<?php

namespace Utils;


class PluginMeta {
	
	protected $text_domain;

	public function __construct($text_domain) {
		$this->text_domain = $text_domain;

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
				'<a href="' . admin_url( "plugins.php?page=wp-editormd-settings" ) . '" rel="nofollow">' . __( 'Settings', $this->text_domain ) . '</a>',
				'<a href="https://github.com/JaxsonWang/WP-Editor.md" target="_blank" rel="nofollow">' . __( 'Github', $this->text_domain ) . '</a>'
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
			//判断地区，根据不同的地区进入不同的文档
			switch (get_bloginfo( 'language' )) {
				case 'zh-CN':
					$lang = 'zh-CN';
					break;
				default :
					$lang = 'en-US';
			}
			$new_links = array(
				'Blog'   => '<a href="https://iiong.com" target="_blank" rel="nofollow">' . __( 'Blog', $this->text_domain ) . '</a>',
				'Issues' => '<a href="https://github.com/JaxsonWang/WP-Editor.md/issues" target="_blank" rel="nofollow">' . __( 'Issues', $this->text_domain ) . '</a>',
				'Docs'   => '<a href="https://github.com/JaxsonWang/WP-Editor.md/blob/docs/'. $lang .'/synopsis.md" target="_blank" rel="nofollow">' . __( 'Docs', $this->text_domain ) . '</a>'
			);
			$links     = array_merge( $links, $new_links );
		}

		return $links;
	}

}