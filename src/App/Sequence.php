<?php

namespace App;

class Sequence {

	public function __construct() {

		add_action('wp_enqueue_scripts', array($this, 'sequence_enqueue_scripts'));

		add_action('wp_print_footer_scripts', array($this, 'sequence_wp_footer_script'));
	}

	public function sequence_enqueue_scripts() {
		//兼容模式 - jQuery
		if( $this->get_option( 'jquery_compatible', 'editor_advanced' ) !== 'off' ) {
			wp_enqueue_script( 'jquery', null, null, array(), false );
		} else {
			wp_deregister_script('jquery');
			wp_enqueue_script( 'jQuery-CDN', $this->sequence_url('jquery'), array(), '1.12.4', true );
		}
		wp_enqueue_script( 'Underscore', $this->sequence_url('underscore'), array(), '1.9.0', true );
		wp_enqueue_script( 'Raphael', $this->sequence_url('raphael'), array(), '2.2.7', true );
		wp_enqueue_script( 'Sequence',  $this->sequence_url('sequence'), array(), '1.0.6', true );
	}

	public function sequence_wp_footer_script() {
		$seqStyle = $this->get_option( 'sequence_style', 'editor_sequence' );
		$script = '<script type="text/javascript">(function($){$(document).ready(function(){if($(".diagram").sequenceDiagram!==undefined){$(".diagram").sequenceDiagram({theme:"'.$seqStyle.'"})}})})(jQuery)</script>';
		echo $script;
	}

	private function sequence_url($lib) {
		if ( $this->get_option( 'static_cdn', 'editor_basics' ) === '//cdn.jsdelivr.net' ) {
			switch ($lib) {
				case 'jquery':
					$lib_url = $this->get_option( 'static_cdn', 'editor_basics' ) . '/npm/jquery@1.12.4/dist/jquery.min.js';
					break;
				case 'underscore':
					$lib_url = $this->get_option( 'static_cdn', 'editor_basics' ) . '/npm/underscore@1.9.0/underscore-min.js';
					break;
				case 'raphael':
					$lib_url = $this->get_option( 'static_cdn', 'editor_basics' ) . '/npm/raphael@2.2.7/raphael.min.js';
					break;
				case 'sequence':
					$lib_url = $this->get_option( 'static_cdn', 'editor_basics' ) . '/npm/js-sequence-diagrams@1000000.0.6/fucknpm/sequence-diagram-min.min.js';
					break;
			}
		} else {
			switch ($lib) {
				case 'jquery':
					$lib_url = $this->get_option( 'static_cdn', 'editor_basics' ) . '/jquery/1.12.4/jquery.min.js';
					break;
				case 'underscore':
					$lib_url = $this->get_option( 'static_cdn', 'editor_basics' ) . '/underscore.js/1.9.0/underscore-min.js';
					break;
				case 'raphael':
					$lib_url = $this->get_option( 'static_cdn', 'editor_basics' ) . '/raphael/2.2.7/raphael.min.js';
					break;
				case 'sequence':
					$lib_url = $this->get_option( 'static_cdn', 'editor_basics' ) . '/js-sequence-diagrams/1.0.6/sequence-diagram-min.js';
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