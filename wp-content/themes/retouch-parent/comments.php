<?php
/**
 * The template for displaying Comments
 *
 * The area of the page that contains comments and the comment form.
 */

/*
 * If the current post is protected by a password and the visitor has not yet
 * entered the password we will return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
} ?>


<?php
$commenter = wp_get_current_commenter();
$req = get_option( 'require_name_email' );
$aria_req = ( $req ? " aria-required='true'" : '' );

if(is_user_logged_in()){
    $comment_field = '<fieldset><p>
                          <label for="fd">'. __( 'Message', 'fw' ) .'</label>
                          <textarea id="fd" name="comment" ' . $aria_req . ' required></textarea>
                      </p></fieldset>';
    $textarea_field = '';
}
else{
    $comment_field = '';
    $textarea_field = '<p>
                            <label for="fd">'. __( 'Message', 'fw' ) .'</label>
                            <textarea id="fd" name="comment" ' . $aria_req . ' required></textarea>
                       </p>';
}

$args = array(
    'id_form'           => 'commentform',
    'id_submit'         => 'submit',
    'title_reply'       => '',
    'title_reply_to'    => __( 'Leave Your Reply to %s','fw'  ),
    'cancel_reply_link' => __( 'Cancel Reply','fw'  ),
    'label_submit'      => __( 'Send','fw'  ),

    'comment_field' => $comment_field,

    'must_log_in' => '<p class="must-log-in">' .
        sprintf(
            __( 'You must be <a href="%s">logged in</a> to post a comment.','fw'  ),
            esc_url(wp_login_url( apply_filters( 'the_permalink', esc_url(get_permalink()) ) ))
        ) . '</p>',

    'logged_in_as' => '<p class="logged-in-as">' .
        sprintf(
            __( 'Logged in as <a href="%1$s">%2$s</a>. <a href="%3$s" title="Log out of this account">Log out?</a>','fw'  ),
            esc_url(admin_url( 'profile.php' )),
            $user_identity,
            esc_url(wp_logout_url( apply_filters( 'the_permalink', esc_url(get_permalink( )) ) ))
        ) . '</p>',

    'comment_notes_before' => '',

    'comment_notes_after' => '',

    'fields' => apply_filters( 'comment_form_default_fields', array(

            'author' =>'<fieldset>
							<p>
                            <span>
                                <label for="author">' . __( 'Name', 'fw' ) . '</label>
                                <input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) .'" ' . $aria_req . ' required>
                            </span>',

            'email' =>'<span>
                        <label for="email">' . __( 'Email', 'fw' ) . '</label>
                        <input id="email" name="email" type="email" value="' . esc_attr(  $commenter['comment_author_email'] ) .'"  ' . $aria_req . ' required>
                       </span>',
            'url' =>'<span>
                            <label  for="url">'.__('Website','fw').'</label>
                            <input id="url" name="url" type="url" value="' . esc_url( $commenter['comment_author_url'] ) .'" >
                        </span>
					</p></fieldset>',
            'comment_field' => $textarea_field
        )
    )
);
?>


