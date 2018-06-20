<?php
/**
 * This file is responsible for the Pearl Framework load.
 */

/**
 * Load Plugins
 */
require_once get_template_directory() . '/pearl-framework/tgm/load-plugins.php';

/**
 * Pearl Functions
 */
require_once PEARL_FRAMEWORK_DIRECTORY . 'functions/pearl-functions.php';

/**
 * Customizer Settings
 */
require_once PEARL_FRAMEWORK_DIRECTORY . 'customizer/customizer.php';

/**
 * The file is responsible to add default post and pages meta-boxes
 */
require_once PEARL_FRAMEWORK_DIRECTORY . 'meta-boxes/pages-meta-boxes.php';

/**
 * The file is responsible to add dynamic sidebars on widgets.php
 */
require_once PEARL_FRAMEWORK_DIRECTORY . 'sidebars/pearl-sidebars.php';


/**
 * Allowed tags in the theme
 */
$pearl_allowed_tags = array(
    'a' => array(
        'href' => array(),
        'title' => array(),
        'target' => array(),
    ),
    'em' => array(),
    'strong' => array(),
    'br' => array(),
    'i'  => array(
        'class' => array()
    )
);

if ( ! function_exists( 'pearl_allowed_tags' ) ) {
    /**
     * Retured sanitized string with allowed only $pearl_allowed_tags
     *
     * @param string
     * @return string
     */
    function pearl_allowed_tags( $value ) {
        global $pearl_allowed_tags;
        return wp_kses( $value, $pearl_allowed_tags );
    }
}

if ( ! function_exists( 'pearl_sanitize' ) ) {
    /**
     * Default sanitize function to use where no sanitization needed.
     * It's to fulfil sanitization function requirement while adding a
     * customizer setting.
     *
     * @param Mixed
     * @return Mixed
     */
    function pearl_sanitize( $value ) {
        return $value;
    }
}

add_filter('get_avatar','add_gravatar_class');

function add_gravatar_class( $class ) {

    $class = str_replace("class='avatar", "class='avatar author-image", $class);

    return $class;
}