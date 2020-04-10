<?php
/**
 * @package WordPress
 * @subpackage Reales
 */

class Search_Realty_Widget extends WP_Widget {
      
    public function __construct() {
        $widget_ops = array('classname' => 'search_realty', 'description' => 'Tìm kiếm bất động sản.');
        $control_ops = array('id_base' => 'search_realty_widget');
        parent::__construct('search_realty_widget', __('Tìm kiếm BDS'), $widget_ops, $control_ops);
    }

    function form($instance) {
        $defaults = array(
            'title' => ''
        );
        $instance = wp_parse_args((array) $instance, $defaults);
        $display = '
            <p>
                <label for="' . esc_attr($this->get_field_id('title')) . '">' . __('Title', 'reales') . ':</label>
                <input type="text" class="widefat" id="' . esc_attr($this->get_field_id('title')) . '" name="' . esc_attr($this->get_field_name('title')) . '" value="' . esc_attr($instance['title']) . '" />
            </p>
        ';

        print $display;
    }


    function update($new_instance, $old_instance) {
        $instance = $old_instance;
        $instance['title'] = sanitize_text_field($new_instance['title']);
    

        if(function_exists('icl_register_string')) {
            icl_register_string('reales_social_widget', 'social_widget_title', sanitize_text_field($new_instance['title']));
        }

        return $instance;
    }

    function widget($args, $instance) {
        global $before_widget,$after_widget,$before_title,$after_title;
        extract($args);
        $title = apply_filters('widget_title', $instance['title']);

        print $before_widget;

        if($title) {
            print $before_title . esc_html($title) . $after_title;
        }

        echo do_shortcode('[search_bds]');
        print $after_widget;
    }

}

?>