<?php

class editormd {
	//启用模式
	public function activate() {
		global $current_user;
		update_user_option( $current_user->ID, 'rich_editing', 'false', true );
	}

	//停用模式
	public function deactivate() {
		global $current_user;
		update_user_option( $current_user->ID, 'rich_editing', 'true', true );
	}

	// 提取jetpack模块
	function editormd_jetpack_markdown_posting_always_on() {
		global $wp_settings_fields;
		if ( isset( $wp_settings_fields['writing']['default'][ WPCom_Markdown::POST_OPTION ] ) ) {
			unset( $wp_settings_fields['writing']['default'][ WPCom_Markdown::POST_OPTION ] );
		}
	}

	function editormd_init_languages() {
		load_plugin_textdomain( 'editormd', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
	}

	// 提取jetpack模块-->载入语言
	function editormd_jetpack_markdown_load_textdomain() {
		load_plugin_textdomain( 'jetpack', false, dirname( plugin_basename( __FILE__ ) ) . '/jetpack/languages/' );
	}

	// 载入插件设置

	/**
	 * @param $actions
	 *
	 * @return array
	 */
	function jetpack_markdown_settings_link( $actions ) {
		return array_merge(
			array( 'settings' => sprintf( '<a href="%s">%s</a>', 'options-general.php?page=' . plugin_basename( __DIR__ . '/editormd_options.php' ), __( 'Settings', 'jetpack' ) ) ),
			$actions
		);
	}

	//加载编辑器相关配置
	public function load_editormd() {
		if ( get_current_screen()->base !== 'post' ) {
			return;
		}
		//获取数据库
		$options   = get_option( 'editormd_options' );
		$emoji_img = isset( $options['support_emoji_library'] ) && $options['support_emoji_library'] == '' ? WP_EDITORMD_PLUGIN_URL . '/emojify/images/basic/' : $options['support_emoji_library'] . '/images/basic/';
		?>
        <script type="text/javascript" defer="defer" charset="UTF-8">
            jQuery(document).ready(function ($) {
                //<![CDATA[
                // 初始化編輯器
                var EditorMD;
                $(function () {
                    EditorMD = editormd("wp-content-editor-container", {
                        width: "100%", //编辑器宽度
                        height: 640,    //编辑器高度
                        syncScrolling: true,   //即是否开启同步滚动预览
                        htmlDecode: <?php isset( $options['support_html_decode'] ) && $options['support_html_decode'] == 1 ? print( "\"script|on*\"" ) : print( "false" ); ?>, //HTML标签解析
                        toolbarAutoFixed: true,   //工具栏是否自动固定
                        tocm: false,
                        tocContainer: <?php isset( $options['support_toc'] ) && $options['support_toc'] == 1 ? print( "''" ) : print( "false" ); ?>, //TOC
                        tocDropdown: false,
                        theme: "<?php isset( $options['theme_dark'] ) && $options['theme_dark'] == 1 ? print( "dark" ) : print( "default" ); ?>", //编辑器主题
                        previewTheme: "<?php isset( $options['theme_dark'] ) && $options['theme_dark'] == 1 ? print( "dark" ) : print( "default" ); ?>", //编辑器主题
                        editorTheme: "<?php isset( $options['theme_dark'] ) && $options['theme_dark'] == 1 ? print( "pastel-on-dark" ) : print( "default" ); ?>", //编辑器主题
                        emoji: <?php isset( $options['support_emoji'] ) && $options['support_emoji'] == 1 ? print( "true" ) : print( "false" ); ?>, //Emoji表情
                        tex: <?php isset( $options['support_latex'] ) && $options['support_latex'] == 1 ? print( "true" ) : print( "false" ) ?>, //LaTeX公式
                        atLink: false,//Github @Link
                        path: "<?php echo WP_EDITORMD_PLUGIN_URL ?>/editormd/lib/", //资源路径
                        toolbarIcons: function () {
                            // Or return editormd.toolbarModes[name]; // full, simple, mini
                            // Using "||" set icons align right.
                            return [
                                "undo", "redo", "|",
                                "bold", "del", "italic", "quote", "ucwords", "uppercase", "lowercase", "|",
                                "h1", "h2", "h3", "h4", "h5", "h6", "|",
                                "list-ul", "list-ol", "hr", "|",
                                "link", "reference-link", "image", "code", "preformatted-text", "code-block", "table", "datetime", "html-entities", "more",<?php isset( $options['support_emoji'] ) && $options['support_emoji'] == 1 ? print( "\"emoji\"," ) : print( "" ); ?> "|",
                                "goto-line", "watch", "preview", "fullscreen", "clear", "search", "|",
                                "help", "info"
                            ];
                        }, //自定义标题栏
                        toolbarIconsClass: {
                            more: "fa-arrows-h" //指定一个FontAawsome的图标类
                        },
                        // 自定义工具栏按钮的事件处理
                        toolbarHandlers: {
                            /**
                             * @param {Object}      cm         CodeMirror对象
                             * @param {Object}      icon       图标按钮jQuery元素对象
                             * @param {Object}      cursor     CodeMirror的光标对象，可获取光标所在行和位置
                             * @param {String}      selection  编辑器选中的文本
                             */
                            more: function (cm, icon, cursor, selection) {
                                cm.replaceSelection("<!--more-->");
                            }
                        },
                        lang: {
                            toolbar: {
                                more: "摘要分隔符"
                            }
                        },
                        //强制全屏
                        onfullscreen: function () {
                            window.document.getElementById("wp-content-editor-container").style.position = "fixed";
                            window.document.getElementById("wp-content-editor-container").style.zIndex = "99999";
                        },
                        //退出全屏返回原来的样式
                        onfullscreenExit: function () {
                            window.document.getElementById("wp-content-editor-container").style.position = "relative";
                            window.document.getElementById("wp-content-editor-container").style.zIndex = "auto";
                        }
                    });
                });
                //隐藏原来编辑器工具栏
                document.getElementById("ed_toolbar").style.display = "none";
                //WP Media module支持
                var original_wp_media_editor_insert = wp.media.editor.insert;
                wp.media.editor.insert = function (html) {
                    //console.log(html);
                    //创建新的DOM
                    var htmlDom = document.createElement("div");
                    htmlDom.style.display = "none";
                    htmlDom.id = "htmlDom";
                    htmlDom.innerHTML = html;
                    document.body.appendChild(htmlDom);
                    //获取src属性
                    var htmlSrc = window.document.getElementsByClassName("alignnone")[0].src;
                    var htmlAlt = window.document.getElementsByClassName("alignnone")[0].alt;
                    //插入Markdown
                    var markdownSrc = '![' + htmlAlt + '](' + htmlSrc + ')';
                    original_wp_media_editor_insert(markdownSrc);
                    EditorMD.insertValue(markdownSrc);
                    //移除dom
                    document.getElementById("htmlDom").remove();
                };
                //Emoji表情自定义服务器地址
                editormd.emoji = {
                    path: "<?php echo $emoji_img ?>",
                    ext: ".png"
                };
            });
            //]]>
        </script>
		<?php
	}

	//保存设置数据
	public function user_personalopts_update() {
		global $current_user;
		update_user_option( $current_user->ID, 'rich_editing', 'false', true );
	}

	//载入JavaScript脚本
	public function add_admin_js() {
		//只在需要有文章编辑器才能加载以下文件
		if ( get_current_screen()->base !== 'post' ) {
			return;
		}
		wp_deregister_script( 'media-upload' );//禁止加载多媒体脚本(减少对编辑器的干扰);
		wp_enqueue_script( 'jquery_js', WP_EDITORMD_PLUGIN_URL . '/jquery/jquery.min.js', array(), WP_EDITORMD_PLUGIN_VERSION, true );
		wp_enqueue_script( 'editormd_js', WP_EDITORMD_PLUGIN_URL . '/editormd/js/editormd.min.js', array(), WP_EDITORMD_PLUGIN_VERSION, true );
		wp_enqueue_script( 'xssjs', WP_EDITORMD_PLUGIN_URL . '/xss/xss.min.js', array(), WP_EDITORMD_PLUGIN_VERSION, true );

		//载入国际化语言资源文件
		$lang = get_bloginfo( 'language' );
		switch ( $lang ) {
			case 'zh-TW':
				wp_enqueue_script( 'lang_tw', WP_EDITORMD_PLUGIN_URL . '/lib/languages/zh-tw.js', array(), WP_EDITORMD_PLUGIN_VERSION, true );//载入台湾语言资源库
				break;
			case 'zh-HK':
				wp_enqueue_script( 'lang_hk', WP_EDITORMD_PLUGIN_URL . '/lib/languages/zh-hk.js', array(), WP_EDITORMD_PLUGIN_VERSION, true );//载入港澳语言资源库
				break;
			case 'zh-CN':
				break;
			case 'en-US':
				wp_enqueue_script( 'lang_us', WP_EDITORMD_PLUGIN_URL . '/lib/languages/en.js', array(), WP_EDITORMD_PLUGIN_VERSION, true );//载入美国英语语言资源库
				break;
			default:
				wp_enqueue_script( 'lang_us', WP_EDITORMD_PLUGIN_URL . '/lib/languages/en.js', array(), WP_EDITORMD_PLUGIN_VERSION, true );//默认载入美国英语语言资源库
				break;
		}
	}

	//载入Style样式文件
	public function add_admin_style() {
		//只在需要有文章编辑器才能加载以下文件
		if ( get_current_screen()->base !== 'post' ) {
			return;
		}
		wp_deregister_style( 'media-upload' );
		wp_enqueue_style( 'editormd_css', WP_EDITORMD_PLUGIN_URL . '/editormd/css/editormd.min.css', array(), WP_EDITORMD_PLUGIN_VERSION, 'all' );
	}

	public function add_admin_head() {
		?>
        <style type="text/css" rel="stylesheet">
            .editormd_wrap input#submit {
                border: none;
            }

            .markdown-body img.emoji {
                height: 24px !important;
                width: 24px !important;
            }

            .markdown-body h2 {
                font-size: 1.75em !important;
                line-height: 1.225 !important;
                padding: 0 0 0.3em 0 !important;
            }

            .markdown-body.editormd-preview-container ul {
                list-style: initial;
            }

            .markdown-body.editormd-preview-container ol {
                margin-left: 0 !important;
            }
        </style>
		<?php
	}

