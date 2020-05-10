<?php

namespace EditormdUtils;

class Deactivator {
    public static function deactivate() {
        //删除欢迎页提醒数据字段
        delete_user_option(get_current_user_id(), "dismissed_wp_pointers", true);
    }
}
