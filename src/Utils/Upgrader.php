<?php

namespace EditormdUtils;

/**
 * 升级器类，用于版本升级时对配置进行修改
 */
class Upgrader {
	function __construct() {
        $this->run_upgrader();
    }
    
    /**
     * 升级逻辑
     * 
     * @return null
     */
    protected function run_upgrader() {
        $current_version = $this->get_current_version();

        switch($current_version) {
            case "":
                $this->any_to_10_1_0();
            case "10.1.0":
                $this->upgrade_10_1_0_to_10_1_1();
            case "10.1.1":
                $this->upgrade_10_1_1_to_10_1_2();
            default:
                break;
        }
    }

    private function upgrade_10_1_1_to_10_1_2() {
        $this->update_to_version("10.1.2");
    }

    private function upgrade_10_1_0_to_10_1_1() {
        // 升级到指定版本号
        $this->update_to_version("10.1.1");
    }

	/**
     * 任意版本升级到10.1.0
     * 
     * @return null
     */
	private function any_to_10_1_0() {
        // 暂时去除MathJax，替换为Katex
        $latexConfig = $this->get_option("support_latex", "editor_latex");
        if ($latexConfig == "mathjax") {
            $this->update_option("support_latex", "editor_latex", "katex");
        }
        
        // 新增在新窗口打开链接选项，默认为关闭
        $this->update_option("open_in_new_tab", "editor_basics", "off");

        // 新建版本号字段
        add_option("editor_version", []);

        // 升级到指定版本号
        $this->update_to_version("10.1.0");
    }
    
    /**
     * 从配置中获取当前版本号，如果没有则为空字符串
     * 
     * @return string
     */
    private function get_current_version() {
        return $this->get_option("wp_editormd_ver", "editor_version");
    }

    /**
     * 更新配置到指定版本号
     * 
     * @param string $version 目标版本号
     * 
     * @return boolean
     */
    private function update_to_version($version) {
        return $this->update_option("wp_editormd_ver", "editor_version", $version);
    }

	/**
     * 获取配置字段值
     *
     * @param string $option   字段名称
     * @param string $section  字段名称分组
     * @param string $default  没搜索到返回空
     *
     * @return mixed
     */
    private function get_option($option, $section, $default = "") {
        $options = get_option($section);

        if (isset($options[$option])) return $options[$option];
        else                          return $default;
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
    private function update_option($option, $section, $value) {
        $options = get_option($section);

        $options[$option] = $value;
        update_option($section, $options);

        if ($this->get_option($option, $section, "NO_DATA") == "NO_DATA") {
            return false;
        } else {
            return true;
        }
    } 
}