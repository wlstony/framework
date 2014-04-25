<?php
/**
 * kotenhanagara functions and definitions
 *
 * @package kotenhanagara
 */
 
 include get_template_directory() . '/extras/adminbar/adminbar.php';

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) )
	$content_width = 640; /* pixels */

/*
 * Load Jetpack compatibility file.
 */
require( get_template_directory() . '/inc/jetpack.php' );

if ( ! function_exists( 'kotenhanagara_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 */
function kotenhanagara_setup() {
	
	add_theme_support('custom-background');
	add_theme_support( 'custom-header' );
	/**
	 * Custom template tags for this theme.
	 */
	require( get_template_directory() . '/inc/template-tags.php' );

	/**
	 * Custom functions that act independently of the theme templates
	 */
	require( get_template_directory() . '/inc/extras.php' );

	/**
	 * Customizer additions
	 */
	require( get_template_directory() . '/inc/customizer.php' );

	/**
	 * Make theme available for translation
	 * Translations can be filed in the /languages/ directory
	 * If you're building a theme based on kotenhanagara, use a find and replace
	 * to change 'kotenhanagara' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'kotenhanagara', get_template_directory() . '/languages' );

	/**
	 * Add default posts and comments RSS feed links to head
	 */
	add_theme_support( 'automatic-feed-links' );

	/**
	 * Enable support for Post Thumbnails on posts and pages
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );

	/**
	 * Enable support for Post Formats
	 */
	add_theme_support( 'post-formats', array( 'aside', 'image', 'video', 'quote', 'link' ) );
	set_post_thumbnail_size( 190, 190, true );
}
endif; // kotenhanagara_setup
add_action( 'after_setup_theme', 'kotenhanagara_setup' );

/**
 * Setup the WordPress core custom background feature.
 *
 * Use add_theme_support to register support for WordPress 3.4+
 * as well as provide backward compatibility for WordPress 3.3
 * using feature detection of wp_get_theme() which was introduced
 * in WordPress 3.4.
 *
 * @todo Remove the 3.3 support when WordPress 3.6 is released.
 *
 * Hooks into the after_setup_theme action.
 */
function kotenhanagara_register_custom_background() {
	$args = array(
		'default-color' => 'ffffff',
		'default-image' => '',
	);

	$args = apply_filters( 'kotenhanagara_custom_background_args', $args );

	if ( function_exists( 'wp_get_theme' ) ) {
		add_theme_support( 'custom-background', $args );
	} 
}
add_action( 'after_setup_theme', 'kotenhanagara_register_custom_background' );

/**
 * Register widgetized area and update sidebar with default widgets
 */
function kotenhanagara_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'kotenhanagara' ),
		'id'            => 'sidebar-1',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
	register_sidebar(array(
		'name'          => __( 'Facebook', 'kotenhanagara' ),
		'description' => 'Facebook',
		'before_widget' => '<li><a href="',
		'after_widget'  => '" target="_blank"><img src="'.get_bloginfo('stylesheet_directory').'/images/ico_social01.png" alt="Facebook" /></a></li>',
		));
	register_sidebar(array(
		'name'          => __( 'Twitter', 'kotenhanagara' ),
		'description' => 'Twitter',
		'before_widget' => '<li><a href="',
		'after_widget'  => '" target="_blank"><img src="'.get_bloginfo('stylesheet_directory').'/images/ico_social02.png" alt="Twitter" /></a></li>',
		));
	register_sidebar(array(
		'name'          => __( 'Tumblr', 'kotenhanagara' ),
		'description' => 'Tumblr',
		'before_widget' => '<li><a href="',
		'after_widget'  => '" target="_blank"><img src="'.get_bloginfo('stylesheet_directory').'/images/ico_social03.png" alt="Tumblr" /></a></li>',
		));
	register_sidebar(array(
		'name'          => __( 'Google', 'kotenhanagara' ),
		'description' => 'Google',
		'before_widget' => '<li><a href="',
		'after_widget'  => '" target="_blank"><img src="'.get_bloginfo('stylesheet_directory').'/images/ico_social04.png" alt="Google" /></a></li>',
		));
	register_sidebar(array(
		'name'          => __( 'LinkedIn', 'kotenhanagara' ),
		'description' => 'LinkedIn',
		'before_widget' => '<li><a href="',
		'after_widget'  => '" target="_blank"><img src="'.get_bloginfo('stylesheet_directory').'/images/ico_social05.png" alt="LinkedIn" /></a></li>',
		));
	register_sidebar(array(
		'name'          => __( 'RSS', 'kotenhanagara' ),
		'description' => 'RSS',
		'before_widget' => '<li><a href="',
		'after_widget'  => '" target="_blank"><img src="'.get_bloginfo('stylesheet_directory').'/images/ico_social06.png" alt="RSS" /></a></li>',
		));

	register_sidebar(array(
		'name'          => __( 'Aboutme', 'kotenhanagara' ),
		'description' => 'Aboutme',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
		));
	register_sidebar(array(
		'name'          => __( 'Links', 'kotenhanagara' ),
		'description' => 'Links',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
		));
	register_sidebar(array(
		'name'          => __( 'Contact', 'kotenhanagara' ),
		'description' => 'Contact',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
		));
}

