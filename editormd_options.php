<?php
// 注册设置，添加设置字段
function editormd_options_init() {
	register_setting( 'editormd_options-group', 'editormd_options', 'editormd_options_validate' );
	add_settings_section( 'main_section', '', 'main_section_text', __FILE__ );
	add_settings_field( 'plugin_support_comment', __( 'Use Markdown For Comments', 'editormd' ), 'support_comment', __FILE__, 'main_section' );
	add_settings_field( 'plugin_theme_dark', __( 'Dark Style Theme', 'editormd' ), 'theme_dark', __FILE__, 'main_section' );
	add_settings_field( 'plugin_support_highlight', __( 'Support Syntax Highlightjs', 'editormd' ), 'support_highlight', __FILE__, 'main_section' );
	add_settings_field( 'plugin_support_highlight_library', __( 'Prism.js Highlightjs Library', 'editormd' ), 'support_highlight_library', __FILE__, 'main_section' );
	add_settings_field( 'plugin_support_highlight_library_style', __( 'Prism.js Highlightjs Style', 'editormd' ), 'support_highlight_library_style', __FILE__, 'main_section' );
	add_settings_field( 'plugin_support_highlight_line_numbers', __( 'Prism.js Line Numbers', 'editormd' ), 'support_highlight_line_numbers', __FILE__, 'main_section' );
	add_settings_field( 'plugin_support_emoji', __( 'Support Emoji', 'editormd' ), 'support_emoji', __FILE__, 'main_section' );
	add_settings_field( 'plugin_support_emoji_library', __( 'Emoji Library', 'editormd' ), 'support_emoji_library', __FILE__, 'main_section' );
	add_settings_field( 'plugin_support_latex', __( 'Support LaTeX', 'editormd' ), 'support_latex', __FILE__, 'main_section' );
	add_settings_field( 'plugin_support_toc', __( 'Support TOC', 'editormd' ), 'support_toc', __FILE__, 'main_section' );
	add_settings_field( 'plugin_support_html_decode', __( 'Support HTML Code', 'editormd' ), 'support_html_decode', __FILE__, 'main_section' );
}

//添加设置
function editormd_options_page() {
	add_options_page( 'Editor.md', 'Editor.md', 'administrator', __FILE__, 'options_page_fn' );
}

function main_section_text() {
	echo '';
}

function support_comment() {
	$markdown_url = admin_url( 'options-discussion.php#wpcom_publish_comments_with_markdown' );
	echo '<a id="plugin_support_comment" href="' . $markdown_url . '" target="_blank">' . __( 'Go', 'editormd' ) . '</a>';
}

function theme_dark() {
	$options = get_option( 'editormd_options' );
	$html    = '<input id="plugin_theme_dark" type="checkbox" name="editormd_options[theme_dark]" value="1" ' . checked( 1, isset( $options['theme_dark'] ) ? $options['theme_dark'] : 0, false ) . '/>';
	echo $html;
}

function support_highlight() {
	$options = get_option( 'editormd_options' );
	$html    = '<input id="plugin_support_highlight" type="checkbox" name="editormd_options[support_highlight]" value="1" ' . checked( 1, isset( $options['support_highlight'] ) ? $options['support_highlight'] : 0, false ) . '/>';
	echo $html;
}

function support_highlight_library() {
	$options = get_option( 'editormd_options' );
	if ( isset( $options['support_highlight_library'] ) && $options['support_highlight_library'] == '' ) {
		$support_highlight_library = WP_EDITORMD_PLUGIN_URL . '/prism';
		$html                      = '<input id="plugin_support_highlight_library" name="editormd_options[support_highlight_library]" size="40" type="text" value="' . $support_highlight_library . '" />';
	} else {
		$html = '<input id="plugin_support_highlight_library" name="editormd_options[support_highlight_library]" size="40" type="text" value="' . $options['support_highlight_library'] . '" />';
	}
	echo $html;
}

function support_highlight_library_style() {
	$options = get_option( 'editormd_options' );
	if ( isset( $options['support_highlight_library_style'] ) && $options['support_highlight_library_style'] == '' ) {
		$support_highlight_library_style = 'default';
		$html                            = '<input id="plugin_support_highlight_library_style" name="editormd_options[support_highlight_library_style]" size="40" type="text" value="' . $support_highlight_library_style . '" />';
	} else {
		$html = '<input id="plugin_support_highlight_library_style" name="editormd_options[support_highlight_library_style]" size="40" type="text" value="' . $options['support_highlight_library_style'] . '" />';
	}
	echo $html;
}

