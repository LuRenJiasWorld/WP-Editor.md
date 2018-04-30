(function ($, doc, win, editor) {
    $(doc).ready(function () {
        try {
            if (doc.getElementById('wp-content-editor-container') !== null) {
                var wpEditormd = editormd({
                    id: 'wp-content-editor-container',
                    path: editor.editormdUrl + '/assets/Editormd/lib/',
                    width: '100%', //编辑器宽度
                    height: 640,    //编辑器高度
                    syncScrolling: editor.syncScrolling !== 'off', //即是否开启同步滚动预览
                    watch: editor.watch !== 'off', //即是否开启实时预览
                    htmlDecode: editor.htmlDecode !== 'off', //HTML标签解析
                    toolbarAutoFixed: true, //工具栏是否自动固定
                    tocm: false, //同TOC 不过不合适
                    tocContainer: editor.toc === 'off' ? false : '', //TOC
                    tocDropdown: false, //下拉TOC
                    theme: editor.theme, //编辑器总体主题
                    previewTheme: editor.previewTheme, //编辑器主题
                    editorTheme: editor.editorTheme, //编辑器主题
                    emoji: editor.emoji !== 'off', //Emoji表情
                    tex: editor.tex !== 'off', //LaTeX公式
                    atLink: false,//Github @Link
                    flowChart: editor.flowChart !== 'off', //FlowChart流程图
                    sequenceDiagram: editor.sequenceDiagram !== 'off',//SequenceDiagram时序图
                    taskList: editor.taskList !== 'off',//task lists
                    placeholder: editor.placeholderEditor, //编辑器placeholder
                    toolbarIcons: function () {
                        // Or return editormd.toolbarModes[name]; // full, simple, mini
                        // Using '||' set icons align right.
                        return [
                            'undo', 'redo', '|',
                            'bold', 'del', 'italic', 'quote', 'ucwords', 'uppercase', 'lowercase', '|',
                            'h1', 'h2', 'h3', 'h4', 'h5', 'h6', '|',
                            'list-ul', 'list-ol', 'hr', '|',
                            'link', 'reference-link', 'image', 'code', 'preformatted-text', 'code-block', 'table', 'datetime', 'html-entities', 'more', 'pagebreak', editor.emoji !== 'off' ? 'emoji' : '' + 'toc', '|',
                            'goto-line', 'watch', 'preview', 'fullscreen', 'clear', 'search', '|',
                            'help', 'info'
                        ];
                    },
                    //强制全屏
                    onfullscreen: function () {
                        $('#wp-content-editor-container').css({
                            'position': 'fixed',
                            'z-index': '99999'
                        })
                    },
                    //退出全屏返回原来的样式
                    onfullscreenExit: function () {
                        $('#wp-content-editor-container').css({
                            'position': 'relative',
                            'z-index': 'auto'
                        })
                    },
                    //自定义工具栏
                    toolbarIconsClass: {
                        toc: 'fa-list-alt',  // 指定一个FontAawsome的图标类
                        more: 'fa-ellipsis-h'
                    },
                    // 自定义工具栏按钮的事件处理
                    toolbarHandlers: {
                        /**
                         * @param {Object}      cm         CodeMirror对象
                         * @param {Object}      icon       图标按钮jQuery元素对象
                         * @param {Object}      cursor     CodeMirror的光标对象，可获取光标所在行和位置
                         * @param {String}      selection  编辑器选中的文本
                         */
                        toc: function (cm, icon, cursor, selection) {
                            cm.replaceSelection('[toc]');
                        },
                        more: function (cm, icon, cursor, selection) {
                            cm.replaceSelection('\r\n<!--more-->\r\n');
                        }
                    },
                    lang: {
                        toolbar: {
                            toc: 'The Table Of Contents',
                            more: 'More'
                        }
                    }
                });

                // WP Media module支持
                var original_wp_media_editor_insert = wp.media.editor.insert;
                wp.media.editor.insert = function (html) {
                    //console.log(html);
                    //创建新的DOM
                    var htmlDom = doc.createElement('div');
                    htmlDom.style.display = 'none';
                    htmlDom.id = 'htmlDom';
                    htmlDom.innerHTML = html;
                    doc.body.appendChild(htmlDom);
                    var dom = doc.getElementById('htmlDom').childNodes[0];
                    var markdownSrc;
                    console.log(dom.localName);
                    switch (dom.localName) {
                        case 'a':
                            if (dom.childNodes[0].localName === 'img') {
                                markdownSrc = '[![](' + dom.childNodes[0].src + ')](' + dom.href + ')';
                            } else {
                                markdownSrc = '[' + dom.innerText + '](' + dom.href + ')';
                            }
                            break;
                        case 'img':
                            var htmlSrc = doc.getElementsByClassName('alignnone')[0].src;
                            var htmlAlt = doc.getElementsByClassName('alignnone')[0].alt;
                            markdownSrc = '![' + htmlAlt + '](' + htmlSrc + ')';
                            break;
                        default:
                            markdownSrc = doc.getElementById('htmlDom').innerHTML;
                    }
                    original_wp_media_editor_insert(markdownSrc);
                    wpEditormd.insertValue(markdownSrc);
                    //移除dom
                    doc.getElementById('htmlDom').remove();
                };

                // Emoji表情配置
                if (editor.emoji === 'on') {
                    // Emoji graphics files url path
                    editormd.emoji = {
                        path: cdn_url(editor.staticFileCDN, 'emojify') + '/',
                        ext: '.png'
                    };
                }

                // KaTeX科学公式配置
                if (editor.tex === 'on') {
                    editormd.katexURL = {
                        css: cdn_url(editor.staticFileCDN, 'katex_config') + '/katex.min',
                        js: cdn_url(editor.staticFileCDN, 'katex_config') + '/katex.min'
                    }
                }

                // 图像粘贴
                if (editor.imagePaste === 'on') {
                    $('#wp-content-editor-container').on('paste', function (event) {
                        event = event.originalEvent;
                        var cbd = window.clipboardData || event.clipboardData; //兼容ie||chrome
                        var ua = window.navigator.userAgent;
                        if (!(event.clipboardData && event.clipboardData.items)) {
                            return;
                        }
                        if (cbd.items && cbd.items.length === 2 && cbd.items[0].kind === 'string' && cbd.items[1].kind === 'file' &&
                            cbd.types && cbd.types.length === 2 && cbd.types[0] === 'text/plain' && cbd.types[1] === 'Files' &&
                            ua.match(/Macintosh/i) && Number(ua.match(/Chrome\/(\d{2})/i)[1]) < 49) {
                            return;
                        }
                        var itemLength = cbd.items.length;
                        if (itemLength === 0) {
                            return;
                        }
                        if (itemLength === 1 && cbd.items[0].kind === 'string') {
                            return;
                        }
                        if ((itemLength === 1 && cbd.items[0].kind === 'file')) {
                            var item = cbd.items[0];
                            var blob = item.getAsFile();
                            if (blob.size === 0) {
                                return;
                            }

                            //封装FileReader对象
                            function readBlobAsDataURL(blob, callback) {
                                var reader = new FileReader();
                                reader.onload = function (e) {
                                    callback(e.target.result);
                                };
                                reader.readAsDataURL(blob);
                            }

                            //传参
                            readBlobAsDataURL(blob, function (dataurl) {
                                var uploadingText = '![' + editor.imgUploading + ']';
                                var uploadFailText = '![' + editor.imgUploadeFailed + ']';
                                var data = {
                                    action: 'imagepaste_action',
                                    dataurl: dataurl
                                };
                                wpEditormd.insertValue(uploadingText);
                                $.ajax({
                                    url: ajaxurl,
                                    type: 'post',
                                    data: data,
                                    success: function (request) {
                                        var obj = eval('(' + request + ')');
                                        if (obj.error) {
                                            wpEditormd.setValue(wpEditormd.getValue().replace(uploadingText, uploadFailText));
                                        } else {
                                            wpEditormd.setValue(wpEditormd.getValue().replace(uploadingText, '![](' + obj.url + ')'));
                                        }
                                    }
                                });
                            });
                        }
                    });
                }
            }

            /**
             * 判断CDN地址
             * @param url 传入CDN地址
             * @param lib 类库名称
             * @returns {*} 重写url
             */
            function cdn_url(url, lib) {
                var lib_url;
                if (url === '//cdn.jsdelivr.net') {
                    switch (lib) {
                        case 'emojify':
                            lib_url = url + '/npm/emojify.js@1.1.0/dist/images/basic';
                            break;
                        case 'katex_config':
                            lib_url = url + '/npm/katex@0.9.0/dist';
                            break;
                    }
                } else {
                    switch (lib) {
                        case 'emojify':
                            lib_url = url + '/emojify.js/1.1.0/images/basic';
                            break;
                        case 'katex_config':
                            lib_url = url + '/KaTeX/0.9.0';
                            break;
                    }
                }
                return lib_url;
            }
        } catch (e) {
            console.error(e);
        }
    });
})(jQuery, document, window, window.Editormd);