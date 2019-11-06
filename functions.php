<?php
/**
 * 50Jones functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package 50Jones
 */

if ( ! function_exists( 'fifty_jones_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function fifty_jones_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on 50Jones, use a find and replace
		 * to change 'fifty-jones' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'fifty-jones', get_template_directory() . '/languages' );

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
			'menu-1' => esc_html__( 'Primary', 'fifty-jones' ),
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
		add_theme_support( 'custom-background', apply_filters( 'fifty_jones_custom_background_args', array(
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
	}
endif;
add_action( 'after_setup_theme', 'fifty_jones_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function fifty_jones_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'fifty_jones_content_width', 640 );
}
add_action( 'after_setup_theme', 'fifty_jones_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function fifty_jones_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'fifty-jones' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'fifty-jones' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'fifty_jones_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function fifty_jones_scripts() {

	$script_version = '1.0.6';
	$form_nonce = wp_create_nonce( 'load_form' );
	wp_enqueue_style( 'fifty-jones-style', get_stylesheet_uri() );

	wp_enqueue_style( 'fifty-jones-main-style', get_template_directory_uri() . '/css/main.css' );

	wp_enqueue_script( 'fifty-jones-navigation', get_template_directory_uri() . '/js/navigation.js', array(), $script_version, true );

	wp_enqueue_script( 'fifty-jones-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), $script_version, true );

	wp_enqueue_script( 'fifty-jones-jquery', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), $script_version, true );

	wp_enqueue_script('fifty-jones-nice-select', get_template_directory_uri() . '/js/lib/jquery.nice-select.min.js', array('jquery'), $script_version, true);

	wp_enqueue_script('fifty-jones-main-js', get_template_directory_uri() . '/js/main.js', array('jquery'), $script_version, true);

	wp_localize_script( 'fifty-jones-main-js', 'my_ajax_obj', array(
		'ajax_url' => admin_url( 'admin-ajax.php' ),
		'nonce'    => $form_nonce, 
	) );  

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'fifty_jones_scripts' );

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
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

/**
 * Ajax gravity form
 */
// if (is_admin()) {
	// add_action( 'wp_ajax_load_form', 'load_form_handler' );
	// add_action( 'wp_ajax_nopriv_load_form', 'load_form_handler' );
// }


function load_form_handler() {
	// check_ajax_referer( 'load_form' );
	// global $post;
	// $mypost = $_POST['action'];
	// echo $my_post;
	$html = "<div id=\"form-container\">";
	$html .= gravity_form( 1, false, false, false, '', true );
	$html .= "<p>hello world.</p>";
	$html .= "</div>";
	
	wp_die();
}

add_action( 'wp_ajax_nopriv_gf_button_get_form', 'gf_button_ajax_get_form' );
add_action( 'wp_ajax_gf_button_get_form', 'gf_button_ajax_get_form' );

// Add the "button" action to the gravityforms shortcode
// e.g. [gravityforms action="button" id=1 text="button text"]
add_filter( 'gform_shortcode_button', 'gf_button_shortcode', 10, 3 );


function gf_button_shortcode( $shortcode_string, $attributes, $content ){
	$a = shortcode_atts( array(
		'id' => 0,
		'text' => 'Show me the form!',
	), $attributes );

	$form_id = absint( $a['id'] );

	if ( $form_id < 1 ) {
		return 'Missing the ID attribute.';
	}

	// Enqueue the scripts and styles
	gravity_form_enqueue_scripts( $form_id, true );

	$ajax_url = admin_url( 'admin-ajax.php' );

	$html = sprintf( '<button id="gf_button_get_form_%d" class="button join-button">%s</button>', $form_id, $a['text'] );
	// $html .= sprintf( '<div id="gf_button_form_container_%d" style="display:none;"></div>', $form_id );
	$html .= "<script>
				(function (SHFormLoader, $) {
				$('#gf_button_get_form_{$form_id}').click(function(){
					var button = $(this);
					var container = $('#gf-form-container');
					$.get('{$ajax_url}?action=gf_button_get_form&form_id={$form_id}',function(response){
						container.html(response).fadeIn();
					});
				});
			}(window.SHFormLoader = window.SHFormLoader || {}, jQuery));
			</script>";
	return $html;
}

function gf_button_ajax_get_form(){
	$form_id = isset( $_GET['form_id'] ) ? absint( $_GET['form_id'] ) : 0;
	// Render an AJAX-enabled form.
	// https://www.gravityhelp.com/documentation/article/embedding-a-form/#function-call
	gravity_form( $form_id,true, false, false, false, true );
	die();
}









// add_action( 'wp_ajax_my_tag_count', 'my_ajax_handler' );
// function my_ajax_handler() {
//     // Handle the ajax request
//     wp_die(); // All ajax handlers die when finished
// }

// Reference:

// function ajax_gravityBoy() {

//     $query_data = $_GET;
//     $form_id = ($query_data['form_id']) ? $query_data['form_id'] : false;
//     $grav_html = '';

//     $grav_html .= gravity_form( $form_id, false, false, false, null, true, null, false );
//     echo $grav_html;
//     die();
// }

// wp_localize_script( 'init', 'ajax_gravityboy_params', array(
// 	'ajax_url' => admin_url( 'admin-ajax.php' ),
// 	'post_id'  => get_the_id() 

// ) );

