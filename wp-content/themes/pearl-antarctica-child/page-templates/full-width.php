<?php
/**
 * Template Name: Full Width
 */
get_header(); ?>
    <!-- Container -->
    <div class="container main-container fullwidth-page entry-content">
        <div class="row">
            <div class="col-md-12">

                <!-- Main Content -->
                <main id="main" class="main">

                    <?php

                        if ( have_posts() ) {
                            while ( have_posts() ) {
                                the_post();

                                if ( has_post_thumbnail() ) {
                                    ?>
                                    <div class="post-thumbnail">
                                        <?php the_post_thumbnail( 'full' ); ?>
                                    </div>
                                    <?php
                                }

                                the_content();
                            }
                        }

                        pearl_link_pages();
                    ?>
                </main>
            </div>
        </div>
    </div>
<?php get_footer(); ?>