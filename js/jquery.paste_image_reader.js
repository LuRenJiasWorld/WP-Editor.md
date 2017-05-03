(function ($) {
    var defaults;
    $.event.fix = (function (originalFix) {
        return function (event) {
            event = originalFix.apply(this, arguments);
            if (event.type.indexOf("copy") === 0 || event.type.indexOf("paste") === 0) {
                event.clipboardData = event.originalEvent.clipboardData
            }
            return event
        }
    })($.event.fix);
    defaults = {callback: $.noop, matchType: /image.*/};
    return $.fn.pasteImageReader = function (options) {
        if (typeof options === "function") {
            options = {callback: options}
        }
        options = $.extend({}, defaults, options);
        return this.each(function () {
            var $this, element;
            element = this;
            $this = $(this);
            return $this.bind("paste", function (event) {
                var clipboardData, found;
                found = false;
                if (jQuery.browser.chrome) {
                    clipboardData = event.clipboardData;
                    return Array.prototype.forEach.call(clipboardData.types, function (type, i) {
                        var file, reader;
                        if (found) {
                            return
                        }
                        if (type.match(options.matchType) || clipboardData.items[i].type.match(options.matchType)) {
                            file = clipboardData.items[i].getAsFile();
                            reader = new FileReader();
                            reader.onload = function (evt) {
                                return options.callback.call(element, {
                                    dataURL: evt.target.result,
                                    event: evt,
                                    file: file,
                                    name: file.name
                                })
                            };
                            reader.readAsDataURL(file);
                            return found = true
                        }
                    })
                } else {
                    if (jQuery.browser.mozilla) {
                        var that = this;
                        setTimeout(function () {
                            images = jQuery(that).find("img");
                            for (i = 0; i < images.length; i++) {
                                if (jQuery(images[i]).attr("src").substr(0, 5) == "data:") {
                                    jQuery(images[i]).attr("id", "imagepaste_temp_" + i);
                                    var data = {
                                        action: "imagepaste_action",
                                        dataurl: jQuery(images[i]).attr("src"),
                                        elementid: "imagepaste_temp_" + i
                                    };
                                    jQuery("#publishing-action #publish").attr("disabled", true);
                                    new jQuery.ajax({
                                        url: ajaxurl,
                                        type: "post",
                                        data: data,
                                        success: function (request) {
                                            jQuery("#publishing-action #publish").removeAttr("disabled");
                                            var obj = eval("(" + request + ")");
                                            var target = jQuery("html").find("iframe").contents().find("body").find("#" + obj.elementid);
                                            target.attr("data-mce-src", obj.url);
                                            target.attr("src", obj.url);
                                            target.attr("id", null)
                                        }
                                    })
                                }
                            }
                        }, 1)
                    } else {
                        console.log("not supported")
                    }
                }
            })
        })
    }
})(jQuery);