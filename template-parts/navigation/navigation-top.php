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
    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="logo">
        <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
            viewBox="0 0 203 23.5" enable-background="new 0 0 203 23.5" xml:space="preserve">
            <path fill="#FFFFFF" d="M0.265,1.95c0-0.663,0.537-1.2,1.2-1.2h4.383c0.663,0,1.2,0.537,1.2,1.2v19.6c0,0.663-0.537,1.2-1.2,1.2
            H1.465c-0.663,0-1.2-0.537-1.2-1.2V1.95z" />
            <path fill="#FFFFFF" d="M87.099,22.75c1.022,0,1.551-1.096,1.551-1.096L99.135,2.236c0.744-1.427-0.642-1.486-0.642-1.486h-4.384
            h-1.426l-8.242,15.263L76.2,0.75h-1.426H70.39c0,0-1.387,0.059-0.642,1.486l10.485,19.418c0,0,0.529,1.096,1.551,1.096
            S87.099,22.75,87.099,22.75z" />
            <g id="XMLID_1_">
                <g>
                    <path fill="#FFFFFF" d="M202.486,6.266v5.34c0,3.047-2.467,5.519-5.514,5.519h-13.281v4.427c0,0.66-0.541,1.196-1.201,1.196
                    h-4.382c-0.665,0-1.201-0.536-1.201-1.196V1.948c0-0.66,0.536-1.196,1.201-1.196h18.865
                    C200.019,0.752,202.486,3.218,202.486,6.266z M196.178,8.936c0-1.553-1.256-2.809-2.809-2.809h-9.678v5.623h9.678
                    C194.922,11.75,196.178,10.489,196.178,8.936z" />
                    <path fill="#FFFFFF" d="M173.099,6.266v10.968c0,3.047-2.467,5.514-5.514,5.514h-17.296c-3.047,0-5.514-2.467-5.514-5.514V6.266
                    c0-3.047,2.467-5.514,5.514-5.514h17.296C170.633,0.752,173.099,3.218,173.099,6.266z M166.508,15.164V8.335
                    c0-1.206-0.978-2.189-2.189-2.189h-10.765c-1.211,0-2.189,0.983-2.189,2.189v6.829c0,1.206,0.978,2.189,2.189,2.189h10.765
                    C165.531,17.353,166.508,16.37,166.508,15.164z" />
                    <path fill="#FFFFFF" d="M141.901,6.266v5.34c0,3.047-2.472,5.519-5.519,5.519h-13.281v4.427c0,0.66-0.536,1.196-1.201,1.196
                    h-4.382c-0.66,0-1.201-0.536-1.201-1.196V1.948c0-0.66,0.541-1.196,1.201-1.196h18.865C139.43,0.752,141.901,3.218,141.901,6.266z
                        M135.593,8.936c0-1.553-1.261-2.809-2.814-2.809h-9.678v5.623h9.678C134.333,11.75,135.593,10.489,135.593,8.936z" />
                </g>
                <g>
                </g>
            </g>
            <g id="XMLID_2_">
                <g>
                    <path fill="#FFFFFF" d="M54.035,18.222c0.581,0.318,0.794,1.047,0.476,1.628l-0.953,1.742c-0.323,0.581-1.052,0.794-1.633,0.476
                    l-2.596-1.474c-1.008,1.31-2.591,2.154-4.372,2.154H31.602c-3.047,0-5.519-2.467-5.519-5.514v-4.427
                    c0-1.211,0.978-2.189,2.189-2.189h1.226c0.392,0,0.715-0.323,0.715-0.715c0-0.213-0.104-0.397-0.253-0.526
                    c-0.774-0.442-1.464-1.29-1.464-2.67V3.561c0-1.553,1.256-2.809,2.809-2.809h13.122c3.047,0,5.514,2.467,5.514,5.514v1.762h-6.095
                    V7.343c0-1.206-0.978-2.189-2.189-2.189H35.16c-1.176,0-1.003,1.176-1.003,1.176c0,0.993,1.206,1.544,1.206,1.544l10.591,5.851
                    v-1.841c0-0.665,0.536-1.201,1.201-1.201h2.893c0.66,0,1.201,0.536,1.201,1.201v4.765L54.035,18.222z M43.384,17.477
                    c0,0,0.129-0.099-0.476-0.432l-8.477-4.685h-0.7c-1.206,0-2.189,0.983-2.189,2.194v0.988c0,1.206,0.983,2.189,2.189,2.189h9.177
                    C42.907,17.73,43.384,17.81,43.384,17.477z" />
                </g>
                <g>
                </g>
            </g>
        </svg>
    </a>
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
