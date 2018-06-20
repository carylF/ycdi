<!-- Slider Three -->
<?php

$args = array(
	'post_type'     => 'slide',
	'post_per_page' => - 1
);

$query = new WP_Query( $args );

if ( $query->have_posts() ) {
	?>
	<div class="flexslider sliders slider-three">
		<ul class="slides">
			<?php
				while ( $query->have_posts() ) {
					$query->the_post();

					$metadata = get_post_custom();
					?>
					<li>
						<div class="slide-caption">
							<div class="slide-text">
								<?php
									if ( ! empty( $metadata['pearl_slide_smart_title'] ) ) {
										echo '<span>' . esc_html( $metadata['pearl_slide_smart_title'][0] ) . '</span>';
									}
								?>
								<h2><?php the_title(); ?></h2>
								<?php
									if ( ! empty( $metadata['pearl_slide_description'] ) ) {
										echo '<p>' . esc_html( $metadata['pearl_slide_description'][0] ) . '</p>';
									}

									if ( ! empty( $metadata['pearl_slide_button_1'] ) && ! empty( $metadata['pearl_slide_button_url_1'] ) ) {
										echo '<a href="' . esc_url( $metadata['pearl_slide_button_url_1'][0] ) . '" class="btn btn-default">' . esc_html( $metadata['pearl_slide_button_1'][0] ) . '</a>';
									}

									if ( ! empty( $metadata['pearl_slide_button_2'] ) && ! empty( $metadata['pearl_slide_button_url_2'] ) ) {
										echo '<a href="' . esc_url( $metadata['pearl_slide_button_url_2'][0] ) . '" class="btn btn-primary">' . esc_html( $metadata['pearl_slide_button_2'][0] ) . '</a>';
									}
								?>
							</div>
						</div>
						<?php the_post_thumbnail( 'full' ); ?>
					</li>
					<?php
				}
			?>
		</ul>
	</div>
	<?php
}
?>
