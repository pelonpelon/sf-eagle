<?php

//add custom color and other custom styles
function gg_frontend_styles(){
	$gg_event_options = get_option( 'gg_event_options');
	
	if($gg_event_options['event_popup_bg_color']){$background = $gg_event_options['event_popup_bg_color'];}
	else {$background = '#eee';}
	
	 ?>
	<style type="text/css">
    
	.gg_widget_calendar .gg_has_event a,
	#gg_fullsize_calendar .gg_has_event a{
		background:<?php echo $gg_event_options ['event_highlight_color']; ?>;
		color:<?php echo $gg_event_options ['event_highlight_text_color']; ?>;
	}
	
	#gg_event_window{
		background:<?php echo $background; ?>;
		border:<?php echo $gg_event_options ['event_popup_border_width']; ?>px solid <?php echo $gg_event_options ['event_popup_border_color']; ?>;
		<?php if($gg_event_options['event_popup_text_color']){ ?>
		color:<?php echo $gg_event_options ['event_popup_text_color']; ?>;
		<?php }	?>
	}

		<?php if($gg_event_options['event_popup_link_color']){ ?>
	#gg_event_window a,
	#gg_event_window p a{		
		color:<?php echo $gg_event_options ['event_popup_link_color']; ?>;
	}
		<?php }	?>

	.gg_event_info{
		border:<?php echo $gg_event_options ['event_popup_info_border_width']; ?>px solid <?php echo $gg_event_options ['event_popup_info_border_color']; ?>;		
	<?php if($gg_event_options['event_popup_info_bg_color']){ ?>		
		background:<?php echo $gg_event_options ['event_popup_info_bg_color']; ?>;
	<?php } ?>	
	
	<?php if($gg_event_options['event_popup_info_box_width']){ ?>		
		width:<?php echo $gg_event_options ['event_popup_info_box_width']; ?>%;
	<?php } ?>		

	<?php if($gg_event_options['event_popup_info_text_color']){ ?>
		color:<?php echo $gg_event_options ['event_popup_info_text_color']; ?>;
	<?php }	?>	
	}
	
		<?php if($gg_event_options['event_popup_info_link_color']){ ?>
	#gg_event_window .gg_event_info a{		
		color:<?php echo $gg_event_options ['event_popup_info_link_color']; ?>;
	}
		<?php }	?>
	
	<?php if($gg_event_options['event_lightbox_color']){ ?>
	
	#gg_event_lightbox{
		background:<?php echo $gg_event_options ['event_lightbox_color']; ?>;
	}
	
	<?php }
	
	gg_event_category_styles();
	
	?>
    </style>
<?php
} //gg_frontend_styles

add_action( 'wp_head', 'gg_frontend_styles' );

function gg_event_category_styles(){
	$gg_category_meta = get_option( 'gg_category_meta' );

	$args = array(
		'taxonomy' => 'event_category'
	);

	$categories = get_categories( $args );
		
	foreach($categories as $category){

		if($gg_category_meta[ $category->term_id .'_event_highlight_color'] || $gg_category_meta[ $category->term_id .'_event_highlight_text_color']){ ?>
            .gg_widget_calendar.category_<?php echo $category->slug; ?> .gg_has_event a,
            #gg_fullsize_calendar.category_<?php echo $category->slug; ?> .gg_has_event a{
			<?php
            if($gg_category_meta[ $category->term_id .'_event_highlight_color']){ ?>
			background:<?php echo $gg_category_meta[ $category->term_id .'_event_highlight_color']; ?>;
			<?php }
            if($gg_category_meta[ $category->term_id .'_event_highlight_text_color']){ ?>
			 color:<?php echo $gg_category_meta[ $category->term_id .'_event_highlight_text_color']; ?>;
			<?php }	?>
            }		
          <?php }
	}//foreach
		
}//gg_event_category_styles
?>