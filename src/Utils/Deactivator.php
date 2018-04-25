<?php

namespace Utils;

class Deactivator {

	public static function deactivate() {

		//开启自带可视化编辑器
		global $current_user;
		update_user_option( $current_user->ID, 'rich_editing', 'true', true );

		//删除欢迎页提醒数据字段
		delete_user_option( $current_user->ID, 'dismissed_wp_pointers', true );
	}

}
