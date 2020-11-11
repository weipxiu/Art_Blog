<?php
/*
Template Name: 404页面  
*/
?>

<!DOCTYPE html>
<html lang="en">

<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, user-scalable=no">
	<?php wp_head(); ?>
	<title><?php wp_title( '-', true, 'right' ); ?>很抱歉,未能找到你的女朋友&nbsp;-&nbsp;<?php echo get_bloginfo('description'); ?></title>
	<meta name="Keywords" content="404、未找到内容">
	<meta name="description" content="抱歉，当前访问的内容不存在！">
	<script src="<?php echo esc_url(get_template_directory_uri()); ?>/js/jquery-2.1.4.min.js"></script>
	<style type="text/css">
		* {
			margin: 0px;
			padding: 0px;
		}

		.container {
			width: 480px;
			height: 500px;
			margin: 40px auto;
		}

		.container h3 {
			font-size: 24px;
			font-family: "微软雅黑";
			line-height: 55px;
		}

		.container p {
			font-size: 13px;
			color: #666;
			font-family: "微软雅黑";
			line-height: 25px;
		}

		.container p font {
			color: #FF00CC;
			font-weight: bold;
		}

		.container p a {
			color: red;
		}

		.container p span {
			color: red;
			font-weight: bold;
			padding-left: 5px;
		}

		.go_back {
			color: red;
			padding-right: 5px;
		}
	</style>
</head>

<body>
	<div class="container">
		<img src="<?php echo esc_url(get_template_directory_uri()); ?>/images/404.png" />
		<h3>很抱歉,未能找到你的女朋友</h3>
		<p>请试试以下方法：</p>
		<p>
			<span>1、</span>检查身高、颜值、支付宝、微信或银行卡存款
		</p>
		<p>
			<span>2、</span>重新降临到这个世界
		</p>
		<p>
			<span>3、</span>页面将在<span class="autotime">5</span>
			<span class="go_back">s</span>后自动跳转到<a href="<?php echo esc_url( home_url() ); ?>"><?php echo get_bloginfo('description'); ?></a>首页
		</p>
		<div>
</body>
<script type="text/javascript">
	var num = 15;
	var clearTime = null;

	function autoPlay() {
		clearTime = setInterval(function() {
			num--;
			$(".autotime").text(num);
			if (num == 0) {
				window.location = window.location.protocol + "//" + window.location.host;
				clearInterval(clearTime);
			}
		}, 1000);
	};
	autoPlay();
</script>
<?php wp_footer(); ?>

</html>