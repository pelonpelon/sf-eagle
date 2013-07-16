<ul class="events">
    <?php global $post; // required
    //correction for time-picker
    $tz = -25200;
    $args = array(
        'meta_key'      => 'date',
        'orderby'       => 'meta_value',
        'order'         => 'ASC',
        'post_type'     => 'event',
        'numberposts'   => -1
    );
    $custom_posts = get_posts($args);
    $day = '';
    $now = time();
    foreach($custom_posts as $post)
    {
        $type = get_field('type_of_event');
        if ( $type[0] !== "music" ) { continue; }
        setup_postdata($post);
        $scheduled = (get_post_meta(get_the_ID(), 'date', true));
        if ($day != date('l', $scheduled))
        { ?>
            <li id="<?php echo date('l', $scheduled); ?>" class="day">
            <h3> <?php echo date('l', $scheduled); ?> <sup><?php echo date('n/j', $scheduled); ?></sup> </h3>
        <?php
        }
        $day = date('l', $scheduled); ?>
    <li class="event cf">
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
            } ?>
        </ul>
        <?php $image = wp_get_attachment_image_src(get_field('image'), 'full'); ?>
        <a href="<?php echo $image[0]; ?>" rel="lightbox">
            <img src="<?php echo $image[0]; ?>" width="140" height="140" alt="<?php the_title(); ?>" class="thumb">
        </a>
    </li> <?php
    } ?>
</ul>
