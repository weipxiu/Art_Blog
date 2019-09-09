# 唯品秀前端技术博客 - Wordpress主题
一款基于Js+jquery2.1.4+H5/CSS3开发，遵循黄金分割定律，把控每个元素每一个像素差的wordpress主题v2.5，[主题介绍](https://www.weipxiu.com/?cat=10)

### 主题后台配置预览
![avatar](https://raw.githubusercontent.com/weipxiu/weipxiu/master/src/images/wp-theme-options.png)

### 如何使用

- 本项目采用gulp自动化构建，建议通过git克隆到本地，然后运行`npm install`安装依赖，接着运行npm run build即可压缩打包整个项目
  到`dist`文件夹。当然，如不需要打包压缩代码等一系列工具功能可直接下载即可，同样找到项目文件的dist目录，里面即是已打包好的主题源码

- 将dist文件名命名为`Art_Blog`,然后将整个文件夹上传到线上：`/htdocs/wp-content/themes/`目录下，然后启用主题

- 运行环境条件：服务器选用Apache，wordPress版本≥4.6，≥5.3服务器php版本≤php7.2，如果出现报错，请尝试切换php版本，[阿里云虚拟主机升级php7.x报错处理](https://www.weipxiu.com/2909.html)

- 启用唯品秀Art_Blog主题后，在设置>常规中设置自己网站标题、副标题、邮箱等信息，然后到外观>唯品秀主题设置，设置站点域名地址（必须的）、公告、底部等信息

- 在后台>外观>菜单中管理你的导航栏，移动端侧边导航栏请自行在header.php中手动添加设置（完全傻瓜式）

- 详细教程地址：[唯品秀前端技术博客主题使用教程](https://www.weipxiu.com/3355.html)；文档枯燥还是不知道说的啥？[简洁教程视频链接](https://pan.baidu.com/s/1WdiCn__A6xQC3V9ddRSN6g)，`4drw`

- 如果喜欢，请多多打赏。

![avatar](https://raw.githubusercontent.com/weipxiu/weipxiu/master/src/images/zhiwei.png)

### 碎言碎语

> 1、wordpress主题制作有特别要求，例如主题根目录必须存在header.php、index.php、footer.php、style.css，否则是不认，无法加载的。
因此不用觉得某些文件摆放不合理，存在必定有意义

> 2、为了最佳浏览效果，该主题对≤IE8作了屏蔽跳转，≥IE9版本可能无法完整展示CSS3效果，但会尽量兼容
到不影响阅读

> 3、基于css文件作了根据终端分割，所以你会看到主题目录dist>css文件夹中有style-ios.css、style-ipd.css
两个文件，没错，三端样式完全独立，不重用，有利有弊，不做过多评论

> 4、源码开放供大家使用并修改，但在使用过程中底部请保留"唯品秀"版权说明，即：在footer.php源码中请不要去掉：<p>本站主题由<a href="https://www.weipxiu.com/" class="highlight">WEIPXIU.COM</a>免费提供</p>

### 项目文件说明
``` bash
│  category-1.php    //穿梭机
│  category-10.php   //关于博客
│  category-8.php    //碎言碎语
│  category.php   //通用列表模板
│  comments.php   //评论模块
│  favicon.ico  //网页浏览器标签icon
│  footer.php  //底部
│  functions.php   //主题核心函数
│  header.php  //头部
│  index.html  //测试页面
│  index.php   //首页
│  page.php    //注册
│  reminder.php   //低版本浏览器重定向
│  screenshot.png //wordpress主题展示图片
│  search.php  //搜索模板
│  sidebar.php    //右侧栏目
│  single.php  //文章详情
│  style.css   //PC端样式
│  thanks.php  //特别鸣谢
│  theme-options.php  //主题设置
│  
├─css
│      PingFangSC-Regular.woff   //一些字体文件
│      sf-pro-display_medium.woff2
│      sf-pro-display_regular.woff2
│      sf-pro-display_semibold.woff2
│      sf-pro-text_bold.woff2
│      sf-pro-text_regular.woff2
│      sf-pro-text_semibold.woff2
│      style-ios.css    //针对手机端样式
│      style-ipd.css    //针对ipd平板样式
│      swiper.min.css   //移动端轮播swiper样式
│      video-js.css    //视频插件样式     
│          
├─images    //图片资源
│      
├─js
│  │  ajax_wordpress.js    //用于分页ajaxs刷新
│  │  canvas-nest.min.js //canvas背景图插件
│  │  date.js  //时光机数据
│  │  index.js    //整个网站的js全局
│  │  javascript.js  //只针对首页的js文件
│  │  jquery-2.1.4.min.js 
│  │  rem.js
│  │  swiper.min.js  //移动端的swiper轮播插件
│  │  
│  ├─video.js 
│  │      video.min.js
│  │      videojs-ie8.min.js
│  │      zh-CN.js
│  │      zh-CN.json
│  │      
│  └─xfg_banner   //PC端首页banner
│          banner-effect.js
│          banner.js
│          effect.js
│          jquery.min.js
│          utils.js
│          
└─music  /导航音频文件
 ```       
<!-- <h2>使用当前主题网站</h2>

>不完全统计

> 爱前端  https//www.huanggr.cn
> 码云笔记  https://www.mybj123.com/
> 小丸子 http://www.minwenyu.com/
> 非常前端 http://moxiaofei.com/

