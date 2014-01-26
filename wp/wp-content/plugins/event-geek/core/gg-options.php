<?php
add_action('admin_menu', 'gg_add_event_options');

function gg_add_event_options() {
	
	$title = __("Event Geek Options", 'event_geek');
	$header = __("Event Options", 'event_geek');
	$parent_slug = 'edit.php?post_type=gg_events';
	$page_title = __("Event Options", 'event_geek');
	$menu_title = __("Options", 'event_geek');
	$capability = 'manage_options';
	$menu_slug = 'gg_event_menu';
	$function = 'gg_event_options';
	
	add_submenu_page( $parent_slug, $page_title, $menu_title, $capability, $menu_slug, $function );
	
}

function gg_event_options() {
	
	if(isset($_POST['submit'])){
		// verify this came from the our screen and with proper authorization,
		// because save_post can be triggered at other times
		$ggNonce = $_POST['gg_event_options_noncename'];
		if (wp_verify_nonce( $ggNonce, 'gg_event_geek-nonce' . plugin_basename(__FILE__) )) {
	   
			$gg_event_posted_options = array();
			$gg_event_posted_options['event_ui_theme'] = $_POST['event_ui_theme'];
			$gg_event_posted_options['event_custom_ui_theme'] = $_POST['event_custom_ui_theme'];
			$gg_event_posted_options['event_highlight_color'] = $_POST['event_highlight_color'];
			$gg_event_posted_options['event_highlight_text_color'] = $_POST['event_highlight_text_color'];	
			$gg_event_posted_options['event_promote'] = $_POST['event_promote'];			
			$gg_event_posted_options['event_language'] = $_POST['event_language'];
			$gg_event_posted_options['customize_event_info'] = $_POST['customize_event_info'];	
			$gg_event_posted_options['custom_event_inputs'] = $_POST['custom_event_inputs'];
			$gg_event_posted_options['custom_event_types'] = $_POST['custom_event_types'];
			$gg_event_posted_options['event_popup_bg_color'] = $_POST['event_popup_bg_color'];
			$gg_event_posted_options['event_page_id'] = $_POST['event_page_id'];						
			$gg_event_posted_options['event_lightbox'] = $_POST['event_lightbox'];
			$gg_event_posted_options['event_lightbox_color'] = $_POST['event_lightbox_color'];
			$gg_event_posted_options['event_lightbox_transparency'] = $_POST['event_lightbox_transparency'];			
			$gg_event_posted_options['event_popup_border_color'] = $_POST['event_popup_border_color'];
			$gg_event_posted_options['event_popup_border_width'] = $_POST['event_popup_border_width'];
			$gg_event_posted_options['event_popup_text_color'] = $_POST['event_popup_text_color'];
			$gg_event_posted_options['event_popup_link_color'] = $_POST['event_popup_link_color'];						
			$gg_event_posted_options['event_popup_info_bg_color'] = $_POST['event_popup_info_bg_color'];	
			$gg_event_posted_options['event_popup_info_border_width'] = $_POST['event_popup_info_border_width'];
			$gg_event_posted_options['event_popup_info_text_color'] = $_POST['event_popup_info_text_color'];
			$gg_event_posted_options['event_popup_info_link_color'] = $_POST['event_popup_info_link_color'];										
			$gg_event_posted_options['event_popup_info_box_width'] = $_POST['event_popup_info_box_width'];	
			$gg_event_posted_options['event_popup_info_border_color'] = $_POST['event_popup_info_border_color'];						
			do_action('gg_options_submited');
				
			update_option('gg_event_options', $gg_event_posted_options);
		
		} else{ //verify failed:
			wp_die( __('Security Error. Try again.') );
		}//end verify nonce
	}// end isset submit

	if (!current_user_can('manage_options'))  {
    	wp_die( __('You do not have sufficient permissions to access this page.', 'event_geek') );
	}

	$gg_event_options = get_option( 'gg_event_options');
	
	if(!$gg_event_options){
		
		$gg_event_defaults = array();
		$gg_event_defaults['event_ui_theme'] = 'base';
		$gg_event_defaults['event_highlight_color'] = '#FFFFFF';
		$gg_event_defaults['event_highlight_text_color'] = '#000000';
		$gg_event_defaults['event_language'] = 'base';
	
		add_option( "gg_event_options", $gg_event_defaults );
		$gg_event_options = get_option( 'gg_event_options');
	}//if(!$gg_event_options)
	
	$defaults = array(
		'event_popup_border_width' => 1,
		'event_lightbox_transparency' => .5,
		'event_popup_info_border_width' => 1,
		'event_popup_info_box_width' => 25
	);
	
	$gg_event_options = array_merge($defaults, $gg_event_options);

?>

    <div class="wrap">
		<?php  $title = __("Event Geek Options", 'event_geek');  ?>
        
        <h2><?php echo $title; ?></h2>
        <hr />
        
        <?php if(isset($_POST['submit'])){?><div id="message" class="updated"><p><?php echo $title; ?> <?php _e('Updated', 'event_geek'); ?></p></div><?php } ?>

        <form id="gg_event-form" method="post">
			<?php 
                
                // Noncename needed to verify where the data originated
                echo '<input type="hidden" name="gg_event_options_noncename" id="gg_event_options_noncename" value="' .
                wp_create_nonce( 'gg_event_geek-nonce' . plugin_basename(__FILE__) ) . '" />';
                
            ?>
            <div class="gg_options_section">
                <h3><?php _e('Style Options', 'event_geek'); ?>:</h3>
                
                    <p><strong><?php _e('Select a style', 'event_geek'); ?>: </strong>
                    <select id="event_ui_theme" name="event_ui_theme">
                        <option value="smoothness" <?php selected($gg_event_options['event_ui_theme'], "smoothness"); ?> >Smoothness</option>
                        <option value="ui-lightness" <?php selected($gg_event_options['event_ui_theme'], "ui-lightness"); ?> >UI Lightness</option>
                        <option value="ui-darkness" <?php selected($gg_event_options['event_ui_theme'], "ui-darkness"); ?> >UI Darkness</option>
                        <option value="start" <?php selected($gg_event_options['event_ui_theme'], "start"); ?> >Start</option>
                        <option value="redmond" <?php selected($gg_event_options['event_ui_theme'], "redmond"); ?> >Redmond</option>
                        <option value="sunny" <?php selected($gg_event_options['event_ui_theme'], "sunny"); ?> >Sunny</option>
                        <option value="overcast" <?php selected($gg_event_options['event_ui_theme'], "overcast"); ?> >Overcast</option>
                        <option value="le-frog" <?php selected($gg_event_options['event_ui_theme'], "le-frog"); ?> >Le Frog</option>
                        <option value="flick" <?php selected($gg_event_options['event_ui_theme'], "flick"); ?> >Flick</option>
                        <option value="pepper-grinder" <?php selected($gg_event_options['event_ui_theme'], "pepper-grinder"); ?> >Pepper Grinder</option>
                        <option value="eggplant" <?php selected($gg_event_options['event_ui_theme'], "eggplant"); ?> >Eggplant</option>
                        <option value="dark-hive" <?php selected($gg_event_options['event_ui_theme'], "dark-hive"); ?> >Dark Hive</option>
                        <option value="cupertino" <?php selected($gg_event_options['event_ui_theme'], "cupertino"); ?> >Cupertino</option>
                        <option value="south-street" <?php selected($gg_event_options['event_ui_theme'], "south-street"); ?> >South Street</option>
                        <option value="blitzer" <?php selected($gg_event_options['event_ui_theme'], "blitzer"); ?> >Blitzer</option>
                        <option value="humanity" <?php selected($gg_event_options['event_ui_theme'], "humanity"); ?> >Humanity</option>
                        <option value="hot-sneaks" <?php selected($gg_event_options['event_ui_theme'], "hot-sneaks"); ?> >Hot Sneaks</option>
                        <option value="excite-bike" <?php selected($gg_event_options['event_ui_theme'], "excite-bike"); ?> >Excite Bike</option>
                        <option value="vader" <?php selected($gg_event_options['event_ui_theme'], "vader"); ?> >Vader</option>
                        <option value="dot-luv" <?php selected($gg_event_options['event_ui_theme'], "dot-luv"); ?> >Dot Luv</option>
                        <option value="mint-choc" <?php selected($gg_event_options['event_ui_theme'], "mint-choc"); ?> >mint-choc</option>
                        <option value="black-tie" <?php selected($gg_event_options['event_ui_theme'], "black-tie"); ?> >Black Tie</option>
                        <option value="trontastic" <?php selected($gg_event_options['event_ui_theme'], "trontastic"); ?> >Trontastic</option>
                        <option value="swanky-purse" <?php selected($gg_event_options['event_ui_theme'], "swanky-purse"); ?> >Swanky Purse</option>
                    </select>
                    <img id="gg_ui_theme_thumb" src="<?php echo plugins_url() . '/event-geek/images/' . $gg_event_options['event_ui_theme'] . '.jpg'; ?>" alt="theme preview" />
                    </p>
                        
                    <p><strong><?php _e('Use your own theme (enter URL)', 'event_geek'); ?>:</strong> <input type="text" name="event_custom_ui_theme" value="<?php echo $gg_event_options['event_custom_ui_theme']; ?>" /><br />
                    <a href="http://jqueryui.com/themeroller/" target="_blank"><?php _e('Read more about jQuery UI themes', 'event_geek'); ?></a></p>
    
                    <?php if($gg_event_options['event_highlight_color']){$background = $gg_event_options['event_highlight_color'];} 
                    else{$background = '#ffffff';}
                    
                    if($gg_event_options['event_highlight_text_color']){$textcolor = $gg_event_options['event_highlight_text_color'];}else{$textcolor = '#000000';}
                    ?>
                    <p><strong><?php _e('Event Date Background color', 'event_geek'); ?>:</strong> <input type="text" class="color_picker" id="event_highlight_color" name="event_highlight_color" value="<?php echo $background; ?>" /></p> 
                
                    
                    <p><strong><?php _e('Event Date Text Color', 'event_geek'); ?>:</strong> <input type="text" id="event_highlight_text_color" class="color_picker" name="event_highlight_text_color" value="<?php echo $textcolor; ?>" /></p> 

    
                    <hr />
					<h4><?php _e('Pop Up Styles', 'event_geek'); ?>:</h4>
<div class="gg_options_section">
                    <p><strong><?php _e('Background color', 'event_geek'); ?>:</strong> <input type="text" class="color_picker" id="event_popup_bg_color" name="event_popup_bg_color" value="<?php echo $gg_event_options['event_popup_bg_color']; ?>" /></p>
					
                    <p><strong><?php _e('Border color', 'event_geek'); ?>:</strong> <input type="text" class="color_picker" id="event_popup_border_color" name="event_popup_border_color" value="<?php echo $gg_event_options['event_popup_border_color']; ?>" /></p>                                       
                    <p><strong><?php _e('Border width', 'event_geek'); ?>: </strong><input id="event_popup_border_width" type="text" name="event_popup_border_width" value="<?php echo $gg_event_options['event_popup_border_width']; ?>" /></p>

                        <span class="ui-slider-label">(<?php _e('none', 'event_geek'); ?>)</span><div id="popup_border_width" class="ui_slider" data-step="1" data-minval="0" data-maxval="10"></div><span class="ui-slider-label">(<?php _e('10 pixels', 'event_geek'); ?>)</span>      

					<p><strong><?php _e('Text color', 'event_geek'); ?>:</strong> <input type="text" class="color_picker" id="event_popup_text_color" name="event_popup_text_color" value="<?php echo $gg_event_options['event_popup_text_color']; ?>" /></p>										
                    <p><strong><?php _e('Link color', 'event_geek'); ?>:</strong> <input type="text" class="color_picker" id="event_popup_link_color" name="event_popup_link_color" value="<?php echo $gg_event_options['event_popup_link_color']; ?>" /></p>
</div>

<div class="gg_options_section">
					<p><strong><?php _e('Use Lightbox Background', 'event_geek'); ?>? </strong>
                    <select class="gg_optional_select" id="event_lightbox" name="event_lightbox">
                        <option value=""><?php _e('No', 'event_geek'); ?></option>
                        <option value="yes" <?php selected($gg_event_options['event_lightbox'], "yes"); ?>><?php _e('Yes', 'event_geek'); ?></option>
                    </select>
                    </p>
                    <?php if($gg_event_options['event_lightbox']){ $class = '';}
							else{$class = ' class="gg_hide"'; }?>
                    <div id="optional_event_lightbox" <?php echo $class; ?>>
	                    <p><strong><?php _e('Lightbox color', 'event_geek'); ?>:</strong> <input type="text" class="color_picker" id="event_lightbox_color" name="event_lightbox_color" value="<?php echo $gg_event_options['event_lightbox_color']; ?>" /></p>

                        <p><strong><?php _e('Transparency level', 'event_geek'); ?>: </strong><input id="event_lightbox_transparency" type="hidden" name="event_lightbox_transparency" value="<?php echo $gg_event_options['event_lightbox_transparency']; ?>" /></p>
                        
                        <span class="ui-slider-label">(<?php _e('Transparent', 'event_geek'); ?>)</span><div id="lightbox_transparency" class="ui_slider" data-step="0.1" data-minval="0" data-maxval="1"></div><span class="ui-slider-label">(<?php _e('Opaque', 'event_geek'); ?>)</span>                    
                    
                    </div><!--#optional_event_lightbox-->
</div>


<div class="gg_options_section">
					<p><strong><?php _e('Info Background color', 'event_geek'); ?>:</strong> <input type="text" class="color_picker" id="event_popup_info_bg_color" name="event_popup_info_bg_color" value="<?php echo $gg_event_options['event_popup_info_bg_color']; ?>" /></p> 
                    <p><strong><?php _e('Info Border color', 'event_geek'); ?>:</strong> <input type="text" class="color_picker" id="event_popup_info_border_color" name="event_popup_info_border_color" value="<?php echo $gg_event_options['event_popup_info_border_color']; ?>" /></p>                                       
                    <p><strong><?php _e('Info Border width', 'event_geek'); ?>: </strong><input id="event_popup_info_border_width" type="text" name="event_popup_info_border_width" value="<?php echo $gg_event_options['event_popup_info_border_width']; ?>" /></p>

                        <span class="ui-slider-label">(<?php _e('none', 'event_geek'); ?>)</span><div id="popup_info_border_width" class="ui_slider" data-step="1" data-minval="0" data-maxval="10"></div><span class="ui-slider-label">(<?php _e('10 pixels', 'event_geek'); ?>)</span>      

                    <p><strong><?php _e('Info box width', 'event_geek'); ?>: </strong><input id="event_popup_info_box_width" type="text" name="event_popup_info_box_width" value="<?php echo $gg_event_options['event_popup_info_box_width']; ?>" /></p>

                        <span class="ui-slider-label">(25%)</span><div id="popup_info_box_width" class="ui_slider" data-step="1" data-minval="25" data-maxval="100"></div><span class="ui-slider-label">(100%)</span>   

					<p><strong><?php _e('Text color', 'event_geek'); ?>:</strong> <input type="text" class="color_picker" id="event_popup_info_text_color" name="event_popup_info_text_color" value="<?php echo $gg_event_options['event_popup_info_text_color']; ?>" /></p>										
                    <p><strong><?php _e('Link color', 'event_geek'); ?>:</strong> <input type="text" class="color_picker" id="event_popup_info_link_color" name="event_popup_info_link_color" value="<?php echo $gg_event_options['event_popup_info_link_color']; ?>" /></p>
                                                                                                      
</div>
                    
	            </div><!--end style options-->

				<div class="gg_options_section">
					<h3><?php _e('Other Options', 'event_geek'); ?>:</h3>
				
					<p><strong><?php _e('Customize Event Info', 'event_geek'); ?>? </strong>
                    <select id="customize_event_info" name="customize_event_info" class="gg_optional_select" >
                        <option value=""><?php _e('No', 'event_geek'); ?></option>
                        <option value="yes" <?php selected($gg_event_options['customize_event_info'], "yes"); ?>><?php _e('Yes', 'event_geek'); ?></option>
                    </select>
                    </p>
					<?php if($gg_event_options['customize_event_info']){ $class = '';}
							else{$class = ' class="gg_hide"'; }?>
					<div id="optional_customize_event_info"<?php echo $class; ?>>
					<p><?php _e('Click and Drag to Sort', 'event_geek'); ?></p>
					<ul id="gg_event_info_boxes">
					<?php
						if(!$gg_event_options['customize_event_info'] && !$gg_event_options['custom_event_inputs']){
						$event_inputs = array(
							array('label' => __('Address', 'event_geek'), 'type' => 'text'),
							array('label' => __('Address Line 2', 'event_geek'),'type' => 'text'),
							array('label' => __('Phone', 'event_geek'),'type' => 'text'),
							array('label' => __('Web Address', 'event_geek'), 'type' => 'link')
						);
						}
						else{
						$event_inputs = array();
						$saved_inputs = $gg_event_options['custom_event_inputs'];
						$saved_types =  $gg_event_options['custom_event_types'];
						$count = 0;
						if(is_array($saved_inputs)){
							foreach($saved_inputs as $input){
								$event_inputs[] = array('label' => $input, 'type'=> $saved_types[$count]);
								$count++;
							}//foreach
						}//if(is_array($saved_inputs){	
						}//end if(!$gg_event_options['customize_event_info']){
						
						foreach($event_inputs as $box){ ?>
							<li><?php _e('Label', 'event_geek'); ?>: <input name="custom_event_inputs[]" type="text" value="<?php echo $box['label']; ?>">
							<?php _e('Type', 'event_geek'); ?>: <select name='custom_event_types[]'>
								<option value="text"><?php _e('Text', 'event_geek'); ?></option>
								<option value="link" <?php selected($box['type'],'link'); ?>><?php _e('Link', 'event_geek'); ?></option>
								<option value="email" <?php selected($box['type'],'email'); ?>><?php _e('Email', 'event_geek'); ?></option>
							</select>
							<span class="gg_delete_event_li">X</span>
							</li>
					<?php	}// foreach
					?>
					</ul>
					<button type="button" id="gg_add_event_info" /><?php _e('Add', 'event_geek'); ?></button>
                    <p><?php _e('Note: Once you have saved event info using these labels, changing the labels will result in some info no longer appearing.', 'event_geek'); ?></p>
					</div><!--gg_event_info_boxes-->

					<p><strong><?php _e('Select Events Page:', 'event_geek'); ?>? </strong>
                    <select id="event_page_id" name="event_page_id">
                        <option value=""><?php _e('None', 'event_geek'); ?></option>
                        <?php gg_content_selector($gg_event_options['event_page_id']); ?>
                    </select>
                    </p>					
					
                    <p><strong><?php _e('Include link to help promote Event Geek', 'event_geek'); ?>? </strong>
                    <select  name="event_promote">
                        <option value="yes" <?php selected($gg_event_options['event_promote'], "yes"); ?> ><?php _e('Yes (thank you!)', 'event_geek'); ?></option>
                        <option value="no" <?php selected($gg_event_options['event_promote'], "no"); ?> ><?php _e('No', 'event_geek'); ?></option>
                    </select>
                    </p>
                </div><!--gg_options_section-->
            <?php do_action('gg_options_form'); ?>
         
            <p><input type="submit" name="submit" value="Save Settings"></p>

        </form>
	<p><?php _e('Thank you for using Event Geek. For support see the', 'event_geek'); ?> <a href="http://wordpress.org/support/plugin/event-geek" target="_blank"><?php _e('WordPress support forum', 'event_geek'); ?></a>, <a href="http://graphicgeek.net/contact/" target="_blank"><?php _e('contact Graphic Geek', 'event_geek'); ?></a>, <?php _e('or', 'event_geek'); ?> <a href="http://graphicgeek.net/event-geek/" target="_blank"><?php _e('leave a comment here', 'event_geek'); ?></a>.</p>
    <p><?php _e('To help support the continued improvement of this plugin, please consider making a', 'event_geek'); ?> <a href="http://graphicgeek.net/donations/" target="_blank"><?php _e('small donation', 'event_geek'); ?></a>. <?php _e('Also be sure to give it a', 'event_geek'); ?> <a href="http://wordpress.org/support/view/plugin-reviews/event-geek" target="_blank"><?php _e('good rating and/or review', 'event_geek'); ?></a> :)</p>
<hr/>
	<p id="event_geek_admin_social">Follow Graphic Geek:<br/>
	<a href="https://www.facebook.com/GraphicArtGeek" target="_blank"><img src="<?php echo plugins_url(); ?>/event-geek/images/facebook.png" alt="Like Graphic Geek on Facebook"/></a>	
	<a href="https://twitter.com/graphicartgeek" target="_blank"><img src="<?php echo plugins_url(); ?>/event-geek/images/twitter.png" alt="Graphic Geek on Twitter"/></a>	
	<a href="http://www.linkedin.com/pub/edward-ellsworth/28/460/90b" target="_blank"><img src="<?php echo plugins_url(); ?>/event-geek/images/linkdin.png" alt="Graphic Geek on LinkedIn"/></a>		
	</p>
    </div>

<?php 

}//end gg_event_options 

?>