<!DOCTYPE html>
<html lang="en">

<head>
    <title><?php the_title(); ?>&nbsp;|&nbsp;<?php echo get_bloginfo('description'); ?></title>
    <?php require ('common.php'); ?>
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

<body id="ajax_centent">
    <!--头部文件引用start-->
    <?php get_header();?>
    <!--头部文件引用end-->

    <!-- 正文区域start -->
    <div class="continar">
        <div class="continar-left" id="details" style="border:0; padding:0; float:none;background: transparent;">
            <!-- 面包屑导航 -->
            <div class="mod-breadcrumb">
                <?php wheatv_breadcrumbs(); ?>
            </div>

            <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
                <div class="text">
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
                            <?php echo mb_strimwidth(strip_tags(apply_filters('the_content', $post->post_content)), 0, 300,"..."); ?>
                            <!--文章内容-->
                        </h3>
                        <a class="read-more read_url" href="<?php the_permalink(); ?>" target="_blank">阅读全文<i class="iconfont icon-jiantou-you-cuxiantiao-fill"></i></a>
                        <p class="l">
                            <span><i class="iconfont icon-shijian" aria-hidden="true"></i><?php the_time('Y年m月d日') ?></span>
                            <span>
                                <a href="<?php the_permalink(); ?> ">
                                    <i class="iconfont icon-liulan"></i><?php echo getPostViews(get_the_ID()); ?>℃
                                </a>
                            </span>
                            <span class="comm">
                                <a href="<?php the_permalink(); ?> "><i class="iconfont icon-pinglun2"></i><?php echo number_format_i18n( get_comments_number() );?>条评论
                                </a>
                            </span>
                            <span class="post-like">
                                <a href="javascript:;" data-action="ding" data-id="<?php the_ID(); ?>" class="favorite<?php if (isset($_COOKIE['bigfa_ding_' . $post->ID])) echo ' done'; ?>"><i class="iconfont icon-damuzhi1"></i><span class="count"><?php if (get_post_meta($post->ID, 'bigfa_ding', true)) {echo get_post_meta($post->ID, 'bigfa_ding', true);} else {echo '0';
                                } ?></span>喜欢
                                </a>
                            </span>
                            <span class="r"></span>
                        </p>
                        <?php if( is_sticky() ) echo '<em><a href="">顶</a></em>'; ?>
                        <!-- <span class="new-icon">NEW</span> -->
                    </div>
                </div>

                <?php endwhile; else: ?>
                <script>
                    $(".mod-breadcrumb").hide();
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