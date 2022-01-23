<?php
    $meta = get_post_meta($post->ID);
    $link_text = get_post_meta($post->ID, 'wp_slider_plugin_link_text', true);
    $link_url = get_post_meta($post->ID, 'wp_slider_plugin_link_url', true);
?>
<table class="form-table wp-slider-plugin-metabox">
    <input type="hidden" name="wp_slider_plugin_nonce" value="<?php echo wp_create_nonce("wp_slider_plugin_nonce"); ?>">
    <tr>
        <th>
            <label for="wp_slider_plugin_link_text">Link Text</label>
        </th>
        <td>
            <input
                type="text"
                name="wp_slider_plugin_link_text"
                id="wp_slider_plugin_link_text"
                class="regular-text link-text"
                value="<?php echo (isset($link_text)) ? esc_html($link_text) : ''; ?>"
            >
        </td>
    </tr>
    <tr>
        <th>
            <label for="wp_slider_plugin_link_url">Link URL</label>
        </th>
        <td>
            <input
                type="url"
                name="wp_slider_plugin_link_url"
                id="wp_slider_plugin_link_url"
                class="regular-text link-url"
                value="<?php echo (isset($link_url)) ? esc_url($link_url) : ''; ?>"
            >
        </td>
    </tr>
</table>