add_action( 'widgets_init', 'kotenhanagara_widgets_init' );

/**
 * Enqueue scripts and styles
 */
function kotenhanagara_scripts() {
	
	wp_enqueue_script( 'script', get_stylesheet_directory_uri() . '/js/script.js' );
	wp_enqueue_script( 'html5', get_stylesheet_directory_uri() . '/js/html5.js' );
	wp_enqueue_style( 'kotenhanagara-style', get_stylesheet_uri() );

	wp_enqueue_script( 'kotenhanagara-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20120206', true );

	wp_enqueue_script( 'kotenhanagara-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	if ( is_singular() && wp_attachment_is_image() ) {
		wp_enqueue_script( 'kotenhanagara-keyboard-image-navigation', get_template_directory_uri() . '/js/keyboard-image-navigation.js', array( 'jquery' ), '20120202' );
	}
}
add_action( 'wp_enqueue_scripts', 'kotenhanagara_scripts' );

function kotenhanagara_new_excerpt_mblength($length) {
     return 30;
}
add_filter('excerpt_mblength', 'kotenhanagara_new_excerpt_mblength');

function kotenhanagara_new_excerpt_more($post) {
	
    return ' ...<a class="readmore" href="'. esc_url( get_permalink() ) . '">' . 'read more' . '</a>';	
}	
add_filter('excerpt_more', 'kotenhanagara_new_excerpt_more');

add_filter( "comment_form_defaults", "kotenhanagara_my_comment_notes_after");

function kotenhanagara_my_comment_notes_after($defaults){
  $defaults['comment_notes_after'] = '';
  return $defaults;
}


add_action('admin_print_styles', 'kotenhanagara_my_admin_print_styles');
function kotenhanagara_my_admin_print_styles() {
  wp_enqueue_style( 'farbtastic' );
}
add_action('admin_print_scripts', 'kotenhanagara_my_admin_print_scripts');
function kotenhanagara_my_admin_print_scripts() {
  wp_enqueue_script( 'farbtastic' );
  wp_enqueue_script( 'quicktags' );
  wp_enqueue_script( 'my-admin-script', get_bloginfo('stylesheet_directory') . '/admin-script.js', array( 'farbtastic', 'quicktags' ), false, true );
}

/*** Link widget ***/

