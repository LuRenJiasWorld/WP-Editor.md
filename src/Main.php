<?php

namespace Editormd;

use EditormdAdmin\Controller as ControllerAdmin;
use EditormdFront\Controller as ControllerFront;
use EditormdApp\WPComMarkdown;
use EditormdApp\PrismJSAuto;
use EditormdApp\PrismJSCustomize;
use EditormdApp\KaTeX;
use EditormdApp\Emoji;
use EditormdApp\Mermaid;
use EditormdApp\TaskList;
use EditormdApp\ImagePaste;
use EditormdApp\MindMap;
use EditormdUtils\Guide;
use EditormdUtils\Internationalization;
use EditormdUtils\Loader;
use EditormdUtils\PluginMeta;
use EditormdUtils\Settings;

/**
 * 核心插件类
 *
 * @package Editormd
 */
class Main {

    /**
     * 注册和挂载钩子
     *
     * @since    1.0.0
     * @access   protected
     * @var      Loader $loader Maintains and registers all hooks for the plugin.
     */
    protected $loader;

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

        $this->plugin_name = 'WP Editor.md';
        $this->text_domain = 'editormd';
        $this->version = WP_EDITORMD_VER;
        $this->loader = new Loader();

        $this->run_core();

        $this->set_locale();
        $this->define_admin_hooks();
        $this->define_public_hooks();
    }

    /**
     * 国际化
     *
     * 使用 Internationalization 类来设置域并使用WordPress注册钩子
     *
     * @since    1.0.0
     * @access   private
     */
    private function set_locale() {

        $plugin_i18n = new Internationalization();
        $plugin_i18n->set_domain($this->text_domain);

        $this->loader->add_action('plugins_loaded', $plugin_i18n, 'load_plugin_textdomain');

    }

    /**
     * 注册该区域相关钩子功能 - 文章和页面
     *
     * @since    1.0.0
     * @access   private
     */
    private function define_admin_hooks() {

        $plugin_admin = new ControllerAdmin($this->get_plugin_name(), $this->get_version(), $this->get_text_domain());

        $this->loader->add_action('edit_page_form', $plugin_admin, 'enqueue_styles');
        $this->loader->add_action('edit_page_form', $plugin_admin, 'enqueue_scripts');
        $this->loader->add_action('edit_form_advanced', $plugin_admin, 'enqueue_styles');
        $this->loader->add_action('edit_form_advanced', $plugin_admin, 'enqueue_scripts');

	    $this->loader->add_action('load-edit-comments.php', $plugin_admin, 'enqueue_styles');
	    $this->loader->add_action('load-edit-comments.php', $plugin_admin, 'enqueue_scripts');
    }

    /**
     * 注册该区域相关钩子功能 - 前端
     *
     * @since    1.0.0
     * @access   private
     */
    private function define_public_hooks() {

        $plugin_public = new ControllerFront($this->get_plugin_name(), $this->get_version(), $this->get_text_domain());

        $this->loader->add_action('wp_enqueue_scripts', $plugin_public, 'enqueue_front_styles');
        $this->loader->add_action('wp_enqueue_scripts', $plugin_public, 'enqueue_front_scripts');
    }

    /**
     * 加载程序执行所有钩子
     *
     * @since    1.0.0
     */
    public function run() {
        $this->loader->run();
    }

    /**
     * 实现方法
     *
     * @return void
     */
    public function run_core() {
        // 实现Markdown类
        new WPComMarkdown($this->get_text_domain());
        // 实现设置类
        new Settings($this->get_plugin_name(), $this->get_version(), $this->get_text_domain());
        // 实现插件meta信息
        new PluginMeta($this->get_text_domain());
        // 实现欢迎页面提醒
        new Guide($this->get_text_domain());
        // 根据选项开启相关选项
        $this->get_option('task_list', 'editor_basics') == 'on' ? new TaskList() : null;
        $this->get_option('imagepaste', 'editor_basics') == 'on' ? new ImagePaste() : null;
        $this->get_option('support_katex', 'editor_katex') == 'on' ? new KaTeX() : null;
        $this->get_option('support_mermaid', 'editor_mermaid') == 'on' ? new Mermaid() : null;
        $this->get_option('support_mindmap', 'editor_mindmap') == 'on' ? new MindMap() : null;
        $this->get_option('support_emoji', 'editor_emoji') == 'on' ? new Emoji() : null;
        $this->get_option('highlight_mode_auto', 'syntax_highlighting') == 'on' ? new PrismJSAuto() : null;
        $this->get_option('highlight_mode_customize', 'syntax_highlighting') == 'on' ? new PrismJSCustomize() : null;
    }

    /**
     * 获取插件名字作为唯一标识符
     *
     * @since     1.0.0
     * @return    string    The name of the plugin.
     */
    public function get_plugin_name() {
        return $this->plugin_name;
    }


    /**
     * 对使用插件钩子的类的引用
     *
     * @since     1.0.0
     * @return    Loader    Orchestrates the hooks of the plugin.
     */
    public function get_loader() {
        return $this->loader;
    }

    /**
     * 检索插件的版本号
     *
     * @since     1.0.0
     * @return    string    The version number of the plugin.
     */
    public function get_version() {
        return $this->version;
    }

    /**
     * 检索插件的名称
     *
     * @since     1.0.0
     * @return    string    The version number of the plugin.
     */
    public function get_text_domain() {
        return $this->text_domain;
    }

    /**
     * 获取字段值
     *
     * @param string $option  字段名称
     * @param string $section 字段名称分组
     * @param string $default 没搜索到返回空
     *
     * @return mixed
     */
    public function get_option($option, $section, $default = '') {

        $options = get_option($section);

        if (isset($options[$option])) {
            return $options[$option];
        }

        return $default;
    }
}
