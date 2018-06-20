<?php
/*
Element Description: Accordion
*/

// Element Class
class Pearl_VC_Accordions extends WPBakeryShortCode {

	// Element Init
	function __construct() {
		add_action( 'init', array( $this, 'element_mapping' ) );
		add_shortcode( 'pearl_accordions', array( $this, 'element_output' ) );
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
				'name'        => esc_html__( 'Pearl Accordions', 'pearl-plugin' ),
				'base'        => 'pearl_accordions',
				'description' => esc_html__( 'Display accordions list.', 'pearl-plugin' ),
				'category'    => esc_html__( 'Antarctica Theme', 'pearl-plugin' ),
				'params'      => array(

					// settings
					array(
						"type"        => "checkbox",
						'heading'     => esc_html__( 'Want to add icon before accordion title?', 'pearl-plugin' ),
						"param_name"  => "enable_icon_addition",
						"std"         => 'false',
						'group'      => esc_html__( 'Settings', 'pearl-plugin' ),
					),
					array(
						'type'       => 'dropdown',
						'holder'     => 'p',
						'class'      => 'accordions-style',
						'heading'    => esc_html__( 'Accordions Style', 'pearl-plugin' ),
						'param_name' => 'accordions_style',
						'std'        => 'horizontal',
						'value'      => array(
							esc_html__( 'One', 'pearl-plugin' )   => 'one',
							esc_html__( 'Two', 'pearl-plugin' )   => 'two',
							esc_html__( 'Three', 'pearl-plugin' ) => 'three',
						),
						'group'      => esc_html__( 'Settings', 'pearl-plugin' ),
					),
					array(
						'type'       => 'dropdown',
						'holder'     => 'p',
						'class'      => 'accordion-open',
						'heading'    => esc_html__( 'Opened Accordion', 'pearl-plugin' ),
						'param_name' => 'accordions_open',
						'std'        => 'full',
						'value'      => array(
							esc_html__( 'None', 'pearl-plugin' ) => 0,
							esc_html__( '1st', 'pearl-plugin' )  => 1,
							esc_html__( '2nd', 'pearl-plugin' )  => 2,
							esc_html__( '3rd', 'pearl-plugin' )  => 3,
							esc_html__( '4th', 'pearl-plugin' )  => 4,
							esc_html__( '5th', 'pearl-plugin' )  => 5,
							esc_html__( '6th', 'pearl-plugin' )  => 6,
						),
						'group'      => esc_html__( 'Settings', 'pearl-plugin' ),
					),


					// first tab
					array(
						'type'       => 'textfield',
						'holder'     => 'p',
						'heading'    => esc_html__( 'Title', 'pearl-plugin' ),
						'param_name' => 'tab_title_1',
						'group'      => esc_html__( '1st Accordion', 'pearl-plugin' ),
					),
					array(
						'type'       => 'iconpicker',
						'heading'    => esc_html__( 'Icon', 'pearl-plugin' ),
						'param_name' => 'tab_icon_1',
						'settings' => array(
							'type' => 'fontawesome'
						),
						'dependency' => array(
							'element' => 'enable_icon_addition',
							'value' => 'true',
						),
						"description" => esc_html__( 'Select icon from library.', 'pearl-plugin' ),
						'group'      => esc_html__( '1st Accordion', 'pearl-plugin' ),
					),
					array(
						'type'       => 'textarea',
						'holder'     => 'p',
						'heading'    => esc_html__( 'Description', 'pearl-plugin' ),
						'param_name' => 'tab_desc_1',
						'group'      => esc_html__( '1st Accordion', 'pearl-plugin' ),
					),


					// second tab
					array(
						'type'       => 'textfield',
						'holder'     => 'p',
						'heading'    => esc_html__( 'Title', 'pearl-plugin' ),
						'param_name' => 'tab_title_2',
						'group'      => esc_html__( '2nd Accordion', 'pearl-plugin' ),
					),
					array(
						'type'       => 'iconpicker',
						'heading'    => esc_html__( 'Icon', 'pearl-plugin' ),
						'param_name' => 'tab_icon_2',
						'settings' => array(
							'type' => 'fontawesome'
						),
						'dependency' => array(
							'element' => 'enable_icon_addition',
							'value' => 'true',
						),
						"description" => esc_html__( 'Select icon from library.', 'pearl-plugin' ),
						'group'      => esc_html__( '2nd Accordion', 'pearl-plugin' ),
					),
					array(
						'type'       => 'textarea',
						'holder'     => 'p',
						'heading'    => esc_html__( 'Description', 'pearl-plugin' ),
						'param_name' => 'tab_desc_2',
						'group'      => esc_html__( '2nd Accordion', 'pearl-plugin' ),
					),

					// third tab
					array(
						'type'       => 'textfield',
						'holder'     => 'p',
						'heading'    => esc_html__( 'Title', 'pearl-plugin' ),
						'param_name' => 'tab_title_3',
						'group'      => esc_html__( '3rd Accordion', 'pearl-plugin' ),
					),
					array(
						'type'       => 'iconpicker',
						'heading'    => esc_html__( 'Icon', 'pearl-plugin' ),
						'param_name' => 'tab_icon_3',
						'settings' => array(
							'type' => 'fontawesome'
						),
						'dependency' => array(
							'element' => 'enable_icon_addition',
							'value' => 'true',
						),
						"description" => esc_html__( 'Select icon from library.', 'pearl-plugin' ),
						'group'      => esc_html__( '3rd Accordion', 'pearl-plugin' ),
					),
					array(
						'type'       => 'textarea',
						'holder'     => 'p',
						'heading'    => esc_html__( 'Description', 'pearl-plugin' ),
						'param_name' => 'tab_desc_3',
						'group'      => esc_html__( '3rd Accordion', 'pearl-plugin' ),
					),

					// fourth tab
					array(
						'type'       => 'textfield',
						'holder'     => 'p',
						'heading'    => esc_html__( 'Title', 'pearl-plugin' ),
						'param_name' => 'tab_title_4',
						'group'      => esc_html__( '4th Accordion', 'pearl-plugin' ),
					),
					array(
						'type'       => 'iconpicker',
						'heading'    => esc_html__( 'Icon', 'pearl-plugin' ),
						'param_name' => 'tab_icon_4',
						'settings' => array(
							'type' => 'fontawesome'
						),
						'dependency' => array(
							'element' => 'enable_icon_addition',
							'value' => 'true',
						),
						"description" => esc_html__( 'Select icon from library.', 'pearl-plugin' ),
						'group'      => esc_html__( '4th Accordion', 'pearl-plugin' ),
					),
					array(
						'type'       => 'textarea',
						'holder'     => 'p',
						'heading'    => esc_html__( 'Description', 'pearl-plugin' ),
						'param_name' => 'tab_desc_4',
						'group'      => esc_html__( '4th Accordion', 'pearl-plugin' ),
					),

					// fifth tab
					array(
						'type'       => 'textfield',
						'holder'     => 'p',
						'heading'    => esc_html__( 'Title', 'pearl-plugin' ),
						'param_name' => 'tab_title_5',
						'group'      => esc_html__( '5th Accordion', 'pearl-plugin' ),
					),
					array(
						'type'       => 'iconpicker',
						'heading'    => esc_html__( 'Icon', 'pearl-plugin' ),
						'param_name' => 'tab_icon_5',
						'settings' => array(
							'type' => 'fontawesome'
						),
						'dependency' => array(
							'element' => 'enable_icon_addition',
							'value' => 'true',
						),
						"description" => esc_html__( 'Select icon from library.', 'pearl-plugin' ),
						'group'      => esc_html__( '5th Accordion', 'pearl-plugin' ),
					),
					array(
						'type'       => 'textarea',
						'holder'     => 'p',
						'heading'    => esc_html__( 'Description', 'pearl-plugin' ),
						'param_name' => 'tab_desc_5',
						'group'      => esc_html__( '5th Accordion', 'pearl-plugin' ),
					),

					// sixth tab
					array(
						'type'       => 'textfield',
						'holder'     => 'p',
						'heading'    => esc_html__( 'Title', 'pearl-plugin' ),
						'param_name' => 'tab_title_6',
						'group'      => esc_html__( '6th Accordion', 'pearl-plugin' ),
					),
					array(
						'type'       => 'iconpicker',
						'heading'    => esc_html__( 'Icon', 'pearl-plugin' ),
						'param_name' => 'tab_icon_6',
						'settings' => array(
							'type' => 'fontawesome'
						),
						'dependency' => array(
							'element' => 'enable_icon_addition',
							'value' => 'true',
						),
						"description" => esc_html__( 'Select icon from library.', 'pearl-plugin' ),
						'group'      => esc_html__( '6th Accordion', 'pearl-plugin' ),
					),
					array(
						'type'       => 'textarea',
						'holder'     => 'p',
						'heading'    => esc_html__( 'Description', 'pearl-plugin' ),
						'param_name' => 'tab_desc_6',
						'group'      => esc_html__( '6th Accordion', 'pearl-plugin' ),
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
					'accordions_style' => '',
					'accordions_open'  => '',
				),
				$attr
			)
		);

