<?php
if ( ! class_exists( 'Pearl_Range_Control' ) )
    return NULL;

class WP_Customize_Range_Control extends WP_Customize_Control
{
    public $type = 'pearl_range';
    public function enqueue()
    {
        wp_enqueue_script(
            'pearl-range-control',
            get_template_directory_uri() . '/pearl-framework/customizer/custom-controls/js/range-control.js',
            array('jquery'),
            false,
            true
        );
    }
    public function render_content()
    {
        ?>
        <label>
            <?php if ( ! empty( $this->label )) : ?>
                <span class="customize-control-title"><?php echo esc_html($this->label); ?></span>
            <?php endif; ?>
            <div class="pearl-range-value"><?php echo esc_attr($this->value()); ?></div>
            <input width="100%" data-input-type="range" type="range" <?php $this->input_attrs(); ?> value="<?php echo esc_attr($this->value()); ?>" <?php $this->link(); ?> />
            <?php if ( ! empty( $this->description )) : ?>
                <span class="description customize-control-description"><?php echo $this->description; ?></span>
            <?php endif; ?>
        </label>
        <?php
    }
}