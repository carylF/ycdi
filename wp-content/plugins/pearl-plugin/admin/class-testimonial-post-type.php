<?php
/**
 * Testimonial custom post type class.
 */

if ( ! class_exists( 'Pearl_Testimonial_Post_type' ) ) {
	class Pearl_Testimonial_Post_type {

		/**
		 * Register Testimonial Post Type
		 * @since 1.0.0
		 */
		function register_testimonial_post_type() {

			$labels = array(
				'name'                  => esc_html_x( 'Testimonials', 'Post Type General Name', 'pearl-plugin' ),
				'singular_name'         => esc_html_x( 'Testimonial', 'Post Type Singular Name', 'pearl-plugin' ),
				'menu_name'             => esc_html__( 'Testimonials', 'pearl-plugin' ),
				'name_admin_bar'        => esc_html__( 'Testimonial', 'pearl-plugin' ),
				'archives'              => esc_html__( 'Testimonial Archives', 'pearl-plugin' ),
				'attributes'            => esc_html__( 'Testimonial Attributes', 'pearl-plugin' ),
				'parent_item_colon'     => esc_html__( 'Parent Testimonial:', 'pearl-plugin' ),
				'all_items'             => esc_html__( 'All Testimonials', 'pearl-plugin' ),
				'add_new_item'          => esc_html__( 'Add New Testimonial', 'pearl-plugin' ),
				'add_new'               => esc_html__( 'Add New', 'pearl-plugin' ),
				'new_item'              => esc_html__( 'New Testimonial', 'pearl-plugin' ),
				'edit_item'             => esc_html__( 'Edit Testimonial', 'pearl-plugin' ),
				'update_item'           => esc_html__( 'Update Testimonial', 'pearl-plugin' ),
				'view_item'             => esc_html__( 'View Testimonial', 'pearl-plugin' ),
				'view_items'            => esc_html__( 'View Testimonials', 'pearl-plugin' ),
				'search_items'          => esc_html__( 'Search Testimonial', 'pearl-plugin' ),
				'not_found'             => esc_html__( 'Not found', 'pearl-plugin' ),
				'not_found_in_trash'    => esc_html__( 'Not found in Trash', 'pearl-plugin' ),
				'featured_image'        => esc_html__( 'Author Photo', 'pearl-plugin' ),
				'set_featured_image'    => esc_html__( 'Set author photo', 'pearl-plugin' ),
				'remove_featured_image' => esc_html__( 'Remove author photo', 'pearl-plugin' ),
				'use_featured_image'    => esc_html__( 'Use as author photo', 'pearl-plugin' ),
				'insert_into_item'      => esc_html__( 'Insert into testimonial', 'pearl-plugin' ),
				'uploaded_to_this_item' => esc_html__( 'Uploaded to this testimonial', 'pearl-plugin' ),
				'items_list'            => esc_html__( 'Testimonials list', 'pearl-plugin' ),
				'items_list_navigation' => esc_html__( 'Testimonials list navigation', 'pearl-plugin' ),
				'filter_items_list'     => esc_html__( 'Filter testimonials list', 'pearl-plugin' ),
			);
			$args   = array(
				'label'               => esc_html__( 'Testimonial', 'pearl-plugin' ),
				'description'         => esc_html__( 'Users testimonials for the company or organisation.', 'pearl-plugin' ),
				'labels'              => $labels,
				'supports'            => array( 'title', 'editor', 'thumbnail', ),
				'hierarchical'        => false,
				'public'              => true,
				'show_ui'             => true,
				'show_in_menu'        => true,
				'menu_position'       => 5,
				'menu_icon'           => 'dashicons-testimonial',
				'show_in_admin_bar'   => true,
				'show_in_nav_menus'   => false,
				'can_export'          => true,
				'has_archive'         => false,
				'exclude_from_search' => true,
				'publicly_queryable'  => false,
				'rewrite'             => false,
				'capability_type'     => 'post',
			);
			register_post_type( 'testimonial', $args );

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

			$prefix = 'pearl_testimonial_';

			// Meta Box Array
			$meta_boxes[] = array(
				'id'       => 'testimonial-meta-box',
				'title'    => esc_html__( 'Testimonial Detail', 'pearl-plugin' ),
				'pages'    => array( 'testimonial' ),
				'context'  => 'normal',
				'priority' => 'high',
				'fields'   => array(
					array(
						'name' => esc_html__( 'Company', 'pearl-plugin' ),
						'desc' => esc_html__( 'Provide author company if available.', 'pearl-plugin' ),
						'id'   => "{$prefix}designation",
						'type' => 'text',
					)
				)
			);

			// apply a filter before returning meta boxes
			$meta_boxes = apply_filters( 'pearl_testimonial_meta_boxes', $meta_boxes );

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
			if ( 'testimonial' == $screen->post_type ) {
				$title = esc_html__( 'Enter author name here', 'pearl-plugin' );
			}

			return $title;
		}
	}
}