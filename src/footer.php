<!-- 小飞机start -->
<div id="aircraft">
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

<?php
  if (get_option('weipxiu_options')['snowflake'] == 'on') {
    ?>
      <!-- 雪花 -->
      <div id="snowMask" class='snow_size<?php echo get_option('weipxiu_options')['snow_size']?>'></div>
      <!-- 雨夹雪 -->
      <div class="rain"></div>
      <!-- 闪电 -->
      <canvas id="cloudlightning"></canvas>
      <canvas id="lightning"></canvas>
      <canvas id="lightningSheet"></canvas>
    <?php
  }
?>

<!-- 在线交流start -->
<div class="communication">
  <img class="suspended" src="<?php echo esc_url(get_template_directory_uri()); ?>/images/open_im.png" width="40" height="133">
  <ul>
    <li>
      <p class="service">电话支持</p>
      <span class="telephone"><?php
        echo trim(get_option('weipxiu_options')['phone-number']);
        ?>
      </span>
    </li>
    <li class="qq">
      <p>在线交流</p>
      <a target="_blank" href="https://wpa.qq.com/msgrd?v=3&uin=<?php
      echo trim(get_option('weipxiu_options')['QQ-number']);
      ?>&site=qq&menu=yes">
        <img width="77" height="22" src="<?php echo esc_url(get_template_directory_uri()); ?>/images/zaixian_qq.png" width="77" height="22" alt="点击这里给我发消息" title="点击这里给我发消息"
        />
      </a>
    </li>
    <li class="wechat">
      <p>微信添加</p>
      <img src="<?php echo trim(get_option('weipxiu_options')['weChat-number']); ?>" alt="">
    </li>
  </ul>
</div>
<!-- 在线交流end -->

<!-- 底部区域start -->
<footer class="footer">
    <?php
        echo get_option('weipxiu_options')['footer_copyright'];
    ?>&nbsp;本站主题由<a href="https://www.weipxiu.com/" class="highlight">WEIPXIU.COM</a>&nbsp;<a href="https://gitee.com/weipxiu/Art_Blog" target="_blank">免费提供</a>
</footer>
<!-- 底部区域end -->

<!-- 底部半透明遮盖层 -->
<div class="footer-banner__navi">
</div>

<script type="text/javascript" src="<?php echo esc_url(get_template_directory_uri()); ?>/js/lib/video/DPlayer.min.js"></script>
<script type="text/javascript" >
  if (window.screen.width > 1200 && $("#my-video").length) {
    let isFullscreen = false; // 是否全屏
    // 初始化视频
    let dp = new DPlayer({
        container: document.querySelector("#my-video"),
        autoplay: false,
        theme: 'var(--color-primary)',
        loop: false, // 是否循环播放
        lang: 'zh-cn',
        hotkey: true, //开启热键，支持快进、快退、音量控制、播放暂停
        preload: 'auto',
        volume: 0.7, // 默认音量，请注意播放器会记忆用户设置，用户手动设置音量后默认音量即失效
        mutex: true, // 互斥，阻止多个播放器同时播放，当前播放器播放时暂停其他播放器
        playbackSpeed:[0.5, 0.75, 1, 1.25, 1.5, 2], //可选的播放速率，可以设置成自定义的数组
        video:{
            url:"<?php echo get_option('weipxiu_options')['video_url']; ?>",
            pic:"<?php echo get_option('weipxiu_options')['video_cover']; ?>"
        },
        highlight: [
          {
              time: 12,
              text: '技术宅',
          },
          {
              time: 30,
              text: '自黑',
          },
          {
              time: 50,
              text: '懂浪漫',
          },
          {
              time: 82,
              text: '手机支付',
          },
        ],
    });
    //播放失败时候处理
    dp.on('error', function () {
      layer.alert('通常是由于视频地址错误或网络异常引起，请检查视频播放地址或重试！', {
            skin: 'layui',
            title: "视频初始化失败",
            closeBtn: 0,
            shade:0.5,
            shadeClose:true,
            anim: 4 //动画类型
        })
    });
    $('#my-video').append(`<i class="iconfont icon-bofang video_switch"></i>`);
    dp.on('play', function () {
      $('.video_switch').fadeOut(300);
    });
    dp.on('pause', function () {
      $('.video_switch').fadeIn(300);
    });
    // 进入全屏
    dp.on('fullscreen', function () {
      isFullscreen = true;
    });
    // 退出全屏
    dp.on('fullscreen_cancel', function () {
      isFullscreen = false;
    });
    // 双击进入/退出全屏
    let el_video = document.querySelector("#my-video .dplayer-video");
    document.querySelector("#my-video").ondblclick = function(){
      // el.mozFullScreenElement 返回当前元素是否全屏，如果没有使用全屏模式，则返回null
      if(isFullscreen && el_video.fullscreenElement){
        el_video.exitFullScreen();
      }else{
        // 进入全屏时候应该选择整个盒子，如果选择vedio作为目标全屏元素，在点击视频控件部分无法全屏还报错
        el_video.requestFullscreen();
      }
      isFullscreen = !isFullscreen;
    };
  }
</script>
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

<!-- 雨、雪、闪电 -->
<?php
  if (get_option('weipxiu_options')['snowflake'] == 'on') {
    ?>
      <script type="module">
        import { lightning_effect, makeItRain } from "<?php echo esc_url(get_template_directory_uri()); ?>/js/global.js";
        let weatherType = <?php echo get_option('weipxiu_options')['snow_size']?>;
        const el_cloudlightning = document.getElementById('cloudlightning');
        const el_lightning = document.getElementById('lightning');
        const el_lightningSheet = document.getElementById('lightningSheet');
        const $el = $('.rain');
        const {snowflake, raindrop} = makeItRain($el);

        // 实时天气获取
        if(!weatherType || weatherType == 6){
          new Promise((resolve, reject) => {
              $.getJSON('https://www.tianqiapi.com/api/?version=v9&appid=23035354&appsecret=8YvlPNrz', function (result) {
                // 天气接口wea_img状态值：xue、lei、shachen、wu、bingbao、yun、yu、yin、qing
                // wea返回值：https://yikeapi.com/help/wea
                let dataType = 100; // 默认晴空万里
                let h = new Date().getHours();
                h = h < 10 ? '0' + h + '时' : h == '24' ? '00' + '时' : h + '时';
                let d = result.data[0].hours.filter(function (item) {
                  return item.hours == h
                })[0];
                dataType = /xue$/.test(d.wea_img) ? 4 : /(yu|lei|bingbao)$/.test(d.wea_img) ? 5 : 100
                if (/雷阵雨/.test(d.wea)) {
                  dataType += 'lei'
                }
                resolve(dataType);
              })
          }).then(res=>{
              weatherType = res;
              if (weatherType == 4) {
                $el.append(raindrop + snowflake); // 雨夹雪
              } else if (weatherType == 5) {
                $el.append(raindrop); // 雨
              } else if (/lei/.test(weatherType)) {
                $el.append(raindrop); // 雨
                lightning_effect(el_cloudlightning, el_lightning, el_lightningSheet); // 闪电
              }
          },err=>{
            layer.msg('天气接口请求失败！', {
              time: 3000
            })
          })
        }else{
          if (weatherType == 4) {
            $el.append(raindrop + snowflake); // 雨夹雪
          } else if (weatherType == 5) {
            $el.append(raindrop); // 雨
            lightning_effect(el_cloudlightning, el_lightning, el_lightningSheet); // 闪电
          }
        }
    </script>
    <?php
  }
?>
