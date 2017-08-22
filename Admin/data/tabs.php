<?php

/**
 * 选项卡配置
 * @Author: JaxsonWang
 */

// Make sure our temporary variable is empty
$tabs = array();

$tabs['basic'] = array(
	'title'      => __( 'Basic Options', 'iiong' ),
	'menu_title' => __( 'Basic Options', 'iiong' ),
	'page'       => 'wpeditormd'
);

$tabs['style'] = array(
	'title'      => __( 'Style Options', 'iiong' ),
	'menu_title' => __( 'Style Options', 'iiong' ),
	'page'       => 'wpeditormd'
);

$tabs['function'] = array(
	'title'      => __( 'Function Options', 'iiong' ),
	'menu_title' => __( 'Function Options', 'iiong' ),
	'page'       => 'wpeditormd'
);

$tabs['prism'] = array(
	'title'      => __( 'Syntax Highlight Options', 'iiong' ),
	'menu_title' => __( 'Syntax Highlight Options ', 'iiong' ),
	'page'       => 'wpeditormd'
);

$tabs['emoji'] = array(
	'title'      => __( 'Emoji Options', 'iiong' ),
	'menu_title' => __( 'Emoji Options ', 'iiong' ),
	'page'       => 'wpeditormd'
);

$tabs['toc'] = array(
	'title'      => __( 'ToC Options', 'iiong' ),
	'menu_title' => __( 'ToC Options ', 'iiong' ),
	'page'       => 'wpeditormd'
);

$tabs['katex'] = array(
	'title'      => __( 'KaTeX Options', 'iiong' ),
	'menu_title' => __( 'KaTeX Options ', 'iiong' ),
	'page'       => 'wpeditormd'
);

$tabs['flowchart'] = array(
	'title'      => __( 'FlowChart Options', 'iiong' ),
	'menu_title' => __( 'FlowChart Options ', 'iiong' ),
	'page'       => 'wpeditormd'
);

$tabs['sequence'] = array(
	'title'      => __( 'Sequence Options', 'iiong' ),
	'menu_title' => __( 'Sequence Options ', 'iiong' ),
	'page'       => 'wpeditormd'
);

$tabs['other'] = array(
	'title'      => __( 'Other Page', 'iiong' ),
	'menu_title' => __( 'Other Page ', 'iiong' ),
	'page'       => 'wpeditormd'
);

// Register tabs
paf_tabs( $tabs );
