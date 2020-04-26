const path = require("path");
const webpack = require("webpack");
const UglifyJsPlugin = require("uglifyjs-webpack-plugin");
const MergeIntoSingleFilePlugin = require("webpack-merge-and-include-globally");
const MiniCssExtractPlugin = require("mini-css-extract-plugin");
const FixStyleOnlyEntriesPlugin = require("webpack-fix-style-only-entries");
const HappyPack = require("happypack");

// HappyPack Configurations
const happyThreadPool = HappyPack.ThreadPool({ size: 8 });
const createHappyPlugin = (id, loaders) =>
  new HappyPack({
    id: id,
    loaders: loaders,
    threadPool: happyThreadPool,
    verbose: process.env.HAPPY_VERBOSE === "1", // make happy more verbose with HAPPY_VERBOSE=1
  });

const banner = Conf.banner;

const mode = process.env.NODE_ENV;
const isDevMode = mode === "development";

module.exports = {
  mode: "",
  performance: {
    maxAssetSize: isDevMode ? 1024 * 1024 * 4 : 1024 * 512,
    maxEntrypointSize: isDevMode ? 1024 * 1024 * 4 : 1024 * 512,
  },
  entry: {
    "assets/Editormd/editormd": "./assets/Editormd/src/editormd.js",
    "assets/Editormd/editormd.min.css": "./assets/Editormd/scss/editormd.scss",
    "assets/Editormd/editormd.preview.min.css": "./assets/Editormd/scss/editormd.preview.scss",
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
        sourceMap: isDevMode ? true : false,
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
    new BundleAnalyzerPlugin({
      analyzerMode: "server",
      analyzerHost: "127.0.0.1",
      analyzerPort: 8889,
      reportFilename: "report.html",
      defaultSizes: "parsed",
      openAnalyzer: true,
      generateStatsFile: false,
      statsFilename: "stats.json",
      statsOptions: null,
      logLevel: "info",
    }),
    new MiniCssExtractPlugin({
      filename: "[name]",
    }),
    isDevMode
      ? new webpack.SourceMapDevToolPlugin({
          filename: "[name].min.js.map",
          exclude: /\.css$/,
        })
      : null,
    isDevMode
      ? new webpack.SourceMapDevToolPlugin({
          filename: "[name].map",
          include: /\.css$/,
        })
      : null,
    new webpack.BannerPlugin({
      banner: banner,
      raw: true,
    }),
    new MergeIntoSingleFilePlugin({
      files: [
        {
          src: Conf.Editormd.CodeMirror.modes,
          dest: function (code) {
            if (isDevMode) {
              const min = require("uglify-js").minify(code, {
                sourceMap: {
                  includeSources: false,
                  filename: "assets/Editormd/lib/modes.min.js",
                  url: "modes.min.js.map",
                },
              });
              return {
                "assets/Editormd/lib/modes.min.js": banner + code,
                "assets/Editormd/lib/modes.min.js.map": min.map,
              };
            } else {
              const min = require("uglify-js").minify(code);
              return {
                "assets/Editormd/lib/modes.min.js": banner + min.code,
              };
            }
          },
        },
        {
          src: Conf.Editormd.CodeMirror.addons,
          dest: function (code) {
            if (isDevMode) {
              const min = require("uglify-js").minify(code, {
                sourceMap: {
                  includeSources: false,
                  filename: "assets/Editormd/lib/addons.min.js",
                  url: "addons.min.js.map",
                },
              });
              return {
                "assets/Editormd/lib/addons.min.js": banner + code,
                "assets/Editormd/lib/addons.min.js.map": min.map,
              };
            } else {
              const min = require("uglify-js").minify(code);
              return {
                "assets/Editormd/lib/addons.min.js": banner + min.code,
              };
            }
          },
        },
      ],
    }),
  ].filter(Boolean),
  module: {
    rules: [
      {
        test: /\.js$/,
        use: {
          loader: "happypack/loader?id=happy-babel",
        },
        exclude: "/node_modules/",
      },
      {
        test: /\.scss$/,
        include: [path.resolve(__dirname, "assets/Editormd/scss")],
        use: [
          {
            loader: MiniCssExtractPlugin.loader,
          },
          {
            loader: "css-loader",
            options: { url: false },
          },
          {
            loader: "postcss-loader",
            options: {
              plugins: [require("autoprefixer")({})],
            },
          },
          {
            loader: "sass-loader",
            options: {
              implementation: require("node-sass"),
            },
          },
        ],
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
            loader: "postcss-loader",
            options: {
              plugins: [require("autoprefixer")({})],
            },
          },
          {
            loader: "sass-loader",
            options: {
              implementation: require("node-sass"),
            },
          },
        ],
      },
    ],
  },
};
