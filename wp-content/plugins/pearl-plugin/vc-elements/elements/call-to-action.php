<?php
/*
Element Description: Call to Action
*/

// Element Class
class Pearl_VC_CTA extends WPBakeryShortCode {

	// Element Init
	function __construct() {
		add_action( 'init', array( $this, 'element_mapping' ) );
		add_shortcode( 'pearl_cta', array( $this, 'element_output' ) );
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
				'name'        => esc_html__( 'Pearl Call to Action', 'pearl-plugin' ),
				'base'        => 'pearl_cta',
				'description' => esc_html__( 'To display a call to action bar.', 'pearl-plugin' ),
				'category'    => esc_html__( 'Antarctica Theme', 'pearl-plugin' ),
				'params'      => array(

					array(
						'type'       => 'textfield',
						'holder'     => 'p',
						'heading'    => esc_html__( 'Text', 'pearl-plugin' ),
						'param_name' => 'cta_text',
					),
					array(
						'type'       => 'textfield',
						'holder'     => 'p',
						'heading'    => esc_html__( 'Button Text', 'pearl-plugin' ),
						'param_name' => 'cta_button',
					),
					array(
						'type'       => 'textfield',
						'holder'     => 'p',
						'class'      => 'heading',
						'heading'    => esc_html__( 'Button URL', 'pearl-plugin' ),
						'param_name' => 'cta_url',
					)
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
					'cta_text'   => '',
					'cta_button' => '',
					'cta_url'    => '',
				),
				$attr
			)
		);

		ob_start();

		if ( ! empty( $cta_text ) ) {
			?>
			<!-- Call to Action -->
			<div class="call-to-action">
				<div class="container">
					<div class="row">
						<div class="col-md-8">
							<p><?php echo esc_html( $cta_text ); ?></p>
						</div>
						<?php
							if ( ! empty( $cta_button ) && ! empty( $cta_url ) ) {
								?>
								<div class="col-md-4">
									<a class="btn"
									   href="<?php echo esc_url( $cta_url ); ?>"><?php echo esc_html( $cta_button ); ?></a>
								</div>
								<?php
							}
						?>
					</div>
				</div>
			</div>
			<?php
		}

		return ob_get_clean();

	}

} // End Element Class

// Element Class Init
new Pearl_VC_CTA();