<?php

/**
 * @package skelet
 */

// Load the TinyMCE plugin
add_filter( 'mce_external_plugins', 'skelet_add_tinyMCE_plugin' );
function skelet_add_tinyMCE_plugin( $buttons ) {

	global $paf_shortcodes;

	if ( $paf_shortcodes ) {
		$buttons['skelet'] = site_url( '?skelet=tinyMCE_js' );
	}

	return $buttons;
}

// Add rewrite rules
// add_action( 'init', 'skelet_add_endpoint' );
function skelet_add_endpoint() {

	$rules = array(
		'tinyMCE\.js'                            => 'tinyMCE_js',
		'tinyMCE\.php/([a-zA-Z_][a-zA-Z0-9_-]*)' => 'tinyMCE_php&tag=$matches[1]',
	);

	foreach ( $rules as $regex => $redirect ) {
		add_rewrite_rule(
			sprintf( '^skelet/%s$', $regex )
			, sprintf( 'index.php?skelet=%s', $redirect )
			, 'top'
		);
	}
}

// Add the query_var "skelet" and "tag"
add_filter( 'query_vars', 'skelet_add_query_vars' );
function skelet_add_query_vars( $vars ) {
	$vars[] = 'skelet';
	$vars[] = 'tag';

	return $vars;
}

// Capture requests and serve files
add_action( 'parse_request', 'skelet_sniff_requests' );
function skelet_sniff_requests() {

	global $wp;
	$serve = K::get_var( 'skelet', $wp->query_vars );
	$tag   = K::get_var( 'tag', $wp->query_vars );

	switch ( $serve ) {
		case 'tinyMCE_php':
			$shortcode = K::get_var( $tag, $GLOBALS['paf_shortcodes'] );
			// Exist if shortcode doesn't exist or doesn't have parameters
			if ( ! $shortcode || ! K::get_var( 'parameters', $shortcode ) ) {
				exit;
			}
			// Show HTML for shortcode popup window
			header( 'Content-Type: text/html; charset=utf-8' );
			die( call_user_func( 'skelet_' . $serve, $tag ) );
		case 'tinyMCE_js':
			header( 'Content-Type: application/javascript; charset=utf-8' );
			die( call_user_func( 'skelet_' . $serve ) );
	}
}

// Add buttons to WordPress editor
add_filter( 'mce_buttons', 'skelet_tinyMCE_buttons' );
function skelet_tinyMCE_buttons( $buttons ) {

	$shortcodes = K::get_var( 'paf_shortcodes', $GLOBALS, array() );

	return array_merge( $buttons, array_keys( $shortcodes ) );
}

