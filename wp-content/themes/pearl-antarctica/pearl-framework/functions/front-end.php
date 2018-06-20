<?php

if ( ! function_exists( 'pearl_site_logo' ) ) {
	/**
	 * Display logo image or site title with description
	 * @since   1.0.0
	 *
	 * @param   $logo_path // logo img url
	 * @param   $retina_logo_path // retina logo image url
	 *
	 * @return  void
	 */
	function pearl_site_logo( $logo_path = '', $retina_logo_path = '' ) {

		if ( ! empty( $logo_path ) || ! empty( $retina_logo_path ) ) {
			?>
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="site-logo"
			   title="<?php bloginfo( 'name' ); ?>">
				<?php pearl_logo_img( $logo_path, $retina_logo_path ); ?>
			</a>
			<?php
		} else {
			?>
			<h1 class="site-title">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
			</h1>
			<?php

			$description = get_bloginfo( 'description' );
			if ( $description ) {
				echo '<small class="tag-line">';
				echo esc_html( $description );
				echo '</small>';
			}
		}
	}
}

if ( ! function_exists( 'pearl_logo_img' ) ) {
	/**
	 * Display logo image
	 * @since   1.0.0
	 *
	 * @param   $logo_url // logo img url
	 * @param   $retina_logo_url // retina logo image url
	 *
	 * @return  void
	 */
	function pearl_logo_img( $logo_url, $retina_logo_url ) {

		global $is_IE;

		if ( ! empty( $logo_url ) && ! empty( $retina_logo_url ) && ! $is_IE ) {
			echo '<img alt="' . esc_attr( get_bloginfo( 'name' ) ) . '" src="' . esc_url( $logo_url ) . '" srcset="' . esc_url( $logo_url ) . ', ' . esc_url( $retina_logo_url ) . ' 2x">';
		} else if ( ! empty( $logo_url ) ) {
			echo '<img alt="' . esc_attr( get_bloginfo( 'name' ) ) . '" src="' . esc_url( $logo_url ) . '">';
		} else {
			echo '<img alt="' . esc_attr( get_bloginfo( 'name' ) ) . '" src="' . esc_url( $retina_logo_url ) . '">';
		}
	}
}

if ( ! function_exists( 'pearl_first_category_link' ) ) {
	/**
	 * Display first category link of the post or page
	 */
	function pearl_first_category_link() {

		$categories = get_the_category( get_the_ID() );

		if ( ! empty( $categories ) ) {
			$cat_name = $categories[0]->name;
			$cat_link = get_term_link( $categories[0]->term_id );

			return ' <a href="' . esc_url( $cat_link ) . '">' . esc_html( $cat_name ) . '</a>';
		}

	}
}

if ( ! function_exists( 'pearl_time_ago' ) ) {
	/**
	 * Display post time ago
	 * @return string
	 */
	function pearl_time_ago() {

		global $post;

		$date = get_post_time( 'G', true, $post );

		// Array of time period chunks
		$chunks = array(
			array(
				60 * 60 * 24 * 365,
				esc_html__( 'year', 'pearl-antarctica' ),
				esc_html__( 'years', 'pearl-antarctica' )
			),
			array(
				60 * 60 * 24 * 30,
				esc_html__( 'month', 'pearl-antarctica' ),
				esc_html__( 'months', 'pearl-antarctica' )
			),
			array(
				60 * 60 * 24 * 7,
				esc_html__( 'week', 'pearl-antarctica' ),
				esc_html__( 'weeks', 'pearl-antarctica' )
			),
			array(
				60 * 60 * 24,
				esc_html__( 'day', 'pearl-antarctica' ),
				esc_html__( 'days', 'pearl-antarctica' )
			),
			array( 60 * 60, esc_html__( 'hour', 'pearl-antarctica' ), esc_html__( 'hours', 'pearl-antarctica' ) ),
			array( 60, esc_html__( 'minute', 'pearl-antarctica' ), esc_html__( 'minutes', 'pearl-antarctica' ) ),
			array( 1, esc_html__( 'second', 'pearl-antarctica' ), esc_html__( 'seconds', 'pearl-antarctica' ) )
		);

		if ( ! is_numeric( $date ) ) {
			$time_chunks = explode( ':', str_replace( ' ', ':', $date ) );
			$date_chunks = explode( '-', str_replace( ' ', '-', $date ) );
			$date        = gmmktime( (int) $time_chunks[1], (int) $time_chunks[2], (int) $time_chunks[3], (int) $date_chunks[1], (int) $date_chunks[2], (int) $date_chunks[0] );
		}

		$current_time = current_time( 'mysql', $gmt = 0 );
		$newer_date   = strtotime( $current_time );

		// Difference in seconds
		$since = $newer_date - $date;

		// Something went wrong with date calculation and we ended up with a negative date.
		if ( 0 > $since ) {
			return esc_html__( 'sometime', 'pearl-antarctica' );
		}

		/**
		 * We only want to output one chunks of time here, eg:
		 * x years
		 * xx months
		 * so there's only one bit of calculation below:
		 */

		//Step one: the first chunk
		for ( $i = 0, $j = count( $chunks ); $i < $j; $i ++ ) {
			$seconds = $chunks[ $i ][0];

			// Finding the biggest chunk (if the chunk fits, break)
			if ( ( $count = floor( $since / $seconds ) ) != 0 ) {
				break;
			}
		}

		// Set output var
		$output = ( 1 == $count ) ? '1 ' . $chunks[ $i ][1] : $count . ' ' . $chunks[ $i ][2];


		if ( ! (int) trim( $output ) ) {
			$output = '0 ' . esc_html__( 'seconds', 'pearl-antarctica' );
		}

		$output .= esc_html__( ' ago', 'pearl-antarctica' );

		return $output;
	}
}

