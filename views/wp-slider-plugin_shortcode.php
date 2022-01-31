<h3><?php echo (!empty($content)) ? esc_html($content)
                                  : esc_html(WP_Slider_Plugin_Settings::$options['wp_slider_plugin_title']);
    ?>
</h3>
<div class="wp-slider-plugin flexslider">
    <ul class="slides">
    <?php
        $args = array(
                'post_type' => 'wp-slider-plugin',
                'post_status' => 'publish',
                'post_in' => $id,
                'orderby' => $orderby
        );

        $my_query = new WP_Query($args);

        if($my_query->have_posts()):
            while($my_query->have_posts()): $my_query->the_post();

            $button_text = get_post_meta(get_the_ID(), 'wp_slider_plugin_link_text', true);
            $button_link = get_post_meta(get_the_ID(), 'wp_slider_plugin_link_url', true);
    ?>
        <li>
        <?php
            // Add image as flexlider says
            the_post_thumbnail('full', array('class' => 'img-fluid'));
        ?>
            <div class="wps-container">
                <div class="slider-details-container">
                    <div class="wrapper">
                        <div class="slider-title">
                            <h2><?php the_title() ?></h2>
                        </div>
                        <div class="slider-description">
                            <div class="subtitle"><?php the_content(); ?></div>
                            <a class="link" href="<?php echo esc_url($button_link); ?>"><?php echo esc_html($button_text); ?></a>
                        </div>
                    </div>
                </div>
            </div>
        </li>
    <?php
        endwhile;
        // Prevent interferences with other wp queries
            wp_reset_postdata();
        endif;
    ?>
    </ul>
</div>
