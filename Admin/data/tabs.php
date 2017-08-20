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
	'title'      => __( 'Style Options', 'iiong' ),
	'menu_title' => __( 'Style Options', 'iiong' ),
	'page'       => 'wpeditormd'
);

$tabs['tab_3'] = array(
	'title'      => __( 'Function Options', 'iiong' ),
	'menu_title' => __( 'Function Options', 'iiong' ),
	'page'       => 'wpeditormd'
);

$tabs['tab_4'] = array(
	'title'      => __( 'Syntax Highlight Options', 'iiong' ),
	'menu_title' => __( 'Syntax Highlight Options ', 'iiong' ),
	'page'       => 'wpeditormd'
);

$tabs['tab_5'] = array(
	'title'      => __( 'Emoji Options', 'iiong' ),
	'menu_title' => __( 'Emoji Options ', 'iiong' ),
	'page'       => 'wpeditormd'
);

$tabs['tab_6'] = array(
	'title'      => __( 'ToC Options', 'iiong' ),
	'menu_title' => __( 'ToC Options ', 'iiong' ),
	'page'       => 'wpeditormd'
);

$tabs['tab_7'] = array(
	'title'      => __( 'LaTeX Options', 'iiong' ),
	'menu_title' => __( 'LaTeX Options ', 'iiong' ),
	'page'       => 'wpeditormd'
);

$tabs['tab_8'] = array(
	'title'      => __( 'FlowChart Options', 'iiong' ),
	'menu_title' => __( 'FlowChart Options ', 'iiong' ),
	'page'       => 'wpeditormd'
);

$tabs['tab_9'] = array(
	'title'      => __( 'Sequence Options', 'iiong' ),
	'menu_title' => __( 'Sequence Options ', 'iiong' ),
	'page'       => 'wpeditormd'
);

// Register tabs
paf_tabs( $tabs );
