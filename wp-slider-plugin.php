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

            add_action('admin_menu', array($this, 'add_menu'));

            require_once(WP_SLIDER_PLUGIN_PATH . 'post-types/class.wp-slider-plugin-cpt.php');
            $WP_Slider_Plugin_Post_Type = new WP_Slider_Plugin_Post_Type();

            require_once(WP_SLIDER_PLUGIN_PATH . 'class.wp-slider-plugin-settings.php');
            $WP_Slider_Plugin_Settings = new WP_Slider_Plugin_Settings();
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

        public function add_menu(){
        	add_menu_page(
        		'WP Slider Options',
		        'WP Slider PLugin',
		        'manage_options',
		        'wp_slider_plugin_admin',
		        array($this, 'wp_slider_plugin_settings_page'),
		        'dashicons-images-alt2'
	        );

        	add_submenu_page(
		        'wp_slider_plugin_admin',
		        'Manage Slides',
		        'Manage Slides',
		        'manage_options',
		        'edit.php?post_type=wp-slider-plugin', // Link submenu to sliders page
	            null
	        );

	        add_submenu_page(
		        'wp_slider_plugin_admin',
		        'Add New Slide',
		        'Add New Slide',
		        'manage_options',
		        'post-new.php?post_type=wp-slider-plugin', // Link submenu to add new sliders page
		        null
	        );
        }

        public function wp_slider_plugin_settings_page(){
            // Prevent malicious access on plugin settings page
            if(!current_user_can('manage_options')){
                return;
            }
            if(isset($_GET['settings-updated'])){
                add_settings_error('wp_slider_plugin_options', 'wp_slider_plugin_message', 'Settings Saved', 'success');
            }
            settings_errors('wp_slider_plugin_options');

        	require(WP_SLIDER_PLUGIN_PATH . 'views/settings-page.php');
        }
    }
}

if(class_exists('WP_SLIDER_PLUGIN')){

    register_activation_hook(__FILE__, array('WP_SLIDER_PLUGIN', 'activate'));
    register_deactivation_hook(__FILE__, array('WP_SLIDER_PLUGIN', 'deactivate'));
    register_uninstall_hook(__FILE__, array('WP_SLIDER_PLUGIN', 'uninstall'));

    $wp_slider_plugin = new WP_SLIDER_PLUGIN();
}

