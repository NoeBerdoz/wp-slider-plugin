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

            add_settings_section(
                'wp_slider_second_section',
                'Other plugin options',
                null,
                'wp_slider_plugin_page2'
            );

            add_settings_field(
                'wp_slider_plugin_shortcode',
                'Shortcode',
                array($this, 'wp_slider_plugin_shortcode_callback'),
                'wp_slider_plugin_page1',
                'wp_slider_main_section'
            );

            add_settings_field(
                'wp_slider_plugin_title',
                'Slider Title',
                array($this, 'wp_slider_plugin_title_callback'),
                'wp_slider_plugin_page2',
                'wp_slider_second_section'
            );

            add_settings_field(
                'wp_slider_plugin_bullets',
                'Display bullets',
                array($this, 'wp_slider_plugin_bullets_callback'),
                'wp_slider_plugin_page2',
                'wp_slider_second_section'
            );

            add_settings_field(
                'wp_slider_plugin_style',
                'Slider Style',
                array($this, 'wp_slider_plugin_style_callback'),
                'wp_slider_plugin_page2',
                'wp_slider_second_section'
            );
        }

        public function wp_slider_plugin_shortcode_callback(){
            ?>
            <span>Use the shortcode [wp-slider-plugin] to display the slider in any page/post/widget</span>
            <?php
        }

        public function wp_slider_plugin_title_callback(){
            ?>
                <input
                    type="text"
                    name="wp_slider_plugin_options[wp_slider_plugin_title]"
                    id="wp_slider_plugin_title"
                    value="<?php echo isset(self::$options['wp_slider_plugin_title']) ? esc_attr(self::$options['wp_slider_plugin_title']) : ''; ?>"
                >
            <?php
        }

        public function wp_slider_plugin_bullets_callback(){
            ?>
                <input
                    type="checkbox"
                    name="wp_slider_plugin_options[wp_slider_plugin_bullets]"
                    id="wp_slider_plugin_bullets"
                    value="1"
                    <?php
                    if(isset(self::$options['wp_slider_plugin_bullets'])) {
                        checked("1", self::$options['wp_slider_plugin_bullets'], true);
                    }
                    ?>
                />
                <label for="wp_slider_plugin_bullets">Whether to display bullets or not</label>
            <?php
        }

        public function wp_slider_plugin_style_callback(){
            ?>
                <select
                    id="wp_slider_plugin_style"
                    name="wp_slider_plugin_options[wp_slider_plugin_style]">
                    <option value="style-1"
                            <?php
                                isset(self::$options['wp_slider_plugin_style'])
                                    ? selected('style-1', self::$options['wp_slider_plugin_style'], true)
                                    : ''; ?>>Style 1
                    </option>
                    <option value="style-2"
                        <?php
                            isset(self::$options['wp_slider_plugin_style'])
                                ? selected('style-2', self::$options['wp_slider_plugin_style'], true)
                                : ''; ?>> Style 2
                    </option>
                </select>
            <?php
        }

    }
}

