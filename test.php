<?php
  date_default_timezone_set('America/Los_Angeles');
  $local_time_zone_factor = trim(date('O', strtotime("now")), "-0");
  global $now;
  $now = time();
  require('wp/wp-blog-header.php');
?>
<!DOCTYPE html>
<html>
  <head>
    <title><?php bloginfo('name'); ?></title>
    <meta http-equiv="Content-Type" content="text/html" charset="utf-8">
    <meta name="viewport" content="width=device-width, minimum-scale=1.0, target-densityDpi=160">
    <link rel="prefetch" href="images/logo.svg">
    <link rel="stylesheet" href="//themes.googleusercontent.com/static/fonts/comingsoon/v3/myblyOycMnPMGjfPG-DzP4bN6UDyHWBl620a-IRfuBk.woff" type="text/css">
    <link rel="stylesheet" href="//themes.googleusercontent.com/static/fonts/jollylodger/v1/RX8HnkBgaEKQSHQyP9itiXhCUOGz7vYGh680lGh-uXM.woff" type="text/css">
    <link rel="stylesheet" href="css/main.css">
    <link rel="apple-touch-icon" href="images/icons/apple-touch-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="72x72" href="images/icons/touch-icon-ipad.png">
    <link rel="apple-touch-icon" sizes="114x114" href="images/icons/touch-icon-iphone-retina.png">
    <link rel="apple-touch-icon" sizes="144x144" href="images/icons/touch-icon-ipad-retina.png">
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
    <!-- #background-->
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
