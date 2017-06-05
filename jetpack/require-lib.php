<?php

function jetpack_require_lib_editormd( $slug ) {
	if ( ! preg_match( '|^[a-z0-9/_.-]+$|i', $slug ) ) {
		trigger_error( "Cannot load a library with invalid slug $slug.", E_USER_ERROR );

		return;
	}
	$basename = basename( $slug );
	$lib_dir = dirname( __FILE__ ) . "/lib";
	$choices = array(
		"$lib_dir/$slug.php",
		"$lib_dir/$slug/0-load.php",
		"$lib_dir/$slug/$basename.php",
	);
	foreach ( $choices as $file_name ) {
		if ( is_readable( $file_name ) ) {
			require_once $file_name;

			return;
		}
	}
	trigger_error( "Cannot find a library with slug $slug.", E_USER_ERROR );
}

