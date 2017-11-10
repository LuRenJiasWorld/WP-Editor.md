<?php

/**
 * 定义选项
 * @Author: JaxsonWang
 */

$options = array();

$options['support_comment'] = array(
	'title'       => __( 'Use Markdown For Comments', 'editormd' ),
	'page'        => 'wpeditormd',
	'tab'         => 'basic',
	'description' => '<a class="support_comment" href="' . admin_url( 'options-discussion.php#wpcom_publish_comments_with_markdown' ) . '" rel="nofollow" target="_blank">' . __( 'Go', 'editormd' ) . '</a>'
);

$options['jquery_library'] = array(
	'type'        => 'text',
	'page'        => 'wpeditormd',
	'tab'         => 'basic',
	'title'       => __( 'jQuery Library', 'editormd' ),
	'subtitle'    => __( '', 'editormd' ),
	'description' => __( '', 'editormd' ),
	'default'     => WP_EDITORMD_PLUGIN_URL . '/jQuery'
);

$options['raphael_library'] = array(
	'type'        => 'text',
	'page'        => 'wpeditormd',
	'tab'         => 'basic',
	'title'       => __( 'Raphael Library', 'editormd' ),
	'subtitle'    => __( '', 'editormd' ),
	'description' => __( '', 'editormd' ),
	'default'     => WP_EDITORMD_PLUGIN_URL . '/Raphael'
);

//================================

$options['theme_style'] = array(
	'type'        => 'select',
	'page'        => 'wpeditormd',
	'tab'         => 'style',
	'title'       => __( 'Editor Theme Style', 'editormd' ),
	'description' => __( 'Change the editor theme style', 'editormd' ),
	'options'     => array(
		'default' => __( 'default', 'editormd' ),
		'dark'    => __( 'dark', 'editormd' )
	),
	'default'     => 'default'
);

$options['code_style'] = array(
	'type'        => 'select',
	'page'        => 'wpeditormd',
	'tab'         => 'style',
	'title'       => __( 'Code Theme Style', 'editormd' ),
	'description' => __( 'Change the code theme style in the editor', 'editormd' ),
	'options'     => array(
		'default'                 => 'default',
		'3024-day'                => '3024-day',
		'3024-night'              => '3024-night',
		'ambiance'                => 'ambiance',
		'ambiance-mobile'         => 'ambiance-mobile',
		'base16-dark'             => 'base16-dark',
		'base16-light'            => 'base16-light',
		'blackboard'              => 'blackboard',
		'cobalt'                  => 'cobalt',
		'eclipse'                 => 'eclipse',
		'elegant'                 => 'elegant',
		'erlang-dark'             => 'erlang-dark',
		'lesser-dark'             => 'lesser-dark',
		'mbo'                     => 'mbo',
		'mdn-like'                => 'mdn-like',
		'midnight'                => 'midnight',
		'monokai'                 => 'monokai',
		'neat'                    => 'neat',
		'neo'                     => 'neo',
		'night'                   => 'night',
		'paraiso-dark'            => 'paraiso-dark',
		'paraiso-light'           => 'paraiso-light',
		'pastel-on-dark'          => 'pastel-on-dark',
		'rubyblue'                => 'rubyblue',
		'solarized'               => 'solarized',
		'the-matrix'              => 'the-matrix',
		'tomorrow-night-eighties' => 'tomorrow-night-eighties',
		'twilight'                => 'twilight',
		'vibrant-ink'             => 'vibrant-ink',
		'xq-dark'                 => 'xq-dark',
		'xq-light'                => 'xq-light'
	),
	'default'     => 'default'
);

//================================

$options['task_list'] = array(
	'type'        => 'radio',
	'page'        => 'wpeditormd',
	'tab'         => 'function',
	'title'       => __( 'Support Task Lists', 'editormd' ),
	'subtitle'    => __( '', 'editormd' ),
	'description' => __( 'Github Flavored Markdown task lists', 'editormd' ),
	'options'     => array(
		'0' => __( 'Off', 'editormd' ),
		'1' => __( 'On', 'editormd' ),
	),
	'default'     => '0'
);