// output for "skelet/tinyMCE.php/$tag"
function skelet_tinyMCE_php( $tag ) {
	global $paf_shortcodes;

	$select2_enqueued = false;
	$protocol         = is_ssl() ? 'https' : 'http';

	// Head
	printf( '<!DOCTYPE html><html><head><meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><title></title>' );

	// CSS
	printf( '<link rel="stylesheet" href="%s" />', admin_url( 'css/common' . ( is_rtl() ? '-rtl' : '' ) . '.css' ) );
	printf( '<link rel="stylesheet" href="%s" />', admin_url( 'css/forms' . ( is_rtl() ? '-rtl' : '' ) . '.css' ) );
	printf( '<link rel="stylesheet" href="%s" />', site_url( 'wp-includes/css/dashicons' . ( is_rtl() ? '-rtl' : '' ) . '.min.css' ) );
	printf( '<link rel="stylesheet" href="%s" />', site_url( 'wp-includes/css/buttons' . ( is_rtl() ? '-rtl' : '' ) . '.min.css' ) );
	print( '<style>body { height: auto; margin: 0; min-width: 0; padding: 1em; }</style>' );

	paf_asset_css( 'paf' );

	// JS
	printf( '<script src="%s"></script>', "$protocol://cdnjs.cloudflare.com/ajax/libs/jquery/1.11.1/jquery.min.js" );
	printf( '<script src="%s"></script>', "$protocol://cdnjs.cloudflare.com/ajax/libs/jquery.serializeJSON/1.2.0/jquery.serializeJSON.min.js" );

	paf_asset_js( 'paf' );

	ob_start();
	?>
    <script>
        var paf;
        var shortcode = '';
        var wrap = <?php echo K::get_var( 'wrap', $paf_shortcodes[ $tag ] ) ? 'true' : 'false'; ?>;

        jQuery(document).ready(function ($) {

            /* Fill content field with selected text if any */
            var content = parent.tinymce.activeEditor.selection.getContent({format: 'text'});
            $('#content').val(content);

            // Update shortcode
            $('input,select,textarea', 'form').on('change keyup', function () {
                $('form').change();
            });

            // Autoselect shortcode
            $("#shortcode").mouseover(function () {
                $(this).select();
            });

            /**
             * Bind to form events
             *
             * - On submit: Fill the WP editor
             * - On change: update the shortcode value
             */
            $('form').on('submit change', function (e) {

                e.preventDefault();

                shortcode = '';
                paf = $(this).serializeJSON().paf;
                content = $('#content').val();

                if ('undefined' === typeof paf) {
                    paf = {};
                }

                // Build the shortcode
                Object.keys(paf).map(function (v) {
                    if ('undefined' !== paf[v] && paf[v]) {
                        shortcode += ' '
                            + v
                            + '="'
                            + paf[v].toString().split().join().replace('"', '\\"', 'g')
                            + '"'
                        ;
                    }
                });

                if (wrap) {
                    shortcode = "[<?php echo $tag; ?>" + shortcode + "]"
                        + content
                        + "[/<?php echo $tag; ?>]"
                    ;
                } else {
                    shortcode = "[<?php echo $tag; ?>" + shortcode + "]";
                }

                // Update the demo
                $("#shortcode").val(shortcode);

                // Fill the editor and close
                if ('submit' === e.type) {
                    parent.tinymce.activeEditor.execCommand("mceInsertContent", false, shortcode);
                    parent.tinymce.activeEditor.windowManager.close(window);
                }
            }).change();
        });
    </script>
	<?php
	print( JSMin::minify( ob_get_clean() ) );

	// Close head
	print( '</head><body class="wp-core-ui">' );

	// Fields
	$parameters = $paf_shortcodes[ $tag ]['parameters'];
	echo '<form id="paf-form" action = "">';
	foreach ( $parameters as $k => $v ) {
		// Validate title
		$v['title'] = k::get_var( 'title', $v, $k );
		// Print option
		paf_print_option( $k, $v );
		if ( 'select' === K::get_var( 'type', $v ) ) {
			printf( '<link rel="stylesheet" href="%s" />', "$protocol://cdnjs.cloudflare.com/ajax/libs/select2/3.5.0/select2.min.css" );
			printf( '<script src="%s"></script>', "$protocol://cdnjs.cloudflare.com/ajax/libs/select2/3.5.0/select2.js" );
			print( "<script>jQuery( document ).ready( function( $ ) { $( 'select' ).select2(); } );</script>" );
			$select2_enqueued = true;
		}
	}

	// Content field
	if ( K::get_var( 'wrap', $paf_shortcodes[ $tag ] ) ) {
		K::textarea( 'content'
			, array( 'class' => 'large-text', 'id' => 'content' )
			, array( 'format' => '<p><label><strong>Content:</strong>:textarea</label></p>' )
		);
	}

	// Buttons
	echo '<hr />';
	echo '<p><label><strong>Shortcode:</strong><input type="text" class="large-text" id="shortcode" value=""/></label></p>';
	echo '<hr />';
	echo '<p>';
	K::input( 'submit'
		, array(
			'class' => 'button button-large button-primary aligncenter	',
			'type'  => 'submit',
			'value' => 'Add shortcode',
		)
	);
	echo ' ';
	K::wrap( 'Reset'
		, array(
			'class' => 'button button-large paf-reset',
			'href'  => '#',
			'id'    => 'paf-reset',
		)
		, array( 'in' => 'a' )
	);
	echo '</p>';

	// Close document
	echo '</form></body></html>';

	// C ya!
	return ob_get_clean();
}

