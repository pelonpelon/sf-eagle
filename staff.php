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
    <link rel="prefetch font/woff" href="//themes.googleusercontent.com/static/fonts/comingsoon/v3/myblyOycMnPMGjfPG-DzP4bN6UDyHWBl620a-IRfuBk.woff" type="text/css">
    <link rel="prefetch font/woff" href="//themes.googleusercontent.com/static/fonts/jollylodger/v1/RX8HnkBgaEKQSHQyP9itiXhCUOGz7vYGh680lGh-uXM.woff" type="text/css">
    <link rel="stylesheet" href="css/main.css">
    <link rel="apple-touch-icon" href="images/icons/apple-touch-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="72x72" href="images/icons/touch-icon-ipad.png">
    <link rel="apple-touch-icon" sizes="114x114" href="images/icons/touch-icon-iphone-retina.png">
    <link rel="apple-touch-icon" sizes="144x144" href="images/icons/touch-icon-ipad-retina.png">
    <!-- [if gte IE 9]-->
    <style type="text/css">
      .gradient {
         filter: none;
      }
    </style>
    <!-- [endif]-->
    <script>
      (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
      (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
      m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
      })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
      ga('create', 'UA-42163204-1', 'sf-eagle.com');
      ga('send', 'pageview');
    </script>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
  </head>
  <body><!-- hello -->
    <!-- #background-->
    <div id="root">
      <div id="page"><a href="index.php"><img src="images/logo.svg" alt="logo" class="logo"></a>
        <div id="page-footer"></div>
      </div>
      <div id="footer">
        <div class="links">
          <ul class="social">
            <li class="faceboook"><a href="http://www.facebook.com/theSFEagle" title="We're on Facebook" target="_blank" width="60" height="60"><img src="images/icons/facebook.png" alt="facebook" class="thumb"></a></li>
            <li class="twitter"><a href="https://twitter.com/sfeaglebar" title="We're on Twitter" target="_blank" width="60" height="60"><img src="images/icons/twitter.png" alt="twitter" class="thumb"></a></li>
            <li class="google"><a href="https://plus.google.com/104184281608152528049/posts" rel="publisher" title="We're on Google Plus" target="_blank" width="60" height="60"><img src="images/icons/google-plus-icon.png" alt="google+" class="thumb"></a>
            </li>
            <li class="youtube"><a href="http://www.youtube.com/channel/UCmzgZ3-nEo1S8tnyjGJ3WoQ/videos" title="We're on Youtube" target="_blank" width="60" height="60"><img src="images/icons/youtube-icon.png" alt="youtube" class="thumb"></a></li>
            <li class="instagram"><a href="http://instagram.com/sfeagle" title="We're on Instagram" target="_blank" width="60" height="60"><img src="images/icons/instagram-60x60.png" alt="instagram" class="thumb"></a></li>
            <li class="email"><a href="mailto:info@sf-eagle.com?subject=Sent%20via%20website" title="Send us email" width="60" height="60"><img src="images/icons/email.png" alt="email" class="thumb"></a></li>
          </ul>
        </div>
        <div class="content">
          <div class="googlemap"><a href="https://maps.google.com/maps?q=Eagle+Tavern,+12th+Street,+San+Francisco,+CA,+USA&amp;hl=en&amp;sll=37.770048,-122.413315&amp;sspn=0.010974,0.01929&amp;oq=Eagle&amp;t=m&amp;z=16" target="_blank"><img src="images/google-map.jpg" width="250" height="250"></a>
            <h3>We're just off the freeway<br>398 12th Street<br>(corner of Harrison)</h3>
          </div>
          <div class="hankypic"><a href="GayHankyCodes.php" title="Don't miss our monthly FLAG parties"><img src="images/hankycodes.jpeg" alt="hanky codes" class="thumb">
              <h3>HANKY CODES</h3></a></div>
        </div>
        <div class="flyers">
          <div class="flexslider">
            <ul class="slides">
              <li>
                <p class="rc">3rd and 5th Sundays</p><a href="images/events/DiscoDaddy-442x600.jpg" rel="lightbox"><img src="images/events/DiscoDaddy-442x600.jpg"></a>
              </li>
              <li>
                <p class="rc">Every 3rd Friday</p><a href="images/events/CubHouse-600.jpg" rel="lightbox"><img src="images/events/CubHouse-600.jpg"></a>
              </li>
              <li>
                <p class="rc">Friday Cigar Nights</p><a href="images/events/cigar-lite.jpg" rel="lightbox"><img src="images/events/cigar-lite.jpg"></a>
              </li>
              <li>
                <p class="rc">Every 4th Saturday</p><a href="images/events/Sadistic-generic-389x600.jpg" rel="lightbox"><img src="images/events/Sadistic-generic-389x600.jpg"></a>
              </li>
              <li>
                <p class="rc">Every 3rd Saturday</p><a href="images/events/bluf-lite.jpg" rel="lightbox"><img src="images/events/bluf-lite.jpg"></a>
              </li>
            </ul>
          </div>
          <div class="nonFlexslider">
            <ul class="slides">
              <li>
                <p class="rc">3rd and 5th Sundays</p><img src="images/events/DiscoDaddy-442x600.jpg">
              </li>
              <li>
                <p class="rc">Every 3rd Friday</p><img src="images/events/CubHouse-600.jpg">
              </li>
              <li>
                <p class="rc">Friday Cigar Nights</p><img src="images/events/cigar-lite.jpg">
              </li>
              <li>
                <p class="rc">Every 4th Saturday</p><img src="images/events/Sadistic-generic-389x600.jpg">
              </li>
              <li>
                <p class="rc">Every 3rd Saturday</p><img src="images/events/bluf-lite.jpg">
              </li>
            </ul>
          </div>
        </div>
        <div class="instagramWidget"><a name="instagram"></a>
          <div class="instagramWidgetMax">
            <iframe width="760" height="240" src="http://statigr.am/widget.php?choice=myfeed&amp;username=sfeagle&amp;show_infos=false&amp;linking=instagram&amp;width=760&amp;height=240&amp;mode=grid&amp;layout_x=6&amp;layout_y=1&amp;padding=0&amp;photo_border=false&amp;background=000000&amp;text=CC0000&amp;widget_border=false&amp;radius=5&amp;border-color=990000&amp;user_id=0&amp;time=0" allowTransparency="true" frameborder="0" scrolling="no" style="border:none; overflow:hidden; width:760px; height:240px;"></iframe>
          </div>
          <div class="instagramWidgetPhone">
            <iframe name="instagram" width="320" height="2400" src="http://statigr.am/widget.php?choice=myfeed&amp;username=sfeagle&amp;show_infos=false&amp;linking=instagram&amp;width=320&amp;height=2000&amp;mode=grid&amp;layout_x=1&amp;layout_y=8&amp;padding=5&amp;photo_border=true&amp;background=000000&amp;text=CC0000&amp;widget_border=false&amp;radius=5&amp;border-color=990000&amp;user_id=723500402&amp;time=1389483326810" allowTransparency="true" frameborder="0" scrolling="no" style="border:none; overflow:hidden; width:320px;"></iframe>
          </div>
        </div>
        <div class="footer-widgets"><?php
    global $post;
    $category_id = get_cat_ID('Add to footer');
    $args = array(
    'category'      => $category_id,
    'orderby'       => 'post_date',
    'order'         => 'DESC',
    'post_type'     => 'post',
    'post_status'   => 'scheduled',
    'numberposts'   => -1
    );
    $posts = get_posts($args);
    foreach($posts as $post)
    {
        if ( !$posts) { continue; }
        setup_postdata($post);
        if ( $post->post_status == "draft" ) { continue; }
        if ( $post->post_status == "private" ) { continue; }
        if ( $post->post_status == "archived" ) { continue; }
        include 'includes/timegames.php';
        ?>
        <section class="footer-widget" style="display: block;">
          <h3><?php the_title() ?></h3>
          <div class="footer-widget-content"><?php the_content(); ?></div>
        </section><?php
    }?>

        </div>
      </div>
    </div>
    <script src="widgets/lightbox/js/lightbox-ck.js"></script>
    <script>
      $(document).ready(function(){
      $.get('index.flyers.html', function(data) {
      $('#flyers').html(data);
      });
      });
      $('div.lb-nav').on('click', function(e) {
      window.close();return false;});
      addEventListener("load", function() {
        window.scrollTo(1, 0);
      }, false);
      
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
    <script src="js/fastclick.min.js"></script>
    <script>(function() {
  window.addEventListener('load', function() {
    return FastClick.attach(document.body, false);
  });

}).call(this);

    </script>
  </body>
</html>