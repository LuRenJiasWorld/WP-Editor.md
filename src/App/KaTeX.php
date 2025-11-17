<?php
/**
 * KaTeX support.
 *
 * 重构公式标识符函数，统一了单美元符号和双美元符号的处理流程，
 * 修复了执行顺序问题，并提升了正则表达式的稳定性。
 *
 */

namespace EditormdApp;
use EditormdUtils\Config;

class KaTeX {

    public function __construct() {
        // 使用统一的处理函数，并设置合理的优先级
        add_filter("the_content", array($this, "katex_markup"), 9);
        add_filter("comment_text", array($this, "katex_markup"), 9);
        
        // 前端加载资源
        add_action("wp_enqueue_scripts", array($this, "katex_enqueue_scripts"));

        if (! in_array($GLOBALS["pagenow"], array("wp-login.php", "wp-register.php"))) {
            // 执行公式渲染操作
            add_action("wp_print_footer_scripts", array($this, "katex_wp_footer_scripts"));
        }
    }
    
    /**
     * 用于处理行内 ($...$) 和行外 ($$...$$) KaTeX 标记的统一函数。
     * 这样可以避免两个独立函数之间产生的冲突和顺序问题。
     */
    public function katex_markup($content) {
        /**
         * 一个用于捕获行外和行内数学公式的统一正则表达式。
         * 使用 OR '|' 操作符，并优先尝试匹配更长的 '$$' 标识符。
         * 这可以防止 '$$' 被错误地解析为两个独立的 '$' 。
         *
         * 正则表达式分解:
         * 捕获组 1: 匹配整个 $$...$$ 块。
         *  ->捕获组 2: 捕获 $$...$$ 内部的实际 LaTeX 内容。
         * 捕获组 3: 匹配整个 $...$ 块。
         *  ->捕获组 4: 捕获 $...$ 内部的实际 LaTeX 内容。
         */
        $regex = '/
            (                                      # 捕获组 1: 捕获 $$...$$ 块
                \$\$                               # 以 $$ 开始
                (                                  # 捕获组 2: 捕获内容
                    (?:
                        [^$]+                        # 匹配任何非美元符号的字符
                        |                          # 或
                        \$ (?<! \$\$ )               # 匹配一个美元符号，前提是它前面不是另一个美元符号
                    )+?                            # 一次或多次非贪婪匹配
                )
                \$\$                               # 以 $$ 结束
            )
            |                                      # 或
            (                                      # 捕获组 3: 捕获 $...$ 块
                \$                                 # 以 $ 开始
                (                                  # 捕获组 4: 捕获内容
                    (?:
                        [^$]+                        # 匹配任何非美元符号的字符
                        |                          # 或
                        \$ (?<! \$\$ )               # 匹配一个美元符号，前提是它前面不是另一个美元符号
                    )+?                            # 一次或多次非贪婪匹配
                )
                \$                                 # 以 $ 结束
            )
        /ix';

        $textarr = wp_html_split($content);
        $pass_tags = ['pre', 'code', 'style', 'script']; // 在这些标签内部不会被解析，跳过处理
        $is_passing = false;

        foreach ($textarr as &$element) {
            
            // 处理进入和退出跳过区域的逻辑
            if (strpos($element, '<') === 0 && preg_match('/<(\/)?(' . implode('|', $pass_tags) . ').*?>/i', $element, $tag_match)) {
                if (isset($tag_match[1]) && $tag_match[1] === '/') {
                    // 这是一个闭合标签
                    $is_passing = false;
                } else {
                    // 这是一个起始标签
                    $is_passing = true;
                }
            }
            
            if ($is_passing || strpos($element, '<') === 0) {
                continue;
            }

            $element = preg_replace_callback($regex, array($this, "katex_universal_replace"), $element);
            
            // 原始代码处理字符 "_" 和 "em" 之间的替换问题，逻辑保留
            if ($element !== null) { // 检查 preg_ 错误
                $element = $this->katex_src_replace_em($element);
            }
        }

        return implode("", $textarr);
    }

