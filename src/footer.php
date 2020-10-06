<!-- 底部区域start -->
<footer class="footer">
  <div class="container">
    <?php 
        echo get_option('weipxiu_options')['footer_copyright'];
    ?>&nbsp;本站主题由<a href="https://www.weipxiu.com/" class="highlight">WEIPXIU.COM</a>&nbsp;<a href="https://github.com/weipxiu/Art_Blog" target="_blank">免费提供</a>
  </div>
</footer>
<!-- 底部区域end -->

<!-- 底部半透明遮盖层 -->
<div class="footer-banner__navi">
</div>

<!-- 小飞机start -->
<div class="aircraft">
  <font class="iconfont icon-huojian-copy"></font>
</div>
<!-- 小飞机end -->

<!--ajax加载loading-->
<div id="loading">
  <div class="k-ball-holder">
      <div class="k-ball7a"></div>
      <div class="k-ball7b"></div>
      <div class="k-ball7c"></div>
      <div class="k-ball7d"></div>
  </div>
</div>
<!--ajax加载loading end-->

<!-- 雪花start -->
<?php
  if (get_option('weipxiu_options')['snowflake'] == 'on') {
    ?>
      <div id="snowMask"></div>
    <?php
  }
?>
<!-- 雪花end -->

<!-- <script type="text/javascript" color="0,0,255" opacity='0.7' zIndex="-1" count="99" src="/js/canvas-nest.min.js"></script> -->
<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/jquery.lazyload.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/video/video.min.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/main_min.js"></script>

<!-- 调用wordpress核心函数 -->
<?php wp_footer(); ?>