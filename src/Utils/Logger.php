<?php

namespace EditormdUtils;
use Exception;

/**
 * 日志类，用于进行日志的读取和写入
 * 接受静态调用，无需实例化，减少各模块代码量
 * 默认存储七天内的所有日志
 * 日志等级：
 * - verbose : 所有调试信息，包括模块生命周期、方法调用、网络请求发送与接收
 * - info    : 基础生命周期、RESTful接口请求、脚本加载、性能报告
 * - warn    : 获取数据与预期不一致、不推荐使用或被弃用的配置与操作
 * - error   : 可能会引起系统工作不正常，通常通过try...catch捕获
 * - fatal   : 已经引起系统出现故障，无法捕获的错误
 */
class Logger {
    /**
     * @var integer 日志存储时间
     * 单位：小时
     */
    private static $log_rotate_time = 7 * 24;

    /**
     * @var float 日志清除概率
     * 数值范围为0~1
     * 每次读取/写入时都会生成一个随机值(0~1)，并与概率进行对比
     * 如果命中概率，则执行日志清除计划，清除超过存储时间的日志
     */
    private static $log_rotate_ratio = 0.1;

    /**
     * @var array<string> 日志等级枚举
     */
    private static $log_level_enum = ['verbose', 'info', 'warn', 'error', 'fatal'];

    /**
     * @var string 当前日志等级
     * 从verbose到fatal，大于等于当前等级的日志将会被记录落盘
     */
    private static $current_log_level = 'info';

    /**
     * @method static 配置日志等级
     * 
     * @param string $log_level 日志等级
     * 
     * @throws LoggerException 日志等级非法
     * 
     * @return void
     */
    public static function set_log_level($log_level) {
        if (in_array($log_level, self::$log_level_enum)) {
            self::$current_log_level = $log_level;
        } else {
            $log_level_enum_json = json_encode(self::$log_level_enum);
            throw new LoggerException(
                "Logger level invalid ! expect: $log_level_enum_json, received: $log_level"
            );
        }
    }

    /**
     * @method static __callStatic 重载PHP静态方法调用的魔术方法
     * 通过中间件的形式将$method和$args传递给需要批量生成方法的功能
     * 
     * @param string $method 方法名
     * @param array<mixed> $args 参数列表
     * 
     * @throw Exception 方法真的不存在，报错提示参考PHP方法不存在的提示
     * 
     * @return mixed 实际调用函数的结果
     */
    public static function __callStatic($method, $args) {
        $save_log_router = self::save_log_router($method, $args);
        if ($save_log_router != NULL) {
            return $save_log_router;
        } 
        
        if (isset(self::$$method)) {
            $func = self::$$method;
            return call_user_func_array($func, $args);
        }

        throw new Exception(
            sprintf("Call to undefined method %s::%s", "Logger", $method)
        );
    }
    
    // ---------------------------
    // 日志写入方法
    // ---------------------------

    /**
     * @method static 写入日志-路由
     * 
     * 接受从__callStatic传递来的调用请求，如果满足日志等级则转发给self::save_log
     * 
     * @return boolean 日志落盘是否成功
     */
    public static function save_log_router($method, $args) {
        if (in_array($method, self::$log_level_enum)) {
            return self::save_log($method, $args, self::get_context());
        }
    }

    /**
     * @method private static 写入日志-落盘
     * 
     * @param string $log_level     日志等级
     * @param mixed $log_content    日志内容
     * @param mixed $log_context    日志上下文
     * $log_content和$log_context支持非字符串，会被解析为JSON格式
     * 
     * @throw LoggerException 日志落盘失败
     * 
     * @return boolean 是否落盘成功
     */
    private static function save_log($log_level, $log_content, $log_context) {

    }

    /**
     * @method private static 获取当前上下文，以供写入日志
     * 上下文内容包含：
     * 
     * @return mixed 相关上下文
     */
    private static function get_context() {
        return [];
    }

    // ---------------------------
    // 日志读取方法
    // ---------------------------

    /**
     * @method static 获取日志
     */
    // public static function 
}

/**
 * 日志错误类，用于抛出日志功能相关错误
 */
class LoggerException extends Exception {
    
}
