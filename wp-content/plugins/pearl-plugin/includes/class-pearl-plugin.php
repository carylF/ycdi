<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       https://www.pearlthemes.com
 * @since      1.0.0
 *
 * @package    Pearl_Plugin
 * @subpackage Pearl_Plugin/includes
 */

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @package    Pearl_Plugin
 * @subpackage Pearl_Plugin/includes
 * @author     PearlThemes <hello@pearlthemes.com>
 */
class Pearl_Plugin {

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      Pearl_Plugin_Loader $loader Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string $plugin_name The string used to uniquely identify this plugin.
	 */
	protected $plugin_name;

	/**
	 * The current version of the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string $version The current version of the plugin.
	 */
	protected $version;

	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function __construct() {

		$this->plugin_name = 'pearl-plugin';
		$this->version     = '1.0.0';

		$this->load_dependencies();
		$this->set_locale();
		$this->define_admin_hooks();
		$this->define_public_hooks();

	}

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - Pearl_Plugin_Loader. Orchestrates the hooks of the plugin.
	 * - Pearl_Plugin_i18n. Defines internationalization functionality.
	 * - Pearl_Plugin_Admin. Defines all hooks for the admin area.
	 * - Pearl_Plugin_Public. Defines all hooks for the public side of the site.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function load_dependencies() {

		/**
		 * The class responsible for orchestrating the actions and filters of the
		 * core plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-pearl-plugin-loader.php';

		/**
		 * The class responsible for defining internationalization functionality
		 * of the plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-pearl-plugin-i18n.php';

		/**
		 * The class responsible for defining all actions that occur in the admin area.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-pearl-plugin-admin.php';

		/**
		 * The class responsible for defining all actions that occur in the public-facing
		 * side of the site.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-pearl-plugin-public.php';

		/**
		 * Meta Boxes Stuff
		 */

		// Deactivate Meta Box Plugin and related extensions if Installed
		add_action( 'init', function () {

			include_once( ABSPATH . 'wp-admin/includes/plugin.php' );

			// Meta Box Plugin
			if ( is_plugin_active( 'meta-box/meta-box.php' ) ) {
				deactivate_plugins( 'meta-box/meta-box.php' );
				add_action( 'admin_notices', function () {
					?>
					<div class="notice notice-warning is-dismissible">
						<p>
							<strong><?php esc_html_e( 'Meta Box plugin has been deactivated!', 'pearl-plugin' ); ?></strong>
							<?php esc_html_e( 'Its functionality is embedded within the Pearl plugin.', 'pearl-plugin' ); ?>
						</p>
						<p>
							<em><?php esc_html_e( 'So, You should remove it completely from your plugins.', 'pearl-plugin' ); ?></em>
						</p>
					</div>
					<?php
				} );
			}

			// Meta Box Columns Extension
			if ( is_plugin_active( 'meta-box-columns/meta-box-columns.php' ) ) {
				deactivate_plugins( 'meta-box-columns/meta-box-columns.php' );
				add_action( 'admin_notices', function () {
					?>
					<div class="notice notice-warning is-dismissible">
						<p>
							<strong><?php esc_html_e( 'Meta Box Columns plugin has been deactivated!', 'pearl-plugin' ); ?></strong>
							&nbsp;<?php esc_html_e( 'Its functionality is embedded within the Pearl plugin.', 'pearl-plugin' ); ?>
						</p>
						<p>
							<em><?php esc_html_e( 'So, You should remove it completely from your plugins.', 'pearl-plugin' ); ?></em>
						</p>
					</div>
					<?php
				} );
			}

			// Meta Box Tabs Extension
			if ( is_plugin_active( 'meta-box-tabs/meta-box-tabs.php' ) ) {
				deactivate_plugins( 'meta-box-tabs/meta-box-tabs.php' );
				add_action( 'admin_notices', function () {
					?>
					<div class="notice notice-warning is-dismissible">
						<p>
							<strong><?php esc_html_e( 'Meta Box Tabs plugin has been deactivated!', 'pearl-plugin' ); ?></strong>
							&nbsp;<?php esc_html_e( 'Its functionality is embedded within the Pearl plugin.', 'pearl-plugin' ); ?>
						</p>
						<p>
							<em><?php esc_html_e( 'So, You should remove it completely from your plugins.', 'pearl-plugin' ); ?></em>
						</p>
					</div>
					<?php
				} );
			}

			// Meta Box Show Hide Extension
			if ( is_plugin_active( 'meta-box-show-hide/meta-box-show-hide.php' ) ) {
				deactivate_plugins( 'meta-box-show-hide/meta-box-show-hide.php' );
				add_action( 'admin_notices', function () {
					?>
					<div class="notice notice-warning is-dismissible">
						<p>
							<strong><?php esc_html_e( 'Meta Box Show Hide plugin has been deactivated!', 'pearl-plugin' ); ?></strong>
							&nbsp;<?php esc_html_e( 'Its functionality is embedded within the Pearl plugin.', 'pearl-plugin' ); ?>
						</p>
						<p>
							<em><?php esc_html_e( 'So, You should remove it completely from your plugins.', 'pearl-plugin' ); ?></em>
						</p>
					</div>
					<?php
				} );
			}

			// Meta Box Group Extension
			if ( is_plugin_active( 'meta-box-group/meta-box-group.php' ) ) {
				deactivate_plugins( 'meta-box-group/meta-box-group.php' );
				add_action( 'admin_notices', function () {
					?>
					<div class="notice notice-warning is-dismissible">
						<p>
							<strong><?php esc_html_e( 'Meta Box Group plugin has been deactivated!', 'pearl-plugin' ); ?></strong>
							&nbsp;<?php esc_html_e( 'Its functionality is embedded within the Pearl plugin.', 'pearl-plugin' ); ?>
						</p>
						<p>
							<em><?php esc_html_e( 'So, You should remove it completely from your plugins.', 'pearl-plugin' ); ?></em>
						</p>
					</div>
					<?php
				} );
			}

		} );

		// Embedded meta box plugin
		if ( ! class_exists( 'RWMB_Core' ) ) {
			require_once( plugin_dir_path( __DIR__ ) . '/plugins/meta-box/meta-box.php' );
		}

		// Meta Box Plugin Extensions

		// Columns extension
		if ( ! class_exists( 'RWMB_Columns' ) ) {
			require_once( plugin_dir_path( __DIR__ ) . '/plugins/meta-box-extensions/meta-box-columns/meta-box-columns.php' );
		}

		// Show Hide extension
		if ( ! class_exists( 'RWMB_Show_Hide' ) ) {
			require_once( plugin_dir_path( __DIR__ ) . '/plugins/meta-box-extensions/meta-box-show-hide/meta-box-show-hide.php' );
		}

		// Conditional Logic Extension
		if ( ! class_exists( 'MB_Conditional_Logic' ) ) {
			require_once( plugin_dir_path( __DIR__ ) . '/plugins/meta-box-extensions/meta-box-conditional-logic/meta-box-conditional-logic.php' );
		}

		// Tabs extension
		if ( ! class_exists( 'RWMB_Tabs' ) ) {
			require_once( plugin_dir_path( __DIR__ ) . '/plugins/meta-box-extensions/meta-box-tabs/meta-box-tabs.php' );
		}

		// Group extension
		if ( ! class_exists( 'RWMB_Group' ) ) {
			require_once( plugin_dir_path( __DIR__ ) . '/plugins/meta-box-extensions/meta-box-group/meta-box-group.php' );
		}

		/**
		 * VC Elements
		 */
		function pearl_init_vc_elements() {

			require_once plugin_dir_path( dirname( __FILE__ ) ) . '/vc-elements/vc-elements.php';

		}

		add_action( 'vc_before_init', 'pearl_init_vc_elements' );

		/**
		 * The file is responsible to handle all forms requests
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/pearl-mail-handler.php';

		/**
		 * The file is responsible for the theme short-codes
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/pearl-short-codes.php';

		/**
		 * The file is responsible for the theme social share links
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/pearl-social-share.php';

		/**
		 * The file is responsible for the theme widgets
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'widgets/widgets.php';

		/**
		 * The file is responsible for the services custom post type and related stuff
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-service-post-type.php';

		/**
		 * The file is responsible for the portfolio custom post type and related stuff
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-portfolio-post-type.php';

		/**
		 * The file is responsible for the team custom post type and related stuff
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-team-post-type.php';

		/**
		 * The file is responsible for the testimonial custom post type and related stuff
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-testimonial-post-type.php';

		$this->loader = new Pearl_Plugin_Loader();

	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the Pearl_Plugin_i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function set_locale() {

		$plugin_i18n = new Pearl_Plugin_i18n();

		$this->loader->add_action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );

	}

	/**
	 * Register all of the hooks related to the admin area functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_admin_hooks() {

		$plugin_admin = new Pearl_Plugin_Admin( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_styles' );
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts' );

		// Service Post Type
		$service_post_type = new Pearl_Service_Post_type();
		add_action( 'init', array( $service_post_type, 'register_service_post_type' ) );
		add_action( 'enter_title_here', array( $service_post_type, 'change_title_text' ) );
		add_filter( 'rwmb_meta_boxes', array( $service_post_type, 'register_meta_boxes' ) );

		// Portfolio Post Type
		$portfolio_post_type = new Pearl_Portfolio_Post_type();
		add_action( 'init', array( $portfolio_post_type, 'register_portfolio_post_type' ) );
		add_action( 'init', array( $portfolio_post_type, 'register_project_category' ) );
		add_action( 'enter_title_here', array( $portfolio_post_type, 'change_title_text' ) );
		add_filter( 'rwmb_meta_boxes', array( $portfolio_post_type, 'register_meta_boxes' ) );

		// Team Post Type
		$team_post_type = new Pearl_Team_Post_type();
		add_action( 'init', array( $team_post_type, 'register_team_post_type' ) );
		add_action( 'enter_title_here', array( $team_post_type, 'change_title_text' ) );
		add_filter( 'rwmb_meta_boxes', array( $team_post_type, 'register_meta_boxes' ) );

		// Testimonial Post Type
		$testimonial_post_type = new Pearl_Testimonial_Post_type();
		add_action( 'init', array( $testimonial_post_type, 'register_testimonial_post_type' ) );
		add_action( 'enter_title_here', array( $testimonial_post_type, 'change_title_text' ) );
		add_filter( 'rwmb_meta_boxes', array( $testimonial_post_type, 'register_meta_boxes' ) );

	}

	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since     1.0.0
	 * @return    string    The name of the plugin.
	 */
	public function get_plugin_name() {
		return $this->plugin_name;
	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @since     1.0.0
	 * @return    string    The version number of the plugin.
	 */
	public function get_version() {
		return $this->version;
	}

	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_public_hooks() {

		$plugin_public = new Pearl_Plugin_Public( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_styles' );
		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_scripts' );

	}

	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since    1.0.0
	 */
	public function run() {
		$this->loader->run();
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since     1.0.0
	 * @return    Pearl_Plugin_Loader    Orchestrates the hooks of the plugin.
	 */
	public function get_loader() {
		return $this->loader;
	}

}
