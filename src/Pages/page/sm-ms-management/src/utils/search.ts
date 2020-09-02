// 从data的各元素中搜索keyword，匹配则返回true
export default function SearchHandler(keyword: string, data: any): boolean {
  for (const each in data) {
    if (data[each].indexOf(keyword) !== -1) {
      return true;
    }
  }
  return false;
}