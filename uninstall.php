<?php

if (
	! defined( 'WP_UNINSTALL_PLUGIN' )
	||
	! WP_UNINSTALL_PLUGIN
	||
	dirname( WP_UNINSTALL_PLUGIN ) != dirname( plugin_basename( __FILE__ ) )
) {
	status_header( 404 );
	exit;
}

static $options_name = array(
	'editor_basics',
	'editor_style',
	'syntax_highlighting',
	'editor_emoji',
	'editor_toc',
	'editor_katex',
	'editor_mermaid',
	'editor_flow',
	'editor_mindmap',
	'editor_sequence',
);


// 删除选项
foreach($options_name as $optionName) {
	delete_option($optionName);
}

//开启自带可视化编辑器
add_filter( 'user_can_richedit', '__return_true' );