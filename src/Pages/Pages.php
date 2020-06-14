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

    private $text_domain;

    function __construct($text_domain) {
        $this->text_domain = $text_domain;

        $this->pages = [
            "sm-ms-management"   =>    self::ADMIN_PRIV,
            "upgrade-release"    =>    self::ADMIN_PRIV,
            "test-page"          =>    self::GURST_PRIV
        ];

        // 注册wp_ajax接口，同时允许登录和非登录用户访问，权限由本类控制
        add_action("wp_ajax_wp_editormd_pages", array($this, "renderer"));
        add_action("wp_ajax_nopriv_wp_editormd_pages", array($this, "renderer"));
    }
    
    public function renderer() {
        $page = $_GET["page"];
        
        if (isset($this->pages[$page])) {
            $pagePriv = $this->pages[$page];
        } else {
            $this->noAccess();
        }

        $authorized = false;

        switch ($pagePriv) {
            case self::ADMIN_PRIV:
                if ($this->canAdmin()) $authorized = true;
                break;
            case self::LOGIN_PRIV:
                if ($this->canLogin()) $authorized = true;
                $authorized = true;
                break;
            case self::GURST_PRIV:
                $authorized = true;
                break;
        }

        if ($authorized) {
            // 设置语言，便于页面通过Cookie获取当前站点语言
            // 如果Cookie因为某些原因未能生效，则由页面自主判断或使用浏览器中的语言
            setcookie("wp-editormd-lang", get_bloginfo("language"), 0, "/");
            require_once(__DIR__ . "/page/$page/$page.php");
            echo display_page();
            wp_die();
        } else {
            $this->noAccess();
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
        global $wp_query;
        $wp_query->set_404();
        status_header(404);
        nocache_headers();
        wp_die();
    }
}