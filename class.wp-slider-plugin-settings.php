<?php

if(!class_exists('WP_Slider_Plugin_Settings')) {
    class WP_Slider_Plugin_Settings{

        public static $options;

        public function __construct() {
            self::$options = get_option('wp_slider_plugin_options'); // Will access this option_name on table wp_options
            add_action('admin_init', array($this, 'admin_init'));
        }

        public function admin_init(){
            register_setting('wp_slider_plugin_group', 'wp_slider_plugin_options', array($this, 'wp_slider_plugin_validate'));

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
                'wp_slider_second_section',
                array(
                        'label_for' => 'wp_slider_plugin_title'
                )
            );

            add_settings_field(
                'wp_slider_plugin_bullets',
                'Display bullets',
                array($this, 'wp_slider_plugin_bullets_callback'),
                'wp_slider_plugin_page2',
                'wp_slider_second_section',
                array(
                        'label_for' => 'wp_slider_plugin_bullets'
                )
            );

            add_settings_field(
                'wp_slider_plugin_style',
                'Slider Style',
                array($this, 'wp_slider_plugin_style_callback'),
                'wp_slider_plugin_page2',
                'wp_slider_second_section',
                array(
                        'items' => array(
                                'style-1',
                                'style-2'
                        ),
                        'label_for' => 'wp_slider_plugin_style'
                )
            );
        }

        public function wp_slider_plugin_shortcode_callback(){
            ?>
            <span>Use the shortcode [wp-slider-plugin] to display the slider in any page/post/widget</span>
            <?php
        }

        // $args is referenced with the array with the label_for attribute
        public function wp_slider_plugin_title_callback($args){
            ?>
                <input
                    type="text"
                    name="wp_slider_plugin_options[wp_slider_plugin_title]"
                    id="wp_slider_plugin_title"
                    value="<?php echo isset(self::$options['wp_slider_plugin_title']) ? esc_attr(self::$options['wp_slider_plugin_title']) : ''; ?>"
                >
            <?php
        }

        // $args is referenced with the array with the label_for attribute
        public function wp_slider_plugin_bullets_callback($args){
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

        public function wp_slider_plugin_style_callback($args){
            ?>
                <select
                    id="wp_slider_plugin_style"
                    name="wp_slider_plugin_options[wp_slider_plugin_style]">
                    <?php
                        foreach ($args['items'] as $item):
                    ?>
                            <option value="<?php echo esc_attr($item); ?>"
                                <?php
                                isset(self::$options['wp_slider_plugin_style'])
                                    ? selected($item, self::$options['wp_slider_plugin_style'], true)
                                    : ''; ?>
                            >
                                <?php echo esc_html(ucfirst($item)) ?>
                            </option>
                    <?php endforeach; ?>
                </select>
            <?php
        }

        // Sanitize submitted data
        public function wp_slider_plugin_validate($input){
            $new_input = array();
            foreach ($input as $key => $value) {
                switch ($key){
                    case 'wp_slider_plugin_title':
                        if(empty($value)){
                            add_settings_error('wp_slider_plugin_options', 'wp_slider_plugin_message', 'The title cannot be empty', 'error');
                            $value = 'Please, type some text';
                        }
                        $new_input[$key] = sanitize_text_field($value);
                    break;
                    case 'wp_slider_plugin_url':
                        $new_input[$key] = esc_url_raw($value);
                    break;
                    case 'wp_slider_plugin_int':
                        $new_input[$key] = absint($value);
                    break;
                    default:
                        $new_input[$key] = sanitize_text_field($value);
                    break;
                }
                $new_input[$key] = sanitize_text_field($value);
            }
            return $new_input;
        }

    }
}

