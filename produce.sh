#!/bin/bash
# 删除文件(夹) - 删除其他库开发无关文件

# assets/Config/
rm -rf assets/Config/editormd.css
rm -rf assets/Config/editormd.js

# assets/Editormd/
rm -rf assets/Editormd/docs/
rm -rf assets/Editormd/examples/
rm -rf assets/Editormd/node_modules/
rm -rf assets/Editormd/scss/
rm -rf assets/Editormd/src/
rm -rf assets/Editormd/tests/
rm -rf assets/Editormd/.idea
rm -rf assets/Editormd/.git
rm -rf assets/Editormd/.bowerrc
rm -rf assets/Editormd/.editorconfig
rm -rf assets/Editormd/.eslintrc
rm -rf assets/Editormd/.gitignore
rm -rf assets/Editormd/bower.json
rm -rf assets/Editormd/CHANGE.md
rm -rf assets/Editormd/editormd.amd.js
rm -rf assets/Editormd/editormd.amd.js
rm -rf assets/Editormd/editormd.amd.min.js
rm -rf assets/Editormd/editormd.css
rm -rf assets/Editormd/editormd.js
rm -rf assets/Editormd/editormd.logo.css
rm -rf assets/Editormd/editormd.logo.min.css
rm -rf assets/Editormd/editormd.preview.css
rm -rf assets/Editormd/editormd.preview.min.css
rm -rf assets/Editormd/Gulpfile.js
rm -rf assets/Editormd/LICENSE
rm -rf assets/Editormd/package.json
rm -rf assets/Editormd/package-lock.json
rm -rf assets/Editormd/README.md

# languages/
rm -rf languages/*.po

# src/App
rm -rf src/App/PrismJSAuto.old.php

# vendor/
rm -rf vendor/bin/

# vendor/composer
rm -rf vendor/composer/installed.json
rm -rf vendor/composer/LICENSE

# vendor/michelf
rm -rf vendor/michelf/php-markdown/.gitignore
rm -rf vendor/michelf/php-markdown/composer.json
rm -rf vendor/michelf/php-markdown/.gitignore
rm -rf vendor/michelf/php-markdown/License.md
rm -rf vendor/michelf/php-markdown/Readme.md
rm -rf vendor/michelf/php-markdown/Readme.php
rm -rf vendor/michelf/php-markdown/Michelf/Markdown.inc.php
rm -rf vendor/michelf/php-markdown/Michelf/MarkdownExtra.inc.php
rm -rf vendor/michelf/php-markdown/Michelf/MarkdownInterface.inc.php

# vendor/jaxsonwang
rm -rf vendor/jaxsonwang/wp-settings-api-class/.git/
rm -rf vendor/jaxsonwang/wp-settings-api-class/.gitignore
rm -rf vendor/jaxsonwang/wp-settings-api-class/composer.json
rm -rf vendor/jaxsonwang/wp-settings-api-class/README.md

# /
rm -rf .git/
rm -rf .idea/
rm -rf .bowerrc
rm -rf .gitignore
rm -rf bower.json
rm -rf composer.json
rm -rf composer.lock
rm -rf README.md
rm -rf CHANGELOG.md
rm -rf produce.sh