=== WP Editor.MD ===
Contributors: JaxsonWang
Donate link: https://iiong.com/
Tags: Edit,Markdown,Markdown Edit,Jetpack
Requires at least: 3.0
Tested up to: 4.7.4
Stable tag: 1.6
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

WP Editor.MD是一个漂亮又实用的在线Markdown文档编辑器。

== Description ==

WP Editor.MD是一个漂亮又实用的在线Markdown文档编辑器。

WP Editor.MD is a beautiful and practical Markdown document editor.

基于Editor.md构建对WordPress平台的支持。

Build support for the WordPress on Editor.md.

使用WordPress [Jetpack](http://jetpack.me) 的Markdown模块来解析和保存内容。

The plugin uses the Markdown module from WordPress [Jetpack](http://jetpack.me) for parsing and saving content.Thank for Jetpack modules.

详细介绍： [文章介绍](https://iiong.com/wordpress-plugins-wp-editormd.html)

More introductory: [My Post](https://iiong.com/wordpress-plugins-wp-editormd.html)

QQ 群：246727127

== Installation ==

1. Upload the plugin files to the `/wp-content/plugins/plugin-name` directory, or install the plugin through the WordPress plugins screen directly.
1. Activate the plugin through the 'Plugins' screen in WordPress
1. Use the Settings->Editor.MD screen to configure the plugin
1. (Make your instructions match the desired user flow for activating and installing your plugin. Include any steps that might be needed for explanatory purposes)


== Frequently Asked Questions ==

= 这会影响网站速度吗？ =

如果默认配置的话，不会影响到前台速度。但是某些设置会在前台添加资源，例如Emoji会添加emojify.min.js等。

= The network resource appears "http://cdn.staticfile.org/emoji-cheat-sheet/1.0.0" and the "https://staticfile.qnssl.com/emoji-cheat-sheet/1.0.0" connection, which What is it? =

This is where you open the Emoji option, the page needs to load some emoji picture resources if you are not sure you can turn off the Emoji option.

= CDN 加速服务清单 =

highlight.js
emojify.js
emoji-cheat-sheet

= CDN Accelerated Service List =

Highlight.js
Emojify.js
Emoji-cheat-sheet

= 启用插件无法正常使用 =

建议在干净的环境下启用插件，例如：停用其它插件，使用默认的主题，最新的WordPress程序等。

= Enable plugins does not work properly =

We recommend that you enable plugins in a clean environment (please disable other plugins and use default themes).

= 语法高亮库 =

不填为空则默认主题，请在[highlightjs](https://highlightjs.org/static/demo/)。请在左边下侧选择自己喜欢的主题，引入主题资源地址即可。不过建议选择CDN静态资源文件。

= Support Highlight Library =

Do not fill the default theme, please [highlightjs] (https://highlightjs.org/static/demo/). Please select your favorite theme on the bottom side of the left, the introduction of the theme resource address can be. However, it is recommended to select the CDN static resource file.

== Screenshots ==

1. Editor.md Interface - Normal Mode
2. Editor.md Interface - Write Mode
3. Editor.md Interface - Full Screen Mode

== Changelog ==

= 1.6 =
* 修复样式被覆盖的问题;Fix style is covered by the problem;
* 支持国际化;Support internationalization;
* 支持前端语法高亮主题更换，[详细](https://iiong.com/wordpress-plugins-wp-editormd.html#support_highlight_library);Support front-end syntax highlight theme replacement, [more](https://iiong.com/wordpress-plugins-wp-editormd.html#support_highlight_library);
* 从WP多媒体库插入图片语法转换成Markdown;From the WP multimedia library to insert the image syntax into Markdown;
* 兼容Jetpack插件;Compatible with Jetpack plugin;
* 修复一些问题;Fix some bugs;

= 1.5 =
* 删除WordPress不支持的Markdown语法快捷键;Remove WordPress unsupported Markdown syntax shortcuts
* 添加Emoji表情支持;Add Emoji support
* 添加暗系风格主题支持;Add dark theme support
* 添加前端语法高亮支持;Add syntax highlighting support
* 修复Jetpack Markdown漏洞;Repair the Jetpack Markdown vulnerability
* 修复某些情况下无法解析Markdown的问题，[Github #3](https://github.com/JaxsonWang/WP-Editor.MD/issues/3);Fixed some cases can not be resolved Markdown the problem,[Github #3](https://github.com/JaxsonWang/WP-Editor.MD/issues/3)

= 1.4 =
* 修复安全性功能;Repair the security feature;
* 除去Emoji表情支持;Remove Emoji expression support;

= 1.3 =
* 支持WP多媒体文件插入;Support WP Media module;
* 一些样式错位修复;Some style dislocation repair;
* 提高插件稳定性;Eliminate the unstable factors;

= 1.2 =
* 修复编辑器无法全屏的问题;Fix the editor can not be full screen;

= 1.1 =
* 重写框架，优化规范代码; Rewrite Rahmenverordnung Code-Optimierung;
* 支持Emoji表情; Support Emoji expression;

= 1.0 =
* 第一版本 Initial version