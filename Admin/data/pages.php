<?php
/**
 * 选项菜单配置
 * @Author: JaxsonWang
 */
$pages = array();

$pages['wpeditormd'] = array(
	'title'         => __( 'WordPress Editor.md Options', 'editormd' ),
	'menu_title'    => __( 'WP-Editor.md', 'editormd' ),
	'submit_button' => __( 'Save settings', 'editormd' ),
	'reset_button'  => __( 'Reset', 'editormd' ),
	'success'       => __( 'Settings saved successfully', 'editormd' ),
	'parent'        => 'options-general.php'
);

// Register pages
paf_pages( $pages );
