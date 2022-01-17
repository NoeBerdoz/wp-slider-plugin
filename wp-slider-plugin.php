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
        }

        public function define_constants(){
            define('WP_SLIDER_PLUGIN_PATH', plugin_dir_path(__FILE__));
            define('WP_SLIDER_PLUGIN_URL', plugin_dir_url(__FILE__));
            define('WP_SLIDER_PLUGIN_VERSION', '1.0.0');
        }
    }
}

if(class_exists('WP_SLIDER_PLUGIN')){
        $wp_slider_plugin = new WP_SLIDER_PLUGIN();
}

