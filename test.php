<?php
require('wp/wp-blog-header.php');
date_default_timezone_set('PDT');
?>
<!DOCTYPE html>
<html>
  <head>
    <title>SF-Eagle | 398 12th Street</title>
    <meta http-equiv="Content-Type" content="text/html" charset="utf-8">
    <!-- <META HTTP-EQUIV="CACHE-CONTROL" CONTENT="NO-CACHE">-->
    <meta name="viewport" content="width=device-width">
    <meta name="viewport" content="initial-scale=1.0">
    <link rel="stylesheet" href="css/wp.css">
    <link rel="stylesheet" href="css/main.css">
    <link href="http://fonts.googleapis.com/css?family=Jolly+Lodger|Coming+Soon|Rouge+Script" rel="stylesheet" type="text/css">
    <script>
      (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
      (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
      m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
      })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
      ga('create', 'UA-42163204-1', 'sf-eagle.com');
      ga('send', 'pageview');
    </script>
  </head>
  <body><!-- hello -->
    <div id="page">
      <style>
        h1 {text-align: center;}
        img {width: 20%; margin:0 auto;}
      </style><?php ini_set('display_errors', 'On'); ?>
      <div class="loop">
        <?php
          $post_type = 'bands';
          $tax = 'event';
          $tax_terms = get_terms($tax);
          if ($tax_terms) {
            foreach ($tax_terms as $tax_term) {
              $args=array(
                'post_type' => $post_type,
                "$tax" => $tax_term->slug,
                'post_status' => 'publish',
                'posts_per_page' => -1,
                'caller_get_posts'=> 1
              );
              
              $my_query = null;
              $my_query = new WP_Query($args);
              if( $my_query->have_posts() ) {
                while ($my_query->have_posts()) : $my_query->the_post(); ?>
                  <h1> <?php the_title(); ?> </h1>
                  <p> <?php the_content(); ?> </p>
                  <p> the link: <?php get_post_meta(get_the_ID(), 'link-to-band-website', true); ?> </p>
                  <p><?php get_post_custom(); ?></p>
                  <?php
                endwhile;
              }
              wp_reset_query();
            }
          }
        ?>
        
        
      </div>
    </div>
  </body>
</html>