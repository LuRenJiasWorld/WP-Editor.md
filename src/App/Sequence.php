<?php

namespace App;

class Sequence {

	public function __construct() {

		add_action('wp_enqueue_scripts', array($this, 'sequence_enqueue_scripts'));

		add_action('wp_print_footer_scripts', array($this, 'sequence_wp_footer_script'));
	}

	public function sequence_enqueue_scripts() {
		wp_enqueue_script( 'jQuery-CDN', $this->get_option( 'static_cdn', 'editor_basics' ) . '/jquery/1.12.4/jquery.min.js', array(), '1.12.4', true );
		wp_enqueue_script( 'Underscore', $this->get_option( 'static_cdn', 'editor_basics' ) . '/underscore.js/1.9.0/underscore-min.js', array(), '1.9.0', true );
		wp_enqueue_script( 'Raphael', $this->get_option( 'static_cdn', 'editor_basics' ) . '/raphael/2.2.7/raphael.min.js', array(), '2.2.7', true );
		wp_enqueue_script( 'Sequence', $this->get_option( 'static_cdn', 'editor_basics' ) . '/js-sequence-diagrams/1.0.6/sequence-diagram-min.js', array(), '1.0.6', true );
	}

	public function sequence_wp_footer_script() {
		$seqStyle = $this->get_option( 'sequence_style', 'editor_sequence' );
		$script = '<script type="text/javascript">(function($){$(document).ready(function(){$(".diagram").sequenceDiagram({theme: "' . $seqStyle . '"})})})(jQuery)</script>';
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