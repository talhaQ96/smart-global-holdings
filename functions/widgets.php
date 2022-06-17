<?php

  function ct_register_widget() {
    register_widget( 'ct_widget' );
  }
  add_action( 'widgets_init', 'ct_register_widget' );

  class ct_widget extends WP_Widget{
    // this function determine the custom widget’s ID, name, and description.
    function __construct(){
      parent::__construct(
        // widget ID
        'ct_custom_link_widget',

        // widget name
        __('Custom Link', 'ct_widget_domain'),

        // widget description
        array ('description' => __( 'Add Custom Links to your widget area', 'ct_widget_domain' ),)
      );
    }

    // this function defines the look of custom widget on the front-end.
    public function widget($args, $instance){
        $text = apply_filters('widget_text', $instance['text']);
        $url = apply_filters('widget_url', $instance['url']);
        $css = apply_filters('widget_css', $instance['css']);

        $instance['target'] ? 'true' : 'false';

        if('on' == $instance['target']){
            $target = '_blank';
        }

        else{
           $target = '_self'; 
        }

        echo $args['before_widget'];
        echo '<a href="'. $url .'" class="'. $css .'" target="'. $target .'">'. $text .'</a>';
        echo $args['after_widget'];
    }

    // this function defines the look of custom widget on the back-end.
    public function form( $instance ) {
        if (isset($instance['text']))
            $text = $instance['text'];

        if (isset($instance['url']))
            $url = $instance['url'];

        if (isset($instance['css']))
            $css = $instance['css'];

?>
      <p>
        <label for="<?php echo $this->get_field_id('text'); ?>"><?php _e('Link Text:'); ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id('text'); ?>" name="<?php echo $this->get_field_name('text'); ?>" type="text"  value="<?php echo esc_attr($text); ?>"/>
        <br/><br/>

        <label for="<?php echo $this->get_field_id('url'); ?>"><?php _e('URL:'); ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id('url'); ?>" name="<?php echo $this->get_field_name('url'); ?>" type="url"  value="<?php echo esc_attr($url); ?>"/>
        <br/><br/>

        <label for="<?php echo $this->get_field_id('css'); ?>"><?php _e('CSS Class(es):'); ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id('css'); ?>" name="<?php echo $this->get_field_name('css'); ?>" type="text"  value="<?php echo esc_attr($css); ?>"/>

        <br/><br/>
        <input class="checkbox" type="checkbox" <?php checked($instance['target'], 'on'); ?> id="<?php echo $this->get_field_id('target'); ?>" name="<?php echo $this->get_field_name('target'); ?>" /> 
        <label for="<?php echo $this->get_field_id('target'); ?>">Open link in new tab</label>
      </p>
<?php
    }

    //this function will refresh the widget every time you change the settings.
    public function update($new_instance, $old_instance){
      $instance = array();
      $instance['text'] = (!empty($new_instance['text'])) ? strip_tags($new_instance['text']): '';
      $instance['url']  = (!empty($new_instance['url'])) ? strip_tags($new_instance['url']): '';
      $instance['css']  = (!empty($new_instance['css'])) ? strip_tags($new_instance['css']): '';
      $instance['target'] = $new_instance['target'];

      return $instance;
    }
  }