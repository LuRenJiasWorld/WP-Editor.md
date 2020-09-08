<?php
// 版本发行注记页面
// 包含页面重渲染功能
function display_page($text_domain, $config) {
  $targetVersion = $_GET["version"];
  $language = $_COOKIE["wp-editormd-lang"] ? $_COOKIE["wp-editormd-lang"] : "en-US";

  $editor_style_base_address = $config::get_option("editor_addres", "editor_style");
  $title = sprintf(__("Successfully upgrade to version", $text_domain), $targetVersion);
  $text = htmlspecialchars(file_get_contents(__DIR__ . "/release-note/$targetVersion/$language.md"));

  // 对用户输入的内容&获取到的文本进行检查，避免安全问题
  if (
      !preg_match("/^[0-9]{1,3}\.[0-9]{1,2}\.[0-9]{1,2}$/", $targetVersion)
   || !preg_match("/^[a-z]{2}-[A-Z]{2}$/", $language)
   || !$text
  ) {
    return null;
  }

  return <<<EOT
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <title>$title</title>
    <link rel="stylesheet" href="$editor_style_base_address/assets/Editormd/editormd.min.css" />
    <link rel="stylesheet" href="$editor_style_base_address/assets/Config/editormd.css" />
    <script src="$editor_style_base_address/assets/Marked/marked.min.js"></script>
    <style>
      html, body {
        margin: 0;
        width: 100%;
        height: 100%;
      }
      code {
        background-color: #e5e5e5 !important;
        margin: 0 4px !important;
        border-radius: 4px !important;
      }
      #upgrade-release {
        width: 100%;
        box-sizing: border-box;
        padding: 40px 36px;
      }
      #upgrade-release-raw-text {
        display: none;
      }
    </style>
  </head>
  <body>
    <div id="upgrade-release" class="markdown-body"></div>
    <div id="upgrade-release-raw-text">
$text
    </div>
  </body>
  <script>
    function decodeHtml(html) {
      var txt = document.createElement("textarea");
      txt.innerHTML = html;
      return txt.value;
    }
    const upgradeRelease = document.getElementById("upgrade-release");
    const upgradeReleaseRawText = document.getElementById("upgrade-release-raw-text");
    upgradeRelease.innerHTML = marked(decodeHtml(upgradeReleaseRawText.innerHTML));
  </script>
</html>
EOT;
}