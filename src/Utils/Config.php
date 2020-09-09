<?php

namespace EditormdUtils;

// Config类用于优化对wp_option表的增删改查
// 接受静态调用，无需实例化，减少各模块代码量
class Config {
    /**
     * 获取字段值
     *
     * @param string $option  字段名称
     * @param string $section 字段名称分组
     * @param string $default 没搜索到返回空
     *
     * @return mixed
     */
    public static function get_option($option, $section, $default="") {

        $options = get_option($section);

        if (isset($options[$option])) {
            return $options[$option];
        }

        return $default;
    }

    /**
     * 更新配置字段值
     *
     * @param string $option   字段名称
     * @param string $section  字段名称分组
     * @param string $value    新值
     *
     * @return mixed
     */
    public static function update_option($option, $section, $value) {
        $options = get_option($section);

        $options[$option] = $value;
        update_option($section, $options);

        if (self::get_option($option, $section, "NO_DATA") == "NO_DATA") {
            return false;
        } else {
            return true;
        }
    } 
}
