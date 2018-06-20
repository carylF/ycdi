<!DOCTYPE html>

<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<?php
	/* Always have wp_head() just before the closing </head>
	 * tag of your theme, or you will break many plugins, which
	 * generally use this hook to add elements to <head> such
	 * as styles, scripts, and meta tags.
	 */
	wp_head();
	?>
</head>
<body <?php body_class(); ?>>
<?php
global $header_type, $sticky_header, $header_classes;

$page_id = pearl_get_the_id();

$header_type          = get_post_meta( $page_id, 'pearl_header_type', true );
$sticky_header        = get_post_meta( $page_id, 'pearl_sticky_header', true );
$display_under_header = get_post_meta( $page_id, 'pearl_under_header', true );

if ( is_singular( 'portfolio' ) ) {
	$header_type = get_option( 'pearl_portfolio_header_type', 'header_3' );
}

if ( 'header_1' == $header_type ) {
	$header_classes = 'header-one header-sticky header-full-width';
} else if ( 'header_3' == $header_type ) {
	$header_classes = 'header-three header-sticky';
} else if ( 'header_4' == $header_type ) {
	$header_classes = 'header-four';
} else {
	$header_classes = 'header-two';
}

if ( '1' == $sticky_header || '1' == get_option('pearl_sticky_header') ) {
	$header_classes .= ' sticky';
}

get_template_part( 'layouts/header/site-loader' );
get_template_part( 'layouts/header/menu-button' );

if ( 'header_5' == $header_type ) {
	?>
	<div class="overlay-form header-search-form">
		<span class="search-toggle"><i class="fa fa-close" aria-hidden="true"></i></span>

		<div class="header-overlay-form-wrap">
			<form action="<?php echo esc_url( home_url( '/' ) ); ?>" class="header-overlay-form">
				<i class="fa fa-search"></i>
				<input type="text" name="s" id="s" value="" placeholder="Search" autofocus>
			</form>
		</div>
	</div>
	<?php
	get_template_part( 'layouts/header/header-5' );
}
?>
<!-- Page Wrapper -->
<div id="page-wrapper" class="page-wrapper">
	<?php
	if ( 'header_5' != $header_type ) {

		if ( 'header_4' == $header_type ) {
			get_template_part( 'layouts/header/header-4' );
		} else {
			get_template_part( 'layouts/header/header' );
		}
	}

	if ( 'slider' == $display_under_header ) {
		get_template_part( 'layouts/slider/slider-1' );
	} else {
		get_template_part( 'layouts/banner/banner' );
	}
	?>