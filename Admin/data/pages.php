<?php
/**
 * 选项菜单配置
 * @Author: JaxsonWang
 */
$pages = array();

$pages['page_a'] = array(
	'title'         => __( 'WordPress Editor.md Options' ),
	'menu_title'    => __( 'WP-Editor.md' ),
	'submit_button' => __( 'Save settings' ),
	'reset_button'  => __( 'Reset' ),
	'success'       => __( 'Settings saved successfully.' ),
	'parent'     => 'options-general.php'
);

// Register pages
paf_pages( $pages );
