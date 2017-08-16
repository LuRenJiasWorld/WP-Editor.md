# WP Editor.MD

## Instructions for use

**Editor preview effect ultimately does not affect the front-end article effect! The style of the article depends on your theme style sheet, and this plugin does not matter!**

If the blog enables the `Jetpack` plugin, disable the`Writing -> Composing` tab and conflict with this plugin.

### GFM task list

This function is modeled on the Github community's task list function, as follows:

```Markdown
 - [x] Hello World
 - [ ] Hello Markdown
 - [x] Hello WP-Editor.md
```

### CDN static address

Domestic (China):

[Staticfile CDN](https://www.staticfile.org/)

[BootCDN](http://www.bootcdn.cn)

Foreign (International) (International):

[Cdnjs](https://cdnjs.com/)

### Article support syntax highlighting

Open the front-end support syntax highlighting function, support the article syntax highlighting. The syntax highlighting currently selects [PrismJS](http://prismjs.com/).

`Prism syntax highlight load library` This option for prism load address, the default is the local load plug-in, personally recommend the use of CDN load, the following is the CDN address,

**PrismJS Version: 1.6.0**

Domestic (China)::

[//cdn.staticfile.org/prism/1.6.0](//cdn.staticfile.org/prism/1.6.0)

[//cdn.bootcss.com/prism/1.6.0](//cdn.bootcss.com/prism/1.6.0)

Foreign (International):

[//cdnjs.cloudflare.com/ajax/libs/prism/1.6.0](//cdnjs.cloudflare.com/ajax/libs/prism/1.6.0)

**Instructions for use:**

\`\`\`Syntax type

Code

\`\`\`

**Please fill in the syntax type, otherwise you can not load the syntax type of the highlighted file, the grammar type please refer to [Prism.js Languages](http://prismjs.com/download.html)**

### Prism syntax highlight style theme

Open this option to replace the syntax of the style, the current support of the theme style is as follows:

[Default](http://prismjs.com/index.html?theme=prism)

[Dark](http://prismjs.com/index.html?theme=prism-dark)

[Funky](http://prismjs.com/index.html?theme=prism-funky)

[Okaidia](http://prismjs.com/index.html?theme=prism-okaidia)

[Twilight](http://prismjs.com/index.html?theme=prism-twilight)

[Coy](http://prismjs.com/index.html?theme=prism-coy)

[Solarizedlight](http://prismjs.com/index.html?theme=prism-solarizedlight)

If you need to change the theme style, please fill in the style of the word can be.

### Emoji

Enable this option to support Emoji expression support, if the device supports Emoji expression is preferred to support native load, such as `iOS` and` MacOS` system. Otherwise load the image resource.

Emoji library support CDN load:

Domestic (China)::

**Emojify.js Version: 1.1.0**

[//cdn.staticfile.org/emojify.js/1.1.0](//cdn.staticfile.org/emojify.js/1.1.0)

[//cdn.bootcss.com/emojify.js/1.1.0](//cdn.bootcss.com/emojify.js/1.1.0)

Foreign (International):

[//cdnjs.cloudflare.com/ajax/libs/emojify.js/1.1.0](//cdnjs.cloudflare.com/ajax/libs/emojify.js/1.1.0)

### Supports LaTeX scientific formula

Enabling this option supports KaTeX Scientific Formula Support:

Use the `$$ formula $$` to support the preview display, the following are examples:

```latex
$$E=mc^2$$

$$c = \\pm\\sqrt{a^2 + b^2}$$

$$
\\dfrac{
    \\tfrac{1}{2}[1-(\\tfrac{1}{2})^n] }
    { 1-\\tfrac{1}{2} } = s_n
$$
```

**Note: The functional syntax displayed in the document is single `\`, but this plugin will be escaped for some reason, so use `\\` instead! Please note!**

To view the documentation for [LaTeX](https://khan.github.io/KaTeX/function-support.html)

### support article directory TOC

Open the option to support the article directory support, in advance you need to install the [Table of Contents Plus] (https://wordpress.org/plugins/table-of-contents-plus/) plugin.

The format is as follows:

```markdown
[toc]

### Title 1

### title 2

### Title 3
```

### Image Paste ImagePaste

This function pastes the clipboard image directly to the editor without manually uploading the picture to the server.

Select an image, press Ctrl + C "Mac: Command + C" to copy, go to the editor press Ctrl + V "Mac: Command + V" to paste.

Compatible browsers: Firefox 18 (or later), Google Chrome 24 (or later), and Window 10 Edge browsers.

Safari browser is not compatible, IE not yet tested.

### Support flow chart

** Please do not have to fill in the line, or analytical failure **

grammar:

```Markdown
$ Flow
Flow chart content
$
```

E.g:

```Markdown
$ Flow
St => start: User login
Op => operation: Operation
Cond => condition: Successful Yes or No?
E => end: Into admin
St-> op-> cond
Cond (yes) -> e
Cond (no) -> op
$
```

**Flowchart loading library:**

Depends on the `Raphael Load Library` and `jQuery Load Library` options

Domestic (China)::

**FlowChart Version: 1.6.6**

[//cdn.staticfile.org/flowchart/1.6.6/](//cdn.staticfile.org/flowchart/1.6.6/)

[//cdn.bootcss.com/flowchart/1.6.6/](//cdn.bootcss.com/flowchart/1.6.6/)

Foreign (International):

[//cdnjs.cloudflare.com/ajax/libs/flowchart/1.6.6/](//cdnjs.cloudflare.com/ajax/libs/flowchart/1.6.6/)


**Flowchart configuration load library:**

This configuration file is a custom configuration file, the default load local file, the ability to upload CDN (seven cattle, and shoot cloud, etc.).


### Supports timing diagram / sequence diagram

**Please do not have to fill in the line, or analytical failure**

grammar:

```markdown
$seq
Timing diagram / sequence diagram content
$
```

E.g:

```markdown
$seq
A->B: Message
B->C: Message
C->A: Message
$
```

**Timing diagram / sequence diagram Loading library:**

Depends on the `Raphael Load Library` and `Underscore Load Library` and `jQuery Load Library` Options

Domestic (China)::

**Sequence Diagrams Version: 1.0.6**

[//cdn.staticfile.org/js-sequence-diagrams/1.0.6/](//cdn.staticfile.org/js-sequence-diagrams/1.0.6/)

[//cdn.bootcss.com/js-sequence-diagrams/1.0.6/](//cdn.bootcss.com/js-sequence-diagrams/1.0.6/)

Foreign (International):

[//cdnjs.cloudflare.com/ajax/libs/js-sequence-diagrams/1.0.6/](//cdnjs.cloudflare.com/ajax/libs/js-sequence-diagrams/1.0.6/)

### Raphael load library

Domestic (China)::

**Raphael Version: 1.8.3**

[//cdn.staticfile.org/raphael/2.2.7/](//cdn.staticfile.org/raphael/2.2.7/)

[//cdn.bootcss.com/raphael/2.2.7/](//cdn.bootcss.com/raphael/2.2.7/)

Foreign (International):

[//cdnjs.cloudflare.com/ajax/libs/raphael/2.2.7/](//cdnjs.cloudflare.com/ajax/libs/raphael/2.2.7/)

### Underscore load library

Domestic (China)::

** Underscore Version: 2.2.7 **

[//cdn.staticfile.org/underscore.js/1.8.3/](//cdn.staticfile.org/underscore.js/1.8.3/)

[//cdn.bootcss.com/underscore.js/1.8.3/](//cdn.bootcss.com/underscore.js/1.8.3/)

Foreign (International):

[//cdnjs.cloudflare.com/ajax/libs/underscore.js/1.8.3/](//cdnjs.cloudflare.com/ajax/libs/underscore.js/1.8.3/)

### jQuery load library

Domestic (China):

**jQuery Version: 1.12.4**

[//cdn.staticfile.org/jquery/1.12.4/](//cdn.staticfile.org/jquery/1.12.4/)

[//cdn.bootcss.com/jquery/1.12.4/](//cdn.bootcss.com/jquery/1.12.4/)

Foreign (International):

[//cdnjs.cloudflare.com/ajax/libs/jquery/1.12.4/](//cdnjs.cloudflare.com/ajax/libs/jquery/1.12.4/)

### Synchronous scrolling

Close this option does not support **real-time preview**, please know!

### support HTML rich text parsing

Open this option Although this feature can greatly expand the Markdown syntax, but also faced with the risk of security, please carefully open (XSS filter mechanism has been added)!