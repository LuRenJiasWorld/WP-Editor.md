<?php

/**
 * 定义选项
 * @Author: JaxsonWang
 */

$options = array();

$options['support_comment'] = array(
	'title'       => __( 'Use Markdown For Comments', 'iiong' ),
	'page'        => 'wpeditormd',
	'tab'         => 'basic',
	'description' => '<a class="support_comment" href="' . admin_url( 'options-discussion.php#wpcom_publish_comments_with_markdown' ) . '" rel="nofollow" target="_blank">' . __( 'Go', 'iiong' ) . '</a>'
);

$options['jquery_library'] = array(
	'type'        => 'text',
	'page'        => 'wpeditormd',
	'tab'         => 'basic',
	'title'       => __( 'jQuery Library', 'iiong' ),
	'subtitle'    => __( '', 'iiong' ),
	'description' => __( 'jQuery resource load library address', 'iiong' ),
	'default'     => WP_EDITORMD_PLUGIN_URL . '/jQuery'
);

$options['raphael_library'] = array(
	'type'        => 'text',
	'page'        => 'wpeditormd',
	'tab'         => 'basic',
	'title'       => __( 'Raphael Library', 'iiong' ),
	'subtitle'    => __( '', 'iiong' ),
	'description' => __( 'Raphael resource load library address(<code>FlowChart</code> and <code>Sequence</code> depend on this option)', 'iiong' ),
	'default'     => WP_EDITORMD_PLUGIN_URL . '/Raphael'
);

//================================

$options['theme_style'] = array(
	'type'        => 'select',
	'page'        => 'wpeditormd',
	'tab'         => 'style',
	'title'       => __( 'Editor Theme Style', 'iiong' ),
	'description' => __( 'Change the editor theme style', 'iiong' ),
	'options'     => array(
		'default' => __( 'default', 'iiong' ),
		'dark'    => __( 'dark', 'iiong' )
	),
	'default'     => 'default'
);

$options['code_style'] = array(
	'type'        => 'select',
	'page'        => 'wpeditormd',
	'tab'         => 'style',
	'title'       => __( 'Code Theme Style', 'iiong' ),
	'description' => __( 'Change the code theme style in the editor', 'iiong' ),
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
	'title'       => __( 'Support Task Lists', 'iiong' ),
	'subtitle'    => __( '', 'iiong' ),
	'description' => __( 'Github Flavored Markdown task lists', 'iiong' ),
	'options'     => array(
		'0' => __( 'Off', 'iiong' ),
		'1' => __( 'On', 'iiong' ),
	),
	'default'     => '0'
);

$options['imagepaste'] = array(
	'type'        => 'radio',
	'page'        => 'wpeditormd',
	'tab'         => 'function',
	'title'       => __( 'Support Image Paste', 'iiong' ),
	'subtitle'    => __( '', 'iiong' ),
	'description' => __( 'Image Paste allows you to copy and paste images from your desktop to the editor', 'iiong' ),
	'options'     => array(
		'0' => __( 'Off', 'iiong' ),
		'1' => __( 'On', 'iiong' ),
	),
	'default'     => '0'
);

$options['live_preview'] = array(
	'type'        => 'radio',
	'page'        => 'wpeditormd',
	'tab'         => 'function',
	'title'       => __( 'Default live preview', 'iiong' ),
	'subtitle'    => __( '', 'iiong' ),
	'description' => __( 'Default to open the editor live preview', 'iiong' ),
	'options'     => array(
		'0' => __( 'Off', 'iiong' ),
		'1' => __( 'On', 'iiong' ),
	),
	'default'     => '1'
);

$options['sync_scrolling'] = array(
	'type'        => 'radio',
	'page'        => 'wpeditormd',
	'tab'         => 'function',
	'title'       => __( 'Default sync scrolling', 'iiong' ),
	'subtitle'    => __( '', 'iiong' ),
	'description' => __( 'The editor and the preview editor are synchronized to scroll', 'iiong' ),
	'options'     => array(
		'0' => __( 'Off', 'iiong' ),
		'1' => __( 'On', 'iiong' ),
	),
	'default'     => '1'
);

$options['html_decode'] = array(
	'type'        => 'radio',
	'page'        => 'wpeditormd',
	'tab'         => 'function',
	'title'       => __( 'Support Html Decode', 'iiong' ),
	'subtitle'    => __( '', 'iiong' ),
	'description' => __( 'Support rich text analysis', 'iiong' ),
	'options'     => array(
		'0' => __( 'Off', 'iiong' ),
		'1' => __( 'On', 'iiong' ),
	),
	'default'     => '0'
);

