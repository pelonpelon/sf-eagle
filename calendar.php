<?php
date_default_timezone_set('America/Los_Angeles');
$local_time_zone_factor = trim(date('O', strtotime("now")), "-0");
global $now;
$now = time();
require('wp/wp-blog-header.php');
?>
<!DOCTYPE html><html><head><title>SF-Eagle Gay Bar | 398 12th Street</title><meta http-equiv="Content-Type" content="text/html" charset="utf-8"><!-- <META HTTP-EQUIV="CACHE-CONTROL" CONTENT="NO-CACHE">--><meta name="viewport" content="width=device-width"><meta name="viewport" content="initial-scale=1.0"><!--link(rel='stylesheet', href='css/wp.css')--><link rel="stylesheet" href="css/main.css.1374400525"><link href="http://fonts.googleapis.com/css?family=Jolly+Lodger|Coming+Soon|Rouge+Script" rel="stylesheet" type="text/css"><link rel="apple-touch-icon" href="images/icons/touch-icon-iphone-57x57.png"><link rel="apple-touch-icon" sizes="72x72" href="images/icons/touch-icon-ipad.png"><link rel="apple-touch-icon" sizes="114x114" href="images/icons/touch-icon-iphone-retina.png"><link rel="apple-touch-icon" sizes="144x144" href="images/icons/touch-icon-ipad-retina.png"><script>(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
})(window,document,'script','//www.google-analytics.com/analytics.js','ga');
ga('create', 'UA-42163204-1', 'sf-eagle.com');
ga('send', 'pageview');</script></head><body><!-- hello --><div id="background"></div><div id="page" class="simple calendar"><a href="index.php"><img src="images/logo-transparency-whiteeagle-cutout-thumb.png" alt="logo" class="logo"></a><section><header><h1>EAGLE CALENDAR</h1></header><article><nav><a href="#"><img src="images/icons/TNL-button-les_paul.png" width="120" height="120" alt="Thursday Night Live Button" class="music"></a><a href="#"><img src="images/icons/calbears-button.png" width="120" height="120" alt="Bears Button" class="bears"></a><a href="#"><img src="images/icons/tom_of_finland.png" width="120" height="120" alt="Leather Button" class="leather"></a><a href="#"><img src="images/icons/anaconda-ugly.png" width="120" height="120" alt="Drag Button" class="drag"></a></nav><table>
    <?php global $post; // required
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
//        MEMO: This is the way to privatize some pages
        include "access.php";
        $type_of_event = get_field('type_of_event');
        if ( $post->post_status == "private" ) { continue; }
        include "includes/timegames.php";
        if ( $now > $endtime + 60*60*18 ) { continue; }
        if ( ! get_field('image') ) { $image = "images/logo-cropped-thumb.jpg"; }
        else { $image = wp_get_attachment_image_src(get_field('image'), 'full'); }

        ?>
            <tr class="<?php echo get_post_meta(get_the_ID(), 'crowd', true); ?>">
                <td>
                    <h2> <?php $day = date('l', $begintime);
                        echo $day; ?> <sup><?php echo date('n/j', $begintime ); ?></sup>
                    </h2>
                    <p class="time"> <?php
                        echo $start . " - " . $finish;
                        ?>
                    </p>
                </td> <?php
                $type_of_event = get_field('type_of_event');
            if ( $type_of_event[0] === 'music' )
            { ?>
                <td>
                    <h5>
                        <a href="<?php the_field('band_#1_link'); ?>" target="_blank" >
                            <?php the_field('band_#1'); ?>
                        </a>
                    </h5>
                    <?php
                    if ( get_field('band_#2') !== "" )
                    { ?>
                        <h5>
                            <a href="<?php the_field('band_#2_link'); ?>" target="_blank" >
                                <?php the_field('band_#2'); ?>
                            </a>
                        </h5>
                    <?php
                    }
                    if ( get_field('band_#3') !== "" )
                    { ?>
                        <h5>
                            <a href="<?php the_field('band_#3_link'); ?>" target="_blank" >
                                <?php the_field('band_#3'); ?>
                            </a>
                        </h5>
                    <?php
                    }
                    if ( get_field('band_#4') !== "" )
                    { ?>
                        <h5>
                            <a href="<?php the_field('band_#4_link'); ?>" target="_blank">
                                <?php the_field('band_#4'); ?>
                            </a>
                        </h5>
                    <?php
                    } ?>
                </td> <?php
                }
                else
                { ?>
                    <td>
                        <h5>
                            <a href="<?php the_field('link'); ?>" target="_blank" >
                                <?php the_title(); ?>
                            </a>
                        </h5>
                    </td> <?php
                } ?>
                <td>
                    <?php
                    $image_large = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'large');
                    $image_thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'thumbnail');
                    ?>
                    <a href="<?php echo $image_large[0] ?>" width="<?php echo $image_large[1]; ?>" height="<?php echo $image_large[2]; ?>" rel="lightbox">
                        <img src="<?php echo $image_thumbnail[0] ?>" width="<?php echo $image_thumbnail[1]; ?>" height="<?php echo $image_thumbnail[2]; ?>" alt="<?php the_title(); ?>" class="thumb">
                    </a>
                </td>
            </tr>
    <?php
    } ?>
</table>
</article></section></div><script src="widgets/lightbox/js/jquery-1.7.2.min.js"></script><script src="widgets/lightbox/js/lightbox-ck.js"></script><script src="widgets/flexslider/jquery.flexslider-ck.js"></script><script src="js/main.js.1374290986"></script></body></html>
