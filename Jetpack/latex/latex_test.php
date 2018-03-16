<?php
/**
 * Created by PhpStorm.
 * User: jaxson
 * Date: 2017/7/3
 * Time: 下午5:42
 */

$wp_path =  dirname(dirname(dirname(dirname(dirname(dirname(__FILE__))))));//获取wp路径

require_once $wp_path . '/wp-load.php'; //引入wp函数库

function wp_html_split_iiong( $input ) {
    return preg_split( get_html_split_regex_iiong(), $input, -1, PREG_SPLIT_DELIM_CAPTURE );
}

function get_html_split_regex_iiong() {
    static $regex;

    if ( ! isset( $regex ) ) {
        $comments =
            '!'           // Start of comment, after the <.
            . '(?:'         // Unroll the loop: Consume everything until --> is found.
            .     '-(?!->)' // Dash not followed by end of comment.
            .     '[^\-]*+' // Consume non-dashes.
            . ')*+'         // Loop possessively.
            . '(?:-->)?';   // End of comment. If not found, match all input.

        $cdata =
            '!\[CDATA\['  // Start of comment, after the <.
            . '[^\]]*+'     // Consume non-].
            . '(?:'         // Unroll the loop: Consume everything until ]]> is found.
            .     '](?!]>)' // One ] not followed by end of comment.
            .     '[^\]]*+' // Consume non-].
            . ')*+'         // Loop possessively.
            . '(?:]]>)?';   // End of comment. If not found, match all input.

        $escaped =
            '(?='           // Is the element escaped?
            .    '!--'
            . '|'
            .    '!\[CDATA\['
            . ')'
            . '(?(?=!-)'      // If yes, which type?
            .     $comments
            . '|'
            .     $cdata
            . ')';

        $regex =
            '/('              // Capture the entire match.
            .     '<<'           // Find start of element.
            .     '(?'          // Conditional expression follows.
            .         $escaped  // Find end of escaped element.
            .     '|'           // ... else ...
            .         '[^>]*>?' // Find end of normal element.
            .     ')'
            . ')/';
    }

    return $regex;
}

function latex_markup_editormd( $content ) {

    $content = preg_replace("/</U","&lt;",$content);

	$textarr = wp_html_split_iiong( $content );

	var_dump($textarr);

	var_dump(wp_html_split("<<"));
	var_dump(wp_html_split(">>"));
	var_dump(wp_html_split("dsasadasd"));

	$regex = '%
		\$\$(?:=*|\s+)
		((?:
			[^$]+ # Not a dollar
		|
			(?<=(?<!\\\\)\\\\)\$ # Dollar preceded by exactly one slash
		)+)
		(?<!\\\\)\$\$ # Dollar preceded by zero slashes
	%ix';

	foreach ( $textarr as &$element ) {
		if ( '' == $element || '<' === $element[0] ) {
			continue;
		}

		if ( false === stripos( $element, '$$' ) ) {
			continue;
		}

		$element = preg_replace_callback( $regex, 'latex_src_editormd', $element );
	}

	return implode( '', $textarr );
}

function latex_src_editormd( $matches ) {
	$latex = $matches[1];

	$latex = latex_entity_decode_editormd( $latex );

	return latex_render_editormd( $latex );
}

function latex_entity_decode_editormd( $latex ) {
	return str_replace( array( '&#60;', '&lt;', '&gt;', '&quot;', '&#039;', '&#038;', '&amp;', "\n", "\r", "&#92;", "&#40;", "&#41;", "&#95;","&#33;" ), array( '<', '<', '>', '"', "'", '&', '&', ' ', ' ', '\\\\', '(', ')', '_', '!' ), $latex );
}

function latex_render_editormd( $latex ) {
	return '<script type="text/javascript">document.write(katex.renderToString("'.$latex.'"));</script>';
}

$a = '
$$
S < 1
S < 1
S < 1
$$';

latex_markup_editormd($a);

//var_dump(latex_markup_editormd($a));