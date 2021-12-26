# WP Editor.md

[![GitHub issues](https://img.shields.io/github/issues/LuRenJiasWorld/WP-Editor.md.svg)](https://github.com/LuRenJiasWorld/WP-Editor.md/issues)
[![GitHub forks](https://img.shields.io/github/forks/LuRenJiasWorld/WP-Editor.md.svg)](https://github.com/LuRenJiasWorld/WP-Editor.md/network)
[![GitHub stars](https://img.shields.io/github/stars/LuRenJiasWorld/WP-Editor.md.svg)](https://github.com/LuRenJiasWorld/WP-Editor.md/stargazers)
[![GitHub releases](https://img.shields.io/github/downloads/LuRenJiasWorld/WP-Editor.md/total.svg)](https://github.com/LuRenJiasWorld/WP-Editor.md/releases)
[![GitHub license](https://img.shields.io/github/license/LuRenJiasWorld/WP-Editor.md.svg)](https://github.com/LuRenJiasWorld/WP-Editor.md/blob/master/LICENSE)
[![Latest Version](https://img.shields.io/badge/Latest%20Version-10.2.1-green)](https://github.com/LuRenJiasWorld/WP-Editor.md/releases)

### 说明 Description

WP Editor.md是一个漂亮又实用的在线Markdown文档编辑器。

WP Editor.md is a beautiful and practical Markdown document editor.

基于[Editor.md](https://github.com/pandao/editor.md)构建对WordPress平台的支持。

Build support for the WordPress on [Editor.md](https://github.com/pandao/editor.md).

使用WordPress [Jetpack](http://jetpack.me) 的Markdown模块来解析和保存内容。

The plugin uses the Markdown module from WordPress [Jetpack](http://jetpack.me) for parsing and saving content.

---

WordPress Plugins [Download](https://wordpress.org/plugins/wp-editormd/)

WordPress 插件库[下载](https://wordpress.org/plugins/wp-editormd/)

### 特征 Feature

 - [x] 支持实时预览/代码插入/代码折叠/列表插入/搜索替换/语法高亮等功能；
 - [x] 支持 [Emoji 表情](http://www.emoji-cheat-sheet.com/)
 - [x] 支持WordPress的多媒体插入
 - [x] 支持Toc文章目录显示
 - [x] 支持GFM Task lists
 - [x] 支持[KaTeX科学公式](https://khan.github.io/KaTeX/)
 - [x] 支持[Mermaid](https://mermaidjs.github.io/)
 - [x] 支持图像粘贴

 ---

 - [x] Real-time Preview, Preformatted text/Code blocks/Tables insert, Search replace, Code syntax highlighting;
 - [x] Support [Emoji](http://www.emoji-cheat-sheet.com/)
 - [x] Support WordPress multimedia insertion
 - [x] Support Toc
 - [x] Support GFM Task lists
 - [x] Support [KaTeX](https://khan.github.io/KaTeX/)
 - [x] Support [Mermaid](https://mermaidjs.github.io/)
 - [x] Support Image Paste

### 开发者状态 Developer status
> 该部分随时更新
This part will be update timely

10.2.1版本已正式发布，可在WordPress中进行更新。下一版本10.3.0将会进一步提升LaTeX撰写体验、解决部分BUG，并尝试提供Docker构建脚本与CI流水线便于调试与修改本插件，预计于11月发布。

---

The new version has released, you can upgrade it from the WordPress admin. Next version will mainly working on LaTeX functionality enhancement, bug fixes and providing Docker build scripts as well as CI pipeline to easily build and modify the source code of WP Editor.md. Next version (10.3.0) will be released in November 2020.

### 更新周期 Update interval

为尽量避免频繁更新打扰用户，同时保证本插件质量与稳定性，正常情况下将每两月更新一次，当前季度更新内容将会在README.md的"下一个版本即将支持"部分提及，便于用户关注当前工作进度。

如有严重BUG更新时间会提前，同理如有重大功能更新时间会延后，请理解。

如有更好的建议或意见欢迎在issues中提出。

---

Regular update interval is around two months. Info about the next update will be shown at the *Next version TO-DO* section at README.md for you to know the working status.

The update interval might be shorten or lengthen due to various situations.

If you have better idea about the next update, please share your idea at issues.

### 下一个版本即将支持 Next version TO-DO
- [x] 重构HTML过滤模块，增强安全性
- [ ] 强化代码高亮功能样式与各种主题兼容性
- [ ] 将LaTeX、Mermaid绘图的报错输出到页面上，便于用户及时修正语法错误
- [ ] 进一步解决LaTeX在部分情况下的兼容性问题
- [ ] 使用WebWorker提升Markdown渲染性能，避免长文写作时出现无法忍受的卡顿现象
- [ ] 新增Docker构建脚本，便于用户在本地测试/修改本项目
- [ ] 重构设置菜单，便于用户更快找到所需要的功能
- [ ] 加入一键重渲染文章功能，便于版本更新后对旧文章进行重渲染
- [ ] 支持Markdown上传与下载
- [ ] 支持Mathjax渲染 (Beta)
- [ ] 支持异步系统日志功能，便于有效反馈BUG/提升开发效率
- [ ] 充分利用WordPress的对象缓存，优化配置读取性能
- [ ] 新增高级配置中心，便于高级用户修改本编辑器核心功能

---

- [x] Rebuild HTML filtering module to enhance security
- [ ] Improve code highlighting compatibility with more themes
- [ ] Print LaTeX and Mermaid error on the web page (not the console) to notice user.
- [ ] Enhacing the compatibility of LaTeX in some cases.
- [ ] Improve Markdown rendering performance using WebWorker to avoid unbearable lagging when editing large document.
- [ ] Include docker build scripts for users to build WP Editor.md on their own machine for better developing experience.
- [ ] Rearrange settings menu, make it more easy to use.
- [ ] Add one-click rerendering feature, for users to rerender posts after upgrading or running into issues.
- [ ] Support Markdown upload and download feature.
- [ ] Support Mathjax LaTeX rendering engine (Beta).
- [ ] Support asynchronous system log feature for effective submission of user feedback and feature development.
- [ ] Utilizing the WordPress object cache for better performance.
- [ ] Introduce advanced configuration center for power users to tweak WP Editor.md in more ways.

## Stars历史 Stargazers over time

欢迎Star本项目，你的Star是对我的最大支持！

Star this project to encourage me！

[![Stargazers over time](https://starchart.cc/LuRenJiasWorld/WP-Editor.md.svg)](https://starchart.cc/LuRenJiasWorld/WP-Editor.md)

### 统计 Stats

![Alt](https://repobeats.axiom.co/api/embed/c2843d385072700fb3c8878df31bf455f03f1c89.svg "Repobeats analytics image")

### 使用说明 ReadMe

请参考 [WP-Editor.md Wiki](https://github.com/LuRenJiasWorld/WP-Editor.md/wiki)
 
### 更新日志 ChangeLog

请见[更新日志](https://github.com/LuRenJiasWorld/WP-Editor.md/blob/master/CHANGELOG.md)

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
