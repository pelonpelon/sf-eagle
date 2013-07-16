<div class="tnl">
    <?php global $post; // required
    date_default_timezone_set('America/Los_Angeles');
    $now = time();
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
        if ( $post->post_status == "private" ) { continue; }
        include "php/timegames.php";
        if ( $now > $begintime + 60*60*18 ) { continue; }
        if ( ! get_field('image') ) { $image = "images/logo-cropped-thumb.jpg"; }
        else { $image = wp_get_attachment_image_src(get_field('image'), 'full'); }

        ?>
        <table>
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
            if ( get_field('type_of_event') === 'music' )
            { ?>
                <td>
                    <p>
                        <a href="<?php the_field('band_#1_link'); ?>" target="_blank" >
                            <?php the_field('band_#1'); ?>
                        </a>
                    </p>
                    <?php
                    if ( get_field('band_#2') !== "" )
                    { ?>
                        <p>
                            <a href="<?php the_field('band_#2_link'); ?>" target="_blank" >
                                <?php the_field('band_#2'); ?>
                            </a>
                        </p>
                    <?php
                    }
                    if ( get_field('band_#3') !== "" )
                    { ?>
                        <p>
                            <a href="<?php the_field('band_#3_link'); ?>" target="_blank" >
                                <?php the_field('band_#3'); ?>
                            </a>
                        </p>
                    <?php
                    }
                    if ( get_field('band_#4') !== "" )
                    { ?>
                        <p>
                            <a href="<?php the_field('band_#4_link'); ?>" target="_blank">
                                <?php the_field('band_#4'); ?>
                            </a>
                        </p>
                    <?php
                    } ?>
                </td> <?php
                }
                else
                { ?>
                    <td>
                        <p>
                            <a href="<?php the_field('link'); ?>" target="_blank" >
                                <?php the_title(); ?>
                            </a>
                        </p>
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
        </table>
    <?php
    } ?>
</div>
