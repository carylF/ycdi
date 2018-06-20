<?php
add_action( 'widgets_init', function(){
    register_widget( 'Pearl_Ad_Widget' );
});

class Pearl_Ad_Widget extends WP_Widget
{

    /**
     * Sets up the widgets name etc
     */
    public function __construct()
    {
        $widget_ops = array(
            'classname' => 'pearl_ad_widget',
            'description' => 'Display linked ad image.',
        );

        parent::__construct( 'pearl_ad_widget', 'Pearl - Advertisement Widget', $widget_ops );
    }

    /**
     * Outputs the content of the widget
     *
     * @param array $args
     * @param array $instance
     */
    public function widget( $args, $instance ) {
        echo $args['before_widget'];

        if ( ! empty( $instance['title'] ) ) {
            echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ) . $args['after_title'];
        }

        if ( ! empty( $instance['img_url'] ) ) {

            $image = '<img src="' . esc_url( $instance['img_url'] ) . '" alt="image">';

            if ( ! empty( $instance['link_url'] ) ) {
                echo '<div class="img-wrap"><a href="' . esc_url( $instance['link_url'] ) . '">';
                echo $image;
                echo '</a></div>';
            } else {
                echo $image;
            }
        }

        echo $args['after_widget'];
    }

    /**
     * Outputs the options form on admin
     * @param array $instance The widget options
     * @return string
     */
    public function form( $instance ) {
        // outputs the options form on admin
        $title      = ! empty( $instance['title'] ) ? $instance['title'] : esc_html__( 'Recommended', 'pearl-antarctica' );
        $img_url    = ! empty( $instance['img_url'] ) ? $instance['img_url'] : '';
        $link_url   = ! empty( $instance['link_url'] ) ? $instance['link_url'] : '';
        ?>
        <p>
            <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php esc_html_e( 'Title:', 'pearl-antarctica' ); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
        </p>
        <p>
            <label for="<?php echo $this->get_field_id( 'img_url' ); ?>"><?php esc_html_e( 'Image URL:', 'pearl-antarctica' ); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'img_url' ); ?>" name="<?php echo $this->get_field_name( 'img_url' ); ?>" type="text" value="<?php echo esc_attr( $img_url ); ?>">
            <i><?php esc_html_e( 'You can provide any image URL from media library or an external source.', 'pearl-antarctica' ); ?></i>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id( 'link_url' ); ?>"><?php esc_html_e( 'Link URL:', 'pearl-antarctica' ); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'link_url' ); ?>" name="<?php echo $this->get_field_name( 'link_url' ); ?>" type="text" value="<?php echo esc_attr( $link_url ); ?>">
            <i><?php esc_html_e( 'Provide the url to which you want link above image.', 'pearl-antarctica' ); ?></i>
        </p>
        <?php
    }

    /**
     * Processing widget options on save
     *
     * @param array $new_instance The new options
     * @param array $old_instance The previous options
     * @return string
     */
    public function update( $new_instance, $old_instance ) {

        $updated_instance = '';

        // Sanitization of widget values on save
        foreach( $new_instance as $key => $value )
        {
            $updated_instance[$key] = sanitize_text_field( $value );
        }

        return $updated_instance;
    }
}