$options['imagepaste'] = array(
	'type'        => 'radio',
	'page'        => 'wpeditormd',
	'tab'         => 'function',
	'title'       => __( 'Support Image Paste', 'editormd' ),
	'subtitle'    => __( '', 'editormd' ),
	'description' => __( 'Image Paste allows you to copy and paste images from your desktop to the editor', 'editormd' ),
	'options'     => array(
		'0' => __( 'Off', 'editormd' ),
		'1' => __( 'On', 'editormd' ),
	),
	'default'     => '0'
);

$options['live_preview'] = array(
	'type'        => 'radio',
	'page'        => 'wpeditormd',
	'tab'         => 'function',
	'title'       => __( 'Live preview', 'editormd' ),
	'subtitle'    => __( '', 'editormd' ),
	'description' => __( 'Default to open the editor live preview', 'editormd' ),
	'options'     => array(
		'0' => __( 'Off', 'editormd' ),
		'1' => __( 'On', 'editormd' ),
	),
	'default'     => '1'
);

$options['sync_scrolling'] = array(
	'type'        => 'radio',
	'page'        => 'wpeditormd',
	'tab'         => 'function',
	'title'       => __( 'Sync scrolling', 'editormd' ),
	'subtitle'    => __( '', 'editormd' ),
	'description' => __( 'The editor and the preview editor are synchronized to scroll', 'editormd' ),
	'options'     => array(
		'0' => __( 'Off', 'editormd' ),
		'1' => __( 'On', 'editormd' ),
	),
	'default'     => '1'
);

$options['html_decode'] = array(
	'type'        => 'radio',
	'page'        => 'wpeditormd',
	'tab'         => 'function',
	'title'       => __( 'Support Html Decode', 'editormd' ),
	'subtitle'    => __( '', 'editormd' ),
	'description' => __( 'Support rich text analysis', 'editormd' ),
	'options'     => array(
		'0' => __( 'Off', 'editormd' ),
		'1' => __( 'On', 'editormd' ),
	),
	'default'     => '0'
);

//================================

$options['support_highlight'] = array(
	'type'        => 'radio',
	'page'        => 'wpeditormd',
	'tab'         => 'prism',
	'title'       => __( 'Support Prism Syntax Highlight', 'editormd' ),
	'subtitle'    => __( '', 'editormd' ),
	'description' => __( 'Article support syntax highlighting', 'editormd' ),
	'options'     => array(
		'0' => __( 'Off', 'editormd' ),
		'1' => __( 'On', 'editormd' ),
	),
	'default'     => '0'
);

$options['highlight_mode'] = array(
	'type'        => 'radio',
	'page'        => 'wpeditormd',
	'tab'         => 'prism',
	'title'       => __( 'Syntax highlighting mode', 'editormd' ),
	'subtitle'    => __( '', 'editormd' ),
	'description' => __( 'According to your preferences to select the corresponding loading mode', 'editormd' ),
	'options'     => array(
		'auto' => __( 'Auto load mode', 'editormd' ),
		'customize' => __( 'Customize mode', 'editormd' ),
	),
	'default'     => 'auto'
);

$options['line_numbers'] = array(
	'type'        => 'radio',
	'page'        => 'wpeditormd',
	'tab'         => 'prism',
	'title'       => __( 'Support Prism Syntax Highlight Line Numbers', 'editormd' ),
	'subtitle'    => __( '', 'editormd' ),
	'description' => __( '', 'editormd' ),
	'options'     => array(
		'0' => __( 'Off', 'editormd' ),
		'1' => __( 'On', 'editormd' ),
	),
	'default'     => '0'
);

$options['highlight_library'] = array(
	'type'        => 'text',
	'page'        => 'wpeditormd',
	'tab'         => 'prism',
	'title'       => __( 'PrismJS Syntax Highlight Library', 'editormd' ),
	'subtitle'    => __( '', 'editormd' ),
	'description' => __( '', 'editormd' ),
	'default'     => WP_EDITORMD_PLUGIN_URL . '/Prism'
);

