<?php
global $pearl_shop_page_layout;

$pearl_shop_page_layout = get_post_meta( get_option( 'woocommerce_shop_page_id' ), 'pearl_woocommerce_shop_page_layout', true );

if ( ! function_exists( 'pearl_woocommerce_support' ) ) {
	/**
	 * Adds "woocommerce" support for the theme.
	 */
	function pearl_woocommerce_support() {
		add_theme_support( 'woocommerce' );
		add_theme_support( 'wc-product-gallery-zoom' );
		add_theme_support( 'wc-product-gallery-lightbox' );
		add_theme_support( 'wc-product-gallery-slider' );
	}

	add_action( 'after_setup_theme', 'pearl_woocommerce_support' );
}


if ( ! function_exists( 'is_woocommerce_activated' ) ) {
	/**
	 * Check whether WooCommerce plugin is activated or not
	 * @return bool
	 */
	function is_woocommerce_activated() {
		if ( class_exists( 'WooCommerce' ) ) {
			return true;
		} else {
			return false;
		}
	}
}


if ( ! function_exists( 'pearl_register_shop_sidebars' ) ) {
	/**
	 * Register Shop widgets area.
	 */
	function pearl_register_shop_sidebars() {

		// shop widgets area
		register_sidebar( array(
			'name'          => esc_html__( 'Shop', 'pearl-antarctica' ),
			'id'            => 'sidebar-shop',
			'description'   => esc_html__( 'Add shop widgets here.', 'pearl-antarctica' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="shop-widget-title widget-title">',
			'after_title'   => '</h2>',
		) );
	}

	if ( is_woocommerce_activated() ) {
		add_action( 'widgets_init', 'pearl_register_shop_sidebars', 20 );
	}
}


if ( ! function_exists( 'loop_columns' ) ) {
	/**
	 * Change number or products per row to 3
	 */
	function loop_columns() {
		global $pearl_shop_page_layout;

		if ( ! empty( $pearl_shop_page_layout ) && 'full_width' == $pearl_shop_page_layout ) {
			return 4;
		}

		return 3;
	}

	add_filter( 'loop_shop_columns', 'loop_columns' );
}


if ( ! function_exists( 'pearl_shop_loop_per_page' ) ) {
	/**
	 * Display 9 products per page.
	 */
	function pearl_shop_loop_per_page( $cols ) {
		global $pearl_shop_page_layout;

		if ( ! empty( $pearl_shop_page_layout ) && 'full_width' == $pearl_shop_page_layout ) {
			return 12;
		}

		return 9;
	}

	add_filter( 'loop_shop_per_page', 'pearl_shop_loop_per_page', 20 );
}


if ( ! function_exists( 'pearl_hide_woocommerce_page_title' ) ) {
	/**
	 * Removes the "shop" title on the main shop page.
	 */
	function pearl_hide_woocommerce_page_title() {
		return false;
	}

	add_filter( 'woocommerce_show_page_title', 'pearl_hide_woocommerce_page_title' );
}


//
// Product Functions
//
if ( ! function_exists( 'pearl_woocommerce_template_loop_product_link_open' ) ) {
	/**
	 * Insert the opening anchor tag for products in the loop.
	 */
	function pearl_woocommerce_template_loop_product_link_open() {
		echo '<div class="product-thumbnail">';
	}

	remove_action( 'woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10 );
	add_action( 'woocommerce_before_shop_loop_item', 'pearl_woocommerce_template_loop_product_link_open', 10 );
}


if ( ! function_exists( 'pearl_woocommerce_template_loop_product_thumbnail' ) ) {
	/**
	 * Get the product thumbnail for the loop.
	 */
	function pearl_woocommerce_template_loop_product_thumbnail() {

		global $post, $product;

		echo woocommerce_get_product_thumbnail( 'pearl_image_size_275_365' );

		if ( $product->is_on_sale() ) {
			echo '<div class="on-sale-wrap">';
			echo apply_filters( 'woocommerce_sale_flash', '<span class="on-sale">' . esc_html__( 'Sale', 'pearl-antarctica' ) . '</span>', $post, $product );
			echo '</div>';
		}

		echo '<div class="product-thumbnail-overlay">';
		echo '<div class="product-overlay-button-wrap">';

		if ( $product ) {
			$class = implode( ' ', array_filter( array(
				'product-overlay-button button',
				'product_type_' . $product->get_type(),
				$product->is_purchasable() && $product->is_in_stock() ? 'add_to_cart_button' : '',
				$product->supports( 'ajax_add_to_cart' ) ? 'ajax_add_to_cart' : '',
			) ) );

			echo apply_filters( 'woocommerce_loop_add_to_cart_link',
				sprintf( '<a rel="nofollow" href="%s" data-quantity="%s" data-product_id="%s" data-product_sku="%s" class="%s"><i class="fa fa-shopping-cart"></i></a>',
					esc_url( $product->add_to_cart_url() ),
					esc_attr( isset( $quantity ) ? $quantity : 1 ),
					esc_attr( $product->get_id() ),
					esc_attr( $product->get_sku() ),
					esc_attr( $class ) ),
				$product );
		}

		echo '<a href="' . get_the_permalink() . '" class="product-overlay-button woocommerce-LoopProduct-link woocommerce-loop-product__link"><i class="fa fa-search"></i></a>';
		echo '</div>';
		echo '</div>';
		echo '</div>';
		echo '<div class="product-content clearfix">';
	}

	remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 10 );
	remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );
	remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10 );
	add_action( 'woocommerce_before_shop_loop_item_title', 'pearl_woocommerce_template_loop_product_thumbnail', 10 );
}


