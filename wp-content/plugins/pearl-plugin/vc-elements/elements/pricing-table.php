<?php
/*
Element Description: Pricing Table
*/

// Element Class
class Pearl_VC_Pricing_Table extends WPBakeryShortCode {

	// Element Init
	function __construct() {
		add_action( 'init', array( $this, 'element_mapping' ) );
		add_shortcode( 'pearl_pricing_table', array( $this, 'element_output' ) );
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
				'name'              => esc_html__( 'Pearl Pricing Table', 'pearl-plugin' ),
				'base'              => 'pearl_pricing_table',
				'description'       => esc_html__( 'Pricing Tables.', 'pearl-plugin' ),
				'category'          => esc_html__( 'Antarctica Theme', 'pearl-plugin' ),
				'admin_enqueue_css' => array( get_template_directory_uri() . '/css/vc_extend.css' ),
				'params'            => array(

					// Basic Group
					array(
						'type'       => 'dropdown',
						'holder'     => 'p',
						'class'      => 'pricing-table-style',
						'heading'    => esc_html__( 'Pricing Table Style', 'pearl-plugin' ),
						'param_name' => 'pricing_table_style',
						'value'      => array(
							esc_html__( 'One', 'pearl-plugin' )   => 'one',
							esc_html__( 'Two', 'pearl-plugin' )   => 'two',
							esc_html__( 'Three', 'pearl-plugin' ) => 'three',
						),
						'group'      => esc_html__( 'Basic', 'pearl-plugin' ),
					),
					array(
						"type"       => "checkbox",
						'heading'    => esc_html__( 'Mark this table as recommended/highlighted ?', 'pearl-plugin' ),
						"param_name" => "recommended",
						"std"        => 'false',
						'group'      => esc_html__( 'Basic', 'pearl-plugin' ),
					),
					array(
						'type'        => 'textfield',
						'holder'      => 'h3',
						'class'       => 'title',
						'heading'     => esc_html__( 'Title', 'pearl-plugin' ),
						'param_name'  => 'title',
						'description' => esc_html__( 'Provide table title.', 'pearl-plugin' ),
						'group'       => esc_html__( 'Basic', 'pearl-plugin' ),
					),
					array(
						'type'        => 'textfield',
						'holder'      => 'h4',
						'class'       => 'sub-title',
						'heading'     => esc_html__( 'Sub Title', 'pearl-plugin' ),
						'param_name'  => 'sub_title',
						'description' => esc_html__( 'Provide table sub title.', 'pearl-plugin' ),
						'dependency'  => array(
							'element' => 'pricing_table_style',
							'value'   => 'one',
						),
						'group'       => esc_html__( 'Basic', 'pearl-plugin' ),
					),
					array(
						'type'        => 'textfield',
						'holder'      => 'p',
						'class'       => 'currency',
						'heading'     => esc_html__( 'Currency', 'pearl-plugin' ),
						'param_name'  => 'currency',
						'description' => esc_html__( 'Provide currency e.g: $', 'pearl-plugin' ),
						'group'       => esc_html__( 'Basic', 'pearl-plugin' ),
					),
					array(
						'type'        => 'textfield',
						'holder'      => 'p',
						'class'       => 'price',
						'heading'     => esc_html__( 'Price', 'pearl-plugin' ),
						'param_name'  => 'price',
						'description' => esc_html__( 'Provide table price.', 'pearl-plugin' ),
						'group'       => esc_html__( 'Basic', 'pearl-plugin' ),
					),
					array(
						'type'        => 'textfield',
						'holder'      => 'p',
						'class'       => 'prefix-text',
						'heading'     => esc_html__( 'Prefix Text', 'pearl-plugin' ),
						'param_name'  => 'prefix_text',
						'description' => esc_html__( 'Provide price prefix text e.g: Per Month', 'pearl-plugin' ),
						'group'       => esc_html__( 'Basic', 'pearl-plugin' ),
					),
					array(
						'type'        => 'textarea',
						'holder'      => 'p',
						'class'       => 'description',
						'heading'     => esc_html__( 'Description', 'pearl-plugin' ),
						'param_name'  => 'description',
						'description' => esc_html__( 'Provide table description.', 'pearl-plugin' ),
						'dependency'  => array(
							'element' => 'pricing_table_style',
							'value'   => 'one',
						),
						'group'       => esc_html__( 'Basic', 'pearl-plugin' ),
					),
					array(
						'type'        => 'textfield',
						'holder'      => 'p',
						'class'       => 'button-text',
						'heading'     => esc_html__( 'Button Text', 'pearl-plugin' ),
						'param_name'  => 'button_text',
						'description' => esc_html__( 'Provide table button text e.g: Sign Up', 'pearl-plugin' ),
						'dependency'  => array(
							'element' => 'pricing_table_style',
							'value'   => array( 'two', 'three' ),
						),
						'group'       => esc_html__( 'Basic', 'pearl-plugin' ),
					),
					array(
						'type'        => 'textfield',
						'holder'      => 'p',
						'class'       => 'button-url',
						'heading'     => esc_html__( 'Button URL', 'pearl-plugin' ),
						'param_name'  => 'button_url',
						'description' => esc_html__( 'Provide table button URL.', 'pearl-plugin' ),
						'dependency'  => array(
							'element' => 'pricing_table_style',
							'value'   => array( 'two', 'three' ),
						),
						'group'       => esc_html__( 'Basic', 'pearl-plugin' ),
					),

					// Pricing Table Fields Group
					array(
						"type"       => "pearl_clone_one",
						"heading"    => esc_html__( "Pricing Table Fields", "pearl-plugin" ),
						"param_name" => "table_fields",
						'dependency' => array(
							'element' => 'pricing_table_style',
							'value'   => array( 'two', 'three' ),
						),
						"group"      => 'Fields'
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
					'pricing_table_style' => 'one',
					'recommended'         => '',
					'title'               => esc_html__( 'Basic Plan', 'pearl-plugin' ),
					'sub_title'           => '',
					'currency'            => '$',
					'price'               => '100',
					'prefix_text'         => esc_html__( 'Per Month', 'pearl-plugin' ),
					'description'         => '',
					'button_text'         => '',
					'button_url'          => '',
					'table_fields'        => '',
				),
				$attr
			)
		);

