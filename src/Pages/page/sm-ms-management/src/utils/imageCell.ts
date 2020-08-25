import { SM_MS_API, SM_MS_HEADER } from "src/utils/constant";
import axios from "axios";
import App from "src/App.vue";
import AppInterface from "src/App.type";

export function deleteImage( context: AppInterface, hash: string) {
  let _this: AppInterface = context;

  // 提示文本
  _this.$Modal.confirm({
    title: `${_this.$tc("confirm_deletion_title")}`,
    content: `<p>${_this.$tc("confirm_deletion_content")}</p>`,
    onOk: () => {
      // 同步删除操作到服务器
      axios.post(_this.endpoint_url, {
        "url": SM_MS_API("delete") + `/${hash}`,
        "method": "get",
        "header": SM_MS_HEADER(_this.authorize.authorize_token),
        "body": {}
      }).then((response) => {
        let data = response.data;
        if (data["success"] === true) {
          _this.$store.commit("deleteImage", hash);
          _this.$Message.success(_this.$tc("success_deletion"));
        } else {
          throw Error("not succeeded");
        }
      }).catch((error) => {
        console.error(error);
        _this.$Message.error(_this.$tc("error_deletion"));
      });
    }
  });
}

//   copyLink() {

//   }

//   downloadImage() {

//   }

//   openImageInNewTab() {

//   }