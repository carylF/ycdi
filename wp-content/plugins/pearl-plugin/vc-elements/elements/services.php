<?php
/*
Element Description: Services list carousel
*/

// Element Class
class Pearl_VC_Services extends WPBakeryShortCode {

	// Element Init
	function __construct() {
		add_action( 'init', array( $this, 'element_mapping' ) );
		add_shortcode( 'pearl_services', array( $this, 'element_output' ) );
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
				'name'        => esc_html__( 'Pearl Services Carousel', 'pearl-plugin' ),
				'base'        => 'pearl_services',
				'description' => esc_html__( 'List of added services.', 'pearl-plugin' ),
				'category'    => esc_html__( 'Antarctica Theme', 'pearl-plugin' ),
				'params'      => array(

					array(
						'type'        => 'dropdown',
						'holder'      => 'p',
						'class'       => 'number-fo-services',
						'heading'     => esc_html__( 'No of Services', 'pearl-plugin' ),
						'description' => esc_html__( 'Select a number of services you want to display.', 'pearl-plugin' ),
						'param_name'  => 'number',
						'value'       => array( 3, 6, 9, 12, 15 )
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
					'number' => '3',
				),
				$attr
			)
		);

		ob_start();

		$args = array(
			'post_type'      => 'service',
			'posts_per_page' => $number
		);

		$query = new WP_Query( $args );

		if ( $query->have_posts() ) {
			?>
			<div class="our-services-carousel owl-carousel owl-theme">
				<?php
					while ( $query->have_posts() ) {
						$query->the_post();
						$metadata = get_post_custom();
						?>
						<div class="service-item">
							<h3 class="title"><?php the_title(); ?></h3>
							<?php

								if ( ! empty( $metadata['pearl_service_description'] ) ) {
									echo '<p>' . esc_html( $metadata['pearl_service_description'][0] ) . '</p>';
								}

								if ( ! empty( $metadata['pearl_service_button'] ) && ! empty( $metadata['pearl_service_button_url'] ) ) {
									echo '<a href="' . esc_url( $metadata['pearl_service_button_url'][0] ) . '" class="btn btn-primary">' . esc_html( $metadata['pearl_service_button'][0] ) . '</a>';
								}
							?>
						</div>
						<?php

					}
				?>
			</div>
			<?php
			wp_enqueue_style( 'owl-carousel' );
			wp_enqueue_style( 'owl-theme-default' );
			wp_enqueue_script( 'owl-carousel' );
		}

		return ob_get_clean();

	}

} // End Element Class

// Element Class Init
new Pearl_VC_Services();