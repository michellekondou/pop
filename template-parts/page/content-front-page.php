<?php
/**
 * Displays content for front page
 *
 * @package WordPress
 * @subpackage pop
 * @since 1.0
 * @version 1.0
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'pop-panel ' ); ?> >

	<?php if ( has_post_thumbnail() ) :
		//$thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'pop-featured-image' );

		// Calculate aspect ratio: h / w * 100%.
		//$ratio = $thumbnail[2] / $thumbnail[1] * 100;
		?>

		<!-- <div class="panel-image" style="background-image: url(<?php echo esc_url( $thumbnail[0] ); ?>);">
			<div class="panel-image-prop" style="padding-top: <?php echo esc_attr( $ratio ); ?>%"></div>
		</div> -->
		<!-- .panel-image -->

	<?php endif; ?>

	<div class="panel-content">
		<div class="wrap">
			<header class="entry-header">
				<?php //the_title( '<h2 class="entry-title">', '</h2>' ); ?>

				<?php //pop_edit_link( get_the_ID() ); ?>

			</header><!-- .entry-header -->
			<div class="entry-content" style="position: absolute; width: 100%;    height: 100%;    top: 0;">
				<div class="main-carousel" data-flickity='{ "cellAlign": "left", "pageDots": false}'>
					
					<div class="carousel-cell" 
						 style="background: url(/wp-content/uploads/HOME-RESIDENCE-AND-OFFICES-KALAMATA.jpg) no-repeat center center;background-size: cover; width: 100vw; height: 100vh;"></div>
					<div class="carousel-cell" 
						 style="background: #000 url(/wp-content/uploads/HOME-RESIDENCE-PORTO-HELI-ARGOLIS.jpg) no-repeat center center;background-size: cover; width: 100vw; height: 100vh;"></div>
					<div class="carousel-cell" 
						 style="background: #eee url(/wp-content/uploads/HOME-RESIDENCE-AG-LAZAROS-MYKONOS.jpg) no-repeat center center;background-size: cover; width: 100vw; height: 100vh;"></div>
				
				</div>
				<?php
					/* translators: %s: Name of current post */
					the_content( sprintf(
						__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'pop' ),
						get_the_title()
					) );
				?>
			</div><!-- .entry-content -->
			
			<script src="/admin/wp-content/themes/pop/assets/js/flickity.pkgd.min.js"></script>
		</div><!-- .wrap -->
	</div><!-- .panel-content -->

</article><!-- #post-## -->
