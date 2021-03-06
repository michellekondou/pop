<?php
/**
 * Twenty Seventeen functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package WordPress
 * @subpackage pop
 * @since 1.0
 */

/**
 * Twenty Seventeen only works in WordPress 4.7 or later.
 */


if ( version_compare( $GLOBALS['wp_version'], '4.7-alpha', '<' ) ) {
	require get_template_directory() . '/inc/back-compat.php';
	return;
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function pop_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed at WordPress.org. See: https://translate.wordpress.org/projects/wp-themes/pop
	 * If you're building a theme based on Twenty Seventeen, use a find and replace
	 * to change 'pop' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'pop' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );

	add_image_size( 'pop-featured-image-front', 255, 255, array( 'center', 'center' ) );

	add_image_size( 'pop-featured-image-front-xs', 205, 205, array( 'center', 'center' ) );

	// Set the default content width.
	$GLOBALS['content_width'] = 1160;

	// This theme uses wp_nav_menu() in two locations.
	register_nav_menus( array(
		'top'    => __( 'Top Menu', 'pop' ),
		'social' => __( 'Social Links Menu', 'pop' ),
		'categories' => __('Works', 'pop' ),
		'pages' => __('I & POP', 'pop' )
	) );

	/*  
 *  Hide empty categories from nav menus
 */
add_filter( 'wp_get_nav_menu_items', 'gowp_nav_remove_empty_terms', 10, 3 );
function gowp_nav_remove_empty_terms ( $items, $menu, $args ) {
    global $wpdb;
    $empty = $wpdb->get_col( "SELECT term_taxonomy_id FROM $wpdb->term_taxonomy WHERE count = 0" );
    foreach ( $items as $key => $item ) {
        if ( ( 'taxonomy' == $item->type ) && ( in_array( $item->object_id, $empty ) ) ) {
            unset( $items[$key] );
        }
    }
    return $items;
}

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 *
	 * See: https://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'aside',
		'image',
		'video',
		'quote',
		'link',
		'gallery',
		'audio',
	) );

	// Add theme support for Custom Logo.
	add_theme_support( 'custom-logo', array(
		'width'       => 250,
		'height'      => 250,
		'flex-width'  => true,
	) );

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/*
	 * This theme styles the visual editor to resemble the theme style,
	 * specifically font, colors, and column width.
 	 */
	add_editor_style( array( 'assets/css/editor-style.css' ) );

	// Define and register starter content to showcase the theme on new sites.
	$starter_content = array(
		'widgets' => array(
			// Place three core-defined widgets in the sidebar area.
			'sidebar-1' => array(
				'text_business_info',
				'search',
				'text_about',
			),

			// Add the core-defined business info widget to the footer 1 area.
			'sidebar-2' => array(
				'text_business_info',
			),

			// Put two core-defined widgets in the footer 2 area.
			'sidebar-3' => array(
				'text_about',
				'search',
			),
		),

		// Specify the core-defined pages to create and add custom thumbnails to some of them.
		'posts' => array(
			'home',
			'about' => array(
				'thumbnail' => '{{image-sandwich}}',
			),
			'contact' => array(
				'thumbnail' => '{{image-espresso}}',
			),
			'blog' => array(
				'thumbnail' => '{{image-coffee}}',
			),
			'homepage-section' => array(
				'thumbnail' => '{{image-espresso}}',
			),
		),

		// Create the custom image attachments used as post thumbnails for pages.
		'attachments' => array(
			'image-espresso' => array(
				'post_title' => _x( 'Espresso', 'Theme starter content', 'pop' ),
				'file' => 'assets/images/espresso.jpg', // URL relative to the template directory.
			),
			'image-sandwich' => array(
				'post_title' => _x( 'Sandwich', 'Theme starter content', 'pop' ),
				'file' => 'assets/images/sandwich.jpg',
			),
			'image-coffee' => array(
				'post_title' => _x( 'Coffee', 'Theme starter content', 'pop' ),
				'file' => 'assets/images/coffee.jpg',
			),
		),

		// Default to a static front page and assign the front and posts pages.
		'options' => array(
			'show_on_front' => 'page',
			'page_on_front' => '{{home}}',
			'page_for_posts' => '{{blog}}',
		),

		// Set the front page section theme mods to the IDs of the core-registered pages.
		'theme_mods' => array(
			'panel_1' => '{{homepage-section}}',
			'panel_2' => '{{about}}',
			'panel_3' => '{{blog}}',
			'panel_4' => '{{contact}}',
		),

		// Set up nav menus for each of the two areas registered in the theme.
		'nav_menus' => array(
			// Assign a menu to the "top" location.
			'top' => array(
				'name' => __( 'Top Menu', 'pop' ),
				'items' => array(
					'link_home', // Note that the core "home" page is actually a link in case a static front page is not used.
					'page_about',
					'page_blog',
					'page_contact',
				),
			),

			// Assign a menu to the "social" location.
			'social' => array(
				'name' => __( 'Social Links Menu', 'pop' ),
				'items' => array(
					'link_yelp',
					'link_facebook',
					'link_twitter',
					'link_instagram',
					'link_email',
				),
			),
		),
	);

	/**
	 * Filters Twenty Seventeen array of starter content.
	 *
	 * @since Twenty Seventeen 1.1
	 *
	 * @param array $starter_content Array of starter content.
	 */
	$starter_content = apply_filters( 'pop_starter_content', $starter_content );

	add_theme_support( 'starter-content', $starter_content );
}
add_action( 'after_setup_theme', 'pop_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function pop_content_width() {

	$content_width = $GLOBALS['content_width'];

	// Get layout.
	$page_layout = get_theme_mod( 'page_layout' );

	// Check if layout is one column.
	if ( 'one-column' === $page_layout ) {
		if ( pop_is_frontpage() ) {
			$content_width = 1320;
		} elseif ( is_page() ) {
			$content_width = 1160;
		}
	}

	// Check if is single post and there is no sidebar.
	if ( is_single() && ! is_active_sidebar( 'sidebar-1' ) ) {
		$content_width = 1160;
	}

	/**
	 * Filter Twenty Seventeen content width of the theme.
	 *
	 * @since Twenty Seventeen 1.0
	 *
	 * @param int $content_width Content width in pixels.
	 */
	$GLOBALS['content_width'] = apply_filters( 'pop_content_width', $content_width );
}
add_action( 'template_redirect', 'pop_content_width', 0 );

