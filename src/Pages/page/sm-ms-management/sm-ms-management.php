<?php
// sm.ms图片管理页面

function display_page() {
	wp_redirect(get_site_url() . "/wp-content/plugins/wp-editormd/src/Pages/page/sm-ms-management/html/index.html", 302);
}