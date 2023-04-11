module.exports = {
  "root": true,
  "parserOptions": {
    "sourceType": "module",
    "ecmaVersion": 2017,
  },
  "env": {
    "browser": true,
  },
  "rules": {
    // 两个空格的缩进
    "indent":             ["error", 2, { "SwitchCase": 1 }],

    // 必须使用双引号
    "quotes":             ["error", "double"],

    // 每行结尾必须带分号或逗号
    "semi":               ["error", "always"],
    "comma-dangle":       ["error", "always-multiline"],

    // 操作符左右必须加空格
    "space-infix-ops":    ["error", {"int32Hint": false}],

    // 必须使用严格模式
    "strict":             ["error", "global"],

    // 规范逗号使用
    "comma-spacing":      ["error", {"before": false, "after": true}],

    // 规范空格使用
    "block-spacing":      ["error", "always"],
    "func-call-spacing":  ["error", "never"],
    "no-trailing-spaces": ["error"],

    // 去除推荐规则中用不上的规则
    "no-useless-escape":  ["off"],
    "no-unused-vars":     ["warn"],
  },
  "extends": ["eslint:recommended"],
  "overrides": [
    {
      "files": [
        "webpack.common.js",
        "webpack.conf.js",
        "webpack.dev.js",
        "webpack.prod.js",
        ".eslintrc.js",
      ],
      "env": {
        "node": true,
      },
    },
  ],
};

