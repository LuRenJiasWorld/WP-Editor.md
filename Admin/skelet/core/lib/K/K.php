<?php

/**
 * The k framework
 *
 * @author Nabil Kadimi <nabil@kadimi.com>
 * @version 1.0.4
 * @package k_framework
 */
class K {

	/**
	 * Prints or returns an input field
	 */
	static function input( $name ) {

		// $params
		if ( func_num_args() > 1 ) {
			$params = func_get_arg( 1 );
		}
		if ( empty( $params ) ) {
			$params = array();
		}

		// $args
		if ( func_num_args() > 2 ) {
			$args = func_get_arg( 2 );
		}
		if ( empty( $args ) ) {
			$args = array();
		}

		// Load defaults
		$params += array(
			'type'  => 'text',
			'id'    => '',
			'value' => ''
		);

		// Add name
		$params['name'] = $name;

		// Build the input field html
		$input = sprintf( '<input %s/>', K::params_str( $params ) );

		// Format
		if ( ! empty ( $args['format'] ) ) {
			$input = str_replace(
				array( ':input', ':name', ':id', ':value' ),
				array( $input, $name, $params['id'], $params['value'] ),
				$args['format']
			);
		}

		// Add default color picker
		if (
			! empty ( $args['colorpicker'] )
			|| (
				'text' === $params['type']
				&& preg_match( '/_color\]?$/', $name )
				&& empty( $args['nocolorpicker'] )
			)
		) {
			wp_enqueue_style( 'wp-color-picker' );
			wp_enqueue_script( 'wp-color-picker' );
			ob_start();
			?>
            <script>
                jQuery('document').ready(function ($) {
                    $('[name="<?php echo $name; ?>"]').wpColorPicker();
                });
            </script>
			<?php
			$input .= ob_get_clean();
		}

		// Print or return the input field HTML
		if ( ! empty( $args['return'] ) ) {
			return $input;
		} else {
			echo $input;
		}
	}

	/**
	 * Prepares an array of params and their values to be added to an html element
	 */
	static function params_str( $params ) {
		$params_str = '';
		foreach ( $params as $parameter => $value ) {
			if ( strlen( $value ) ) {
				$params_str .= sprintf( ' %s="%s"', $parameter, $value );
			}
		}

		return $params_str;
	}

	/**
	 * Prints or returns an input field
	 */
	static function textarea( $name ) {

		// $params
		if ( func_num_args() > 1 ) {
			$params = func_get_arg( 1 );
		}
		if ( ! is_array( $params ) ) {
			$params = array();
		}

		// $args
		if ( func_num_args() > 2 ) {
			$args = func_get_arg( 2 );
		}
		if ( ! is_array( $args ) ) {
			$args = array();
		}

		// Load defaults
		$params += array(
			'id' => '',
		);

		// Add name
		$params['name'] = $name;

		// Set $value
		$value = empty( $args['value'] ) ? '' : $args['value'];

		// Build textarea html
		if ( K::get_var( 'editor', $args ) ) {
			// Remove the name since it's attached to the editor
			$params_for_editor = $params;
			unset( $params_for_editor['name'] );
			// Build
			ob_start();
			wp_editor(
				$value,
				str_replace( array( '[', ']' ), '_', $name ) . mt_rand( 100, 999 ),
				array(
					'editor_height' => K::get_var( 'editor_height', $args ),
					'media_buttons' => K::get_var( 'media_buttons', $args, true ),
					'teeny'         => K::get_var( 'teeny', $args ),
					'textarea_name' => $name,
					'textarea_rows' => K::get_var( 'textarea_rows', $args, 20 ),
				)
			);
			$textarea = ob_get_clean();
			$textarea = sprintf( '<div %s>%s</div>', K::params_str( $params_for_editor ), $textarea );
		} else {
			$textarea = sprintf( '<textarea %s>%s</textarea>', K::params_str( $params ), $value );
		}

		// Format
		if ( ! empty ( $args['format'] ) ) {
			$textarea = str_replace(
				array( ':textarea', ':value', ':name', ':id' ),
				array( $textarea, $value, $name, $params['id'] ),
				$args['format']
			);
		}

		// Print or return the textarea field HTML
		if ( ! empty( $args['return'] ) ) {
			return $textarea;
		} else {
			echo $textarea;
		}
	}

	/**
	 * Gets a variable
	 */
	static function get_var( $name, $array = null, $default = null ) {

		if ( is_null( $array ) ) {
			$array = $GLOBALS;
		}
		if ( is_array( $array ) && array_key_exists( $name, $array ) ) {
			return $array[ $name ];
		} else {
			return $default;
		}
	}

