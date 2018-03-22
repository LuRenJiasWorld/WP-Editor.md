<?php
/**
 * Created by PhpStorm.
 * User: jaxson
 * Date: 2017/7/3
 * Time: 下午5:42
 */

$wp_path = dirname( dirname( dirname( dirname( dirname( dirname( __FILE__ ) ) ) ) ) );//获取wp路径

require_once $wp_path . '/wp-load.php'; //引入wp函数库

function latex_markup_editormd( $content ) {

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

		$element = preg_replace_callback( $regex, 'latex_src_editormd', $element );
	}

	$implode = implode( '', $textarr );

	return $implode;
}

function latex_src_editormd( $matches ) {

	$latex = $matches[1];

	return '<script type="text/javascript">document.write(katex.renderToString("'.$latex.'"));</script>';
}

$a = '$$ S < 1 $$';

latex_markup_editormd( $a );

//var_dump(latex_markup_editormd($a));