<?php
	// site loader
	$loader_display = get_option( 'pearl_site_loader_display' );
	if ( 'hide' != $loader_display ) {

		$loader_style = get_option( 'pearl_site_loader_type', 'spinner1' );
		$loader_bg    = get_option( 'pearl_site_loader_background', '#04befc' );
		$loader_icon  = get_option( 'pearl_site_loader_image' );

		echo "<div id='antarctica-loader' data-style='" . esc_html( $loader_style ) . "' data-bg='" . esc_html( $loader_bg ) . "' data-icon='" . esc_url( $loader_icon ) . "'></div>";
	}

	do_action( 'pearl_after_site_loader' );