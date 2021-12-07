<?php

add_action('after_setup_theme', 'demo_menus');
function demo_menus() {
    register_nav_menu('headerMenuLocation', 'Header Menu Location');
    register_nav_menu('footerFirstSectionMenuLocation', 'Footer First Section Menu');
    register_nav_menu('footerSecondSectionMenuLocation', 'Footer Second Section Menu');
}
