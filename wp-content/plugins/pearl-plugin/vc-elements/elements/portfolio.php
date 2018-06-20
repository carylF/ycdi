<?php
	/*
	Element Description: Portfolio Posts
	*/

// Element Class
	class Pearl_VC_Portfolio extends WPBakeryShortCode {

		// Element Init
		function __construct() {
			add_action( 'init', array( $this, 'element_mapping' ) );
			add_shortcode( 'pearl_portfolio', array( $this, 'element_output' ) );
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
					'name'        => esc_html__( 'Pearl Portfolio', 'pearl-plugin' ),
					'base'        => 'pearl_portfolio',
					'description' => esc_html__( 'Display portfolio posts.', 'pearl-plugin' ),
					'category'    => esc_html__( 'Antarctica Theme', 'pearl-plugin' ),
					'params'      => array(

						array(
							'type'        => 'dropdown',
							'holder'      => 'p',
							'class'       => 'portfolio-style',
							'heading'     => esc_html__( 'Blog Style', 'pearl-plugin' ),
							'param_name'  => 'portfolio_style',
							'std'         => 'meta_without',
							'value'       => array(
								esc_html__( 'FullWidth', 'pearl-plugin' ) => 'full_width',
								esc_html__( 'Float', 'pearl-plugin' )     => 'float',
								esc_html__( 'Sorter', 'pearl-plugin' )    => 'sorter',
								esc_html__( 'Carousel', 'pearl-plugin' )  => 'carousel'
							),
							'description' => esc_html__( 'Choose a portfolio style you want to display projects in.', 'pearl-plugin' ),
						),
						array(
							'type'        => 'dropdown',
							'holder'      => 'p',
							'class'       => 'number-fo-projects',
							'heading'     => esc_html__( 'No of Projects', 'pearl-plugin' ),
							'description' => esc_html__( 'Select a number of projects you want to display.', 'pearl-plugin' ),
							'param_name'  => 'number',
							'value'       => array( 3, 4, 6, 8, 9, 12, 16 ),
							'dependency'  => array(
								'element' => 'portfolio_style',
								'value'   => array( 'float', 'sorter', 'carousel' )
							)
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
						'portfolio_style' => '',
						'number'          => '4',
					),
					$attr
				)
			);

			ob_start();

			if ( 'float' == $portfolio_style ) {

				global $number_of_items;
				$number_of_items = $number;
				?>
				<section class="our-portfolio our-portfolio-4">
					<div class="portfolio-items-container row no-padding">
						<?php get_template_part( 'layouts/portfolio/portfolio-loop' ); ?>
					</div>
				</section>
				<?php
			} else if ( 'sorter' == $portfolio_style ) {
				?>
				<section class="our-portfolio our-portfolio-3">
					<div class="portfolio-wrapper">
						<div class="filtering">
							<ul class="filter-group">
								<li>
									<a class="is-checked"
									   data-filter="*"><?php esc_html_e( 'All Projects', 'pearl-plugin' ); ?></a>
								</li>
								<?php
									$portfolio_categories = get_terms( array( 'taxonomy' => 'project-category' ) );

									if ( ! empty( $portfolio_categories ) && ! is_wp_error( $portfolio_categories ) ) {
										foreach ( $portfolio_categories as $category ) {
											echo '<li><a class="entry-category" data-filter=".' . esc_attr( $category->slug ) . '">' . esc_html( $category->name ) . '</a></li>';
										}
									}
								?>
							</ul>
						</div>
						<div class="portfolio-items-container row">
							<?php
								$args = array(
									'post_type'      => 'portfolio',
									'posts_per_page' => $number,
									'meta_key'       => '_thumbnail_id',
									'meta_compare'   => 'EXISTS'
								);

								$query = new WP_Query( $args );

								if ( $query->have_posts() ) {
									while ( $query->have_posts() ) {
										$query->the_post();

										$classes              = '';
										$portfolio_categories = get_the_terms( get_the_ID(), 'project-category' );

										if ( ! empty( $portfolio_categories ) && ! is_wp_error( $portfolio_categories ) ) {
											foreach ( $portfolio_categories as $category ) {
												$classes .= ' ' . esc_attr( $category->slug );
											}
										}
										?>
										<div class="col-xs-6 col-lg-4 portfolio-post <?php echo esc_attr( $classes ); ?>">
											<article class="portfolio-post-item">
												<?php the_post_thumbnail( 'pearl_image_size_475_360' ); ?>
												<div class="portfolio-content-wrapper">
													<div class="portfolio-content">
														<h3 class="portfolio-title">
															<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
														</h3>
														<?php
															if ( ! empty( $portfolio_categories ) && ! is_wp_error( $portfolio_categories ) ) {

																$count = 0;

																echo '<span class="portfolio-cat">';

																foreach ( $portfolio_categories as $category ) {

																	if ( $count > 0 ) {
																		echo apply_filters( 'pearl_portfolio_cat_separator', ' / ' );
																	}

																	echo esc_html( $category->name );

																	if ( $count == 1 ) {
																		break;
																	}

																	$count ++;
																}

																echo '</span>';
															}
														?>
													</div>
												</div>
											</article>
										</div>
										<?php
									}
								}
							?>
						</div>
					</div>
				</section>
				<?php
			} else if ( 'carousel' == $portfolio_style ) {
				?>
				<section class="our-portfolio our-portfolio-3">
					<div class="portfolio-nav-wrapper">
						<a class="previous-link" href="#"><i class="fa fa-arrow-left"></i></a>
						<span class="sep">/</span>
						<a class="next-link" href="#"><i class="fa fa-arrow-right"></i></a>
					</div>
					<div class="portfolio-wrapper">
						<div class="portfolio-carousel owl-carousel owl-theme">
							<div class="portfolio-carousel-item">
								<div class="portfolio-items-container row">
									<?php
										$args = array(
											'post_type'      => 'portfolio',
											'posts_per_page' => -1,
											'meta_key'       => '_thumbnail_id',
											'meta_compare'   => 'EXISTS'
										);

										$query = new WP_Query( $args );

										if ( $query->have_posts() ) {

											$loop = 1;

											while ( $query->have_posts() ) {
												$query->the_post();

												$classes              = '';
												$portfolio_categories = get_the_terms( get_the_ID(), 'project-category' );

												if ( ! empty( $portfolio_categories ) && ! is_wp_error( $portfolio_categories ) ) {
													foreach ( $portfolio_categories as $category ) {
														$classes .= ' ' . esc_attr( $category->slug );
													}
												}

												if( $loop > $number ){
													$loop = 1;
													echo '</div></div><div class="portfolio-carousel-item"><div class="portfolio-items-container row">';
												}
												?>
												<div class="col-xs-6 col-md-4 portfolio-post <?php echo esc_attr( $classes ); ?>">
													<article class="portfolio-post-item">
														<?php the_post_thumbnail( 'pearl_image_size_475_360' ); ?>
														<div class="portfolio-content-wrapper">
															<div class="portfolio-content">
																<h3 class="portfolio-title">
																	<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
																</h3>
																<?php
																	if ( ! empty( $portfolio_categories ) && ! is_wp_error( $portfolio_categories ) ) {

																		$count = 0;

																		echo '<span class="portfolio-cat">';

																		foreach ( $portfolio_categories as $category ) {

																			if ( $count > 0 ) {
																				echo apply_filters( 'pearl_portfolio_cat_separator', ' / ' );
																			}

																			echo esc_html( $category->name );

																			if ( $count == 1 ) {
																				break;
																			}

																			$count ++;
																		}

																		echo '</span>';
																	}
																?>
															</div>
														</div>
													</article>
												</div>
												<?php

												$loop++;
											}
										}
									?>
								</div>
							</div>
						</div>
					</div>
				</section>
				<?php
				wp_enqueue_style( 'owl-carousel' );
				wp_enqueue_style( 'owl-theme-default' );
				wp_enqueue_script( 'owl-carousel' );
			} else {
				?>
				<section class="our-portfolio our-portfolio-1">
					<div class="portfolio-items-container row no-padding">
						<?php get_template_part( 'layouts/portfolio/portfolio-loop' ); ?>
					</div>
				</section>
				<?php
			}

			return ob_get_clean();

		}

	} // End Element Class

// Element Class Init
	new Pearl_VC_Portfolio();