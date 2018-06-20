<?php
/**
 * Template Name: Portfolio
 */
get_header();
?>
	<div class="portfolio-page">

		<!-- Main Content -->
		<main id="main" class="main">

			<div class="filtering">

				<ul class="filter-group">
					<li><a class="is-checked" data-filter="*"><?php esc_html_e( 'All', 'pearl-antarctica' ); ?></a></li>
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

			<div class="portfolio-items-container row no-padding">
				<?php get_template_part( 'layouts/portfolio/portfolio-loop' ); ?>
			</div>
		</main>
	</div>

<?php get_footer(); ?>