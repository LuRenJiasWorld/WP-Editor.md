<?php

namespace EditormdFrontStyle;

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
		$this->plugin_name      = 'WP Editor.md';
		$this->text_domain      = 'editormd';
		$this->version          = WP_EDITORMD_VER;
		$this->front_static_url = $this->get_option('editor_addres', 'editor_style');

		add_action('wp_enqueue_scripts', array($this, 'enqueue_front_scripts'));
	}

	/**
	 * 注册脚本文件
	 */
	public function enqueue_front_scripts() {
		wp_enqueue_script('Front_Style', $this->front_static_url . '/assets/FrontStyle/frontstyle.min.js', array('jQuery-CDN'), $this->version, true);

		wp_localize_script('Front_Style', 'FrontStyle', array(
			'openLinkInNewTab'			=>		$this->get_option('open_in_new_tab', 'editor_basics')		// 在新标签页打开链接
		));
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
