# WP Editor.md

![](https://raw.githubusercontent.com/JaxsonWang/WP-Editor.md/docs/screenshots/Interface-logo.jpg)

## 使用说明

**编辑器预览效果最终不影响前端文章效果！文章的样式取决于你的主题样式表，和本插件没有关系！**

### GFM任务列表

此功能仿照Github社区的任务列表功能，实例如下：

```markdown
 - [x] Hello World
 - [ ] Hello Markdown
 - [x] Hello WP-Editor.md
```

### 支持图像粘贴

此功能将剪贴板的图像直接粘贴到编辑器上，无需将图片手动上传到服务器。

选择一个图像，按Ctrl+C『Mac：Command+C』进行复制，转到编辑器按Ctrl+V『Mac：Command+V』即可粘贴。

兼容浏览器：Firefox 18（或更高版本），Google Chrome 24（或更高版本），以及Window 10 Edge浏览器。

对Safari浏览器不兼容，IE暂未测试。

开仅在浏览器复制图片以及类似QQ的截图效果有效，如果在系统桌面复制图片是无效的。

关于无效的部分会找到更好的方案。

### 支持HTML

开启该功能支持HTML标签解析，但会增加XSS注入风险，请根据自身情况是否启用。

### 静态资源加速

开启该功能则加速网站静态资源加载，目前CDN有四家，建议选择推荐的选项！
只接管前端的静态资源加速，后台编辑器静态资源没有接管，请知悉！

### 编辑器风格

如果你喜欢暗色系风格推荐组合：（编辑器主题风格）dark + （代码风格主题）pastel-on-dark

### 语法高亮加载模式

该选项有`自动加载模式`和`自定义加载模式`：

`自动加载模式`：此模式根据你的`语法类型`加载语法高亮所需依赖文件，推荐使用该模式。

`自定义加载模式`：用户自定义配置语法类型文件。需要到[PrismJS](http://prismjs.com/download.html)下载所需文件。


### Prism语法高亮样式主题

开启该选项可更换语法高亮的风格，目前所支持的主题风格如下：

[default](http://prismjs.com/index.html?theme=prism)

[dark](http://prismjs.com/index.html?theme=prism-dark)

[funky](http://prismjs.com/index.html?theme=prism-funky)

[okaidia](http://prismjs.com/index.html?theme=prism-okaidia)

[twilight](http://prismjs.com/index.html?theme=prism-twilight)

[coy](http://prismjs.com/index.html?theme=prism-coy)

[solarizedlight](http://prismjs.com/index.html?theme=prism-solarizedlight)

### Emoji

开启该选项则支持Emoji表情支持，若设备支持Emoji表情则优先支持原生加载，例如`iOS`和`MacOS`系统等。否则加载图片资源。

### 支持LaTeX科学公式

开启此选项则支持KaTeX科学公式的支持：

以下皆为实例：

```latex
$$E=mc^2$$

$$c = \pm\sqrt{a^2 + b^2}$$
```

```markdown
    ```latex
        f(x) = \int_{-\infty}^\infty
            \hat f(\xi)\,e^{2 \pi i \xi x}
        \,d\xi
    ```
```

更多[实例](https://raw.githubusercontent.com/JaxsonWang/WP-Editor.md/docs/Example/KaTeX.md)查看


查看[LaTeX](https://khan.github.io/KaTeX/function-support.html)的语法支持文档

### 支持文章目录 TOC

开启选项支持文章目录支持，提前你得需要安装[Table of Contents Plus](https://wordpress.org/plugins/table-of-contents-plus/)插件。

格式如下：

```markdown
[toc]

### 标题1

### 标题2

### 标题3
```

[toc]不分大小写

### 支持Mermaid

更多信息请查看：[Mermaid](https://raw.githubusercontent.com/JaxsonWang/WP-Editor.md/docs/Example/Mermaid.md)

### 支持思维导图

更多信息请查看：[MindMap](https://raw.githubusercontent.com/JaxsonWang/WP-Editor.md/docs/Example/MindMap.md)

### 兼容模式

如果前端（文章或者页面）KaTeX科学公式，Emoji表情，流程图，时序图或者一些其它的问题（主要从浏览器的F12控制台得出是jQuery问题），建议开启该选项！
很大的程度上能解决该问题。