//================================

$options['support_highlight'] = array(
	'type'        => 'radio',
	'page'        => 'wpeditormd',
	'tab'         => 'prism',
	'title'       => __( 'Support Prism Syntax Highlight', 'iiong' ),
	'subtitle'    => __( '', 'iiong' ),
	'description' => __( 'Article support syntax highlighting', 'iiong' ),
	'options'     => array(
		'0' => __( 'Off', 'iiong' ),
		'1' => __( 'On', 'iiong' ),
	),
	'default'     => '0'
);

$options['highlight_mode'] = array(
	'type'        => 'radio',
	'page'        => 'wpeditormd',
	'tab'         => 'prism',
	'title'       => __( 'Syntax highlighting mode', 'iiong' ),
	'subtitle'    => __( '', 'iiong' ),
	'description' => __( 'According to your preferences to select the corresponding loading mode', 'iiong' ),
	'options'     => array(
		'auto' => __( 'Auto load mode', 'iiong' ),
		'customize' => __( 'Customize mode', 'iiong' ),
	),
	'default'     => 'auto'
);

$options['line_numbers'] = array(
	'type'        => 'radio',
	'page'        => 'wpeditormd',
	'tab'         => 'prism',
	'title'       => __( 'Support Prism Syntax Highlight Line Numbers', 'iiong' ),
	'subtitle'    => __( '', 'iiong' ),
	'description' => __( '', 'iiong' ),
	'options'     => array(
		'0' => __( 'Off', 'iiong' ),
		'1' => __( 'On', 'iiong' ),
	),
	'default'     => '0'
);

$options['highlight_library'] = array(
	'type'        => 'text',
	'page'        => 'wpeditormd',
	'tab'         => 'prism',
	'title'       => __( 'PrismJS Syntax Highlight Library', 'iiong' ),
	'subtitle'    => __( '', 'iiong' ),
	'description' => __( 'PrismJS resource load library address', 'iiong' ),
	'default'     => WP_EDITORMD_PLUGIN_URL . '/Prism'
);

$options['highlight_library_style'] = array(
	'type'        => 'select',
	'page'        => 'wpeditormd',
	'tab'         => 'prism',
	'title'       => __( 'PrismJS Syntax Highlight Style', 'iiong' ),
	'description' => __( 'Syntax highlight theme style', 'iiong' ),
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
	'title'       => __( 'PrismJS Syntax Highlight Style Library', 'iiong' ),
	'subtitle'    => __( '', 'iiong' ),
	'description' => __( 'PrismJS resource customize load library address', 'iiong' ),
	'default'     => WP_EDITORMD_PLUGIN_URL . '/Prism/customize/prism.css'
);

$options['customize_highlight_javascript'] = array(
	'type'        => 'text',
	'page'        => 'wpeditormd',
	'tab'         => 'prism',
	'title'       => __( 'PrismJS Syntax Highlight JavaScript Library', 'iiong' ),
	'subtitle'    => __( '', 'iiong' ),
	'description' => __( 'PrismJS resource customize load library address', 'iiong' ),
	'default'     => WP_EDITORMD_PLUGIN_URL . '/Prism/customize/prism.js'
);

//================================

$options['support_emoji'] = array(
	'type'        => 'radio',
	'page'        => 'wpeditormd',
	'tab'         => 'emoji',
	'title'       => __( 'Support Emoji', 'iiong' ),
	'subtitle'    => __( '', 'iiong' ),
	'description' => __( '', 'iiong' ),
	'options'     => array(
		'0' => __( 'Off', 'iiong' ),
		'1' => __( 'On', 'iiong' ),
	),
	'default'     => '0'
);

$options['emoji_library'] = array(
	'type'        => 'text',
	'page'        => 'wpeditormd',
	'tab'         => 'emoji',
	'title'       => __( 'Emoji Library', 'iiong' ),
	'subtitle'    => __( '', 'iiong' ),
	'description' => __( 'Emoji resource load library address', 'iiong' ),
	'default'     => WP_EDITORMD_PLUGIN_URL . '/Emojify.js'
);

//================================

$options['support_toc'] = array(
	'type'        => 'radio',
	'page'        => 'wpeditormd',
	'tab'         => 'toc',
	'title'       => __( 'Support ToC', 'iiong' ),
	'subtitle'    => __( '', 'iiong' ),
	'description' => __( 'Table of Contents', 'iiong' ),
	'options'     => array(
		'0' => __( 'Off', 'iiong' ),
		'1' => __( 'On', 'iiong' ),
	),
	'default'     => '0'
);

