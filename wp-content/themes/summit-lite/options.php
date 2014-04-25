<?php
/**
 * A unique identifier is defined to store the options in the database and reference them from the theme.
 * By default it uses the theme name, in lowercase and without spaces, but this can be changed if needed.
 * If the identifier changes, it'll appear as if the options have been reset.
 */

function summit_optionsframework_option_name() {

	// This gets the theme name from the stylesheet
	$themename = wp_get_theme();
	$themename = preg_replace("/\W/", "_", strtolower($themename) );

	$summit_optionsframework_settings = get_option( 'summit_optionsframework' );
	$summit_optionsframework_settings['id'] = $themename;
	update_option( 'summit_optionsframework', $summit_optionsframework_settings );
}

/**
 * Defines an array of options that will be used to generate the settings page and be saved in the database.
 * When creating the 'id' fields, make sure to use all lowercase and no spaces.
 *
 * If you are making your theme translatable, you should replace 'options_framework_theme'
 * with the actual text domain for your theme.  Read more:
 * http://codex.wordpress.org/Function_Reference/load_theme_textdomain
 */

function summit_optionsframework_options() {

	// Single Header Options
	$simple_header = array(
		'1' => __('Yes', 'options_framework_theme'),
		'0' => __('No', 'options_framework_theme')
	);

	// Social Widget Options
	$social_widget_options = array(
		'one' => __('Yes', 'options_framework_theme'),
		'two' => __('No', 'options_framework_theme')
	);

	// Multicheck Array
	$multicheck_array = array(
		'one' => __('French Toast', 'options_framework_theme'),
		'two' => __('Pancake', 'options_framework_theme'),
		'three' => __('Omelette', 'options_framework_theme'),
		'four' => __('Crepe', 'options_framework_theme'),
		'five' => __('Waffle', 'options_framework_theme')
	);

	// Multicheck Defaults
	$multicheck_defaults = array(
		'one' => '1',
		'five' => '1'
	);

	// Background Defaults
	$background_defaults = array(
		'color' => '',
		'image' => '',
		'repeat' => 'repeat',
		'position' => 'top center',
		'attachment'=>'scroll' );

	// Typography Defaults : Headers
	$typography_defaults_headers = array(
		'size' => false,
		'face' => false,
		'style' => false,
		'color' => '#444' );

	// Typography Options : Headers
	$typography_options_headers = array(
		'sizes' => false,
		'faces' => false,
		'styles' => false,
		'color' => true
	);

	// Typography Defaults : Body
	$typography_defaults_body = array(
		'size' => '14px',
		'face' => false,
		'style' => false,
		'color' => '#444' );
		
	// Typography Options
	$typography_options_body = array(
		'sizes' => array( '11','12','14','16','20' ),
		'faces' => false,
		'styles' => false,
		'color' => true
	);

	// Pull all the categories into an array
	$options_categories = array();
	$options_categories_obj = get_categories();
	foreach ($options_categories_obj as $category) {
		$options_categories[$category->cat_ID] = $category->cat_name;
	}
	
	// Pull all tags into an array
	$options_tags = array();
	$options_tags_obj = get_tags();
	foreach ( $options_tags_obj as $tag ) {
		$options_tags[$tag->term_id] = $tag->name;
	}


	// Pull all the pages into an array
	$options_pages = array();
	$options_pages_obj = get_pages('sort_column=post_parent,menu_order');
	$options_pages[''] = 'Select a page:';
	foreach ($options_pages_obj as $page) {
		$options_pages[$page->ID] = $page->post_title;
	}

	// If using image radio buttons, define a directory path
	$imagepath =  get_template_directory_uri() . '/img/';

	$options = array();


	// TAB: Basic Settings
	$options[] = array(
		'name' => __('Basic Theme Settings', 'options_framework_theme'),
		'type' => 'heading');

	// Custom Header Image
	$options[] = array(     
		'name' => __('Upload a Custom Header Image', 'options_framework_theme'),     
		'desc' => __('Header images are suggested to be exactly <strong>1200px wide</strong> by <strong>280px high</strong>. However, images under 1200px wide will stretch to fill, and images higher then 280px will not be cut off.', 'options_framework_theme'),     
		'id' => 'custom_header', 
		'type' => 'upload');

	// Show Header Text? 
	$options[] = array(
		'name' => __('Display Header Text?', 'options_framework_theme'),
		'desc' => __('Uncheck to hide header Title and Description.', 'options_framework_theme'),
		'id' => 'header_display',
		'std' => true,
		'type' => 'checkbox');

	// Header Text Color
	$options[] = array(
		'name' => __('Color of Title Text', 'options_framework_theme'),
		'desc' => __('No color selected by default.', 'options_framework_theme'),
		'id' => 'header_color',
		'std' => '#333333',
		'type' => 'color' );

	// TAB: Footer Options
	$options[] = array(
		'name' => __('Footer', 'options_framework_theme'),
		'type' => 'heading');

	//Footer text             
	$options[] = array(         
		'name' => __('Footer Text', 'options_framework_theme'),         
		'desc' => __('Enter custom footer text.', 'options_framework_theme'),         
		'id' => 'footer_input',                 
		'type' => 'textarea');		

	/**
	 * For $settings options see:
	 * http://codex.wordpress.org/Function_Reference/wp_editor
	 *
	 * 'media_buttons' are not supported as there is no post to attach items to
	 * 'textarea_name' is set by the 'id' you choose
	 */

	// $wp_editor_settings = array(
	// 	'wpautop' => true, // Default
	// 	'textarea_rows' => 5,
	// 	'tinymce' => array( 'plugins' => 'wordpress' )
	// );
	
	// $options[] = array(
	// 	'name' => __('Default Text Editor', 'options_framework_theme'),
	// 	'desc' => sprintf( __( 'You can also pass settings to the editor.  Read more about wp_editor in <a href="%1$s" target="_blank">the WordPress codex</a>', 'options_framework_theme' ), 'http://codex.wordpress.org/Function_Reference/wp_editor' ),
	// 	'id' => 'example_editor',
	// 	'type' => 'editor',
	// 	'settings' => $wp_editor_settings );

	return $options;
}