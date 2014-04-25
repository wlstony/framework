<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="UTF-8">
	<title><?php wp_title(); ?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
	<?php wp_head(); ?>
</head>
<body  <?php body_class(); ?>>
	<div class="container">
		<div class="row-fluid">
			<div class="span12">
				<header>
					<?php get_template_part('assets/styles/custom', 'header'); ?>
					<nav class="top-nav" role="navigation">			
						<?php

							$menu_defaults = array(
								'sort_column'		=> 'menu_order',
								'theme_location'	=> 'primary_nav',
								'menu'				=> 'Primary Navigation',
								'depth'				=> 3,
								'menu_id'			=> 'menu',
								'menu_class'		=> 'hidden-phone'
							);
							wp_nav_menu( $menu_defaults );
						?>
						<?php 
							$args = array(
								'depth'       => 0,
								'sort_column' => 'menu_order, post_title',
								'menu_class'  => 'mobile-menu',
								'include'     => '',
								'exclude'     => '',
								'echo'        => true,
								'show_home'   => false,
								'link_before' => '',
								'link_after'  => ''
							);
						?>
						<div class="visible-phone">
							<a id="mobile-nav"><i class="glyphicon glyphicon-align-justify"></i> Menu</a>
							<?php wp_page_menu($args); ?>
						</div>
					</nav>
				</header>
			</div>
		</div>
		<div class="row-fluid">