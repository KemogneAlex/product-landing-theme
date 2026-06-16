<?php
/**
 * The template for displaying comments
 *
 * The area of the page that contains both current comments
 * and the comment form.
 *
 * @package Jupi
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}
?>
<div id="comments" class="comments-area">
    <?php
    /*---------------------------------------------------------------------------------------
    If comments are closed and there are comments, let's leave a little note, shall we?
    ----------------------------------------------------------------------------------------*/
    if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
    ?>
    <p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'jupi' ); ?></p>
    <?php endif; ?>
    <?php if ( have_comments() ) : ?>
    <div class="comment-list-area">
        <h3 class="comments-title">
            <?php
                $comments_number = get_comments_number();
                if ( '1' === $comments_number ) {
                    /* translators: %s: post title */
                    printf( _x( 'One thought on &ldquo;%s&rdquo;', 'comments title', 'jupi' ), get_the_title() );
                } else {
                    printf(
                        /* translators: 1: number of comments, 2: post title */
                        _nx(
                            '%1$s Comment',
                            '%1$s Comments',
                            $comments_number,
                            'comments title',
                            'jupi'
                        ),
                        number_format_i18n( $comments_number ),
                        get_the_title()
                    );
                }
            ?>
        </h3>
        <ol class="comment-list">
            <?php
                wp_list_comments(
                    array(
                        'style'       => 'ul+',
                        'short_ping'  => true,
                        'avatar_size' => 100
                    )
                );
            ?>
        </ol>
        <?php 
            $paginet = array(
                'prev_text' => '<i class="flaticon-left-arrow-1"></i>',
                'next_text' => '<i class="flaticon-right-arrow"></i>',
                'screen_reader_text' => ' ',
                'type' => 'array',
                'show_all' => true,
            );
            the_comments_pagination( $paginet );
        ?>
    </div>       
    <?php endif; 
    
    $commenter = wp_get_current_commenter();
    $req = get_option( 'require_name_email' );
    $aria_req = ( $req ? " aria-required='true'" : '' );
    $consent = empty( $commenter['comment_author_email'] ) ? '' : ' checked="checked"';
    $jupi_comment_fields =  array(        
        'author' => '<p class="comment-form-author"><label for="author" class="icon"><i class="flaticon-user"></i></label><input id="author" name="author" type="text" value="'.esc_attr( $commenter['comment_author'] ).'" size="30" '. $aria_req .' '. $aria_req .' placeholder="'.esc_attr__('Type your name...','jupi').'"></p>',

        'email' => '<p class="comment-form-email"><label for="email" class="icon"><i class="flaticon-email"></i></label><input id="email" name="email" type="email" size="30" value="'.esc_attr( $commenter['comment_author_email'] ).'" '. $aria_req .' placeholder="'.esc_attr__('Type your email...','jupi').'" ></p>',

        'url' => '<p class="comment-form-url"><label for="url" class="icon"><i class="flaticon-worldwide"></i></label><input id="url" name="url" type="url" value="'.esc_attr( $commenter['comment_author_url'] ).'" placeholder="'.esc_attr__('Type your website...','jupi').'" ></p>',   

        'cookies' => '<p class="comment-form-cookies-consent"><input id="wp-comment-cookies-consent" name="wp-comment-cookies-consent" type="checkbox" value="yes"' . $consent . ' />' . '<label for="wp-comment-cookies-consent">' . esc_html__( 'Save my name, email, and website in this browser for the next time I comment.', 'jupi' ) . '</label></p>'        
        
    );            
    comment_form( array(
        'fields' => apply_filters( 'comment_form_default_fields', $jupi_comment_fields ),
        'comment_field' => '<p class="comment-form-comment"><label for="comment" class="icon"><i class="flaticon-edit-2"></i></label><textarea id="comment" name="comment" cols="45" rows="8" required="required" placeholder="'.esc_attr__('Type your comment...','jupi').'"></textarea></p>',
        'class_submit' => 'bttn-1 submit-button',
        'logged_in_as' => '<p class="logged-in-as">'. esc_html__( 'Logged in as ','jupi' ) .sprintf( '<a href="%1$s">%2$s</a>. <a href="%3$s" title="'.esc_attr__('Log out of this account','jupi').'">'.esc_html__( 'Log out?','jupi' ).'</a>' ,admin_url( 'profile.php' ),$user_identity,wp_logout_url( apply_filters( 'the_permalink', get_permalink( )))) . '</p>',
        'title_reply' => esc_html__( 'Post Comment', 'jupi' )
    ) );
    
    ?>
</div>