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
<!-- 是否强制资源https加载 -->
<?php if (get_option('weipxiu_options')['switch_https'] == 'on'){ ?>
<meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
<?php } ?>
<!-- DNS预解析 -->
<meta http-equiv="x-dns-prefetch-control" content="on">
<link rel="dns-prefetch" href="<?php echo esc_url( home_url() ); ?>">
<link rel="shortcut icon" type="image/x-icon" href="<?php echo get_option('weipxiu_options')['label_logo']; ?>" />
<link rel="stylesheet" type="text/css" href="<?php echo esc_url(get_template_directory_uri()); ?>/css/style_min.css">
<link rel="stylesheet" type="text/css" href="https://at.alicdn.com/t/font_385244_f77xrfh9aki.css">
<script type="text/javascript" src="<?php echo esc_url(get_template_directory_uri()); ?>/js/jquery-2.1.4.min.js"></script>
<script type="text/javascript" src="<?php echo esc_url(get_template_directory_uri()); ?>/layer/layer.js"></script>
<!-- 判断低版本IE -->
<script>
	 /*if ((navigator.userAgent.indexOf('MSIE') >= 0) 
		&& (navigator.userAgent.indexOf('Opera') < 0)){
		window.location.href="echo esc_url(get_template_directory_uri()); /reminder.php";//判断IE5-10
	 }*/
	if(navigator.appName == "Microsoft Internet Explorer"&&parseInt(navigator.appVersion.split(";")[1].replace(/[ ]/g, "").replace("MSIE",""))<9){
		window.location.href="<?php echo esc_url(get_template_directory_uri()); ?>/reminder";/*判断<IE9,此方法也可以判断<IE10*/
	}
</script>

<!-- 百度统计 -->
<?php
if (get_option('weipxiu_options')['baidu_statistics']) {
?>
<?php echo get_option('weipxiu_options')['baidu_statistics']; ?>
<?php
}else
{
?>
<script>
	var _hmt = _hmt || [];
	(function() {
		var hm = document.createElement("script");
		hm.src = "https://hm.baidu.com/hm.js?704cfdd415da41b2e884bbb16a5dd3f3";
		var s = document.getElementsByTagName("script")[0]; 
		s.parentNode.insertBefore(hm, s);
	})();
</script>
<?php
}
?>

<script>
var win_width = 375;
var deviation = document.querySelectorAll(".continar,.os-headertop");
var setFontSize = function() {
    win_width = window.innerWidth;
    if (/Android|webOS|iPhone|iPad|iPod|BlackBerry/i.test(navigator.userAgent) || win_width < 1200) {
        var w_init = 750;
        var pro = 100 * win_width / w_init;
        if (win_width > 767 && win_width < 1000) {
            pro = 70
        }
        if (win_width > 1000 && win_width < 1200) {
            pro = 100
        }
        document.documentElement.style.setProperty("font-size", pro + "px");
    } else if(deviation.length) {
				deviation[0].style.transform = "translateX(0)";
    }
}
setFontSize(); 
window.onresize = function() {
    setFontSize()
}
</script>

<!-- 自定义样式 -->
<style>
	<?php echo get_option('weipxiu_options')['details_css']; ?>
	<?php
			if (get_option('weipxiu_options')['mourning'] == 'on') {
					?>
					html{filter: grayscale(100%);}
				<?php
			}
	?>
</style>
