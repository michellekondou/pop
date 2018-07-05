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
?> 
<div class="wrap" id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php if( have_rows('project_intro') ): ?>
		<div class="container project-intro">
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
					<figure>
						<img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" />
						<figcaption><?php echo $image['caption']; ?></figcaption>
					</figure>
					<?php endif; ?>
				<?php endwhile; ?>
				<?php endif; ?>
				</div>
			</div>
		<?php
			elseif( get_row_layout() == 'image_full_width' ): ?>
			<div class="section full-width">
				<div class="images">
					<?php 
					$image = get_sub_field('image');
					if( !empty($image) ): ?>
					<figure>
						<img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" />
						<figcaption><?php echo $image['caption']; ?></figcaption>
					</figure>
					<?php endif; ?>
				</div>
			</div>
		<?php
			elseif( get_row_layout() == 'image_2col_width' ): ?>
			<div class="section two-column-width">
				<?php 
					$image = get_sub_field('image');
					if( !empty($image) ): ?>
					<figure>
						<img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" />
						<figcaption><?php echo $image['caption']; ?></figcaption>
					</figure>
				<?php endif; ?>
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
				<div class="images">
					<?php 
					$image = get_sub_field('image');
					if( !empty($image) ): ?>
					<figure>
						<img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" />
						<figcaption><?php echo $image['caption']; ?></figcaption>
					</figure>
					<?php endif; ?>
				</div>
			</div>
			<?php
			elseif( get_row_layout() == 'image_2col_width' ): ?>
			<div class="section two-column-width">
				<?php 
					$image = get_sub_field('image');
					if( !empty($image) ): ?>
					<figure>
						<img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" />
						<figcaption><?php echo $image['caption']; ?></figcaption>
					</figure>
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
					<figure>
						<img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" />
						<figcaption><?php echo $image['caption']; ?></figcaption>
					</figure>
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
							<figure>
								<?php echo wp_get_attachment_image( $image['ID'], $size ); ?>
							</figure>
						<?php endforeach; ?>
						<?php endif; ?>
					</div>
					<?php endif; ?>
				<?php
				elseif( get_row_layout() == 'gallery_with_captions' ): ?>
					<?php if( get_sub_field('images') ): ?>
					  <div style="width: 200px; margin: 0 auto">
						<a class="magnifier-thumb-wrapper demo" href="http://en.wikipedia.org/wiki/File:Starry_Night_Over_the_Rhone.jpg">
							<img 
							id="thumb-inside" 
							src="http://upload.wikimedia.org/wikipedia/commons/thumb/9/94/Starry_Night_Over_the_Rhone.jpg/200px-Starry_Night_Over_the_Rhone.jpg"
							data-mode="inside" 
							data-zoomable="true"
							data-large-img-url="http://upload.wikimedia.org/wikipedia/commons/thumb/9/94/Starry_Night_Over_the_Rhone.jpg/1200px-Starry_Night_Over_the_Rhone.jpg">
						</a>
					</div>
					<div class="gallery-with-captions">
						<?php 
						$images = get_sub_field('images');
						$size = 'full'; // (thumbnail, medium, large, full or custom size)
						if( $images ): ?>
						<?php foreach( $images as $image ): ?>
						<?php $large = $image['sizes']['large']; ?>
							<figure>
								<?php echo wp_get_attachment_image( $image['ID'], $size, "", array('data-large-img-url'=> $large) ); ?>
								<figcaption><?php echo $image['caption']; ?></figcaption>
							</figure>
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
					<figure>
						<img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" />
						<figcaption><?php echo $image['caption']; ?></figcaption>
					</figure>
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
							<figure>
								<?php echo wp_get_attachment_image( $image['ID'], $size ); ?>
							</figure>
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
							<figure>
								<?php echo wp_get_attachment_image( $image['ID'], $size ); ?>
								<figcaption><?php echo $image['caption']; ?></figcaption>
							</figure>
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
</div> 
<!-- .wrap -->
<?php endwhile; ?>



<!-- <div class="wrap">
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<?php
			/* Start the Loop */
			while ( have_posts() ) : the_post();

				//get_template_part( 'template-parts/post/content', get_post_format() );

				// If comments are open or we have at least one comment, load up the comment template.
				if ( comments_open() || get_comments_number() ) :
					//comments_template();
				endif;

				// the_post_navigation( array(
				// 	'prev_text' => '<span class="screen-reader-text">' . __( 'Previous Post', 'pop' ) . '</span><span aria-hidden="true" class="nav-subtitle">' . __( 'Previous', 'pop' ) . '</span> <span class="nav-title"><span class="nav-title-icon-wrapper">' . pop_get_svg( array( 'icon' => 'arrow-left' ) ) . '</span>%title</span>',
				// 	'next_text' => '<span class="screen-reader-text">' . __( 'Next Post', 'pop' ) . '</span><span aria-hidden="true" class="nav-subtitle">' . __( 'Next', 'pop' ) . '</span> <span class="nav-title">%title<span class="nav-title-icon-wrapper">' . pop_get_svg( array( 'icon' => 'arrow-right' ) ) . '</span></span>',
				// ) );

			endwhile; // End of the loop.
			?>

		</main> -->
		<!-- #main -->
	<!-- </div> -->
	<!-- #primary -->
	<?php //get_sidebar(); ?>
<!-- </div> -->
<!-- .wrap -->

<?php get_footer();