if ( ! function_exists( 'pearl_comment_list' ) ) {
	/**
	 * Displays post comments list
	 * @since   1.0.0
	 *
	 * @param   $comment // user comment
	 * @param   $args // user comment arguments
	 * @param   $depth // depth of a comment reply
	 *
	 * @return  void
	 */
	function pearl_comment_list( $comment, $args, $depth ) {
		?>

		<li <?php comment_class( empty( $args['has_children'] ) ? 'clearfix' : 'parent clearfix' ) ?>
			id="comment-<?php comment_ID() ?>">
			<article class="comment-body">
				<?php if ( $args['avatar_size'] != 0 ) {
					echo get_avatar( $comment, $args['avatar_size'] );
				} ?>
				<div class="comment-wrapper">
					<div class="comment-meta">
						<?php if ( $comment->comment_approved == '0' ) : ?>
							<em class="comment-awaiting-moderation"><?php esc_html_e( 'Your comment is awaiting moderation.', 'pearl-antarctica' ); ?></em>
							<br/>
						<?php endif; ?>
						<div class="comment-author vcard">
							<h4 class="fn"><?php comment_author_link( $comment->comment_ID ); ?></h4>
							<span class="comment-metadata"><a
									href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ); ?>"><?php printf( '%1$s', get_comment_date( 'F j, Y' ) ); ?></a></span>
						</div>
						<div class="reply">
							<?php comment_reply_link( array_merge( $args, array(
								'add_below' => 'comment',
								'depth'     => $depth,
								'max_depth' => $args['max_depth']
							) ) ); ?>
						</div>
					</div>
					<div class="comment-content">
						<?php comment_text(); ?>
					</div>
					<?php edit_comment_link( esc_html__( '(Edit)', 'pearl-antarctica' ), '  ', '' ); ?>
				</div>
			</article>
		</li>
		<!-- #comment-## -->
		<?php
	}
}

if ( ! function_exists( 'pearl_comment_fields_placeholder' ) ) {
	/**
	 * Update default comment form fields to add placeholders
	 *
	 * @param $fields
	 *
	 * @return mixed
	 */
	function pearl_comment_fields_placeholder( $fields ) {

		$commenter = wp_get_current_commenter();
		$req       = get_option( 'require_name_email' );
		$aria_req  = $req ? "aria-required='true'" : '';

		$fields['author'] =
			'<div class="row"><div class="col-sm-6 comment-form-author">
<p><input id="author" name="author" type="text" placeholder="' . esc_attr__( 'Name*', 'pearl-antarctica' ) . '" value="' . esc_attr( $commenter['comment_author'] ) . '"' . $aria_req . ' /></p>
</div><div class="clearfix"></div>';

		$fields['email'] =
			'<div class="col-sm-6 comment-form-email">
<p><input id="email" name="email" type="email" placeholder="' . esc_attr__( 'Email*', 'pearl-antarctica' ) . '" value="' . esc_attr( $commenter['comment_author_email'] ) . '"' . $aria_req . ' /></p>
</div><div class="clearfix"></div>';

		$fields['url'] =
			'<div class="col-sm-6 comment-form-url">
<p><input id="url" name="url" type="url"  placeholder="' . esc_attr__( 'Website', 'pearl-antarctica' ) . '" value="' . esc_attr( $commenter['comment_author_url'] ) . '" /></p>
</div></div>';

		return $fields;
	}

	add_filter( 'comment_form_default_fields', 'pearl_comment_fields_placeholder' );
}

if ( ! function_exists( 'pearl_comment_box_placeholder' ) ) {
	/**
	 * Comment Form Placeholder Comment Field
	 *
	 * @param $fields
	 *
	 * @return mixed
	 */
	function pearl_comment_box_placeholder( $fields ) {

		$fields['comment_field'] = '<p class="comment-form-comment"><textarea id="comment" name="comment" placeholder="' . esc_attr__( 'Comment', 'pearl-antarctica' ) . '" aria-required="true"></textarea></p>';

		return $fields;
	}

	add_filter( 'comment_form_defaults', 'pearl_comment_box_placeholder' );
}

