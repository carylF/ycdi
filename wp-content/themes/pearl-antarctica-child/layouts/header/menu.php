<?php
	global $header_type, $menu_Classes;
	$theme_location = 'header-menu';
	$menu_Classes   = 'menu-primary clearfix';

	if ( 'header_5' == $header_type ) {
		$theme_location = 'sidebar-menu';
		$menu_Classes .= ' side-menu-primary';
	}
?>
<nav id="site-navigation" class="main-navigation">
	<div class="menu-primary-container">
		<?php
			$main_menu = array(
				'theme_location' => $theme_location,
				'menu_class'     => $menu_Classes
			);
			wp_nav_menu( $main_menu );
		?>
	</div>
</nav>