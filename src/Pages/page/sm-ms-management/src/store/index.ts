import Vue from "vue";
import Vuex from "vuex";
// 此处存在误判，实际变量被使用，但提示未使用
// eslint-disable-next-line
import { ImageInfoType, StateType } from "./index.type";

Vue.use(Vuex);

let state: StateType = {
  image_list: []
};

export default new Vuex.Store({
  state: state,
  mutations: {
    getImage(state, imageHash: string): ImageInfoType | null {
      let imageInfo: ImageInfoType | null = null;

      state.image_list.forEach((element: ImageInfoType) => {
        if (element.hash === imageHash) {
          imageInfo = element;
        }
      });

      return imageInfo;
    },
    getImages(state): ImageInfoType[] {
      return state.image_list;
    },
    addImage(state, imageInfo: ImageInfoType): boolean {
      state.image_list = [...state.image_list, imageInfo];
      return true;
    },
    addImages(state, imageInfoBatch: ImageInfoType[]): boolean {
      state.image_list = [...state.image_list, ...imageInfoBatch];
      return true;
    },
    deleteImage(state, imageHash: string): boolean {
      let success = false;
      state.image_list.forEach((element, index, object) => {
        if (element.hash === imageHash) {
          object.splice(index, 1);
          success = true;
        }
      });
      return success;
    }
  },
  actions: {
  },
  modules: {
  }
});
