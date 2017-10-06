<?php
?>
<html lang="zh-CN"><head>
    <meta charset="UTF-8">
    <title></title>
    <style id="system" type="text/css">*{margin:0;padding:0;}body {	font:13.34px helvetica,arial,freesans,clean,sans-serif;	color:black;	line-height:1.4em;	background-color: #F8F8F8;	padding: 0.7em;}p {	margin:1em 0;	line-height:1.5em;}table {	font-size:inherit;	font:100%;	margin:1em;}table th{border-bottom:1px solid #bbb;padding:.2em 1em;}table td{border-bottom:1px solid #ddd;padding:.2em 1em;}input[type=text],input[type=password],input[type=image],textarea{font:99% helvetica,arial,freesans,sans-serif;}select,option{padding:0 .25em;}optgroup{margin-top:.5em;}pre,code{font:12px Monaco,"Courier New","DejaVu Sans Mono","Bitstream Vera Sans Mono",monospace;}pre {	margin:1em 0;	font-size:12px;	background-color:#eee;	border:1px solid #ddd;	padding:5px;	line-height:1.5em;	color:#444;	overflow:auto;	-webkit-box-shadow:rgba(0,0,0,0.07) 0 1px 2px inset;	-webkit-border-radius:3px;	-moz-border-radius:3px;border-radius:3px;white-space: pre-wrap;word-wrap:break-word;}pre code {	padding:0;	font-size:12px;	background-color:#eee;	border:none;}code {	font-size:12px;	background-color:#f8f8ff;	color:#444;	padding:0 .2em;	border:1px solid #dedede;}img{border:0;max-width:100%;}abbr{border-bottom:none;}a{color:#4183c4;text-decoration:none;}a:hover{text-decoration:underline;}a code,a:link code,a:visited code{color:#4183c4;}h2,h3{margin:1em 0;}h1,h2,h3,h4,h5,h6{border:0;}h1{font-size:170%;border-top:4px solid #aaa;padding-top:.5em;margin-top:1.5em;}h1:first-child{margin-top:0;padding-top:.25em;border-top:none;}h2{font-size:150%;margin-top:1.5em;border-top:4px solid #e0e0e0;padding-top:.5em;}h3{margin-top:1em;}hr{border:1px solid #ddd;}ul{margin:1em 0 1em 2em;}ol{margin:1em 0 1em 2em;}ul li,ol li{margin-top:.5em;margin-bottom:.5em;}ul ul,ul ol,ol ol,ol ul{margin-top:0;margin-bottom:0;}blockquote{margin:1em 0;border-left:5px solid #ddd;padding-left:.6em;color:#555;}dt{font-weight:bold;margin-left:1em;}dd{margin-left:2em;margin-bottom:1em;}@media screen and (min-width: 768px) {    body {        width: 748px;        margin:10px auto;    }}</style><style id="custom" type="text/css"></style></head>
<body marginheight="0"><h1>WP Editor.MD</h1>
<p><img src="https://raw.githubusercontent.com/JaxsonWang/WP-Editor.MD/master/Interface-logo.jpg" alt="">

</p>
<h2>使用说明</h2>
<p><strong>编辑器预览效果最终不影响前端文章效果！文章的样式取决于你的主题样式表，和本插件没有关系！</strong>

</p>
<h3>GFM任务列表</h3>
<p>此功能仿照Github社区的任务列表功能，实例如下：

</p>
<pre><code class="lang-markdown"> - [x] Hello World
 - [ ] Hello Markdown
 - [x] Hello WP-Editor.md</code></pre>
<h3>CDN静态地址</h3>
<p>国内：

</p>
<p><a href="https://www.staticfile.org/">Staticfile CDN</a>

</p>
<p><a href="http://www.bootcdn.cn">BootCDN</a>

</p>
<p>国外：

</p>
<p><a href="https://cdnjs.com/">cdnjs</a>

</p>
<h3>前端支持语法高亮</h3>
<p>开启<code>前端支持语法高亮</code>功能，支持文章语法高亮。语法高亮引擎目前选择的是<a href="http://prismjs.com/">PrismJS</a>。

</p>
<p><code>Prism语法高亮加载库</code>此选项为prism加载地址，默认是插件本地加载，个人推荐使用CDN加载，以下是CDN地址，

</p>
<p><strong>PrismJS Version: 1.6.0</strong>

</p>
<p>国内：

</p>
<p><a href="//cdn.staticfile.org/prism/1.6.0">//cdn.staticfile.org/prism/1.6.0</a>

</p>
<p><a href="//cdn.bootcss.com/prism/1.6.0">//cdn.bootcss.com/prism/1.6.0</a>

</p>
<p>国外：

</p>
<p><a href="//cdnjs.cloudflare.com/ajax/libs/prism/1.6.0">//cdnjs.cloudflare.com/ajax/libs/prism/1.6.0</a>

</p>
<p><strong>使用说明：</strong>

</p>
<p>'''语法类型

</p>
<p>代码

</p>
<p>'''

</p>
<p>请务必填写语法类型，否则无法加载语法类型的高亮文件，语法类型请参考<a href="http://prismjs.com/download.html">Prism.js Languages</a>

</p>
<h3>语法高亮加载模式</h3>
<p>该选项有<code>自动加载模式</code>和<code>自定义加载模式</code>：

</p>
<p><code>自动加载模式</code>：此模式根据你的<code>语法类型</code>加载语法高亮所需依赖文件，推荐使用该模式。

</p>
<p><code>自定义加载模式</code>：用户自定义配置语法类型文件。需要到<a href="http://prismjs.com/download.html">PrismJS</a>下载所需文件。


</p>
<h3>Prism语法高亮样式主题</h3>
<p>开启该选项可更换语法高亮的风格，目前所支持的主题风格如下：

</p>
<p><a href="http://prismjs.com/index.html?theme=prism">default</a>

</p>
<p><a href="http://prismjs.com/index.html?theme=prism-dark">dark</a>

</p>
<p><a href="http://prismjs.com/index.html?theme=prism-funky">funky</a>

</p>
<p><a href="http://prismjs.com/index.html?theme=prism-okaidia">okaidia</a>

</p>
<p><a href="http://prismjs.com/index.html?theme=prism-twilight">twilight</a>

</p>
<p><a href="http://prismjs.com/index.html?theme=prism-coy">coy</a>

</p>
<p><a href="http://prismjs.com/index.html?theme=prism-solarizedlight">solarizedlight</a>

</p>
<p>若需要更换主题风格，请填入风格单词即可。

</p>
<h3>Emoji</h3>
<p>开启该选项则支持Emoji表情支持，若设备支持Emoji表情则优先支持原生加载，例如<code>iOS</code>和<code>MacOS</code>系统等。否则加载图片资源。

</p>
<p>Emoji库支持CDN加载：

</p>
<p>国内：

</p>
<p><strong>Emojify.js Version: 1.1.0</strong>

</p>
<p><a href="//cdn.staticfile.org/emojify.js/1.1.0">//cdn.staticfile.org/emojify.js/1.1.0</a>

</p>
<p><a href="//cdn.bootcss.com/emojify.js/1.1.0">//cdn.bootcss.com/emojify.js/1.1.0</a>

</p>
<p>国外：

</p>
<p><a href="//cdnjs.cloudflare.com/ajax/libs/emojify.js/1.1.0">//cdnjs.cloudflare.com/ajax/libs/emojify.js/1.1.0</a>

</p>
<h3>支持LaTeX科学公式</h3>
<p>开启此选项则支持KaTeX科学公式的支持：

</p>
<p>使用<code>$$公式$$</code>，支持预览显示，以下皆为实例：

</p>
<pre><code class="lang-latex">$$E=mc^2$$

$$c = \\pm\\sqrt{a^2 + b^2}$$

$$
\\dfrac{
    \\tfrac{1}{2}[1-(\\tfrac{1}{2})^n] }
    { 1-\\tfrac{1}{2} } = s_n
$$</code></pre>
<p>更多<a href="./latex.md">实例</a>查看

</p>
<p><strong>注意：文档中展示功能语法是单个<code>\</code>，但本插件由于某些原因单<code>\</code>会被转义，所以使用<code>\\</code>来替代！请知悉！</strong>

</p>
<p>查看<a href="https://khan.github.io/KaTeX/function-support.html">LaTeX</a>的文档

</p>
<h3>支持文章目录 TOC</h3>
<p>开启选项支持文章目录支持，提前你得需要安装<a href="https://wordpress.org/plugins/table-of-contents-plus/">Table of Contents Plus</a>插件。

</p>
<p>格式如下：

</p>
<pre><code class="lang-markdown">[toc]

### 标题1

### 标题2

### 标题3</code></pre>
<h3>图像粘贴 ImagePaste</h3>
<p>此功能将剪贴板的图像直接粘贴到编辑器上，无需将图片手动上传到服务器。

</p>
<p>选择一个图像，按Ctrl+C『Mac：Command+C』进行复制，转到编辑器按Ctrl+V『Mac：Command+V』即可粘贴。

</p>
<p>兼容浏览器：Firefox 18（或更高版本），Google Chrome 24（或更高版本），以及Window 10 Edge浏览器。

</p>
<p>对Safari浏览器不兼容，IE暂未测试。

</p>
<h3>支持流程图</h3>
<p><strong>填写请不要有换行，否则解析失败</strong>

</p>
<p>语法：

</p>
<pre><code class="lang-markdown">$flow
流程图内容
$</code></pre>
<p>例如：

</p>
<pre><code class="lang-markdown">$flow
st=&gt;start: User login
op=&gt;operation: Operation
cond=&gt;condition: Successful Yes or No?
e=&gt;end: Into admin
st-&gt;op-&gt;cond
cond(yes)-&gt;e
cond(no)-&gt;op
$</code></pre>
<p><strong>流程图加载库：</strong>

</p>
<p>依赖<code>Raphael加载库</code>和<code>jQuery加载库</code>选项

</p>
<p>国内：

</p>
<p><strong>FlowChart Version: 1.6.6</strong>

</p>
<p><a href="//cdn.staticfile.org/flowchart/1.6.6/">//cdn.staticfile.org/flowchart/1.6.6/</a>

</p>
<p><a href="//cdn.bootcss.com/flowchart/1.6.6/">//cdn.bootcss.com/flowchart/1.6.6/</a>

</p>
<p>国外：

</p>
<p><a href="//cdnjs.cloudflare.com/ajax/libs/flowchart/1.6.6/">//cdnjs.cloudflare.com/ajax/libs/flowchart/1.6.6/</a>


</p>
<p><strong>流程图配置加载库：</strong>

</p>
<p>此配置文件是自定义配置文件，默认加载本地文件，有能力可以上传CDN（七牛、又拍云等）。


</p>
<h3>支持时序图/序列图</h3>
<p><strong>填写请不要有换行，否则解析失败</strong>

</p>
<p>语法：

</p>
<pre><code class="lang-markdown">$seq
时序图/序列图内容
$</code></pre>
<p>例如：

</p>
<pre><code class="lang-markdown">$seq
A-&gt;B: Message
B-&gt;C: Message
C-&gt;A: Message
$</code></pre>
<p><strong>时序图/序列图加载库：</strong>

</p>
<p>依赖<code>Raphael加载库</code>和<code>Underscore加载库</code>和<code>jQuery加载库</code>选项

</p>
<p>国内：

</p>
<p><strong>Sequence Diagrams Version: 1.0.6</strong>

</p>
<p><a href="//cdn.staticfile.org/js-sequence-diagrams/1.0.6/">//cdn.staticfile.org/js-sequence-diagrams/1.0.6/</a>

</p>
<p><a href="//cdn.bootcss.com/js-sequence-diagrams/1.0.6/">//cdn.bootcss.com/js-sequence-diagrams/1.0.6/</a>

</p>
<p>国外：

</p>
<p><a href="//cdnjs.cloudflare.com/ajax/libs/js-sequence-diagrams/1.0.6/">//cdnjs.cloudflare.com/ajax/libs/js-sequence-diagrams/1.0.6/</a>

</p>
<h3>Raphael加载库</h3>
<p>国内：

</p>
<p><strong>Raphael Version: 1.8.3</strong>

</p>
<p><a href="//cdn.staticfile.org/raphael/2.2.7/">//cdn.staticfile.org/raphael/2.2.7/</a>

</p>
<p><a href="//cdn.bootcss.com/raphael/2.2.7/">//cdn.bootcss.com/raphael/2.2.7/</a>

</p>
<p>国外：

</p>
<p><a href="//cdnjs.cloudflare.com/ajax/libs/raphael/2.2.7/">//cdnjs.cloudflare.com/ajax/libs/raphael/2.2.7/</a>

</p>
<h3>Underscore加载库</h3>
<p>国内：

</p>
<p><strong>Underscore Version: 2.2.7</strong>

</p>
<p><a href="//cdn.staticfile.org/underscore.js/1.8.3/">//cdn.staticfile.org/underscore.js/1.8.3/</a>

</p>
<p><a href="//cdn.bootcss.com/underscore.js/1.8.3/">//cdn.bootcss.com/underscore.js/1.8.3/</a>

</p>
<p>国外：

</p>
<p><a href="//cdnjs.cloudflare.com/ajax/libs/underscore.js/1.8.3/">//cdnjs.cloudflare.com/ajax/libs/underscore.js/1.8.3/</a>

</p>
<h3>jQuery加载库</h3>
<p>国内：

</p>
<p><strong>jQuery Version: 1.12.4</strong>

</p>
<p><a href="//cdn.staticfile.org/jquery/1.12.4/">//cdn.staticfile.org/jquery/1.12.4/</a>

</p>
<p><a href="//cdn.bootcss.com/jquery/1.12.4/">//cdn.bootcss.com/jquery/1.12.4/</a>

</p>
<p>国外：

</p>
<p><a href="//cdnjs.cloudflare.com/ajax/libs/jquery/1.12.4/">//cdnjs.cloudflare.com/ajax/libs/jquery/1.12.4/</a>

</p>
<h3>同步滚动</h3>
<p>关闭该选项不支持<strong>实时预览</strong>，请知悉！

</p>
<h3>支持HTML富文本解析</h3>
<p>开启该选项虽然此功能能极大地扩展 Markdown 语法，但也面临着安全上的风险，请慎重开启（已添加XSS过滤机制）！

</p>
<h3>描点</h3>
<p>例子：<code>### Header {#header}</code>

</p>
<p>转换：<code>&lt;h3 id="header"&gt;Header&lt;h3&gt;</code>

</p>
<p>例子：<code>### Header {.header}</code>

</p>
<p>转换：<code>&lt;h3 class="header"&gt;Header&lt;h3&gt;</code>
</body></html>
