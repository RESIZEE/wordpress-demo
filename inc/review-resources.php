<?php

add_action('pre_get_posts', 'demo_adjust_queries');
function create_or_update_review($reviewScore, $reviewedPostId) {
    if(!is_user_logged_in()) {
        return;
    }

    wp_insert_post([
        'ID' => current_user_has_reviewed(),
        'post_type' => 'review',
        'post_status' => 'publish',
        'meta_input' => [
            'reviewed_post_id' => sanitize_text_field($reviewedPostId),
            'review_score' => sanitize_text_field($reviewScore),
        ],
    ]);

    //create_or_update_review(10, get_the_ID());
}
