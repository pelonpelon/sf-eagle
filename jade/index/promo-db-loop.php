<?php
    global $post;
    $category_id = get_cat_ID('Add to sidebar');
    $args = array(
    'category'      => $category_id,
    'orderby'       => 'post_date',
    'order'         => 'ASC',
    'post_type'     => 'post',
    'post_status'   => 'publish',
    'numberposts'   => 2
    );
  $query_starttime = microtime(true); 
  $custom_posts = get_posts($args);
  $query_endtime = microtime(true); 
  $querytime = $query_endtime - $query_starttime; ?>
  <span id="event-loop-query-time" style="display:none;"><?php echo $querytime; ?></span>
<?php
    if ( $custom_posts[1] ) {
      $post = $custom_posts[1];
      setup_postdata($post);
      ?>
        <section class="promo">
            <?php the_content();?>
        </section><?php
    }
    if ( $custom_posts[0] ) {
      $post = $custom_posts[0];
      setup_postdata($post);
      ?>
        <section class="promo">
            <?php the_content();?>
        </section><?php
    } ?>
