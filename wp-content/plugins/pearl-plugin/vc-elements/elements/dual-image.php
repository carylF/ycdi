<?php
/*
Element Description: Dual Image
*/

// Element Class
class Pearl_VC_Dual_Image extends WPBakeryShortCode {

	// Element Init
	function __construct() {
		add_action( 'init', array( $this, 'element_mapping' ) );
		add_shortcode( 'pearl_dual_image', array( $this, 'element_output' ) );
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
				'name'        => esc_html__( 'Pearl Dual Image', 'pearl-plugin' ),
				'base'        => 'pearl_dual_image',
				'description' => esc_html__( 'Dual image box with hyperlink.', 'pearl-plugin' ),
				'category'    => esc_html__( 'Antarctica Theme', 'pearl-plugin' ),
				'params'      => array(
					array(
						'type'       => 'attach_image',
						'holder'     => 'p',
						'heading'    => esc_html__( 'Left Image', 'pearl-plugin' ),
						'param_name' => 'image_1',
					),
					array(
						'type'       => 'textfield',
						'holder'     => 'p',
						'heading'    => esc_html__( 'Left Image Link', 'pearl-plugin' ),
						'param_name' => 'image_link_1',
					),
					array(
						'type'       => 'attach_image',
						'holder'     => 'p',
						'heading'    => esc_html__( 'Right Image', 'pearl-plugin' ),
						'param_name' => 'image_2',
					),
					array(
						'type'       => 'textfield',
						'holder'     => 'p',
						'heading'    => esc_html__( 'Right Image Link', 'pearl-plugin' ),
						'param_name' => 'image_link_2',
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
					'image_1' => '',
					'image_2' => '',
					'image_link_1' => '',
					'image_link_2' => '',
				),
				$attr
			)
		);

		ob_start();
?>
		<div class="images-container">
			<?php
				if ( ! empty(  $image_1 ) ) {

						$left_image_url = wp_get_attachment_image_url( $image_1, 'full' );

						if( ! empty( $image_link_1 ) ) {
							echo '<a class="img-hover img-one" href="'. esc_url($image_link_1)  .'"><img class="img-responsive" src="'. esc_url($left_image_url) .'" alt="Image"></a>';
						} else {
							echo '<img class="img-one img-responsive" src="'. esc_url($left_image_url) .'" alt="Image">';
						}
				}


				if ( ! empty(  $image_2 ) ) {

					$right_image_url = wp_get_attachment_image_url( $image_2, 'full' );

					if( ! empty( $image_link_2 ) ) {
						echo '<a class="img-hover img-two" href="'. esc_url($image_link_2)  .'"><img class="img-responsive" src="'. esc_url($right_image_url) .'" alt="Image"></a>';
					} else {
						echo '<img class="img-two img-responsive" src="'. esc_url($right_image_url) .'" alt="Image">';
					}
				}
			?>
		</div>
<?php

		return ob_get_clean();

	}

} // End Element Class

// Element Class Init
new Pearl_VC_Dual_Image();