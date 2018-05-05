# WP Editor.MD

![](https://raw.githubusercontent.com/JaxsonWang/WP-Editor.md/docs/screenshots/Interface-logo.jpg) 

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
 1. 升级Editor.md依赖库版本，详细请见[Editormd](https://github.com/JaxsonWang/Editormd)
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
 * 修复流程图和时序图渲染问题[#45](https://github.com/JaxsonWang/WP-Editor.MD/issues/45) [46](https://github.com/JaxsonWang/WP-Editor.MD/issues/46)
 * 修复Prism高亮文件重复加载的问题[#38](https://github.com/JaxsonWang/WP-Editor.MD/issues/38) Thank for [@giuem](https://github.com/giuem)
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
 * 修复某些情况下无法解析Markdown的问题，[Github #3](https://github.com/JaxsonWang/WP-Editor.MD/issues/3);
 
 * Remove WordPress unsupported Markdown syntax shortcuts;
 * Add Emoji support;
 * Add dark theme support;
 * Add syntax highlighting support;
 * Repair the Jetpack Markdown vulnerability;
 * Fixed some cases can not be resolved Markdown the problem,[Github #3](https://github.com/JaxsonWang/WP-Editor.MD/issues/3);
 
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