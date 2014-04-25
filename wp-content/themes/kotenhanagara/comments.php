<?php
/**
 * The template for displaying Comments.
 *
 * The area of the page that contains both current comments
 * and the comment form. The actual display of comments is
 * handled by a callback to kotenhanagara_comment() which is
 * located in the inc/template-tags.php file.
 *
 * @package kotenhanagara
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() )
	return;
?>

	<div id="comments" class="comments-area">

	<?php // You can start editing here -- including this comment! ?>

	<?php if ( have_comments() ) : ?>
		<h2 class="comments-title">
			comment
		</h2>

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
		<nav id="comment-nav-above" class="navigation-comment" role="navigation">
			<h1 class="screen-reader-text"><?php _e( 'Comment navigation', 'kotenhanagara' ); ?></h1>
			<div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'kotenhanagara' ) ); ?></div>
			<div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'kotenhanagara' ) ); ?></div>
		</nav><!-- #comment-nav-before -->
		<?php endif; // check for comment navigation ?>

		<ol class="comment-list">
			<?php
				/* Loop through and list the comments. Tell wp_list_comments()
				 * to use kotenhanagara_comment() to format the comments.
				 * If you want to overload this in a child theme then you can
				 * define kotenhanagara_comment() and that will be used instead.
				 * See kotenhanagara_comment() in inc/template-tags.php for more.
				 */
				wp_list_comments( array( 'callback' => 'kotenhanagara_comment' ) );
			?>
		</ol><!-- .comment-list -->

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
		<nav id="comment-nav-below" class="navigation-comment" role="navigation">
			<h1 class="screen-reader-text"><?php _e( 'Comment navigation', 'kotenhanagara' ); ?></h1>
			<div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'kotenhanagara' ) ); ?></div>
			<div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'kotenhanagara' ) ); ?></div>
		</nav><!-- #comment-nav-below -->
		<?php endif; // check for comment navigation ?>

	<?php endif; // have_comments() ?>

	<?php
		// If comments are closed and there are comments, let's leave a little note, shall we?
		if ( ! comments_open() && '0' != get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
	?>
		<p class="no-comments"><?php _e( 'Comments are closed.', 'kotenhanagara' ); ?></p>
	<?php endif; ?>

	<?php
// デフォルト値取得
$commenter = wp_get_current_commenter();
$req = get_option( 'require_name_email' );
$aria_req = ( $req ? " aria-required='true'" : '' );

// $fields設定
$fields = array(
    'author' => '<p id="inputtext">' .
                '<input id="author" name="author" type="text" placeholder="name" value="' 
                . esc_attr( $commenter['comment_author'] ) . '" size="40"' . $aria_req . ' /></p>',

    'email'  => '<p id="inputtext">' .
                '<input id="email" name="email" type="text" placeholder="mail (will not be published)" value="' 
                . esc_attr(  $commenter['comment_author_email'] ) . '" size="40"' . $aria_req . ' /></p>',

    'url'    => '<p id="inputtext">'.
                '<input id="url" name="url" type="text" placeholder="website" value="' 
                . esc_attr( $commenter['comment_author_url'] ) . '" size="40" /></p>',
    ); 

// $comment_field設定
$comment_field = '<p class="comment-form-comment"><textarea id="comment" name="comment" placeholder="message" cols="45" rows="8" aria-required="true"></textarea></p>';

// $comment_notes_before設定
$comment_notes_before = NULL;

// $args設定
$args = array(
	'fields'		=> apply_filters( 'comment_form_default_fields', $fields ),
	'comment_field'		=> $comment_field,
	'comment_notes_before' 	=> $comment_notes_before,
);
?>

<?php comment_form($args); ?>


</div><!-- #comments -->