	/**
	 * Prints or returns an dropdown select
	 */
	static function select( $name ) {

		// $params
		if ( func_num_args() > 1 ) {
			$params = func_get_arg( 1 );
		}
		if ( empty( $params ) ) {
			$params = array();
		}
		// Load defaults
		$params += array(
			'id' => '',
		);

		// Sanitize $params[multiple], and Add brackets if the former is true
		if ( ! empty( $params['multiple'] ) ) {
			$params['multiple'] = 'multiple';
			$name               .= '[]';
		}

		// Add name
		$params['name'] = $name;

		// $args
		if ( func_num_args() > 2 ) {
			$args = func_get_arg( 2 );
		}
		if ( empty( $args ) ) {
			$args = array();
		}
		$args += array(
			'default'     => '',
			'options'     => array(),
			'html_before' => '',
			'html_after'  => '',
			'selected'    => '',
		);

		// Make 'selected' an array
		if ( $selected = $args['selected'] ) {
			if ( ! is_array( $selected ) ) {
				$selected = array( $selected );
			}
		}

		// Use 'default' is 'selected' is empty
		if ( ! $selected ) {
			$selected = array( $args['default'] );
		}

		// Build options
		$options = '';
		foreach ( $args['options'] as $value => $label ) {
			$options .= K::wrap(
				$label
				, array(
					'value'    => $value,
					'selected' => ( in_array( $value, $selected ) )
						? 'selected'
						: null
				,
				)
				, array(
					'in'     => 'option',
					'return' => true,
				)
			);
		}

		// Build the input field html
		$select = sprintf( '%s<select %s>%s</select>%s', $args['html_before'], K::params_str( $params ), $options, $args['html_after'] );

		// Format
		if ( ! empty ( $args['format'] ) ) {
			$select = str_replace(
				array( ':select', ':name', ':id' ),
				array( $select, $name, $params['id'] ),
				$args['format']
			);
		}

		// Print or return the input field HTML
		if ( ! empty( $args['return'] ) ) {
			return $select;
		} else {
			echo $select;
		}
	}

	/**
	 * Wraps given input in an html tag
	 */
	static function wrap( $content = '' ) {

		// $params		
		if ( func_num_args() > 1 ) {
			$params = func_get_arg( 1 );
		}
		if ( empty( $params ) ) {
			$params = array();
		}

		// $args
		if ( func_num_args() > 2 ) {
			$args = func_get_arg( 2 );
		}
		if ( empty( $args ) ) {
			$args = array();
		}
		$args += array(
			'in'          => 'div',
			'html_before' => '',
			'html_after'  => '',
		);

		// Build the input field html
		$html = sprintf( '%s<%s %s>%s</%s>%s',
			$args['html_before'],
			$args['in'],
			K::params_str( $params ),
			$content,
			$args['in'],
			$args['html_after']
		);

		// Print or return the input field HTML
		if ( ! empty( $args['return'] ) ) {
			return $html;
		} else {
			echo $html;
		}
	}

	/**
	 * Prints or returns an input field
	 *
	 * @param array $controls The array of controls
	 */
	static function fieldset( $legend, $controls = array() ) {

		// $params
		if ( func_num_args() > 2 ) {
			$params = func_get_arg( 2 );
		}
		if ( empty( $params ) ) {
			$params = array();
		}

		// $args
		if ( func_num_args() > 3 ) {
			$args = func_get_arg( 3 );
		}
		if ( empty( $args ) ) {
			$args = array();
		}

		// Inner HTML placeholder
		$innerHTML = '';

		// Put controls in placehoder
		foreach ( $controls as $control ) {

			// Fill params if needed
			$control[2] = ! empty( $control[2] ) ? $control[2] : array();

			// Set $args['return'] to false
			if ( empty( $control[3] ) ) {
				$control[3] = array();
			}
			$control[3]['return'] = true;

			// Get control HTML
			$innerHTML .= call_user_func(
			/* Callback */
				'K::' . $control[0],
				/* Name/content */
				$control[1],
				/* Params*/
				$control[2],
				/* Args */
				$control[3]
			);
		}

		// Prepare HTML
		$HTML = str_replace(
			array( ':legend', ':controls', ':parameters' ),
			array(
				! empty( $legend ) ? $legend : '',
				$innerHTML,
				K::params_str( $params )
			),
			'<fieldset :parameters><legend>:legend</legend>:controls</fieldset>'
		);

		// Print or return the input field HTML
		if ( ! empty ( $args['return'] ) ) {
			return $HTML;
		} else {
			echo $HTML;
		}
	}
}

add_action( 'in_admin_footer', 'k_scripts' );
function k_scripts() {
	?>
    <style>
        fieldset.k {
            border: solid 1px lightgray;
            margin-bottom: 1em;
            padding-left: .5em;
            padding-right: .5em;
        }

        fieldset.k legend {
            background: white;
            padding: .25em .5em;
            box-shadow: 0 0 3px silver;
            transition: all .5s;
        }

        fieldset.k legend.highlighted {
            background: lightgray;
            box-shadow: 0 0 1px black;
        }

        fieldset.k.expanded legend {
            font-weight: bold;
        }

        fieldset.k.collapsible legend {
            cursor: pointer;
        }

        fieldset.k.collapsed :not(legend) {
            display: none;
        }

        fieldset.k.collapsed {
            display: inline;
            border: none;
        }
    </style>
    <script>
        jQuery(document).ready(function ($) {
            $('.collapsible legend').click(function () {
                $this = $(this);
                $fieldset = $this.parent();
                // Collapse all except target
                $fieldset.parent()
                    .find('fieldset')
                    .not($fieldset)
                    .removeClass('expanded')
                    .addClass('collapsed')
                    .trigger('collapse');
                // Toggle target
                $fieldset.toggleClass('collapsed');
                // Add expanded class to non-collpased and vice-versa, then trigger events
                if ($fieldset.hasClass('collapsed')) {
                    $fieldset.removeClass('expanded');
                    $fieldset.trigger('collapse');
                } else {
                    $fieldset.addClass('expanded');
                    $fieldset.trigger('expand');
                }
            });
        });
    </script>
	<?php
}
