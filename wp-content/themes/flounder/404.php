<?php
/**
 * The template for displaying 404 pages (Not Found).
 *
 * @package Flounder
 */

get_header(); ?>

	<section id="primary" class="content-area">
		<div id="content" class="site-content" role="main">

			<article id="post-0" class="post hentry error404 not-found">
				<div class="entry-area">
					
					<header class="entry-header">
						<h1 class="entry-title"><?php _e( 'Oops! That page can&rsquo;t be found.', 'flounder' ); ?></h1>
					</header><!-- .entry-header -->
	
					<div class="entry-content">
						<p><?php _e( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'flounder' ); ?></p>
	
						<?php get_search_form(); ?>
	
						<?php the_widget( 'WP_Widget_Recent_Posts', '',"before_title=<h2 class='widget-title'>" ); ?>
	
						<?php
						/* translators: %1$s: smiley */
						$archive_content = '<p>' . sprintf( __( 'Try looking in the monthly archives. %1$s', 'flounder' ), convert_smilies( ':)' ) ) . '</p>';
						the_widget( 'WP_Widget_Archives', 'dropdown=1', "before_title=<h2 class='widget-title'>&after_title=</h2>$archive_content" );
						?>
	
						<?php the_widget( 'WP_Widget_Tag_Cloud', '', "before_title=<h2 class='widget-title'>" ); ?>
	
					</div><!-- .entry-content -->
				
				</div><!-- .entry-area -->

				<div class="entry-meta sidebar-bg"></div>
				<footer class="entry-meta">
					<i class="icon format-icon dashicons dashicons-tinymce-help"></i>
				</footer><!-- .entry-meta -->
			
			</article><!-- #post-0 .post .error404 .not-found -->

		</div><!-- #content -->
	</section><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>