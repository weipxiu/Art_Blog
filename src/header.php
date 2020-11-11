<!-- 头部start -->
<!-- 移动端头部start -->
<div class="os-headertop">
		<div class="btn_menu"><i class="iconfont icon-caidanlan"></i></div>
		<a href="<?php echo esc_url( home_url() ); ?>" class="weipxiu_nav"><?php echo get_bloginfo('description'); ?></a>
		<div class="xis">
			<i class="iconfont icon-sousuo"></i>
		</div>
		<div class="site-search active">
			<div class="container">
				<form role="search" method="get" id="searchform_os" class="site-search-form" action="<?php echo esc_url( home_url() ); ?>/">
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
	<div class="speed_bar"></div>
	<div class="header-body">
		<div class="header-conter">
			<nav class="nav">
					<a href="<?php echo esc_url( home_url() ); ?>" class="t-logo" id="Logo">
							<img src="<?php echo get_option('weipxiu_options')['logo']; ?>">
					</a>
					<div class="brand">
					<?php echo get_option('weipxiu_options')['key_word']; ?>
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
			<form role="search" method="get" id="searchform_pc" class="site-search-form" action="<?php echo esc_url( home_url() ); ?>/">
				<input class="search-input" name="s" type="text" value="" placeholder="输入关键字搜索">
				<button class="search-btn" type="submit" id="searchsubmit_pc"><i class="iconfont icon-sousuo"></i></button>
			</form>
		</div>
	</div>
	<!-- 搜索区域end -->
</header>
<!-- 头部end -->

<!-- 移动端侧边栏导航start -->
<div class="os-herder">
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
	<!-- 移动端登录注册start -->
	<?php
			if (get_option('weipxiu_options')['login_reg'] == 'on' && !is_user_logged_in()) {
				?>
					<div class="sign_up">
							<a href="/wp-login.php"><i class="iconfont icon-denglu"></i>立即登录</a>
							<a href="/wp-login.php?action=register"><i class="iconfont icon-zhuce"></i>马上注册</a>
					</div>
				<?php
			}
	?>
	<?php
	if (get_option('weipxiu_options')['login_reg'] == 'on' && is_user_logged_in()) {
		echo "<div class='sign_up'> <a class='backstage' style='display:none' href='/wp-admin/'>后台管理</a></div>";
	}
	?>
	<!-- 移动端登录注册end -->
</div>
<!-- 移动端侧边栏导航end -->

<!-- 移动端遮盖层，防止导航出现页面上下滑动导致bug-start -->
<div class="cover"></div>
<!-- 移动端遮盖层，防止导航出现页面上下滑动导致bug-end -->

<!-- 网站换肤start -->
<script type="text/javascript">
	function getColor(){
		<?php if (trim(get_option('weipxiu_options')['replace_skin'])){ ?>
			document.documentElement.style.setProperty('--color', '<?php echo trim(get_option('weipxiu_options')['replace_skin']); ?>')
		<?php }else{?>
			document.documentElement.style.setProperty('--color', '#1890ff')
		<?php }?>
	}
	getColor()
	window.onresize = function(){
		getColor()
	}
</script>
<!-- 网站换肤end -->