$options['toc_tips'] = array(
	'title'       => __( 'You need install the plugin', 'iiong' ),
	'page'        => 'wpeditormd',
	'tab'         => 'toc',
	'description' => '<a class="toc_tips" href="' . get_option( 'home' ) . '/wp-admin/plugin-install.php?tab=plugin-information&plugin=table-of-contents-plus&TB_iframe=true" rel="nofollow" target="_blank">' . __( 'If you need to enable this option,you need install the plugin', 'editormd' ) . '</a>'
);

//================================

$options['support_katex'] = array(
	'type'        => 'radio',
	'page'        => 'wpeditormd',
	'tab'         => 'katex',
	'title'       => __( 'Support LaTeX', 'iiong' ),
	'subtitle'    => __( '', 'iiong' ),
	'description' => __( '', 'iiong' ),
	'options'     => array(
		'0' => __( 'Off', 'iiong' ),
		'1' => __( 'On', 'iiong' ),
	),
	'default'     => '0'
);

$options['katex_library'] = array(
	'type'        => 'text',
	'page'        => 'wpeditormd',
	'tab'         => 'katex',
	'title'       => __( 'KaTeX Library', 'iiong' ),
	'subtitle'    => __( '', 'iiong' ),
	'description' => __( 'KaTeX resource load library address', 'iiong' ),
	'default'     => WP_EDITORMD_PLUGIN_URL . '/KaTeX'
);

//================================

$options['support_flowchart'] = array(
	'type'        => 'radio',
	'page'        => 'wpeditormd',
	'tab'         => 'flowchart',
	'title'       => __( 'Support FlowChart', 'iiong' ),
	'subtitle'    => __( '', 'iiong' ),
	'description' => __( '', 'iiong' ),
	'options'     => array(
		'0' => __( 'Off', 'iiong' ),
		'1' => __( 'On', 'iiong' ),
	),
	'default'     => '0'
);

$options['flowchart_library'] = array(
	'type'        => 'text',
	'page'        => 'wpeditormd',
	'tab'         => 'flowchart',
	'title'       => __( 'FlowChart Library', 'iiong' ),
	'subtitle'    => __( '', 'iiong' ),
	'description' => __( 'FlowChart resource load library address', 'iiong' ),
	'default'     => WP_EDITORMD_PLUGIN_URL . '/FlowChart'
);

$options['flowchart_config'] = array(
	'type'        => 'text',
	'page'        => 'wpeditormd',
	'tab'         => 'flowchart',
	'title'       => __( 'jQuery FlowChart Config', 'iiong' ),
	'subtitle'    => __( '', 'iiong' ),
	'description' => __( 'Config resource load library address', 'iiong' ),
	'default'     => WP_EDITORMD_PLUGIN_URL . '/FlowChart'
);

//================================

$options['support_sequence'] = array(
	'type'        => 'radio',
	'page'        => 'wpeditormd',
	'tab'         => 'sequence',
	'title'       => __( 'Support Sequence', 'iiong' ),
	'subtitle'    => __( '', 'iiong' ),
	'description' => __( '', 'iiong' ),
	'options'     => array(
		'0' => __( 'Off', 'iiong' ),
		'1' => __( 'On', 'iiong' ),
	),
	'default'     => '0'
);

$options['sequence_library'] = array(
	'type'        => 'text',
	'page'        => 'wpeditormd',
	'tab'         => 'sequence',
	'title'       => __( 'Sequence Library', 'iiong' ),
	'subtitle'    => __( '', 'iiong' ),
	'description' => __( 'Sequence resource load library address', 'iiong' ),
	'default'     => WP_EDITORMD_PLUGIN_URL . '/Sequence'
);

$options['underscore_library'] = array(
	'type'        => 'text',
	'page'        => 'wpeditormd',
	'tab'         => 'sequence',
	'title'       => __( 'Underscore Library', 'iiong' ),
	'subtitle'    => __( '', 'iiong' ),
	'description' => __( 'Underscore resource load library address', 'iiong' ),
	'default'     => WP_EDITORMD_PLUGIN_URL . '/Underscore'
);

//================================

$options['other_one'] = array(
	'title'       => __( 'Use documentation', 'iiong' ),
	'page'        => 'wpeditormd',
	'tab'         => 'other',
	'description' => '<a class="other_one" href="' . WP_EDITORMD_PLUGIN_URL . '/Document/use-zh_CN.php' . '" rel="nofollow" target="_blank">' . __( 'Go', 'iiong' ) . '</a>'
);

// Register options
paf_options( $options );
