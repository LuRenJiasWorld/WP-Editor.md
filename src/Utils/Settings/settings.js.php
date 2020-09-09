<!-- 导出调试信息需要使用到的JS文件 -->
<script src="<?php echo $editor_style_base_address . "/assets/DomToImage/dist/dom-to-image.min.js?version=" . WP_EDITORMD_VER ?>"></script>
<script src="<?php echo $editor_style_base_address . "/assets/FileSaver/FileSaver.min.js?version=" . WP_EDITORMD_VER ?>"></script>

<script type="text/javascript">
(function ($) {
	$("window").ready(function() {
		///	---------------------
		/// 通用
		///	---------------------
		$.urlParam = function (name) {
			var results = new RegExp('[\?&]' + name + '=([^&#]*)')
							.exec(window.location.search);

			return (results !== null) ? results[1] || 0 : false;
		}
		///	---------------------
		/// 通用
		///	---------------------


		///	---------------------
		/// 调试信息与捐赠信息
		///	---------------------
		// 切换显示信息
		$("#debugger").click(function (event) {
			event.preventDefault();

			if ($(".form-and-donate").css("flex-direction") !== "column") {
				$(".form-and-donate").css("flex-direction", "column");
			} else {
				$(".form-and-donate").css("flex-direction", "row");    
			}

			$(".debugger-wrap").fadeToggle();
			$("#donate").fadeToggle();
		});

		// 下载调试信息
		$("#debugger-download").click(function (event) {
			// lastElementChild是table
			domtoimage.toBlob(document.getElementsByClassName("debugger-wrap")[0].lastElementChild, {
				bgcolor: "#ffffff"
			}).then(function (blob) {
				window.saveAs(blob, "wp-editormd-debug-info.png");
			})
		});
		
		// 判断非调试界面则隐藏
		$("a[href!='#editor_advanced'].nav-tab").click(function () {
			if ($(".form-and-donate").css("flex-direction") !== "row") {
				$(".form-and-donate").css("flex-direction", "row");
			}
			$(".debugger-wrap").hide();
			$("#donate").show();
		});
		///	---------------------
		/// 调试信息与捐赠信息
		///	---------------------


		///	---------------------
		/// sm-ms-management
		///	---------------------
		function modalTemplate(content) {
			return '<div id="wp-editormd-modal" class="modal">' 
					+ content
					+ '</div>';
		}

		$("#sm-ms-management").click(function(event) {
			event.preventDefault();

			var sm_ms_token = $("#editor_basics\\[imagepaste_sm_token\\]").val();

			$("#wp-editormd-modal").remove();
			$(modalTemplate(
				'<iframe id="sm-ms-management-window" src="<?php echo get_site_url(); ?>/wp-admin/admin-ajax.php?action=wp_editormd_pages&page=sm-ms-management&token=' + sm_ms_token + 
				'&endpoint_url=' + encodeURIComponent("<?php echo get_site_url(); ?>/wp-admin/admin-ajax.php?action=wp_editormd_pages&page=sm-ms-management&entry=sm_ms_proxy") + '"></iframe>'
			)).appendTo("body").modal({
				fadeDuration: 200
			});

			// 点击悬浮窗的关闭按钮后，自动清除窗口相关DOM节点
			let interval = setInterval(function() {
				$(".close-modal").click(function() {
					setTimeout(function() {
						clearInterval(interval);
						$("#wp-editormd-modal").remove();
					}, 200);
				});
			}, 200);
		});
		///	---------------------
		/// sm-ms-management
		///	---------------------


		///	---------------------
		/// 升级提示
		///	---------------------
		function urlWithoutUpgradeArgs(url) {
			return url
				.replace(/&action=\w+/, "")
				.replace(/&version=[0-9]{1,3}\.[0-9]{1,2}\.[0-9]{1,2}/, "");
		}

		if ($.urlParam("page") === "wp-editormd-settings" && $.urlParam("action") === "release" && $.urlParam("version")) {
			$(modalTemplate(
				'<iframe id="upgrade-release" src="<?php echo get_site_url(); ?>/wp-admin/admin-ajax.php?action=wp_editormd_pages&page=upgrade-release&version=' + $.urlParam("version") + '"></iframe>'
			)).appendTo("body").modal({
				fadeDuration: 200
			});
			
			history.replaceState({}, "", urlWithoutUpgradeArgs(location.href));

			// 避免点击保存，提交表单后又跳到升级提示链接
			var input = $("input[name=\"_wp_http_referer\"]");
			var oldLink = input.val();
			input.val(urlWithoutUpgradeArgs(oldLink));

		}
		///	---------------------
		/// 升级提示
		///	---------------------


		///	---------------------
		/// 重置资源
		///	---------------------
		// 在编辑器静态资源地址部分增加重置按钮
		resetResources();

		function resetResources() {
			// 定位按钮插入位置
			var editor_address    = $("#editor_style\\[editor_addres\\]");
			var customize_mindmap = $("#editor_mindmap\\[customize_mindmap\\]");

			// 插入按钮
			$(
				'<br />'
			+ '<button class="button reset-button button-secondary" id="reset_editor_addres_local"><?php echo __('Use local', $this->text_domain) ?></button>'
			+ '<button class="button reset-button button-secondary" id="reset_editor_addres_cdn"><?php echo __('Use CDN', $this->text_domain) ?></button>'
			).insertAfter(editor_address);

			$(
				'<br />'
			+ '<button class="button reset-button button-secondary" id="reset_customize_mindmap_local"><?php echo __('Use local', $this->text_domain) ?></button>'
			+ '<button class="button reset-button button-secondary" id="reset_customize_mindmap_cdn"><?php  echo __('Use CDN', $this->text_domain) ?></button>' 
			).insertAfter(customize_mindmap);

			// 本地和CDN基础路径
			var siteUrl = "<?php echo get_site_url(); ?>" + "/wp-content/plugins/wp-editormd";
			var cdnUrl = "https://cdn.jsdelivr.net/wp/wp-editormd/tags/" + "<?php echo WP_EDITORMD_VER; ?>";

			// 按钮点击事件
			$("#reset_editor_addres_local").click(function(event) {
				event.preventDefault();
				editor_address.val(siteUrl);
			})

			$("#reset_editor_addres_cdn").click(function(event) {
				event.preventDefault();
				editor_address.val(cdnUrl);
			});

			$("#reset_customize_mindmap_local").click(function(event) {
				event.preventDefault();
				customize_mindmap.val(siteUrl + "/assets/MindMap/mindMap.min.js");
			})

			$("#reset_customize_mindmap_cdn").click(function(event) {
				event.preventDefault();
				customize_mindmap.val(cdnUrl + "/assets/MindMap/mindMap.min.js");
			})
		}
		///	---------------------
		/// 重置资源
		///	---------------------


		///	---------------------
		/// 样式选择预览
		///	---------------------
		var imageResourceBaseURL = "https://cdn.jsdelivr.net/wp/wp-editormd/assets/image-resource";

		// 预加载预览资源
		// 异步即可，用户操作过程中预加载仍在继续
		previewPreload();
		// 在编辑器样式选择部分增加预览功能
		initEditorStylePreview(imageResourceBaseURL);
		// 在代码高亮样式选择部分增加预览功能
		initCodeHighlightStylePreview(imageResourceBaseURL);

		// 根据manifest.json预加载预览图片资源
		function previewPreload() {
			var fetchImage = (list) => {
				let batch = [];
				for (let each in list) {
						batch = batch.concat(list[each].map((item) => (
						new Promise(function (resolve, reject) {
							var img = new Image();
							img.onload = () => (resolve(img));
							img.error  = () => (reject("图片预加载失败"));
							img.src = `${imageResourceBaseURL}/${each}/${item}.png`;
						})
					)));
				}
				return batch;
			}

			$.ajax({
				url: `${imageResourceBaseURL}/manifest.json?t=${new Date().getTime()}`,
				dataType: "json",
				success: function(res) {
					var fetchImageBatch = fetchImage(res)
					Promise.all(fetchImageBatch)
						.then(() => { console.log("预览图片预加载成功"); })
						.catch((err) => { console.error("预览图片预加载失败", err); });
				}
			});
		}

		function initEditorStylePreview(imageResourceBaseURL) {
			// 预览窗体不允许点击右键
			$("#style-preview-container").on("contextmenu", (e) => {
				e.preventDefault();
			});

			// 绑定预览窗口样式修改事件
			$("#editor_style\\[theme_style\\]").change((e) => {
				var style = e.target.value;
				$("#style-preview-frame").attr("src", `${imageResourceBaseURL}/editor-preview/${style}.png`);
			});
			// 预览窗口样式初始化
			var themeStyle = $("#editor_style\\[theme_style\\]").val();
			$("#style-preview-frame").attr("src", `${imageResourceBaseURL}/editor-preview/${themeStyle}.png`);

			// 绑定编辑器样式修改事件
			$("#editor_style\\[code_style\\]").change((e) => {
				var style = e.target.value;
				$("#style-preview-editor").attr("src", `${imageResourceBaseURL}/editor-markdown/${style}.png`);
			});
			// 绑定编辑器样式初始化
			var codeStyle = $("#editor_style\\[code_style\\]").val();
			$("#style-preview-editor").attr("src", `${imageResourceBaseURL}/editor-markdown/${codeStyle}.png`);
		}

		function initCodeHighlightStylePreview(imageResourceBaseURL) {
			// 预览窗体不允许点击右键
			$("#code-highlight-preview-container").on("contextmenu", (e) => {
				e.preventDefault();
			});
			
			var row = $("#highlight-preview-container").parent().parent();

			// 代码高亮窗口样式修改事件
			$("#syntax_highlighting\\[highlight_library_style\\]").change((e) => {
				var style = e.target.value;
				if (style === "customize") {
					row.hide();
				} else {
					row.show();
					$("#highlight-preview-frame").attr("src", `${imageResourceBaseURL}/editor-highlight/${style}.png`);
				}
			});
			// 代码高亮窗口样式初始化
			var highlightStyle = $("#syntax_highlighting\\[highlight_library_style\\]").val();
			if (highlightStyle === "customize") {
				row.hide();
			} else {
				row.show();
				$("#highlight-preview-frame").attr("src", `${imageResourceBaseURL}/editor-highlight/${highlightStyle}.png`);
			}
		}
		///	---------------------
		/// 样式选择预览
		///	---------------------
	});
})(jQuery);
</script>