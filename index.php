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
    <!-- #background--><a name="top"></a>
    <div id="root">
      <div id="page" class="index"><a name="mast"></a>
        <div id="mast">
          <header><img src="images/logo.svg" alt="logo" width="200" height="200" class="logo"></header>
          <nav>
            <ul>
              <li class="thisweek"><a href="#events" class="button"><span>This<br>Week</span></a></li>
              <li><a href="merch.php" class="button"><span>Hoodies<br>Tanks<br>& Tees</span></a></li>
              <li><a href="calendar.php" class="button"><span>Calendar</span></a></li>
            </ul>
          </nav>
          <h2>HALLOWEEN</h2><a href="images/freakshow.jpg" rel="lightbox" class="promo"><img src="images/freakshow.jpg" alt="promo" width="388" height="600"></a>
        </div><a name="tease"></a>
        <div id="tease"><?php
    global $post;
    $category_id = get_cat_ID('Drink Special');
    $args = array(
    'category'      => $category_id,
    'orderby'       => 'post_date',
    'order'         => 'DESC',
    'post_type'     => 'post',
    'post_status'   => 'scheduled',
    'numberposts'   => 1
    );
    $custom_posts = get_posts($args);
    foreach($custom_posts as $post)
    {
    if ( !$custom_posts || !($post->post_status == 'future') )
    {
        continue;
    }
    setup_postdata($post);
    if ( $post->post_status == "private" ) { continue; }
    include 'includes/timegames.php';
        // MEMO Check that $publishtime works here
    if ( $now > $publish_time ) { continue; } ?>
    <section class="drink_special" style="display: block;"> <?php
    if ( has_post_thumbnail($post->ID) )
    {
    $image_thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'thumbnail'); ?>
        <img src="<?php echo $image_thumb[0] ?>"
             width="<?php echo $image_thumb[1]; ?>"
             height="<?php echo $image_thumb[2]; ?>"
             alt="Drink Special" > <div class="with_thumbnail"><?php
        }
        else
        {?>
        <div class="without_thumbnail"><?php
        }
            the_content(); ?></div> <?php
    } ?>
    </section>

<?php
$empty = true;
global $post; // required
$category_id = get_cat_ID('Tease Now');
$args = array(
    'category'      => $category_id,
    'orderby'       => 'post_date',
    'order'         => 'DESC',
    'post_type'     => 'post',
    'post_status'   => 'scheduled',
    'numberposts'   => 1
);
$custom_posts = get_posts($args);
foreach($custom_posts as $post)
{
    if ( !$custom_posts || !($post->post_status == 'future') )
    {
        continue;
    }
    setup_postdata($post);
    if ( $post->post_status == "private" ) { continue; }
    include 'includes/timegames.php';
    if ( $now > $publish_time ) { continue; } ?>
    <section class="tease_now" style="display: block;">
        <h1> <?php the_title(); ?> </h1> <?php
    fill_tease($post);
    $empty = false;
} ?>
</section>

<?php
if ( $empty )
{
    // scheduled event in tease unless replaced by tease_now
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
        include 'includes/timegames.php';
        if ( $begintime > ($now + 60*60*24*7) || $now > $endtime ) { continue; } ?>
        <section class="event" style="display: block;"> <?php
        if ( get_field('include_title') )
        { ?>
            <h1> <?php echo $post->post_title; ?> </h1> <?php
        }
        fill_tease($post);
        break; ?>
            </section> <?php
    }
}

/**
 * fill the center of the top of the home page with
 * a drink special or an announcement w/ images
 * @param  obj $post
 * @return null
 */
