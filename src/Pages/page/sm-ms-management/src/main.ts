import Vue from "vue";
import App from "./App.vue";
import store from "./store";
import { Button, ButtonGroup, Divider, Input, Card, Tooltip } from "view-design";
import "view-design/dist/styles/iview.css";
import i18n from "./i18n";
import "./theme/view-ui-theme.less";
import VueLazyload from "vue-lazyload";

console.log(process.env);

if (process.env.VUE_APP_MOCK === "mock") {
  const Mock = require("./mock.js");
  Mock();
}

Vue.component("Button", Button);
Vue.component("ButtonGroup", ButtonGroup);
Vue.component("Divider", Divider);
Vue.component("Input", Input);
Vue.component("Card", Card);
Vue.component("Tooltip", Tooltip);

Vue.config.productionTip = false;

Vue.use(VueLazyload, {
  preLoad: 1.3,
  loading: process.env.NODE_ENV === "development"
    ? "/img/loading.svg"
    : "../wp-content/plugins/wp-editormd/src/Pages/page/sm-ms-management/html/img/loading.svg",
  attempt: 5
});


new Vue({
  store,
  i18n,
  render: h => h(App)
}).$mount("#app");
