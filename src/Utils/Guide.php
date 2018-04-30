<?php

namespace Utils;

class Guide {

	protected $text_domain;

	public function __construct( $text_domain ) {
		add_action( 'admin_enqueue_scripts', array( $this, 'editormd_admin_scripts' ) );
		$this->text_domain = $text_domain;
	}

	// Each pointer has its own function responsible for putting appropriate JavaScript into footer
	public function editormd_pointer_footer_script() {
		// Build the main content of your pointer balloon in a variable
		$pointer_content = __( '<h3>Hello! New WP Editor.md</h3>', $this->text_domain ); // Title should be <h3> for proper formatting.
		$pointer_content .= '<p>' .__( 'Welcome to the new version of WordPress Editor.md editor, please go to WP Editor.md to configure related settings!', $this->text_domain ) . '</p>';
		// In JavaScript below:
		// 1. "#menu-plugins" needs to be the unique id of whatever DOM element in your HTML you want to attach your pointer balloon to.
		// 2. "editormd" needs to be the unique id, for internal use, of this pointer
		// 3. "position" --
		//      edge indicates which horizontal spot to hang on to;
		//      align indicates how to align with element vertically
		?>
        <script type="text/javascript">
            // <![CDATA[
            jQuery(document).ready(function ($) {
                /* make sure pointers will actually work and have content */
                if (typeof(jQuery().pointer) !== 'undefined') {
                    $('#menu-plugins').pointer({
                        content: '<?php echo $pointer_content; ?>',
                        position: {
                            edge: 'left',
                            align: 'center'
                        },
                        close: function () {
                            $.post(ajaxurl, {
                                pointer: 'editormd',
                                action: 'dismiss-wp-pointer'
                            });
                        }
                    }).pointer('open');
                }
            });
            // ]]>
        </script>
		<?php
	}

	public function editormd_admin_scripts() {
		// You might of course have other scripts enqueued here,
		// for functionality other than WordPress Pointers.

		// WordPress Pointer Handling
		// find out which pointer ids this user has already seen
		$seen_it = explode( ',', (string) get_user_meta( get_current_user_id(), 'dismissed_wp_pointers', true ) );

		// at first assume we don't want to show pointers
		$do_add_script = false;

		// Handle our first pointer announcing the plugin's new settings screen.
		// check for dismissal of editormd settings menu pointer 'editormd'
		if ( ! in_array( 'editormd', $seen_it ) ) {
			// flip the flag enabling pointer scripts and styles to be added later
			$do_add_script = true;
			// hook to function that will output pointer script just for editormd
			add_action( 'admin_print_footer_scripts', array( $this, 'editormd_pointer_footer_script' ) );
		}

		// now finally enqueue scripts and styles if we ended up with do_add_script == TRUE
		if ( $do_add_script ) {
			// add JavaScript for WP Pointers
			wp_enqueue_script( 'wp-pointer' );
			// add CSS for WP Pointers
			wp_enqueue_style( 'wp-pointer' );
		}
	}

}