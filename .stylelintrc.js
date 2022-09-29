module.exports = {
  /*extends 扩展插件
  stylelint的配置可以 extend 一个已存在的配置文件(无论是你自己的还是第三方的配置)。当一个配置继承了里一个配置，它将会添加自己的属性并覆盖原有的属性。
  你也可以将extends设置为一个数组，每一项都是一个独立的stylelint配置项，后一项将会覆盖前一项，而接下来你自己书写的 rules 规则可以覆盖他们所有。*/
  // extends: ['stylelint-config-standard', 'stylelint-config-prettier'], // 因历史包袱过重，开启后寸步难行，因此需手动自定义按需开启规则
  plugins: ['stylelint-order'], // CSS属性排序插件,具体顺序规则在下面自定义规则“order/properties-order”中配置
  // postcss-html该插件的主要用例是使用Stylelint 将linting应用于HTML（和类似 HTML）中的<style>标签和属性。<div style="*">
  overrides: [
    {
      "files": ["*.html", "**/*.html"],
      "customSyntax": "postcss-html"
    }
  ],
  // 自定义规则
  rules: {
    // 默认情况下没有打开任何规则，也没有默认值。您必须明确配置每个规则以将其打开，基本配置——null关闭、true开启
    'indentation': 2, // 指定缩进（可自动修复）
    'max-empty-lines': 2, // 限制相邻空行的数量（可自动修复）
    'no-empty-first-line': true, // 不允许空的第一行（可自动修复）
    'no-extra-semicolons': true, // 不允许额外的分号（可自动修复）
    'color-no-invalid-hex': true, // 禁止无效的十六进制颜色
    'font-family-no-duplicate-names': true, // 不允许重复的字体系列名称
    'font-family-name-quotes': 'always-unless-keyword', // 指定是否应在字体系列名称周围使用引号（可自动修复
    'function-calc-no-unspaced-operator': true, // 不允许在calc函数中使用无空格运算符
    'unit-no-unknown': true, //禁止未知单位
    'property-no-unknown': [true, { ignoreProperties: ['box-orient','box-pack','box-align'] }], // 禁止未知属性，如有属性不可识别，可在ignoreProperties此数组中添加，例如box-orient
    'declaration-block-no-duplicate-custom-properties': true, //不允许在声明块中重复自定义属性
    'comment-no-empty': true, // 禁止空/无效注释
    'no-invalid-double-slash-comments': true, // 禁止CSS 不支持的双斜线注​​释,指：用双斜杠//去注释css
    'at-rule-empty-line-before': 'always', // 在规则之前要求有空行（可自动修复）
    'comment-whitespace-inside': 'always', // 要求注释标记内部空格（可自动修复）
    'no-descending-specificity': null, // 不允许较低特异性的选择器出现在覆盖较高特异性的选择器之后
    'property-no-vendor-prefix': null, // 不允许属性的供应商前缀（可自动修复）
    'number-leading-zero': 'always', // 对于小于1的小数，要求前面带零（可自动修复）
    'number-no-trailing-zeros': true, // 不允许数字中的尾随零（可自动修复）
    'string-quotes': 'single', // 在字符串周围指定单引号（可自动修复）
    'unit-case': 'lower', // 为单位指定小写（可自动修复）
    'declaration-colon-space-after': 'always', // 在声明的冒号后需要一个空格（可自动修复）
    'declaration-colon-space-before': 'never', // 在声明的冒号之前不允许空格（可自动修复）
    'declaration-block-semicolon-space-before': 'never', // 在声明块的分号之前需要一个空格（可自动修复）
    // 'block-opening-brace-newline-before':'always', // 在块的左大括号之前需要换行符（可自动修复）
    'block-opening-brace-newline-after': 'always', // 在块的左大括号之后需要换行符（可自动修复）
    // 'block-closing-brace-space-before': 'always', // 在块的右大括号之前需要一个空格（可自动修复
    'block-closing-brace-newline-before': 'always', // 在块的右大括号后需要换行符
    'declaration-block-semicolon-newline-after': 'always', // 在声明块的分号后需要换行符（可自动修复）
    'at-rule-semicolon-newline-after': 'always', // 在样式大括号内规则的分号后需要换行符（可自动修复）
    // 'declaration-block-no-duplicate-properties': true, // 禁止声明块中的重复属性
    'selector-pseudo-element-no-unknown': [
      true,
      {
        ignorePseudoElements: ['v-deep'],
      },
    ],
    'selector-pseudo-class-no-unknown': [
      true,
      {
        ignorePseudoClasses: ['global'],
      },
    ],
    'at-rule-no-unknown': [
      true,
      {
        ignoreAtRules: ['function', 'if', 'for', 'else', 'each', 'include', 'mixin'],
      },
    ],
    "order/order": [
      "custom-properties",
      "declarations"
    ],
    "order/properties-order": [
      'position',
      'top',
      'right',
      'bottom',
      'left',
      'z-index',
      'display',
      'float',
      'width',
      'height',
      'max-width',
      'max-height',
      'min-width',
      'min-height',
      'padding',
      'padding-top',
      'padding-right',
      'padding-bottom',
      'padding-left',
      'margin',
      'margin-top',
      'margin-right',
      'margin-bottom',
      'margin-left',
      'margin-collapse',
      'margin-top-collapse',
      'margin-right-collapse',
      'margin-bottom-collapse',
      'margin-left-collapse',
      'overflow',
      'overflow-x',
      'overflow-y',
      'clip',
      'clear',
      'font',
      'font-family',
      'font-size',
      'font-smoothing',
      'osx-font-smoothing',
      'font-style',
      'font-weight',
      'hyphens',
      'src',
      'line-height',
      'letter-spacing',
      'word-spacing',
      'color',
      'text-align',
      'text-decoration',
      'text-indent',
      'text-overflow',
      'text-rendering',
      'text-size-adjust',
      'text-shadow',
      'text-transform',
      'word-break',
      'word-wrap',
      'white-space',
      'vertical-align',
      'list-style',
      'list-style-type',
      'list-style-position',
      'list-style-image',
      'pointer-events',
      'cursor',
      'background',
      'background-attachment',
      'background-color',
      'background-image',
      'background-position',
      'background-repeat',
      'background-size',
      'border',
      'border-collapse',
      'border-top',
      'border-right',
      'border-bottom',
      'border-left',
      'border-color',
      'border-image',
      'border-top-color',
      'border-right-color',
      'border-bottom-color',
      'border-left-color',
      'border-spacing',
      'border-style',
      'border-top-style',
      'border-right-style',
      'border-bottom-style',
      'border-left-style',
      'border-width',
      'border-top-width',
      'border-right-width',
      'border-bottom-width',
      'border-left-width',
      'border-radius',
      'border-top-right-radius',
      'border-bottom-right-radius',
      'border-bottom-left-radius',
      'border-top-left-radius',
      'border-radius-topright',
      'border-radius-bottomright',
      'border-radius-bottomleft',
      'border-radius-topleft',
      'content',
      'quotes',
      'outline',
      'outline-offset',
      'opacity',
      'filter',
      'visibility',
      'size',
      'zoom',
      'transform',
      'box-align',
      'box-flex',
      'box-orient',
      'box-pack',
      'box-shadow',
      'box-sizing',
      'table-layout',
      'animation',
      'animation-delay',
      'animation-duration',
      'animation-iteration-count',
      'animation-name',
      'animation-play-state',
      'animation-timing-function',
      'animation-fill-mode',
      'transition',
      'transition-delay',
      'transition-duration',
      'transition-property',
      'transition-timing-function',
      'background-clip',
      'backface-visibility',
      'resize',
      'appearance',
      'user-select',
      'interpolation-mode',
      'direction',
      'marks',
      'page',
      'set-link-source',
      'unicode-bidi',
      'speak',
    ],
  },
};
