<?php
global $post; // required

// scheduled event in tease
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
    if ( $post->post_status == "private" ) { continue; }
    if ( get_field('tease') )
    {
        include 'includes/timegames.php';
        if ( $begintime > ($now + 60*60*24*7) || $now > $endtime ) { continue; } ?>
        <section class="event" style="display: block;"> <?php
        if ( get_field('lead') )
        {
             ?>
            <div class="lead"><?php echo (get_field('lead')); ?> </div> <?php
        }
        if ( get_field('include_title') )
        { ?>
            <h1> <?php echo $post->post_title; ?> </h1> <?php
        }
        fill_tease($post);
        ?>
            </section>
            <hr>
        <?php
        break;
    }
}

// additional event if checked in admin screen
$category_id = get_cat_ID('Add to main content section');
$args = array(
    'category'      => $category_id,
    'orderby'       => 'post_date',
    'order'         => 'DESC',
    'post_type'     => 'post',
    'post_status'   => 'published',
    'numberposts'   => -1
);
$custom_posts = get_posts($args);
foreach($custom_posts as $post)
{
    if ( !$custom_posts )
    {
        continue;
    }
    setup_postdata($post);
    if ( $post->post_status == "draft" ) { continue; }
    if ( $post->post_status == "private" ) { continue; }
    if ( $post->post_status == "archived" ) { continue; }
    include 'includes/timegames.php'; ?>
    <section class="tease_now" style="display: block;">
    <?php
    if ( has_category( "print-post-title", $post ) ) { ?>
        <h1> <?php the_title(); ?> </h1>
        <?php
    }
    fill_tease($post);
} ?>
</section>

<?php
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
    <p><?php the_field('blurb'); ?> </p><?php
} ?>