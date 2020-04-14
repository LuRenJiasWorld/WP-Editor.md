const path = require("path");

module.exports = {
  mode: "production",
  entry: "./assets/Config/editormd.js",
  output: {
    filename: "./assets/Config/editormd.min.js",
    path: path.resolve(__dirname),
  },
  module: {
    rules: [
      {
        test: /\.(css|scss|sass)$/,
        include: [path.resolve(__dirname, "assets/Config")],
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
