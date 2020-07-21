<template>
  <div id="app">
    <div v-if="authorize.authorized">
      <div id="header">
        <img class="head-logo" src="./assets/logo.png" />
        <p class="title">WP Editor.md</p>
        <Divider class="divider" type="vertical" />
        <p class="title">{{ $t("app_title") }}</p>
        <div class="spacing"></div>
        <div class="search-bar">
          <Input search v-bind:placeholder="$t('search_placeholder')" />
        </div>
      </div>
      <div id="container" v-viewer>
        <div v-bind:key="image.hash" v-for="image in image_list">
          <ImageCell
            v-bind:filename="image.filename"
            v-bind:width="image.width"
            v-bind:height="image.height"
            v-bind:size="image.size"
            v-bind:created_at="image.created_at"
            v-bind:url="image.url"
            v-bind:hash="image.hash"
          />
        </div>
      </div>
    </div>
    <div v-else>
      <div class="card full-width" v-show="!this.authorize.authorized">
        <p v-html="$t('err_token')"></p>
      </div>
    </div>
  </div>
</template>

<script lang="ts">
import { Component, Vue } from "vue-property-decorator";
import ImageCell from "./components/ImageCell.vue";
import Utils from "./utils/utils";
import axios from "axios";
import { ImageInfoType } from "./store/index.type";

const SM_MS_API = (api: string) => "https://sm.ms/api/v2/" + api;

const SM_MS_HEADER = (token: string) => ["Authorization: " + token];

enum LoaderStatus {
  On,
  Off
}

@Component({
  components: {
    "ImageCell": ImageCell
  },
  computed: {
    image_list: function(): ImageInfoType[] {
      return this.$store.state.image_list;
    }
  }
})
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
      "url": SM_MS_API("profile"),
      "method": "post",
      "header": SM_MS_HEADER(this.authorize.authorize_token),
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
          throw Error("not succeeded");
        }
      })
      .catch((error) => {
        console.log(error);
        result = false;
      });

    return result;
  }

  async getImageList(): Promise<boolean> {
    let result: boolean = false;

    await axios.post(this.endpoint_url, {
      "url": SM_MS_API("upload_history"),
      "method": "get",
      "header": SM_MS_HEADER(this.authorize.authorize_token),
      "body": {}
    })
      .then((response) => {
        let data = response.data;
        if (data["success"] === true) {
          let imageInfoBatch: ImageInfoType[] = data.data;
          this.$store.commit("addImages", imageInfoBatch);
          result = true;
        } else {
          throw Error("not succeeded");
        }
      }).catch((error) => {
        console.log(error);
        result = false;
      });

    return result;
  }

  toggleLoader(status: LoaderStatus) {
    const element = document.getElementById("loading")!;
    switch (status) {
      case LoaderStatus.On:
        element.style.display = "block";
        break;
      case LoaderStatus.Off:
        element.style.display = "none";
        break;
    }
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

    // 避免在热更新时出现数据重复问题
    this.$store.commit("clearImages");

    if (this.authorize.authorize_token !== "" && this.endpoint_url !== "") {
      Promise.all([this.getUserInfo(), this.getImageList()]).then((result) => {
        this.authorize.authorized = result[0] && result[1];
      }).catch((error) => {
        console.log(error);
      }).finally(() => {
        this.toggleLoader(LoaderStatus.Off);
      });
    }
  }
}
</script>

<style lang="scss">
#app {
  font-family: "PingFang SC", "Hiragino Sans GB", "Heiti SC", "Microsoft YaHei", "WenQuanYi Micro Hei", Avenir, Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  background-color: #eee;

  & .card.full-width {
    top: 0;
    bottom: 0;
    margin: auto;
    position: absolute;
    width: 100%;
    height: 104px;

    & p {
      text-align: center;
      font-size: 16px;
      padding: 40px 0;
    }
  }

  & #header {
    height: 64px;
    padding: 8px 32px;
    display: flex;
    flex-direction: row;
    box-shadow: 0 1px 2px 0 hsla(0, 0%, 0%, 0.2);
    background-color: #fff;

    & .head-logo {
      width: 32px;
      height: 32px;
      margin: 8px 10px 8px 2px;
    }

    & .divider {
      height: 32px;
      margin: 8px 10px;
    }

    & .title {
      color: #4d4d4d;
      text-align: left;
      line-height: 48px;
      font-size: 20px;
    }

    & .spacing {
      flex: 1;
      height: 48px;
    }

    & .search-bar {
      width: 240px;
      padding: 8px;
    }
  }

  & #container {
    margin-top: 20px;
    padding: 36px 32px;
    overflow: hidden;
    background-color: #fff;
    display: grid;
    grid-template-columns: repeat(auto-fill, 240px);
    grid-gap: 10px;
    justify-content: space-between;
  }
}
</style>
