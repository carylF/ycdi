<?php
	/*
	Element Description: Clients / Partners
	*/

// Element Class
	class Pearl_VC_Clients extends WPBakeryShortCode {

		// Element Init
		function __construct() {
			add_action( 'init', array( $this, 'element_mapping' ) );
			add_shortcode( 'pearl_clients', array( $this, 'element_output' ) );
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
					'name'        => esc_html__( 'Pearl Clients/Partners', 'pearl-plugin' ),
					'base'        => 'pearl_clients',
					'description' => esc_html__( 'Display clients or partners.', 'pearl-plugin' ),
					'category'    => esc_html__( 'Antarctica Theme', 'pearl-plugin' ),
					'params'      => array(

						array(
							'type'       => 'attach_image',
							'holder'     => 'p',
							'class'      => 'icon',
							'heading'    => esc_html__( '1st Slot Image', 'pearl-plugin' ),
							'param_name' => 'img_1',
						),
						array(
							'type'       => 'textfield',
							'holder'     => 'p',
							'class'      => 'url',
							'heading'    => esc_html__( '1st Slot URL', 'pearl-plugin' ),
							'param_name' => 'url_1',
						),
						array(
							'type'       => 'attach_image',
							'holder'     => 'p',
							'class'      => 'icon',
							'heading'    => esc_html__( '2nd Slot Image', 'pearl-plugin' ),
							'param_name' => 'img_2',
						),
						array(
							'type'       => 'textfield',
							'holder'     => 'p',
							'class'      => 'url',
							'heading'    => esc_html__( '2nd Slot URL', 'pearl-plugin' ),
							'param_name' => 'url_2',
						),
						array(
							'type'       => 'attach_image',
							'holder'     => 'p',
							'class'      => 'icon',
							'heading'    => esc_html__( '3rd Slot Image', 'pearl-plugin' ),
							'param_name' => 'img_3',
						),
						array(
							'type'       => 'textfield',
							'holder'     => 'p',
							'class'      => 'url',
							'heading'    => esc_html__( '3rd Slot URL', 'pearl-plugin' ),
							'param_name' => 'url_3',
						),
						array(
							'type'       => 'attach_image',
							'holder'     => 'p',
							'class'      => 'icon',
							'heading'    => esc_html__( '4th Slot Image', 'pearl-plugin' ),
							'param_name' => 'img_4',
						),
						array(
							'type'       => 'textfield',
							'holder'     => 'p',
							'class'      => 'url',
							'heading'    => esc_html__( '4th Slot URL', 'pearl-plugin' ),
							'param_name' => 'url_4',
						),
						array(
							'type'       => 'attach_image',
							'holder'     => 'p',
							'class'      => 'icon',
							'heading'    => esc_html__( '5th Slot Image', 'pearl-plugin' ),
							'param_name' => 'img_5',
						),
						array(
							'type'       => 'textfield',
							'holder'     => 'p',
							'class'      => 'url',
							'heading'    => esc_html__( '5th Slot URL', 'pearl-plugin' ),
							'param_name' => 'url_5',
						),
						array(
							'type'       => 'attach_image',
							'holder'     => 'p',
							'class'      => 'icon',
							'heading'    => esc_html__( '6th Slot Image', 'pearl-plugin' ),
							'param_name' => 'img_6',
						),
						array(
							'type'       => 'textfield',
							'holder'     => 'p',
							'class'      => 'url',
							'heading'    => esc_html__( '6th Slot URL', 'pearl-plugin' ),
							'param_name' => 'url_6',
						),
						array(
							'type'       => 'attach_image',
							'holder'     => 'p',
							'class'      => 'icon',
							'heading'    => esc_html__( '7th Slot Image', 'pearl-plugin' ),
							'param_name' => 'img_7',
						),
						array(
							'type'       => 'textfield',
							'holder'     => 'p',
							'class'      => 'url',
							'heading'    => esc_html__( '7th Slot URL', 'pearl-plugin' ),
							'param_name' => 'url_7',
						),
						array(
							'type'       => 'attach_image',
							'holder'     => 'p',
							'class'      => 'icon',
							'heading'    => esc_html__( '8th Slot Image', 'pearl-plugin' ),
							'param_name' => 'img_8',
						),
						array(
							'type'       => 'textfield',
							'holder'     => 'p',
							'class'      => 'url',
							'heading'    => esc_html__( '8th Slot URL', 'pearl-plugin' ),
							'param_name' => 'url_8',
						),
						array(
							'type'       => 'attach_image',
							'holder'     => 'p',
							'class'      => 'icon',
							'heading'    => esc_html__( '9th Slot Image', 'pearl-plugin' ),
							'param_name' => 'img_9',
						),
						array(
							'type'       => 'textfield',
							'holder'     => 'p',
							'class'      => 'url',
							'heading'    => esc_html__( '9th Slot URL', 'pearl-plugin' ),
							'param_name' => 'url_9',
						),
						array(
							'type'       => 'dropdown',
							'holder'     => 'p',
							'class'      => 'columns',
							'heading'    => esc_html__( 'Columns', 'pearl-plugin' ),
							'param_name' => 'columns',
							'value'      => array( 'Three' => 'three', 'Four' => 'four', 'Six' => 'six' ),
							'group'      => 'Settings'
						),
						array(
							'type'       => 'dropdown',
							'holder'     => 'p',
							'class'      => 'separation',
							'heading'    => esc_html__( 'Border Separation', 'pearl-plugin' ),
							'param_name' => 'separation',
							'value'      => array( 'Yes' => 'yes', 'No' => 'no' ),
							'group'      => 'Settings'
						),
						array(
							'type'       => 'dropdown',
							'holder'     => 'p',
							'class'      => 'separation',
							'heading'    => esc_html__( 'Border Color', 'pearl-plugin' ),
							'param_name' => 'border_color',
							'value'      => array( 'Light' => 'light', 'Dark' => 'dark' ),
							'dependency' => array(
								'element' => 'separation',
								'value' => 'yes',
							),
							'group'      => 'Settings'
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
						'img_1'      => '',
						'img_2'      => '',
						'img_3'      => '',
						'img_4'      => '',
						'img_5'      => '',
						'img_6'      => '',
						'img_7'      => '',
						'img_8'      => '',
						'img_9'      => '',
						'url_1'      => '',
						'url_2'      => '',
						'url_3'      => '',
						'url_4'      => '',
						'url_5'      => '',
						'url_6'      => '',
						'url_7'      => '',
						'url_8'      => '',
						'url_9'      => '',
						'columns'    => '',
						'separation' => '',
						'border_color' => '',
					),
					$attr
				)
			);

			ob_start();

			$images_ids  = array( $img_1, $img_2, $img_3, $img_4, $img_5, $img_6, $img_7, $img_8, $img_9 );
			$sites_urls  = array( $url_1, $url_2, $url_3, $url_4, $url_5, $url_6, $url_7, $url_8, $url_9 );
			$images_urls = $partners = array();

			foreach ( $images_ids as $images_id ) {
				$images_urls[] = wp_get_attachment_image_url( $images_id );
			}

			$k = count( $images_urls );
			for ( $i = 0; $i < $k; $i ++ ) {
				if ( ! empty( $images_urls[ $i ] ) ) {
					$partners[ $i ]['img'] = $images_urls[ $i ];
					$partners[ $i ]['url'] = $sites_urls[ $i ];
				}
			}

			if ( 'six' == $columns ) {
				$column_classes = 'col-xs-6 col-sm-4 col-md-2 col-full-width';
			} else if ( 'four' == $columns ) {
				$column_classes = 'col-xs-6 col-sm-3';
				$row     = 4;
			} else {
				$column_classes = 'col-xs-6 col-sm-4';
				$row     = 3;
			}

			if ( 'no' == $separation ) {
				$separation = 'no-border';
			} else {
				$separation = '';
			}

			if ( 'dark' == $border_color ) {
				$separation .= ' our-clients-2';
			}
			?>
			<div class="our-clients <?php echo esc_attr( $separation ); ?>">
				<div class="row">
					<?php
						if ( count( $partners ) > 0 ) {

							$count = 1;

							foreach ( $partners as $partner ) {

								$div = false;
								if ( ( 'six' != $columns ) && ( $count % $row == 0 ) && ( $count < 8 ) ) {
									$div = true;
								}
								?>
								<div class="<?php echo esc_attr( $column_classes ); ?>">
									<div class="single-client">
										<?php
											if ( ! empty( $partner['url'] ) ) {
												echo '<a href="' . esc_url( $partner['url'] ) . '"><img src="' . esc_url( $partner['img'] ) . '" alt="Client"></a>';
											} else {
												echo '<img src="' . esc_url( $partner['img'] ) . '" alt="Client">';
											}
										?>
									</div>
								</div>
								<?php

								if ( $div ) {
									echo '</div><div class="row">';
								}

								$count ++;
							}
						}
					?>
				</div>
			</div>
			<?php

			return ob_get_clean();

		}

	} // End Element Class

// Element Class Init
	new Pearl_VC_Clients();