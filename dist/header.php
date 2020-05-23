<!-- 头部start -->
<!-- 移动端头部start -->
<div class="os-headertop">
		<div class="btn_menu"></div>
		<a href="/" class="weipxiu_nav"><?php echo get_bloginfo('description'); ?></a>
		<div class="xis">
			<i class="iconfont icon-sousuo"></i>
		</div>
		<div class="site-search active">
			<div class="container">
				<form role="search" method="get" id="searchform_os" class="site-search-form" action="<?php echo home_url(); ?>/">
					<input class="search-input" name="s" value="" placeholder="输入关键字搜索" type="text" />
					<button class="search-btn" type="submit" id="searchsubmit_os">
						<i class="iconfont icon-sousuo"></i>
					</button>
				</form>
			</div>
		</div>
</div>
<!--移动端头部end-->

<header class="header">
	<div style="height:2px;background:url(<?php bloginfo('template_url'); ?>/images/header_bj.gif); animation: hue 20s infinite linear;overflow: hidden; width:100%;">
	</div>
	<div class="header-body">
		<div class="header-conter">
			<nav class="nav">
					<a href="/" class="t-logo" id="Logo">
							<img src="<?php echo get_option('weipxiu_options')['logo']; ?>" onerror="this.src='https:\/\/www.weipxiu.com/wp-content/uploads/2019/06/weipxiu_logo_2.png';">
					</a>
					<div class="nav-left"></div>
					<div class="brand">
					<p>关注前端开发</p>
					<p>Html5、Vue、Node、Flutter</p>
				</div>
				<?php 
					// 列出顶部导航菜单，只列出一级菜单
					wp_nav_menu( array( 
						'theme_location'  => '',//导航别名
						'menu'   => '', //期望显示的菜单
						'container'  => '',  //容器标签
						//'container_class' => 'nav',//ul父节点class值
						//'container_id'  => '',  //ul父节点id值
						'menu_class'   => 'music-nav',   //ul节点class值
						'menu_id'   => 'nav_list',  //ul节点id值
						'echo'  => true,//是否输出菜单，默认为true
						'fallback_cb' => 'false',  //'wp_page_menu'菜单不存在时，返回默认菜单，设为false则不返回
						'before' => '', //链接前文本
						'after'  => '', //链接后文本
						'link_before'  => '',   //链接文本前
						'link_after'  => '',//链接文本后
						'items_wrap'  => '<ul id="%1$s" class="%2$s">%3$s</ul>',   //如何包装列表
						'depth' => 0   //菜单深度，默认0
						//'walker' => new Header_Menu_Walker()  //自定义walker
					) );
				?>
				<!-- 搜索按钮start -->
				<div class="navto-search">
					<a href="javascript:;" class="search-show active">
							<i class="iconfont icon-sousuo"></i>
					</a>
				</div>
				<!-- 搜索按钮end -->
			</nav>
		</div>
	</div>
	<!-- 搜索区域start -->
	<div class="site-search active pc">
		<div class="container">
			<form role="search" method="get" id="searchform_pc" class="site-search-form" action="<?php echo home_url(); ?>/">
				<input class="search-input" name="s" type="text" value="" placeholder="输入关键字搜索">
				<button class="search-btn" type="submit" id="searchsubmit_pc"><i class="iconfont icon-sousuo"></i></button>
			</form>
		</div>
	</div>
	<!-- 搜索区域end -->
</header>
<!-- 头部end -->

<!-- 移动端侧边栏导航start -->
<div class="os-herder btn">
	<!-- <ul class="slide-left">
		<li><a href="<?php echo home_url(); ?>"><i class="iconfont">&#xe632;</i>首页</a></li>
		<li data-implement='element'>
			<a href="javascript:void(0);" class="frontEnd"><i class="iconfont">&#xe64b;</i>前端开发<i class="iconfont iconfont_click icon-xiajiantou"></i></a>
			<div class="slide_slect">
				<a href="/category/frontend/htmlcss"><i class="iconfont">&#xe68c;</i>HTML/CSS</a>
				<a href="/category/frontend/javascript"><i class="iconfont">&#xe898;</i>Javascript</a>
				<a href="/category/frontend/js-frame"><i class="iconfont">&#xe89a;</i>Js框架</a>
				<a href="/category/frontend/holdall"><i class="iconfont">&#xe6ad;</i>前端工具箱</a>
				<a href="/works/h5-7_vip/index.html"><i class="iconfont">&#xe757;</i>作品案例</a>
			</div>
		</li>
		<li><a href="/category/jqzy"><i class="iconfont">&#xe75c;</i>别具匠心</a></li>
		<li><a href="/category/mood"><i class="iconfont">&#xe668;</i>心情小镇</a></li>
		<li><a href="/message"><i class="iconfont">&#xe69f;</i>碎言碎语</a></li>
		<li><a href="/about"><i class="iconfont">&#xe603;</i>关于博客</a></li>
		<li><a href="/wp-login.php"><i class="iconfont">&#xe630;</i>用户登录</a></li>
	</ul> -->
	<?php 
		// 列出顶部导航菜单，只列出一级菜单
		wp_nav_menu( array( 
			'theme_location'  => '',//导航别名
			'menu'   => '', //期望显示的菜单
			'container'  => '',  //容器标签
			//'container_class' => 'nav',//ul父节点class值
			//'container_id'  => '',  //ul父节点id值
			'menu_class'   => 'slide-left',   //ul节点class值
			'menu_id'   => 'nav_list',  //ul节点id值
			'echo'  => true,//是否输出菜单，默认为true
			'fallback_cb' => 'false',  //'wp_page_menu'菜单不存在时，返回默认菜单，设为false则不返回
			'before' => '', //链接前文本
			'after'  => '', //链接后文本
			'link_before'  => '',   //链接文本前
			'link_after'  => '',//链接文本后
			'items_wrap'  => '<ul id="%1$s" class="%2$s">%3$s</ul>',   //如何包装列表
			'depth' => 0   //菜单深度，默认0
			//'walker' => new Header_Menu_Walker()  //自定义walker
		) );
	?>
</div>
<!-- 移动端侧边栏导航end -->

<!-- 移动端遮盖层，防止导航出现页面上下滑动导致bug-start -->
<div class="cover"></div>
<!-- 移动端遮盖层，防止导航出现页面上下滑动导致bug-end -->