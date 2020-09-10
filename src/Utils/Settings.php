<?php

namespace EditormdUtils;

use \SettingsApi\SettingsApi as SettingsGo;
use EditormdUtils\Config;

class Settings {

    /**
     * @var string 插件名称
     */
    private $plugin_name;

    /**
     * @var string 插件版本号
     */
    private $version;

    /**
     * @var string 翻译文本域
     */
    protected $text_domain;

    private $settings_api;

    function __construct($plugin_name, $version, $text_domain) {
        $this->plugin_name = $plugin_name;
        $this->text_domain = $text_domain;
        $this->version     = $version;

        // 设置菜单生成器
        $this->settings_api = new SettingsGo;

        add_action("admin_init", array($this, "admin_init"));
        add_action("admin_menu", array($this, "admin_menu"));

        // 只在插件设置页面加载相关静态资源
        if (isset($_GET["page"]) && $_GET["page"] == "wp-editormd-settings") {
            add_action("admin_enqueue_scripts", array($this, "code_mirror_script"));
    
            wp_enqueue_style("jQuery.Modal", Config::get_option("editor_addres","editor_style") . "/assets/jQuery.Modal/jquery.modal.min.css", array(), WP_EDITORMD_VER, "all");
            wp_enqueue_script("jQuery.Modal", Config::get_option("editor_addres","editor_style") . "/assets/jQuery.Modal/jquery.modal.min.js", array("jquery"), WP_EDITORMD_VER, true);
        }
    }

    function admin_init() {
        //检查编辑器静态资源，如果是默认配置选项提前条件下，不符合最新版资源强制升级
        $option = get_option("editor_style");
        $addres = $option["editor_addres"];
        // is_ssl 判断网站是否启用ssl不准确
        $jsdelivrLatest = "https://cdn.jsdelivr.net/wp/wp-editormd/tags/" . WP_EDITORMD_VER;

        // 判断本地选项是否jsdelivr地址，如果是则判断是否最新地址
        // jsdelivr始终提供https地址，所以，我们无需管用户当前是否启用ssl，一律加载https的jsdelivr
        // 否则由于is_ssl的判断失误，导致https的网站尝试去加载http的jsdelivr而被浏览器安全策略阻止
        // 同时，http网页加载https资源更安全，无法被运营商劫持
        $addresResult = preg_match("/cdn\.jsdelivr\.net/i",$addres);
        if ($addresResult && $addres !== $jsdelivrLatest) {
            $option["editor_addres"] =  $jsdelivrLatest;
            update_option("editor_style",$option);
        }
        //如果空值填入最新CDN地址 - 编辑器静态地址
        if (Config::get_option("editor_addres", "editor_style") === "") {
            $option["editor_addres"] =  $jsdelivrLatest;
            update_option("editor_style",$option);
        }

        //如果空值填入最新CDN地址 - 思维导图
        if (Config::get_option("customize_mindmap", "editor_mindmap") === "") {
            $option["customize_mindmap"] =  $jsdelivrLatest . "/assets/MindMap/mindMap.min.js";
            update_option("editor_mindmap",$option);
        }

        //set the settings
        $this->settings_api->set_sections($this->get_settings_sections());
        $this->settings_api->set_fields($this->get_settings_fields());

        //initialize settings
        $this->settings_api->admin_init();

        // 检查是否携带需要弹出Modal的参数
    }

    function admin_menu() {
        add_options_page($this->plugin_name . __(" Options", $this->text_domain), $this->plugin_name, "manage_options", "wp-editormd-settings", array($this, "plugin_page"));
    }

    function code_mirror_script() {
        wp_enqueue_script("code-editor");
        wp_enqueue_style("code-editor");

        $settings = wp_enqueue_code_editor(array(
            "type" => "json",
            'codemirror' => array(
                'autoRefresh' => true
              )
        ));

        // 系统禁用CodeMirror
        if (false === $settings) {
            return;
        }

        wp_add_inline_script(
            "code-editor",
            sprintf(
                'jQuery(function() { jQuery("#editor_mermaid\\\\[mermaid_config\\\\]").length !== 0 ? wp.codeEditor.initialize("editor_mermaid\\\\[mermaid_config\\\\]", %s) : ""; });',
                wp_json_encode($settings)
            )
        );

        wp_add_inline_script(
            "wp-codemirror",
            "window.CodeMirror = wp.CodeMirror;"
        );
    }

