$(function () {
    // 剪贴板解析HTML转换到Markdown
    clipboardHTMLToMd = function (htmlText) {
        if (htmlText !== "") {
            var referencelinkRegEx = /reference-link/;
            EditorMD.insertValue(toMarkdown(htmlText, {
                gfm: true,
                converters:[
                    {
                        filter: 'div',
                        replacement: function(content) {
                            return content + '\n';
                        }
                    },
                    {
                        filter: 'span',
                        replacement: function(content) {
                            return content;
                        }
                    },
                    {
                        filter: function (node) {
                            return (node.nodeName === 'A' && referencelinkRegEx.test(node.className));
                        },
                        replacement: function(content) {
                            return "";
                        }
                    }]})
            );
            return true;
        }
        return false;
    };
});