<?php

if ( post_password_required() ) {
    return;
}

?>

<div id="comments">

    <?php
    $commentField = sprintf(
            '<p class="comment-form-comment mt-4 col-lg-5">%s</p>',
            sprintf(
                    '<textarea id="comment" class="form-control" name="comment" placeholder="%s" rows="5" maxlength="65525" required="required"></textarea>',
                    _x( 'Comment', 'noun' ) . '...'
            )
    );

    $fields = [
            'author'  => sprintf(
                    '<p class="comment-form-author col-lg-5">%s</p>',
                    sprintf(
                            '<input id="author" class="form-control" name="author" type="text" value="%s" placeholder="%s" maxlength="245" />',
                            esc_attr( $commenter['comment_author'] ),
                            __( 'Name', 'demo' ),
                    )
            ),
            'email'   => sprintf(
                    '<p class="comment-form-email col-lg-5">%s</p>',
                    sprintf(
                            '<input id="email" class="form-control" name="email" type="email" value="%s" placeholder="%s" size="30" maxlength="100" aria-describedby="email-notes" />',
                            esc_attr( $commenter['comment_author_email'] ),
                            __( 'Email' ),
                    )
            ),
            'cookies' => '',
    ];
    comment_form( [
            ''                     => '',
            'comment_notes_before' => '',
            'logged_in_as'         => '',
            'class_submit'         => 'col-lg-5 col-12 btn btn-warning fw-bold',
            'label_submit'         => __( 'Post Comment', 'demo' ),
            'comment_field'        => $commentField,
            'fields'               => apply_filters( 'comment_form_default_fields', $fields ),
    ] )
    ?>
    <?php if ( have_comments() ) {
        the_comment();
        ?>

        <?php
        // Checks if there are comments and also if they are closed
        // and prints notification about it
        if ( ! comments_open() && get_comments_number() ) {
            ?>
            <p class="no-comments">
                <?php echo __( 'Comments are disabled.', 'demo' ) ?>
            </p>
        <?php } else { ?>

            <h3 class="comments-title"><?php echo __( 'Comments', 'demo' ) . '(' . count( $comments ) . ')'; ?></h3>
            <div class="comment-list">
                <?php wp_list_comments( [
                        'max_depth'        => '',
                        'style'            => 'div',
                        'reply_text'       => __( 'Reply', 'demo' ),
                        'page'             => '',
                        'callback'         => 'custom_comments',
                        'per_page'         => '',
                        'avatar_size'      => 64,
                        'reverse_top_leve' => null,
                        'reverse_children' => null,
                ] )
                ?>
                <div class="pagination">
                    <?php paginate_comments_links( array(
                            'prev_text' => '<i class="fas fa-chevron-left"></i>',
                            'next_text' => '<i class="fas fa-chevron-right"></i>',
                    ) ); ?>
                </div>
            </div>
        <?php } ?>


    <?php } ?>

</div>