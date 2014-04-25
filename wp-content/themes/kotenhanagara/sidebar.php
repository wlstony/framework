<?php
/**
 * The Sidebar containing the main widget areas.
 *
 * @package kotenhanagara
 */
?>
	<div id="secondary" class="widget-area" role="complementary">
		<?php do_action( 'before_sidebar' ); ?>
		<?php if ( ! dynamic_sidebar( 'sidebar-1' ) ) : ?>

			<aside id="search" class="widget widget_search">
				<?php get_search_form(); ?>
			</aside>

			<aside id="archives" class="widget">
				<h1 class="widget-title"><?php _e( 'Archives', 'kotenhanagara' ); ?></h1>
				<ul>
					<?php wp_get_archives( array( 'type' => 'monthly' ) ); ?>
				</ul>
			</aside>
            
            <aside id="tag" class="widget">
            <?php wp_tag_cloud('smallest=10largest=18&orderby=count&order=desc'); ?>
            </aside>

		<?php endif; // end sidebar widget area ?>
	</div>
			<!-- #secondary -->
