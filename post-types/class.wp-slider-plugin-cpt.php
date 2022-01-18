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
                    'public' => true,
                    'supports' => array('title', 'editor', 'thumbnail'),
                    'hierarchical' => false,
                    'show_ui' => true,
                    'show_in_menu' => true,
                    'menu_position' => 5,
                    'show_in_admin_bar' => true,
                    'show_in_nav_menus' => true,
                    'can_export' => true,
                    'has_archive' => true,
                    'exclude_from_search' => false,
                    'publicly_queryable' => true,
                    'show_in_rest' => true,
                    'menu_icon' => 'dashicons-images-alt2',
                )
            );
        }

    }
}

