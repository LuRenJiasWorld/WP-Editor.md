// Third-party packages
const path = require("path");
const webpack = require("webpack");
const ParallelUglifyPlugin = require("webpack-parallel-uglify-plugin");
const MergeIntoSingleFilePlugin = require("webpack-merge-and-include-globally");
const MiniCssExtractPlugin = require("mini-css-extract-plugin");
const RemoveEmptyScriptsPlugin = require("webpack-remove-empty-scripts");
const BundleAnalyzerPlugin = require("webpack-bundle-analyzer")
  .BundleAnalyzerPlugin;
const ESLintPlugin = require("eslint-webpack-plugin");

// Configuration file
const Conf = require("./webpack.conf");
const banner = Conf.banner;

// Build mode
const mode = process.env.NODE_ENV;
const isDevMode = mode === "development";

// Show analyze
const analyze = process.env.ANALYZE;

module.exports = {
  mode: mode,
  stats: {
    all: false,
    assets: true,
    relatedAssets: true,
    cached: true,
    warnings: true,
    errors: true,
    errorDetails: true,
    moduleTrace: true,
    hash: true,
    performance: true,
    assetsSort: "name",
  },
  performance: {
    maxAssetSize: isDevMode ? 1024 * 1024 : 1024 * 512,
    maxEntrypointSize: isDevMode ? 1024 * 1024 : 1024 * 512,
  },
  entry: {
    "assets/Editormd/editormd": "./assets/Editormd/src/editormd.js",
    "assets/Editormd/editormd.min.css": "./assets/Editormd/scss/editormd.scss",
    "assets/Editormd/editormd.preview.min.css": "./assets/Editormd/scss/editormd.preview.scss",
    "assets/Config/editormd": "./assets/Config/editormd.js",
    "assets/FrontStyle/FrontStyle": "./assets/FrontStyle/FrontStyle.js",
    "assets/FrontStyle/FrontStyle.min.css": "./assets/FrontStyle/FrontStyle.scss",
  },
  output: {
    filename: "[name].min.js",
    path: path.resolve(__dirname),
  },
  devtool: false,
  optimization: {
    minimizer: [
      new ParallelUglifyPlugin({
        cacheDir: ".cache/",
        sourceMap: isDevMode ? true : false,
        uglifyJS: {
          output: {
            comments: false,
            beautify: false,
            preamble: banner,
          },
          compress: {
            drop_console: isDevMode ? false : true,
            collapse_vars: isDevMode ? false : true,
            reduce_vars: isDevMode ? false : true,
          },
        },
      }),
    ],
  },
  plugins: [
    analyze ? new BundleAnalyzerPlugin({
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
    }) : null,
    new RemoveEmptyScriptsPlugin({}),
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
    new ESLintPlugin({
      extensions: ["js", "jsx"],
      exclude: [
        path.resolve(__dirname, "node_modules"),
      ],
    })
  ].filter(Boolean),
  module: {
    rules: [
      {
        test: /\.js$/,
        include: [path.resolve(__dirname, "assets")],
        use: [
          {
            loader: "thread-loader",
            options: {
              workers: 2,
              workerParallelJobs: 50,
              workerNodeArgs: ["--max-old-space-size=1024"],
              name: "js-builders",
            },
          },
        ],
      },
      {
        test: /\.scss$/,
        include: [
          path.resolve(__dirname, "assets/Editormd/scss"),
          path.resolve(__dirname, "assets/FrontStyle"),
        ],
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
              postcssOptions: {
                plugins: [require("autoprefixer")({})],
              }
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
        test: /\.css$/,
        include: [
          path.resolve(__dirname, "assets/Config"),
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
              postcssOptions: {
                plugins: [require("autoprefixer")({})],
              },
            },
          },
        ],
      },
    ],
  },
};
