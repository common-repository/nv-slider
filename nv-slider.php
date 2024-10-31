<?php
/*
Plugin Name: NV Slider
Plugin URI: http://www.sutanaryan.com/freebies/plugins/nv-slider/
Description: A responsive, simple, light and easy customizable wordpress content slider and comes with unlimeted number of slides and effects.
Author: Ryan Sutana
Version: 1.6
Author URI: http://www.sutanaryan.com/
*/

define( 'SLIDER_VERSION', '1.5.0' );
define( 'SLIDER_PLUGIN_PATH', plugin_dir_path(__FILE__) );
define( 'SLIDER_PLUGIN_URL', plugin_dir_url(__FILE__) );
define( 'SLIDER_JS', SLIDER_PLUGIN_URL.'assets/js/' );
define( 'SLIDER_CSS', SLIDER_PLUGIN_URL.'assets/css/' );
define( 'SLIDER_IMAGES', SLIDER_PLUGIN_URL.'assets/images/' );
define( 'PLUGIN_DOMAIN', 'nv-slider-plugin' );

include_once ( SLIDER_PLUGIN_PATH . 'inc/class.php' );
include_once ( SLIDER_PLUGIN_PATH . 'inc/shortcode.php' );
include_once ( SLIDER_PLUGIN_PATH . 'inc/utilities.php' );
include_once ( SLIDER_PLUGIN_PATH . 'admin/post_meta.php' );


add_action( 'admin_init', 'register_admin_nv_style' );
function register_admin_nv_style() {
	wp_register_style( 'nv_admin_style', SLIDER_CSS . 'admin-style.css', false, '1.0.0', 'all' );
}
	//activate only in admin area
	function active_nv_admin_styles() {
		wp_enqueue_style( 'nv_admin_style' );
	}


// register script
add_action('init', 'register_nv_slider_script');
function register_nv_slider_script(){
	$labels = array(
		'name' 					=> _x('NV Sliders', 'nv-slider'),
		'singular_name' 		=> _x('NV Slider', 'nv-slider'),
		'add_new' 				=> _x('Add New', 'nv-slider'),
		'add_new_item' 			=> __('Add New Slider'),
		'edit_item' 			=> __('Edit Slider'),
		'new_item' 				=> __('New Slider'),
		'all_items' 			=> __('Sliders'),
		'view_item' 			=> __('View Slider'),
		'search_items' 			=> __('Search Sliders'),
		'not_found' 			=>  __('No sliders found'),
		'not_found_in_trash' 	=> __('No sliders found in Trash'), 
		'menu_name'	 			=> __('NV Sliders')
	);
	
	$args = array(
		'labels' 				=> $labels,
		'public' 				=> true,
		'publicly_queryable' 	=> true,
		'show_ui' 				=> true, 
		'show_in_menu' 			=> true, 
		'query_var' 			=> true,
		'rewrite' 				=> true,
		'capability_type' 		=> 'post',
		'has_archive' 			=> true, 
		'hierarchical' 			=> false,
		'menu_position' 		=> null,
		'menu_icon' 			=> 'dashicons-format-gallery',
		'supports' 				=> array( 'title', 'editor', 'thumbnail', 'page-attributes' )
	);
	
	register_post_type('nv-slider', $args);
	
	// register scripts and styles
	wp_register_script( 'nv_script', SLIDER_JS . 'jquery.nivo.slider.js', array('jquery'), '2.5.1' );
	wp_register_style( 'nv_style', SLIDER_CSS . 'nivo-slider.css', false, '1.0.0', 'all');
}

add_action( 'wp_enqueue_scripts', 'enqueue_nv_slider_scripts' );
function enqueue_nv_slider_scripts(){
	wp_enqueue_script('nv_script');
	
	wp_enqueue_style( 'nv_style' );
}


// register nv settings page
add_action( 'admin_menu', 'add_nv_sub_page' );
function add_nv_sub_page() {
	$page = add_submenu_page( 'edit.php?post_type=nv-slider', __( 'Settings', 'nv-slider' ), __( 'Settings', 'nv-slider' ), 'manage_options', __FILE__, 'add_nv_sub_page_callback' ); 
	
	//activate admin style only in nv settings page
	add_action( 'admin_print_styles-' . $page, 'active_nv_admin_styles' );
}

	function add_nv_sub_page_callback() {
		//include data fetcher admin
		include_once ( SLIDER_PLUGIN_PATH . 'admin/index.php' );
	}

// enable featured image
if (function_exists('add_theme_support')) {
	add_theme_support('post-thumbnails');
}

// add defualt value
register_activation_hook(__FILE__, 'nv_slider_table');
function nv_slider_table()
{
    global $wpdb;
	
    $table = $wpdb->prefix."nv_slider";
    $structure = "
	CREATE TABLE IF NOT EXISTS $table (
        ID INT(11) NOT NULL AUTO_INCREMENT,
		effect VARCHAR(225) NOT NULL,
		animSpeed INT(11),
		pauseTime INT(11),
		startSlide INT(11),
		directionNav VARCHAR(25),
		controlNav VARCHAR(25),
		keyboardNav VARCHAR(25),
		pauseOnHover VARCHAR(25),
		width INT(11),
		height INT(11),
		PRIMARY KEY(ID)
    );";
    $wpdb->query( $structure );
	
	$wpdb->insert("{$wpdb->prefix}nv_slider", 
		array(
			'effect'		=> "random",
			'animSpeed'		=> "1000",
			'pauseTime'		=> "5000",
			'startSlide'	=> "0",
			'directionNav'	=> "true",
			'controlNav'	=> "true",
			'keyboardNav'	=> "true",
			'pauseOnHover'	=> "true",
			'width'			=> "960",
			'height'		=> "300",
		)
	);
}