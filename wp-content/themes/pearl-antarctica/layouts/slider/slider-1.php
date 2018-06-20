<!-- Slider One -->
<?php

$slider_type = get_post_meta( get_the_ID(), 'pearl_slider_type', true );
$slides      = get_post_meta( get_the_ID(), 'pearl_slides', true );

$slider_type = ( empty( $slider_type ) ) ? 'one' : $slider_type;

if ( ! empty( $slides ) ) {

	?>
	<div class="flexslider sliders slider-<?php echo esc_attr( $slider_type ); ?>">
		<ul class="slides">
			<?php
				foreach ( $slides as $slide ) {

					if ( ! empty ( $slide['pearl_slide_image'] ) ) {

						$image_url = wp_get_attachment_image_url( $slide['pearl_slide_image'][0], 'full' )

						?>
						<li>
							<div class="slide-caption">
								<div class="slide-text">
									<?php
										if ( ! empty( $slide['pearl_slide_smart_title'] ) ) {
											echo '<span>' . esc_html( $slide['pearl_slide_smart_title'] ) . '</span>';
										}

										if ( ! empty( $slide['pearl_slide_title'] ) ) {
											echo '<h2>' . esc_html( $slide['pearl_slide_title'] ) . '</h2>';
										}

										if ( ! empty( $slide['pearl_slide_sub_title'] ) ) {
											echo '<h3>' . esc_html( $slide['pearl_slide_sub_title'] ) . '</h3>';
										}

										if ( ! empty( $slide['pearl_slide_description'] ) ) {
											echo '<p>' . esc_html( $slide['pearl_slide_description'] ) . '</p>';
										}

										if ( ! empty( $slide['pearl_slide_left_btn_text'] ) && ! empty( $slide['pearl_slide_left_btn_url'] ) ) {
											echo '<a href="' . esc_url( $slide['pearl_slide_left_btn_url'] ) . '" class="btn btn-default">' . esc_html( $slide['pearl_slide_left_btn_text'] ) . '</a>';
										}

										if ( ! empty( $slide['pearl_slide_right_btn_text'] ) && ! empty( $slide['pearl_slide_right_btn_url'] ) ) {
											echo '<a href="' . esc_url( $slide['pearl_slide_right_btn_url'] ) . '" class="btn btn-primary">' . esc_html( $slide['pearl_slide_right_btn_text'] ) . '</a>';
										}
									?>
								</div>
							</div>
							<img src="<?php echo esc_url( $image_url ) ?>" alt="slide">
						</li>
						<?php
					}
				}
			?>
		</ul>
		<div class="mouse-icon">
			<div class="wheel"></div>
		</div>
	</div>
	<?php
} else {
	get_template_part( 'layouts/banner/banner' );
}
?>
