<?php
/**
 * ReduxFramework配置文件
 * 完整实例文档，请访问: http://docs.reduxframework.com/
 */

if ( ! class_exists( 'Redux' ) ) {
	return;
}


// 存储所有Redux数据的选项名称
$opt_name = "editor";

// 此行仅用于展示数据，可以删除
//$opt_name = apply_filters( 'editor/opt_name', $opt_name );

$args = array(
	// TYPICAL -> Change these values as you need/desire
	'opt_name'            => $opt_name,
	// This is where your data is stored in the database and also becomes your global variable name.
	'display_name'        => "WordPress Editor.md",
	// Name that appears at the top of your panel
	'display_version'     => WP_EDITORMD_PLUGIN_VERSION,
	// Version that appears at the top of your panel
	'menu_type'           => 'submenu',
	//Specify if the admin menu should appear or not. Options: menu or submenu (Under appearance only)
	'allow_sub_menu'      => true,
	// Show the sections below the admin menu item or not
	'menu_title'          => __( 'Editor.md', 'editormd' ),
	'page_title'          => __( 'Editor.md', 'editormd' ),
	// Must be defined to add google fonts to the typography module
	'async_typography'    => true,
	// Use a asynchronous font on the front end or font string
	//'disable_google_fonts_link' => true,
	// Disable this in case you want to create your own google fonts loader
	'admin_bar'           => false,
	// Show the panel pages on the admin bar
	'admin_bar_icon'      => 'dashicons-portfolio',
	// Choose an icon for the admin bar menu
	'admin_bar_priority'  => 50,
	// Choose an priority for the admin bar menu
	'global_variable'     => 'editormd_inlobase',
	// Set a different name for your global variable other than the opt_name
	'dev_mode'            => false,
	// Show the time the page took to load, etc
	'update_notice'       => false,
	// If dev_mode is enabled, will notify developer of updated versions available in the GitHub Repo
	'customizer'          => true,
	// Enable basic customizer support
	//'open_expanded'     => true,                    // Allow you to start the panel in an expanded way initially.
	//'disable_save_warn' => true,                    // Disable the save warning when a user changes a field

	// OPTIONAL -> Give you extra features
	'page_priority'       => null,
	// Order where the menu appears in the admin area. If there is any conflict, something will not show. Warning.
	'page_parent'         => 'options-general.php',
	// For a full list of options, visit: http://codex.wordpress.org/Function_Reference/add_submenu_page#Parameters
	'page_permissions'    => 'manage_options',
	// Permissions needed to access the options panel.
	'menu_icon'           => '',
	// Specify a custom URL to an icon
	'last_tab'            => '',
	// Force your panel to always open to a specific tab (by id)
	'page_icon'           => 'icon-themes',
	// Icon displayed in the admin panel next to your menu_title
	'page_slug'           => '',
	// Page slug used to denote the panel, will be based off page title then menu title then opt_name if not provided
	'save_defaults'       => true,
	// On load save the defaults to DB before user clicks save or not
	'default_show'        => false,
	// If true, shows the default value next to each field that is not the default value.
	'default_mark'        => '',
	// What to print by the field's title if the value shown is default. Suggested: *
	'show_import_export'  => true,
	// Shows the Import/Export panel when not used as a field.
	'show_options_object' => false,
	//关闭options object选项卡
	// CAREFUL -> These options are for advanced use only
	'transient_time'      => 60 * MINUTE_IN_SECONDS,
	'output'              => true,
	// Global shut-off for dynamic CSS output by the framework. Will also disable google fonts output
	'output_tag'          => true,
	// Allows dynamic CSS to be generated for customizer and google fonts, but stops the dynamic CSS from going to the head
	// 'footer_credit'     => '',                   // Disable the footer credit of Redux. Please leave if you can help it.

	// FUTURE -> Not in use yet, but reserved or partially implemented. Use at your own risk.
	'database'            => '',
	// possible: options, theme_mods, theme_mods_expanded, transient. Not fully functional, warning!
	'use_cdn'             => false,
	// If you prefer not to use the CDN for Select2, Ace Editor, and others, you may download the Redux Vendor Support plugin yourself and run locally or embed it in your code.

	// HINTS
	'hints'               => array(
		'icon'          => 'el el-question-sign',
		'icon_position' => 'right',
		'icon_color'    => 'lightgray',
		'icon_size'     => 'normal',
		'tip_style'     => array(
			'color'   => 'red',
			'shadow'  => true,
			'rounded' => false,
			'style'   => '',
		),
		'tip_position'  => array(
			'my' => 'top left',
			'at' => 'bottom right',
		),
		'tip_effect'    => array(
			'show' => array(
				'effect'   => 'slide',
				'duration' => '500',
				'event'    => 'mouseover',
			),
			'hide' => array(
				'effect'   => 'slide',
				'duration' => '500',
				'event'    => 'click mouseleave',
			),
		),
	)
);

