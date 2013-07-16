<ul>
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