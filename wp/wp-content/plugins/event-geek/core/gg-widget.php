<?php
//http://codex.wordpress.org/Widgets_API
class gg_event_widget extends WP_Widget {

	public function __construct() {
		// widget actual processes
		parent::__construct(
	 		'gg_event_widget', // Base ID
			'Event Geek Calendar Widget', // Name
			array( 'description' => __( 'Show a Calendar of Events')) // Args
		);		
		
	}

/*--------------------------Admin Form------------------------------------------------------*/
 	public function form( $instance ) {
		// outputs the options form on admin

		?>

		<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label> 
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $instance['title'] ); ?>" />

		<div class="gg_widget_section">
            <label for="<?php echo $this->get_field_id('include_link'); ?>"><?php _e('Include Link to Event Page:', 'event_geek'); ?></label> 
            <input id="<?php echo $this->get_field_id('include_link'); ?>" name="<?php echo $this->get_field_name('include_link'); ?>" type="checkbox" <?php checked($instance['include_link'], 'yes'); ?> value="yes" />
		</div>

		<div class="gg_widget_section">
            <label for="<?php echo $this->get_field_id('no_popup'); ?>"><?php _e('Do Not Use Popup:', 'event_geek'); ?></label> 
            <input id="<?php echo $this->get_field_id('no_popup'); ?>" name="<?php echo $this->get_field_name('no_popup'); ?>" type="checkbox" <?php checked($instance['no_popup'], 'yes'); ?> value="yes" />
            <p class="gg_small"><?php _e('Be sure you have selected a template page on the ','event_geek'); ?><a href="<?php echo admin_url(); ?>/edit.php?post_type=gg_events&page=gg_event_menu"><?php _e('options page','event_geek'); ?>.</a></p>
		</div>    

		<div class="gg_widget_section">
            <label for="<?php echo $this->get_field_id('category'); ?>"><?php _e('Category:', 'event_geek'); ?></label> 
            <select id="<?php echo $this->get_field_id('category'); ?>" name="<?php echo $this->get_field_name('category'); ?>">
				<?php
					gg_category_selector($instance['category']); 
				?>
            </select>
            
		</div>                
 
		<?php 
		
	}


/*--------------------------save info------------------------------------------------------*/
	public function update( $new_instance, $old_instance ) {
		// processes widget options to be saved
		$instance = array();
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['include_link'] = strip_tags( $new_instance['include_link'] );
		$instance['no_popup'] = $new_instance['no_popup'];
		$instance['category'] = $new_instance['category'];		

		return $instance;		
	}


/*--------------------------Front End display----------------------------------------------*/
	public function widget( $args, $instance ) {
		// outputs the content of the widget
		extract( $args );

 ?>
 <?php echo $before_widget; ?>

<?php


if($instance['include_link'] || $instance['no_popup']){ 
	$gg_event_options = get_option( 'gg_event_options');
	$url = get_permalink($gg_event_options['event_page_id']);
}

if($url && $instance['no_popup']){
	$popup = $url;
} else {
	$popup = 'yes'; 
}

 ?>

<?php

do_action('gg_start_event_widget');

	echo $before_title;
	if($url){ echo '<a href="' . $url . '">';}
		echo apply_filters('gg_event_widget_title', $instance['title']);
	if($url){ echo '</a>';}
	echo $after_title; 
	
	$args = array(
		'popup' => $popup,
		'category' => $instance['category']
	);
	
	gg_display_event_calendar($args);
	
?>

<?php if($url && $instance['include_link']){ ?>
	<h4><a href="<?php echo $url; ?>"><?php echo apply_filters('gg_widget_link_text', __('More Events', 'event_geek')); ?></a></h4>	
<?php } ?>

<?php
do_action('gg_end_event_widget');
 echo $after_widget; 	
	}

}

add_action('widgets_init', 'register_gg_widget');
function register_gg_widget() {
    register_widget('gg_event_widget');
}

?>