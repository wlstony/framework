<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package Flounder
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width" />
<title><?php wp_title( '|', true, 'right' ); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

<!--[if lt IE 9]>
<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js" type="text/javascript"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/fixicons.js" type="text/javascript"></script>
<![endif]-->

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php if ( has_nav_menu( 'primary' ) ): ?>
<div class="menu-toggle nav icon dashicons dashicons-menu" id="toggle-nav"></div>
<?php endif; ?>
<?php if ( is_active_sidebar( 'sidebar-1' ) ): ?>
<div class="menu-toggle widgets icon dashicons dashicons-screenoptions" id="toggle-widgets"></div>
<?php endif; ?>

<div id="page" class="hfeed site">

	<header id="masthead" class="site-header" role="banner">
		<div class="site-branding">
			<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
		</div>

		<nav id="site-navigation" class="navigation-main" role="navigation">
			<div class="screen-reader-text skip-link"><a href="#content" title="<?php esc_attr_e( 'Skip to content', 'flounder' ); ?>"><?php _e( 'Skip to content', 'flounder' ); ?></a></div>

			<?php wp_nav_menu( array( 
				'theme_location' => 'primary',
				/* No fallback, we want the menu to be purposefully set. */
				'fallback_cb' => '__return_false'
			) ); ?>
		</nav><!-- #site-navigation -->
	</header><!-- #masthead -->
