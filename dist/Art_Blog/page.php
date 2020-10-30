<!DOCTYPE html>
<html lang="en">
<title><?php wp_title( '-', true, 'right' ); ?></title>
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
        </div>

        <!-- 正文区域end -->

        <!-- 底部引用区域start -->
        <?php get_footer()?>
        <!-- 底部引用区域end -->
    </body>

</html>