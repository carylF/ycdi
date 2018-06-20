<?php

	if ( ! function_exists( 'pearl_import_files' ) ) {
		/**
		 * Demo contents import
		 */
		function pearl_import_files() {
			return array(
				array(
					'import_file_name'             => esc_html__( 'Antarctica Demo Import', 'pearl-antarctica' ),
					'local_import_file'            => PEARL_FRAMEWORK_DIRECTORY . 'demo-import/import-files/content.xml',
					'local_import_widget_file'     => PEARL_FRAMEWORK_DIRECTORY . 'demo-import/import-files/widgets.wie',
					'local_import_customizer_file' => PEARL_FRAMEWORK_DIRECTORY . 'demo-import/import-files/customizer.dat',
					'import_notice'                => htmlspecialchars_decode( esc_html__( 'Please wait for a few minutes, do not close the window or refresh the page until the data is imported :) <br><br>After you import this demo, you will have to setup the permalinks settings to <strong>Post name</strong> from <code>Settings > Permalinks</code> page.', 'pearl-antarctica' ) ),
				)
			);
		}

		add_filter( 'pt-ocdi/import_files', 'pearl_import_files' );
	}

	if ( ! function_exists( 'pearl_after_import' ) ) {
		/**
		 * Set up the news and front page plus menu locations
		 * @param $selected_import
		 */
		function pearl_after_import( $selected_import ) {

			if ( 'Antarctica Demo Import' === $selected_import['import_file_name'] ) {

				//Header Menu
				$header_menu = get_term_by( 'name', 'Header Menu', 'nav_menu' );

				//Sidebar Menu
				$sidebar_menu = get_term_by( 'name', 'Sidebar Menu', 'nav_menu' );

				set_theme_mod( 'nav_menu_locations', array(
						'header-menu' => $header_menu->term_id,
						'sidebar-menu' => $sidebar_menu->term_id,
					)
				);

				//Set Front page
				$page         = get_page_by_title( 'Home' );
				$blog_page_id = get_page_by_title( 'Blog' );
				if ( isset( $page->ID ) ) {
					update_option( 'page_on_front', $page->ID );
					update_option( 'show_on_front', 'page' );
					update_option( 'page_for_posts', $blog_page_id->ID );
				}
			}

		}

		add_action( 'pt-ocdi/after_import', 'pearl_after_import' );

	}