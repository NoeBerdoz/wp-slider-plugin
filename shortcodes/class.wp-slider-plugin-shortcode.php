<?php

if(!class_exists('WP_Slider_Plugin_Shortcode')){

    class WP_Slider_Plugin_Shortcode{
        function __construct(){
            add_shortcode('wp_slider_plugin', array($this, 'add_shortcode')); // add_shortcode won't conflict with add_shortcode wp function
        }

        public function add_shortcode( $atts = array(), $content = null, $tag = ''){
            $atts = array_change_key_case((array) $atts, CASE_LOWER);

            // extract takes each value of the array and turns it into a variable
            extract(shortcode_atts(
                array(
                    'id' => '',
                    'orderBy' => 'date'
                ),
                $atts,
                $tag
            ));

            /*
             * id exemple : [wp_slider_plugin id='43, 221']
             * this condition will take the id to absint('43') absint('221')
             */
            if(!empty($id)){
                $id = array_map('absint', explode(',',$id));
            }

            ob_start();
            // Can't us require_once if the user want to use the slider more than once in a post
            require(WP_SLIDER_PLUGIN_PATH . 'views/wp-slider-plugin_shortcode.php');

            // Add files dependencies when shortcode is called
            wp_enqueue_script('wp-slider-plugin-main-jq');
            wp_enqueue_script('wp-slider-plugin-options-js');
            wp_enqueue_style('wp-slider-plugin-main-css');
            wp_enqueue_style('wp-slider-plugin-style-css');
            return ob_get_clean();
        }
    }
}
