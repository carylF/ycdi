<?php
/**
 * Customizer settings for Header
 */

if ( ! function_exists( 'pearl_header_customizer' ) ) :
	function pearl_header_customizer( WP_Customize_Manager $wp_customize ) {

		/**
		 * Site Identity (logo)
		 */
		$wp_customize->add_setting( 'pearl_site_logo', array(
			'type'              => 'option',
			'sanitize_callback' => 'esc_url_raw',
		) );
		$wp_customize->add_control( new WP_Customize_Image_Control(
			$wp_customize,
			'pearl_site_logo',
			array(
				'label'    => esc_html__( 'Site Logo', 'pearl-antarctica' ),
				'section'  => 'title_tagline',
				// id of site identity section - Ref: https://developer.wordpress.org/themes/advanced-topics/customizer-api/
				'settings' => 'pearl_site_logo',
				'priority' => 100,
			) ) );

		/**
		 * Site Identity ( retina logo)
		 */
		$wp_customize->add_setting( 'pearl_site_logo_retina', array(
			'type'              => 'option',
			'sanitize_callback' => 'esc_url_raw',
		) );
		$wp_customize->add_control( new WP_Customize_Image_Control(
			$wp_customize,
			'pearl_site_logo_retina',
			array(
				'label'       => esc_html__( 'Site Retina Logo', 'pearl-antarctica' ),
				'description' => esc_html__( 'Upload double size of your default logo image. For example, if your default logo image size is 185px by 24px then your retina logo image size should be 370px by 48px.', 'pearl-antarctica' ),
				'section'     => 'title_tagline',
				'settings'    => 'pearl_site_logo_retina',
				'priority'    => 110,
			) ) );


		/* Separator */
		$wp_customize->add_setting( 'pearl_site_loader_display_separator', array(
			'sanitize_callback' => 'pearl_sanitize',
		) );
		$wp_customize->add_control(
			new Pearl_Separator_Control(
				$wp_customize,
				'pearl_site_loader_display_separator',
				array(
					'section'  => 'title_tagline',
					'priority' => 111,
				)
			)
		);

		/**
		 * Site Identity (loader)
		 */
		$wp_customize->add_setting( 'pearl_site_loader_display', array(
			'type'              => 'option',
			'default'           => 'show',
			'sanitize_callback' => 'sanitize_text_field',
		) );
		$wp_customize->add_control( new Pearl_Dropdown_Control(
			$wp_customize,
			'pearl_site_loader_display',
			array(
				'label'    => esc_html__( 'Site Loader', 'pearl-antarctica' ),
				'section'  => 'title_tagline',
				'settings' => 'pearl_site_loader_display',
				'choices'  => array(
					'show' => 'Show',
					'hide' => 'Hide',
				),
				'priority' => 115,
			)
		) );

		// loader type
		$wp_customize->add_setting( 'pearl_site_loader_type', array(
			'type'              => 'option',
			'default'           => 'spinner1',
			'sanitize_callback' => 'sanitize_text_field',
		) );
		$wp_customize->add_control( new Pearl_Dropdown_Control(
			$wp_customize,
			'pearl_site_loader_type',
			array(
				'label'    => esc_html__( 'Loader Style', 'pearl-antarctica' ),
				'section'  => 'title_tagline',
				'settings' => 'pearl_site_loader_type',
				'choices'  => array(
					'spinner1' => esc_html__( 'First', 'pearl-antarctica' ),
					'spinner2' => esc_html__( 'Second', 'pearl-antarctica' ),
					'spinner3' => esc_html__( 'Third', 'pearl-antarctica' ),
					'spinner4' => esc_html__( 'Fourth', 'pearl-antarctica' ),
					'spinner5' => esc_html__( 'Fifth', 'pearl-antarctica' ),
					'spinner6' => esc_html__( 'Sixth', 'pearl-antarctica' ),
					'spinner7' => esc_html__( 'Seventh', 'pearl-antarctica' )
				),
				'priority' => 115,
			)
		) );

		// loader background color
		$wp_customize->add_setting( 'pearl_site_loader_background', array(
			'type'              => 'option',
			'default'           => '#04befc',
			'sanitize_callback' => 'sanitize_text_field'
		) );
		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				'pearl_site_loader_background',
				array(
					'label'    => esc_html__( 'Background Color', 'pearl-antarctica' ),
					'section'  => 'title_tagline',
					'settings' => 'pearl_site_loader_background',
					'priority' => 120,
				)
			)
		);

		// loader image (optional)
