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
  </head>
  <body><!-- hello -->
    <!-- #background-->
    <div id="root">
      <div id="page" class="simple merch"><a href="index.php"><img src="images/logo.svg" alt="logo" class="logo"></a>
        <section>
          <header class="cf">
            <h1>Hoodies Tanks & Tees</h1>
          </header>
          <article>
            <div class="samples"><img src="images/merch/tee-red-front.jpg" alt="Red T-Shirt (front)"><img src="images/merch/tank-white-front.jpg" alt="White Tanktop (front)"><img src="images/merch/tank-gray-front.jpg" alt="Gray Tanktop (front)"><img src="images/merch/hoodie-gray-front.jpg" alt="Gray Hoodie (front)"><img src="images/merch/hoodie-gray-back.jpg" alt="Gray Hoodie (back)"><img src="images/merch/hoodie-black-front.jpg" alt="Black Hoodie (front)"><img src="images/merch/hoodie-black-back.jpg" alt="Black Hoodie (back)"></div>
            <div id="hoodiequality">Hoodies are 80% cotton / 20% polyester<br>Beautiful and built to last<br><br>... models not included ...</div>
            <table>
              <tr>
                <td>
                  <form action="merch-email.html" method="get">
                    <input type="hidden" name="cmd" value="_s-xclick">
                    <input type="hidden" name="hosted_button_id" value="NFJKF939UUQT2">
                  </form>
                </td>
              </tr>
            </table>
            <table>
              <tr>
                <td>
                  <input type="hidden" name="on0" value="ITEMS"><br>
                </td>
              </tr>
              <tr>
                <td>
                  <select name="os0">
                    <option value="T-SHIRT-BLACK">T-SHIRT (black) $18.00</option>
                    <option value="T-SHIRT-RED">T-SHIRT (red) $25.00</option>
                    <option value="T-SHIRT-LONG-SLEEVE">LONG SLEEVE T (black: not shown) $30.00</option>
                    <option value="TANKTOP-WHITE">TANKTOP (white) $25.00</option>
                    <option value="TANKTOP-GRAY">TANKTOP (gray) $25.00</option>
                    <option value="HOODIE-GRAY">HOODIE (gray) $55.00</option>
                    <option value="HOODIE-BLACK">HOODIE (black) $55.00</option>
                  </select>
                </td>
              </tr>
              <tr>
                <td>
                  <input type="hidden" name="on1" value="SIZE">
                </td>
              </tr>
              <tr>
                <td>
                  <select name="os1"></select>
                  <option value="XXL">XXL</option>
                  <option value="XL">XL</option>
                  <option value="L">L</option>
                  <option value="M">M</option>
                  <option value="S">S</option>
                </td>
              </tr>
              <tr>
                <td>
                  <input type="hidden" name="currency_code" value="USD">
                  <input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_buynowCC_LG.gif" name="submit" alt="PayPal - The safer, easier way to pay online!">
                </td>
              </tr>
              <tr>
                <td>
                  <p>*shipping rate applies within the continental U.S. only - International rate will vary please email info@sf-eagle.com for information</p>
                  <p><a href="policy.html">return policy | privacy policy</a><a href="merch-email.html"></a></p>
                </td>
              </tr>
            </table>
          </article>
        </section>
        <div id="page-footer"></div>
      </div>
      <div id="footer">
        <div class="links">
          <ul class="social">
            <li class="faceboook"><a href="http://www.facebook.com/SFEagle" title="We're on Facebook" target="_blank" width="60" height="60"><img src="images/icons/facebook.png" alt="facebook" class="thumb"></a></li>
            <li class="twitter"><a href="https://twitter.com/sfeaglebar" title="We're on Twitter" target="_blank" width="60" height="60"><img src="images/icons/twitter.png" alt="twitter" class="thumb"></a></li>
            <li class="google"><a href="https://plus.google.com/109544451979985071388/posts" rel="publisher" title="We're on Google Plus" target="_blank" width="60" height="60"><img src="images/icons/google-plus-icon.png" alt="google+" class="thumb"></a></li>
            <li class="youtube"><a href="http://www.youtube.com/channel/UCmzgZ3-nEo1S8tnyjGJ3WoQ/videos" title="We're on Youtube" target="_blank" width="60" height="60"><img src="images/icons/youtube-icon.png" alt="youtube" class="thumb"></a></li>
            <li class="email"><a href="mailto:info@sf-eagle.com?subject=Sent%20via%20website" title="Send us email" width="60" height="60"><img src="images/icons/email.png" alt="email" class="thumb"></a></li>
          </ul>
          <ul class="info">
            <li class="hankypic"><a href="GayHankyCodes.php" title="Don't miss our monthly FLAG parties"><img src="images/hankycodes.jpeg" alt="hanky codes" class="thumb"></a>Hanky Code</li>
          </ul>
        </div>
        <div class="content">
          <div class="googlemap"><a href="https://maps.google.com/maps?q=Eagle+Tavern,+12th+Street,+San+Francisco,+CA,+USA&amp;hl=en&amp;sll=37.770048,-122.413315&amp;sspn=0.010974,0.01929&amp;oq=Eagle&amp;t=m&amp;z=16" target="_blank"><img src="images/google-map.jpg" width="250" height="250"></a>
            <h3>We're just off the freeway<br>398 12th Street<br>(corner of Harrison)</h3>
          </div>
          <div class="mrsfeagle"><a href="images/mrsfeagle.png" rel="lightbox"><img src="images/mrsfeagle.png" alt="Mr. SF-Eagle Application" width="451" height="600"></a><a href="docs/mrsfeagle-application.pdf" target="_blank" alt="Mr. SF-Eagle Application">
              <h3>DOWNLOAD PDF</h3></a></div>
        </div>
        <div class="flyers">
          <div class="flexslider">
            <ul class="slides">
              <li>
                <p class="rc">Once A Month</p><a href="images/events/DiscoDaddy-442x600.jpg" rel="lightbox"><img src="images/events/DiscoDaddy-442x600.jpg"></a>
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
                <p class="rc">Once A Month</p><img src="images/events/DiscoDaddy-442x600.jpg">
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
    <script src="js/fastclick.min.js"></script>
    <script>
      window.addEventListener('load', function() {
        FastClick.attach(document.body);
      }, false);
      
    </script>
  </body>
</html>