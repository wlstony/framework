<?php
/**
 * @package    Alice
 * @version    1.0.0
 * @author     Anand Kumar <anand@blogsynthesis.com>
 * @copyright  Copyright (c) 2013, Anand Kumar
 * @author     Justin Tadlock <justin@justintadlock.com>
 * @copyright  Copyright (c) 2013, Justin Tadlock
 * @link       http://www.blogsynthesis.com/themes/alice
 * @license    http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */

/* Adds the child theme setup function to the 'after_setup_theme' hook. */
add_action( 'after_setup_theme', 'alice_theme_setup', 11 );

function alice_theme_setup() {

        /* Change default background color. */
        add_theme_support( 'custom-background', array( 'default-color' => 'f7f7f7' ) );			
				
        /* Add a custom default color for the "primary" color option. */
        add_filter( 'theme_mod_color_primary', 'alice_color_primary' );
		
		/* Change default custom header */
		add_theme_support( 'custom-header', array ( 'default-image' => '%2$s/images/headers/header.jpg'	) );
		
}

/**
 * Returns a default primary color if there is none set.  We use this instead of setting a default
 * so that child themes can overwrite the default early.
 *
 * @since  1.0.0
 * @param  string  $hex
 * @return string
 */
function alice_color_primary( $hex ) {
	return $hex ? $hex : '1897a0';
}
	
/**/
?>