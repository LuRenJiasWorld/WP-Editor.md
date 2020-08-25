type ImageInfoType = {
  width: number,
  height: number,
  filename: string,
  storename: string,
  size: number,
  path: string,
  hash: string,
  created_at: number,
  url: string,
  delete: string,
  page: string
};

type StateType = {
  image_list: ImageInfoType[]
}

export { ImageInfoType, StateType };