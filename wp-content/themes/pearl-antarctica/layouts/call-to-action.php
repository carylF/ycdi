<?php
    $action_bar_text   = get_option( 'pearl_footer_call_action_text' );
    $action_bar_button = get_option( 'pearl_footer_call_action_button' );
    $action_bar_url    = get_option( 'pearl_footer_call_action_url' );

    if ( ! empty( $action_bar_text ) || ! empty( $action_bar_button ) && ! empty( $action_bar_url ) ) {
        ?>
        <!-- Call to Action -->
        <div class="call-to-action">
            <div class="container">
                <div class="row">
                    <div class="col-md-8">
                        <?php
                        if ( ! empty( $action_bar_text ) ) {
                            echo '<p>' . esc_html( $action_bar_text ) . '</p>';
                        }
                        ?>
                    </div>
                    <div class="col-md-4">
                        <?php
                        if ( ! empty( $action_bar_button ) && ! empty( $action_bar_url ) ) {
                            echo '<a class="btn" href="' . esc_url( $action_bar_url ) . '">' . esc_html( $action_bar_button ) . '</a>';
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }
?>
