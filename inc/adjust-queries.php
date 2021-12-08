<?php

add_action('pre_get_posts', 'demo_adjust_queries');
function demo_adjust_queries(WP_Query $query) {
    /*
        Modifying main query to display ceratain number of posts per page
        on arhive for custom post types.
   */
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

    /*
         Modifying main query to display only custom post type posts from genre they clicked on.
         Results are shown on same page(archive) user was.
    */
    if(
        !is_admin() &&
        is_main_query() &&
        (is_post_type_archive('movie') ||
            is_post_type_archive('book') ||
            is_post_type_archive('game')
        ) &&
        !!get_query_var('genre')
    ) {
        $posts_number = wp_is_mobile() ? 3 : 9;
        $taxonomyQuery = [
            [
                'taxonomy' => 'genre',
                'field' => 'slug',
                'terms' => get_query_var('genre'),
            ],
        ];

        $query->set('posts_per_page', $posts_number);
        $query->set('tax_query', $taxonomyQuery);
    }

    //if (!is_admin() &&
    //     tis_main_query() &&
    //    is_tax()
    //) {
    //    $obj = get_queried_object();
    //    $archive_url = get_post_type_archive_link('custom_post_type_name');
    //
    //    // If the WP_Taxonomy has multiple object_types mapped, and 'custom_post_type' is one of them:
    //    if (true === is_array($obj->object_type) && true === in_array($obj->object_type, ['custom_post_type_name'])) {
    //        wp_redirect($archive_url);
    //        exit;
    //    }
    //
    //    // If the WP_Taxonomy has one object_type mapped, and it's 'custom_post_type'
    //    if (true === is_string($obj->object_type) && 'custom_post_type_name' === $obj->object_type) {
    //        wp_redirect($archive_url);
    //        exit;
    //    }
    //}
}
