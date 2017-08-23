<?php

/**
 * 选项卡配置
 * @Author: JaxsonWang
 */

// Make sure our temporary variable is empty
$tabs = array();

$tabs['basic'] = array(
	'title'      => __( 'Basic Options', 'editormd' ),
	'menu_title' => __( 'Basic Options', 'editormd' ),
	'page'       => 'wpeditormd'
);

$tabs['style'] = array(
	'title'      => __( 'Style Options', 'editormd' ),
	'menu_title' => __( 'Style Options', 'editormd' ),
	'page'       => 'wpeditormd'
);

$tabs['function'] = array(
	'title'      => __( 'Function Options', 'editormd' ),
	'menu_title' => __( 'Function Options', 'editormd' ),
	'page'       => 'wpeditormd'
);

$tabs['prism'] = array(
	'title'      => __( 'Syntax Highlight Options', 'editormd' ),
	'menu_title' => __( 'Syntax Highlight Options', 'editormd' ),
	'page'       => 'wpeditormd'
);

$tabs['emoji'] = array(
	'title'      => __( 'Emoji Options', 'editormd' ),
	'menu_title' => __( 'Emoji Options', 'editormd' ),
	'page'       => 'wpeditormd'
);

$tabs['toc'] = array(
	'title'      => __( 'ToC Options', 'editormd' ),
	'menu_title' => __( 'ToC Options', 'editormd' ),
	'page'       => 'wpeditormd'
);

$tabs['katex'] = array(
	'title'      => __( 'KaTeX Options', 'editormd' ),
	'menu_title' => __( 'KaTeX Options', 'editormd' ),
	'page'       => 'wpeditormd'
);

$tabs['flowchart'] = array(
	'title'      => __( 'FlowChart Options', 'editormd' ),
	'menu_title' => __( 'FlowChart Options', 'editormd' ),
	'page'       => 'wpeditormd'
);

$tabs['sequence'] = array(
	'title'      => __( 'Sequence Options', 'editormd' ),
	'menu_title' => __( 'Sequence Options', 'editormd' ),
	'page'       => 'wpeditormd'
);

$tabs['other'] = array(
	'title'      => __( 'Other Page', 'editormd' ),
	'menu_title' => __( 'Other Page', 'editormd' ),
	'page'       => 'wpeditormd'
);

// Register tabs
paf_tabs( $tabs );
