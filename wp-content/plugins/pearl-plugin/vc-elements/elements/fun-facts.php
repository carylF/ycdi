<?php
/*
Element Description: Fun Facts
*/

// Element Class
class Pearl_VC_Fun_Facts extends WPBakeryShortCode {

	// Element Init
	function __construct() {
		add_action( 'init', array( $this, 'element_mapping' ) );
		add_shortcode( 'pearl_fun_facts', array( $this, 'element_output' ) );
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
				'name'        => esc_html__( 'Pearl Fun Facts', 'pearl-plugin' ),
				'base'        => 'pearl_fun_facts',
				'description' => esc_html__( 'Display fun facts counter.', 'pearl-plugin' ),
				'category'    => esc_html__( 'Antarctica Theme', 'pearl-plugin' ),
				'params'      => array(


					array(
						'type'       => 'textfield',
						'holder'     => 'p',
						'heading'    => esc_html__( '1st Title', 'pearl-plugin' ),
						'param_name' => 'title_1',
					),
					array(
						'type'       => 'textfield',
						'holder'     => 'p',
						'heading'    => esc_html__( '1st Counter', 'pearl-plugin' ),
						'param_name' => 'count_1',
					),
					array(
						'type'       => 'textfield',
						'holder'     => 'p',
						'heading'    => esc_html__( '2nd Title', 'pearl-plugin' ),
						'param_name' => 'title_2',
					),
					array(
						'type'       => 'textfield',
						'holder'     => 'p',
						'heading'    => esc_html__( '2nd Counter', 'pearl-plugin' ),
						'param_name' => 'count_2',
					),
					array(
						'type'       => 'textfield',
						'holder'     => 'p',
						'heading'    => esc_html__( '3rd Title', 'pearl-plugin' ),
						'param_name' => 'title_3',
					),
					array(
						'type'       => 'textfield',
						'holder'     => 'p',
						'heading'    => esc_html__( '3rd Counter', 'pearl-plugin' ),
						'param_name' => 'count_3',
					),
					array(
						'type'       => 'textfield',
						'holder'     => 'p',
						'heading'    => esc_html__( '4th Title', 'pearl-plugin' ),
						'param_name' => 'title_4',
					),
					array(
						'type'       => 'textfield',
						'holder'     => 'p',
						'heading'    => esc_html__( '4th Counter', 'pearl-plugin' ),
						'param_name' => 'count_4',
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
					'title_1' => '',
					'title_2' => '',
					'title_3' => '',
					'title_4' => '',
					'count_1' => '',
					'count_2' => '',
					'count_3' => '',
					'count_4' => '',
				),
				$attr
			)
		);

		ob_start();

		$titles    = array( $title_1, $title_2, $title_3, $title_4 );
		$counts    = array( $count_1, $count_2, $count_3, $count_4 );
		$fun_facts = array();

		$k = count( $titles );
		for ( $i = 0; $i < $k; $i ++ ) {
			if ( ! empty( $titles[$i] ) ) {
				$fun_facts[$i]['title'] = $titles[$i];
				$fun_facts[$i]['count'] = $counts[$i];
			}
		}

		?>
		<!-- Counter -->
		<section class="counter counter-1 sections">
			<div class="container">
				<div class="row">
					<?php
						foreach ( $fun_facts as $fun_fact ) {
							?>
							<div class="col-xs-6 col-sm-3">
								<div class="counter-content text-center">
									<h3 class="counter-digit">
										<span data-from="0" data-to="<?php echo absint( $fun_fact['count'] ); ?>"
										      data-speed="800"><?php echo absint( $fun_fact['count'] ); ?></span><?php
										// Remove all numerals including Western Arabic (e.g. Indian):
										echo preg_replace('/\d+/u', '', $fun_fact['count']); ?>
									</h3>
									<h4 class="counter-desc"><?php echo esc_html( $fun_fact['title'] ); ?></h4>
								</div>
							</div>
							<?php
						}
					?>
				</div>
			</div>
		</section>
		<?php

		return ob_get_clean();

	}

} // End Element Class

// Element Class Init
new Pearl_VC_Fun_Facts();