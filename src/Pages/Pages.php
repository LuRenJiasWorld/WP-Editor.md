<?php

namespace EditormdPages;
use EditormdUtils\Config;

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
        ];

        // 注册wp_ajax接口，同时允许登录和非登录用户访问，权限由本类控制
        add_action("wp_ajax_wp_editormd_pages", array($this, "renderer"));
        add_action("wp_ajax_nopriv_wp_editormd_pages", array($this, "renderer"));
    }
    
    public function renderer() {
        $page  = $_GET["page"];
        $entry = $_GET["entry"];

        // 正则表达式匹配目的在于过滤潜在不安全字符，避免在require_once的时候被利用
        $safeParamRegex = "/^([a-z0-9\-\_]?)+$/";
        if (isset($this->pages[$page]) && preg_match($safeParamRegex, $page) && preg_match($safeParamRegex, $entry)) {
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
            require_once(__DIR__ . "/page/$page/$page.php");

            if (isset($entry)) {
                if  (!function_exists("wp_editormd_entry_" . $entry)) {
                    $this->noAccess();
                }
                echo call_user_func("wp_editormd_entry_" . $entry);
            } else {
                echo display_page($this->text_domain, Config::class);
            }
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
        die();
    }
}