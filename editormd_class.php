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
		if ( isset( $wp_settings_fields['writing']['default'][ WP_Editormd_Markdown::POST_OPTION ] ) ) {
			unset( $wp_settings_fields['writing']['default'][ WP_Editormd_Markdown::POST_OPTION ] );
		}
	}

	// 载入插件语言
	function editormd_init_languages() {
		load_plugin_textdomain( 'editormd', false, dirname( plugin_basename( __FILE__ ) ) . '/Languages/' );
	}

	// 提取jetpack模块-->载入语言
	function editormd_jetpack_markdown_load_textdomain() {
		load_plugin_textdomain( 'jetpack', false, dirname( plugin_basename( __FILE__ ) ) . '/Jetpack/languages/' );
	}

	// 载入插件设置

	/**
	 * @param $actions
	 *
	 * @return array
	 */
	function jetpack_markdown_settings_link( $actions ) {
		return array_merge(
			array(
				'<a href="' . 'https://' . 'github.com/JaxsonWang/WP-Editor.MD/blob/master/Document/use-zh_CN.md" target="_blank" rel="nofollow">' . __( 'Docs', 'editormd' ) . '</a>',
				'<a href="' . 'https://' . 'github.com/JaxsonWang/WP-Editor.MD" target="_blank" rel="nofollow">' . __( 'Repo', 'editormd' ) . '</a>',
				'<a href="' . admin_url( 'options-general.php?page=wpeditormd&tab=basic' ) . '">' . __( 'Settings', 'jetpack' ) . '</a>',
			),
			$actions
		);
	}

	//加载编辑器相关配置
	public function post_load_editormd() {
		$emoji_img = paf( 'emoji_library' ) . '/images/basic/';
		$katex     = paf( 'katex_library' ) . '/katex.min';
		?>
        <script type="text/javascript" defer="defer" charset="UTF-8">
            jQuery(document).ready(function ($) {
                // 初始化編輯器
                var EditorMD;
                $(function () {
                    EditorMD = editormd("wp-content-editor-container", {
                        width: "100%", //编辑器宽度
                        height: 640,    //编辑器高度
                        syncScrolling: <?php paf( 'sync_scrolling' ) == 1 ? print( "true" ) : print( "false" ); ?>,   //即是否开启同步滚动预览
                        watch: <?php paf( 'live_preview' ) == 1 ? print( "true" ) : print( "false" ); ?>,   //即是否开启实时预览
                        htmlDecode: <?php paf( 'html_decode' ) == 1 ? print( "true" ) : print( "false" ); ?>, //HTML标签解析
                        toolbarAutoFixed: true,   //工具栏是否自动固定
                        tocm: false,
                        tocContainer: <?php paf( 'support_toc' ) == 1 ? print( "''" ) : print( "false" ); ?>, //TOC
                        tocDropdown: false,
                        theme: "<?php echo paf( 'theme_style' ); ?>", //编辑器主题
                        previewTheme: "<?php echo paf( 'theme_style' ); ?>", //编辑器主题
                        editorTheme: "<?php echo paf( 'code_style' ); ?>", //编辑器主题
                        emoji: <?php paf( 'support_emoji' ) == 1 ? print( "true" ) : print( "false" ); ?>, //Emoji表情
                        tex: <?php paf( 'support_katex' ) == 1 ? print( "true" ) : print( "false" ) ?>, //LaTeX公式
                        atLink: false,//Github @Link
                        flowChart: <?php paf( 'support_flowchart' ) == 1 ? print( "true" ) : print( "false" ) ?>, //FlowChart流程图
                        sequenceDiagram: <?php paf( 'support_sequence' ) == 1 ? print( "true" ) : print( "false" ) ?>,//SequenceDiagram时序图
                        taskList: <?php paf( 'task_list' ) == 1 ? print( "true" ) : print( "false" ) ?>,//task lists
                        path: "<?php echo WP_EDITORMD_PLUGIN_URL ?>/Editor.md/lib/", //资源路径
                        placeholder: "<?php echo __( "Enjoy Markdown! coding now...", "editormd" ) ?>",
                        toolbarIcons: function () {
                            // Or return editormd.toolbarModes[name]; // full, simple, mini
                            // Using "||" set icons align right.
                            return [
                                "undo", "redo", "|",
                                "bold", "del", "italic", "quote", "ucwords", "uppercase", "lowercase", "|",
                                "h1", "h2", "h3", "h4", "h5", "h6", "|",
                                "list-ul", "list-ol", "hr", "|",
                                "link", "reference-link", "image", "code", "preformatted-text", "code-block", "table", "datetime", "html-entities", "more", "pagebreak", <?php paf( 'support_emoji' ) == 1 ? print( "\"emoji\"," ) : print( "" ); ?> "toc", "|",
                                "goto-line", "watch", "preview", "fullscreen", "clear", "search", "|",
                                "help", "info"
                            ];
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
                        },
                        //自定义工具栏
                        toolbarIconsClass: {
                            toc: "fa-list-alt",  // 指定一个FontAawsome的图标类
                            more:"fa-ellipsis-h"
                        },
                        // 自定义工具栏按钮的事件处理
                        toolbarHandlers: {
                            /**
                             * @param {Object}      cm         CodeMirror对象
                             * @param {Object}      icon       图标按钮jQuery元素对象
                             * @param {Object}      cursor     CodeMirror的光标对象，可获取光标所在行和位置
                             * @param {String}      selection  编辑器选中的文本
                             */
                            toc: function (cm, icon, cursor, selection) {
                                cm.replaceSelection("[toc]");
                            },
                            more: function (cm, icon, cursor, selection) {
                                cm.replaceSelection("\r\n<!--more-->\r\n");
                            }
                        },
                        lang: {
                            toolbar: {
                                toc: "<?php echo __( "The Table Of Contents", "editormd" ) ?>",
                                more:"<?php echo __( "More" )?>"
                            }
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
                    var dom =  window.document.getElementById("htmlDom").childNodes[0];
                    var markdownSrc;
                    switch ( dom.localName ) {
                        case "a":
                            if ( dom.childNodes[0].localName === "img" ) {
                                markdownSrc = '[![]('+ dom.childNodes[0].src +')]('+ dom.href +')';
                            } else {
                                markdownSrc = '[' + dom.innerText + '](' + dom.href + ')';
                            }
                            break;
                        case "img":
                            var htmlSrc = window.document.getElementsByClassName("alignnone")[0].src;
                            var htmlAlt = window.document.getElementsByClassName("alignnone")[0].alt;
                            markdownSrc = '![' + htmlAlt + '](' + htmlSrc + ')';
                            break;
                        default:
                            markdownSrc = window.document.getElementById("htmlDom").innerText;
                    }
                    original_wp_media_editor_insert(markdownSrc);
                    EditorMD.insertValue(markdownSrc);
                    //移除dom
                    document.getElementById("htmlDom").remove();
                };
				<?php
				/*Emoji配置脚本*/
				if ( paf( 'support_emoji' ) == 1 ) {
					echo "
                //Emoji表情自定义服务器地址
                editormd.emoji = {
                    path: \"$emoji_img\",
                    ext: \".png\"
                };";
				}
				/*LaTeX公式配置脚本*/
				if ( paf( 'support_katex' ) == 1 ) {
					echo "
				//KaTeX科学公式加载库地址
                editormd.katexURL = {
                    css : \"$katex\",
                    js  : \"$katex\"
                };";
				}
				/*图像粘贴配置脚本*/
				if ( paf( 'imagepaste' ) == 1 ) {
					echo "
                    //监听图像粘贴事件
                    $(\"#wp-content-editor-container\").on('paste', function (event) {
                        event = event.originalEvent;
                        var cbd = window.clipboardData || event.clipboardData; //兼容ie||chrome
                        var ua = window.navigator.userAgent;
                        if (!(event.clipboardData && event.clipboardData.items)) {
                            return;
                        }
                        if (cbd.items && cbd.items.length === 2 && cbd.items[0].kind === \"string\" && cbd.items[1].kind === \"file\" &&
                            cbd.types && cbd.types.length === 2 && cbd.types[0] === \"text/plain\" && cbd.types[1] === \"Files\" &&
                            ua.match(/Macintosh/i) && Number(ua.match(/Chrome\/(\d{2})/i)[1]) < 49) {
                            return;
                        }
                        var itemLength = cbd.items.length;
                        if (itemLength === 0) {
                            return;
                        }
                        if (itemLength === 1 && cbd.items[0].kind === 'string') {
                            return;
                        }
                        if ((itemLength === 1 && cbd.items[0].kind === 'file')) {
                            var item = cbd.items[0];
                            var blob = item.getAsFile();
                            if (blob.size === 0) {
                                return;
                            }
                            //封装FileReader对象
                            function readBlobAsDataURL(blob, callback) {
                                var reader = new FileReader();
                                reader.onload = function (e) {
                                    callback(e.target.result);
                                };
                                reader.readAsDataURL(blob);
                            }
                            //传参
                            readBlobAsDataURL(blob, function (dataurl) {
                                var uploadingText = '![图片上传中...]';
                                var uploadFailText = '![图片上传失败]';
                                var data = {
                                    action: \"imagepaste_action\",
                                    dataurl: dataurl
                                };
                                EditorMD.insertValue(uploadingText);
                                $.ajax({
                                    url: ajaxurl,
                                    type: \"post\",
                                    data: data,
                                    success: function (request) {
                                        var obj = eval(\"(\" + request + \")\");
                                        if (obj.error) {
                                            EditorMD.setValue(EditorMD.getValue().replace(uploadingText, uploadFailText));
                                        } else {
                                            EditorMD.setValue(EditorMD.getValue().replace(uploadingText, '![](' + obj.url + ')'));
                                        }
                                    }
                                });
                            });
                        }
                    });
                    if (localStorage.getItem(\"wp_editormd\") !== 'true') {
                        alert(\"图像功能暂未完善，请慎重使用！\");
                        localStorage.setItem(\"wp_editormd\",\"true\");
                    };
                    <!--End-->
                    ";
				}
				?>
            });
        </script>
		<?php
	}

	//载入JavaScript脚本
	public function add_admin_js() {
		wp_deregister_script( 'media-upload' );//禁止加载多媒体脚本(减少对编辑器的干扰);
		wp_enqueue_script( 'jqueryjs', paf( 'jquery_library' ) . '/jquery.min.js', array(), WP_EDITORMD_PLUGIN_VERSION, true );
		wp_enqueue_script( 'editormd_js', WP_EDITORMD_PLUGIN_URL . '/Editor.md/js/editormd.min.js', array(), WP_EDITORMD_PLUGIN_VERSION, true );

		//载入国际化语言资源文件
		$lang = get_bloginfo( 'language' );
		switch ( $lang ) {
			case 'zh-TW':
				wp_enqueue_script( 'lang_tw', WP_EDITORMD_PLUGIN_URL . '/Editor.md/lib/languages/zh-tw.js', array(), WP_EDITORMD_PLUGIN_VERSION, true );//载入台湾语言资源库
				break;
			case 'zh-HK':
				wp_enqueue_script( 'lang_hk', WP_EDITORMD_PLUGIN_URL . '/Editor.md/lib/languages/zh-hk.js', array(), WP_EDITORMD_PLUGIN_VERSION, true );//载入港澳语言资源库
				break;
			case 'zh-CN':
				break;
			case 'en-US':
				wp_enqueue_script( 'lang_us', WP_EDITORMD_PLUGIN_URL . '/Editor.md/lib/languages/en.js', array(), WP_EDITORMD_PLUGIN_VERSION, true );//载入美国英语语言资源库
				break;
			default:
				wp_enqueue_script( 'lang_us', WP_EDITORMD_PLUGIN_URL . '/Editor.md/lib/languages/en.js', array(), WP_EDITORMD_PLUGIN_VERSION, true );//默认载入美国英语语言资源库
				break;
		}
	}

	//载入Style样式文件
	public function add_admin_style() {
		wp_deregister_style( 'media-upload' );
		wp_enqueue_style( 'editormd_css', WP_EDITORMD_PLUGIN_URL . '/Editor.md/css/editormd.min.css', array(), WP_EDITORMD_PLUGIN_VERSION, 'all' );
	}

	public function add_admin_head() {
		?>
        <style type="text/css" rel="stylesheet">
            .editormd_wrap input#submit{border:none}
            .markdown-body img.emoji{height:24px!important;width:24px!important}
            .markdown-body h2{font-size:1.75em!important;line-height:1.225!important;padding:0 0 .3em 0!important}
            .markdown-body.editormd-preview-container ul{list-style:initial}
            .markdown-body.editormd-preview-container ol{margin-left:0!important}
            .wrap a:active,.wrap a:hover,.wrap a:link,.wrap a:visited{text-decoration:none}
        </style>
		<?php
	}

	public function customize_prism() {
		wp_enqueue_style( 'prismCSS', paf('customize_highlight_style') . '', array(), WP_EDITORMD_PLUGIN_VERSION, 'all' );
		wp_enqueue_script( 'prismJS', paf('customize_highlight_javascript') . '', array(), WP_EDITORMD_PLUGIN_VERSION, 'true'  );
	}

	public function latex_enqueue_scripts() {
		wp_enqueue_style( 'katex_css', paf( 'katex_library' ) . '/katex.min.css', array(), WP_EDITORMD_PLUGIN_VERSION, 'all' );
		wp_enqueue_script( 'katex_js', paf( 'katex_library' ) . '/katex.min.js', array(), WP_EDITORMD_PLUGIN_VERSION, false );
	}

	public function flowchart_enqueue_scripts() {
		wp_enqueue_script( 'jqueryjs', paf( 'jquery_library' ) . '/jquery.min.js', array(), WP_EDITORMD_PLUGIN_VERSION, true );
		wp_enqueue_script( 'raphaeljs', paf( 'raphael_library' ) . '/raphael.min.js', array(), WP_EDITORMD_PLUGIN_VERSION, true );
		wp_enqueue_script( 'flowchartjs', paf( 'flowchart_library' ) . '/flowchart.min.js', array(), WP_EDITORMD_PLUGIN_VERSION, true );
		wp_enqueue_script( 'jqueryflowjs', paf( 'flowchart_config' ) . '/jquery.flowchart.min.js', array(), WP_EDITORMD_PLUGIN_VERSION, true );
	}

	public function sequence_enqueue_scripts() {
		wp_enqueue_script( 'jqueryjs', paf( 'jquery_library' ) . '/jquery.min.js', array(), WP_EDITORMD_PLUGIN_VERSION, true );
		wp_enqueue_script( 'underscore_js', paf( 'underscore_library' ) . '/underscore.min.js', array(), WP_EDITORMD_PLUGIN_VERSION, true );
		wp_enqueue_script( 'raphaeljs', paf( 'raphael_library' ) . '/raphael.min.js', array(), WP_EDITORMD_PLUGIN_VERSION, true );
		wp_enqueue_script( 'sequence_js', paf( 'sequence_library' ) . '/sequence-diagram-min.js', array(), WP_EDITORMD_PLUGIN_VERSION, true );
	}

	//前端Emoji表情
	public function emoji_enqueue_scripts() {
		wp_enqueue_style( 'emojify_css', paf( 'emoji_library' ) . '/css/basic/emojify.min.css', array(), WP_EDITORMD_PLUGIN_VERSION, 'all' );
		wp_enqueue_script( 'emojify_js', paf( 'emoji_library' ) . '/js/emojify.min.js', array(), WP_EDITORMD_PLUGIN_VERSION, true );
	}

	public function emoji_enqueue_footer_js() {
		?>
        <script type="text/javascript" charset="UTF-8">
            window.onload = function () {
                emojify.setConfig({
                    img_dir: "<?php echo paf( 'emoji_library' ) . '/images/basic' ?>",//前端emoji资源地址
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

	public function mobile_code_javascript() {
	    ?>
        <script type="text/javascript" charset="UTF-8" defer="defer">
            window.onload = function () {
                if(navigator.userAgent.match(/(iPhone|iPod|Android|ios)/i)){
                    $("i.fa-eye-slash").attr("class","fa fa-eye");
                    $(".editormd-preview-theme-default")[0].style.display = "none";
                    $(".CodeMirror.cm-s-default.CodeMirror-wrap")[0].style.width = "100%";
                    $(".CodeMirror.cm-s-default.CodeMirror-wrap")[0].style.borderRight = "none";
                }
                //TODO 添加兼容
                // (function() {
                //     var hm = document.createElement("script");
                //     hm.src = "http://localhost/wordpress/wp-content/plugins/WP-Editor.MD/jQuery/jquery.min.js?ver=3.5";
                //     var s = document.getElementsByTagName("head")[0];
                //     s.parentNode.insertBefore(hm, s);
                // })();
            }
        </script>
        <?php
    }
}

$editormd = new editormd();