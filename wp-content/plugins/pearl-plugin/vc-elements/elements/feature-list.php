<?php
/*
* Element Description: Feature List
*/

// Element Class
class Pearl_VC_FeatureList extends WPBakeryShortCode {

	// Element Init
	function __construct() {
		add_action( 'init', array( $this, 'element_mapping' ) );
		add_shortcode( 'pearl_feature_list', array( $this, 'element_output' ) );
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
				'name'        => esc_html__( 'Pearl Feature List', 'pearl-plugin' ),
				'base'        => 'pearl_feature_list',
				'description' => esc_html__( 'Display a bunch of features with a featured image.', 'pearl-plugin' ),
				'category'    => esc_html__( 'Antarctica Theme', 'pearl-plugin' ),
				'params'      => array(

					array(
						'type'       => 'dropdown',
						'holder'     => 'p',
						'class'      => 'heading',
						'heading'    => esc_html__( 'Feature Box Style', 'pearl-plugin' ),
						'param_name' => 'style',
						'value'      => array(
							'Left Image'   => 'left_image',
							'Center Image' => 'center_image'
						),
					),
					array(
						'type'       => 'attach_image',
						'holder'     => 'p',
						'class'      => 'featured-image',
						'heading'    => esc_html__( 'Featured Image', 'pearl-plugin' ),
						'param_name' => 'featured_image',
					),
					array(
						'type' => 'animation_style',
						'heading' => __( 'CSS Animation', 'pearl-plugin' ),
						'param_name' => 'css_animation_image',
						'admin_labe' => false,
						'value' => '',
						'settings' => array(
							'type' => 'in',
							'custom' => array(
								array(
									'label' => __( 'Default', 'pearl-plugin' ),
									'values' => array(
										__( 'Top to bottom', 'pearl-plugin' ) => 'top-to-bottom',
										__( 'Bottom to top', 'pearl-plugin' ) => 'bottom-to-top',
										__( 'Left to right', 'pearl-plugin' ) => 'left-to-right',
										__( 'Right to left', 'pearl-plugin' ) => 'right-to-left',
										__( 'Appear from center', 'pearl-plugin' ) => 'appear',
									),
								),
							),
						),
					),

					// first column services
					array(
						'type' => 'animation_style',
						'heading' => __( 'CSS Animation', 'pearl-plugin' ),
						'param_name' => 'css_animation_1_col',
						'admin_labe' => false,
						'value' => '',
						'settings' => array(
							'type' => 'in',
							'custom' => array(
								array(
									'label' => __( 'Default', 'pearl-plugin' ),
									'values' => array(
										__( 'Top to bottom', 'pearl-plugin' ) => 'top-to-bottom',
										__( 'Bottom to top', 'pearl-plugin' ) => 'bottom-to-top',
										__( 'Left to right', 'pearl-plugin' ) => 'left-to-right',
										__( 'Right to left', 'pearl-plugin' ) => 'right-to-left',
										__( 'Appear from center', 'pearl-plugin' ) => 'appear',
									),
								),
							),
						),
						'group'       => '1st Column'
					),
					// 1 - service 1
					array(
						'type'       => 'textfield',
						'holder'     => 'p',
						'class'      => 'heading',
						'heading'    => esc_html__( '1st Heading', 'pearl-plugin' ),
						'param_name' => 'heading_1_1',
						'group'      => '1st Column'
					),
					array(
						'type'       => 'textarea',
						'holder'     => 'p',
						'class'      => 'description',
						'heading'    => esc_html__( '1st Description', 'pearl-plugin' ),
						'param_name' => 'description_1_1',
						'group'      => '1st Column'
					),
					array(
						'type'       => 'attach_image',
						'holder'     => 'p',
						'class'      => 'icon',
						'heading'    => esc_html__( '1st Icon Image', 'pearl-plugin' ),
						'param_name' => 'icon_1_1',
						'group'      => '1st Column'
					),
					// 1 - service 2
					array(
						'type'       => 'textfield',
						'holder'     => 'p',
						'class'      => 'heading',
						'heading'    => esc_html__( '2nd Heading', 'pearl-plugin' ),
						'param_name' => 'heading_1_2',
						'group'      => '1st Column'
					),
					array(
						'type'       => 'textarea',
						'holder'     => 'p',
						'class'      => 'description',
						'heading'    => esc_html__( '2nd Description', 'pearl-plugin' ),
						'param_name' => 'description_1_2',
						'group'      => '1st Column'
					),
					array(
						'type'       => 'attach_image',
						'holder'     => 'p',
						'class'      => 'icon',
						'heading'    => esc_html__( '2nd Icon Image', 'pearl-plugin' ),
						'param_name' => 'icon_1_2',
						'group'      => '1st Column'
					),
					// 1 - service 3
					array(
						'type'       => 'textfield',
						'holder'     => 'p',
						'class'      => 'heading',
						'heading'    => esc_html__( '3rd Heading', 'pearl-plugin' ),
						'param_name' => 'heading_1_3',
						'group'      => '1st Column'
					),
					array(
						'type'       => 'textarea',
						'holder'     => 'p',
						'class'      => 'description',
						'heading'    => esc_html__( '3rd Description', 'pearl-plugin' ),
						'param_name' => 'description_1_3',
						'group'      => '1st Column'
					),
					array(
						'type'       => 'attach_image',
						'holder'     => 'p',
						'class'      => 'icon',
						'heading'    => esc_html__( '3rd Icon Image', 'pearl-plugin' ),
						'param_name' => 'icon_1_3',
						'group'      => '1st Column'
					),

					// second column services
					array(
						'type' => 'animation_style',
						'heading' => __( 'CSS Animation', 'pearl-plugin' ),
						'param_name' => 'css_animation_2_col',
						'admin_labe' => false,
						'value' => '',
						'settings' => array(
							'type' => 'in',
							'custom' => array(
								array(
									'label' => __( 'Default', 'pearl-plugin' ),
									'values' => array(
										__( 'Top to bottom', 'pearl-plugin' ) => 'top-to-bottom',
										__( 'Bottom to top', 'pearl-plugin' ) => 'bottom-to-top',
										__( 'Left to right', 'pearl-plugin' ) => 'left-to-right',
										__( 'Right to left', 'pearl-plugin' ) => 'right-to-left',
										__( 'Appear from center', 'pearl-plugin' ) => 'appear',
									),
								),
							),
						),
						'group'       => '2nd Column'
					),
					// 2 - service 1
					array(
						'type'       => 'textfield',
						'holder'     => 'p',
						'class'      => 'heading',
						'heading'    => esc_html__( '1st Heading', 'pearl-plugin' ),
						'param_name' => 'heading_2_1',
						'group'      => '2nd Column'
					),
					array(
						'type'       => 'textarea',
						'holder'     => 'p',
						'class'      => 'description',
						'heading'    => esc_html__( '1st Description', 'pearl-plugin' ),
						'param_name' => 'description_2_1',
						'group'      => '2nd Column'
					),
					array(
						'type'       => 'attach_image',
						'holder'     => 'p',
						'class'      => 'icon',
						'heading'    => esc_html__( '1st Icon Image', 'pearl-plugin' ),
						'param_name' => 'icon_2_1',
						'group'      => '2nd Column'
					),
					// 1 - service 2
					array(
						'type'       => 'textfield',
						'holder'     => 'p',
						'class'      => 'heading',
						'heading'    => esc_html__( '2nd Heading', 'pearl-plugin' ),
						'param_name' => 'heading_2_2',
						'group'      => '2nd Column'
					),
					array(
						'type'       => 'textarea',
						'holder'     => 'p',
						'class'      => 'description',
						'heading'    => esc_html__( '2nd Description', 'pearl-plugin' ),
						'param_name' => 'description_2_2',
						'group'      => '2nd Column'
					),
					array(
						'type'       => 'attach_image',
						'holder'     => 'p',
						'class'      => 'icon',
						'heading'    => esc_html__( '2nd Icon Image', 'pearl-plugin' ),
						'param_name' => 'icon_2_2',
						'group'      => '2nd Column'
					),
					// 1 - service 3
					array(
						'type'       => 'textfield',
						'holder'     => 'p',
						'class'      => 'heading',
						'heading'    => esc_html__( '3rd Heading', 'pearl-plugin' ),
						'param_name' => 'heading_2_3',
						'group'      => '2nd Column'
					),
					array(
						'type'       => 'textarea',
						'holder'     => 'p',
						'class'      => 'description',
						'heading'    => esc_html__( '3rd Description', 'pearl-plugin' ),
						'param_name' => 'description_2_3',
						'group'      => '2nd Column'
					),
					array(
						'type'       => 'attach_image',
						'holder'     => 'p',
						'class'      => 'icon',
						'heading'    => esc_html__( '3rd Icon Image', 'pearl-plugin' ),
						'param_name' => 'icon_2_3',
						'group'      => '2nd Column'
					),
				)
			)
		);

	}


	// Element HTML
	public function element_output( $attr ) {

		$animation_col_1 = '';
		$animation_col_2 = '';
		$css_animation_image = '';
		$animate_classes = ' wpb_animate_when_almost_visible wpb_';

		if( isset($attr['css_animation_1_col']) || isset($attr['css_animation_2_col']) || isset($attr['css_animation_image']) ){
			wp_enqueue_style( 'animate-css' );

			if(isset($attr['css_animation_1_col'])){
				$animation_col = $attr['css_animation_1_col'];
				$animation_col_1 = $animate_classes . $animation_col . ' ' . $animation_col;
			}

			if(isset($attr['css_animation_2_col'])){
				$animation_col = $attr['css_animation_2_col'];
				$animation_col_2 = $animate_classes . $animation_col . ' ' . $animation_col;
			}

			if(isset($attr['css_animation_image'])){
				$animation_image = $attr['css_animation_image'];
				$css_animation_image = $animate_classes . $animation_image . ' ' . $animation_image;
			}
		}

		$i = '1';
		for ( $k = 1; $k <= 3; $k ++ ) {
			$list_one[] = array(
				'heading'     => ( isset( $attr[ 'heading_' . $i . '_' . $k ] ) ) ? $attr[ 'heading_' . $i . '_' . $k ] : '',
				'description' => ( isset( $attr[ 'description_' . $i . '_' . $k ] ) ) ? $attr[ 'description_' . $i . '_' . $k ] : '',
				'icon'        => ( isset( $attr[ 'icon_' . $i . '_' . $k ] ) ) ? wp_get_attachment_image_url( $attr[ 'icon_' . $i . '_' . $k ] ) : ''
			);
		}

		$i = '2';
		for ( $k = 1; $k <= 3; $k ++ ) {
			$list_two[] = array(
				'heading'     => ( isset( $attr[ 'heading_' . $i . '_' . $k ] ) ) ? $attr[ 'heading_' . $i . '_' . $k ] : '',
				'description' => ( isset( $attr[ 'description_' . $i . '_' . $k ] ) ) ? $attr[ 'description_' . $i . '_' . $k ] : '',
				'icon'        => ( isset( $attr[ 'icon_' . $i . '_' . $k ] ) ) ? wp_get_attachment_image_url( $attr[ 'icon_' . $i . '_' . $k ] ) : ''
			);
		}

		if ( isset( $attr['featured_image'] ) ) {
			$featured_image = ( isset( $attr['featured_image'] ) ) ? wp_get_attachment_image_url( $attr['featured_image'], 'full' ) : '';
			$column         = 7;
		} else {
			$featured_image = '';
			$column         = 12;
		}

		$style = ( isset( $attr['style'] ) ) ? $attr['style'] : '';

	ob_start();

	if ( 'center_image' == $style ) {
		?>
		<section class="our-services our-services-2 sections">
			<div class="container">
				<div class="row">
					<div class="col-xs-6 col-md-4 right-side<?php echo $animation_col_1; ?>">
						<?php
						foreach ( $list_one as $item ) {
							if (
								! empty( $item['icon'] )
								|| ! empty( $item['heading'] )
								|| ! empty( $item['description'] )
							) {
								?>
								<div class="feature-item feature-item-1 clearfix">
									<div class="feature-img">
										<?php
										if ( ! empty( $item['icon'] ) ) {
											?>
											<img class="img-responsive"
											     src="<?php echo esc_url( $item['icon'] ); ?>"
											     alt="Image">
											<?php
										}
										?>
									</div>
									<div class="feature-content">
										<?php
										if ( ! empty( $item['heading'] ) ) {
											echo '<h3 class="title">' . esc_html( $item['heading'] ) . '</h3>';
										}

										if ( ! empty( $item['description'] ) ) {
											echo '<p>' . esc_html( $item['description'] ) . '</p>';
										}
										?>
									</div>
								</div>
								<?php
							}
						}
						?>
					</div>
					<?php
					if ( ! empty( $featured_image ) ) {
						?>
						<div class="col-md-4 hidden-xs hidden-sm image-column<?php echo $css_animation_image; ?>">
							<img class="img-responsive aligncenter" src="<?php echo esc_url( $featured_image ); ?>" alt="Feature Image">
						</div>
						<?php
					}
					?>
					<div class="col-xs-6 col-md-4 left-side<?php echo $animation_col_2; ?>">
						<?php
						foreach ( $list_two as $item ) {

							if (
								! empty( $item['icon'] )
								|| ! empty( $item['heading'] )
								|| ! empty( $item['description'] )
							) {
								?>
								<div class="feature-item feature-item-1 clearfix">
									<div class="feature-img">
										<?php
										if ( ! empty( $item['icon'] ) ) {
											?>
											<img class="img-responsive"
											     src="<?php echo esc_url( $item['icon'] ); ?>"
											     alt="Image">
											<?php
										}
										?>
									</div>
									<div class="feature-content">
										<?php
										if ( ! empty( $item['heading'] ) ) {
											echo '<h3 class="title">' . esc_html( $item['heading'] ) . '</h3>';
										}

										if ( ! empty( $item['description'] ) ) {
											echo '<p>' . esc_html( $item['description'] ) . '</p>';
										}
										?>
									</div>
								</div>
								<?php
							}
						}
						?>
					</div>
				</div>
			</div>
		</section>
		<?php
	} else {
		?>
		<!-- Features -->
		<section class="our-features our-features-1">
			<div class="container">
				<div class="row">
					<?php
						if ( ! empty( $featured_image ) ) {
							?>
							<div class="col-md-5<?php echo $css_animation_image; ?>">
								<div class="wide-image">
									<img class="img-responsive aligncenter"
									     src="<?php echo esc_url( $featured_image ); ?>"
									     alt="Feature Image">
								</div>
							</div>
							<?php
						}
					?>

					<div class="col-md-<?php echo esc_attr( $column ); ?>">
						<ul class="features-list list-unstyled clearfix">
							<li class="<?php echo $animation_col_1; ?>">
								<?php

									foreach ( $list_one as $item ) {

										if (
											! empty( $item['icon'] )
											|| ! empty( $item['heading'] )
											|| ! empty( $item['description'] )
										) {
											?>
											<div class="feature-item feature-item-1 clearfix">
												<div class="feature-img">
													<?php
														if ( ! empty( $item['icon'] ) ) {
															?>
															<img class="img-responsive"
															     src="<?php echo esc_url( $item['icon'] ); ?>"
															     alt="Image">
															<?php
														}
													?>
												</div>
												<div class="feature-content">
													<?php
														if ( ! empty( $item['heading'] ) ) {
															echo '<h3 class="title">' . esc_html( $item['heading'] ) . '</h3>';
														}
													?>
													<span class="line"></span>
													<?php
														if ( ! empty( $item['description'] ) ) {
															echo '<p>' . esc_html( $item['description'] ) . '</p>';
														}
													?>
												</div>
											</div>
											<?php
										}

									}
								?>
							</li>

							<li class="<?php echo $animation_col_2; ?>">
								<?php

									foreach ( $list_two as $item ) {

										if (
											! empty( $item['icon'] )
											|| ! empty( $item['heading'] )
											|| ! empty( $item['description'] )
										) {
											?>
											<div class="feature-item feature-item-1 clearfix">
												<div class="feature-img">
													<?php
														if ( ! empty( $item['icon'] ) ) {
															?>
															<img class="img-responsive"
															     src="<?php echo esc_url( $item['icon'] ); ?>"
															     alt="Image">
															<?php
														}
													?>
												</div>
												<div class="feature-content">
													<?php
														if ( ! empty( $item['heading'] ) ) {
															echo '<h3 class="title">' . esc_html( $item['heading'] ) . '</h3>';
														}
													?>
													<span class="line"></span>
													<?php
														if ( ! empty( $item['description'] ) ) {
															echo '<p>' . esc_html( $item['description'] ) . '</p>';
														}
													?>
												</div>
											</div>
											<?php
										}

									}
								?>
							</li>
						</ul>
					</div>
				</div>
		</section>
		<?php
	}

	return ob_get_clean();

}

} // End Element Class

// Element Class Init
new Pearl_VC_FeatureList();