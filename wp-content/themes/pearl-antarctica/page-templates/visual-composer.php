<?php
/**
 * Template Name: Visual Composer Template
 */
get_header(); ?>
    <!-- Container -->
    <div class="container fullwidth-page entry-content">
        <div class="row">
            <div class="col-md-12">
                <!-- Main Content -->
                <main id="main" class="main">
                    <?php
                        if ( have_posts() ) {
                            while ( have_posts() ) {
                                the_post();

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