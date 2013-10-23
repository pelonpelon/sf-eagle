<?php
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