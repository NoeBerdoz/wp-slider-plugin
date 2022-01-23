<?php
// CPT -> CUSTOM POST TYPE

if(!class_exists('WP_SLIDER_PLUGIN_POST_TYPE')){
    class WP_SLIDER_PLUGIN_POST_TYPE {

        function __construct() {
            add_action('init', array($this, 'create_post_type'));
            add_action('add_meta_boxes', array($this, 'add_meta_boxes'));
            add_action('save_post', array($this, 'save_post'), 10, 2);
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
                    'register_meta_box_cb' => array($this, 'add_meta_boxes')
                )
            );
        }

        public function add_meta_boxes(){
            add_meta_box(
                'wp_slider_plugin_meta_box',
            'Link Options',
                array($this, 'add_inner_meta_boxes'),
                'wp-slider-plugin',
                'normal',
                'high'
            );
        }

        public function add_inner_meta_boxes($post){
            require_once(WP_SLIDER_PLUGIN_PATH . 'views/wp-slider-plugin_metabox.php');
        }

        public function save_post($post_id){
            if(isset($_POST['action']) && $_POST['action'] == 'editpost'){
                $old_link_text = get_post_meta($post_id, 'wp_slider_plugin_link_text', true);
                $new_link_text = $_POST['wp_slider_plugin_link_text'];
                $old_link_url = get_post_meta($post_id, 'wp_slider_plugin_link_url', true);
                $new_link_url = $_POST['wp_slider_plugin_link_url'];

                if(empty($new_link_text)){
                	update_post_meta($post_id, 'wp_slider_plugin_link_text', 'Add some text here');
                }
                if(empty($new_link_url)){
                	update_post_meta($post_id, 'wp_slider_plugin_link_url', '#');
                }

                update_post_meta($post_id, 'wp_slider_plugin_link_text', sanitize_text_field($new_link_text), $old_link_text);
                update_post_meta($post_id, 'wp_slider_plugin_link_url', sanitize_text_field($new_link_url), $old_link_url);
            }
        }


    }
}