		ob_start();

		$sep                   = '';
		$price_group           = '';
		$pricing_table_classes = 'pricing-table-' . $pricing_table_style;

		if ( 'true' == $recommended ) {
			$pricing_table_classes .= ' recommended';
		}

		if ( 'one' == $pricing_table_style || 'two' == $pricing_table_style ) {
			$sep = '/';
		}

		if ( ! empty( $price ) ) {
			$price_group .= '<div class="price-group">';
			$price_group .= '<span class="currency">' . esc_html( $currency ) . '</span>';
			$price_group .= '<span class="price">' . esc_html( $price ) . '</span>';
			$price_group .= '<span class="prefix-text"><span>' . $sep . '</span>' . esc_html( $prefix_text ) . '</span>';
			$price_group .= '</div>';
		}

		$table_fields = explode( '*', $table_fields );
		?>
		<div class="pricing-table <?php echo esc_attr( $pricing_table_classes ); ?>"><?php

				// Header
				if ( ! empty( $title ) || ! empty( $sub_title ) || ! empty( $price ) ) {
					echo '<header class="pricing-table-header">';

					if ( ! empty( $title ) ) {
						echo '<h3 class="title">' . esc_html( $title ) . '</h3>';
					}

					if ( 'one' == $pricing_table_style ) {
						echo '<h4 class="sub-title">' . esc_html( $sub_title ) . '</h4>';
					}

					if ( 'three' == $pricing_table_style ) {
						echo '<div class="line"></div>';
					}

					if ( 'two' == $pricing_table_style || 'three' == $pricing_table_style ) {
						echo $price_group;
					}

					echo '</header>';

					if ( 'one' == $pricing_table_style ) {
						echo $price_group;
					}
				}

				// Body
				echo '<div class="pricing-table-body">';
				if ( 'two' == $pricing_table_style || 'three' == $pricing_table_style ) {
					echo '<ul>';
					foreach ( $table_fields as $field ) {
						if ( ! empty( $field ) ) {
							if ( strpos( $field, '|' ) !== false ) {
								$field = explode( '|', $field );
								echo '<li><h5>' . $field[0] . '</h5>' . $field[1] . '</li>';
							} else {
								echo '<li>' . $field . '</li>';
							}
						}
					}
					echo '</ul>';
				} else {
					if ( ! empty( $description ) ) {
						echo '<p>' . esc_html( $description ) . '</p>';
					}
				}
				echo '</div>';

				// Footer
				if ( 'two' == $pricing_table_style || 'three' == $pricing_table_style && ! empty( $button_text ) ) {
					if ( ! empty( $button_text ) && ! empty( $button_url ) ) {
						echo '<footer class="pricing-table-footer">';
						echo '<a href="' . esc_url( $button_url ) . '" class="btn btn-primary">' . esc_html( $button_text ) . '</a>';
						echo '</footer>';
					}
				}
			?>
		</div><!-- .pricing-table -->
		<?php

		return ob_get_clean();
	}

} // End Element Class

// Element Class Init
new Pearl_VC_Pricing_Table();