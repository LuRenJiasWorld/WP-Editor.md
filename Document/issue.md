# Issue

![](https://raw.githubusercontent.com/JaxsonWang/WP-Editor.MD/master/Interface-logo.jpg)

## 插件问题收集

---

### 多用户文章公式显示失效（例如作者身份编写文章） 

由于WordPress自身安全，把一些特性标签过滤（XSS脚本）。所以需要公式这块功能需要安装一个插件：[User Role Editor](https://wordpress.org/plugins/user-role-editor/).

启用插件后在`用户 - User Role Editor - 选择对应的用户（例如作者）`把`Unfiltered html`打勾，在右边`update`点击更新即可。