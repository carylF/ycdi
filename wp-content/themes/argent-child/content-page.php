<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package Argent
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="page-header">
		<?php the_title( '<h1 class="page-title">', '</h1>' ); ?>
	</header><!-- .page-header -->

	<div id="main-banner" class="page-content">
		<?php the_content(); ?>
	</div><!-- .page-content -->


</article><!-- #post-## -->
