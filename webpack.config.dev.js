const path = require("path");
const webpack = require("webpack");
const UglifyJsPlugin = require("uglifyjs-webpack-plugin");

const date = new Date();
const version = require("./package.json").version;

const banner = `/*!
 * WP Editor.md v${version} \
| Author: @LuRenJiasWorld \
| Repository: https://github.com/LuRenJiasWorld/WP-Editor.md \
| Compiled on ${date.getFullYear()}-${(date.getMonth() + 1).toString().padStart(2, "0")}-${date.getDate().toString().padStart(2, "0")} \
| License: GNU General Public License v3.0
 * NOTICE: Code in assets/Editormd is originally developed by @pandao and forked to work with WP Editor.md by @LuRenJiasWorld. 
 *         Related MIT license is located in assets/Editormd/LICENSE, but now distributed with WP Editor.md using GPLv3.
 */`;

module.exports = {
  mode: "production",
  performance: {
    maxAssetSize: 1024 * 1024 * 4,
    maxEntrypointSize: 1024 * 1024 * 4,
  },
  entry: {
    "assets/Editormd/editormd": "./assets/Editormd/src/editormd.js",
    "assets/Config/editormd": "./assets/Config/editormd.js",
    "assets/FrontStyle/frontstyle": "./assets/FrontStyle/frontstyle.js",
  },
  output: {
    filename: "[name].min.js",
    path: path.resolve(__dirname),
  },
  devtool: false,
  optimization: {
    minimizer: [
      new UglifyJsPlugin({
        sourceMap: true,
        uglifyOptions: {
          output: {
            beautify: false,
            preamble: banner,
          },
        },
      }),
    ],
  },
  plugins: [
    new webpack.SourceMapDevToolPlugin({}),
    new webpack.BannerPlugin({
      banner: banner,
      raw: true,
    }),
  ],
  module: {
    rules: [
      {
        test: /\.js$/,
        use: {
          loader: "babel-loader",
        },
        exclude: "/node_modules/",
      },
      {
        test: /\.(css|scss|sass)$/,
        include: [
          path.resolve(__dirname, "assets/Config"),
          path.resolve(__dirname, "assets/FrontStyle"),
        ],
        use: [
          {
            loader: "style-loader",
          },
          {
            loader: "css-loader",
            options: {
              importLoaders: 1,
            },
          },
          {
            loader: "sass-loader",
            options: {
              implementation: require("dart-sass"),
            },
          },
          {
            loader: "postcss-loader",
            options: {
              plugins: [require("autoprefixer")({})],
            },
          },
        ],
      },
    ],
  },
};
