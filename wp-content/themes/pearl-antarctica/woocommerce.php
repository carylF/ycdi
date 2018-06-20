<?php
get_header();

global $pearl_shop_page_layout;
$pearl_shop_page_container = 'col-md-9';
$pearl_sidebar_class       = 'right';

if ( 'sidebar_left' == $pearl_shop_page_layout ) {
	$pearl_sidebar_class = 'left';
}

$pearl_shop_page_container_class = " wc-three-column wc-sidebar-$pearl_sidebar_class";

if ( 'full_width' == $pearl_shop_page_layout || is_singular( 'product' ) ) {
	$pearl_shop_page_container_class = '';
	$pearl_shop_page_container       = 'col-xs-12';
}
?>
	<div class="container main-container entry-content pearl-shop-page<?php echo esc_attr( $pearl_shop_page_container_class ); ?>">
		<div class="row">
			<div class="<?php echo esc_attr( $pearl_shop_page_container ); ?>">
				<main id="main" class="main">
					<?php woocommerce_content(); ?>
				</main>
			</div>
			<?php
			if ( ! is_singular( 'product' ) ) :
				if ( empty( $pearl_shop_page_layout ) || 'sidebar_right' == $pearl_shop_page_layout || 'sidebar_left' == $pearl_shop_page_layout || ! is_singular( 'product' ) ) : ?>
					<div class="col-md-3 sidebar-<?php echo esc_attr( $pearl_sidebar_class ); ?>">
						<?php get_sidebar( 'shop' ); ?>
					</div>
					<?php
				endif;
			endif; ?>
		</div>
	</div>
<?php
get_footer();