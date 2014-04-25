<section id="content" class="span12">
	<article id="post-single" class="search-results">
		<div class="search-header-wrapper">
			<h2>Search Results for "<?php the_search_query(); ?>"</h2>
		</div>
		<?php 
		$query = new WP_Query('s=keyword'); 
		if (have_posts()) while (have_posts()) : the_post(); ?>
			<div class="search-header-wrapper">
				<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
				<?php if (has_post_thumbnail() ) { 
					echo '<a href="',
						 the_permalink(),
						 '">',
						 get_the_post_thumbnail($post->ID, 'thumbnail', array('class' => 'alignleft thumbnail')),
						 '</a>';
				} ?>
				<?php the_excerpt(); ?>
			</div>
		<?php endwhile; ?>
		<p>Didn't find what you're looking for? Try another search term:</p>
		<?php get_search_form(); ?>
	</article>
</section>