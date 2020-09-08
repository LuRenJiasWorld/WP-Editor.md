const tagFilter = (tagList, content) => {
  const replaceableMagicText = "c697e50f";
  const regexTemplate = `<\\/?${replaceableMagicText}[\\S\\s]*?\\/(${replaceableMagicText})?[\\ ]*?>`;
  const lt = /</g,
    gt = />/g,
    ap = /'/g,
    ic = /"/g;
  let regex = [];

  const regexGenerator = (tagName) => {
    return new RegExp(
      regexTemplate
        .replace(replaceableMagicText, tagName)
        .replace(replaceableMagicText, tagName),
      "gim"
    );
  };

  tagList.forEach((each) => {
    regex = [
      ...regex,
      regexGenerator(each),
    ];
  });

  regex.forEach((eachRegex) => {
    content = content.replace(eachRegex, (matched) => {
      const filteredItem = matched
        .replace(lt, "&lt;")
        .replace(gt, "&gt;")
        .replace(ap, "&#39;")
        .replace(ic, "&#34;");
      return `<p>${filteredItem}</p>`;
    });
  });

  return content;
};

export default tagFilter;