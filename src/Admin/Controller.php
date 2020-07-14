<?php

namespace EditormdAdmin;

use EditormdApp\WPComMarkdown;
use EditormdUtils\Config;

class Controller {
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
    private $text_domain;

    /**
     * @var string 静态资源地址
     */
    private $front_static_url;

    /**
     * @var \League\HTMLToMarkdown\HtmlConverter
     */
    private $htmlConverter;

    /**
     * Controller constructor 初始化类并设置其属性
     *
     * @param $plugin_name
     * @param $version
     * @param $ioption
     */
    public function __construct() {
        $this->plugin_name = "WP Editor.md";
        $this->text_domain = "editormd";
        $this->version = WP_EDITORMD_VER;
        $this->front_static_url = Config::get_option("editor_addres", "editor_style");

        add_filter("pre_option_" . WPComMarkdown::POST_OPTION, "__return_true");

        add_action("admin_init", array($this, "editormd_markdown_posting_always_on"), 11);

        add_filter("wp_editor_settings", array($this, "parse_editor_settings"));

        add_action("edit_page_form", array($this, "enqueue_styles"));
        add_action("edit_page_form", array($this, "enqueue_scripts"));
        add_action("edit_form_advanced", array($this, "enqueue_styles"));
        add_action("edit_form_advanced", array($this, "enqueue_scripts"));
        add_action("load-edit-comments.php", array($this, "enqueue_styles"));
        add_action("load-edit-comments.php", array($this, "enqueue_scripts"));

        // WordPress 5.0 Gutenberg Editor
        if ($GLOBALS["wp_version"] > "5.0") {
            add_filter("use_block_editor_for_post", "__return_false", 5);
        }
    }

    /**
     * 删除和编辑器无用的设置
     *
     * @param $settings
     *
     * @return mixed
     */
    public function parse_editor_settings($settings) {
        $settings["tinymce"] = false;
        $settings["quicktags"] = true;
        return $settings;
    }

    /**
     * 注册样式文件
     */
    public function enqueue_styles() {
        // Style - Editor.md
        wp_enqueue_style("Editormd", $this->front_static_url . "/assets/Editormd/editormd.min.css", array(), WP_EDITORMD_VER, "all");
    }

    /**
     * 注册脚本文件
     */
    public function enqueue_scripts() {
        //JavaScript - Turndown
        wp_enqueue_script("Turndown", $this->front_static_url . "/assets/Turndown/turndown.js", array(), "5.0.1", true);

        //JavaScript - Editormd
        wp_enqueue_script("Editormd", $this->front_static_url . "/assets/Editormd/editormd.min.js", array("jquery"), WP_EDITORMD_VER, true);

        //JavaScript - Config
        wp_enqueue_script("Config", $this->front_static_url . "/assets/Config/editormd.min.js", array("Editormd"), $this->version, true);

        //JavaScript - 载入国际化语言资源文件
        $lang = get_bloginfo("language");
        switch ($lang) {
            case "zh-TW":
                wp_enqueue_script("Editormd-lang-tw", $this->front_static_url . "/assets/Editormd/languages/zh-tw.js", array(), WP_EDITORMD_VER, true);//载入台湾语言资源库
                break;
            case "zh-CN":
                break;
            case "en-US":
                wp_enqueue_script("Editormd-lang-us", $this->front_static_url . "/assets/Editormd/languages/en.js", array(), WP_EDITORMD_VER, true);//载入美国英语语言资源库
                break;
            default:
                wp_enqueue_script("Editormd-lang-us", $this->front_static_url . "/assets/Editormd/languages/en.js", array(), WP_EDITORMD_VER, true);//默认载入美国英语语言资源库
        }

        if (Config::get_option("highlight_library_style", "syntax_highlighting") == "customize") {
            $prismTheme = Config::get_option("customize_my_style"     , "syntax_highlighting");
        } else {
            $prismTheme = Config::get_option("highlight_library_style", "syntax_highlighting");
        }

        wp_localize_script("Config", "_Editormd", array(
            "editormdUrl"       => $this->front_static_url,                                      // 静态资源CDN地址
            "syncScrolling"     => Config::get_option("sync_scrolling", "editor_basics"),        // 编辑器同步
            "livePreview"       => Config::get_option("live_preview", "editor_basics"),          // 即是否开启实时预览
            "htmlDecode"        => Config::get_option("html_decode", "editor_basics"),           // HTML标签解析
            "imageLink"         => Config::get_option("image_link", "editor_basics"),            // 图片链接
            "toc"               => Config::get_option("support_toc", "editor_toc"),              // TOC
            "theme"             => Config::get_option("theme_style", "editor_style"),            // 编辑器总体主题
            "previewTheme"      => Config::get_option("theme_style", "editor_style"),            // 编辑器预览主题
            "editorTheme"       => Config::get_option("code_style", "editor_style"),             // 编辑器编辑主题
            "emoji"             => Config::get_option("support_emoji", "editor_emoji"),          // emoji表情
            "tex"               => Config::get_option("support_latex", "editor_latex"),          // 科学公式
            "taskList"          => Config::get_option("task_list", "editor_basics"),             // task lists
            "imagePaste"        => Config::get_option("imagepaste", "editor_basics"),            // 图像粘贴
            "prismTheme"        => $prismTheme,                                                  // 语法高亮风格
            "prismLineNumbers"  => Config::get_option("line_numbers", "syntax_highlighting"),    // 行号显示
            "mindMap"           => Config::get_option("support_mindmap", "editor_mindmap"),      // 思维导图
            "mindMapURL"        => Config::get_option("customize_mindmap", "editor_mindmap"),    // 思维导图地址
            "mermaid"           => Config::get_option("support_mermaid", "editor_mermaid"),      // Mermaid
            //"mermaidConfig"     => Config::get_option("mermaid_config","editor_mermaid"),      // Mermaid配置
            "placeholderEditor" => __("Enjoy Markdown! Coding now...", $this->text_domain),
            "imgUploading"      => __("Image Uploading...", $this->text_domain),
            "imgUploadeFailed"  => __("Failed To Upload The Image!", $this->text_domain),
            "supportComment"    => Config::get_option("support_front", "editor_basics"),         // 前端评论
            "supportReply"      => Config::get_option("support_reply", "editor_basics")          // 后台回复评论
        ));
    }

    /**
     * 将 Jetpack Markdown写作模式始终设置为开
     */
    public function editormd_markdown_posting_always_on() {
        if (!class_exists("WPComMarkdown")) {
            return;
        }
        global $wp_settings_fields;
        if (isset($wp_settings_fields["writing"]["default"][WPComMarkdown::POST_OPTION])) {
            unset($wp_settings_fields["writing"]["default"][WPComMarkdown::POST_OPTION]);
        }
    }
}
