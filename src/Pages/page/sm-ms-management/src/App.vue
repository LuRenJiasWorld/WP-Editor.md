<template>
  <div id="app">
    <div v-if="authorize.authorized">
      <h1>{{ $t("app_title") }}</h1>
      <Button type="primary">Primary</Button>
    </div>
    <div v-else>
      <div class="card full-width">
        <p style="text-align: center;" v-html="$t('err_token')"></p>
      </div>
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

  user = {
    userName: "",
    email: "",
    disk_usage_byte: 0,
    disk_limit_byte: 0
  }

  endpoint_url = "";

  async getUserInfo(): Promise<boolean> {
    let result: boolean = false;

    await axios.post(this.endpoint_url, {
      "url": "https://sm.ms/api/v2/profile",
      "method": "post",
      "header": [
        "Authorization: " + this.authorize.authorize_token
      ],
      "body": {}
    })
      .then((response) => {
        let data = response.data;
        if (data["success"] === true) {
          this.user.userName        = data["data"]["username"]        as string;
          this.user.email           = data["data"]["email"]           as string;
          this.user.disk_usage_byte = data["data"]["disk_usage_raw"]  as number;
          this.user.disk_limit_byte = data["data"]["disk_limit_raw"]  as number;
          result = true;
        } else {
          result = false;
        }
      })
      .catch((error) => {
        console.log(error);
        result = false;
      });

    return result;
  }

  mounted() {
    this.$i18n.locale = Utils.getCookie("wp-editormd-lang") ? Utils.getCookie("wp-editormd-lang") : Utils.getBrowserLang();

    if (process.env.VUE_APP_MOCK === "mock") {
      this.authorize.authorize_token = "00000000000000000000000000000000";
      this.endpoint_url = "test_endpoint";
    } else {
      this.authorize.authorize_token = Utils.getGet("token") as string;
      this.endpoint_url = Utils.getGet("endpoint_url") as string;
    }

    if (this.authorize.authorize_token !== "" && this.endpoint_url !== "") {
      this.getUserInfo()
        .then((result) => {
          this.authorize.authorized = result;
          document.getElementById("loading")!.style.display = "none";
        })
        .catch();
    }
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
