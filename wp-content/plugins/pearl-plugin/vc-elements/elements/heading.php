<?php
/*
Element Description: Heading
*/

// Element Class
class Pearl_VC_Heading extends WPBakeryShortCode {

	// Element Init
	function __construct() {
		add_action( 'init', array( $this, 'element_mapping' ) );
		add_shortcode( 'pearl_heading', array( $this, 'element_output' ) );
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
				'name'        => esc_html__( 'Pearl Heading', 'pearl-plugin' ),
				'base'        => 'pearl_heading',
				'description' => esc_html__( 'Main Heading.', 'pearl-plugin' ),
				'category'    => esc_html__( 'Antarctica Theme', 'pearl-plugin' ),
				'params'      => array(
					array(
						'type'        => 'textfield',
						'holder'      => 'strong',
						'class'       => 'smart-heading',
						'heading'     => esc_html__( 'Smart Heading', 'pearl-plugin' ),
						'param_name'  => 'smart_heading',
						'description' => esc_html__( 'Smart heading will be displayed above main heading.', 'pearl-plugin' ),
						'group'       => 'Content',
					),
					array(
						'type'        => 'textfield',
						'holder'      => 'h3',
						'class'       => 'heading',
						'heading'     => esc_html__( 'Heading', 'pearl-plugin' ),
						'param_name'  => 'heading',
						'description' => esc_html__( 'Provide main heading here.', 'pearl-plugin' ),
						'group'       => 'Content',
					),
					array(
						'type'        => 'textarea',
						'holder'      => 'p',
						'class'       => 'smart_description',
						'heading'     => esc_html__( 'Smart Description', 'pearl-plugin' ),
						'param_name'  => 'smart_description',
						'description' => esc_html__( 'Smart description will be displayed right after main heading.', 'pearl-plugin' ),
						'group'       => 'Content',
					),
					array(
						'type'        => 'textarea',
						'holder'      => 'p',
						'class'       => 'description',
						'heading'     => esc_html__( 'Description', 'pearl-plugin' ),
						'param_name'  => 'description',
						'description' => esc_html__( 'Provide long description here.', 'pearl-plugin' ),
						'group'       => 'Content',
					),
					array(
						'type'       => 'dropdown',
						'holder'     => 'p',
						'class'      => 'heading-style',
						'heading'    => esc_html__( 'Heading Style', 'pearl-plugin' ),
						'param_name' => 'heading_style',
						'value'      => array(
							esc_html__( 'Default', 'pearl-plugin' ) => 'default',
							esc_html__( 'Bold', 'pearl-plugin' )    => 'bold',
						),
						'group'      => 'Settings',
					),
					array(
						'type'       => 'dropdown',
						'holder'     => 'p',
						'class'      => 'heading-color-style',
						'heading'    => esc_html__( 'Heading Color Style', 'pearl-plugin' ),
						'param_name' => 'heading_color_style',
						'value'      => array(
							esc_html__( 'Default', 'pearl-plugin' ) => 'default',
							esc_html__( 'White', 'pearl-plugin' )    => 'white',
						),
						'group'      => 'Settings',
					),
					array(
						'type'       => 'dropdown',
						'holder'     => 'p',
						'class'      => 'text-align',
						'heading'    => esc_html__( 'Text Alignment', 'pearl-plugin' ),
						'param_name' => 'text_align',
						'value'      => array(
							esc_html__( 'Center', 'pearl-plugin' ) => 'center',
							esc_html__( 'Left', 'pearl-plugin' )   => 'left',
						),
						'group'      => 'Settings',
					),
					array(
						'type'       => 'dropdown',
						'holder'     => 'p',
						'class'      => 'smart-heading-style',
						'heading'    => esc_html__( 'Smart Heading Style', 'pearl-plugin' ),
						'param_name' => 'smart_style',
						'value'      => array(
							esc_html__( 'Default', 'pearl-plugin' ) => 'default',
							esc_html__( 'Fade', 'pearl-plugin' )    => 'fade',
						),
						'group'      => 'Settings',
					),
					array(
						'type'       => 'dropdown',
						'holder'     => 'p',
						'class'      => 'separator-style',
						'heading'    => esc_html__( 'Separator Style', 'pearl-plugin' ),
						'param_name' => 'separator',
						'value'      => array(
							esc_html__( 'First', 'pearl-plugin' )  => 'first',
							esc_html__( 'Second', 'pearl-plugin' ) => 'second',
						),
						'group'      => 'Settings',
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
					'smart_heading'       => '',
					'heading'             => '',
					'smart_description'   => '',
					'description'         => '',
					'heading_style'       => '',
					'heading_color_style' => '',
					'text_align'          => '',
					'smart_style'         => '',
					'separator'           => '',
				),
				$attr
			)
		);

		$text_align  = ( 'left' == $text_align ) ? '' : 'text-center';
		$smart_style = ( 'fade' == $smart_style ) ? 'fade-style' : '';
		$heading_color_style = ( 'white' == $heading_color_style ) ? 'white' : 'default';

		ob_start();

		?>
		<div class="heading-color-<?php echo esc_attr( $heading_color_style ); ?>">
			<header class="section-header <?php echo esc_attr( $text_align ); ?>">
				<?php
				if ( ! empty( $smart_heading ) ) {
					echo '<h3 class="section-sub-title ' . esc_attr( $smart_style ) . '">' . esc_html( $smart_heading ) . '</h3>';
				}

				if ( ! empty( $heading ) ) {
					echo '<h2 class="section-title ' . esc_attr( $heading_style ) . '">' . esc_html( $heading ) . '</h2>';
				}

				if ( 'second' == $separator ) {
					echo '<span class="line-two"><span></span></span>';
				} else {
					echo '<span class="line"></span>';
				}

				if ( ! empty( $smart_description ) ) {
					echo '<p>' . esc_html( $smart_description ) . '</p>';
				}
				if ( ! empty( $description ) ) {
					echo '<p>' . esc_html( $description ) . '</p>';
				}
				?>
			</header>
		</div>
		<?php

		return ob_get_clean();

	}

} // End Element Class

// Element Class Init
new Pearl_VC_Heading();