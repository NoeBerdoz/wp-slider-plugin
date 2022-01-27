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
        }

    }
}
