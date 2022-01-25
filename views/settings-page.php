<div class="wrap">
	<h1><?php echo esc_html(get_admin_page_title()); ?></h1>
	<form action="options.php" method="post">
        <?php
        settings_fields('wp_slider_plugin_group');
        do_settings_sections('wp_slider_plugin_page1');
        submit_button('Save Settings');
        ?>
    </form>
</div>
