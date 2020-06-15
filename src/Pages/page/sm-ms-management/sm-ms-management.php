<?php
// sm.ms图片管理页面

function display_page() {
	return file_get_contents(__DIR__ . "/html/index.html");
}

function wp_editormd_entry_sm_ms_proxy() {
	return "Hello, World!";
}