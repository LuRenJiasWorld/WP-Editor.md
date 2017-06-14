<?php
require('xsshtml.class.php');
$html = '<p class="editormd-tex"> c = \pm\sqrt{a^2 + b^2}</p>';
$xss = new XssHtml($html);
$html = $xss->getHtml();
echo $html;
?>