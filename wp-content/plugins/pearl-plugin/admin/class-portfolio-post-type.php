<?php
/**
 * Portfolio custom post type class.
 */

if ( ! class_exists( 'Pearl_Portfolio_Post_type' ) ) {
	class Pearl_Portfolio_Post_type {

		/**
		 * Register Portfolio Post Type
		 * @since 1.0.0
		 */
		public function register_portfolio_post_type() {

			$labels = array(
				'name'                  => esc_html_x( 'Portfolio Items', 'Post Type General Name', 'pearl-plugin' ),
				'singular_name'         => esc_html_x( 'Portfolio Item', 'Post Type Singular Name', 'pearl-plugin' ),
				'menu_name'             => esc_html__( 'Portfolio', 'pearl-plugin' ),
				'name_admin_bar'        => esc_html__( 'Portfolio Item', 'pearl-plugin' ),
				'archives'              => esc_html__( 'Portfolio Item Archives', 'pearl-plugin' ),
				'attributes'            => esc_html__( 'Portfolio Item Attributes', 'pearl-plugin' ),
				'parent_item_colon'     => esc_html__( 'Parent Portfolio Item:', 'pearl-plugin' ),
				'all_items'             => esc_html__( 'All Portfolio Items', 'pearl-plugin' ),
				'add_new_item'          => esc_html__( 'Add New Portfolio Item', 'pearl-plugin' ),
				'add_new'               => esc_html__( 'Add New Item', 'pearl-plugin' ),
				'new_item'              => esc_html__( 'New Portfolio Item', 'pearl-plugin' ),
				'edit_item'             => esc_html__( 'Edit Portfolio Item', 'pearl-plugin' ),
				'update_item'           => esc_html__( 'Update Portfolio Item', 'pearl-plugin' ),
				'view_item'             => esc_html__( 'View Portfolio Item', 'pearl-plugin' ),
				'view_items'            => esc_html__( 'View Portfolio Items', 'pearl-plugin' ),
				'search_items'          => esc_html__( 'Search Portfolio Item', 'pearl-plugin' ),
				'not_found'             => esc_html__( 'Not found', 'pearl-plugin' ),
				'not_found_in_trash'    => esc_html__( 'Not found in Trash', 'pearl-plugin' ),
				'featured_image'        => esc_html__( 'Project Image', 'pearl-plugin' ),
				'set_featured_image'    => esc_html__( 'Set Project image', 'pearl-plugin' ),
				'remove_featured_image' => esc_html__( 'Remove Portfolio Item image', 'pearl-plugin' ),
				'use_featured_image'    => esc_html__( 'Use as Portfolio Item image', 'pearl-plugin' ),
				'insert_into_item'      => esc_html__( 'Insert into Portfolio Item', 'pearl-plugin' ),
				'uploaded_to_this_item' => esc_html__( 'Uploaded to this Portfolio Item', 'pearl-plugin' ),
				'items_list'            => esc_html__( 'Portfolio Items list', 'pearl-plugin' ),
				'items_list_navigation' => esc_html__( 'Portfolio Items list navigation', 'pearl-plugin' ),
				'filter_items_list'     => esc_html__( 'Filter Portfolio Items list', 'pearl-plugin' ),
			);

			$rewrite = array(
				'slug'       => 'portfolio-item',
				'with_front' => true,
				'pages'      => true,
				'feeds'      => true,
			);

			$args = array(
				'label'               => esc_html__( 'Portfolio Item', 'pearl-plugin' ),
				'description'         => esc_html__( 'A sample post type to help in developing custom post types in future themes.', 'pearl-plugin' ),
				'labels'              => $labels,
				'supports'            => array( 'title', 'editor', 'thumbnail', 'revisions' ),
				'taxonomies'          => array( 'network' ),
				'hierarchical'        => false,
				'public'              => true,
				'show_ui'             => true,
				'show_in_menu'        => true,
				'menu_position'       => 5,
				'menu_icon'           => 'dashicons-portfolio',
				'show_in_admin_bar'   => true,
				'show_in_nav_menus'   => true,
				'can_export'          => true,
				'has_archive'         => true,
				'exclude_from_search' => true,
				'publicly_queryable'  => true,
				'capability_type'     => 'post',
				'rewrite'             => $rewrite
			);
			register_post_type( 'portfolio', $args );

		}

		/**
		 * Register Portfolio Category Taxonomy
		 * @since 1.0.0
		 */
		function register_project_category() {

			$labels = array(
				'name'                       => esc_html_x( 'Project Categories', 'Taxonomy General Name', 'pearl-plugin' ),
				'singular_name'              => esc_html_x( 'Project Category', 'Taxonomy Singular Name', 'pearl-plugin' ),
				'menu_name'                  => esc_html__( 'Project Categories', 'pearl-plugin' ),
				'all_items'                  => esc_html__( 'All Categories', 'pearl-plugin' ),
				'parent_item'                => esc_html__( 'Parent Category', 'pearl-plugin' ),
				'parent_item_colon'          => esc_html__( 'Parent Category:', 'pearl-plugin' ),
				'new_item_name'              => esc_html__( 'New Category Name', 'pearl-plugin' ),
				'add_new_item'               => esc_html__( 'Add New Category', 'pearl-plugin' ),
				'edit_item'                  => esc_html__( 'Edit Category', 'pearl-plugin' ),
				'update_item'                => esc_html__( 'Update Category', 'pearl-plugin' ),
				'view_item'                  => esc_html__( 'View Category', 'pearl-plugin' ),
				'separate_items_with_commas' => esc_html__( 'Separate Categories with commas', 'pearl-plugin' ),
				'add_or_remove_items'        => esc_html__( 'Add or remove Categories', 'pearl-plugin' ),
				'choose_from_most_used'      => esc_html__( 'Choose from the most used', 'pearl-plugin' ),
				'popular_items'              => esc_html__( 'Popular Categories', 'pearl-plugin' ),
				'search_items'               => esc_html__( 'Search Categories', 'pearl-plugin' ),
				'not_found'                  => esc_html__( 'Not Found', 'pearl-plugin' ),
				'no_terms'                   => esc_html__( 'No Categories', 'pearl-plugin' ),
				'items_list'                 => esc_html__( 'Categories list', 'pearl-plugin' ),
				'items_list_navigation'      => esc_html__( 'Categories list navigation', 'pearl-plugin' ),
			);
			$args   = array(
				'labels'            => $labels,
				'hierarchical'      => true,
				'public'            => true,
				'show_ui'           => true,
				'show_admin_column' => true,
				'show_in_nav_menus' => true,
				'show_tagcloud'     => true,
			);
			register_taxonomy( 'project-category', array( 'portfolio' ), $args );

		}

		/**
		 * Register meta boxes related to portfolio post type
		 *
		 * @param   array $meta_boxes
		 *
		 * @since   1.0.0
		 * @return  array   $meta_boxes
		 */
		public function register_meta_boxes( $meta_boxes ) {

			$prefix = 'pearl_project_';

			// Portfolio Meta Box
			$meta_boxes[] = array(
				'id'       => 'portfolio-meta-box',
				'title'    => esc_html__( 'Project Details', 'pearl-plugin' ),
				'pages'    => array( 'portfolio' ),
				'context'  => 'normal',
				'priority' => 'high',
				'fields'   => array(
					array(
						'name' => esc_html__( 'Client Name', 'pearl-plugin' ),
						'id'   => "{$prefix}client",
						'type' => 'text',
					),
					array(
						'name' => esc_html__( 'Delivered Date', 'pearl-plugin' ),
						'id'   => "{$prefix}date",
						'type' => 'text',
					),
					array(
						'name' => esc_html__( 'Project URL', 'pearl-plugin' ),
						'id'   => "{$prefix}url",
						'type' => 'url',
					),
					array(
						'id'   => "{$prefix}project_gallery_divider",
						'type' => 'divider',
					),
					array(
						'name'             => 'Gallery Images',
						'desc'             => esc_html__( 'Minimum required project gallery image width is 1170px. The bigger size images will be cropped automatically and proportionally.', 'pearl-plugin' ),
						'id'               => "{$prefix}project_images",
						'type'             => 'image_advanced',
						'max_file_uploads' => 20
					)
				)
			);

			// apply a filter before returning meta boxes
			$meta_boxes = apply_filters( 'pearl_portfolio_meta_boxes', $meta_boxes );

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
			if ( 'portfolio' == $screen->post_type ) {
				$title = esc_html__( 'Enter project name here', 'pearl-plugin' );
			}

			return $title;
		}
	}
}