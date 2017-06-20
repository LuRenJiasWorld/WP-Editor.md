# WP Editor.MD

![](./../Interface-logo.jpg)

### CDN静态地址

国内：

[Staticfile CDN](https://www.staticfile.org/)

[BootCDN](http://www.bootcdn.cn)

国外：

[cdnjs](https://cdnjs.com/)

### 使用说明

> 前端支持语法高亮

开启`前端支持语法高亮`功能，支持文章语法高亮。语法高亮引擎目前选择的是[PrismJS](http://prismjs.com/)。

`Prism语法高亮加载库`此选项为prism加载地址，默认是插件本地加载，个人推荐使用CDN加载，以下是CDN地址，

**PrismJS Version: 1.6.0**

国内：

[//cdn.staticfile.org/prism/1.6.0](//cdn.staticfile.org/prism/1.6.0)

[//cdn.bootcss.com/prism/1.6.0](//cdn.bootcss.com/prism/1.6.0)

国外：

[//cdnjs.cloudflare.com/ajax/libs/prism/1.6.0](//cdnjs.cloudflare.com/ajax/libs/prism/1.6.0)

**使用说明：**

&#39;&#39;&#39;语法类型

代码

&#39;&#39;&#39;

请务必填写语法类型，否则无法加载语法类型的高亮文件，语法类型请参考[Prism.js Languages](http://prismjs.com/download.html)

> Prism语法高亮样式主题

开启该选项可更换语法高亮的风格，目前所支持的主题风格如下：

[default](http://prismjs.com/index.html?theme=prism)

[dark](http://prismjs.com/index.html?theme=prism-dark)

[funky](http://prismjs.com/index.html?theme=prism-funky)

[okaidia](http://prismjs.com/index.html?theme=prism-okaidia)

[twilight](http://prismjs.com/index.html?theme=prism-twilight)

[coy](http://prismjs.com/index.html?theme=prism-coy)

[solarizedlight](http://prismjs.com/index.html?theme=prism-solarizedlight)

若需要更换主题风格，请填入风格单词即可。

> Emoji

开启该选项则支持Emoji表情支持，若设备支持Emoji表情则优先支持原生加载，例如`iOS`和`MacOS`系统等。否则加载图片资源。

Emoji库支持CDN加载：

国内：

**Emojify.js Version: 1.1.0**

[//cdn.staticfile.org/emojify.js/1.1.0](//cdn.staticfile.org/emojify.js/1.1.0)

[//cdn.bootcss.com/emojify.js/1.1.0](//cdn.bootcss.com/emojify.js/1.1.0)

国外：

[//cdnjs.cloudflare.com/ajax/libs/emojify.js/1.1.0](//cdnjs.cloudflare.com/ajax/libs/emojify.js/1.1.0)

> 支持LaTeX科学公式

开启此选项则支持KaTeX科学公式的支持，在编辑器编写公式有俩个方式：

使用`$latex 公式$`，支持预览显示，以下皆为实例：

$latex E=mc^2$

$latex c = \\pm\\sqrt{a^2 + b^2}$

$latex
\\dfrac{
    \\tfrac{1}{2}[1-(\\tfrac{1}{2})^n] }
    { 1-\\tfrac{1}{2} } = s_n
$

更多[实例](./latex.md)查看

**注意：文档中展示功能语法是单个`\`，但本插件由于某些原因单`\`会被转义，所以使用`\\`来替代！请知悉！**

查看[LaTeX](https://khan.github.io/KaTeX/function-support.html)的文档

> 支持文章目录 TOC

开启选项支持文章目录支持，提前你得需要安装[Table of Contents Plus](https://wordpress.org/plugins/table-of-contents-plus/)插件。

格式如下：

```markdown
[toc]

### 标题1

### 标题2

### 标题3
```

> 图像粘贴 ImagePaste

此功能将剪贴板的图像直接粘贴到编辑器上，无需将图片手动上传到服务器。

选择一个图像，按Ctrl+C『Mac：Command+C』进行复制，转到编辑器按Ctrl+V『Mac：Command+V』即可粘贴。

兼容浏览器：Firefox 18（或更高版本），Google Chrome 24（或更高版本）。