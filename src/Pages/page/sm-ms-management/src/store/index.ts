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
    addImage(state, imageInfo: ImageInfoType) {
      state.image_list = [...state.image_list, imageInfo];
    },
    addImages(state, imageInfoBatch: ImageInfoType[]) {
      state.image_list = [...state.image_list, ...imageInfoBatch];
    },
    deleteImage(state, imageHash: string) {
      state.image_list.forEach((element, index, object) => {
        if (element.hash === imageHash) {
          object.splice(index, 1);
        }
      });
    },
    clearImages(state) {
      state.image_list = [];
    }
  },
  actions: {
  },
  modules: {
  }
});