    function file_get_content($url) {
        $timeout = 3;
        if (function_exists("file_get_contents")) {
            $ctx = stream_context_create(
                [ 'http' => [ 'timeout' => $timeout ] ]
            );

            $file_contents = @file_get_contents($url, false, $ctx);
        }
        if ($file_contents == "") {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
            $file_contents = curl_exec($ch);
            curl_close($ch);
        }
        return $file_contents;
    }

    function get_settings_sections() {
        //判断资源版本
        $file_json = Config::get_option("editor_addres","editor_style") . "/assets/version.json";
        $json_string = $this->file_get_content($file_json);
        $editormd = json_decode($json_string, true);
        if ($editormd != null) {
            $file_version = $editormd["version"];
            define("WP_EDITORMD_STATIC_FILE_VER", $file_version); //编辑器静态资源版本
        } else {
            define("WP_EDITORMD_STATIC_FILE_VER", "0.0.0"); //编辑器静态资源版本
            add_action("admin_notices", function () {
                $message = __("The resource package is corrupt, please download again!", "editormd");
                printf('<div class="error"><p>%1$s</p></div>', esc_html($message));
            });
        }
        /**
         * 返回资源版本状态
         * @return string
         */
        function upgradeEditormdFile() {
            if (WP_EDITORMD_STATIC_FILE_VER !== WP_EDITORMD_VER) {
                add_action("admin_notices", function () {
                    $message = __("The resources used by the plugin check are outdated. Please upgrade the latest resources.", "editormd");
                    printf('<div class="error"><p>%1$s</p></div>', esc_html($message));
                });
                return '<span class="error">'. __('Status: Please Update!', 'editormd') .'</span><a href="https://github.com/LuRenJiasWorld/WP-Editor.md/releases/latest">'. __('Downaload', 'editormd') .'</a>';
            } else {
                return '<span class="updated">'. __('Status: Latest', 'editormd') .'</span>';
            }
        }

        $sections = array(
            array(
                "id"    => "editor_basics",
                "title" => __("Basic Settings", $this->text_domain)
            ),
            array(
                "id"    => "editor_style",
                "title" => __("Editor Style Settings", $this->text_domain)
            ),
            array(
                "id"    => "syntax_highlighting",
                "title" => __("Syntax Highlighting Settings", $this->text_domain)
            ),
            array(
                "id"    => "editor_emoji",
                "title" => __("Emoji Settings", $this->text_domain)
            ),
            array(
                "id"    => "editor_toc",
                "title" => __("TOC Settings", $this->text_domain)
            ),
            array(
                "id"    => "editor_latex",
                "title" => __("KaTeX Settings", $this->text_domain)
            ),
            array(
                "id"    => "editor_mermaid",
                "title" => __("Mermaid Settings", $this->text_domain)
            ),
            array(
                "id"    => "editor_mindmap",
                "title" => __("MindMap Settings", $this->text_domain)
            ),
            array(
                "id"    => "editor_advanced",
                "title" => __("Advanced Settings", $this->text_domain)
            ),
        );

        return $sections;
    }

