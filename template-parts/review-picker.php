<?php
if ( is_user_logged_in() ) {
    $postId = get_the_ID();

    get_template_part(
            'template-parts/alerts/success',
            null,
            [ 'class' => 'w-50 d-none', ]
    );

    get_template_part(
            'template-parts/alerts/error',
            null,
            [ 'class' => 'w-50 d-none', ]
    );
    ?>

    <div
            class="reviews"
            data-post-id="<?php echo $postId; ?>"
    >
        <?php
        for ( $i = 1; $i <= 5; $i ++ ) {
            $currentStarIsChecked = current_user_review_score( $postId ) >= $i;
            ?>
            <i
                    class="<?php echo $currentStarIsChecked ? 'fas' : 'far' ?> fa-star text-3xl text-yellow"
                    <?php
                    echo $currentStarIsChecked ?
                            'data-star-checked="true"' : ''
                    ?>
            >
            </i>
        <?php } ?>
    </div>
<?php } ?>