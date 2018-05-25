<?php
/**
 * Plugin Name:       WP Editor.md
 * Plugin URI:        https://github.com/JaxsonWang/WP-Editor.md
 * Description:       Perhaps this is the best and most perfect Markdown editor in WordPress
 * Version:           6.0.4
 * Author:            淮城一只猫
 * Author URI:        https://iiong.com
 * License:           GPL-3.0+
 * License URI:       http://www.gnu.org/licenses/gpl-3.0.txt
 * Text Domain:       editormd
 * Domain Path:       /languages
 */

namespace Root;

use Editormd\Main;
use Utils\Activator;
use Utils\Deactivator;

define( 'WP_EDITORMD_VER', '6.0.4' ); //版本说明
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

register_activation_hook( __FILE__, '\Root\activate_editormd' );
register_deactivation_hook( __FILE__, '\Root\deactivate_editormd' );

/**
 * 开始执行插件
 */
function run_editormd() {
	$plugin = new Main();
	$plugin->run();
}

run_editormd();