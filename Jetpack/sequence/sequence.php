<?php
/**
 * Sequence support.
 *
 * Backward compatibility requires support for both "$seq TheSequence$" shortcodes.
 *
 */

function seq_markup( $content ) {
	$textarr = wp_html_split( $content );

	$regex = '%
		\$seq(?:=\s*|\s+)
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

		if ( false === stripos( $element, '$seq' ) ) {
			continue;
		}

		$element = preg_replace_callback( $regex, 'seq_src', $element );
	}

	return implode( '', $textarr );
}

function seq_src( $matches ) {
	$seq = $matches[1];

	return '<div class="diagram">'.$seq.'</div>';
}

function seq_script() {
	$seqStyle = paf("sequence_style");
	echo '<script type="text/javascript" defer="defer">$(".diagram").sequenceDiagram({theme: "'. $seqStyle .'"})</script>';
}

add_filter( 'the_content', 'seq_markup', 9 ); // before wptexturize
add_filter( 'comment_text', 'seq_markup', 9 ); // before wptexturize
add_action( 'wp_print_footer_scripts', 'seq_script' );