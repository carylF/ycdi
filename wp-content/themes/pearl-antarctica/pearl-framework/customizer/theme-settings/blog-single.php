<?php
/**
 * Customizer settings for blog single
 */

if ( ! function_exists( 'pearl_blog_single_customizer' ) ) :
	function pearl_blog_single_customizer( WP_Customize_Manager $wp_customize ) {


		/**
		 * BLog Single Section
		 */
		$wp_customize->add_section( 'pearl_blog_single_section', array(
			'title'    => esc_html__( 'Blog Single Page', 'pearl-antarctica' ),
			'priority' => 170
		) );


		// blog single page title
		$wp_customize->add_setting( 'pearl_blog_banner_title', array(
			'type'              => 'option',
			'default'           => esc_html__( 'Our Blog', 'pearl-antarctica' ),
			'sanitize_callback' => 'sanitize_text_field'
		) );

		$wp_customize->add_control(
			'pearl_blog_banner_title',
			array(
				'label'       => esc_html__( 'Banner Title', 'pearl-antarctica' ),
				'description' => esc_html__( 'If you leave this field empty "Our Blog" will be show as blog single page title.', 'pearl-antarctica' ),
				'section'     => 'pearl_blog_single_section',
				'settings'    => 'pearl_blog_banner_title',
				'type'        => 'text',
			)
		);

		// blog single page description
		$wp_customize->add_setting( 'pearl_blog_banner_description', array(
			'type'              => 'option',
			'sanitize_callback' => 'sanitize_text_field'
		) );

		$wp_customize->add_control(
			'pearl_blog_banner_description',
			array(
				'label'    => esc_html__( 'Banner Sub-Title / Description', 'pearl-antarctica' ),
				'section'  => 'pearl_blog_single_section',
				'settings' => 'pearl_blog_banner_description',
				'type'     => 'text',
			) );

		// separator
		$wp_customize->add_setting( 'pearl_blog_banner_description_separator', array(
			'sanitize_callback' => 'pearl_sanitize',
		) );
		$wp_customize->add_control(
			new Pearl_Separator_Control(
				$wp_customize,
				'pearl_blog_banner_description_separator',
				array(
					'section' => 'pearl_blog_single_section',
				)
			)
		);

		// banner image
		$wp_customize->add_setting( 'pearl_blog_banner_image', array(
			'type'              => 'option',
			'sanitize_callback' => 'esc_url'
		) );
		$wp_customize->add_control( new WP_Customize_Image_Control(
			$wp_customize,
			'pearl_blog_banner_image',
			array(
				'label'       => esc_html__( 'Banner Background Image', 'pearl-antarctica' ),
				'description' => esc_html__( 'Recommended minimum width is 2000px and minimum height is 400px.', 'pearl-antarctica' ),
				'section'     => 'pearl_blog_single_section',
				'settings'    => 'pearl_blog_banner_image'
			) ) );


		// separator
		$wp_customize->add_setting( 'pearl_blog_banner_image_separator', array(
			'sanitize_callback' => 'pearl_sanitize',
		) );
		$wp_customize->add_control(
			new Pearl_Separator_Control(
				$wp_customize,
				'pearl_blog_banner_image_separator',
				array(
					'section' => 'pearl_blog_single_section',
				)
			)
		);

		// banner space top
		$wp_customize->add_setting( 'pearl_blog_banner_padding', array(
			'type'              => 'option',
			'default'           => 184,
			'transport'         => 'postMessage',
			'sanitize_callback' => 'pearl_sanitize'
		) );
		$wp_customize->add_control(
			new WP_Customize_Range_Control(
				$wp_customize,
				'pearl_blog_banner_padding',
				array(
					'label'       => esc_html( 'Banner Top Space', 'pearl-antarctica' ),
					'description' => esc_html( 'This space option value will be applied above 1200px window size only (measurement is in pixels).', 'pearl-antarctica' ),
					'section'     => 'pearl_blog_single_section',
					'settings'    => 'pearl_blog_banner_padding',
					'input_attrs' => array(
						'min' => 10,
						'max' => 333,
					),
				)
			)
		);

		// banner space bottom
		$wp_customize->add_setting( 'pearl_blog_banner_padding_bottom', array(
			'type'              => 'option',
			'default'           => 100,
			'transport'         => 'postMessage',
			'sanitize_callback' => 'pearl_sanitize'
		) );
		$wp_customize->add_control(
			new WP_Customize_Range_Control(
				$wp_customize,
				'pearl_blog_banner_padding_bottom',
				array(
					'label'       => esc_html( 'Banner Bottom Space', 'pearl-antarctica' ),
					'section'     => 'pearl_blog_single_section',
					'settings'    => 'pearl_blog_banner_padding_bottom',
					'description' => esc_html( 'This space option value will be applied above 1200px window size only (measurement is in pixels).', 'pearl-antarctica' ),
					'input_attrs' => array(
						'min' => 10,
						'max' => 333,
					),
				)
			)
		);


		// banner overlay opacity
		$wp_customize->add_setting( 'pearl_blog_banner_overlay', array(
			'type'              => 'option',
			'default'           => 60,
			'transport'         => 'postMessage',
			'sanitize_callback' => 'pearl_sanitize'
		) );
		$wp_customize->add_control(
			new WP_Customize_Range_Control(
				$wp_customize,
				'pearl_blog_banner_overlay',
				array(
					'label'       => esc_html( 'Banner Overlay Opacity', 'pearl-antarctica' ),
					'section'     => 'pearl_blog_single_section',
					'settings'    => 'pearl_blog_banner_overlay',
					'description' => esc_html( 'Set a default banner overlay opacity (measurement is in percentage).', 'pearl-antarctica' ),
					'input_attrs' => array(
						'min' => 10,
						'max' => 100,
					),
				)
			)
		);
	}

	add_action( 'customize_register', 'pearl_blog_single_customizer' );
endif;