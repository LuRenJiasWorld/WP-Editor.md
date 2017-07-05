<?php
require('xsshtml.class.php');
$html = '\\alpha = \\sqrt{1-e^2}';
$xss = new XssHtml($html);
$html = $xss->getHtml();
echo $html;
?>