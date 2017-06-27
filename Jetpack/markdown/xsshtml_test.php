<?php
require('xsshtml.class.php');
$html = '<blockquote>引用块</blockquote>';
$xss = new XssHtml($html);
$html = $xss->getHtml();
echo $html;
?>