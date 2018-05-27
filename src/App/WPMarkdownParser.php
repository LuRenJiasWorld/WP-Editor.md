<?php

namespace App;

use Michelf\MarkdownExtra;

class WPMarkdownParser extends MarkdownExtra {

	/**
	 * Hooray somewhat arbitrary numbers that are fearful of 1.0.x.
	 */
	const WPCOM_GHF_MARDOWN_VERSION = '1.0.0';

	/**
	 * Preserve shortcodes, untouched by Markdown.
	 * This requires use within a WordPress installation.
	 * @var boolean
	 */
	public $preserve_shortcodes = true;

	/**
	 * Preserve single-line <code> blocks.
	 * @var boolean
	 */
	public $preserve_inline_code_blocks = true;

	/**
	 * Strip paragraphs from the output. This is the right default for WordPress,
	 * which generally wants to create its own paragraphs with `wpautop`
	 * @var boolean
	 */
	public $strip_paras = true;

	// Will run through sprintf - you can supply your own syntax if you want
	public $shortcode_start = '[code lang=%s]';
	public $shortcode_end = '[/code]';

	// Stores shortcodes we remove and then replace
	protected $preserve_text_hash = array();

	//TODO 变量范围是否要重写？
	public $contain_span_tags_re = 'p|h[1-6]|li|dd|dt|td|th|legend|address';

	/**
	 * Set environment defaults based on presence of key functions/classes.
	 */
	public function __construct() {
		/**
		 * Allow processing shortcode contents.
		 *
		 * @module markdown
		 *
		 * @since 4.4.0
		 *
		 * @param boolean $preserve_shortcodes Defaults to $this->preserve_shortcodes.
		 */
		$this->preserve_shortcodes = apply_filters( 'jetpack_markdown_preserve_shortcodes', $this->preserve_shortcodes ) && function_exists( 'get_shortcode_regex' );
		$this->strip_paras         = function_exists( 'wpautop' );

		$this->span_gamut += array(
			'doStrikethrough' => 55,
		);

		parent::__construct();
	}

	/**
	 * 重载方法：将标题更严格
	 * Overload to specify heading styles only if the hash has space(s) after it. This is actually in keeping with
	 * the documentation and eases the semantic overload of the hash character.
	 * #Will Not Produce a Heading 1    不会生效
	 * # This Will Produce a Heading 1  标准格式
	 *
	 * @param  string $text Markdown text
	 *
	 * @return string       HTML-transformed text
	 */
	public function transform( $text ) {
		// Preserve anything inside a single-line <code> element
		if ( $this->preserve_inline_code_blocks ) {
			$text = $this->single_line_code_preserve( $text );
		}
		// Remove all shortcodes so their interiors are left intact
		if ( $this->preserve_shortcodes ) {
			$text = $this->shortcode_preserve( $text );
		}

		// escape line-beginning # chars that do not have a space after them.
		$text = preg_replace_callback( '|^#{1,6}( )?|um', array( $this, '_doEscapeForHashWithoutSpacing' ), $text );
		/**
		 * Allow third-party plugins to define custom patterns that won't be processed by Markdown.
		 *
		 * @module markdown
		 *
		 * @since 3.9.2
		 *
		 * @param array $custom_patterns Array of custom patterns to be ignored by Markdown.
		 */
		$custom_patterns = apply_filters( 'jetpack_markdown_preserve_pattern', array() );
		if ( is_array( $custom_patterns ) && ! empty( $custom_patterns ) ) {
			foreach ( $custom_patterns as $pattern ) {
				$text = preg_replace_callback( $pattern, array( $this, '_doRemoveText' ), $text );
			}
		}

		// run through core Markdown
		$text = parent::transform( $text );

		// Occasionally Markdown Extra chokes on a para structure, producing odd paragraphs.
		$text = str_replace( "<p>&lt;</p>\n\n<p>p>", '<p>', $text );

		// put start-of-line # chars back in place
		$text = $this->restore_leading_hash( $text );

		// Strip paras if set
		if ( $this->strip_paras ) {
			$text = $this->unp( $text );
		}

		// Restore preserved things like shortcodes/LaTeX
		$text = $this->do_restore( $text );

		return $text;
	}

	/**
	 * Prevents blocks like <code>__this__</code> from turning into <code><strong>this</strong></code>
	 *
	 * @param  string $text Text that may need preserving
	 *
	 * @return string       Text that was preserved if needed
	 */
	public function single_line_code_preserve( $text ) {
		return preg_replace_callback( '|<code\b[^>]*>(.*?)</code>|', array( $this, 'do_single_line_code_preserve' ), $text );
	}

	/**
	 * Regex callback for inline code presevation
	 *
	 * @param  array $matches Regex matches
	 *
	 * @return string         Hashed content for later restoration
	 */
	public function do_single_line_code_preserve( $matches ) {
		return '<code>' . $this->hash_block( $matches[1] ) . '</code>';
	}

