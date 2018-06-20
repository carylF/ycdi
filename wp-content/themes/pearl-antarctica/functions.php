<?php

/**
 * The current version of Antarctica theme.
 */
define( 'PEARL_THEME_VERSION', '1.6.0' );

define( 'PEARL_TEMPLATE_DIRECTORY_URI', get_template_directory_uri() . '/' );
define( 'PEARL_JS_DIRECTORY_URI', PEARL_TEMPLATE_DIRECTORY_URI . 'js/' );
define( 'PEARL_CSS_DIRECTORY_URI', PEARL_TEMPLATE_DIRECTORY_URI . 'css/' );
define( 'PEARL_FRAMEWORK_DIRECTORY_URI', PEARL_TEMPLATE_DIRECTORY_URI . 'pearl-framework/' );

define( 'PEARL_TEMPLATE_DIRECTORY', get_template_directory() . '/' );
define( 'PEARL_JS_DIRECTORY', PEARL_TEMPLATE_DIRECTORY . 'js/' );
define( 'PEARL_CSS_DIRECTORY', PEARL_TEMPLATE_DIRECTORY . 'css/' );
define( 'PEARL_INC_DIRECTORY', PEARL_TEMPLATE_DIRECTORY . 'inc/' );
define( 'PEARL_FRAMEWORK_DIRECTORY', PEARL_TEMPLATE_DIRECTORY . 'pearl-framework/' );

/**
 * Content width of the theme
 */
if ( ! isset( $content_width ) ) {
	$content_width = 870;
}

if ( ! function_exists( 'pearl_theme_setup' ) ) {
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function pearl_theme_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 */
		load_theme_textdomain( 'pearl-antarctica', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		/*
		 * Enable support for Post Formats on posts.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/post-formats/
		 */
		add_theme_support( 'post-formats', array( 'image', 'quote', 'video' ) );

		/*
		 * Used on:
		 * Single post page and Post archive pages
		 */
		set_post_thumbnail_size( 870, 496, true );

		/*
		 * Add image sizes
		 * When you refactor the image sizes also utilize default three sizes
		 * which are by WordPress thumbnail,medium, full
		*/


		// recent posts widget
		add_image_size( 'pearl_image_size_102_80', 102, 80, true );

		// product thumbnail
		add_image_size( 'pearl_image_size_275_365', 275, 365, true );

		// vc team members
		add_image_size( 'pearl_image_size_540_570', 540, 576, true );

		// vc portfolio & VC Blog & Related Posts
		add_image_size( 'pearl_image_size_475_360', 475, 360, true );

		// portfolio listing
		add_image_size( 'pearl_image_size_475_475', 475, 475, true );

		// portfolio single
		add_image_size( 'pearl_image_size_1170_570', 1170, 570, true );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'header-menu' => esc_html__( 'Header Menu', 'pearl-antarctica' ),
			'sidebar-menu' => esc_html__( 'Sidebar Menu', 'pearl-antarctica' ),
		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'pearl_custom_background_args', array(
			'default-color' => 'fff',
			'default-image' => '',
		) ) );
	}

	add_action( 'after_setup_theme', 'pearl_theme_setup' );
}

/**
 * Load Pearl Framework
 */
require_once PEARL_FRAMEWORK_DIRECTORY . 'load-framework.php';

/**
 * Demo contents import
 */
require_once PEARL_FRAMEWORK_DIRECTORY . 'demo-import/pearl-import.php';

