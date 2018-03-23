<?php
/**
 * Created by PhpStorm.
 * User: jaxson
 * Date: 2017/7/3
 * Time: 下午5:42
 */

$wp_path = dirname( dirname( dirname( dirname( dirname( dirname( __FILE__ ) ) ) ) ) );//获取wp路径

require_once $wp_path . '/wp-load.php'; //引入wp函数库

/**
 * LaTeX support.
 *
 * Backward compatibility requires support for both "[latex][/latex]", and
 * "$latex $" shortcodes.
 *
 * $latex e^{\i \pi} + 1 = 0$  ->  [latex]e^{\i \pi} + 1 = 0[/latex]
 * $latex [a, b]$              ->  [latex][a, b][/latex]
 */

function latex_markup_editormd( $content ) {
    $textarr = wp_html_split( $content );

    $regex = '%
		\$\$
		((?:
			[^$]+ # Not a dollar
		|
			(?<=(?<!\\\\)\\\\)\$ # Dollar preceded by exactly one slash
		)+)
		\$\$ # Dollar preceded by zero slashes
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

    return '<script type="text/javascript">document.write(katex.renderToString("'.$latex.'"));</script>';
}

function latex_entity_decode_editormd( $latex ) {
    return str_replace( array( '&lt;', '&gt;', '&quot;', '&#039;', '&#038;', '&amp;', "\n", "\r" ), array( '<', '>', '"', "'", '&', '&', ' ', ' ' ), $latex );
}