<p align="center">
  <img width="160" height="55" src="https://www.weipxiu.com/wp-content/uploads/2019/06/weipxiu_logo_2.png">
</p>
<!-- 下列标签如何制作？https://shields.io/#/ -->
<p align="center">
  <a href="https://wordpress.org/">
    <img src="https://img.shields.io/badge/wordPress-5.2.3-brightgreen.svg" alt="wordPress">
  </a>
  <a href="https://www.php.net/">
    <img src="https://img.shields.io/badge/PHP-7.2.19-brightgreen.svg" alt="PHP">
  </a>
  <a href="https://jquery.com/">
    <img src="https://img.shields.io/badge/jQuery-2.1.4-brightgreen.svg" alt="jQuery">
  </a>
  <a href="http://layer.layui.com/">
    <img src="https://img.shields.io/badge/layer-3.1.1-brightgreen.svg" alt="layui">
  </a>
  <a href="https://www.iconfont.cn/">
    <img src="https://img.shields.io/badge/iocons-2.x-brightgreen.svg" alt="iconfont">
  </a>
  <a href="https://docs.videojs.com/docs/api/video.html">
    <img src="https://img.shields.io/badge/video-1.8.7-ff69b4" alt="video.js">
  </a>
  <a href="https://www.swiper.com.cn/">
    <img src="https://img.shields.io/badge/Swiper-3.4.2-blue" alt="Swiper">
  </a>
</p>

一款精美绝伦的wordPress开源艺术主题，历时四年时光洗礼，每段代码皆不忘初心，炫彩夺目奢华外表的同时，更有一颗懂你的心，[下载安装](https://github.com/weipxiu/Art_Blog/tags)

## 如何使用它

I、方式一：直接下载项目，找到项目文件的Art_Blog.zip压缩包，即是已打包好的主题源码，通过后台主题上传，启用主题即可。方式二：将项目中dist文件夹下Art_Blog整个`文件夹`上传到线上：`/根目录/wp-content/themes/`目录下，启用主题，`推荐使用方式二`

II、当然，本项目采用gulp自动化构建，推荐通过git克隆到本地，电脑全局安装gulp，然后运行`npm install`安装依赖，接着运行npm run build即可压缩打包整个项目到`dist`文件夹（显然，这一切需要你电脑安装了Node.js以及git工具，node版本控制在v8.x为宜），dist里的文件就是Art_Blog.zip里的文件

III、运行环境条件：1、优先采用云服务器而不是虚拟主机，2、wordPress版本≥4.0，服务器php版本≥5.6，3、如果出现意外报错，可尝试切换php版本，[论一个网站服务器性能重要性](https://www.weipxiu.com/3246.html)

IV、更多详细教程点击：[主题使用教程](https://www.weipxiu.com/3355.html)；文档枯燥？[教程视频](https://pan.baidu.com/s/1WdiCn__A6xQC3V9ddRSN6g)，`4drw`

V、主题开源，唯一支持作者的方式是下方打赏[支付宝/微信]，您的认可与支持将是我前进的最大动力！
<p align="center">
<img src="https://www.weipxiu.com/wp-content/uploads/2019/04/alipay.png" width="150"><img src="https://www.weipxiu.com/wp-content/uploads/2019/04/weixin.png" width="150">
</p>

## 主题后台配置预览
![avatar](https://www.weipxiu.com/wp-content/themes/Art_Blog/images/wp_theme_config.png)

## 碎言碎语

I、wordPress主题制作有特别要求，例如主题根目录必须存在header.php、index.php、footer.php、style.css，否则主题视为"不完整"，无法安装。
因此不用觉得某些文件摆放不合理，存在即有意义

II、为了用户最佳浏览体验，该主题对≤IE8作了屏蔽跳转，≥IE9版本可能无法完整展示CSS3效果，但会尽量兼容到不影响阅读

III、CSS文件基于终端做分割，所以你会看到主题目录dist>css文件夹中有style-pc.css、style-ios.css、style-ipd.css两个文件，没错，三端样式完全独立，不重用，不过你完全不用过分担心，打包后多端样式会合并压缩，代价没你想象的那么大，有利有弊，不予置评

IV、源码开放供大家使用并修改，但在使用过程中底部请保留"唯品秀"版权说明，即：在footer.php源码中请不要去掉：<p>本站主题由<a href="https://www.weipxiu.com" class="highlight">WEIPXIU.COM</a>免费提供</p>

V、主题不定期优化，如若在使用过程中出现问题自己无法解决可直接与我联系，免费在线技术支持QQ:343049466，微信同号，加好友请备注

## 项目文件说明
``` bash
│  page-time.php    //穿梭机（单页）
│  page-about.php   //关于博客（单页）
│  page-message.php    //碎言碎语（单页）
│  page-reminder.php   //低版本浏览器落地页
│  category.php   //通用文章列表模板
│  comments.php   //评论模板
│  favicon.ico  //网页浏览器标签icon
│  functions.php  //主题核心函数
│  header.php  //公共头部
│  footer.php  //公共底部
│  common.php  //公共引入文件（js、css）
│  index.html  //测试页面（忽略）
│  index.php   //首页
│  page.php    //通用单页模板
│  screenshot.png //wordpress主题展示图
│  search.php  //搜索模板
│  sidebar.php    //右侧栏目
│  single.php  //文章详情
│  style.css   //主题必备描述文件
│  theme-options.php  //主题后台配置
│  
├─css
│      main.css    //多端全局 
│      style-pc.css    //PC端
│      style-ios.css    //手机端
│      style-ipd.css    //ipd端
│      swiper.min.css   //移动端轮播
│      video-js.css    //视频插件     
│   
├─font 
│      sf-pro-text_regular.woff2 //字体包 
│ 
├─images  //公共图片资源（含表情包）
│      
├─js
│  │  ajax_wordpress.js    //分页ajax刷新
│  │  canvas-nest.min.js   //canvas背景图插件
│  │  index.js    //整个网站全局js
│  │  javascript.js  //只针对首页js文件
│  │  jquery-2.1.4.min.js // 公共js库
│  │  rem.js //移动端自适应适配
│  │  swiper.min.js  //移动端的swiper轮播插件
│  │  
│  ├─video.js 
│  │      video.min.js //视频插件
│  │      
│  └─xfg_banner
│          banner-effect.js //PC端首页banner
│          
└─music  //3D导航音频文件
 ```       


## 哪些网站在使用(据百度受访问域名不完全统计，并非后门)

|  网站名称 | 网站地址 | 
| :----: | :----: | 
| [张峰博客](http://www.feng01.top/) | http://www.feng01.top
| [枯痕博客](https://www.xiaole.biz/) | https://www.xiaole.biz
| [故城县历史](http://www.gaojibo.com/) | http://www.gaojibo.com
| [北漂程序员](https://blog.zoux.xin/) | https://blog.zoux.xin
| [小初博客](http://youerdianxian.com/) | http://youerdianxian.com
| [前端笔记](http://younglee666.com/) | http://younglee666.com
| [非常前端](http://moxiaofei.com) | www.moxiaofei.com 
| [大川渝个人博客](https://www.dcydz.com) | www.dcydz.com
| [青幽](http://moxiaofei.com) | http://moxiaofei.com
| [智慧博客网](https://www.llg.design) | www.llg.design 
| [开源NetCore](http://www.netcore.pub) | http://netcore.pub
| [狗蛋博客](https://www.xiaole.biz) | https://www.xiaole.biz
| [苏州特个人博客](http://www.sutee.cn) | http://www.sutee.cn
| [某小健博客](http://www.mouxj.com) | www.mouxj.com |