if ( ! function_exists( 'pearl_register_sidebars' ) ) {
	/**
	 * Register widgets area.
	 */
	function pearl_register_sidebars() {

		// default sidebar widgets area
		register_sidebar( array(
			'name'          => esc_html__( 'Sidebar', 'pearl-antarctica' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add sidebar widgets here.', 'pearl-antarctica' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		) );

		// footer first column widgets area
		register_sidebar( array(
			'name'          => esc_html__( 'Footer First Column', 'pearl-antarctica' ),
			'id'            => 'footer-1',
			'description'   => esc_html__( 'Add footer first column widget here.', 'pearl-antarctica' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		) );

		// footer second column widgets area
		register_sidebar( array(
			'name'          => esc_html__( 'Footer Second Column', 'pearl-antarctica' ),
			'id'            => 'footer-2',
			'description'   => esc_html__( 'Add footer second column widget here.', 'pearl-antarctica' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		) );

		// footer third column widgets area
		register_sidebar( array(
			'name'          => esc_html__( 'Footer Third Column', 'pearl-antarctica' ),
			'id'            => 'footer-3',
			'description'   => esc_html__( 'Add footer third column widget here.', 'pearl-antarctica' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		) );

		// footer fourth column widgets area
		register_sidebar( array(
			'name'          => esc_html__( 'Footer Fourth Column', 'pearl-antarctica' ),
			'id'            => 'footer-4',
			'description'   => esc_html__( 'Add footer fourth column widget here.', 'pearl-antarctica' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		) );
	}

	add_action( 'widgets_init', 'pearl_register_sidebars' );
}

if ( ! function_exists( 'pearl_search_form' ) ) {
	/**
	 * Modify the default search form
	 * @since   1.0.0
	 * @return  string
	 */
	function pearl_search_form() {

		$form = '<form role="search" method="get" class="search-form clearfix" action="' . esc_url( home_url( '/' ) ) . '">
    <input type="search" class="search-field" placeholder="' . esc_attr_x( 'Search', 'placeholder', 'pearl-antarctica' ) . '" value="' . get_search_query() . '" name="s" />
    <input type="submit" class="search-submit" value="" />
</form>';

		return $form;
	}

	add_filter( 'get_search_form', 'pearl_search_form' );
}

if ( ! function_exists( 'pearl_google_fonts' ) ) {
	/**
	 * Google fonts enqueue url
	 * @since   1.0.0
	 * @return  string
	 */
	function pearl_google_fonts() {

		$fonts_url     = '';
		$font_families = array();

		/*
		 * Translators: If there are characters in your language that are not
		 * supported by Raleway, Roboto and Lato, translate this to 'off'. Do not translate
		 * into your own language.
		 */
		$raleway    = esc_html_x( 'on', 'Raleway font: on or off', 'pearl-antarctica' );
		$roboto     = esc_html_x( 'on', 'Roboto font: on or off', 'pearl-antarctica' );
		$roboto_slab = esc_html_x( 'on', 'Roboto Slab font: on or off', 'pearl-antarctica' );
		$lato       = esc_html_x( 'on', 'Lato font: on or off', 'pearl-antarctica' );
		$montserrat = esc_html_x( 'on', 'Montserrat font: on or off', 'pearl-plugin' );


		if ( 'off' !== $raleway ) {
			$font_families[] = 'Raleway:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i';
		}

		if ( 'off' !== $roboto ) {
			$font_families[] = 'Roboto:300,300i,400,400i,500,500i,700,700i,900,900';
		}

		if ( 'off' !== $roboto_slab ) {
			$font_families[] = 'Roboto+Slab:300,400,700';
		}

		if ( 'off' !== $lato ) {
			$font_families[] = 'Lato:300,300i,400,400i,700,700i,900';
		}

		if ( 'off' !== $montserrat ) {
			$font_families[] = 'Montserrat:400,500,600,700';
		}

		if ( $font_families ) {
			$query_args = array(
				'family' => str_replace( '%2B', '+', urlencode( implode( '|', $font_families ) ) ),
				'subset' => urlencode( 'latin,latin-ext' ),
			);

			$fonts_url = add_query_arg( $query_args, '//fonts.googleapis.com/css' );
		}

		return esc_url_raw( $fonts_url );
	}
}

if ( ! function_exists( 'pearl_enqueue_styles' ) ) {
	/**
	 * Enqueue required styles
	 * @since   1.0.0
	 * @return  void
	 */
	function pearl_enqueue_styles() {

		if ( ! is_admin() ) {

			// owl carousel
			wp_register_style(
				'owl-carousel',
				PEARL_JS_DIRECTORY_URI . 'owl.carousel/assets/owl.carousel.min.css',
				array('antarctica', 'pearl-parent-custom'),
				'2.2.0'
			);

			// owl default theme
			wp_register_style(
				'owl-theme-default',
				PEARL_JS_DIRECTORY_URI . 'owl.carousel/assets/owl.theme.default.min.css',
				array('antarctica', 'pearl-parent-custom'),
				'2.2.0'
			);

			// Google Font
			wp_enqueue_style(
				'pearl-google-fonts',
				pearl_google_fonts(),
				array(),
				PEARL_THEME_VERSION
			);

			// font awesome
			wp_enqueue_style(
				'fontawesome',
				PEARL_CSS_DIRECTORY_URI . 'font-awesome.min.css',
				array(),
				'4.7.0'
			);

			// flex slider
			wp_enqueue_style(
				'flexslider-css',
				PEARL_JS_DIRECTORY_URI . 'flexslider/flexslider.css',
				array(),
				'2.6.3'
			);

			// slick nav
			wp_enqueue_style(
				'slicknav',
				PEARL_JS_DIRECTORY_URI . 'slicknav/slicknav.min.css',
				array(),
				'1.0.10'
			);

			// light case
			wp_enqueue_style(
				'lightcase',
				PEARL_JS_DIRECTORY_URI . 'lightcase/css/lightcase.css',
				array(),
				'2.3.6'
			);

			// select2
			if ( ! wp_style_is( 'select2' ) ) {
				wp_enqueue_style(
					'select2',
					PEARL_JS_DIRECTORY_URI . 'select2/select2.min.css',
					array(),
					'4.0.3'
				);
			}

			// fake Loader
			wp_enqueue_style(
				'fakeLoader',
				PEARL_JS_DIRECTORY_URI . 'fakeLoader/fakeLoader.css',
				array(),
				PEARL_THEME_VERSION
			);

			// antarctica css
			wp_enqueue_style(
				'antarctica',
				PEARL_CSS_DIRECTORY_URI . 'main.css',
				array(),
				PEARL_THEME_VERSION
			);

			// parent custom css
			wp_enqueue_style(
				'pearl-parent-custom',
				PEARL_CSS_DIRECTORY_URI . 'custom.css',
				array(),
				PEARL_THEME_VERSION
			);

			// antarctica inline css
			wp_add_inline_style( 'antarctica', pearl_inline_css() );

		}

	}

	add_action( 'wp_enqueue_scripts', 'pearl_enqueue_styles' );
}

if ( ! function_exists( 'pearl_enqueue_scripts' ) ) {
	/**
	 * Enqueue required scripts
	 * @since   1.0.0
	 * @return  void
	 */
	function pearl_enqueue_scripts() {

		if ( ! is_admin() ) {

			// owl carousel
			wp_register_script(
				'owl-carousel',
				PEARL_JS_DIRECTORY_URI . 'owl.carousel/owl.carousel.min.js',
				array( 'jquery', 'antarctica' ),
				'2.2.0'
			);

			// bootstrap
			wp_enqueue_script(
				'bootstrap',
				PEARL_JS_DIRECTORY_URI . 'bootstrap.min.js',
				array( 'jquery' ),
				'3.3.7'
			);

			// flex slider
			wp_enqueue_script(
				'flexslider',
				PEARL_JS_DIRECTORY_URI . 'flexslider/jquery.flexslider-min.js',
				array( 'jquery' ),
				'2.6.3'
			);

			// count to
			wp_enqueue_script(
				'countto',
				PEARL_JS_DIRECTORY_URI . 'jquery-countTo/jquery.countTo.js',
				array( 'jquery' ),
				PEARL_THEME_VERSION
			);

			// waypoints
			wp_enqueue_script(
				'waypoints',
				PEARL_JS_DIRECTORY_URI . 'jquery.waypoints.min.js',
				array( 'jquery' ),
				'4.0.1'
			);

			// slicknav
			wp_enqueue_script(
				'slicknav',
				PEARL_JS_DIRECTORY_URI . 'slicknav/jquery.slicknav.min.js',
				array( 'jquery' ),
				'1.0.10'
			);

			// events touch
			wp_enqueue_script(
				'events-touch',
				PEARL_JS_DIRECTORY_URI . 'lightcase/vendor/jQuery/jquery.events.touch.js',
				array( 'jquery' ),
				'1.4.5'
			);

			// light case
			wp_enqueue_script(
				'light-case',
				PEARL_JS_DIRECTORY_URI . 'lightcase/js/lightcase.js',
				array( 'jquery' ),
				'2.3.6'
			);

			// select2
			if ( ! wp_script_is( 'select2' ) ) {
				wp_enqueue_script(
					'select2',
					PEARL_JS_DIRECTORY_URI . 'select2/select2.min.js',
					array( 'jquery' ),
					'4.0.3'
				);
			}

			// fakeLoader
			wp_enqueue_script(
				'fakeLoader',
				PEARL_JS_DIRECTORY_URI . 'fakeLoader/fakeLoader.min.js',
				array( 'jquery' ),
				PEARL_THEME_VERSION
			);

			// isotopes
			wp_enqueue_script(
				'isotope',
				PEARL_JS_DIRECTORY_URI . 'isotope.pkgd.min.js',
				array( 'jquery' ),
				'3.0.1'
			);

			// form
			wp_enqueue_script(
				'form',
				PEARL_JS_DIRECTORY_URI . 'jquery.form.min.js',
				array( 'jquery' ),
				'3.51.0'
			);

			// validate
			wp_enqueue_script(
				'validate',
				PEARL_JS_DIRECTORY_URI . 'jquery.validate.min.js',
				array( 'jquery' ),
				'1.15.0'
			);

			if ( is_page_template( 'page-templates/contact.php' ) ) {

				// Get Google Map API Key if available
				$google_map_api_key = get_option( 'pearl_google_map_api_key' );

				if ( isset( $google_map_api_key ) && ! empty( $google_map_api_key ) ) {

					$google_map_arguments        = array();
					$google_map_arguments['key'] = urlencode( $google_map_api_key );

					$google_map_api_uri = add_query_arg( apply_filters( 'pearl_google_map_arguments', $google_map_arguments ), '//maps.google.com/maps/api/js' );

					wp_enqueue_script(
						'google-map-api',
						esc_url_raw( $google_map_api_uri ),
						array(),
						'3.21',
						false
					);
				}
			}


			// comment reply
			if ( ! is_admin() && is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
				wp_enqueue_script( 'comment-reply' );
			}

			// antarctica
			wp_enqueue_script(
				'antarctica',
				PEARL_JS_DIRECTORY_URI . 'antarctica.js',
				array( 'jquery' ),
				PEARL_THEME_VERSION
			);

			wp_add_inline_script( 'antarctica', pearl_inline_script() );

		}

	}

	add_action( 'wp_enqueue_scripts', 'pearl_enqueue_scripts' );
}

if ( ! function_exists( 'pearl_add_editor_style' ) ) {
	/**
	 * Add editor style
	 */
	function pearl_add_editor_style() {
		add_editor_style( array( get_template_directory_uri() . '/css/editor-style.css', pearl_google_fonts() ) );
	}

	add_action( 'admin_init', 'pearl_add_editor_style' );
}

if ( ! function_exists( 'pearl_customizer_live_preview' ) ) {
	/**
	 * Enqueue live customizer js
	 */
	function pearl_customizer_live_preview() {

		// live customizer
		wp_enqueue_script(
			'live-customizer-js',
			PEARL_FRAMEWORK_DIRECTORY_URI . 'customizer/custom-controls/js/live-customizer.js',
			array( 'jquery' ),
			PEARL_THEME_VERSION,
			true
		);

	}

	add_action( 'customize_preview_init', 'pearl_customizer_live_preview' );
}

if ( ! function_exists( 'pearl_inline_css' ) ) {
	/**
	 * Build and return theme inline css
	 */
	function pearl_inline_css() {

		if ( is_home() ) {
			$post_id = get_option( 'page_for_posts' );
		} else {
			$post_id = get_the_ID();
		}

		// banner css
		$banner_padding        = 184;
		$banner_padding_bottom = 184;
		$banner_overlay        = 60;

		if ( is_singular( 'post' ) ) {

			$banner_padding        = get_option( 'pearl_blog_banner_padding', 184 );
			$banner_padding_bottom = get_option( 'pearl_blog_banner_padding_bottom', 184 );
			$banner_overlay        = get_option( 'pearl_blog_banner_overlay', 60 );

		} else if ( is_singular( 'portfolio' ) ) {

			$banner_padding        = get_option( 'pearl_portfolio_banner_padding', 184 );
			$banner_padding_bottom = get_option( 'pearl_portfolio_banner_padding_bottom', 184 );
			$banner_overlay        = get_option( 'pearl_portfolio_banner_overlay', 60 );

		} else {

			$meta_data = get_post_custom( $post_id );

			if ( ! empty( $meta_data['pearl_banner_padding'] ) ) {
				$banner_padding = esc_html( $meta_data['pearl_banner_padding'][0] );
			}

			if ( ! empty( $meta_data['pearl_banner_padding_bottom'] ) ) {
				$banner_padding_bottom = esc_html( $meta_data['pearl_banner_padding_bottom'][0] );
			}

			if ( ! empty( $meta_data['pearl_banner_opacity'][0] ) ) {
				$banner_overlay = esc_html( $meta_data['pearl_banner_opacity'][0] );
			}
		}

		$banner_overlay = ( $banner_overlay * 100 ) / 100;

		if ( $banner_overlay > 99 ) {
			$banner_overlay = 1;
		} else {
			$banner_overlay = '0.' . $banner_overlay;
		}

		$custom_css = "
@media (min-width: 1200px) {
    .sub-header {
        padding-top: {$banner_padding}px;
        padding-bottom: {$banner_padding_bottom}px;
    }                   

}

.sub-header .bg-overlay {
        background-color: rgba(23, 32, 37, {$banner_overlay})
}

";
		/**
		 * Filters Pearl inline css.
		 *
		 * @since Pearl Antarctica 1.3.0
		 *
		 * @param string $custom_css String of inline css.
		 */
		$custom_css = apply_filters('pearl_inline_css', $custom_css);

		return $custom_css;
	}
}

if ( ! function_exists( 'pearl_inline_script' ) ) {
	/**
	 * Site loader script that runs right after loader div
	 *
	 * This function is only for the later use.
	 */
	function pearl_inline_script() {
		$inline_script = "";

		return $inline_script;

	}
}

if ( ! function_exists( 'pearl_body_class' ) ) {
	function pearl_body_class( $classes ) {
		$header_type = get_post_meta( get_the_ID(), 'pearl_header_type', true );

		if ( 'header_5' == $header_type ) {
			$classes[] = 'pearl_header_5';
		}
		return $classes;
	}
	add_filter( 'body_class', 'pearl_body_class' );
}

