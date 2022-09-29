module.exports = {
  ignores: [(commit) => commit.includes('init')],
  extends: ['@commitlint/config-conventional'],
  rules: {
    'body-leading-blank': [2, 'always'],
    'footer-leading-blank': [1, 'always'],
    'header-max-length': [2, 'always', 108],
    'subject-empty': [2, 'never'],
    'type-empty': [2, 'never'],
    'type-enum': [
      2,
      'always',
      [
        'feat', // 新增功能
        'fix', // 修复问题 or bug
        'style', // 代码风格相关（不影响运行结果）
        'perf', // 优化 or 性能提升
        'chore', // 依赖更新 or 脚手架配置更新等
        'refactor', // 重构
        'docs', // 文档 or 注释
        'test', // 测试相关
        'build', // 打包构建
        'ci', // 持续集成
        'revert', // 撤销修改（回滚）
        'wip', // 开发中
        'workflow', // 工作流更新
        'types', // 类型定义文件更新
        'release', // 发布
      ],
    ],
  },
};
