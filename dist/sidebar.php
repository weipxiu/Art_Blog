<div class="aside">
    <h3>博客简介</h3>
    <?php
        if (get_option('weipxiu_options')['side_video'] == 'on') {
            ?>
                <video id="my-video" preload="none" class="video-js vjs-default-skin vjs-big-play-centered" controls preload width="308" height="173"
                    style="margin-top:0" poster="<?php echo get_option('weipxiu_options')['video_cover']; ?>" width="308" height="173"
                    data-setup="{}">
                    <source src="<?php echo get_option('weipxiu_options')['video_url']; ?>" type="video/mp4">
                    </source>
                    <p class="vjs-no-js"> 要查看此视频，请启用JavaScript，并考虑升级到Web浏览器版本。
                        <a href="https://videojs.com/html5-video-support/" target="_blank">supports HTML5 video</a>
                    </p>
                </video>
            <?php
        }
    ?>

    <div class="textwidget">
        <p class="clearfix">
            <?php 
                echo get_option('weipxiu_options')['sidebar_notice'];
            ?>
        </p>
        <ul class="social">
            <ul class="social">
                <li class="weibo">
                    <a target="_blank" href="https://wpa.qq.com/msgrd?v=3&uin=<?php echo get_option('weipxiu_options')['QQ-number'];?>&site=qq&menu=yes"><i class="iconfont icon-qq"></i>QQ</a>
                </li>
                <li class="qq">
                    <a target="_blank" href="https://jq.qq.com/?_wv=1027&k=4BemYKg" rel="nofollow" class="top-tip"
                        title="加入web前端QQ群"><i class="iconfont icon-qqqun"></i>Q群</a>
                </li>
                <li class="feed">
                    <a target="_blank" href="tencent://message/?uin=<?php echo get_option('weipxiu_options')['QQ-number'];?>&Site=qq&Menu=yes" rel="nofollow" class="top-tip"
                        title="QQ临时会话"><i class="iconfont icon-qq"></i>会话</a>
                </li>
                <li class="email">
                    <a href="mailto:<?php echo get_option('weipxiu_options')['QQ-number'];?>@qq.com.com" target="_blank" rel="nofollow" class="top-tip" title="给我发送qq邮件"><i
                            class="iconfont icon-youxiang"></i>邮件</a>
                </li>
                <li class="weixin">
                    <a href="javascript:;" target="_blank" rel="nofollow" class="top-tip" title="关注微信"><i
                            class="iconfont icon-weixin"></i>微信</a>
                </li>
            </ul>
        </ul>
    </div>
</div>

<!-- 热门文章start -->
<div class="widget hot_rticles">
    <div class="daily-list">
        <h3 class="widget-title"><a href="javascript:()"><i class="iconfont icon-web__xinshou"></i>最近更新</a></h3>
        <!-- 按发布日期排序 orderby=date?
        按修改时间排序 orderby=modified
        按文章ID排序 orderby=ID
        按评论最多排序 orderby=comment_count
        按标题排序 orderby=title
        随机排序 orderby=rand -->
        <ul>
            <?php
                  $args = array(
                      'post_password' => '',
                      'post_status' => 'publish', // 只选公开的文章.
                      'post__not_in' => array($post->ID),//排除当前文章
                      'caller_get_posts' => 1, // 排除置頂文章.
                      'orderby' => 'modified', // 依ID排序.
                      'posts_per_page' => 5 // 设置调用条数
                  );
                  $query_posts = new WP_Query();
                  $query_posts->query($args);
                  while( $query_posts->have_posts() ) { $query_posts->the_post(); ?>
            <li>
                <a href="<?php the_permalink(); ?>">
                    <?php
                        if ( has_post_thumbnail() )
                        the_post_thumbnail();
                    else
                        echo "<img src='". catch_that_image()."'"." alt='".get_the_title()."'>";
                    ?>
                </a>
                <!-- <em></em> -->
                <div class="hot_text">
                    <a href="<?php the_permalink(); ?>" class="hot_title">
                        <?php the_title(); ?>
                    </a>
                    <time class="hot_time"><?php the_time('Y年m月d日') ?>
                        <span><i class="iconfont icon-icon-eyes"></i><?php echo getPostViews(get_the_ID()); ?></span>
                    </time>
                </div>
            </li>
            <?php } wp_reset_query();?>
        </ul>
    </div>
</div>
<!-- 热门文章end -->

