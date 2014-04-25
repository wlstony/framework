<?php get_header(); ?>
<section class="span9">
<style type="text/css">
	.content:first-of-type {
		border-top: 1px solid #dfdfdf;
	}
</style>
<div class="well category-title">
	<h3><?php single_tag_title(); ?></h3>
	<p><small class="glyphicon glyphicon-tag"></small><em>All of the posts under the <strong>"<?php single_tag_title(); ?>"</strong> tag.</em></p>
</div>
<?php get_template_part('loop');
summit_content_nav( 'nav-below' ); ?>
</section>
<?php get_sidebar(); ?>
</div>
<?php get_footer() ?>
