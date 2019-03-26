<?php 
//Add styles and scripts
add_action( 'wp_enqueue_scripts', 'theme_scripts' );

function theme_scripts() {
//  Adding styles
  wp_enqueue_style( 'libs-styles', get_template_directory_uri() . '/css/libs.min.css' );
  wp_enqueue_style( 'style-css', get_template_directory_uri() . '/css/main.min.css' );

//  Adding scripts
  wp_enqueue_script( 'libs-scripts', get_template_directory_uri() . '/js/libs.min.js', array(), '1.0.0', true );
  wp_enqueue_script( 'main-scripts', get_template_directory_uri() . '/js/common.min.js', array(), '1.0.0', true );
}

// Enable svg
function cc_mime_types($mimes) {
	$mimes['svg'] = 'image/svg+xml';
	return $mimes;
}
add_filter('upload_mimes', 'cc_mime_types');

// Add widgets, menus, post-thumbnails
add_theme_support('widgets');
add_theme_support('menus');
add_theme_support('post-thumbnails');

/*** Navigation ***/
if (function_exists('add_theme_support')) {
	add_theme_support('menus');
}

add_action('after_setup_theme', function () {
	register_nav_menus(array(
		'header_nav' => 'Меню в Хедере',
		'footer_nav' => 'Меню в Футере'
	));
});

function get_custom_menu($name, $class = 'header-nav-list') {
	wp_nav_menu(array(
		'menu'              => $name,
		'theme_location'    => $name,
		'depth'             => 0,
		'container'         => '',
		'container_id'      => '',
		'container_class'   => 'collapse navbar-collapse navbar-ex1-collapse',
		'menu_class'        => $class,
		'menu_id'           => $class,
		'show_in_nav_menus' => true,
	));
}