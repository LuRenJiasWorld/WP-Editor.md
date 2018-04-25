<?php

namespace App;

class PrismJSCustomize {

	public function __construct() {
		add_action('wp_enqueue_scripts', array($this, 'prism_styles_scripts'));
	}

	public function prism_styles_scripts() {
		wp_enqueue_style( 'Prism', $this->get_option( 'customize_highlight_style', 'syntax_highlighting' ) , array(), WP_EDITORMD_VER, 'all' );
		wp_enqueue_script( 'Prism', $this->get_option( 'customize_highlight_javascript', 'syntax_highlighting' ) , array(), WP_EDITORMD_VER, 'true' );
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