<?php
/**
 * Free Blog functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Free_Blog
 */

if ( ! function_exists( 'free_blog_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function free_blog_setup() {
		$GLOBALS['free_blog_theme_options'] = free_blog_get_options_value();
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Free Blog, use a find and replace
		 * to change 'free-blog' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'free-blog' );

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

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'menu-1' => esc_html__( 'Primary', 'free-blog' ),
			'top' => esc_html__( 'Top Header', 'free-blog' ),
			'social' => esc_html__( 'Social Icons', 'free-blog' ),
		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'free_blog_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
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
            'status',
            'audio',
            'chat',
        ) );
	}
endif;
add_action( 'after_setup_theme', 'free_blog_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function free_blog_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'free_blog_content_width', 640 );
}
add_action( 'after_setup_theme', 'free_blog_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function free_blog_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'free-blog' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'free-blog' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Left Sidebar', 'free-blog' ),
		'id'            => 'left-sidebar',
		'description'   => esc_html__( 'Add widgets here.', 'free-blog' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer One', 'free-blog' ),
		'id'            => 'footer-1',
		'description'   => esc_html__( 'Add widgets here.', 'free-blog' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer Two', 'free-blog' ),
		'id'            => 'footer-2',
		'description'   => esc_html__( 'Add widgets here.', 'free-blog' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer Three', 'free-blog' ),
		'id'            => 'footer-3',
		'description'   => esc_html__( 'Add widgets here.', 'free-blog' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer Four', 'free-blog' ),
		'id'            => 'footer-4',
		'description'   => esc_html__( 'Add widgets here.', 'free-blog' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'free_blog_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function free_blog_scripts() {

	/*google font  */
	global $free_blog_theme_options;
	$free_blog_name_font_url   = esc_url( $free_blog_theme_options['free-blog-font-family-url'] );

	if($free_blog_name_font_url != ''):
		wp_enqueue_style('free-blog-googleapis',$free_blog_name_font_url , null, false, 'all');
	endif;
	
	/*Author signature google font  */
    wp_enqueue_style('free-blog-author-sign', '//fonts.googleapis.com/css?family=Italianno|Niconne', array(), null);
	
	//*Font-Awesome-master*/
    wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/css/font-awesome.min.css', array(), '4.5.0' );

     wp_enqueue_style( 'bootstrap-_css', get_template_directory_uri() . '/assets/css/bootstrap.min.css', array(), '4.5.0' );
    
    /*Slick CSS*/
    wp_enqueue_style( 'slick', get_template_directory_uri() . '/assets/css/slick.css', array(), '4.5.0' );
    
	wp_enqueue_style( 'free-blog-style', get_stylesheet_uri() );
	
	 wp_enqueue_script( 'bootstrap_js', get_template_directory_uri() . '/assets/js/bootstrap.min.js', array('jquery'), '4.6.0' );
	
	$masonry =  esc_attr($free_blog_theme_options['free-blog-column-blog-page']);
    if( 'masonry-post' == $masonry )  {
    	wp_enqueue_script( 'masonry' );
    	wp_enqueue_script( 'free-blog-custom-masonry', get_template_directory_uri() . '/assets/js/custom-masonry.js', array('jquery'), '4.6.0' );
   }

	wp_enqueue_script( 'free-blog-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );

	/*Slick JS*/
    wp_enqueue_script( 'slick', get_template_directory_uri() . '/assets/js/slick.js', array('jquery'), '4.6.0' );

	wp_enqueue_script( 'free-blog-script', get_template_directory_uri() . '/js/script.js', array(), '20151215', true );

	/*Custom Scripts*/
	wp_enqueue_script( 'free-blog-custom', get_template_directory_uri() . '/assets/js/custom.js', array(), '20151215', true );

	global $wp_query;
    $paged = ( get_query_var( 'paged' ) > 1 ) ? get_query_var( 'paged' ) : 1;
    $max_num_pages = $wp_query->max_num_pages;

    wp_localize_script( 'free-blog-custom', 'free_blog_ajax', array(
        'ajaxurl' => admin_url( 'admin-ajax.php' ),
        'paged'     => $paged,
        'max_num_pages'      => $max_num_pages,
        'next_posts'      => next_posts( $max_num_pages, false ),
        'show_more'      => __( 'View More', 'free-blog' ),
        'no_more_posts'        => __( 'No More', 'free-blog' ),
    ));

	wp_enqueue_script( 'free-blog-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

	/*Sticky Sidebar*/
	global $free_blog_theme_options;
	if( 1 == absint($free_blog_theme_options['free-blog-enable-sticky-sidebar'])) {
		wp_enqueue_script( 'theia-sticky-sidebar', get_template_directory_uri() . '/assets/js/theia-sticky-sidebar.js', array(), '20151215', true );
	}

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
	
}
add_action( 'wp_enqueue_scripts', 'free_blog_scripts' );


/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/getting-started.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

/**
 * Load custom functions file
 */
require get_template_directory() . '/inc/custom-functions.php';

/**
 * Load sanitize functions file
 */
require get_template_directory() . '/inc/sanitize-functions.php';

/**
 * Load category dropdown functions
 */
require get_template_directory() . '/inc/customizer-category-control.php';

/**
 * Dynamic CSS file load
 */
require get_template_directory() . '/inc/dynamic-css.php';
/**
 * load custom widgets
 */
require get_template_directory() . '/inc/widgets/widget-init.php';
require get_template_directory() . '/inc/widgets/aki-author-widget.php';
require get_template_directory() . '/inc/widgets/aki-featured-posts-widget.php';
require get_template_directory() . '/inc/widgets/aki-social-widget.php';
require get_template_directory() . '/inc/widgets/aki-post-slider-widget.php';
/**
 * customizer pro
 */
require get_template_directory() . '/inc/customizer-pro/class-customize.php';

// Update CSS within in Admin
function free_blog_admin_style() {
  wp_enqueue_style('free-blog-about', get_template_directory_uri() . '/css/about.css', array(), '4.5.0');
}
add_action('admin_enqueue_scripts', 'free_blog_admin_style');