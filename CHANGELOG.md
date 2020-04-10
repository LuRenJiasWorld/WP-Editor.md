# WP Editor.md

### Version 10.1.1

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

### Version 10.1.0

* 修复启用LaTeX情况下文章内包含`$`符号导致内容空白的BUG（#359）
* 修复编辑器中字数统计不准确的问题
* 修复与PHP7.4的不兼容
* 修复列表中无法插入多行代码的BUG
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

### Version 10.0.8

* 修复与WordPress5.3版本不兼容的问题
* 解决部分浏览器环境下图片粘贴功能无效的BUG
* 解决Nginx反向代理环境下`is_ssl()`判断失误的问题
* 解决`sm.ms`图床功能失效的BUG

### Version 10.0.7

* 移除富文本文章转换 markdown 文章功能
* 新增 mathjax 支持，编辑器暂未实现。

### Version 10.0.6

* 功能渲染转义问题修复

### Version 10.0.5

* 功能渲染转义问题修复
* 新增富文本文章转换 markdown 文章功能

### Version 10.0.4

* 修复思维导图地址错误问题
* code 块内 katex 公式不解析的问题
* 修复多媒体无法插入附件的问题
* 更新编辑器依赖文件和功能核心文件

### Version 10.0.3

* 修复思维导图地址错误问题

### Version 10.0.2

* 兼容Jetpack Markdown
* 兼容WordPress 5.0版本
* 修复思维导图地址错误问题

### Version 10.0.1

* 升级CodeMirror资源
* 升级Marked.js资源
* 添加丢失的资源

### Version 10.0.0

* 暂无

### Version 6.1.6

* 重写WP Media插入图片业务逻辑
* 修复markdown斜体语法编译失败的问题
* 添加切换编辑器时需要转义字符
* 优化一些配置文件

### Version 6.1.5

* [x] 优化公式矩阵换行（俩个\可以实现，不需要四个\）
* [x] 允许一些Markdown特征解析，不排除短代码
* [x] 修复公式和斜体语法引起的冲突
* [x] 修复编辑器公式可视化展示问题
* [x] 修复编辑器输入邮箱链接显示错误的问题
* [x] 修复编辑器配置逻辑错误的问题
* [x] 可自定义编辑器静态资源地址
* [x] 文章内超链接设置target属性
* [x] 修复编辑器按钮显示问题: Emoji按钮
* [x] 修复编辑器在某些情况下提示变量访问属性错误的问题
* [x] 修复编辑器在某些情况下图片粘贴失效的问题
* [x] 修复编辑器在特定分辨率错位的问题 eg: 1600 * 900
* [X] 原生编辑器和Markdown编辑器的切换 e.g: Visual Composer Support

### Version 6.1.4

* 添加PHP版本检测并添加温馨提示
* 前端资源逻辑判断的错误

### Version 6.1.3