<!-- 随机文章start -->
<div class="widget mouseover">
    <div class="daily-list">
        <h3 class="widget-title"><a href="javascript:()"><i class="iconfont icon-suiji-copy"></i>随机文章</a></h3>
        <ul>
            <?php
              $args = array(
                  'post_password' => '',
                  'post_status' => 'publish', // 只选公开的文章.
                  'post__not_in' => array($post->ID),//排除当前文章
                  'caller_get_posts' => 1, // 排除置頂文章.
                  'orderby' => 'rand', // 随机排序.
                  'posts_per_page' => 10 // 设置调用条数
              );
              $query_posts = new WP_Query();
              $query_posts->query($args);
              while( $query_posts->have_posts() ) { $query_posts->the_post(); ?>
            <li>
                <em></em>
                <a href="<?php the_permalink(); ?>">
                    <?php the_title(); ?>
                </a>
            </li>
            <?php } wp_reset_query();?>
        </ul>
    </div>
</div>
<!-- 随机文章end -->

<!-- 热门标签start -->
<div class="classif">
    <h3 class="widget-title"><a href="javascript:()"><i class="iconfont icon-leimupinleifenleileibie"></i>热门标签</a></h3>
    <?php if (get_option('weipxiu_options')['popular'] != 'on'){ ?>
        <div class="items">
            <?php wp_tag_cloud('number=24&orderby=name&order=DESC&smallest=12&largest=12&unit=px'); ?>
        </div>
    <?php }else{?>
        <div class="items">
            <?php echo get_option('weipxiu_options')['custom_label']; ?>
        </div>
    <?php }?>
</div>
<!-- 热门标签end -->

<!-- 评论模块start -->
<div class="classif" id="primary-sidebar">
    <!-- <div class="com-s com">
        <h3 class="widget-title">
            <a href="javascript:()"><i class="fa fa-bars" aria-hidden="true"></i>精彩评论</a>
        </h3>
        代码1：放在页面需要展示的位置  -->
        <!-- 如果您配置过sourceid，建议在div标签中配置sourceid、cid(分类id)，没有请忽略  -->
        <!-- <div id="cyReping" role="cylabs" data-use="reping"></div> -->
        <!-- 代码2：用来读取评论框配置，此代码需放置在代码1之后。 -->
        <!-- 如果当前页面有评论框，代码2请勿放置在评论框代码之前。 -->
        <!-- 如果页面同时使用多个实验室项目，以下代码只需要引入一次，只配置上面的div标签即可 -->
        <!-- 评论模块end --
    </div> -->
    <div class="com-s com">
        <h3 class="widget-title">
            <a href="javascript:()"><i class="iconfont icon-pinglun3"></i>精彩评论</a>
        </h3>
        <ul class="uk-list uk-padding-small tuts_comments_user_avatars">
            <!-- wordPress原生评论头像获取get_avatar(get_comment_author_email(), 50) -->
            <!-- 获取QQ昵称和头像（jsonp）https://users.qzone.qq.com/fcg-bin/cgi_get_portrait.fcg?uins=343049466
             -->
            <!-- 获取QQ头像
                 https://q1.qlogo.cn/g?b=qq&nk=343049466&s=40
                 https://q2.qlogo.cn/headimg_dl?dst_uin=343049466&spec=40 
            -->
            <?php
            global $wpdb;
            $my_email = get_bloginfo ('admin_email'); // AND comment_author_email != '$my_email' 不展示管理员回复
            $sql = "SELECT DISTINCT ID, post_title, post_password, comment_ID, comment_post_ID, comment_author, comment_date_gmt, comment_approved, comment_type,comment_author_url,comment_author_email, SUBSTRING(comment_content,1,100) AS com_excerpt FROM $wpdb->comments LEFT OUTER JOIN $wpdb->posts ON ($wpdb->comments.comment_post_ID = $wpdb->posts.ID) WHERE comment_approved = '1' AND comment_type = '' AND post_password = '' ORDER BY comment_date_gmt DESC LIMIT 6";
            $comments = $wpdb->get_results($sql);
            $output = $pre_HTML;
            foreach ($comments as $comment) { $com_excerpt = strip_tags($comment->com_excerpt); $excerpt_len = mb_strlen($com_excerpt, 'utf-8');
                if ($excerpt_len > 46) $com_excerpt = mb_substr($com_excerpt, 0, 46, 'utf-8').'...';
                $output .= "\n<li>". '<img src=https://q.qlogo.cn/headimg_dl?bs=qq&dst_uin='.get_comment_author_email().'&src_uin=qq.feixue.me&fid=blog&spec=100&id='.rand(1,1000).' onerror="this.src=\'https://www.weipxiu.com/wp-content/themes/Art_Blog/images/head_portrait.jpg\';">' .strip_tags($comment->comment_author) . "<span>（" . timeago($comment->comment_date_gmt) . "）</span>" . "<p>". $com_excerpt ."</p>" . "<a href=\"" . get_permalink($comment->ID) ."#comment-" . $comment->comment_ID . "\" title=\"查看 " .$comment->post_title . "\">评：".$comment->post_title ."</a></li>";}
            $output .= $post_HTML;
            $output = convert_smilies($output);
            echo $output;
        ?> 
        </ul>
    </div>