class kotenhanagara_MyWidgetItem extends WP_Widget {
	function kotenhanagara_MyWidgetItem() {
    	parent::WP_Widget(false, $name = 'Social Link');
    }
    function widget($args, $instance) {
        extract( $args );
        $title = apply_filters( 'widget_title', $instance['title'] );
    	?><?php echo $before_widget .$title. $after_widget; ?><?php
    }
    function update($new_instance, $old_instance) {
	$instance = $old_instance;
	$instance['title'] = strip_tags($new_instance['title']);
        return $instance;
    }
    function form($instance) {
        ?>
        <p>
          <label for="<?php echo $this->get_field_id('title'); ?>">
          <?php _e('URL:'); ?>
          </label>
          <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="" />
        </p>
        <?php
    }
}
add_action('widgets_init', create_function('', 'return register_widget("kotenhanagara_MyWidgetItem");'));


/**
 * Implement the Custom Header feature
 */
//require( get_template_directory() . '/inc/custom-header.php' );



/* CUSTOM HEADER AND FOOTER */

/* CUSTOM FUNCTIONS */

add_action('init', 'kotenhanagara_user_custom_header_and_footer');
add_action('admin_menu', 'kotenhanagara_admin_custom_header_and_footer');

function kotenhanagara_wp_add_custom_header_style() {
	do_action('kotenhanagara_wp_add_custom_header_style');
}

function kotenhanagara_wp_add_custom_footer_style () {
	do_action('kotenhanagara_wp_add_custom_footer_style');
}

function kotenhanagara_user_custom_header_and_footer() {
	add_action('kotenhanagara_wp_add_custom_footer_style', 'kotenhanagara_fc_text_inputreal');
	remove_filter( 'wp_footer', 'strip_tags' );

	// hook for header
	add_action('kotenhanagara_wp_add_custom_header_style', 'kotenhanagara_headerthing');
	add_action('kotenhanagara_wp_add_custom_header_style', 'kotenhanagara_fc_custom_css');
	remove_filter( 'wp_head', 'strip_tags' );
}

function kotenhanagara_admin_custom_header_and_footer() {
	// Hook for adding admin menus
$theme_page = add_theme_page(
		__( 'Custom header and footer','Header & Footer' ),   // Name of page
		__( 'Custom header and footer','Header & Footer' ),   // Label in menu
		'edit_theme_options',                    // Capability required
		'custom_handf',                         // Menu slug, used to uniquely identify the page
		'kotenhanagara_fc_settings_page' // Function that renders the options page
	);
	add_action('admin_enqueue_scripts', 'kotenhanagara_fc_farbtastic_script');
}



// Display footer
function kotenhanagara_fc_text_inputreal() {
	if(True == get_option('checkboxhf')) {
        $stylestr = '';
        if(get_option('fc_uplo2')) {
			$stylestr .= 'background-image:'.get_option('fc_uplo2').';';
		}	 
        if(get_option('fc_backgroundpick2')) {
			$stylestr .= 'background-color:'.get_option('fc_backgroundpick2').';';
		}
		if(get_option('fc_textpick2')) {
			$stylestr .= 'color:'.get_option('fc_textpick2').';';
		}
		if($stylestr != '') {
			$stylestr = ' style="'.$stylestr.'"';
		}
		echo $stylestr;
	}
}

// Display header
function kotenhanagara_headerthing() {
	if(True == get_option('checkboxhf')) {
		$stylestr = '';
		if(get_option('fc_uplo1')) {
			$stylestr .= 'background-image:'.get_option('fc_uplo1').';';
		}
		if(get_option('fc_backgroundpick1')) {
			$stylestr .= 'background-color:'.get_option('fc_backgroundpick1').';';
		}
		if(get_option('fc_textpick1')) {
			$stylestr .= 'color:'.get_option('fc_textpick1').';';
		}
		if($stylestr != '') {
			$stylestr = ' style="'.$stylestr.'"';
		}
		echo $stylestr;
	}
}

// custom css support
function kotenhanagara_fc_custom_css() {
 	if(True == get_option('checkboxhf') && get_option('fc_css_get')) {
		echo '<style type="text/css">'.get_option('fc_css_get').'</style>';
	}
}


