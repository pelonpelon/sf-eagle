<div class="loop"> <?php
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