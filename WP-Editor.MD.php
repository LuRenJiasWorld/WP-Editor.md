<?php
/**
 * Plugin Name: WP Editor.md
 * Plugin URI: https://iiong.com/wordpress-plugins-wp-editormd.html
 * Description: 或许这是一个WordPress中最好，最完美的Markdown编辑器。
 * Version: 3.0
 * Author: 淮城一只猫
 * Author URI: https://iiong.com/
 * License: GPLv3 or later
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	die;
}

if ( get_option( 'editormd_options' ) ) {
	delete_option( 'editormd_options' );
}

define( 'WP_EDITORMD_PLUGIN_VERSION', '3.0' ); //版本说明
define( 'WP_EDITORMD_PLUGIN_URL', plugins_url( '', __FILE__ ) ); //插件资源路径
define( 'WP_EDITORMD_PLUGIN_PATH', dirname( __FILE__ ) ); //插件路径文件夹

//获取数据
$editormd_inlobase = get_option( 'editormd' );

//引入jetpack解析库
if ( ! function_exists( 'jetpack_require_lib_editormd' ) ) {
	require WP_EDITORMD_PLUGIN_PATH . '/Jetpack/require-lib.php';
}

//引入jetpack markdown库
if ( ! class_exists( 'WPCom_Markdown' ) ) {
	require WP_EDITORMD_PLUGIN_PATH . '/Jetpack/markdown/easy-markdown.php';
}

//引入TaskList库
if ( isset( $editormd_inlobase['support_task_list'] ) && $editormd_inlobase['support_task_list'] == 1 ) {
	if ( ! function_exists( 'taskList_markup' ) ) {
		require WP_EDITORMD_PLUGIN_PATH . '/Jetpack/taskList/taskList.php';
	}
}

//引入jetpack LaTeX库
if ( isset( $editormd_inlobase['support_latex'] ) && $editormd_inlobase['support_latex'] == 1 ) {
	if ( ! function_exists( 'latex_markup' ) ) {
		require WP_EDITORMD_PLUGIN_PATH . '/Jetpack/latex/latex.php';
	}
}

//引入FlowChart库
if ( isset( $editormd_inlobase['support_flowchart'] ) && $editormd_inlobase['support_flowchart'] == 1 ) {
	if ( ! function_exists( 'flow_markup' ) ) {
		require WP_EDITORMD_PLUGIN_PATH . '/Jetpack/flowchart/flowchart.php';
	}
}

//引入Sequence库
if ( isset( $editormd_inlobase['support_sequence'] ) && $editormd_inlobase['support_sequence'] == 1 ) {
	if ( ! function_exists( 'seq_markup' ) ) {
		require WP_EDITORMD_PLUGIN_PATH . '/Jetpack/sequence/sequence.php';
	}
}

//前端语法高亮处理函数
if ( isset( $editormd_inlobase['support_highlight'] ) && $editormd_inlobase['support_highlight'] == 1 ) {
	if ( ! class_exists( 'editormd_prismjs' ) ) {
		require WP_EDITORMD_PLUGIN_PATH . '/editormd_prismjs.php';
	}
}

//引入快捷图片上传函数库
if ( isset( $editormd_inlobase['support_imagepaste'] ) && $editormd_inlobase['support_imagepaste'] == 1 ) {
	if ( ! class_exists( 'editormd_imagepaste' ) ) {
		require WP_EDITORMD_PLUGIN_PATH . '/editormd_imagepaste.php';
	}
}

//引入资源模板
if ( ! class_exists( 'editormd' ) ) {
	require WP_EDITORMD_PLUGIN_PATH . '/editormd_class.php';
}

//引入设置页面
if ( ! class_exists( 'ReduxFramework' ) && file_exists( dirname( __FILE__ ) . '/admin/ReduxCore/framework.php' ) ) {
	require_once( dirname( __FILE__ ) . '/Admin/ReduxCore/framework.php' );
}
if ( ! isset( $editor ) && file_exists( dirname( __FILE__ ) . '/admin/Config.php' ) ) {
	require_once( dirname( __FILE__ ) . '/Admin/Config.php' );
}

if ( ! class_exists( 'ReduxFramework_extension_vendor_support' ) ) {
	if ( file_exists( dirname( __FILE__ ) . '/Admin/ReduxVendorSupport/extension_vendor_support.php' ) ) {
		require dirname( __FILE__ ) . '/Admin/ReduxVendorSupport/extension_vendor_support.php';
		new ReduxFramework_extension_vendor_support();
	}
}

add_action( 'personal_options_update', array( $editormd, 'user_personalopts_update' ) );
add_action( 'admin_head', array( $editormd, 'add_admin_head' ) );
add_action( 'edit_form_advanced', array( $editormd, 'load_editormd' ) );
add_action( 'edit_page_form', array( $editormd, 'load_editormd' ) );
add_action( 'simple_edit_form', array( $editormd, 'load_editormd' ) );
add_action( 'admin_print_styles', array( $editormd, 'add_admin_style' ) );
add_action( 'admin_print_scripts', array( $editormd, 'add_admin_js' ) );
add_action( 'admin_init', array( $editormd, 'editormd_jetpack_markdown_posting_always_on' ), 11 );
add_action( 'plugins_loaded', array( $editormd, 'editormd_init_languages' ) );
add_action( 'plugins_loaded', array( $editormd, 'editormd_jetpack_markdown_load_textdomain' ) );
add_filter( 'pre_option_' . WPCom_Markdown::POST_OPTION, '__return_true' );
add_filter( 'plugin_action_links_' . plugin_basename( __FILE__ ), array(
	$editormd,
	'jetpack_markdown_settings_link'
) );//添加插件设置链接
add_filter( 'user_can_richedit', '__return_false' );
remove_filter( 'the_content', 'wptexturize' ); //取消内容转义
remove_filter( 'the_excerpt', 'wptexturize' ); //取消摘要转义
remove_filter( 'comment_text', 'wptexturize' );//取消评论转义

register_activation_hook( basename( dirname( __FILE__ ) ) . '/' . basename( __FILE__ ), array(
	$editormd,
	'activate'
) ); //启用挂钩
register_deactivation_hook( basename( dirname( __FILE__ ) ) . '/' . basename( __FILE__ ), array(
	$editormd,
	'deactivate'
) );//停用挂钩

//Emoji表情
if ( isset( $editormd_inlobase['support_emoji'] ) && $editormd_inlobase['support_emoji'] == 1 ) {
	add_action( 'wp_enqueue_scripts', array( $editormd, 'emoji_enqueue_scripts' ) );
	add_action( 'wp_footer', array( $editormd, 'emoji_enqueue_footer_js' ) );
	//禁用WordPress自带Emoji表情 ==> 排除干扰
	remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
	remove_action( 'admin_print_styles', 'print_emoji_styles' );
	remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
	remove_action( 'wp_print_styles', 'print_emoji_styles' );
	remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
	remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
	remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
};

//KaTeX
if ( isset( $editormd_inlobase['support_latex'] ) && $editormd_inlobase['support_latex'] == 1 ) {
	add_action( 'wp_enqueue_scripts', array( $editormd, 'latex_enqueue_scripts' ) );
}

//FlowChart
if ( isset( $editormd_inlobase['support_flowchart'] ) && $editormd_inlobase['support_flowchart'] == 1 ) {
	add_action( 'wp_enqueue_scripts', array( $editormd, 'flowchart_enqueue_scripts' ) );
	//remove_filter ('the_content', 'wpautop');//禁止自动给文章段落添加<p>,<br/>等标签
	//remove_filter ('comment_text', 'wpautop');//禁止自动给评论段落添加<p>,<br/>等标签
}

//Sequence
if ( isset( $editormd_inlobase['support_sequence'] ) && $editormd_inlobase['support_sequence'] == 1 ) {
	add_action( 'wp_enqueue_scripts', array( $editormd, 'sequence_enqueue_scripts' ) );
	//remove_filter ('the_content', 'wpautop');//禁止自动给文章段落添加<p>,<br/>等标签
	//remove_filter ('comment_text', 'wpautop');//禁止自动给评论段落添加<p>,<br/>等标签
}