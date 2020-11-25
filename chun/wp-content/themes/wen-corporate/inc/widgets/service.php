<?php

class WEN_Corporate_Service_Widget extends WP_Widget {

	function __construct() {
		$opts =array(
					'classname'     => 'wen_corporate_service_widget',
					'description'   => __( 'Service Block Widget', 'wen-corporate' )
				);

		parent::__construct('wen-corporate-service', '[WEN Corporate]   '.__('Service Widget', 'wen-corporate'), $opts);
	}

	function widget( $args, $instance ) {
		extract( $args , EXTR_SKIP );

		$title               = apply_filters( 'widget_title', empty($instance['title']) ? '' : $instance['title'], $instance, $this->id_base );

    $block_title_1       = ! empty( $instance['block_title_1'] ) ? $instance['block_title_1'] : '';
    $block_icon_1        = ! empty( $instance['block_icon_1'] ) ? $instance['block_icon_1'] : 'fa-cogs';
    $block_description_1 = ! empty( $instance['block_description_1'] ) ? $instance['block_description_1'] : '';
    $block_read_more_1   = ! empty( $instance['block_read_more_1'] ) ? $instance['block_read_more_1'] : '';
    $block_url_1         = ! empty( $instance['block_url_1'] ) ? $instance['block_url_1'] : '';

    $block_title_2       = ! empty( $instance['block_title_2'] ) ? $instance['block_title_2'] : '';
    $block_icon_2        = ! empty( $instance['block_icon_2'] ) ? $instance['block_icon_2'] : 'fa-cogs';
    $block_description_2 = ! empty( $instance['block_description_2'] ) ? $instance['block_description_2'] : '';
    $block_read_more_2   = ! empty( $instance['block_read_more_2'] ) ? $instance['block_read_more_2'] : '';
    $block_url_2         = ! empty( $instance['block_url_2'] ) ? $instance['block_url_2'] : '';

    $block_title_3       = ! empty( $instance['block_title_3'] ) ? $instance['block_title_3'] : '';
    $block_icon_3        = ! empty( $instance['block_icon_3'] ) ? $instance['block_icon_3'] : 'fa-cogs';
    $block_description_3 = ! empty( $instance['block_description_3'] ) ? $instance['block_description_3'] : '';
    $block_read_more_3   = ! empty( $instance['block_read_more_3'] ) ? $instance['block_read_more_3'] : '';
    $block_url_3         = ! empty( $instance['block_url_3'] ) ? $instance['block_url_3'] : '';

    $block_title_4       = ! empty( $instance['block_title_4'] ) ? $instance['block_title_4'] : '';
    $block_icon_4        = ! empty( $instance['block_icon_4'] ) ? $instance['block_icon_4'] : 'fa-cogs';
    $block_description_4 = ! empty( $instance['block_description_4'] ) ? $instance['block_description_4'] : '';
    $block_read_more_4   = ! empty( $instance['block_read_more_4'] ) ? $instance['block_read_more_4'] : '';
    $block_url_4         = ! empty( $instance['block_url_4'] ) ? $instance['block_url_4'] : '';

		echo $before_widget;
		if ($title) echo $before_title . '<span>'.$title .'</span>'. $after_title;
    $service_arr = array();
    for ( $i=0; $i < 4 ; $i++ ) {
      $block = ( $i + 1 );
      $service_arr[ $i ] = array(
        'title'       => ${"block_title_" . $block},
        'icon'        => ${"block_icon_" . $block},
        'description' => ${"block_description_" . $block},
        'read_more'   => ${"block_read_more_" . $block},
        'url'         => ${"block_url_" . $block},
      );
    }
    $refined_arr = array();
    foreach ($service_arr as $key => $item) {
      if ( ! empty( $item['title'] ) ) {
        $refined_arr[] = $item;
      }
    }

    if ( ! empty( $refined_arr ) ) {
  		$this->render_widget_content( $refined_arr );
    }
		//
		echo $after_widget;

	}

