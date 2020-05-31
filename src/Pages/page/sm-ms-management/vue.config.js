module.exports = {
  outputDir: "html",
  publicPath: process.env.NODE_ENV === "development" ? "/" : "../wp-content/plugins/wp-editormd/src/Pages/page/sm-ms-management/html/",

  pluginOptions: {
    i18n: {
      locale: "en",
      fallbackLocale: "en",
      localeDir: "locales",
      enableInSFC: true
    }
  }
};
