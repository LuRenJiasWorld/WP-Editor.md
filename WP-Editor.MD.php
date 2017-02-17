<?php
/**
 * Plugin Name: WP Editor.md
 * Plugin URI: https://iiong.com/wordpress-plugins-wp-editormd.html
 * Description: 或许这是一个WordPress中最好，最完美的Markdown编辑器。
 * Version: 1.3
 * Author: 苏城一只猫
 * Author URI: https://iiong.com/
 * License: GPLv2 or later
 */

define('WP_EDITORMD_PLUGIN_VERSION', '1.3'); //版本说明
define('WP_EDITORMD_PLUGIN_URL', plugins_url('', __FILE__)); //插件资源路径
define('WP_EDITORMD_PLUGIN_PATH', dirname(__FILE__)); //插件路径文件夹

//引入jetpack解析库
if (!function_exists('jetpack_require_lib')) {
    require WP_EDITORMD_PLUGIN_PATH . '/jetpack/require-lib.php';
}

//引入jetpack保存库
if (!class_exists('WPCom_Markdown')) {
    require WP_EDITORMD_PLUGIN_PATH . '/jetpack/markdown/easy-markdown.php';
}

//引入资源模板
require  WP_EDITORMD_PLUGIN_PATH . '/editormd_class.php';

add_action('personal_options_update', array($editormd, 'user_personalopts_update'));
add_action('admin_head', array($editormd, 'add_admin_head'));
add_action('edit_form_advanced', array($editormd, 'load_editormd'));
add_action('edit_page_form', array($editormd, 'load_editormd'));
add_action('simple_edit_form', array($editormd, 'load_editormd'));
add_action('admin_print_styles', array($editormd, 'add_admin_style'));
add_action('admin_print_scripts', array($editormd, 'add_admin_js'));
add_action('admin_init', array($editormd, 'editormd_jetpack_markdown_posting_always_on'), 11);
add_action('plugins_loaded', array($editormd, 'editormd_jetpack_markdown_load_textdomain'));
add_filter('quicktags_settings', array($editormd, 'quicktags_settings'), $editorId = 'content');// 删除编辑器的快捷按钮标签
add_filter('pre_option_' . WPCom_Markdown::POST_OPTION, '__return_true');
add_filter('plugin_action_links_' . plugin_basename(__FILE__), array($editormd, 'jetpack_markdown_settings_link'));//添加插件设置链接

//插入插件设置属性
function editormd_plugin_menu() {
    add_options_page('WP-Editor.MD', 'WP-Editor.MD','manage_options', 'editormd-settings', 'editormd_option_page');
}
add_action('admin_menu', 'editormd_plugin_menu');

register_activation_hook(basename(dirname(__FILE__)).'/' . basename(__FILE__), array($editormd, 'activate')); //启用挂钩
register_deactivation_hook(basename(dirname(__FILE__)).'/' . basename(__FILE__), array($editormd, 'deactivate'));//停用挂钩

//Enabled启用时候加载Emoji相关配置文件（前台显示）
if ( get_option('editormd_emoji_support') == 'yes' ) {
    function add_emojify() {
        wp_register_style('emojifycss', WP_EDITORMD_PLUGIN_URL . '/css/emojify.min.css', array(), WP_EDITORMD_PLUGIN_VERSION, 'all');
        wp_register_script('emojifyjs', WP_EDITORMD_PLUGIN_URL . '/js/emojify.min.js',  array() , WP_EDITORMD_PLUGIN_VERSION ,true);
        wp_register_script('emojifyconfig', WP_EDITORMD_PLUGIN_URL . '/js/emojifyconfig.js',  array() , WP_EDITORMD_PLUGIN_VERSION ,true);
        wp_enqueue_style('emojifycss');
        wp_enqueue_script('emojifyjs');
        wp_enqueue_script('emojifyconfig');
    }
    add_action('wp_enqueue_scripts', 'add_emojify');
}

//选项
function editormd_option_page() {
    //生成随机值
    //链接
    $nonce = wp_create_nonce( 'Editormd' );
    if ( ! wp_verify_nonce( $_REQUEST['wpnonce'] = $nonce , 'Editormd' ) ) {
        ob_clean();
        die( 'Security check' );
    }
    //Emoji
    if(isset($_POST['emoji_support'])) {
		if( ! wp_verify_nonce($_POST['emoji_support'] = $nonce , 'Editormd' ) ) {
			ob_clean();
			die( 'Security check' );
		}
	}
    //设置更新提示
    if ( !empty($_POST) && check_admin_referer('editormd_admin_options-update') ) {
        update_option('editormd_emoji_support', isset($_POST['emoji_support'])?$_POST['emoji_support']:''); //定义传参——>解决空值的问题
        echo '<div id="message" class="updated">设置保存成功</div>';
    }

    //Emoji表情开关 切换
    if ( get_option('editormd_emoji_support') == $nonce ){
        $checked_emoji = "checked = 'checked'";
    } else {
        $checked_emoji = '';
    }
    ?>
    <!--设置页面-->
    <div class="editormd_wrap">
        <h2>WP-Editor.MD Options</h2>
        <p>欢迎来到Editor.MD For WordPress的设置页面。</p>
        <p>如果你有什么好的意见和建议，可以到这里<a href="https://github.com/JaxsonWang/WP-Editor.MD/issues">提交问题/建议</a></p>
        <form action="" method="post">
            <p>
                <label for="emoji_support">开启Emoji表情支持：</label>
                <input type="checkbox" id="emoji_support" name="emoji_support" <?php echo $checked_emoji;?> value="<?php echo $nonce; ?>" />
            </p>
            <p>
                <span>评论支持Markdown语法：</span><a href="<?php echo admin_url() ?>options-discussion.php#wpcom_publish_comments_with_markdown&wpnonce=<?php echo $nonce; ?>">设置</a>
            </p>
            <p class="submit"><input type="submit" name="submit" id="submit" class="button-primary" value="<?php _e('Save Changes'); ?>" /></p>
            <?php wp_nonce_field('editormd_admin_options-update'); ?>
        </form>
    </div>

    <?php

}