import Vue from "vue";
import App from "./App.vue";
import store from "./store";
import { Button } from "view-design";
import "view-design/dist/styles/iview.css";
import i18n from "./i18n";

console.log(process.env);

if (process.env.VUE_APP_MOCK === "mock") {
  const Mock = require("./mock.js");
  Mock();
}

Vue.component("Button", Button);

Vue.config.productionTip = false;

new Vue({
  store,
  i18n,
  render: h => h(App)
}).$mount("#app");
