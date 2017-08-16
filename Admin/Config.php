<?php
/**
 * ReduxFramework配置文件
 * 完整实例文档，请访问: http://docs.reduxframework.com/
 */

if ( ! class_exists( 'Redux' ) ) {
	return;
}


// 存储所有Redux数据的选项名称
$opt_name = "editormd";

// 此行仅用于展示数据，可以删除
//$opt_name = apply_filters( 'editor/opt_name', $opt_name );

$args = array(
	//这是数据存储在数据库中的地方，也是全局变量名称
	'opt_name'            => $opt_name,
	//显示在控制面板的名称
	'display_name'        => "WordPress Editor.md",
	//显示在面板顶部的版本
	'display_version'     => WP_EDITORMD_PLUGIN_VERSION,
	//指定管理菜单是否出现。 选项：菜单或子菜单（仅在外观下）
	'menu_type'           => 'submenu',
	//显示管理员菜单项下面的部分
	'allow_sub_menu'      => true,
	//
	'menu_title'          => __( 'Editor.md', 'editormd' ),
	'page_title'          => __( 'Editor.md', 'editormd' ),
	//在前端使用异步字体或字体字符串
	'async_typography'    => true,
	//如果您想要创建自己的谷歌字体加载程序，请禁用此选项
	//'disable_google_fonts_link' => true,
	//显示管理栏上的面板页面
	'admin_bar'           => false,
	//选择管理员菜单的图标
	'admin_bar_icon'      => 'dashicons-portfolio',
	//选择管理员菜单的优先级
	'admin_bar_priority'  => 50,
	//为opt_name之外的全局变量设置不同的名称
	'global_variable'     => 'editormd_inlobase',
	//如果启用了dev_mode，将通知开发人员GitHub Repo中可用的更新版本
	'dev_mode'            => false,
	'update_notice'       => false,
	//启用基本的定制器支持
	'customizer'          => true,
	// Enable basic customizer support
	//允许您最初以扩展的方式启动面板。
	//'open_expanded'     => true,
	//当用户更改字段时，禁用保存警告
	//'disable_save_warn' => true,

	// OPTIONAL -> Give you extra features
	//在菜单出现在管理区域的顺序
	'page_priority'       => null,
	'page_parent'         => 'options-general.php',
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
	// Shows the Import/Export panel when not used as a field.
	'show_import_export'  => true,
	//关闭options object选项卡
	'show_options_object' => false,
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
);

$args['footer_text'] = __( '', 'editormd' );

Redux::setArgs( $opt_name, $args );

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
