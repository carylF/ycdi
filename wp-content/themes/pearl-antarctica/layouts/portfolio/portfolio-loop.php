<?php
global $number_of_items;

$number = ( is_page_template( 'page-templates/portfolio.php' ) ) ? -1 : 4;

if ( isset( $number_of_items ) && ! empty( $number_of_items ) ) {
	$number = $number_of_items;
}

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

		$thumbnail_size = 'pearl_image_size_475_360';

		if( is_page_template( 'page-templates/portfolio.php' ) ){
			$thumbnail_size = 'pearl_image_size_475_475';
		}

		?>
		<div class="col-xs-6 col-md-4 col-lg-3 portfolio-post <?php echo esc_attr( $classes ); ?>">
			<article class="portfolio-post-item">
				<?php the_post_thumbnail( $thumbnail_size ); ?>
				<div class="portfolio-content-wrapper">
					<div class="portfolio-content">
						<h3 class="portfolio-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
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