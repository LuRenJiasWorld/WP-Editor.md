<?php

namespace EditormdFrontStyle;

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
     * Controller constructor 初始化类并设置其属性
     *
     * @param $plugin_name
     * @param $version
     * @param $ioption
     */
    public function __construct() {
        $this->plugin_name      = "WP Editor.md";
        $this->text_domain      = "editormd";
        $this->version          = WP_EDITORMD_VER;
        $this->front_static_url = Config::get_option("editor_addres", "editor_style");

        add_action("wp_enqueue_scripts", array($this, "enqueue_front_scripts"));
    }

    /**
     * 注册脚本文件
     */
    public function enqueue_front_scripts() {
        //兼容模式 - jQuery
        if (Config::get_option("jquery_compatible", "editor_advanced") !== "off") {
            wp_enqueue_script("jquery", null, null, array(), false);
            $jQueryName = "jquery";
        } else {
            wp_deregister_script("jquery");
            wp_enqueue_script("jQuery-CDN", $this->front_static_url . "/assets/jQuery/jquery.min.js", array(), "1.12.4", true);
            $jQueryName = "jQuery-CDN";
        }

        wp_enqueue_script("Front_Style", $this->front_static_url . "/assets/FrontStyle/frontstyle.min.js", array($jQueryName), $this->version, true);

        wp_localize_script("Front_Style", "FrontStyle", array(
            "openLinkInNewTab"  =>  Config::get_option("open_in_new_tab", "editor_basics")        // 在新标签页打开链接
        ));
    }
}
