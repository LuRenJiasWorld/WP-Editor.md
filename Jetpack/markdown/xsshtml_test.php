<?php
require('xsshtml.class.php');
$html = '<!--more-->';
$xss = new XssHtml($html);
$html = $xss->getHtml();
echo $html;
?>