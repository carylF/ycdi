<?php
	get_header(); ?>
	<!-- Container -->
	<div class="container main-container fullwidth-page entry-content">
		<div class="row">
			<div class="col-md-12">

				<!-- Main Content -->
				<main id="main" class="main">
					<div class="wrapper-404">

						<h1 title="title-404">4<span>0</span>4</h1>

						<div class="content-404">

							<p><?php esc_html_e( 'Looks like something went wrong!', 'pearl-antarctica' ) ?></p>

							<p><?php esc_html_e( 'The page you were looking for is not here', 'pearl-antarctica' ) ?></p>

							<p><a class="btn btn-primary btn-small btn-outline" href="<?php echo esc_url( home_url('/') ); ?>"><?php esc_html_e( 'Go to Home', 'pearl-antarctica' ); ?></a></p>

						</div>

					</div>
				</main>
			</div>
		</div>
	</div>
<?php get_footer(); ?>