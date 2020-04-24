const date = new Date();
const version = require("./package.json").version;

const Common = {
	"banner": `/*!
	* WP Editor.md v${version} \
   | Author: @LuRenJiasWorld \
   | Repository: https://github.com/LuRenJiasWorld/WP-Editor.md \
   | Compiled on ${date.getFullYear()}-${(date.getMonth() + 1).toString().padStart(2, "0")}-${date.getDate().toString().padStart(2, "0")} \
   | License: GNU General Public License v3.0
	* NOTICE: Code in assets/Editormd is originally developed by @pandao and forked to work with WP Editor.md by @LuRenJiasWorld. 
	*         Related MIT license is located in assets/Editormd/LICENSE, but now distributed with WP Editor.md using GPLv3.
	*/`,

	Editormd: {
		CodeMirror: {
			modes: [
				"assets/CodeMirror/mode/meta.js",
				"assets/CodeMirror/mode/css/css.js",
				"assets/CodeMirror/mode/sass/sass.js",
				"assets/CodeMirror/mode/shell/shell.js",
				"assets/CodeMirror/mode/sql/sql.js",
				"assets/CodeMirror/mode/clike/clike.js",
				"assets/CodeMirror/mode/php/php.js",
				"assets/CodeMirror/mode/xml/xml.js",
				"assets/CodeMirror/mode/markdown/markdown.js",
				"assets/CodeMirror/mode/javascript/javascript.js",
				"assets/CodeMirror/mode/htmlmixed/htmlmixed.js",
				"assets/CodeMirror/mode/gfm/gfm.js",
				"assets/CodeMirror/mode/http/http.js",
				"assets/CodeMirror/mode/go/go.js",
				"assets/CodeMirror/mode/dart/dart.js",
				"assets/CodeMirror/mode/coffeescript/coffeescript.js",
				"assets/CodeMirror/mode/nginx/nginx.js",
				"assets/CodeMirror/mode/python/python.js",
				"assets/CodeMirror/mode/perl/perl.js",
				"assets/CodeMirror/mode/lua/lua.js",
				"assets/CodeMirror/mode/r/r.js",
				"assets/CodeMirror/mode/ruby/r.js",
				"assets/CodeMirror/mode/rst/rst.js",
				"assets/CodeMirror/mode/smartymixed/smartmixed.js",
				"assets/CodeMirror/mode/vb/vb.js",
				"assets/CodeMirror/mode/vbscript/vbscript.js",
				"assets/CodeMirror/mode/velocity/velocity.js",
				"assets/CodeMirror/mode/xquery/xquery.js",
				"assets/CodeMirror/mode/yaml/yaml.js",
				"assets/CodeMirror/mode/erlang/erlang.js",
				"assets/CodeMirror/mode/jade/jade.js",
			],
			addons: [
				"assets/CodeMirror/addon/edit/trailingspace.js",
				"assets/CodeMirror/addon/dialog/dialog.js",
				"assets/CodeMirror/addon/search/searchcursor.js",
				"assets/CodeMirror/addon/search/search.js",
				"assets/CodeMirror/addon/scroll/annotatescrollbar.js",
				"assets/CodeMirror/addon/search/matchesonscrollbar.js",
				"assets/CodeMirror/addon/display/placeholder.js",
				"assets/CodeMirror/addon/edit/closetag.js",
				"assets/CodeMirror/addon/fold/foldcode.js",
				"assets/CodeMirror/addon/fold/foldgutter.js",
				"assets/CodeMirror/addon/fold/indent-fold.js",
				"assets/CodeMirror/addon/fold/brace-fold.js",
				"assets/CodeMirror/addon/fold/xml-fold.js",
				"assets/CodeMirror/addon/fold/markdown-fold.js",
				"assets/CodeMirror/addon/fold/comment-fold.js",
				"assets/CodeMirror/addon/mode/overlay.js",
				"assets/CodeMirror/addon/selection/active-line.js",
				"assets/CodeMirror/addon/edit/closebrackets.js",
				"assets/CodeMirror/addon/display/fullscreen.js",
				"assets/CodeMirror/addon/search/match-highlighte.js"
			]
		}
	}
}

module.exports = Common;