  function render_widget_content( $service_arr ){

    $column = count( $service_arr );
    switch ( $column ) {
      case 1:
        $block_item_class = 'col-sm-12';
        break;

      case 2:
        $block_item_class = 'col-sm-6';
        break;

      case 3:
        $block_item_class = 'col-sm-4';
        break;

      case 4:
        $block_item_class = 'col-sm-3';
        break;

      default:
        $block_item_class = '';
        break;
    }

    ?>
    <div class="service-block-list row">

      <?php foreach ( $service_arr as $key => $service ): ?>
        <?php
          $link_open  = '';
          $link_close = '';
          if ( ! empty( $service['url'] ) && ! empty( $service['read_more'] ) ) {
            $link_open  = '<a href="' . esc_url( $service['url'] ) . '" title="' . esc_attr( $service['title'] ) . '">';
            $link_close = '</a>';
          }
        ?>

        <div class="service-block-item <?php echo esc_attr( $block_item_class ); ?>">
          <div class="service-block-inner">

            <i class="<?php echo 'fa ' . esc_attr( $service['icon'] ); ?>"></i>
            <h3 class="service-item-title">
              <?php printf('%s%s%s', $link_open, esc_html( $service['title'] ), $link_close ); ?>
            </h3>
            <div class="service-block-item-excerpt">
              <?php echo esc_html( $service['description'] ); ?>
            </div><!-- .service-block-item-excerpt -->

            <?php if ( ! empty( $link_open ) ): ?>
              <a href="<?php echo esc_url( $service['url'] ); ?>" class="read-more"><?php echo esc_html( $service['read_more'] ); ?></a>
            <?php endif ?>

          </div><!-- .service-block-inner -->
        </div><!-- .service-block-item -->

      <?php endforeach ?>

    </div><!-- .service-block-list -->
    <?php

  }

	function update( $new_instance, $old_instance ) {

		$instance = $old_instance;

    $instance['title']         = esc_attr( strip_tags( $new_instance['title'] ) );

    $instance['block_title_1']       = sanitize_text_field( $new_instance['block_title_1'] );
    $instance['block_icon_1']        = esc_attr( strip_tags( $new_instance['block_icon_1'] ) );
    $instance['block_description_1'] = esc_html( $new_instance['block_description_1'] );
    $instance['block_read_more_1']   = esc_html( $new_instance['block_read_more_1'] );
    $instance['block_url_1']         = esc_url( $new_instance['block_url_1'] );

    $instance['block_title_2']       = sanitize_text_field( $new_instance['block_title_2'] );
    $instance['block_icon_2']        = esc_attr( strip_tags( $new_instance['block_icon_2'] ) );
    $instance['block_description_2'] = esc_html( $new_instance['block_description_2'] );
    $instance['block_read_more_2']   = esc_html( $new_instance['block_read_more_2'] );
    $instance['block_url_2']         = esc_url( $new_instance['block_url_2'] );

    $instance['block_title_3']       = sanitize_text_field( $new_instance['block_title_3'] );
    $instance['block_icon_3']        = esc_attr( strip_tags( $new_instance['block_icon_3'] ) );
    $instance['block_description_3'] = esc_html( $new_instance['block_description_3'] );
    $instance['block_read_more_3']   = esc_html( $new_instance['block_read_more_3'] );
    $instance['block_url_3']         = esc_url( $new_instance['block_url_3'] );

    $instance['block_title_4']       = sanitize_text_field( $new_instance['block_title_4'] );
    $instance['block_icon_4']        = esc_attr( strip_tags( $new_instance['block_icon_4'] ) );
    $instance['block_description_4'] = esc_html( $new_instance['block_description_4'] );
    $instance['block_read_more_4']   = esc_html( $new_instance['block_read_more_4'] );
    $instance['block_url_4']         = esc_url( $new_instance['block_url_4'] );

		return $instance;
	}

