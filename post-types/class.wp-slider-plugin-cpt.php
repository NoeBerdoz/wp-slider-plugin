<?php
// CPT -> CUSTOM POST TYPE

if(!class_exists('WP_SLIDER_PLUGIN_POST_TYPE')){
    class WP_SLIDER_PLUGIN_POST_TYPE {

        function __construct() {
            add_action('init', array($this, 'create_post_type'));
        }

        public function create_post_type(){
            register_post_type(
                'wp-slider-plugin',
                array(
                    'label' => 'Slider',
                    'description' => 'A simple slider',
                    'labels' => array(
                        'name' => 'Sliders',
                        'singular_name' => 'Slider'
                    ),
                    'public' => true
                )
            );
        }

    }
}

