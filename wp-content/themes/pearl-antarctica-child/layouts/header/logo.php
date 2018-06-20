<?php
// page meta
$page_id = pearl_get_the_id();
$custom_logo        = get_post_meta( $page_id, 'pearl_logo_image', true );
$custom_retina_logo = get_post_meta( $page_id, 'pearl_logo_image_retina', true );

// site branding
$logo_path        = ( empty( $custom_logo ) ) ? get_option( 'pearl_site_logo' ) : wp_get_attachment_image_url( $custom_logo, 'full' );
$retina_logo_path = ( empty( $custom_retina_logo ) ) ? get_option( 'pearl_site_logo_retina' ) : wp_get_attachment_image_url( $custom_retina_logo, 'full' );;

if ( is_singular( 'portfolio' ) ) {
	$portfolio_logo = get_option( 'pearl_portfolio_header_logo' );

	if ( ! empty( $portfolio_logo ) ) {
		$logo_path        = $portfolio_logo;
		$retina_logo_path = '';
	}
}
pearl_site_logo( $logo_path, $retina_logo_path );
?>