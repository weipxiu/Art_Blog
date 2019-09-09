<?php
/**
 * 删除不需要的字段
 */
function xm_rest_prepare_post ($data, $post, $request)
{
  $_data = $data -> data;
  $params = $request -> get_params();
  unset($_data['template']);
  unset($_data['categories']);
  unset($_data['excerpt']);
  $data -> data = $_data;
  return $data;
}

add_filter('rest_prepare_post', 'xm_rest_prepare_post', 10, 3);

/**
 * 获取网站基本信息
 */
function add_get_blog_info ()
{
  global $wpdb;
  // 获取最后更新时间
  $last = $wpdb -> get_results("SELECT MAX(post_modified) AS MAX_m FROM $wpdb->posts WHERE (post_type = 'post' OR post_type = 'page') AND (post_status = 'publish' OR post_status = 'private')");
  $last = date('Y-n-j', strtotime($last[0] -> MAX_m));
  // 获取最新评论
  $newComment = get_comments(array(
    'number' => 10,
    'status' => 'approve',
    'type' => 'comment',
    'user_id' => 0,
    'post_type' => 'post'
  ));
  for ($i = 0; $i < count($newComment); $i++) {
    $newComment[$i] -> avatar = 'https://www.gravatar.com/avatar/' . md5(strtolower(trim($newComment[$i] -> comment_author_email))) . '?s=200';
    $newComment[$i] -> background = '#' . substr(md5(strtolower(trim($newComment[$i] -> comment_author_email))), 0, 6);
    $newComment[$i] -> countCom = get_comments_number($newComment[$i] -> comment_post_ID);
    $newComment[$i] -> link = get_post_meta($newComment[$i] -> comment_post_ID, 'xm_post_link', true)['very_good'];
    $newComment[$i] -> title = get_the_title($newComment[$i] -> comment_post_ID);
  }
  $array = array(
    'baseUrl' => get_option('weipxiu_options')['domain'],
    'isTextThumbnail' => get_option('weipxiu_options')['text_pic'],
    'detailsCss' => get_option('weipxiu_options')['details_css'],
    'adminAjax' => admin_url('admin-ajax.php'),
    'templeteUrl' => get_option('weipxiu_options')['domain'] . '/wp-content/themes/' . get_option('template'),
    'contentUrl' => '/wp-content',
    'blogName' => get_bloginfo('name'),
    'blogDescription' => get_bloginfo('description'),
    'rewardText' => get_option('weipxiu_options')['reward_text'],
    'alipay' => get_option('weipxiu_options')['alipay'],
    'wechatpay' => get_option('weipxiu_options')['wechatpay'],
    'adminPic' => get_the_author_meta('simple_local_avatar', 1),
    'setExtend' => get_option('weipxiu_options'),
    'banner' => get_option('weipxiu_options')['banner'],
    'logo' => get_option('weipxiu_options')['logo'],
    'tagCloud' => get_tags(array('orderby' => 'count', 'order' => 'DESC')),
    'getAllCountArticle' => wp_count_posts() -> publish,
    'getAllCountCat' => wp_count_terms('category'),
    'getAllCountTag' => wp_count_terms('post_tag'),
    'getAllCountPage' => wp_count_posts('page') -> publish,
    'getAllCountComment' => $wpdb -> get_var("SELECT COUNT(*) FROM $wpdb->comments"),
    'lastUpDate' => $last,
    'getSidebarCount' => get_option('weipxiu_options')['aside_count'],
    'link' => get_option('weipxiu_options')['link'],
    'newArticle' => $wpdb -> get_results("SELECT ID,post_title FROM $wpdb->posts where post_status='publish' and post_type='post' ORDER BY ID DESC LIMIT 0 , 10"),
    'newComment' => $newComment
  );
  return $array;
}

add_action('rest_api_init', function () {
  register_rest_route('xm-blog/v1', '/info', array('methods' => 'GET', 'callback' => 'add_get_blog_info'));
});

/**
 * 发表意见
 */
function xm_opinion ($request)
{
  $data = $request -> get_params();
  $count_key = 'xm_post_link';
  $id = $data['id'];
  $key = $data['key'];
  $count = get_post_meta($id, $count_key, true);
  update_post_meta($id, $count_key, array_merge($count, array($key => $count[$key] + 1)));
  return $count[$key] + 1;
}

add_action('rest_api_init', function () {
  register_rest_route('xm-blog/v1', '/link/', array('methods' => 'POST', 'callback' => 'xm_opinion'));
});

