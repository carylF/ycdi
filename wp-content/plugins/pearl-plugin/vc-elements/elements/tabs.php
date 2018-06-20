<?php
/*
Element Description: Tabs
*/

// Element Class
class Pearl_VC_Tabs extends WPBakeryShortCode {

	// Element Init
	function __construct() {
		add_action( 'init', array( $this, 'element_mapping' ) );
		add_shortcode( 'pearl_tabs', array( $this, 'element_output' ) );
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
				'name'        => esc_html__( 'Pearl Tabs', 'pearl-plugin' ),
				'base'        => 'pearl_tabs',
				'description' => esc_html__( 'Display tabs section.', 'pearl-plugin' ),
				'category'    => esc_html__( 'Antarctica Theme', 'pearl-plugin' ),
				'params'      => array(

					// first tab
					array(
						'type'       => 'textfield',
						'holder'     => 'p',
						'heading'    => esc_html__( 'Title', 'pearl-plugin' ),
						'param_name' => 'tab_title_1',
						'group'      => esc_html__( '1st Tab', 'pearl-plugin' ),
					),
					array(
						'type'       => 'textarea',
						'holder'     => 'p',
						'heading'    => esc_html__( 'Description', 'pearl-plugin' ),
						'param_name' => 'tab_desc_1',
						'group'      => esc_html__( '1st Tab', 'pearl-plugin' ),
					),


					// second tab
					array(
						'type'       => 'textfield',
						'holder'     => 'p',
						'heading'    => esc_html__( 'Title', 'pearl-plugin' ),
						'param_name' => 'tab_title_2',
						'group'      => esc_html__( '2nd Tab', 'pearl-plugin' ),
					),
					array(
						'type'       => 'textarea',
						'holder'     => 'p',
						'heading'    => esc_html__( 'Description', 'pearl-plugin' ),
						'param_name' => 'tab_desc_2',
						'group'      => esc_html__( '2nd Tab', 'pearl-plugin' ),
					),

					// third tab
					array(
						'type'       => 'textfield',
						'holder'     => 'p',
						'heading'    => esc_html__( 'Title', 'pearl-plugin' ),
						'param_name' => 'tab_title_3',
						'group'      => esc_html__( '3rd Tab', 'pearl-plugin' ),
					),
					array(
						'type'       => 'textarea',
						'holder'     => 'p',
						'heading'    => esc_html__( 'Description', 'pearl-plugin' ),
						'param_name' => 'tab_desc_3',
						'group'      => esc_html__( '3rd Tab', 'pearl-plugin' ),
					),

					// fourth tab
					array(
						'type'       => 'textfield',
						'holder'     => 'p',
						'heading'    => esc_html__( 'Title', 'pearl-plugin' ),
						'param_name' => 'tab_title_4',
						'group'      => esc_html__( '4th Tab', 'pearl-plugin' ),
					),
					array(
						'type'       => 'textarea',
						'holder'     => 'p',
						'heading'    => esc_html__( 'Description', 'pearl-plugin' ),
						'param_name' => 'tab_desc_4',
						'group'      => esc_html__( '4th Tab', 'pearl-plugin' ),
					),

					// fifth tab
					array(
						'type'       => 'textfield',
						'holder'     => 'p',
						'heading'    => esc_html__( 'Title', 'pearl-plugin' ),
						'param_name' => 'tab_title_5',
						'group'      => esc_html__( '5th Tab', 'pearl-plugin' ),
					),
					array(
						'type'       => 'textarea',
						'holder'     => 'p',
						'heading'    => esc_html__( 'Description', 'pearl-plugin' ),
						'param_name' => 'tab_desc_5',
						'group'      => esc_html__( '5th Tab', 'pearl-plugin' ),
					),

					// sixth tab
					array(
						'type'       => 'textfield',
						'holder'     => 'p',
						'heading'    => esc_html__( 'Title', 'pearl-plugin' ),
						'param_name' => 'tab_title_6',
						'group'      => esc_html__( '6th Tab', 'pearl-plugin' ),
					),
					array(
						'type'       => 'textarea',
						'holder'     => 'p',
						'heading'    => esc_html__( 'Description', 'pearl-plugin' ),
						'param_name' => 'tab_desc_6',
						'group'      => esc_html__( '6th Tab', 'pearl-plugin' ),
					),

					// settings
					array(
						'type'       => 'dropdown',
						'holder'     => 'p',
						'class'      => 'tabs-style',
						'heading'    => esc_html__( 'Tabs Style', 'pearl-plugin' ),
						'param_name' => 'tabs_style',
						'std'        => 'horizontal',
						'value'      => array(
							esc_html__( 'Horizontal', 'pearl-plugin' ) => 'horizontal',
							esc_html__( 'Vertical', 'pearl-plugin' )   => 'vertical',
						),
						'group'      => esc_html__( 'Settings', 'pearl-plugin' ),
					),
					array(
						'type'       => 'dropdown',
						'holder'     => 'p',
						'class'      => 'tabs-length',
						'heading'    => esc_html__( 'Tabs Length', 'pearl-plugin' ),
						'param_name' => 'tabs_length',
						'std'        => 'full',
						'value'      => array(
							esc_html__( 'Full', 'pearl-plugin' )  => 'full',
							esc_html__( 'Auto', 'pearl-plugin' ) => 'not-full',
						),
						'dependency' => array( 'element' => 'tabs_style', 'value' => 'horizontal' ),
						'group'      => esc_html__( 'Settings', 'pearl-plugin' ),
					),
					array(
						'type'       => 'dropdown',
						'holder'     => 'p',
						'class'      => 'tabs-color',
						'heading'    => esc_html__( 'Color Scheme', 'pearl-plugin' ),
						'param_name' => 'tabs_color',
						'std'        => 'default',
						'value'      => array(
							esc_html__( 'Default', 'pearl-plugin' )  => 'default',
							esc_html__( 'Sky Blue', 'pearl-plugin' ) => 'sky',
							esc_html__( 'Dark', 'pearl-plugin' )     => 'dark',
						),
						'dependency' => array( 'element' => 'tabs_style', 'value' => 'horizontal' ),
						'group'      => esc_html__( 'Settings', 'pearl-plugin' ),
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
					'tabs_style' => '',
					'tabs_length' => '',
					'tabs_color' => '',
				),
				$attr
			)
		);

