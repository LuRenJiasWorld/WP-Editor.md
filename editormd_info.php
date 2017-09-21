<?php

defined('ABSPATH') OR exit;

function editormd_admin_notice() {
	global $pagenow;
	if ($pagenow == 'plugins.php'):
		$user_id = get_current_user_id();
		$editormd_info_visibility = get_user_meta($user_id, 'editormd_info_visibility', true);
		if ($editormd_info_visibility == 1 OR $editormd_info_visibility == ''):
			?>
            <div class="update-nag antispam-panel-info">
                <p style="margin: 0;">
					<?php printf( esc_html__( '%1$s' ), esc_attr__('Welcome to the WordPress Markdown editor,You can turn off the notification by going to the Screen Options.','editormd')); ?>
                </p>
            </div>
            <br/>
            <div class="update-nag antispam-panel-info">
                <p style="margin: 0;">
					<?php printf( esc_html__( '%1$s' ), esc_attr__('Please turn off other markdown editor features, including the Jetpack settings in the Writing-Composing function (if you install the Jetpack plugin).','editormd')); ?>
                </p>
            </div>
			<?php
		endif; // end of if($editormd_info_visibility)
	endif; // end of if($pagenow == 'plugins.php')
}
add_action('admin_notices', 'editormd_admin_notice');

function editormd_display_screen_option() {
	global $pagenow;
	if ($pagenow == 'plugins.php'):
		$user_id = get_current_user_id();
		$editormd_info_visibility = get_user_meta($user_id, 'editormd_info_visibility', true);

		if ($editormd_info_visibility == 1 OR $editormd_info_visibility == '') {
			$checked = 'checked="checked"';
		} else {
			$checked = '';
		}

		?>
		<script>
			jQuery(function($){
				$('.editormd_screen_options_group').insertAfter('#screen-options-wrap #adv-settings');
			});
		</script>
		<form method="post" class="editormd_screen_options_group" style="padding: 20px 0 5px 0;">
			<input type="hidden" name="editormd_option_submit" value="1" />
			<label>
				<input name="editormd_info_visibility" type="checkbox" value="1" <?php echo $checked; ?> />
				<?php printf( esc_html__( '%1$s' ),esc_attr__('Hidden Editor Notification','editormd')); ?>
			</label>
			<input type="submit" class="button" value="<?php _e('Apply'); ?>" />
		</form>
		<?php
	endif; // end of if($pagenow == 'plugins.php')
}


function editormd_register_screen_option() {
	add_filter('screen_layout_columns', 'editormd_display_screen_option');
}
add_action('admin_head', 'editormd_register_screen_option');


function editormd_update_screen_option() {
	if (isset($_POST['editormd_option_submit']) AND $_POST['editormd_option_submit'] == 1) {
		$user_id = get_current_user_id();
		if (isset($_POST['editormd_info_visibility']) AND $_POST['editormd_info_visibility'] == 1) {
			update_user_meta($user_id, 'editormd_info_visibility', 1);
		} else {
			update_user_meta($user_id, 'editormd_info_visibility', 0);
		}
	}
}
add_action('admin_init', 'editormd_update_screen_option');
