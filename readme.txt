=== WP Editor.md - The Perfect WordPress Markdown Editor ===
Contributors: LuRenJiasWorld
Donate link: https://untitled.pw/
Tags: Editor,Markdown,Markdown Edit,Jetpack,KaTeX,PrismJS,Mermaid
Requires at least: 4.9.8
Tested up to: 5.3.2
Stable tag: 10.1.0
Requires PHP: 5.3.0
License: GPLv3 or later
License URI: https://www.gnu.org/licenses/gpl-3.0.html

WP Editor.MD is a beautiful and practical Markdown document editor.

== Description ==

WP Editor.MD is a beautiful and practical Markdown document editor.

Build support for the WordPress on Editor.md.

The plugin uses the Markdown module from WordPress [Jetpack](http://jetpack.me) for parsing and saving content.Thank for Jetpack modules.

QQ Group：[246727127](http://shang.qq.com/wpa/qunwpa?idkey=d68582245ccb7ac1c01499d0c5863624d56ee214f7816b0eedfbe3a12915e530)

Telegram Group : [WP Editor.md](https://t.me/wpeditormd)

== Installation ==

1. Upload the plugin files to the `/wp-content/plugins/plugin-name` directory, or install the plugin through the WordPress plugins screen directly.
1. Activate the plugin through the 'Plugins' screen in WordPress
1. Use the Settings->Editor.MD screen to configure the plugin
1. (Make your instructions match the desired user flow for activating and installing your plugin. Include any steps that might be needed for explanatory purposes)


== Frequently Asked Questions ==

= The network resource appears "http://cdn.staticfile.org/emoji-cheat-sheet/1.0.0" and the "https://staticfile.qnssl.com/emoji-cheat-sheet/1.0.0" connection, which What is it? =

This is where you open the Emoji option, the page needs to load some emoji picture resources if you are not sure you can turn off the Emoji option.

= CDN Accelerated Service List =

prism.js
prism.css
emojify.js
emojify.css
emoji-cheat-sheet

= Enable plugins does not work properly =

We recommend that you enable plugins in a clean environment (please disable other plugins and use default themes).

== Screenshots ==

1. Editor.md Interface - Normal Mode
2. Editor.md Interface - Write Mode
3. Editor.md Interface - Full Screen Mode

== Changelog ==

= 10.0.8 =

* 修复启用LaTeX情况下文章内包含`$`符号导致内容空白的BUG（#359 & #390）
* 修复编辑器中字数统计不准确的问题
* 修复与PHP7.4的不兼容（#399）
* 修复列表中无法插入多行代码的BUG（#392）
* 新增实时字数统计功能
* 新增在新窗口打开链接功能（需手动启用）
* 将设置菜单变更到『设置』板块，符合插件一般规范
* 优化WordPress媒体管理器图片添加用户体验

---

* Fix the issue causing the page being blank when containing the `$` character in LaTeX-enabled editor. (#359 & #390)
* Fix the issue with inaccurate word counts in the editor.
* Fix the incompatibility with PHP7.4. (#399)
* Fix the issue when inserting multiline code in lists. (#392)
* Add the real time word count feature.
* Add the open in new tab feature (manually enable in plugin settings).
* Move the settings menu to Settings menu of the WordPress admin page.
* Optimize the experience of inserting image using the WordPress Media Utilities.

注意：如果使用插件请不要使用Gutenberg编辑器，会出现文章数据丢失的问题。

More changlog please see the [Github CHANGELOG.md](https://github.com/LuRenJiasWorld/WP-Editor.md/blob/master/CHANGELOG.md)