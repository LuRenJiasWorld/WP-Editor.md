<?php
/**
 * KaTeX support.
 *
 * Backward compatibility requires support for both "$$katex$$" shortcodes.
 *
 */

namespace App;

class KaTeX {

	public function __construct() {

		add_filter( 'the_content', array( $this, 'katex_markup_editormd' ), 9 ); // before wptexturize
		add_filter( 'comment_text', array( $this, 'katex_markup_editormd' ), 9 ); // before wptexturize
		//前端加载资源
		add_action( 'wp_enqueue_scripts', array( $this, 'katex_enqueue_scripts' ) );

		if( !in_array($GLOBALS['pagenow'], array('wp-login.php', 'wp-register.php')) ) {
			//执行公式渲染操作
			add_action( 'wp_print_footer_scripts', array( $this, 'katex_wp_footer_scripts' ) );
		}

	}

	public function katex_markup_editormd( $content ) {

		$textarr = wp_html_split( $content );

		//匹配行内$$公式
		$regexTeXInline = '
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

		foreach ( $textarr as &$element ) {

			if ( '' === $element || '<' === $element[0] ) {
				continue;
			}

			if ( false === stripos( $element, '$$' ) ) {
				continue;
			}

			$element = preg_replace_callback( $regexTeXInline, array( $this, 'katex_src_editormd' ), $element );
		}

		return implode( '', $textarr );
	}

	public function katex_src_editormd( $matches ) {

		$katex = $matches[1];

		$katex = $this->katex_entity_decode_editormd( $katex );

		return '<span class="katex math inline">' . $katex . '</span>';
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

		if ( !is_admin() ) {
			//兼容模式 - jQuery
			if( $this->get_option( 'jquery_compatible', 'editor_advanced' ) !== 'off' ) {
				wp_enqueue_script( 'jquery', null, null, array(), false );
			} else {
				wp_deregister_script('jquery');
				wp_enqueue_script( 'jQuery-CDN', $this->katex_url('jquery'), array(), '1.12.4', true );
			}

			//兼容模式 - KaTeX
			if( $this->get_option( 'katex_compatible', 'editor_advanced' ) !== 'off' ) {
				wp_enqueue_style( 'Katex', $this->katex_url('katex') . '/katex.min.css', array(), '0.9.0', 'all' );
				wp_enqueue_script( 'Katex', $this->katex_url('katex') . '/katex.min.js', array(), '0.9.0', false );
			} else {
				wp_enqueue_style( 'Katex', $this->katex_url('katex') . '/katex.min.css', array(), '0.9.0', 'all' );
				wp_enqueue_script( 'Katex', $this->katex_url('katex') . '/katex.min.js', array(), '0.9.0', true );
			}
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

	private function katex_url($lib) {
		if ( $this->get_option( 'static_cdn', 'editor_basics' ) === '//cdn.jsdelivr.net' ) {

			switch ($lib) {
				case 'jquery':
					$lib_url = $this->get_option( 'static_cdn', 'editor_basics' ) . '/npm/jquery@1.12.4/dist/jquery.min.js';
					break;
				case 'katex':
					$lib_url = $this->get_option( 'static_cdn', 'editor_basics' ) . '/npm/katex@0.9.0/dist';
					break;
			}
		} else {
			switch ($lib) {
				case 'jquery':
					$lib_url = $this->get_option( 'static_cdn', 'editor_basics' ) . '/jquery/1.12.4/jquery.min.js';
					break;
				case 'katex':
					$lib_url = $this->get_option( 'static_cdn', 'editor_basics' ) . '/KaTeX/0.9.0';
					break;
			}

		}

		return $lib_url;
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