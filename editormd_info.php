<?php
function wp_upgrade_notice() {

	if (!!get_option('wp-editormd_options') != 1) {
		printf( '
			<div id="message" class="notice-info notice is-dismissible">
				<p>
					<strong>%1$s</strong>%2$s
				</p>
			</div>',
			__( 'Welcome to WordPress Markdown Editor.', 'editormd' ),
			__( 'Please turn off other markdown editor features, including the Jetpack settings in the Writing-Composing function (if you install the Jetpack plugin).', 'editormd' )
        );

	}
}

add_action('all_admin_notices', 'wp_upgrade_notice');