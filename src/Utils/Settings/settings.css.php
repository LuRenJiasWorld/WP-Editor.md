<style type="text/css" rel="stylesheet">
	#style-preview-container, #highlight-preview-container {
		display: block;
		position: relative;
	}

	#style-preview-frame {
		max-width: 100%;
		border: 1px solid #a5a5a5;
	}

	#highlight-preview-frame {
		max-width: 100%;
		width: 550px;
	}

	#style-preview-editor {
		z-index: 1;
		position: absolute;
		width: 50%;
		left: 1px;
		top: 6.3%;
	}

	/*设置选项样式*/
	.debugger-wrap {
		margin-top: 10px;
		display: none;
	}

	.debugger-wrap tbody tr {
		width: 100%;
		text-align: left;
	}

	.debugger-wrap tbody tr th {
		padding: 5px 10px 5px 0;
	}

	.debugger-wrap tbody tr th:nth-child(2) {
		color: #006686;
		width: 75%;
	}

	.CodeMirror {
		width: 560px;
	}

	span.error {
		color: #dc3232;
		font-weight: 600;
		margin-right: 10px;
	}

	span.updated {
		color: #46b450;
		font-weight: 600;
	}

	/* 用于将捐赠信息和设置面板横向并排 */
	.form-and-donate #donate a {
		display: block;
	}

	.form-and-donate #donate a:focus {
		/* 去除WordPress自带的边框 */
		box-shadow: none;
	}

	.form-and-donate #donate img {
		border-radius: 10px;
		background: white;
		padding: 4px;
		box-shadow: 0 2px 5px hsla(0, 0%, 0%, 0.18);
	}

	@media (min-width: 1366px) {
		.form-and-donate {
			display: flex;
			flex-direction: row;
		}

		.form-and-donate .metabox-holder {
			flex: 1;
		}

		.form-and-donate #donate {
			width: 300px;
			padding: 10px 30px;
			position: relative;
		}

		.form-and-donate #donate::before {
			content: "";
			position: absolute;
			background-color: #cccccc;
			width: 1px;
			height: calc(100% - 20px);
			margin-left: -20px;
			box-shadow: 1px 0 #ffffff;
		}

		#style-preview-frame, #highlight-preview-frame {
			max-width: 70%;
		}

		#style-preview-editor {
			width: 35%;
		}
	}

	.reset-button {
		margin: 6px 4px 0 1px !important;
	}

	@media (max-width: 1366px) {
		.form-and-donate #donate {
			max-width: 700px;
		}
	}

	/* Modal悬浮窗处于最高层级 */
	.blocker {
		z-index: 1000000;
	}

	/* Modal悬浮窗样式 */
	.modal {
		max-width: none;
		width: auto;
		max-height: none;
		height: auto;
	}

	#wp-editormd-modal {
		padding: 0;
		width: calc(100% - 180px);
		height: calc(100% - 100px);
		max-width: 1200px;
		max-height: 760px;
		min-width: 460px;
		min-height: 300px;
	}

	#wp-editormd-modal iframe {
		width: 100%;
		height: 100%;
		border-radius: 8px;
	}
</style>