<?php

namespace EditormdApp;

use EditormdUtils\Config;

class PrismJSCustomize {

    public function __construct() {
        add_action("wp_enqueue_scripts", array($this, "prism_styles_scripts"));
    }

    public function prism_styles_scripts() {
        wp_enqueue_style("Prism", Config::get_option("customize_highlight_style", "syntax_highlighting") , array(), WP_EDITORMD_VER, "all");
        wp_enqueue_script("Prism", Config::get_option("customize_highlight_javascript", "syntax_highlighting") , array(), WP_EDITORMD_VER, "true");
    }
}