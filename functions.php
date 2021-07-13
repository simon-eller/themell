<?php

//Adds functionality to have an own logo and to have thumbnails at blog posts
if ( ! function_exists( 'themell_theme_support' ) ) {

    function themell_theme_support(){
        //Adds dynamic title tag and logo
        add_theme_support( 'title-tag' );
        $logo_width  = 250;
		    $logo_height = 70;

		add_theme_support(
			'custom-logo',
      array(
				'height'               => $logo_height,
				'width'                => $logo_width,
				'flex-width'           => true,
				'flex-height'          => true,
				'unlink-homepage-logo' => true,
			)
		);
        add_theme_support('post-thumbnails');
    }
    add_action( 'after_setup_theme', 'themell_theme_support' );
}


//Adds dynamic menu options
function themell_menus(){

    $locations = array(
        'primary' => "Header menu",
        'footer' => "Footer Menu"
    );

    register_nav_menus($locations);
}

add_action('init','themell_menus');

//Inserts the stylesheets inside the header
function themell_register_styles(){

    $version = wp_get_theme()->get( 'Version' );
    wp_enqueue_style('themell-bootstrap', get_template_directory_uri() . "/assets/css/bootstrap.css", array(), '5.0.0', 'all');
    wp_enqueue_style('themell-style', get_template_directory_uri() . "/assets/css/style.css", array('themell-bootstrap'), $version, 'all');
    wp_enqueue_style('themell-w3', get_template_directory_uri() . "/assets/css/w3.css", array(), '4', 'all');
}

add_action( 'wp_enqueue_scripts', 'themell_register_styles');

//Inserts the jscript files inside the footer
function themell_register_scripts(){

    $version = wp_get_theme()->get( 'Version' );
    wp_enqueue_script('themell-bootstrap', get_template_directory_uri() . "/assets/js/bootstrap.min.js", array(), '5.0.0',true);
    wp_enqueue_script('themell-main', get_template_directory_uri() . "/assets/js/main.js", array(), $version,true);
}

add_action( 'wp_enqueue_scripts', 'themell_register_scripts');

function themell_widget_areas(){
    register_sidebar(
        array(
            'before_title' => '',
            'after_title' => '',
            'before_widget' => '',
            'after_widget' => '',
            'name' => 'Footer Area',
            'id' => 'footer-1',
            'description' => 'Here you can add some stuff that should be displayed in the footer of your website.',
        )
    );
}

add_action( 'widgets_init', 'themell_widget_areas');

/* Register Custom Navigation Walker*/
function register_navwalker(){
	require_once get_template_directory() . '/class-wp-bootstrap-navwalker.php';
}
add_action( 'after_setup_theme', 'register_navwalker' );

?>
