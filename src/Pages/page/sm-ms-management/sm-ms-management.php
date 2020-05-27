<?php
// sm.ms图片管理页面

function display_page() {
	echo "<h1>正在加载中......</h1>";
	wp_redirect(get_site_url() . "/wp-content/plugins/wp-editormd/src/Pages/page/sm-ms-management/html/index.html", 302);
}