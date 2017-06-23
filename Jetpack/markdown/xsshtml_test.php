<?php
require('xsshtml.class.php');
$html = '<code>dom<=$test</code>';
$xss = new XssHtml($html);
$html = $xss->getHtml();
echo $html;
?>