	function form( $instance ) {

		$instance = wp_parse_args( (array) $instance, array(
      'title'               =>  __( 'Services' , 'wen-corporate' ),
      'block_title_1'       =>  '',
      'block_icon_1'        =>  'fa-cogs',
      'block_description_1' =>  '',
      'block_read_more_1'   =>  __( 'Read more' , 'wen-corporate' ),
      'block_url_1'         =>  '',
      'block_title_2'       =>  '',
      'block_icon_2'        =>  'fa-cogs',
      'block_description_2' =>  '',
      'block_read_more_2'   =>  __( 'Read more' , 'wen-corporate' ),
      'block_url_2'         =>  '',
      'block_title_3'       =>  '',
      'block_icon_3'        =>  'fa-cogs',
      'block_description_3' =>  '',
      'block_read_more_3'   =>  __( 'Read more' , 'wen-corporate' ),
      'block_url_3'         =>  '',
      'block_title_4'       =>  '',
      'block_icon_4'        =>  'fa-cogs',
      'block_description_4' =>  '',
      'block_read_more_4'   =>  __( 'Read more' , 'wen-corporate' ),
      'block_url_4'         =>  '',
		) );
    $title               = htmlspecialchars( $instance['title'] );
    $block_title_1       = esc_html( $instance['block_title_1'] );
    $block_icon_1        = esc_attr( $instance['block_icon_1'] );
    $block_description_1 = esc_html( $instance['block_description_1'] );
    $block_read_more_1   = esc_html( $instance['block_read_more_1'] );
    $block_url_1         = esc_html( $instance['block_url_1'] );
    $block_title_2       = esc_html( $instance['block_title_2'] );
    $block_icon_2        = esc_attr( $instance['block_icon_2'] );
    $block_description_2 = esc_html( $instance['block_description_2'] );
    $block_read_more_2   = esc_html( $instance['block_read_more_2'] );
    $block_url_2         = esc_html( $instance['block_url_2'] );
    $block_title_3       = esc_html( $instance['block_title_3'] );
    $block_icon_3        = esc_attr( $instance['block_icon_3'] );
    $block_description_3 = esc_html( $instance['block_description_3'] );
    $block_read_more_3   = esc_html( $instance['block_read_more_3'] );
    $block_url_3         = esc_html( $instance['block_url_3'] );
    $block_title_4       = esc_html( $instance['block_title_4'] );
    $block_icon_4        = esc_attr( $instance['block_icon_4'] );
    $block_description_4 = esc_html( $instance['block_description_4'] );
    $block_read_more_4   = esc_html( $instance['block_read_more_4'] );
    $block_url_4         = esc_html( $instance['block_url_4'] );

?>

  <p>
    <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title', 'wen-corporate'); ?></label>
    <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
  </p>
  <h4 class="block-heading">Block 1</h4><!-- .block-heading -->
  <p>
    <label for="<?php echo $this->get_field_id('block_title_1'); ?>"><?php _e('Title', 'wen-corporate'); ?></label>
    <input class="" id="<?php echo $this->get_field_id('block_title_1'); ?>" name="<?php echo $this->get_field_name('block_title_1'); ?>" type="text" value="<?php echo esc_attr( $block_title_1 ); ?>" />
  </p>
  <p>
    <label for="<?php echo $this->get_field_id('block_icon_1'); ?>"><?php _e('Icon', 'wen-corporate'); ?></label>
    <input class="" id="<?php echo $this->get_field_id('block_icon_1'); ?>" name="<?php echo $this->get_field_name('block_icon_1'); ?>" type="text" value="<?php echo esc_attr( $block_icon_1 ); ?>" />&nbsp;<small><?php _e('eg: fa-cogs', 'wen-corporate'); ?></small>
  </p>
  <p>
    <label for="<?php echo $this->get_field_id('block_description_1'); ?>">
    <?php _e('Intro', 'wen-corporate'); ?>:</label>
    <textarea class="widefat" rows="2" id="<?php echo $this->get_field_id('block_description_1'); ?>" name="<?php echo $this->get_field_name('block_description_1'); ?>"><?php echo $block_description_1; ?></textarea>
  </p>
  <p>
    <label for="<?php echo $this->get_field_id('block_read_more_1'); ?>"><?php _e('Read more text', 'wen-corporate'); ?></label>
    <input class="" id="<?php echo $this->get_field_id('block_read_more_1'); ?>" name="<?php echo $this->get_field_name('block_read_more_1'); ?>" type="text" value="<?php echo esc_attr( $block_read_more_1 ); ?>" />
  </p>
  <p>
    <label for="<?php echo $this->get_field_id('block_url_1'); ?>"><?php _e('URL', 'wen-corporate'); ?></label>
    <input class="" id="<?php echo $this->get_field_id('block_url_1'); ?>" name="<?php echo $this->get_field_name('block_url_1'); ?>" type="text" value="<?php echo esc_attr( $block_url_1 ); ?>" />
  </p>
  <h4 class="block-heading">Block 2</h4><!-- .block-heading -->
  <p>
    <label for="<?php echo $this->get_field_id('block_title_2'); ?>"><?php _e('Title', 'wen-corporate'); ?></label>
    <input class="" id="<?php echo $this->get_field_id('block_title_2'); ?>" name="<?php echo $this->get_field_name('block_title_2'); ?>" type="text" value="<?php echo esc_attr( $block_title_2 ); ?>" />
  </p>
  <p>
    <label for="<?php echo $this->get_field_id('block_icon_2'); ?>"><?php _e('Icon', 'wen-corporate'); ?></label>
    <input class="" id="<?php echo $this->get_field_id('block_icon_2'); ?>" name="<?php echo $this->get_field_name('block_icon_2'); ?>" type="text" value="<?php echo esc_attr( $block_icon_2 ); ?>" />&nbsp;<small><?php _e('eg: fa-cogs', 'wen-corporate'); ?></small>
  </p>
  <p>
    <label for="<?php echo $this->get_field_id('block_description_2'); ?>">
    <?php _e('Intro', 'wen-corporate'); ?>:</label>
    <textarea class="widefat" rows="2" id="<?php echo $this->get_field_id('block_description_2'); ?>" name="<?php echo $this->get_field_name('block_description_2'); ?>"><?php echo $block_description_2; ?></textarea>
  </p>
  <p>
    <label for="<?php echo $this->get_field_id('block_read_more_2'); ?>"><?php _e('Read more text', 'wen-corporate'); ?></label>
    <input class="" id="<?php echo $this->get_field_id('block_read_more_2'); ?>" name="<?php echo $this->get_field_name('block_read_more_2'); ?>" type="text" value="<?php echo esc_attr( $block_read_more_2 ); ?>" />
  </p>
	<p>
		<label for="<?php echo $this->get_field_id('block_url_2'); ?>"><?php _e('URL', 'wen-corporate'); ?></label>
    <input class="" id="<?php echo $this->get_field_id('block_url_2'); ?>" name="<?php echo $this->get_field_name('block_url_2'); ?>" type="text" value="<?php echo esc_attr( $block_url_2 ); ?>" />
	</p>
  <h4 class="block-heading">Block 3</h4><!-- .block-heading -->
  <p>
    <label for="<?php echo $this->get_field_id('block_title_3'); ?>"><?php _e('Title', 'wen-corporate'); ?></label>
    <input class="" id="<?php echo $this->get_field_id('block_title_3'); ?>" name="<?php echo $this->get_field_name('block_title_3'); ?>" type="text" value="<?php echo esc_attr( $block_title_3 ); ?>" />
  </p>
  <p>
    <label for="<?php echo $this->get_field_id('block_icon_3'); ?>"><?php _e('Icon', 'wen-corporate'); ?></label>
    <input class="" id="<?php echo $this->get_field_id('block_icon_3'); ?>" name="<?php echo $this->get_field_name('block_icon_3'); ?>" type="text" value="<?php echo esc_attr( $block_icon_3 ); ?>" />&nbsp;<small><?php _e('eg: fa-cogs', 'wen-corporate'); ?></small>
  </p>
  <p>
    <label for="<?php echo $this->get_field_id('block_description_3'); ?>">
    <?php _e('Intro', 'wen-corporate'); ?>:</label>
    <textarea class="widefat" rows="2" id="<?php echo $this->get_field_id('block_description_3'); ?>" name="<?php echo $this->get_field_name('block_description_3'); ?>"><?php echo $block_description_3; ?></textarea>
  </p>
  <p>
    <label for="<?php echo $this->get_field_id('block_read_more_3'); ?>"><?php _e('Read more text', 'wen-corporate'); ?></label>
    <input class="" id="<?php echo $this->get_field_id('block_read_more_3'); ?>" name="<?php echo $this->get_field_name('block_read_more_3'); ?>" type="text" value="<?php echo esc_attr( $block_read_more_3 ); ?>" />
  </p>
  <p>
    <label for="<?php echo $this->get_field_id('block_url_3'); ?>"><?php _e('URL', 'wen-corporate'); ?></label>
    <input class="" id="<?php echo $this->get_field_id('block_url_3'); ?>" name="<?php echo $this->get_field_name('block_url_3'); ?>" type="text" value="<?php echo esc_attr( $block_url_3 ); ?>" />
  </p>
  <h4 class="block-heading">Block 4</h4><!-- .block-heading -->
  <p>
    <label for="<?php echo $this->get_field_id('block_title_4'); ?>"><?php _e('Title', 'wen-corporate'); ?></label>
    <input class="" id="<?php echo $this->get_field_id('block_title_4'); ?>" name="<?php echo $this->get_field_name('block_title_4'); ?>" type="text" value="<?php echo esc_attr( $block_title_4 ); ?>" />
  </p>
  <p>
    <label for="<?php echo $this->get_field_id('block_icon_4'); ?>"><?php _e('Icon', 'wen-corporate'); ?></label>
    <input class="" id="<?php echo $this->get_field_id('block_icon_4'); ?>" name="<?php echo $this->get_field_name('block_icon_4'); ?>" type="text" value="<?php echo esc_attr( $block_icon_4 ); ?>" />&nbsp;<small><?php _e('eg: fa-cogs', 'wen-corporate'); ?></small>
  </p>
  <p>
    <label for="<?php echo $this->get_field_id('block_description_4'); ?>">
    <?php _e('Intro', 'wen-corporate'); ?>:</label>
    <textarea class="widefat" rows="2" id="<?php echo $this->get_field_id('block_description_4'); ?>" name="<?php echo $this->get_field_name('block_description_4'); ?>"><?php echo $block_description_4; ?></textarea>
  </p>
  <p>
    <label for="<?php echo $this->get_field_id('block_read_more_4'); ?>"><?php _e('Read more text', 'wen-corporate'); ?></label>
    <input class="" id="<?php echo $this->get_field_id('block_read_more_4'); ?>" name="<?php echo $this->get_field_name('block_read_more_4'); ?>" type="text" value="<?php echo esc_attr( $block_read_more_4 ); ?>" />
  </p>
  <p>
    <label for="<?php echo $this->get_field_id('block_url_4'); ?>"><?php _e('URL', 'wen-corporate'); ?></label>
    <input class="" id="<?php echo $this->get_field_id('block_url_4'); ?>" name="<?php echo $this->get_field_name('block_url_4'); ?>" type="text" value="<?php echo esc_attr( $block_url_4 ); ?>" />
  </p>



<?php }

} ?>
