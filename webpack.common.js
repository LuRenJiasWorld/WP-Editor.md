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
	*/`
}

module.exports = Common;