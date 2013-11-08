<?php
if(!function_exists('event_geek_list')){
	function event_geek_list($options = array()){
		
		// Set defaults for all passed options
		$options = array_merge(array(
			'post_per_page'=> '',
			'order_by'=> 'meta_value_num',
			'order' => 'ASC',
			'category' => 'all',
			'all_dates' => false
		), $options); 

		global $post;
		$gg_event_options = get_option( 'gg_event_options');//get event plugin options
		$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

		$clickedDate = $_GET['date'];
		$cat = $_GET['cat'];
		
		if($clickedDate){
			$meta_query =  array(
				array(
					'key' => 'gg_event_dates',
					'value' => date($gg_event_options['gg_event_date_format'], strtotime($clickedDate)),
					'compare' => 'LIKE'
				)
			);
				
			$args = array(
				'post_type' => 'gg_events',
				'posts_per_page' => -1,
				'meta_key' => 'gg_event_dates',
				'orderby' => 'meta_value_num',
				'order' => 'ASC',
				'meta_query' => $meta_query,
			); 
		} else {

		//set up query to show only events that haven't ended
		$metaquery = array(
				 array(
					'key' => 'gg_event_date_end_standard_format',
					'value' => date('Y/n/j'),
					'compare' => '>=',
					'type' => 'date'

				 )
			  );			
		
		if($options['post_per_page']){
			$args = array(
			'post_type' => 'gg_events',
			'orderby' => $options['order_by'],
			'meta_key' => 'gg_event_dates',
			'order' => $options['order'],
		 	'paged' => $paged,		
			'posts_per_page' => $options['post_per_page']
		  ); 				
		} else {
			$args = array(
			'post_type' => 'gg_events',
			'orderby' => $options['order_by'],
			'meta_key' => 'gg_event_dates',
			'order' => $options['order'],
		 	'paged' => $paged
		  ); 			
		}
	  if(!$options['all_dates']){
		  $args['meta_query'] = $metaquery;
		  }
	}//if($clickedDate){

	if($cat && $cat != 'all'){
		$args['event_category'] = $cat;
		$term = get_term_by('slug', $cat, 'event_category');
	}
	elseif($options['category'] !='all'){
		$args['event_category'] = $options['category'];
		$term = get_term_by('slug', $options['category'], 'event_category');
	}		

	echo apply_filters('gg_template_tag_begin', '<div class="event-listing event_geek_page">');
	
	if($term->name){echo apply_filters('gg_before_event_category_title', '<h3 class="event_category_title">') .  apply_filters('gg_event_category_title', $term->name) . apply_filters('gg_after_event_category_title', '</h3>');}
	
	if($clickedDate){
	echo apply_filters('gg_before_clicked_date', '<h3>') . apply_filters('gg_clicked_date',date_i18n(get_option('date_format'), strtotime($clickedDate))) . apply_filters('gg_after_clicked_date', '</h3>'); 
	}
	
	gg_event_loop($args);
			?>
		<div class="navigation">
		<?php
			$nextEvents = apply_filters('gg_event_navigation_previous','«' . __('Later Events', 'event_geek'));
			$prevEvents = apply_filters('gg_event_navigation_next', __('Earlier Events', 'event_geek') . '»');
				 
			if (get_next_posts_link($nextEvents, $query->max_num_pages)) { ?>
				<div class="alignleft"><?php next_posts_link($nextEvents, $query->max_num_pages); ?></div>
			<?php } 
			if (get_previous_posts_link($prevEvents, $query->max_num_pages)) { ?>
				<div class="alignright"><?php previous_posts_link($prevEvents, $query->max_num_pages); ?></div>
			<?php } ?>
		</div><!--navigation--> 
		<?php
		$gg_event_options = get_option( 'gg_event_options');
		
		if($gg_event_options['event_promote'] == "yes"){
			echo '<p class="event_geek_promo"><a href="http://graphicgeek.net/event-geek" target="_blank">' . __('Powered by', 'event_geek') . ' Event Geek</a></p>'; 
		}

		echo apply_filters('gg_template_tag_end', '</div>');
		
	}//event_geek_list
}//if(!function_exists('event_geek_list'))

