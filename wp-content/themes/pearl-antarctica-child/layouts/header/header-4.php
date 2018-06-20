<?php
global $header_classes;
?>
<header id="header" class="header <?php echo esc_attr( $header_classes ); ?> clearfix">
	<div class="container">
		<div class="row">
			<div class="col-md-4 hidden-xs hidden-sm">
				<?php get_template_part( 'layouts/header/tag-line' ); ?>
			</div>
			<div class="col-sm-6 col-md-4">
				<div class="site-branding">
					<?php get_template_part( 'layouts/header/logo' ); ?>
				</div>
			</div>
			<div class="col-sm-6 col-md-4">
				<?php get_template_part( 'layouts/header/social-links' ); ?>
			</div>
		</div>
	</div>
	<div class="header-menu-wrap">
		<div class="container">
			<div class="row">
				<div class="col-xs-6 col-md-8 col-lg-9">
					<div class="navigation-top clearfix">
						<?php get_template_part( 'layouts/header/menu' ); ?>
					</div>
				</div>
				<div class="col-xs-6 col-md-4 col-lg-3">
					<?php get_template_part( 'layouts/header/search-form' ); ?>
				</div>
			</div>
		</div>
	</div>
</header>