* 修复历史上遗留下来的KaTex和代码块冲突问题 感谢[@jizhidemowang](https://github.com/jizhidemowang)代码贡献
* KaTeX公式风格习惯调整（单个$识别符号为行内公式，双个$识别符号为多行公式）
* 删除老版本资源，请升级最新版插件即可

### Version 6.1.2

* 修复前端文章跳转编辑器区域的问题
* 修复编辑器主题风格丢失的问题

### Version 6.1.1

* 修复KaTeX无法工作的问题

### Version 6.1.0

* 支持管理评论渲染
* 优化插件逻辑
* 修复图片上传失效的问题
* 完善KaTeX公式识别过程，支持$ S>1 $单个$识别公式

### Version 6.0.9

* 重写前端评论加载逻辑
* 修复编辑器列表和表格无法加载KaTeX科学公式的问题

### Version 6.0.8

* 优化插件逻辑
* 更换构建工具
* 支持前端评论渲染（注意：目前测试对默认主题兼容，其它主题未测试，如果有问题请及时反馈！）

### Version 6.0.7

* 修复mermaid在某些情况下失效的问题
* 添加分页符和摘要符可视化样式
* 提高对其他插件的兼容性

### Version 6.0.6

* Editormd核心文件更新
* 修复语法高亮选项逻辑警告
* 修复移动端错位的问题
* 修复PrismJS自动加载不规范加载css的问题

### Version 6.0.5.1

* -

### Version 6.0.5

* 添加版本最低支持
* 添加Mermaid选项配置
* 图片粘贴支持SM图库
* 图片上传支持SM图库
* 升级KaTeX版本为0.10.0-beta
* 升级PrismJS版本为1.15.0

### Version 6.0.4

* 添加Prism Copy功能
* 修复代码块含有公式被解析的问题
* 优化前端脚本显示
* 编辑器脚本加载优化
* 扩展插件链接的错误
* 添加隐藏捐赠信息选项
* 更新Markedjs版本为0.4.0 [#158](https://github.com/LuRenJiasWorld/WP-Editor.md/issues/158)
* 时序图的优化

### Version 6.0.3

* 取消单个$公式识别
* 重写Mermaid渲染，比之前快几百毫秒
* 修复Editor.md Prism不可自定义URL的问题
* 优化代码语言显示多余DOM的问题
* 更新Mermaid 8.0.0-rc.8

### Version 6.0.2

* 修复mindMap已知bug
* 修复KaTeX公式已知bug
* 其它代码改善

### Version 6.0.1

* fix the prismjs bug

### Version 6.0.0

Oh,Sorry, the version of WP Editor.md 6.0 replaces the flowchart and timing diagram features, using the more powerful [Mermaid.js](https://mermaidjs.github.io) tool. Thank you for using WP Editor.md and have a good time!

6.X版本已经废弃原有的时序图和流程图，启用更加强大的[Mermaid](https://mermaidjs.github.io)绘图工具。有原来的需求请不要升级！

* Support Mermaid(FlowChart,SequenceDiagram and GantDiagrams)
* 新的绘图工具(支持流程图，时序图和甘特图)
* 一些问题的修复


### Version 5.0.8

* 修复编辑器在特列的情况下，出现关闭按钮的情况
* 修复编辑器在全屏下被其它样式遮住
* 添加Mind Map(思维导图)支持
* 修复触屏屏幕的支持

### Version：5.0.7

* 添加Prism自定义风格选项
* 添加代码语言
* 修复前端调用自带编辑器引起的问题（类似投稿功能）

### Version：5.0.6

* 修复prism失效问题

### Version：5.0.5

* 优化Prism自动加载模式（大幅度提升性能）
* 解决一些加载问题

### Version：5.0.4

* 添加Prism Tomorrow Night主题风格
* 更换编辑器语法高亮引擎为Prism
* 修复debugger警告提示问题
* 添加KaTeX兼容选项

### Version：5.0.3

* 修复单独加载KaTeX失效的问题
* 修复暗色系主题标题看不清的问题
* 添加兼容模式（如果前端页面不正常请启用该选项）
* 添加调试信息

### Version：5.0.2

* 优化公式展示(KaTeX：displayMode)
* 添加JSDelivr CDN
* 添加[~~md~~]语法支持
* 添加图像粘贴（还有些小问题，类似web粘贴和QQ的截图正常使用，像在桌面粘贴图像会失效）
* 完善一些翻译

### Version：5.0.1
 
* 针对PHP 7.2.X某些函数做了兼容，感谢某个朋友！
* 修复重要的bug

### Version：5.0

**改版亮点：**
* 5.0版本插件代码重构
* 插件代码遵循 PSR-4 规则编写
* 大部分逻辑业务重写，业务分明，方便扩展
* 精简无用代码，大大提升插件资源性能
* 提高插件对主题以及其它插件的兼容性

**改版细节：**
 1. 允许某些HTML标签上的`markdown`属性 [Jetpack #9366](https://github.com/Automattic/jetpack/pull/9366/commits/427065a5c56aaf1d850fd10396c2afdfaf6f313a)
 1. 升级PHP Markdown内核版本为[1.8.0](https://github.com/michelf/php-markdown#version-history)
 1. 升级Editor.md依赖库版本，详细请见[Editormd](https://github.com/LuRenJiasWorld/Editormd)
 1. 全新KaTeX科学公式的前端页面渲染优化
 1. 提高KaTeX科学公式的易用性（行内公式和多行公式注意事项请看文档）
 1. 修复Prism新版本PHP语法失效
 1. 提高设置选项的易用性
 1. [TOC]不分大小写
 1. 新增十几套代码主题风格（夜间风格：dark + pastel-on-dark）

 ### 4.1
 
* 修复多行公式转义失败的问题
 
### 4.0
 
* 增强xss安全性
* 修复关闭同步滚动后输入内容右侧不更新的问题
* 修复关闭同步滚动后输入内容右侧滚动条跳转的问题
* 修复上个版本有几率公式失效的问题
* 修复编辑器marked重要漏洞
* 优化公式/时序(序列)图/流程图逻辑
* 优化列表语法逻辑 @感谢未知朋友修改
* 升级Underscore版本为1.8.3
* 升级Marked版本为0.3.17
* 升级Sequence Diagram版本为2.0.1
* 升级Raphael版本为2.2.7
* 升级FlowChart版本为1.10.0
* 升级Katex版本为0.9.0
* 升级Emojify.js版本为1.1.0
 
### 3.8
 
* 不可描述的修复
 
### 3.7
 
* 修复Katex逻辑小于号失效
 
### 3.6

* 兼容新版本Jetpack（新建文章出现500的错误）
* 修复Jetpack核心问题
 
### 3.5
 
* 升级一些库文件
* 修复一些问题
 
### 3.4
 
* 取消XSS过滤
* 添加描点支持
* 修复一些bugs
 
### 3.3
 
* 修复加粗语法和插入图片语法导致部分语法失效的问题
* 修复编辑器在独立页面失效的问题
* 修复描点和脚注的过滤问题 Thank for [@David Kuo](https://github.com/david50407)
* 修复多媒体文件插入逻辑错误
* 支持xss和editor.md自定义外链，为后期方便扩展
* 添加文章目录按钮工具栏
* 添加插件的兼容通知
 
### 3.2
 
* 修复图片粘贴失效的问题
* 修复多媒体附件不同格式导致的一系列的错误
* 修复保存设置重定向问题
* 添加对时序图风格的支持
* 添加音频/视频媒体的短代码的支持
 
### 3.1
 
* fix some bugs
 
### 3.0
 
* 重写后台选项框架
* 修复流程图和时序图渲染问题[#45](https://github.com/LuRenJiasWorld/WP-Editor.MD/issues/45) [46](https://github.com/LuRenJiasWorld/WP-Editor.MD/issues/46)
* 修复Prism高亮文件重复加载的问题[#38](https://github.com/LuRenJiasWorld/WP-Editor.MD/issues/38) Thank for [@giuem](https://github.com/giuem)
* 修复短代码引起的问题
* 其他一些问题的修复
 
### 2.8
 
* Fix Some Bugs
 
### 2.7
 
* `video`标签支持
* 支持Pjax环境的语法高亮
* 支持GFM Task Lists
 
### 2.6
 
* 支持流程图
* 支持时序图/序列图
* Fix bug for touch device [@TechCiel](https://github.com/TechCiel)
* 修复(s)ftp协议过滤的问题
 
### 2.5
 
* 优化科学公式加载
 
### 2.4
 
* 优化科学公式加载
 
### 2.3
 
* 修复上标和下标被过滤的问题
* 修复居中标签被过滤的问题
* 修复公式行内展示问题
* 更新marked.js版本
* 更新CodeMorror为最新版本
* 更新对新公式语法支持
* 支持评论语法高亮
* 增强文章渲染
 
### 2.2
 
* 优化图片粘贴逻辑代码
* 优化语法高亮逻辑
* 更新同步预览开关
* 修复某些md语法被过滤的问题
* 更新翻译
 
### 2.1
 
* 支持图片粘贴上传
* 支持预览窗口是否同步滚动
* 前端KaTeX科学公式和编辑器一致
* 修复部分语法高亮失效的问题
 
### 2.0
 
* fix bugs
 
### 1.9
 
* 修复toc被xss过滤的问题
* 支持自定义KaTeX加载地址
* 优化加载配置文件
* 修复`<!--more-->`被过滤的问题
 
* Repair toc xss filter
* Supports custom KaTeX load address
* Optimize the loading of the configuration file
* Fix `<! - more ->` filtered
 
### 1.8
 
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
 
### 1.7
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
 
### 1.6
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
 
### 1.5
* 删除WordPress不支持的Markdown语法快捷键;
* 添加Emoji表情支持;
* 添加暗系风格主题支持;
* 添加前端语法高亮支持;
* 修复Jetpack Markdown漏洞;
* 修复某些情况下无法解析Markdown的问题，[Github #3](https://github.com/LuRenJiasWorld/WP-Editor.MD/issues/3);
 
* Remove WordPress unsupported Markdown syntax shortcuts;
* Add Emoji support;
* Add dark theme support;
* Add syntax highlighting support;
* Repair the Jetpack Markdown vulnerability;
* Fixed some cases can not be resolved Markdown the problem,[Github #3](https://github.com/LuRenJiasWorld/WP-Editor.MD/issues/3);
 
### 1.4
* 修复安全性功能;
* 除去Emoji表情支持;
 
* Repair the security feature;
* Remove Emoji expression support;
 
### 1.3
* 支持WP多媒体文件插入;
* 一些样式错位修复;
* 提高插件稳定性;
 
* Support WP Media module;
* Some style dislocation repair;
* Eliminate the unstable factors;
 
### 1.2
* 修复编辑器无法全屏的问题;
 
* Fix the editor can not be full screen;
 
### 1.1
* 重写框架，优化规范代码;
* 支持Emoji表情;
 
* Rewrite Rahmenverordnung Code-Optimierung;
* Support Emoji expression;
 
### 1.0
* 第一版本
 
* Initial version