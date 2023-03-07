const { merge } = require('webpack-merge');
const common = require("./webpack.common");

process.env.NODE_ENV = "production";

module.exports = merge(common, {
	mode: "production"
});
