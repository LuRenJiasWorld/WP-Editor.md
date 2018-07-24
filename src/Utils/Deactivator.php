<?php

namespace EditormdUtils;

class Deactivator {

	public static function deactivate() {

		//开启自带可视化编辑器
		update_user_option( get_current_user_id(), 'rich_editing', 'true', true );

		//删除欢迎页提醒数据字段
		delete_user_option( get_current_user_id(), 'dismissed_wp_pointers', true );
	}

}
