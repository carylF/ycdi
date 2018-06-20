<?php
/*
Element Description: Blog Posts
*/

// Element Class
class Pearl_VC_Blog extends WPBakeryShortCode {

	// Element Init
	function __construct() {
		add_action( 'init', array( $this, 'element_mapping' ) );
		add_shortcode( 'pearl_blog', array( $this, 'element_output' ) );
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
				'name'        => esc_html__( 'Pearl Blog', 'pearl-plugin' ),
				'base'        => 'pearl_blog',
				'description' => esc_html__( 'Display blog posts.', 'pearl-plugin' ),
				'category'    => esc_html__( 'Antarctica Theme', 'pearl-plugin' ),
				'params'      => array(

					array(
						'type'        => 'dropdown',
						'holder'      => 'p',
						'class'       => 'blog-style',
						'heading'     => esc_html__( 'Blog Style', 'pearl-plugin' ),
						'param_name'  => 'blog_style',
						'std'         => 'meta_without',
						'value'       => array(
							esc_html__( 'Blog Without Meta Info', 'pearl-plugin' )     => 'meta_without',
							esc_html__( 'Blog With Top Meta Info', 'pearl-plugin' )    => 'meta_top',
							esc_html__( 'Blog With Bottom Meta Info', 'pearl-plugin' ) => 'meta_bottom'
						),
						'description' => esc_html__( 'Choose a blog style you want to display posts in.', 'pearl-plugin' ),
					),
					array(
						'type'        => 'textfield',
						'holder'      => 'p',
						'class'       => 'blog-url',
						'heading'     => esc_html__( 'Blog URL', 'pearl-plugin' ),
						'param_name'  => 'blog_url',
						'std'         => '',
						'description' => esc_html__( 'Provide your blog page URL here.', 'pearl-plugin' ),
						'dependency'  => array( 'element' => 'blog_style', 'value' => 'meta_without' ),
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
					'blog_style' => '',
					'blog_url'   => ''
				),
				$attr
			)
		);

		$blog_id = 3;

		if ( 'meta_top' == $blog_style ) {
			$blog_id = 1;
		} else if ( 'meta_bottom' == $blog_style ) {
			$blog_id = 2;
		}

		ob_start();

		?>
		<section class="our-blog our-blog-<?php echo esc_attr( $blog_id ); ?>">
			<div class="row">
				<?php
				$args = array(
					'post_type'      => 'post',
					'posts_per_page' => 3,
					'meta_key'       => '_thumbnail_id',
					'meta_compare'   => 'EXITS',
					'ignore_sticky_posts' => 1
				);

				$posts = new WP_Query( $args );

				if ( $posts->have_posts() ) {
					while ( $posts->have_posts() ) {
						$posts->the_post();

						if ( 'meta_top' == $blog_style ) {
							?>
							<div class="col-xs-6 col-sm-4">
								<div class="blog-post">
									<div class="post-feature-img">
										<a href="<?php the_permalink(); ?>" class="img-hover">
											<?php the_post_thumbnail( 'pearl_image_size_475_360', array( 'class' => 'img-responsive' ) ) ?>
										</a>
									</div>
									<div class="entry-header">
										<h3 class="post-title">
											<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
										<?php
										$categories = get_the_category( get_the_ID() );
										$cat_name   = $categories[0]->name;
										$cat_link   = get_term_link( $categories[0]->term_id );
										?>
										<p class="post-meta"><?php the_time( get_option( 'date_format' ) ); ?>
											, <?php esc_html_e( 'posted in', 'pearl-plugin' ); ?>
											<a href="<?php echo esc_url( $cat_link ); ?>"><?php echo esc_html( $cat_name ); ?></a>
										</p>
									</div>
									<p>
										<?php echo wp_trim_words( get_the_content(), 14 ); ?>
									</p>
									<div class="entry-footer">
										<a href="<?php echo get_comments_link( get_the_ID() ); ?>" class="post-comments"><i class="fa fa-envelope-o" aria-hidden="true"></i> <?php comments_number( esc_html__( 'no comment', 'pearl-plugin' ), esc_html__( '1 comment', 'pearl-plugin' ), esc_html__( '% comments', 'pearl-plugin' ) ); ?>
										</a>
										<a href="<?php the_permalink(); ?>" class="read-more"><i class="fa fa-arrow-circle-o-right" aria-hidden="true"></i></a>
									</div>
								</div>
							</div>
							<?php
						} else if ( 'meta_bottom' == $blog_style ) {
							?>
							<div class="col-xs-6 col-sm-4">
								<div class="blog-post">
									<div class="post-feature-img">
										<a href="<?php the_permalink(); ?>" class="img-hover">
											<?php the_post_thumbnail( 'pearl_image_size_475_360', array( 'class' => 'img-responsive' ) ) ?>
										</a>
									</div>
									<span class="post-date"><?php the_time( get_option( 'date_format' ) ); ?></span>
									<h3 class="post-title">
										<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
									<p>
										<?php echo wp_trim_words( get_the_content(), 22 ); ?>
									</p>
									<div class="entry-footer hidden-xs hidden-sm">
										<a class="post-author" href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" title="<?php esc_attr( the_author() ); ?>"><i class="fa fa-user"></i><?php the_author(); ?>
										</a>
										<?php
										$categories = get_the_category( get_the_ID() );
										$cat_name   = $categories[0]->name;
										$cat_link   = get_term_link( $categories[0]->term_id );
										?>
										<a class="post-category" href="<?php echo esc_url( $cat_link ); ?>"><i class="fa fa-folder-open-o"></i><?php echo esc_html( $cat_name ); ?>
										</a>
										<a class="post-comments" href="<?php echo get_comments_link( get_the_ID() ); ?>"><i class="fa fa-comments-o"></i><?php echo get_comments_number(); ?>
										</a>
									</div>
								</div>
							</div>
							<?php
						} else {
							?>
							<div class="col-xs-6 col-sm-4">
								<div class="blog-post">
									<div class="post-feature-img">
										<a href="<?php the_permalink(); ?>" class="img-hover">
											<?php the_post_thumbnail( 'pearl_image_size_475_360', array( 'class' => 'img-responsive' ) ) ?>
										</a>
									</div>
									<h3 class="post-title">
										<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
									<p>
										<?php echo wp_trim_words( get_the_content(), 22 ); ?>
									</p>
								</div>
							</div>
							<?php
						}

					}
				}
				?>
			</div>
			<?php

			if ( ! empty( $blog_url ) ) {
				?>
				<div class="text-center text-uppercase">
					<a href="<?php echo esc_url( $blog_url ); ?>"><?php esc_html_e( 'Learn more about us', 'pearl-plugin' ); ?>
						<i class="fa fa-star-o"></i></a>
				</div>
				<?php
			}
			?>
		</section>
		<?php

		return ob_get_clean();

	}

} // End Element Class

// Element Class Init
new Pearl_VC_Blog();