<?php
/**
 * Template Name: Contact
 */
get_header();

$meta_data = get_post_custom();
$map_dis   = $meta_data['pearl_map_display'][0];

if ( 'show' == $map_dis ) {
	?>
	<!-- Google Map -->
	<div id="google-map"></div>
	<?php
}
?>
	<!-- Container -->
	<div class="container main-container contact-page">

		<!-- Main Content -->
		<main id="main" class="main">
			<div class="row">
				<div class="col-md-5">
					<?php
					if ( ! empty( $meta_data['pearl_detail_title'] ) ) {
						echo '<h3 class="section-title">' . esc_html( $meta_data['pearl_detail_title'][0] ) . '</h3>';
					}

					if ( ! empty( $meta_data['pearl_detail_description'] ) ) {
						echo '<p class="section-description">' . esc_html( $meta_data['pearl_detail_description'][0] ) . '</p>';
					}

					?>

					<ul class="list-unstyled contacts">
						<?php
						if ( ! empty( $meta_data['pearl_detail_address'] ) ) {
							?>
							<li>
								<span class="title"><?php esc_html_e( 'Address:', 'pearl-antarctica' ); ?></span>
								<div class="content">
									<address>
										<?php echo esc_html( $meta_data['pearl_detail_address'][0] ); ?>

									</address>
								</div>
							</li>
							<?php
						}

						$contact_numbers = rwmb_meta( 'pearl_detail_numbers' );

						if ( ! empty( $contact_numbers ) ) {


							?>
							<li>
								<span class="title"><?php esc_html_e( 'Phone:', 'pearl-antarctica' ); ?></span>
								<div class="content">
									<?php
										foreach ( $contact_numbers as $number ) {
											echo '<p>' . esc_html( $number['pearl_number'] ) . ' - <span>' . esc_html( $number['pearl_label'] ) . '</span></p>';
										}
									?>
								</div>
							</li>
							<?php


						}

						$contact_emails = rwmb_meta( 'pearl_detail_emails' );

						if ( ! empty( $contact_emails ) ) {


							?>
							<li>
								<span class="title"><?php esc_html_e( 'Email:', 'pearl-antarctica' ); ?></span>
								<div class="content ">
									<?php
										foreach ( $contact_emails as $email ) {
											echo '<p><a href="mailto:' . esc_html( $email['pearl_email'] ) . '">' . esc_html( $email['pearl_email'] ) . '</a></p>';
										}
									?>
								</div>
							</li>
							<?php
						}
						?>


						<li>
							<span class="title"><?php esc_html_e( 'Follow on:', 'pearl-antarctica' ); ?></span>
							<div class="content">
                               <span class="follow-us">
	                               <?php

		                               // facebook
		                               if ( ! empty( $meta_data['pearl_facebook_profile'] ) ) {
			                               echo '<a href="' . esc_url( $meta_data['pearl_facebook_profile'][0] ) . '" target="_blank"><i class="fa fa-facebook"></i></a>';
		                               }

		                               // twitter
		                               if ( ! empty( $meta_data['pearl_twitter_profile'] ) ) {
			                               echo '<a href="' . esc_url( $meta_data['pearl_twitter_profile'][0] ) . '" target="_blank"><i class="fa fa-twitter"></i></a>';
		                               }

		                               // google+
		                               if ( ! empty( $meta_data['pearl_google_profile'] ) ) {
			                               echo '<a href="' . esc_url( $meta_data['pearl_google_profile'][0] ) . '" target="_blank"><i class="fa fa-google-plus"></i></a>';
		                               }

		                               // linkedin
		                               if ( ! empty( $meta_data['pearl_linkedin_profile'] ) ) {
			                               echo '<a href="' . esc_url( $meta_data['pearl_linkedin_profile'][0] ) . '" target="_blank"><i class="fa fa-linkedin"></i></a>';
		                               }

		                               // instagram
		                               if ( ! empty( $meta_data['pearl_instagram_profile'] ) ) {
			                               echo '<a href="' . esc_url( $meta_data['pearl_instagram_profile'][0] ) . '" target="_blank"><i class="fa fa-instagram"></i></a>';
		                               }

		                               // pinterest
		                               if ( ! empty( $meta_data['pearl_pinterest_profile'] ) ) {
			                               echo '<a href="' . esc_url( $meta_data['pearl_pinterest_profile'][0] ) . '" target="_blank"><i class="fa fa-pinterest-p"></i></a>';
		                               }
	                               ?>
                                </span>
							</div>
						</li>

					</ul>

				</div>

				<div class="col-md-7">
					<?php

					if ( ! empty( $meta_data['pearl_form_title'] ) ) {
						echo '<h3 class="section-title">' . esc_html( $meta_data['pearl_form_title'][0] ) . '</h3>';
					}

					if ( ! empty( $meta_data['pearl_form_shortcode'] ) ) {
						echo do_shortcode( esc_html( $meta_data['pearl_form_shortcode'][0] ) );
					} else {
						echo do_shortcode( '[pearl_contact_form]' );
					}


					?>
				</div>

			</div>
		</main>
	</div>