//		$wp_customize->add_setting( 'pearl_site_loader_image', array(
//			'type'              => 'option',
//			'sanitize_callback' => 'esc_url_raw',
//		) );
//		$wp_customize->add_control( new WP_Customize_Image_Control(
//			$wp_customize,
//			'pearl_site_loader_image',
//			array(
//				'label'       => esc_html__( 'Loader Icon (optional)', 'pearl-antarctica' ),
//				'description' => esc_html__( 'You can upload a custom icon image to replace default loader spinner.', 'pearl-antarctica' ),
//				'section'     => 'title_tagline',
//				'settings'    => 'pearl_site_loader_image',
//				'priority'    => 130,
//			)
//		) );

		/**
		 * Header Top Bar Panel
		 */
		$wp_customize->add_panel(
			'pearl_header_panel',
			array(
				'title' => 'Header'
			)
		);

		/**
		 * Header Others Section
		 */
		$wp_customize->add_section( 'pearl_header_others_section', array(
			'title'    => esc_html__( 'General ', 'pearl-antarctica' ),
			'panel'    => 'pearl_header_panel',
		) );

		/**
		 * Header Banner Section
		 */
		$wp_customize->add_section( 'pearl_header_banner_section', array(
			'title'    => esc_html__( 'Banner', 'pearl-antarctica' ),
			'panel'    => 'pearl_header_panel',
		) );

		/**
		 * Header Social Links Section
		 */
		$wp_customize->add_section( 'pearl_header_social_links_section', array(
			'title'    => esc_html__( 'Social Links', 'pearl-antarctica' ),
			'panel'    => 'pearl_header_panel',
		) );

		// banner image
		$wp_customize->add_setting( 'pearl_banner_image', array(
			'type'              => 'option',
			'sanitize_callback' => 'esc_url'
		) );
		$wp_customize->add_control( new WP_Customize_Image_Control(
			$wp_customize,
			'pearl_banner_image',
			array(
				'label'       => esc_html__( 'Banner Background Image', 'pearl-antarctica' ),
				'description' => esc_html__( 'Recommended minimum width is 2000px and minimum height is 400px.', 'pearl-antarctica' ),
				'section'     => 'pearl_header_banner_section',
				'settings'    => 'pearl_banner_image'
			) ) );


		// separator
		$wp_customize->add_setting( 'pearl_banner_image_separator', array(
			'sanitize_callback' => 'pearl_sanitize',
		) );
		$wp_customize->add_control(
			new Pearl_Separator_Control(
				$wp_customize,
				'pearl_banner_image_separator',
				array(
					'section' => 'pearl_header_banner_section',
				)
			)
		);

		// page title on banner image
		$wp_customize->add_setting( 'pearl_banner_page_title', array(
			'type'              => 'option',
			'default'           => 'show',
			'sanitize_callback' => 'pearl_sanitize'
		) );

		$wp_customize->add_control( new Pearl_Dropdown_Control(
			$wp_customize,
			'pearl_banner_page_title',
			array(
				'label'    => esc_html__( 'Page Title on Banner Image', 'pearl-antarctica' ),
				'section'  => 'pearl_header_banner_section',
				'settings' => 'pearl_banner_page_title',
				'choices'  => array(
					'show' => 'Show',
					'hide' => 'Hide',
				)
			)
		) );

		// social icons
		$wp_customize->add_setting( 'pearl_header_social_links', array(
			'type'              => 'option',
			'default'           => 'show',
			'sanitize_callback' => 'pearl_sanitize'
		) );

		$wp_customize->add_control( new Pearl_Dropdown_Control(
			$wp_customize,
			'pearl_header_social_links',
			array(
				'label'    => esc_html__( 'Social Links', 'pearl-antarctica' ),
				'section'  => 'pearl_header_social_links_section',
				'settings' => 'pearl_header_social_links',
				'choices'  => array(
					'show' => 'Show',
					'hide' => 'Hide',
				)
			)
		) );

		// separator
		$wp_customize->add_setting( 'pearl_social_links_separator', array(
			'sanitize_callback' => 'pearl_sanitize',
		) );
		$wp_customize->add_control(
			new Pearl_Separator_Control(
				$wp_customize,
				'pearl_social_links_separator',
				array(
					'section' => 'pearl_header_social_links_section',
				)
			)
		);

		/* Facebook URL */
		$wp_customize->add_setting( 'pearl_facebook_url', array (
			'type'              => 'option',
			'sanitize_callback' => 'esc_url_raw',
		) );
		$wp_customize->add_control( 'pearl_facebook_url', array (
			'label' => esc_html__( 'Facebook URL', 'pearl-antarctica' ),
			'type' => 'url',
			'section' => 'pearl_header_social_links_section',			
		) );

		/* Twitter URL */
		$wp_customize->add_setting( 'pearl_twitter_url', array (
			'type'              => 'option',
			'sanitize_callback' => 'esc_url_raw',
		) );
		$wp_customize->add_control( 'pearl_twitter_url', array (
			'label' => esc_html__( 'Twitter URL', 'pearl-antarctica' ),
			'type' => 'url',
			'section' => 'pearl_header_social_links_section',			
		) );

		/* Google Plus URL */
		$wp_customize->add_setting( 'pearl_google_url', array (
			'type'              => 'option',
			'sanitize_callback' => 'esc_url_raw',
		) );
		$wp_customize->add_control( 'pearl_google_url', array (
			'label' => esc_html__( 'Google Plus URL', 'pearl-antarctica' ),
			'type' => 'url',
			'section' => 'pearl_header_social_links_section',
		) );

		/* LinkedIn URL */
		$wp_customize->add_setting( 'pearl_linkedin_url', array (
			'type'              => 'option',
			'sanitize_callback' => 'esc_url_raw',
		) );
		$wp_customize->add_control( 'pearl_linkedin_url', array (
			'label' => esc_html__( 'LinkedIn URL', 'pearl-antarctica' ),
			'type' => 'url',
			'section' => 'pearl_header_social_links_section',			
		) );

		/* Pinterest URL */
		$wp_customize->add_setting( 'pearl_pinterest_url', array (
			'type'              => 'option',
			'sanitize_callback' => 'esc_url_raw',
		) );
		$wp_customize->add_control( 'pearl_pinterest_url', array (
			'label' => esc_html__( 'Pinterest URL', 'pearl-antarctica' ),
			'type' => 'url',
			'section' => 'pearl_header_social_links_section',
		) );

		/* Instagram URL */
		$wp_customize->add_setting( 'pearl_instagram_url', array (
			'type'              => 'option',
			'sanitize_callback' => 'esc_url_raw',
		) );
		$wp_customize->add_control( 'pearl_instagram_url', array (
			'label' => esc_html__( 'Instagram URL', 'pearl-antarctica' ),
			'type' => 'url',
			'section' => 'pearl_header_social_links_section',			
		) );

		/* Skype Username */
		$wp_customize->add_setting( 'pearl_skype_username', array (
			'type'              => 'option',
			'sanitize_callback' => 'sanitize_text_field',
		) );
		$wp_customize->add_control( 'pearl_skype_username', array (
			'label' => esc_html__( 'Skype Username', 'pearl-antarctica' ),
			'type' => 'text',
			'section' => 'pearl_header_social_links_section',			
		) );


		// Sticky Header
		$wp_customize->add_setting( 'pearl_sticky_header', array (
			'type'              => 'option',
			'sanitize_callback' => 'sanitize_text_field',
		) );
		$wp_customize->add_control( 'pearl_sticky_header', array (
			'label' => esc_html__( 'Enable Sticky Header ', 'pearl-antarctica' ),
			'type' => 'checkbox',
			'section' => 'pearl_header_others_section',
		) );

		// separator
		$wp_customize->add_setting( 'pearl_header_others_section_separator', array(
			'sanitize_callback' => 'pearl_sanitize',
		) );
		$wp_customize->add_control(
			new Pearl_Separator_Control(
				$wp_customize,
				'pearl_header_others_section_separator',
				array(
					'section' => 'pearl_header_others_section',
				)
			)
		);

		// search form in the header
		$wp_customize->add_setting( 'pearl_header_search', array(
			'type'              => 'option',
			'default'           => 'show',
			'sanitize_callback' => 'pearl_sanitize'
		) );

		$wp_customize->add_control( new Pearl_Dropdown_Control(
			$wp_customize,
			'pearl_header_search',
			array(
				'label'    => esc_html__( 'Search Form in Header', 'pearl-antarctica' ),
				'section'  => 'pearl_header_others_section',
				'settings' => 'pearl_header_search',
				'choices'  => array(
					'show' => 'Show',
					'hide' => 'Hide',
				)
			)
		) );
	}

	add_action( 'customize_register', 'pearl_header_customizer' );
endif;