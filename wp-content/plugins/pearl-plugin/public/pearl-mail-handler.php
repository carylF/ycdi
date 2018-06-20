<?php

if( !function_exists( 'pearl_mail_handler' ) ){
    /**
     * contact form email handler
     * @since   1.0.0
     * @return  void
     */
    function pearl_mail_handler() {

        if ( isset( $_POST['email'] ) ):

            $nonce = $_POST['nonce'];

            if ( ! wp_verify_nonce( $nonce, 'pearl_mail_handler' ) ) {
                echo json_encode( array(
                    'success' => false,
                    'message' => esc_html__( 'Unverified Nonce!', 'pearl-plugin' )
                ) );
                die;
            }

            // Sanitize and Validate Target email address that is coming from agent form
            $to_email = sanitize_email( $_POST['target'] );
            $to_email = is_email( $to_email );
            if ( ! $to_email ) {
                echo wp_json_encode( array(
                    'success' => false,
                    'message' => esc_html__( 'Target Email address is not properly configured!', 'pearl-plugin' )
                ));
                die;
            }

            /*
             *  Sanitize and Validate contact form input data
             */
            $from_name = sanitize_text_field( $_POST['name'] );
            $last_name = sanitize_text_field( $_POST['lname'] );
            $phone     = sanitize_text_field( $_POST['phone'] );
            $message = wp_kses_data( $_POST['message'] );
            $from_email = sanitize_email( $_POST['email'] );
            $from_email = is_email( $from_email );
            if ( ! $from_email ) {
                echo json_encode( array(
                    'success' => false,
                    'message' => esc_html__( 'Provided Email address is invalid!', 'pearl-plugin' )
                ) );
                die;
            }

            $email_subject = esc_html__( 'New message sent by', 'pearl-plugin' ) . ' ' . $from_name . ' ' . esc_html__( 'using contact form at', 'pearl-plugin' ) . ' ' . esc_html( get_bloginfo( 'name' ) );
            $email_body  = esc_html__( "You have received a message from: ", 'pearl-plugin' ) . $from_name . ' ' . $last_name . " <br/>";

            if ( ! empty( $phone ) ) {
                $email_body .= esc_html__( "Phone Number: ", 'pearl-plugin' ) . $phone . " <br/>";
            }

            $email_body .= esc_html__( "Their additional message is as follows:", 'pearl-plugin' ) . " <br/>";
            $email_body .= wpautop( $message );
            $email_body .= wpautop( sprintf( esc_html__( 'You can contact %1$s via email: %2$s', 'pearl-plugin' ), $from_name, $from_email ) );

            /*
             * Email Headers ( Reply To and Content Type )
             */
            $headers   = array();
            $headers[] = "Reply-To: $from_name <$from_email>";
            $headers[] = "Content-Type: text/html; charset=UTF-8";
            $headers   = apply_filters( "pearl_contact_mail_header", $headers );    // just in case if you want to modify the header in child theme

            if ( wp_mail( $to_email, $email_subject, $email_body, $headers ) ) {
                echo json_encode( array(
                    'success' => true,
                    'message' => esc_html__( "Message Sent Successfully!", 'pearl-plugin' )
                ) );
            } else {
                echo json_encode( array(
                        'success' => false,
                        'message' => esc_html__( "Server Error: WordPress mail function failed!", 'pearl-plugin' )
                    )
                );
            }

        else:
            echo json_encode( array(
                    'success' => false,
                    'message' => esc_html__( "Invalid Request !", 'pearl-plugin' )
                )
            );
        endif;

        die;
    }

    add_action( 'wp_ajax_nopriv_pearl_mail_handler', 'pearl_mail_handler' );
    add_action( 'wp_ajax_pearl_mail_handler', 'pearl_mail_handler' );

}