if ( ! function_exists( 'pearl_woocommerce_shop_loop_item_title' ) ) {
	/**
	 * Show the product title in the product loop. By default this is an H2.
	 */
	function pearl_woocommerce_shop_loop_item_title() {
		echo '<h2 class="woocommerce-loop-product__title"><a href="' . get_the_permalink() . '">' . get_the_title() . '</a></h2>';
	}

	remove_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10 );
	add_action( 'woocommerce_shop_loop_item_title', 'pearl_woocommerce_shop_loop_item_title', 10 );
}


//
// Single Product Functions
//
if ( ! function_exists( 'pearl_woocommerce_show_product_images' ) ) {
	/**
	 * Output the product image before the single product summary.
	 *
	 * @subpackage    Product
	 */
	function pearl_woocommerce_show_product_images() {

		global $post, $product;
		$columns           = apply_filters( 'woocommerce_product_thumbnails_columns', 4 );
		$thumbnail_size    = apply_filters( 'woocommerce_product_thumbnails_large_size', 'full' );
		$post_thumbnail_id = get_post_thumbnail_id( $post->ID );
		$full_size_image   = wp_get_attachment_image_src( $post_thumbnail_id, $thumbnail_size );
		$placeholder       = has_post_thumbnail() ? 'with-images' : 'without-images';
		$wrapper_classes   = apply_filters( 'woocommerce_single_product_image_gallery_classes', array(
			'woocommerce-product-gallery',
			'woocommerce-product-gallery--' . $placeholder,
			'woocommerce-product-gallery--columns-' . absint( $columns ),
			'images',
		) );
		?>
		<div class="<?php echo esc_attr( implode( ' ', array_map( 'sanitize_html_class', $wrapper_classes ) ) ); ?>" data-columns="<?php echo esc_attr( $columns ); ?>" style="opacity: 0; transition: opacity .25s ease-in-out;">
			<figure class="woocommerce-product-gallery__wrapper">
				<?php
				$attributes = array(
					'title'                   => get_post_field( 'post_title', $post_thumbnail_id ),
					'data-caption'            => get_post_field( 'post_excerpt', $post_thumbnail_id ),
					'data-src'                => $full_size_image[0],
					'data-large_image'        => $full_size_image[0],
					'data-large_image_width'  => $full_size_image[1],
					'data-large_image_height' => $full_size_image[2],
				);

				if ( has_post_thumbnail() ) {
					$html = '<div data-thumb="' . get_the_post_thumbnail_url( $post->ID, 'shop_thumbnail' ) . '" class="woocommerce-product-gallery__image"><a href="' . esc_url( $full_size_image[0] ) . '">';
					$html .= get_the_post_thumbnail( $post->ID, 'shop_single', $attributes );
					$html .= '</a></div>';
				} else {
					$html = '<div class="woocommerce-product-gallery__image--placeholder">';
					$html .= sprintf( '<img src="%s" alt="%s" class="wp-post-image" />', esc_url( wc_placeholder_img_src() ), esc_html__( 'Awaiting product image', 'woocommerce' ) );
					$html .= '</div>';
				}

				echo apply_filters( 'woocommerce_single_product_image_thumbnail_html', $html, get_post_thumbnail_id( $post->ID ) );

				do_action( 'woocommerce_product_thumbnails' );
				?>
			</figure>
			<?php
			if ( $product->is_on_sale() ) {
				echo '<div class="on-sale-wrap">';
				echo apply_filters( 'woocommerce_sale_flash', '<span class="on-sale">' . esc_html__( 'Sale', 'pearl-antarctica' ) . '</span>', $post, $product );
				echo '</div>';
			}
			?>
		</div>
		<?php
	}

	remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash', 10 );
	remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_images', 20 );
	add_action( 'woocommerce_before_single_product_summary', 'pearl_woocommerce_show_product_images', 20 );
}


