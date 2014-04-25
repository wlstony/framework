<?php 
$body_typography = of_get_option('body_typography');
$body_typography_color = $body_typography["color"];

$header_typography = of_get_option('header_typography');
$header_typography_color = $header_typography["color"];

$link_color = of_get_option('link_color');

$accent_color = of_get_option('accent_color');

$social_widget = of_get_option('social_widget');
?>
<style type="text/css">
	body {
		font-size: <?php echo $body_typography["size"]; ?>;
		<?php if ( $body_typography_color !== "") { ?>
			color: <?php echo $body_typography["color"]; ?>;
		<?php }; ?>
	}
	h1,
	h2,
	h3,
	h4,
	h5,
	h6,
	.sticky-title, 
	#sidebar h3 {
		<?php if ( $header_typography_color !== "") { ?>
			color: <?php echo $header_typography["color"]; ?>;
		<?php }; ?>
	}
	<?php if ($link_color !== "") { ?>
		a {color: <?php echo $link_color; ?>;}
		.title-link:hover { color: <?php echo $link_color; ?>;}
		.post-type { color: <?php echo $link_color; ?>;}
		.comments-link a { color: <?php echo $link_color; ?>;}
		.post-home.format-image img:hover { border-bottom: 7px solid <?php echo $link_color; ?>;}
	<?php } ?>
	<?php if ($accent_color !== "") { ?>
		header {border-bottom: 7px solid <?php echo $accent_color; ?>;}
		.divider-home {background: <?php echo $accent_color; ?>;}
		.single-post-title {border-bottom: 7px solid <?php echo $accent_color; ?>;}
		.comment ul.children > li.bypostauthor > article {border-left: 7px solid <?php echo $accent_color; ?>;}
		blockquote {border-left: 7px solid <?php echo $accent_color; ?>;}
	<?php } 
	if ($social_widget == "two") { ?>
		#social-sidebar {
			display: none;
		}
	<?php } ?>
</style>