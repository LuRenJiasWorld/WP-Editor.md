# 🎉 恭喜您升级到10.2.0版本！ 🎉

> 时隔五个月，WP Editor.md正式发布10.2.0版本，包含大量更新。

更新内容如下：

## 1. 体验提升

* 使用Webpack进行代码构建，体积缩小30%，页面加载速度更快
* 图床功能支持与sm.ms用户绑定，并支持sm.ms图床管理功能，便于更高效管理上传的图片
* 整理代码格式，完善注释，去除冗余代码，便于理解、维护、二次开发
* 编辑器支持鼠标悬浮提示，便于快速了解工具栏各按钮的用途
* 新增高亮语法支持，与Typora功能一致，现在可以使用`==高亮==`来实现高亮文本（[#467](https://github.com/LuRenJiasWorld/WP-Editor.md/issues/467)）
* 粘贴图片时新增Loading窗口，避免误操作导致粘贴上传失败
* 设置菜单选择编辑器/预览/代码高亮样式时支持预览，帮助您更快找到喜欢的样式
* 升级后将为您跳转到发行注记页面，帮助您更快了解最新版本的更新内容

## 2. 故障修复

* 修复自定义风格在后台无法正常预览的问题
* 修复评论功能相关故障（[#455](https://github.com/LuRenJiasWorld/WP-Editor.md/issues/455)）
* 不再误解析pre标签中的LaTeX代码
* 不对多行LaTeX中的$符号进行循环解析（[#411](https://github.com/LuRenJiasWorld/WP-Editor.md/issues/411)）
* 修复特殊情况下新标签页打开链接功能无法生效的BUG（[#457](https://github.com/LuRenJiasWorld/WP-Editor.md/issues/457)）
* 修复粘贴图片时连带文件名一同粘贴到编辑器的问题
* 修复后台评论无法预览的问题
* 修复全屏后窗口大小无法自适应的BUG
* 进一步解决正文中`$`符号被误识别为LaTeX公式导致文章空白的BUG（[#420](https://github.com/LuRenJiasWorld/WP-Editor.md/issues/420)）
* 解决包含`_`的LaTeX公式被误解析为`<em>`的BUG（[#411](https://github.com/LuRenJiasWorld/WP-Editor.md/issues/411)）
* 修复服务器外网不通情况下静态资源版本检查功能未设置超时导致加载缓慢的问题
* 修复在开启思维导图情况下无法启用前端评论功能的问题

## 3. 安全加固

* 后台编辑器预览时不再渲染如`<form>`、`<audio>`、`<video>`、`<scripts>`等与排版无关的标签（[#428](https://github.com/LuRenJiasWorld/WP-Editor.md/issues/428)）

## 4. 其他

* 合并Editor.md代码到本项目主干（原作者@pandao已不再更新，合并便于二次开发，在未来版本实现更多功能）
* 新增依赖库相关开源协议与版权信息，规范本项目开源质量
* 升级相关依赖库到最新版本，避免安全隐患
* 修改本地化相关文本（[#458，感谢@zkl2333](https://github.com/LuRenJiasWorld/WP-Editor.md/issues/458)）
* 兼容WordPress 5.5版本

> 由于此前工作较忙，此前承诺的两月一版未能及时履约，在这里向各位表示歉意。到2020年底之前，本编辑器会再发布两个版本（分别是10.3.0与10.3.1），解决过去一段时间各位用户集中反馈的问题，并进一步提升性能，加入更多实用的新功能。
> 感谢大家对WP Editor.md的支持与信赖，祝大家学业顺利，工作愉快！如果有其他问题或建议，欢迎在Issue中及时提出，我会及时回复，并在未来版本予以解决:)