	//前端Emoji表情
	public function emoji_enqueue_scripts() {
		//获取数据库
		$options     = get_option( 'editormd_options' );
		$emojify_css = isset( $options['support_emoji_library'] ) && $options['support_emoji_library'] == '' ? WP_EDITORMD_PLUGIN_URL . '/emojify/css/basic/emojify.min.css' : $options['support_emoji_library'] . '/css/basic/emojify.min.css';
		$emojify_js  = isset( $options['support_emoji_library'] ) && $options['support_emoji_library'] == '' ? WP_EDITORMD_PLUGIN_URL . '/emojify/js/emojify.min.js' : $options['support_emoji_library'] . '/js/emojify.min.js';
		wp_enqueue_style( 'emojify_css', $emojify_css, array(), WP_EDITORMD_PLUGIN_VERSION, 'all' );
		wp_enqueue_script( 'emojify_js', $emojify_js, array(), WP_EDITORMD_PLUGIN_VERSION, true );
	}

	public function emoji_enqueue_footer_js() {
		$options   = get_option( 'editormd_options' );
		$emoji_img = isset( $options['support_emoji_library'] ) && $options['support_emoji_library'] == '' ? WP_EDITORMD_PLUGIN_URL . '/emojify/images/basic' : $options['support_emoji_library'] . '/images/basic';
		?>
        <script type="text/javascript" defer="defer" charset="UTF-8">
            window.onload = function () {
                emojify.setConfig({
                    img_dir: "<?php echo $emoji_img ?>",//前端emoji资源地址
                    blacklist: {
                        'ids': [],
                        'classes': ['no-emojify'],
                        'elements': ['^script$', '^textarea$', '^pre$', '^code$']
                    }
                });
                emojify.run();
            }
        </script>
		<?php
	}
}

$editormd = new editormd();
