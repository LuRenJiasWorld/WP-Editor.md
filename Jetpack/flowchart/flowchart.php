<?php
/**
 * FlowChart support.
 *
 * Backward compatibility requires support for both "$flow TheFlow$" shortcodes.
 *
 */

function flow_markup( $content ) {
	$textarr = wp_html_split( $content );

	$regex = '%
		\$flow(?:=\s*|\s+)
		((?:
			[^$]+ # Not a dollar
		|
			(?<=(?<!\\\\)\\\\)\$ # Dollar preceded by exactly one slash
		)+)
		(?<!\\\\)\$ # Dollar preceded by zero slashes
	%ix';

	foreach ( $textarr as &$element ) {
		if ( '' == $element || '<' === $element[0] ) {
			continue;
		}

		if ( false === stripos( $element, '$flow' ) ) {
			continue;
		}

		$element = preg_replace_callback( $regex, 'flow_src', $element );
	}

	return implode( '', $textarr );
}

function flow_src( $matches ) {
	$flow = $matches[1];

	$flow = flow_entity_decode( $flow );

	return flow_render( $flow );
}

function flow_entity_decode( $flow ) {
	return str_replace( array( '&lt;', '&gt;', '&quot;', '&#039;', '&#038;', '&amp;', "\n", "\r", "&#92;", "&#40;", "&#41;", "&#95;","&#33;" ), array( '<', '>', '"', "'", '&', '&', ' ', ' ', '\\\\', '(', ')', '_', '!' ), $flow );
}

function flow_render( $flow ) {
	return '<script type="text/javascript">document.write(katex.renderToString("'.$flow.'"));</script>';
}

add_filter( 'the_content', 'flow_markup', 9 ); // before wptexturize
add_filter( 'comment_text', 'flow_markup', 9 ); // before wptexturize
