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
  // media-upload、thickbox、my-upload
  wp_enqueue_script('thickbox');
  //加载css(wp自带)
  wp_enqueue_style('thickbox');
?>
  <link rel="stylesheet" href="<?php echo esc_url(get_template_directory_uri()); ?>/include/css/style.css">
  <div class="wrap">
    <h2>唯品秀主题设置</h2>
    <ul class="nav-wrap clearfix">
      <li class="nav-list on">基础</li>
      <li class="nav-list">SEO</li>
      <li class="nav-list">图片</li>
      <li class="nav-list">社交</li>
      <li class="nav-list">样式</li>
      <li class="nav-list">时光机</li>
    </ul>
    <form method="post" action="">
      <input type="hidden" name="update_themeoptions" value="true">
      <!-- 内容一 基本 -->
      <div class="content-wrap content1">
        <div class="row clearfix">
          <label class="fl left-wrap">桌面轮播效果：</label>
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
          <label class="fl left-wrap">全站置灰哀悼：</label>
          <div class="fr right-wrap">
            <label for="mourning_on">开</label>
            <input
              type="radio"
              id="mourning_on"
              name="mourning"
              value="on" <?php if($a_options['mourning'] == 'on') echo 'checked'; ?>
            >
            <label for="mourning_off">关</label>
            <input
              type="radio"
              id="mourning_off"
              name="mourning"
              value="off" <?php if($a_options['mourning'] == 'off' || $a_options['mourning'] == '') echo 'checked'; ?>
            >
            <span class="warn">*该选项用于国际社会等突发重大事件进行哀悼活动</span>
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
            <span class="warn">*默认仅首页展示友情链接，开启后所有页面皆展示</span>
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
            <span class="warn">*非登陆状态下，移动端侧边栏展示，PC仅首页展示</span>
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
          <label class="fl left-wrap">站点信息统计：</label>
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
          <label class="fl left-wrap">电子邮箱订阅：</label>
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
            <span class="warn">*开启之前必须确保已安装WP Easy Post Mailer插件，并已配置好；部分网站无法发送邮件还需要借助wp-mail-smtp插件</span>
          </div>
        </div>

        <div class="row clearfix">
          <label class="fl left-wrap">HTTPS安全项：</label>
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
            <span class="warn">*所有资源强制以https方式加载，必须确保网站支持https</span>
          </div>
        </div>

        <div class="row clearfix">
          <label for="replace-skin" class="fl left-wrap">更换主题色调：</label>
          <div class="fr right-wrap">
            <input
                type="text"
                class="url-inp"
                name="replace-skin"
                id="replace-skin"
                value="<?php echo $a_options['replace_skin']; ?>"
                placeholder="请输入主题颜色值"
              >
              <input type="color" name="color" id="colorPicker" value="<?php if ($a_options['replace_skin']) {echo $a_options['replace_skin'];} else {echo "#1890ff";}?>">
            <span class="warn">*可输入任意颜色格式，例如：#ed145b、red、rgba(0,0,0,.5)，默认或低端浏览器不支持情况下展示颜色值：#1890ff（Daybreak Blue / 拂晓蓝）</span>
          </div>
        </div>

        <div class="row clearfix">
          <label class="fl left-wrap">侧边视频宣传：</label>
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
            <div class="fixed-wrap fr right-wrap">
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
              <div class="fixed-wrap fr right-wrap">
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
                视频封面预览：
              </div>
              <div class="fr right-wrap">
                <img src="<?php echo $a_options['video_cover']; ?>" class="preview-img" style="max-width: 100px;" alt="">
                <span class="warn" style="display:block">*封面最佳尺寸308*174（如若感觉不够清晰，可使用2倍尺寸图片）</span>
              </div>
            </div>
          </div>
        </div>

        <div class="row clearfix">
          <label for="key-word" class="fl left-wrap">Logo旁关键词：</label>
          <div class="fr right-wrap">
            <textarea id="key-word" name="key-word" rows="3" cols="100" placeholder="例如：&#10;&lt;p&gt;关注前端开发&lt;/p&gt;&#10;&lt;p&gt;Html5、Vue、Node、Koa&lt;/p&gt;"><?php echo $a_options['key_word']; ?></textarea>
            <span class="warn">*展示在PC端logo右侧的关键词、座右铭或经典语录</span>
          </div>
        </div>

        <div class="row clearfix">
          <label for="sidebar-notice" class="fl left-wrap">桌面侧边公告：</label>
          <div class="fr right-wrap">
            <textarea id="sidebar-notice" name="sidebar-notice" rows="3" cols="100"><?php echo $a_options['sidebar_notice']; ?></textarea>
          </div>
        </div>

        <div class="row clearfix">
          <label class="fl left-wrap">侧边热门标签：</label>
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
            <span class="warn">*默认取文章标签列表，可自定义内容，以便于你更好的维护自己收藏的工具链接</span>
          </div>
        </div>

        <div class="row clearfix popular_show" style="display:none">
          <label class="fl left-wrap" for="custom_label"></label>
          <div class="fr right-wrap">
            <textarea id="custom_label" name="custom_label" rows="8" cols="100" placeholder="例如：&#10;&lt;a href=&#x27;https://www.weipxiu.com&#x27;&gt;唯品秀前端技术博客&lt;/a&gt;"><?php echo $a_options['custom_label']; ?></textarea>
            <span class="warn" style="display:block">*每条链接占一行，中间不需要逗号","衔接</span>
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
            <textarea id="keywords" name="keywords" rows="5" cols="100" placeholder="关键词字数关键词字数最好控制在5个左右，每个长度最好别超过8个汉字！"><?php echo $a_options['keywords'] ?></textarea>
          </div>
        </div>
        <div class="row clearfix">
          <label for="description" class="fl left-wrap">网站描述信息：</label>
          <div class="fr right-wrap">
            <textarea id="description" name="description" rows="5" cols="100"  placeholder="网站描述字数网站描述尽量空制在80个汉字以内,160个字符之间!"><?php echo $a_options['description'] ?></textarea>
          </div>
        </div>
        <div class="row clearfix">
          <label for="baidu-statistics" class="fl left-wrap">百度统计代码：</label>
          <div class="fr right-wrap">
            <textarea id="baidu-statistics" name="baidu-statistics" rows="10" cols="100" placeholder="用于分析网站流量"><?php echo $a_options['baidu_statistics'] ?></textarea>
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
              <span class="warn" style="display:block">*前台Logo最佳尺寸135*45（如若感觉不够清晰，可使用2倍尺寸图片）</span>
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
              <span class="warn" style="display:block">*默认信息流缩略图最佳尺寸220*140，展示规则：特色图片 > 内容首张图片 > 默认缩略图</span>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="margin-top-15 clearfix">
						<label class="fl left-wrap" for="">默认PC_Banner图：</label>
            <div class="fr right-wrap">
              <input
                type="text"
                class="url-inp"
								name="pc_banner_default"
                id="pc_banner_default"
                value="<?php echo $a_options['pc_banner_default']; ?>">
              <input type="button" name="img-upload" value="选择文件">
            </div>
          </div>
          <div class="margin-top-15 clearfix">
            <div class="fl left-wrap">
              默认Banner图预览：
            </div>
            <div class="fr right-wrap">
              <img src="<?php echo $a_options['pc_banner_default']; ?>" class="preview-img" style="max-width: 100px;" alt="">
              <span class="warn" style="display:block">*PC端默认banner图最佳尺寸1200*300，如果不配置，PC轮播初始化后、正式播放之前页面将出现几秒钟的空白真空状态</span>
            </div>
          </div>
        </div>

        <div class="row clearfix">
          <label class="fl left-wrap" for="pc_banner">PC端Banner图：</label>
          <div class="fr right-wrap">
            <textarea id="pc_banner" name="pc_banner" rows="8" cols="100" placeholder="例如：&#10;[{url:'图片地址',link:'跳转地址'}]"><?php echo $a_options['pc_banner']; ?></textarea>
            <span class="warn" style="display:block">*PC轮播图最佳尺寸：1200*300，多组数据用,分开，<a target="_blank" href="<?php echo esc_url(get_template_directory_uri()); ?>/include/js/pc_slide.js">示例数据</a></span>
          </div>
        </div>

        <div class="row clearfix">
          <label class="fl left-wrap" for="pc_rotateNav_content">3D导航-左侧大图：</label>
          <div class="fr right-wrap">
            <textarea id="pc_rotateNav_content" name="pc_rotateNav_content" rows="5" cols="100" placeholder="例如：&#10;点击下方查看'示例数据'"><?php echo $a_options['pc_rotateNav_content']; ?></textarea>
            <span class="warn" style="display:block">*PC轮播下方3D导航，指定左侧区域单图信息<a target="_blank" href="<?php echo esc_url(get_template_directory_uri()); ?>/include/js/nav_left.json" >示例数据</a>，<span style="color:red">发现乱码请换个浏览器查看</span></span>
          </div>
        </div>

        <div class="row clearfix">
          <label class="fl left-wrap" for="rotateNav_content">3D导航详细数据：</label>
          <div class="fr right-wrap">
            <textarea id="rotateNav_content" name="rotateNav_content" rows="10" cols="100" placeholder="例如：&#10;点击下方查看'示例数据'"><?php echo $a_options['rotateNav_content']; ?></textarea>
            <span class="warn" style="display:block">*PC轮播下方3D导航，规则为：左侧一张大图，右侧分上下两栏，每个栏目4个小模块，每个栏目其中任意(仅)一个模块可指定为较大图，<a target="_blank" href="<?php echo esc_url(get_template_directory_uri()); ?>/include/js/nav.json" >示例数据</a>，<span style="color:red">发现乱码请换个浏览器查看</span></span>
          </div>
        </div>

        <div class="row clearfix">
          <label class="fl left-wrap" for="mobile_banner">移动端Banner图：</label>
          <div class="fr right-wrap">
            <textarea id="mobile_banner" name="mobile_banner" rows="8" cols="100" placeholder="例如：&#10;点击下方查看'示例数据'"><?php echo $a_options['mobile_banner']; ?></textarea>
            <span class="warn" style="display:block">*强调，该处数据格式特殊，<a target="_blank" href="<?php echo esc_url(get_template_directory_uri()); ?>/include/js/mobile_slide.json">示例数据</a>，<span style="color:red">发现乱码请换个浏览器查看</span>，注意双引号以及在目录层级前需要加<span style="color:red">反斜杠\</span></span>
          </div>
        </div>
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
          <label for="wangwang-link" class="fl left-wrap">旺旺链接：</label>
          <div class="fr right-wrap">
						<input
							type="text"
							class="url-inp"
							name="wangwang-link"
							id="wangwang-link"
              placeholder="https://amos.alicdn.com/getcid.aw?&uid=xxx"
							value="<?php echo $a_options['wangwang-link']; ?>"
						>
            <span class="warn">*只需要旺旺的http链接，不需要a标签</span>
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

        <div class="row clearfix">
          <label for="leaving-message" class="fl left-wrap">留言板寄语：</label>
          <div class="fr right-wrap">
            <textarea id="leaving-message" name="leaving-message" rows="5" cols="100" placeholder="例如：&#10;&lt;p&gt;留言板寄语&lt;/p&gt;"><?php echo $a_options['leaving_message'] ?></textarea>
          </div>
        </div>
      </div>

      <!-- 内容五 自定义样式 -->
      <div class="content-wrap content5">
        <div class="row clearfix">
          <label for="details-css" class="fl left-wrap">前台页面样式：</label>
          <div class="fr right-wrap">
            <textarea id="details-css" name="details-css" rows="8" cols="100"><?php echo $a_options['details_css'] ?></textarea>
            <span class="warn">*无需style标签，支持媒体查询，个别样式无法覆盖情况下可以加!important权重，仅供熟悉css用户使用，不懂的请忽略</span>
          </div>
        </div>
        <div class="row clearfix">
          <label for="login-css" class="fl left-wrap">登录注册样式：</label>
          <div class="fr right-wrap">
            <textarea id="login-css" name="login-css" rows="8" cols="100"><?php echo $a_options['login_css'] ?></textarea>
            <span class="warn">*无需style标签，支持媒体查询，个别样式无法覆盖情况下可以加!important权重，仅供熟悉css用户使用，不懂的请忽略</span>
          </div>
        </div>
      </div>

      <!-- 内容六 时光机 -->
      <div class="content-wrap content5">
      <div class="row">
          <div class="margin-top-15 clearfix">
            <label class="fl left-wrap" for="">头像：</label>
            <div class="fr right-wrap">
              <input
                type="text"
                class="url-inp"
                name="time-portrait"
                id="time-portrait"
                value="<?php echo $a_options['time_portrait']; ?>"
              >
              <input type="button" name="img-upload" value="选择文件">
            </div>
          </div>
          <div class="margin-top-15 clearfix">
            <div class="fl left-wrap">
              头像预览：
            </div>
            <div class="fr right-wrap">
              <img src="<?php echo $a_options['time_portrait']; ?>" class="preview-img" style="max-width: 50px;" alt="">
            </div>
          </div>
        </div>

        <div class="row clearfix">
          <label for="time-machine" class="fl left-wrap">数据：</label>
          <div class="fr right-wrap">
            <textarea id="time-machine" name="time-machine" rows="20" cols="100" placeholder="例如：&#10;[{time: '时间', text:'文案'}]"><?php echo $a_options['time_machine'] ?></textarea>
            <span class="warn">*该功能仅供作者使用，暂不对外开放，如有需要，自行更改源码获取拓展
            </span>
          </div>
        </div>
      </div>

      <div class="row btn-wrap">
        <input type="submit" class="submit-btn" name="bcn-admin-options" value="保存更改">
      </div>
    </form>
  </div>
  <script src="<?php echo esc_url(get_template_directory_uri()); ?>/include/js/set.js"></script>
