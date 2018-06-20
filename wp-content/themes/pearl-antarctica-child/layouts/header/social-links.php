<?php
if ( 'show' === get_option( 'pearl_header_social_links', 'show' ) ) : ?>
	<span class="follow-us">
	<?php
	$pearl_facebook_url   = get_option( 'pearl_facebook_url' );
	$pearl_twitter_url    = get_option( 'pearl_twitter_url' );
	$pearl_google_url     = get_option( 'pearl_google_url' );
	$pearl_linkedin_url   = get_option( 'pearl_linkedin_url' );
	$pearl_pinterest_url  = get_option( 'pearl_pinterest_url' );
	$pearl_instagram_url  = get_option( 'pearl_instagram_url' );
	$pearl_skype_username = get_option( 'pearl_skype_username' );

	if ( ! empty( $pearl_facebook_url ) ) :
		?>
		<a href="<?php echo esc_url($pearl_facebook_url); ?>" target="_blank"><i class="fa fa-facebook"></i></a>
		<?php
	endif;
	if ( ! empty( $pearl_twitter_url ) ) :
		?>
		<a href="<?php echo esc_url($pearl_twitter_url); ?>" target="_blank"><i class="fa fa-twitter"></i></a>
		<?php
	endif;
	if ( ! empty( $pearl_google_url ) ) :
		?>
		<a href="<?php echo esc_url($pearl_google_url); ?>" target="_blank"><i class="fa fa-google-plus"></i></a>
		<?php
	endif;
	if ( ! empty( $pearl_linkedin_url ) ) :
		?>
		<a href="<?php echo esc_url($pearl_linkedin_url); ?>" target="_blank"><i class="fa fa-linkedin"></i></a>
		<?php
	endif;
	if ( ! empty( $pearl_pinterest_url ) ) :
		?>
		<a href="<?php echo esc_url($pearl_pinterest_url); ?>" target="_blank"><i class="fa fa-pinterest-p"></i></a>
		<?php
	endif;
	if ( ! empty( $pearl_instagram_url ) ) :
		?>
		<a href="<?php echo esc_url($pearl_instagram_url); ?>" target="_blank"><i class="fa fa-instagram"></i></a>
		<?php
	endif;
	if ( ! empty( $pearl_skype_username ) ) :
		?>
		<a href="skype:<?php echo esc_attr($pearl_skype_username); ?>" target="_blank"><i class="fa fa-skype"></i></a>
		<?php
	endif;
	?>
	</span>
	<?php
endif;
?>