$options['highlight_library_style'] = array(
	'type'        => 'select',
	'page'        => 'wpeditormd',
	'tab'         => 'prism',
	'title'       => __( 'PrismJS Syntax Highlight Style', 'editormd' ),
	'description' => __( 'Syntax highlight theme style', 'editormd' ),
	'options'     => array(
		'default'        => 'default',
		'dark'           => 'dark',
		'funky'          => 'funky',
		'okaidia'        => 'okaidia',
		'twilight'       => 'twilight',
		'coy'            => 'coy',
		'solarizedlight' => 'solarizedlight'
	),
	'default'     => 'default'
);

$options['customize_highlight_style'] = array(
	'type'        => 'text',
	'page'        => 'wpeditormd',
	'tab'         => 'prism',
	'title'       => __( 'PrismJS Syntax Highlight Style Library', 'editormd' ),
	'subtitle'    => __( '', 'editormd' ),
	'description' => __( '', 'editormd' ),
	'default'     => WP_EDITORMD_PLUGIN_URL . '/Prism/customize/prism.min.css'
);

$options['customize_highlight_javascript'] = array(
	'type'        => 'text',
	'page'        => 'wpeditormd',
	'tab'         => 'prism',
	'title'       => __( 'PrismJS Syntax Highlight JavaScript Library', 'editormd' ),
	'subtitle'    => __( '', 'editormd' ),
	'description' => __( '', 'editormd' ),
	'default'     => WP_EDITORMD_PLUGIN_URL . '/Prism/customize/prism.min.js'
);

//================================

$options['support_emoji'] = array(
	'type'        => 'radio',
	'page'        => 'wpeditormd',
	'tab'         => 'emoji',
	'title'       => __( 'Support Emoji', 'editormd' ),
	'subtitle'    => __( '', 'editormd' ),
	'description' => __( '', 'editormd' ),
	'options'     => array(
		'0' => __( 'Off', 'editormd' ),
		'1' => __( 'On', 'editormd' ),
	),
	'default'     => '0'
);

$options['emoji_library'] = array(
	'type'        => 'text',
	'page'        => 'wpeditormd',
	'tab'         => 'emoji',
	'title'       => __( 'Emoji Library', 'editormd' ),
	'subtitle'    => __( '', 'editormd' ),
	'description' => __( '', 'editormd' ),
	'default'     => WP_EDITORMD_PLUGIN_URL . '/Emojify.js'
);

//================================

$options['support_toc'] = array(
	'type'        => 'radio',
	'page'        => 'wpeditormd',
	'tab'         => 'toc',
	'title'       => __( 'Support ToC', 'editormd' ),
	'subtitle'    => __( '', 'editormd' ),
	'description' => __( 'Table of Contents', 'editormd' ),
	'options'     => array(
		'0' => __( 'Off', 'editormd' ),
		'1' => __( 'On', 'editormd' ),
	),
	'default'     => '0'
);

$options['toc_tips'] = array(
	'title'       => __( 'You need install the plugin', 'editormd' ),
	'page'        => 'wpeditormd',
	'tab'         => 'toc',
	'description' => '<a class="toc_tips" href="' . get_option( 'home' ) . '/wp-admin/plugin-install.php?tab=plugin-information&plugin=table-of-contents-plus&TB_iframe=true" rel="nofollow" target="_blank">' . __( 'If you need to enable this option,you need install the plugin', 'editormd' ) . '</a>'
);

//================================

$options['support_katex'] = array(
	'type'        => 'radio',
	'page'        => 'wpeditormd',
	'tab'         => 'katex',
	'title'       => __( 'Support KaTeX', 'editormd' ),
	'subtitle'    => __( '', 'editormd' ),
	'description' => __( '', 'editormd' ),
	'options'     => array(
		'0' => __( 'Off', 'editormd' ),
		'1' => __( 'On', 'editormd' ),
	),
	'default'     => '0'
);