<?php
	}
	function themeoptions_update() {
    // 数据提交,key对应最终保存以及展示值，$_POST对应name
    $options = array(
      'update_themeoptions' => 'true',
      'wheel_banner' => $_POST['wheel-banner'],
      'mourning' => $_POST['mourning'],
      'label_logo' => $_POST['label-logo'],
      'popular' => $_POST['popular'],
      'login_reg' => $_POST['logo-flake'],
      'snowflake' => $_POST['snow-flake'],
      'friendlinks' => $_POST['friend-links'],
      'aside_count' => $_POST['aside-count'],
      'switch_https' => $_POST['switch_https'],
      'replace_skin' => $_POST['replace-skin'],
      'side_video' => $_POST['side_video'],
      'video_url' => $_POST['video_url'],
      'video_cover' => $_POST['video_cover'],
      'text_pic' => $_POST['text-pic'],
      'logo' => $_POST['logo'],
      'thumbnail' => $_POST['thumbnail-img'],
      'key_word' => $_POST['key-word'],
      'sidebar_notice' => $_POST['sidebar-notice'],
      'footer_copyright' => $_POST['footer-copyright'],
      'login_css'  => $_POST['login-css'],
      'leaving_message'  => $_POST['leaving-message'],
      'details_css'  => $_POST['details-css'],
      'time_portrait'  => $_POST['time-portrait'],
      'time_machine'  => $_POST['time-machine'],
      'keywords' => $_POST['keywords'],
      'description' => $_POST['description'],
      'baidu_statistics' => $_POST['baidu-statistics'],
      'custom_label' => $_POST['custom_label'],
      'pc_banner_default' => $_POST['pc_banner_default'],
      'pc_banner' => $_POST['pc_banner'],
      'pc_rotateNav_content' => $_POST['pc_rotateNav_content'],
      'rotateNav_content' => $_POST['rotateNav_content'],
      'mobile_banner' => $_POST['mobile_banner'],
      'QQ-number' => $_POST['QQ-number'],
      'wangwang-link' => $_POST['wangwang-link'],
      'weChat-number' => $_POST['weChat-number'],
      'phone-number' => $_POST['phone-number'],
      'reward_text' => $_POST['reward-text'],
      'alipay' => $_POST['alipay'],
      'wechatpay' => $_POST['wechatpay']
    );
    update_option('weipxiu_options', stripslashes_deep($options));
	}
	add_action('admin_menu', 'themeoptions_admin_menu');
?>
