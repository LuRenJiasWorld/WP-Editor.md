<?php
// 注册设置，添加设置字段
function editormd_options_init()
{
    register_setting('editormd_options-group', 'editormd_options', 'editormd_options_validate');
    add_settings_section('main_section', '', 'main_section_text', __FILE__);
    add_settings_field('plugin_support_comment', '使评论支持Markdown', 'support_comment',__FILE__,'main_section');
    add_settings_field('plugin_theme_dark', '暗系风格', 'theme_dark', __FILE__, 'main_section');
    add_settings_field('plugin_support_highlight', '前端支持语法高亮', 'support_highlight', __FILE__, 'main_section');
    add_settings_field('plugin_support_emoji', 'Emoji表情', 'support_emoji', __FILE__, 'main_section');
}

//添加设置
function editormd_options_page()
{
    add_options_page('Editor.md 设置', 'Editor.md 设置', 'administrator', __FILE__, 'options_page_fn');
}

function main_section_text()
{
    echo '<p>使用过程中发现问题，请到<a href="https://iiong.com/wordpress-plugins-wp-editormd.html" target="_blank" rel="nofollow">淮城一只猫</a>或者<a href="https://github.com/JaxsonWang/WP-Editor.MD/issues" target="_blank" rel="nofollow">Github</a>提交建议或者Bug，谢谢！</p>
          我的邮箱：<a href="mailto:wangjin@boxrom.com">wangjin@boxrom.com</a>';
}

function support_comment()
{
    $markdown_url = admin_url('options-discussion.php#wpcom_publish_comments_with_markdown');
    echo '<a id="plugin_support_comment" href="'.$markdown_url.'" target="_blank">点击跳转</a>';
}

function theme_dark()
{
    $options = get_option('editormd_options');
    $html = '<input id="plugin_theme_dark" type="checkbox" name="editormd_options[theme_dark]" value="1" '. checked( 1, isset( $options['theme_dark'] ) ? $options['theme_dark'] : 0, false ) .'/>';
    $html .= '夜间主题';
    echo $html;
}

function support_highlight()
{
    $options = get_option('editormd_options');
    $html = '<input id="plugin_support_highlight" type="checkbox" name="editormd_options[support_highlight]" value="1" '. checked( 1, isset( $options['support_highlight'] ) ? $options['support_highlight'] : 0, false ) .'/>';
    $html .= '前端语法高亮';
    echo $html;
}

function support_emoji()
{
    $options = get_option('editormd_options');
    $html = '<input id="plugin_support_emoji" type="checkbox" name="editormd_options[support_emoji]" value="1" '. checked( 1, isset( $options['support_emoji'] ) ? $options['support_emoji'] : 0, false ) .'/>';
    $html .= '图片类型';
    echo $html;
}

function options_page_fn()
{
    ?>
    <div class="wrap">
        <div class="icon32" id="icon-options-general"><br></div>
        <h2>Editor.md 设置</h2>
        <p>欢迎使用WordPress Editor.md Markdown文本编辑器</p>
        <div class="postbox-container" style="width: 70%;">
            <div class="meta-box-sortables ui-sortable">
                <h3 class="hndle"><span><?php _e('设置', 'hrecipe'); ?></span></h3>
                <div class="inside">
                    <?php // This block needs to go into a function itself.
                    ?>
                    <form action="options.php" method="post">
                        <?php settings_fields('editormd_options-group'); ?>
                        <?php do_settings_sections(__FILE__); ?>
                        <?php
//                        $options = get_option('editormd_options');
//                        if ($options['support_highlight'] == 1) {
//                            echo "启用";
//                        }
                        ?>
                        <p class="submit">
                            <input name="Submit" type="submit" class="button-primary"
                                   value="<?php esc_attr_e('Save Changes'); ?>"/>
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php
}

//验证用户字段
function editormd_options_validate($input)
{
    //检测是否包含HTML标签，包含则删除，防止SQL注入
    $input['text_string'] = wp_filter_nohtml_kses($input['text_string']);
    //返回验证输入
    return $input;
}

add_action('admin_init', 'editormd_options_init');
add_action('admin_menu', 'editormd_options_page');

?>