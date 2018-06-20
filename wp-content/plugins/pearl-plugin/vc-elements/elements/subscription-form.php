<?php
	/*
	Element Description: Subscription Form
	*/

// Element Class
	class Pearl_VC_Subscription extends WPBakeryShortCode {

		// Element Init
		function __construct() {
			add_action( 'init', array( $this, 'element_mapping' ) );
			add_shortcode( 'pearl_subscription', array( $this, 'element_output' ) );
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
					'name'        => esc_html__( 'Pearl Subscription', 'pearl-plugin' ),
					'base'        => 'pearl_subscription',
					'description' => esc_html__( 'Display subscription form.', 'pearl-plugin' ),
					'category'    => esc_html__( 'Antarctica Theme', 'pearl-plugin' ),
					'params'      => array(

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
							'class'      => 'description',
							'heading'    => esc_html__( 'Description', 'pearl-plugin' ),
							'param_name' => 'description',
						),
						array(
							'type'       => 'textfield',
							'holder'     => 'p',
							'class'      => 'Note',
							'heading'    => esc_html__( 'Note', 'pearl-plugin' ),
							'param_name' => 'note',
						),
						array(
							'type'        => 'textfield',
							'holder'      => 'p',
							'class'       => 'url',
							'heading'     => esc_html__( 'Form Submission URL', 'pearl-plugin' ),
							'description' => esc_html__( 'Add a url where you want to submit the subscription form.', 'pearl-plugin' ),
							'param_name'  => 'url',
							'group'       => 'Form Settings'
						),
						array(
							'type'       => 'textfield',
							'holder'     => 'p',
							'class'      => 'name',
							'heading'    => esc_html__( 'Name of the "Your Name" field.', 'pearl-plugin' ),
							'param_name' => 'name',
							'group'      => 'Form Settings'
						),
						array(
							'type'       => 'textfield',
							'holder'     => 'p',
							'class'      => 'email',
							'heading'    => esc_html__( 'Name of the "Email Address" field.', 'pearl-plugin' ),
							'param_name' => 'email',
							'group'      => 'Form Settings'
						),
					)
				)
			);

		}


		// Element HTML
		public function element_output( $atts ) {

			// Params extraction
			extract(
				shortcode_atts(
					array(
						'heading'     => '',
						'description' => '',
						'note'        => '',
						'url'         => '',
						'name'        => '',
						'email'       => '',
					),
					$atts
				)
			);


			ob_start();
			?>
			<!-- Subscription -->
			<section class="subscribe sections section-padding">
				<div class="container">
					<?php
						if ( ! empty( $heading ) ) {
							echo '<h3 class="title">' . esc_html( $heading ) . '</h3>';
						}
					?>
					<form action="<?php echo esc_url( $url ); ?>" method="post" class="subscribe-form"
					      novalidate="novalidate">
						<div class="row">
							<div class="col-md-6 col-lg-3">
								<div class="form-group">
									<input type="text" name="<?php echo esc_attr( $name ); ?>" id="first-name"
									       placeholder="Your Name"
									       required="required">
									<i class="fa fa-user"></i>
								</div>
							</div>
							<div class="col-md-6 col-lg-6">
								<div class="form-group">
									<input type="email" name="<?php echo esc_attr( $email ); ?>" id="email"
									       placeholder="Email Address"
									       required="required">
									<i class="fa fa-envelope-o"></i>
								</div>
							</div>
							<div class="col-md-12 col-lg-3">
								<div class="form-group">
									<input type="submit" value="Subscribe" id="subscribe-submit" class="btn-submit">
									<i class="fa fa-paper-plane-o"></i>
								</div>
							</div>
						</div>
					</form>
					<?php

						if ( ! empty( $description ) ) {
							echo '<p>' . esc_html( $description ) . '</p>';
						}

						if ( ! empty( $note ) ) {
							echo '<p><strong>' . esc_html( $note ) . '</strong></p>';
						}
					?>
				</div>
			</section>
			<?php

			return ob_get_clean();

		}

	} // End Element Class

// Element Class Init
	new Pearl_VC_Subscription();