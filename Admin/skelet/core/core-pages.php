<?php

/**
 * @package skelet
 */
add_action( 'admin_menu', 'paf_admin_add_pages' );

/**
 * Adds top level pages and subpages
 */
function paf_admin_add_pages() {

	global $paf_pages;

	// Do nothing if there are no pages
	if ( empty( $paf_pages ) ) {
		return;
	}

	foreach ( $paf_pages as $slug => $paf_page ) {

		// Add top level menu pages
		if ( ! K::get_var( 'parent', $paf_page ) ) {

			/**
			 * Handle position, no top level menus should have the same position
			 *
			 * - We will append a dot and the binary representation of the slug (to assure alphabetical order)
			 * - We add 5 after the dot so that menues with go to the middle, this way,
			 *   if you want a menu to go to the top use a decimal lover than .5 and vice versa
			 */
			$paf_page['position'] = K::get_var( 'position', $paf_page, null );
			if ( preg_match( '/^\d+$/', $paf_page['position'] ) ) {
				$slug_unpacked        = unpack( 'H*', $slug );
				$paf_page['position'] = ( string ) (
					$paf_page['position']
					. '.5'
					. base_convert( $slug_unpacked[1], 16, 2 )
				);
			}

			add_menu_page(
				$paf_page['title']
				, $paf_page['menu_title']
				, 'manage_options'
				, $slug
				, 'paf_page_cb'
				, $paf_page['icon_url']
				, $paf_page['position']
			);
		}

		// Add sub menu pages
		if ( K::get_var( 'parent', $paf_page ) ) {
			add_submenu_page(
				$paf_page['parent']
				, $paf_page['title']
				, $paf_page['menu_title']
				, 'manage_options'
				, $slug
				, 'paf_page_cb'
			);
		}
	}
}

/**
 * Callback function for pages
 */
function paf_page_cb() {

	global $paf;
	global $paf_options, $paf_pages, $paf_sections, $paf_tabs;
	global $paf_page_tabs, $paf_page_sections, $paf_page_options;
	global $paf_page, $paf_tab;

	// Get submit button text (looks in: tab > page > default )
	if ( $paf_tab && $submit_button_text = K::get_var( 'submit_button', $paf_page_tabs[ $paf_tab ] ) ) {
		;
	} else if ( $submit_button_text = K::get_var( 'submit_button', $paf_pages[ $paf_page ] ) ) {
		;
	} else {
		$submit_button_text = __( 'Save Changes' );
	}

	// Get reset button text (looks in: tab > page )
	if ( $paf_tab && $reset_button_text = K::get_var( 'reset_button', $paf_page_tabs[ $paf_tab ] ) ) {
		;
	} else if ( $reset_button_text = K::get_var( 'reset_button', $paf_pages[ $paf_page ] ) ) {
		;
	}

	// Start output
	echo '<div class="wrap">'
	     . '<h2>'
	     . K::get_var( 'title', $paf_pages[ $paf_page ], $paf_page )
	     . '</h2>';

	// Print tabs links
	if ( $paf_page_tabs ) {
		echo '<h2 class="nav-tab-wrapper">';
		foreach ( $paf_page_tabs as $slug => $page_tab ) {
			printf( '<a href="?page=%s&amp;tab=%s" class="nav-tab %s">%s</a>'
				, $paf_page
				, $slug
				, ( $paf_tab === $slug ) ? 'nav-tab-active' : ''
				, $page_tab['menu_title']
			);
		}
		echo '</h2>';
		echo '<h2>' . $paf_page_tabs [ $paf_tab ]['title'] . '</h2>';
	}

	// Print the options
	echo '<form id="paf-form" class="hidden" action="' . paf_url() . '" method="post">';

	// Show options that don't have sections
	reset( $paf_page_options );
	foreach ( $paf_page_options as $id => $page_option ) {
		if ( K::get_var( 'section', $page_option ) ) {
			continue;
		}
		paf_print_option( $id );
	}

	// Show options that have sections
	reset( $paf_page_options );
	foreach ( $paf_page_sections as $section_id => $page_section ) {

		K::wrap( K::get_var( 'title', $page_section, $section_id )
			, array( 'class' => 'title' )
			, array( 'in' => 'h3' )
		);

		foreach ( $paf_page_options as $id => $page_option ) {
			if ( $section_id === K::get_var( 'section', $page_option ) ) {
				paf_print_option( $id );
			}
		}
	}

	// Nonce
	wp_nonce_field( 'paf_save', 'paf_nonce' );

	// Submit and Reset buttons
	echo '<p>';
	K::input(
		'paf_submit'
		, array(
			'class' => 'button button-large button-primary',
			'href'  => '#',
			'id'    => 'paf-submit',
			'type'  => 'submit',
			'value' => $submit_button_text,
		)
		, array(
			'in' => 'input',
		)
	);
	if ( $reset_button_text ) {
		echo ' ';
		K::wrap( $reset_button_text
			, array(
				'class' => 'button button-large paf-reset',
				'href'  => '#',
				'id'    => 'paf-reset',
			)
			, array(
				'in' => 'a'
			)
		);
	}
	echo '</p>';

	echo '</form>';

	// Add JS and CSS
	paf_asset_js( 'paf', true );
	paf_asset_css( 'paf', true );

	echo '</div>';
}