if(!function_exists('get_event_geek_info')){
	function get_event_geek_info($id=''){
		$return = '';
		if(!$id){global $post; $id = $post->ID;}//set default id
        $gg_names = get_post_meta($id, 'gg_names', true); //get list of meta names
        $meta = gg_get_saved_meta($gg_names,$id);// load meta data
		$gg_event_options = get_option( 'gg_event_options');//get current options
		
		if($gg_event_options['customize_event_info']){
			
			//if info customization is turned on--------------------------------------
			
			//get the list of fields
			$saved_inputs = $gg_event_options['custom_event_inputs'];
			$saved_types =  $gg_event_options['custom_event_types'];
			$count = 0;
			$info = '';
			if(is_array($saved_inputs)){
				
				foreach($saved_inputs as $input){
					$name = 'gg_event_' . strtolower($input);
					$name = str_replace(' ', '_', $name);
					if($meta[$name]){//if this input has a value filled in
						switch($saved_types[$count]){
							case 'link':
								//make sure http is added to the link
								$link = $meta[$name];
								if (strpos($link,'http://') === false){
									$link = 'http://'.$link;
								}
								
								if($meta[$name . '_link_text']){$str = $meta[$name . '_link_text'];}
								else{
									$str = $link;
									$str = preg_replace('#^https?://#', '', $str);
								}
								
								$info .='<p><strong>' . $input . ':  </strong><a href="' . $link . '" target="_blank">' . $str . '</a></p>';
							break;
							
							case 'email':
								$info .='<p><strong>' . $input . ':  </strong><a href="mailto:' . $meta[$name] . '">' . $meta[$name]  . '</a></p>';
							break;
							
							default:
								$info .='<p><strong>' . $input . ':  </strong>' . $meta[$name] . '</p>';
						}//switch
			
						
					}// if($meta[$name]){
					$count++;
				}//foreach
				if($info){
					$return .='<div class="gg_event_info custom">';
					$return .= apply_filters('gg_event_info', $info, $meta);
					$return .= '</div>'; //.gg_event_info
				}//if $info
			}//if if(is_array($saved_inputs)){
		} else{
			
			//if info customization is not turned on--------------------------------------
			
			if($meta['gg_event_address'] || $meta['gg_event_address2'] || $meta['gg_event_phone'] || $meta['gg_event_web_address']) {
				if($meta['gg_event_address']){
                         $info .= '<p><strong>' . __('Address', 'event_geek') . ': </strong>' . $meta['gg_event_address'] . '</p>';
                    }
                    if($meta['gg_event_address2']){ $info .= '<p>' . $meta['gg_event_address2'] . '</p>'; }
                    if($meta['gg_event_phone']){ $info .= '<p>' . __('Phone', 'event_geek') . ': ' . $meta['gg_event_phone'] . '</p>'; }
                    if($meta['gg_event_web_address']){
                        $link = $meta['gg_event_web_address'];
                        
                        if (strpos($link,'http://') === false){
                        $link = 'http://'.$link;
                        }
                        
                        $str = $link;
                        $str = preg_replace('#^https?://#', '', $str);
                        
                         $info .= '<p><a href="' . $link . '" target="_blank">' . $str . '</a></p>';
					}// if($meta['gg_event_web_address']
				$return .='<div class="gg_event_info">';					
					$return .= apply_filters('gg_event_info', $info, $meta);
				$return .= '</div>'; //.gg_event_info
			}// end if($meta['gg_event_address']
		
		
		}//if($gg_event_options['customize_event_info'])
		return $return;
	}//get_event_geek_info()
}//if(!function_exists('get_event_geek_info')){

if(!function_exists('event_geek_full_size')){
	function event_geek_full_size(){ ?>
		<div id="gg_fullsize_calendar"></div>
<?php }//event_geek_full_size
}//if(!function_exists('event_geek_full_size')){

if(!function_exists('gg_display_event_calendar')){
	function gg_display_event_calendar($args = array()){
		if(!is_array($args)){$args = array();}
	
		// Set defaults for all passed options
		$args = array_merge(array(
			'popup'=> 'yes',
			'category'=> 'all'
		), $args); 

		?>
         <div class="gg_widget_calendar category_<?php echo $args['category']; ?>" data-popup="<?php echo $args['popup']; ?>" data-dates='<?php gg_event_widget_dates($args['category']); ?>' data-category="<?php echo $args['category']; ?>"></div>
        <?php
	}//event_geek_full_size
}//if(!function_exists('event_geek_full_size')){
	
function gg_event_loop($args){
	global $post;
    $query = new WP_Query($args);
    while ( $query->have_posts() ) { $query->the_post();
        $gg_names = get_post_meta($post->ID, 'gg_names', true); //get list of meta names
        $meta = gg_get_saved_meta($gg_names,$post->ID);// load meta data
    
       ?>
            <div class="event-listing">
            <?php
			do_action('gg_start_event_listing', $meta);
			
			echo apply_filters('gg_before_event_title', '<h4>');
            	the_title();
            echo apply_filters('gg_after_event_title', '</h4>');
                
            echo apply_filters('gg_before_event_dates', '<div class="event_dates">');
			
				$eventStartDate = apply_filters('gg_before_event_start_date' ,'<span class="datestart">') . date_i18n(get_option('date_format'),strtotime($meta['gg_event_date_start_standard_format'])) . apply_filters('gg_after_event_start_date' ,'</span>');
				$eventEndDate = apply_filters('gg_before_event_end_date' , '<span class="dateend"> ' . __('to', 'event_geek')) . ' ' . date_i18n(get_option('date_format'),strtotime($meta['gg_event_date_end_standard_format'])) . apply_filters('gg_after_event_end_date' ,'</span>');
				 
				echo apply_filters('gg_event_start_date', $eventStartDate);
			   
				if(!$meta['gg_is_single_day']){
					echo apply_filters('gg_event_end_date', $eventEndDate);
				 }
			   
		    echo apply_filters('gg_after_event_dates', '</div>');	 
             ?>
        
            <?php
            	$thumb = wp_get_attachment_image_src( $meta['event_image_id'], 'thumbnail'); // returns an array
            
            if($thumb){
            ?><img class="event_thumb" src="<?php echo $thumb[0]; ?>" alt="<?php the_title(); ?>" /><?php } ?>
            
          <?php echo get_event_geek_info($post->ID); ?>
            
            <div class="event_content">
            <?php
			do_action('gg_before_event_content', $meta);
			 the_content(); 
			 do_action('gg_after_event_content', $meta);
			 ?>
            </div>
            
            <div class="clear"></div>
            </div>
      
    <?php
       
     }wp_reset_postdata();	
}//gg_event_loop
?>