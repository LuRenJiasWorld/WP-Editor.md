module.exports = {
  outputDir: "html",
  publicPath: process.env.NODE_ENV === "development" ? "/" : "../wp-content/plugins/wp-editormd/src/Pages/page/sm-ms-management/html/",
  configureWebpack:{
    optimization: {
      splitChunks: {
        minSize: 10000,
        maxSize: 200000,
      }
    }
  },
  pluginOptions: {
    i18n: {
      locale: "en",
      fallbackLocale: "en",
      localeDir: "locales",
      enableInSFC: true
    }
  }
};