function fill_tease($post)
{
    $image_large = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'large'); ?>
    <div>
        <a href="<?php echo $image_large[0] ?>" rel="lightbox">
            <img src="<?php echo $image_large[0] ?>"
                 width="<?php echo $image_large[1]; ?>"
                 height="<?php echo $image_large[2]; ?>"
                 alt="<?php get_the_title($post->ID); ?>" >
        </a>
        <?php the_content(); ?>
    </div>
    <p><?php the_field('blurb'); ?> </p> <?php
} ?>
        </div><a name="events"></a>
        <div id="events"><ul class="listing">
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
    $type_of_event = get_field('type_of_event');
    include 'includes/timegames.php';
    if ( $begintime > $now + 60*60*24*7 || $now > $endtime ) { continue; }

    if ($day != date('l', $begintime)) { ?>
      <li id="<?php echo date('l', $begintime); ?>" class="day">
      <h3><?php echo date('l', $begintime); ?> <sup><?php echo date('n/j', $begintime); ?></sup> </h3> <?php }

    $day = date('l', $begintime);
    $price = "$" . get_field('price'); ?>

    <div class="event cf">
        <p class="time"><?php echo $start . " - " . $finish;
            if ( get_field('price')) { ?>
              <span class="price"><?php echo $price; ?></span> <?php } ?>
        </p><?php

    if ( $type_of_event[0] === "music" ) { ?>

      <ul class="tnl event-list"> <?php

        if ( get_field('promoter')) { ?>
          <li class="promoter">
              <a href="<?php the_field('promoter_link'); ?>" target="_blank">
                  <span> <?php the_field('promoter'); ?> </span>
              </a>
          </li><?php } ?>

        <li>
            <a href="<?php the_field('band_#1_link'); ?>" class="button" target="_blank">
                <span> <?php the_field('band_#1'); ?> </span>
            </a>
        </li> <?php

        if ( get_field('band_#2') !== "" ) { ?>
          <li>
              <a href="<?php the_field('band_#2_link'); ?>" class="button" target="_blank">
                  <span> <?php the_field('band_#2'); ?> </span>
              </a>
          </li><?php }

        if ( get_field('band_#3') !== "" ) { ?>
          <li>
              <a href="<?php the_field('band_#3_link'); ?>" class="button" target="_blank">
                  <span> <?php the_field('band_#3'); ?> </span>
              </a>
          </li><?php }

        if ( get_field('band_#4') !== "" ) { ?>
          <li>
              <a href="<?php the_field('band_#4_link'); ?>" class="button" target="_blank">
                  <span> <?php the_field('band_#4'); ?> </span>
              </a>
          </li><?php } ?>

      </ul><?php

    }

    else { ?>
        <ul class="event-list">
            <li>
                <a href="<?php the_field('link'); ?>" class="button" target="_blank">
                    <span> <?php the_title(); ?> </span>
                </a>
            </li>
        </ul><?php }

    $image_large = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'large');
    $image_thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'thumbnail'); ?>

        <a href="<?php echo $image_large[0] ?>" rel="lightbox">
            <img src="<?php echo $image_thumbnail[0] ?>" width="<?php echo $image_thumbnail[1]; ?>" height="<?php echo $image_thumbnail[2]; ?>" alt="<?php the_title(); ?>">
        </a><?php

    if ( $type_of_event[0] === "music" ) { ?>
        <a href="<?php the_field('youtube_playlist'); ?>" target="_blank">
            <img src="images/icons/icon-youtubePlaylist.jpg" alt="Youtube Playlist">
        </a><?php
        } ?>

    </div>

    <?php

    if ($day != date('l', $begintime)) { ?>
      </li> <?php }

} ?>
</ul>

<a href="calendar.php" >
  <h3 class="more_events">More...</h3>
