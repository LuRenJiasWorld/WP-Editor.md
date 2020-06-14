class Utils {
  static getCookie(name: string): string {
    const value = `; ${document.cookie}`;
    const parts = value.split(`; ${name}=`);
    if (parts.length === 2) {
      return parts.pop()!.split(";").shift()!;
    } else {
      return "";
    }
  }

  static getBrowserLang(): string {
    let language;
    if (window.navigator.languages) {
      language = window.navigator.languages[0];
    } else {
      // window.navigator.userLanguage是IE的属性，此处只作为兼容
      // @ts-ignore
      language = window.navigator.userLanguage || window.navigator.language;
    }
    return language;
  }

  static getGet(queryKey: string = ""): string | object {
    interface GetParam {
      [index: string]: string;
    }
    var vars: GetParam = {};
    window.location.href.replace(/[?&]+([^=&]+)=([^&]*)/gi, function(m, key, value) {
      vars[key] = value;
      // 满足ts类型需求
      return value;
    });
    if (queryKey === "") return vars;
    else                 return vars[queryKey] === undefined ? "" : vars[queryKey];
  }
}

export default Utils;