<div class="container bg-light pt-2 pb-2">
    <h2>
        <?php
            if( ! have_comments()){
            }
            else{
                echo get_comments_number(). " Kommentare";
            }
        ?>
    </h2>

    <?php
    //all comments
        wp_list_comments(
            array(
                'avatar_size' => 50,
                'style' => 'div',
            )
        );
    ?>

    <?php
    //comment form
        if( comments_open() ){
            $comment_args = array(
                'class_submit' => 'btn themell-btn',
                'comment_field' => '<p class="comment-form-comment"><label for="comment">' . _x( 'Comment', 'noun' ) . '</label> <textarea id="comment" name="comment" class="form-control" cols="45" rows="8" maxlength="1000" aria-required="true" required="required"></textarea></p>',
                'fields' => array(
                    'class_form' => '',
                    'title_reply_before' => '<h2>',
                    'title_replay_after' => '</h2>',
                    'author' => '<p class="comment-form-author">' . '<label for="author">' . __( 'Name' ) . ( $req ? ' <span class="required">*</span>' : '' ) . '</label> ' .
                    '<input id="author" name="author" class="form-control" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . $html_req . ' /></p>',
                    'email'  => '<p class="comment-form-email"><label for="email">' . __( 'Email' ) . ( $req ? ' <span class="required">*</span>' : '' ) . '</label> ' .
                    '<input id="email" name="email" class="form-control" ' . ( $html5 ? 'type="email"' : 'type="text"' ) . ' value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30" aria-describedby="email-notes"' . $aria_req . $html_req  . ' /></p>',
                    'url'    => '<p class="comment-form-url"><label for="url">' . __( 'Website' ) . '</label> ' .
                    '<input id="url" name="url" class="form-control" ' . ( $html5 ? 'type="url"' : 'type="text"' ) . ' value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" /></p>',
                    )
            );
            comment_form($comment_args);
        }
    ?>


</div>