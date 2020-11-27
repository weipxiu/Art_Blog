<!DOCTYPE html>
<html lang="en">

<head>
<meta name='generator' content='WordPress/Art_Blog v2020-11-27 15:50:07'>
<title><?php $name = wp_title( '-', true, 'right' );
		if ($name) {
			echo $name . "&nbsp;-&nbsp;" . get_bloginfo('description');
		} else {
			echo get_bloginfo('name');
		}?>
</title>
<link rel="stylesheet" type="text/css" href="<?php echo esc_url(get_template_directory_uri()); ?>/css/swiper.min.css">
<?php get_template_part('common'); ?>
</head>

<body>
	<?php get_header(); ?>
	<!-- pc端轮播start -->
	<?php
		if (trim(get_option('weipxiu_options')['pc_banner'])) {
		?>
		<section class="mod-banner" id="js_banner">
			<a href="<?php echo esc_url( home_url() ); ?>" target="_blank" class="mod-banner__img banner_1" id="banner_img" style="background: url('<?php echo get_option('weipxiu_options')['pc_banner_default']; ?>') center center no-repeat;"></a>
			<div class="mod-banner__navi">
				<div class="js_banner_nav mod-banner_nav"></div>
				<span class="mod-banner__nav-dot"><canvas id="dotCanvas"></canvas></span>
			</div>
			<div class="mod-banner__tool">
				<span class="js_banner_prev mod-banner__tool-prev">
					<span class="mod-banner__tool-white"></span>
					<span class="mod-banner__tool-shadow"></span>
				</span>
				<span class="js_banner_next mod-banner__tool-next">
					<span class="mod-banner__tool-white"></span>
					<span class="mod-banner__tool-shadow"></span>
				</span>
			</div>
		</section>
		<?php
	}
	?>
	<!-- pc端轮播end -->

	<!-- 正文区域start -->
	<section class="continar" id="lazycontainer">
		<img class="search_404" src="<?php echo esc_url(get_template_directory_uri()); ?>/images/search_404.png" alt="">
		
			<!--移动端轮播start-->
			<?php
			if (trim(get_option('weipxiu_options')['mobile_banner'])) {
				?>
				<div id="mobil">
					<div class="swiper-container1">
						<div class="swiper-wrapper">
							<?php $mobile_banners = json_decode(get_option('weipxiu_options')['mobile_banner'], true); ?>
							<?php foreach ($mobile_banners as $item) { ?>
									<div class="swiper-slide" style="background:url('<?php echo $item['url']?>') no-repeat center top; background-size:100% 100%"><a href="<?php echo $item['link']?>"></a></div>
							<?php } ?>
						</div>
						<div class="swiper-pagination"></div>
					</div>
				</div>
				<?php
			}
			?>
			<!--移动端轮播end-->

		<div class="continar-left" id="ajax_centent">
			<!-- PC正文3d导航start -->
			<div class="mod-index__feature">
				<div class="img_list_6pic ui-clearfix">
					<!-- 大图 -->
					<?php
					if (trim(get_option('weipxiu_options')['pc_rotateNav_content'])) {
						?>
							<?php $pc_rotateNav_content = json_decode(get_option('weipxiu_options')['pc_rotateNav_content'], true); ?>
									<?php foreach ($pc_rotateNav_content as $item) { ?>
										<div class="img_box">
											<a href="<?php echo $item['link']?>" target="_blank">
												<img src="<?php echo $item['url']?>" width="280" height="180" alt="<?php echo get_bloginfo('name'); ?>" class="ui-d-b">
												<div class="img_bg"></div>
												<div class="img_txt">
													<p class="img_title"><?php echo $item['title']?></p>
												</div>
												<i class="light"></i>
											</a>
										</div>
									<?php } ?>
						<?php
					}
					?>
					<!-- 分栏数据 -->
					<?php
					if (trim(get_option('weipxiu_options')['rotateNav_content'])) {
						?>
						<?php $rotateNav_content = json_decode(get_option('weipxiu_options')['rotateNav_content'], true); ?>
							<?php foreach ($rotateNav_content as $item) { ?>
							<a href="<?php echo $item['link']?>" class="small_pic_wrap carousel_pic_wrap small_pic_wrap_small word_display <?php if ($item['isWide']) { ?>small_pic_wrap_long<?php }?>" target="_blank">
								<div class="carousel_small_str txt_bg01">
									<h3 class="img_txt_title"><?php echo $item['top']?></h3>
									<p class="img_p"><?php echo $item['bot']?></p>
								</div>
								<img class="carousel_small_pic" width="<?php $wide=$item['isWide'];if ($wide) {echo 160;} else {echo 110;}?>" height="85" src="<?php echo $item['url']?>">
							</a>
							<?php } ?>
						<?php
						}
					?>
				</div>
			</div>
			<!-- PC正文3d导航end -->

			<!-- 今日焦点start -->
			<aside class="continar-left-top">
				<?php
				$args = array(
					'post_password' => '',
					'post_status' => 'publish', // 只选公开的文章.
					//'post__not_in' => array($post->ID),//排除当前文章
					'caller_get_posts' => 1, // 排除置頂文章.
					//'orderby' => 'rand', // 依评论数排序.
					'showposts' => 1 // 设置调用条数
				);
				$query_posts = new WP_Query();
				$query_posts->query($args);
				while ($query_posts->have_posts()) {
					$query_posts->the_post(); ?>
					<h1>
						<a href="<?php the_permalink(); ?>" target="_blank">
							<span>【今日焦点】</span>
							<?php the_title(); ?>
							<img src="<?php echo esc_url(get_template_directory_uri()); ?>/images/new.gif" width="26" height="14" alt="24小时内最新" alt="<?php echo get_bloginfo('name'); ?>">
						</a>
					</h1>
					<span>
							<?php if (has_excerpt()) {
									//文章编辑中的摘要
									echo $description = get_the_excerpt(); 
							}else {
									//文章编辑中若无摘要，自定截取文章内容字数做为摘要
									echo mb_strimwidth(strip_tags(apply_filters('the_content', $post->post_content)), 0, 300,"..."); 
							} ?>
					</span>
				<?php }
			wp_reset_query(); ?>
			</aside>
			<!-- 今日焦点end -->

			<!-- 邮件订阅start -->
			<?php
			if (get_option('weipxiu_options')['text_pic'] == 'on') {
					?>
					<div class="inner-box">
						<div class="rssbook">
							<h3 class="info">您也可以通过电子邮件订阅每日的更新，不定时为您推送优质文章</h3>
							<p>我们不会公开您的邮箱，您可以随时取消订阅</p>
							<div class="mailInput">
								<?php echo wpm_form(1); ?>
							</div>
						</div>
					</div>
				<?php
			}
			?>
			<!-- 邮件订阅end -->

			<!-- 文章start -->
			<!-- 单独强制限制首页渲染多页渲染多少列表数据 -->
			<!-- <?php /*$posts = query_posts($query_string . '&orderby=date&showposts=12'); ?>
			<?php
			if(have_posts()): while(have_posts()):the_post();*/
			?> -->

				<?php
				if(have_posts()): while(have_posts()):the_post();
				?>
					<article class="text">
						<div class="mod-category__article-time">
							<span><?php the_time('d') ?></span>
							<span><?php the_time('Y-m') ?></span>
						</div>
						<div class="img-left">
							<a class="read-more" href="<?php the_permalink(); ?>" target="_blank">
								<?php echo _get_post_thumbnail(); ?>
							</a>
						</div>
						<div class="text_right">
							<h2>
								<span>
									<?php the_category() ?><i></i></span>
								<a href="<?php the_permalink(); ?>" target="_blank">
									<?php the_title(); ?></a>
							</h2>
							<?php echo _get_post_thumbnail(); ?>
							<h3>
									<?php if (has_excerpt()) {
											//文章编辑中的摘要
											echo $description = get_the_excerpt(); 
									}else {
											//文章编辑中若无摘要，自定截取文章内容字数做为摘要
											echo mb_strimwidth(strip_tags(apply_filters('the_content', $post->post_content)), 0, 190,"..."); 
									} ?>
							</h3>
							<a class="read-more read_url" href="<?php the_permalink(); ?>" target="_blank">阅读全文<i class="iconfont icon-jiantou-you-cuxiantiao-fill"></i></a>
							<p class="l">
								<span class="p_time"><i class="iconfont icon-shijian" aria-hidden="true"></i><?php the_time('Y年m月d日 H:i:s D') ?></span>
								<span class="i_time"><i class="iconfont icon-shijian" aria-hidden="true"></i><span><?php the_time('Y-m-d D') ?></span>
								</span>
								<span><a href="<?php the_permalink(); ?> "><i class="iconfont icon-icon-eyes"></i><span><?php echo getPostViews(get_the_ID()); ?></span></a></span>
								<span class="comm"><a href="<?php the_permalink(); ?> "><i class="iconfont icon-liuyan1"></i><span><?php echo number_format_i18n(get_comments_number()); ?></span></a></span>
								<span class="post-like"><a href="javascript:;" data-action="ding" data-id="<?php the_ID(); ?>" class="favorite<?php if (isset($_COOKIE['bigfa_ding_' . $post->ID])) echo ' done'; ?>"><i class="iconfont icon-xingxing"></i><span class="count"><?php if (get_post_meta($post->ID, 'bigfa_ding', true)) {echo get_post_meta($post->ID, 'bigfa_ding', true);} else {echo '0';
									} ?></span>
									</a>
								</span>
							</p>
							<?php if (is_sticky()) echo '<em><a href="">顶</a></em>'; ?>
						</div>
					</article>
				<?php endwhile;
				else : ?>
				<script>
					$("body, html").css("height","100%");
					$(".search_404").show();
					if ($(window).width() < 1200) {
						setTimeout(function(){
							$('footer.footer').css({
									"position": "fixed",
									"bottom": "0",
									"left":  "0"
							})
						}, 500);
					}
					layer.ready(function(){
						layer.alert('Sorry，当前分类下没有任何文章，去后台发布？',{
							skin: 'layui',
							title:"提示",
							closeBtn: 1, //是否展示关闭x按钮
							anim: 4,
							btn: ['确认'],
							yes:function(){
								location.href="/wp-login.php"
							}
						})
					}); 

				</script>
				<?php endif; ?>
				<?php lingfeng_pagenavi();?><!-- 分页调用 -->
		</div>
		<!-- 左侧区域end -->

		<!-- 右侧区域start -->
		<section class="continar-right">
			<?php get_sidebar($name); ?>
		</section>
		<!-- 右侧区域end -->
	</section>
	<!-- 正文区域end -->

	<!-- 底部悬浮窗start -->
	<?php
			if (get_option('weipxiu_options')['login_reg'] == 'on' && !is_user_logged_in()) {
					?>
					<div class="login_alert">
						<div class="login_alert_close">
								<i class="iconfont icon-guanbi"></i>
						</div>
							<div class="login_alert_box">
								<div><?php echo get_option('weipxiu_options')['tips_sentence']; ?>
											<a href="/wp-login.php" rel="nofollow">会员登录</a>
											<span>或</span>
											<a href="/wp-login.php?action=register" class="register" rel="nofollow">注册会员</a> 
									</div>
							</div>
					</div>
				<?php
			}
	?>
	<!-- 底部悬浮窗end -->

	<!-- 底部调用start -->
	<?php get_footer() ?>
	<!-- 底部调用end -->
