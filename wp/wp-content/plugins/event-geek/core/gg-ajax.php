<?php
function gg_event_ajax(){
	$clickedDate = $_POST['clickedDate'];
	$cat = $_POST['cat'];
	$gg_event_options = get_option( 'gg_event_options');//get event plugin options
	
	global $post;

	$post_per_page = -1; 
	
	$meta_query =  array(
		array(
			'key' => 'gg_event_dates',
			'value' => date($gg_event_options['gg_event_date_format'], strtotime($clickedDate)),
			'compare' => 'LIKE'
		)
	);
		
	$args = array(
		'post_type' => 'gg_events',
		'posts_per_page' => $post_per_page,
		'meta_key' => 'gg_event_dates',
		'orderby' => 'meta_value_num',
		'order' => 'ASC',
		'meta_query' => $meta_query,
	); 
	  
	if($cat != 'all'){
		$args['event_category'] = $cat;
		$term = get_term_by('slug', $cat, 'event_category');
	}
		  
	

?>
	<img class="gg_close_ajax" src="<?php echo apply_filters('gg_ajax_close_image', plugins_url() . '/event-geek/images/close.png'); ?>" align="close" />

    <div id="gg_event_window_inner">
    <?php do_action('gg_event_geek_ajax_header'); ?>
    <?php if($term->name){echo apply_filters('gg_before_event_category_title', '<h3 class="event_category_title">') .  apply_filters('gg_event_category_title', $term->name) . apply_filters('gg_after_event_category_title', '</h3>');}?>
    <?php echo apply_filters('gg_before_clicked_date', '<h3>') . apply_filters('gg_clicked_date',date_i18n(get_option('date_format'), strtotime($clickedDate))) . apply_filters('gg_after_clicked_date', '</h3>'); ?>
    
    <?php gg_event_loop($args); ?>
    
    <?php 
               
        if($gg_event_options['event_promote'] == "yes"){
        
        echo '<p class="event_geek_promo"><a href="http://graphicgeek.net/event-geek" target="_blank">' . __('Powered by', 'event_geek') . ' Event Geek</a></p>'; 
        
        }
    ?>
    <?php do_action('gg_event_geek_ajax_footer'); ?>
    <?php do_action('gg_event_ajax'); ?>
    </div><!--#gg_event_window_inner-->
    <img class="arrow_up" src="<?php echo apply_filters('gg_event_arrow_up',plugins_url() . '/event-geek/images/arrow-up.png'); ?>" alt="arrow up" />
    <img class="arrow_down" src="<?php echo apply_filters('gg_event_arrow_down', plugins_url() . '/event-geek/images/arrow-down.png'); ?>" alt="arrow up" />
 <?php   exit;
}

// for logged in users
add_action('wp_ajax_gg_event_ajax', 'gg_event_ajax');
// for non-logged in users
add_action('wp_ajax_nopriv_gg_event_ajax', 'gg_event_ajax');

function gg_ajax_event_info(){
	global $post;
	$return = array(
		'title' => array(),
		'start_date' => array()
	);
	
	$args = array(
		'post_type' => 'gg_events',	
		'posts_per_page' => -1
	); 	
	
	$query = new WP_Query($args);
		while ( $query->have_posts() ) { $query->the_post();
			$gg_names = get_post_meta($post->ID, 'gg_names', true); //get list of meta names
			$meta = gg_get_saved_meta($gg_names,$post->ID);// load meta data
			
			$return['title'][] = get_the_title();
			$return['start_date'][] = $meta['gg_event_date_start_standard_format'];
			
		} wp_reset_postdata();	//end while
		
		echo json_encode($return);
		
	exit;
}//gg_ajax_event_info

// for logged in users
add_action('wp_ajax_gg_ajax_event_info', 'gg_ajax_event_info');
// for non-logged in users
add_action('wp_ajax_nopriv_gg_ajax_event_info', 'gg_ajax_event_info');

?>