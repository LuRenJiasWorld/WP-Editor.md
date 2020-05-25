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
            "sm-ms-management"   =>    self::ADMIN_PRIV,
            "upgrade-release"    =>    self::ADMIN_PRIV
        ];

        // 注册wp_ajax接口，同时允许登录和非登录用户访问，权限由本类控制
        add_action("wp_ajax_wp_editormd_pages", array($this, "editormd_imagepaste_action_callback"));
        add_action("wp_ajax_nopriv_wp_editormd_pages", array($this, "editormd_imagepaste_action_callback"));
    }
    
    public function renderer() {
        $page = $_GET["page"];
        
        if (isset($this->pages[$page])) {
            $pagePriv = $this->pages[$page];
        } else {
            $this->noAccess();
        }

        switch ($pagePriv) {
            case self::ADMIN_PRIV:
                if (!$this->canAdmin()) $this->noAccess();
                echo "Admin";
                break;
            case self::LOGIN_PRIV:
                if (!$this->canLogin()) $this->noAccess();
                echo "Login";
                break;
            case self::GURST_PRIV:
                break;
        }
    }

    private function canAdmin() {
        return (bool)current_user_can("administrator");
    }

    private function canLogin() {
        return (bool)is_user_logged_in();
    }

    private function canGuest() {
        return true;
    }

    private function noAccess() {
        // 直接返回一个404
        $wp_query->set_404();
        status_header(404);
        nocache_headers();
        die();
    }
}

// 尝试输出对应路径的页面资源