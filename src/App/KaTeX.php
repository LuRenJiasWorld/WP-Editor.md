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

		if( !in_array($GLOBALS['pagenow'], array('wp-login.php', 'wp-register.php')) ) {
			//执行公式渲染操作
			add_action( 'wp_print_footer_scripts', array( $this, 'katex_wp_footer_scripts' ) );
		}

	}

	public function katex_markup_single( $content ) {

		$textarr = wp_html_split( $content );

		//匹配行内$公式
		$regexTeXInline = '
		%
		\$
			((?:
				[^\n$]+ # Not a dollar
				|
				(?<=(?<!\\\\)\\\\)\$ # Dollar preceded by exactly one slash
				)+)
			(?<!\\\\)
		\$ # Dollar preceded by zero slashes
		%ix';

		foreach ( $textarr as &$element ) {

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

		$textarr = wp_html_split( $content );

		//匹配行内$公式
		$regexTeXInline = '
		%
		\$\$
			((?:
				[^\n$]+ # Not a dollar
				|
				(?<=(?<!\\\\)\\\\)\$ # Dollar preceded by exactly one slash
				)+)
			(?<!\\\\)
		\$\$ # Dollar preceded by zero slashes
		%ix';

		foreach ( $textarr as &$element ) {

			// 跳出循环
			if ( '' === $element || '<' === $element[0] ) {
				continue;
			}

			if ( false === stripos( $element, '$$' ) ) {
				continue;
			}

			$element = preg_replace_callback( $regexTeXInline, array( $this, 'katex_src_multiline' ), $element );
		}

		return implode( '', $textarr );
	}

	public function katex_src_multiline( $matches ) {

		$katex = $matches[1];

		$katex = $this->katex_entity_decode_editormd( $katex );

		return '<span class="katex math multi-line">' . $katex . '</span>';
	}

	/**
	 * 渲染转换
	 * @param $katex
	 *
	 * @return mixed
	 */
	public function katex_entity_decode_editormd( $katex ) {
		return str_replace(
			array( '&lt;', '&gt;', '&quot;', '&#039;', '&#038;', '&amp;', "\n", "\r" ),
			array( '<', '>', '"', "'", '&', '&', ' ', ' ' ),
			$katex
		);
	}

	public function katex_enqueue_scripts() {

		//兼容模式 - jQuery
		if( $this->get_option( 'jquery_compatible', 'editor_advanced' ) !== 'off' ) {
			wp_enqueue_script( 'jquery', null, null, array(), false );
		} else {
			wp_deregister_script('jquery');
			wp_enqueue_script( 'jQuery-CDN', '//cdn.jsdelivr.net/npm/jquery@1.12.4/dist/jquery.min.js', array(), '1.12.4', true );
		}

		//兼容模式 - KaTeX
		if( $this->get_option( 'katex_compatible', 'editor_advanced' ) !== 'off' ) {
			wp_enqueue_style( 'Katex', '//cdn.jsdelivr.net/npm/katex@0.10.0-beta/dist/katex.min.css', array(), '0.10.0-beta', 'all' );
			wp_enqueue_script( 'Katex', '//cdn.jsdelivr.net/npm/katex@0.10.0-beta/dist/katex.min.js', array(), '0.10.0-beta', false );
		} else {
			wp_enqueue_style( 'Katex', '//cdn.jsdelivr.net/npm/katex@0.10.0-beta/dist/katex.min.css', array(), '0.10.0-beta', 'all' );
			wp_enqueue_script( 'Katex', '//cdn.jsdelivr.net/npm/katex@0.10.0-beta/dist/katex.min.js', array(), '0.10.0-beta', true );
		}

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
	 * @param string $option 字段名称
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