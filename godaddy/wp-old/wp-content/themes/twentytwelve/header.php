<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */
?><!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width" />
<title><?php wp_title( '|', true, 'right' ); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<?php // Loads HTML5 JavaScript file to add support for HTML5 elements in older IE versions. ?>
<!--[if lt IE 9]>
<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js" type="text/javascript"></script>
<![endif]-->
<?php wp_head(); ?>
<META HTTP-EQUIV="CACHE-CONTROL" CONTENT="NO-CACHE">
<meta name="viewport" content="width=device-width">
<meta name="viewport" content="initial-scale=1.0">
<link rel="stylesheet" href="wp/wp-content/themes/twentytwelve/style.css">
<link rel="stylesheet" href="widgets/flexslider/flexslider.css">
<link rel="stylesheet" href="widgets/lightbox/css/lightbox.css">
<link rel="stylesheet" href="main0.css">
<!-- <script src= "https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"> </script> -->
<!-- <script type="text/javascript" src="js/jquery-1.9.1-min.js"></script> -->
<script src="widgets/lightbox/js/jquery-1.7.2.min.js"> </script>
<script src="widgets/lightbox/js/lightbox.js"> </script>
  <script type="text/javascript" src="widgets/flexslider/jquery.flexslider.js"> </script>
  <script type="text/javascript" charset="utf-8">
      $(window).load(function() {

                $('.flexslider').flexslider({
                        animation: "slide",
                        animationLoop: "true",
                });
        });
    <!-- Make lightbox close when clicked -->
  </script>
</head>

<body <?php body_class(); ?>>
<div id="page" class="hfeed site">
	<header id="masthead" class="site-header" role="banner">

		<?php $header_image = get_header_image();
		if ( ! empty( $header_image ) ) : ?>
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><img src="<?php echo esc_url( $header_image ); ?>" class="header-image" width="<?php echo get_custom_header()->width; ?>" height="<?php echo get_custom_header()->height; ?>" alt="" /></a>
		<?php endif; ?>
	</header><!-- #masthead -->

	<div id="main" class="wrapper">