// Panel Intro text -> before the form
if ( ! isset( $args['global_variable'] ) || $args['global_variable'] !== false ) {
	if ( ! empty( $args['global_variable'] ) ) {
		$v = $args['global_variable'];
	} else {
		$v = str_replace( '-', '_', $args['opt_name'] );
	}
	$args['intro_text'] = sprintf( __( '<p>Did you know that Redux sets a global variable for you? To access any of your saved options from within your code you can use your global variable: <strong>$%1$s</strong></p>', 'redux-framework-demo' ), $v );
} else {
	$args['intro_text'] = __( '<p>This text is displayed above the options panel. It isn\'t required, but more info is always better! The intro_text field accepts all HTML.</p>', 'redux-framework-demo' );
}

// Add content after the form.
$args['footer_text'] = __( '<p>This text is displayed below the options panel. It isn\'t required, but more info is always better! The footer_text field accepts all HTML.</p>', 'redux-framework-demo' );

Redux::setArgs( $opt_name, $args );

/*
 * ---> END ARGUMENTS
 */


/*
 *
 * ---> START SECTIONS
 *
 */

/*

	As of Redux 3.5+, there is an extensive API. This API can be used in a mix/match mode allowing for


 */

// -> START Basic Fields
Redux::setSection( $opt_name, array(
	'title' => __( 'Editor Settings', 'editormd' ),
	'id'    => 'basic',
	'desc'  => __( '', 'editormd' ),
	'icon'  => 'el el-home'
) );

Redux::setSection( $opt_name, array(
	'title'      => __( 'Base Settings', 'editormd' ),
	'id'         => 'base_settings',
	'subsection' => true,
	'desc'       => __( '', 'editormd' ),
	'fields'     => array(
		array(
			'id'         => 'support_comment',
			'type'       => 'raw',
			'full_width' => false,
			'title'      => __( 'Use Markdown For Comments', 'editormd' ),
			'subtitle'   => __( '', 'editormd' ),
			'content'    => '<a href="' . admin_url( 'options-discussion.php#wpcom_publish_comments_with_markdown' ) . '" target="_blank">' . __( 'Go', 'editormd' ) . '</a>',
			'desc'       => __( '', 'editormd' )
		),
		array(
			'id'       => 'support_jquery_library',
			'type'     => 'text',
			'title'    => __( 'jQuery Library', 'editormd' ),
			'subtitle' => __( '', 'editormd' ),
			'desc'     => __( 'jQuery resource load library address', 'editormd' ),
			'default'  => WP_EDITORMD_PLUGIN_URL . '/jQuery'
		),
		array(
			'id'       => 'support_raphael_library',
			'type'     => 'text',
			'title'    => __( 'Raphael Library', 'editormd' ),
			'subtitle' => __( '', 'editormd' ),
			'desc'     => __( 'Raphael resource load library address(<code>FlowChart</code> and <code>Sequence</code> depend on this option)', 'editormd' ),
			'default'  => WP_EDITORMD_PLUGIN_URL . '/Raphael'
		)
	)
) );

