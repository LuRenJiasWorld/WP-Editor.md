(function ($, doc, win, frontStyle) {
	$(doc).ready(function () { 
		if (frontStyle) {
			var conf = {
				openLinkInNewTab: frontStyle.openLinkInNewTab == "on"
			}
	
			Handler(conf);
		}
	})

	function Handler(conf) {
		// 对配置进行分别处理
		if (conf.openLinkInNewTab) Handler.prototype.openLinkInNewTab();
	}

	Handler.prototype.openLinkInNewTab = function() {
		$(".wp-editor-md-post-content-link").attr("target", "_blank");
	}

})(window.jQuery, document, window, window.FrontStyle);