	/**
	 * Preserve code block contents by HTML encoding them. Useful before getting to KSES stripping.
	 *
	 * @param  string $text Markdown/HTML content
	 *
	 * @return string       Markdown/HTML content with escaped code blocks
	 */
	public function codeblock_preserve( $text ) {
		return preg_replace_callback( "/^([`~]{3})([^`\n]+)?\n([^`~]+)(\\1)/m", array( $this, 'do_codeblock_preserve' ), $text );
	}

	/**
	 * Regex callback for code block preservation.
	 *
	 * @param  array $matches Regex matches
	 *
	 * @return string         Codeblock with escaped interior
	 */
	public function do_codeblock_preserve( $matches ) {
		$block = stripslashes( $matches[3] );
		$block = esc_html( $block );
		$block = str_replace( '\\', '\\\\', $block );
		$open  = $matches[1] . $matches[2] . "\n";

		return $open . $block . $matches[4];
	}

	/**
	 * Restore previously preserved (i.e. escaped) code block contents.
	 *
	 * @param  string $text Markdown/HTML content with escaped code blocks
	 *
	 * @return string       Markdown/HTML content
	 */
	public function codeblock_restore( $text ) {
		return preg_replace_callback( "/^([`~]{3})([^`\n]+)?\n([^`~]+)(\\1)/m", array( $this, 'do_codeblock_restore' ), $text );
	}

	/**
	 * Regex callback for code block restoration (unescaping).
	 *
	 * @param  array $matches Regex matches
	 *
	 * @return string         Codeblock with unescaped interior
	 */
	public function do_codeblock_restore( $matches ) {
		$block = html_entity_decode( $matches[3], ENT_QUOTES );
		$open  = $matches[1] . $matches[2] . "\n";

		return $open . $block . $matches[4];
	}

	/**
	 * Called to preserve WP shortcodes from being formatted by Markdown in any way.
	 *
	 * @param  string $text Text in which to preserve shortcodes
	 *
	 * @return string       Text with shortcodes replaced by a hash that will be restored later
	 */
	protected function shortcode_preserve( $text ) {
		$text = preg_replace_callback( $this->get_shortcode_regex(), array( $this, '_doRemoveText' ), $text );

		return $text;
	}

	/**
	 * Restores any text preserved by $this->hash_block()
	 *
	 * @param  string $text Text that may have hashed preservation placeholders
	 *
	 * @return string       Text with hashed preseravtion placeholders replaced by original text
	 */
	protected function do_restore( $text ) {
		// Reverse hashes to ensure nested blocks are restored.
		$hashes = array_reverse( $this->preserve_text_hash, true );
		foreach ( $hashes as $hash => $value ) {
			$placeholder = $this->hash_maker( $hash );
			$text        = str_replace( $placeholder, $value, $text );
		}
		// reset the hash
		$this->preserve_text_hash = array();

		return $text;
	}

	/**
	 * Regex callback for text preservation
	 *
	 * @param  array $m Regex $matches array
	 *
	 * @return string    A placeholder that will later be replaced by the original text
	 */
	protected function _doRemoveText( $m ) {
		return $this->hash_block( $m[0] );
	}

	/**
	 * Call this to store a text block for later restoration.
	 *
	 * @param  string $text Text to preserve for later
	 *
	 * @return string       Placeholder that will be swapped out later for the original text
	 */
	protected function hash_block( $text ) {
		$hash                              = md5( $text );
		$this->preserve_text_hash[ $hash ] = $text;
		$placeholder                       = $this->hash_maker( $hash );

		return $placeholder;
	}

	/**
	 * Less glamorous than the Keymaker
	 *
	 * @param  string $hash An md5 hash
	 *
	 * @return string       A placeholder hash
	 */
	protected function hash_maker( $hash ) {
		return 'MARKDOWN_HASH' . $hash . 'MARKDOWN_HASH';
	}

	/**
	 * Remove bare <p> elements. <p>s with attributes will be preserved.
	 *
	 * @param  string $text HTML content
	 *
	 * @return string       <p>-less content
	 */
	public function unp( $text ) {
		return preg_replace( "#<p>(.*?)</p>(\n|$)#ums", '$1$2', $text );
	}

	/**
	 * A regex of all shortcodes currently registered by the current
	 * WordPress installation
	 * @uses   get_shortcode_regex()
	 * @return string A regex for grabbing shortcodes.
	 */
	protected function get_shortcode_regex() {
		$pattern = get_shortcode_regex();

		// don't match markdown link anchors that could be mistaken for shortcodes.
		$pattern .= '(?!\()';

		return "/$pattern/s";
	}

	/**
	 * Since we escape unspaced #Headings, put things back later.
	 *
	 * @param  string $text text with a leading escaped hash
	 *
	 * @return string       text with leading hashes unescaped
	 */
	protected function restore_leading_hash( $text ) {
		return preg_replace( "/^(<p>)?(&#35;|\\\\#)/um", "$1#", $text );
	}

