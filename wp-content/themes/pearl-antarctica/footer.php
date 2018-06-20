<?php

    $call_action_bar = get_option( 'pearl_footer_call_action', 'show' );

    if ( 'show' == $call_action_bar ) {
        /* Call to action bar */
        get_template_part( 'layouts/call-to-action' );
    }
?>

<!-- Footer -->
<footer id="footer" class="footer">
    <?php
        if ( is_active_sidebar( 'footer-1' ) || is_active_sidebar( 'footer-2' ) || is_active_sidebar( 'footer-3' )
             || is_active_sidebar( 'footer-4' )
        ) {
            global $footer_widget_column_classes;

            $footer_widget_layout = get_option('pearl_footer_widget_layout','four-column');

            if ( 'one-column' == $footer_widget_layout ) {
                $footer_widget_column = 1;
                $footer_widget_column_classes = 'col-xs-12';
            } elseif ( 'two-column' == $footer_widget_layout ) {
                $footer_widget_column = 2;
                $footer_widget_column_classes = 'col-sm-6';
            } elseif ( 'three-column' == $footer_widget_layout ) {
                $footer_widget_column = 3;
                $footer_widget_column_classes = 'col-sm-6 col-md-4';
            }else{
                $footer_widget_column = 4;
                $footer_widget_column_classes = 'col-sm-6 col-md-3';
            }
            ?>
            <div class="container">
                <aside class="row footer-widgets">
                    <?php
                    for ( $i = 1; $i <= $footer_widget_column; $i ++ ) {
                        get_template_part( 'layouts/footer/widget-column-' . $i );

                        if( $i % 2 == 0){
                            echo '<div class="clearfix visible-sm"></div>';
                        }
                    }
                    ?>
                </aside>
            </div>
            <?php
        }

        $copyright = get_option( 'pearl_footer_copyright', esc_html__( 'Copyrights © - All rights reserved.', 'pearl-antarctica' ) );

        if ( ! empty( $copyright ) ) {
            global $pearl_allowed_tags;
            ?><div class="sub-footer text-center">
                <div class="container">
                    <?php
                    echo '<p>' . wp_kses( $copyright, $pearl_allowed_tags ) . '</p>';
                    ?>
                </div>
            </div><?php
        }
    ?>
</footer>

</div><!-- End Page Wrapper -->

<a href="#" id="scroll-to-top"><i class="fa fa-chevron-up"></i></a>

<?php
    /* Always have wp_footer() just before the closing </body>
     * tag of your theme, or you will break many plugins, which
     * generally use this hook to reference JavaScript files.
     */
    wp_footer();
?>
</body>
</html>