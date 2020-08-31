<?php
function themeoptions_admin_menu() {
  // 在控制面板的侧边栏添加设置选项页链接
  // add_theme_page(添加到外观下) add_menu_page(添加到主菜单下)
	add_menu_page('唯品秀主题配置', '唯品秀主题配置','edit_themes', basename(__FILE__), 'themeoptions_page', '',80);
}
if ( isset($_POST['update_themeoptions']) && $_POST['update_themeoptions'] == 'true' ) themeoptions_update();
function themeoptions_page() {
  // 获取提交的数据
  $a_options = get_option('weipxiu_options');
  //加载上传图片的js(wp自带)
  wp_enqueue_script('thickbox');
  //加载css(wp自带)
  wp_enqueue_style('thickbox');
?>
  <link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/include/css/set.css">
  <div class="wrap">
    <h2>唯品秀主题设置</h2>
    <ul class="nav-wrap clearfix">
      <li class="nav-list on">基本</li>
      <li class="nav-list">SEO</li>
      <li class="nav-list">图片</li>
      <li class="nav-list">社交</li>
    </ul>
    <form method="post" action="">
      <input type="hidden" name="update_themeoptions" value="true">
      <!-- 内容一 基本 -->
      <div class="content-wrap content1">
        <div class="row clearfix">
          <label class="fl left-wrap">PC轮播图效果：</label>
          <div class="fr right-wrap">
            <label for="wheel_banner1">翻转</label>
            <input
              type="radio"
              id="wheel_banner1"
              name="wheel-banner"
              value="1" <?php if($a_options['wheel_banner'] == '1') echo 'checked'; ?>
            >
            <label for="wheel_banner2">爆炸</label>
            <input
              type="radio"
              id="wheel_banner2"
              name="wheel-banner"
              value="2" <?php if($a_options['wheel_banner'] == '2') echo 'checked'; ?>
            >
            <label for="wheel_banner3">翻页</label>
            <input
              type="radio"
              id="wheel_banner3"
              name="wheel-banner"
              value="3" <?php if($a_options['wheel_banner'] == '3') echo 'checked'; ?>
            >
            <label for="wheel_banner4">扭曲</label>
            <input
              type="radio"
              id="wheel_banner4"
              name="wheel-banner"
              value="4" <?php if($a_options['wheel_banner'] == '4') echo 'checked'; ?>
            >
            <label for="wheel_banner5">立方体</label>
            <input
              type="radio"
              id="wheel_banner5"
              name="wheel-banner"
              value="5" <?php if($a_options['wheel_banner'] == '5') echo 'checked'; ?>
            >
            <label for="wheel_banner0">随机</label>
            <input
              type="radio"
              id="wheel_banner0"
              name="wheel-banner"
              value="0" <?php if($a_options['wheel_banner'] == '0' || $a_options['wheel_banner'] == '') echo 'checked'; ?>
            >
          </div>
        </div>

        <div class="row clearfix">
          <label class="fl left-wrap">全局友情链接：</label>
          <div class="fr right-wrap">
            <label for="friendlinks_on">开</label>
            <input
              type="radio"
              id="friendlinks_on"
              name="friend-links"
              value="on" <?php if($a_options['friendlinks'] == 'on') echo 'checked'; ?>
            >
            <label for="friendlinks_off">关</label>
            <input
              type="radio"
              id="friendlinks_off"
              name="friend-links"
              value="off" <?php if($a_options['friendlinks'] == 'off' || $a_options['friendlinks'] == '') echo 'checked'; ?>
            >
            <span class="warn">*默认只在首页侧边栏展示友情链接，开启后所有页面都会展示</span>
          </div>
        </div>

        <div class="row clearfix">
          <label class="fl left-wrap">登录注册入口：</label>
          <div class="fr right-wrap">
            <label for="reg-flake_on">开</label>
            <input
              type="radio"
              id="reg-flake_on"
              name="logo-flake"
              value="on" <?php if($a_options['login_reg'] == 'on') echo 'checked'; ?>
            >
            <label for="reg-flake_off">关</label>
            <input
              type="radio"
              id="reg-flake_off"
              name="logo-flake"
              value="off" <?php if($a_options['login_reg'] == 'off' || $a_options['login_reg'] == '') echo 'checked'; ?>
            >
          </div>
        </div>

        <div class="row clearfix">
          <label class="fl left-wrap">雪花背景特效：</label>
          <div class="fr right-wrap">
            <label for="snow-flake_on">开</label>
            <input
              type="radio"
              id="snow-flake_on"
              name="snow-flake"
              value="on" <?php if($a_options['snowflake'] == 'on') echo 'checked'; ?>
            >
            <label for="snow-flake_off">关</label>
            <input
              type="radio"
              id="snow-flake_off"
              name="snow-flake"
              value="off" <?php if($a_options['snowflake'] == 'off' || $a_options['snowflake'] == '') echo 'checked'; ?>
            >
          </div>
        </div>

        <div class="row clearfix">
          <label class="fl left-wrap">侧边栏站点统计：</label>
          <div class="fr right-wrap">
            <label for="aside-count-on">开</label>
            <input
              type="radio"
              id="aside-count-on"
              name="aside-count"
              value="on" <?php if($a_options['aside_count'] == 'on') echo 'checked'; ?>
            >
            <label for="aside-count-off">关</label>
            <input
              type="radio"
              id="aside-count-off"
              name="aside-count"
              value="off" <?php if($a_options['aside_count'] == 'off' || $a_options['aside_count'] == '') echo 'checked'; ?>
            >
          </div>
        </div>

        <div class="row clearfix">
          <label class="fl left-wrap">电子邮件订阅：</label>
          <div class="fr right-wrap">
            <label for="text-pic-on">开</label>
            <input
              type="radio"
              id="text-pic-on"
              name="text-pic"
              value="on" <?php if($a_options['text_pic'] == 'on') echo 'checked'; ?>
            >
            <label for="text-pic-off">关</label>
            <input
              type="radio"
              id="text-pic-off"
              name="text-pic"
              value="off" <?php if($a_options['text_pic'] == 'off' || $a_options['text_pic'] == '') echo 'checked'; ?>
            >
            <span class="warn">*开启之前必须确保已安装WP Easy Post Mailer插件，并已配置好</span>
          </div>
        </div>

        <div class="row clearfix">
          <label class="fl left-wrap">开启https：</label>
          <div class="fr right-wrap">
            <label for="switch-https-on">开</label>
            <input
              type="radio"
              id="switch-https-on"
              name="switch_https"
              value="on" <?php if($a_options['switch_https'] == 'on') echo 'checked'; ?>
            >
            <label for="switch-https-off">关</label>
            <input
              type="radio"
              id="switch-https-off"
              name="switch_https"
              value="off" <?php if($a_options['switch_https'] == 'off' || $a_options['switch_https'] == '') echo 'checked'; ?>
            >
            <span class="warn">*开启后所有资源强制以https方式加载，必须确保网站支持https</span>
          </div>
        </div>

        <div class="row clearfix">
          <label class="fl left-wrap">侧边栏视频：</label>
          <div class="fr right-wrap">
            <label for="video_on">开</label>
            <input
              class="video_on"
              type="radio"
              id="video_on"
              name="side_video"
              value="on" <?php if($a_options['side_video'] == 'on') echo 'checked'; ?>
            >
            <label for="video_off">关</label>
            <input
              class="video_off"
              type="radio"
              id="video_off"
              name="side_video"
              value="off" <?php if($a_options['side_video'] == 'off' || $a_options['side_video'] == '') echo 'checked'; ?>
            >
          </div>
        </div>

        <div class="row clearfix row_content border_none" style="display:none">
          <div class="row clearfix border_none" >
            <label for="video-url" class="fl left-wrap">视频播放地址：</label>
            <div class="fixed-wrap">
              <input
                type="text"
                class="url-inp"
                name="video_url"
                id="video-url"
                value="<?php echo $a_options['video_url']; ?>"
              >
              <span class="warn">*请写入.mp4视频文件地址</span>
            </div>
          </div>

          <div class="row clearfix">
            <div class="margin-top-15 clearfix">
              <label class="fl left-wrap" for="">视频封面图片：</label>
              <div class="fixed-wrap">
                <input
                  type="text"
                  class="url-inp"
                  name="video_cover"
                  id="video_cover"
                  value="<?php echo $a_options['video_cover']; ?>"
                >
                <input type="button" name="img-upload" value="选择文件">
              </div>
            </div>
            <div class="margin-top-15 clearfix">
              <div class="fl left-wrap">
                视频封面图片预览：
              </div>
              <div class="fr right-wrap">
                <img src="<?php echo $a_options['video_cover']; ?>" class="preview-img" style="max-width: 100px;" alt="">
                <span class="warn" style="display:block">*封面最佳尺寸308*174</span>
              </div>
            </div>
          </div>
        </div>

        <div class="row clearfix">
          <label for="sidebar-notice" class="fl left-wrap">侧边栏公告：</label>
          <div class="fr right-wrap">
            <textarea id="sidebar-notice" name="sidebar-notice" rows="2" cols="100"><?php echo $a_options['sidebar_notice']; ?></textarea>
          </div>
        </div>

        <div class="row clearfix">
          <label class="fl left-wrap">侧边栏热门标签</label>
          <div class="fr right-wrap">
            <label for="popular_on">开</label>
            <input
              class="popular_on"
              type="radio"
              id="popular_on"
              name="popular"
              value="on" <?php if($a_options['popular'] == 'on') echo 'checked'; ?>
            >
            <label for="popular_off">关</label>
            <input
              class="popular_off"
              type="radio"
              id="popular_off"
              name="popular"
              value="off" <?php if($a_options['popular'] == 'off' || $a_options['popular'] == '') echo 'checked'; ?>
            >
            <span class="warn">*开启后可自定义结构，以便于你更好的维护自己收藏的工具链接</span>
          </div>
        </div>

        <div class="row clearfix popular_show" style="display:none">
          <label class="fl left-wrap" for="custom_label">自定义热门标签：</label>
          <div class="fr right-wrap">
            <textarea id="custom_label" name="custom_label" rows="8" cols="100" placeholder="例如：<a href='https://www.weipxiu.com'>唯品秀前端技术博客</a>"><?php echo $a_options['custom_label']; ?></textarea>
            <span class="warn" style="display:block">*每条链接占一行</span>
          </div>
        </div>

        <div class="row clearfix">
          <label for="footer-copyright" class="fl left-wrap">底部版权信息：</label>
          <div class="fr right-wrap">
            <textarea id="footer-copyright" name="footer-copyright" rows="8" cols="100"><?php echo $a_options['footer_copyright']; ?></textarea>
          </div>
        </div>
      </div>
      <!-- 内容二 SEO -->
      <div class="content-wrap content2">
        <div class="row clearfix">
          <label for="keywords" class="fl left-wrap">网站关键词：</label>
          <div class="fr right-wrap">
            <textarea id="keywords" name="keywords" rows="8" cols="100"><?php echo $a_options['keywords'] ?></textarea>
          </div>
        </div>
        <div class="row clearfix">
          <label for="description" class="fl left-wrap">网站描述：</label>
          <div class="fr right-wrap">
            <textarea id="description" name="description" rows="8" cols="100"><?php echo $a_options['description'] ?></textarea>
          </div>
        </div>
      </div>
			<!-- 内容三 图片设置 -->
      <div class="content-wrap content3">
        <div class="row">
          <div class="margin-top-15 clearfix">
            <label class="fl left-wrap" for="">前台Logo：</label>
            <div class="fr right-wrap">
              <input
                type="text"
                class="url-inp"
                name="logo"
                id="logo"
                value="<?php echo $a_options['logo']; ?>"
              >
              <input type="button" name="img-upload" value="选择文件">
            </div>
          </div>
          <div class="margin-top-15 clearfix">
            <div class="fl left-wrap">
              前台Logo预览：
            </div>
            <div class="fr right-wrap">
              <img src="<?php echo $a_options['logo']; ?>" class="preview-img" style="max-width: 100px;" alt="">
              <span class="warn" style="display:block">*前台Logo最佳尺寸135*45（如若感觉不够清晰，可使用2倍尺寸图片，即270*90）</span>
            </div>
          </div>
        </div>

				<div class="row">
          <div class="margin-top-15 clearfix">
            <label class="fl left-wrap" for="">浏览器标签Logo：</label>
            <div class="fr right-wrap">
              <input
                type="text"
                class="url-inp"
                name="label-logo"
                id="label-logo"
                value="<?php echo $a_options['label_logo']; ?>"
              >
              <input type="button" name="img-upload" value="选择文件">
            </div>
          </div>
          <div class="margin-top-15 clearfix">
            <div class="fl left-wrap">
              标签图标预览：
            </div>
            <div class="fr right-wrap">
              <img src="<?php echo $a_options['label_logo']; ?>" class="preview-img" style="max-width: 100px;" alt="">
              <span class="warn" style="display:block">*浏览器标签窗口图标，最佳尺寸16*16或32*32</span>
            </div>
          </div>
        </div>

				<div class="row">
          <div class="margin-top-15 clearfix">
						<label class="fl left-wrap" for="">默认缩略图：</label>
            <div class="fr right-wrap">
              <input
                type="text"
                class="url-inp"
								name="thumbnail-img"
                id="thumbnail-img"
                value="<?php echo $a_options['thumbnail']; ?>">
              <input type="button" name="img-upload" value="选择文件">
            </div>
          </div>
          <div class="margin-top-15 clearfix">
            <div class="fl left-wrap">
              默认缩略图预览：
            </div>
            <div class="fr right-wrap">
              <img src="<?php echo $a_options['thumbnail']; ?>" class="preview-img" style="max-width: 100px;" alt="">
              <span class="warn" style="display:block">*默认信息流缩略图最佳尺寸220*140，展示规则：先取文章中设置的特色图片，如果没有，取文章内容首张图片，再没有将启用当前默认缩略图</span>
            </div>
          </div>
        </div>

        <div class="row" style="display:none">
          <div class="margin-top-15 clearfix">
            <label class="fl left-wrap" for="">banner大图：</label>
            <div class="fr right-wrap">
              <input
                type="text"
                class="url-inp"
                name="big-banner"
                id="big-banner"
                value="<?php echo $a_options['banner']['big_banner']['path']; ?>"
              >
              <input type="button" name="img-upload" value="选择文件">
            </div>
          </div>
          <div class="margin-top-15 clearfix">
            <label class="fl left-wrap" for="">banner标题：</label>
            <div class="fr right-wrap">
              <input
                type="text"
                class="url-inp"
                name="big-banner-text"
                id="big-banner-text"
                value="<?php echo $a_options['banner']['big_banner']['text']; ?>"
              >
            </div>
          </div>
          <div class="margin-top-15 clearfix">
            <label class="fl left-wrap" for="">banner链接：</label>
            <div class="fr right-wrap">
              <input
                type="text"
                class="url-inp"
                name="big-banner-link"
                id="big-banner-link"
                value="<?php echo $a_options['banner']['big_banner']['link']; ?>"
              >
            </div>
          </div>
          <div class="margin-top-15 clearfix">
            <div class="fl left-wrap">
              banner大图预览：
            </div>
            <div class="fr right-wrap">
              <img src="<?php echo $a_options['banner']['big_banner']['path']; ?>" class="preview-img" style="max-width: 400px; max-height: 200px;" alt="">
            </div>
          </div>
        </div>
				<?php
					for ($i = 1; $i < 4; $i++) {
				?>
					<div class="row" style="display:none">
	          <div class="margin-top-15 clearfix">
	            <label class="fl left-wrap" for="">banner<?php echo $i; ?>：</label>
	            <div class="fr right-wrap">
	              <input
	                type="text"
	                class="url-inp"
	                name="small-banner-<?php echo $i; ?>"
	                id="small-banner-<?php echo $i; ?>"
	                value="<?php echo $a_options['banner']['small_banner']['banner'. $i]['path']; ?>"
	              >
	              <input type="button" name="img-upload" value="选择文件">
	            </div>
	          </div>
	          <div class="margin-top-15 clearfix">
	            <label class="fl left-wrap" for="">banner<?php echo $i; ?>标题：</label>
	            <div class="fr right-wrap">
	              <input
	                type="text"
	                class="url-inp"
	                name="small-banner-text-<?php echo $i; ?>"
	                id="small-banner-text-<?php echo $i; ?>"
	                value="<?php echo $a_options['banner']['small_banner']['banner'. $i]['text']; ?>"
	              >
	            </div>
	          </div>
	          <div class="margin-top-15 clearfix">
	            <label class="fl left-wrap" for="">banner<?php echo $i; ?>链接：</label>
	            <div class="fr right-wrap">
	              <input
	                type="text"
	                class="url-inp"
	                name="small-banner-link-<?php echo $i; ?>"
	                id="small-banner-link-<?php echo $i; ?>"
	                value="<?php echo $a_options['banner']['small_banner']['banner'. $i]['link']; ?>"
	              >
	            </div>
	          </div>
	          <div class="margin-top-15 clearfix">
	            <div class="fl left-wrap">
	              banner<?php echo $i; ?>大图预览：
	            </div>
	            <div class="fr right-wrap">
	              <img src="<?php echo $a_options['banner']['small_banner']['banner'. $i]['path']; ?>" class="preview-img" style="max-width: 400px; max-height: 200px;" alt="">
	            </div>
	          </div>
	        </div>
				<?php
					}
				?>

      </div>
      <!-- 内容四 社交 -->
      <div class="content-wrap content4">
        <div class="row clearfix">
          <label for="QQ-number" class="fl left-wrap">QQ账号：</label>
          <div class="fr right-wrap">
						<input
							type="text"
							class="url-inp"
							name="QQ-number"
							id="QQ-number"
							value="<?php echo $a_options['QQ-number']; ?>"
						>
          </div>
        </div>

        <div class="row clearfix">
          <label for="phone-number" class="fl left-wrap">手机号码：</label>
          <div class="fr right-wrap">
						<input
							type="text"
							class="url-inp"
							name="phone-number"
							id="phone-number"
							value="<?php echo $a_options['phone-number']; ?>"
						>
          </div>
        </div>

        <div class="row">
          <div class="margin-top-15 clearfix">
            <label class="fl left-wrap" for="">微信账号二维码：</label>
            <div class="fr right-wrap">
              <input
                type="text"
                class="url-inp"
                name="weChat-number"
                id="weChat-number"
                value="<?php echo $a_options['weChat-number']; ?>"
              >
              <input type="button" name="img-upload" value="选择文件">
            </div>
          </div>
          <div class="margin-top-15 clearfix">
            <div class="fl left-wrap">
              微信二维码预览：
            </div>
            <div class="fr right-wrap">
              <img src="<?php echo $a_options['weChat-number']; ?>" class="preview-img" style="max-width: 100px;" alt="">
            </div>
          </div>
        </div>

				<div class="row clearfix">
          <label for="reward-text" class="fl left-wrap">打赏欢迎语：</label>
          <div class="fr right-wrap">
						<input
							type="text"
							class="url-inp"
							name="reward-text"
							id="reward-text"
							value="<?php echo $a_options['reward_text']; ?>"
						>
          </div>
        </div>

				<div class="row">
          <div class="margin-top-15 clearfix">
            <label class="fl left-wrap" for="">支付宝收账二维码：</label>
            <div class="fr right-wrap">
              <input
                type="text"
                class="url-inp"
                name="alipay"
                id="alipay"
                value="<?php echo $a_options['alipay']; ?>"
              >
              <input type="button" name="img-upload" value="选择文件">
            </div>
          </div>
          <div class="margin-top-15 clearfix">
            <div class="fl left-wrap">
              收账二维码预览：
            </div>
            <div class="fr right-wrap">
              <img src="<?php echo $a_options['alipay']; ?>" class="preview-img" style="max-width: 100px;" alt="">
            </div>
          </div>
        </div>

				<!-- 微信付款二维码 -->
				<div class="row">
					<!-- 支付宝付款二维码 -->
          <div class="margin-top-15 clearfix">
            <label class="fl left-wrap" for="">微信收账二维码：</label>
            <div class="fr right-wrap">
              <input
                type="text"
                class="url-inp"
                name="wechatpay"
                id="wechatpay"
                value="<?php echo $a_options['wechatpay']; ?>"
              >
              <input type="button" name="img-upload" value="选择文件">
            </div>
          </div>
          <div class="margin-top-15 clearfix">
            <div class="fl left-wrap">
              收账二维码预览：
            </div>
            <div class="fr right-wrap">
              <img src="<?php echo $a_options['wechatpay']; ?>" class="preview-img" style="max-width: 100px;" alt="">
            </div>
          </div>
        </div>
      </div>
      <!-- 内容五 自定义代码 -->
      <!-- <div class="content-wrap content5">
        <div class="row clearfix">
          <label class="fl left-wrap" for="login-css">后台登录页面css（不需要style标签）：</label>
          <div class="fr right-wrap">
            <textarea id="login-css" name="login-css" rows="8" cols="100"><?php echo $a_options['login_css']; ?></textarea>
          </div>
        </div>
				<div class="row clearfix">
          <label class="fl left-wrap" for="details-css">文章详情页css（不需要style标签）：</label>
          <div class="fr right-wrap">
            <textarea id="details-css" name="details-css" rows="8" cols="100"><?php echo $a_options['details_css']; ?></textarea>
          </div>
        </div>
      </div> -->
      <div class="row btn-wrap">
        <input type="submit" class="submit-btn" name="bcn-admin-options" value="保存更改">
      </div>
    </form>
  </div>
  <script src="<?php bloginfo('template_url'); ?>/include/js/set.js"></script>
<?php
	}
	function themeoptions_update() {
    // 数据提交,key对应页面选中的key，_POST对应name
    $options = array(
      'update_themeoptions' => 'true',
      'wheel_banner' => $_POST['wheel-banner'],
      'label_logo' => $_POST['label-logo'],
      'popular' => $_POST['popular'],
      'login_reg' => $_POST['logo-flake'],
      'snowflake' => $_POST['snow-flake'],
      'friendlinks' => $_POST['friend-links'],
      'aside_count' => $_POST['aside-count'],
      'switch_https' => $_POST['switch_https'],
      'side_video' => $_POST['side_video'],
      'video_url' => $_POST['video_url'],
      'video_cover' => $_POST['video_cover'],
      'text_pic' => $_POST['text-pic'],
      'logo' => $_POST['logo'],
      'thumbnail' => $_POST['thumbnail-img'],
      'sidebar_notice' => $_POST['sidebar-notice'],
      'footer_copyright' => $_POST['footer-copyright'],
      'login_css'  => $_POST['login-css'],
      'details_css'  => $_POST['details-css'],
      'keywords' => $_POST['keywords'],
      'description' => $_POST['description'],
      'custom_label' => $_POST['custom_label'],
      'QQ-number' => $_POST['QQ-number'],
      'weChat-number' => $_POST['weChat-number'],
      'phone-number' => $_POST['phone-number'],
      'reward_text' => $_POST['reward-text'],
      'alipay' => $_POST['alipay'],
      'wechatpay' => $_POST['wechatpay'],
			'banner' => array(
				'big_banner' => array(
					'path' => $_POST['big-banner'],
					'text' => $_POST['big-banner-text'],
					'link' => $_POST['big-banner-link'],
				),
				'small_banner' => array(
					'banner1' => array(
						'path' => $_POST['small-banner-1'],
						'text' => $_POST['small-banner-text-1'],
						'link' => $_POST['small-banner-link-1'],
					),
					'banner2' => array(
						'path' => $_POST['small-banner-2'],
						'text' => $_POST['small-banner-text-2'],
						'link' => $_POST['small-banner-link-2'],
					),
					'banner3' => array(
						'path' => $_POST['small-banner-3'],
						'text' => $_POST['small-banner-text-3'],
						'link' => $_POST['small-banner-link-3'],
					)
				)
			)
    );
    update_option('weipxiu_options', stripslashes_deep($options));
	}
	add_action('admin_menu', 'themeoptions_admin_menu');
?>
