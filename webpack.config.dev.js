const path = require("path");
const webpack = require("webpack");
const UglifyJsPlugin = require("uglifyjs-webpack-plugin");
const MergeIntoSingleFilePlugin = require("webpack-merge-and-include-globally");
const Common = require("./webpack.common");

const banner = Common.banner;

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
    new webpack.SourceMapDevToolPlugin({
      filename: "[name].min.js.map"
    }),
    new webpack.BannerPlugin({
      banner: banner,
      raw: true,
    }),
    new MergeIntoSingleFilePlugin({
      files: [{
        src: Common.Editormd.CodeMirror.modes,
        dest: function(code) {
          const min = require("uglify-js").minify(code, {
            sourceMap: {
              filename: 'assets/Editormd/lib/modes.min.js',
              url: 'assets/Editormd/lib/modes.min.js.map'
            }
          });
          return {
            'assets/Editormd/lib/modes.min.js': min.code,
            'assets/Editormd/lib/modes.min.js.map': min.map
          }
        }
      }, {
        src: Common.Editormd.CodeMirror.addons,
        dest: function(code) {
          const min = require("uglify-js").minify(code, {
            sourceMap: {
              filename: "assets/Editormd/lib/addons.min.js",
              url: "assets/Editormd/lib/modes.min.js.map"
            }
          });
          return {
            'assets/Editormd/lib/addons.min.js': min.code,
            'assets/Editormd/lib/addons.min.js.map': min.map
          }
        }
      }]
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
