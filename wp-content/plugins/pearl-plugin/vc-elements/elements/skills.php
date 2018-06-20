<?php
/*
Element Description: Lead Note
*/

// Element Class
class Pearl_VC_Skills extends WPBakeryShortCode {

	// Element Init
	function __construct() {
		add_action( 'init', array( $this, 'element_mapping' ) );
		add_shortcode( 'pearl_skills', array( $this, 'element_output' ) );
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
				'name'        => esc_html__( 'Pearl Skills', 'pearl-plugin' ),
				'base'        => 'pearl_skills',
				'description' => esc_html__( 'Display Skill Bars.', 'pearl-plugin' ),
				'category'    => esc_html__( 'Antarctica Theme', 'pearl-plugin' ),
				'params'      => array(

					array(
						'type'       => 'textfield',
						'holder'     => 'p',
						'class'      => 'skill',
						'heading'    => esc_html__( 'Skill 1st', 'pearl-plugin' ),
						'param_name' => 'skill_1',
					),
					array(
						'type'       => 'textfield',
						'holder'     => 'p',
						'class'      => 'skill',
						'heading'    => esc_html__( 'Skill 2nd', 'pearl-plugin' ),
						'param_name' => 'skill_2',
					),
					array(
						'type'       => 'textfield',
						'holder'     => 'p',
						'class'      => 'skill',
						'heading'    => esc_html__( 'Skill 3rd', 'pearl-plugin' ),
						'param_name' => 'skill_3',
					),
					array(
						'type'       => 'textfield',
						'holder'     => 'p',
						'class'      => 'skill',
						'heading'    => esc_html__( 'Skill 4th', 'pearl-plugin' ),
						'param_name' => 'skill_4',
					),
					array(
						'type'       => 'textfield',
						'holder'     => 'p',
						'class'      => 'skill',
						'heading'    => esc_html__( 'Skill 5th', 'pearl-plugin' ),
						'param_name' => 'skill_5',
					),
					array(
						'type'       => 'textfield',
						'holder'     => 'p',
						'class'      => 'skill',
						'heading'    => esc_html__( 'Skill 6th', 'pearl-plugin' ),
						'param_name' => 'skill_6',
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
					'skill_1' => '',
					'skill_2' => '',
					'skill_3' => '',
					'skill_4' => '',
					'skill_5' => '',
					'skill_6' => '',
				),
				$attr
			)
		);

		ob_start();

		$skills_raw = array( $skill_1, $skill_2, $skill_3, $skill_4, $skill_5, $skill_6 );
		$skills     = array();
		foreach ( $skills_raw as $skill ) {
			if ( ! empty( $skill ) ) {
				$skills[] = explode( '-', str_replace( ' ', '', $skill ) );
			}
		}

		?>
		<div class="progress-bars">
			<?php
				foreach ( $skills as $skill ) {
					?>
					<div class="progress" data-percentage="<?php echo esc_html( $skill[1] ); ?>">
						<h5 class="title"><?php echo esc_html( $skill[0] ); ?></h5>
						<div class="progress-bar">
							<span class="progressed"></span>
							<div class="completed"></div>
						</div>
					</div>
					<?php
				}
			?>
		</div>
		<?php

		return ob_get_clean();

	}

} // End Element Class

// Element Class Init
new Pearl_VC_Skills();