<?php

if(post_password_required()) {
    return;
}

?>

<div id="comments">
    <?php if(have_comments()) {
        the_comment();
        ?>

        <?php
        // Checks if there are comments and also if they are closed
        // and prints notification about it
        if(!comments_open() && get_comments_number()) {
            ?>
            <p class="no-comments">
                <?php echo __('Comments are disabled.', 'demo') ?>
            </p>
        <?php }else { ?>
            <?php
            $commentField = sprintf(
                    '<p class="comment-form-comment mt-4">%s</p>',
                    sprintf(
                            '<textarea id="comment" class="form-control" name="comment" placeholder="%s" cols="45" rows="8" maxlength="65525" required="required"></textarea>',
                            _x('Comment', 'noun') . '...'
                    )
            );

            $fields = [
                    'author' => sprintf(
                            '<p class="comment-form-author">%s</p>',
                            sprintf(
                                    '<input id="author" class="form-control" name="author" type="text" value="%s" placeholder="%s" maxlength="245" />',
                                    esc_attr($commenter['comment_author']),
                                    __('Name', 'demo'),
                            )
                    ),
                    'email' => sprintf(
                            '<p class="comment-form-email">%s</p>',
                            sprintf(
                                    '<input id="email" class="form-control" name="email" %s value="%s" placeholder="%s" size="30" maxlength="100" aria-describedby="email-notes" />',
                                    ($html5 ? 'type="email"' : 'type="text"'),
                                    esc_attr($commenter['comment_author_email']),
                                    __('Email'),
                            )
                    ),
                    'cookies' => '',
            ];
            comment_form([
                    '' => '',
                    'comment_notes_before' => '',
                    'logged_in_as' => '',
                    'class_submit' => 'btn btn-warning w-100',
                    'label_submit' => __('Post Comment', 'demo'),
                    'comment_field' => $commentField,
                    'fields' => apply_filters('comment_form_default_fields', $fields),
            ])
            ?>

            <h2 class="comments-title"><?php echo __('Comments', 'demo') . '(' . get_comments_number() . ')' ?></h2>
            <div class="comment-list">
                <?php
                wp_list_comments([
                        'max_depth' => '',
                        'style' => 'div',
                        'callback' => null,
                        'end_callback' => null,
                        'type' => 'all',
                        'reply_text' => __('Reply', 'demo'),
                        'page' => '',
                        'per_page' => '',
                        'avatar_size' => 64,
                        'reverse_top_leve' => null,
                        'reverse_children' => null,
                ])
                ?>
            </div>
        <?php } ?>

    <?php } ?>

</div>
