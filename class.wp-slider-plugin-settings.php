<?php

if(!class_exists('WP_Slider_Plugin_Settings')) {
    class WP_Slider_Plugin_Settings{

        public static $options;

        public function __construct() {
            self::$options = get_option('wp_slider_plugin_options'); // Will access this option_name on table wp_options
            add_action('admin_init', array($this, 'admin_init'));
        }

        public function admin_init(){
            register_setting('wp_slider_plugin_group', 'wp_slider_plugin_options');
            add_settings_section(
                'wp_slider_main_section',
                'How does it work?',
                null,
                'wp_slider_plugin_page1'
            );

            add_settings_field(
                'wp_slider_plugin_shortcode',
                'Shortcode',
                array($this, 'wp_slider_plugin_shortcode_callback'),
                'wp_slider_plugin_page1',
                'wp_slider_main_section'
            );
        }

        public function wp_slider_plugin_shortcode_callback(){
            ?>
            <span>Use the shortcode [wp-slider-plugin] to display the slider in any page/post/widget</span>
            <?php
        }
    }
}