// kotenhanagara_fc_settings_page() displays the page content for the Header and Footer Commander submenu
function kotenhanagara_fc_settings_page() {

	//must check that the user has the required capability 
	if (!current_user_can('manage_options')) {
		wp_die( __('You do not have sufficient permissions to access this page.') );
	}

	// variables for the field and option names 
	//$fc_text = 'fc_input_text';
	$hidden_field_name = 'fc_submit_hidden';
	//$footer_field_name = 'fc_input_text';
	//$fch_text = 'fch_input_text';
	//$header_field_name = 'fch_input_text';
	$fc_new_bc2 = 'fc_backgroundpick2';
	$fc_new_bc1 = 'fc_backgroundpick1';
	$hidden_name_bc1 = 'fc_background1';
	$hidden_name_bc2 = 'fc_background2';
	$fc_new_tc2 = 'fc_textpick2';
	$fc_new_tc1 = 'fc_textpick1';
	$hidden_name_tc1 = 'fc_text1';
	$hidden_name_tc2 = 'fc_text2';
	$ad_image1 = 'fc_imade1';
	$ad_image2 = 'fc_imade2';
	$fc_new_up1 = 'fc_uplo1';
	$fc_new_up2 = 'fc_uplo2';
	$cssfc_new_val = 'fc_css_get';
	$cssfc_field_name = '$cssfc_fieldget';



	// Read in existing option value from database
	//$fc_val = get_option( $fc_text );
	//$fch_val = get_option( $fch_text );
	$fc_bc2 = get_option( $fc_new_bc2 );
	$fc_bc1 = get_option( $fc_new_bc1 );
	$fc_tc2 = get_option( $fc_new_tc2 );
	$fc_tc1 = get_option( $fc_new_tc1 );
	$fc_upload2 = get_option( $fc_new_up2 );
	$fc_upload1 = get_option( $fc_new_up1 );
	$cssfc_field_val = get_option( $cssfc_new_val );

        
	//checks to see if empty then populates values

	if ($fc_bc2== '') {
		$fc_bc2 = '#fff';
	}
	if ($fc_bc1== '') {
		$fc_bc1 = '#fff';
	}
	if ($fc_tc2== '') {
		$fc_tc2 = '#aaa';
	}
	if ($fc_tc1== '') {
		$fc_tc1 = '#aaa';
	}

	// See if the user has posted us some information
	// If they did, this hidden field will be set to 'Y'

	if( isset($_POST[ $hidden_field_name ]) && $_POST[ $hidden_field_name ] == 'Y' ) {
        // Read their posted value
		//$fc_val = $_POST[ $footer_field_name ];
		//$fch_val = $_POST[ $header_field_name ];
		$fc_bc2 = $_POST[ $hidden_name_bc2 ];
		$fc_bc1 = $_POST[ $hidden_name_bc1 ];
		$fc_tc2 = $_POST[ $hidden_name_tc2 ];
		$fc_tc1 = $_POST[ $hidden_name_tc1 ];
		$fc_upload1 = $_POST[ $ad_image1 ];
		$fc_upload2 = $_POST[ $ad_image2 ];
		$cssfc_field_val = $_POST[ $cssfc_field_name ];
		add_option('checkboxhf', TRUE);
        

        // Save the posted value in the database
		//update_option( $fc_text, $fc_val );  
		//update_option( $fch_text, $fch_val );  
		update_option( $fc_new_bc2, $fc_bc2 );
		update_option( $fc_new_bc1, $fc_bc1 );
		update_option( $fc_new_tc2, $fc_tc2 );
		update_option( $fc_new_tc1, $fc_tc1 );
		update_option( $fc_new_up1, $fc_upload1 );
		update_option( $fc_new_up2, $fc_upload2 );
		update_option( $cssfc_new_val , $cssfc_field_val );
		update_option('checkboxhf', (bool) $_POST["checkboxhf"]);


?>
<div class="updated"><p><strong><?php _e('settings saved.', 'fc-menu' ); ?></strong></p></div>
<?php 
}
	// Now display the settings editing screen
	echo '<div class="wrap">';

	// icon for settings
	echo '<div id="icon-plugins" class="icon32"></div>';

	// header
	echo "<h2>" . __( 'Header and Footer Commander Settings', 'fc-menu' ) . "</h2>";

    // settings form and farbtastic script on click shoot out
?>
<div class="updated"><p><?php _e('Supports HTML tags such as the ( a, img, blockquote, code, em, ul ) etc... Quotes ( " ) are not allowed and do not leave ( Background color ) field blank.', 'fc-menu' ); ?></p></div>
<form name="form1" method="post" action="">
<script type="text/javascript">
jQuery(document).ready(function() {
	jQuery('#colorpicker1').hide();
	jQuery('#colorpicker1').farbtastic("#color1");
	jQuery("#color1").click(function(){
		jQuery('#colorpicker1').slideToggle()
	});
});

jQuery(document).ready(function() {
	jQuery('#colorpicker2').hide();
	jQuery('#colorpicker2').farbtastic("#color2");
	jQuery("#color2").click(function(){
		jQuery('#colorpicker2').slideToggle();
	});
});

jQuery(document).ready(function() {
	jQuery('#colorpicker3').hide();
	jQuery('#colorpicker3').farbtastic("#color3");
	jQuery("#color3").click(function(){
		jQuery('#colorpicker3').slideToggle();
	});
});
                
jQuery(document).ready(function() {
	jQuery('#colorpicker4').hide();
	jQuery('#colorpicker4').farbtastic("#color4");
	jQuery("#color4").click(function(){
		jQuery('#colorpicker4').slideToggle();
	});
});
                 
jQuery(document).ready(function($){
	var custom_uploader;
	$('#upload_image_button1').click(function(e) {
		e.preventDefault();
		//If the uploader object has already been created, reopen the dialog
		if (custom_uploader) {
			custom_uploader.open();
			return;
		}
 
		//Extend the wp.media object
		custom_uploader = wp.media.frames.file_frame = wp.media({
			title: 'Choose Image',
			button: {
				text: 'Choose Image'
			},
			multiple: false
		});
		//When a file is selected, grab the URL and set it as the text field's value
		custom_uploader.on('select', function() {
			attachment = custom_uploader.state().get('selection').first().toJSON();
			$('#upload_image1').val(attachment.url);
		});
		
		//Open the uploader dialog
		custom_uploader.open();
	});
});
                  
jQuery(document).ready(function($){
	var custom_uploader;
	$('#upload_image_button2').click(function(e) {
		e.preventDefault();
		//If the uploader object has already been created, reopen the dialog
		if (custom_uploader) {
			custom_uploader.open();
			return;
		}

		//Extend the wp.media object
		custom_uploader = wp.media.frames.file_frame = wp.media({
			title: 'Choose Image',
			button: {
				text: 'Choose Image'
			},
			multiple: false
		});
 
        //When a file is selected, grab the URL and set it as the text field's value
		custom_uploader.on('select', function() {
			attachment = custom_uploader.state().get('selection').first().toJSON();
			$('#upload_image2').val(attachment.url);
		});

		//Open the uploader dialog
		custom_uploader.open();

    });
});
                  
</script>
<table class="widefat" border="1">
	<tr valign="top">
		<th scope="row" colspan="2" width="33%">Background colors: Click on each field to display the color picker. Click again to close it.</th>
		<td width="33%" rowspan="4">
			<div id="colorpicker1"></div>
			<div id="colorpicker2"></div>
			<div id="colorpicker3"></div>
			<div id="colorpicker4"></div>
		</td>
	</tr>

	<tr valign="top">
		<input type="hidden" name="<?php echo $hidden_field_name; ?>" value="Y">
		<th scope="row">Background color</th>
		<td width="33%"><input type="text" maxlength="7" size="6" value="<?php echo esc_attr( $fc_bc1 ); ?>" name="<?php echo $hidden_name_bc1; ?>" id="color1" /></td>
	</tr>
	<tr valign="top">
		<input type="hidden" name="<?php echo $hidden_field_name; ?>" value="Y">
		<th scope="row">Text color</th>
		<td width="33%"><input type="text" maxlength="7" size="6" value="<?php echo esc_attr( $fc_tc1 ); ?>" name="<?php echo $hidden_name_tc1; ?>" id="color2" /></td>
	</tr>
	<tr valign="top">
		<input type="hidden" name="<?php echo $hidden_field_name; ?>" value="Y">
		<th scope="row">Choose Image</th>
		<td><label for="upload_image">
		<input id="upload_image1" type="text" size="36" name="<?php echo $ad_image1; ?>" value="<?php echo $fc_upload1; ?>" /> 
		<input id="upload_image_button1" class="button" type="button" value="Upload Image" />
		<br />Enter an URL, upload or select an existing image for the banner.
		</label></td>
	</tr>
	<tr valign="top">
		<th scope="row" ></th>
		<td width="33%" ></td>
	</tr>
	<tr valign="top">
		<input type="hidden" name="<?php echo $hidden_field_name; ?>" value="Y">
		<th scope="row">Background color</th>
		<td width="33%"><input type="text" maxlength="7" size="6" value="<?php echo esc_attr( $fc_bc2 ); ?>" name="<?php echo $hidden_name_bc2; ?>" id="color3" /></td>
	</tr>
	<tr valign="top">
		<input type="hidden" name="<?php echo $hidden_field_name; ?>" value="Y">
		<th scope="row">Text color</th>
		<td width="33%"><input type="text" maxlength="7" size="6" value="<?php echo esc_attr( $fc_tc2 ); ?>" name="<?php echo $hidden_name_tc2; ?>" id="color4" /></td>
	</tr>
	<tr valign="top">
		<input type="hidden" name="<?php echo $hidden_field_name; ?>" value="Y">
		<th scope="row">Choose Image</th>
		<td><label for="upload_image">
		<input id="upload_image2" type="text" size="36" name="<?php echo $ad_image2; ?>" value="<?php echo $fc_upload2; ?>" /> 
		<input id="upload_image_button2" class="button" type="button" value="Upload Image" />
		<br />Enter an URL, upload or select an existing image for the banner.
		</label></td>
	</tr>
	<tr valign="top">
		<input type="hidden" name="<?php echo $hidden_field_name; ?>" value="Y">
		<th width="33%"><?php _e("Custom CSS: ", 'fc-menu' ); ?> </th>
		<td width="70%"><textarea name="<?php echo $cssfc_field_name; ?>" style="height:200px;width:80%;"><?php echo $cssfc_field_val; ?></textarea></td>
	</tr>
	<tr valign="top">
		<input type="hidden" name="<?php echo $hidden_field_name; ?>" value="Y">
		<td width="33%"><?php _e("Check to Enable Both Options: ", 'fc-menu' ); ?>
		<input type="checkbox" name="checkboxhf" value="checkbox" <?php if (get_option('checkboxhf')) echo "checked='checked'"; ?>/></td>
		<td width="33%"><?php submit_button(); ?></td>
	</tr>
</table>
</form>
<?php }
// Include WordPress color picker functionality
function kotenhanagara_fc_farbtastic_script($hook) {
	// only enqueue farbtastic on the plugin settings page
	if( $hook != 'appearance_page_custom_handf' ) { 
		return;
	}
	// load the style and script for farbtastic
	wp_enqueue_style( 'farbtastic' );
	wp_enqueue_script( 'farbtastic' );

}

