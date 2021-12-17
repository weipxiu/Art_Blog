<?php
require('./wp-blog-header.php');
header("Content-type: text/xml");
header('HTTP/1.1 200 OK');
$posts_to_show = 1000;
echo '<?xml version="1.0" encoding="UTF-8"?>';
echo '<urlset xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">';
?>
<!-- generated-on=<?php echo get_lastpostdate('blog'); ?>-->
<url>
<loc>http://www.weipxiu.com/</loc>
<lastmod><?php echo get_lastpostdate('blog'); ?></lastmod>
<changefreq>daily</changefreq>
<priority>1.0</priority>
</url>
<?php
header("Content-type: text/xml");
$myposts = get_posts( "numberposts=" . $posts_to_show );
foreach( $myposts as $post ) { ?>
<url>
<loc><?php the_permalink(); ?></loc>
<lastmod><?php the_time('c') ?></lastmod>
<changefreq>monthly</changefreq>
<priority>0.6</priority>
</url>
<?php } // end foreach ?>
<?php
$terms = get_terms('category', 'orderby=name&hide_empty=0' );
$count = count($terms);
if($count > 0){
foreach ($terms as $term) { ?>
    <url>
      <loc><?php echo get_term_link($term, $term->slug); ?></loc>
      <changefreq>weekly</changefreq>
      <priority>0.8</priority>
  </url>
<?php }} ?>
</urlset>
