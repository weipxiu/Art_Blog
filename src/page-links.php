<?php
/*
Template Name: 友情链接
*/
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
<title><?php wp_title( '-', true, 'right' ); ?><?php echo get_bloginfo('description'); ?></title>
<?php get_template_part('common'); ?>
    <style>
        .continar {
            background:#fff;
            padding:15px;
        }
        .continar h3 {
            font-size:20px;
            color:rgba(0, 0, 0, .85);
            text-align:center;
            margin:10px 0 20px;
        }
        .continar > h3:after {
            content:"";
            display: block;
            width: 20px;
            height: 2px;
            margin: 5px auto 0;
            background: #333;
        }
        .links_item {
            display: grid;
            padding: 15px 4px;
            grid-gap: 20px 8px;
            /* 可以通过minmax()函数来创建网格轨道的最小或最大尺寸。minmax()函数接受两个参数：第一个参数定义网格轨道的最小值，第二个参数定义网格轨道的最大值。可以接受任何长度值，也接受auto值。auto值允许网格轨道基于内容的尺寸拉伸或挤压,fr单位为每个item分配的份额/比例 */
            grid-template-columns: repeat(auto-fit, minmax(18%, 1fr));
        }
        .links_item li {
            align-items: center;
            justify-content: flex-end;
            display: flex;
            flex-direction: column;
        }
        .links_item li a {
            align-items: center;
            justify-content: center;
            display: flex;
            flex-direction: column;
            color: var(--color-primary);
            color: var(--color-theme);
        }
        .links_item li a img {
            display: block;
            margin-bottom:10px;
            max-width:100%;
            max-height: 50px;
        }
        .post_content h3.comments-title {
            font-size:14px;
            color: var(--color-gray);
        }
        @media screen and (max-width: 1199px) {
            .continar {
                padding: 0 .25rem;
            }
            .continar h3{
              margin: 0.3rem 0 0.2rem;
            }
            .links_item {
                display: grid;
                padding: 0.3rem 0.08rem;
                grid-gap: 0.38rem 0.16rem;
                /* 可以通过minmax()函数来创建网格轨道的最小或最大尺寸。minmax()函数接受两个参数：第一个参数定义网格轨道的最小值，第二个参数定义网格轨道的最大值。可以接受任何长度值，也接受auto值。auto值允许网格轨道基于内容的尺寸拉伸或挤压,fr单位为每个item分配的份额/比例 */
                grid-template-columns: repeat(auto-fit, minmax(30%, 1fr));
            }
            .post_content h3.comments-title {
                font-size:0.26rem;
            }
        }
    </style>
</head>
<body>
  <?php get_header();?>
    <div class="continar">
        <h3>友情链接</h3>
        <ul class="links_item">
            <?php wp_list_bookmarks('categorize=0&title_li=0&orderby=id&show_name=1'); ?>
        </ul>
        <!-- 评论 -->
        <div class="post_content">
          <?php
            comments_template( '', true );
          ?>
        </div>
    </div>
    <?php get_footer();?>
</body>
</html>
