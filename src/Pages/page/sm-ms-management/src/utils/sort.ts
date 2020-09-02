import { ImageInfoType } from "src/store/index.type";
import sort from "fast-sort";

// 对传入的图片数组，按照时间逆序排序
export function ImageSortByTimeDesc(imageList: ImageInfoType[]) {
  return sort(imageList).desc((u: ImageInfoType) => u.created_at);
}