<?php
/*
Element Description: Single Service Item
*/

// Element Class
class Pearl_VC_Service extends WPBakeryShortCode {

	// Element Init
	function __construct() {
		add_action( 'init', array( $this, 'element_mapping' ) );
		add_shortcode( 'pearl_service_item', array( $this, 'element_output' ) );
	}

	// Element Mapping
	public function element_mapping() {

		// Stop all if VC is not enabled
		if ( ! defined( 'WPB_VC_VERSION' ) ) {
			return;
		}

		// Map the block with vc_map()
		vc_map(

			array(
				'name'        => esc_html__( 'Pearl Service Item', 'pearl-plugin' ),
				'base'        => 'pearl_service_item',
				'description' => esc_html__( 'Single service item.', 'pearl-plugin' ),
				'category'    => esc_html__( 'Antarctica Theme', 'pearl-plugin' ),
				'params'      => array(

					array(
						'type'       => 'dropdown',
						'holder'     => 'p',
						'class'      => 'heading',
						'heading'    => esc_html__( 'Service Style', 'pearl-plugin' ),
						'param_name' => 'style',
						'value'      => array( 'Style 1' => 'style_1', 'Style 2' => 'style_2', 'Style 3' => 'style_3', 'Style 4' => 'style_4' )
					),
					array(
						'type'       => 'textfield',
						'holder'     => 'p',
						'class'      => 'heading',
						'heading'    => esc_html__( 'Heading', 'pearl-plugin' ),
						'param_name' => 'heading',
					),
					array(
						'type'       => 'textarea',
						'holder'     => 'p',
						'class'      => 'description',
						'heading'    => esc_html__( 'Description', 'pearl-plugin' ),
						'param_name' => 'description',
					),
					array(
						'type'       => 'attach_image',
						'holder'     => 'p',
						'class'      => 'icon',
						'heading'    => esc_html__( 'Icon Image', 'pearl-plugin' ),
						'param_name' => 'icon',
						'dependency' => array(
							'element' => 'style',
							'value' => array('style_1', 'style_2', 'style_3'),
						),
					),
					array(
						'type'       => 'iconpicker',
						'heading'    => esc_html__( 'Icon', 'pearl-plugin' ),
						'param_name' => 'font_icon',
						'settings' => array(
							'type' => 'fontawesome'
						),
						'dependency' => array(
							'element' => 'style',
							'value' => 'style_4',
						),
						"description" => esc_html__( 'Select icon from library.', 'pearl-plugin' ),
					),
				)
			)
		);

	}


	// Element HTML
	public function element_output( $attr ) {

		// Params extraction
		extract(
			shortcode_atts(
				array(
					'heading'     => '',
					'description' => '',
					'icon'        => '',
					'style'       => '',
					'font_icon'   => '',
				),
				$attr
			)
		);

		ob_start();

		if ( 'style_2' == $style ) {
			?>
			<div class="feature-item feature-item-2 clearfix">
				<div class="feature-img">
					<?php
						$img_url = wp_get_attachment_image_url( $icon );
						if ( ! empty( $img_url ) ) {
							echo '<img class="img-responsive" src="' . esc_url( $img_url ) . '" alt="Image">';
						}
					?>
				</div>
				<div class="feature-content">
					<?php

						if ( ! empty( $heading ) ) {
							echo '<h3 class="title">' . esc_html( $heading ) . '</h3>';
						}

						if ( ! empty( $description ) ) {
							echo '<p>' . esc_html( $description ) . '</p>';
						}
					?>
				</div>
			</div>
			<?php
		} elseif ( 'style_3' == $style ) {
			?>
			<div class="feature-item feature-item-3 clearfix">
				<div class="feature-img">
					<?php
						$img_url = wp_get_attachment_image_url( $icon );
						if ( ! empty( $img_url ) ) {
							echo '<img class="img-responsive" src="' . esc_url( $img_url ) . '" alt="Image">';
						}
					?>
				</div>
				<div class="feature-content">
					<?php

						if ( ! empty( $heading ) ) {
							echo '<h3 class="title">' . esc_html( $heading ) . '</h3>';
						}

						if ( ! empty( $description ) ) {
							echo '<p>' . esc_html( $description ) . '</p>';
						}
					?>
				</div>
				<div class="group">
					<span></span><span></span><span></span>
				</div>
			</div>
			<?php
		} elseif ( 'style_4' == $style ) {
			?>
			<div class="intro-features clearfix">
				<div class="icon-wrap">
					<?php echo '<i class="' . esc_html( $font_icon ) . '"></i>'; ?>
				</div>
				<div class="content">
					<?php
					if ( ! empty( $heading ) ) {
						echo '<h4 class="title">' . esc_html( $heading ) . '</h4>';
					}

					if ( ! empty( $description ) ) {
						echo '<p class="detail">' . esc_html( $description ) . '</p>';
					}
					?>
				</div>
			</div>
			<?php
		} else {
			?>
			<div class="services-item services-3">
				<div class="services-img">
					<?php
						$img_url = wp_get_attachment_image_url( $icon );
						if ( ! empty( $img_url ) ) {
							echo '<img class="img-responsive" src="' . esc_url( $img_url ) . '" alt="Image">';
						}
					?>
				</div>
				<div class="services-content">
					<?php

						if ( ! empty( $heading ) ) {
							echo '<h3 class="title">' . esc_html( $heading ) . '</h3><span class="line"></span>';
						}

						if ( ! empty( $description ) ) {
							echo '<p>' . esc_html( $description ) . '</p>';
						}
					?>
				</div>
			</div>
			<?php
		}

		return ob_get_clean();

	}

} // End Element Class

// Element Class Init
new Pearl_VC_Service();