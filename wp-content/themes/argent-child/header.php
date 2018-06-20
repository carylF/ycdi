<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package argent
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div  class="container">
	<a class="skip-link screen-reader-text" href="#content"><?php _e( 'Skip to content', 'argent' ); ?></a>
  <!-- Loader -->

	 <div class="row banner" role="banner">
     <div class="overlay"></div>
				<!-- header -->
				<div id="header" class="row header sticky">
					<div class="row-fixed row-pd">
                <div class="logo">
                  <a href="#"><img src="../wp-content/uploads/2018/06/ycdi.png"/></a>
                </div>
                <!-- Menu -->
                <div class="menu">
                  <nav  role="navigation">
                    <button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><?php _e( 'Menu', 'argent' ); ?></button>
                    <?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'primary-menu' ) ); ?>
                  </nav><!-- #site-navigation -->
                </div>
          </div>
     </div>


    <!-- .site-branding -->
    

	 </div><!-- #masthead -->
  
  </div>
  
  
  

	<div id="content" class="site-content">
