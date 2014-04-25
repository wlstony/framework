<?php
if ( ! function_exists( 'summit_comment' ) ) :
/**
 * Template for comments and pingbacks.
 *
 * Used as a callback by wp_list_comments() for displaying the comments.
 *
 * @since Summit 2.0
 */
function summit_comment( $comment, $args, $depth ) {
    $GLOBALS['comment'] = $comment;
    switch ( $comment->comment_type ) :
        case 'pingback' :
        case 'trackback' :
    ?>
    <li class="post pingback">
        <p><?php _e( 'Pingback:', 'summit' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __( '(Edit)', 'summit' ), ' ' ); ?></p>
    <?php
            break;
        default :
    ?>
    <li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
        <article id="comment-<?php comment_ID(); ?>" class="comment row">
            <div class="comment-author vcard span2">
                <?php echo get_avatar( $comment, $size = '100' ); ?>
            </div><!-- .comment-author .vcard -->
            <?php if ( $comment->comment_approved == '0' ) : ?>
                <em><?php _e( 'Your comment is awaiting moderation.', 'summit' ); ?></em>
                <br />
            <?php endif; ?>
                
            <div class="comment-content">
                <div class="comment-meta commentmetadata">
                    <?php printf( __( '%s', 'summit' ), sprintf( '<cite class="fn">%s</cite>', get_comment_author_link() ) ); ?> |
                    <a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>"><time pubdate datetime="<?php comment_time( 'c' ); ?>">
                    <?php
                        /* translators: 1: date, 2: time */
                        printf( __( '%1$s at %2$s', 'summit' ), get_comment_date(), get_comment_time() ); ?>
                    </time></a>
                    <?php edit_comment_link( __( '(Edit)', 'summit' ), ' ' );
                    ?>
                </div><!-- .comment-meta .commentmetadata -->
                <?php comment_text(); ?>
            </div>
 
            <div class="reply">
                <?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
            </div><!-- .reply -->
        </article><!-- #comment-## -->
 
    <?php
            break;
    endswitch;
}
endif; // ends check for summit_comment()