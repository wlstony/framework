<?php while ( have_posts() ) : the_post() ?>
	<section class="content">
		<article id="post-<?php the_ID(); ?>" <?php post_class('post-home'); ?>>
			<h2 class="post-title">
				<?php 
				$format = get_post_format();
				$format_link = get_post_format_link($format); ?>
				<?php 
				if ( has_post_format('link') ) {
					the_title();
				} elseif (is_sticky() ) { ?>
					<a class="title-link" href="<?php the_permalink(); ?>" title="Permalink to <?php printf( the_title_attribute('echo=0') ); ?>" rel="bookmark"><?php the_title(); ?></a><span class="sticky-title">Featured</span>
			 	<?php } else { ?>
			 		<a class="title-link" href="<?php the_permalink(); ?>" title="Permalink to <?php printf( the_title_attribute('echo=0') ); ?>" rel="bookmark"><?php the_title(); ?></a>
				<?php } 
				if ($format !== false) { 
					if ($format == "status") {
						$format = 'comment';
					} ?>
					<a href="<?php echo $format_link; ?>" alt="The Post Format Archive"><span class="post-type glyphicon glyphicon-<?php echo $format; ?>"></span></a>
				<?php } ?>
			</h2>
			<?php if ( has_post_format('link') ) { ?>
				<div class="format-link">
					<?php the_content(); ?>
				</div>
			<?php } else {
				if (has_post_thumbnail() ) { 
					if (is_sticky() ) {
					echo '<div class="sticky-featured-container"><a href="',
						 the_permalink(),
						 '">',
						 get_the_post_thumbnail($post->ID, 'full', array('class' => 'sticky-featured-img')),
						 '</a></div>';
					} else {
					echo '<a href="',
						 the_permalink(),
						 '">',
						 get_the_post_thumbnail($post->ID, 'thumbnail', array('class' => 'alignleft thumbnail')),
						 '</a>';
					} 
				}
				if ($format == 'video') { ?>
					<div class="video-container">
						<?php the_content(); ?>
					</div>
				<?php } 
				else {
					the_content('Read more &rarr;');
				}
			} ?>
		</article>
		<div class="meta-container">
			<p class="meta">
				<span><i class="glyphicon glyphicon-user"></i> <a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>"><?php the_author_meta( 'display_name' ); ?></a></span> 
				<span class="published" title="<?php the_time('Y-m-d\TH:i:sO') ?>"><i class="glyphicon glyphicon-calendar"></i> <?php the_time( get_option( 'date_format' ) ); ?></span>  
				<span><i class="glyphicon glyphicon-comment"></i> <span class="comments-link"><a href="<?php comment_link(); ?>" title="The posts comments."><?php comments_number('Leave A Comment', '1 Comment', '% Comments') ?></a></span>
				<span><i class="glyphicon glyphicon-link"></i> <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"">Permalink</a></span>
			</p>
	   	</div>
	</section>
<?php endwhile; ?>