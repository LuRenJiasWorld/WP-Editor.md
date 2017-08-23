<?php
/**
 * 载入设置页面配置
 * @Author: JaxsonWang
 */

//引入核心文件
require WP_EDITORMD_PLUGIN_PATH . '/Admin/skelet/skelet.php';

//引入配置选项文件
skelet_dir( WP_EDITORMD_PLUGIN_PATH . '/Admin/data/' );


function options_script() {
	wp_enqueue_style( 'meow', WP_EDITORMD_PLUGIN_URL . '/Admin/skelet/assets/css/_meow.min.css', array(), WP_EDITORMD_PLUGIN_VERSION, 'all' );
	wp_enqueue_script( 'meow', WP_EDITORMD_PLUGIN_URL . '/Admin/skelet/assets/js/_meow.min.js', array(), WP_EDITORMD_PLUGIN_VERSION, true );
}

add_action( 'admin_print_scripts', 'options_script' );

?>