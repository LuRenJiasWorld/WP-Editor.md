<template>
  <div id="app">
    <div v-if="authorize.authorized">
      <h1>{{ $t("app_title") }}</h1>
      <Button type="primary">Primary</Button>
    </div>
    <div v-else>
      <h1>未填写Token或Token有误</h1>
    </div>
  </div>
</template>

<script lang="ts">
import { Component, Vue } from "vue-property-decorator";
import Utils from "./utils/utils";
import axios from "axios";

@Component
export default class App extends Vue {
  authorize = {
    authorize_token: "",
    authorized: false
  };

  endpoint_url = "";

  getUserInfo(): Boolean {
    let result: Boolean = false;

    axios.post(this.endpoint_url, {
      "url": "https://sm.ms/api/v2/profile",
      "method": "post",
      "header": [
        "Authorization: 8pA2q9qnaYsS9CKFifChJxQHwqRu3Y1l"
      ],
      "body": {}
    })
      .then(function(response) {
        console.log(response.data);
        result = true;
      })
      .catch(function(error) {
        console.log(error);
      });

    return result;
  }

  mounted() {
    this.$i18n.locale = Utils.getCookie("wp-editormd-lang") ? Utils.getCookie("wp-editormd-lang") : Utils.getBrowserLang();

    this.authorize.authorize_token = Utils.getGet("token") as string;
    this.endpoint_url = Utils.getGet("endpoint_url") as string;
    if (this.authorize.authorize_token !== "" && this.endpoint_url !== "" && this.getUserInfo()) {
      this.authorize.authorized = true;
    }

    document.getElementById("loading")!.style.display = "none";
  }
}
</script>

<style lang="scss">
#app {
  font-family: Avenir, Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
  margin-top: 60px;
}
</style>
