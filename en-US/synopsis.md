# WP Editor.md

![](https://raw.githubusercontent.com/JaxsonWang/WP-Editor.md/docs/screenshots/Interface-logo.jpg)

## Instructions for use

**The editor preview effect does not affect the front-end article effects in the end! The style of the article depends on your theme style sheet, and it has nothing to do with this plugin!**

### GFM task list

This function is modeled on the task list feature of the Github community. Examples are as follows:

```markdown
 - [x] Hello World
 - [ ] Hello Markdown
 - [x] Hello WP-Editor.md
```

### Support image paste

This function pastes the image of the clipboard directly into the editor without manually uploading the image to the server.

Select an image, press Ctrl + C "Mac: Command + C" to copy, go to the editor and press Ctrl + V "Mac: Command + V" to paste.

Compatible browsers: Firefox 18 (or higher), Google Chrome 24 (or higher), and Window 10 Edge browser.

Incompatibility with Safari browser, IE is not tested yet.

The effect of copying pictures only in the browser and screenshots similar to QQ is valid, if the picture is copied on the system desktop is invalid.

About the invalid part will find a better solution.

### Support HTML

Enabling this function supports HTML tag parsing, but it will increase the risk of XSS injection. Please enable it according to your own situation.

### Static Resource Acceleration

Turning on this feature will speed up the static load of the website. There are currently four CDNs and it is recommended to select the recommended option!
Only take care of the front-end static resource acceleration, the background editor static resources are not taken over, please be aware!

### Editor style

If you like dark color style recommended combination: (Editor theme style) dark + (code style theme) pastel-on-dark

### syntax highlighting loading mode

This option has `automatic loading mode` and `custom loading mode`:

`Automatic loading mode`: This mode loads syntax dependent highlighting required files based on your `syntax type`, which is recommended.

`Custom loading mode`: user-defined configuration syntax type file. Need to [PrismJS] (http://prismjs.com/download.html) to download the necessary files.


### Prism syntax highlighting style theme

Turn on this option to change the syntax highlighting style. The currently supported theme styles are as follows:

[default](http://prismjs.com/index.html?theme=prism)

[dark](http://prismjs.com/index.html?theme=prism-dark)

[funky](http://prismjs.com/index.html?theme=prism-funky)

[okaidia](http://prismjs.com/index.html?theme=prism-okaidia)

[twilight](http://prismjs.com/index.html?theme=prism-twilight)

[coy](http://prismjs.com/index.html?theme=prism-coy)

[solarizedlight](http://prismjs.com/index.html?theme=prism-solarizedlight)

### Emoji

Turn on this option to support Emoji expression support. If the device supports Emoji expression, it supports first-priority loading, such as `iOS` and `MacOS` system. Otherwise load the picture resource.

### Support LaTeX Scientific Formula

Turn on this option to support KaTeX scientific formula support:

The following are examples:

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

More [Examples] (./latex.md) View


See the syntax support documentation for [LaTeX](https://khan.github.io/KaTeX/function-support.html)

### Support Article Directory TOC

The open option supports article directory support. In advance you need to install the [Table of Contents Plus] (https://wordpress.org/plugins/table-of-contents-plus/) plugin.

The format is as follows:

```markdown
[toc]

### Heading 1

### Heading 2

### Heading 3
```

[toc] is not case sensitive

### Support Mermaid

More info to: [Mermaid](https://raw.githubusercontent.com/JaxsonWang/WP-Editor.md/docs/Example/Mermaid.md)

### Support MindMap

More info to: [MindMap](https://raw.githubusercontent.com/JaxsonWang/WP-Editor.md/docs/Example/MindMap.md)

### Compatibility Mode

If the front-end (article or page) KaTeX scientific formulas, Emoji expressions, flowcharts, sequence diagrams or some other problem (mainly from the browser's F12 console is a jQuery problem), it is recommended to turn this option on!
To a great extent, this problem can be solved.
