(function ($, doc, win, frontStyle) {
  $(doc).ready(function() {
    if (frontStyle) {
      var conf = {
        openLinkInNewTab: frontStyle.openLinkInNewTab === "on"
      };

      new Handler(conf);
    }
  });

  function Handler(conf) {
    // 对配置进行分别处理
    if (conf.openLinkInNewTab) this.openLinkInNewTab();
  }

  Handler.prototype.openLinkInNewTab = function() {
    $(".wp-editor-md-post-content-link").attr("target", "_blank");
  };

})(window.jQuery, document, window, window.FrontStyle);