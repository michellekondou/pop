<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage pop
 * @since 1.0
 * @version 1.0
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js no-svg">
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<link rel="profile" href="http://gmpg.org/xfn/11">
<?php wp_head(); ?>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<link rel="manifest" href="/static/manifest.json">
<meta name="mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="application-name" content="Sample App">
<meta name="apple-mobile-web-app-title" content="Sample App">
<meta name="theme-color" content="#fff">
<meta name="msapplication-navbutton-color" content="#fff">
<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
<meta name="msapplication-starturl" content="/">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="Description" content="A sample test app with users, posts and comments">
<title>Pop Architects</title>
</head>

<body <?php body_class(); ?>>
<?php
	get_template_part( 'template-parts/navigation/navigation-top', 'front-page' );
?>
 <div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php _e( 'Skip to content', 'pop' ); ?></a>

	<header id="masthead" class="site-header" role="banner">
		<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="logo">
		  	<img src="/admin/wp-content/themes/pop/assets/images/logo.png">
   	 	</a>
		<?php //get_template_part( 'template-parts/header/header', 'image' ); ?>

		<?php if ( has_nav_menu( 'top' ) ) : ?>
			<!-- <div class="navigation-top">
				<div class="wrap">
				 
				</div> -->
				<!-- .wrap -->
			<!-- </div> -->
			<!-- .navigation-top -->
		<?php endif; ?>

	</header>
	<!-- #masthead -->

	<?php

	/*
	 * If a regular post or page, and not the front page, show the featured image.
	 * Using get_queried_object_id() here since the $post global may not be set before a call to the_post().
	 */
	if ( ( is_single() || ( is_page() && ! pop_is_frontpage() ) ) && has_post_thumbnail( get_queried_object_id() ) ) :
		//echo '<div class="single-featured-image-header">';
		//echo get_the_post_thumbnail( get_queried_object_id(), 'pop-featured-image' );
		//echo '</div><!-- .single-featured-image-header -->';
	endif;
	?>

	<div class="site-content-contain">
		<div id="content" class="site-content">
