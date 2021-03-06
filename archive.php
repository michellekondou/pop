<?php
/**
 * The template for displaying archive pages
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage pop
 * @since 1.0
 * @version 1.0
 */

get_header(); ?>


	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
		<?php if ( have_posts() ) : ?>
		<header class="page-header scroll-visible">
			<?php
				the_archive_title( '<h1 class="page-title">', '</h1>' );
			?>
		</header>
		<!-- .page-header -->
		<?php endif; ?>
		<div class="container scrollElement">
		<?php if ( is_home() && is_front_page() || is_archive() ) : ?> 
		    <div class="home-grid grid">
			<?php
			if ( have_posts() ) : ?>
				<?php
				/* Start the Loop */
				while ( have_posts() ) : the_post();

					/*
					* Include the Post-Format-specific template for the content.
					* If you want to override this in a child theme, then include a file
					* called content-___.php (where ___ is the Post Format name) and that will be used instead.
					*/
					get_template_part( 'template-parts/post/content-front', get_post_format() );

				endwhile;

				the_posts_pagination( array(
					'prev_text' => pop_get_svg( array( 'icon' => 'arrow-left' ) ) . '<span class="screen-reader-text">' . __( 'Previous page', 'pop' ) . '</span>',
					'next_text' => '<span class="screen-reader-text">' . __( 'Next page', 'pop' ) . '</span>' . pop_get_svg( array( 'icon' => 'arrow-right' ) ),
					'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'pop' ) . ' </span>',
				) );

			else :

				get_template_part( 'template-parts/post/content', 'none' );

			endif; ?> 
	        </div><!-- .home-grid -->
		<?php endif; ?>
		</div>
		</main><!-- #main -->
	</div><!-- #primary -->
	<?php //get_sidebar(); ?>

<!-- .wrap -->

<?php get_footer();
