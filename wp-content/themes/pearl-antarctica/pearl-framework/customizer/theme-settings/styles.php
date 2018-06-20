<?php
/**
 * Customizer settings for Styles
 */
if ( ! function_exists( 'pearl_styles_customizer' ) ) :
	function pearl_styles_customizer( WP_Customize_Manager $wp_customize ) {

		/**
		 * Style Panel
		 */
		$wp_customize->add_panel(
			'pearl_styles_panel', array(
				'title' => 'Style',
				'priority' => 176
			)
		);

		/**
		 * General Section
		 */
		$wp_customize->add_section( 'pearl_general_styles_section', array(
			'title'    => esc_html__( 'General', 'pearl-antarctica' ),
			'panel'    => 'pearl_styles_panel'
		) );

		/**
		 * Header Section
		 */
		$wp_customize->add_section( 'pearl_header_styles_section', array(
			'title'    => esc_html__( 'Header', 'pearl-antarctica' ),
			'panel'    => 'pearl_styles_panel'
		) );

		/**
		 * Footer Section
		 */
		$wp_customize->add_section( 'pearl_footer_styles_section', array(
			'title'    => esc_html__( 'Footer', 'pearl-antarctica' ),
			'panel'    => 'pearl_styles_panel'
		) );

		$colors = array(
			'general_color'              => array( __( 'Theme Color', 'pearl-antarctica' ), '#04befc', 'pearl_general_styles_section' ),
			'body_text_color'            => array( __( 'Body Text Color', 'pearl-antarctica' ), '#444444', 'pearl_general_styles_section' ),
			'heading_color'              => array( __( 'Heading Text Color', 'pearl-antarctica' ), '#222222', 'pearl_general_styles_section' ),
			'link_color'                 => array( __( 'Link Text Color', 'pearl-antarctica' ), '#222222', 'pearl_general_styles_section' ),
			'link_hover_color'           => array( __( 'Link Text Hover Color', 'pearl-antarctica' ), '#04befc', 'pearl_general_styles_section' ),

			// Header Settings
//			'header_text_color'          => array( __( 'Header Text Color', 'pearl-antarctica' ), '#444444', 'pearl_header_styles_section' ),
//			'header_menu_color'          => array( __( 'Menu Text Color', 'pearl-antarctica' ), '#222222', 'pearl_header_styles_section' ),
//			'header_menu_hover_color'    => array( __( 'Menu Text Hover Color', 'pearl-antarctica' ), '#222222', 'pearl_header_styles_section' ),

			// Footer Settings
			'footer_text_color'          => array( __( 'Text Color', 'pearl-antarctica' ), '#999999', 'pearl_footer_styles_section' ),
			'footer_link_color'          => array( __( 'Link Color', 'pearl-antarctica' ), '#999999', 'pearl_footer_styles_section' ),
			'footer_link_hover'          => array( __( 'Link Hover Color', 'pearl-antarctica' ), '#04befc', 'pearl_footer_styles_section' ),
			'footer_bg_color'            => array( __( 'Background Color', 'pearl-antarctica' ), '#181819', 'pearl_footer_styles_section' ),
			'footer_widget_title_color'  => array( __( 'Widget Title Color', 'pearl-antarctica' ), '#ffffff', 'pearl_footer_styles_section' ),
//			'footer_widget_link_color'   => array( __( 'Widget Link Color', 'pearl-antarctica' ), '#999999', 'pearl_footer_styles_section' ),
//			'footer_widget_link_hover'   => array( __( 'Widget Link Hover Color', 'pearl-antarctica' ), '#ffffff', 'pearl_footer_styles_section' ),
			'footer_sub_bg_color'        => array( __( 'Footer Bottom Background Color', 'pearl-antarctica' ), '#111111', 'pearl_footer_styles_section' ),
		);

		foreach ( $colors as $id => $settings ) {

			$title   = $settings[0];
			$default = $settings[1];
			$section = $settings[2];

			$wp_customize->add_setting( $id, array(
				'type'              => 'option',
				'default'           => $default,
				'sanitize_callback' => 'sanitize_text_field'
			) );

			$wp_customize->add_control(
				new WP_Customize_Color_Control(
					$wp_customize, $id, array(
						'label'    => esc_html( $title ),
						'section'  => $section,
						'settings' => $id,
					)
				)
			);
		}
	}

	add_action( 'customize_register', 'pearl_styles_customizer' );
