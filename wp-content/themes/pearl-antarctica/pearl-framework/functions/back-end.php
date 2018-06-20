<?php


/**
 * User Functions
 */
if ( ! function_exists( 'pearl_user_social_links' ) ) {
	/**
	 * Add custom fields to the user profile.
	 *
	 * @param object $user
	 *
	 * @return void
	 */
	function pearl_user_social_links( $user ) {
		?>
		<h3><?php esc_html_e( 'Social Profile Links', 'pearl-antarctica' ); ?></h3>

		<table class="form-table">
			<tr>
				<th><label
						for="facebook_profile"><?php esc_html_e( 'Facebook Profile', 'pearl-antarctica' ); ?></label>
				</th>
				<td><input type="text" name="facebook_profile"
				           value="<?php echo esc_attr( get_the_author_meta( 'facebook_profile', $user->ID ) ); ?>"
				           class="regular-text"/></td>
			</tr>

			<tr>
				<th><label
						for="twitter_profile"><?php esc_html_e( 'Twitter Profile', 'pearl-antarctica' ); ?></label>
				</th>
				<td><input type="text" name="twitter_profile"
				           value="<?php echo esc_attr( get_the_author_meta( 'twitter_profile', $user->ID ) ); ?>"
				           class="regular-text"/></td>
			</tr>

			<tr>
				<th><label
						for="google_profile"><?php esc_html_e( 'Google+ Profile', 'pearl-antarctica' ); ?></label>
				</th>
				<td><input type="text" name="google_profile"
				           value="<?php echo esc_attr( get_the_author_meta( 'google_profile', $user->ID ) ); ?>"
				           class="regular-text"/></td>
			</tr>
			<tr>
				<th><label
						for="youtube_profile"><?php esc_html_e( 'YouTube Profile', 'pearl-antarctica' ); ?></label>
				</th>
				<td><input type="text" name="youtube_profile"
				           value="<?php echo esc_attr( get_the_author_meta( 'youtube_profile', $user->ID ) ); ?>"
				           class="regular-text"/></td>
			</tr>
			<tr>
				<th><label
						for="instagram_profile"><?php esc_html_e( 'Instagram Profile', 'pearl-antarctica' ); ?></label>
				</th>
				<td><input type="text" name="instagram_profile"
				           value="<?php echo esc_attr( get_the_author_meta( 'instagram_profile', $user->ID ) ); ?>"
				           class="regular-text"/></td>
			</tr>
		</table>
		<?php
	}

	add_action( 'show_user_profile', 'pearl_user_social_links' );
	add_action( 'edit_user_profile', 'pearl_user_social_links' );
}

if ( ! function_exists( 'pearl_update_user_social_links' ) ) {
	/**
	 * Save custom user fields data.
	 *
	 * @param int $user_id
	 *
	 * @return void
	 */
	function pearl_update_user_social_links( $user_id ) {
		update_user_meta( $user_id, 'twitter_profile', sanitize_text_field( $_POST['twitter_profile'] ) );
		update_user_meta( $user_id, 'facebook_profile', sanitize_text_field( $_POST['facebook_profile'] ) );
		update_user_meta( $user_id, 'google_profile', sanitize_text_field( $_POST['google_profile'] ) );
		update_user_meta( $user_id, 'instagram_profile', sanitize_text_field( $_POST['instagram_profile'] ) );
		update_user_meta( $user_id, 'youtube_profile', sanitize_text_field( $_POST['youtube_profile'] ) );
	}

	add_action( 'personal_options_update', 'pearl_update_user_social_links' );
	add_action( 'edit_user_profile_update', 'pearl_update_user_social_links' );
}

if ( ! function_exists( 'pearl_backend_safe_string' ) ) {
	/**
	 * Create a lower case version of a string without spaces so we can use that string for database settings
	 *
	 * @param string $string to convert
	 *
	 * @return string the converted string
	 */
	function pearl_backend_safe_string( $string, $replace = "_", $check_spaces = false ) {
		$string = strtolower( $string );

		$trans = array(
			'&\#\d+?;'       => '',
			'&\S+?;'         => '',
			'\s+'            => $replace,
			'ä'              => 'ae',
			'ö'              => 'oe',
			'ü'              => 'ue',
			'Ä'              => 'Ae',
			'Ö'              => 'Oe',
			'Ü'              => 'Ue',
			'ß'              => 'ss',
			'[^a-z0-9\-\._]' => '',
			$replace . '+'   => $replace,
			$replace . '$'   => $replace,
			'^' . $replace   => $replace,
			'\.+$'           => ''
		);

		$trans = apply_filters( 'pearl_safe_string_trans', $trans, $string, $replace );

		$string = strip_tags( $string );

		foreach ( $trans as $key => $val ) {
			$string = preg_replace( "#" . $key . "#i", $val, $string );
		}

		if ( $check_spaces ) {
			if ( str_replace( '_', '', $string ) == '' ) {
				return;
			}
		}

		return stripslashes( $string );
	}
}
