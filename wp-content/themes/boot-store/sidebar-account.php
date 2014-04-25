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

	<?php if ( is_active_sidebar( 'sidebar-account' ) ) : ?>
		<div id="secondary" class="widget-area span3" role="complementary">
			<?php dynamic_sidebar( 'sidebar-account' ); ?>
		</div><!-- #secondary -->
	<?php endif; ?>