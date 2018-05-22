<?php

namespace App;

class PrismJSAuto {

	public function __construct() {
		add_action( 'wp_footer', array( $this, 'prism_styles_scripts' ) );

		if( !in_array($GLOBALS['pagenow'], array('wp-login.php', 'wp-register.php')) ) {
			add_action( 'wp_print_footer_scripts', array( $this, 'prism_wp_footer_scripts') );
		}
	}

	public function prism_styles_scripts() {
		$prism_base_url = $this->prism_url(); //资源载入地址
		$prism_theme    = $this->get_option( 'highlight_library_style', 'syntax_highlighting' ); //语法高亮风格
		$line_numbers   = $this->get_option( 'line_numbers', 'syntax_highlighting' ) == 'on' ? true : false; //行号显示
		$show_language  = $this->get_option( 'show_language', 'syntax_highlighting' ) == 'on' ? true : false; //显示语言
		$copy_clipboard = $this->get_option( 'copy_clipboard', 'syntax_highlighting' ) == 'on' ? true : false; //粘贴
		if($show_language == true) {
			$toolbar = true;
		}
		$prism_plugins  = array(
			'autoloader' => array(
				'js'  => true,
				'css' => false
			),
			'toolbar' => array(
				'js'  => $toolbar,
				'css' => $toolbar
			),
			'line-numbers' => array(
				'css' => $line_numbers,
				'js'  => $line_numbers
			),
			'show-language' => array(
				'js'  => $show_language,
				'css' => false
			),
			'copy-to-clipboard' => array(
				'js'  => $copy_clipboard,
				'css' => false
			),
		);
		$prism_styles   = array();
		$prism_scripts  = array();

		$prism_scripts['prism-core-js'] = $prism_base_url . '/components/prism-core.min.js';
		//$prism_scripts['prism-language-default-js'] = $prism_base_url . '/prism.min.js';

		if ( empty( $prism_theme ) || $prism_theme == 'default' ) {
			$prism_styles['prism-theme-default'] = $prism_base_url . '/themes/prism.min.css';
		} else if ( $prism_theme == 'customize' ) {
			$prism_styles['prism-theme-style'] = $this->get_option( 'customize_my_style', 'syntax_highlighting' ); //自定义风格
		} else {
			$prism_styles['prism-theme-style'] = $prism_base_url . "/themes/prism-{$prism_theme}.min.css";
		}
		foreach ( $prism_plugins as $prism_plugin => $prism_plugin_config ) {
			if ( $prism_plugin_config['css'] === true ) {
				$prism_styles["prism-plugin-{$prism_plugin}"] = $prism_base_url . "/plugins/{$prism_plugin}/prism-{$prism_plugin}.min.css";
			}
			if ( $prism_plugin_config['js'] === true ) {
				$prism_scripts["prism-plugin-{$prism_plugin}"] = $prism_base_url . "/plugins/{$prism_plugin}/prism-{$prism_plugin}.min.js";
			}
		}

		/**
		 * 代码粘贴代码增强
		 * 引入clipboard
		 */
		if ( $this->get_option( 'static_cdn', 'editor_basics' ) === '//cdn.jsdelivr.net' ) {
			$lib_url = $this->get_option( 'static_cdn', 'editor_basics' ) . '/npm/clipboard@2.0.1/dist/clipboard.min.js';
		} else {
			$lib_url = $this->get_option( 'static_cdn', 'editor_basics' ) . '/clipboard.js/2.0.1/clipboard.min.js';
		}

		if ( $copy_clipboard ) {
			wp_enqueue_script('copy-clipboard', $lib_url, array(), '2.0.1', true);
		}

		foreach ( $prism_styles as $name => $prism_style ) {
			wp_enqueue_style( $name, $prism_style, array(), '1.14.0', 'all' );
		}

		foreach ( $prism_scripts as $name => $prism_script ) {
			wp_enqueue_script( $name, $prism_script, array(), '1.14.0', true );
		}
	}

	public function prism_wp_footer_scripts() {
		?>
		<script type="text/javascript">
			Prism.plugins.autoloader.languages_path = "<?php echo $this->prism_url() ?>/components/"
		</script>
		<?php
	}

	private function prism_url() {
		if ( $this->get_option( 'static_cdn', 'editor_basics' ) === '//cdn.jsdelivr.net' ) {
			$lib_url = $this->get_option( 'static_cdn', 'editor_basics' ) . '/npm/prismjs@1.14.0';
		} else {
			$lib_url = $this->get_option( 'static_cdn', 'editor_basics' ) . '/prism/1.14.0';
		}

		return $lib_url;
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