    /**
     * Returns all the settings fields
     *
     * @return array settings fields
     */
    function get_settings_fields() {
        $mermaidConfig = '{
    "theme": "dark",
    "logLevel": 5,
    "arrowMarkerAbsolute": false,
    "startOnLoad": true,
    "flowchart": {
        "htmlLabels": true,
        "curve": "linear"
    },
    "sequence": {
        "diagramMarginX": 50,
        "diagramMarginY": 10,
        "actorMargin": 50,
        "width": 150,
        "height": 65,
        "boxMargin": 10,
        "boxTextMargin": 5,
        "noteMargin": 10,
        "messageMargin": 35,
        "mirrorActors": true,
        "bottomMarginAdj": 1,
        "useMaxWidth": true
    },
    "gantt": {
        "titleTopMargin": 25,
        "barHeight": 20,
        "barGap": 4,
        "topPadding": 50,
        "leftPadding": 75,
        "gridLineStartPadding": 35,
        "fontSize": 11,
        "fontFamily": "\"Open-Sans\", \"sans-serif\"",
        "numberSectionStyles": 4,
        "axisFormat": "%Y-%m-%d"
    },
    "class": {},
    "git": {}
}';
        $settings_fields = array(
            'editor_basics'       => array(
                array(
                    'name'  => 'support_posts_pages',
                    'label' => __('Use Markdown For Posts And Pages', $this->text_domain),
                    'desc'  => '<a href="' . admin_url("options-writing.php") . '" target="_blank">' . __('Go', $this->text_domain) . '</a>',
                    'type'  => 'html'
                ),
                array(
                    'name'  => 'support_comment',
                    'label' => __('Use Markdown For Comments', $this->text_domain),
                    'desc'  => '<a href="' . admin_url("options-discussion.php#wpcom_publish_comments_with_markdown") . '" target="_blank">' . __('Go', $this->text_domain) . '</a>',
                    'type'  => 'html'
                ),
                array(
                    'name'    => 'task_list',
                    'label'   => __('Support Task Lists', $this->text_domain),
                    'desc'    => __('Github Flavored Markdown task lists', $this->text_domain),
                    'type'    => 'checkbox',
                    'default' => 'off'
                ),
                array(
                    'name'    => 'imagepaste',
                    'label'   => __('Support Image Paste', $this->text_domain),
                    'desc'    => __('Image Paste allows you to copy and paste images from your desktop to the editor, maybe won\'t work on some browsers due to incompatibility. Reference: <a href="https://github.com/LuRenJiasWorld/WP-Editor.md/pull/386" target="_blank">PR #386</a>', $this->text_domain),
                    'type'    => 'checkbox',
                    'default' => 'off'
                ),
                array(
                    'name'    => 'imagepaste_sm',
                    'label'   => __('ImagePaste Upload Source', $this->text_domain),
                    'desc'    => __('Change image paste upload source to https://sm.ms', $this->text_domain),
                    'type'    => 'checkbox',
                    'default' => 'off'
                ),
                array(
                    'name'    => 'imagepaste_sm_token',
                    'label'   => __('sm.ms Auth Token', $this->text_domain),
                    'desc'    => __('Optional, makes your uploaded image binded with your sm.ms account. Get token <a href="https://sm.ms/home/apitoken" target="_blank">Here</a>.', $this->text_domain),
                    'type'    => 'text',
                    'default' => ''
                ),
                array(
                    'name'    => 'sm_library_management',
                    'label'   => __('sm.ms Image Management', $this->text_domain),
                    'desc'    => '<a href="javascript;" id="sm-ms-management">' . __('Go', $this->text_domain) . '</a>',
                    'type'    => 'html'
                ),
                array(
                    'name'    => 'image_link',
                    'label'   => __('Image Hyperlink', $this->text_domain),
                    'desc'    => __('Support upload image hyperlink', $this->text_domain),
                    'type'    => 'checkbox',
                    'default' => 'off'
                ),
                array(
                    'name'    => 'open_in_new_tab',
                    'label'   => __('Open link in new tab', $this->text_domain),
                    'desc'    => __('Only works for new posts after enabled, or you can manually update every posts', $this->text_domain),
                    'type'    => 'checkbox',
                    'default' => 'on'
                ),
                array(
                    'name'    => 'live_preview',
                    'label'   => __('Live preview', $this->text_domain),
                    'desc'    => __('', $this->text_domain),
                    'type'    => 'checkbox',
                    'default' => 'off'
                ),
                array(
                    'name'    => 'sync_scrolling',
                    'label'   => __('Sync scrolling', $this->text_domain),
                    'desc'    => __('', $this->text_domain),
                    'type'    => 'checkbox',
                    'default' => 'off'
                ),
                array(
                    'name'    => 'html_decode',
                    'label'   => __('Support Html Decode', $this->text_domain),
                    'desc'    => __('Support rich text analysis', $this->text_domain),
                    'type'    => 'checkbox',
                    'default' => 'off'
                ),
                array(
                    'name'    => 'support_front',
                    'label'   => __('Support Front Comment', $this->text_domain),
                    'type'    => 'checkbox',
                    'default' => 'off'
                ),
                array(
                    'name'    => 'support_reply',
                    'label'   => __('Support Reply Comment For edit-comments.php', $this->text_domain),
                    'type'    => 'checkbox',
                    'default' => 'off'
                ),
                array(
                    'name'    => 'support_other_text',
                    'label'   => __('Support Other (Document ID)', $this->text_domain),
                    'desc'    => __('', $this->text_domain),
                    'type'    => 'text',
                    'default' => ''
                )
            ),
            'editor_style'        => array(
                array(
                    'name'    => 'theme_style',
                    'label'   => __('Toolbar & Preview Style', $this->text_domain),
                    'desc'    => __('Will not affect the Markdown editor window', $this->text_domain),
                    'type'    => 'select',
                    'options' => array(
                        'default' => __('default', $this->text_domain),
                        'dark'    => __('dark', $this->text_domain)
                    ),
                    'default' => 'default'
                ),
                array(
                    'name'    => 'code_style',
                    'label'   => __('Markdown Editor Style', $this->text_domain),
                    'desc'    => __('Change the markdown editor style', $this->text_domain),
                    'type'    => 'select',
                    'options' => array(
                        'default'                 => 'default',
                        '3024-day'                => '3024-day',
                        '3024-night'              => '3024-night',
                        'abcdef'                  => 'abcdef',
                        'ambiance'                => 'ambiance',
                        'ambiance-mobile'         => 'ambiance-mobile',
                        'base16-dark'             => 'base16-dark',
                        'base16-light'            => 'base16-light',
                        'bespin'                  => 'bespin',
                        'blackboard'              => 'blackboard',
                        'cobalt'                  => 'cobalt',
                        'colorforth'              => 'colorforth',
                        'dracula'                 => 'dracula',
                        'duotone-dark'            => 'duotone-dark',
                        'duotone-light'           => 'duotone-light',
                        'eclipse'                 => 'eclipse',
                        'elegant'                 => 'elegant',
                        'erlang-dark'             => 'erlang-dark',
                        'gruvbox-dark'            => 'gruvbox-dark',
                        'hopscotch'               => 'hopscotch',
                        'icecoder'                => 'icecoder',
                        'idea'                    => 'idea',
                        'isotope'                 => 'isotope',
                        'lesser-dark'             => 'lesser-dark',
                        'liquibyte'               => 'liquibyte',
                        'lucario'                 => 'lucario',
                        'material'                => 'material',
                        'mbo'                     => 'mbo',
                        'mdn-like'                => 'mdn-like',
                        'midnight'                => 'midnight',
                        'monokai'                 => 'monokai',
                        'neat'                    => 'neat',
                        'neo'                     => 'neo',
                        'night'                   => 'night',
                        'oceanic-next'            => 'oceanic-next',
                        'panda-syntax'            => 'panda-syntax',
                        'paraiso-dark'            => 'paraiso-dark',
                        'paraiso-light'           => 'paraiso-light',
                        'pastel-on-dark'          => 'pastel-on-dark',
                        'railscasts'              => 'railscasts',
                        'rubyblue'                => 'rubyblue',
                        'seti'                    => 'seti',
                        'shadowfox'               => 'shadowfox',
                        'solarized'               => 'solarized',
                        'ssms'                    => 'ssms',
                        'the-matrix'              => 'the-matrix',
                        'tomorrow-night-bright'   => 'tomorrow-night-bright',
                        'tomorrow-night-eighties' => 'tomorrow-night-eighties',
                        'ttcn'                    => 'ttcn',
                        'twilight'                => 'twilight',
                        'vibrant-ink'             => 'vibrant-ink',
                        'xq-dark'                 => 'xq-dark',
                        'xq-light'                => 'xq-light',
                        'yeti'                    => 'yeti',
                        'zenburn'                 => 'zenburn'
                    ),
                    'default' => 'default'
                ),
                array(
                    'name'    => 'style_preview',
                    'label'   => __('Editor Style Preview', $this->text_domain),
                    'desc'    => '
                                    <div id="style-preview-container">
                                        <img 
                                            src="https://github.com/LuRenJiasWorld/WP-Editor.md-Image-Resource/raw/master/editor-preview/blank.png" 
                                            id="style-preview-frame" 
                                        />
                                        <img 
                                            src="https://github.com/LuRenJiasWorld/WP-Editor.md-Image-Resource/raw/master/editor-markdown/blank.png"
                                            id="style-preview-editor" 
                                        />
                                    </div>
                                 ',
                    'type'    => 'html'
                ),
                array(
                    'name'    => 'editor_addres',
                    'label'   => __('Editor.md Static Resource Addres', $this->text_domain),
                    'desc'    => __('Please make sure the resources are up to date.<br/>' , $this->text_domain) . __('Please upload the resource (the unzipped folder name is "assets") to your server or cdn. If your resource address is: "http(s)://example.com/myfile/assets", you should fill in: "http(s)://example.com/myfile ". <br/>',$this->text_domain) . upgradeEditormdFile(),
                    'type'    => 'text',
                    'default' => '//cdn.jsdelivr.net/wp/wp-editormd/tags/' . WP_EDITORMD_VER
                ),
            ),
            'syntax_highlighting' => array(
                array(
                    'name'    => 'highlight_mode_auto',
                    'label'   => __('Auto load mode', $this->text_domain),
                    'desc'    => __('', $this->text_domain),
                    'type'    => 'checkbox',
                    'default' => 'off'
                ),
                array(
                    'name'    => 'line_numbers',
                    'label'   => __('Line Numbers', $this->text_domain),
                    'desc'    => __('', $this->text_domain),
                    'type'    => 'checkbox',
                    'default' => 'off'
                ),
                array(
                    'name'    => 'show_language',
                    'label'   => __('Show Language', $this->text_domain),
                    'desc'    => __('', $this->text_domain),
                    'type'    => 'checkbox',
                    'default' => 'off'
                ),
                array(
                    'name'    => 'copy_clipboard',
                    'label'   => __('Copy to Clipboard', $this->text_domain),
                    'desc'    => __('', $this->text_domain),
                    'type'    => 'checkbox',
                    'default' => 'off'
                ),
                array(
                    'name'    => 'highlight_library_style',
                    'label'   => __('PrismJS Syntax Highlight Style', $this->text_domain),
                    'desc'    => __('Syntax highlight theme style', $this->text_domain),
                    'type'    => 'select',
                    'options' => array(
                        'default'        => 'Default',
                        'dark'           => 'Dark',
                        'funky'          => 'Funky',
                        'okaidia'        => 'Okaidia',
                        'twilight'       => 'Twilight',
                        'coy'            => 'Coy',
                        'solarizedlight' => 'Solarized Light',
                        'tomorrow'       => 'Tomorrow Night',
                        'customize'       => __('Customize Style', $this->text_domain),
                    ),
                    'default' => 'default'
                ),
                array(
                    'name'    => 'highlight_preview',
                    'label'   => __('Syntax Highlight Preview', $this->text_domain),
                    'desc'    => '
                                    <div id="highlight-preview-container">
                                        <img 
                                            src="https://github.com/LuRenJiasWorld/WP-Editor.md-Image-Resource/raw/master/editor-highlight/blank.png" 
                                            id="highlight-preview-frame" 
                                        />
                                    </div>
                                 ',
                    'type'    => 'html'
                ),
                array(
                    'name'    => 'customize_my_style',
                    'label'   => __('Customize Style Library', $this->text_domain),
                    'desc'    => __('Get More <a href="https://github.com/LuRenJiasWorld/Prism.js-style" target="_blank" rel="nofollow">Theme Style</a>', $this->text_domain),
                    'type'    => 'text',
                    'default' => 'notiong'
                )
            ),
            'editor_emoji'        => array(
                array(
                    'name'    => 'support_emoji',
                    'label'   => __('Support Emoji', $this->text_domain),
                    'desc'    => __('', $this->text_domain),
                    'type'    => 'checkbox',
                    'default' => 'off'
                )
            ),
            'editor_toc'          => array(
                array(
                    'name'    => 'support_toc',
                    'label'   => __('Support ToC', $this->text_domain),
                    'desc'    => __('Table of Contents', $this->text_domain),
                    'type'    => 'checkbox',
                    'default' => 'off'
                ),
                array(
                    'name'  => 'toc_tips',
                    'label' => __('You need install the plugin', $this->text_domain),
                    'desc'  => '<a class="toc_tips" href="' . admin_url("plugin-install.php?tab=plugin-information&plugin=table-of-contents-plus&TB_iframe=true ") . '" rel="nofollow" target="_blank">' . __('If you need to enable this option,you need install the plugin', $this->text_domain) . '</a>',
                    'type'  => 'html'
                )
            ),
            'editor_latex'        => array(
                array(
                    'name'    => 'support_latex',
                    'label'   => __('Support LaTeX', $this->text_domain),
                    'desc'    => __('LaTeX Support Library', $this->text_domain),
                    'type'    => 'select',
                    'options' => array(
                        'katex'   => 'KaTeX',
                        'disable' => __('Disable', $this->text_domain)
                   ),
                    'default' => 'disable'
               ),
            ),
            'editor_mermaid'      => array(
                array(
                    'name'    => 'support_mermaid',
                    'label'   => __('Support Mermaid', $this->text_domain),
                    'desc'    => __('Support FlowChart,SequenceDiagram and GantDiagrams', $this->text_domain),
                    'type'    => 'checkbox',
                    'default' => 'off'
                ),
                array(
                    'name'    => 'mermaid_config',
                    'label'   => __('Mermaid Config', $this->text_domain),
                    'desc'    => __('More info: <a rel="nofollow" target="_blank" href="https://mermaidjs.github.io/mermaidAPI.html">MermaidAPI Doc</a> and <a href="https://github.com/knsv/mermaid/blob/master/src/mermaidAPI.js" target="_blank" rel="nofollow">MermaidAPI.js</a>', $this->text_domain),
                    'type'    => 'textarea',
                    'default' => $mermaidConfig
               )
           ),
            'editor_mindmap'      => array(
                array(
                    'name'    => 'support_mindmap',
                    'label'   => __('Support MindMap', $this->text_domain),
                    'desc'    => __('', $this->text_domain),
                    'type'    => 'checkbox',
                    'default' => 'off'
                ),
                array(
                    'name'    => 'customize_mindmap',
                    'label'   => __('Customize MindMap Library', $this->text_domain),
                    'type'    => 'text',
                    'default' => Config::get_option('editor_addres','editor_style') . '/assets/MindMap/mindMap.min.js'
                ),
           ),
            'editor_advanced'     => array(
                array(
                    'name'    => 'jquery_compatible',
                    'label'   => __('Compatibility Mode', $this->text_domain),
                    'desc'    => __('Enable WordPress\'s own jQuery library and load first, will fix many compatibility issues.', $this->text_domain),
                    'type'    => 'checkbox',
                    'default' => 'off'
                ),
                array(
                    'name'  => 'debugger',
                    'label' => __('Debugger', $this->text_domain),
                    'desc'  => '<a id="debugger" href="#">' . __('Info', $this->text_domain) . '</a>',
                    'type'  => 'html'
                ),
                array(
                    'name'  => 'hide_ads',
                    'label'   => __('Hide Ads', $this->text_domain),
                    'desc'    => __('', $this->text_domain),
                    'type'    => 'checkbox',
                    'default' => 'off'
               ),
            ),
        );

