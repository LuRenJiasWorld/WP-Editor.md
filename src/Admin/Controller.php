<?php

namespace Admin;

use App\WPComMarkdown;

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
	 * 筛选markdown post 类型
	 * @return string
	 */
	public function get_post_type() {
		if ( ! function_exists( 'get_current_screen' ) ) {
			return null;
		}

		return get_current_screen()->post_type;
	}

	/**
	 * Controller constructor 初始化类并设置其属性
	 *
	 * @param $plugin_name
	 * @param $version
	 * @param $ioption
	 */
	public function __construct( $plugin_name, $version, $text_domain ) {

		$this->plugin_name = $plugin_name;
		$this->text_domain = $text_domain;
		$this->version     = $version;

		add_filter( 'quicktags_settings', array( $this, 'quicktags_settings' ), 'content' );

		add_action( 'admin_init', array( $this, 'editormd_markdown_posting_always_on' ), 11 );

		// 如果模块是激活状态保持文章/页面正常激活，评论Markdown是可选
		add_filter( 'pre_option_' . WPComMarkdown::POST_OPTION, '__return_true' );

	}

	/**
	 * 注册样式文件
	 */
	public function enqueue_styles() {
		//Style - Editor.md
		wp_enqueue_style( 'Editormd', WP_EDITORMD_URL . '/assets/Editormd/editormd.min.css', array(), '2.0.1', 'all' );
		//Style - Config
		wp_enqueue_style( 'Config', WP_EDITORMD_URL . '/assets/Config/editormd.min.css', array(), $this->version, 'all' );
	}

	/**
	 * 注册脚本文件
	 */
	public function enqueue_scripts() {

		if ( ! post_type_supports( $this->get_post_type(), WPComMarkdown::POST_TYPE_SUPPORT ) ) {
			return;
		}

		//JavaScript - Editormd
		wp_enqueue_script( 'Editormd', WP_EDITORMD_URL . '/assets/Editormd/editormd.min.js', array( 'jquery' ), '2.0.1', true );

		//JavaScript - Config
		wp_enqueue_script( 'Config', WP_EDITORMD_URL . '/assets/Config/editormd.min.js', array( 'Editormd' ), $this->version, true );

		//JavaScript - 载入国际化语言资源文件
		$lang = get_bloginfo( 'language' );
		switch ( $lang ) {
			case 'zh-TW':
				wp_enqueue_script( 'Editormd-lang-tw', WP_EDITORMD_URL . '/assets/Editormd/languages/zh-tw.js', array(), '2.0.1', true );//载入台湾语言资源库
				break;
			case 'zh-CN':
				break;
			case 'en-US':
				wp_enqueue_script( 'Editormd-lang-us', WP_EDITORMD_URL . '/assets/Editormd/languages/en.js', array(), '2.0.1', true );//载入美国英语语言资源库
				break;
			default:
				wp_enqueue_script( 'Editormd-lang-us', WP_EDITORMD_URL . '/assets/Editormd/languages/en.js', array(), '2.0.1', true );//默认载入美国英语语言资源库
		}


		if ( $this->get_option( 'highlight_library_style', 'syntax_highlighting' ) == 'customize' ) {
			$prismTheme = 'default';
		} else {
			$prismTheme = $this->get_option( 'highlight_library_style', 'syntax_highlighting' );
		}

		wp_localize_script( 'Config', 'Editormd', array(
			'editormdUrl'       => WP_EDITORMD_URL,
			'syncScrolling'     => $this->get_option( 'sync_scrolling', 'editor_basics' ), //编辑器同步
			'watch'             => $this->get_option( 'live_preview', 'editor_basics' ), //即是否开启实时预览
			'htmlDecode'        => $this->get_option( 'html_decode', 'editor_basics' ), //HTML标签解析
			'toc'               => $this->get_option( 'support_toc', 'editor_toc' ), //TOC
			'theme'             => $this->get_option( 'theme_style', 'editor_style' ), //编辑器总体主题
			'previewTheme'      => $this->get_option( 'theme_style', 'editor_style' ), //编辑器预览主题
			'editorTheme'       => $this->get_option( 'code_style', 'editor_style' ), //编辑器编辑主题
			'emoji'             => $this->get_option( 'support_emoji', 'editor_emoji' ), //emoji表情
			'tex'               => $this->get_option( 'support_katex', 'editor_katex' ), //科学公式
			'taskList'          => $this->get_option( 'task_list', 'editor_basics' ), //task lists
			'imagePaste'        => $this->get_option( 'imagepaste', 'editor_basics' ), //图像粘贴
			'staticFileCDN'     => $this->get_option( 'static_cdn', 'editor_basics' ), //静态资源CDN地址
			'prismTheme'        => $prismTheme, //语法高亮风格
			'prismLineNumbers'  => $this->get_option( 'line_numbers', 'syntax_highlighting' ), //行号显示
			'mindMap'           => $this->get_option( 'support_mindmap', 'editor_mindmap' ), //思维导图
			'mermaid'           => $this->get_option('support_mermaid','editor_mermaid'), // Mermaid
			'placeholderEditor' => __( 'Enjoy Markdown! Coding now...', $this->text_domain ),
			'imgUploading'      => __( 'Image Uploading...', $this->text_domain ),
			'imgUploadeFailed'  => __( 'Failed To Upload The Image!', $this->text_domain ),
		) );
	}


	/**
	 * 将 Jetpack Markdown写作模式始终设置为开
	 */
	public function editormd_markdown_posting_always_on() {
		if ( ! class_exists( 'WPComMarkdown' ) ) {
			return;
		}
		global $wp_settings_fields;
		if ( isset( $wp_settings_fields['writing']['default'][ WPComMarkdown::POST_OPTION ] ) ) {
			unset( $wp_settings_fields['writing']['default'][ WPComMarkdown::POST_OPTION ] );
		}
	}

	/**
	 * 快速标记按钮
	 *
	 * @param $qt_init
	 *
	 * @return mixed
	 */
	public function quicktags_settings( $qt_init ) {

		// 仅删除指定 post 类型上的按钮
		if ( ! post_type_supports( $this->get_post_type(), WPComMarkdown::POST_TYPE_SUPPORT ) ) {
			return $qt_init;
		}

		$qt_init['buttons'] = '';

		return $qt_init;
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
	public function get_option( $option, $section, $default = '' ) {

		$options = get_option( $section );

		if ( isset( $options[ $option ] ) ) {
			return $options[ $option ];
		}

		return $default;
	}

}
