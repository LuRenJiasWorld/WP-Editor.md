module.exports = {
  "root": true,    
  "parserOptions": {
    "sourceType": "module",
    "ecmaVersion": 2016
  },
  "env": {
      "browser": true,
  },
  "rules": {
    // 两个空格的缩进
    "indent":             ["error", 2],  
    
    // 必须使用双括号
    "quotes":             ["error", "double"],
    
    // 每行结尾必须带分号
    "semi":               ["error", "always"],
    
    // 操作符左右必须加分号
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
    "no-unused-vars":     ["warn"]
  },
  "extends": ["eslint:recommended"]
}