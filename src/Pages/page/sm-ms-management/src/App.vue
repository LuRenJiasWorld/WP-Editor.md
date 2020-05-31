<template>
  <div id="app">
    <h1>{{ $t("app_title") }}</h1>
    <Button type="primary">Primary</Button>
  </div>
</template>

<script lang="ts">
import { Component, Vue } from "vue-property-decorator";
import HelloWorld from "./components/HelloWorld.vue";

@Component({
  components: {
    HelloWorld
  },
  mounted() {
    this.$i18n.locale = "zh_CN";
    document.getElementById("loading")!.style.display = "none";
  }
})
export default class App extends Vue {}
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
