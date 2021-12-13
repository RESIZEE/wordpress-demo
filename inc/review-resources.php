<?php
add_action('rest_api_init', 'demo_review_routes');
function demo_review_routes() {
    register_rest_route(
        'demo/v1',
        'review',
        [
            'methods' => 'POST',
            'callback' => 'create_or_update_review',
        ]
    );
}

$allowedReviewPostTypes = ['movie', 'book', 'game',];

function create_or_update_review($data) {
    $postId = sanitize_text_field($data['reviewed_post_id']);
    $reviewScore = (int)sanitize_text_field($data['review_score']);

    if(
        !is_user_logged_in() ||
        !in_array(get_post_type($postId), $allowedReviewPostTypes) ||
        !in_array($reviewScore, range(1, 5))
    ) {
        die('You did something wrong.');
    }

    wp_insert_post([
        'ID' => current_user_has_reviewed($postId),
        'post_type' => 'review',
        'post_status' => 'publish',
        'meta_input' => [
            'reviewed_post_id' => $postId,
            'review_score' => $reviewScore,
        ],
    ]);

    return [
        'review_score' => review_score($postId),
    ];
}