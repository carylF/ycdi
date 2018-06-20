<?php
/**
 * Team custom post type class.
 */

if ( ! class_exists( 'Pearl_Team_Post_type' ) ) {
	class Pearl_Team_Post_type {

		/**
		 * Register Team Post Type
		 * @since 1.0.0
		 */
		function register_team_post_type() {

			$labels = array(
				'name'                  => esc_html_x( 'Team Members', 'Post Type General Name', 'pearl-plugin' ),
				'singular_name'         => esc_html_x( 'Team Member', 'Post Type Singular Name', 'pearl-plugin' ),
				'menu_name'             => esc_html__( 'Team', 'pearl-plugin' ),
				'name_admin_bar'        => esc_html__( 'Team Member', 'pearl-plugin' ),
				'archives'              => esc_html__( 'Team Archives', 'pearl-plugin' ),
				'attributes'            => esc_html__( 'Team Attributes', 'pearl-plugin' ),
				'parent_item_colon'     => esc_html__( 'Parent Team Memeber:', 'pearl-plugin' ),
				'all_items'             => esc_html__( 'All Team', 'pearl-plugin' ),
				'add_new_item'          => esc_html__( 'Add New Team Member', 'pearl-plugin' ),
				'add_new'               => esc_html__( 'Add New', 'pearl-plugin' ),
				'new_item'              => esc_html__( 'New Team Member', 'pearl-plugin' ),
				'edit_item'             => esc_html__( 'Edit Team Member', 'pearl-plugin' ),
				'update_item'           => esc_html__( 'Update Team Member', 'pearl-plugin' ),
				'view_item'             => esc_html__( 'View Team Member', 'pearl-plugin' ),
				'view_items'            => esc_html__( 'View Team Members', 'pearl-plugin' ),
				'search_items'          => esc_html__( 'Search Team Member', 'pearl-plugin' ),
				'not_found'             => esc_html__( 'Not found', 'pearl-plugin' ),
				'not_found_in_trash'    => esc_html__( 'Not found in Trash', 'pearl-plugin' ),
				'featured_image'        => esc_html__( 'Team Member Photo', 'pearl-plugin' ),
				'set_featured_image'    => esc_html__( 'Set team member photo', 'pearl-plugin' ),
				'remove_featured_image' => esc_html__( 'Remove team member photo', 'pearl-plugin' ),
				'use_featured_image'    => esc_html__( 'Use as team member photo', 'pearl-plugin' ),
				'insert_into_item'      => esc_html__( 'Insert into post', 'pearl-plugin' ),
				'uploaded_to_this_item' => esc_html__( 'Uploaded to this team member photo', 'pearl-plugin' ),
				'items_list'            => esc_html__( 'Team Members list', 'pearl-plugin' ),
				'items_list_navigation' => esc_html__( 'Team Members list navigation', 'pearl-plugin' ),
				'filter_items_list'     => esc_html__( 'Filter Team Members list', 'pearl-plugin' ),
			);
			$args   = array(
				'label'               => esc_html__( 'Team Member', 'pearl-plugin' ),
				'description'         => esc_html__( 'Team members of the company or organisation.', 'pearl-plugin' ),
				'labels'              => $labels,
				'supports'            => array( 'title', 'thumbnail', ),
				'hierarchical'        => false,
				'public'              => true,
				'show_ui'             => true,
				'show_in_menu'        => true,
				'menu_position'       => 5,
				'menu_icon'           => 'dashicons-groups',
				'show_in_admin_bar'   => true,
				'show_in_nav_menus'   => false,
				'can_export'          => true,
				'has_archive'         => false,
				'exclude_from_search' => true,
				'publicly_queryable'  => false,
				'rewrite'             => false,
				'capability_type'     => 'post',
			);
			register_post_type( 'team', $args );

		}


		/**
		 * Register meta boxes related to team post type
		 *
		 * @param   array $meta_boxes
		 *
		 * @since   1.0.0
		 * @return  array   $meta_boxes
		 */
		public function register_meta_boxes( $meta_boxes ) {

			$prefix = 'pearl_team_';

			// Portfolio Meta Box
			$meta_boxes[] = array(
				'id'       => 'team-meta-box',
				'title'    => esc_html__( 'Team Member Details', 'pearl-plugin' ),
				'pages'    => array( 'team' ),
				'context'  => 'normal',
				'priority' => 'high',
				'fields'   => array(
					array(
						'name' => esc_html__( 'Designation', 'pearl-plugin' ),
						'id'   => "{$prefix}designation",
						'type' => 'text',
					),
					array(
						'name' => esc_html__( 'Bio URL', 'pearl-plugin' ),
						'id'   => "{$prefix}bio_url",
						'type' => 'url',
					),
					array(
						'type' => 'divider'
					),
					array(
						'name' => esc_html__( 'Twitter URL', 'pearl-plugin' ),
						'id'   => "{$prefix}twitter_url",
						'type' => 'url',
					),
					array(
						'name' => esc_html__( 'Facebook URL', 'pearl-plugin' ),
						'id'   => "{$prefix}facebook_url",
						'type' => 'url',
					),
					array(
						'name' => esc_html__( 'Google+ URL', 'pearl-plugin' ),
						'id'   => "{$prefix}google_url",
						'type' => 'url',
					),
					array(
						'name' => esc_html__( 'Instagram URL', 'pearl-plugin' ),
						'id'   => "{$prefix}instagram_url",
						'type' => 'url',
					),
				)
			);

			// apply a filter before returning meta boxes
			$meta_boxes = apply_filters( 'pearl_team_meta_boxes', $meta_boxes );

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
			if ( 'team' == $screen->post_type ) {
				$title = esc_html__( 'Enter team member name here', 'pearl-plugin' );
			}

			return $title;
		}
	}
}