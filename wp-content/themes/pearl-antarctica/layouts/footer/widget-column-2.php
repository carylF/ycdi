<?php
global $footer_widget_column_classes
?>
<div class="widget-column <?php echo esc_attr($footer_widget_column_classes); ?>">
    <?php
    if ( is_active_sidebar( 'footer-2' ) ) {
        dynamic_sidebar( 'footer-2' );
    }
    ?>
</div>
