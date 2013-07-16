<?php
date_default_timezone_set('America/Los_Angeles');
global $now;
$now = time();
require('wp/wp-blog-header.php');
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
    <link rel="apple-touch-icon" href="images/icons/touch-icon-iphone-57x57.png">
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
    <div id="page" class="index">
      <div id="mast">
        <header><img src="images/logo-transparency-whiteeagle-cutout-400.png" alt="logo" class="logo"></header>
        <nav>
          <ul>
            <li class="thisweek"><a href="#events" class="button"><span>This<br>Week</span></a></li>
            <li><a href="merch.php" class="button"><span>Hoodies<br>Tanks<br>& Tees</span></a></li>
            <li><a href="calendar.php" class="button"><span>Calendar</span></a></li>
            <li><a href="jobs.php" class="button"><span>Barback<br>Needed</span></a></li>
          </ul>
        </nav>
        <aside>
          <ul class="widgets">
            <li class="hankypic"><a href="GayHankyCodes.php"><img src="images/hankycodes.jpeg" alt="hanky codes" class="thumb"></a>Hanky Codes</li>
            <li class="faceboook"><a href="http://www.facebook.com/SFEagle"><img src="images/icons/facebook.png" alt="facebook" class="thumb"></a></li>
            <li class="twitter"><a href="https://twitter.com/sfeaglebar"><img src="images/icons/twitter.png" alt="facebook" class="thumb"></a></li>
          </ul>
        </aside>
      </div>
      <div id="tease">
        <!--  .poster-->
        <!--    img(src='images/DrinkSpecials/dickel-250-transparent.png')-->
        <!--    img(src='images/DrinkSpecials/dickel-rye-250-transparent.png')-->
        <!--    h3-->
        <!--      | Have you met George Dickel?-->
        <!--      br-->
        <!--      | He has a rye sense af humor.-->
        <!--      br-->
        <!--      | He's 12 years old and can kick your butt.--><!--      br
        <h2>3 bucks. ALL NIGHT!</h2>--><div class="loop"> <?php
    global $post; // required
    $category_id = get_cat_ID('tease_now');
    $args = array(
        'category'      => $category_id,
        'orderby'       => 'post_date',
        'order'         => 'DESC',
        'post_type'     => 'post',
        'numberposts'   => 1
    );
    $custom_posts = get_posts($args);
    foreach($custom_posts as $post)
    {
        setup_postdata($post);
        include 'php/timegames.php';
        if ( $now < $begintime || $now > $endtime ) { continue; } ?>
        <h1> <?php echo $post->post_title; ?> </h1> <?php
        fill_tease($post);
    }
    $args = array(
        'meta_key'      => 'date',
        'orderby'       => 'meta_value',
        'order'         => 'ASC',
        'post_type'     => 'event',
        'numberposts'   => -1
    );
        $custom_posts = get_posts($args);
        foreach($custom_posts as $post)
        {
            setup_postdata($post);
            if ( !get_field('tease') ) { continue;}
            include 'php/timegames.php';
            if ( $now < $begintime - 60*60*24*5 || $now > $endtime ) { continue; }
            if ( get_field('include_title') )
            { ?>
                <h1> <?php echo $post->post_title; ?> </h1> <?php
            }
            fill_tease($post);
            break;
        }
    ?>
</div>

<?php function fill_tease($post)
{
    $image_medium = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'medium'); ?>
    <div>
        <img src="<?php echo $image_medium[0] ?>"
             width="<?php echo $image_medium[1]; ?>"
             height="<?php echo $image_medium[2]; ?>"
             alt="<?php get_the_title($post->ID); ?>" >
    </div>
    <p><?php echo $post->post_content; ?> </p> <?php
} ?>
      </div>
      <div id="events" class="cf"><ul>
                    <?php global $post; // required
                    $day = '';
                    $args = array(
                        'meta_key'      => 'date',
                        'orderby'       => 'meta_value',
                        'order'         => 'ASC',
                        'post_type'     => 'event',
                        'numberposts'   => -1
                    );
                    $custom_posts = get_posts($args);
                    foreach($custom_posts as $post)
                    {
                        setup_postdata($post);
                        $type = get_field('type_of_event');
                        include 'php/timegames.php';
                        if ( $now < $begintime - 60*60*24*5 || $now > $endtime ) { continue; }
                        if ($day != date('l', $begintime))
                        { ?>
    <li id="<?php echo date('l', $begintime); ?>" class="day">
        <h3> <?php echo date('l', $begintime); ?> <sup><?php echo date('n/j', $begintime); ?></sup> </h3>
                        <?php
                        }
                        $day = date('l', $begintime); ?>
        <ul class="events">
            <li class="event cf">
                <p class="time"><?php echo $start . " - " . $finish; ?> </p>
                        <?php
                        if ( $type[0] === "music" )
                        { ?>
                <ul class="tnl event-list">
                    <li>
                        <a href="<?php the_field('band_#1_link'); ?>" class="button">
                            <span> <?php the_field('band_#1'); ?> </span>
                        </a>
                    </li>
                            <?php
                            if ( get_field('band_#2') !== "" )
                            { ?>
                    <li>
                        <a href="<?php the_field('band_#2_link'); ?>" class="button">
                            <span> <?php the_field('band_#2'); ?> </span>
                        </a>
                    </li>
                            <?php
                            }
                            if ( get_field('band_#3') !== "" )
                            { ?>
                    <li>
                        <a href="<?php the_field('band_#3_link'); ?>" class="button">
                            <span> <?php the_field('band_#3'); ?> </span>
                        </a>
                    </li>
                            <?php
                            }
                            if ( get_field('band_#4') !== "" )
                            { ?>
                    <li>
                        <a href="<?php the_field('band_#4_link'); ?>" class="button">
                            <span> <?php the_field('band_#4'); ?> </span>
                        </a>
                    </li>
                            <?php
                                }
                        }
                        else
                        { ?>
                <ul class="event-list">
                    <li>
                        <a href="<?php the_field('link'); ?>" class="button">
                            <span> <?php the_title(); ?> </span>
                        </a>
                    </li> <?php
                        } ?>
                </ul>
                        <?php
                            $image_large = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'large');
                            $image_thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'thumbnail');
                        ?>
                <a href="<?php echo $image_large[0] ?>" width="<?php echo $image_large[1]; ?>" height="<?php echo $image_large[2]; ?>" rel="lightbox">
                    <img src="<?php echo $image_thumbnail[0] ?>" width="<?php echo $image_thumbnail[1]; ?>" height="<?php echo $image_thumbnail[2]; ?>" alt="<?php the_title(); ?>" class="thumb">
                </a>
            </li>
        </ul>
                         <?php if ($day != date('l', $begintime)) { ?>
    </li>
                         <?php }
                    } ?>
</ul>
      </div>
      <div id="flyers" class="cf">[flyers]</div>
      <script src="widgets/lightbox/js/jquery-1.7.2.min.js"></script>
      <script src="widgets/lightbox/js/lightbox-ck.js"></script>
      <script src="widgets/flexslider/jquery.flexslider-ck.js"></script>
      <script src="js/main.js"></script>
    </div>
  </body>
</html>
<script>
  $(window).load(function() {
  $('.flexslider').flexslider({
  animation: "slide",
  animationLoop: "true"
  });
  });
  
</script>
<script>
  $(document).ready(function(){
  $.get('index.flyers.html', function(data) {
  $('#flyers').html(data);
  });
  });
  $('div.lb-nav').on('click', function(e) {
  window.close();return false;});
</script>