<?php
/**
 * Plugin Name:       WP Editor.md
 * Plugin URI:        https://github.com/JaxsonWang/WP-Editor.md
 * Description:       Perhaps this is the best and most perfect Markdown editor in WordPress
 * Version:           6.0.7
 * Author:            淮城一只猫
 * Author URI:        https://iiong.com
 * License:           GPL-3.0+
 * License URI:       http://www.gnu.org/licenses/gpl-3.0.txt
 * Text Domain:       editormd
 * Domain Path:       /languages
 */

namespace EditormdRoot;

use Editormd\Main;
use EditormdUtils\Activator;
use EditormdUtils\Deactivator;

define( 'WP_EDITORMD_VER', '6.0.7' ); //版本说明
define( 'WP_EDITORMD_URL', plugins_url( '', __FILE__ ) ); //插件资源路径
define( 'WP_EDITORMD_PATH', dirname( __FILE__ ) ); //插件路径文件夹
define( 'WP_EDITORMD_NAME', plugin_basename( __FILE__ ) ); //插件名称

// 自动载入文件
require_once WP_EDITORMD_PATH . '/vendor/autoload.php';

/**
 * 插件激活期间运行的代码
 * includes/class-plugin-name-activator.php
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
    $php_version = phpversion();
    $ver = '5.3.0';
    if (version_compare($php_version, $ver) < 0) {
        $a = __("WP Editor.md requires at least version 5.3.0 of PHP. You are running an older version: $php_version. Please upgrade PHP version!",'editormd');
        wp_die( $a, 'WP Editor.md' );
    } else {
        $plugin = new Main();
        $plugin->run();
    }
}

/**
 * 开始执行插件
 */
run_editormd();