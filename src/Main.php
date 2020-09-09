<?php

namespace Editormd;

use EditormdAdmin\Controller as ControllerAdmin;
use EditormdFront\Controller as ControllerFront;
use EditormdFrontStyle\Controller as ControllerFrontStyle;
use EditormdApp\WPComMarkdown;
use EditormdApp\PrismJSAuto;
use EditormdApp\KaTeX;
use EditormdApp\Emoji;
use EditormdApp\Mermaid;
use EditormdApp\TaskList;
use EditormdApp\ImagePaste;
use EditormdApp\MindMap;
use EditormdPages\Pages;
use EditormdUtils\Guide;
use EditormdUtils\Internationalization;
use EditormdUtils\PluginMeta;
use EditormdUtils\Settings;
use EditormdUtils\Config;

/**
 * 核心插件类
 *
 * @package Editormd
 */
class Main {

    /**
     * 唯一标识符
     *
     * @since    1.0.0
     * @access   protected
     * @var      string $plugin_name The string used to uniquely identify this plugin.
     */
    protected $plugin_name;

    /**
     * 翻译域
     *
     * @since    1.0.0
     * @access   protected
     * @var      string $text_domain
     */
    protected $text_domain;

    /**
     * 插件版本
     *
     * @since    1.0.0
     * @access   protected
     * @var      string $version The current version of the plugin.
     */
    protected $version;

    /**
     * 定义插件核心功能
     *
     * @since    1.0.0
     */
    public function __construct() {
        $this->plugin_name = "WP Editor.md";
        $this->text_domain = "editormd";
        $this->version = WP_EDITORMD_VER;
        $this->init_cookie();
        $this->run_core();
    }

    /**
     * 实现方法
     *
     * @return void
     */
    public function run_core() {
        // 实现后台编辑器加载
        new ControllerAdmin();
        // 实现Markdown类
        new WPComMarkdown($this->text_domain);
        // 实现设置类
        new Settings($this->plugin_name, $this->version, $this->text_domain);
        // 实现国际化
        new Internationalization();
        // 实现插件meta信息
        new PluginMeta($this->text_domain);
        // 实现欢迎页面提醒
        new Guide($this->text_domain);
        // 实现页面功能
        new Pages($this->text_domain);

        // 根据选项开启相关选项
        Config::get_option("task_list", "editor_basics")                 == "on"     ? new TaskList()          : null;
        Config::get_option("imagepaste", "editor_basics")                == "on"     ? new ImagePaste()        : null;
        Config::get_option("support_latex", "editor_latex")              == "katex"  ? new KaTeX()             : null;
        Config::get_option("support_mermaid", "editor_mermaid")          == "on"     ? new Mermaid()           : null;
        Config::get_option("support_mindmap", "editor_mindmap")          == "on"     ? new MindMap()           : null;
        Config::get_option("support_emoji", "editor_emoji")              == "on"     ? new Emoji()             : null;
        Config::get_option("highlight_mode_auto", "syntax_highlighting") == "on"     ? new PrismJSAuto()       : null;
        Config::get_option("support_front", "editor_basics")             == "on" 
        || Config::get_option("support_other_text", "editor_basics")    !== ""       ? new ControllerFront()   : null;
        Config::get_option("open_in_new_tab", "editor_basics")          !== "off"    ? new ControllerFrontStyle() : null;
    }

    /**
     * 初始化Cookie
     * 
     * @return void
     */
    public function init_cookie() {
        // 语言配置
        $language = get_bloginfo("language");
        if (!isset($_COOKIE["wp-editormd-lang"]) || $_COOKIE["wp-editormd-lang"] !== $language) {
            setcookie("wp-editormd-lang", $language, 0, "/");
        }
    }
}
