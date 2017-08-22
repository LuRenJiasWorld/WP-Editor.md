<?php
/**
 * 选项菜单配置
 * @Author: JaxsonWang
 */
$pages = array();

$pages['wpeditormd'] = array(
	'title'         => __( 'WordPress Editor.md Options', 'iiong' ),
	'menu_title'    => __( 'WP-Editor.md', 'iiong' ),
	'submit_button' => __( 'Save settings', 'iiong' ),
	'reset_button'  => __( 'Reset', 'iiong' ),
	'success'       => __( 'Settings saved successfully', 'iiong' ),
	'parent'        => 'options-general.php'
);

// Register pages
paf_pages( $pages );