if ( ! function_exists( 'pearl_header_banner_image' ) ) {
	/**
	 * Display Header Banner Image With Settings
	 */
	function pearl_header_banner_image() {


		$background_repeat   = 'no-repeat';
		$background_size     = 'cover';
		$background_position = 'center-center';

		if ( is_singular( 'post' ) ) {

			$background_url = get_option( 'pearl_blog_banner_image' );

			if ( empty( $background_url ) ) {
				$background_url = get_option( 'pearl_banner_image', get_template_directory_uri() . '/img/sub-header-bg.jpg' );
			}
		} else if ( is_singular( 'portfolio' ) ) {

			$background_url = get_option( 'pearl_portfolio_banner_image' );

			if ( empty( $background_url ) ) {
				$background_url = get_option( 'pearl_banner_image', get_template_directory_uri() . '/img/sub-header-bg.jpg' );
			}
		} else {

			if ( is_home() ) {
				$post_id = get_option( 'page_for_posts' );
			} else {
				$post_id = get_the_ID();
			}

			$banner_image_id = get_post_meta( $post_id, 'pearl_banner_image', true );

			if ( ! empty( $banner_image_id ) ) {
				$background_url = wp_get_attachment_image_url( $banner_image_id, 'full', false );
			} else {
				$background_url = get_option( 'pearl_banner_image', get_template_directory_uri() . '/img/sub-header-bg.jpg' );
			}
		}


		echo 'background: url(' . esc_url( $background_url ) . '); ';
		echo 'background-repeat: ' . esc_html( $background_repeat ) . '; ';
		echo 'background-size: ' . esc_html( $background_size ) . '; ';
		echo 'background-position: ' . str_replace( '-', ' ', esc_html( $background_position ) ) . '; ';
	}
}

if ( ! function_exists( 'pearl_blog_title' ) ) {
	/**
	 * Display blog page title
	 */
	function pearl_blog_title() {

		$blog_page_id = get_option( 'page_for_posts' );
		if ( $blog_page_id ) {
			return get_the_title( $blog_page_id );
		} else {
			return esc_html__( 'Our Blog', 'pearl-antarctica' );
		}
	}

}

if ( ! function_exists( 'pearl_blog_description' ) ) {
	/**
	 * Display blog page description
	 */
	function pearl_blog_description() {

		$blog_page_id = get_option( 'page_for_posts' );
		if ( $blog_page_id ) {
			return get_post_meta( $blog_page_id, 'pearl_banner_description', true );
		}

		return false;
	}

}


if ( ! function_exists( 'pearl_link_pages' ) ) {
	/**
	 * Provide paged pages navigation
	 */
	function pearl_link_pages() {
		$defaults = array(
			'before'    => '<nav class="navigation pagination" role="navigation"><ul class="page-numbers"><li>',
			'after'     => '</li></ul>',
			'separator' => '</li><li>',
			'pagelink'  => '<span>%</span>',
			'echo'      => 1
		);

		wp_link_pages( $defaults );
	}
}


if ( ! function_exists( 'pearl_loader_script' ) ) {
	/**
	 * Script to initiate the site loader
	 */
	function pearl_loader_script() {
		?>
		<script>
			if (jQuery().fakeLoader) {
				$ = jQuery;
				var $loader = $('#antarctica-loader'),
					style = $loader.data('style'),
					bg = $loader.data('bg'),
					icon = $loader.data('icon');

				if (bg.length === 0) {
					bg = '#04befc';
				}

				$($loader).fakeLoader({

					// timeToHide : 1200,
					zIndex: "9999",
					spinner: style,
					bgColor: bg,
					imagePath: icon
				});
			}
		</script><?php
	}

	add_action( 'pearl_after_site_loader', 'pearl_loader_script' );
}

if ( ! function_exists( 'pearl_dynamic_sidebar' ) ) {
	/**
	 * Check if custom sidebars set to display otherwise
	 * display default entry's sidebar
	 *
	 * @param $sidebar // index of the sidebar
	 */
	function pearl_dynamic_sidebar( $sidebar ) {

		global $wp_registered_sidebars;

		if ( is_home() ) {
			$the_id = get_option( 'page_for_posts' );
		} elseif ( is_woocommerce_activated() && is_shop() ) {
			$the_id = get_option( 'woocommerce_shop_page_id' );
		} else {
			$the_id = get_the_ID();
		}

		$custom_sidebar = get_post_meta( $the_id, 'pearl_entry_sidebar', true );

		if ( ! empty( $custom_sidebar ) && array_key_exists( pearl_backend_safe_string( $custom_sidebar, '-' ), $wp_registered_sidebars ) ) {
			if ( is_active_sidebar( $custom_sidebar ) ) {
				dynamic_sidebar( $custom_sidebar );
			}
		} else {
			if ( is_active_sidebar( $sidebar ) ) {
				dynamic_sidebar( $sidebar );
			}
		}

	}
}


if ( ! function_exists( 'pearl_get_the_id' ) ) {
	/**
	 * Return proper page id whether it's
	 * a default page or a blog page
	 * @return false|int|mixed|void
	 */
	function pearl_get_the_id() {

		$page_id = get_the_ID();

		if ( is_home() ) {
			$page_id = get_option( 'page_for_posts' );
		}

		return $page_id;
	}
}

?>