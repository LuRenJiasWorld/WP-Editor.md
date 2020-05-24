<?php

namespace EditormdPages;

/**
 * 页面渲染类，用于控制静态页面的展示
 */
class Pages {
	const ADMIN_PRIV = 0;
	const LOGIN_PRIV = 1;
	const GURST_PRIV = 2;

	// 页面路径和权限
	private $pages;

	function __construct() {
        $this->pages = [
			"sm-ms-management"	=>	self::ADMIN_PRIV,
			"upgrade-release"	=>	self::ADMIN_PRIV
		];

		// 注册wp_ajax接口，同时允许登录和非登录用户访问，权限由本类控制
		add_action("wp_ajax_wp_editormd_pages", array($this, "editormd_imagepaste_action_callback"));
		add_action("wp_ajax_nopriv_wp_editormd_pages", array($this, "editormd_imagepaste_action_callback"));
	}
	
	public function renderer() {
		$page = $_GET["page"];
		
		if (isset($this->pages[$page])) {
			$pagePriv = $this->pages[$page];
		}
	}
}

// 尝试输出对应路径的页面资源