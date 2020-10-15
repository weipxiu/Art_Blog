<?php   
/*
Template Name: 升级浏览器 
*/  
?>
<!doctype html>
<html>

<head>
	<title>温馨提示：您的浏览器需要更新才能访问哦^_^</title>
	<?php wp_head(); ?>
	<style>
		* {
			margin: 0;
			padding: 0;
			font-size: 20px;
		}

		body {
			text-align: center;
			padding-top: 30px;
		}

		img {
			border: none;
		}

		h2,
		h3,
		h4 {
			color: #666;
			margin: 26px;
			font-size: 24px;
		}

		strong {
			font-weight: normal;
			padding-bottom: 2px;
			color: #930;
		}

		p {
			padding: 50px 0;
			letter-spacing: 20px;
		}

		h4 {
			font-weight: normal;
		}

		a {
			color: #930;
			text-decoration: none;
			border-bottom: 1px dotted #930;
		}
	</style>
</head>

<body>
	<h2>温馨提示：<br /><br /><strong>您的浏览器版本实在过低，需要更新才能访问哦 ^_^</strong></h2>
	<h3>建议使用
		<strong><a href="https://www.google.cn/chrome/" target="_blank">Chrome</a></strong>、<strong><a
				href="https://www.firefox.com/" target="_blank">firefox</a></strong>、<strong><a
				href="https://www.apple.com/safari" target="_blank">Safari</a></strong>、<strong><a
				href="https://www.opera.com/zh-cn" target="_blank">opera</a></strong>
		标准浏览器访问~
	</h3>
	<h3>
		如果坚持使用Internet Explorer浏览器，那么请务必升级到最新版<a
			href="https://support.microsoft.com/zh-cn/help/17621/internet-explorer-downloads">Explorer 11</a>
	</h3>
	<p>
		<a href="https://www.google.cn/chrome/" target="_blank"><img alt="chrome"
				src="<?php bloginfo('template_url'); ?>/images/chrome.png"></a>
		<a href="https://www.firefox.com/" target="_blank"><img alt="safari"
				src="<?php bloginfo('template_url'); ?>/images/firefox.png"></a>
		<a href="https://www.apple.com/safari" target="_blank"><img alt="safari"
				src="<?php bloginfo('template_url'); ?>/images/safari.png"></a>
		<a href="https://www.opera.com/zh-cn" target="_blank"><img alt="safari"
				src="<?php bloginfo('template_url'); ?>/images/opera.png"></a>
	</p>
	<h4>Copyright © 2016-2020 <a href="/">WEIPXIU.COM</a> · 版权所有</h4>
</body>

</html>