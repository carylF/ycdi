<?php
/**
 * Register meta boxes related to pages
 *
 * @param   array $meta_boxes
 *
 * @since   1.0.0
 * @return  array   $meta_boxes
 */

if ( ! function_exists( 'pearl_register_page_metaboxes' ) ) {

	function pearl_register_page_metaboxes( $meta_boxes ) {

		$prefix = 'pearl_';

		// Post Meta Box Settings
		$meta_boxes[] = array(
			'id'       => 'post-meta-box',
			'title'    => esc_html__( 'Video Information', 'pearl-antarctica' ),
			'pages'    => array( 'post' ),
			'context'  => 'normal',
			'priority' => 'high',
			'show'     => array(
				'template' => 'page-templates/contact.php'
			),
			'fields'   => array(
				array(
					'name' => esc_html__( 'Video URL', 'pearl-antarctica' ),
					'id'   => "{$prefix}video_url",
					'type' => 'url',
					'size' => '80'
				)
			)
		);

		// Page Meta Box Settings
		$meta_boxes[] = array(
			'id'       => 'page-meta-box',
			'title'    => esc_html__( 'Header Configuration', 'pearl-antarctica' ),
			'pages'    => array( 'page' ),
			'context'  => 'side',
			'priority' => 'low',
			'fields'   => array(
				array(
					'name'    => esc_html__( 'Header Type', 'pearl-antarctica' ),
					'id'      => "{$prefix}header_type",
					'type'    => 'select',
					'std'     => 'header_2',
					'options' => array(
						'header_1' => esc_html__( 'Header One', 'pearl-antarctica' ),
						'header_2' => esc_html__( 'Header Two', 'pearl-antarctica' ),
						'header_3' => esc_html__( 'Header Three', 'pearl-antarctica' ),
						'header_4' => esc_html__( 'Header Four', 'pearl-antarctica' ),
						'header_5' => esc_html__( 'Header Five', 'pearl-antarctica' ),
					)
				),
				array(
					'name'   => esc_html__( 'Enable Sticky Header', 'pearl-antarctica' ),
					'id'     => "{$prefix}sticky_header",
					'type'   => 'checkbox',
					'hidden' => [ 'pearl_header_type', '=', 'header_5' ]
				),
				array(
					'type' => 'divider'
				),
				array(
					'name'    => esc_html__( 'Under Header Display', 'pearl-antarctica' ),
					'id'      => "{$prefix}under_header",
					'type'    => 'select',
					'std'     => 'banner',
					'options' => array(
						'banner' => esc_html__( 'Banner', 'pearl-antarctica' ),
						'slider' => esc_html__( 'Slider', 'pearl-antarctica' ),
					)
				),
				array(
					'type' => 'divider'
				),
				array(
					'name'             => esc_html__( 'Logo Image', 'pearl-antarctica' ),
					'id'               => "{$prefix}logo_image",
					'type'             => 'image_advanced',
					'max_file_uploads' => 1,
				),
				array(
					'name'             => esc_html__( 'Retina Logo Image', 'pearl-antarctica' ),
					'id'               => "{$prefix}logo_image_retina",
					'type'             => 'image_advanced',
					'max_file_uploads' => 1,
				),
			)
		);

		// Show when woo-commerce is activated
		if ( is_woocommerce_activated() ) {

			// WooCommerce Shop Page Meta Box Settings
			$meta_boxes[] = array(
				'id'       => 'woocommerce-shop-page-layout-meta-box',
				'title'    => esc_html__( 'WooCommerce Page Layout', 'pearl-antarctica' ),
				'pages'    => array( 'page' ),
				'visible' => [ 'post_ID', absint( get_option( 'woocommerce_shop_page_id' ) ) ],
				'context'  => 'normal',
				'priority' => 'high',
				'fields'   => array(
					array(
						'name'    => esc_html__( 'Page Layout', 'pearl-antarctica' ),
						'id'      => "{$prefix}woocommerce_shop_page_layout",
						'type'    => 'select',
						'std'     => 'sidebar_left',
						'options' => array(
							'sidebar_left'  => esc_html__( 'Left Sidebar', 'pearl-antarctica' ),
							'sidebar_right' => esc_html__( 'Right Sidebar', 'pearl-antarctica' ),
							'full_width'    => esc_html__( 'Full Width', 'pearl-antarctica' ),
						)
					),
				)
			);
		}

		global $wp_registered_sidebars;
		$sidebars[''] = esc_html__( 'Choose a sidebar', 'pearl-antarctica' );

		foreach ( $wp_registered_sidebars as $sidebar ) {
			$sidebars[ $sidebar['id'] ] = $sidebar['name'];
		}

		// Sidebar Settings Meta-box
		$meta_boxes[] = array(
			'id'       => 'sidebar-settings-meta-box',
			'title'    => esc_html__( 'Sidebar (optional)', 'pearl-antarctica' ),
			'pages'    => array( 'post', 'page' ),
			'context'  => 'side',
			'priority' => 'low',
			'hide'     => array(
				'template' => array(
					'page-templates/contact.php',
					'page-templates/full-width.php',
					'page-templates/portfolio.php',
					'page-templates/visual-composer.php',
				),
			),
			'fields'   => array(
				array(
					'name'    => '',
					'id'      => "{$prefix}entry_sidebar",
					'desc'    => esc_html__( 'Choose a custom sidebar for this entry. Otherwise, default sidebar will be displayed.', 'pearl-antarctica' ),
					'type'    => 'select',
					'options' => $sidebars,

				),
			)
		);

		// Banner Meta Box Settings
		$meta_boxes[] = array(
			'id'       => 'banner-meta-box',
			'title'    => esc_html__( 'Banner Configuration', 'pearl-antarctica' ),
			'pages'    => array( 'page' ),
			'context'  => 'normal',
			'priority' => 'high',
			'show'     => array(
				'input_value' => array('#pearl_under_header' => "banner" ),
			),
			'fields'   => array(
				array(
					'name'             => esc_html__( 'Banner Image', 'pearl-antarctica' ),
					'id'               => "{$prefix}banner_image",
					'type'             => 'image_advanced',
					'max_file_uploads' => 1,
				),
				array(
					'name' => esc_html__( 'Banner Sub-Title / Description', 'pearl-antarctica' ),
					'id'   => "{$prefix}banner_description",
					'type' => 'text',
					'size' => '80'
				),
				array(
					'name' => esc_html__( 'Banner Top Space', 'pearl-antarctica' ),
					'desc' => esc_html__( 'Set banner top space.', 'pearl-antarctica' ),
					'id'   => "{$prefix}banner_padding",
					'type' => 'range',
					'std'  => '184',
					'min'  => '10',
					'max'  => '333'
				),
				array(
					'name' => esc_html__( 'Banner Bottom Space', 'pearl-antarctica' ),
					'desc' => esc_html__( 'Set banner bottom space.', 'pearl-antarctica' ),
					'id'   => "{$prefix}banner_padding_bottom",
					'type' => 'range',
					'std'  => '184',
					'min'  => '10',
					'max'  => '333'
				),
				array(
					'name' => esc_html__( 'Banner Overlay Opacity', 'pearl-antarctica' ),
					'id'   => "{$prefix}banner_opacity",
					'type' => 'range',
					'std'  => '60',
					'min'  => '10',
					'max'  => '100'
				),
			)
		);

		// Slider Meta Box Settings
		$meta_boxes[] = array(
			'id'       => 'slider-meta-box',
			'title'    => esc_html__( 'Slider Configuration', 'pearl-antarctica' ),
			'pages'    => array( 'page' ),
			'context'  => 'normal',
			'priority' => 'high',
			'show'     => array(
				'input_value' => array('#pearl_under_header' => "slider" ),
			),
			'fields'   => array(
				array(
					'name'    => esc_html__( 'Slider Type', 'pearl-antarctica' ),
					'id'      => "{$prefix}slider_type",
					'type'    => 'select',
					'std'     => 'one',
					'options' => array(
						'one'   => esc_html__( 'One', 'pearl-antarctica' ),
						'two'   => esc_html__( 'Two', 'pearl-antarctica' ),
						'three' => esc_html__( 'Three', 'pearl-antarctica' ),
						'four'  => esc_html__( 'Four', 'pearl-antarctica' ),
						'five'  => esc_html__( 'Five', 'pearl-antarctica' ),
					)
				),
				array(
					'type' => 'divider'
				),
				array(
					'name'    => esc_html__( 'Slider Slides', 'pearl-antarctica' ),
					'id'         => "{$prefix}slides",
					'type'       => 'group',
					'clone'      => true,
					'sort_clone' => true,
					'fields'     => array(

						array(
							'name' => esc_html__( 'Smart Title', 'pearl-antarctica' ),
							'id'   => "{$prefix}slide_smart_title",
							'type' => 'text',
							'size' => '50'
						),
						array(
							'name' => esc_html__( 'Title', 'pearl-antarctica' ),
							'id'   => "{$prefix}slide_title",
							'type' => 'text',
							'size' => '50'
						),
						array(
							'name' => esc_html__( 'Sub Title', 'pearl-antarctica' ),
							'id'   => "{$prefix}slide_sub_title",
							'type' => 'text',
							'size' => '50',
							'visible' => ['pearl_slider_type', '=', 'five']
						),
						array(
							'name' => esc_html__( 'Description', 'pearl-antarctica' ),
							'id'   => "{$prefix}slide_description",
							'type' => 'textarea',
						),
						array(
							'type' => 'divider'
						),
						array(
							'name'    => esc_html__( 'Left Button Text', 'pearl-antarctica' ),
							'id'      => "{$prefix}slide_left_btn_text",
							'type'    => 'text',
							'columns' => '6'
						),
						array(
							'name'    => esc_html__( 'Right Button Text', 'pearl-antarctica' ),
							'id'      => "{$prefix}slide_right_btn_text",
							'type'    => 'text',
							'columns' => '6'
						),
						array(
							'name'    => esc_html__( 'Left Button URL', 'pearl-antarctica' ),
							'id'      => "{$prefix}slide_left_btn_url",
							'type'    => 'text',
							'columns' => '6'
						),
						array(
							'name'    => esc_html__( 'Right Button URL', 'pearl-antarctica' ),
							'id'      => "{$prefix}slide_right_btn_url",
							'type'    => 'text',
							'columns' => '6'
						),
						array(
							'type' => 'divider'
						),
						array(
							'name'             => esc_html__( 'Slide Image', 'pearl-antarctica' ),
							'id'               => "{$prefix}slide_image",
							'type'             => 'image_advanced',
							'max_file_uploads' => 1,
						),
					)
				),
			)
		);

		// Contact Page Meta Box Settings
		$meta_boxes[] = array(
			'id'          => 'contact-meta-box',
			'title'       => esc_html__( 'Contact Information', 'pearl-antarctica' ),
			'pages'       => array( 'page' ),
			'context'     => 'normal',
			'priority'    => 'high',
			// Show this meta box for posts matched below conditions
			'show'        => array(
				'template' => 'page-templates/contact.php'
			),
			'tabs'        => array(
				'form'   => array(
					'label' => esc_html__( 'Contact Form', 'pearl-antarctica' ),
					'icon'  => 'dashicons-email',
				),
				'detail' => array(
					'label' => esc_html__( 'Detail', 'pearl-antarctica' ),
					'icon'  => 'dashicons-id-alt',
				),
				'map'    => array(
					'label' => esc_html__( 'Map', 'pearl-antarctica' ),
					'icon'  => 'dashicons-location-alt',
				)

			),
			'tab_style'   => 'left',
			'tab_wrapper' => true,
			'fields'      => array(

				// contact form section
				array(
					'name' => esc_html__( 'Form Title', 'pearl-antarctica' ),
					'id'   => "{$prefix}form_title",
					'type' => 'text',
					'tab'  => 'form'
				),
				array(
					'name' => esc_html__( 'Target Email', 'pearl-antarctica' ),
					'desc' => esc_html__( 'Please provide an email address where you would like to receive the contact form requests.', 'pearl-antarctica' ),
					'id'   => "{$prefix}form_email",
					'type' => 'text',
					'tab'  => 'form'
				),
				array(
					'name' => esc_html__( 'Contact Form Shortcode', 'pearl-antarctica' ),
					'desc' => wp_kses( __( 'If you want to use an alternative contact form e.g <a href="https://wordpress.org/plugins/contact-form-7/" target="_blank">Contact form 7</a>, then you can provide its shortcode here.', 'pearl-antarctica' ), array(
						'a' => array(
							'href'   => array(),
							'target' => array()
						)
					) ),
					'id'   => "{$prefix}form_shortcode",
					'type' => 'text',
					'tab'  => 'form'
				),

				// contact detail section
				array(
					'name' => esc_html__( 'Detail Title', 'pearl-antarctica' ),
					'id'   => "{$prefix}detail_title",
					'type' => 'text',
					'tab'  => 'detail',
					'size' => '78'
				),
				array(
					'name' => esc_html__( 'Contact Detail Description', 'pearl-antarctica' ),
					'id'   => "{$prefix}detail_description",
					'type' => 'textarea',
					'tab'  => 'detail'
				),
				array(
					'name' => esc_html__( 'Address', 'pearl-antarctica' ),
					'id'   => "{$prefix}detail_address",
					'type' => 'textarea',
					'tab'  => 'detail'
				),
				array(
					'name'       => esc_html__( 'Contact Numbers', 'pearl-antarctica' ),
					'id'         => "{$prefix}detail_numbers",
					// Group field
					'type'       => 'group',
					// Clone whole group?
					'clone'      => true,
					// Drag and drop clones to reorder them?
					'sort_clone' => true,
					'tab'        => 'detail',
					// Sub-fields
					'fields'     => array(
						array(
							'name'    => esc_html__( 'Number', 'pearl-antarctica' ),
							'id'      => "{$prefix}number",
							'columns' => 6,
							'type'    => 'text',
							'size'    => '34'
						),
						array(
							'name'    => esc_html__( 'Label', 'pearl-antarctica' ),
							'id'      => "{$prefix}label",
							'columns' => 6,
							'type'    => 'text',
							'size'    => '34'
						)
					)
				),
				array(
					'name'       => esc_html__( 'Email Address', 'pearl-antarctica' ),
					'id'         => "{$prefix}detail_emails",
					// Group field
					'type'       => 'group',
					// Clone whole group?
					'clone'      => true,
					// Drag and drop clones to reorder them?
					'sort_clone' => true,
					'tab'        => 'detail',
					// Sub-fields
					'fields'     => array(
						array(
							'name' => esc_html__( 'Email', 'pearl-antarctica' ),
							'id'   => "{$prefix}email",
							'type' => 'text',
							'size' => '40'
						)
					)
				),
				array(
					'type' => 'heading',
					'name' => esc_html__( 'Social Profile Links', 'pearl-antarctica' ),
					'desc' => esc_html__( 'Provide the social profile links into the related fields given below.', 'pearl-antarctica' ),
					'tab'  => 'detail'
				),
				array(
					'name' => esc_html__( 'Facebook', 'pearl-antarctica' ),
					'id'   => "{$prefix}facebook_profile",
					'type' => 'url',
					'tab'  => 'detail'
				),
				array(
					'name' => esc_html__( 'Google+', 'pearl-antarctica' ),
					'id'   => "{$prefix}google_profile",
					'type' => 'url',
					'tab'  => 'detail'
				),
				array(
					'name' => esc_html__( 'Twitter', 'pearl-antarctica' ),
					'id'   => "{$prefix}twitter_profile",
					'type' => 'url',
					'tab'  => 'detail'
				),
				array(
					'name' => esc_html__( 'Linkedin', 'pearl-antarctica' ),
					'id'   => "{$prefix}linkedin_profile",
					'type' => 'url',
					'tab'  => 'detail'
				),
				array(
					'name' => esc_html__( 'Instagram', 'pearl-antarctica' ),
					'id'   => "{$prefix}instagram_profile",
					'type' => 'url',
					'tab'  => 'detail'
				),
				array(
					'name' => esc_html__( 'Pinterest', 'pearl-antarctica' ),
					'id'   => "{$prefix}pinterest_profile",
					'type' => 'url',
					'tab'  => 'detail'
				),

				// contact map section
				array(
					'name'    => esc_html__( 'Map Display', 'pearl-antarctica' ),
					'id'      => "{$prefix}map_display",
					'std'     => 'show',
					'type'    => 'radio',
					'tab'     => 'map',
					'options' => array(
						'show' => esc_html__( 'Show', 'pearl-antarctica' ),
						'hide' => esc_html__( 'Hide', 'pearl-antarctica' ),
					),
				),
				array(
					'name' => esc_html__( 'Map Latitude', 'pearl-antarctica' ),
					'id'   => "{$prefix}map_lat",
					'std'  => 40.715923,
					'type' => 'text',
					'tab'  => 'map'
				),
				array(
					'name' => esc_html__( 'Map Longitude', 'pearl-antarctica' ),
					'id'   => "{$prefix}map_long",
					'std'  => - 74.008924,
					'type' => 'text',
					'tab'  => 'map'
				),
				array(
					'name' => esc_html__( 'Map Zoom', 'pearl-antarctica' ),
					'id'   => "{$prefix}map_zoom",
					'std'  => 11,
					'type' => 'number',
					'tab'  => 'map'
				),
			)
		);

		// apply a filter before returning meta boxes
		$meta_boxes = apply_filters( 'pearl_page_meta_boxes', $meta_boxes );

		return $meta_boxes;

	}

	add_filter( 'rwmb_meta_boxes', 'pearl_register_page_metaboxes' );
}

