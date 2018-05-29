<?php

namespace App;

class MindMap {

	public function __construct() {

		add_action( 'wp_enqueue_scripts', array( $this, 'mindmap_enqueue_scripts' ) );
		if( !in_array($GLOBALS['pagenow'], array('wp-login.php', 'wp-register.php')) ) {
			add_action( 'wp_print_footer_scripts', array( $this, 'mindmap_wp_footer_script' ) );
		}
	}

	public function mindmap_enqueue_scripts() {

		//兼容模式 - jQuery
		if( $this->get_option( 'jquery_compatible', 'editor_advanced' ) !== 'off' ) {
			wp_enqueue_script( 'jquery', null, null, array(), false );
		} else {
			wp_deregister_script('jquery');
			wp_enqueue_script( 'jQuery-CDN', $this->flow_url('jquery'), array(), '1.12.4', true );
		}

		wp_enqueue_script( 'MindMap',  $this->get_option( 'customize_mindmap', 'editor_mindmap' ), array(), WP_EDITORMD_VER, true );
	}

	public function mindmap_wp_footer_script() {
		?>
		<script type="text/javascript">
            (function ($) {
                $(document).ready(function () {
                    $(".mind p").remove();
                    $(".mind .mindTxt script").remove();
                    var mind = $(".mind");
                    if (mind.drawMind !== undefined) {
                        mind.drawMind();
                    }
                })
            })(jQuery)
		</script>
		<?php
	}

	private function flow_url($lib) {
		if ( $this->get_option( 'static_cdn', 'editor_basics' ) === '//cdn.jsdelivr.net' ) {
			switch ($lib) {
				case 'jquery':
					$lib_url = $this->get_option( 'static_cdn', 'editor_basics' ) . '/npm/jquery@1.12.4/dist/jquery.min.js';
					break;
			}
		} else {
			switch ($lib) {
				case 'jquery':
					$lib_url = $this->get_option( 'static_cdn', 'editor_basics' ) . '/jquery/1.12.4/jquery.min.js';
					break;
			}
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
	private function get_option( $option, $section, $default = '' ) {

		$options = get_option( $section );

		if ( isset( $options[ $option ] ) ) {
			return $options[ $option ];
		}

		return $default;
	}

}