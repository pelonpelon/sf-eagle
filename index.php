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
      <div id="mast">
        <header><img src="images/logo-transparency-whiteeagle-cutout-400.png" alt="logo" class="logo"></header>
        <nav>
          <ul>
            <li class="thisweek"><a href="#events" class="button"><span>This<br>Week</span></a></li>
            <li><a href="merch.php" class="button"><span>Hoodies<br>Tanks<br>& Tees</span></a></li>
            <li><a href="tnl.php" class="button"><span>Live<br>Music</span></a></li>
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
      <div id="tease"><?php $category_id = get_cat_ID('tease'); ?><div class="loop">
    <?php global $post; // required
    $args = array(
                    'category'      => $category_id,
                    'orderby'       => 'post_date',
                    'order'         => 'DESC',
                    'post_type'     => 'post',
                    'numberposts'   => 1
    );
    $custom_posts = get_posts($args);
    foreach($custom_posts as $post) : setup_postdata($post); ?>
        <h1> <?php the_title(); ?> </h1>
        <p> <?php the_content(); ?> </p>
    <?php endforeach; ?>
</div>
      </div>
      <div id="events" class="cf">
        <ul><!--li#monday.day
          <h3>Monday</h3>
          <ul class="events">
            <li id="ronaritas" class="event cf">
              <p class="time">4pm-7pm</p>
              <ul class="event-list">
                <li><a href="#" class="buttonless"><span>Happy Hour with Ron and his infamous Ronaritas</span></a></li>
                <li><a href="#" class="buttonless"><span>Gage will finish you off into the wee hours...</span></a></li>
              </ul><a href="http://www.facebook.com/gagefisher"><img src="images/staff/gage-fisher-nice-thumb.jpg " alt="gage" title="Gage"></a>
            </li>
            <li id="freepool" class="event cf">
              <p class="time">4pm-Midnight</p>
              <ul class="event-list">
                <li><a href="#" class="buttonless"><span>FREE POOL<br>$2 pints of BIG DADDY</span></a></li>
              </ul><a href="https://www.facebook.com/SpeakeasyBeer"><img src="images/events/speakeasyipa.jpg" alt="Big Daddy" class="thumb"></a>
            </li>
          </ul>--><!--li#tuesday.day
          <h3>Tuesday</h3>
          <ul class="events">
            <li id="karaoke" class="event cf">
              <p class="time">8pm</p>
              <ul class="event-list">
                <li><a href="#" class="buttonless"><span>Karaoke<br>For Dummies</span></a></li>
              </ul>
            </li>
          </ul>-->
          <li id="wednesday" class="day">
            <h3>Wednesday</h3>
            <ul class="events">
              <li class="event cf">
                <p class="time">7pm-2am</p>
                <ul class="event-list">
                  <li><a href="#" class="buttonless"><span>Break up your work week and have a hump day drink with Cody!</span></a></li>
                </ul><a href="http://www.facebook.com/cody.joseph"><img src="images/staff/cody-joseph-virgin-mary-thumb.jpg" alt="cody" title="Cody"></a>
              </li>
              <!--include events/womensnight-->
            </ul>
          </li>
          <li id="thursday" class="day">
            <h3>Thursday</h3>
            <ul class="events">
              <li id="tnl" class="event cf">
                <p class="time">9pm</p>
                <ul class="event-list">
                  <li><a href="https://www.facebook.com/TitanUps" class="button"><span>THE TITAN UPS</span></a></li>
                  <li><a href="http://www.kelleystoltz.com/" class="button"><span>KELLEY STOLTZ</span></a></li>
                  <li><a href="https://soundcloud.com/james-finch-jr" rel="lightbox" class="button"><span>JAMES FINCH JR</span></a></li>
                </ul><a href="images/events/TNL-600.jpg" rel="lightbox"><img src="images/events/TNL-160.jpg" alt="TNL Flyer"></a>
              </li>
            </ul>
          </li>
          <li id="friday" class="day">
            <h3>Friday</h3>
            <ul class="events">
              <!--include events/flag-->
              <!--include events/cachorro-->
              <li id="cigar" class="event cf">
                <ul class="event-list">
                  <li><a href="http://cubtrap.tumblr.com/" class="button"><span>CubTrap</span></a></li>
                </ul><a href="images/events/cubtrap-130712-500.jpg" rel="lightbox"><img src="images/events/cubtrap-130712-150.jpg" alt="cub trap" class="thumb"></a>
              </li>
              <li id="cigar" class="event cf">
                <ul class="event-list">
                  <li><a href="#" class="buttonless"><span>Cigar Night</span></a></li>
                </ul><a href="http://25.media.tumblr.com/tumblr_l7zya0TQID1qcbnafo1_500.jpg" rel="lightbox"><img src="images/events/cigar-thing.gif" alt="cigar night" class="thumb"></a>
              </li>
            </ul>
          </li>
          <li id="saturday" class="day">
            <h3>Saturday</h3>
            <ul class="events">
              <!--include events/cubhouse-->
              <!--include events/afterdark-->
              <!--include events/bluff-->
              <li id="sadistic" class="event cf">
                <p class="time">9pm</p>
                <ul class="event-list">
                  <li><a href="http://en.wikipedia.org/wiki/Michael_Brandon_(pornographic_actor)" class="button"><span>Sadistic Saturday</span></a></li>
                </ul><a href="images/events/sadistic-lite.jpg" rel="lightbox"><img src="images/events/sadistic-thumb.jpg" alt="Sadistic Saturday" class="thumb"></a>
              </li>
              <!--include events/special-bearbust-->
              <!--include events/charliehorse-->
            </ul>
          </li>
          <li id="sunday" class="day">
            <h3>Sunday</h3>
            <ul class="events">
              <!--include events/bust-->
              <!--include events/karaoke-->
              <li id="sunday" class="special event cf">
                <p class="time">7pm-Midnight</p>
                <ul class="event-list">
                  <li><a href="https://www.facebook.com/events/212708702216007/" class="button"><span>Bus Station John<br>Presents:<br>Disco Daddy</span></a></li>
                </ul><a href="images/events/DiscoDaddy-130714-600.jpg" rel="lightbox"><img src="images/events/DiscoDaddy-130714-150.jpg" alt="Bus Station John - Disco Daddy" class="thumb"></a>
              </li>
            </ul>
          </li>
        </ul>
      </div>
      <div id="flyers" class="cf">[flyers]</div>
      <script src="widgets/lightbox/js/jquery-1.7.2.min.js"></script>
      <script src="widgets/lightbox/js/lightbox-ck.js"></script>
      <script src="widgets/flexslider/jquery.flexslider-ck.js"></script>
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
      <!--FIXX this-->
      <!--MEMO add email address to wp form-->
      <!--MEMO create special form for Live Music-->
      <!--MEMO Split title into two lines on form-->
      <!--MEMO Just start with events list. Calendar can come later-->
      <!--MEMO vacation response-->
    </div>
  </body>
</html>