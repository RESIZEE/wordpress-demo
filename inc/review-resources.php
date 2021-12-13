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

/* START OF SEARCH */
/* Added a new property authorName to api for blog posts */
add_action('rest_api_init', 'demo_custom_rest');
function demo_custom_rest(){
    register_rest_field('post', 'authorName', array(
        'get_callback' => function(){return get_the_author();}
    ));
}

/* Custom route for custom_post_type */
add_action('rest_api_init', 'demoRegisterSearch');
function demoRegisterSearch(){
    register_rest_route(
        'demo/v1',
        'search',
        [
            'methods' => WP_REST_SERVER::READABLE,
            'callback' => 'demoSearchResults'
        ]
    );
}

function demoSearchResults($data){
    $post_type_query = new WP_Query([
        'post_type' => $allowedReviewPostTypes,
        's' => sanitize_text_field($data['term']) 
    ]);

    $results = [
        'generalInfo' => [],
        'movies' => [],
        'books' => [],
        'games' => []
    ];

    while($post_type_query->have_posts()){
        $post_type_query->the_post();

        if(get_post_type() == 'post' || get_post_type() == 'page'){
            array_push($results['generalInfo'], [
                'postType' => get_post_type(),
                'title' => get_the_title(),
                'permalink' => get_the_permalink(),
                'authorName' => get_the_author()
            ]);
        }

        if(get_post_type() == 'movie'){
            array_push($results['movies'], [
                'postType' => get_post_type(),
                'title' => get_the_title(),
                'permalink' => get_the_permalink(),
                'authorName' => get_the_author(),
                'image' => get_the_post_thumbnail_url(0, 'card-image-container')
            ]);
        }

        if(get_post_type() == 'book'){
            array_push($results['books'], [
                'postType' => get_post_type(),
                'title' => get_the_title(),
                'permalink' => get_the_permalink(),
                'authorName' => get_the_author(),
                'image' => get_the_post_thumbnail_url(0, 'card-image-container')
            ]);
        }

        if(get_post_type() == 'game'){
            array_push($results['games'], [
                'postType' => get_post_type(),
                'title' => get_the_title(),
                'permalink' => get_the_permalink(),
                'authorName' => get_the_author()
            ]);
        }
    }

    return $results;
}
/* END OF SEARCH */