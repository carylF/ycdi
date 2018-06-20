<?php
/*
Element Description: Testimonials Posts
*/

// Element Class
class Pearl_VC_Testimonials extends WPBakeryShortCode {

	// Element Init
	function __construct() {
		add_action( 'init', array( $this, 'element_mapping' ) );
		add_shortcode( 'pearl_testimonials', array( $this, 'element_output' ) );
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
				'name'        => esc_html__( 'Pearl Testimonials', 'pearl-plugin' ),
				'base'        => 'pearl_testimonials',
				'description' => esc_html__( 'Display testimonials carousel.', 'pearl-plugin' ),
				'category'    => esc_html__( 'Antarctica Theme', 'pearl-plugin' ),
				'params'      => array(
					array(
						'type'        => 'dropdown',
						'holder'      => 'p',
						'class'       => 'posts-number',
						'heading'     => esc_html__( 'Number of Testimonial Posts', 'pearl-plugin' ),
						'description' => esc_html__( 'Choose a blog style you want to display posts in.', 'pearl-plugin' ),
						'param_name'  => 'number',
						'std'         => 3,
						'value'       => array( 1, 2, 3, 4, 5, 6, 7, 8, 9, 10 ),
					)
				),
			)
		);
	}

	// Element HTML
	public function element_output( $attr ) {

		// Params extraction
		extract(
			shortcode_atts(
				array(
					'number' => ''
				),
				$attr
			)
		);

		$number = ( empty( $number ) ) ? 3 : $number;

		ob_start();

		?>
		<section class="testimonial testimonial-2">
			<div class="container">
				<div class="row">
					<div class="col-md-8 col-md-offset-2">
						<div class="testimonial-carousel owl-carousel owl-theme">
							<?php
							$args = array(
								'post_type'      => 'testimonial',
								'posts_per_page' => $number
							);

							$query = new WP_Query( $args );

							if ( $query->have_posts() ) {
								while ( $query->have_posts() ) {
									$query->the_post();
									$metadata = get_post_custom();
									?>
									<div class="item text-center">
										<i class="quote-icon"></i>
										<div class="description">
											<?php the_content(); ?>
										</div>
										<div class="author-info">
											<?php

											the_post_thumbnail( 'thumbnail' );

											$author_title = str_replace( '&#8220;', "<span>", get_the_title() );
											echo '<h5>' . str_replace( '&#8221;', "</span>", $author_title ) . '</h5>';

											if ( ! empty( $metadata['pearl_testimonial_designation'] ) ) {
												echo '<p>' . esc_html( $metadata['pearl_testimonial_designation'][0] ) . '</p>';
											}

											?>
										</div>
									</div>
									<?php
								}
							}
							wp_enqueue_style( 'owl-carousel' );
							wp_enqueue_style( 'owl-theme-default' );
							wp_enqueue_script( 'owl-carousel' );
							?>
						</div>
					</div>
				</div>
			</div>
		</section>
		<?php

		return ob_get_clean();

	}

} // End Element Class

// Element Class Init
new Pearl_VC_Testimonials();