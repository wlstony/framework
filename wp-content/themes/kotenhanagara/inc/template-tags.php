<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features
 *
 * @package kotenhanagara
 */

if ( ! function_exists( 'kotenhanagara_content_nav' ) ) :
/**
 * Display navigation to next/previous pages when applicable
 */
function kotenhanagara_content_nav( $nav_id ) {
	global $wp_query, $post;

	// Don't print empty markup on single pages if there's nowhere to navigate.
	if ( is_single() ) {
		$previous = ( is_attachment() ) ? get_post( $post->post_parent ) : get_adjacent_post( false, '', true );
		$next = get_adjacent_post( false, '', false );

		if ( ! $next && ! $previous )
			return;
	}

	// Don't print empty markup in archives if there's only one page.
	if ( $wp_query->max_num_pages < 2 && ( is_home() || is_archive() || is_search() ) )
		return;

	$nav_class = ( is_single() ) ? 'navigation-post' : 'navigation-paging';

	?>
    
    <div class="also-link">

                </div><!-- ./also-link -->
	<?php
}
endif; // kotenhanagara_content_nav

if ( ! function_exists( 'kotenhanagara_comment' ) ) :
/**
 * Template for comments and pingbacks.
 *
 * Used as a callback by wp_list_comments() for displaying the comments.
 */
function kotenhanagara_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case 'pingback' :
		case 'trackback' :
	?>
	<li class="post pingback">
		<p><?php _e( 'Pingback:', 'kotenhanagara' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __( 'Edit', 'kotenhanagara' ), '<span class="edit-link">', '<span>' ); ?></p>
	<?php
			break;
		default :
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<article id="comment-<?php comment_ID(); ?>" class="comment">
			<footer>
				<div class="comment-author vcard">
					<?php echo get_avatar( $comment, 48 ); ?>
				</div><!-- .comment-author .vcard -->
                <div class="author-detail">
				<?php printf( __( '%s', 'kotenhanagara' ), sprintf( '<cite class="fn">%s</cite>', get_comment_author_link() ) ); ?>
				<?php if ( $comment->comment_approved == '0' ) : ?>
					<em><?php _e( 'Your comment is awaiting moderation.', 'kotenhanagara' ); ?></em>
					<br />
                    </div><!-- .comment-author .vcard -->
				<?php endif; ?>

				<div class="comment-meta commentmetadata">
					<a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>"><time datetime="<?php comment_time('M d, Y'); ?>">
					<?php printf( _x( '%1$s at %2$s', '1: date, 2: time', 'kotenhanagara' ), get_comment_date('M d, Y'), get_comment_time() ); ?>
					</time></a>
					<?php edit_comment_link( __( 'Edit', 'kotenhanagara' ), '<span class="edit-link">', '<span>' ); ?>
				</div><!-- .comment-meta .commentmetadata -->
			</footer>

			<div class="comment-content"><?php comment_text(); ?>
            <div class="reply">
			<?php
				comment_reply_link( array_merge( $args,array(
					'depth'     => $depth,
					'max_depth' => $args['max_depth'],
				) ) );
			?>
			</div><!-- .reply -->
            </div>

			<div class="comment-clear"></div><!-- .comment-clear -->
		</article><!-- #comment-## -->

	<?php
			break;
	endswitch;
}
endif; // ends check for kotenhanagara_comment()

if ( ! function_exists( 'kotenhanagara_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function kotenhanagara_posted_on() {
	printf( __( '<a href="%1$s" title="%2$s" rel="bookmark"><time class="entry-date" datetime="%3$s">%4$s</time></a>', 'kotenhanagara' ),
		esc_url( get_permalink() ),
		esc_attr( get_the_time() ),
		esc_attr( get_the_date('M d, Y') ),
		esc_html( get_the_date() ),
		esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
		esc_attr( sprintf( __( 'View all posts by %s', 'kotenhanagara' ), get_the_author() ) ),
		get_the_author()
	);
}
endif;
/**
 * Returns true if a blog has more than 1 category
 */
function kotenhanagara_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'all_the_cool_cats' ) ) ) {
		// Create an array of all the categories that are attached to posts
		$all_the_cool_cats = get_categories( array(
			'hide_empty' => 1,
		) );

		// Count the number of categories that are attached to the posts
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'all_the_cool_cats', $all_the_cool_cats );
	}

	if ( '1' != $all_the_cool_cats ) {
		// This blog has more than 1 category so kotenhanagara_categorized_blog should return true
		return true;
	} else {
		// This blog has only 1 category so kotenhanagara_categorized_blog should return false
		return false;
	}
}

/**
 * Flush out the transients used in kotenhanagara_categorized_blog
 */
function kotenhanagara_category_transient_flusher() {
	// Like, beat it. Dig?
	delete_transient( 'all_the_cool_cats' );
}
add_action( 'edit_category', 'kotenhanagara_category_transient_flusher' );
add_action( 'save_post', 'kotenhanagara_category_transient_flusher' );