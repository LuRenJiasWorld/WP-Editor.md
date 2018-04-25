<?php

namespace Utils;


class PluginMeta {

	public function __construct() {

		// Add settings link to plugins page
		add_filter( 'plugin_action_links_' . WP_EDITORMD_NAME, array( $this, 'add_settings_link' ), 10, 5 );

		// Add settings meta to plugins page
		add_filter( 'plugin_row_meta', array( $this, 'add_plugin_row_meta' ), 10, 2 );

	}

	/**
	 * Add settings link to plugin list table
	 *
	 * @param  array $links Existing links
	 *
	 * @return array        Modified links
	 */
	public function add_settings_link( $actions ) {
		return array_merge(
			array(
				'<a href="' . admin_url( "plugins.php?page=wp-editormd-settings" ) . '" rel="nofollow">' . __( 'Settings', 'editormd' ) . '</a>',
				'<a href="https://github.com/JaxsonWang/WP-Editor.md" target="_blank" rel="nofollow">' . __( 'Github', 'editormd' ) . '</a>'
			),
			$actions
		);
	}

	/**
	 * 插件设置标签链接
	 *
	 * @param $links
	 * @param $file
	 *
	 * @return array
	 */
	public function add_plugin_row_meta( $links, $file ) {
		if ( strpos( $file, WP_EDITORMD_NAME ) !== false ) {
			$new_links = array(
				'Blog'   => '<a href="https://iiong.com" target="_blank" rel="nofollow">' . __( 'Blog', 'editormd' ) . '</a>',
				'Issues' => '<a href="https://github.com/JaxsonWang/WP-Editor.md/issues" target="_blank" rel="nofollow">' . __( 'Issues', 'editormd' ) . '</a>',
				'Docs'   => '<a href="https://github.com/JaxsonWang/WP-Editor.MD/blob/master/Document/use-zh_CN.md" target="_blank" rel="nofollow">' . __( 'Docs', 'editormd' ) . '</a>'
			);
			$links     = array_merge( $links, $new_links );
		}

		return $links;
	}

}