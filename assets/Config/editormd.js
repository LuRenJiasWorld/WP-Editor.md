/* global jQuery, TurndownService, require, editormd, wp, ajaxurl */

/**
 * Editor.md配置
 */
require("./editormd.css");

(function ($, doc, win, editor) {
  $(doc).ready(function () {
    var textareaID = null;
    if (doc.getElementById("wp-content-editor-container")) {
      textareaID = "wp-content-editor-container";
    } else if (doc.getElementById("wp-replycontent-editor-container") && editor.supportReply === "on" && location.href.indexOf("/wp-admin/") !== -1) {
      textareaID = "wp-replycontent-editor-container";
    } else if (doc.getElementById("comment") && editor.supportComment === "on" && location.href.indexOf("/wp-admin/") === -1) {
      textareaID = "comment";
      $("#comment").after("<div id=\"comment\"></div>").remove();
    } else if (editor.supportOther !== "") {
      // 自定义ID编辑器
      textareaID = editor.supportOther;
      $("#" + editor.supportOther).after("<div id=\"" + editor.supportOther + "\"></div>").remove();
    } else {
      return false;
    }

    //完整菜单
    var fullToolBar = [
      "undo", "redo", "|",
      "bold", "del", "italic", "quote", "ucwords", "uppercase", "lowercase", "|",
      "h1", "h2", "h3", "h4", "h5", "h6", "|",
      "list-ul", "list-ol", "hr", "|",
      "link", "reference-link", "image", "code", "code-block", "table", "datetime", editor.emoji !== "off" ? "emoji" : "" + "html-entities", "more", "pagebreak", "|",
      "goto-line", "watch", "preview", "fullscreen", "clear", "search", "|",
      "help", "info"
    ];
    var simpleToolBar = [
      "bold", "del", "italic", "quote", "ucwords", "uppercase", "lowercase", "|",
      "link", "reference-link", "image", "code", "code-block", "table", "datetime", editor.emoji !== "off" ? "emoji" : "" + "html-entities", "|",
      "watch", "preview", "fullscreen", "clear", "info"
    ];
    var miniToolBar = [
      "ucwords", "uppercase", "lowercase", "|",
      "link", "reference-link", "image", "table", "datetime", editor.emoji !== "off" ? "emoji" : "" + "html-entities", "|",
      "watch", "preview", "fullscreen", "info"
    ];

    var toolBar;
    switch (textareaID) {
      case "wp-content-editor-container":
        toolBar = fullToolBar;
        break;
      case "comment":
        toolBar = simpleToolBar;
        break;
      case "wp-replycontent-editor-container":
        toolBar = miniToolBar;
        break;
      default:
        toolBar = fullToolBar;
        break;
    }

    const editorTextArea = doc.getElementById(textareaID);

    const htmlTagEscapedItem = [
      // 可能会引起样式错乱或XSS漏洞的标签
      "script", "style",
      // 每次输入新字符都会导致重复加载的标签
      "audio", "video",
      // 表单相关内容，可能会影响编辑器其他功能（如无法提交）
      "form", "input", "textarea", "button", "select", "option", "optgroup", "fieldset", "output",
    ];

    var wpEditormd = editormd({
      id: textareaID,
      path: editor.editormdUrl + "/assets/Editormd/lib/",
      width: "100%", //编辑器宽度
      height: textareaID === "wp-content-editor-container" ? 640 : 320,  //编辑器高度
      syncScrolling: editor.syncScrolling !== "off", //即是否开启同步滚动预览
      watch: textareaID === editor.livePreview !== "off", //即是否开启实时预览
      htmlDecode: editor.htmlDecode !== "off", //HTML标签解析
      htmlTagEscapedItem: htmlTagEscapedItem,
      toolbarAutoFixed: false, //工具栏是否自动固定
      toolbar: true,
      autoFocus: textareaID !== "comment", //判断场景是否跳转到编辑器区域
      tocm: false, //同TOC 不过不合适
      tocContainer: editor.toc === "off" ? false : "", //TOC
      tocDropdown: false, //下拉TOC
      theme: editor.theme, //编辑器总体主题
      previewTheme: editor.previewTheme, //编辑器主题
      editorTheme: editor.editorTheme, //编辑器主题
      emoji: editor.emoji !== "off", //Emoji表情
      tex: editor.tex === "katex", //LaTeX公式
      mind: editor.mindMap !== "off", //思维导图
      mermaid: editor.mermaid !== "off", //Mermaid
      atLink: false, //Github @Link
      taskList: editor.taskList !== "off", //task lists
      imageFormats: ["jpg", "jpeg", "gif", "png", "bmp", "webp"],
      placeholder: editor.placeholderEditor, //编辑器placeholder
      prismTheme: editor.prismTheme, //Prism主題风格
      prismLineNumbers: editor.prismLineNumbers !== "off",
      saveHTMLToTextarea: true,
      toolbarIcons: function () {
        return toolBar;
      },
      //强制全屏
      onfullscreen: function () {
        editorTextArea.style.position = "fixed";
        editorTextArea.style.zIndex = "99999";
        editorTextArea.style.width = "100%";
        editorTextArea.style.height = "100%";
      },
      //退出全屏返回原来的样式
      onfullscreenExit: function () {
        editorTextArea.style.position = "relative";
        editorTextArea.style.zIndex = "auto";
        editorTextArea.style.width = "100%";
        editorTextArea.style.removeProperty("height");
        // 触发resize事件，让编辑器重新获得尺寸信息，重新处理编辑器内部布局
        window.dispatchEvent(new Event("resize", {}));
      },
      onload: function () {
        //加载完成执行
        if (textareaID === "comment") {
          //修改评论表单name
          $("textarea.editormd-markdown-textarea").attr("name", "comment");
        }

        if (textareaID === "wp-replycontent-editor-container") {
          $(".reply").click(function () {
            setTimeout(function () {
              $(".edit-comments-php .CodeMirror.cm-s-default.CodeMirror-wrap").css("margin-top", $(".editormd-toolbar").height());
            }, 100);
          });
        }

        if (getWidth() === 1600) {
          // 1600分辨率删除编辑器编辑空白外边距
          var codeMirror = $(".editormd .CodeMirror.CodeMirror-wrap");
          var codeMirrorMarginTop = codeMirror.css("margin-top");
          codeMirror.css("margin-top", parseInt(codeMirrorMarginTop) - 32 + "px");
        }

        // 隐藏默认编辑器
        $("#ed_toolbar").hide();
      }
    });
    // WP Media module支持
    if (typeof wp !== "undefined" && typeof wp.media !== "undefined") {
      var original_wp_media_editor_insert = wp.media.editor.insert;
      wp.media.editor.insert = function (html) {
        // 显示Loading画面，避免用户以为添加失败
        showLoader();

        // 需要判断标签格式，如果是可以被转换的标签则对其进行转换
        // <img> <a>标签是可以被转换的
        // 否则不进行转换，直接插入到文本中
        var convertableRegex = new RegExp("(<img .*?>)|(<a ?.*?>.*<\/a>)");
        var markdown;
        if (convertableRegex.test(html)) {
          var turndownService = new TurndownService();
          markdown = turndownService.turndown(html);
        } else {
          markdown = html;
        }

        original_wp_media_editor_insert(markdown);
        wpEditormd.insertValue(markdown);

        hideLoader(1500);
      };
    }
    // 实时更新字数
    var updateWordCounter = setInterval(function() {
      // wp.utils.WordCounter()在前台评论部分不存在，因此需要判断一下，避免出现错误
      if (wp && wp.utils) {
        var $count = $("#wp-word-count").find(".word-count");
        var html = wpEditormd.getHTML();

        var wordCounter = new wp.utils.WordCounter();
        var words = wordCounter.count(html);

        $count.text(words);
      } else {
        clearInterval(updateWordCounter);
      }
    }, 1000);
    // 图像粘贴
    if (editor.imagePaste === "on") {
      $("#" + textareaID).on("paste", function (event) {
        event = event.originalEvent;
        var cbd = window.clipboardData || event.clipboardData; //兼容ie||chrome
        var ua = window.navigator.userAgent;
        if (!(event.clipboardData && event.clipboardData.items)) {
          return;
        }
        // 获取当前光标位置
        var nowCursor = {
          line: wpEditormd.getCursor().line,
          ch: wpEditormd.getCursor().ch
        };
        if (cbd.items && cbd.items.length === 2 && cbd.items[0].kind === "string" && cbd.items[1].kind === "file" &&
          cbd.types && cbd.types.length === 2 && cbd.types[0] === "text/plain" && cbd.types[1] === "Files" &&
          ua.match(/Macintosh/i) && Number(ua.match(/Chrome\/(\d{2})/i)[1]) < 49) {
          return;
        }
        var itemLength = cbd.items.length;
        if (itemLength === 0) {
          return;
        }
        if (itemLength === 1 && cbd.items[0].kind === "string") {
          return;
        }

        // 此处itemLength等于2的情况是为了兼容MacOS，其剪贴板内包含两个元素，一个是文件名，一个是文件二进制数据
        if ((itemLength === 1 && cbd.items[0].kind === "file") || itemLength === 2 && cbd.items[1].kind === "file") {
          var item;
          var fileName = "";
          if (itemLength === 1) {
            item = cbd.items[0];
          } else {
            cbd.items[0].getAsString(function(s) {
              fileName = s;
            });
            item = cbd.items[1];
          }


          var blob = item.getAsFile();
          if (blob.size === 0) {
            return;
          }

          showLoader();

          //传参
          readBlobAsDataURL(blob, function (dataurl) {
            var uploadingText = "![" + editor.imgUploading + "]";
            var uploadFailText = "![" + editor.imgUploadeFailed + "]";
            var data = {
              action: "wp_editormd_imagepaste",
              dataurl: dataurl
            };
            wpEditormd.insertValue(uploadingText);

            // 去除部分设备下粘贴时出现的文件名（如MacOS）
            wpEditormd.setValue(wpEditormd.getValue().replace(fileName, ""));
            nowCursor.ch = nowCursor.ch - fileName.length;

            $.ajax({
              url: ajaxurl,
              type: "POST",
              data: data,
              success: function (obj) {
                let pasteMarkdownText;
                if (obj.error) {
                  pasteMarkdownText = wpEditormd.getValue().replace(uploadingText, uploadFailText);
                } else {
                  if ( editor.imageLink === "on" ) {
                    pasteMarkdownText = wpEditormd.getValue().replace(uploadingText, "[" + "![](" + obj.url + ")" + "](" + obj.url + ")");
                  } else {
                    pasteMarkdownText = wpEditormd.getValue().replace(uploadingText, "![](" + obj.url + ")");
                  }
                }
                wpEditormd.setValue(pasteMarkdownText);

                // 移动光标
                nowCursor.ch = nowCursor.ch + pasteMarkdownText.length;
                wpEditormd.setCursor(nowCursor);
                wpEditormd.focus();
              },
              complete: function() {
                hideLoader();
              }
            });
          });
        }
      });
    }
  });
  // CodeMirror
  editormd.codeMirrorURL = {
    url: cdn_url(editor.editormdUrl, "codemirror")
  };
  // Marked
  editormd.markedURL = {
    js: cdn_url(editor.editormdUrl, "marked") + "/marked.min"
  };
  // Prism高亮库
  editormd.prismURL = {
    url: cdn_url(editor.editormdUrl, "prismjs")
  };

  // 思维导图自定义地址
  editormd.mindMapURL = splitFileName(editor.mindMapURL);

  // KaTeX科学公式配置
  if (editor.tex === "on") {
    editormd.katexURL = {
      css: cdn_url(editor.editormdUrl, "katex") + "/katex.min",
      js: cdn_url(editor.editormdUrl, "katex") + "/katex.min"
    };
  }
  // Mermaid配置
  if (editor.mermaid === "on") {
    editormd.mermaidURL = {
      js: cdn_url(editor.editormdUrl, "mermaid") + "/mermaid.min"
    };
  }
  // Emoji表情配置
  if (editor.emoji === "on") {
    editormd.emoji = {
      path: cdn_url(editor.editormdUrl, "emojify") + "/",
      ext: ".png"
    };
  }

  /**
   * 判断CDN地址
   * @param url 传入CDN地址
   * @param lib 类库名称
   * @returns {*} 重写url
   */
  function cdn_url(url, lib) {
    var lib_url;
    switch (lib) {
      case "emojify":
        lib_url = url + "/assets/Emojify.js/images/basic";
        break;
      case "katex":
        lib_url = url + "/assets/KaTeX";
        break;
      case "mermaid":
        lib_url = url + "/assets/Mermaid";
        break;
      case "prismjs":
        lib_url = url + "/assets/Prism.js";
        break;
      case "codemirror":
        lib_url = url + "/assets/CodeMirror";
        break;
      case "marked":
        lib_url = url + "/assets/Marked";
    }
    return lib_url;
  }

  /**
   * 获取窗口宽度
   * @returns {*}
   */
  function getWidth() {
    if (Window.innerWidth) {
      return Window.innerWidth;
    }
    if (document.documentElement && document.documentElement.clientWidth) {
      return document.documentElement.clientWidth;
    }
    if (document.body) {
      return document.body.clientWidth;
    }
  }

  /**
   * 获取去掉后缀
   * @param text
   * @returns {*}
   */
  function splitFileName(text) {
    var pattern = /\.{1}[a-z]{1,}$/;
    if (pattern.exec(text) !== null) {
      return (text.slice(0, pattern.exec(text).index));
    } else {
      return text;
    }
  }

  //封装FileReader对象
  function readBlobAsDataURL(blob, callback) {
    var reader = new FileReader();
    reader.onload = function (e) {
      callback(e.target.result);
    };
    reader.readAsDataURL(blob);
  }

  function showLoader() {
    jQuery(".editormd-container-mask").css("display", "block");
  }

  function hideLoader(timeout = 0) {
    setTimeout(function() {
      jQuery(".editormd-container-mask").css("display", "none");
    }, timeout);
  }
})(window.jQuery, document, window, window._Editormd);