	/**
	 * Callback for pre-processing start of line hashes to slyly escape headings that don't
	 * have a leading space
	 *
	 * @param  array $m preg_match matches
	 *
	 * @return string    possibly escaped start of line hash
	 */
	public function _doEscapeForHashWithoutSpacing( $m ) {
		if ( ! isset( $m[1] ) ) {
			$m[0] = '\\' . $m[0];
		}

		return $m[0];
	}

	/**
	 * 重载方法，支持Prism语法高亮和科学公式
	 */
	public function _doFencedCodeBlocks_callback( $matches ) {
		$classname = $matches[2];
		$attrs     = $matches[3];
		$codeblock = $matches[4];

		if ( $this->code_block_content_func ) {
			$codeblock = call_user_func( $this->code_block_content_func, $codeblock, $classname );
		} else {
			$codeblock = htmlspecialchars( $codeblock, ENT_NOQUOTES );
		}

		$codeblock = preg_replace_callback( '/^\n+/', array( $this, '_doFencedCodeBlocks_newlines' ), $codeblock );

		switch ( $classname ) {
			//Mermaid
			case "mermaid":
				$codeblock = addslashes($codeblock);
				$codeblock = preg_replace( '/\n/', '\n', $codeblock );
				$codeblock = '<div class="mermaid mermaid-diagram no-emojify"><script type="text/javascript">document.write("' . $codeblock . '");</script></div>';
				break;
			//思维导图
			case "mind":
				$codeblock = preg_replace( '/\n/', '\n', $codeblock );
				$codeblock = '<div class="mind no-emojify" style="width:100%;overflow:auto"><canvas></canvas><div class="mindTxt" style="display:none"><script type="text/javascript">document.write("' . $codeblock . '");</script></div></div>';
				break;
			//科学公式
			case "math":
				$codeblock = '<div class="katex math multi-line no-emojify">' . $codeblock . '</div>';
				break;
			//科学公式
			case "latex":
				$codeblock = '<div class="katex math multi-line no-emojify">' . $codeblock . '</div>';
				break;
			//科学公式
			case "katex":
				$codeblock = '<div class="katex math multi-line no-emojify">' . $codeblock . '</div>';
				break;
			//代码块
			default:
				//删除第一行注释块{# 注释}有个反斜杠
				$codeblock = preg_replace( '/^\\\/', '', $codeblock );

				//添加Prism相关的类名
				$lineNumbersClass = '';
				$this->get_option('line_numbers','syntax_highlighting') == 'on' ? $lineNumbersClass  = ' line-numbers' : null;

				$classes = array();
				$langname = '';
				if ( $classname != "" ) {
					if ( $classname{0} == '.' ) {
						$classname = substr( $classname, 1 );
					}

					//检验语言类型 判断归纳
					switch ($classname) {
						case 'html' :
							$classname = 'markup';
							$langname = 'HTML';
							break;
						case 'xml' :
							$classname = 'markup';
							$langname = 'XML';
							break;
						case 'svg' :
							$classname = 'markup';
							$langname = 'SVG';
							break;
						case 'mathml' :
							$classname = 'markup';
							$langname = 'MathML';
							break;
					}
					$classes[] = $this->code_class_prefix . 'language-' . $classname;
				}

				$classes[] = $lineNumbersClass;

				//更新语言标识符
				if ( $langname !== '' ) {
					$dataLanguage = ' data-language=' . $langname;
				} else {
					$dataLanguage = '';
				}

				$attr_str      = $this->doExtraAttributes( $this->code_attr_on_pre ? "pre" : "code", $attrs, null, $classes );
				$pre_attr_str  = $this->code_attr_on_pre ? $attr_str : $dataLanguage;
				$code_attr_str = $this->code_attr_on_pre ? '' : $attr_str;
				$codeblock     = "<pre$pre_attr_str><code$code_attr_str>$codeblock</code></pre>";
		}
		return "\n\n" . $this->hashBlock( $codeblock ) . "\n\n";
	}


	###  Strikethrough ###
	protected function doStrikethrough( $text ) {
		#
		# Strikethrough:
		#    in:  text ~~deleted~~ from doc
		#    out: text <del>deleted</del> from doc
		#
		$parts = preg_split( '/(?<![~])(~~)(?![~])/', $text, null, PREG_SPLIT_DELIM_CAPTURE );
		//don't bother if nothing to do...
		if ( count( $parts ) <= 1 ) {
			return $text;
		}
		$inTag = false;
		foreach ( $parts as &$part ) {
			if ( $part == '~~' ) {
				$part  = ( $inTag ? '</del>' : '<del>' );
				$inTag = ! $inTag;
			}
		}
		//no hanging delimiter
		if ( $inTag ) {
			$parts[] = '</del>';
		}

		return implode( '', $parts );
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