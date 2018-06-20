<?php
/**
 * Service custom post type class.
 */

if ( ! class_exists( 'Pearl_Service_Post_type' ) ) {
	class Pearl_Service_Post_type {

		/**
		 * Register Service Post Type
		 * @since 1.0.0
		 */
		function register_service_post_type() {

			$labels = array(
				'name'                  => esc_html_x( 'Services', 'Post Type General Name', 'pearl-plugin' ),
				'singular_name'         => esc_html_x( 'Service', 'Post Type Singular Name', 'pearl-plugin' ),
				'menu_name'             => esc_html__( 'Services', 'pearl-plugin' ),
				'name_admin_bar'        => esc_html__( 'Service', 'pearl-plugin' ),
				'archives'              => esc_html__( 'Service Archives', 'pearl-plugin' ),
				'attributes'            => esc_html__( 'Service Attributes', 'pearl-plugin' ),
				'parent_item_colon'     => esc_html__( 'Parent Service:', 'pearl-plugin' ),
				'all_items'             => esc_html__( 'All Services', 'pearl-plugin' ),
				'add_new_item'          => esc_html__( 'Add New Service', 'pearl-plugin' ),
				'add_new'               => esc_html__( 'Add New', 'pearl-plugin' ),
				'new_item'              => esc_html__( 'New Service', 'pearl-plugin' ),
				'edit_item'             => esc_html__( 'Edit Service', 'pearl-plugin' ),
				'update_item'           => esc_html__( 'Update Service', 'pearl-plugin' ),
				'view_item'             => esc_html__( 'View Service', 'pearl-plugin' ),
				'view_items'            => esc_html__( 'View Services', 'pearl-plugin' ),
				'search_items'          => esc_html__( 'Search Service', 'pearl-plugin' ),
				'not_found'             => esc_html__( 'Not found', 'pearl-plugin' ),
				'not_found_in_trash'    => esc_html__( 'Not found in Trash', 'pearl-plugin' ),
				'insert_into_item'      => esc_html__( 'Insert into service', 'pearl-plugin' ),
				'uploaded_to_this_item' => esc_html__( 'Uploaded to this service', 'pearl-plugin' ),
				'items_list'            => esc_html__( 'Services list', 'pearl-plugin' ),
				'items_list_navigation' => esc_html__( 'Services list navigation', 'pearl-plugin' ),
				'filter_items_list'     => esc_html__( 'Filter services list', 'pearl-plugin' ),
			);

			$args = array(
				'label'               => esc_html__( 'Service', 'pearl-plugin' ),
				'description'         => esc_html__( 'Services or services list.', 'pearl-plugin' ),
				'labels'              => $labels,
				'supports'            => array( 'title' ),
				'hierarchical'        => false,
				'public'              => true,
				'show_ui'             => true,
				'show_in_menu'        => true,
				'menu_position'       => 5,
				'menu_icon'           => 'dashicons-admin-generic',
				'show_in_admin_bar'   => true,
				'show_in_nav_menus'   => false,
				'can_export'          => true,
				'has_archive'         => false,
				'exclude_from_search' => true,
				'publicly_queryable'  => false,
				'rewrite'             => false,
				'capability_type'     => 'post',
			);

			register_post_type( 'service', $args );

		}


		/**
		 * Register meta boxes related to this post type
		 *
		 * @param   array $meta_boxes
		 *
		 * @since   1.0.0
		 * @return  array   $meta_boxes
		 */
		public function register_meta_boxes( $meta_boxes ) {

			$prefix = 'pearl_service_';

			// Meta Box Array
			$meta_boxes[] = array(
				'id'       => 'service-meta-box',
				'title'    => esc_html__( 'Service Detail', 'pearl-plugin' ),
				'pages'    => array( 'service' ),
				'context'  => 'normal',
				'priority' => 'high',
				'fields'   => array(
					array(
						'name' => esc_html__( 'Description', 'pearl-plugin' ),
						'id'   => "{$prefix}description",
						'type' => 'textarea',
					),
					array(
						'type' => 'divider',
					),
					array(
						'name' => esc_html__( 'Button Text', 'pearl-plugin' ),
						'id'   => "{$prefix}button",
						'type' => 'text',
					),
					array(
						'name' => esc_html__( 'Button URL', 'pearl-plugin' ),
						'id'   => "{$prefix}button_url",
						'type' => 'text',
					)
				)
			);

			// apply a filter before returning meta boxes
			$meta_boxes = apply_filters( 'pearl_service_meta_boxes', $meta_boxes );

			return $meta_boxes;

		}

		/**
		 * Change title field placeholder
		 *
		 * @param   string $title
		 *
		 * @since   1.0.0
		 * @return  string   $title
		 */
		public function change_title_text( $title ) {
			$screen = get_current_screen();
			if ( 'service' == $screen->post_type ) {
				$title = esc_html__( 'Enter service title here', 'pearl-plugin' );
			}

			return $title;
		}
	}
}