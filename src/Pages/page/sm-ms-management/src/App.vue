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

interface Data {
  authorize: {
    authorize_token: String,
    authorized: Boolean
  }
}

@Component
export default class App extends Vue {
  authorize = {
    authorize_token: "",
    authorized: false
  };

  mounted() {
    this.$i18n.locale = Utils.getCookie("wp-editormd-lang") ? Utils.getCookie("wp-editormd-lang") : Utils.getBrowserLang();

    this.authorize.authorize_token = Utils.getGet("token") as string;
    if (this.authorize.authorize_token !== "") {
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
