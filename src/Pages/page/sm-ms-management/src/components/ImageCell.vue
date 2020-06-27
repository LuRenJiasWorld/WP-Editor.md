<template>
	<div class="image-cell">
		<img v-bind:src="url" />
		<p class="image-cell-file-name">{{filename}}</p>
	</div>
</template>

<script lang="ts">
import { Component, Vue } from "vue-property-decorator";

@Component
export default class ImageCell extends Vue {
	filename = "测试";
	url = "https://i.loli.net/2020/06/26/MVS7BqwImvxLXuk.jpg";
}
</script>

<style lang="scss">
.image-cell {
	width: 320px;
	height: 240px;
	border-radius: 12px;
	border: 1px solid #666666;

	& img {
		width: 320px;
		height: 180px;
	}
}
</style>