</body>

<script type="text/javascript" src="<?php echo esc_url(get_template_directory_uri()); ?>/js/swiper.min.js"></script>
<script type="text/javascript" src="<?php echo esc_url(get_template_directory_uri()); ?>/js/xfg_banner/banner-effect.js"></script>
<script type="text/javascript">
$(function () {
			//var domain_name = window.location.origin;//https://www.weipxiu.com（不兼容IE10及以下）
			var domain_name = window.location.protocol + "//" + window.location.host;
			if (!($(window).width() < 1200)) {
					// 桌面提醒功能
					var set_desktop = function () {
							if (window.Notification) {
									var popNotice = function () {
											if (Notification.permission == "granted") {
													var notification = new Notification("友情提示：", {
															body: '欢迎点击立即加入"Vue.js3.0技术栈"群互相学习、交流！',
															icon: '<?php echo esc_url(get_template_directory_uri()); ?>/images/notification.png'
													})

													notification.onclick = function () {
															window.open("https://jq.qq.com/?_wv=1027&k=aU2c7W76")
															notification.close();
													}
											}
									}

									var desktop = function () {
											if (Notification.permission == "granted") {
													popNotice();
											} else if (Notification.permission != "denied") {
													Notification.requestPermission(function (permission) {
															popNotice();
													})
											}
									}
									desktop();
							}
					}
					//set_desktop();
					if (domain_name.indexOf('weipxiu.com') != '-1') {
							setTimeout(function () {
									set_desktop();
							}, 2000);
					}
					// 桌面提醒功能

					// 控制台打印start
					if (window.console && window.console.log) {
							setTimeout(function () {
									console.log("\n %c 当前主题由唯品秀前端技术博客免费提供 %c  © Jun Li  https://www.weipxiu.com  \n",
											"color:#FFFFFB;background:#1890ff;padding:5px 0;border-radius:.5rem 0 0 .5rem;",
											"color:#FFFFFB;background:#080808;padding:5px 0;border-radius:0 .5rem .5rem 0;"
									);
							}, 1500);
					}
					// 控制台打印end

					$(".buffer").fadeOut();
					$(".buffer .bar").hide();

			} else {
					//排除PC端执行下列代码
					//移动端只在首页展示sidebar.php模块
					$(".continar-right").show();

					//swiper核心三要素：依赖swiper.js、swiper.css，外面父亲盒子高度
					var swiper1 = new Swiper('.swiper-container1', {
							pagination: '.swiper-pagination', //是否出现小圆点
							//nextButton: '.swiper-button-next',//上一张
							//prevButton: '.swiper-button-prev',//下一张
							slidesPerView: 1, //每一屏幕排几张图片
							effect: 'slide', //轮播方式，左右切换
							paginationClickable: true, //小圆点是否可点击
							spaceBetween: 0, //图片间距
							autoplay: 4500, //自动轮播时间
							speed: 500, //切换一张所需要的时间
							// keyboardControl: true, //键盘左右按钮切换
							// mousewheelControl: false, //鼠标滚轮切换
							autoplayDisableOnInteraction: false, //表示用户操作swiper之后，是否禁止autoplay。默认为 true：停止。false是播放
							loop: true //循环
					});
					//navigator.vibrate([1000, 500, 1000]);
					//手机震动功能，里面是数组-震动时间，第二个为间隔时间
			}

			//首页轮播下sd导航start
			$(".mod-index__feature .img_list_6pic a").removeClass("word_display");
			if (!!window.ActiveXObject || "ActiveXObject" in window) {
					console.log("当前浏览器IE内核，部分效果不可展现！")
			} else {
					$("body").on("mouseenter",".mod-index__feature .img_list_6pic a",function(){
							$(this).addClass("word_display")
					})
					$("body").on("mouseleave",".mod-index__feature .img_list_6pic a",function(){
							$(this).removeClass("word_display")
					})
			}
			//首页轮播下sd导航end

			//修改邮件订阅表单类型
			$(".wpm_form .wpm_email input").attr("type", "email")

			// 当窗口改变时候start
			$(window).resize(function () {
					if ($(document).width() >= 1200) {
							if (window.location.href == domain_name || window.location.href == domain_name + '/') {
									$("#js_banner").show();
							}
					} else {

					}
			});
			// 当窗口改变时候end
			
			// pc轮播
			if("<?php echo esc_url(get_template_directory_uri()); ?>".indexOf('wp-content/themes/Art_Blog') == -1){
				layer.alert('Sorry，当前主题安装路径不正确，详情点击确认查看主题使用说明！',{
				skin: 'layui',
				title:"提示",
				closeBtn: 1, //是否展示关闭x按钮
				anim: 4,
				btn: ['确认'],
				yes:function(){
					location.href="https://github.com/weipxiu/Art_Blog"
				}
			})
		}
		//turnEffect（翻转）boomEffect（爆炸）pageEffect（翻页）skewEffect（扭曲）cubeEffect（立方体）
		var flippingMode = ['turnEffect', 'boomEffect', 'pageEffect', 'skewEffect','cubeEffect'];
		var randomNum = Math.floor(Math.random() * 3);
		var bannerData = [];
	<?php
		if (trim(get_option('weipxiu_options')['pc_banner'])) {
		?>
			bannerData = <?php echo get_option('weipxiu_options')['pc_banner'] ?>;
			var banner =  new Banner({
					banner: '#banner_img',
					index: 0,
					autoplay: 8000,
					width: 1200,
					height: 300,
					images: bannerData,
					preloadImages: true, // 预加载所有图片

					// 分页及控制
					pagination: '.js_banner_nav', // 分页dom
					paginationClick: true, // 分页是否可点击
					prevButton: '.js_banner_prev', // 下一张dom
					nextButton: '.js_banner_next', // 上一张dom
					Effects: {
						'prev': 'turnEffect',
						'next': Number(<?php echo get_option('weipxiu_options')['wheel_banner']; ?>) == ''?flippingMode[parseInt(Math.random()*(5),10)]:flippingMode[<?php echo get_option('weipxiu_options')['wheel_banner']; ?>-1],
						'navi': 'pageEffect'
					},
			});
		<?php
		}
	?>
})
</script>
</html>