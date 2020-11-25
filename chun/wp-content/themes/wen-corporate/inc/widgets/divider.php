<?php

class WEN_Corporate_Divider_Widget extends WP_Widget {

    function __construct() {
        $opts =array(
                    'classname'     => 'wen_corporate_divider_widget',
                    'description'   => __( 'Divider Widget', 'wen-corporate' )
                );

        $this-> WP_Widget('wen-corporate-divider', '[WEN Corporate]   '.__('Divider Widget', 'wen-corporate'), $opts );
    }


    function widget( $args, $instance ) {
        //
        echo '<hr class="wen-corporate-divider" />';
        //

    }

    function update( $new_instance, $old_instance ) {

        $instance = $old_instance;
        return $instance;

    }

    function form( $instance ) {

        echo '<p>' . __('No option for this widget', 'wen-corporate') . '</p>';
    }

} ?>
