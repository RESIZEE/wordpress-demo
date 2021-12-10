<div class="comment-section col-md-12">
    <?php comments_template(); ?>
</div>

<?php

function custom_comments($comment, $args, $depth){
    $GLOBALS['comment'] = $comment;

    if(get_comment_type() == 'pingback' || get_comment_type() == 'trackback') : ?>
    display trackbacks

    <?php elseif(get_comment_type() == 'comment') : ?>

        <div class="col-12" id="comment-<?php comment_ID(); ?>">
            <div <?php comment_class(); ?>>
                <div class="d-flex col-lg-8">
                    <div class="avatar col-3 col-lg-2"><?php echo get_avatar($comment); ?></div>
                    <div class="comment-author col-9 col-lg-10">
                        <cite class="fn"><?php comment_author_link(); ?></cite>
                        <div class="comment-meta my-3"><?php comment_time('H:i:s'); ?> min ago</div>
                    </div>
                </div>
                <div class="d-flex col-lg-8">
                    <div class="col-lg-2"></div>
                    <div class="col-lg-10 comment-text-area">
                        <?php comment_text();?>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; 
} ?>