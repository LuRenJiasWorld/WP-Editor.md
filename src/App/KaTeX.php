<?php
/**
 * KaTeX support.
 *
 * Backward compatibility requires support for both "$$katex$$" shortcodes.
 *
 */

namespace EditormdApp;

class KaTeX {

	public function __construct() {

		//单个$或者双个$$符号匹配
		add_filter( 'the_content', array( $this, 'katex_markup_single' ), 9 );
		add_filter( 'comment_text', array( $this, 'katex_markup_single' ), 9 );

		add_filter( 'the_content', array( $this, 'katex_markup_double' ), 8 );
		add_filter( 'comment_text', array( $this, 'katex_markup_double' ), 8 );
		//前端加载资源
		add_action( 'wp_enqueue_scripts', array( $this, 'katex_enqueue_scripts' ) );

		if ( ! in_array( $GLOBALS['pagenow'], array( 'wp-login.php', 'wp-register.php' ) ) ) {
			//执行公式渲染操作
			add_action( 'wp_print_footer_scripts', array( $this, 'katex_wp_footer_scripts' ) );
		}

	}

	public function katex_markup_single( $content ) {

		//匹配行内$公式
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

		$newRegexTeXInline = '/\$(.*?)\$/ims';

		$content = preg_replace_callback( $newRegexTeXInline, array( $this, 'katex_src_replace' ),  $content);

		$textarr = wp_html_split( $content );

		// 初始化参数
		$count = 0;
		$preg  = true;

		foreach ( $textarr as &$element ) {

			//判断是否在code里面
			if ( $count > 0 ) {
				++ $count;
			}

			// 判断是否是<pre>然后开始计数，此时为第一行
			if ( htmlspecialchars_decode( $element ) == "<pre>" ) {
				$count = 1;
			}

			// 当读到第三行时，判断是code标签嘛，如果是，说明是代码，则后续不进行处理
			if ( $count == 3 && strpos( htmlspecialchars_decode( $element ), "<code class=" ) === 0 ) {
				$preg = false;
			}

			// 如果发现是</pre>标签，则表示代码部分结束，继续处理
			if ( htmlspecialchars_decode( $element ) == "</pre>" ) {
				$preg = true;
			}

			// 如果在代码中，则跳出本次循环
			if ( ! $preg ) {
				continue;
			}

			// 跳出循环
			if ( '' === $element || '<' === $element[0] ) {
				continue;
			}

			if ( false === stripos( $element, '$' ) ) {
				continue;
			}

			$element = preg_replace_callback( $regexTeXInline, array( $this, 'katex_src_inline' ), $element );
		}

		return implode( '', $textarr );
	}

	public function katex_src_inline( $matches ) {

		$katex = $matches[1];

		$katex = $this->katex_entity_decode_editormd( $katex );

		return '<span class="katex math inline">' . $katex . '</span>';
	}

	public function katex_markup_double( $content ) {

		//匹配行内$公式
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

		$content = preg_replace_callback( $regexTeXMultiline, array( $this, 'katex_src_replace' ), $content );

		$textarr = wp_html_split( $content );

		// 初始化参数
		$count = 0;
		$preg  = true;

		foreach ( $textarr as &$element ) {

			//判断是否在code里面
			if ( $count > 0 ) {
				++ $count;
			}

			// 判断是否是<pre>然后开始计数，此时为第一行
			if ( htmlspecialchars_decode( $element ) == "<pre>" ) {
				$count = 1;
			}

			// 当读到第三行时，判断是code标签嘛，如果是，说明是代码，则后续不进行处理
			if ( $count == 3 && strpos( htmlspecialchars_decode( $element ), "<code class=" ) === 0 ) {
				$preg = false;
			}

			// 如果发现是</pre>标签，则表示代码部分结束，继续处理
			if ( htmlspecialchars_decode( $element ) == "</pre>" ) {
				$preg = true;
			}

			// 如果在代码中，则跳出本次循环
			if ( ! $preg ) {
				continue;
			}

			// 跳出循环
			if ( '' === $element || '<' === $element[0] ) {
				continue;
			}

			if ( false === stripos( $element, '$$' ) ) {
				continue;
			}

			$element = preg_replace_callback( $regexTeXMultiline, array( $this, 'katex_src_multiline' ), $element );
		}

		return implode( '', $textarr );
	}

	public function katex_src_multiline( $matches ) {

		$katex = $matches[1];

		$katex = $this->katex_entity_decode_editormd( $katex );

		return '<span class="katex math multi-line">' . $katex . '</span>';
	}

	public function katex_src_replace( $matches ) {

		//在如果公式含有_则会被Markdown解析，所以现在需要转换过来
		$content = str_replace(
			array( "<em>", "</em>" ),
			array( "_", "_" ),
			$matches[0]
		);

		return $content;
	}

	/**
	 * 渲染转换
	 *
	 * @param $katex
	 *
	 * @return mixed
	 */
	public function katex_entity_decode_editormd( $katex ) {
		return str_replace(
			array( '&lt;', '&gt;', '&quot;', '&#039;', '&#038;', '&amp;', "\n", "\r", '&#60;', '&#62;', "&#40;", "&#41;", "&#95;", "&#33;", "&#123;", "&#125;", "&#94;", "&#43;","&#92;" ),
			array( '<', '>', '"', "'", '&', '&', ' ', ' ', '<', '>', '(', ')', '_', '!', '{', '}', '^', '+','\\\\' ),
			$katex );
	}

	public function katex_enqueue_scripts() {

		//兼容模式 - jQuery
		if ( $this->get_option( 'jquery_compatible', 'editor_advanced' ) !== 'off' ) {
			wp_enqueue_script( 'jquery', null, null, array(), false );
		} else {
			wp_deregister_script( 'jquery' );
			wp_enqueue_script( 'jQuery-CDN', $this->get_option('editor_addres','editor_style') . '/assets/jQuery/jquery.min.js', array(), WP_EDITORMD_VER, true );
		}

		wp_enqueue_style( 'Katex', $this->get_option('editor_addres','editor_style') . '/assets/KaTeX/katex.min.css', array(), WP_EDITORMD_VER, 'all' );
		wp_enqueue_script( 'Katex', $this->get_option('editor_addres','editor_style') . '/assets/KaTeX/katex.min.js', array(), WP_EDITORMD_VER, true );

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
                                $(this).html("<span class=\'err\'>" + err);
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
                            $(this).html("<span class=\'err\'>" + err)
                        }
                    });
                })
            })(jQuery);
        </script>
		<?php
	}

	/**
	 * 获取字段值
	 *
	 * @param string $option  字段名称
	 * @param string $section 字段名称分组
	 * @param string $default 没搜索到返回空
	 *
	 * @return mixed
	 */
	private function get_option( $option, $section, $default = '' ) {

		$options = get_option( $section );

		if ( isset( $options[ $option ] ) ) {
			return $options[ $option ];
		}

		return $default;
	}

}