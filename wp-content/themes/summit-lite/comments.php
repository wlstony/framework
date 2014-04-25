<?php
/**
 * The template for displaying Comments.
 *
 * The area of the page that contains both current comments
 * and the comment form. The actual display of comments is
 * handled by a callback to summit_comment() which is
 * located in the inc/template-tags.php file.
 * 
 * This has been adapted from the Comments Template described in ThemeShapers post: http://http://themeshaper.com/2012/11/04/the-wordpress-theme-comments-template/
 * I highly recommend this template.
 *
 * @package summit
 * @since Summit 1.0
 */
?>
 
<?php
    /*
     * If the current post is protected by a password and
     * the visitor has not yet entered the password we will
     * return early without loading the comments.
     */
    if ( post_password_required() )
        return;
?>
 
    <div id="comments" class="comments-area">
    <?php if ( have_comments() ) : ?>
        <h3 class="comments-title">
            <?php
                printf( _n( 'One person is talking about &ldquo;%2$s&rdquo;', '%1$s people are talking about &ldquo;%2$s&rdquo;', get_comments_number(), 'summit' ),
                    number_format_i18n( get_comments_number() ), '<span>' . get_the_title() . '</span>' );
            ?>
        </h3>
 
        <?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through? If so, show navigation ?>
        <nav role="navigation" id="comment-nav-above" class="site-navigation comment-navigation">
            <div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'summit' ) ); ?></div>
            <div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'summit' ) ); ?></div>
        </nav><!-- #comment-nav-before .site-navigation .comment-navigation -->
        <?php endif; // check for comment navigation ?>
 
        <ol class="commentlist">
            <?php
                /* Loop through and list the comments. Tell wp_list_comments()
                 * to use summit_comment() to format the comments.
                 * If you want to overload this in a child theme then you can
                 * define summit_comment() and that will be used instead.
                 * See summit_comment() in inc/template-tags.php for more.
                 */
                wp_list_comments( array( 'callback' => 'summit_comment' ) );
            ?>
        </ol><!-- .commentlist -->
 
        <?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through? If so, show navigation ?>
        <nav role="navigation" id="comment-nav-below" class="site-navigation comment-navigation">
            <div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'summit' ) ); ?></div>
            <div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'summit' ) ); ?></div>
        </nav><!-- #comment-nav-below .site-navigation .comment-navigation -->
        <?php endif; // check for comment navigation ?>
 
    <?php endif; // have_comments() ?>
 
    <?php
        // If comments are closed and there are comments, let's leave a little note, shall we?
        if ( ! comments_open() && '0' != get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
    ?>
        <p class="nocomments"><?php _e( 'Comments are closed.', 'summit' ); ?></p>
    <?php endif; ?>
 
    <?php comment_form(); ?>
 
</div><!-- #comments .comments-area -->