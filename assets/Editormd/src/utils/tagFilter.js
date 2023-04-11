export const tagEncode = (text) => {
  // 不编码HTML注释
  if (/<!--(.*?)-->/.test(text)) {
    return text;
  }

  const lt = /</g,
    gt = />/g,
    ap = /'/g,
    ic = /"/g;
  return text
    .replace(lt, "&lt;")
    .replace(gt, "&gt;")
    .replace(ap, "&#39;")
    .replace(ic, "&#34;");
};

const tagFilter = (tagList, content) => {
  const replaceableMagicText = "c697e50f";
  const regexTemplate = `<\\/?${replaceableMagicText}[\\S\\s]*?\\/(${replaceableMagicText})?[\\ ]*?>`;

  let regex = [];

  const regexGenerator = (tagName) => {
    return new RegExp(
      regexTemplate
        .replace(replaceableMagicText, tagName)
        .replace(replaceableMagicText, tagName),
      "gim",
    );
  };

  tagList.forEach((each) => {
    regex = [
      ...regex,
      regexGenerator(each),
    ];
  });

  regex.forEach((eachRegex) => {
    content = content.replace(eachRegex, (matched) => (
      `<p>${tagEncode(matched)}</p>`
    ));
  });

  return content;
};

export default tagFilter;
