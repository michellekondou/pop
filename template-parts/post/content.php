<?php
/**
 * Template part for displaying posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage pop
 * @since 1.0
 * @version 1.2
 */

?>
<?php 
	$image_data = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), "pop-featured-image-front" );
?>
<article id="post-<?php the_ID(); ?>" class="grid-item" style="width:<?php echo $image_data[1]; ?>px;height: <?php echo $image_data[2]+24; ?>px">

	<?php if ( '' !== get_the_post_thumbnail() && ! is_single() ) : ?>
		<div class="post-thumbnail">
			<a href="<?php the_permalink(); ?>">
					
				<img 
					width="<?php echo $image_data[1]; ?>"
					height="<?php echo $image_data[2]; ?>"
					data-src="<?php echo $image_data[0]; ?>" 
					src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7"
					class="lazyload">
			</a>
		</div><!-- .post-thumbnail -->
	<?php endif; ?>

	<header class="entry-header">
		<?php
		if ( 'post' === get_post_type() ) {
			//echo '<div class="entry-meta">';
				if ( is_single() ) {
					//pop_posted_on();
				} else {
					//echo pop_time_link();
					//pop_edit_link();
				};
			//echo '</div><!-- .entry-meta -->';
		};

		if ( is_single() ) {
			the_title( '<h1 class="entry-title">', '</h1>' );
		} elseif ( is_front_page() && is_home() ) {
			the_title( '<h3 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h3>' );
		} else {
			the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
		}
		?>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php
		/* translators: %s: Name of current post */
		the_content( sprintf(
			__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'pop' ),
			get_the_title()
		) );

		wp_link_pages( array(
			'before'      => '<div class="page-links">' . __( 'Pages:', 'pop' ),
			'after'       => '</div>',
			'link_before' => '<span class="page-number">',
			'link_after'  => '</span>',
		) );
		?>
	</div>
	<!-- .entry-content -->

	<?php
	if ( is_single() ) {
		pop_entry_footer();
	}
	?>

</article><!-- #post-## -->