if ( ! function_exists( 'pearl_woocommerce_template_single_title' ) ) {
	/**
	 * Output the product title.
	 *
	 * @subpackage    Product
	 */
	function pearl_woocommerce_template_single_title() {

		if ( post_type_supports( 'product', 'comments' ) ) {
			wc_get_template( 'single-product/rating.php' );
		}

		the_title( '<h1 class="product_title entry-title">', '</h1>' );
	}

	remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10 );
	remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 5 );
	add_action( 'woocommerce_single_product_summary', 'pearl_woocommerce_template_single_title', 5 );
}


if ( ! function_exists( 'pearl_woocommerce_template_single_sharing' ) ) {
	/**
	 * Display social sharing button
	 */
	function pearl_woocommerce_template_single_sharing() {
		$post_id       = get_the_ID();
		$product_title = get_the_title( $post_id );
		$product_url   = get_permalink( $post_id );
		$product_img   = wp_get_attachment_image_src( get_post_thumbnail_id( $post_id ), 'full' );

		$facebook_url  = 'https://www.facebook.com/share.php?u=' . $product_url . '&amp;title=' . $product_title;
		$twitter_url   = 'https://twitter.com/intent/tweet?status=' . $product_title . ' - ' . $product_url;
		$pinterest_url = 'https://pinterest.com/pin/create/bookmarklet/?media=' . $product_img[0] . '&amp;url=' . $product_url . '&amp;is_video=false&amp;description=' . $product_title;
		?>
		<ul class="product-social-sharing clearfix list-unstyled list-inline">
			<li>
				<a href="<?php echo esc_url( $facebook_url ); ?>" class="facebook" target="_blank">
					<i class="fa fa-facebook"></i>
				</a>
			</li>
			<li>
				<a href="<?php echo esc_url( $twitter_url ); ?>" class="twitter" target="_blank">
					<i class="fa fa-twitter"></i>
				</a>
			</li>
			<li>
				<a href="<?php echo esc_url( $pinterest_url ); ?>" class="pinterest" target="_blank">
					<i class="fa fa-pinterest"></i>
				</a>
			</li>
		</ul>
		<?php
	}

	remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_sharing', 50 );
	add_action( 'woocommerce_single_product_summary', 'pearl_woocommerce_template_single_sharing', 50 );
}


if ( ! function_exists( 'pearl_woocommerce_upsell_display_args' ) ) {
	/**
	 * Output product up sells $args. Output the related products $args.
	 *
	 * @param array $args
	 *
	 * @return array
	 */
	function pearl_woocommerce_upsell_and_related_display_args( $args ) {
		global $pearl_shop_page_layout;
		if ( ! empty( $pearl_shop_page_layout ) && 'full_width' == $pearl_shop_page_layout || is_singular( 'product' ) ) {
			return $args = array(
				'posts_per_page' => 4,
				'columns'        => 4,
			);
		}

		return $args = array(
			'posts_per_page' => 3,
			'columns'        => 3,
		);
	}

	add_filter( 'woocommerce_upsell_display_args', 'pearl_woocommerce_upsell_and_related_display_args' );
	add_filter( 'woocommerce_output_related_products_args', 'pearl_woocommerce_upsell_and_related_display_args' );
}