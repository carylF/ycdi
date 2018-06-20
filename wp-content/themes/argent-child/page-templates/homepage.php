<?php
/**
 * Template Name: Home Page
 *
 * @package Argent
 */

$home_portfolio = get_theme_mod( 'argent-child_front_portfolio', 1 );

get_header(); ?>
<?php the_content(); ?>

<?php get_footer(); ?>
