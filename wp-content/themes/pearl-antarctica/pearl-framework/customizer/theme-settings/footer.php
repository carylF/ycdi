<?php
/**
 * Customizer settings for Footer
 */

if ( ! function_exists( 'pearl_footer_customizer' ) ) :
    function pearl_footer_customizer( WP_Customize_Manager $wp_customize ) {

        /**
         * Footer Section
         */
        $wp_customize->add_section( 'pearl_footer_section', array(
            'title' => esc_html__( 'Footer', 'pearl-antarctica' ),
            'priority' => 173
        ) );

        // call to action bar
        $wp_customize->add_setting( 'pearl_footer_call_action', array(
            'type' => 'option',
            'default' => 'show',
            'sanitize_callback' => 'pearl_sanitize'
        ) );

        $wp_customize->add_control( new Pearl_Dropdown_Control(
            $wp_customize,
            'pearl_footer_call_action',
            array(
                'label'      => esc_html__( 'Call to Action Bar', 'pearl-antarctica' ),
                'section'    => 'pearl_footer_section',
                'settings'   => 'pearl_footer_call_action',
                'choices'    => array(
                    'show'   => 'Show',
                    'hide'   => 'Hide',
                )
            )
        ) );

        // call to action bar text
        $wp_customize->add_setting( 'pearl_footer_call_action_text', array(
            'type' => 'option',
            'sanitize_callback' => 'sanitize_text_field',
            'transport'   => 'postMessage',
        ) );

        $wp_customize->add_control( 'pearl_footer_call_action_text', array(
            'label'             => esc_html__( 'Call to Action Text', 'pearl-antarctica' ),
            'section'           => 'pearl_footer_section',
            'settings'          => 'pearl_footer_call_action_text',
            'type'              => 'text',
            'active_callback'   => 'pearl_footer_call_action'
        ) );

        // call to action bar button text
        $wp_customize->add_setting( 'pearl_footer_call_action_button', array(
            'type' => 'option',
            'sanitize_callback' => 'sanitize_text_field'
        ) );

        $wp_customize->add_control( 'pearl_footer_call_action_button', array(
            'label'      => esc_html__( 'Call to Action Button Text', 'pearl-antarctica' ),
            'section'    => 'pearl_footer_section',
            'settings'   => 'pearl_footer_call_action_button',
            'type'       => 'text',
            'active_callback'   => 'pearl_footer_call_action'
        ) );

        // call to action bar button url
        $wp_customize->add_setting( 'pearl_footer_call_action_url', array(
            'type' => 'option',
            'sanitize_callback' => 'esc_url'
        ) );

        $wp_customize->add_control( 'pearl_footer_call_action_url', array(
            'label'      => esc_html__( 'Call to Action Button URL', 'pearl-antarctica' ),
            'section'    => 'pearl_footer_section',
            'settings'   => 'pearl_footer_call_action_url',
            'type'       => 'text',
            'active_callback'   => 'pearl_footer_call_action'
        ) );


        // separator
        $wp_customize->add_setting( 'pearl_footer_widget_layout_separator', array(
            'sanitize_callback' => 'pearl_sanitize',
        ) );
        $wp_customize->add_control(
            new Pearl_Separator_Control(
                $wp_customize,
                'pearl_footer_widget_layout_separator',
                array(
                    'section' => 'pearl_footer_section',
                )
            )
        );

        // widget Layout
        $wp_customize->add_setting( 'pearl_footer_widget_layout', array(
            'type' => 'option',
            'default' => 'four-column',
            'sanitize_callback' => 'sanitize_text_field',
        ) );

        $wp_customize->add_control( 'pearl_footer_widget_layout', array(
            'label'       => __( 'Footer Columns', 'pearl_footer_section' ),
            'section'     => 'pearl_footer_section',
            'settings'    => 'pearl_footer_widget_layout',
            'type'        => 'radio',
            'choices'     => array(
                'one-column' => __( 'One Column', 'pearl-antarctica' ),
                'two-column' => __( 'Two Columns', 'pearl-antarctica' ),
                'three-column' => __( 'Three Columns', 'pearl-antarctica' ),
                'four-column' => __( 'Four Columns', 'pearl-antarctica' ),
            ),
        ) );

        // separator
        $wp_customize->add_setting( 'pearl_footer_copyright_separator', array(
            'sanitize_callback' => 'pearl_sanitize',
        ) );
        $wp_customize->add_control(
            new Pearl_Separator_Control(
                $wp_customize,
                'pearl_footer_copyright_separator',
                array(
                    'section' => 'pearl_footer_section',
                )
            )
        );

        // footer copyright text
        $wp_customize->add_setting( 'pearl_footer_copyright', array(
            'type' => 'option',
            'sanitize_callback' => 'pearl_allowed_tags'
        ) );

        $wp_customize->add_control( 'pearl_footer_copyright', array(
            'label'       => esc_html__( 'Footer Copyright Text', 'pearl-antarctica' ),
            'description' => esc_html__( 'You are allowed to use <a>, <em>, <strong>, <br> and <i> tags in your copyright text area.', 'pearl-antarctica' ),
            'section'     => 'pearl_footer_section',
            'settings'    => 'pearl_footer_copyright',
            'type'        => 'textarea'
        ) );

    }

    add_action( 'customize_register', 'pearl_footer_customizer' );
endif;

if ( ! function_exists( 'pearl_footer_call_action' ) ) :
    /**
     * Check call to action bar display
     * @return bool
     */
    function pearl_footer_call_action( $control ) {

        $action_call = $control->manager->get_setting( 'pearl_footer_call_action' )->value();

        if ( 'show' == $action_call ) return true;

        return false;
    }
endif;
