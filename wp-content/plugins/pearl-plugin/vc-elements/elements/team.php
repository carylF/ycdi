<?php
/*
Element Description: Team Posts
*/

// Element Class
class Pearl_VC_Team extends WPBakeryShortCode {

	// Element Init
	function __construct() {
		add_action( 'init', array( $this, 'element_mapping' ) );
		add_shortcode( 'pearl_team', array( $this, 'element_output' ) );
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
				'name'        => esc_html__( 'Pearl Team', 'pearl-plugin' ),
				'base'        => 'pearl_team',
				'description' => esc_html__( 'Display team members.', 'pearl-plugin' ),
				'category'    => esc_html__( 'Antarctica Theme', 'pearl-plugin' ),
				'params'      => array(

					array(
						'type'        => 'dropdown',
						'holder'      => 'p',
						'class'       => 'team-style',
						'heading'     => esc_html__( 'Team Style', 'pearl-plugin' ),
						'param_name'  => 'team_style',
						'std'         => 'overlay',
						'value'       => array(
							esc_html__( 'Overlay', 'pearl-plugin' ) => 'overlay',
							esc_html__( 'Simple', 'pearl-plugin' )  => 'simple',
						),
						'description' => esc_html__( 'Choose a team style you want to display members in.', 'pearl-plugin' ),
					),
					array(
						'type'        => 'dropdown',
						'holder'      => 'p',
						'class'       => 'number-of-posts',
						'heading'     => esc_html__( 'Number of posts', 'pearl-plugin' ),
						'param_name'  => 'number',
						'value' => array( 'All', 4, 8, 12 ),
					)
				)
			)
		);

	}


	// Element HTML
	public function element_output( $attr ) {

		$team_style = '';

		// Params extraction
		extract(
			shortcode_atts(
				array(
					'team_style' => '',
					'number'     => '4'
				),
				$attr
			)
		);

		ob_start();

		$team_class = ( 'simple' == $team_style ) ? 2 : 1;

		?>
		<section class="our-team our-team-<?php echo $team_class; ?>">
			<div class="row">
				<?php
					$args = array(
						'post_type'      => 'team',
						'posts_per_page' => ( 'All' === $number ) ? -1 : intval($number),
						'meta_key'       => '_thumbnail_id',
						'meta_compare'   => 'EXISTS'
					);

					$query = new WP_Query( $args );

					if ( $query->have_posts() ) {
						while ( $query->have_posts() ) {
							$query->the_post();

							$metadata = get_post_custom();
							?>
							<div class="col-xs-6 col-md-3 col-team-member">
								<div class="team-member">
									<?php
										if ( ! empty( $metadata['pearl_team_bio_url'] ) ) {
											echo '<a href="' . esc_url( $metadata['pearl_team_bio_url'][0] ) . '">';
												the_post_thumbnail( 'pearl_image_size_540_570' );
											echo '</a>';
										} else {
											the_post_thumbnail( 'pearl_image_size_540_570' );
										}
									?>
									<div class="overlay">
										<div class="member-info">
											<h3 class="title"><?php the_title(); ?></h3>
											<?php
												if ( ! empty( $metadata['pearl_team_designation'] ) ) {
													echo '<p>' . esc_html( $metadata['pearl_team_designation'][0] ) . '</p>';
												}
											?>
										</div>
										<div class="social-media">
											<?php
												if ( ! empty( $metadata['pearl_team_facebook_url'] ) ) {
													echo '<a href="' . esc_url( $metadata['pearl_team_facebook_url'][0] ) . '" target="_blank"><i class="fa fa-facebook"></i></a>';
												}

												if ( ! empty( $metadata['pearl_team_twitter_url'] ) ) {
													echo '<a href="' . esc_url( $metadata['pearl_team_twitter_url'][0] ) . '" target="_blank"><i class="fa fa-twitter"></i></a>';
												}

												if ( ! empty( $metadata['pearl_team_google_url'] ) ) {
													echo '<a href="' . esc_url( $metadata['pearl_team_google_url'][0] ) . '" target="_blank"><i class="fa fa-google-plus"></i></a>';
												}

												if ( ! empty( $metadata['pearl_team_instagram_url'] ) ) {
													echo '<a href="' . esc_url( $metadata['pearl_team_instagram_url'][0] ) . '" target="_blank"><i class="fa fa-instagram"></i></a>';
												}
											?>
										</div>
									</div>
								</div>
							</div>
							<?php
						}
					}
				?>
			</div>
		</section>
		<?php

		return ob_get_clean();

	}

} // End Element Class

// Element Class Init
new Pearl_VC_Team();