/**
 * Register custom fonts.
 */
// function pop_fonts_url() {
// 	$fonts_url = '';

// 	/*
// 	 * Translators: If there are characters in your language that are not
// 	 * supported by Libre Franklin, translate this to 'off'. Do not translate
// 	 * into your own language.
// 	 */
// 	$libre_franklin = _x( 'on', 'Libre Franklin font: on or off', 'pop' );

// 	if ( 'off' !== $libre_franklin ) {
// 		$font_families = array();

// 		$font_families[] = 'Libre Franklin:300,300i,400,400i,600,600i,800,800i';

// 		$query_args = array(
// 			'family' => urlencode( implode( '|', $font_families ) ),
// 			'subset' => urlencode( 'latin,latin-ext' ),
// 		);

// 		$fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );
// 	}

// 	return esc_url_raw( $fonts_url );
// }

/**
 * Add preconnect for Google Fonts.
 *
 * @since Twenty Seventeen 1.0
 *
 * @param array  $urls           URLs to print for resource hints.
 * @param string $relation_type  The relation type the URLs are printed.
 * @return array $urls           URLs to print for resource hints.
 */
function pop_resource_hints( $urls, $relation_type ) {
	if ( wp_style_is( 'pop-fonts', 'queue' ) && 'preconnect' === $relation_type ) {
		$urls[] = array(
			'href' => 'https://fonts.gstatic.com',
			'crossorigin',
		);
	}

	return $urls;
}
add_filter( 'wp_resource_hints', 'pop_resource_hints', 10, 2 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function pop_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Blog Sidebar', 'pop' ),
		'id'            => 'sidebar-1',
		'description'   => __( 'Add widgets here to appear in your sidebar on blog posts and archive pages.', 'pop' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => __( 'Footer 1', 'pop' ),
		'id'            => 'sidebar-2',
		'description'   => __( 'Add widgets here to appear in your footer.', 'pop' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => __( 'Footer 2', 'pop' ),
		'id'            => 'sidebar-3',
		'description'   => __( 'Add widgets here to appear in your footer.', 'pop' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'pop_widgets_init' );

/**
 * Replaces "[...]" (appended to automatically generated excerpts) with ... and
 * a 'Continue reading' link.
 *
 * @since Twenty Seventeen 1.0
 *
 * @param string $link Link to single post/page.
 * @return string 'Continue reading' link prepended with an ellipsis.
 */
function pop_excerpt_more( $link ) {
	if ( is_admin() ) {
		return $link;
	}

	$link = sprintf( '<p class="link-more"><a href="%1$s" class="more-link">%2$s</a></p>',
		esc_url( get_permalink( get_the_ID() ) ),
		/* translators: %s: Name of current post */
		sprintf( __( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'pop' ), get_the_title( get_the_ID() ) )
	);
	return ' &hellip; ' . $link;
}
add_filter( 'excerpt_more', 'pop_excerpt_more' );

/**
 * Handles JavaScript detection.
 *
 * Adds a `js` class to the root `<html>` element when JavaScript is detected.
 *
 * @since Twenty Seventeen 1.0
 */
function pop_javascript_detection() {
	echo "<script>(function(html){html.className = html.className.replace(/\bno-js\b/,'js')})(document.documentElement);</script>\n";
}
add_action( 'wp_head', 'pop_javascript_detection', 0 );

/**
 * Add a pingback url auto-discovery header for singularly identifiable articles.
 */
function pop_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">' . "\n", get_bloginfo( 'pingback_url' ) );
	}
}
add_action( 'wp_head', 'pop_pingback_header' );

/**
 * Display custom color CSS.
 */
function pop_colors_css_wrap() {
	if ( 'custom' !== get_theme_mod( 'colorscheme' ) && ! is_customize_preview() ) {
		return;
	}

	require_once( get_parent_theme_file_path( '/inc/color-patterns.php' ) );
	$hue = absint( get_theme_mod( 'colorscheme_hue', 250 ) );
?>
	<style type="text/css" id="custom-theme-colors" <?php if ( is_customize_preview() ) { echo 'data-hue="' . $hue . '"'; } ?>>
		<?php echo pop_custom_colors_css(); ?>
	</style>
<?php }
add_action( 'wp_head', 'pop_colors_css_wrap' );

/**
 * Enqueue scripts and styles.
 */
function pop_scripts() {
	// Add custom fonts, used in the main stylesheet.
	//wp_enqueue_style( 'pop-fonts', pop_fonts_url(), array(), null );

	// Theme stylesheet.
	wp_enqueue_style( 'pop-style', get_stylesheet_uri() );

	// Load the Internet Explorer 9 specific stylesheet, to fix display issues in the Customizer.
	
	wp_enqueue_style( 'pop-ie9', get_theme_file_uri( '/assets/css/ie9.css' ), array( 'pop-style' ), '1.0' );
	wp_style_add_data( 'pop-ie9', 'conditional', 'IE 9' );
	

	if ( is_page('home') ) {
		wp_enqueue_script( 'flickity', get_theme_file_uri( '/assets/js/flickity.pkgd.min.js' ), array(), '1.0', true );
	}

	// Load the Internet Explorer 8 specific stylesheet.
	wp_enqueue_style( 'pop-ie8', get_theme_file_uri( '/assets/css/ie8.css' ), array( 'pop-style' ), '1.0' );
	wp_style_add_data( 'pop-ie8', 'conditional', 'lt IE 9' );

	// Load the html5 shiv.
	wp_enqueue_script( 'html5', get_theme_file_uri( '/assets/js/html5.js' ), array(), '3.7.3' );
	wp_script_add_data( 'html5', 'conditional', 'lt IE 9' );

	wp_enqueue_script( 'pop-skip-link-focus-fix', get_theme_file_uri( '/assets/js/skip-link-focus-fix.js' ), array(), '1.0', true );

	$pop_l10n = array(
		'quote' => pop_get_svg( array( 'icon' => 'quote-right' ) ),
	);

	if ( has_nav_menu( 'top' ) ) {
		wp_enqueue_script( 'pop-navigation', get_theme_file_uri( '/assets/js/navigation.js' ), array( 'jquery' ), '1.0', true );
		$pop_l10n['expand']         = __( 'Expand child menu', 'pop' );
		$pop_l10n['collapse']       = __( 'Collapse child menu', 'pop' );
		$pop_l10n['icon']           = pop_get_svg( array( 'icon' => 'angle-down', 'fallback' => true ) );
	}

	wp_enqueue_script( 'pop-polyfills', get_theme_file_uri( '/public/js/polyfills.bundle.js' ), array(), '1.0', true );
	wp_enqueue_script( 'pop-lazyload', get_theme_file_uri( '/public/js/iolazy.bundle.js' ), array(), '1.0', true, true );
	wp_enqueue_script( 'pop-global', get_theme_file_uri( '/public/js/global.bundle.js' ), array(), '1.0', true );
	


	//wp_enqueue_script( 'jquery-scrollto', get_theme_file_uri( '/assets/js/jquery.scrollTo.js' ), array( 'jquery' ), '2.1.2', true );

	wp_localize_script( 'pop-skip-link-focus-fix', 'popScreenReaderText', $pop_l10n );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'pop_scripts' );

remove_action( 'wp_head', 'print_emoji_detection_script', 7 ); 
remove_action( 'admin_print_scripts', 'print_emoji_detection_script' ); 
remove_action( 'wp_print_styles', 'print_emoji_styles' ); 
remove_action( 'admin_print_styles', 'print_emoji_styles' );

/**
 * Add custom image sizes attribute to enhance responsive image functionality
 * for content images.
 *
 * @since Twenty Seventeen 1.0
 *
 * @param string $sizes A source size value for use in a 'sizes' attribute.
 * @param array  $size  Image size. Accepts an array of width and height
 *                      values in pixels (in that order).
 * @return string A source size value for use in a content image 'sizes' attribute.
 */
function pop_content_image_sizes_attr( $sizes, $size ) {
	$width = $size[0];

	if ( 740 <= $width ) {
		$sizes = '(max-width: 706px) 89vw, (max-width: 767px) 82vw, 740px';
	}

	if ( is_active_sidebar( 'sidebar-1' ) || is_archive() || is_search() || is_home() || is_page() ) {
		if ( ! ( is_page() && 'one-column' === get_theme_mod( 'page_options' ) ) && 767 <= $width ) {
			 $sizes = '(max-width: 767px) 89vw, (max-width: 1000px) 54vw, (max-width: 1071px) 543px, 580px';
		}
	}

	return $sizes;
}
add_filter( 'wp_calculate_image_sizes', 'pop_content_image_sizes_attr', 10, 2 );


/**
 * Filter the `sizes` value in the header image markup.
 *
 * @since Twenty Seventeen 1.0
 *
 * @param string $html   The HTML image tag markup being filtered.
 * @param object $header The custom header object returned by 'get_custom_header()'.
 * @param array  $attr   Array of the attributes for the image tag.
 * @return string The filtered header image HTML.
 */
function pop_header_image_tag( $html, $header, $attr ) {
	if ( isset( $attr['sizes'] ) ) {
		$html = str_replace( $attr['sizes'], '100vw', $html );
	}
	return $html;
}
add_filter( 'get_header_image_tag', 'pop_header_image_tag', 10, 3 );

/**
 * Add custom image sizes attribute to enhance responsive image functionality
 * for post thumbnails.
 *
 * @since Twenty Seventeen 1.0
 *
 * @param array $attr       Attributes for the image markup.
 * @param int   $attachment Image attachment ID.
 * @param array $size       Registered image size or flat array of height and width dimensions.
 * @return array The filtered attributes for the image markup.
 */
function pop_post_thumbnail_sizes_attr( $attr, $attachment, $size ) {
	if ( is_archive() || is_search() ) {
		$attr['sizes'] = '(max-width: 767px) 89vw, (max-width: 1000px) 54vw, (max-width: 1071px) 543px, 580px';
	} else {
		$attr['sizes'] = '100vw';
	}

	return $attr;
}
add_filter( 'wp_get_attachment_image_attributes', 'pop_post_thumbnail_sizes_attr', 10, 3 );

/**
 * Use front-page.php when Front page displays is set to a static page.
 *
 * @since Twenty Seventeen 1.0
 *
 * @param string $template front-page.php.
 *
 * @return string The template to be used: blank if is_home() is true (defaults to index.php), else $template.
 */
function pop_front_page_template( $template ) {
	return is_home() ? '' : $template;
}
add_filter( 'frontpage_template',  'pop_front_page_template' );

/**
 * Modifies tag cloud widget arguments to display all tags in the same font size
 * and use list format for better accessibility.
 *
 * @since Twenty Seventeen 1.4
 *
 * @param array $args Arguments for tag cloud widget.
 * @return array The filtered arguments for tag cloud widget.
 */
function pop_widget_tag_cloud_args( $args ) {
	$args['largest']  = 1;
	$args['smallest'] = 1;
	$args['unit']     = 'em';
	$args['format']   = 'list';

	return $args;
}
add_filter( 'widget_tag_cloud_args', 'pop_widget_tag_cloud_args' );

add_filter( 'get_the_archive_title', function ( $title ) {

    if( is_category() ) {

        $title = single_cat_title( '', false );

    }

    return $title;

});

/**
 * Return only the first category when outputting the previous/next post links
 */
function my_custom_post_navigation($terms, $object_ids, $taxonomies, $args){
	var_dump($terms, $object_ids, $taxonomies, $args);
    return array_slice($terms, 0, 1);

}
// Change to post_type_link for custom post type posts
add_filter('post_link', function( $permalink ) 
{
    if ( is_category() && ($cat = get_queried_object()) ) {
        $permalink = esc_url( add_query_arg( array( 'ref' => $cat->term_id ), $permalink ) );
    }
    return $permalink;
});

add_filter( 'query_vars', function ( $vars ) 
{
    $vars[] = 'ref';
    return $vars;
});

/*
 * Add our custom query vars so Wordpress can read it
 */
add_filter( 'query_vars', function ( $vars ) 
{
    $vars[] = 'ref';
    return $vars;
});

/* 
 * Add our referrer to single post links if we are on a category page
 */
add_filter('post_link', function( $permalink ) // Change to post_type_link for custom post type posts
{
    if (      is_category() // Change to is_tax() for custom taxonomy pages
         && ( $cat = get_queried_object() ) 
    ) {
        $permalink = esc_url( add_query_arg( ['ref' => $cat->term_id], $permalink ) );
    }
    return $permalink;
});

/*
 * Create our custom adjacent post link 
 */
function get_referred_adjacent_post( $args = [] ) 
{
    //First check if we are on a single post, else return false
    if ( !is_single() )
        return false;

    //Defaults arguments set for the function. 
    $defaults = [
        'previous'       => true,
		'anchor_class_prev' => 'nav-previous',
		'anchor_class_next' => 'nav-next'
    ];  

    $combined_args = wp_parse_args( $args, $defaults );

    /**
     * Get the currently displayed single post. For this use 
     * get_queried_object() as this is more safe than the global $post
     *
     * The $post global is very easily changed by any poorly written custom query
     * or function, and is there for not reliable
     *
     * @see Post below on WPSE for explanation
     * @link https://wordpress.stackexchange.com/q/167706/31545
    */ 
    $current_post       = get_queried_object();
    $current_post_date  = $current_post->post_date;
    $current_post_type  = $current_post->post_type;

    //Set the important parameters to either get the next post or previous post
    $previous = $combined_args['previous'];
    $order    = ( $previous ) ? 'DESC' : 'ASC';
    $op       = ( $previous ) ? 'before' : 'after';

    // Check if we have a referrer, if so, we need to set this to get the next post in this specific referrer category
    $cat_id = filter_input( INPUT_GET, 'ref', FILTER_VALIDATE_INT );

    if ( $cat_id )
        $custom_args = ['cat' => $cat_id];

    /**
     * Set the default arguments to merge with the referrer arguments
     *
     * Uses date_query (introduced Wordpress 3.7) to calculate the appropriate adjacent post
     * @see http://codex.wordpress.org/Class_Reference/WP_Query#Date_Parameters
    */ 
    $query_args = [
        'post_type'         => $current_post_type,
        'posts_per_page'    => 1,
        'order'             => $order,
        'no_found_rows'     => true,
        'suppress_filters'  => true,
        'date_query'        => [
            [
                $op         => $current_post_date,
                'inclusive' => false
            ]
        ]
    ];

    $query_args = ( isset( $custom_args ) ) ? wp_parse_args( $custom_args, $query_args ) : $query_args;

    $q = new WP_Query( $query_args );

    //If there are no post found, bail early
    if( !$q->posts )
		return false;
		
		//If there are posts, continue
		if($q->posts[0]) {
			$adjacent_post = $q->posts[0];
		} else {
			$adjacent_post =  $q->posts;
		}
		
		//Build the permalinks for the adjacent post
		$permalink = get_permalink( $adjacent_post->ID );

		// Return the correct permalink, we should add our referrer to the link now if this post was referred
		$link = ( $cat_id ) ? add_query_arg( ['ref' => $cat_id], $permalink ) : $permalink;

		// Create our anchor and post title text. By default. The post title is used
		$post_title  = ( $combined_args['post_link_text'] == '%text' ) ? $adjacent_post->post_title : $combined_args['post_link_text'];
		
		if($post_title) {
			$anchor_class = ( $combined_args['previous'] ) ? $combined_args['anchor_class_prev'] : $combined_args['anchor_class_next'];
		}
		//Create the link with title name and anchor text
		$adjacent_post_link = '<a class="' . $anchor_class . '" href="' . $link . '"></a>';
		
		return $adjacent_post_link;


}

// Create the next post link - Return the post link
function get_next_adjacent_post_link( $post_link_text = '%text', $span_text_next = 'Newer post: ' )
{
    $args = [
        'previous'       => false,
        'post_link_text' => $post_link_text,
        'span_text_next' => $span_text_next,
    ];
    return get_referred_adjacent_post( $args );
}

// Create the previous post link - Return the post link
function get_previous_adjacent_post_link( $post_link_text = '%text', $span_text_prev = 'Older post: ' )
{
    $args = [
        'previous'       => true,
        'post_link_text' => $post_link_text,
        'span_text_prev' => $span_text_prev,
    ];
    return get_referred_adjacent_post( $args );
}

// Create the next post link - Echo post link
function next_adjacent_post_link( $post_link_text = '%text', $span_text_next = 'Newer post: ' )
{
    echo get_next_adjacent_post_link( $post_link_text, $span_text_next );
}

// Create the previous post link - Echo post link
function previous_adjacent_post_link( $post_link_text = '%text', $span_text_prev = 'Older post: ' )
{
    echo get_previous_adjacent_post_link( $post_link_text, $span_text_prev );
}

function my_acf_init() {
	
	acf_update_setting('google_api_key', 'AIzaSyDWs5Kl4S40sW5pHYnmxhl4Sv56p06Qias');
}

add_action('acf/init', 'my_acf_init');

/**
 * Implement the Custom Header feature.
 */
require get_parent_theme_file_path( '/inc/custom-header.php' );

/**
 * Custom template tags for this theme.
 */
require get_parent_theme_file_path( '/inc/template-tags.php' );

/**
 * Additional features to allow styling of the templates.
 */
require get_parent_theme_file_path( '/inc/template-functions.php' );

/**
 * Customizer additions.
 */
require get_parent_theme_file_path( '/inc/customizer.php' );

/**
 * SVG icons functions and filters.
 */
require get_parent_theme_file_path( '/inc/icon-functions.php' );

//add_action( 'init', 'setting_my_first_cookie' );


