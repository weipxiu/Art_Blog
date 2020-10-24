<!DOCTYPE html>
<html lang="en">

<head>
    <title><?php the_title(); ?>&nbsp;|&nbsp;<?php echo get_bloginfo('description'); ?></title>
    <?php get_template_part('common'); ?>
    <style>
        .bdcs-container .bdcs-search {
            width: 100%
        }

        .bdcs-container .bdcs-search-form-input {
            float: left;
            color: #999;
            border: solid 1px transparent;
            width: 748px;
            height: 50px;
            padding: 0px 12px;
            border-right: none;
            font-size: 16px;
            border-radius: 2px 0 0 2px;
            outline: none;
        }

        .bdcs-container .bdcs-search-form-submit {
            color: #fff;
            border: none;
            background: #1890ff;
            font-size: 16px;
            padding: 0 12px;
            border-radius: 0 2px 2px 0;
            float: right;
            height: 43px;
            line-height: 43px;
        }

        .bdcs-container .bdcs-search {
            height: 43px;
            line-height: 43px;
        }
    </style>
</head>

<body class="search_result">
    <!--头部文件引用start-->
    <?php get_header();?>
    <!--头部文件引用end-->

    <!-- 正文区域start -->
    <div class="continar">
        <img class="search_404" src="<?php echo esc_url(get_template_directory_uri()); ?>/images/search_404.png" alt="">
        <div class="continar-left" id="ajax_centent">
            <!-- 面包屑导航 -->
            <div class="mod-breadcrumb">
                <?php wheatv_breadcrumbs(); ?>
            </div>

            <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
            <article class="text">
                <div class="mod-category__article-time">
                    <span><?php the_time('d') ?></span>
                    <span><?php the_time('Y-m') ?></span>
                </div>
                <div class="img-left">
                    <a class="read-more" href="<?php the_permalink(); ?>" target="_blank">
                        <?php
                            if (has_post_thumbnail())
                            echo _get_post_thumbnail();
                        else
                            echo "<img src='". catch_that_image()."'"." alt='".get_the_title()."'>";
                        ?>
                    </a>
                </div>
                <div class="text_right">
                    <h2>
                        <span>
                            <?php the_category() ?><i></i></span>
                        <a href="<?php the_permalink(); ?>" target="_blank">
                            <?php the_title(); ?></a>
                    </h2>
                    <?php
                            if (has_post_thumbnail())
                            echo _get_post_thumbnail();
                        else
                            echo "<img src='". catch_that_image()."'"." alt='".get_the_title()."'>";
                    ?>
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
                        <!-- <span>
                                    <a href="<?php /*the_permalink(); */?> ">
                                        <i class="">&nbsp;</i><?php /*echo '发表于 '.timeago( get_gmt_from_date(get_the_time('Y-m-d G:i:s')) ); */?>
                                    </a>
                                </span> -->
                        <span class="p_time"><i class="iconfont icon-shijian" aria-hidden="true"></i><?php the_time('Y年m月d日 H:i:s D') ?></span>
                        <span class="i_time"><i class="iconfont icon-shijian" aria-hidden="true"></i><?php the_time('Y-m-d D') ?></span>
                        <span>
                            <a href="<?php the_permalink(); ?> ">
                                <i class="iconfont icon-icon-eyes"></i><?php echo getPostViews(get_the_ID()); ?>
                            </a>
                        </span>
                        <span class="comm">
                            <a href="<?php the_permalink(); ?> "><i class="iconfont icon-liuyan1"></i><?php echo number_format_i18n(get_comments_number()); ?>
                            </a>
                        </span>
                        <span class="post-like">
                            <a href="javascript:;" data-action="ding" data-id="<?php the_ID(); ?>" class="favorite<?php if (isset($_COOKIE['bigfa_ding_' . $post->ID])) echo ' done'; ?>"><i class="iconfont icon-xingxing"></i><span class="count"><?php if (get_post_meta($post->ID, 'bigfa_ding', true)) {echo get_post_meta($post->ID, 'bigfa_ding', true);} else {echo '0';
                            } ?></span>
                            </a>
                        </span>
                        <span class="r"></span>
                    </p>
                    <?php if (is_sticky()) echo '<em><a href="">顶</a></em>'; ?>
                    <!-- <span class="new-icon">NEW</span> -->
                </div>
            </article>

            <?php endwhile; else: ?>
            <script>
                $(".mod-breadcrumb").hide();
                $("body, html").css("height","100%");
                $(".search_404").show();
                if (/Android|webOS|iPhone|iPad|iPod|BlackBerry/i.test(navigator.userAgent)) {
                    setTimeout(function(){
                        $('footer.footer').css({
                                "position": "fixed",
                                "bottom": "0",
                                "left":  "0"
                        })
                    }, 500);
                }
                layer.alert('Sorry，当前关键词下未找到相关信息！',{
                    skin: 'layui',
                    title:"提示",
                    icon: 5,
                    closeBtn: 1,
                    anim: 3 //动画类型
                })
                document.title="Sorry，当前关键词下未找到相关信息！"
                if (localStorage.getItem("off_y") == 1) {
                    new Audio(
                        'https://tts.baidu.com/text2audio?cuid=baiduid&lan=zh&ctp=1&pdt=311&tex=' + 'Sorry，当前关键词下未找到相关信息！'
                    ).play();                       
                }
            </script>
            <?php endif; ?>
            <?php lingfeng_pagenavi();?><!-- 分页调用 -->
        </div>
        <!-- 左侧区域end -->
    </div>
    <!-- 正文区域end -->

    <!-- 底部引用区域start -->
    <?php get_footer()?>
    <!-- 底部引用区域end -->

</body>
</html>