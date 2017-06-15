<?php
require('xsshtml.class.php');
$html = '<!--more--><html code><a href="http://baidu.com">1</a>';
$xss = new XssHtml($html);
$html = $xss->getHtml();
echo $html;
?>