endif;

if ( ! function_exists( 'pearl_custom_css' ) ) {
	/**
	 *  return custom theme css
	 */
	function pearl_custom_css( $custom_css ) {

		$styles = array(
			array(
				'selector' => 'body',
				'property' => 'color',
				'value'    => get_option( 'body_text_color' )
			),
			array(
				'selector' => 'h1, h2, h3, h4, h5, h6, .h1, .h2, .h3, .h4, .h5, .h6',
				'property' => 'color',
				'value'    => get_option( 'heading_color' )
			),
			array(
				'selector' => 'a',
				'property' => 'color',
				'value'    => get_option( 'link_color' )
			),
			array(
				'selector' => 'a:hover, a:focus',
				'property' => 'color',
				'value'    => get_option( 'link_hover_color' )
			),
			array(
				'selector' => '.section-header .section-sub-title, .progress .progressed, .our-blog-1 .entry-footer a:hover, .form-group input[type="text"]:focus + .fa, .form-group input[type="email"]:focus + .fa, .form-group textarea:focus + .fa,
				.feature-box .section-sub-title, .our-portfolio-3 .filtering li a.is-checked, .our-portfolio-3 .filtering li a:hover, .accordion .accordion-sections.opened .fa-caret, .our-blog-2 .entry-footer a:hover, .testimonial-2 .author-info h5 span,
				.portfolio-content .portfolio-title a:hover, .menu-primary li.current-menu-item > a, .menu-primary li:hover > a, .menu-primary > ul li.current-menu-item > a, .menu-primary > ul li:hover > a, .header-three .search-toggle:hover, .header-four .search-toggle:hover, .header-one .search-toggle:hover,
				.flex-direction-nav a:hover, .btn-outline, .tabs-nav-list li.current, .tabs-4 .tabs-nav-list li.current, .accordion-three .accordion-sections.opened .accordion-header,
				.accordion-three .accordion-sections.opened .fa-caret:before, .widget_archive li:before, .widget_recent_entries li:before, .widget_categories li:before, .our-services-carousel .btn, .pearl_twitter_widget a,
				 .widget_recent_comments li:before, .widget_nav_menu li:before, .widget_meta li:before, .widget_pages li:before, .share-this-post > a:hover, .entry-share-this a:hover, .contacts a[href^="mailto"]',
				'property' => 'color',
				'value'    => get_option( 'general_color' )
			),
			array(
				'selector' => '#scroll-to-top, .line, .feature-item-1 .feature-content:hover .line, .img-hover, .our-team-1 .overlay, .call-to-action, .progress .completed, .contact-details .follow-us a:hover, input[type="submit"], .feature-item-3 .group span, .line-two > span:before, .line-two > span:after,
				.line-two:before, .line-two:after, .our-portfolio-3 .portfolio-content-wrapper, .our-team-2 .overlay a:hover, .header-menu-wrap, .intro-features .icon-wrap, .title-underline:after, .testimonial-2 .owl-theme .owl-dots .owl-dot.active span, .testimonial-2 .owl-theme .owl-dots .owl-dot:hover span,
				.video-popup .fa-play:hover, #show-slide-header .active, #show-slide-header:hover, .page-side-header .follow-us a:hover, .btn-primary, .tabs-2 .tabs-nav-list li.current, .tabs-2 .tab-content, .pearl_recent_posts_widget .post-thumb, .pearl_featured_posts_widget .post-thumb,
				.widget_tag_cloud a:hover, .sidebar .widget-title:after, .img-wrap, .services-item:hover .line, .post-cat, .format-quote blockquote, .entry-tags a:hover, .navigation .page-numbers > li > a:hover, .navigation .page-numbers > li > a.current, .navigation .page-numbers > li > span:hover, .navigation .page-numbers > li > span.current',
				'property' => 'background-color',
				'value'    => get_option( 'general_color' )
			),
			array(
				'selector' => '.our-services-carousel.owl-carousel .owl-dots .owl-dot.active span, .our-services-carousel.owl-carousel .owl-dots .owl-dot:hover span, .our-blog .entry-header,
				.feature-item-2 .feature-img, .contact-details .follow-us a:hover, .header-three, .header-four, .header-one, input[type="submit"], .flex-direction-nav a:hover, .our-services-carousel .btn,
				.btn-outline, .btn-primary, .tabs-4 .tabs-nav-list li.current, .widget_tag_cloud a:hover, .entry-tags a:hover, .contact-form input[type="text"]:focus:not(.error), .contact-form input[type="email"]:focus:not(.error), .contact-form input[type="url"]:focus:not(.error), .contact-form textarea:focus:not(.error),
				.navigation .page-numbers > li > a:hover, .navigation .page-numbers > li > a.current, .navigation .page-numbers > li > span:hover, .navigation .page-numbers > li > span.current',
				'property' => 'border-color',
				'value'    => get_option( 'general_color' )
			),
			array(
				'selector' => '.tabs-nav-list li.current',
				'property' => 'border-top-color',
				'value'    => get_option( 'general_color' )
			),


			// Header Settings
			array(
				'selector' => '.header-one .menu-primary > li.current-menu-item > a, .header-one .menu-primary > li:hover > a,
				',
				'property' => 'color',
				'value'    => get_option( 'header_menu_color' )
			),
			array(
				'selector' => '',
				'property' => 'color',
				'value'    => get_option( 'header_menu_hover_color' )
			),


			// Footer Settings
			array(
				'selector' => '.footer, .widget_calendar #wp-calendar tbody td, .pearl_recent_posts_widget .post-date, .pearl_featured_posts_widget .post-date, .pearl_twitter_widget .tweet-time',
				'property' => 'color',
				'value'    => get_option( 'footer_text_color' )
			),
			array(
				'selector' => '.footer a, .footer .widget_archive a, .footer .widget_recent_entries a, .footer .widget_categories a, .footer .widget_recent_comments a, .footer .widget_nav_menu a, .footer .widget_pages a, .footer .widget_meta a',
				'property' => 'color',
				'value'    => get_option( 'footer_link_color' )
			),
			array(
				'selector' => '.footer a:hover, .footer .widget_archive a:hover, .footer .widget_recent_entries a:hover, .footer .widget_categories a:hover, .footer .widget_recent_comments a:hover, .footer .widget_nav_menu a:hover,
				 .footer .widget_pages a:hover, .footer .widget_meta a:hover',
				'property' => 'color',
				'value'    => get_option( 'footer_link_hover' )
			),
			array(
				'selector' => '.footer',
				'property' => 'background-color',
				'value'    => get_option( 'footer_bg_color' )
			),
			array(
				'selector' => '.footer-widgets .widget-title',
				'property' => 'color',
				'value'    => get_option( 'footer_widget_title_color' )
			),
			array(
				'selector' => '.sub-footer',
				'property' => 'background-color',
				'value'    => get_option( 'footer_sub_bg_color' )
			),
		);

		foreach ( $styles as $style ) {
			$custom_css .= "{$style['selector']} {{$style['property']} : {$style['value']};}";
		}

		return $custom_css;
	}

	add_filter( 'pearl_inline_css', 'pearl_custom_css' );
}