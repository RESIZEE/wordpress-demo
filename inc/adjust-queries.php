<?php
add_action('pre_get_posts', 'demo_adjust_queries');

function demo_adjust_queries($query) {

    if(
        !is_admin() &&
        is_main_query() &&
        (is_post_type_archive('movie') ||
            is_post_type_archive('book') ||
            is_post_type_archive('game')
        )
    ) {
        $posts_number = wp_is_mobile() ? 3 : 9;
        $query->set('posts_per_page', $posts_number);
    }
}
