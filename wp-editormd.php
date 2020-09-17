<?php
/**
 * Plugin Name:       WP Editor.md
 * Plugin URI:        https://github.com/LuRenJiasWorld/WP-Editor.md
 * Description:       Perhaps this is the best and most perfect Markdown editor in WordPress
 * Version:           10.2.1
 * Author:            LuRenJiasWorld
 * Author URI:        https://untitled.pw/
 * License:           GPL-3.0+
 * License URI:       http://www.gnu.org/licenses/gpl-3.0.txt
 * Text Domain:       editormd
 * Domain Path:       /languages
 */

namespace EditormdRoot;

use Editormd\Main;
use EditormdUtils\Activator;
use EditormdUtils\Deactivator;

define( 'WP_EDITORMD_VER', '10.2.1' );                      //版本说明
define( 'WP_EDITORMD_URL', plugins_url( '', __FILE__ ) );   //插件资源路径
define( 'WP_EDITORMD_PATH', dirname( __FILE__ ) );          //插件路径文件夹
define( 'WP_EDITORMD_NAME', plugin_basename( __FILE__ ) );  //插件名称

// 自动载入文件
require_once WP_EDITORMD_PATH . '/vendor/autoload.php';

/**
 * 插件激活期间运行的代码
 */
function activate_editormd() {
    Activator::activate();
}

/**
 * 在插件停用期间运行的代码
 * includes/class-plugin-name-deactivator.php
 */
function deactivate_editormd() {
    Deactivator::deactivate();
}

register_activation_hook( __FILE__, '\EditormdRoot\activate_editormd' );
register_deactivation_hook( __FILE__, '\EditormdRoot\deactivate_editormd' );

/**
 * 执行插件函数
 */
function run_editormd() {
    if ( version_compare( PHP_VERSION, '5.6.0' ) < 0 ) {
        add_filter( 'template_include', '__return_null', 99 );
        unset( $_GET['activated'] );
        add_action( 'admin_notices', function () {
            $message = __( 'Hey, we\'ve noticed that you\'re running an outdated version of PHP which is no longer supported. Make sure your site is fast and secure, by upgrading PHP to the latest version.', 'editormd' );
            printf( '<div class="error"><p>%1$s</p></div>', esc_html( $message ) );
        } );
    } else {
        // 版本更新后需要执行Activator中的Upgrader，因此需要将其放在这里
        // 只有当用户登录的时候才会执行，提升前台页面加载性能
        add_action("init", function() {
            if (is_user_logged_in()) Activator::activate();
        });

        new Main();
    }
}

/**
 * 开始执行插件
 */
run_editormd();