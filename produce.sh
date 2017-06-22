#!/bin/bash

# 删除文件(夹)
rm -rf ./.idea/
rm -rf ./.DS_Store
rm -rf ./.git/
rm -rf ./.gitignore
rm -rf ./composer.json
rm -rf ./composer.phar
rm -rf ./README.md
rm -rf ./Document/
rm -rf ./Editor.md.html

#Editor.md
rm -rf ./Editor.md/css/editormd.css
rm -rf ./Editor.md/css/editormd.preview.css
rm -rf ./Editor.md/js/editormd.js

#Emojify.js
rm -rf ./Emojify.js/css/basic/emojify.css
rm -rf ./Emojify.js/js/emojify.js

#Jetpack
rm -rf ./Jetpack/latex/latex_wp.php

#jQuery
rm -rf ./jQuery/jquery.js

#KaTeX
rm -rf ./KaTeX/katex.css
rm -rf ./KaTeX/katex.js
rm -rf ./KaTeX/katex.html
rm -rf ./KaTeX/README.md

#Prism
cd ./Prism/ && find . -type f -not \( -name '*.min.js' -or -name '*.min.css' \) -delete && cd ../

#XSS
rm -rf ./XSS/xss.js
rm -rf ./XSS/xss_test.html
