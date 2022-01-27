<h3><?php echo (!empty($content)) ? esc_html($content)
                                  : esc_html(WP_Slider_Plugin_Settings::$options['wp_slider_plugin_title']);
    ?>
</h3>
<div class="wp-slider-plugin flexslider">
    <ul class="slides">
        <li>
            <div class="mvs-container">
                <div class="slider-details-container">
                    <div class="wrapper">
                        <div class="slider-title">
                            <h2>Slider Title</h2>
                        </div>
                        <div class="slider-description">
                            <div class="subtitle">Subtitle</div>
                            <a class="link" href="#">Button text</a>
                        </div>
                    </div>
                </div>
            </div>
        </li>
    </ul>
</div>