/**
 * 更新阅读量
 */
function xm_get_view_count ($request)
{
  $postID = $request -> get_params()['id'];
  $count_key = 'post_views_count';
  $count = get_post_meta($postID, $count_key, true);
  if ($count == '') {
    $count = 0;
    delete_post_meta($postID, $count_key);
    add_post_meta($postID, $count_key, '0');
  } else {
    $count++;
    update_post_meta($postID, $count_key, $count);
  }
  return $count;
}

add_action('rest_api_init', function () {
  register_rest_route('xm-blog/v1', '/view-count/', array('methods' => 'POST', 'callback' => 'xm_get_view_count',));
});

/**
 * 获取主菜单
 */
function xm_get_menu ()
{
  $array_menu = wp_get_nav_menu_items('Home');
  $menu = array();
  foreach ($array_menu as $m) {
    if (empty($m -> menu_item_parent)) {
      $menu[$m -> ID] = array();
      $menu[$m -> ID]['ID'] = $m -> object_id;
      $menu[$m -> ID]['title'] = $m -> title;
      $menu[$m -> ID]['url'] = $m -> url;
      $menu[$m -> ID]['type'] = $m -> object;
      $menu[$m -> ID]['icon'] = implode(' ', $m -> classes);
      $menu[$m -> ID]['children'] = array();
    }
  }
  $submenu = array();
  foreach ($array_menu as $m) {
    if ($m -> menu_item_parent) {
      $submenu[$m -> ID] = array();
      $submenu[$m -> ID]['ID'] = $m -> object_id;
      $submenu[$m -> ID]['title'] = $m -> title;
      $submenu[$m -> ID]['url'] = $m -> url;
      $submenu[$m -> ID]['type'] = $m -> object;
      $submenu[$m -> ID]['icon'] = implode(' ', $m -> classes);
      $menu[$m -> menu_item_parent]['children'][$m -> ID] = $submenu[$m -> ID];
    }
  }
  return array(
    'mainMenu' => $menu,
    'subMenu' => wp_get_nav_menu_items('SubMenu')
  );
}

add_action('rest_api_init', function () {
  register_rest_route('xm-blog/v1', '/menu', array('methods' => 'GET', 'callback' => 'xm_get_menu'));
});

/**
 * 获取page添加自定义字段
 */
function add_api_page_meta_field ()
{
  register_rest_field('page', 'pageInfor', array(
    'get_callback' => function () {
      $array = array('commentCount' => get_comments_number());
      return $array;
    },
    'schema' => null,
  ));
}

add_action('rest_api_init', 'add_api_page_meta_field');

/**
 * 获取用户添加自定义字段
 */
function add_api_user_meta_field ()
{
  register_rest_field('user', 'meta', array(
    'get_callback' => function () {
      $id = intval($_GET['id']);
      $array = array(
        'qq' => get_the_author_meta('qq', $id),
        'github' => get_the_author_meta('github_url', $id),
        'wechat_num' => get_the_author_meta('wechat_num', $id),
        'wechat_img' => get_the_author_meta('wechat_img', $id),
        'sina_url' => get_the_author_meta('sina_url', $id),
        'sex' => get_the_author_meta('sex', $id)
      );
      return $array;
    },
    'schema' => null,
  ));
}

add_action('rest_api_init', 'add_api_user_meta_field');

/**
 * 评论添加字段
 */
