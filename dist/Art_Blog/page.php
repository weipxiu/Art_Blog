<!DOCTYPE html>
<html lang="en">
<head>
    <title><?php wp_title( '-', true, 'right' ); ?><?php echo get_bloginfo('description'); ?></title>
    <?php get_template_part('common'); ?>
</head>
    <body>
	      <?php get_header();?>

        <!-- 正文区域start -->
        <div class="continar">
          <div class="single_page">
            <?php echo get_the_content(); ?>
          </div>
        </div>
        <!-- 正文区域end -->

        <!-- 底部引用区域start -->
        <?php get_footer()?>
        <!-- 底部引用区域end -->
    </body>

</html>
