# WP Editor.MD

### 此版本为开发版，请勿在线上使用

### [使用说明](./editormd/use-zh_CN.md)

![](./Interface-logo.jpg)

### 说明 Description

WP Editor.MD是一个漂亮又实用的在线Markdown文档编辑器。

WP Editor.MD is a beautiful and practical Markdown document editor.

基于[Editor.md](https://github.com/pandao/editor.md)构建对WordPress平台的支持。

Build support for the WordPress on [Editor.md](https://github.com/pandao/editor.md).

使用WordPress [Jetpack](http://jetpack.me) 的Markdown模块来解析和保存内容。

The plugin uses the Markdown module from WordPress [Jetpack](http://jetpack.me) for parsing and saving content.

### 特征 Feature

 - [x] 支持实时预览、代码插入、代码折叠等功能；
 - [x] 支持 [Emoji 表情](http://www.emoji-cheat-sheet.com/)
 - [x] 支持WordPress的多媒体插入
 - [x] 支持Toc文章目录显示
 - [x] 支持LaTeX科学公式

 ---

 - [x] Real-time Preview, Preformatted text/Code blocks/Tables insert, Search replace, Code syntax highlighting;
 - [x] Support [Emoji](http://www.emoji-cheat-sheet.com/)
 - [x] Support WordPress multimedia insertion
 - [x] Supports Toc
 - [x] Support LaTeX

### 安装 Installation

1. 上传 `WP-Editor.MD`目录 到 `/wp-content/plugins/` 目录;

1. 在后台插件菜单激活该插件;

---

- Upload the `WP-Editor.MD` directory to the `/wp-content/plugins/` directory;

- Enable the WordPress Plugins

### 截图 Screenshots

![](./Interface-editor.jpg)

![](./Interface-wp-editor.jpg)

## 更新日志 Changelog

> Version 1.8

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

> Version 1.7

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

> Version 1.6

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

> Version 1.5

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

> Version 1.4

* 修复安全性功能;
* 除去Emoji表情支持;

* Repair the security feature;
* Remove Emoji expression support;

> Version 1.3

* 支持WP多媒体文件插入;
* 一些样式错位修复;
* 提高插件稳定性;

* Support WP Media module;
* Some style dislocation repair;
* Eliminate the unstable factors;

> Version 1.2

* 修复编辑器无法全屏的问题;

* Fix the editor can not be full screen;

> Version 1.1

* 重写框架，优化规范代码;
* 支持Emoji表情;

* Rewrite Rahmenverordnung Code-Optimierung;
* Support Emoji expression;

> Version 1.0

* 第一版本

* Initial version

### 其他 Other

**启用插件发现不正常的现象，请确保在干净的环境下，例如：停用其它插件，使用默认的主题，最新的WordPress程序等。**

感谢@孫培元进行繁体翻译！

本人博客：[淮城一只猫](https://iiong.com)

My Blog: [Jaxson'Blog](https://iiong.com)

插件发布：[WP Editor.MD：一个好用的Markdown WP插件](https://iiong.com/wordpress-plugins-wp-editormd.html)

捐赠(Donation)：

![捐赠](./editormd/images/AliPay.png)

感谢您的捐赠！Thank you for your donation!

### License

![GPLv3](https://www.gnu.org/graphics/gplv3-127x51.png)

WP-Editor.MD is licensed under [GNU General Public License](https://www.gnu.org/licenses/gpl.html) Version 3 or later.

```
WP-Editor.MD is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

WP-Editor.MD is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with WP-Editor.MD.  If not, see <http://www.gnu.org/licenses/>.
```