// 判断浏览器型号
function get_browser_name ($str)
{
  $matches['ua'] = $str;
  // 判断系统
  if (preg_match('/Maci/', $str)) {
    // mac
    preg_match_all('/(?P<system>Mac(\s\w+)+\s(?P<version>(\d+\.\d+)|\d+(_\d+){2}))/i', $str, $match, PREG_SET_ORDER);
    $matches['system'] = 'Mac ' . $match[0]['version'];
  } else if (preg_match('/iPad|iPhone/', $str)) {
    // iPad or iphone
    preg_match_all('/(?P<system>\w+);(\s[a-zA-Z]+)+\s(?P<version>\d+_\d+)/i', $str, $match, PREG_SET_ORDER);
    $matches['system'] = $match[0]['system'] . ' ' . $match[0]['version'];
  } else if (preg_match('/Android/', $str)) {
    // Android
    preg_match_all('/(?P<system>Android\s\d+\.\d+)/i', $str, $match, PREG_SET_ORDER);
    $matches['system'] = $match[0]['system'];
  } else if (preg_match('/Wind/', $str)) {
    // windows
    preg_match_all('/(?P<system>Windows\sNT\s\d+\.\d+)/i', $str, $match, PREG_SET_ORDER);
    if (strpos($match[0]['system'], '6.1')) {
      $matches['system'] = str_replace(' NT 6.1', ' 7', $match[0]['system']);
    } else if (strpos($match[0]['system'], '6.2')) {
      $matches['system'] = str_replace(' NT 6.2', ' 8', $match[0]['system']);
    } else if (strpos($match[0]['system'], '6.3')) {
      $matches['system'] = str_replace(' NT 6.3', ' 8.1', $match[0]['system']);
    } else if (strpos($match[0]['system'], '10.0')) {
      $matches['system'] = str_replace(' NT 10.0', ' 10', $match[0]['system']);
    } else if (strpos($match[0]['system'], '5.1')) {
      $matches['system'] = str_replace(' NT 5.1', ' XP', $match[0]['system']);
    }
  } else {
    $matches['system'] = 'Unknown';
  }

  // 判断浏览器信息
  if (preg_match('/QQBrowser/', $str)) {
    // QQ浏览器
    preg_match_all('/(?P<name>QQBrowser)\/(?P<version>(\d+\.\d+))/i', $str, $match, PREG_SET_ORDER);
    $matches['browserVersion'] = $match[0]['version'];
    $matches['browserName'] = $match[0]['name'];
  } else if (preg_match('/MicroMessenger/', $str)) {
    // 微信内置浏览器
    preg_match_all('/(?P<name>MicroMessenger)\/(?P<version>(\d+\.\d+))/i', $str, $match, PREG_SET_ORDER);
    $matches['browserVersion'] = $match[0]['version'];
    $matches['browserName'] = 'wechat';
  } else if (preg_match('/QQ\/\d/', $str)) {
    // QQ
    preg_match_all('/(?P<name>QQ)\/(?P<version>(\d+\.\d+))/i', $str, $match, PREG_SET_ORDER);
    $matches['browserVersion'] = $match[0]['version'];
    $matches['browserName'] = $match[0]['name'];
  } else if (preg_match('/UCBrowser/', $str)) {
    // UC
    preg_match_all('/(?P<name>UCBrowser)\/(?P<version>(\d+\.\d+))/i', $str, $match, PREG_SET_ORDER);
    $matches['browserVersion'] = $match[0]['version'];
    $matches['browserName'] = $match[0]['name'];
  } else if (preg_match('/Edge/', $str)) {
    // edge
    preg_match_all('/(?P<name>Edge)\/(?P<version>(\d+\.\d+))/i', $str, $match, PREG_SET_ORDER);
    $matches['browserVersion'] = $match[0]['version'];
    $matches['browserName'] = $match[0]['name'];
  } else if (preg_match('/OPR/', $str)) {
    // opera
    preg_match_all('/(?P<name>OPR)\/(?P<version>(\d+\.\d+))/i', $str, $match, PREG_SET_ORDER);
    $matches['browserVersion'] = $match[0]['version'];
    $matches['browserName'] = 'Opera';
  } else if (preg_match('/Chrome|MetaSr/', $str)) {
    // chrome
    preg_match_all('/(?P<name>(Chrome))\/(?P<version>(\d+\.\d+))/i', $str, $match, PREG_SET_ORDER);
    $matches['browserVersion'] = $match[0]['version'];
    $matches['browserName'] = $match[0]['name'];
  } else if (preg_match('/Safari/', $str)) {
    // safari
    preg_match_all('/(?P<name>Version\/\d+\.\d+)/i', $str, $match, PREG_SET_ORDER);
    $matches['browserVersion'] = str_replace('Version/', '', $match[0]['name']);
    $matches['browserName'] = 'Safari';
  } else if (preg_match('/Firefox/', $str)) {
    // Firefox
    preg_match_all('/(?P<name>Firefox)\/(?P<version>(\d+\.\d+))/i', $str, $match, PREG_SET_ORDER);
    $matches['browserVersion'] = $match[0]['version'];
    $matches['browserName'] = $match[0]['name'];
  } else if (preg_match('/Trident/', $str)) {
    // IE
    preg_match_all('/MSIE\s(?P<version>(\d+\.\d+))/i', $str, $match, PREG_SET_ORDER);
    $matches['browserVersion'] = $match[0]['version'];
    $matches['browserName'] = 'Internet-Explorer';
  } else {
    $matches['browserVersion'] = 'Unknown';
    $matches['browserName'] = 'Unknown';
  }
  return $matches;
}

