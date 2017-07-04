<?php
/**
 * Created by PhpStorm.
 * User: jaxson
 * Date: 2017/7/3
 * Time: 下午5:42
 */

function latex_markup( $content ) {
	$textarr = $content ;

	$regex = '%
		\$latex(?:=\s*|\s+)
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

		if ( false === stripos( $element, '$latex' ) ) {
			continue;
		}

		$element = preg_replace_callback( $regex, 'latex_src', $element );
	}

	return implode( '', $textarr );
}

$regex = '%
		\$\$(?:=*|\s+)
		((?:
			[^$]+ # Not a dollar
		|
			(?<=(?<!\\\\)\\\\)\$ # Dollar preceded by exactly one slash
		)+)
		(?<!\\\\)\$\$ # Dollar preceded by zero slashes
	%ix';

$test = '$$12$$';

echo preg_match($regex,$test);