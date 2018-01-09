=== WP Editor.MD ===
Contributors: 淮城一只猫
Donate link: https://iiong.com/
Tags: Edit,Markdown,Markdown Edit,Jetpack
Requires at least: 3.5
Tested up to: 4.9.1
Stable tag: 3.5
License: GPLv3 or later
License URI: https://www.gnu.org/licenses/gpl-3.0.html

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

QQ 群：[246727127](http://shang.qq.com/wpa/qunwpa?idkey=d68582245ccb7ac1c01499d0c5863624d56ee214f7816b0eedfbe3a12915e530)

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

prism.js
prism.css
emojify.js
emojify.css
emoji-cheat-sheet

= CDN Accelerated Service List =

prism.js
prism.css
emojify.js
emojify.css
emoji-cheat-sheet

= 启用插件无法正常使用 =

建议在干净的环境下启用插件，例如：停用其它插件，使用默认的主题，最新的WordPress程序等。

= Enable plugins does not work properly =

We recommend that you enable plugins in a clean environment (please disable other plugins and use default themes).

= 语法高亮库 =

不填为空则默认主题，请在[PrismJS](http://prismjs.com/download.html)。请在下面选择你所需要的的语法高亮资源以及插件，上传到CDN或者覆盖插件`prism`文件夹下面的文件即可。

= Support Highlight Library =

Empty content is the default highlight library, Go to [highlightjs] (https://highlightjs.org/static/demo/). Please select the syntax you want below and highlight the plugin, upload it to CDN or overwrite the file under the folder `prism` folder.

== Screenshots ==

1. Editor.md Interface - Normal Mode
2. Editor.md Interface - Write Mode
3. Editor.md Interface - Full Screen Mode

== Changelog ==

= 3.5 =

* 升级一些库文件
* 修复一些问题

= 3.4 =

* 取消XSS过滤
* 添加描点支持
* 修复一些bugs

= 3.3 =

* 修复加粗语法和插入图片语法导致部分语法失效的问题
* 修复编辑器在独立页面失效的问题
* 修复描点和脚注的过滤问题 Thank for [@David Kuo](https://github.com/david50407)
* 修复多媒体文件插入逻辑错误
* 支持xss和editor.md自定义外链，为后期方便扩展
* 添加文章目录按钮工具栏
* 添加插件的兼容通知

= 3.2 =

* 修复图片粘贴失效的问题
* 修复多媒体附件不同格式导致的一系列的错误
* 修复保存设置重定向问题
* 添加对时序图风格的支持
* 添加音频/视频媒体的短代码的支持

= 3.1 =

* fix some bugs

= 3.0 =

* 重写后台选项框架
* 修复流程图和时序图渲染问题[#45](https://github.com/JaxsonWang/WP-Editor.MD/issues/45) [46](https://github.com/JaxsonWang/WP-Editor.MD/issues/46)
* 修复Prism高亮文件重复加载的问题[#38](https://github.com/JaxsonWang/WP-Editor.MD/issues/38) Thank for [@giuem](https://github.com/giuem)
* 修复短代码引起的问题
* 其他一些问题的修复

= 2.8 =

* Fix Some Bugs

= 2.7 =

* `video`标签支持
* 支持Pjax环境的语法高亮
* 支持GFM Task Lists

= 2.6 =

* 支持流程图
* 支持时序图/序列图
* Fix bug for touch device [@TechCiel](https://github.com/TechCiel)
* 修复(s)ftp协议过滤的问题

= 2.5 =

* 优化科学公式加载

= 2.4 =

* 优化科学公式加载

= 2.3 =

* 修复上标和下标被过滤的问题
* 修复居中标签被过滤的问题
* 修复公式行内展示问题
* 更新marked.js版本
* 更新CodeMorror为最新版本
* 更新对新公式语法支持
* 支持评论语法高亮
* 增强文章渲染

= 2.2 =

* 优化图片粘贴逻辑代码
* 优化语法高亮逻辑
* 更新同步预览开关
* 修复某些md语法被过滤的问题
* 更新翻译

= 2.1 =

* 支持图片粘贴上传
* 支持预览窗口是否同步滚动
* 前端KaTeX科学公式和编辑器一致
* 修复部分语法高亮失效的问题

= 2.0 =

* fix bugs

= 1.9 =

* 修复toc被xss过滤的问题
* 支持自定义KaTeX加载地址
* 优化加载配置文件
* 修复`<!--more-->`被过滤的问题

* Repair toc xss filter
* Supports custom KaTeX load address
* Optimize the loading of the configuration file
* Fix `<! - more ->` filtered

= 1.8 =

* 修复Jetpack已存在的问题 [Github Jetpack #7107](https://github.com/Automattic/jetpack/pull/7107)
* 支持LaTeX公式
* 支持Prism识别代码语法高亮，感谢[@Kewell Tsao](https://github.com/kewell-tsao)和[@Giuem](https://github.com/giuem)
* 支持删除线Markdown语法
* 支持Toc文章目录功能，需要插件支持
* 支持html解析开关
* 优化编辑器显示
* 修复一些bug

* Fix Jetpack already exists [Github Jetpack #7107](https://github.com/Automattic/jetpack/pull/7107)
* Support LaTeX formula
* Support Prism recognition code syntax highlight, thanks for [@Kewell Tsao](https://github.com/kewell-tsao) and [@Giuem](https://github.com/giuem)
* Support to remove the line Markdown syntax
* Support Toc article directory function, need plug-in support
* Support html resolution switch
* Optimize the editor display
* Fix some bugs

= 1.7 =
* 修复某些情况下语法高亮渲染失败的问题;
* 修复设置超链接错误的问题,感谢@[giuem](https://github.com/giuem);
* 修复某些情况下启用选项会失效的问题;
* 修复某些情况下前端语法高亮会失效的问题;
* 修复后台回复快捷键丢失的问题;
* 更换语法高亮库为Prism,感谢@[千千](https://www.dreamwings.cn/)提供核心代码;

* Fixed some cases where syntax highlighting failed to render the problem;
* Fix the problem of setting hyperlinks,thank @[giuem](https://github.com/giuem);
* Fixed a problem where the option was disabled in some cases;
* Fixed some cases where the front-end syntax highlighting would fail;
* Repair background back to the shortcut keys lost;
* Replace the syntax highlight library for Prism, thanks @[千千](https://www.dreamwings.cn/) provide the core code;

= 1.6 =
* 修复样式被覆盖的问题;
* 支持国际化;
* 支持前端语法高亮主题更换，[详细](https://iiong.com/wordpress-plugins-wp-editormd.html#support_highlight_library);
* 从WP多媒体库插入图片语法转换成Markdown;
* 兼容Jetpack插件;
* 修复一些问题;

* Fix style is covered by the problem;
* Support internationalization;
* Support front-end syntax highlight theme replacement, [more](https://iiong.com/wordpress-plugins-wp-editormd.html#support_highlight_library);
* From the WP multimedia library to insert the image syntax into Markdown;
* Compatible with Jetpack plugin;
* Fix some bugs;

= 1.5 =
* 删除WordPress不支持的Markdown语法快捷键;
* 添加Emoji表情支持;
* 添加暗系风格主题支持;
* 添加前端语法高亮支持;
* 修复Jetpack Markdown漏洞;
* 修复某些情况下无法解析Markdown的问题，[Github #3](https://github.com/JaxsonWang/WP-Editor.MD/issues/3);

* Remove WordPress unsupported Markdown syntax shortcuts;
* Add Emoji support;
* Add dark theme support;
* Add syntax highlighting support;
* Repair the Jetpack Markdown vulnerability;
* Fixed some cases can not be resolved Markdown the problem,[Github #3](https://github.com/JaxsonWang/WP-Editor.MD/issues/3);

= 1.4 =
* 修复安全性功能;
* 除去Emoji表情支持;

* Repair the security feature;
* Remove Emoji expression support;

= 1.3 =
* 支持WP多媒体文件插入;
* 一些样式错位修复;
* 提高插件稳定性;

* Support WP Media module;
* Some style dislocation repair;
* Eliminate the unstable factors;

= 1.2 =
* 修复编辑器无法全屏的问题;

* Fix the editor can not be full screen;

= 1.1 =
* 重写框架，优化规范代码;
* 支持Emoji表情;

* Rewrite Rahmenverordnung Code-Optimierung;
* Support Emoji expression;

= 1.0 =
* 第一版本

* Initial version
