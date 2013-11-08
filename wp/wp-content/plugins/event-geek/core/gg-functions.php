<?php
//set up post type custom meta functions
function gg_get_saved_meta($names, $id){
	$return = array();
	
	if(!is_array($names)){$names = explode(",", $names);}
		
		foreach($names as $name){
			$return[$name] = get_post_meta($id, $name, true);
		}
		
	$return['gg_names'] = get_post_meta($id, 'gg_names', true);		
	
	return $return;
} //gg_get_saved_meta

function gg_get_posted_meta(){
	$return = array();
	$names = $_POST['gg_names'];
	if(!is_array($names)){$names = explode(",", $names);}
		foreach($names as $name){
			$return[$name] = $_POST[$name];
		}
		
	$return['gg_names'] = $names;
	return $return;
} //gg_get_posted_meta

//localization functions
function gg_strip_array_indices( $ArrayToStrip ) {

    foreach( $ArrayToStrip as $objArrayItem) {
        $NewArray[] =  $objArrayItem;
    }
 
    return( $NewArray );
} //gg_strip_array_indices

function gg_date_format_php_to_js( $php_format ) {
    $PHP_matching_JS = array(
            // Day
            'd' => 'dd',
            'D' => 'D',
            'j' => 'd',
            'l' => 'DD',
            'N' => '',
            'S' => '',
            'w' => '',
            'z' => 'o',
            // Week
            'W' => '',
            // Month
            'F' => 'MM',
            'm' => 'mm',
            'M' => 'M',
            'n' => 'm',
            't' => '',
            // Year
            'L' => '',
            'o' => '',
            'Y' => 'yy',
            'y' => 'y',
            // Time
            'a' => '',
            'A' => '',
            'B' => '',
            'g' => '',
            'G' => '',
            'h' => '',
            'H' => '',
            'i' => '',
            's' => '',
            'u' => ''
    );

    $js_format = "";
    $escaping = false;

    for($i = 0; $i < strlen($php_format); $i++)
    {
        $char = $php_format[$i];
        if($char === '\\') // PHP date format escaping character
        {
            $i++;
            if($escaping) $js_format .= $php_format[$i];
            else $js_format .= '\'' . $php_format[$i];
            $escaping = true;
        }
        else
        {
            if($escaping) { $js_format .= "'"; $escaping = false; }
            if(isset($PHP_matching_JS[$char]))
                $js_format .= $PHP_matching_JS[$char];
            else
            {
                $js_format .= $char;
            }
        }
    }

    return $js_format;
} //date_format_php_to_js

function gg_event_widget_dates($cat='all'){
	global $post;
	$event_dates = array();

	$args = array(
		'post_type' => 'gg_events',
		'posts_per_page' => -1
	); 

	if($cat != 'all'){
		$args['event_category'] = $cat;
	}

	$query = new WP_Query(apply_filters('gg_event_widget_date_args', $args));	
		
	while ( $query->have_posts() ) { $query->the_post();
		$gg_names = get_post_meta($post->ID, 'gg_names', true); //get list of meta names
		$meta = gg_get_saved_meta($gg_names,$post->ID);// load meta data		
		$dates = explode('|', $meta['gg_event_dates']);
		foreach($dates as $date){
			if(!in_array($date, $event_dates)){$event_dates[] = $date;}		
		}
	}wp_reset_postdata();	
	
	echo json_encode($event_dates);
	
} //gg_event_widget_dates

function gg_event_footer(){
	 ?>
	<div id="gg_event_window"><?php do_action('gg_event_footer'); ?><img class="ajax_loader" src="<?php echo apply_filters('gg_event_ajax_loader', plugins_url() . '/event-geek/images/ajax-loader.gif'); ?>" alt="loading" /></div>
<?php 
	$gg_event_options = get_option( 'gg_event_options');
	if($gg_event_options['event_lightbox_color']){ ?><div id="gg_event_lightbox"></div> <?php }
}//gg_event_footer

add_action( 'wp_footer', 'gg_event_footer' );

if(!function_exists('gg_content_selector')){
	function gg_content_selector($id){
		global $post;

		$post_per_page = -1; 
		$postArgs = array('public' => true);
		$postTypes = get_post_types($postArgs);
		
		//$postTypes = array('page', 'post');
	  	$args = array(
	  	'post_type' => $postTypes,
		'posts_per_page' => $post_per_page
	  ); 

		$query = new WP_Query($args);

		while ( $query->have_posts() ) {
				$query->the_post(); 
				$obj = get_post_type_object(get_post_type());
				$theType = $obj->rewrite['slug'];
				if ($theType == ""){$theType = get_post_type();}
				?>
					<option value="<?php the_ID(); ?>" <?php selected($id, get_the_ID());?>><?php the_title(); ?> (<?php echo $theType; ?>)</option>
		<?php } wp_reset_postdata();		
	}//gg_content_selector
}//if(!function_exists('gg_content_selector')){
	
if(!function_exists('gg_category_selector')){
	function gg_category_selector($cat){
		?>
        <option value="all">Show All</option>
        <?php
		$args = array(
		'taxonomy' => 'event_category'
		);

		$categories = get_categories( $args );
		
		foreach($categories as $category){ ?>
			<option value="<?php echo $category->slug; ?>"<?php selected($category->slug, $cat); ?>><?php echo $category->name; ?></option>
		<?php		}//foreach
	
	}//gg_category_selector
}//if(!function_exists('gg_category_selector')){


//-----------------depriciated functions----------------------------------------

function gg_event_dates(){ //function depriciated, replaced by gg_event_widget_dates()
	global $post;
	$event_dates = array();

	$args = array(
		'post_type' => 'gg_events',
		'posts_per_page' => -1
	); 

	$query = new WP_Query($args);	
		
	while ( $query->have_posts() ) { $query->the_post();
		$gg_names = get_post_meta($post->ID, 'gg_names', true); //get list of meta names
		$meta = gg_get_saved_meta($gg_names,$post->ID);// load meta data		
		$dates = explode('|', $meta['gg_event_dates']);
		foreach($dates as $date){
		if(!in_array($date, $event_dates)){$event_dates[] = $date;}
		
		}

	}wp_reset_postdata();	
	
	
	return $event_dates;
	
} //gg_event_dates
?>