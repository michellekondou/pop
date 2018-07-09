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
	$image_data_xs = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), "pop-featured-image-front-xs" );
?>
<article id="post-<?php the_ID(); ?>" class="grid-item">
    <a href="<?php the_permalink(); ?>" rel='bookmark'>
        <div class="loader-2 center"><span></span></div>
        <img 
            width="<?php echo $image_data[1]; ?>"
            height="<?php echo $image_data[2]; ?>"
            data-mobile-height="<?php echo $image_data_xs[2]; ?>"
            data-srcset="<?php echo $image_data_xs[0]; ?> 205w, <?php echo $image_data[0]; ?> 255w"
            data-ie="<?php echo $image_data_xs[0]; ?>"
            sizes=" (max-width: 320px) 205px,
                    (max-width: 860px) 255px,
                    (max-width: 960px) 205px,
                    (max-width: 1060px) 255px,
                    255px"
            src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7"
            class="lazyload">
        <noscript>
            <img 
                data-srcset="<?php echo $image_data_xs[0]; ?> 255w"
                sizes="255px"
                src="<?php echo $image_data_m[0]; ?>"
                class="attachment-post-thumbnail size-post-thumbnail wp-post-image lazyload">
        </noscript>
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
			the_title( '<h3 class="entry-title">', '</h3>' );
		} else {
			the_title( '<h2 class="entry-title">', '</h2>' );
		}
		?>
        </header><!-- .entry-header -->
    </a>
        <script>
            // var cw = window.innerWidth;
            // console.log(cw);
            // var gridItem = document.querySelectorAll('#post-'+ <?php the_ID(); ?> + '.grid-item');
            // var gridItemWidth;
            // var gridItemHeight;
            // if(cw <= 360) {
            //     gridItemWidth = <?php echo $image_data_xs[1]; ?>;
            //     gridItemHeight = <?php echo $image_data_xs[2]+24; ?>;
            // } else if (cw > 360 && cw < 1375) {
            //     gridItemWidth = <?php echo $image_data_s[1]; ?>;
            //     gridItemHeight = <?php echo $image_data_s[2]+24; ?>;
            // } else if (cw > 1375) {
            //     gridItemWidth = <?php echo $image_data[1]; ?>;
            //     gridItemHeight = <?php echo $image_data[2]+24; ?>;
            // }
            
            // gridItem[0].style.width = gridItemWidth +'px';
            // gridItem[0].style.height = gridItemHeight +'px';
        </script>
</article>


