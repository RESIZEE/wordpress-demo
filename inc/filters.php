<?php

add_filter('query_vars', 'demo_query_vars');
function demo_query_vars($queryVars) {
    $queryVars[] = 'genre';
    $queryVars[] = 'cpt';

    return $queryVars;
}

add_filter('excerpt_more', 'wpdocs_excerpt_more');
function wpdocs_excerpt_more($more) {
    return '</br><a style="color: #fac900" href="' . get_the_permalink() . '" rel="nofollow"> Read More...</a>';
}

add_filter('nav_menu_css_class', 'add_class_to_nav_menu', 10, 4);
function add_class_to_nav_menu($classes, $item, $args) {
    if(
        is_single() &&
        get_post_type() == $item->object
    ) {
        $classes[] = 'current-menu-item';

        return $classes;
    }
    
    if(
        is_single() &&
        get_post_type() == 'post' &&
        get_post_meta($item->ID, '_menu_item_object_id', true) == get_option('page_for_posts')
    ) {
        $classes[] = 'current-menu-item';

        return $classes;
    }

    return $classes;
}