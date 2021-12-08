<?php
add_action('after_setup_theme', 'demo_adjust_queries');

function demo_adjust_queries($query)
{
    if (!is_admin() && is_post_type_archive('movie') && is_post_type_archive('book') && is_post_type_archive('game')) {
        $query->set('posts_per_page', wp_is_mobile() ? 3 : 9);
    }
}
