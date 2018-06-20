<?php
/**
 * Customizer settings for Miscellaneous
 */

if ( ! function_exists( 'pearl_misc_customizer' ) ) :
	function pearl_misc_customizer( WP_Customize_Manager $wp_customize ) {


		/**
		 * Misc Section
		 */
		$wp_customize->add_section( 'pearl_misc_section', array(
			'title'    => esc_html__( 'Misc', 'pearl-antarctica' ),
			'priority' => 175
		) );

		// google map api key
		$wp_customize->add_setting( 'pearl_google_map_api_key', array(
			'type'              => 'option',
			'sanitize_callback' => 'sanitize_text_field'
		) );

		$wp_customize->add_control( 'pearl_google_map_api_key', array(
			'label'       => 'Google Map API Key',
			'description' => 'You can get your Google Maps API Key by <a href="https://developers.google.com/maps/documentation/javascript/get-api-key" target="_blank">clicking here</a>.',
			'section'     => 'pearl_misc_section',
			'settings'    => 'pearl_google_map_api_key',
			'type'        => 'text'
		) );
	}

	add_action( 'customize_register', 'pearl_misc_customizer' );
endif;