        return $settings_fields;
    }

    function plugin_page() {
        echo '<div class="wrap">';

        $this->settings_api->show_navigation();

        echo '<div class="form-and-donate">';

        $this->settings_api->show_forms();

        echo Debugger::editormd_debug($this->text_domain);

        if(Config::get_option("hide_ads","editor_advanced") == "off") {
            $donateImgUrl = "//static.lurenjia.in/WP%20Editor.md";
            
            echo '<div id="donate">';
            echo '<h3>' . __('Donate', $this->text_domain) . '</h3>';
            echo '<p>' . __('It is hard to continue development and support for this plugin without contributions from users like you. If you enjoy using WP-Editor.md and find it useful, please consider making a donation. Your donation will help encourage and support the plugin’s continued development and better user support.Thank You!', $this->text_domain) . '</p>';
            echo '<p style="display: table;"><strong style="display: table-cell;vertical-align: middle;">Alipay(支付宝)：</strong><a rel="nofollow" target="_blank" href="'. $donateImgUrl .'/支付宝.png"><img width="160" height="160" src="'. $donateImgUrl .'/支付宝.png"/></a></p>';
            echo '<p style="display: table;"><strong style="display: table-cell;vertical-align: middle;">WeChat(微信)：</strong><a rel="nofollow" target="_blank" href="'. $donateImgUrl .'/微信赞赏.png"><img width="160" height="160" src="'. $donateImgUrl .'/微信赞赏.png"/></a></p>';
            echo '<p style="display: table;"><strong style="display: table-cell;vertical-align: middle;">PayPal(贝宝)：</strong><a rel="nofollow" target="_blank" href="https://www.paypal.me/lurenjia">https://www.paypal.me/lurenjia</a></p>';
            echo '</div>';
        }
        
        echo '</div>';
        echo '</div>';

        $this->script_style();
    }

    /**
     * Get all the pages
     *
     * @return array page names with key value pairs
     */
    function get_pages() {
        $pages         = get_pages();
        $pages_options = array();
        if ($pages) {
            foreach ($pages as $page) {
                $pages_options[$page->ID] = $page->post_title;
            }
        }

        return $pages_options;
    }

    private function script_style() {
        $editor_style_base_address = Config::get_option("editor_addres", "editor_style");
        include "Settings/settings.css.php";
        include "Settings/settings.js.php";
    }
}
