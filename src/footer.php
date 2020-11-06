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

<!-- 在线客服start -->
<div id="divStayTopright" style="position:fixed;z-index:999999;top:40%;right:0px;height:16px;">
  <div id="wuyousujian-kefuDv" style="right: -196px; position: fixed;">
    <script>
      var isIn = true;
      var isLeft = "right";
    </script>
    <table>
      <tbody>
        <tr>
          <td id="navLog">
            <img src="<?php echo esc_url(get_template_directory_uri()); ?>/images/open_im.png" width="40" height="133" id="imgNav">
          </td>
          <td>
            <table id="__01" width="105" class="customer-list" style="min-width:105px" border="0" cellpadding="0" cellspacing="0">
              <tbody>
                <tr>
                  <td>
                    <div class="kefu1">服务热线：</div>
                  </td>
                </tr>
                <tr>
                  <td>
                    <div class="telNo" id="txtTelNo">&nbsp;<?php 
                      echo trim(get_option('weipxiu_options')['phone-number']);
                      ?>
                    </div>
                  </td>
                </tr>
                <tr>
                  <td>
                    <div class="kefu3"></div>
                  </td>
                </tr>
                <tr>
                  <td>
                    <p class="wangwang-names" style="margin-bottom:7px">&nbsp;QQ在线交流</p>
                    <div class="qqSmall">
                      <a target="_blank" href="https://wpa.qq.com/msgrd?v=3&uin=<?php 
                      echo trim(get_option('weipxiu_options')['QQ-number']);
                      ?>&site=qq&menu=yes">
                        <img width="77" height="22" src="<?php echo esc_url(get_template_directory_uri()); ?>/images/zaixian_qq.png" width="77" height="22" alt="点击这里给我发消息" title="点击这里给我发消息"
                        />
                      </a>
                    </div>
                  </td>
                </tr>
                <tr>
                  <td>
                    <p class="wangwang-names">&nbsp;旺旺在线</p>
                    <div class="qqSmall">
                      <a target="_blank" href="<?php 
                      echo trim(get_option('weipxiu_options')['wangwang-link']);
                      ?>"style="position: relative; overflow: hidden;">
                        <img src="<?php echo esc_url(get_template_directory_uri()); ?>/images/zaixian_ww.gif" alt="点击这里给我发消息" width="77" height="19" style="vertical-align:middle;">
                      </a>
                    </div>
                  </td>
                </tr>
                <tr>
                  <td>
                    <div class="line"></div>
                  </td>
                </tr>
                <tr>
                  <td>
                    <div class="qq-kefu-fun-box">
                      <a class="qq-kefu-qrCode" id="qq-kefu-qrCode" href="javascript:;">
                        <img src="<?php echo trim(get_option('weipxiu_options')['weChat-number']); ?>" alt="">
                      </a>
                      <a class="qq-kefu-backUp-2" id="qq-kefu-backUp" href="javascript:;"></a>
                      <div class="qqkefu-qrcode-box" pos="2">
                      </div>
                    </div>
                  </td>
                </tr>
              </tbody>
            </table>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</div>
<!-- 在线客服end -->

<!-- 底部区域start -->
<footer class="footer">
    <?php 
        echo get_option('weipxiu_options')['footer_copyright'];
    ?>&nbsp;本站主题由<a href="https://www.weipxiu.com/" class="highlight">WEIPXIU.COM</a>&nbsp;<a href="https://github.com/weipxiu/Art_Blog/tags" target="_blank">免费提供</a>
</footer>
<!-- 底部区域end -->

<!-- 底部半透明遮盖层 -->
<div class="footer-banner__navi">
</div>

<script type="text/javascript" src="<?php echo esc_url(get_template_directory_uri()); ?>/js/jquery.lazyload.js"></script>
<script type="text/javascript" src="<?php echo esc_url(get_template_directory_uri()); ?>/js/video/video.min.js"></script>
<script type="text/javascript" src="<?php echo esc_url(get_template_directory_uri()); ?>/js/main_min.js"></script>

<!-- 调用wordpress核心函数 -->
<?php wp_footer(); ?>

<script type="text/javascript" defer="defer">
	$(function(){
		// 登录状态下展示后台管理入口
		<?php
			if (get_option('weipxiu_options')['login_reg'] == 'on' && is_user_logged_in()) {
				?>
					$("#backstage").show()
				<?php
			}
		?>
	})
</script>