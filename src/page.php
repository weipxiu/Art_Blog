<!DOCTYPE html>
<html lang="en">

<head>
    <?php 
        $keywords = get_post_meta($post->ID, "keywords", true);
        if($keywords == '') {
            $tags = wp_get_post_tags($post->ID);    
            foreach ($tags as $tag ) {        
                $keywords = $keywords . $tag->name . ", ";    
            }
            $keywords = rtrim($keywords, ', ');
        }
    ?>
    <?php require ('common.php'); ?>
    <link rel="stylesheet" href="/wp-content/themes/Art_Blog/css/codecolorer.css">
    <style>
        .continar-left {
            border-radius: 5px;
            background: #fff;
            padding: 15px;
            border: 1px solid #e6e6e6;
        }
        @media screen and (min-width:980px) {
            .continar-left {
                margin-top: 50px;
            }
        }
    </style>
</head>
    <body>
        <!--头部文件引用start-->
        <?php get_header();?>
        <!--头部文件引用end-->

        <!-- 正文区域start -->
        <div class="continar">
            <?php
		  if (have_posts()) : while (have_posts()) : the_post();setPostViews(get_the_ID());
		 ?>
                <div class="continar-left" id="ajax_centent">
                    <!-- 面包屑导航 -->
                    <div class="mod-crumbs">
                        <span class="mod-breadcrumb">
                            <?php wheatv_breadcrumbs(); ?>
                        </span>
                    </div>
                    <div class="xiaob">
                        <h1 class="title">
                            <?php the_title(); ?>
                        </h1>
                        <p class="data-l">
                        <span>
                            <i class="iconfont icon-shijian"></i>
                                <?php the_time('Y年m月d日') ?>
                            </span>
                            <span>
                            <i class="iconfont icon-zuozhe"></i>
                            <?php the_author_nickname(); ?>
                            </span>
                            <span>
                                <i class="iconfont icon-kanguo"></i>
                                <?php echo getPostViews(get_the_ID()); ?>次浏览</span>
                            <span>
                                <!-- <a href="<?php the_permalink(); ?> ">
                                    <i class="iconfont icon-liuyan1"></i>
                                    <span id="url::<?php the_permalink(); ?>" class="cy_cmt_count"></span>
                                    <script id="cy_cmt_num" src="https://changyan.sohu.com/upload/plugins/plugins.list.count.js?clientId=cyt2b1NqT">
                                    </script>
                                    
                                </a> -->
                            </span>
                        </p>
                    </div>

                    <div class="log-text">
                        <?php the_content(); ?>
                        <!--文章内容-->
                        <?php endwhile; else : ?>
                        <h2>
                            <?php _e('Not Found'); ?>
                        </h2>
                        <?php endif; ?>
                        <p class="copy">「四年博客，如果觉得我的文章对您有用，请帮助本站成长」</p>
                        <!--文章打赏start-->
                        <!-- PC端start -->
                        <div class="post-actions">
                            <span class="post-like action action-like">
                                <a href="javascript:;" data-action="ding" data-id="<?php the_ID(); ?>" class="favorite<?php if(isset($_COOKIE['bigfa_ding_'.$post->ID])) echo ' done';?>">
                                    <i class="iconfont icon-xingxing"></i>赞(	  
                                    <span class="count">   
                                        <?php if( get_post_meta($post->ID,'bigfa_ding',true) ){            
                                                echo get_post_meta($post->ID,'bigfa_ding',true);
                                            } else {
                                                echo '0';
                                        }?>
                                    </span>)  
                                </a>   
                            </span>
                            <a href="javascript:;" class="action action-rewards" data-event="rewards">
                                <i class="fa fa-jpy"></i> 打赏
                                <span class="tooltip-content">
                                    <span class="tooltip-text">
                                        <span class="tooltip-inner">
                                            <p class="reward-p">
                                                <i class="icon icon-quo-left"></i><?php echo get_option('weipxiu_options')['reward_text'];?>
                                                <i class="icon icon-quo-right"></i>
                                            </p>
                                            <div class="reward-box">
                                                <div class="reward-box-item">
                                                    <img class="reward-img" src="<?php echo get_option('weipxiu_options')['alipay'];?>">
                                                    <span class="reward-type">支付宝</span>
                                                </div>
                                                <div class="reward-box-item">
                                                    <img class="reward-img" src="<?php echo get_option('weipxiu_options')['wechatpay'];?>">
                                                    <span class="reward-type">微信</span>
                                                </div>
                                            </div>
                                        </span>
                                    </span>
                                </span>
                            </a>
                        </div>
                        <!-- PC端end -->
                        <div class="page-reward">
                            <div class="page-reward-btn tooltip-top">
                                <div class="tooltip tooltip-east">
                                    <span class="tooltip-item">
                                        <font class="s_show">赏</font>
                                        <a href="javascript:;" style="color: #f78585" data-action="ding" data-id="<?php the_ID(); ?>" class="favorite<?php if(isset($_COOKIE['bigfa_ding_'.$post->ID])) echo ' done';?>">
                                            <i class="iconfont icon-xingxing" style="color: #fff"></i>
                                            <span class="tog_show">
                                                <?php if( get_post_meta($post->ID,'bigfa_ding',true) ){            
                                                        echo get_post_meta($post->ID,'bigfa_ding',true);
                                                    } else {
                                                        echo '0';
                                                }?>
                                            </span>
                                        </a>
                                    </span>
                                    <span class="tooltip-content">
                                        <span class="tooltip-text">
                                            <span class="tooltip-inner">
                                                <p class="reward-p">
                                                    <i class="icon icon-quo-left"></i><?php echo get_option('weipxiu_options')['reward_text'];?>
                                                    <i class="icon icon-quo-right"></i>
                                                </p>
                                                <div class="reward-box">
                                                    <div class="reward-box-item">
                                                        <img class="reward-img" src="<?php echo get_option('weipxiu_options')['alipay'];?>">
                                                        <span class="reward-type">支付宝</span>
                                                    </div>
                                                    <div class="reward-box-item">
                                                        <img class="reward-img" src="<?php echo get_option('weipxiu_options')['wechatpay'];?>">
                                                        <span class="reward-type">微信</span>
                                                    </div>
                                                </div>
                                            </span>
                                        </span>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!--文章打赏end-->
                    <div class="key-w">
                        <div class="single_lable">
                            <i class="iconfont icon-biaoqian" style="padding-right:3px"></i>标签：</div>
                        <?php the_tags('','',''); ?>
                    </div>
                    <p class="text-post text-post-top">
                        <?php if (get_previous_post()) { previous_post_link('<span  id="respond">上一篇：</span>%link');} else {echo "上一篇：没有了，已经是最后文章";} ?>
                    </p>
                    <p class="text-post">
                        <?php if (get_next_post()) { next_post_link('<span>下一篇：</span>%link');} else {echo "下一篇：没有了，已经是最新文章";} ?>
                    </p>

                    <!-- 评论 -->
                    <div class="post_content">
                        <?php comments_template( '', true ); ?>
                    </div>
                </div>
                <!-- 左侧区域end -->

                <!-- 右侧区域start -->

                <div class="continar-right">
                    <?php get_sidebar( $name ); ?>
                </div>
                <!-- 右侧区域end -->
        </div>

        <!-- 正文区域end -->

        <!-- 底部引用区域start -->
        <?php get_footer()?>
        <!-- 底部引用区域end -->
    </body>

</html>