    /**
     * 用于统一正则表达式的通用回调函数。
     * 判断找到的是行内匹配还是行外匹配，并进行相应处理。
     * 
     * 重点**************
     * 不允许标识符和公式代码之间存在空格。
     * *****************
     *
     * $matches 来自 preg_replace_callback 的匹配数组。
     * 返回替换后的字符串。
     */
    public function katex_universal_replace($matches) {
        // 如果 matches[1] 被设置，则说明是行外 ($$) 匹配。
        if (!empty($matches[1])) {
            $type = 'multi-line';
            $content = $matches[2]; // 内容在捕获组 2 中
        } 
        // 如果 matches[3] 被设置，则说明是行内 ($) 匹配。
        elseif (!empty($matches[3])) {
            $type = 'inline';
            $content = $matches[4]; // 内容在捕获组 4 中
        } 
        else {
            return $matches[0]; // 没有有效匹配，返回原始字符串
        }

        // 重要：检查标识符和公式代码之间是否存在空格。
        // 如果存在空格则不进行渲染。
        if (ctype_space(substr($content, 0, 1)) || ctype_space(substr($content, -1))) {
            return $matches[0];
        }

        $katex = $this->katex_entity_decode_editormd($content);

        return '<span class="katex math ' . $type . '">' . trim($katex) . '</span>';
    }
    
    /**
     * 在如果公式含有_则会被Markdown解析，所以现在需要转换过来
     */
    public function katex_src_replace_em($content) {
        // 如果内容不是字符串（例如，preg_ 出错），则返回空字符串。
        if (!is_string($content)) {
            return '';
        }
        // 以防带有 '_' 的公式被 Markdown 优先解析。
        return str_replace(
            array("<em>", "</em>"),
            array("_", "_"),
            $content
        );
    }
    
    /**
     * 渲染转换
     * 
     * 解决特殊字符可能会与HTML标签冲突的问题
     * 需要注意的是转换后的html entities两边要带空格
     * 这也是为什么不直接使用htmlentities()的主要原因
     * 否则如果用户没有在符号两边加空格的习惯
     * 就会导致entities与LaTeX公式混在一起
     * 
     * @param $katex
     *
     * @return mixed
     */
    public function katex_entity_decode_editormd($katex) {
        return str_replace(
            array(" &lt; "  , " &gt; " , " &quot; ", " &#039; ", 
                  " &#038; ", " &amp; ", " \n "    , " \r "    , 
                  " &#60; " , " &#62; ", " &#40; " , " &#41; " ,
                  " &#95; " , " &#33; ", " &#123; ", " &#125; ", 
                  " &#94; " , " &#43; ", " &#92; "
                ),
                   
            array("<"       , ">"      , "\""      , "\'"      , 
                  "&"       , "&"      , " "       , " "       , 
                  "<"       , ">"      , "("       , ")"       , 
                  "_"       , "!"      , "{"       , "}"       , 
                  "^"       , "+"      , "\\\\"   
                ),
                   
            $katex);
    }

    public function katex_enqueue_scripts() {
        // 兼容模式 - jQuery
        if (Config::get_option("jquery_compatible", "editor_advanced") !== "off") {
            wp_enqueue_script("jquery", null, null, array(), false);
        } else {
            wp_deregister_script("jquery");
            wp_enqueue_script("jQuery-CDN", Config::get_option("editor_addres","editor_style") . "/assets/jQuery/jquery.min.js", array(), WP_EDITORMD_VER, true);
        }

        wp_enqueue_style("Katex", Config::get_option("editor_addres","editor_style") . "/assets/KaTeX/katex.min.css", array(), WP_EDITORMD_VER, "all");
        wp_enqueue_script("Katex", Config::get_option("editor_addres","editor_style") . "/assets/KaTeX/katex.min.js", array(), WP_EDITORMD_VER, true);
    }

    public function katex_wp_footer_scripts() {
        ?>
        <script type="text/javascript">
            (function ($) {
                $(document).ready(function () {
                    $(".katex.math.inline").each(function () {
                        var parent = $(this).parent()[0];
                        if (parent.localName !== "code") {
                            var texTxt = $(this).text();
                            var el = $(this).get(0);
                            try {
                                katex.render(texTxt, el);
                            } catch (err) {
                                $(this).html("<span class=\"err\">" + err);
                            }
                        } else {
                            $(this).parent().text($(this).parent().text());
                        }
                    });
                    $(".katex.math.multi-line").each(function () {
                        var texTxt = $(this).text();
                        var el = $(this).get(0);
                        try {
                            katex.render(texTxt, el, {displayMode: true})
                        } catch (err) {
                            $(this).html("<span class=\"err\">" + err)
                        }
                    });
                })
            })(jQuery);
        </script>
        <?php
    }
}
