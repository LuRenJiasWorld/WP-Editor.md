<?php

namespace EditormdUtils;

use EditormdUtils\Upgrader as Upgrader;

class Activator {

    public static function activate() {
        // 初次载入插件写入默认数据 => 判断本地是否存在数据 不存在写入数据即可
        if (get_option("editor_basics") == false) {
            add_option("editor_basics", Activator::$defaultOptionsBasics, "", "yes");
        }

        if (get_option("editor_style") == false) {
            add_option("editor_style", Activator::$defaultOptionsStyle, "", "yes");
        }

        if (get_option("syntax_highlighting") == false) {
            add_option("syntax_highlighting", Activator::$defaultOptionsSyntax, "", "yes");
        }

        if (get_option("editor_emoji") == false) {
            add_option("editor_emoji", Activator::$defaultOptionsEmoji, "", "yes");
        }

        if (get_option("editor_toc") == false) {
            add_option("editor_toc", Activator::$defaultOptionsToc, "", "yes");
        }

        if (get_option("editor_latex") == false) {
            add_option("editor_latex", Activator::$defaultOptionsKatex, "", "yes");
        }

        if (get_option("editor_mermaid") == false) {
            add_option("editor_mermaid", Activator::$defaultOptionsKatex, "", "yes");
        }

        if (get_option("editor_mindmap") == false) {
            add_option("editor_mindmap", Activator::$defaultOptionsMindMap, "", "yes");
        }

        if (get_option("editor_advanced") == false) {
            add_option("editor_advanced", Activator::$defaultOptionsAdvanced, "", "yes");
        }

        if (get_option("editor_version") == false) {
            add_option("editor_version", array("wp_editormd_ver" => WP_EDITORMD_VER), "", "yes");
        }

        // 版本升级器
        new Upgrader();
    }

    public static $defaultOptionsBasics = array(
        "task_list"           =>  "on",
        "imagepaste"          =>  "on",
        "imagepaste_sm"       =>  "off",
        "imagepaste_sm_token" =>  "",
        "image_link"          =>  "on",
        "open_in_new_tab"     =>  "on",
        "live_preview"        =>  "on",
        "sync_scrolling"      =>  "on",
        "html_decode"         =>  "on",
        "support_front"       =>  "off",
        "support_reply"       =>  "off",
        "support_other_text"  =>  ""
    );

    public static $defaultOptionsStyle = array(
        "theme_style"   => "default",
        "code_style"    => "default",
        "editor_addres" => ""
    );

    public static $defaultOptionsSyntax = array(
        "highlight_mode_auto"            => "on",
        "line_numbers"                   => "on",
        "show_language"                  => "on",
        "copy_clipboard"                 => "on",
        "highlight_library_style"        => "default",
        "customize_my_style"             => "nothing"
    );

    public static $defaultOptionsEmoji = array(
        "support_emoji" => "on"
    );

    public static $defaultOptionsToc = array(
        "support_toc" => "off"
    );

    public static $defaultOptionsKatex = array(
        "support_latex" => "katex"
    );

    public static $defaultOptionsMermaid = array(
        'support_mermaid' => 'off',
        'mermaid_config'  => '{
    "theme": "dark",
    "logLevel": 5,
    "arrowMarkerAbsolute": false,
    "startOnLoad": true,
    "flowchart": {
        "htmlLabels": true,
        "curve": "linear"
    },
    "sequence": {
        "diagramMarginX": 50,
        "diagramMarginY": 10,
        "actorMargin": 50,
        "width": 150,
        "height": 65,
        "boxMargin": 10,
        "boxTextMargin": 5,
        "noteMargin": 10,
        "messageMargin": 35,
        "mirrorActors": true,
        "bottomMarginAdj": 1,
        "useMaxWidth": true
    },
    "gantt": {
        "titleTopMargin": 25,
        "barHeight": 20,
        "barGap": 4,
        "topPadding": 50,
        "leftPadding": 75,
        "gridLineStartPadding": 35,
        "fontSize": 11,
        "fontFamily": "\"Open-Sans\", \"sans-serif\"",
        "numberSectionStyles": 4,
        "axisFormat": "%Y-%m-%d"
    },
    "class": {},
    "git": {}
}'
    );

    public static $defaultOptionsMindMap = array(
        "support_mindmap"   => "off",
        "customize_mindmap" => ""
    );

    public static $defaultOptionsAdvanced = array(
        "jquery_compatible" => "off",
        "hide_ads"          => "off",
    );
}
