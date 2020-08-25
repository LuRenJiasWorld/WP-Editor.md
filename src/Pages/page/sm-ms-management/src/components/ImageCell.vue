<template>
  <Card class="image-cell">
    <img v-lazy="url" />
    <p class="image-cell-file-name image-cell-text" v-bind:title="filename">{{ filename }}</p>
    <Divider style="margin: 10px 0;" size="small" dashed />
    <p class="image-cell-datetime image-cell-text">{{ datetime }}</p>
    <p class="image-cell-width-height-size image-cell-text">
      {{ width }}px * {{ height }}px | {{ fileSizeCalculate(size) }}
    </p>
    <div class="image-cell-control-group">
      <div class="image-cell-control-group-left">
        <Tooltip v-bind:content="$tc('image_cell.delete_this_image')" placement="bottom-start">
          <Button style="padding: 0 3px;" icon="md-trash" v-on:click="deleteImage(hash)"></Button>
        </Tooltip>
      </div>
      <div class="image-cell-control-group-right">
        <Tooltip v-bind:content="$tc('image_cell.copy_image_link')" placement="bottom-start">
          <Button style="padding: 0 3px;" icon="md-copy" v-on:click="copyLink(url)"></Button>
        </Tooltip>
        <Tooltip v-bind:content="$tc('image_cell.download_image')" placement="bottom">
          <Button style="padding: 0 3px;" icon="md-cloud-download" v-on:click="downloadImage(url, filename)"></Button>
        </Tooltip>
        <Tooltip v-bind:content="$tc('image_cell.open_image_in_new_tab')" placement="bottom-end">
          <Button style="padding: 0 3px;" icon="md-open" v-on:click="openImageInNewTab(url)"></Button>
        </Tooltip>
      </div>
    </div>
  </Card>
</template>

<script lang="ts">
import { Component, Vue } from "vue-property-decorator";
const tinydate = require("tinydate").default;

@Component({
  props: [
    // 属性
    "filename", "width", "height", "size", "created_at", "url", "hash",
    // 方法
    "deleteImage", "copyLink", "downloadImage", "openImageInNewTab"
  ],
  computed: {
    datetime: function() {
      const created_at = new Date(parseInt(this.$props.created_at + "000"));
      const strftime = tinydate("{YYYY}-{MM}-{DD} {HH}:{mm}:{ss}");
      return strftime(created_at);
    }
  }
})
export default class ImageCell extends Vue {
  fileSizeCalculate(sizeByte: number): string {
    // 处理NaN的情况
    if (isNaN(sizeByte)) {
      return "";
    }

    if (sizeByte < 1024) {
      // Byte
      return sizeByte.toString() + "B";
    } else if (sizeByte >= 1024 && sizeByte < 1024 * 1024) {
      // KB
      return (sizeByte / 1024).toFixed(2).toString() + "KB";
    } else {
      // MB
      return (sizeByte / 1024 / 1024).toFixed(2).toString() + "MB";
    }
  }
}
</script>

<style lang="scss">
$width: 240px;

.image-cell {
  width: $width;
  margin: 14px 6px;
  flex: 1;

  & img {
    // 这里的16px是card内部的padding
    width: $width - (16px * 2);
    height: 170px;
    cursor: zoom-in;
    object-fit: cover;
  }

  & p {
    margin: 4px 10px;
    text-overflow: ellipsis;
    white-space: nowrap;
    overflow: hidden;
    user-select: none;

    &.image-cell-text {
      text-align: left;
      font-size: 0.92em;
    }

    &.image-cell-datetime, &.image-cell-width-height-size {
      text-align: right;
    }

    &.image-cell-file-name {
      font-size: 1em;
      margin: 4px 4px;
    }
  }

  & .image-cell-control-group {
    text-align: right;
    margin-top: 10px;
    display: flex;
    justify-content: space-between;

    & button {
      margin: 0 2px;
    }
  }
}
</style>
