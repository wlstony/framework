<?php
$format = get_post_format();
?>
<section id="content" class="span9">
<?php while ( have_posts() ) : the_post() ?>
	<article id="post-single">
		<div class="post-header-wrapper">
			<h1 class="post-title"><?php the_title(); ?></h1>
			<p class="top-meta"><span class="published" title="<?php the_time('Y-m-d\TH:i:sO') ?>"><?php the_time( get_option( 'date_format' ) ); ?></span> | <span class="comments-link"><?php comments_popup_link( 'Comment', '1 Comment', '% Comments' ) ?></span></p>
		</div>
			<?php 
			$img_url = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'large');	
			if ( has_post_thumbnail() ) { ?>
				<div class="regular-post-featured-bg">
					<img src="<?php echo $img_url[0] ?>">
				</div>
			<?php } ?>
		<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<?php
				if ($format == 'video') { ?>
					<div class="video-container">
						<?php the_content(); ?>
					</div>
				<?php } 
				else {
					the_content('Read more &rarr;');
				}
			?>
			<?php wp_link_pages(); ?>
		</div>
	</article>
	<div class="meta-container">
		<p class="meta">
			<span><i class="glyphicon glyphicon-user"></i> <a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>"><?php the_author_meta( 'display_name' ); ?></a></span>
			<span><?php if ('has_category') { echo '<i class="glyphicon glyphicon-folder-open"></i> ', get_the_category_list(', '); } ?></span>
			<?php if ('has_tag') { the_tags( '<span>' . '<i class="glyphicon glyphicon-tag"></i>', ", ", "</span>" ); } ?>
			<span><?php edit_post_link( '<i class="glyphicon glyphicon-edit"></i> Edit' ) ?></span>
		</p>
	</div>
	<div id="comments-wrap">
		<?php
			comments_template('/comments.php');
		?>
	</div>
	<?php endwhile; ?>
</section>