</div>
<!-- 评论模块end -->

<!-- 友情链接start -->
<?php if (get_option('weipxiu_options')['friendlinks'] != 'on'){ ?>
    <?php
        if (is_home()) {
            ?>
                <div class="widget friendship">
                    <div class="daily-list">
                        <h3 class="widget-title"><a href="javascript:()"><i class="iconfont icon-pengyouwang"></i>友情链接</a></h3>
                        <p>他们同样是一群网虫，却不是每天泡在网上游走在淘宝和网游之间、刷着本来就快要透支的信用卡。他们或许没有踏出国门一步，但同学却不局限在一国一校，而是遍及全球！<a href="http://mail.qq.com/cgi-bin/qm_share?t=qm_mailme&amp;email=<?php echo get_option('weipxiu_options')['QQ-number'];?>@qq.com" target="_blank">申请交换友链</a>
                        </p>
                        <ul class="friendsChain">
                            <?php wp_list_bookmarks('title_li=&categorize=0'); ?>
                        </ul>
                    </div>
                </div>
            <?php
        }
    ?>
<?php }else{?>
    <div class="widget friendship">
        <div class="daily-list">
            <h3 class="widget-title"><a href="javascript:()"><i class="iconfont icon-pengyouwang"></i>友情链接</a></h3>
            <p>他们同样是一群网虫，却不是每天泡在网上游走在淘宝和网游之间、刷着本来就快要透支的信用卡。他们或许没有踏出国门一步，但同学却不局限在一国一校，而是遍及全球！<a href="http://mail.qq.com/cgi-bin/qm_share?t=qm_mailme&amp;email=<?php echo get_option('weipxiu_options')['QQ-number'];?>@qq.com" target="_blank">申请交换友链</a>
            </p>
            <ul class="friendsChain">
                <?php wp_list_bookmarks('title_li=&categorize=0'); ?>
            </ul>
        </div>
    </div>
<?php }?>
<!-- 友情链接end -->

<!-- 网站统计start -->
<?php
  if (get_option('weipxiu_options')['aside_count'] == 'on') {
    ?>
      <div class="widget" id="web-tj">
        <div class="daily-list">
            <h3 class="widget-title"><a href="javascript:()"><i class="iconfont icon-icon"></i>站点统计</a></h3>
            <ul>
                <li>文章总数：
                    <?php $count_posts = wp_count_posts(); echo $published_posts = $count_posts->publish; ?> 篇
                </li>
                <li>草稿数目：
                    <?php $count_posts = wp_count_posts(); echo $draft_posts = $count_posts->draft; ?> 篇
                </li>
                <li>分类数目：
                    <?php echo $count_categories = wp_count_terms('category'); ?> 个
                </li>
                <li>独立页面：
                    <?php $count_pages = wp_count_posts('page'); echo $page_posts = $count_pages->publish; ?> 个
                </li>
                <li>评论总数：
                    <?php echo $wpdb->get_var("SELECT COUNT(*) FROM $wpdb->comments");?> 条</li>
                <li>链接总数：
                    <?php $link = $wpdb->get_var("SELECT COUNT(*) FROM $wpdb->links WHERE link_visible = 'Y'"); echo $link; ?>
                    个
                </li>
                <li>标签总数：
                    <?php echo $count_tags = wp_count_terms('post_tag'); ?> 个
                </li>
                <!-- <li>建站时间：
                    <?php echo floor((time()-strtotime("2016-12-15"))/86400);?> 天
                </li> -->
                <li>注册用户：
                    <?php $users = $wpdb->get_var("SELECT COUNT(ID) FROM $wpdb->users"); echo $users; ?> 人
                </li>
                <li>访问总量：
                    <?php
                        $counterFile = "counter.txt";
                        $fp = fopen($counterFile,"a+");
                        $num = fgets($fp,10);
                        $num += 1;
                        print ($num+8647865).' 次';
                        fclose($fp);
                        $fpp=fopen($counterFile,"w");
                        fwrite($fpp, $num);
                        fclose($fpp);
                    ?>
                </li>
                <li>最近更新：
                    <?php $last = $wpdb->get_results("SELECT MAX(post_modified) AS MAX_m FROM $wpdb->posts WHERE (post_type = 'post' OR post_type = 'page') AND (post_status = 'publish' OR post_status = 'private')");$last = date('Y年n月j日', strtotime($last[0]->MAX_m));echo $last; ?>
                </li>
            </ul>
        </div>
    </div>
    <?php
  }
?>