// Output for "skelet/tinyMCE.js"
function skelet_tinyMCE_js() {
	global $paf_shortcodes;
	$minify = true;

	// Prepare a shortcodes object for JavaScript
	$shortcodes = $paf_shortcodes;
	foreach ( $paf_shortcodes as $tag => $settings ) {

		// Is it a menu button
		$shortcodes[ $tag ]['isMenu'] = ( bool ) K::get_var( 'menu', $shortcodes[ $tag ] );
		$shortcodes[ $tag ]['isMenu'] && $shortcodes[ $tag ]['_type'] = 'menu';

		// Or a modal window
		$shortcodes[ $tag ]['isModal'] = ( bool ) K::get_var( 'parameters', $shortcodes[ $tag ] );
		$shortcodes[ $tag ]['isModal'] && $shortcodes[ $tag ]['_type'] = 'modal';
		$shortcodes[ $tag ]['parameters'] = array();
		unset( $shortcodes[ $tag ]['parameters'] );

		// or a normal button
		0
		|| $shortcodes[ $tag ]['isMenu']
		|| $shortcodes[ $tag ]['isModal']
		|| (
			1
			&& $shortcodes[ $tag ]['isBasic'] = true
			                                    && $shortcodes[ $tag ]['_type'] = 'basic'
		);

		// Get parent if any
		$parent = K::get_var( 'parent', $shortcodes[ $tag ] );
		if ( $parent && array_key_exists( $parent, $shortcodes )
		) {
			$shortcodes[ $tag ]['isChildOf'] = $parent;
		}
	}

	ob_start();
	?>
    /*
    <script>*/
        (function () {

            var i
                , $ = jQuery
                , s
                , shortcodes = <?php echo json_encode( $shortcodes, JSON_FORCE_OBJECT ); ?>
                , shortcodes_handlers = []
            ;

            function createShortcodeHandler(tag) {
                var s = shortcodes[tag];

                switch (s._type) {
                    case 'basic' :
                        return function () {

                            var ed = tinymce.activeEditor
                                , tag_end
                                , tag_start
                            ;

                            tag_end = '[/tag]'.replace('tag', tag);
                            tag_start = '[tag]'.replace('tag', tag);

                            /* Wrap or replace */
                            ed.selection.setContent(s.wrap
                                ? tag_start + ed.selection.getContent() + tag_end
                                : tag_start
                            );
                        };
                    case 'modal' :
                        return function () {

                            var ed = tinymce.activeEditor
                                , $w = $(window)
                                , h = ( 'undefined' !== s.height && s.height && s.height <= 1 )
                                ? $w.height() * s.height
                                : $w.height() * 0.5
                                , w = ( 'undefined' !== s.width && s.width && s.width <= 1 )
                                ? $w.width() * s.width
                                : $w.width() * 0.5
                            ;

                            ed.windowManager.open({
                                title: s.title,
                                text: s.text,
                                url: '<?php echo site_url( "?skelet=tinyMCE_php&tag=" ); ?>' + tag,
                                width: w,
                                height: h
                            });
                        };
                }
            }

            /**
             * Define shortcode handlers here
             *
             * This is a solution to the closure loops infamous issue
             */
            for (tag in shortcodes) {

                s = shortcodes[tag];

                /* Skip menus since they don't have functions */
                if (['basic', 'modal'].indexOf(s._type) == -1) {
                    continue;
                }

                shortcodes_handlers[tag] = createShortcodeHandler(tag);
            }

            /* Register the buttons */
            tinymce.create('tinymce.plugins.skelet', {
                init: function (ed, url) {

                    /* Gets sub_items recursively in a format compatible with tinyMCE */
                    var getMenuItems = function (_parent) {

                        var items = [];
                        var s;

                        /* Loop all, non-children are skipped inside */
                        for (var tag in shortcodes) {

                            s = shortcodes[tag];

                            /* Skip non-children */
                            if ('undefined' === typeof s.isChildOf || s.isChildOf !== _parent) {
                                continue;
                            }

                            /* Get item */
                            switch (s._type) {
                                case 'menu' :
                                    s.menu = getMenuItems(tag);
                                    break;
                                case 'basic' :
                                case 'modal' :
                                    s.onclick = shortcodes_handlers [tag];
                            }

                            /* Add item to array */
                            items.push(s);
                        }

                        return items;
                    };

                    /* Adds button to tinyMCE toolbar */
                    var addControl = function (tag) {

                        var s = shortcodes[tag];

                        if (s.isChildOf) {

                            /* Skip non-top-level elements, those are added by there parents */
                            return;
                        }

                        /* Get the control parameters */
                        switch (s._type) {
                            case 'menu' :
                                s.menu = getMenuItems(tag);
                                s.type = 'menubutton';
                                break;
                            case 'basic' :
                            case 'modal' :
                                s.onclick = shortcodes_handlers [tag];
                        }

                        /* Add the control */
                        return ed.addButton(tag, s);
                    };

                    /* Loops through the object defining the shortcodes and add them */
                    for (var tag in shortcodes) {

                        addControl(tag);
                    }
                }
            });
            /* Add buttons */
            tinymce.PluginManager.add('skelet', tinymce.plugins.skelet);
        })();<?php

	return empty( $minify )
		? ob_get_clean()
		: JSMin::minify( ob_get_clean() );
}

/**
 * Bind shortcodes to fuctions
 *
 * For each shortcode, the function will try functions in this order:
 * - the func parameter
 * - the tag with _func added to it
 * - the tag
 */
add_action( 'init', 'skelet_process_shortcodes' );
function skelet_process_shortcodes() {
	foreach ( K::get_var( 'paf_shortcodes', $GLOBALS, array() ) as $tag => $specs ) {
		// Get func
		$func = K::get_var( 'func', $specs );
		if ( ! function_exists( $func ) ) {
			$func = $tag . '_func';
			if ( ! function_exists( $func ) ) {
				$func = $tag;
				if ( ! function_exists( $func ) ) {
					$func = 'skelet_func';
				}
			}
		}
		// bind
		add_shortcode( $tag, $func );
	}
}

// Callback used for a shortcode when non is defined for it
function skelet_func() {
	$args['atts']    = func_get_arg( 0 );
	$args['content'] = func_get_arg( 1 );
	$tag             = func_get_arg( 2 );

	if ( $args['atts'] ) {
		$atts = substr( json_encode( $args['atts'], JSON_PRETTY_PRINT ), 2, - 2 );
	} else {
		$atts = '    ' . htmlspecialchars( '<' . __( 'none' ) . '>' );
	}

	if ( $args['content'] ) {
		$content = '    "' . $args['content'] . '"';
	} else {
		$content = '    ' . htmlspecialchars( '<' . __( 'none' ) . '>' );
	}

	$ret = '<pre>'
	       . sprintf( __( 'Shortcode <strong>%s</strong> used with parameters:' ), $tag )
	       . "\n"
	       . $atts
	       . "\n"
	       . __( 'With this enclosed content:' )
	       . "\n"
	       . $content
	       . '</pre>';

	return $ret;
}
