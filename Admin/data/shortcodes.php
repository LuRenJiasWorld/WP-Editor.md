<?php
/**
 * 短代码配置
 * @Author: JaxsonWang
 */

// Make sure our temporary variable is empty
$shortcodes = array();

/**
 * $dir in this example translates to where this file resides relative to the site
 * domain name, ex: "/wp/wp-content/plugins/some_plugin/skelet". Use it to set the
 * icon paths, so if your icon is in "/wp/wp-content/plugins/some_plugin/skelet/dummy.png"
 * set "image" to "$dir/dummy.png".
 */
$dir = parse_url( site_url(), PHP_URL_PATH ) . str_replace( ABSPATH, '/', dirname( __FILE__ ) );

$shortcodes['skelet_basic'] = array(
	'title' => __( 'Insert text/ Replace selection' ),
	'wrap'  => false,
	'image' => "$dir/shortcode.png",
);
function skelet_basic_function( $atts = array(), $content = null ) {
	return sprintf( __( 'Hello from <strong>%s</strong>.' ), func_get_arg( 2 ) );
}

$shortcodes['skelet_wrap'] = array(
	'title' => __( 'Wrap Selection' ),
	'wrap'  => true,
	'image' => 'http://findicons.com/files/icons/85/kids/32/keyboard.png',
);
function skelet_wrap_function( $atts = array(), $content = null ) {
	return sprintf( __( 'Hello from <strong>%s</strong>, I was given this content: <strong>%s</strong>.' )
		, func_get_arg( 2 )
		, strlen( $content ) ? $content : '&lt;nothing&gt;'
	);
}

$shortcodes['skelet_modal'] = array(
	'title'      => __( 'With parameters (open popup)' ),
	'text'       => 'Advanced',
	'wrap'       => true,
	// 'height'     => .8,
	// 'width'      => .5,
	'parameters' => array(
		'p1' => array(
			'title'       => __( 'Title' ),
			'subtitle'    => __( 'Subtitle with <code>code</code>' ),
			'description' => __( '<i class="dashicons dashicons-editor-help"></i>Mind some help text?' ),
			'placeholder' => __( 'Oh! A placeholder...' ),
		),
		'p2' => array(
			'type'    => 'checkbox',
			'options' => 'posts',
			'args'    => array(
				'post_status' => 'publish',
				'post_type'   => 'post',
			),
		),
		'p3' => array(
			'type'     => 'radio',
			'options'  => 'terms',
			'multiple' => true,
		),
	),
);

$shortcodes['skelet_menu'] = array(
	'text'  => __( 'Nice Menu' ),
	'title' => __( 'Happy menu' ),
	'menu'  => true,
);

$shortcodes['skelet_menu_item_1'] = array(
	'text'   => __( 'Hey' ),
	'title'  => __( 'My title' ),
	'parent' => 'skelet_menu',
);

$shortcodes['skelet_modal_2'] = array(
	'title'      => __( 'Advanced' ),
	'text'       => 'Advanced #2',
	'parameters' => array(
		'p' => array(),
	),
	'parent'     => 'skelet_menu',
);

$shortcodes['lvl_0'] = array(
	'text' => __( 'Level 0' ),
	'menu' => true,
);

$shortcodes['lvl_1a'] = array(
	'text'   => __( 'replumed' ),
	'parent' => 'lvl_0',
);

$shortcodes['lvl_1b'] = array(
	'menu'   => true,
	'text'   => 'langtry',
	'parent' => 'lvl_0',
);

$shortcodes['lvl_2a'] = array(
	'menu'   => true,
	'text'   => 'orgulous',
	'parent' => 'lvl_1b',
);

$shortcodes['lvl_3a'] = array(
	'text'   => 'bermudan',
	'parent' => 'lvl_2a',
);

$shortcodes['lvl_3b'] = array(
	'menu'   => true,
	'text'   => 'unslung',
	'parent' => 'lvl_2a',
);

$shortcodes['lvl_4a'] = array(
	'text'       => 'Morocco',
	'title'      => 'Found you!',
	'parent'     => 'lvl_3b',
	'parameters' => array(
		'p1' => array(),
	),
);

// Register shortcodes
paf_shortcodes( $shortcodes );
