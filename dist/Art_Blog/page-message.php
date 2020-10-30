<?php   
/*
Template Name: 给我留言  
*/  
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title><?php wp_title( '-', true, 'right' ); ?>唯品秀 – 前端开发 | web前端技术博客</title>
    <?php get_template_part('common'); ?>
</head>
    <body>
    <!--头部文件引用start-->
	<?php get_header();?>
	<!--头部文件引用end-->
    
    <!-- 正文区域start -->
    <div class="continar" id="leaving_message">
         <div class="continar-left" id="details">
              <div class="leaving_message">
                <h1>留言板</h1>

                <!-- 留言板寄语 -->
                <?php echo get_option('weipxiu_options')['leaving_message'] ?>
              </div>

              <!-- 评论 -->
              <div class="post_content">
                  <?php comments_template( '', true ); ?>
              </div>
         </div>
         <!-- 左侧区域end -->
    </div>
    <!-- 正文区域end -->
    
	<!-- 底部引用区域start -->
    <?php get_footer()?>
    <!-- 底部引用区域end -->

</body>
</html>