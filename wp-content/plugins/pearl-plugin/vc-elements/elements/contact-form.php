<?php
/*
Element Description: Contact Form
*/

// Element Class
class Pearl_VC_Contact_Form extends WPBakeryShortCode {

	// Element Init
	function __construct() {
		add_action( 'init', array( $this, 'element_mapping' ) );
		add_shortcode( 'pearl_contact_form_vc', array( $this, 'element_output' ) );
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
				'name'        => esc_html__( 'Pearl Contact Form', 'pearl-plugin' ),
				'base'        => 'pearl_contact_form_vc',
				'description' => esc_html__( 'Contact form to stay in touch with your users.', 'pearl-plugin' ),
				'category'    => esc_html__( 'Antarctica Theme', 'pearl-plugin' ),
				'params'      => array(

					array(
						'type'       => 'textfield',
						'holder'     => 'p',
						'class'      => 'heading',
						'heading'    => esc_html__( 'Target Email Address', 'pearl-plugin' ),
						'description'    => esc_html__( 'Provide a target email address where you would like to receive the contact form requests', 'pearl-plugin' ),
						'param_name' => 'email',
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
					'email' => '',
				),
				$attr
			)
		);

		ob_start();

		if ( ! empty( $email ) ) {
			?>
			<div class="our-contact">
				<form class="home-contact-form" novalidate="novalidate" method="post" action="<?php echo esc_url( admin_url( 'admin-ajax.php' ) ); ?>">
					<div class="form-group">
						<input type="text" name="name" placeholder="<?php esc_html_e( 'Name*', 'pearl-plugin' ); ?>" class="required" title="<?php esc_html_e( '*Please provide your name', 'pearl-plugin' ); ?>">
						<i class="fa fa-user"></i>
					</div>
					<div class="form-group">
						<input type="email" name="email" placeholder="<?php esc_html_e( 'Email*', 'pearl-plugin' ); ?>" class="required email" title="<?php esc_html_e( '*Please provide your Email Address', 'pearl-plugin' ); ?>">
						<i class="fa fa-envelope-o"></i>
					</div>
					<div class="form-group">
						<textarea name="message" placeholder="<?php esc_html_e( 'Your Message', 'pearl-plugin' ); ?>"></textarea>
						<i class="fa fa-comments-o"></i>
					</div>
					<div class="form-group submit-btn-group">
						<input type="hidden" name="action" value="pearl_mail_handler"/>
						<input type="hidden" name="nonce" value="<?php echo wp_create_nonce( 'pearl_mail_handler' ); ?>"/>
						<input type="hidden" name="target"
						       value="<?php echo antispambot( sanitize_email( $email ) ); ?>">
						<input type="submit" class="submit-button" value="<?php esc_html_e( 'Send Message', 'pearl-plugin' ); ?>">
						<i class="fa fa-paper-plane-o"></i>
						<i id="progress-loader" class="fa fa-circle-o-notch fa-spin"></i>
					</div>
					<div class="status"></div>
				</form>
			</div>
			<?php
		}

		return ob_get_clean();

	}

} // End Element Class

// Element Class Init
new Pearl_VC_Contact_Form();