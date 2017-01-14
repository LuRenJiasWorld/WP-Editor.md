<?php
/**
 * Plugin Name: WP Editor.md
 * Plugin URI: https://iiong.com/wordpress-plugins-wp-editormd.html
 * Description: 或许这是一个WordPress中最好，最完美的Markdown编辑器。
 * Version: 1.0
 * Author: 苏城一只猫
 * Author URI: https://iiong.com/
 * License: GPLv2 or later
 */

define('CAT_VERSION', '1.0');
define('CAT_URL', plugins_url('', __FILE__));
define('PLUGIN_VERSION', '2.0'); //插件版本
define('MINIMUM_WP_VERSION', '3.1'); //WordPress版本

// 调用事件
if (!function_exists('add_action')) {
    echo 'Hi there!  I"m just a plugin, not much I can do when called directly.';
    exit;
}

//引入jetpack解析库
if (!function_exists('jetpack_require_lib')) {
    include_once dirname(__FILE__) . '/jetpack/require-lib.php';
}

//引入jetpack保存库
if (!class_exists('WPCom_Markdown')) {
    include_once dirname(__FILE__) . '/jetpack/markdown/easy-markdown.php';
}

class WPEditorMD {
    private static $instance;

    private function __construct() {
        //激活/停用挂钩
        register_activation_hook(__FILE__, array($this, 'plugin_activation'));
        register_deactivation_hook(__FILE__, array($this, 'plugin_deactivation'));

        // 载入Markdown Editor
        add_action('admin_enqueue_scripts', array($this, 'enqueue_stuffs'));
        add_action('admin_footer', array($this, 'init_editor'));

        // 删除编辑器的快捷按钮标签
        add_filter('quicktags_settings', array($this, 'quicktags_settings'), $editorId = 'content');

        // 载入Jetpack Markdown核心模块
        $this->load_jetpack_markdown_module();
    }

    public static function getInstance() {
        if (!isset(self::$instance)) {
            $c = __CLASS__;
            self::$instance = new $c;
        }
        return self::$instance;
    }

    public function __clone() {
        trigger_error('Clone is not allowed.', E_USER_ERROR);
    }

    function enqueue_stuffs() {
        //只在需要有文章编辑器才能加载以下文件
        if (get_current_screen()->base !== 'post') {
            return;
        }
        wp_enqueue_script('jQuery.js', $this->plugin_url('./js/jquery.min.js'));
        wp_enqueue_script('EditorMD.js', $this->plugin_url('./js/editormd.min.js'));
        wp_enqueue_style('EditorMD.css', $this->plugin_url('./css/editormd.min.css'));
        wp_enqueue_style('Style.css', $this->plugin_url('./css/style.css'));
    }

    // 提取jetpack模块-->开启Markdown支持
    function load_jetpack_markdown_module() {
        // If the module is active, let's make this active for posting, period.
        // Comments will still be optional.
        add_filter('pre_option_' . WPCom_Markdown::POST_OPTION, '__return_true');
        add_action('admin_init', array($this, 'jetpack_markdown_posting_always_on'), 11);
        add_action('plugins_loaded', array($this, 'jetpack_markdown_load_textdomain'));
        add_filter('plugin_action_links_' . plugin_basename(__FILE__), array($this, 'jetpack_markdown_settings_link'));
    }

    // 提取jetpack模块
    function jetpack_markdown_posting_always_on() {
        global $wp_settings_fields;
        if (isset($wp_settings_fields['writing']['default'][WPCom_Markdown::POST_OPTION])) {
            unset($wp_settings_fields['writing']['default'][WPCom_Markdown::POST_OPTION]);
        }
    }

    // 提取jetpack模块-->载入语言
    function jetpack_markdown_load_textdomain() {
        load_plugin_textdomain('jetpack', false, dirname(plugin_basename(__FILE__)) . '/jetpack/languages/');
    }

    // 提取jetpack模块-->载入设置
    function jetpack_markdown_settings_link($actions) {
        return array_merge(
            array('settings' => sprintf('<a href="%s">%s</a>', 'options-discussion.php#' . WPCom_Markdown::COMMENT_OPTION, __('Settings', 'jetpack'))),
            $actions
        );
        return $actions;
    }

    function init_editor() {
        if (get_current_screen()->base !== 'post') {
            return;
        }

        echo '<script type="text/javascript">
            // 初始化編輯器
            var EditorMD;
            $(function() {
                EditorMD = editormd("wp-content-editor-container", {
                    width            : "100%",
                    height           : 640,
                    syncScrolling    : "single", //即是否开启同步滚动预览
                    htmlDecode       : true, //开启HTML解析
                    toolbarAutoFixed : true, //工具栏是否自动固定
                    path             : "../wp-content/plugins/WP-Editor.MD/lib/", //资源路径
                    toolbarIcons     : function() {
                        // Or return editormd.toolbarModes[name]; // full, simple, mini
                        // Using "||" set icons align right.
                        return [
                            "undo", "redo", "|", 
                            "bold", "del", "italic", "quote", "ucwords", "uppercase", "lowercase", "|", 
                            "h1", "h2", "h3", "h4", "h5", "h6", "|", 
                            "list-ul", "list-ol", "hr", "|",
                            "link", "reference-link", "image", "code", "preformatted-text", "code-block", "table", "datetime", "html-entities", "more", "pagebreak", "|",
                            "goto-line", "watch", "preview", "fullscreen", "clear", "search", "|",
                            "help", "info"
                        ];
                    }, //自定义标题栏
                    toolbarIconsClass: {
                        more: "fa-arrows-h" //指定一个FontAawsome的图标类
                    },
                    // 自定义工具栏按钮的事件处理
                    toolbarHandlers  : {
                    /**
                     * @param {Object}      cm         CodeMirror对象
                     * @param {Object}      icon       图标按钮jQuery元素对象
                     * @param {Object}      cursor     CodeMirror的光标对象，可获取光标所在行和位置
                     * @param {String}      selection  编辑器选中的文本
                      */
                      more: function (cm, icon, cursor, selection) {
                            cm.replaceSelection("<!--more-->");
                      }},
                      lang           : {
                            toolbar: {
                                more: "摘要分隔符"
                            }
                      },
                      onfullscreen : function() {
                            window.document.getElementById("wp-content-editor-container").style.position="fixed";
                      },//强制全屏
                      onfullscreenExit : function() {
                            window.document.getElementById("wp-content-editor-container").style.position="relative";
                      }//退出全屏返回原来的样式
                });
            });
            </script>';
    }

    function quicktags_settings($qtInit) {
        $qtInit['buttons'] = ' ';
        return $qtInit;
    }

    function plugin_url($path) {
        return plugins_url('WP-Editor.MD/' . $path);
    }

    function plugin_activation() {
        global $wpdb;
        $wpdb->query("UPDATE `" . $wpdb->prefix . "usermeta` SET `meta_value` = 'false' WHERE `meta_key` = 'rich_editing'");
    }

    function plugin_deactivation() {
        global $wpdb;
        $wpdb->query("UPDATE `" . $wpdb->prefix . "usermeta` SET `meta_value` = 'true' WHERE `meta_key` = 'rich_editing'");
    }

}

WPEditorMD::getInstance();