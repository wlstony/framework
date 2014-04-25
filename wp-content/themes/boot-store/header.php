<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 * Boot Store theme is based on Twentytwelve theme. The official WordPress theme.
 *
 * @package WordPress
 * @subpackage Boot Store
 * @since Boot Store 1.0
 */
?><!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width" />
<title><?php wp_title( '|', true, 'right' ); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<?php // Loads HTML5 JavaScript file to add support for HTML5 elements in older IE versions. ?>
<!--[if lt IE 9]>
<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js" type="text/javascript"></script>
<![endif]-->

<!--<link rel="shortcut icon" href="<?php get_stylesheet_directory(); ?>/favicon.ico" type="image/x-icon">
<link rel="icon" href="<?php get_stylesheet_directory(); ?>/favicon.ico" type="image/x-icon">-->

<?php wp_head(); ?>

</head>

<body <?php body_class(); ?> id="bp-default" >
<?php if ( ! is_user_logged_in() ) : ?>
	<div id="myLoginRegister" class="modal hide fade">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>

		<div class="row-fluid">
			<div class="span12">
				<div class="modal-header">
					<h3><?php _e( 'Login', 'bre-bootstrap-ecommerce' ); ?></h3>
				</div>
				<div class="modal-body">
					<?php if ( function_exists( 'tcp_login_form' ) ) tcp_login_form(); ?>
				</div>
			</div>
		</div><!-- .row-fluid -->
	</div><!-- #myLoginRegister -->
<?php endif; ?>
	
<div id="page-top-wrapper" class="container-fluid-wrapper">
	<div id="page-top" class="site">

		<header id="masthead" class="site-header wrapper" role="banner">
			<div class="hgroup">
				<div class="site-title-description clearfix">
					<?php $bre_logo = get_option( 'bre_image_logo', false );
					if ( $bre_logo !== false ) : $bre_logo = $bre_logo['url']; ?>
						<h1 class="site-title bre-logo"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><img alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" src="<?php echo $bre_logo ?>"></a></h1>
					<?php else : ?>
						<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
					<?php endif; ?>

					<?php $bse_site_description = get_option( 'bre_site_description_hide', false );
					if ( $bse_site_description == false ) :  ?>
						<h2 class="site-description"><?php bloginfo( 'description' ); ?></h2>
					<?php endif; ?>
				</div>
				<div class="bse-language">
					<?php do_action( 'icl_language_selector' ); ?>
				</div>
				<?php $header_image = get_header_image();
				if ( ! empty( $header_image ) ) : ?>
					<!-- a href="<?php echo esc_url( home_url( '/' ) ); ?>"></a> -->
						<img src="<?php echo esc_url( $header_image ); ?>" class="header-image" width="<?php echo get_custom_header()->width; ?>" height="<?php echo get_custom_header()->height; ?>" alt="" />
				<?php endif; ?>
			</div>

		<?php ob_start();
		wp_nav_menu( array( 
			'theme_location' => 'primary', 
			'menu_class' => 'nav',
			'container_class' => 'nav-collapse-primary nav-collapse collapse',
			'fallback_cb'     => 'false',
		) );
		$out = ob_get_clean(); 
		if ( strlen( $out ) > 0 ) : ?>
			<div class="primary-menu-wrapper">
				<?php $bre_primary_menu = get_option( 'bre_primary_menu', '' );
				$bre_primary_menu_transparent = get_option( 'bre_primary_menu_transparent', true );
				$bre_primary_menu_transparent = $bre_primary_menu_transparent ? 'transparent' : ''; ?>
				<div class="navbar <?php echo $bre_primary_menu; ?> <?php echo $bre_primary_menu_transparent; ?> primary-menu-bs">
						<div class="navbar-inner">
							<div class="container">
								<?php echo $out; ?>
							</div>
						</div>
					</div><!-- .navbar -->
			</div><!-- .primary-menu-wrapper -->
		<?php endif; ?>
		</header><!-- #masthead -->

		<?php $bre_secondary_menu		= get_option( 'bre_secondary_menu', 'navbar-inverse' );
		$bre_secondary_menu_transparent	= get_option( 'bre_secondary_menu_transparent', false );
		$bre_secondary_menu_transparent	= $bre_secondary_menu_transparent ? 'transparent' : ''; ?>

		<div class="navbar <?php echo $bre_secondary_menu; ?> <?php echo $bre_secondary_menu_transparent; ?> secondary-menu-bs">
			<div class="navbar-inner">
				<div class="container">
					<?php wp_nav_menu( array( 
						'theme_location' => 'secondary-menu', 
						'menu_class' => 'nav',
						'container_class' => 'nav-collapse-secondary nav-collapse collapse',
					) ); ?>
				</div>
			</div>
		</div><!-- navbar -->
<?php $bre_carousel_hide = get_option( 'bre_carousel_hide', false );

if ( ! $bre_carousel_hide && ( is_front_page() || is_page_template( 'page-templates/full-width-carousel.php' ) ) ) : ?>
		<script type="text/javascript">
		jQuery( function() {
			jQuery( '#template-carousel' ).carousel( {
				interval: 8000
			} );
		} );
		</script>

	<?php $carousel_args = array(
		'post_type' => get_post_types( array( 'public' => true ) ),
		'posts_per_page' => -1,
		'post_status' => 'publish',
		'order' => 'DESC',
		'meta_query' => array(
			array(
				'key' => 'bre_add_to_home_carousel',
				'value' => true,
				'compare' => '=',
			),
		),
		'fields' => 'ids'
	);
	$carousel_posts = get_posts( $carousel_args );
	//If not post to show in the carrousel, the last 5 posts will be loaded
	if ( is_array( $carousel_posts ) && count( $carousel_posts ) == 0 ) $carousel_posts = get_posts( array( 'fields' => 'ids' ) );?>
<?php endif ?>

	</div><!-- page-top -->

</div><!-- page-top-wrapper -->

<div id="page" class="hfeed site">
	<div class="bse-container">


<?php if ( is_front_page() ) :
	if ( ! get_option( 'bre_hide_home_shortcuts', false ) ) bre_the_three_boxes() ?>
<?php endif; ?>

		<div id="main" class="row-fluid">
