<?php
/**
 * Displays top navigation
 *
 * @package WordPress
 * @subpackage pop
 * @since 1.0
 * @version 1.2
 */

?>

<nav class="menu" id="side-menu">
    <input type="checkbox" id="small-nav" aria-hidden="true" tabindex="-1">
    <label class="small-screen" for="small-nav">
        <span></span>
        <span></span>
        <span></span>
    </label>
    <div class="menu__items">
        <ul>
            <li class="menu__heading"><span>WORKS</span>
               <?php wp_nav_menu( array(
                    'theme_location' => 'categories'
                ) ); ?>
            </li>
            <li class="menu__heading about"><span>I & POP</span> 
                <?php wp_nav_menu( array(
                    'theme_location' => 'pages'
                ) ); ?>
            </li>
        </ul>
    </div>
    <button type="button" class="language-switcher">GR</button>
</nav>

<!-- <nav id="site-navigation" class="main-navigation" role="navigation" aria-label="<?php esc_attr_e( 'Top Menu', 'pop' ); ?>">
	<button class="menu-toggle" aria-controls="top-menu" aria-expanded="false">
		<?php
		echo pop_get_svg( array( 'icon' => 'bars' ) );
		echo pop_get_svg( array( 'icon' => 'close' ) );
		_e( 'Menu', 'pop' );
		?>
	</button>

	<?php wp_nav_menu( array(
		'theme_location' => 'top',
		'menu_id'        => 'top-menu',
	) ); ?>

	<?php if ( ( pop_is_frontpage() || ( is_home() && is_front_page() ) ) && has_custom_header() ) : ?>
		<a href="#content" class="menu-scroll-down"><?php echo pop_get_svg( array( 'icon' => 'arrow-right' ) ); ?><span class="screen-reader-text"><?php _e( 'Scroll down to content', 'pop' ); ?></span></a>
	<?php endif; ?>
</nav> -->
<!-- #site-navigation -->
