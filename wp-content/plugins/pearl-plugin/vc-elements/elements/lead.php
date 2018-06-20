<?php
/*
Element Description: Lead Note
*/

// Element Class
class Pearl_VC_Lead extends WPBakeryShortCode {

	// Element Init
	function __construct() {
		add_action( 'init', array( $this, 'element_mapping' ) );
		add_shortcode( 'pearl_lead', array( $this, 'element_output' ) );
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
				'name'        => esc_html__( 'Pearl Lead Note', 'pearl-plugin' ),
				'base'        => 'pearl_lead',
				'description' => esc_html__( 'To display a lead statement.', 'pearl-plugin' ),
				'category'    => esc_html__( 'Antarctica Theme', 'pearl-plugin' ),
				'params'      => array(

					array(
						'type'       => 'textarea',
						'holder'     => 'p',
						'class'      => 'heading',
						'heading'    => esc_html__( 'Lead Text', 'pearl-plugin' ),
						'param_name' => 'lead_text',
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
					'lead_text' => '',
				),
				$attr
			)
		);

		ob_start();

		if ( ! empty( $lead_text ) ) {
			?>
			<div class="row">
				<div class="col-md-8 col-md-offset-2">
					<?php echo '<p class="lead text-center">' . esc_html( $lead_text ) . '</p>'; ?>
				</div>
			</div>
			<?php
		}

		return ob_get_clean();

	}

} // End Element Class

// Element Class Init
new Pearl_VC_Lead();