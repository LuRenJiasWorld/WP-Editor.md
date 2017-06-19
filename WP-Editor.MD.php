<?php
/**
 * Plugin Name: WP Editor.md
 * Plugin URI: https://iiong.com/wordpress-plugins-wp-editormd.html
 * Description: 或许这是一个WordPress中最好，最完美的Markdown编辑器。
 * Version: 2.1
 * Author: 淮城一只猫
 * Author URI: https://iiong.com/
 * License: GPLv3 or later
 */

define( 'WP_EDITORMD_PLUGIN_VERSION', '2.1' ); //版本说明
define( 'WP_EDITORMD_PLUGIN_URL', plugins_url( '', __FILE__ ) ); //插件资源路径
define( 'WP_EDITORMD_PLUGIN_PATH', dirname( __FILE__ ) ); //插件路径文件夹

//载入数据库
$options = get_option( 'editormd_options' );

//引入jetpack解析库
if ( ! function_exists( 'jetpack_require_lib_editormd' ) ) {
	require WP_EDITORMD_PLUGIN_PATH . '/Jetpack/require-lib.php';
}

//引入jetpack markdown库
if ( ! class_exists( 'WPCom_Markdown' ) ) {
	require WP_EDITORMD_PLUGIN_PATH . '/Jetpack/markdown/easy-markdown.php';
}

//引入jetpack LaTeX库
if ( isset( $options['support_latex'] ) && $options['support_latex'] == 1 ) {
	if ( ! function_exists( 'latex_markup' ) ) {
		require WP_EDITORMD_PLUGIN_PATH . '/Jetpack/latex/latex.php';
	}
}

//前端语法高亮处理函数
if ( isset( $options['support_highlight'] ) && $options['support_highlight'] == 1 ) {
	if ( ! class_exists( 'editormd_prismjs' ) ) {
		require WP_EDITORMD_PLUGIN_PATH . '/editormd_prismjs.php';
	}
}

//引入快捷图片上传函数库
if ( isset( $options['support_imagepaste'] ) && $options['support_imagepaste'] == 1 ) {
	if ( ! class_exists( 'editormd_imagepaste' ) ) {
		require WP_EDITORMD_PLUGIN_PATH . '/editormd_imagepaste.php';
	}
}

//引入资源模板
if ( ! class_exists( 'editormd' ) ) {
	require WP_EDITORMD_PLUGIN_PATH . '/editormd_class.php';
}

//引入设置页面
require WP_EDITORMD_PLUGIN_PATH . '/editormd_options.php';

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
remove_filter( 'the_content', 'wpautop' );
remove_filter( 'the_content', 'wptexturize' );

register_activation_hook( basename( dirname( __FILE__ ) ) . '/' . basename( __FILE__ ), array(
	$editormd,
	'activate'
) ); //启用挂钩
register_deactivation_hook( basename( dirname( __FILE__ ) ) . '/' . basename( __FILE__ ), array(
	$editormd,
	'deactivate'
) );//停用挂钩

//Emoji表情
if ( isset( $options['support_emoji'] ) && $options['support_emoji'] == 1 ) {
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