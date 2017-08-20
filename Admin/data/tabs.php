<?php

/**
 * 选项卡配置
 * @Author: JaxsonWang
 */

// Make sure our temporary variable is empty
$tabs = array();

$tabs['tab_1'] = array(
	'title'      => __( 'Basic Options', 'iiong' ),
	'menu_title' => __( 'Basic Options', 'iiong' ),
	'page'       => 'wpeditormd'
);

$tabs['tab_2'] = array(
	'title'      => __( 'Style Settings', 'iiong' ),
	'menu_title' => __( 'Style Settings', 'iiong' ),
	'page'       => 'wpeditormd'
);

// Register tabs
paf_tabs( $tabs );
