<?php wp_head(); ?>

<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta name="baidu-site-verification" content="cNP7vhhXuw" />
<meta name="Author" content="<?php echo get_bloginfo('description'); ?>" />
<?php if (is_single()){ ?>
<title><?php the_title(); ?>&nbsp;-&nbsp;<?php echo get_bloginfo('description'); ?></title>
<?php } ?>
<meta name="keywords" content="<?php echo get_option('weipxiu_options')['keywords']; ?>" />
<?php if (is_home()){ ?>
<meta name="description" content="<?php echo get_option('weipxiu_options')['description']; ?>" />
<?php }else{?>
<meta name="description" content="<?php echo mb_strimwidth(strip_tags(apply_filters('the_content', $post->post_content)), 0, 190,"..."); ?>" />
<?php }?>

<meta name="format-detection" content="telephone=no"/>
<meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1">
<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, user-scalable=no">

<!-- Force HTTPS mode to open -->
<?php if (get_option('weipxiu_options')['text_pic'] == 'on'){ ?>
	<meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
<?php } ?>

<!-- Pre-parsing is currently on the site -->
<meta http-equiv="x-dns-prefetch-control" content="on">

<link rel="shortcut icon" type="image/x-icon" href="<?php echo get_option('weipxiu_options')['label_logo']; ?>" />
<link rel="dns-prefetch" href="<?php echo home_url(); ?>">

<link rel="stylesheet" type="text/css" media="screen and (min-width:1200px)" href="<?php bloginfo('template_url'); ?>/style.css">
<link rel="stylesheet" type="text/css" media="screen and (max-width:767px)" href="<?php bloginfo('template_url'); ?>/css/style-ios.css">
<link rel="stylesheet" type="text/css" media="screen and (min-width:768px) and (max-width:1199px)" href="<?php bloginfo('template_url'); ?>/css/style-ipd.css">
<link rel="stylesheet" type="text/css" href="https://at.alicdn.com/t/font_385244_bicc8gniahd.css">
<link rel="stylesheet" type="text/css" href="<?php bloginfo('template_url'); ?>/css/video-js.css">

<script src="<?php bloginfo('template_url'); ?>/js/jquery-2.1.4.min.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/rem.js"></script>
<script src="<?php bloginfo('template_url'); ?>/layer/layer.js"></script>
<!-- 判断低版本IE -->
<script>
	 /*if ((navigator.userAgent.indexOf('MSIE') >= 0) 
		&& (navigator.userAgent.indexOf('Opera') < 0)){
		window.location.href="<php bloginfo('template_url'); ?>/reminder.php";//判断IE5-10
	 }*/
		if(navigator.appName == "Microsoft Internet Explorer"&&parseInt(navigator.appVersion.split(";")[1].replace(/[ ]/g, "").replace("MSIE",""))<9){
		window.location.href="<?php bloginfo('template_url'); ?>/reminder";/*判断<IE9,此方法也可以判断<IE10*/
	}
</script>

<!-- 百度统计 -->
<script>
	var _hmt = _hmt || [];
	(function() {
		var hm = document.createElement("script");
		hm.src = "https://hm.baidu.com/hm.js?704cfdd415da41b2e884bbb16a5dd3f3";
		var s = document.getElementsByTagName("script")[0]; 
		s.parentNode.insertBefore(hm, s);
	})();
</script>
