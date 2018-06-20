<?php
// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

// BEGIN ENQUEUE PARENT ACTION
// AUTO GENERATED - Do not modify or remove comment markers above or below:

if ( !function_exists( 'chld_thm_cfg_parent_css' ) ):
    function chld_thm_cfg_parent_css() {
        wp_enqueue_style( 'chld_thm_cfg_parent', trailingslashit( get_template_directory_uri() ) . 'style.css', array(  ) );
    }
endif;

add_action( 'wp_enqueue_scripts', 'argentchild_theme_stylesheets' );
function argentchild_theme_stylesheets() {
    wp_enqueue_style('argentchild-responsive', get_stylesheet_directory_uri() .'/css/responsive.min.css', array('css'));
    
    wp_enqueue_style('argentchild-carousel', get_stylesheet_directory_uri() .'/css/owl.carousel.css', array('css'));
    wp_enqueue_style('argentchild-meanmenu', get_stylesheet_directory_uri() .'/css/meanmenu.css', array('css'));
  
  
    wp_enqueue_style('argentchild-animate', get_stylesheet_directory_uri() .'/css/animate.css', array('css'));
  

}

add_action( 'wp_enqueue_scripts', function () {
    wp_enqueue_script( 'imagesloaded', '//cdnjs.cloudflare.com/ajax/libs/jquery.imagesloaded/4.1.3/imagesloaded.min.js', [ 'jquery' ], null, true );
    wp_enqueue_script( 'isotope', '//cdnjs.cloudflare.com/ajax/libs/jquery.isotope/3.0.4/isotope.pkgd.min.js', [ 'jquery' ], null, true );
    wp_enqueue_script( 'infinitescroll', '//cdnjs.cloudflare.com/ajax/libs/jquery-infinitescroll/2.1.0/jquery.infinitescroll.min.js', [ 'jquery' ], null, true );
}, 100 );


add_action( 'wp_enqueue_scripts', 'enqueue_load_fa' );
function enqueue_load_fa() {
  wp_enqueue_style( 'load-fa', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css' );
}


add_action( 'wp_enqueue_scripts', 'argentchild_enqueue_scripts' );
function argentchild_enqueue_scripts() {
    wp_register_script('count-to', get_stylesheet_directory_uri()  . '/js/jquery.countTo.js', array( 'jquery' ));
    wp_enqueue_script( 'count-to');
}



// END ENQUEUE PARENT ACTION
