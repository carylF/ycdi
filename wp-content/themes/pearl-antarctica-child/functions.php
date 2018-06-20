<?php

if ( ! function_exists( 'pearl_enqueue_child_styles' ) ) {
	/**
	 * Enqueue styles in the child theme
	 */
	function pearl_enqueue_child_styles() {
		if ( ! is_admin() ) {

			// dequeue and deregister parent default css
			wp_dequeue_style( 'parent-default' );
			wp_deregister_style( 'parent-default' );

			// dequeue parent custom css
			wp_dequeue_style( 'pearl-parent-custom' );

			// parent default css
			wp_enqueue_style( 'parent-default', get_template_directory_uri() . '/style.css' );

			// parent custom css
			wp_enqueue_style( 'pearl-parent-custom' );

			// child default css
			wp_enqueue_style( 'child-default', get_stylesheet_uri(), array( 'parent-default' ), '1.0.0', 'all' );

			// child custom css
			wp_enqueue_style( 'pearl-child-custom', get_stylesheet_directory_uri() . '/child-custom.css', array( 'child-default' ), '1.0.0', 'all' );
      
      wp_enqueue_style( 'pearl-child-custom-main', get_stylesheet_directory_uri() . '/css/main.css', array( 'css' ), '1.0.0', 'all' );
		}
	}
}
add_action( 'wp_enqueue_scripts', 'pearl_enqueue_child_styles', PHP_INT_MAX );


if ( ! function_exists( 'pearl_load_translation_from_child' ) ) {
	/**
	 * Load translation files from child theme
	 */
	function pearl_load_translation_from_child() {
		load_child_theme_textdomain( 'pearl-antarctica-child', get_stylesheet_directory() . '/languages' );
	}

	add_action( 'after_setup_theme', 'pearl_load_translation_from_child' );
}

add_action( 'wp_enqueue_scripts', 'enqueue_load_fa' );
function enqueue_load_fa() {
  wp_enqueue_style( 'load-fa', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css' );
}
