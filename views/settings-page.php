<div class="wrap">
	<h1><?php echo esc_html(get_admin_page_title()); ?></h1>
    <?php
        $active_tab = isset($_GET['tab']) ? $_GET['tab'] : 'main_options';
    ?>
    <h2 class="nav-tab-wrapper">
        <a href="?page=wp_slider_plugin_admin&tab=main_options"
           class="nav-tab <?php echo $active_tab == 'main_options' ? 'nav-tab-active' : ''?>">Main Options</a>
        <a href="?page=wp_slider_plugin_admin&tab=additional_options"
           class="nav-tab <?php echo $active_tab == 'additional _options' ? 'nav-tab-active' : ''?>">Additional Options</a>
    </h2>
	<form action="options.php" method="post">
        <?php
            if($active_tab == 'main_options'){
                settings_fields('wp_slider_plugin_group');
                do_settings_sections('wp_slider_plugin_page1');
            }
            if($active_tab == 'additional_options'){
                settings_fields('wp_slider_plugin_group');
                do_settings_sections('wp_slider_plugin_page2');
                submit_button('Save Settings');
            }
        ?>
    </form>
</div>
