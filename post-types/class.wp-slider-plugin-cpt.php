<?php
// CPT -> CUSTOM POST TYPE

if(!class_exists( 'WP_Slider_Plugin_Post_Type' )){
    class WP_Slider_Plugin_Post_Type {

        function __construct() {
            add_action('init', array($this, 'create_post_type'));
            add_action('add_meta_boxes', array($this, 'add_meta_boxes'));
            add_action('save_post', array($this, 'save_post'), 10, 2);
            add_filter('manage_wp-slider-plugin_posts_columns', array($this, 'wp_slider_plugin_cpt_columns')); // filter name based on custom post type key
	        add_action('manage_wp-slider-plugin_posts_custom_column', array($this, 'wp_slider_custom_columns'), 10, 2); // function priority 10, 2 arguments
	        add_filter('manage_edit-wp-slider-plugin_sortable_columns', array($this, 'wp_slider_plugin_sortable_columns'));
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
                    'show_in_menu' => false,
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

        // Adds Columns Link Text and URL in Sliders list
        public function wp_slider_plugin_cpt_columns($columns){
        	$columns['wp_slider_plugin_link_text'] = esc_html__('Link Text', 'wp-slider-plugin');
        	$columns['wp_slider_plugin_link_url'] = esc_html__('Link URL', 'wp-slider-plugin');
        	return $columns;
        }

        // Display metabox Link Text and URL content in Sliders List
        public function wp_slider_custom_columns($column, $post_id){
        	switch ($column){
		        case 'wp_slider_plugin_link_text':
		        	echo esc_html(get_post_meta($post_id, 'wp_slider_plugin_link_text', true));
		        break;
		        case 'wp_slider_plugin_link_url':
			        echo esc_url(get_post_meta($post_id, 'wp_slider_plugin_link_url', true));
			    break;
	        }
        }

        // Add asc/desc filter on column Link Text
        public function wp_slider_plugin_sortable_columns($columns) {
        	$columns['wp_slider_plugin_link_text'] = 'wp_slider_link_text';
        	return $columns;
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

        	if(isset($_POST['wp_slider_plugin_nonce'])){
        		if(!wp_verify_nonce($_POST['wp_slider_plugin_nonce'], 'wp_slider_plugin_nonce')){
					return;
		        }
	        }

        	if(defined('DOING AUTOSAVE') && DOING_AUTOSAVE){
        		return;
	        }

        	if(isset($_POST['post_type']) && $_POST['post_type'] === 'wp_slider_plugin'){
        		if(!current_user_can('edit_page', $post_id) || !current_user_can('edit_post', $post_id)){
        			return;
		        }

	        }

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

