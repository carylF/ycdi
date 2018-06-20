<?php get_header(); ?>
    <!-- Container -->
    <div class="container main-container portfolio-page portfolio-single-post">

        <!-- Main Content -->
        <main id="main" class="main">
            <?php

                while ( have_posts() ) {
                    the_post();

                    $project_metadata = get_post_custom();


                    $gallery_ids = $project_metadata['pearl_project_project_images'];
                    $gallery_images = array();

                    if ( ! empty( $gallery_ids ) ) {


                        foreach ( $gallery_ids as $image_id ) {
                            $gallery_images[$image_id]['thumbnail'] = wp_get_attachment_image_url( $image_id, 'pearl_image_size_1170_570' );
                            $gallery_images[$image_id]['full'] = wp_get_attachment_image_url( $image_id, 'full' );
                        }

                        ?>
                        <div class="project-slider flexslider">
                            <ul class="slides">
                                <?php

                                    foreach ( $gallery_images as $image ) {

                                        ?><li class="slide"><a href="<?php echo esc_url( $image['full'] ); ?>" data-rel="lightcase:portfolio"><img src="<?php echo esc_url( $image['thumbnail'] ); ?>" alt=""></a></li><?php
                                    }
                                ?>
                            </ul>
                        </div>
                        <?php
                    }

                    ?>

                    <article class="portfolio-post clearfix">
                        <div class="post-thumbnail">
                            <?php
                                $thumbnail_url = wp_get_attachment_image_url( get_post_thumbnail_id(), 'full' );
                            ?>
                            <a href="<?php echo esc_url( $thumbnail_url ); ?>" data-rel="lightcase"><?php the_post_thumbnail( 'pearl_image_size_1170_570', array( 'class' => 'img-responsive' ) ); ?></a>
                        </div>
                        <div class="row">
                            <div class="col-md-8">
                                <header class="portfolio-post-header">
                                    <h2 class="portfolio-post-title"><?php the_title(); ?></h2>
                                </header>
                                <div class="entry-content clearfix">
                                    <?php the_content(); ?>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <ul class="project-meta">
                                    <?php

                                        if ( ! empty( $project_metadata['pearl_project_client'][0] ) ) {
                                            ?>
                                            <li>
                                                <h5 class="title"><?php esc_html_e( 'Client', 'pearl-antarctica' ); ?></h5>
                                                <span><?php echo esc_html( $project_metadata['pearl_project_client'][0] ); ?></span>
                                            </li>
                                            <?php
                                        }

                                        if ( ! empty( $project_metadata['pearl_project_date'][0] ) ) {
                                            ?>
                                            <li>
                                                <h5 class="title"><?php esc_html_e( 'Date', 'pearl-antarctica' ); ?></h5>
                                                <span><?php echo esc_html( $project_metadata['pearl_project_date'][0] ); ?></span>
                                            </li>
                                            <?php
                                        }

                                        $portfolio_categories = get_the_terms( get_the_ID(), 'project-category' );

                                        if( ! empty( $portfolio_categories ) && ! is_wp_error( $portfolio_categories ) ) {

                                            $count = count( $portfolio_categories );
                                            $i = 0;

                                            echo '<li>';
                                            ?>
                                            <h5 class="title"><?php esc_html_e( 'Skills', 'pearl-antarctica' ); ?></h5><?php

                                            foreach( $portfolio_categories as $category ){
                                                $i++;
                                                echo '<span>'. esc_html( $category->name ) .'</span>';
                                                if ( $i < $count ) { echo ', '; }
                                            }
                                            echo '</li>';
                                        }
                                    ?>
                                </ul>
                                <?php
                                    if ( ! empty( $project_metadata['pearl_project_url'][0] ) ) {
                                        ?><a href="<?php echo esc_url( $project_metadata['pearl_project_url'][0] ); ?>" class="btn btn-primary" target="_blank"><?php esc_html_e( 'View Project', 'pearl-antarctica' ); ?></a><?php
                                    }
                                ?>
                            </div>
                        </div>
                    </article>
                    <?php
                }

                if ( get_previous_post_link() || get_next_post_link() ) {
                    ?>
                    <div class="post-navigation clearfix">
                        <?php

                            $next_post = get_previous_post();
                            if ( ! empty( $next_post ) ) : ?>
                                <a class="pull-left" href="<?php echo get_permalink($next_post->ID); ?>"><i class="fa fa-angle-left" aria-hidden="true"></i></a>
                            <?php endif;

                            $prev_post = get_next_post();
                            if ( ! empty( $prev_post ) ) : ?>
                                <a class="pull-right" href="<?php echo get_permalink($prev_post->ID); ?>"><i class="fa fa-angle-right" aria-hidden="true"></i></a>
                            <?php endif;
                        ?>
                    </div>
                <?php } ?>

        </main>
    </div>
<?php get_footer(); ?>