		$title_list = $desc_list = $icon_list = array();

		for ( $i = 1; $i <= 6; $i ++ ) {
			$title_list[] = isset( $attr[ 'tab_title_' . $i ] ) ? $attr[ 'tab_title_' . $i ] : '';
			$desc_list[]  = isset( $attr[ 'tab_desc_' . $i ] ) ? $attr[ 'tab_desc_' . $i ] : '';
			$icon_list[]  = isset( $attr[ 'tab_icon_' . $i ] ) ? $attr[ 'tab_icon_' . $i ] : '';
		}

		ob_start();
		
		?>
		<div class="accordion accordion-<?php echo esc_attr( $accordions_style ); ?>">
			<?php
				if ( ! empty( $title_list ) && ! empty( $desc_list ) ) {

					for ( $i = 0; $i <= 6; $i ++ ) {

						if ( ! empty( $title_list[ $i ] ) && ! empty( $desc_list[ $i ] ) ) {

							$opened = ( $accordions_open == ( $i + 1 ) ) ? 'opened' : '';

							?>
							<div class="accordion-sections <?php echo esc_attr( $opened ); ?>">
								<div class="accordion-header">
									<?php echo '<i class="' . esc_html( $icon_list[ $i ] ) . '"></i>'; ?>
									<?php echo '<h3 class="title">' . esc_html( $title_list[ $i ] ) . '</h3>'; ?>
									<i class="fa fa-caret fa-caret-up"></i>
								</div>
								<div class="accordion-content">
									<?php echo '<p>' . ( $desc_list[ $i ] ) . '</p>'; ?>
								</div>
							</div>
							<?php
						}
					}
				}
			?>
		</div>
		<?php

		return ob_get_clean();

	}

} // End Element Class

// Element Class Init
new Pearl_VC_Accordions();