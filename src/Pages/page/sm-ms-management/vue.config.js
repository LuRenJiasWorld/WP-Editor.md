const path = require("path");

module.exports = {
  outputDir: "html",
  publicPath: process.env.NODE_ENV === "development" ? "/" : "../wp-content/plugins/wp-editormd/src/Pages/page/sm-ms-management/html/",
  configureWebpack:{
    optimization: {
      splitChunks: {
        minSize: 204800,
        maxSize: 409600,
      }
    },
    performance: {
      maxAssetSize:      process.env.NODE_ENV === "development" ? 1024 * 4096 : 1024 * 2048,
      maxEntrypointSize: process.env.NODE_ENV === "development" ? 1024 * 4096 : 1024 * 2048,
    },
    resolve: {
      extensions: ['.ts', '.js', '.vue', '.json'],
      alias: {
        'src': path.resolve(__dirname, 'src'),
      },
    }
  },
  css: {
    loaderOptions: {
      less: {
        javascriptEnabled: true
      }
    }
  },
  pluginOptions: {
    i18n: {
      locale: "en",
      fallbackLocale: "en",
      localeDir: "locales",
      enableInSFC: true
    },
  },
};