function support_highlight_line_numbers() {
	$options = get_option( 'editormd_options' );
	$html    = '<input id="plugin_support_highlight_line_numbers" type="checkbox" name="editormd_options[support_highlight_line_numbers]" value="1" ' . checked( 1, isset( $options['support_highlight_line_numbers'] ) ? $options['support_highlight_line_numbers'] : 0, false ) . '/>';
	echo $html;
}

function support_emoji() {
	$options = get_option( 'editormd_options' );
	$html    = '<input id="plugin_support_emoji" type="checkbox" name="editormd_options[support_emoji]" value="1" ' . checked( 1, isset( $options['support_emoji'] ) ? $options['support_emoji'] : 0, false ) . '/>';
	echo $html;
}

function support_emoji_library() {
	$options = get_option( 'editormd_options' );
	if ( isset( $options['support_emoji_library'] ) && $options['support_emoji_library'] == '' ) {
		$support_emoji_library = WP_EDITORMD_PLUGIN_URL . '/emojify';
		$html                  = '<input id="plugin_support_emoji_library" name="editormd_options[support_emoji_library]" size="40" type="text" value="' . $support_emoji_library . '" />';
	} else {
		$html = '<input id="plugin_support_emoji_library" name="editormd_options[support_emoji_library]" size="40" type="text" value="' . $options['support_emoji_library'] . '" />';
	}
	echo $html;
}

function support_latex() {
	$options = get_option( 'editormd_options' );
	$html    = '<input id="plugin_support_latex" type="checkbox" name="editormd_options[support_latex]" value="1" ' . checked( 1, isset( $options['support_latex'] ) ? $options['support_latex'] : 0, false ) . '/>';
	echo $html;
}

function support_toc() {
	$options   = get_option( 'editormd_options' );
	$html      = '<input id="plugin_support_toc" type="checkbox" name="editormd_options[support_toc]" value="1" ' . checked( 1, isset( $options['support_toc'] ) ? $options['support_toc'] : 0, false ) . '/>';
	$html_tips = sprintf( '<a rel="nofollow" target="_blank" href="%s">%s</a>', get_option( 'home' ) . '/wp-admin/plugin-install.php?tab=plugin-information&plugin=table-of-contents-plus&TB_iframe=true', __( 'You need install the plugin', 'editormd' ) );
	echo $html;
	echo $html_tips;
}

function support_html_decode() {
	$options = get_option( 'editormd_options' );
	$html    = '<input id="plugin_support_html_decode" type="checkbox" name="editormd_options[support_html_decode]" value="1" ' . checked( 1, isset( $options['support_html_decode'] ) ? $options['support_html_decode'] : 0, false ) . '/>';
	echo $html;
}

function options_page_fn() {
	?>
    <div class="wrap">
        <h2><?php _e( 'Editor.md Options', 'editormd' ) ?></h2>
        <p><?php _e( 'Welcome to WordPress Editor.md Markdown Text Editor', 'editormd' ) ?></p>
        <div class="postbox-container" style="width: 70%;">
            <div class="meta-box-sortables ui-sortable">
                <h3><span><?php _e( 'Settings', 'editormd' ); ?></span></h3>
                <div class="inside">
					<?php // This block needs to go into a function itself.
					?>
                    <form action="options.php" method="post">
						<?php settings_fields( 'editormd_options-group' ); ?>
						<?php do_settings_sections( __FILE__ ); ?>
						<?php
						$options = get_option( 'editormd_options' );
						//echo $options['support_highlight_line_numbers']
						?>
                        <p class="submit">
                            <input name="Submit" type="submit" class="button-primary"
                                   value="<?php esc_attr_e( 'Save Changes' ); ?>"/>
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </div>
	<?php
}

//验证用户字段
function editormd_options_validate( $input ) {
	if ( isset( $input['text_string'] ) ) {
		//检测是否包含HTML标签，包含则删除，防止SQL注入
		$input['text_string'] = wp_filter_nohtml_kses( $input['text_string'] );
	}

	//返回验证输入
	return $input;
}

add_action( 'admin_init', 'editormd_options_init' );
add_action( 'admin_menu', 'editormd_options_page' );

?>