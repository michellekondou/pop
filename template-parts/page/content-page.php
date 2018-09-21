<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage pop
 * @since 1.0
 * @version 1.0
 */

?>

<div class="container layout-extended scrollElement">
	<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
	<?php if( have_rows('layout') ): ?>
	<?php
	// loop through the rows of data
	while ( have_rows('layout') ) : the_row(); ?>
		<?php
		if( get_row_layout() == 'image_full_width' ): ?>
		<div class="section full-width">
			<?php 
				$image = get_sub_field('image');
				if( !empty($image) ): 
				?>
				<div class="magnifiable">
					<a data-size="<?php echo $image['width'].'x'.$image['height'] ?>" href="<?php echo $image['url']; ?>" title="<?php if ($image['caption']) { echo $image['caption']; } else { echo the_title(); } ?>">
						<figure>
							<img 
								width="<?php echo $image['sizes']['large-width']; ?>"
								height="<?php echo $image['sizes']['large-height']; ?>"
								data-mobile-width="<?php echo $image['sizes']['pop-featured-image-front-width']; ?>"
								data-mobile-height="<?php echo $image['sizes']['pop-featured-image-front-height']; ?>"
								data-srcset="<?php echo $image['sizes']['pop-featured-image-front']; ?> 255w, <?php echo $image['sizes']['large']; ?> 1160w"
								data-ie="<?php echo $image['sizes']['large']; ?>"
								sizes="(max-width: 356px) 255px, 1160px"
								src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7"
								class="lazyload"
								alt="<?php if ($image['alt']) { echo $image['alt']; } else { echo the_title(); } ?>">
							<figcaption><?php echo $image['caption']; ?></figcaption>
						</figure>
					</a>
				</div>
				<noscript>
					<img 
						src="<?php echo $image['sizes']['large']; ?>"
						class="attachment-post-thumbnail size-post-thumbnail wp-post-image lazyload"
						alt="<?php if ($image['alt']) { echo $image['alt']; } else { echo the_title(); } ?>">
				</noscript>
			<?php endif; ?>
		</div>
		<?php
		elseif( get_row_layout() == 'image_2col_width' ): ?>
		<div class="section two-column-width">
			<?php 
				$image = get_sub_field('image');
				if( !empty($image) ): ?>
				<div class="magnifiable">
					<a data-size="<?php echo $image['sizes']['large-width'].'x'.$image['sizes']['large-height'] ?>" href="<?php echo $image['sizes']['large']; ?>" title="<?php if ($image['caption']) { echo $image['caption']; } else { echo the_title(); } ?>">
						<figure>
							<img 
								width="<?php echo $image['sizes']['medium-width']; ?>"
								height="<?php echo $image['sizes']['medium-height']; ?>"
								data-mobile-width="<?php echo $image['sizes']['pop-featured-image-front-width']; ?>"
								data-mobile-height="<?php echo $image['sizes']['pop-featured-image-front-height']; ?>"
								data-srcset="<?php echo $image['sizes']['pop-featured-image-front']; ?> 255w, <?php echo $image['sizes']['medium']; ?> 530w"
								data-ie="<?php echo $image['sizes']['medium']; ?>"
								sizes="(max-width: 356px) 255px, 530px"
								src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7"
								class="lazyload"
								alt="<?php if ($image['alt']) { echo $image['alt']; } else { echo the_title(); } ?>">
							<figcaption><?php echo $image['caption']; ?></figcaption>
						</figure>
					</a>
				</div>
				<noscript>
					<img 
						src="<?php echo $image['sizes']['medium']; ?>"
						class="attachment-post-thumbnail size-post-thumbnail wp-post-image lazyload"
						alt="<?php if ($image['alt']) { echo $image['alt']; } else { echo the_title(); } ?>">
				</noscript>
			<?php endif; ?>
		</div>
		<?php
		elseif( get_row_layout() == 'two_columns' ): ?>
		<div class="section two-columns">
		<?php 
		$test = get_sub_field('column_1'); ?>
		<?php // flexible content
		if( have_rows('column_1') ): ?>
			<div class="column">
			<?php while ( have_rows('column_1') ) : the_row(); ?>
			<?php
			if( get_row_layout() == 'image' ): ?>
				<?php if( get_sub_field('image') ): ?>
				<?php 
				$image = get_sub_field('image'); ?>
				<div class="magnifiable">
					<a data-size="<?php echo $image['sizes']['large-width'].'x'.$image['sizes']['large-height'] ?>" href="<?php echo $image['sizes']['large']; ?>" title="<?php if ($image['caption']) { echo $image['caption']; } else { echo the_title(); } ?>">
						<figure>
							<img 
								width="<?php echo $image['sizes']['medium-width']; ?>"
								height="<?php echo $image['sizes']['medium-height']; ?>"
								data-mobile-width="<?php echo $image['sizes']['pop-featured-image-front-width']; ?>"
								data-mobile-height="<?php echo $image['sizes']['pop-featured-image-front-height']; ?>"
								data-srcset="<?php echo $image['sizes']['pop-featured-image-front']; ?> 255w, <?php echo $image['sizes']['medium']; ?> 530w"
								data-ie="<?php echo $image['sizes']['medium']; ?>"
								sizes="(max-width: 356px) 255px, 530px"
								src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7"
								class="lazyload"
								alt="<?php if ($image['alt']) { echo $image['alt']; } else { echo the_title(); } ?>">
							<figcaption><?php echo $image['caption']; ?></figcaption>
						</figure>
					</a>
				</div>
				<noscript>
					<img 
						src="<?php echo $image['sizes']['medium']; ?>"
						class="attachment-post-thumbnail size-post-thumbnail wp-post-image lazyload"
						alt="<?php if ($image['alt']) { echo $image['alt']; } else { echo the_title(); } ?>">
				</noscript>
				<?php endif; ?>
			<?php
			elseif( get_row_layout() == 'text' ): ?>
				<?php if( get_sub_field('text') ): ?>
				<article class="text">
					<?php the_sub_field('text'); ?>
				</article>
				<?php endif; ?>
			<?php
			elseif( get_row_layout() == 'gallery' ): ?>
				<?php if( get_sub_field('images') ): ?>
				<div class="gallery">
					<?php 
					$images = get_sub_field('images');
					$size = 'full'; // (thumbnail, medium, large, full or custom size)
					if( $images ): ?>
					<?php foreach( $images as $image ): ?>
					<a data-size="<?php echo $image['sizes']['large-width'].'x'.$image['sizes']['large-height'] ?>" href="<?php echo $image['sizes']['large']; ?>" title="<?php if ($image['caption']) { echo $image['caption']; } else { echo the_title(); } ?>">
						<figure>
							<img 
								width="<?php echo $image['sizes']['medium-width']; ?>"
								height="<?php echo $image['sizes']['medium-height']; ?>"
								data-mobile-width="<?php echo $image['sizes']['pop-featured-image-front-width']; ?>"
								data-mobile-height="<?php echo $image['sizes']['pop-featured-image-front-height']; ?>"
								data-srcset="<?php echo $image['sizes']['pop-featured-image-front']; ?> 255w, <?php echo $image['sizes']['medium']; ?> 530w"
								data-ie="<?php echo $image['sizes']['medium']; ?>"
								sizes="(max-width: 356px) 255px, 530px"
								src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7"
								class="lazyload"
								alt="<?php if ($image['alt']) { echo $image['alt']; } else { echo the_title(); } ?>">
							<!-- <img src="<?php echo $image['sizes']['medium']; ?>" alt="<?php echo $image['alt']; ?>" class="lazyload" /> -->
							<figcaption><?php echo $image['caption']; ?></figcaption>
						</figure>
					</a>
					<?php endforeach; ?>
					<?php endif; ?>
				</div>
				<?php endif; ?>
			<?php
			elseif( get_row_layout() == 'gallery_with_captions' ): ?>
				<?php if( get_sub_field('images') ): ?>
				<div class="gallery-with-captions magnifiable">
					<?php 
					$images = get_sub_field('images');
					$size = 'full'; // (thumbnail, medium, large, full or custom size)
					if( $images ): ?>
					<?php foreach( $images as $image ): ?>
					<a data-size="<?php echo $image['sizes']['large-width'].'x'.$image['sizes']['large-height'] ?>" href="<?php echo $image['sizes']['large']; ?>" title="<?php if ($image['caption']) { echo $image['caption']; } else { echo the_title(); } ?>">
						<figure>
							<img 
								width="<?php echo $image['sizes']['medium-width']; ?>"
								height="<?php echo $image['sizes']['medium-height']; ?>"
								data-mobile-width="<?php echo $image['sizes']['pop-featured-image-front-width']; ?>"
								data-mobile-height="<?php echo $image['sizes']['pop-featured-image-front-height']; ?>"
								data-srcset="<?php echo $image['sizes']['pop-featured-image-front']; ?> 255w, <?php echo $image['sizes']['medium']; ?> 530w"
								data-ie="<?php echo $image['sizes']['medium']; ?>"
								sizes="(max-width: 356px) 255px, 530px"
								src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7"
								class="lazyload"
								alt="<?php if ($image['alt']) { echo $image['alt']; } else { echo the_title(); } ?>">
							<!-- <img src="<?php echo $image['sizes']['medium']; ?>" alt="<?php echo $image['alt']; ?>" class="lazyload" /> -->
							<figcaption><?php echo $image['caption']; ?></figcaption>
						</figure>
					</a>
					<?php endforeach; ?>
					<?php endif; ?>
				</div>
				<?php endif; ?>
			<?php endif; ?>
			<?php endwhile; ?>
			</div>
		<?php endif; ?>
		<?php 
		$test = get_sub_field('column_2'); ?>
		<?php // flexible content
		if( have_rows('column_2') ): ?>
			<div class="column">
			<?php while ( have_rows('column_2') ) : the_row(); ?>
			
			<?php
			if( get_row_layout() == 'image' ): ?>
				<?php if( get_sub_field('image') ): ?>
				<?php 
				$image = get_sub_field('image'); ?>
				<div class="magnifiable">
					<a data-size="<?php echo $image['sizes']['large-width'].'x'.$image['sizes']['large-height'] ?>" href="<?php echo $image['sizes']['large']; ?>" title="<?php if ($image['caption']) { echo $image['caption']; } else { echo the_title(); } ?>">
						<figure>
							<img 
								width="<?php echo $image['sizes']['medium-width']; ?>"
								height="<?php echo $image['sizes']['medium-height']; ?>"
								data-mobile-width="<?php echo $image['sizes']['pop-featured-image-front-width']; ?>"
								data-mobile-height="<?php echo $image['sizes']['pop-featured-image-front-height']; ?>"
								data-srcset="<?php echo $image['sizes']['pop-featured-image-front']; ?> 255w, <?php echo $image['sizes']['medium']; ?> 530w"
								data-ie="<?php echo $image['sizes']['medium']; ?>"
								sizes="(max-width: 356px) 255px, 530px"
								src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7"
								class="lazyload"
								alt="<?php if ($image['alt']) { echo $image['alt']; } else { echo the_title(); } ?>">
							<!-- <img src="<?php echo $image['sizes']['medium']; ?>" alt="<?php echo $image['alt']; ?>" class="lazyload" /> -->
							<figcaption><?php echo $image['caption']; ?></figcaption>
						</figure>
					</a>
				</div>
				<noscript>
					<img 
						src="<?php echo $image['sizes']['medium']; ?>"
						class="attachment-post-thumbnail size-post-thumbnail wp-post-image lazyload"
						alt="<?php if ($image['alt']) { echo $image['alt']; } else { echo the_title(); } ?>">
				</noscript>
				<?php endif; ?>
			<?php
			elseif( get_row_layout() == 'text' ): ?>
				<?php if( get_sub_field('text') ): ?>
				<article class="text">
					<?php the_sub_field('text'); ?>
				</article>
				<?php endif; ?>
			<?php
			elseif( get_row_layout() == 'gallery' ): ?>
				<?php if( get_sub_field('images') ): ?>
				<div class="gallery magnifiable">
					<?php 
					$images = get_sub_field('images');
					$size = 'medium'; // (thumbnail, medium, large, full or custom size)
					if( $images ): ?>
					<?php foreach( $images as $image ): ?>
					<a data-size="<?php echo $image['sizes']['large-width'].'x'.$image['sizes']['large-height'] ?>" href="<?php echo $image['sizes']['large']; ?>" title="<?php if ($image['caption']) { echo $image['caption']; } else { echo the_title(); } ?>">
						<figure>
							<img 
								width="<?php echo $image['sizes']['medium-width']; ?>"
								height="<?php echo $image['sizes']['medium-height']; ?>"
								data-mobile-width="<?php echo $image['sizes']['pop-featured-image-front-width']; ?>"
								data-mobile-height="<?php echo $image['sizes']['pop-featured-image-front-height']; ?>"
								data-srcset="<?php echo $image['sizes']['pop-featured-image-front']; ?> 255w, <?php echo $image['sizes']['medium']; ?> 530w"
								data-ie="<?php echo $image['sizes']['medium']; ?>"
								sizes="(max-width: 356px) 255px, 530px"
								src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7"
								class="lazyload"
								alt="<?php if ($image['alt']) { echo $image['alt']; } else { echo the_title(); } ?>">
							<!-- <img src="<?php echo $image['sizes']['medium']; ?>" alt="<?php echo $image['alt']; ?>" class="lazyload" /> -->
							<figcaption><?php echo $image['caption']; ?></figcaption>
						</figure>
					</a>
					<?php endforeach; ?>
					<?php endif; ?>
				</div>
				<?php endif; ?>
			<?php
			elseif( get_row_layout() == 'gallery_with_captions' ): ?>
				<?php if( get_sub_field('images') ): ?>
				<div class="gallery-with-captions">
					<?php 
					$images = get_sub_field('images');
					$size = 'full'; // (thumbnail, medium, large, full or custom size)
					if( $images ): ?>
					<?php foreach( $images as $image ): ?>
					<a data-size="<?php echo $image['sizes']['large-width'].'x'.$image['sizes']['large-height'] ?>" href="<?php echo $image['sizes']['large']; ?>" title="<?php if ($image['caption']) { echo $image['caption']; } else { echo the_title(); } ?>">
						<figure>
							<img 
								width="<?php echo $image['sizes']['medium-width']; ?>"
								height="<?php echo $image['sizes']['medium-height']; ?>"
								data-mobile-width="<?php echo $image['sizes']['pop-featured-image-front-width']; ?>"
								data-mobile-height="<?php echo $image['sizes']['pop-featured-image-front-height']; ?>"
								data-srcset="<?php echo $image['sizes']['pop-featured-image-front']; ?> 255w, <?php echo $image['sizes']['medium']; ?> 530w"
								data-ie="<?php echo $image['sizes']['medium']; ?>"
								sizes="(max-width: 356px) 255px, 530px"
								src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7"
								class="lazyload"
								alt="<?php if ($image['alt']) { echo $image['alt']; } else { echo the_title(); } ?>">
							<!-- <img src="<?php echo $image['sizes']['medium']; ?>" alt="<?php echo $image['alt']; ?>" class="lazyload" /> -->
							<figcaption><?php echo $image['caption']; ?></figcaption>
						</figure>
					</a>
					<?php endforeach; ?>
					<?php endif; ?>
				</div>
				<?php endif; ?>
			<?php endif; ?>
			<?php endwhile; ?>
			</div>
		<?php endif; ?>
		</div>
		<?php endif; ?>
	<?php endwhile; //layout ?>
	<?php endif; //layout ?>
</div>
<?php if(is_page('contact')) {
	echo '<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDWs5Kl4S40sW5pHYnmxhl4Sv56p06Qias"></script>';
} ?>

<?php
    get_template_part('template-parts/post/photoswipe');
?>

<script src="<?php echo esc_url( site_url( '/' ) . 'wp-content/themes/pop/src/js/photoswipe.js' ); ?>"></script>

<?php get_footer();
