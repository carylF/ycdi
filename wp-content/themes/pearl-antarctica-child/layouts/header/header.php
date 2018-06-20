<?php
global $header_classes;
?>
<header id="header" class="header <?php echo esc_attr( $header_classes ); ?> clearfix">
	<div class="container">
		<div class="row">
			<div class="col-xs-6 col-sm-4 col-lg-3">
				<div class="site-branding">
					<div class="wrap">
						<?php get_template_part( 'layouts/header/logo' ); ?>
					</div>
				</div>
			</div>
			<div class="col-xs-6 col-sm-8 col-lg-9">
				<div class="navigation-top clearfix">
					<?php get_template_part( 'layouts/header/search-form' ); ?>
					<?php get_template_part( 'layouts/header/menu' ); ?>
				</div>
			</div>
		</div>
	</div>
</header>