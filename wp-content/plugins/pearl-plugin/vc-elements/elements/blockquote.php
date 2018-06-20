<?php
/*
Element Description: Blockquote
*/

// Element Class
class Pearl_VC_Blockquote extends WPBakeryShortCode {

	// Element Init
	function __construct() {
		add_action( 'init', array( $this, 'element_mapping' ) );
		add_shortcode( 'pearl_blockquote', array( $this, 'element_output' ) );
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
				'name'        => esc_html__( 'Pearl Blockquote', 'pearl-plugin' ),
				'base'        => 'pearl_blockquote',
				'description' => esc_html__( 'Single blcokquote/testimonial with author.', 'pearl-plugin' ),
				'category'    => esc_html__( 'Antarctica Theme', 'pearl-plugin' ),
				'params'      => array(
					array(
						'type'        => 'textfield',
						'holder'      => 'p',
						'class'       => 'author',
						'heading'     => esc_html__( 'Author', 'pearl-plugin' ),
						'param_name'  => 'author',
						'std'         => '',
						'description' => esc_html__( 'Provide blockquote/testimonial author name here.', 'pearl-plugin' ),
					),
					array(
						'type'        => 'textarea',
						'holder'      => 'p',
						'class'       => 'blockquote',
						'heading'     => esc_html__( 'Blockquote/Testimonial', 'pearl-plugin' ),
						'param_name'  => 'text',
						'std'         => '',
						'description' => esc_html__( 'Provide blockquote/testimonial text here.', 'pearl-plugin' ),
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
					'author' => '',
					'text'   => ''
				),
				$attr
			)
		);

		ob_start();

		?>
		<section class="testimonial testimonial-1 sections section-padding">
			<div class="container">
				<div class="row">
					<div class="col-md-8 col-md-offset-2">
						<blockquote>
							<?php
							if ( ! empty( $text ) ) {
								echo '<p>' . esc_html( $text ) . '</p>';
							}
							?>
						</blockquote>
						<span class="line"></span>
						<?php
						if ( ! empty( $author ) ) {
							echo '<p class="author">- ' . esc_html( $author ) . '</p>';
						}
						?>
					</div>
				</div>
			</div>
		</section>
		<?php

		return ob_get_clean();

	}

} // End Element Class

// Element Class Init
new Pearl_VC_Blockquote();