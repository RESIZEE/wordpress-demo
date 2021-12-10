<?php
if(is_user_logged_in()) {
    $postId = get_the_ID();
    ?>
    <div
            class="reviews"
            data-post-id="<?php echo $postId; ?>"
    >
        <?php
        for($i = 1; $i <= 5; $i++){
            $currentStarIsChecked = current_user_review_score($postId) >= $i;
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