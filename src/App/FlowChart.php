<?php

namespace App;

class FlowChart {

	public function __construct() {

		add_action( 'wp_enqueue_scripts', array( $this, 'flowchart_enqueue_scripts' ) );

		add_action( 'wp_print_footer_scripts', array( $this, 'flowchart_wp_footer_script' ) );

	}

	public function flowchart_enqueue_scripts() {
		wp_enqueue_script( 'jQuery-CDN', $this->get_option( 'static_cdn', 'editor_basics' ) . '/jquery/1.12.4/jquery.min.js', array(), '1.12.4', true );
		wp_enqueue_script( 'Raphael', $this->get_option( 'static_cdn', 'editor_basics' ) . '/raphael/2.2.7/raphael.min.js', array(), '2.2.7', true );
		wp_enqueue_script( 'Flowchart', $this->get_option( 'static_cdn', 'editor_basics' ) . '/flowchart/1.11.0/flowchart.min.js', array(), '1.11.0', true );
		//wp_enqueue_script( 'jQueryFlow', WP_EDITORMD_URL . '/assets/Config/jquery.flowchart.min.js', array( ), WP_EDITORMD_VER, true );
	}

	public function flowchart_wp_footer_script() {
		$script = '<script type="text/javascript">(function($){$(document).ready(function(){$(".flowchart").flowChart();})})(jQuery)</script>';
		echo $script;
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