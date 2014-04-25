<?php
/**
 * The sidebar containing the main widget area for blog pages.
 *
 * If no active widgets in sidebar, let's hide it completely.
 * Boot Store theme is based on Twentytwelve theme. The official WordPress theme.
 *
 * @package WordPress
 * @subpackage Boot Store
 * @since Boot Store 1.0
 */
?>
<?php do_action( 'bp_before_sidebar' ); ?>

	<?php if ( is_active_sidebar( 'sidebar-buddypress' ) ) : ?>
		<div id="secondary" class="widget-area span3" role="complementary">
			<?php do_action( 'bp_inside_before_sidebar' ); ?>

				<?php dynamic_sidebar( 'sidebar-buddypress' ); ?>

			<?php /* Show forum tags on the forums directory */
			if ( function_exists( 'bp_is_active' ) && bp_is_active( 'forums' ) && bp_is_forums_component() && bp_is_directory() ) : ?>
				<div id="forum-directory-tags" class="widget tags">
					<h3 class="widgettitle"><?php _e( 'Forum Topic Tags', 'buddypress' ); ?></h3>
					<div id="tag-text"><?php bp_forums_tag_heat_map(); ?></div>
				</div>
			<?php endif; ?>

			<?php do_action( 'bp_inside_after_sidebar' ); ?>
		</div><!-- #sidebar -->
	<?php endif; ?>

	<?php do_action( 'bp_after_sidebar' ); ?>
