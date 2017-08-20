<?php

/**
 * 定义选项
 * @Author: JaxsonWang
 */

$options = array();

$options['support_comment'] = array(
	'title'       => __( 'Use Markdown For Comments', 'iiong' ),
	'page'        => 'wpeditormd',
	'tab'         => 'tab_1',
	'description' => '<a class="support_comment_text" href="' . admin_url( 'options-discussion.php#wpcom_publish_comments_with_markdown' ) . '" rel="nofollow" target="_blank">' . __( 'Go', 'iiong' ) . '</a>'
);

$options['support_jquery_library'] = array(
	'type'        => 'text',
	'page'        => 'wpeditormd',
	'tab'         => 'tab_1',
	'title'       => __( 'jQuery Library', 'iiong' ),
	'subtitle'    => __( '', 'iiong' ),
	'description' => __( 'jQuery resource load library address', 'iiong' ),
	'default'     => WP_EDITORMD_PLUGIN_URL . '/jQuery'
);

$options['support_raphael_library'] = array(
	'type'        => 'text',
	'page'        => 'wpeditormd',
	'tab'         => 'tab_1',
	'title'       => __( 'Raphael Library', 'iiong' ),
	'subtitle'    => __( '', 'iiong' ),
	'description' => __( 'Raphael resource load library address(<code>FlowChart</code> and <code>Sequence</code> depend on this option)', 'iiong' ),
	'default'     => WP_EDITORMD_PLUGIN_URL . '/Raphael'
);

$options['basic_2'] = array(
	'page' => 'wpeditormd',
	'tab'  => 'tab_2',
);

// Register options
paf_options( $options );