		$title_list = $desc_list = array();

		for ( $i = 1; $i <= 6; $i ++ ) {
			$title_list[] = isset( $attr[ 'tab_title_' . $i ] ) ? $attr[ 'tab_title_' . $i ] : '';
			$desc_list[]  = isset( $attr[ 'tab_desc_' . $i ] ) ? $attr[ 'tab_desc_' . $i ] : '';
		}

		$first_title = $first_desc = 'current';

		if ( 'vertical' === $tabs_style ) {
			$tabs_class = '4';
		} else {

			if ( 'sky' === $tabs_color ) {
				$tabs_class = '2';
			} else if ( 'dark' === $tabs_color ) {
				$tabs_class = '3';
			} else {
				$tabs_class = '1';
			}
		}

		ob_start();

		?>
		<div class="tabs tabs-<?php echo $tabs_class; ?>">
			<?php
				if ( ! empty( $title_list ) ) {
					?>
					<div class="tabs-nav">
						<ul class="tabs-nav-list list-unstyled clearfix <?php echo $tabs_length; ?>">
							<?php

								foreach ( $title_list as $title ) {

									if ( empty( $title ) ) {
										continue;
									}

									echo '<li class="' . $first_title . '">' . $title . '</li>';
									$first_title = '';
								}
							?>
						</ul>
					</div>
					<?php
				}

				if ( ! empty( $title_list ) ) {
					?>
					<div class="tabs-content">
						<?php

							foreach ( $desc_list as $desc ) {

								if ( empty( $desc ) ) {
									continue;
								}

								?>
								<div class="tab-content <?php echo $first_desc; ?>">
									<?php echo '<p>' . $desc . '</p>';
										$first_desc = ''; ?>
								</div>
								<?php
							}
						?>
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
new Pearl_VC_Tabs();