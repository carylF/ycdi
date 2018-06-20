<?php
/*
Element Description: Feature Box
*/

// Element Class
class Pearl_VC_FeatureBox extends WPBakeryShortCode {

	// Element Init
	function __construct() {
		add_action( 'init', array( $this, 'element_mapping' ) );
		add_shortcode( 'pearl_feature_box', array( $this, 'element_output' ) );
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
				'name'        => esc_html__( 'Pearl Feature Box', 'pearl-plugin' ),
				'base'        => 'pearl_feature_box',
				'description' => esc_html__( 'Feature box to list any single feature or service.', 'pearl-plugin' ),
				'category'    => esc_html__( 'Antarctica Theme', 'pearl-plugin' ),
				'params'      => array(
					array(
						'type'       => 'textfield',
						'holder'     => 'p',
						'heading'    => esc_html__( 'Smart Heading', 'pearl-plugin' ),
						'param_name' => 'smart_heading',
					),
					array(
						'type'       => 'textfield',
						'holder'     => 'p',
						'class'      => 'heading',
						'heading'    => esc_html__( 'Heading', 'pearl-plugin' ),
						'param_name' => 'heading',
					),
					array(
						'type'       => 'textarea',
						'holder'     => 'p',
						'class'      => 'smart-description',
						'heading'    => esc_html__( 'Smart Description', 'pearl-plugin' ),
						'param_name' => 'smart_description',
					),
					array(
						'type'       => 'textarea_html',
						'holder'     => 'p',
						'class'      => 'description',
						'heading'    => esc_html__( 'Description', 'pearl-plugin' ),
						'param_name' => 'content',
					),
					array(
						'type'       => 'textfield',
						'holder'     => 'p',
						'class'      => 'button-text',
						'heading'    => esc_html__( 'Button Text', 'pearl-plugin' ),
						'param_name' => 'button_text',
					),
					array(
						'type'       => 'textfield',
						'holder'     => 'p',
						'class'      => 'button-url',
						'heading'    => esc_html__( 'Button URL', 'pearl-plugin' ),
						'param_name' => 'url',
					),
					array(
						'type'       => 'dropdown',
						'holder'     => 'p',
						'heading'    => esc_html__( 'Feature Box Style', 'pearl-plugin' ),
						'param_name' => 'fbc_style',
						'value'      => array(
							'One'   => 'default',
							'Two'   => 'two',
							'Three' => 'three',
						),
						'group'      => esc_html__( 'Style', 'pearl-plugin' ),
					),
					array(
						'type'       => 'dropdown',
						'holder'     => 'p',
						'heading'    => esc_html__( 'Feature Box Content Alignment', 'pearl-plugin' ),
						'param_name' => 'fbc_alignment',
						'value'      => array(
							'Default' => 'default',
							'Center'  => 'center',
						),
						'group'      => esc_html__( 'Style', 'pearl-plugin' ),
					),
					array(
						'type'       => 'dropdown',
						'holder'     => 'p',
						'heading'    => esc_html__( 'Heading', 'pearl-plugin' ),
						'param_name' => 'heading_style',
						'value'      => array(
							'Simple'    => 'simple',
							'Underline' => 'underline',
						),
						'group'      => esc_html__( 'Style', 'pearl-plugin' ),
					),
					array(
						'type'       => 'dropdown',
						'holder'     => 'p',
						'heading'    => esc_html__( 'Smart Description Color', 'pearl-plugin' ),
						'param_name' => 'smart_desc_color',
						'value'      => array(
							'Fade' => 'fade',
							'Dark' => 'dark',
						),
						'group'      => esc_html__( 'Style', 'pearl-plugin' ),
					),
					array(
						'type'       => 'dropdown',
						'holder'     => 'p',
						'heading'    => esc_html__( 'Smart Description Style', 'pearl-plugin' ),
						'param_name' => 'smart_desc_style',
						'value'      => array(
							'Simple' => 'simple',
							'Italic' => 'italic',
						),
						'group'      => esc_html__( 'Style', 'pearl-plugin' ),
					),
					array(
						'type'       => 'dropdown',
						'holder'     => 'p',
						'heading'    => esc_html__( 'Description Style', 'pearl-plugin' ),
						'param_name' => 'desc_style',
						'value'      => array(
							'Light' => 'light',
							'Dark'  => 'dark',
						),
						'group'      => esc_html__( 'Style', 'pearl-plugin' ),
					),
					array(
						'type'       => 'dropdown',
						'holder'     => 'p',
						'class'      => 'button-style',
						'heading'    => esc_html__( 'Button Type', 'pearl-plugin' ),
						'param_name' => 'button_style',
						'value'      => array(
							'Default' => 'default',
							'Outline' => 'outline',
							'Icon'    => 'icon',
							'Link'    => 'link',
						),
						'group'      => esc_html__( 'Style', 'pearl-plugin' ),
					),
					array(
						'type'       => 'dropdown',
						'holder'     => 'p',
						'heading'    => esc_html__( 'Button Color', 'pearl-plugin' ),
						'param_name' => 'button_color',
						'value'      => array(
							'Default' => 'default',
							'Black'   => 'btn-black',
						),
						'dependency' => array(
							'element' => 'button_style',
							'value'   => array( 'default', 'outline' ),
						),
						'group'      => esc_html__( 'Style', 'pearl-plugin' ),
					),
					array(
						'type'       => 'dropdown',
						'holder'     => 'p',
						'heading'    => esc_html__( 'Button Size', 'pearl-plugin' ),
						'param_name' => 'button_size',
						'value'      => array(
							'Default' => 'default',
							'Small'   => 'btn-small',
							'Medium'  => 'btn-medium',
							'Large'   => 'btn-large',
						),
						'dependency' => array(
							'element' => 'button_style',
							'value'   => array( 'default', 'outline' ),
						),
						'group'      => esc_html__( 'Style', 'pearl-plugin' ),
					),
				)
			)
		);

	}


	// Element HTML
	public function element_output( $attr, $content = null ) {

		// Params extraction
		extract(
			shortcode_atts(
				array(
					'smart_heading'     => '',
					'heading'           => '',
					'smart_description' => '',
					'description'       => '',
					'url'               => '',
					'button_text'       => '',
					'button_style'      => '',
					'button_color'      => '',
					'button_size'       => '',
					'style'             => '',
					'fbc_style'         => '',
					'fbc_alignment'     => '',
					'heading_style'     => '',
					'smart_desc_color'  => '',
					'smart_desc_style'  => '',
					'desc_style'        => '',
				),
				$attr
			)
		);

		ob_start();

		$content = wpb_js_remove_wpautop( $content, true );

		$button_classes = 'btn btn-primary';
		$icon           = '';

		// heading style config
		if ( 'underline' == $heading_style ) {
			$heading_classes = ' title-underline title';
		} else {
			$heading_classes = '';
		}

		// smart description style config
		$smart_desc_classes = 'smart-description';
		if ( 'dark' == $smart_desc_color ) {
			$smart_desc_classes .= ' dark';
		}

		if ( 'italic' == $smart_desc_color ) {
			$smart_desc_classes .= ' italic';
		}

		// description config
		$desc_classes = '';
		if ( 'dark' == $desc_style ) {
			$desc_classes .= ' dark';
		}

		// button style config
		if ( 'outline' == $button_style ) {
			if ( 'btn-black' == $button_color ) {
				$button_classes .= ' btn-outline-black';
			} else {
				$button_classes .= ' btn-outline';
			}
		} else if ( 'link' == $button_style ) {
			$button_classes = ' btn-link text-uppercase';
			$icon           = '<i class="fa fa-chevron-circle-right" aria-hidden="true"></i>';
		} else if ( 'icon' == $button_style ) {
			$button_classes .= ' btn-wide btn-icon';
			$icon = '<i class="fa fa-angle-right" aria-hidden="true"></i>';
		} else {
			if ( 'btn-black' == $button_color ) {
				$button_classes .= ' ' . $button_color;
			}
		}

		if ( 'default' != $button_size ) {
			$button_classes .= ' ' . $button_size;
		}

		$fbc_classes = $fbc_style;

		if ( 'center' == $fbc_alignment ) {
			$fbc_classes .= ' text-center';
		}
		?>
		<div class="feature-box <?php echo esc_attr( $fbc_classes ); ?>">
			<?php

			if ( ! empty( $smart_heading ) ) {
				echo '<span class="section-sub-title">' . esc_html( $smart_heading ) . '</span>';
			}

			if ( ! empty( $heading ) ) {
				echo '<h3 class="text-uppercase ' . esc_attr( $heading_classes ) . '">' . esc_html( $heading ) . '</h3>';
			}

			if ( ! empty( $smart_description ) ) {
				echo '<p class="' . esc_attr( $smart_desc_classes ) . '">' . esc_html( $smart_description ) . '</p>';
			}

			if ( ! empty( $content ) ) {
				echo '<div class="' . esc_attr( $desc_classes ) . '">' . $content . '</div>';
			}

			if ( ! empty( $url ) && ! empty( $button_text ) ) {
				echo '<a href="' . esc_url( $url ) . '" class="' . esc_attr( $button_classes ) . '">' . esc_html( $button_text ) . $icon . '</a>';
			}

			?>
		</div>
		<?php

		return ob_get_clean();

	}

} // End Element Class

// Element Class Init
new Pearl_VC_FeatureBox();