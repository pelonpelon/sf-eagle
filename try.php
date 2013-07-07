<?php
require('wp/wp-blog-header.php');
date_default_timezone_set('PDT');
?>
<!DOCTYPE html><html><head><title>SF-Eagle | 398 12th Street</title><meta http-equiv="Content-Type" content="text/html" charset="utf-8"><!-- <META HTTP-EQUIV="CACHE-CONTROL" CONTENT="NO-CACHE">--><meta name="viewport" content="width=device-width"><meta name="viewport" content="initial-scale=1.0"><link rel="stylesheet" href="css/wp.css"><link rel="stylesheet" href="css/main.css"><link href="http://fonts.googleapis.com/css?family=Jolly+Lodger|Coming+Soon|Rouge+Script" rel="stylesheet" type="text/css"><script>(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
})(window,document,'script','//www.google-analytics.com/analytics.js','ga');
ga('create', 'UA-42163204-1', 'sf-eagle.com');
ga('send', 'pageview');</script></head><body><!-- hello --><div id="page"><style>h1 {text-align: center;}
img {width: 20%; margin:0 auto;}</style><!--include php-errors--><div class="loop"><?php global $post; // required
  $args = array(
    'orderby'       => 'post_date',
    'order'         => 'ASC',
    'post_type'     => 'event',
    'numberposts'   => -1
  );
  $custom_posts = get_posts($args);
  foreach($custom_posts as $post) : setup_postdata($post); ?>
    <h1> <?php the_title(); ?> </h1>
    <p> <?php
      $epoch = get_post_meta(get_the_ID(), 'date', true);
      echo date('l  M j     g:i A', $epoch); ?> </p>
    <p> <?php the_field('endtime'); ?> </p>
    <?php $image = wp_get_attachment_image_src(get_field('image'), 'full'); ?>
    <a href="<?php the_field('link'); ?>">
      <img src="<?php echo $image[0]; ?>" alt="<?php echo get_the_title(get_field('image')) ?>" />
    </a>
    <p> <?php the_field('blurb'); ?> </p>
  <?php endforeach; ?>
  </div></div></body></html>