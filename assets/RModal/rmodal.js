(function (global, factory) {
    typeof exports === 'object' && typeof module !== 'undefined' ? module.exports = factory() :
    typeof define === 'function' && define.amd ? define(factory) :
    (global = global || self, global.RModal = factory());
}(this, function () { 'use strict';

    var is = function (obj, type) { return Object.prototype.toString.call(obj).toLowerCase() === ("[object " + type + "]"); };

    var addClass = function (el, cls) {
        var arr = el.className
        .split(/\s+/)
        .filter(function (c) { return !!c && c == cls; });

        if (!arr.length) {
            el.className += " " + cls;
        }
    };

    var removeClass = function (el, cls) {
        el.className = el.className
        .split(/\s+/)
        .filter(function (c) { return !!c && c != cls; })
        .join(' ');
    };

    var RModal = function RModal(el, opts) {
        var this$1 = this;

        this.opened = false;

        this.opts = {
            bodyClass: 'modal-open',
            dialogClass: 'modal-dialog',
            dialogOpenClass: 'bounceInDown',
            dialogCloseClass: 'bounceOutUp',
            focus: true,
            focusElements: [
                'a[href]', 'area[href]', 'input:not([disabled]):not([type=hidden])',
                'button:not([disabled])', 'select:not([disabled])',
                'textarea:not([disabled])', 'iframe', 'object', 'embed',
                '*[tabindex]', '*[contenteditable]'
            ],
            escapeClose: true,
            content: null,
            closeTimeout: 500
        };

        Object.keys(opts || {})
        .forEach(function (key) {
            /* istanbul ignore else */
            if (opts[key] !== undefined) {
                this$1.opts[key] = opts[key];
            }
        });

        this.overlay = el;
        this.dialog = el.querySelector(("." + (this.opts.dialogClass)));

        if (this.opts.content) {
            this.content(this.opts.content);
        }
    };

    RModal.prototype.open = function open (content) {
            var this$1 = this;

        this.content(content);

        if (!is(this.opts.beforeOpen, 'function')) {
            return this._doOpen();
        }

        this.opts.beforeOpen(function () {
            this$1._doOpen();
        });
    };

    RModal.prototype._doOpen = function _doOpen () {
        addClass(document.body, this.opts.bodyClass);

        removeClass(this.dialog, this.opts.dialogCloseClass);
        addClass(this.dialog, this.opts.dialogOpenClass);

        this.overlay.style.display = 'block';

        if (this.opts.focus) {
            this.focusOutElement = document.activeElement;
            this.focus();
        }

        if (is(this.opts.afterOpen, 'function')) {
            this.opts.afterOpen();
        }
        this.opened = true;
    };

    RModal.prototype.close = function close () {
            var this$1 = this;

        if (!is(this.opts.beforeClose, 'function')) {
            return this._doClose();
        }

        this.opts.beforeClose(function () {
            this$1._doClose();
        });
    };

    RModal.prototype._doClose = function _doClose () {
            var this$1 = this;

        removeClass(this.dialog, this.opts.dialogOpenClass);
        addClass(this.dialog, this.opts.dialogCloseClass);

        removeClass(document.body, this.opts.bodyClass);

        if (this.opts.focus) {
            this.focus(this.focusOutElement);
        }

        setTimeout(function () {
            this$1.overlay.style.display = 'none';

            if (is(this$1.opts.afterClose, 'function')) {
                this$1.opts.afterClose();
            }
            this$1.opened = false;
        }, this.opts.closeTimeout);
    };

    RModal.prototype.content = function content (html) {
        if (html === undefined) {
            return this.dialog.innerHTML;
        }

        this.dialog.innerHTML = html;
    };

    RModal.prototype.elements = function elements (selector, fallback) {
        fallback = fallback || window.navigator.appVersion.indexOf('MSIE 9.0') > -1;
        selector = is(selector, 'array') ? selector.join(',') : selector;

        return [].filter.call(
            this.dialog.querySelectorAll(selector)
            , function (element) {
                if (fallback) {
                    var style = window.getComputedStyle(element);
                    return style.display !== 'none' && style.visibility !== 'hidden';
                }

                return element.offsetParent !== null;
            }
        );
    };

    RModal.prototype.focus = function focus (el) {
        el = el || this.elements(this.opts.focusElements)[0] || this.dialog.firstChild;

        if (el && is(el.focus, 'function')) {
            el.focus();
        }
    };

    RModal.prototype.keydown = function keydown (ev) {
        if (this.opts.escapeClose && ev.which == 27) {
            this.close();
        }

        var stopEvent = function () {
            ev.preventDefault();
            ev.stopPropagation();
        };

        if (this.opened && ev.which == 9 && this.dialog.contains(ev.target)) {
            var elements = this.elements(this.opts.focusElements),
                first = elements[0],
                last = elements[elements.length - 1];

            if (first == last) {
                stopEvent();
            }
            else if (ev.target == first && ev.shiftKey) {
                stopEvent();
                last.focus();
            }
            else if (ev.target == last && !ev.shiftKey) {
                stopEvent();
                first.focus();
            }
        }
    };

    RModal.prototype.version = '1.0.36';
    RModal.version = '1.0.36';

    return RModal;

}));
//# sourceMappingURL=rmodal.js.map
