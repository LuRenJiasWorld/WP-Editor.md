<?php
/**
 * Module Name: Beautiful Math
 * Module Description: Use LaTeX markup for complex equations and other geekery.
 * Sort Order: 12
 * First Introduced: 1.1
 * Requires Connection: No
 * Auto Activate: Yes
 * Module Tags: Writing
 * Feature: Writing
 * Additional Search Queries: latex, math, equation, equations, formula, code
 */

/**
 * LaTeX support.
 *
 * Backward compatibility requires support for both "$latex $" shortcodes.
 *
 */

function latex_markup( $content ) {
	$textarr = wp_html_split( $content );
	
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

		$element = preg_replace_callback( $regex, 'latex_src', $element );
	}

	return implode( '', $textarr );
}

function latex_src( $matches ) {
	$latex = $matches[1];

	$latex = latex_entity_decode( $latex );

	return latex_render( $latex );
}

function latex_entity_decode( $latex ) {
	return str_replace( array( '&lt;', '&gt;', '&quot;', '&#039;', '&#038;', '&amp;', "\n", "\r" ), array( '<', '>', '"', "'", '&', '&', ' ', ' ' ), $latex );
}

function latex_render( $latex ) {
	return '<script type="text/javascript">document.write(katex.renderToString("'.$latex.'"));</script>';
}

add_filter( 'the_content', 'latex_markup', 9 ); // before wptexturize
add_filter( 'comment_text', 'latex_markup', 9 ); // before wptexturize
