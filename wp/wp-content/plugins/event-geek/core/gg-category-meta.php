<?php

//http://wordpress.stackexchange.com/questions/5955/category-listing-with-thumbnail-and-description-on-home-page/6817#6817


add_action( 'edit_tag_form_fields', 'gg_category_custom_fields' );
add_action( 'edited_terms', 'save_gg_category_custom_fields' );

function gg_category_custom_fields( $tag ) {
	$tax = $_GET['taxonomy'];
	
	if($tax == 'event_category'){
		wp_enqueue_style( 'wp-color-picker' );  
		
		// we need to know the values of our existing entries if any
		$gg_category_meta = get_option( 'gg_category_meta' );
		
		$gg_event_options = get_option( 'gg_event_options');
		
		
		//get saved colors
		if($gg_category_meta[ $tag->term_id .'_event_highlight_color']){
			$background = $gg_category_meta[ $tag->term_id .'_event_highlight_color'];
		} else{
			//get default colors from options page
         	if($gg_event_options['event_highlight_color']){$background = $gg_event_options['event_highlight_color'];} else{$background = '#ffffff';}

		}//if($gg_category_meta[ $tag->term_id ]['event_highlight_color']){

		if($gg_category_meta[ $tag->term_id .'_event_highlight_text_color']){
			$textcolor = $gg_category_meta[ $tag->term_id .'_event_highlight_text_color'];
		} else{
			//get default colors from options page
         	if($gg_event_options['event_highlight_text_color']){$textcolor = $gg_event_options['event_highlight_text_color'];} else{$textcolor = '#000000';}

		}//if($gg_category_meta[ $tag->term_id ]['event_highlight_color']){			

		// your custom field HTML will go here
		// the $tag variable is a taxonomy term object with properties like $tag->name, $tag->term_id etc...
	

		?>
		<tr class="form-field">
			<th scope="row" valign="top"><label for="gg_cat_sidebar"><?php _e('Event Date Background color', 'event_geek'); ?></label></th>
			<td>
            <div class="gg_options_section">
            
				<label><?php _e('Event Date Background color', 'event_geek'); ?>:</label> <input type="text" class="color_picker" id="event_highlight_color" name="<?php echo $tag->term_id ?>_event_highlight_color" value="<?php echo $background; ?>" /><br />
			
                <label><?php _e('Event Date Text Color', 'event_geek'); ?>:</label> <input type="text" id="event_highlight_text_color" class="color_picker" name="<?php echo $tag->term_id ?>_event_highlight_text_color" value="<?php echo $textcolor; ?>" />
                <input type="hidden" name="gg_category_meta" value="<?php echo $tag->term_id; ?>" />
            </div>
			</td>
		</tr>
		<!-- rinse & repeat for other fields you need -->
		<?php
	}//if
}


function save_gg_category_custom_fields() {
    if ( isset( $_POST['gg_category_meta']) && current_user_can('manage_categories')) {
		$gg_category_meta = get_option( 'gg_category_meta' );
		$id = $_POST['gg_category_meta'];
		
		$gg_category_meta[$id . '_event_highlight_color'] = $_POST[$id . '_event_highlight_color'] ;
		$gg_category_meta[$id . '_event_highlight_text_color'] = $_POST[$id . '_event_highlight_text_color'] ;

		update_option('gg_category_meta',$gg_category_meta);
	}
}
?>
