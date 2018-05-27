<?php

namespace Utils;

use \SettingsApi\SettingsApi as SettingsGo;

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

	function __construct( $plugin_name, $version, $text_domain ) {
		$this->plugin_name = $plugin_name;
		$this->text_domain = $text_domain;
		$this->version     = $version;

		$this->settings_api = new SettingsGo;

		add_action( 'admin_init', array( $this, 'admin_init' ) );
		add_action( 'admin_menu', array( $this, 'admin_menu' ) );
	}

	function admin_init() {

		//set the settings
		$this->settings_api->set_sections( $this->get_settings_sections() );
		$this->settings_api->set_fields( $this->get_settings_fields() );

		//initialize settings
		$this->settings_api->admin_init();
	}

	function admin_menu() {
		add_plugins_page( $this->plugin_name . __( ' Options', $this->text_domain ), $this->plugin_name, 'manage_options', 'wp-editormd-settings', array( $this, 'plugin_page' ) );
	}

	function get_settings_sections() {
		$sections = array(
			array(
				'id'    => 'editor_basics',
				'title' => __( 'Basic Settings', $this->text_domain )
			),
			array(
				'id'    => 'editor_style',
				'title' => __( 'Editor Style Settings', $this->text_domain )
			),
			array(
				'id'    => 'syntax_highlighting',
				'title' => __( 'Syntax Highlighting Settings', $this->text_domain )
			),
			array(
				'id'    => 'editor_emoji',
				'title' => __( 'Emoji Settings', $this->text_domain )
			),
			array(
				'id'    => 'editor_toc',
				'title' => __( 'TOC Settings', $this->text_domain )
			),
			array(
				'id'    => 'editor_katex',
				'title' => __( 'KaTeX Settings', $this->text_domain )
			),
			array(
				'id'    => 'editor_mermaid',
				'title' => __( 'Mermaid Settings', $this->text_domain )
			),
			array(
				'id'    => 'editor_mindmap',
				'title' => __( 'MindMap Settings', $this->text_domain )
			),
			array(
				'id'    => 'editor_advanced',
				'title' => __( 'Advanced Settings', $this->text_domain )
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
		$settings_fields = array(
			'editor_basics'       => array(
				array(
					'name'  => 'support_comment',
					'label' => __( 'Use Markdown For Posts And Pages', $this->text_domain ),
					'desc'  => '<a href="' . admin_url( "options-writing.php" ) . '" target="_blank">' . __( 'Go', $this->text_domain ) . '</a>',
					'type'  => 'html'
				),
				array(
					'name'  => 'support_post_page',
					'label' => __( 'Use Markdown For Comments', $this->text_domain ),
					'desc'  => '<a href="' . admin_url( "options-discussion.php#wpcom_publish_comments_with_markdown" ) . '" target="_blank">' . __( 'Go', $this->text_domain ) . '</a>',
					'type'  => 'html'
				),
				array(
					'name'    => 'task_list',
					'label'   => __( 'Support Task Lists', $this->text_domain ),
					'desc'    => __( 'Github Flavored Markdown task lists', $this->text_domain ),
					'type'    => 'checkbox',
					'default' => 'off'
				),
				array(
					'name'    => 'imagepaste',
					'label'   => __( 'Support Image Paste', $this->text_domain ),
					'desc'    => __( 'Image Paste allows you to copy and paste images from your desktop to the editor', $this->text_domain ),
					'type'    => 'checkbox',
					'default' => 'off'
				),
				array(
					'name'    => 'live_preview',
					'label'   => __( 'Live preview', $this->text_domain ),
					'desc'    => __( '', $this->text_domain ),
					'type'    => 'checkbox',
					'default' => 'off'
				),
				array(
					'name'    => 'sync_scrolling',
					'label'   => __( 'Sync scrolling', $this->text_domain ),
					'desc'    => __( '', $this->text_domain ),
					'type'    => 'checkbox',
					'default' => 'off'
				),
				array(
					'name'    => 'html_decode',
					'label'   => __( 'Support Html Decode', $this->text_domain ),
					'desc'    => __( 'Support rich text analysis', $this->text_domain ),
					'type'    => 'checkbox',
					'default' => 'off'
				),
				array(
					'name'    => 'static_cdn',
					'label'   => __( 'Static File CDN', $this->text_domain ),
					'desc'    => __( 'Store static files in CDN to increase website speed,<br/>Files List:jQuery,KaTeX,Mermaid,Emoji', $this->text_domain ),
					'type'    => 'radio',
					'options' => array(
						'//cdn.jsdelivr.net'               => __( 'Recommended Use', $this->text_domain ) . ' JSDelivr',
						'//cdn.bootcss.com'                => __( 'China', $this->text_domain ) . ' BootCDN',
						'//cdn.staticfile.org'             => __( 'China', $this->text_domain ) . ' Staticfile CDN',
						'//cdnjs.cloudflare.com/ajax/libs' => __( 'International', $this->text_domain ) . ' CDNJS'
					),
					'default' => 'default'
				)
			),
			'editor_style'        => array(
				array(
					'name'    => 'theme_style',
					'label'   => __( 'Editor Theme Style', $this->text_domain ),
					'desc'    => __( 'Change the editor theme style', $this->text_domain ),
					'type'    => 'select',
					'options' => array(
						'default' => __( 'default', $this->text_domain ),
						'dark'    => __( 'dark', $this->text_domain )
					),
					'default' => 'default'
				),
				array(
					'name'    => 'code_style',
					'label'   => __( 'Code Theme Style', $this->text_domain ),
					'desc'    => __( 'Change the code theme style in the editor', $this->text_domain ),
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
				)
			),
			'syntax_highlighting' => array(
				array(
					'name'  => 'highlight_tip',
					'label' => __( 'Tips', $this->text_domain ),
					'desc'  => __( '<b>Please Select the following load mode and do not enable the feature if you do not select it.</b>', $this->text_domain ),
					'type'  => 'html'
				),
				array(
					'name'  => 'highlight_auto_tip',
					'label' => __( 'Load Mode', $this->text_domain ),
					'desc'  => __( '<b>Load Mode - Auto load mode</b> - Please select one of the two modes', $this->text_domain ),
					'type'  => 'html'
				),
				array(
					'name'    => 'highlight_mode_auto',
					'label'   => __( 'Auto load mode', $this->text_domain ),
					'desc'    => __( '', $this->text_domain ),
					'type'    => 'checkbox',
					'default' => 'off'
				),
				array(
					'name'    => 'line_numbers',
					'label'   => __( 'Line Numbers', $this->text_domain ),
					'desc'    => __( '', $this->text_domain ),
					'type'    => 'checkbox',
					'default' => 'off'
				),
				array(
					'name'    => 'show_language',
					'label'   => __( 'Show Language', $this->text_domain ),
					'desc'    => __( '', $this->text_domain ),
					'type'    => 'checkbox',
					'default' => 'off'
				),
				array(
					'name'    => 'copy_clipboard',
					'label'   => __( 'Copy to Clipboard', $this->text_domain ),
					'desc'    => __( '', $this->text_domain ),
					'type'    => 'checkbox',
					'default' => 'off'
				),
				array(
					'name'    => 'highlight_library_style',
					'label'   => __( 'PrismJS Syntax Highlight Style', $this->text_domain ),
					'desc'    => __( 'Syntax highlight theme style', $this->text_domain ),
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
						'customize'       => __( 'Customize Style', $this->text_domain ),
					),
					'default' => 'default'
				),
				array(
					'name'    => 'customize_my_style',
					'label'   => __( 'Customize Style Library', $this->text_domain ),
					'desc'    => __( 'Get More <a href="https://github.com/JaxsonWang/Prism.js-Style" target="_blank" rel="nofollow">Theme Style</a>', $this->text_domain ),
					'type'    => 'text',
					'default' => 'notiong'
				),

				array(
					'name'  => 'highlight_customize_tip',
					'label' => __( 'Load Mode', $this->text_domain ),
					'desc'  => __( '<b>Load Mode - Customize load mode</b> - Please select one of the two modes', $this->text_domain ),
					'type'  => 'html'
				),
				array(
					'name'    => 'highlight_mode_customize',
					'label'   => __( 'Customize mode', $this->text_domain ),
					'desc'    => __( '', $this->text_domain ),
					'type'    => 'checkbox',
					'default' => 'off'
				),
				array(
					'name'    => 'customize_highlight_style',
					'label'   => __( 'PrismJS Syntax Highlight Style Library', $this->text_domain ),
					'desc'    => __( '', $this->text_domain ),
					'type'    => 'text',
					'default' => 'nothing'
				),
				array(
					'name'    => 'customize_highlight_javascript',
					'label'   => __( 'PrismJS Syntax Highlight JavaScript Library', $this->text_domain ),
					'desc'    => __( '', $this->text_domain ),
					'type'    => 'text',
					'default' => 'nothing'
				)
			),
			'editor_emoji'        => array(
				array(
					'name'    => 'support_emoji',
					'label'   => __( 'Support Emoji', $this->text_domain ),
					'desc'    => __( '', $this->text_domain ),
					'type'    => 'checkbox',
					'default' => 'off'
				)
			),
			'editor_toc'          => array(
				array(
					'name'    => 'support_toc',
					'label'   => __( 'Support ToC', $this->text_domain ),
					'desc'    => __( 'Table of Contents', $this->text_domain ),
					'type'    => 'checkbox',
					'default' => 'off'
				),
				array(
					'name'  => 'toc_tips',
					'label' => __( 'You need install the plugin', $this->text_domain ),
					'desc'  => '<a class="toc_tips" href="' . admin_url( "plugin-install.php?tab=plugin-information&plugin=table-of-contents-plus&TB_iframe=true " ) . '" rel="nofollow" target="_blank">' . __( 'If you need to enable this option,you need install the plugin', $this->text_domain ) . '</a>',
					'type'  => 'html'
				)
			),
			'editor_katex'        => array(
				array(
					'name'    => 'support_katex',
					'label'   => __( 'Support KaTeX', $this->text_domain ),
					'desc'    => __( '', $this->text_domain ),
					'type'    => 'checkbox',
					'default' => 'off'
				)
			),
			'editor_mermaid'      => array(
				array(
					'name'    => 'support_mermaid',
					'label'   => __( 'Support Mermaid', $this->text_domain ),
					'desc'    => __( 'Support FlowChart,SequenceDiagram and GantDiagrams', $this->text_domain ),
					'type'    => 'checkbox',
					'default' => 'off'
				)
            ),
			'editor_mindmap'      => array(
				array(
					'name'    => 'support_mindmap',
					'label'   => __( 'Support MindMap', $this->text_domain ),
					'desc'    => __( '', $this->text_domain ),
					'type'    => 'checkbox',
					'default' => 'off'
				),
				array(
					'name'    => 'customize_mindmap',
					'label'   => __( 'Customize MindMap Library', $this->text_domain ),
					'type'    => 'text',
					'default' => WP_EDITORMD_URL . '/assets/Editormd/lib/mindMap.min.js'
				),
            ),
			'editor_advanced'     => array(
				array(
					'name'    => 'jquery_compatible',
					'label'   => __( 'Compatibility Mode', $this->text_domain ),
					'desc'    => __( 'Enable WordPress\' own jQuery library and load first', $this->text_domain ),
					'type'    => 'checkbox',
					'default' => 'off'
				),
				array(
					'name'    => 'katex_compatible',
					'label'   => __( 'Old Katex Compatibility Mode', $this->text_domain ),
					'desc'    => __( 'Write math in KaTeX if version below 4.x (included) needs to enable this option.', $this->text_domain ),
					'type'    => 'checkbox',
					'default' => 'off'
				),
				array(
					'name'  => 'debugger',
					'label' => __( 'Debugger', $this->text_domain ),
					'desc'  => '<a id="debugger" href="#">' . __( 'Info', $this->text_domain ) . '</a>',
					'type'  => 'html'
				),
                array(
                    'name'  => 'hide_ads',
                    'label'   => __( 'Hide Ads', $this->text_domain ),
                    'desc'    => __( '', $this->text_domain ),
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
		$this->settings_api->show_forms();

		echo Debugger::editormd_debug( $this->text_domain );

		if($this->get_option('hide_ads','editor_advanced') == 'off') {
            //判断地区，根据不同的地区进入不同的文档
            switch (get_bloginfo( 'language' )) {
                case 'zh-CN':
                    $donateImgUrl = '//gitee.com/JaxsonWang/JaxsonWang/raw/master/mydonate';
                    break;
                default :
                    $donateImgUrl = '//github.com/JaxsonWang/WP-Editor.md/raw/docs/screenshots';
            }
            echo '<div id="donate">';
            echo '<h3>' . __('Donate', $this->text_domain) . '</h3>';
            echo '<p style="width: 50%">' . __('It is hard to continue development and support for this plugin without contributions from users like you. If you enjoy using WP-Editor.md and find it useful, please consider making a donation. Your donation will help encourage and support the plugin’s continued development and better user support.Thank You!', $this->text_domain) . '</p>';
            echo '<p style="display: table;"><strong style="display: table-cell;vertical-align: middle;">Alipay(支付宝)：</strong><a rel="nofollow" target="_blank" href="'. $donateImgUrl .'/alipay.jpg"><img width="100" src="'. $donateImgUrl .'/alipay.jpg"/></a></p>';
            echo '<p style="display: table;"><strong style="display: table-cell;vertical-align: middle;">WeChat(微信)：</strong><a rel="nofollow" target="_blank" href="'. $donateImgUrl .'/wechart.jpg"><img width="100" src="'. $donateImgUrl .'/wechart.jpg"/></a></p>';
            echo '<p style="display: table;"><strong style="display: table-cell;vertical-align: middle;">PayPal(贝宝)：</strong><a rel="nofollow" target="_blank" href="https://www.paypal.me/JaxsonWang">https://www.paypal.me/JaxsonWang</a></p>';
            echo '</div>';
            echo '</div>';
        }

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
		if ( $pages ) {
			foreach ( $pages as $page ) {
				$pages_options[ $page->ID ] = $page->post_title;
			}
		}

		return $pages_options;
	}

    /**
     * 获取字段值
     *
     * @param string $option 字段名称
     * @param string $section 字段名称分组
     * @param string $default 没搜索到返回空
     *
     * @return mixed
     */
    private function get_option( $option, $section, $default = '' ) {

        $options = get_option( $section );

        if ( isset( $options[ $option ] ) ) {
            return $options[ $option ];
        }

        return $default;
    }

	private function script_style() {
		?>
        <style type="text/css" rel="stylesheet">
            /*设置选项样式*/
            .debugger-wrap {
                margin-top: 10px;
                display: none;
            }

            .debugger-wrap tbody tr {
                width: 100%;
                text-align: left;
            }

            .debugger-wrap tbody tr th {
                padding: 5px 10px 5px 0;
            }

            .debugger-wrap tbody tr th:nth-child(2) {
                color: #006686;
                width: 75%;
            }
        </style>
        <script type="text/javascript">
            (function ($) {
                if (document.getElementById('wpuf-syntax_highlighting[highlight_mode_auto]').checked === true) {
                    document.getElementById('wpuf-syntax_highlighting[highlight_mode_customize]').removeAttribute('checked');
                    document.getElementById('wpuf-syntax_highlighting[highlight_mode_customize]').setAttribute('disabled', 'disabled');
                    document.getElementById('syntax_highlighting[customize_highlight_style]').setAttribute('disabled', 'disabled');
                    document.getElementById('syntax_highlighting[customize_highlight_javascript]').setAttribute('disabled', 'disabled');
                } else {
                    document.getElementById('wpuf-syntax_highlighting[highlight_mode_customize]').removeAttribute('disabled');
                    document.getElementById('syntax_highlighting[customize_highlight_style]').removeAttribute('disabled');
                    document.getElementById('syntax_highlighting[customize_highlight_javascript]').removeAttribute('disabled');
                }
                if (document.getElementById('wpuf-syntax_highlighting[highlight_mode_customize]').checked === true) {
                    document.getElementById('wpuf-syntax_highlighting[highlight_mode_auto]').removeAttribute('checked');
                    document.getElementById('wpuf-syntax_highlighting[highlight_mode_auto]').setAttribute('disabled', 'disabled');
                    document.getElementById('wpuf-syntax_highlighting[line_numbers]').setAttribute('disabled', 'disabled');
                    document.getElementById('syntax_highlighting[highlight_library_style]').setAttribute('disabled', 'disabled');
                    document.getElementById('syntax_highlighting[customize_my_style]').setAttribute('disabled', 'disabled');
                    document.getElementById('wpuf-syntax_highlighting[show_language]').setAttribute('disabled', 'disabled');
                    document.getElementById('wpuf-syntax_highlighting[copy_clipboard]').setAttribute('disabled', 'disabled');
                } else {
                    document.getElementById('wpuf-syntax_highlighting[highlight_mode_auto]').removeAttribute('disabled');
                    document.getElementById('wpuf-syntax_highlighting[line_numbers]').removeAttribute('disabled');
                    document.getElementById('syntax_highlighting[highlight_library_style]').removeAttribute('disabled');
                    document.getElementById('syntax_highlighting[customize_my_style]').removeAttribute('disabled');
                    document.getElementById('wpuf-syntax_highlighting[show_language]').removeAttribute('disabled');
                    document.getElementById('wpuf-syntax_highlighting[copy_clipboard]').removeAttribute('disabled');
                }
                document.getElementById('wpuf-syntax_highlighting[highlight_mode_auto]').addEventListener('click', function () {
                    if (document.getElementById('wpuf-syntax_highlighting[highlight_mode_auto]').checked === true) {
                        document.getElementById('wpuf-syntax_highlighting[highlight_mode_customize]').removeAttribute('checked');

                        document.getElementById('wpuf-syntax_highlighting[highlight_mode_customize]').setAttribute('disabled', 'disabled');
                        document.getElementById('syntax_highlighting[customize_highlight_style]').setAttribute('disabled', 'disabled');
                        document.getElementById('syntax_highlighting[customize_highlight_javascript]').setAttribute('disabled', 'disabled');
                    } else {
                        document.getElementById('wpuf-syntax_highlighting[highlight_mode_customize]').removeAttribute('disabled');
                        document.getElementById('syntax_highlighting[customize_highlight_style]').removeAttribute('disabled');
                        document.getElementById('syntax_highlighting[customize_highlight_javascript]').removeAttribute('disabled');
                    }
                });
                document.getElementById('wpuf-syntax_highlighting[highlight_mode_customize]').addEventListener('click', function () {
                    if (document.getElementById('wpuf-syntax_highlighting[highlight_mode_customize]').checked === true) {
                        document.getElementById('wpuf-syntax_highlighting[highlight_mode_auto]').removeAttribute('checked');
                        document.getElementById('wpuf-syntax_highlighting[highlight_mode_auto]').setAttribute('disabled', 'disabled');
                        document.getElementById('wpuf-syntax_highlighting[line_numbers]').setAttribute('disabled', 'disabled');
                        document.getElementById('syntax_highlighting[highlight_library_style]').setAttribute('disabled', 'disabled');
                        document.getElementById('syntax_highlighting[customize_my_style]').setAttribute('disabled', 'disabled');
                        document.getElementById('wpuf-syntax_highlighting[show_language]').setAttribute('disabled', 'disabled');
                        document.getElementById('wpuf-syntax_highlighting[copy_clipboard]').setAttribute('disabled', 'disabled');
                    } else {
                        document.getElementById('wpuf-syntax_highlighting[highlight_mode_auto]').removeAttribute('disabled');
                        document.getElementById('wpuf-syntax_highlighting[line_numbers]').removeAttribute('disabled');
                        document.getElementById('syntax_highlighting[highlight_library_style]').removeAttribute('disabled');
                        document.getElementById('syntax_highlighting[customize_my_style]').removeAttribute('disabled');
                        document.getElementById('wpuf-syntax_highlighting[show_language]').removeAttribute('disabled');
                        document.getElementById('wpuf-syntax_highlighting[copy_clipboard]').removeAttribute('disabled');
                    }

                });

                //插入信息
                $('#jquery').text(jQuery.fn.jquery);
                //切换显示信息
                $('#debugger').click(function () {
                    $('.debugger-wrap').fadeToggle();
                    $('#donate').fadeToggle();
                });
                //判断非调试界面则隐藏
                $('a[href!="#editor_advanced"].nav-tab').click(function () {
                    $('.debugger-wrap').fadeOut();
                    $('#donate').fadeIn();
                });
            })(jQuery);
        </script>
		<?php
	}

}