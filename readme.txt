=== WP Editor.md - The Perfect WordPress Markdown Editor ===
Contributors: LuRenJiasWorld
Donate link: https://untitled.pw/
Tags: Editor,Markdown,Markdown Edit,Jetpack,KaTeX,PrismJS,Mermaid
Requires at least: 5.0.0
Tested up to: 5.4.0
Stable tag: 10.1.2
Requires PHP: 5.6.0
License: GPLv3 or later
License URI: https://www.gnu.org/licenses/gpl-3.0.html

WP Editor.MD is a beautiful and practical Markdown document editor.

== Description ==

WP Editor.MD is a beautiful and practical Markdown document editor.

Build support for the WordPress on Editor.md.

The plugin uses the Markdown module from WordPress [Jetpack](http://jetpack.me) for parsing and saving content.Thank for Jetpack modules.

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

= 10.1.2 =
* 修复部分代码高亮主题在编辑页面存在样式错误的问题
* 更新相关JavaScript依赖到最新版本
* 缩减代码体积，提升加载性能
* 新增静态资源地址一键重置功能，避免误操作出现错误后无法恢复
* 完善调试信息，新增一键导出调试信息功能
* 修复sm.ms图床无法使用的BUG(#427)
* 修复前台评论功能和兼容模式冲突的BUG
* 新增繁体中文本地化
* 修复自定义代码高亮样式无法加载的问题(#425)
* 优化安装后的默认配置，增强可用性
* 修复无法从插件页面打开设置的BUG(#429)
* 进一步修复包含$符号的文本被误识别为LaTeX文本的BUG(#420)
* 修复WordPress媒体按钮无法添加短标签到编辑器的BUG(#433)

---

* Fix issues with code highlighting styles the in post edit page.
* Update JavaScript dependencies to the newest version.
* Reducing code sizes and increase the loading performance.
* Add "Use Local" ans "Use CDN" buttons in static resource settings form for easily resetting resource addresses.
* Improving the information in debugging info and add features for exporting these info.
* Fix the issue when using sm.ms image hosting service.(#427)
* Fix the issue with post comment editor ans compatible mode conflicts.
* Add Traditional Chinese Localization support.
* Fix the issue when using customized code highlight styles.(#425)
* Optimize the default configurations after installed for better usability.
* Fix the issue that can't open plugin's settings in plugins page.(#429)
* Fix the issue that post text contains character $ was misinterpreted as LaTeX code.(#420)
* Fix the issue that can't add shortcode properly into editor from WordPress's Media Buttons.(#433)

注意：如果使用插件请不要使用Gutenberg编辑器，会出现文章数据丢失的问题。

More changlog please see the [Github CHANGELOG.md](https://github.com/LuRenJiasWorld/WP-Editor.md/blob/master/CHANGELOG.md)