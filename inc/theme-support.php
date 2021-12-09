<?php

add_action('after_setup_theme', 'demo_features');
function demo_features() {
    //Post-type features
    add_theme_support('post-thumbnails');

    //Image sizes
    add_image_size('card-image', 0, 500, true);
    add_image_size('single-image', 0, 450, true);
}