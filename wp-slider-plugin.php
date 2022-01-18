<?php

/**
 * Plugin Name: WP Slider Plugin
 * Plugin URI: none
 * Description: A slider for WordPress
 * Version: 1.0
 * Requires at least: 5.6
 * Author: NoeBerdoz
 * Author URI: https://github.com/NoeBerdoz
 * License: GPL v2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: wp-slider-plugin
 * Domain Path: /languages
 */

/*
WP Slider Plugin is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 2 of the License, or
any later version.

WP Slider Plugin is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with {Plugin Name}. If not, see https://www.gnu.org/licenses/gpl-2.0.html.
*/

if(!defined('ABSPATH')){
    die('Nothing interesting here, be laylow');
    exit;
}

if(!class_exists('WP_SLIDER_PLUGIN')){
    class WP_SLIDER_PLUGIN{
        function __construct(){
            $this->define_constants();

            require_once(WP_SLIDER_PLUGIN_PATH . 'post-types/class.wp-slider-plugin-cpt.php');
            $WP_SLIDER_PLUGIN_POST_TYPE = new WP_SLIDER_PLUGIN_POST_TYPE();
        }

        public function define_constants(){
            define('WP_SLIDER_PLUGIN_PATH', plugin_dir_path(__FILE__));
            define('WP_SLIDER_PLUGIN_URL', plugin_dir_url(__FILE__));
            define('WP_SLIDER_PLUGIN_VERSION', '1.0.0');
        }

        public static function activate(){
            update_option('rewrite_rules', ''); // Delete content in rewrite_rules from wp_options table
        }

        public static function deactivate(){
            flush_rewrite_rules();
            unregister_post_type('wp-slider-plugin');

        }

        public static function uninstall(){

        }
    }
}

if(class_exists('WP_SLIDER_PLUGIN')){

    register_activation_hook(__FILE__, array('WP_SLIDER_PLUGIN', 'activate'));
    register_deactivation_hook(__FILE__, array('WP_SLIDER_PLUGIN', 'deactivate'));
    register_uninstall_hook(__FILE__, array('WP_SLIDER_PLUGIN', 'uninstall'));

    $wp_slider_plugin = new WP_SLIDER_PLUGIN();
}

