#!/bin/bash
# 删除文件(夹)
rm -rf .idea/
rm -rf .DS_Store
rm -rf .git/
rm -rf .gitignore
rm -rf composer.json
rm -rf composer.phar
rm -rf README.md
rm -rf PasteTest/
rm -rf To-Markdown/
rm -rf *.jpg
#Document
rm -rf Document/*.md
#Editor.md
rm -rf Editor.md/css/editormd.css
rm -rf Editor.md/js/editormd.js
rm -rf Editor.md/lib/jquery.flowchart.js
rm -rf Editor.md/lib/marked.js
#Jetpack
rm -rf Jetpack/flowchart/flowchart_test.php
rm -rf Jetpack/latex/latex_test.php
rm -rf Jetpack/lib/markdown/README.md
rm -rf Jetpack/lib/markdown/test.php
rm -rf Jetpack/markdown/xsshtml_test.php
rm -rf Jetpack/sequence/sequence_test.php
rm -rf Jetpack/taskList/taskList_test.php
#jQuery
rm -rf jQuery/jquery.js
#FlowChart
rm -rf FlowChart/flow.html
rm -rf FlowChart/flowchart.reg.test.html
rm -rf FlowChart/jquery.flow.html
rm -rf FlowChart/jquery.flowchart.js
#KaTeX
rm -rf KaTeX/katex.html
rm -rf KaTeX/README.md
#Prism
cd Prism/ && find . -type f -not \( -name '*.min.js' -or -name '*.min.css' \) -delete && cd ../
rm -rf Prism/package.json
#Sequence
rm -rf Sequence/sequence.html
rm -rf Sequence/sequence_reg_test.html
#Admin
rm -rf Admin/skelet/assets/css/_meow.css
rm -rf Admin/skelet/assets/js/_meow.js
#Languages
rm -rf Languages/*.po