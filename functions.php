<?php
/**
 * Created by IntelliJ IDEA.
 * User: Tiafeno
 * Date: 06/05/2018
 * Time: 15:36
 */

define('__site_key__', "6LdkSUkUAAAAAMqVJODAt7TpAMUX9LJVVnOlz9gX"); /** Google api key */
define('sitename', 'orangea');
define('_OG_POSTTYPE_', '__og_section');

// Class dependence for Orangea template
require get_template_directory() . '/includes/wp_orangea.php';
require get_template_directory() . '/includes/wp_orangea_services.php';
require get_template_directory() . '/includes/wp_orangea_menu_walker.php';
require get_template_directory() . '/composer/vendor/autoload.php';

// Create class instance
$instanceOrangea = new WP_Orangea();
$instanceOrangeaServices = new WP_orangea_services();

add_action( 'init', function () {

	// Creer une nouvelle post 'section'
	register_post_type( _OG_POSTTYPE_, array(
		'label'         => _x( "Section", 'General name for "Ad" post type' ),
		'labels'        => array(
			'name'               => _x( "Sections", "Plural name for sections post type" ),
			'singular_name'      => _x( "Section", "Singular name for section post type" ),
			'add_new'            => __( 'Add' ),
			'add_new_item'       => __( "Add New section" ),
			'edit_item'          => __( 'Edit' ),
			'view_item'          => __( 'View' ),
			'search_items'       => __( "Search sections" ),
			'not_found'          => __( "No section found" ),
			'not_found_in_trash' => __( "No section found in trash" )
		),
		'public'        => true,
		'hierarchical'  => false,
		'menu_position' => 100,
		'menu_icon'     => 'dashicons-exerpt-view',
		'supports'      => [ 'title', 'editor', 'thumbnail' ]
	) );
});

add_action( 'after_setup_theme', function () {
	load_theme_textdomain( 'twentyfifteen' );
	load_theme_textdomain( sitename, get_template_directory() . '/languages' );

	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'title-tag' );

	/** Register menu location */
	register_nav_menus( array(
		'primary'  => __( 'Primary Menu',      'twentyfifteen' ),
		'hebergement'   => __( 'Hébergement Menu', sitename ),
		'activities_resort'   => __( 'Activités resort Menu', sitename ),
		'activities_excursion'   => __( 'Activités excursion Menu', sitename )
	) );
});

add_action( 'get_header', function () {

});

add_action ( 'widgets_init', function () {

	/** register sidebar */

	// Element avec le fond orange
	register_sidebar( array(
		'name'          => 'Menu Area',
		'id'            => 'menu-area',
		'description'   => 'Add widgets here to appear in accommodation section.',
		'before_widget' => '<div id="%1$s" class="%2$s uk-text-meta menu-area">',
		'after_widget'  => '</div>'
	) );

	// Element liste
	register_sidebar( array(
		'name'          => 'List Area',
		'id'            => 'list-area',
		'description'   => 'Add widgets here to appear in right container footer.',
		'before_widget' => '<div id="%1$s" class="%2$s">',
		'after_widget'  => '</div>'
	) );
});

add_action( 'wp_enqueue_scripts', function () {
	wp_enqueue_script( 'lodash', get_template_directory_uri() . '/libs/lodash.min.js', array() );
	wp_enqueue_script( 'bluebird', get_template_directory_uri() . '/libs/bluebird.min.js', array() );
	wp_enqueue_script( 'angularjs', get_template_directory_uri() . '/libs/angularjs/angular.js', array() );
	wp_enqueue_script( 'angularjs-sanitize', '//ajax.googleapis.com/ajax/libs/angularjs/1.6.9/angular-sanitize.js', array("angularjs") );

	wp_enqueue_script( 'jquery-adress', get_template_directory_uri() . '/libs/jquery/jquery.address.js', array( 'jquery' ) );

	wp_enqueue_script( 'uikit', get_template_directory_uri() . '/libs/uikit/uikit.min.js', array( 'jquery' ) );
	wp_enqueue_script( 'uikit-icon', get_template_directory_uri() . '/libs/uikit/uikit-icons.min.js', array( 'jquery', 'uikit' ) );

	wp_enqueue_script( 'sematic-transition', get_template_directory_uri() . '/libs/semantic/transition.min.js', array() );
	wp_enqueue_script( 'sematic-form', get_template_directory_uri() . '/libs/semantic/form.min.js', array() );
	wp_enqueue_script( 'sematic-modal', get_template_directory_uri() . '/libs/semantic/modal.min.js', array() );
	wp_enqueue_script( 'sematic-tab', get_template_directory_uri() . '/libs/semantic/tab.min.js', array() );

	wp_enqueue_script( 'orangea-script', get_template_directory_uri() . '/assets/js/orangea.js', array( 'jquery' ), 1, true );
	wp_enqueue_script( 'menu', get_template_directory_uri() . '/assets/js/menu.js', array( 'jquery' ), 1, true );

	//wp_enqueue_style( 'orangea-style', get_stylesheet_uri() );
});


// Register string (polylang plugins)
if (function_exists( "pll_register_string" )) :
		pll_register_string(sitename, "MENU");
	else:
		exit("Function `pll_register_string` is not define, please active polylang plugins");
endif;

