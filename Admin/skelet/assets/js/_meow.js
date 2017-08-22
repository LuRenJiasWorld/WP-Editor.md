(function ($,doc) {
    jQuery(document).ready(function ($) {
        /**
         * 隐藏内容
         * @type {Element}
         */
        var support_comment = doc.querySelector(".support_comment");
        var toc_tips = doc.querySelector(".toc_tips");
        if ( support_comment !== null) {
            var support_comment_text = getNearEle(support_comment, 0);
            support_comment_text.parentNode.removeChild(support_comment_text);
        }
        if ( toc_tips !== null) {
            var toc_tips_text = getNearEle(toc_tips, 0);
            toc_tips_text.parentNode.removeChild(toc_tips_text);
        }

        /**
         * 根据选项显示或者隐藏
         */
        if (doc.querySelectorAll(".nav-tab")[3].getAttribute("class") === "nav-tab nav-tab-active") {
            if (doc.querySelectorAll("input")[1].getAttribute("checked") === "checked") {
                doc.querySelectorAll(".form-table")[1].style.display = "block";
                doc.querySelectorAll(".form-table")[2].style.display = "block";
                doc.querySelectorAll(".form-table")[3].style.display = "block";
            } else {
                doc.querySelectorAll(".form-table")[1].style.display = "none";
                doc.querySelectorAll(".form-table")[2].style.display = "none";
                doc.querySelectorAll(".form-table")[3].style.display = "none";
            }
            doc.querySelectorAll("input")[0].addEventListener("click",function () {
                doc.querySelectorAll(".form-table")[1].style.display = "none";
                doc.querySelectorAll(".form-table")[2].style.display = "none";
                doc.querySelectorAll(".form-table")[3].style.display = "none";
            });
            doc.querySelectorAll("input")[1].addEventListener("click",function () {
                doc.querySelectorAll(".form-table")[1].style.display = "block";
                doc.querySelectorAll(".form-table")[2].style.display = "block";
                doc.querySelectorAll(".form-table")[3].style.display = "block";
            });

        }

        /**
         * 获取相邻元素
         * @param ele 参考物元素
         * @param type 类型，上一个(1)or下一个(0)
         * @return 返回查找到的元素Dom对象，无则返回null
         */
        function getNearEle(ele, type) {
            type = type === 1 ? "previousSibling" : "nextSibling";
            var nearEle = ele[type];
            while(nearEle) {
                if(nearEle.nodeType === 1) {
                    return nearEle;
                }
                nearEle = nearEle[type];
                if(!nearEle) {
                    break;
                }
            }
            return null;
        }
        /**
         * 获取当前执行对象的上一个元素
         */
        function prev() {
            return getNearEle(this, 1);
        }
        /**
         * 获取当前执行对象的下一个元素
         */
        function next() {
            return getNearEle(this, 0);
        }
    });
})(jQuery,document);