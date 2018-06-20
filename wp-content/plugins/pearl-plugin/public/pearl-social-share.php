<?php

if ( ! function_exists( 'pearl_blog_social_share' ) ) {
	function pearl_blog_social_share() {
		?>
		<span class="<?php $class = ( is_single() ) ? 'entry-share-this' : 'share-this-post'; echo esc_attr( $class ) ?>">
		<?php
		    esc_html_e( 'Share this:', 'pearl-antarctica' );

		    $buttons = array( 'facebook', 'linkedin', 'twitter', 'google+', 'pinterest' );

		    pearl_social_share_buttons( $buttons );
		?>
		</span>
		<?php
	}

	add_action( 'pearl_blog_social_share', 'pearl_blog_social_share' );
}

if ( ! function_exists( 'pearl_social_share_buttons' ) ) {
	/**
	 * Display social share buttons
	 *
	 * @param $buttons string|array
	 */
	function pearl_social_share_buttons( $buttons = '' ) {

		if ( ! empty( $buttons ) ) {
			if ( is_array( $buttons ) ) {
				foreach ( $buttons as $button ) {
					pearl_social_share_button( $button );
				}
			} else {
				pearl_social_share_button( $buttons );
			}
		}
	}
}

if ( ! function_exists( 'pearl_social_share_button' ) ) {
	/**
	 * Display social share button
	 *
	 * @param $button string
	 */
	function pearl_social_share_button( $button = '' ) {

		switch ( $button ) {
			case 'twitter':
				echo '<a href="http://twitter.com/home/?status=' . get_the_title() . ' - ' . get_the_permalink() . '" title="Tweet this!" target="_blank"><i class="fa fa-twitter" aria-hidden="true"></i></a>';
				break;
			case 'facebook':
				echo '<a href="http://www.facebook.com/sharer.php?u=' . get_the_permalink() . '&amp;t=' . get_the_title() . '" title="Share on Facebook" target="_blank"><i class="fa fa-facebook" aria-hidden="true"></i></a>';
				break;
			case 'reddit':
				echo '<a href="http://www.reddit.com/submit?url=' . get_the_permalink() . '&amp;title=' . get_the_title() . '" title="Vote on Reddit" target="_blank"><i class="fa fa-reddit-alien" aria-hidden="true"></i></a>';
				break;
			case 'linkedin':
				echo '<a href="http://www.linkedin.com/shareArticle?mini=true&amp;title=' . get_the_title() . '&amp;url=' . get_the_permalink() . '" title="Share on LinkedIn" target="_blank"><i class="fa fa-linkedin" aria-hidden="true"></i></a>';
				break;
			case 'google+':
				echo '<a href="https://plus.google.com/share?url=' . get_the_permalink() . '" target="_blank"><i class="fa fa-google-plus" aria-hidden="true"></i></a>';
				break;
			case 'pinterest':
				echo '<a href="http://pinterest.com/pin/create/button/?url=' . get_the_permalink() . '&media=' . wp_get_attachment_url( get_post_thumbnail_id( get_the_ID() ) ) . '" target="_blank"><i class="fa fa-pinterest-p" aria-hidden="true"></i></a>';
				break;
			case '':
				esc_html_e( 'No social button is specified.', 'pearl-antarctica' );
				break;
			default:
				esc_html_e( 'Social button could not be found.', 'pearl-antarctica' );

		}
	}
}