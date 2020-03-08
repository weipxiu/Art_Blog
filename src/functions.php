<?php
// 引入模板主题设置文件
if (is_admin()) require ('include/wp-theme-options.php');

//注册菜单
register_nav_menus(array(
    'MainNav' => '主导航',
));

//注册小工具
if ( function_exists('register_sidebar') )
register_sidebar(array(
    'before_widget' => '<div class="sidebox">    ',
    'after_widget' => '</div>',
    'before_title' => '<h2>',
    'after_title' => '</h2>',
));

//注册特色图像
add_theme_support('post-thumbnails');

// 获取文章第一张缩略图 
function catch_that_image() {
	global $post;
	$first_img = '';
	ob_start();
	ob_end_clean();
	$output = preg_match_all('/<img*.+src=[\'"]([^\'"]+)[\'"].*>/iU', wp_unslash($post->post_content), $matches);
	if(empty($output)){ 
        $first_img =  get_option('weipxiu_options')['thumbnail'];
	}else {
		$first_img = $matches [1][0];
	}
	return $first_img;
}  
//重写特色图像
function _get_post_thumbnail($size = 'thumbnail', $class = 'thumb') {
	global $post;
	$r_src = '';
	if (has_post_thumbnail()) {
        $domsxe = get_the_post_thumbnail();
        preg_match_all('/<img.*?(?: |\\t|\\r|\\n)?src=[\'"]?(.+?)[\'"]?(?:(?: |\\t|\\r|\\n)+.*?)?>/sim', $domsxe, $strResult, PREG_PATTERN_ORDER);  
        $images = $strResult[1];
        foreach($images as $src){
        	$r_src = $src;
            break;
        }
	}
	if( $r_src ){
    	return sprintf('<img data-original="%s" src="/wp-content/themes/Art_Blog/images/Lazy_load.png" border="0" alt="%s" class="Lazy_load">', $r_src, $post->post_title.'-'.get_bloginfo('name'));
    }else{
    	//return catch_that_image()
    }
}
set_post_thumbnail_size(220, 140, true); // 图片宽度与高度
?>
<?php //控制分页页面，每个页面所显示的文章数量
// function custom_posts_per_page($query){
// 		if(is_home()){
// 		$query->set('posts_per_page',15);//首页每页显示12篇文章
// 		}
// 		if(is_search()){
// 			$query->set('posts_per_page',10);//搜索页显示所有匹配的文章，不分页
// 		}
// 		if(is_archive()){
// 			$query->set('posts_per_page',15);//其它页面每页显示10篇文章
// 	}endif
// 	}function
//     add_action('pre_get_posts','custom_posts_per_page');
?>
<?php 
//部分内容登录可见
function login_to_read($atts, $content=null) {
    extract(shortcode_atts(array("notice" => '
    <p style="text-align:center;text-align-last: center;"><span style="color: red;">温馨提示：</span>此处内容需要<a title="登录后可见" href="/wp-login.php">登录</a>后才能查看！
    </p>'), $atts));
    if ( is_user_logged_in() && !is_null( $content ) && !is_feed() )
                    return $content;
            return $notice;
    }
    add_shortcode('login_success', 'login_to_read');
/**
* 数字分页函数
* 因为wordpress默认仅仅提供简单分页
* 所以要实现数字分页，需要自定义函数
* @Param int $range            数字分页的宽度
* @Return string|empty        输出分页的HTML代码        
*/
function lingfeng_pagenavi( $range = 4 ) {
    global $paged,$wp_query;
    if ( !$max_page ) {
        $max_page = $wp_query->max_num_pages;
    }
    if( $max_page >1 ) {
        echo "<div class='fenye wp-pagenavi'>"; 
        if( !$paged ){
            $paged = 1;
        }
        if( $paged != 1 ) {
            echo "<a href='".get_pagenum_link(1) ."' class='extend' title='跳转到首页'>首页</a>";
        }
        previous_posts_link('上一页');
        if ( $max_page >$range ) {
            if( $paged <$range ) {
                for( $i = 1; $i <= ($range +1); $i++ ) {
                    echo "<a href='".get_pagenum_link($i) ."'";
                if($i==$paged) echo " class='current'";echo ">$i</a>";
                }
            }elseif($paged >= ($max_page -ceil(($range/2)))){
                for($i = $max_page -$range;$i <= $max_page;$i++){
                    echo "<a href='".get_pagenum_link($i) ."'";
                    if($i==$paged)echo " class='current'";echo ">$i</a>";
                    }
                }elseif($paged >= $range &&$paged <($max_page -ceil(($range/2)))){
                    for($i = ($paged -ceil($range/2));$i <= ($paged +ceil(($range/2)));$i++){
                        echo "<a href='".get_pagenum_link($i) ."'";if($i==$paged) echo " class='current'";echo ">$i</a>";
                    }
                }
            }else{
                for($i = 1;$i <= $max_page;$i++){
                    echo "<a href='".get_pagenum_link($i) ."'";
                    if($i==$paged)echo " class='current'";echo ">$i</a>";
                }
            }
        next_posts_link('下一页');
        if($paged != $max_page){
            //echo '<a href=".get_pagenum_link($max_page) ." class="extend" title='跳转到最后一页'>共'.$max_page.'页</a>';
            echo '<a href='.get_pagenum_link($max_page) .' class="last">共 '.$max_page.' 页</a>';
        }
        //echo '<span class="last">共'.$max_page.'页</span>';
        echo "</div>\n";  
    }
}

//文章分类统计
function wt_get_category_count($input = '') {
    global $wpdb;
    if ($input == '') {
        $category = get_the_category();
        return $category[0]->category_count;
    } elseif (is_numeric($input)) {
        $SQL = "SELECT $wpdb->term_taxonomy.count FROM $wpdb->terms, $wpdb->term_taxonomy WHERE $wpdb->terms.term_id=$wpdb->term_taxonomy.term_id AND $wpdb->term_taxonomy.term_id=$input";
        return $wpdb->get_var($SQL);
    } else {
        $SQL = "SELECT $wpdb->term_taxonomy.count FROM $wpdb->terms, $wpdb->term_taxonomy WHERE $wpdb->terms.term_id=$wpdb->term_taxonomy.term_id AND $wpdb->terms.slug='$input'";
        return $wpdb->get_var($SQL);
    }
}
?>
<?php
//获取浏览数-参数文章ID
function getPostViews($postID) {
    //字段名称
    $count_key = 'post_views_count';
    //获取字段值即浏览次数
    $count = get_post_meta($postID, $count_key, true);
    //如果为空设置为0
    if ($count == '') {
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
        return "0";
    }
    return $count;
}
//设置浏览数-参数文章ID
function setPostViews($postID) {
    //字段名称
    $count_key = 'post_views_count';
    //先获取获取字段值即浏览次数
    $count = get_post_meta($postID, $count_key, true);
    //如果为空就设为0
    if ($count == '') {
        $count = 0;
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
    } else {
        //如果不为空，加1，更新数据
        $count++;
        update_post_meta($postID, $count_key, $count);
    }
}
add_filter('show_admin_bar', '__return_false'); //去掉默认顶端导航条

//时间显示方式‘xx以前’
function time_ago($type = 'commennt', $day = 7) {
    $d = $type == 'post' ? 'get_post_time' : 'get_comment_time';
    if (time() - $d('U') > 60 * 60 * 24 * $day) return;
    echo ' (', human_time_diff($d('U') , strtotime(current_time('mysql', 0))) , '前)';
}
function timeago($ptime) {
    $ptime = strtotime($ptime);
    $etime = time() - $ptime;
    if ($etime < 1) return '刚刚';
    $interval = array(
        12 * 30 * 24 * 60 * 60 => '年前 (' . date('Y-m-d', $ptime) . ')',
        30 * 24 * 60 * 60 => '个月前 (' . date('m-d', $ptime) . ')',
        7 * 24 * 60 * 60 => '周前 (' . date('m-d', $ptime) . ')',
        24 * 60 * 60 => '天前',
        60 * 60 => '小时前',
        60 => '分钟前',
        1 => '秒前'
    );
    foreach ($interval as $secs => $str) {
        $d = $etime / $secs;
        if ($d >= 1) {
            $r = round($d);
            return $r . $str;
        }
    };
}
// 更改后台字体
function Bing_admin_lettering() {
    echo '<style type="text/css">
        * { font-family: "Microsoft YaHei" !important; }
        i, .ab-icon, .mce-close, i.mce-i-aligncenter, i.mce-i-alignjustify, i.mce-i-alignleft, i.mce-i-alignright, i.mce-i-blockquote, i.mce-i-bold, i.mce-i-bullist, i.mce-i-charmap, i.mce-i-forecolor, i.mce-i-fullscreen, i.mce-i-help, i.mce-i-hr, i.mce-i-indent, i.mce-i-italic, i.mce-i-link, i.mce-i-ltr, i.mce-i-numlist, i.mce-i-outdent, i.mce-i-pastetext, i.mce-i-pasteword, i.mce-i-redo, i.mce-i-removeformat, i.mce-i-spellchecker, i.mce-i-strikethrough, i.mce-i-underline, i.mce-i-undo, i.mce-i-unlink, i.mce-i-wp-media-library, i.mce-i-wp_adv, i.mce-i-wp_fullscreen, i.mce-i-wp_help, i.mce-i-wp_more, i.mce-i-wp_page, .qt-fullscreen, .star-rating .star { font-family: dashicons !important; }
        .mce-ico { font-family: tinymce, Arial !important; }
        .fa { font-family: FontAwesome !important; }
        .genericon { font-family: "Genericons" !important; }
        .appearance_page_scte-theme-editor #wpbody *, .ace_editor * { font-family: Monaco, Menlo, "Ubuntu Mono", Consolas, source-code-pro, monospace !important; }
        </style>';
}
add_action('admin_head', 'Bing_admin_lettering');
//点赞
add_action('wp_ajax_nopriv_bigfa_like', 'bigfa_like');
add_action('wp_ajax_bigfa_like', 'bigfa_like');
function bigfa_like() {
    global $wpdb, $post;
    $id = $_POST["um_id"];
    $action = $_POST["um_action"];
    if ($action == 'ding') {
        $bigfa_raters = get_post_meta($id, 'bigfa_ding', true);
        $expire = time() + 99999999;
        $domain = ($_SERVER['HTTP_HOST'] != 'localhost') ? $_SERVER['HTTP_HOST'] : false; // make cookies work with localhost
        setcookie('bigfa_ding_' . $id, $id, $expire, '/', $domain, false);
        if (!$bigfa_raters || !is_numeric($bigfa_raters)) {
            update_post_meta($id, 'bigfa_ding', 1);
        } else {
            update_post_meta($id, 'bigfa_ding', ($bigfa_raters + 1));
        }
        echo get_post_meta($id, 'bigfa_ding', true);
    }
    die;
}

function e_secret($atts, $content = null) { //输入密码查看
    extract(shortcode_atts(array(
        'key' => null
    ) , $atts));
    if (isset($_POST['e_secret_key']) && $_POST['e_secret_key'] == $key) {
        return '<div class="e-secret">' . $content . '</div>';
    } else {
        return '<form class="e-secret" action="' . get_permalink() . '" method="post" name="e-secret"><label>请输入密码：</label><input type="password" name="e_secret_key" class="euc-y-i" maxlength="50"><input type="submit" class="euc-y-s" value="确定"><div class="euc-clear"></div></form>';
    }
}
//取消内容转义
remove_filter('the_content', 'wptexturize');
//取消摘要转义
remove_filter('the_excerpt', 'wptexturize');
//取消评论转义
remove_filter('comment_text', 'wptexturize');
//更改编辑器默认视图为HTML/文本
add_filter('wp_default_editor', create_function('', 'return "html";'));
//关闭wordpress各种更新，避免插件不兼容
//add_filter('pre_site_transient_update_core',create_function('$a', "return null;")); // 关闭核心提示
//add_filter('pre_site_transient_update_plugins',create_function('$a', "return null;")); // 关闭插件提示
//add_filter('pre_site_transient_update_themes',create_function('$a', "return null;")); // 关闭主题提示
remove_action('admin_init', '_maybe_update_core');  //禁止 WordPress 自动检查更新自动升级
//remove_action('admin_init', '_maybe_update_plugins'); // 禁止 WordPress 更新插件
//remove_action('admin_init', '_maybe_update_themes');  // 禁止 WordPress 更新主题

//禁用REST API功能代码
add_filter('rest_enabled', '__return_false');
add_filter('rest_jsonp_enabled', '__return_false');

//移除wp-json链接的代码
remove_action( 'wp_head', 'rest_output_link_wp_head', 10 );
remove_action( 'wp_head', 'wp_oembed_add_discovery_links', 10 );

// WordPress Emoji Delete
remove_action( 'admin_print_scripts' , 'print_emoji_detection_script');
remove_action( 'admin_print_styles' , 'print_emoji_styles');
remove_action( 'wp_head' , 'print_emoji_detection_script', 7);
remove_action( 'wp_print_styles' , 'print_emoji_styles');
remove_filter( 'the_content_feed' , 'wp_staticize_emoji');
remove_filter( 'comment_text_rss' , 'wp_staticize_emoji');
remove_filter( 'wp_mail' , 'wp_staticize_emoji_for_email');
add_filter( 'emoji_svg_url', create_function( '', 'return false;' ) );//禁用emoji预解析

add_filter('pre_option_link_manager_enabled', '__return_true'); //恢复wordpress删除的友情链接功能
add_shortcode('secret', 'e_secret');
remove_action('wp_head', 'wp_enqueue_scripts', 1); //Javascript的调用
remove_action('wp_head', 'feed_links', 2); //移除feed
remove_action('wp_head', 'feed_links_extra', 3); //移除feed
remove_action('wp_head', 'rsd_link'); //移除离线编辑器开放接口
remove_action('wp_head', 'wlwmanifest_link'); //移除离线编辑器开放接口
remove_action('wp_head', 'index_rel_link'); //去除本页唯一链接信息
remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);
remove_action('wp_head', 'locale_stylesheet');
remove_action('publish_future_post', 'check_and_publish_future_post', 10, 1);
remove_action('wp_head', 'noindex', 1);
remove_action('wp_head', 'wp_print_styles', 8); //载入css
remove_action('wp_head', 'wp_print_head_scripts', 9);
//remove_action('wp_head', 'wp_generator'); //移除WordPress版本
remove_action('wp_head', 'rel_canonical');
remove_action('wp_footer', 'wp_print_footer_scripts');
remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0);
remove_action('template_redirect', 'wp_shortlink_header', 11, 0);
add_action('widgets_init', 'my_remove_recent_comments_style');
function my_remove_recent_comments_style() {
    global $wp_widget_factory;
    remove_action('wp_head', array(
        $wp_widget_factory->widgets['WP_Widget_Recent_Comments'],
        'recent_comments_style'
    ));
}
//禁止加载WP自带的jquery.js
if (!is_admin()) { // 后台不禁止
    function my_init_method() {
        wp_deregister_script('jquery'); // 取消原有的 jquery 定义
        
    }
    add_action('init', 'my_init_method');
}
wp_deregister_script('l10n');
add_action('after_wp_tiny_mce', 'add_button_mce');

//扩展发表文章编辑器的导航标签
function add_button_mce($mce_settings) { 
?>
    <script type="text/javascript">
        QTags.addButton( '注意', '注意', "<span class='beCareful'>", "</span>" );
        QTags.addButton( '加密内容', '加密内容', "[secret key='123']", "[/secret]" );
        QTags.addButton( '视频', '视频', "[embed]", "[/embed]" );
        QTags.addButton( '登录可见', '登录可见', "[login_success]", "[/login_success]" );
        QTags.addButton( '前言', '前言', "<p class='con_info'>", "</p>" );
        QTags.addButton( '在线一览', '在线一览', "<a href='' target='_blank' id='domo'>", "在线一览</a>" );
        QTags.addButton( 'a', 'a', "<a href='' target='_blank'>", "</a>" );
        QTags.addButton( '[cc]', '[cc]', "[cc lang='php']\n", "\n[/cc]" );
        QTags.addButton( 'p', 'p', "<p>", "</p>" );
        QTags.addButton( 'li', 'li', "<li>", "</li>" );
        QTags.addButton( 'span', 'span', "<span>", "</span>" );
        QTags.addButton( 'h2', 'h2', "<h2>", "</h2>" );
        QTags.addButton( 'h3', 'h3', "<h3>", "</h3>" );
    </script>
<?php
}

//标签显示文章数
// function Tagno($text) {
//     $text = preg_replace_callback('|<a (.+?)</a>|i', 'tagnoCallback', $text);
//     return $text;
// }
// function tagnoCallback($matches) {
//     $text=$matches[1];
//     preg_match('|title=(.+?)style|i',$text ,$a);
//     preg_match("/[0-9]+/",$a[1],$a);
//     return "<a ".$text ."(".$a[0].")</a>";
// }
// add_filter('wp_tag_cloud', 'Tagno', 1);

// 自定义登录界面
function custom_login() {
    echo '<link rel="stylesheet" type="text/css" href="/wp-content/themes/Art_Blog/css/login.css" />';
}
add_action('login_head', 'custom_login');
function login_headerurl($url) {
    return get_bloginfo('url');
}
add_filter('login_headerurl', 'login_headerurl');
function login_headertitle($title) {
    return __(''); //输出标题，当前去掉了输出空
}
add_filter('login_headertitle', 'login_headertitle');

//WordPress新用户注册随机数学验证码
function add_security_question_fields() {
    //获取两个随机数, 范围0~9
    $num1=rand(0,9);
    $num2=rand(0,9);
    //最终网页中的具体内容
    echo "<p><label for='math' class='small'>验证码：$num1 + $num2 = ? </label><input type='text' name='sum' class='input' value='' size='25'>"
    ."<input type='hidden' name='num1' value='$num1'>"
    ."<input type='hidden' name='num2' value='$num2'></p>";}
    add_action('register_form','add_security_question_fields');
    add_action( 'register_post', 'add_security_question_validate', 10, 3 );
    function add_security_question_validate( $sanitized_user_login, $user_email, $errors) {
    $sum=$_POST['sum'];//用户提交的计算结果
    switch($sum){
        //得到正确的计算结果则直接跳出
        case $_POST['num1']+$_POST['num2']:break;
        //未填写结果时的错误讯息
        case null:wp_die('错误：请输入验证码！');break;
        //计算错误时的错误讯息
        default:wp_die('错误：验证码错误,请重试！');
    }
}
add_action( 'add_security_question','register_form' );

//添加百度是否收录(php baidu_record())
function baidu_check($url){
    $url='http://www.baidu.com/s?wd='.$url;
    $curl=curl_init();
    curl_setopt($curl,CURLOPT_URL,$url);
    curl_setopt($curl,CURLOPT_RETURNTRANSFER,1);
    $rs=curl_exec($curl);
    curl_close($curl);
    if(!strpos($rs,'没有找到')){
    return 1;
    }else{
    return 0;
    }
    }
    function baidu_record() {
    if( is_single() && current_user_can( 'manage_options') )//判断管理员输出
    if(baidu_check(get_permalink()) == 1) {
    echo '<a target="_blank" title="点击查看" rel="external nofollow" href="https://www.baidu.com/s?wd='.get_the_title().'">百度已收录</a>';
     } else {
     echo '<a rel="external nofollow" title="一键帮忙提交给百度收录，谢谢哦！" target="_blank" href="https://zhanzhang.baidu.com/sitesubmit/index?sitename='.get_permalink().'">推荐给百度</a>';
     }
    }

// 面包屑导航注册代码
function wheatv_breadcrumbs() {
    $delimiter = '<i>&gt;</i>';
    $name = '当前位置:'; //text for the 'Home' link
    $currentBefore = '';
    $currentAfter = '';
    if (!is_home() && !is_front_page() || is_paged()) {
        echo '';
        global $post;
        // $home = get_bloginfo('url');
        $home = get_option('home');
        echo '<a href="' . $home . '" >' . $name . ' </a>';
        if (is_category()) {
            global $wp_query;
            $cat_obj = $wp_query->get_queried_object();
            $thisCat = $cat_obj->term_id;
            $thisCat = get_category($thisCat);
            $parentCat = get_category($thisCat->parent);
            if ($thisCat->parent != 0) echo (get_category_parents($parentCat, TRUE, ' ' . $delimiter . ' '));
            echo $currentBefore . '';
            single_cat_title();
            echo '' . $currentAfter;
        } elseif (is_day()) {
            echo '' . get_the_time('Y') . ' ' . $delimiter . ' ';
            echo '' . get_the_time('F') . ' ' . $delimiter . ' ';
            echo $currentBefore . get_the_time('d') . $currentAfter;
        } elseif (is_month()) {
            echo '' . get_the_time('Y') . ' ' . $delimiter . ' ';
            echo $currentBefore . get_the_time('F') . $currentAfter;
        } elseif (is_year()) {
            echo $currentBefore . get_the_time('Y') . $currentAfter;
        } elseif (is_single()) {
            $cat = get_the_category();
            $cat = $cat[0];
            echo get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
            echo $currentBefore;
            the_title();
            echo $currentAfter;
        } elseif (is_page() && !$post->post_parent) {
            echo $currentBefore;
            the_title();
            echo $currentAfter;
        } elseif (is_page() && $post->post_parent) {
            $parent_id = $post->post_parent;
            $breadcrumbs = array();
            while ($parent_id) {
                $page = get_page($parent_id);
                $breadcrumbs[] = '' . get_the_title($page->ID) . '';
                $parent_id = $page->post_parent;
            }
            $breadcrumbs = array_reverse($breadcrumbs);
            foreach ($breadcrumbs as $crumb) echo $crumb . ' ' . $delimiter . ' ';
            echo $currentBefore;
            the_title();
            echo $currentAfter;
        } elseif (is_search()) {
            echo $currentBefore . '搜索结果' . get_search_query() . '' . $currentAfter;
        } elseif (is_tag()) {
            echo $currentBefore . '搜索标签： ';
            single_tag_title();
            echo '' . $currentAfter;
        } elseif (is_author()) {
            global $author;
            $userdata = get_userdata($author);
            echo $currentBefore . 'Articles posted by ' . $userdata->display_name . $currentAfter;
        } elseif (is_404()) {
            echo $currentBefore . 'Error 404' . $currentAfter;
        }
        if (get_query_var('paged')) {
            if (is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author()) echo ' (';
            echo __('第') . '' . get_query_var('paged') . '页';
            if (is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author()) echo ')';
        }
        echo '';
    }
}

//评论 VIP 标志
function get_author_class($comment_author_email, $comment_author_url) {
    global $wpdb;
    $adminEmail = '343049466@qq.com';
    $author_count = count($wpdb->get_results("SELECT comment_ID as author_count FROM $wpdb->comments WHERE comment_author_email = '$comment_author_email' "));
    if ($comment_author_email == $adminEmail) echo '<a class="vp" target="_blank" href="/category/about" title="经鉴定，管理员"></a>';
    $linkurls = $wpdb->get_results("SELECT link_url FROM $wpdb->links WHERE link_url = '$comment_author_url'");
    foreach ($linkurls as $linkurl) {
        if ($linkurl->link_url == $comment_author_url) echo '<a class="vip" target="_blank" href="/links.html" title="合作商或友情链接认证"><i class="wi wi-heart"></i></a>';
    }
    if ($author_count >= 1 && $author_count < 5 && $comment_author_email != $adminEmail) echo '<a class="vip1" target="_blank" href="/category/about" title="评论之星 LV.1"><i class="wi wi-level-1"></i></a>';
    else if ($author_count >= 5 && $author_count < 10 && $comment_author_email != $adminEmail) echo '<a class="vip2" target="_blank" href="/category/about" title="评论之星 LV.2"><i class="wi wi-level-2"></i></a>';
    else if ($author_count >= 10 && $author_count < 25 && $comment_author_email != $adminEmail) echo '<a class="vip3" target="_blank" href="/category/about" title="评论之星 LV.3"><i class="wi wi-level-3"></i></a>';
    else if ($author_count >= 25 && $author_count < 50 && $comment_author_email != $adminEmail) echo '<a class="vip4" target="_blank" href="/category/about" title="评论之星 LV.4"><i class="wi wi-level-4"></i></a>';
    else if ($author_count >= 50 && $author_count < 100 && $comment_author_email != $adminEmail) echo '<a class="vip5" target="_blank" href="/category/about" title="评论之星 LV.5"><i class="wi wi-level-5"></i></a>';
    else if ($author_count >= 100 && $author_count < 250 && $comment_author_email != $adminEmail) echo '<a class="vip6" target="_blank" href="/category/about" title="评论之星 LV.6"><i class="wi wi-level-6"></i></a>';
    else if ($author_count >= 250 && $comment_author_email != $adminEmail) echo '<a class="vip7" target="_blank" href="/category/about" title="评论之星 LV.7"><i class="wi wi-level-7"></i></a>';
}
//获取用户UA信息,包括浏览器和系统等 调用:echo user_agent($comment->comment_agent);
function user_agent($ua) {
    //解析操作系统start
    $os = null;
    if (preg_match('/Windows 95/i', $ua) || preg_match('/Win95/', $ua)) {
        $os = "Windows 95";
    } elseif (preg_match('/Windows NT 5.0/i', $ua) || preg_match('/Windows 2000/i', $ua)) {
        $os = "Windows 2000";
    } elseif (preg_match('/Win 9x 4.90/i', $ua) || preg_match('/Windows ME/i', $ua)) {
        $os = "Windows ME";
    } elseif (preg_match('/Windows.98/i', $ua) || preg_match('/Win98/i', $ua)) {
        $os = "Windows 98";
    } elseif (preg_match('/Windows NT 6.0/i', $ua)) {
        $os = "Windows Vista";
    } elseif (preg_match('/Windows NT 6.1/i', $ua)) {
        $os = "Windows 7";
    } elseif (preg_match('/Windows NT 5.1/i', $ua)) {
        $os = "Windows XP";
    } elseif (preg_match('/Windows NT 5.2/i', $ua) && preg_match('/Win64/i', $ua)) {
        $os = "Windows XP 64 bit";
    } elseif (preg_match('/Windows NT 5.2/i', $ua)) {
        $os = "Windows Server 2003";
    } elseif (preg_match('/Mac_PowerPC/i', $ua)) {
        $os = "Mac OS";
    } elseif (preg_match('/Windows Phone/i', $ua)) {
        $os = "Windows Phone7";
    } elseif (preg_match('/Windows NT 6.2/i', $ua)) {
        $os = "Windows 8";
    } elseif (preg_match('/Windows NT 4.0/i', $ua) || preg_match('/WinNT4.0/i', $ua)) {
        $os = "Windows NT 4.0";
    } elseif (preg_match('/Windows NT/i', $ua) || preg_match('/WinNT/i', $ua)) {
        $os = "Windows NT";
    } elseif (preg_match('/Windows CE/i', $ua)) {
        $os = "Windows CE";
    } elseif (preg_match('/ipad/i', $ua)) {
        $os = "iPad";
    } elseif (preg_match('/Touch/i', $ua)) {
        $os = "Touchw";
    } elseif (preg_match('/Symbian/i', $ua) || preg_match('/SymbOS/i', $ua)) {
        $os = "Symbian OS";
    } elseif (preg_match('/iPhone/i', $ua)) {
        $os = "iPhone";
    } elseif (preg_match('/PalmOS/i', $ua)) {
        $os = "Palm OS";
    } elseif (preg_match('/QtEmbedded/i', $ua)) {
        $os = "Qtopia";
    } elseif (preg_match('/Ubuntu/i', $ua)) {
        $os = "Ubuntu Linux";
    } elseif (preg_match('/Gentoo/i', $ua)) {
        $os = "Gentoo Linux";
    } elseif (preg_match('/Fedora/i', $ua)) {
        $os = "Fedora Linux";
    } elseif (preg_match('/FreeBSD/i', $ua)) {
        $os = "FreeBSD";
    } elseif (preg_match('/NetBSD/i', $ua)) {
        $os = "NetBSD";
    } elseif (preg_match('/OpenBSD/i', $ua)) {
        $os = "OpenBSD";
    } elseif (preg_match('/SunOS/i', $ua)) {
        $os = "SunOS";
    } elseif (preg_match('/Linux/i', $ua)) {
        $os = "Linux";
    } elseif (preg_match('/Mac OS X/i', $ua)) {
        $os = "Mac OS X";
    } elseif (preg_match('/Macintosh/i', $ua)) {
        $os = "Mac OS";
    } elseif (preg_match('/Unix/i', $ua)) {
        $os = "Unix";
    } elseif (preg_match('#Nokia([a-zA-Z0-9.]+)#i', $ua, $matches)) {
        $os = "Nokia" . $matches[1];
    } elseif (preg_match('/Mac OS X/i', $ua)) {
        $os = "Mac OS X";
    } else {
        $os = '未知操作系统';
    }
    //解析浏览器start
    if (preg_match('#(Camino|Chimera)[ /]([a-zA-Z0-9.]+)#i', $ua, $matches)) {
        $browser = 'Camino ' . $matches[2];
    } elseif (preg_match('#SE 2([a-zA-Z0-9.]+)#i', $ua, $matches)) {
        $browser = '搜狗浏览器 2' . $matches[1];
    } elseif (preg_match('#360([a-zA-Z0-9.]+)#i', $ua, $matches)) {
        $browser = '360浏览器 ' . $matches[1];
    } elseif (preg_match('#Maxthon( |\/)([a-zA-Z0-9.]+)#i', $ua, $matches)) {
        $browser = 'Maxthon ' . $matches[2];
    } elseif (preg_match('#Chrome/([a-zA-Z0-9.]+)#i', $ua, $matches)) {
        $browser = 'Chrome ' . $matches[1];
    } elseif (preg_match('#Safari/([a-zA-Z0-9.]+)#i', $ua, $matches)) {
        $browser = 'Safari ' . $matches[1];
    } elseif (preg_match('#opera mini#i', $ua)) {
        $browser = 'Opera Mini ' . $matches[1];
    } elseif (preg_match('#Opera.([a-zA-Z0-9.]+)#i', $ua, $matches)) {
        $browser = 'Opera ' . $matches[1];
    } elseif (preg_match('#(j2me|midp)#i', $ua)) {
        $browser = "J2ME/MIDP Browser";
    } elseif (preg_match('/GreenBrowser/i', $ua)) {
        $browser = 'GreenBrowser';
    } elseif (preg_match('#TencentTraveler ([a-zA-Z0-9.]+)#i', $ua, $matches)) {
        $browser = '腾讯TT浏览器 ' . $matches[1];
    } elseif (preg_match('#UCWEB([a-zA-Z0-9.]+)#i', $ua, $matches)) {
        $browser = 'UCWEB ' . $matches[1];
    } elseif (preg_match('#MSIE ([a-zA-Z0-9.]+)#i', $ua, $matches)) {
        $browser = 'Internet Explorer ' . $matches[1];
    } elseif (preg_match('#avantbrowser.com#i', $ua)) {
        $browser = 'Avant Browser';
    } elseif (preg_match('#PHP#', $ua, $matches)) {
        $browser = 'PHP';
    } elseif (preg_match('#danger hiptop#i', $ua, $matches)) {
        $browser = 'Danger HipTop';
    } elseif (preg_match('#Shiira[/]([a-zA-Z0-9.]+)#i', $ua, $matches)) {
        $browser = 'Shiira ' . $matches[1];
    } elseif (preg_match('#Dillo[ /]([a-zA-Z0-9.]+)#i', $ua, $matches)) {
        $browser = 'Dillo ' . $matches[1];
    } elseif (preg_match('#Epiphany/([a-zA-Z0-9.]+)#i', $ua, $matches)) {
        $browser = 'Epiphany ' . $matches[1];
    } elseif (preg_match('#UP.Browser/([a-zA-Z0-9.]+)#i', $ua, $matches)) {
        $browser = 'Openwave UP.Browser ' . $matches[1];
    } elseif (preg_match('#DoCoMo/([a-zA-Z0-9.]+)#i', $ua, $matches)) {
        $browser = 'DoCoMo ' . $matches[1];
    } elseif (preg_match('#(Firefox|Phoenix|Firebird|BonEcho|GranParadiso|Minefield|Iceweasel)/([a-zA-Z0-9.]+)#i', $ua, $matches)) {
        $browser = 'Firefox ' . $matches[2];
    } elseif (preg_match('#(SeaMonkey)/([a-zA-Z0-9.]+)#i', $ua, $matches)) {
        $browser = 'Mozilla SeaMonkey ' . $matches[2];
    } elseif (preg_match('#Kazehakase/([a-zA-Z0-9.]+)#i', $ua, $matches)) {
        $browser = 'Kazehakase ' . $matches[1];
    } else {
        $browser = '未知浏览器';
    }
    return "<span class='system'>" . $os . "</span>  <span class='browser'>" . $browser . "</span>";
}
//自定义评论列表模板
function dedewp_comment_add_at($comment_text, $comment = '') {
    if ($comment->comment_parent > 0) {
        $comment_text = '<a  class="action" href="#comment-' . $comment->comment_parent . '">@' . get_comment_author($comment->comment_parent) . '</a>' . $comment_text;
    }
    return $comment_text;
}
add_filter('get_comment_text', 'dedewp_comment_add_at', 20, 2);
function simple_comment($comment, $args, $depth) {
    $GLOBALS['comment'] = $comment; ?>
    <li class="comment" id="li-comment-<?php
    comment_ID(); ?>">
        <div class="media">
            <div class="media-left">
            <?php
                echo '<img src=https://q.qlogo.cn/headimg_dl?bs=qq&dst_uin='. (get_comment_author_email()?get_comment_author_email():1) .'&src_uin=qq.feixue.me&fid=blog&spec=100&id='.rand(1,1000).'>'
                //通过wordpress自身获取图像
                // if (function_exists('get_avatar') && get_option('show_avatars')) {
                //     echo get_avatar($comment, 48);
                // }
            ?>
            </div>
            <div class="media-body">
                <?php
                    printf(__('<span class="author_name">%s</span>') , get_comment_author_link()); ?>
                <!-- vip等级 -->
                <span class="comment_vip">
                    <?php
                        get_author_class($comment->comment_author_email, $comment->comment_author_url) ?>
                </span>
                <!-- 评论用户系统信息 -->
                <?php
                    echo user_agent($comment->comment_agent); ?>
                <?php
                    if ($comment->comment_approved == '0'): ?>
                    <em>评论等待审核...</em><br />
                <?php
                    endif; ?>
                <?php
                    comment_text(); ?>
            </div>
        </div>
        <div class="comment-metadata">
            <span class="comment-pub-time">
                <?php
                    echo get_comment_time('Y-m-d H:i'); ?>
            </span>
            <span class="comment-btn-reply">
                <i class="fa fa-reply"></i> <?php
                comment_reply_link(array_merge($args, array(
                    'reply_text' => '回复',
                    'depth' => $depth,
                    'null' => $args['max_depth']
                ))) ?> 
            </span>
        </div>
    <?php
}
// require_once(TEMPLATEPATH . 'include/xm-api.php');

// 给回复评论用户进行邮件反馈
function ludou_comment_mail_notify($comment_id, $comment_status) {
    // 评论必须经过审核才会发送通知邮件
    if ($comment_status !== 'approve' && $comment_status !== 1)
      return;
    
    $comment = get_comment($comment_id);
  
    if ($comment->comment_parent != '0') {
      $parent_comment = get_comment($comment->comment_parent);
  
      // 邮件接收者email      
      $to = trim($parent_comment->comment_author_email);
      
      // 邮件标题
      $subject = '您在[' . get_option("blogname") . ']的留言有了新的回复';
  
      // 邮件内容，自行修改，支持HTML
      $message = '<div style="border-right:#666666 1px solid;border-radius:8px;color:#111;font-size:12px;width:702px;    border-bottom:#666666 1px solid;font-family:微软雅黑,arial;margin:10px auto 0px;border-top:#666666 1px solid;border-left:#666666 1px solid"><div class="adM">
        </div><div style="width:100%;background:#666666;min-height:60px;color:white;border-radius:6px 6px 0 0"><span style="line-height:60px;min-height:60px;margin-left:30px;font-size:12px">您在<a style="color:#00bbff;font-weight:600;text-decoration:none" href="' . get_option('home') . '" target="_blank">' . get_option('blogname') . '</a> 上的留言有回复啦！</span> </div>
        <div style="margin:0px auto;width:90%">
        <p>' . trim($parent_comment->comment_author) . ', 您好！</p>
        <p>您于' . trim($parent_comment->comment_date) . ' 在文章《' . get_the_title($comment->comment_post_ID) . '》上发表的评论: </p>
        <p style="border-bottom:#ddd 1px solid;border-left:#ddd 1px solid;padding-bottom:20px;background-color:#eee;margin:15px 0px;padding-left:20px;padding-right:20px;border-top:#ddd 1px solid;border-right:#ddd 1px solid;padding-top:20px">' . nl2br($parent_comment->comment_content) . '</p>
        <p>' . trim($comment->comment_author) . ' 于' . trim($comment->comment_date) . ' 给您的回复如下: </p>
        <p style="border-bottom:#ddd 1px solid;border-left:#ddd 1px solid;padding-bottom:20px;background-color:#eee;margin:15px 0px;padding-left:20px;padding-right:20px;border-top:#ddd 1px solid;border-right:#ddd 1px solid;padding-top:20px">' . nl2br($comment->comment_content) . '</p>
        <p>您可以点击 <a style="color:#00bbff;text-decoration:none" href="' . htmlspecialchars(get_comment_link($comment->comment_parent)). '" target="_blank">查看回复的完整內容</a></p>
        <p>感谢您对 <a style="color:#00bbff;text-decoration:none" href="' . get_option('home') . '" target="_blank">' . get_option('blogname') . '</a> 的关注，如您有任何疑问，欢迎在博客留言，我都会一一解答，么么哒！！！</p><p>(此邮件由系统自动发出，请勿回复。)</p></div></div>';
  
      $message_headers = "Content-Type: text/html; charset=\"".get_option('blog_charset')."\"\n";
      
      // 不用给不填email的评论者和管理员发提醒邮件
      if($to != '' && $to != get_bloginfo('admin_email'))
        @wp_mail($to, $subject, $message, $message_headers);
    }
  }
   
  // 编辑和管理员的回复直接发送提醒邮件，因为编辑和管理员的评论不需要审核
  add_action('comment_post', 'ludou_comment_mail_notify', 20, 2);
  
  // 普通访客发表的评论，等博主审核后再发送提醒邮件
  add_action('wp_set_comment_status', 'ludou_comment_mail_notify', 20, 2);
?>
