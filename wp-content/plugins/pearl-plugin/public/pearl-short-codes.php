<?php

if ( ! function_exists( 'pearl_contact_form_shortcode' ) ) {
	/**
	 * Contact form shortcode
	 */
	function pearl_contact_form_shortcode() {

		$target_email = get_post_meta( get_the_ID(), 'pearl_form_email', true );

		?>
		<form id="contact-form" class="contact-form" method="post"
		      action="<?php echo esc_url( admin_url( 'admin-ajax.php' ) ); ?>">
			<div class="row">
				<div class="col-md-6">
					<p><input type="text" name="name" placeholder="<?php esc_html_e( 'Name*', 'pearl-plugin' ); ?>" class="required" title="<?php esc_html_e( '*Please provide your name', 'pearl-plugin' ); ?>"></p>
				</div>
				<div class="col-md-6">
					<p><input type="email" name="email" placeholder="<?php esc_html_e( 'Email*', 'pearl-plugin' ); ?>" class="required email" title="<?php esc_html_e( '*Please provide your Email Address', 'pearl-plugin' ); ?>"></p>
				</div>
				<div class="col-md-6">
					<p><input type="text" name="phone" placeholder="<?php esc_html_e( 'Phone', 'pearl-plugin' ); ?>"></p>
				</div>
				<div class="col-md-6">
					<p><input type="text" name="website" placeholder="<?php esc_html_e( 'Website', 'pearl-plugin' ); ?>"></p>
				</div>
				<div class="col-xs-12">
					<p><textarea name="message" placeholder="<?php esc_html_e( 'Message', 'pearl-plugin' ); ?>"></textarea></p>
				</div>
				<div class="col-xs-12">
					<input type="hidden" name="action" value="pearl_mail_handler"/>
					<input type="hidden" name="nonce" value="<?php echo wp_create_nonce( 'pearl_mail_handler' ); ?>"/>
					<input type="hidden" name="target"
					       value="<?php echo antispambot( sanitize_email( $target_email ) ); ?>">
					<input type="submit" class="submit-button" value="<?php esc_html_e( 'Send Message', 'pearl-plugin' ); ?>">
					<img id="progress-loader" src="<?php echo get_template_directory_uri(); ?>/img/ajax-loader.gif" alt="<?php esc_html_e( 'Sending....', 'pearl-plugin' ); ?>">
				</div>
				<div class="col-xs-12">
					<div class="status"></div>
				</div>
			</div>
		</form>
		<?php
	}

	add_shortcode( 'pearl_contact_form', 'pearl_contact_form_shortcode' );
}