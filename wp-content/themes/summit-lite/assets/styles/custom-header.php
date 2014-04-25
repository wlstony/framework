<?php 
	// Is the Header Image Set? 
	$header_image = of_get_option('custom_header');
    if ( ! empty( $header_image ) ) { ?>
    	<a href="<?php echo home_url(); ?>"><img class="hidden-phone" src="<?php echo $header_image; ?>" alt="<?php bloginfo('name'); ?>"></a>
    	<style type="text/css">
    		header {
    			position: relative;
    		}
    		header img {
    			width: 100%;
    		}
    		header #site-title, header p {
    			position: relative;
    			top: 20px;
    			text-align: center;
    		}
    		.title-container {
    			position: absolute;
    			top: 0;
				width: 100%;
    			display: block;
    			height: auto;
			}
    		@media (min-width: 481px) and (max-width: 767px) {
				.title-container {
					position: relative;
				}
				header #site-title, header p {
					display: block !important;
					top: 0;
				}
				a#site-title, #site-description {
					color: #333 !important;
				}
			}
			@media (max-width: 480px) {
				.title-container {
					position: relative;
				}
				header #site-title, header p {
					display: block !important;
					top: 0;
				}
				header h1 {
					font-size: 2em;
					margin-bottom: 5px;
					margin-top: 10px;
				}
				header p {
					font-size: 1em !important;
				}
				a#site-title, #site-description {
					color: #333 !important;
				}
			}
    	</style>
    <?php } 

    // Is there a logo? 
	$logo_uploader = of_get_option('logo_uploader');
		if ($logo_uploader) { ?>
			<h1 class="offset"><?php bloginfo('name'); ?></h1>
			<a href="<?php home_url(); ?>" class="site-logo-wrapper" title="<?php bloginfo('name'); ?>"><img id="site-logo" src="<?php echo $logo_uploader; ?>" alt="<?php bloginfo('name'); echo " - "; bloginfo('description'); ?>"></a>
		<?php } else { ?>
		<div class="title-container">
			<h1><a id="site-title" title="<?php bloginfo( 'name' ); ?>" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?></a></h1>
			<p id="site-description"><?php bloginfo( 'description' ); ?></p>
		</div>
		<?php } 
	?> 
	<?php 

	// Do we want to show the header text?
    $header_display = of_get_option('header_display');
    if ( $header_display == false ) { ?>
    	<style type="text/css">
    		header #site-title, header #site-description {
    			display: none;
    		}
    	</style>
    <?php } 

    // Is there a Custom Header Color?
    $header_color = of_get_option('header_color');
    if ( ! empty( $header_color ) ) { ?>
		<style type="text/css">
    		header #site-title, a#site-title, #site-description {
    			color: <?php echo $header_color; ?>;
    		}
    	</style>
<?php } ?>