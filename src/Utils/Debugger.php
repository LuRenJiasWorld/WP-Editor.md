<?php

namespace Utils;

class Debugger {

	public static function editormd_debug( $text_domain ) {

		$user = wp_get_current_user();

		$basics       = '';
		$style        = '';
		$highlighting = '';
		$emoji        = '';
		$toc          = '';
		$katex        = '';
		$mermaid      = '';
		$advanced     = '';
		foreach ( (array)get_option( 'editor_basics' ) as $key => $value ) {
			$basics .= "{$key} => {$value} <br>";
		}
		foreach ( (array)get_option( 'editor_style' ) as $key => $value ) {
			$style .= "{$key} => {$value} <br>";
		}
		foreach ( (array)get_option( 'syntax_highlighting' ) as $key => $value ) {
			$highlighting .= "{$key} => {$value} <br>";
		}
		foreach ( (array)get_option( 'editor_emoji' ) as $key => $value ) {
			$emoji .= "{$key} => {$value} <br>";
		}
		foreach ( (array)get_option( 'editor_toc' ) as $key => $value ) {
			$toc .= "{$key} => {$value} <br>";
		}
		foreach ( (array)get_option( 'editor_katex' ) as $key => $value ) {
			$katex .= "{$key} => {$value} <br>";
		}
		foreach ( (array)get_option( 'editor_mermaid' ) as $key => $value ) {
			$mermaid .= "{$key} => {$value} <br>";
		}
		foreach ( (array)get_option( 'editor_advanced' ) as $key => $value ) {
			$advanced .= "{$key} => {$value} <br>";
		}

		$debug_info = '<table class="debugger-wrap">';

		$debug_info .= '<tr>';
		$debug_info .= '<th>' . __( 'Operating System', $text_domain ) . '</th><th>' . PHP_OS . '</th>';
		$debug_info .= '</tr>';

		$debug_info .= '<tr>';
		$debug_info .= '<th>' . __( 'Operating Environment', $text_domain ) . '</th><th>' . $_SERVER["SERVER_SOFTWARE"] . '</th>';
		$debug_info .= '</tr>';

		$debug_info .= '<tr>';
		$debug_info .= '<th>' . __( 'PHP Version', $text_domain ) . '</th><th>' . PHP_VERSION . '</th>';
		$debug_info .= '</tr>';

		$debug_info .= '<tr>';
		$debug_info .= '<th>' . __( 'PHP Operating Mode', $text_domain ) . '</th><th>' . php_sapi_name() . '</th>';
		$debug_info .= '</tr>';

		$debug_info .= '<tr>';
		$debug_info .= '<th>' . __( 'Browser Information', $text_domain ) . '</th><th>' . $_SERVER['HTTP_USER_AGENT'] . '</th>';
		$debug_info .= '</tr>';

		$debug_info .= '<tr>';
		$debug_info .= '<th>' . __( 'WordPress Version', $text_domain ) . '</th><th>' . $GLOBALS['wp_version'] . '</th>';
		$debug_info .= '</tr>';

		$debug_info .= '<tr>';
		$debug_info .= '<th>' . __( 'WP Editor.md Version', $text_domain ) . '</th><th>' . WP_EDITORMD_VER . '</th>';
		$debug_info .= '</tr>';

		$debug_info .= '<tr>';
		$debug_info .= '<th>' . __( 'jQuery Version', $text_domain ) . '</th><th id="jquery"></th>';
		$debug_info .= '</tr>';

		$debug_info .= '<tr>';
		$debug_info .= '<th>' . __( 'Current Roles', $text_domain ) . '</th><th>' . $user->roles[0] . '</th>';
		$debug_info .= '</tr>';

		$debug_info .= '<tr>';
		$debug_info .= '<th>' . __( 'Site URL', $text_domain ) . '</th><th>' . site_url() . '</th>';
		$debug_info .= '</tr>';

		$debug_info .= '<tr>';
		$debug_info .= '<th>' . __( 'Home URL', $text_domain ) . '</th><th>' . home_url() . '</th>';
		$debug_info .= '</tr>';

		$debug_info .= '<tr>';
		$debug_info .= '<th>' . __( 'Basic Settings', $text_domain ) . '</th><th>' . $basics . '</th>';
		$debug_info .= '</tr>';

		$debug_info .= '<tr>';
		$debug_info .= '<th>' . __( 'Editor Style Settings', $text_domain ) . '</th><th>' . $style . '</th>';
		$debug_info .= '</tr>';

		$debug_info .= '<tr>';
		$debug_info .= '<th>' . __( 'Syntax Highlighting Settings', $text_domain ) . '</th><th>' . $highlighting . '</th>';
		$debug_info .= '</tr>';

		$debug_info .= '<tr>';
		$debug_info .= '<th>' . __( 'Emoji Settings', $text_domain ) . '</th><th>' . $emoji . '</th>';
		$debug_info .= '</tr>';

		$debug_info .= '<tr>';
		$debug_info .= '<th>' . __( 'TOC Settings', $text_domain ) . '</th><th>' . $toc . '</th>';
		$debug_info .= '</tr>';

		$debug_info .= '<tr>';
		$debug_info .= '<th>' . __( 'KaTeX Settings', $text_domain ) . '</th><th>' . $katex . '</th>';
		$debug_info .= '</tr>';

		$debug_info .= '<tr>';
		$debug_info .= '<th>' . __( 'Mermaid Settings', $text_domain ) . '</th><th>' . $mermaid . '</th>';
		$debug_info .= '</tr>';

		$debug_info .= '<tr>';
		$debug_info .= '<th>' . __( 'Advanced Settings', $text_domain ) . '</th><th>' . $advanced . '</th>';
		$debug_info .= '</tr>';

		$debug_info .= '</div>';

		return $debug_info;
	}

}