<?php

/**
 * Main core file of the "Plugin Options" framework
 *
 * The file loads the different parts of the framework
 *
 * @package skelet
 */

/**
 * Helps tracking that the framework core was loaded
 *
 * @var bool
 */
define( 'PAF', 1 );

/**
 * Load the class K
 */
if ( ! class_exists( 'K' ) ) {

	require dirname( __FILE__ ) . '/lib/K/K.php';
}

/**
 * Load JSMin and CSSmin
 */
if ( ! class_exists( 'JSMin' ) ) {

	require dirname( __FILE__ ) . '/lib/JSMin.php';
}
if ( ! class_exists( 'CSSmin' ) ) {

	require dirname( __FILE__ ) . '/lib/CSSmin.php';
}

/**
 * Include core files
 */
foreach ( array( 'pages', 'options', 'shortcodes' ) as $core_file_name ) {

	include dirname( __FILE__ ) . '/core-' . $core_file_name . '.php';
}

/**
 * Enqueue JS/CSS
 */
function paf_enqueue() {

	$js = array(
		'highlight' => WP_EDITORMD_PLUGIN_URL . '/Admin/skelet/assets/highlight/highlight.min.js',
	);

	$css = array(
		'highlight' => WP_EDITORMD_PLUGIN_URL . '/Admin/skelet/assets/highlight/default.min.css',
	);

	foreach ( $js as $handle => $src ) {
		wp_enqueue_script( $handle, $src );
	}
	foreach ( $css as $handle => $src ) {
		wp_enqueue_style( $handle, $src );
	}
}

add_action( 'admin_init', 'paf_enqueue' );

/**
 * Load important gobal data
 *
 * The data is:
 *  - paf
 *  - paf_page_tabs
 *  - paf_page_options
 *  - paf_page_sections
 *  - paf_page_shortcodes
 *  - paf_page
 *  - paf_tab
 */
function paf_load() {

	global $paf;
	$paf = get_option( 'wp-editormd_options', array() );

	global $paf_options, $paf_pages, $paf_sections, $paf_shortcodes, $paf_tabs;

	// Make sure $GLOBALS[ 'paf_...' ] exist
	foreach ( array( 'paf_options', 'paf_pages', 'paf_sections', 'paf_shortcodes', 'paf_tabs' ) as $k ) {
		if ( empty( $GLOBALS[ $k ] ) ) {
			$GLOBALS[ $k ] = array();
		}
	}

	global $paf_page_tabs, $paf_page_options, $paf_page_sections;
	$paf_page_tabs = $paf_page_options = $paf_page_sections = array();

	global $paf_page, $paf_tab;
	$paf_page = K::get_var( 'page', $_GET );
	$paf_tab  = K::get_var( 'tab', $_GET );

	// Get defined page tabs
	foreach ( $paf_tabs as $slug => $page_tab ) {
		if ( $paf_page === $paf_tabs[ $slug ]['page'] ) {
			$paf_page_tabs[ $slug ] = $page_tab;
		}
	}

	/**
	 * Use the first tab:
	 *   - if page has tabs and none is specified in $_GET
	 *   - or if the specified tab doesn't exist
	 */
	if (
		( $paf_page_tabs && ! $paf_tab )
		|| ( $paf_page_tabs && $paf_tab && ! K::get_var( $paf_tab, $paf_page_tabs ) )
	) {
		reset( $paf_page_tabs );
		$paf_tab = key( $paf_page_tabs );
	}

	// If the page has a tab, force tab-less options to use the default tab
	reset( $paf_options );
	foreach ( $paf_options as $id => $paf_option ) {
		if ( $paf_page === K::get_var( 'page', $paf_option ) ) {
			if ( $paf_tab && ! K::get_var( 'tab', $paf_option ) ) {
				$paf_options[ $id ]['tab'] = key( $paf_page_tabs );
			}
		}
	}

	// Get defined page and tab options
	reset( $paf_options );
	foreach ( $paf_options as $id => $paf_option ) {
		if ( $paf_page === K::get_var( 'page', $paf_option ) ) {
			if ( ! $paf_tab || ( $paf_tab === $paf_option['tab'] ) ) {
				$paf_page_options[ $id ] = $paf_option;
			}
		}
	}

	// Get defined page and tab sections
	reset( $paf_page_options );
	foreach ( $paf_page_options as $id => $paf_option ) {
		if ( K::get_var( 'section', $paf_option ) ) {
			$paf_page_sections[ $paf_option['section'] ] = K::get_var( $paf_option['section'], $paf_sections, array() );
		}
	}
}

add_action( 'admin_init', 'paf_load' );

/**
 * Save options
 *
 * The function will preserve options saved on other pages
 */
function paf_save() {

	global $paf_page_options;

	// Abort saving if the nonce is not valid
	if ( ! wp_verify_nonce( K::get_var( 'paf_nonce', $_POST ), 'paf_save' ) ) {

		return;
	}

	// Force select and radio to have a value to prevent skipping empty
	// Escape text on textual fields
	$_POST['paf'] = K::get_var( 'paf', $_POST, array() );
	$_POST['paf'] = stripslashes_deep( $_POST['paf'] );
	foreach ( $paf_page_options as $option_id => $option_def ) {
		$option_type = K::get_var( 'type', $option_def, 'text' );
		switch ( $option_type ) {
			case 'text':
			case 'textarea':
				$_POST['paf'][ $option_id ] = esc_attr( K::get_var( $option_id, $_POST['paf'], '' ) );
				break;
			case 'media':
				$_POST['paf'][ $option_id ] = esc_url( K::get_var( $option_id, $_POST['paf'], '' ) );
				break;
			case 'radio':
				$_POST['paf'][ $option_id ] = K::get_var( $option_id, $_POST['paf'], '' );
				break;
			case 'checkbox':
			case 'select':
				$_POST['paf'][ $option_id ] = K::get_var( $option_id, $_POST['paf'], array() );
				break;
		}
	}

	// Combine old and saved options
	$paf = get_option( 'wp-editormd_options ', array() );
	$paf = array_merge( $paf, $_POST['paf'] );

	// Save
	delete_option( 'wp-editormd_options' );
	add_option( 'wp-editormd_options', $paf, '', true );

	// Bind showing the success message
	add_action( 'admin_notices', 'paf_notice' );
}

