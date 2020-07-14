<?php

namespace EditormdApp;

use EditormdUtils\Config;

class Mermaid {

    public function __construct() {
        add_action("wp_enqueue_scripts", array($this, "mermaid_enqueue_scripts"));
        if(!in_array($GLOBALS["pagenow"], array("wp-login.php", "wp-register.php"))) {
            add_action("wp_print_footer_scripts", array($this, "mermaid_wp_footer_script"));
        }
    }

    public function mermaid_enqueue_scripts() {
        wp_enqueue_script("Mermaid",  Config::get_option("editor_addres","editor_style") . "/assets/Mermaid/mermaid.min.js", array(), WP_EDITORMD_VER, true);
    }

    public function mermaid_wp_footer_script() {
        ?>
        <script type="text/javascript">
            (function ($) {
                $(document).ready(function () {
                    $(".mermaid script").remove();
                    mermaid.initialize(<?php
                        echo Config::get_option("mermaid_config", "editor_mermaid")
                    ?>,".mermaid");
                })
            })(jQuery)
        </script>
        <?php
    }
}