</a>

        </div>
        <div id="page-footer"></div>
      </div><a name="footer"></a>
      <div id="footer">
        <div class="links">
          <ul class="social">
            <li class="faceboook"><a href="http://www.facebook.com/SFEagle" title="We're on Facebook" target="_blank" width="60" height="60"><img src="images/icons/facebook.png" alt="facebook" class="thumb"></a></li>
            <li class="twitter"><a href="https://twitter.com/sfeaglebar" title="We're on Twitter" target="_blank" width="60" height="60"><img src="images/icons/twitter.png" alt="twitter" class="thumb"></a></li>
            <li class="google"><a href="https://plus.google.com/u/0/b/109544451979985071388/109544451979985071388/posts/p/pub" title="We're on Google Plus" target="_blank" width="60" height="60"><img src="images/icons/google-plus-icon.png" alt="google+" class="thumb"></a></li>
            <li class="youtube"><a href="http://www.youtube.com/channel/UCmzgZ3-nEo1S8tnyjGJ3WoQ" title="We're on Youtube" target="_blank" width="60" height="60"><img src="images/icons/youtube-icon.png" alt="youtube" class="thumb"></a></li>
            <li class="email"><a href="mailto:info@sf-eagle.com?subject=Sent%20via%20website" title="Send us email" width="60" height="60"><img src="images/icons/email.png" alt="email" class="thumb"></a></li>
          </ul>
          <ul class="info">
            <li class="hankypic"><a href="GayHankyCodes.php" title="Don't miss our monthly FLAG parties"><img src="images/hankycodes.jpeg" alt="hanky codes" class="thumb"></a>Hanky Codes</li>
          </ul>
        </div>
        <div class="googlemap"><a href="https://maps.google.com/maps?q=Eagle+Tavern,+12th+Street,+San+Francisco,+CA,+USA&amp;hl=en&amp;sll=37.770048,-122.413315&amp;sspn=0.010974,0.01929&amp;oq=Eagle&amp;t=m&amp;z=16" target="_blank"><img src="images/google-map.jpg" width="250" height="250"></a>
          <h3>We're just off the freeway<br>398 12th Street<br>(corner of Harrison)</h3>
        </div>
        <div class="flyers">
          <div class="flexslider">
            <ul class="slides">
              <li>
                <p class="rc">Every 3rd Friday</p><a href="images/events/CubHouse-600.jpg" rel="lightbox"><img src="images/events/CubHouse-600.jpg"></a>
              </li>
              <li>
                <p class="rc">Friday Cigar Nights</p><a href="images/events/cigar-lite.jpg" rel="lightbox"><img src="images/events/cigar-lite.jpg"></a>
              </li>
              <li>
                <p class="rc">Every 2nd Saturday</p><a href="images/events/sadistic-lite.jpg" rel="lightbox"><img src="images/events/sadistic-lite.jpg"></a>
              </li>
              <li>
                <p class="rc">Every 2nd Sunday</p><a href="images/events/rubber-showtunes-lite.jpg" rel="lightbox"><img src="images/events/rubber-showtunes-lite.jpg"></a>
              </li>
              <li>
                <p class="rc">Every 3rd Saturday</p><a href="images/events/bluf-lite.jpg" rel="lightbox"><img src="images/events/bluf-lite.jpg"></a>
              </li>
              <li>
                <p class="rc">Every Now and Then</p><a href="images/events/flag-crucified.jpg" rel="lightbox"><img src="images/events/flag-crucified.jpg"></a>
              </li>
            </ul>
          </div>
          <div class="nonFlexslider">
            <ul class="slides">
              <li>
                <p class="rc">Every 3rd Friday</p><img src="images/events/CubHouse-600.jpg">
              </li>
              <li>
                <p class="rc">Friday Cigar Nights</p><img src="images/events/cigar-lite.jpg">
              </li>
              <li>
                <p class="rc">Every 2nd Saturday</p><img src="images/events/sadistic-lite.jpg">
              </li>
              <li>
                <p class="rc">Every 2nd Sunday</p><img src="images/events/rubber-showtunes-lite.jpg">
              </li>
              <li>
                <p class="rc">Every 3rd Saturday</p><img src="images/events/bluf-lite.jpg">
              </li>
              <li>
                <p class="rc">Every Now and Then</p><img src="images/events/flag-crucified.jpg">
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
    <script src="widgets/lightbox/js/lightbox-ck.js"></script>
    <script>
      $(document).ready(function(){
      $.get('index.flyers.html', function(data) {
      $('#flyers').html(data);
      });
      });
      $('div.lb-nav').on('click', function(e) {
      window.close();return false;});
      
    </script>
    <script src="widgets/flexslider/jquery.flexslider-ck.js"></script>
    <script>
      $(window).load(function() {
      $('.flexslider').flexslider({
      animation: "slide",
      animationLoop: "true"
      });
      });
      
    </script>
    <script src="js/main.js"></script>
  </body>
</html>