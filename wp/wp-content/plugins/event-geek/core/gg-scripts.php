<?php
//load styles and scripts for admin
function gg_event_admin_scripts(){
	
	$thePage = $_GET['page'];
	if($thePage == 'gg_event_menu'){//register scripts for options page
		wp_enqueue_style( 'wp-color-picker' );          
		wp_enqueue_script( 'wp-color-picker' );
		wp_enqueue_script('jquery-ui-sortable');
		wp_enqueue_script('jquery-ui-slider');	
		$uiTheme = 'http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/themes/smoothness/jquery-ui.css';	
		wp_enqueue_style('jquery-style', $uiTheme);		
	}

	wp_register_style( 'gg_admin_styles', plugins_url() . '/event-geek/css/admin-styles.css');
	wp_enqueue_style('gg_admin_styles');

	wp_register_script('gg_admin_script', plugins_url() . '/event-geek/js/gg-admin-script.js', array('jquery', 'wp-color-picker'));
	wp_enqueue_script('gg_admin_script');

   //localize the js
	global $post, $wp_locale;
	
    $languageoptions = array(
		'closeText'         => __( 'Close', 'event_geek'),
		'currentText'       => __( 'Today', 'event_geek'),
		// we must replace the text indices for the following arrays with 0-based arrays
		'monthNames'        => gg_strip_array_indices( $wp_locale->month ),
		'monthNamesShort'   => gg_strip_array_indices( $wp_locale->month_abbrev ),
		'dayNames'          => gg_strip_array_indices( $wp_locale->weekday ),
		'dayNamesShort'     => gg_strip_array_indices( $wp_locale->weekday_abbrev ),
		'dayNamesMin'       => gg_strip_array_indices( $wp_locale->weekday_initial ),
		// the date format must be converted from PHP date tokens to js date tokens
		'dateFormat'        => gg_date_format_php_to_js(get_option('date_format')),
		// First day of the week from WordPress general settings
		'firstDay'          => get_option( 'start_of_week' ),
		// is Right to left language? default is false
		'isRTL'             => $wp_locale->is_rtl,
    );
	
	 // Pass the array to the enqueued JS
    wp_localize_script( 'gg_admin_script', 'languageoptions', $languageoptions );

	$gg_event_site_vars = array(
		'home_url' => home_url(),
		'plugin_directory' => plugins_url(),
		'admin_url' => admin_url()
	);
	
	wp_localize_script( 'gg_admin_script', 'gg_event_site_vars', $gg_event_site_vars );	

}
add_action( 'admin_enqueue_scripts', 'gg_event_admin_scripts' );

//load styles and scripts for front end
function gg_event_scripts(){
	
	//load jquery styles
	$gg_event_options = get_option( 'gg_event_options');
	
	if($gg_event_options['event_ui_theme']){$uiTheme = 'http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/themes/' .  $gg_event_options['event_ui_theme'] . '/jquery-ui.css';} 
	else{$uiTheme = 'http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/themes/smoothness/jquery-ui.css';}//use default "smoothness" jquery ui theme
	
	if($gg_event_options['event_custom_ui_theme']){$uiTheme = $gg_event_options['event_custom_ui_theme'];} //use custom css file if one has been chosen
	
	wp_enqueue_style('jquery-style', $uiTheme);

	//load event styles
	wp_register_style( 'gg_styles', plugins_url() . '/event-geek/css/gg_event_styles.css');
	wp_enqueue_style('gg_styles');
	
	//load scripts
	$mousewheel = plugins_url() . '/event-geek/js/jquery.mousewheel.js';
    wp_register_script( 'gg_mousewheel', $mousewheel, array('jquery'));
    wp_enqueue_script( 'gg_mousewheel' );	

	wp_register_script('gg_script', plugins_url() . '/event-geek/js/gg_script.js', array('jquery-ui-datepicker', 'gg_mousewheel'));
	wp_enqueue_script('gg_script');	

    //localize our js
	global $post, $wp_locale;
    $languageoptions = array(
		'closeText'         => __( 'Close', 'event_geek'),
		'currentText'       => __( 'Today', 'event_geek'),
		// we must replace the text indices for the following arrays with 0-based arrays
		'monthNames'        => gg_strip_array_indices( $wp_locale->month ),
		'monthNamesShort'   => gg_strip_array_indices( $wp_locale->month_abbrev ),
		'dayNames'          => gg_strip_array_indices( $wp_locale->weekday ),
		'dayNamesShort'     => gg_strip_array_indices( $wp_locale->weekday_abbrev ),
		'dayNamesMin'       => gg_strip_array_indices( $wp_locale->weekday_initial ),
		// the date format must be converted from PHP date tokens to js date tokens
		'dateFormat'        => gg_date_format_php_to_js(get_option('date_format')),
		// First day of the week from WordPress general settings
		'firstDay'          => get_option( 'start_of_week' ),
		// is Right to left language? default is false
		'isRTL'             => $wp_locale->is_rtl,
    );
	
	 // Pass the array to the enqueued JS
    wp_localize_script( 'gg_script', 'languageoptions', apply_filters('gg_event_language_options', $languageoptions) );
	
	$gg_event_site_vars = array(
		'home_url' => home_url(),
		'plugin_directory' => plugins_url(),
		'admin_url' => admin_url(),
		'plugin_version' => $gg_event_options['gg_event_version'],
		'lightbox_tansparency' => $gg_event_options['event_lightbox_transparency']		
	);
	
	wp_localize_script( 'gg_script', 'gg_event_site_vars', $gg_event_site_vars );
	
}//gg_event_scripts

add_action( 'wp_enqueue_scripts', 'gg_event_scripts' );
?>