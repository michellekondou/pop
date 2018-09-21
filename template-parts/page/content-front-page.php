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
	<div class="panel-content">
		<div class="wrap">
			<div class="entry-content" style="position: absolute; width: 100%; height: 100%; top: 0;">
				<div class="loader-2 center"><span></span></div>
				<div class="main-carousel" data-flickity='{ "cellAlign": "center", "pageDots": false, "lazyLoad": true, "imagesLoaded": true, "autoPlay": 7000, "pauseAutoPlayOnHover": false }'>
					<?php

						// check if the repeater field has rows of data
						if( have_rows('home_slides') ):

							// loop through the rows of data
							while ( have_rows('home_slides') ) : the_row();

								// display a sub field value
								$image = get_sub_field('image');
								$link = get_sub_field('link');
							 ?>
						<div class="carousel-cell" 
						 style="background: url(<?php echo $image['url']; ?>) no-repeat center center;background-size: cover; width: 100vw; height: 100vh;">
							<a href="<?php echo $link; ?>"></a>
						</div>
						<?php endwhile; ?>
						<?php endif; ?>
				</div>
				<?php
					/* translators: %s: Name of current post */
					the_content( sprintf(
						__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'pop' ),
						get_the_title()
					) );
				?>
			</div><!-- .entry-content -->
		</div><!-- .wrap -->
	</div><!-- .panel-content -->

</article><!-- #post-## -->
