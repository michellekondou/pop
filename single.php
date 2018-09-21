<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package WordPress
 * @subpackage pop
 * @since 1.0
 * @version 1.0
 */

get_header(); ?>

<?php
/* Start the Loop */
while ( have_posts() ) : the_post(); 
	$location = get_field( "location" );
	$referrer = filter_input( INPUT_GET, 'ref', FILTER_VALIDATE_INT ); // This validate and checks if our referrer "ref" is set
	if ( $referrer ) {
		$category = get_category( $referrer );
	}
?> 
<div id="primary" class="content-area">
	<main id="main" class="site-main" role="main" id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php if ( $referrer ) : ?>
	<header class="page-header scroll-visible">
		<h2 class="page-title"><a href="<?php echo site_url() . '\/category/' . $category->slug; ?>"><?php echo $category->name; ?></a></h2>		
	</header>
	<?php endif; ?>
	<?php if( have_rows('project_intro') ): ?>
		<div class="container project-intro scrollElement">
		<?php
		// loop through the rows of data
		while ( have_rows('project_intro') ) : the_row(); ?>

		<?php
			if( get_row_layout() == 'image_left_text_right' ): ?>
			<div class="section two-columns">
				<article class="text">
					<h2 class="entry-title"><?php the_title();?></h2>
					<?php the_sub_field('text'); ?>
				</article>
				<div class="images">
				<?php
				// check if the repeater field has rows of data
				if( have_rows('images') ): ?>
				<?php while ( have_rows('images') ) : the_row(); ?>
					<?php 
					$image = get_sub_field('image_file');
					if( !empty($image) ): ?>
					<div class="magnifiable block">
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
				<?php endwhile; ?>
				<?php endif; ?>
				</div>
			</div>
		<?php endif; ?>
		<?php endwhile; ?>
		</div>
	<?php endif; //project_intro ?>
	<?php if( have_rows('project_extended') ): ?> 
		<div class="container project-extended">
		<?php
		// loop through the rows of data
		while ( have_rows('project_extended') ) : the_row(); ?>
			<?php
			if( get_row_layout() == 'image_full_width' ): ?>
			<div class="section full-width">
				<?php 
					$image = get_sub_field('image');
					if( !empty($image) ): 
					?>
					<div class="magnifiable block">
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
					<div class="magnifiable block">
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
					<div class="magnifiable block">
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
					<div class="gallery magnifiable block">
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
					<div class="gallery-with-captions magnifiable block">
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
					<div class="magnifiable block">
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
					<div class="gallery magnifiable block">
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
					<div class="gallery-with-captions block">
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
		<?php endwhile; //project_extended ?>
		</div>
	<?php endif; //project_extended ?>
<!-- </div>  -->
</main>
<!-- .wrap -->
<div id="posts-navigation" class="navigation">
<?php 
/**
 *  Infinite next and previous post looping in WordPress
 */
// get next post link
// $next_post = get_adjacent_post( true, '', false );
// if( $next_post ) {
//     echo '<a class="nav-next" href="' . get_permalink( $next_post->ID ) . '"></a>';
// } 

// // show prev post link
// $prev_post = get_adjacent_post( true, '', true );
// if( $prev_post ) {
//     echo '<a class="nav-previous" href="' . get_permalink( $prev_post->ID ) . '"></a>';
// } 

if ( function_exists( 'next_adjacent_post_link' ) ) {
	next_adjacent_post_link();
}
    
if ( function_exists( 'previous_adjacent_post_link' ) ) {
	previous_adjacent_post_link();
}
    
?>
</div>

<?php endwhile; ?>

<?php
    get_template_part('template-parts/post/photoswipe');
?>

<script src="<?php echo esc_url( site_url( '/' ) . 'wp-content/themes/pop/src/js/photoswipe.js' ); ?>"></script>

<?php get_footer();