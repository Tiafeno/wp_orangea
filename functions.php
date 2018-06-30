<?php
/**
 * Created by IntelliJ IDEA.
 * User: Tiafeno
 * Date: 06/05/2018
 * Time: 15:36
 */

define( '__site_key__', "6LdkSUkUAAAAAMqVJODAt7TpAMUX9LJVVnOlz9gX" );
/** Google api key */
define( 'sitename', 'orangea' );
define( '_OG_POSTTYPE_', '__og_section' );

$og_global_args = [];

// Class dependence for Orangea template
require get_template_directory() . '/actions/orangea-actions.php';
require get_template_directory() . '/includes/wp_orangea.php';
require get_template_directory() . '/includes/wp_orangea_services.php';
require get_template_directory() . '/includes/wp_orangea_menu_walker.php';
require get_template_directory() . '/composer/vendor/autoload.php';

require_once get_template_directory() . '/includes/wp_acf_orangea.php';

// Create class instance
$instanceOrangea         = new WP_Orangea();
$instanceOrangeaServices = new WP_orangea_services();
$detector                = new Mobile_Detect;

//
add_action( 'orangea_section_bg', 'action_section_bg', 10, 3 );
add_action( 'orangea_home_bg', 'action_home_bg', 10, 2 );
add_action( 'orangea_enqueue_options_script', 'action_enqueue_option_scripts', 10, 1 );

add_action( 'wp_ajax_action_get_galerie', 'action_get_galerie' );
add_action( 'wp_ajax_nopriv_action_get_galerie', 'action_get_galerie' );

add_action( 'init', function () {
	// Creer une nouvelle post 'section'
	register_post_type( _OG_POSTTYPE_, array(
		'label'           => _x( "Section", 'General name for "Ad" post type' ),
		'labels'          => array(
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
		'public'          => true,
		'hierarchical'    => false,
		'menu_position'   => null,
		'show_ui'         => true,
		'rewrite'         => array( 'slug' => 'section' ),
		'capability_type' => 'post',
		'menu_icon'       => 'dashicons-exerpt-view',
		'supports'        => [ 'title', 'editor', 'excerpt', 'thumbnail', 'custom-fields' ]
	) );
} );

add_action( 'after_setup_theme', function () {
	load_theme_textdomain( 'twentyfifteen' );
	load_theme_textdomain( sitename, get_template_directory() . '/languages' );

	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'title-tag' );

	/** Register menu location */
	register_nav_menus( array(
		'primary'              => __( 'Primary Menu', 'twentyfifteen' ),
		'hebergement'          => __( 'Hébergement Menu', sitename ),
		'activities_resort'    => __( 'Activités resort Menu', sitename ),
		'activities_excursion' => __( 'Activités excursion Menu', sitename )
	) );
} );

add_action( 'get_header', function () {

} );

add_action( 'widgets_init', function () {

	// Element avec le fond orange
	register_sidebar( array(
		'name'          => 'Menu Area',
		'id'            => 'menu-area',
		'description'   => 'Add widgets here to appear in accommodation section.',
		'before_widget' => '<div id="%1$s" class="%2$s uk-text-meta menu-area">',
		'after_widget'  => '</div>',
		'before_title'  => '<div class="uk-hidden">',
		'after_title'   => '</div>'
	) );

	// Element liste
	register_sidebar( array(
		'name'          => 'List Area',
		'id'            => 'list-area',
		'description'   => 'Add widgets here to appear in right container footer.',
		'before_widget' => '<div id="%1$s" class="%2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<div class="uk-hidden">',
		'after_title'   => '</div>'
	) );
} );

