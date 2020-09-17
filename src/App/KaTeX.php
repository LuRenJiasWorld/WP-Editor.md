<?php
/**
 * KaTeX support.
 *
 * Backward compatibility requires support for both "$$katex$$" shortcodes.
 *
 */

namespace EditormdApp;
use EditormdUtils\Config;

class KaTeX {

    public function __construct() {

        //单个$或者双个$$符号匹配
        add_filter("the_content", array($this, "katex_markup_single"), 9);
        add_filter("comment_text", array($this, "katex_markup_single"), 9);

        add_filter("the_content", array($this, "katex_markup_double"), 8);
        add_filter("comment_text", array($this, "katex_markup_double"), 8);
        //前端加载资源
        add_action("wp_enqueue_scripts", array($this, "katex_enqueue_scripts"));

        if (! in_array($GLOBALS["pagenow"], array("wp-login.php", "wp-register.php"))) {
            //执行公式渲染操作
            add_action("wp_print_footer_scripts", array($this, "katex_wp_footer_scripts"));
        }

    }

    public function katex_markup_single($content) {
        // 匹配单行LaTeX
        // 尽管只是多了一个$符号，却会引起指数级的回溯
        $regexTeXInline = '
        %
        \$
            ((?:
                [^$]+ # Not a dollar
                |
                (?<=(?<!\\\\)\\\\)\$ # Dollar preceded by exactly one slash
                )+)
            (?<!\\\\)
        \$ # Dollar preceded by zero slashes
        %ix';

        // 简易版本，可能存在误判，但尽可能简单，以避免上面这个LaTeX引起的性能问题
        $regexTeXMultilineLite = "/\$[\S\ ]+?\$/ix";
        
        $content = preg_replace_callback($regexTeXMultilineLite, array($this, "katex_src_replace"), $content);

        $textarr = wp_html_split($content);

        // 需要跳过的行数
        $count = 0;
        // 是否需要跳过LaTeX解析
        $pass  = false;

        foreach ($textarr as &$element) {
            // 默认进行LaTeX解析，如果满足下面的判断条件，则跳过
            $pass = false;

            // 判断已经跳过的行数
            if ($count > 0) {
                ++ $count;
            }

            /**
             * 1. 判断是否满足如下规则，如果是则不进行LaTeX解析
             * <pre>
             * </pre>
             */
            // 判断是否是<pre>然后开始计数，此时为第一行
            if (htmlspecialchars_decode($element) == "<pre>") {
                $pass = true;
            }

            // 如果发现是</pre>标签，则表示代码部分结束，继续处理
            if (htmlspecialchars_decode($element) == "</pre>") {
                $pass = false;
            }

            /**
             * 2. 对于使用```katex的多行LaTeX，不在里面进行单行LaTeX的重复解析
             */
            if (strpos(htmlspecialchars_decode($element), '<div class="katex math') === 0) {
                $count = 1;
                $pass = true;
            }
            
            if ($count == 3 && htmlspecialchars_decode($element) == "</div>") {
                $pass = false;
            }

            /**
             * 3. 对于其他空行或可能为HTML单行标签的行，直接跳过
             */
            if ($element == "" || $element[0] == "<" || !stripos($element, "$")) {
                $pass = true;
            }

            // 如果存在需要跳过LaTeX解析的情况，在这里跳过
            if ($pass) {
                continue;
            } else {
                $element = preg_replace_callback($regexTeXInline, array($this, "katex_src_inline"), $element);
            }
        }

        return implode("", $textarr);
    }

    public function katex_src_inline($matches) {

        $katex = $matches[1];

        $katex = $this->katex_entity_decode_editormd($katex);

        return '<span class="katex math inline">' . trim($katex) . '</span>';
    }

    public function katex_markup_double($content) {

        // 匹配多行LaTeX
        // 尽管只是多了一个$符号，却会引起指数级的回溯
        $regexTeXMultiline = '
        %
        \$\$
            ((?:
                [^$]+ # Not a dollar
                |
                (?<=(?<!\\\\)\\\\)\$ # Dollar preceded by exactly one slash
                )+)
            (?<!\\\\)
        \$\$ # Dollar preceded by zero slashes
        %ix';

        // 简易版本，可能存在误判，但尽可能简单，以避免上面这个LaTeX引起的性能问题
        $regexTeXMultilineLite = '
        %
		\$\$
			([\S\s]+?)
		\$\$
        %ix';

        $content = preg_replace_callback($regexTeXMultilineLite, array($this, "katex_src_replace"), $content);

        $textarr = wp_html_split($content);

        // 需要跳过的行数
        $count = 0;
        // 是否需要跳过LaTeX解析
        $pass  = false;

        foreach ($textarr as &$element) {
            // 默认进行LaTeX解析，如果满足下面的判断条件，则跳过
            $pass = false;

            // 判断已经跳过的行数
            if ($count > 0) {
                ++ $count;
            }

            /**
             * 1. 判断是否满足如下规则，如果是则不进行LaTeX解析
             * <pre>
             * </pre>
             */
            // 判断是否是<pre>然后开始计数，此时为第一行
            if (htmlspecialchars_decode($element) == "<pre>") {
                $pass = true;
            }

            // 如果发现是</pre>标签，则表示代码部分结束，继续处理
            if (htmlspecialchars_decode($element) == "</pre>") {
                $pass = false;
            }

            /**
             * 2. 对于其他空行或可能为HTML单行标签的行，直接跳过
             */
            if ($element == "" || $element[0] == "<" || !stripos($element, "$$")) {
                $pass = true;
            }

            // 如果存在需要跳过LaTeX解析的情况，在这里跳过
            if ($pass) {
                continue;
            } else {
                $element = preg_replace_callback($regexTeXMultiline, array($this, "katex_src_multiline"), $element);
            }
        }

        return implode("", $textarr);
    }

    public function katex_src_multiline($matches) {

        $katex = $matches[1];

        $katex = $this->katex_entity_decode_editormd($katex);

        return '<span class="katex math multi-line">' . trim($katex) . '</span>';
    }

    public function katex_src_replace($matches) {

        //在如果公式含有_则会被Markdown解析，所以现在需要转换过来
        $content = str_replace(
            array("<em>", "</em>"),
            array("_", "_"),
            $matches[0]
        );

        return $content;
    }

    /**
     * code 内公式渲染
     * @param $matches
     *
     * @return string|null
     */
    public function code_katex_src_replace($matches) {
        $matches = func_get_arg(0);

        if (! empty($matches[1])) {
            $katex = $matches[1];
            $katex = $this->katex_entity_decode_editormd($katex);
            return '<span class="katex math inline">' . trim($katex) . '</span>';
        }

        return null;
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

        //兼容模式 - jQuery
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
