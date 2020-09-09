=== WP Editor.md - The Perfect WordPress Markdown Editor ===
Contributors: LuRenJiasWorld
Donate link: https://untitled.pw/
Tags: Editor,Markdown,Markdown Edit,Jetpack,KaTeX,PrismJS,Mermaid
Requires at least: 5.0.0
Tested up to: 5.5.0
Stable tag: 10.2.0
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

= 10.2.0 =

1. 体验提升
* 使用Webpack进行代码构建，体积缩小30%，页面加载速度更快
* 图床功能支持与sm.ms用户绑定，并支持sm.ms图床管理功能，便于更高效管理上传的图片
* 整理代码格式，完善注释，去除冗余代码，便于理解、维护、二次开发
* 编辑器支持鼠标悬浮提示，便于快速了解工具栏各按钮的用途
* 新增高亮语法支持，与Typora功能一致，现在可以使用==高亮==来实现高亮文本（#467）
* 粘贴图片时新增Loading窗口，避免误操作导致粘贴上传失败
* 设置菜单选择编辑器/预览/代码高亮样式时支持预览，帮助您更快找到喜欢的样式
* 升级后将为您跳转到发行注记页面，帮助您更快了解最新版本的更新内容

2. 故障修复
* 修复自定义风格在后台无法正常预览的问题
* 修复评论功能相关故障（#455）
* 不再误解析pre标签中的LaTeX代码
* 不对多行LaTeX中的$符号进行循环解析（#411）
* 修复特殊情况下新标签页打开链接功能无法生效的BUG（#457）
* 修复粘贴图片时连带文件名一同粘贴到编辑器的问题
* 修复后台评论无法预览的问题
* 修复全屏后窗口大小无法自适应的BUG
* 进一步解决正文中$符号被误识别为LaTeX公式导致文章空白的BUG（#420）
* 解决包含_的LaTeX公式被误解析为<em>的BUG（#411）
* 修复服务器外网不通情况下静态资源版本检查功能未设置超时导致加载缓慢的问题
* 修复在开启思维导图情况下无法启用前端评论功能的问题

3. 安全加固
* 后台编辑器预览时不再渲染如<form>、<audio>、<video>、<scripts>等与排版无关的标签（#428）

4. 其他
* 合并Editor.md代码到本项目主干（原作者@pandao已不再更新，合并便于二次开发，在未来版本实现更多功能）
* 新增依赖库相关开源协议与版权信息，规范本项目开源质量
* 升级相关依赖库到最新版本，避免安全隐患
* 修改本地化相关文本（#458，感谢@zkl2333）
* 兼容WordPress 5.5版本

---

1. Experience Enhancements
* Using webpack to build JavaScript code, reducing the final .min.js size by 30%, making WP Editor.md to load faster.
* Image uploading to sm.ms now supports binding to sm.ms user account, and also add sm.ms image management functionality into the settings page of WP Editor.md.
* Reformat the code, enhancing the maintainability, security and performance, also makes it more easily to add more feature.
* Supports mouse hover tip in editor toolbar, makes it more easily to know each button's meaning in the toolbar.
* Add markdown highlight support, just like Typora, now you can use ==highlight== to highlight any text you want. (#467)
* Add loading screen when uploading image, to prevent unexpected user actions to interrupt the uploading process.
* Supports previewing in Editor / Markdown / Code Highlight settings, helps you find your favorite style more efficiently.
* Display the release note after a successful update (like this one), to help you know more about the newest updates.

2. Bug Fixes
* Fix custom code highlightin style can't property displayed in editor.
* Fix markdown comment infinite loading issue. (#455)
* WP Editor.md will no longer extract and renderding the LaTeX code in <pre> tag.
* WP Editor.md will no longer recursively rendering the $ sign in LaTeX code. (#411)
* Fix issue causing "Open links in new page" function failed to work. (#457)
* Fix redundant filename when copy an image file and paste it into editor when image pasting is enabled.
* Fix issue in comments management causing comments invisible.
* Fix issue when the editor window is set to fullscreen then set it back to normal mode, the editor will not auto adapt screen width.
* Further fix the issue causing all post content invisible by the $ sign. (#420)
* Fix the issue that the _ sign in LaTeX formula would be incorrectly rendered as <em> like it in Markdown. (#411)
* Fix the slow loading issue when your server has a poor internet connection.
* Fix the issue causing markdown comment load infinitely when MindMap was enabled.

3. Security Reinforcements
* Editor will not preview the labels unrelated to typography like <form>``<audio> <video> <scripts> and more. (#428)

4. Other
* Merge Editor.md source code into the editor. (Original author @pandao had not working on this for nearly four years, but WP Editor.md will still add more features into it)
* Add license in every open source project dependency, enhancing the open source quality of WP Editor.md.
* Update dependency into the newest version to avoid any security issue.
* Edit some localization text. (#458，Thanks to @zkl2333)
* Compatibility work to make it works with WordPress 5.5

---

1. 體驗提升
* 使用Webpack進行代碼構建，體積縮小30%，頁麵加載速度更快
* 圖床功能支援與sm.ms用戶綁定，並支援sm.ms圖床管理功能，便於更高效管理上載的圖片
* 整理代碼格式，完善註釋，去除冗餘代碼，便於理解、維護、二次開發
* 編輯器支援滑鼠懸浮提示，便於快速了解工具欄各按鈕的用途
* 新增高亮文法支援，與Typora功能一緻，現在可以使用==高亮==來實現高亮文本（#467）
* 粘貼圖片時新增Loading視窗，避免誤操作導緻粘貼上載失敗
* 設定菜單選擇編輯器/預覽/代碼高亮樣式時支援預覽，幫助您更快找到喜歡的樣式
* 升級後將為您跳轉到發行註記頁麵，幫助您更快了解最新版本的更新內容

2. 故障修複
* 修複自定義風格在後臺無法正常預覽的問題
* 修複評論功能相關故障（#455）
* 不再誤解析pre標簽中的LaTeX代碼
* 不對多行LaTeX中的$符號進行循環解析（#411）
* 修複特殊情況下新標簽頁打開鏈接功能無法生效的BUG（#457）
* 修複粘貼圖片時連帶文件名一同粘貼到編輯器的問題
* 修複後臺評論無法預覽的問題
* 修複全屏後視窗大小無法自適應的BUG
* 進一步解決正文中$符號被誤識別為LaTeX公式導緻文章空白的BUG（#420）
* 解決包含_的LaTeX公式被誤解析為<em>的BUG（#411）
* 修複服務器外網不通情況下靜態資源版本檢查功能未設定超時導緻加載緩慢的問題
* 修複在開啓思維導圖情況下無法啓用前端評論功能的問題

3. 安全加固
* 後臺編輯器預覽時不再渲染如<form>、<audio>、<video>、<scripts>等與排版無關的標簽（#428）

4. 其他
* 合並Editor.md代碼到本項目主幹（原作者@pandao已不再更新，合並便於二次開發，在未來版本實現更多功能）
* 新增依賴庫相關開源協議與版權信息，規範本項目開源質量
* 升級相關依賴庫到最新版本，避免安全隱患
* 修改在地化相關文本（#458，感謝@zkl2333）
* 兼容WordPress 5.5版本

注意：如果使用插件请不要使用Gutenberg编辑器，会出现文章数据丢失的问题。

More changlog please see the [Github CHANGELOG.md](https://github.com/LuRenJiasWorld/WP-Editor.md/blob/master/CHANGELOG.md)