$options['katex_library'] = array(
	'type'        => 'text',
	'page'        => 'wpeditormd',
	'tab'         => 'katex',
	'title'       => __( 'KaTeX Library', 'editormd' ),
	'subtitle'    => __( '', 'editormd' ),
	'description' => __( '', 'editormd' ),
	'default'     => WP_EDITORMD_PLUGIN_URL . '/KaTeX'
);

//================================

$options['support_flowchart'] = array(
	'type'        => 'radio',
	'page'        => 'wpeditormd',
	'tab'         => 'flowchart',
	'title'       => __( 'Support FlowChart', 'editormd' ),
	'subtitle'    => __( '', 'editormd' ),
	'description' => __( '', 'editormd' ),
	'options'     => array(
		'0' => __( 'Off', 'editormd' ),
		'1' => __( 'On', 'editormd' ),
	),
	'default'     => '0'
);

$options['flowchart_library'] = array(
	'type'        => 'text',
	'page'        => 'wpeditormd',
	'tab'         => 'flowchart',
	'title'       => __( 'FlowChart Library', 'editormd' ),
	'subtitle'    => __( '', 'editormd' ),
	'description' => __( '', 'editormd' ),
	'default'     => WP_EDITORMD_PLUGIN_URL . '/FlowChart'
);

$options['flowchart_config'] = array(
	'type'        => 'text',
	'page'        => 'wpeditormd',
	'tab'         => 'flowchart',
	'title'       => __( 'jQuery FlowChart Config', 'editormd' ),
	'subtitle'    => __( '', 'editormd' ),
	'description' => __( 'Please create a CDN static acceleration file', 'editormd' ),
	'default'     => WP_EDITORMD_PLUGIN_URL . '/FlowChart'
);

//================================

$options['support_sequence'] = array(
	'type'        => 'radio',
	'page'        => 'wpeditormd',
	'tab'         => 'sequence',
	'title'       => __( 'Support Sequence', 'editormd' ),
	'subtitle'    => __( '', 'editormd' ),
	'description' => __( '', 'editormd' ),
	'options'     => array(
		'0' => __( 'Off', 'editormd' ),
		'1' => __( 'On', 'editormd' ),
	),
	'default'     => '0'
);

$options['sequence_library'] = array(
	'type'        => 'text',
	'page'        => 'wpeditormd',
	'tab'         => 'sequence',
	'title'       => __( 'Sequence Library', 'editormd' ),
	'subtitle'    => __( '', 'editormd' ),
	'description' => __( '', 'editormd' ),
	'default'     => WP_EDITORMD_PLUGIN_URL . '/Sequence'
);

$options['underscore_library'] = array(
	'type'        => 'text',
	'page'        => 'wpeditormd',
	'tab'         => 'sequence',
	'title'       => __( 'Underscore Library', 'editormd' ),
	'subtitle'    => __( '', 'editormd' ),
	'description' => __( '', 'editormd' ),
	'default'     => WP_EDITORMD_PLUGIN_URL . '/Underscore'
);

$options['sequence_style'] = array(
	'type'        => 'select',
	'page'        => 'wpeditormd',
	'tab'         => 'sequence',
	'title'       => __( 'Sequence Style', 'editormd' ),
	'description' => __( 'Change the sequence style', 'editormd' ),
	'options'     => array(
		'simple' => __( 'simple', 'editormd' ),
		'hand'    => __( 'hand', 'editormd' )
	),
	'default'     => 'simple'
);

//================================

$options['other_one'] = array(
	'title'       => __( 'Use documentation', 'editormd' ),
	'page'        => 'wpeditormd',
	'tab'         => 'other',
	'description' => '<a class="other_one" href="' . WP_EDITORMD_PLUGIN_URL . '/Document/use-zh_CN.php' . '" rel="nofollow" target="_blank">' . __( 'Go', 'editormd' ) . '</a>'
);

// Register options
paf_options( $options );
