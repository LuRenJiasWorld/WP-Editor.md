<?php

namespace EditormdAdmin;

use EditormdApp\WPComMarkdown;
use EditormdApp\WPMarkdownParser;
use League\HTMLToMarkdown\HtmlConverter;

class Controller {

	const METAKEY = '_wpcom_is_markdown';

	const NONCE = '_wordpress_editormd';

	/**
	 * @var \League\HTMLToMarkdown\
	 */
	private $htmlConverter;

	/**
	 * @var WPMarkdownParser
	 */
	private $parsedown;

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
		$this->front_static_url = $this->get_option( 'editor_addres', 'editor_style' );

		$converter_options = array(
			'header_style' => 'atx'
		);

		$this->parsedown = new WPMarkdownParser();
		$this->htmlConverter = new HtmlConverter($converter_options);

		add_action( 'post_submitbox_misc_actions', array($this,'create_markdown_link') );
		add_action( 'save_post', array($this, 'save_markdown_meta'), 10, 2 );

		add_filter( 'wp_editor_settings', array($this,'parse_editor_settings') );

		add_action( 'load-edit-comments.php', array( $this, 'enqueue_styles' ) );
		add_action( 'load-edit-comments.php', array( $this, 'enqueue_scripts' ) );
	}

	/**
     * 注入插件所需要的逻辑业务代码
	 * @param $settings
	 *
	 * @return mixed
	 */
	public function parse_editor_settings( $settings ) {

		if ( $this->use_markdown_post() ) {

			// 将 Jetpack Markdown写作模式始终设置为开
			//add_action( 'admin_init', array( $this, 'editormd_markdown_posting_always_on' ), 11 );
			// 如果模块是激活状态保持文章/页面正常激活，评论Markdown是可选
			//add_filter( 'pre_option_' . WPComMarkdown::POST_OPTION, '__return_true' );

			add_action( 'edit_page_form', array( $this, 'enqueue_styles' ) );
			add_action( 'edit_page_form', array( $this, 'enqueue_scripts' ) );
			add_action( 'edit_form_advanced', array( $this, 'enqueue_styles' ) );
			add_action( 'edit_form_advanced', array( $this, 'enqueue_scripts' ) );

			$settings['tinymce'] = false;
			$settings['quicktags'] = false;
		}
		return $settings;
	}

	/**
	 * 使用markdown进行发布
	 * @param null $post
	 *
	 * @return bool
	 */
	public function use_markdown_post( $post = null ) {
		if ( ! $post ) {
			$post = $this->getPost();
		}
		$meta_value = null;
		if ( $post ) {
			$meta_value = get_post_meta( $post->ID, self::METAKEY, true );
		}
		if ( $post && absint( $meta_value ) === 1 ) {
			return true;
		} elseif ( $post && $meta_value === 0 ) {
			// If post meta is set to 0 (not false), disable Markdown
			return false;
		}
		/**
		 * 默认启用Markdown编辑器:
		 *
		 *    add_filter('editormd_autoenable', '__return_true');
		 */
		return apply_filters( 'editormd_autoenable', false );
	}

	/**
	 * 在文章/页面提交框中创建Markdown激活链接
	 *
	 * @see https://developer.wordpress.org/resource/dashicons/
	 *
	 * @param $post
	 */
	public function create_markdown_link( $post ) {
		$use_markdown = $this->use_markdown_post( $post );
		wp_nonce_field( $post->ID, self::NONCE );
		echo '<input type="hidden" value="' . (int) $use_markdown . '" name="' . self::METAKEY . '"  id="' . self::METAKEY . '" />';
		if ( $use_markdown ) {
			?>
			<div class="misc-pub-section">
				<span class="dashicons dashicons-edit"></span> WP Editor.md:
				<a href="javascript:{}"
				   onclick="document.getElementById('<?php echo self::METAKEY; ?>').value = 0; document.getElementById('post').submit(); return false;"><?php _e( 'Disable', $this->text_domain ); ?></a>
			</div>
			<?php
		} else {
			?>
			<div class="misc-pub-section">
				<span class="dashicons dashicons-edit"></span> WP Editor.md:
				<a href="javascript:{}"
				   onclick="document.getElementById('<?php echo self::METAKEY; ?>').value = 1; document.getElementById('post').submit(); return false;"><?php _e( 'Enable', $this->text_domain ); ?></a>
			</div>
			<?php
		}
	}

	/**
	 * 保存markdown文章元数据
	 *
	 * @param $post_id
	 * @param $post
	 */
	public function save_markdown_meta( $post_id, $post ) {

		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
			return;
		}
		if ( ! isset( $_POST[ self::NONCE ] ) || ! wp_verify_nonce( $_POST[ self::NONCE ], $post_id ) ) {
			return;
		}
		if ( ! current_user_can( 'edit_post', $post_id ) ) {
			return;
		}

		$use_markdown_old = get_post_meta( $post_id, self::METAKEY, true );
		$use_markdown = ! empty( $_POST[ self::METAKEY ] ) ? 1 : 0;
		if ( (string) $use_markdown_old !== (string) $use_markdown ) {
			static $recursion = false;
			if ( ! $recursion ) {
				$recursion = true;
				if ( $use_markdown ) {
				    //从原生编辑器切换到editor.md
					$content = wp_slash( $post->post_content );
					$content = $this->htmlConverter->convert( wpautop( $content ) ); // HTML To Markdown
				} else {
				    //从editor.md切换到原生编辑器
                    $content = wp_slash( $post->post_content );
					$content = $this->parsedown->transform( $content ); // Markdown To HTML
				}
				wp_update_post(array(
					'ID' => $post_id,
					'post_content' => $content
				));
				update_post_meta( $post_id, self::METAKEY, $use_markdown );
				$recursion = false;
			}
		}
	}

	/**
	 * 获取文章数据
	 * @return array|null|\WP_Post
	 */
	public function getPost() {
		$post = get_post();
		if ( ! $post ) {
			// Try to find using deprecated means
			global $id;
			$post = get_post( $id );
		}
		return $post;
	}

	/**
	 * 注册样式文件
	 */
	public function enqueue_styles() {
		//Style - Editor.md
		wp_enqueue_style( 'Editormd', $this->front_static_url . '/assets/Editormd/editormd.min.css', array(), '2.0.1', 'all' );
		//Style - Config
		wp_enqueue_style( 'Config', $this->front_static_url . '/assets/Config/editormd.min.css', array(), $this->version, 'all' );
	}

	/**
	 * 注册脚本文件
	 */
	public function enqueue_scripts() {
		//JavaScript - Editormd
		wp_enqueue_script( 'Editormd', $this->front_static_url . '/assets/Editormd/editormd.min.js', array( 'jquery' ), '2.0.1', true );

		//JavaScript - Config
		wp_enqueue_script( 'Config', $this->front_static_url . '/assets/Config/editormd.min.js', array( 'Editormd' ), $this->version, true );

		//JavaScript - 载入国际化语言资源文件
		$lang = get_bloginfo( 'language' );
		switch ( $lang ) {
			case 'zh-TW':
				wp_enqueue_script( 'Editormd-lang-tw', $this->front_static_url . '/assets/Editormd/languages/zh-tw.js', array(), '2.0.1', true );//载入台湾语言资源库
				break;
			case 'zh-CN':
				break;
			case 'en-US':
				wp_enqueue_script( 'Editormd-lang-us', $this->front_static_url . '/assets/Editormd/languages/en.js', array(), '2.0.1', true );//载入美国英语语言资源库
				break;
			default:
				wp_enqueue_script( 'Editormd-lang-us', $this->front_static_url . '/assets/Editormd/languages/en.js', array(), '2.0.1', true );//默认载入美国英语语言资源库
		}


		if ( $this->get_option( 'highlight_library_style', 'syntax_highlighting' ) == 'customize' ) {
			$prismTheme = 'default';
		} else {
			$prismTheme = $this->get_option( 'highlight_library_style', 'syntax_highlighting' );
		}

		wp_localize_script( 'Config', 'Editormd', array(
			'editormdUrl'       => $this->front_static_url,
			'syncScrolling'     => $this->get_option( 'sync_scrolling', 'editor_basics' ), //编辑器同步
			'livePreview'       => $this->get_option( 'live_preview', 'editor_basics' ), //即是否开启实时预览
			'htmlDecode'        => $this->get_option( 'html_decode', 'editor_basics' ), //HTML标签解析
			'toc'               => $this->get_option( 'support_toc', 'editor_toc' ), //TOC
			'theme'             => $this->get_option( 'theme_style', 'editor_style' ), //编辑器总体主题
			'previewTheme'      => $this->get_option( 'theme_style', 'editor_style' ), //编辑器预览主题
			'editorTheme'       => $this->get_option( 'code_style', 'editor_style' ), //编辑器编辑主题
			'emoji'             => $this->get_option( 'support_emoji', 'editor_emoji' ), //emoji表情
			'tex'               => $this->get_option( 'support_katex', 'editor_katex' ), //科学公式
			'taskList'          => $this->get_option( 'task_list', 'editor_basics' ), //task lists
			'imagePaste'        => $this->get_option( 'imagepaste', 'editor_basics' ), //图像粘贴
			'imagePasteSM'      => $this->get_option( 'imagepaste_sm', 'editor_basics' ), //图像粘贴上传源
			'staticFileCDN'     => $this->get_option( 'editor_addres', 'editor_style' ), //静态资源CDN地址
			'prismTheme'        => $prismTheme, //语法高亮风格
			'prismLineNumbers'  => $this->get_option( 'line_numbers', 'syntax_highlighting' ), //行号显示
			'mindMap'           => $this->get_option( 'support_mindmap', 'editor_mindmap' ), //思维导图
			'mermaid'           => $this->get_option( 'support_mermaid', 'editor_mermaid' ), // Mermaid
			//'mermaidConfig'     => $this->get_option('mermaid_config','editor_mermaid'), // Mermaid配置
			'placeholderEditor' => __( 'Enjoy Markdown! Coding now...', $this->text_domain ),
			'imgUploading'      => __( 'Image Uploading...', $this->text_domain ),
			'imgUploadeFailed'  => __( 'Failed To Upload The Image!', $this->text_domain ),
			'supportReply'      => $this->get_option( 'support_reply', 'editor_basics' ), // 后台评论管理
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
	 * 获取字段值
	 *
	 * @param string $option  字段名称
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
