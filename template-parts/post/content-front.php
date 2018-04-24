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
    $image_data_s = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), "pop-featured-image-front-s" );
	$image_data_xs = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), "pop-featured-image-front-xs" );
?>

<article id="post-<?php the_ID(); ?>" class="grid-item">
<img 
    width="<?php echo $image_data[1]; ?>"
    height="<?php echo $image_data[2]; ?>"
    data-srcset="<?php echo $image_data_xs[0]; ?> 205w, <?php echo $image_data_s[0]; ?> 255w, <?php echo $image_data[0]; ?> 325w"
    sizes="(max-width: 320px) 205px,
            (max-width: 465px) 255px,
            325px"
    src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7"
    class="lazyload">
</article>
<script>
    var cw = window.innerWidth;
    console.log(cw);
    var gridItem = document.querySelectorAll('#post-'+ <?php the_ID(); ?> + '.grid-item');
    var gridItemWidth;
    var gridItemHeight;
    if(cw <= 360) {
        gridItemWidth = <?php echo $image_data_xs[1]; ?>;
        gridItemHeight = <?php echo $image_data_xs[2]+24; ?>;
    } else if (cw > 360 && cw < 465) {
        gridItemWidth = <?php echo $image_data_s[1]; ?>;
        gridItemHeight = <?php echo $image_data_s[2]+24; ?>;
    } else if (cw > 465) {
        gridItemWidth = <?php echo $image_data[1]; ?>;
        gridItemHeight = <?php echo $image_data[2]+24; ?>;
    }
    
    gridItem[0].style.width = gridItemWidth +'px';
    gridItem[0].style.height = gridItemHeight +'px';
</script>
