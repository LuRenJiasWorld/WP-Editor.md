import axios from "axios";
import copy from "copy-to-clipboard";
import { throttle } from "throttle-debounce";
// @ts-ignore
import Downloader from "js-file-downloader";
import AppInterface from "src/App.type";

import { SM_MS_API, SM_MS_HEADER } from "src/utils/constant";
import { ACTION_THROTTLE_TIME_MS as t } from "src/utils/constant";

export const deleteImage = throttle(t, (context: AppInterface, hash: string) => {
  const _this: AppInterface = context;

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
});

export const copyLink = throttle(t, (context: AppInterface, url: string) => {
  const _this: AppInterface = context;

  copy(url);

  _this.$Message.success(_this.$tc("copy_success"));
});

export const downloadImage = throttle(t, (context: AppInterface, url: string, filename: string) => {
  const _this: AppInterface = context;

  _this.$Message.info(_this.$tc("downloading"));

  // Mock.js测试环境无法保存，属于正常情况，是Mock.js的BUG，由于项目停更，无法简单修复
  // 其实有浏览器的缓存（图片早就加载了），所以这里几乎是极速下载，设置一点延迟以优化体验
  // Ref: https://github.com/nuysoft/Mock/issues/299
  setTimeout(() => {
    new Downloader({
      url: url,
      filename: filename
    })
      .then(function () {
        _this.$Message.destroy();
        _this.$Message.success(_this.$tc("download_success"));
      })
      .catch(function (error: any) {
        _this.$Message.destroy();
        _this.$Message.error(_this.$tc("download_failed"));
      });
  }, 1000 + (Math.random() * 1000));

});

export const openImageInNewTab = throttle(t, (context: AppInterface, url: string) => {
  const _this: AppInterface = context;

  const link = document.createElement("a");
  link.href          = url;
  link.style.display = "none";
  link.target        = "_blank";
  document.body.appendChild(link);
  link.click();
  document.body.removeChild(link);
});