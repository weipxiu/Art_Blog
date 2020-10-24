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
    <?php get_template_part('common'); ?>
    <link rel="stylesheet" href="<?php echo esc_url(get_template_directory_uri()); ?>/css/codecolorer.css">
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
                <div class="continar-left single" id="ajax_centent">
                    <!-- 面包屑导航 -->
                    <div class="mod-crumbs">
                        <span class="mod-breadcrumb">
                            <?php wheatv_breadcrumbs(); ?>
                        </span>
                    </div>
                    <div class="article-meta">
                        <h1 class="title">
                            <?php the_title(); ?>
                        </h1>
                        <div class="article-items">
                            <span>
                                <?php echo the_time('Y-m-d')?>
                            </span>
                            <span>
                                分类：<?php
                                    $category = get_the_category();
                                    echo $category[0]->cat_name;
                                ?>
                            </span>
                            <span>
                                作者：<?php the_author_nickname(); ?>
                            </span>
                            <span>
                                阅读（<?php echo getPostViews(get_the_ID()); ?>）
                            </span>
                            <!--
                            检测改文章是否被百度收录，该功能谨慎开启，它将严重拖累详情页打开速度 
                            <span class="recommend" style="display:none">
                            <?php /* baidu_record(); */?>
                            </span>
                            -->
                        </div>
                    </div>

                    <div class="log-text">
                        <?php the_content(); ?>
                        <!--文章内容-->
                        <?php endwhile; else : ?>
                        <h2>
                            <?php _e('Not Found'); ?>
                        </h2>
                        <?php endif; ?>

                        <p class="post-motto">「梦想一旦被付诸行动，就会变得神圣，如果觉得我的文章对您有用，请帮助本站成长」</p>

                        <!--文章打赏start-->
                        <div class="post-actions">
                            <span class="post-like reward action-like">
                                <a href="javascript:;" data-action="ding" data-id="<?php the_ID(); ?>" class="favorite<?php if(isset($_COOKIE['bigfa_ding_'.$post->ID])) echo ' done';?>">
                                    <i class="iconfont icon-xingxing"></i>赞(<span class="count"><?php if( get_post_meta($post->ID,'bigfa_ding',true) ){            
                                                echo get_post_meta($post->ID,'bigfa_ding',true);
                                            } else {
                                                echo '0';
                                        }?></span>)  
                                </a>   
                            </span>
                            <span class="reward js_reward">
                                <i class="iconfont icon-jiage1"></i> 打赏
                            </span>
                            <div id="reward-popup">
                                <div class="title">
                                    <?php echo get_option('weipxiu_options')['reward_text'];?>
                                </div>
                                <div class="reward_item">
                                    <div>
                                        <p>支付宝扫一扫打赏</p>
                                        <img src="<?php echo get_option('weipxiu_options')['alipay'];?>" alt="">
                                    </div>
                                    <div>
                                        <p>微信扫一扫打赏</p>
                                        <img src="<?php echo get_option('weipxiu_options')['wechatpay'];?>" alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--文章打赏end-->
                    </div>
                    
                    <div class="key-w">
                        <div class="single_lable">
                            <i class="iconfont icon-biaoqian" style="padding-right:7px"></i>标签：</div>
                        <?php the_tags('','',''); ?>
                    </div>

                    <p class="text-post">
                        <?php if (get_previous_post()) { previous_post_link('<span  id="respond">上一篇：</span>%link');} else {echo "上一篇：没有了，已经是最后文章";} ?>
                    </p>
                    <p class="text-post">
                        <?php if (get_next_post()) { next_post_link('<span>下一篇：</span>%link');} else {echo "下一篇：没有了，已经是最新文章";} ?>
                    </p>
                    
                    <!-- 相关文章推荐start -->
                    <h3 class="cat-title"><span>相关推荐</span></h3>
                    <?php
                        // 默认参数
                        $args = array(
                            'posts_per_page' => 8, // 要显示的项目数
                            'post__not_in'   => array( get_the_ID() ), // 排除当前帖子
                            'no_found_rows'  => true, 
                        );

                        // 检查当前的帖子类别，并将tax_query添加到查询参数中
                        $cats = wp_get_post_terms( get_the_ID(), 'category' ); 
                        $cats_ids = array();  
                        foreach( $cats as $wpex_related_cat ) {
                            $cats_ids[] = $wpex_related_cat->term_id; 
                        }
                        if ( ! empty( $cats_ids ) ) {
                            $args['category__in'] = $cats_ids;
                        }

                        // 查询文章
                        $wpex_query = new wp_query( $args );

                        // 输出文章
                        foreach( $wpex_query->posts as $post ) : setup_postdata( $post ); ?>
                        <div id="related_posts">
                            <ul class="live">
                                <li><a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( the_title_attribute( 'echo=0' ) ); ?>"><?php the_title(); ?></a></li>
                            </ul>
                        </div>
                        <?php
                        // 结束循环
                        endforeach;
                        wp_reset_postdata(); ?>
                        <!-- 相关文章推荐end -->

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