// 访客等级
function get_author_class ($comment_author_email)
{
  global $wpdb;
  $adminEmail = get_bloginfo('admin_email');
  $styleClass = get_option('weipxiu_options')['vip_style'];
  $author_count = count($wpdb -> get_results("SELECT comment_ID as author_count FROM $wpdb->comments WHERE comment_author_email = '$comment_author_email'"));
  if ($comment_author_email == $adminEmail) {
    return array('style' => $styleClass, 'level' => 'vip7', 'admin' => true, 'title' => '博主');
  } else {
    if ($author_count >= 1 && $author_count < 10) {
      return array('style' => $styleClass, 'level' => 'vip1', 'title' => 'LV.1');
    } else if ($author_count >= 10 && $author_count < 20) {
      return array('style' => $styleClass, 'level' => 'vip2', 'title' => 'LV.2');
    } else if ($author_count >= 20 && $author_count < 40) {
      return array('style' => $styleClass, 'level' => 'vip3', 'title' => 'LV.3');
    } else if ($author_count >= 40 && $author_count < 80) {
      return array('style' => $styleClass, 'level' => 'vip4', 'title' => 'LV.4');
    } else if ($author_count >= 80 && $author_count < 160) {
      return array('style' => $styleClass, 'level' => 'vip5', 'title' => 'LV.5');
    } else if ($author_count >= 160 && $author_count < 300) {
      return array('style' => $styleClass, 'level' => 'vip6', 'title' => 'LV.6');
    } else if ($author_count >= 300) {
      return array('style' => $styleClass, 'level' => 'vip7', 'title' => '博主好基友');
    }
  }
}

function add_api_comment_meta_field ()
{
  register_rest_field('comment', 'userAgentInfo', array(
    'get_callback' => function ($object) {
      $array = array(
        'userAgent' => get_browser_name($object[author_user_agent]),
        'vipStyle' => get_author_class($object[author_email]),
        'author_avatar_urls' => 'https://www.gravatar.com/avatar/' . md5(strtolower(trim($object[author_email]))) . '?s=200',
        'background' => '#' . substr(md5(strtolower(trim($object[author_email]))), 0, 6)
      );
      return $array;
    },
    'schema' => null
  ));
}

add_action('rest_api_init', 'add_api_comment_meta_field');

/**
 * 添加自定义字段
 */
function add_api_posts_meta_field ()
{
  // 获取文章相关信息
  register_rest_field('post', 'articleInfor', array('get_callback' => 'xm_get_article_infor', 'schema' => null,));
}

function xm_get_article_infor ($object)
{
  $postID = $object['id'];
  // 添加发表意见默认值
  if (get_post_meta($postID, 'xm_post_link', true) === '') {
    add_post_meta($postID, 'xm_post_link', array(
      'very_good' => 0,
      'good' => 0,
      'commonly' => 0,
      'bad' => 0,
      'very_bad' => 0
    ));
  }
  $current_category = get_the_category($postID);
  $array = array(
    'author' => get_the_author(),
    'other' => array(
      'authorPic' => get_the_author_meta('simple_local_avatar'),
      'authorTro' => get_the_author_meta('description'),
      'github' => get_the_author_meta('github_url'),
      'qq' => get_the_author_meta('qq'),
      'wechatNum' => get_the_author_meta('wechat_num'),
      'wechatPic' => get_the_author_meta('wechat_img'),
      'sina' => get_the_author_meta('sina_url'),
      'email' => get_the_author_meta('user_email'),
    ),
    'thumbnail' => wp_get_attachment_image_src(get_post_thumbnail_id($postID), 'Full')[0],
    'viewCount' => get_post_meta($postID, 'post_views_count', true) === '' ? 0 : get_post_meta($postID, 'post_views_count', true),
    'commentCount' => get_comments_number(),
    'xmLike' => get_post_meta($postID, 'xm_post_link', true),
    'summary' => xm_get_post_excerpt(300, ''),
    'classify' => get_the_category(),
    'tags' => get_the_tags($postID),
    'prevLink' => get_previous_post($current_category, ''),
    'nextLink' => get_next_post($current_category, '')
  );
  return $array;
}

add_action('rest_api_init', 'add_api_posts_meta_field');
?>
