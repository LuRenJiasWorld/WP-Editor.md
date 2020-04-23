const path = require("path");

module.exports = {
  mode: "production",
  performance: {
    maxAssetSize: 1024 * 1024 * 0.5,
    maxEntrypointSize: 1024 * 1024 * 0.5,
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
  module: {
    rules: [
      {
        test: /\.js$/,
            use: {
                loader: 'babel-loader'
            },
            exclude: '/node_modules/'
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
