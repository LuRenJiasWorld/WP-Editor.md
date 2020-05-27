import Vue from "vue";
import App from "./App.vue";
import store from "./store";
import { Button } from "view-design";
Vue.component("Button", Button);
import "view-design/dist/styles/iview.css";

Vue.config.productionTip = false;

new Vue({
  store,
  render: h => h(App)
}).$mount("#app");
