<?php
/**
 * Fired when the plugin is uninstalled.
 *
 * @package     WP-Editor.MD\Uninstall
 * @author      Jaxson Wang <wangjin@boxrom.com>
 * @since       3.0.0
 */


// If uninstall, not called from WordPress, then exit
if( !defined( 'WP_UNINSTALL_PLUGIN' ) ) {
	exit;
}

if ( get_option( 'editormd' ) ) {
	delete_option( 'editormd' );
}