add_action( 'admin_init', 'paf_save' );

/**
 * Add $pages to the global $paf_pages
 */
function paf_pages( $pages ) {

	$GLOBALS['paf_pages'] = array_merge( K::get_var( 'paf_pages', $GLOBALS, array() ), $pages );
}

/**
 * Add $options to the global $paf_options
 */
function paf_options( $options ) {

	$GLOBALS['paf_options'] = array_merge( K::get_var( 'paf_options', $GLOBALS, array() ), $options );
}

/**
 * Add $tabs to the global $paf_tabs
 */
function paf_tabs( $tabs ) {

	$GLOBALS['paf_tabs'] = array_merge( K::get_var( 'paf_tabs', $GLOBALS, array() ), $tabs );
	// ksort( $GLOBALS[ 'paf_tabs' ] );
}

/**
 * Add $sections to the global $paf_sections
 */
function paf_sections( $sections ) {

	$GLOBALS['paf_sections'] = array_merge( K::get_var( 'paf_sections', $GLOBALS, array() ), $sections );
	// ksort( $GLOBALS[ 'paf_sections' ] );
}

/**
 * Add $sections to the global $paf_sections
 */
function paf_shortcodes( $shortcodes ) {

	$GLOBALS['paf_shortcodes'] = array_merge( K::get_var( 'paf_shortcodes', $GLOBALS, array() ), $shortcodes );
	// ksort( $GLOBALS[ 'paf_shortcodes' ] );
}

/**
 * Show message when options are saved successfully
 *
 * Seeks in this order: tab > page > default
 */
function paf_notice() {

	global $paf_pages, $paf_tabs, $paf_page, $paf_tab;

	// Look in tab configuration
	if ( $paf_tab && $message = K::get_var( 'success', $paf_tabs[ $paf_tab ] ) ) {
	} // Look in page configuration
	else if ( $message = K::get_var( 'success', $paf_pages[ $paf_page ] ) ) {
	} // Use default
	else {
		$message = __( 'Settings saved.' );
	}

	printf(
		'<div class="updated"><p>%s</p></div>'
		, $message
	);
}

/**
 * Adds some JS in the header:
 * - paf_assets, here paf assets can be found
 */
function paf_header() {

	$home_path   = get_home_path();
	$assets_path = str_replace(
		array( $home_path, 'core/core.php' )
		, array( '', 'assets/' )
		, __FILE__
	);

	$assets_dir_url = home_url( $assets_path );
	?>
    <script>
        var paf_assets = "<?php echo $assets_dir_url ?>";
        hljs.initHighlightingOnLoad();
    </script>
	<?php
}

add_action( 'admin_head', 'paf_header' );

/**
 * Add JS file
 */
function paf_asset_js( $asset, $block = false ) {

	return paf_asset( $asset, 'js', $block );
}

/**
 * Add CSS file
 */
function paf_asset_css( $asset, $block = false ) {

	return paf_asset( $asset, 'css', $block );
}

/**
 * Add asset
 */
function paf_asset( $asset, $type, $block = false ) {

	// Trac files that are blocked in the futire
	static $blocked = array();

	// Exit function if type is not supported
	if ( ! in_array( $type, array( 'css', 'js' ) ) ) {
		return;
	}

	$js[]  = 'paf';
	$css[] = 'paf';

	// Do nothing if asset not defined
	if ( ! in_array( $asset, $$type ) ) {
		return;
	}

	// Do nothing if already loaded
	if ( in_array( "$type/$asset", $blocked ) ) {
		return;
	}

	// Mark as blocked if needed
	if ( $block ) {
		$blocked[] = "$type/$asset";
	}

	// Get source
	$src = dirname( __FILE__ ) . "/../assets/$type/$asset.$type";
	$o   = file_get_contents( $src );

	// Minify source
	switch ( $type ) {
		case 'css':
			$CSSmin = new CSSmin();
			$o      = $CSSmin->run( $o );
		case 'js':
			$o = JSMin::minify( $o );
	}

	// Wrap in tags
	$o = sprintf( '<%s>%s</%s>'
		, 'css' === $type ? 'style' : 'script'
		, $o
		, 'css' === $type ? 'style' : 'script'
	);

	// Output
	print( $o );
}

function paf_url() {

	return 'http'
	       . ( is_ssl() ? 's' : '' )
	       . '://'
	       . $_SERVER['HTTP_HOST']
	       //. ( 80 != $_SERVER['SERVER_PORT'] ? ":$_SERVER[SERVER_PORT]" : '' )
	       . $_SERVER['REQUEST_URI'];
}

function paf_htmlspecialchars_recursive( &$array ) {

	$array = htmlspecialchars( $array );
}

function skelet_dir( $dir ) {
	foreach ( array( 'pages', 'tabs', 'sections', 'options', 'shortcodes' ) as $option_file_name ) {

		$option_file_path = $dir . '/' . $option_file_name . '.php';
		if ( file_exists( $option_file_path ) ) {
			require $option_file_path;
		}
	}
}