add_action( 'wp_enqueue_scripts', function () {
	$upload_dir = wp_upload_dir();

	$theme   = wp_get_theme( 'wp_orangea' );
	$version = $theme->get( 'Version' );

	/**
	 * Style
	 */
	wp_enqueue_style( 'semantic', get_template_directory_uri() . '/libs/semantic/semantic.css', '', $version );
	wp_enqueue_style( 'semantic-transition', get_template_directory_uri() . '/libs/semantic/transition.css', '', $version );
	wp_enqueue_style( 'semantic-modal', get_template_directory_uri() . '/libs/semantic/modal.css', '', $version );
	wp_enqueue_style( 'semantic-form', get_template_directory_uri() . '/libs/semantic/form.css', '', $version );
	wp_enqueue_style( 'semantic-icon', get_template_directory_uri() . '/libs/semantic/icon.css', '', $version );
	wp_enqueue_style( 'semantic-tab', get_template_directory_uri() . '/libs/semantic/tab.css', '', $version );

	wp_enqueue_style( 'uikit', get_template_directory_uri() . '/libs/uikit/uikit.css', '', $version );
	wp_enqueue_style( 'orangea-menu', get_template_directory_uri() . '/assets/css/menu.css', '', $version );
	wp_enqueue_style( 'orangea-style', get_stylesheet_uri(), array(), $version );
	wp_enqueue_style( 'Montserrat', "//fonts.googleapis.com/css?family=Montserrat:300,400,400i,500,500i,700,800" );

	wp_enqueue_script( 'underscore' );
	// wp_enqueue_script('jquery');

	// Qunit test unit
	if ( WP_DEBUG ):
		wp_enqueue_script( 'qunit', 'https://code.jquery.com/qunit/qunit-2.6.1.js', array( 'jquery' ), $version, true );
		wp_enqueue_style( 'qunit-style', 'https://code.jquery.com/qunit/qunit-2.6.1.css', array(), $version );
	endif;

	wp_enqueue_script( 'bluebird', get_template_directory_uri() . '/libs/bluebird.js', array(), $version );
	wp_enqueue_script( 'angularjs', get_template_directory_uri() . '/libs/angularjs/angular.js', array(), $version );
	wp_enqueue_script( 'angularjs-sanitize', '//ajax.googleapis.com/ajax/libs/angularjs/1.6.9/angular-sanitize.js', array( "angularjs" ), $version );
	wp_enqueue_script( 'activity-galerie', get_template_directory_uri() . '/assets/js/activityGalerie.js', array( "angularjs" ), $version );
	wp_localize_script( 'activity-galerie', 'orangea', array(
		'ajax_url'    => admin_url( 'admin-ajax.php' ),
		'templateUrl' => get_template_directory_uri() . '/assets/js/templates/',
		'templateDir' => get_template_directory_uri()
	) );
	wp_enqueue_script( 'jquery-adress', get_template_directory_uri() . '/libs/jquery/jquery.address.js', array( 'jquery' ), $version );
	wp_enqueue_script( 'uikit', get_template_directory_uri() . '/libs/uikit/uikit.min.js', array( 'jquery' ) );
	wp_enqueue_script( 'uikit-icon', get_template_directory_uri() . '/libs/uikit/uikit-icons.min.js', array(
		'jquery',
		'uikit'
	) );
	wp_enqueue_script( 'sematic-transition', get_template_directory_uri() . '/libs/semantic/transition.min.js', array() );
	wp_enqueue_script( 'sematic-form', get_template_directory_uri() . '/libs/semantic/form.min.js', array() );
	wp_enqueue_script( 'sematic-modal', get_template_directory_uri() . '/libs/semantic/modal.min.js', array() );
	wp_enqueue_script( 'sematic-tab', get_template_directory_uri() . '/libs/semantic/tab.min.js', array() );
	wp_enqueue_script( 'orangea-script', get_template_directory_uri() . '/assets/js/orangea.js', array( 'jquery' ), $version, true );

	if ( WP_DEBUG ):
		wp_enqueue_script( 'qunit-orangea-script', get_template_directory_uri() . '/assets/js/orangea-test.js', array(
			'qunit',
			'orangea-script'
		), $version, true );
	endif;

	wp_enqueue_script( 'menu', get_template_directory_uri() . '/assets/js/menu.js', array( 'jquery' ), $version, true );

	/** Visual composer dependance */
	wp_enqueue_script( 'simpleImageSlider', $upload_dir['baseurl'] . '/visualcomposer-assets/elements/simpleImageSlider/simpleImageSlider/public/dist/simpleImageSlider.min.js', array( 'jquery' ), $version, true );
	wp_enqueue_script( 'slick', $upload_dir['baseurl'] . '/visualcomposer-assets/elements/simpleImageSlider/simpleImageSlider/public/dist/slick.custom.min.js', array( 'jquery' ), $version, true );
	wp_enqueue_script( 'fullHeightRow', $upload_dir['baseurl'] . '/visualcomposer-assets/elements/row/row/public/dist/fullHeightRow.min.js', array( 'jquery' ), $version, true );

} );


/**
 * @param $name String
 */
function og_get_view_content( $name, $args ) {
	if ( is_array( $name ) ) {
		$nameExtact = implode( '-', $name );
		$filename   = $nameExtact;
	}

	if ( is_string( $name ) ) {
		$filename = $name;
	}

	if ( ! isset( $filename ) ) {
		return false;
	}
	$fileLocation = get_template_directory() . '/templates/views/' . $filename . 'View.php';
	if ( file_exists( $fileLocation ) ) :
		extract( $args, EXTR_OVERWRITE );
		include $fileLocation;
	endif;
}

if ( function_exists( 'acf_add_options_page' ) ) {
	// Premier menu d'options
	acf_add_options_page( array(
		'page_title' => 'Orangea',
		'menu_title' => 'Orangea Options',
		'menu_slug'  => 'options-orangea',
		'capability' => 'edit_posts',
		'redirect'   => true
	) );
}

// Register string (polylang plugins)
if ( function_exists( "pll_register_string" ) ) :
	pll_register_string( sitename, "MENU" );
	pll_register_string( sitename, "Book" );
	pll_register_string( sitename, "STRATÉGIE, CONCEPTION, MARKETING ET SOUTENU PAR" );
else:
	exit( "Function `pll_register_string` is not define, please active polylang plugins" );
endif;

