<?php

add_action('pre_get_posts', 'demo_adjust_queries');
function demo_adjust_queries(WP_Query $query) {
    /*
        Modifying main query to display ceratain number of posts per page
        on arhive for custom post types.
   */
    if(
        !is_admin() &&
        $query->is_main_query() &&
        is_post_type_archive(get_query_var('post_type'))
    ) {

        $posts_number = wp_is_mobile() ? 3 : 1;
        $query->set('posts_per_page', $posts_number);

        if(get_query_var('genre')) {
            /*
                Modifying main query to display only custom post type posts from genre they clicked on.
                Results are shown on same page(archive) user was.
            */
            $taxonomyQuery = [
                [
                    'taxonomy' => 'genre',
                    'field' => 'slug',
                    'terms' => get_query_var('genre'),
                ],
            ];
            $query->set('tax_query', $taxonomyQuery);
        }
    }

    /*
        Modifying main query to display ceratain number of posts per page
        and also filter only posts from certain post_type on taxonomy archive pages.
   */
    if(
        !is_admin() &&
        $query->is_main_query() &&
        is_tax('genre') &&
        get_query_var('cpt')
    ) {
        $posts_number = wp_is_mobile() ? 3 : 1;

        $query->set('posts_per_page', $posts_number);
        $query->set('post_type', get_query_var('cpt'));
    }

    return $query;
}