Redux::setSection( $opt_name, array(
	'title'      => __( 'Style Settings', 'editormd' ),
	'id'         => 'style_settings',
	'subsection' => true,
	'desc'       => __( '', 'editormd' ),
	'fields'     => array(
		array(
			'id'       => 'theme_style',
			'type'     => 'select',
			'title'    => __( 'Editor Theme Style', 'editormd' ),
			'subtitle' => __( '', 'editormd' ),
			'desc'     => __( 'Change the editor theme style', 'editormd' ),
			'options'  => array(
				'default' => 'default',
				'dark'    => 'dark'
			),
			'default'  => 'default'
		),
		array(
			'id'       => 'code_style',
			'type'     => 'select',
			'title'    => __( 'Code Theme Style', 'editormd' ),
			'subtitle' => __( '', 'editormd' ),
			'desc'     => __( 'Change the code theme style in the editor', 'editormd' ),
			'options'  => array(
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
			'default'  => 'default'
		)
	)
) );

Redux::setSection( $opt_name, array(
	'title'      => __( 'Function Settings', 'editormd' ),
	'id'         => 'function_settings',
	'subsection' => true,
	'desc'       => __( '', 'editormd' ),
	'fields'     => array(
		array(
			'id'       => 'task_list',
			'type'     => 'checkbox',
			'title'    => __( 'Support Task Lists', 'editormd' ),
			'subtitle' => __( '', 'editormd' ),
			'desc'     => __( 'Github Flavored Markdown task lists', 'editormd' ),
			'default'  => '0'// 1 = on | 0 = off
		),
		array(
			'id'       => 'support_toc',
			'type'     => 'checkbox',
			'title'    => __( 'Support ToC', 'editormd' ),
			'subtitle' => __( '', 'editormd' ),
			'desc'     => __( 'Table of Contents', 'editormd' ),
			'default'  => '0'// 1 = on | 0 = off
		),
		array(
			'id'       => 'support_imagepaste',
			'type'     => 'checkbox',
			'title'    => __( 'Support Image Paste', 'editormd' ),
			'subtitle' => __( '', 'editormd' ),
			'desc'     => __( 'Image Paste allows you to copy and paste images from your desktop to the editor', 'editormd' ),
			'default'  => '0'// 1 = on | 0 = off
		),
		array(
			'id'       => 'support_sync_scrolling',
			'type'     => 'checkbox',
			'title'    => __( 'Support Sync Scrolling', 'editormd' ),
			'subtitle' => __( '', 'editormd' ),
			'desc'     => __( 'The editor and the preview editor are synchronized to scroll', 'editormd' ),
			'default'  => '1'// 1 = on | 0 = off
		),
		array(
			'id'       => 'support_html_decode',
			'type'     => 'checkbox',
			'title'    => __( 'Support Html Decode', 'editormd' ),
			'subtitle' => __( '', 'editormd' ),
			'desc'     => __( 'Support rich text analysis', 'editormd' ),
			'default'  => '0'// 1 = on | 0 = off
		)
	)
) );

Redux::setSection( $opt_name, array(
	'title'      => __( 'Prism Settings', 'editormd' ),
	'id'         => 'prism_settings',
	'subsection' => true,
	'desc'       => __( 'Prism is a lightweight, robust, elegant syntax highlighting library', 'editormd' ),
	'fields'     => array(
		array(
			'id'       => 'support_highlight',
			'type'     => 'checkbox',
			'title'    => __( 'Support Syntax Highlightjs', 'editormd' ),
			'subtitle' => __( '', 'editormd' ),
			'desc'     => __( 'Article support syntax highlighting (not editor support syntax highlighting)', 'editormd' ),
			'default'  => '0'// 1 = on | 0 = off
		),
		array(
			'id'       => 'support_highlight_line_numbers',
			'type'     => 'checkbox',
			'title'    => __( 'PrismJS Line Numbers', 'editormd' ),
			'subtitle' => __( '', 'editormd' ),
			'desc'     => __( '', 'editormd' ),
			'default'  => '0'// 1 = on | 0 = off
		),
		array(
			'id'       => 'support_highlight_library',
			'type'     => 'text',
			'title'    => __( 'PrismJS Highlightjs Library', 'editormd' ),
			'subtitle' => __( '', 'editormd' ),
			'desc'     => __( 'PrismJS resource load library address', 'editormd' ),
			'default'  => WP_EDITORMD_PLUGIN_URL . '/Prism'
		),
		array(
			'id'       => 'support_highlight_library_style',
			'type'     => 'select',
			'title'    => __( 'PrismJS Highlightjs Style', 'editormd' ),
			'subtitle' => __( '', 'editormd' ),
			'desc'     => __( 'Syntax highlight theme style', 'editormd' ),
			'options'  => array(
				'default'        => 'default',
				'dark'           => 'dark',
				'funky'          => 'funky',
				'okaidia'        => 'okaidia',
				'twilight'       => 'twilight',
				'coy'            => 'coy',
				'solarizedlight' => 'solarizedlight'
			),
			'default'  => 'default'
		)
	)
) );

Redux::setSection( $opt_name, array(
	'title'      => __( 'Emoji Settings', 'editormd' ),
	'id'         => 'emoji_settings',
	'subsection' => true,
	'desc'       => __( '', 'editormd' ),
	'fields'     => array(
		array(
			'id'       => 'support_emoji',
			'type'     => 'checkbox',
			'title'    => __( 'Support Emoji', 'editormd' ),
			'subtitle' => __( '', 'editormd' ),
			'desc'     => __( '', 'editormd' ),
			'default'  => '0'// 1 = on | 0 = off
		),
		array(
			'id'       => 'support_emoji_library',
			'type'     => 'text',
			'title'    => __( 'Emoji Library', 'editormd' ),
			'subtitle' => __( '', 'editormd' ),
			'desc'     => __( 'Emoji resource load library address', 'editormd' ),
			'default'  => WP_EDITORMD_PLUGIN_URL . '/Emojify.js'
		)
	)
) );

Redux::setSection( $opt_name, array(
	'title'      => __( 'LaTeX Settings', 'editormd' ),
	'id'         => 'latex_settings',
	'subsection' => true,
	'desc'       => __( '', 'editormd' ),
	'fields'     => array(
		array(
			'id'       => 'support_latex',
			'type'     => 'checkbox',
			'title'    => __( 'Support LaTeX', 'editormd' ),
			'subtitle' => __( '', 'editormd' ),
			'desc'     => __( '', 'editormd' ),
			'default'  => '0'// 1 = on | 0 = off
		),
		array(
			'id'       => 'support_latex_library',
			'type'     => 'text',
			'title'    => __( 'KaTeX Library', 'editormd' ),
			'subtitle' => __( '', 'editormd' ),
			'desc'     => __( 'KaTeX resource load library address', 'editormd' ),
			'default'  => WP_EDITORMD_PLUGIN_URL . '/KaTeX'
		)
	)
) );

Redux::setSection( $opt_name, array(
	'title'      => __( 'FlowChart Settings', 'editormd' ),
	'id'         => 'flowchart_settings',
	'subsection' => true,
	'desc'       => __( '', 'editormd' ),
	'fields'     => array(
		array(
			'id'       => 'support_flowchart',
			'type'     => 'checkbox',
			'title'    => __( 'Support FlowChart', 'editormd' ),
			'subtitle' => __( '', 'editormd' ),
			'desc'     => __( '', 'editormd' ),
			'default'  => '0'// 1 = on | 0 = off
		),
		array(
			'id'       => 'support_flowchart_library',
			'type'     => 'text',
			'title'    => __( 'FlowChart Library', 'editormd' ),
			'subtitle' => __( '', 'editormd' ),
			'desc'     => __( 'FlowChart resource load library address', 'editormd' ),
			'default'  => WP_EDITORMD_PLUGIN_URL . '/FlowChart'
		),
		array(
			'id'       => 'support_jquery_flowchart_library',
			'type'     => 'text',
			'title'    => __( 'jQuery FlowChart Library', 'editormd' ),
			'subtitle' => __( '', 'editormd' ),
			'desc'     => __( 'jQuery FlowChart resource load library address', 'editormd' ),
			'default'  => WP_EDITORMD_PLUGIN_URL . '/FlowChart'
		)
	)
) );

Redux::setSection( $opt_name, array(
	'title'      => __( 'Sequence Settings', 'editormd' ),
	'id'         => 'sequence_settings',
	'subsection' => true,
	'desc'       => __( '', 'editormd' ),
	'fields'     => array(
		array(
			'id'       => 'support_sequence',
			'type'     => 'checkbox',
			'title'    => __( 'Support Sequence', 'editormd' ),
			'subtitle' => __( '', 'editormd' ),
			'desc'     => __( '', 'editormd' ),
			'default'  => '0'// 1 = on | 0 = off
		),
		array(
			'id'       => 'support_sequence_library',
			'type'     => 'text',
			'title'    => __( 'Sequence Library', 'editormd' ),
			'subtitle' => __( '', 'editormd' ),
			'desc'     => __( 'Sequence resource load library address', 'editormd' ),
			'default'  => WP_EDITORMD_PLUGIN_URL . '/Sequence'
		),
		array(
			'id'       => 'support_underscore_library',
			'type'     => 'text',
			'title'    => __( 'Underscore Library', 'editormd' ),
			'subtitle' => __( '', 'editormd' ),
			'desc'     => __( 'Underscore resource load library address', 'editormd' ),
			'default'  => WP_EDITORMD_PLUGIN_URL . '/Underscore'
		)
	)
) );

//if ( file_exists( dirname( __FILE__ ) . '/../README.md' ) ) {
//	$section = array(
//		'icon'   => 'el el-list-alt',
//		'title'  => __( 'Documentation', 'redux-framework-demo' ),
//		'fields' => array(
//			array(
//				'id'           => '17',
//				'type'         => 'raw',
//				'markdown'     => true,
//				'content_path' => dirname( __FILE__ ) . '/../README.md', // FULL PATH, not relative please
//				//'content' => 'Raw content here',
//			),
//		),
//	);
//	Redux::setSection( $opt_name, $section );
//}