<?php
	$map_lat  = ( empty( $meta_data['pearl_map_lat'] ) ) ? 40.7033127 : $meta_data['pearl_map_lat'][0];
	$map_long = ( empty( $meta_data['pearl_map_long'] ) ) ? - 73.979681 : $meta_data['pearl_map_long'][0];
	$map_zoom = ( empty( $meta_data['pearl_map_zoom'] ) ) ? 12 : $meta_data['pearl_map_zoom'][0];

	if ( 'show' == $map_dis ) {
		?>
		<script>
			function initialize() {
				var mapCanvas = document.getElementById('google-map'),
					latlang = new google.maps.LatLng(<?php echo esc_html( $map_lat ); ?>, <?php echo esc_html( $map_long ); ?>);

				var options = {
					center: latlang,
					scrollwheel: false,
					zoom: <?php echo esc_html( $map_zoom ); ?>,
					zoomControl: true,
					zoomControlOptions: {
						style: google.maps.ZoomControlStyle.SMALL
					},
					panControl: false,
					mapTypeControl: true,
					styles: [
						{
							"featureType": "water",
							"elementType": "geometry",
							"stylers": [
								{
									"color": "#e9e9e9"
								},
								{
									"lightness": 17
								}
							]
						},
						{
							"featureType": "landscape",
							"elementType": "geometry",
							"stylers": [
								{
									"color": "#f5f5f5"
								},
								{
									"lightness": 20
								}
							]
						},
						{
							"featureType": "road.highway",
							"elementType": "geometry.fill",
							"stylers": [
								{
									"color": "#ffffff"
								},
								{
									"lightness": 17
								}
							]
						},
						{
							"featureType": "road.highway",
							"elementType": "geometry.stroke",
							"stylers": [
								{
									"color": "#ffffff"
								},
								{
									"lightness": 29
								},
								{
									"weight": 0.2
								}
							]
						},
						{
							"featureType": "road.arterial",
							"elementType": "geometry",
							"stylers": [
								{
									"color": "#ffffff"
								},
								{
									"lightness": 18
								}
							]
						},
						{
							"featureType": "road.local",
							"elementType": "geometry",
							"stylers": [
								{
									"color": "#ffffff"
								},
								{
									"lightness": 16
								}
							]
						},
						{
							"featureType": "poi",
							"elementType": "geometry",
							"stylers": [
								{
									"color": "#f5f5f5"
								},
								{
									"lightness": 21
								}
							]
						},
						{
							"featureType": "poi.park",
							"elementType": "geometry",
							"stylers": [
								{
									"color": "#dedede"
								},
								{
									"lightness": 21
								}
							]
						},
						{
							"elementType": "labels.text.stroke",
							"stylers": [
								{
									"visibility": "on"
								},
								{
									"color": "#ffffff"
								},
								{
									"lightness": 16
								}
							]
						},
						{
							"elementType": "labels.text.fill",
							"stylers": [
								{
									"saturation": 36
								},
								{
									"color": "#333333"
								},
								{
									"lightness": 40
								}
							]
						},
						{
							"elementType": "labels.icon",
							"stylers": [
								{
									"visibility": "off"
								}
							]
						},
						{
							"featureType": "transit",
							"elementType": "geometry",
							"stylers": [
								{
									"color": "#f2f2f2"
								},
								{
									"lightness": 19
								}
							]
						},
						{
							"featureType": "administrative",
							"elementType": "geometry.fill",
							"stylers": [
								{
									"color": "#fefefe"
								},
								{
									"lightness": 20
								}
							]
						},
						{
							"featureType": "administrative",
							"elementType": "geometry.stroke",
							"stylers": [
								{
									"color": "#fefefe"
								},
								{
									"lightness": 17
								},
								{
									"weight": 1.2
								}
							]
						}
					]
				};
				var map = new google.maps.Map(mapCanvas, options);
				var marker = new google.maps.Marker({
					position: latlang,
					map: map,
					icon: '<?php echo get_template_directory_uri() . '/img/marker.png'; ?>',
					animation: google.maps.Animation.BOUNCE
				});
			}
			google.maps.event.addDomListener(window, 'load', initialize);
		</script>
		<?php
	}

get_footer(); ?>

