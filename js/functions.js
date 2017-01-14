function iiong() {
    // 初始化編輯器
    var EditorMD;
    $(function() {
        EditorMD = editormd("wp-content-editor-container", {
            width            : "100%",
            height           : 640,
            syncScrolling    : "single", //即是否开启同步滚动预览
            htmlDecode       : true, //开启HTML解析
            toolbarAutoFixed : true, //工具栏是否自动固定
            path             : "../wp-content/plugins/WP-Editor.MD/lib/", //资源路径
            toolbarIcons     : function() {
                // Or return editormd.toolbarModes[name]; // full, simple, mini
                // Using "||" set icons align right.
                return [
                    "undo", "redo", "|",
                    "bold", "del", "italic", "quote", "ucwords", "uppercase", "lowercase", "|",
                    "h1", "h2", "h3", "h4", "h5", "h6", "|",
                    "list-ul", "list-ol", "hr", "|",
                    "link", "reference-link", "image", "code", "preformatted-text", "code-block", "table", "datetime", "html-entities", "more", "pagebreak", "|",
                    "goto-line", "watch", "preview", "fullscreen", "clear", "search", "|",
                    "help", "info"
                ];
            }, //自定义标题栏
            toolbarIconsClass: {
                more: "fa-arrows-h" //指定一个FontAawsome的图标类
            },
            // 自定义工具栏按钮的事件处理
            toolbarHandlers  : {
                /**
                 * @param {Object}      cm         CodeMirror对象
                 * @param {Object}      icon       图标按钮jQuery元素对象
                 * @param {Object}      cursor     CodeMirror的光标对象，可获取光标所在行和位置
                 * @param {String}      selection  编辑器选中的文本
                 */
                more: function (cm, icon, cursor, selection) {
                    cm.replaceSelection("<!--more-->");
                }},
            lang           : {
                toolbar: {
                    more: "摘要分隔符"
                }
            },
        });
    });
}