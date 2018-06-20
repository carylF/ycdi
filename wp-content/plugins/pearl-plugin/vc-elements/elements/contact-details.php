<?php
/*
Element Description: Contact Details
*/

// Element Class
class Pearl_VC_Contact_Details extends WPBakeryShortCode {

	// Element Init
	function __construct() {
		add_action( 'init', array( $this, 'element_mapping' ) );
		add_shortcode( 'pearl_contact_detail', array( $this, 'element_output' ) );
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
				'name'        => esc_html__( 'Pearl Contact Details', 'pearl-plugin' ),
				'base'        => 'pearl_contact_detail',
				'description' => esc_html__( 'To display contact details with social profiles links.', 'pearl-plugin' ),
				'category'    => esc_html__( 'Antarctica Theme', 'pearl-plugin' ),
				'params'      => array(

					array(
						'type'       => 'textfield',
						'holder'     => 'p',
						'heading'    => esc_html__( 'Heading', 'pearl-plugin' ),
						'param_name' => 'heading',
						'group'      => 'Details',
					),
					array(
						'type'       => 'textfield',
						'holder'     => 'p',
						'heading'    => esc_html__( 'Phone', 'pearl-plugin' ),
						'param_name' => 'phone',
						'group'      => 'Details',
					),
					array(
						'type'       => 'textfield',
						'holder'     => 'p',
						'class'      => 'heading',
						'heading'    => esc_html__( 'Fax', 'pearl-plugin' ),
						'param_name' => 'fax',
						'group'      => 'Details',
					),
					array(
						'type'       => 'textarea',
						'holder'     => 'p',
						'class'      => 'heading',
						'heading'    => esc_html__( 'Address', 'pearl-plugin' ),
						'param_name' => 'address',
						'group'      => 'Details',
					),
					array(
						'type'       => 'textfield',
						'holder'     => 'p',
						'class'      => 'heading',
						'heading'    => esc_html__( 'Opening Time', 'pearl-plugin' ),
						'param_name' => 'opening_time',
						'group'      => 'Details',
					),

					// social profiles links
					array(
						'type'       => 'textfield',
						'holder'     => 'p',
						'class'      => 'heading',
						'heading'    => esc_html__( 'Facebook', 'pearl-plugin' ),
						'param_name' => 'facebook',
						'group'      => 'Social Profiles',
					),
					array(
						'type'       => 'textfield',
						'holder'     => 'p',
						'class'      => 'heading',
						'heading'    => esc_html__( 'Twitter', 'pearl-plugin' ),
						'param_name' => 'twitter',
						'group'      => 'Social Profiles',
					),
					array(
						'type'       => 'textfield',
						'holder'     => 'p',
						'class'      => 'heading',
						'heading'    => esc_html__( 'skype', 'pearl-plugin' ),
						'param_name' => 'skype',
						'group'      => 'Social Profiles',
					),
					array(
						'type'       => 'textfield',
						'holder'     => 'p',
						'class'      => 'heading',
						'heading'    => esc_html__( 'Vimeo', 'pearl-plugin' ),
						'param_name' => 'vimeo',
						'group'      => 'Social Profiles',
					),
					array(
						'type'       => 'textfield',
						'holder'     => 'p',
						'class'      => 'heading',
						'heading'    => esc_html__( 'Behance', 'pearl-plugin' ),
						'param_name' => 'behance',
						'group'      => 'Social Profiles',
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
					'heading'      => '',
					'address'      => '',
					'phone'        => '',
					'fax'          => '',
					'opening_time' => '',
					'facebook'     => '',
					'twitter'      => '',
					'skype'        => '',
					'vimeo'        => '',
					'behance'      => '',
				),
				$attr
			)
		);

		ob_start();

		?>
		<div class="our-contact">
			<div class="contact-details">
				<?php
					if ( ! empty( $heading ) ) {
						echo '<h5 class="title text-uppercase">' . esc_html( $heading ) . '</h5>';
					}
				?>
				<ul class="list-unstyled contact-details-list">
					<?php
						if ( ! empty( $address ) ) {
							?>
							<li>
								<i class="fa fa-map-marker"></i>
								<p><span
										class="title"><?php esc_html_e( 'Location:', 'pearl-plugin' ); ?></span> <?php echo esc_html( $address ); ?>
								</p>
							</li>
							<?php
						}

						if ( ! empty( $phone ) || ! empty( $fax ) ) {
							?>
							<li>
								<i class="fa fa-phone"></i>
								<?php
									if ( ! empty( $phone ) ) {
										?>
										<p><span
												class="title"><?php esc_html_e( 'Phone:', 'pearl-plugin' ); ?></span> <?php echo esc_html( $phone ); ?>
										</p>
										<?php
									}

									if ( ! empty( $fax ) ) {
										?>
										<p><span
												class="title"><?php esc_html_e( 'Fax:', 'pearl-plugin' ); ?></span> <?php echo esc_html( $fax ) ?>
										</p>
										<?php
									}
								?>
							</li>
							<?php
						}
					?>
				</ul>
				<?php
					if ( ! empty( $opening_time ) ) {
						echo '<p class="timings">' . esc_html( $opening_time ) . '</p>';
					}
				?>
				<span class="follow-us">
						<?php
							if ( ! empty( $facebook ) ) {
								echo '<a href="' . esc_url( $facebook ) . '"><i class="fa fa-facebook"></i></a>';
							}

							if ( ! empty( $twitter ) ) {
								echo '<a href="' . esc_url( $twitter ) . '"><i class="fa fa-twitter"></i></a>';
							}

							if ( ! empty( $skype ) ) {
								echo '<a href="' . esc_url( $skype ) . '"><i class="fa fa-skype"></i></a>';
							}
							if ( ! empty( $vimeo ) ) {
								echo '<a href="' . esc_url( $vimeo ) . '"><i class="fa fa-vimeo"></i></a>';
							}
							if ( ! empty( $behance ) ) {
								echo '<a href="' . esc_url( $behance ) . '"><i class="fa fa-behance"></i></a>';
							}
						?>
				</span>
			</div>
		</div>
		<?php

		return ob_get_clean();

	}

} // End Element Class

// Element Class Init
new Pearl_VC_Contact_Details();