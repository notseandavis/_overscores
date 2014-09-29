<?php
/**
 * _dw functions and definitions
 *
 * @package _dw
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) )
	$content_width = 750; /* pixels */

if ( ! function_exists( '_dw_setup' ) ) :
/**
 * Set up theme defaults and register support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 */
function _dw_setup() {
    global $cap, $content_width;

    // This theme styles the visual editor with editor-style.css to match the theme style.
    add_editor_style();

    if ( function_exists( 'add_theme_support' ) ) {

		/**
		 * Add default posts and comments RSS feed links to head
		*/
		add_theme_support( 'automatic-feed-links' );
		
		/**
		 * Enable support for Post Thumbnails on posts and pages
		 *
		 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
		*/
		add_theme_support( 'post-thumbnails' );
		
		/**
		 * Enable support for Post Formats
		*/
		add_theme_support( 'post-formats', array( 'aside', 'image', 'video', 'quote', 'link' ) );
		
		/**
		 * Setup the WordPress core custom background feature.
		*/
		add_theme_support( 'custom-background', apply_filters( '_dw_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );
	
    }

	/**
	 * Make theme available for translation
	 * Translations can be filed in the /languages/ directory
	 * If you're building a theme based on _dw, use a find and replace
	 * to change '_dw' to the name of your theme in all the template files
	*/
	load_theme_textdomain( '_dw', get_template_directory() . '/languages' );

	/**
	 * This theme uses wp_nav_menu() in one location.
	*/ 
    register_nav_menus( array(
        'primary'  => __( 'Header bottom menu', '_dw' ),
    ) );

}
endif; // _dw_setup
add_action( 'after_setup_theme', '_dw_setup' );

/**
 * Register widgetized area and update sidebar with default widgets
 */
function _dw_widgets_init() {
	register_sidebar( array(
		'name' => __( 'Header Widget Area 1', '_dw' ),
		'id' => 'header-widget-1',
		'description' => __( 'First header widget area. Overrides the custom header image', '_dw' ),
		'before_widget' => '<div class="first-header-widget">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="header-widget-title">',
		'after_title' => '</h3>',
	) );
	register_sidebar( array(
		'name' => __( 'Header Widget Area 2', '_dw' ),
		'id' => 'header-widget-2',
		'description' => __( 'Second header widget area.', '_dw' ),
		'before_widget' => '<div class="second-header-widget">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="header-widget-title">',
		'after_title' => '</h3>',
	) );
	register_sidebar( array(
		'name' => __( 'Header Widget Area 3', '_dw' ),
		'id' => 'header-widget-3',
		'description' => __( 'Third header widget area.', '_dw' ),
		'before_widget' => '<div class="third-header-widget">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="header-widget-title">',
		'after_title' => '</h3>',
	) );
	register_sidebar( array(
		'name'          => __( 'Sidebar', '_dw' ),
		'id'            => 'sidebar-1',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
	// First footer widget. Empty by default.
	register_sidebar( array(
		'name' => __( 'Footer Widget Area 1', '_dw' ),
		'id' => 'footer-widget-1',
		'description' => __( 'The first footer widget area', '_dw' ),
		'before_widget' => '<div class="%1$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	// Decond footer widget. Empty by default.
	register_sidebar( array(
		'name' => __( 'Footer Widget Area 2', '_dw' ),
		'id' => 'footer-widget-2',
		'description' => __( 'The second footer widget area', '_dw' ),
		'before_widget' => '<div class="%1$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	// Third footer widget. Empty by default.
	register_sidebar( array(
		'name' => __( 'Footer Widget Area 3', '_dw' ),
		'id' => 'footer-widget-3',
		'description' => __( 'The third footer widget area', '_dw' ),
		'before_widget' => '<div class="%1$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	// Foruth footer widget. Empty by default.
	register_sidebar( array(
		'name' => __( 'Footer Widget Area 4', '_dw' ),
		'id' => 'footer-widget-4',
		'description' => __( 'The fourth footer widget area', '_dw' ),
		'before_widget' => '<div class="%1$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
	// Homepage Widget
	register_sidebar( array(
		'name' => __( 'Homepage Widget', '_dw' ),
		'id' => 'homepage-widget',
		'description' => __( 'Widget area above content on homepage', '_dw' ),
		'before_widget' => '',
		'after_widget' => '',
		'before_title' => '<h3 class="homepage-widget-title">',
		'after_title' => '</h3>',
	) );

}
add_action( 'widgets_init', '_dw_widgets_init' );

// Enable shortcodes in widgets
add_filter('widget_text', 'do_shortcode');

/**
 * Enqueue scripts and styles
 */
function _dw_scripts() {

	// load bootstrap css
	wp_enqueue_style( '_dw-bootstrap', get_template_directory_uri() . '/includes/resources/bootstrap/css/bootstrap.css' );
	
	// load bootstrap js
	wp_enqueue_script('_dw-bootstrapjs', get_template_directory_uri().'/includes/resources/bootstrap/js/bootstrap.js', array('jquery') );
		
	// load bootstrap wp js
	wp_enqueue_script( '_dw-bootstrapwp', get_template_directory_uri() . '/includes/js/bootstrap-wp.js', array('jquery') );

	wp_enqueue_script( '_dw-skip-link-focus-fix', get_template_directory_uri() . '/includes/js/skip-link-focus-fix.js', array(), '20130115', true );
	
	wp_enqueue_style( '_dw-style', get_stylesheet_uri() );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
	
	if ( is_singular() && wp_attachment_is_image() ) {
		wp_enqueue_script( '_dw-keyboard-image-navigation', get_template_directory_uri() . '/includes/js/keyboard-image-navigation.js', array( 'jquery' ), '20120202' );
	}
}
add_action( 'wp_enqueue_scripts', '_dw_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/includes/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/includes/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/includes/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/includes/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/includes/jetpack.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/includes/bootstrap-wp-navwalker.php';
