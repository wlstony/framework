<?php

function summit_setup() {
  // Menu Setup
  add_theme_support( 'menus' );

  register_nav_menu( 'primary_nav', 'Primary Navigation');

  // Add Post Formats
  add_theme_support( 'post-formats', array( 'aside','status','video','audio','image', 'link', 'quote' ) );

  // Theme Background Defaults \\
  $defaults = array(
    'default-color'          => '',
    'default-image'          => '',
    'wp-head-callback'       => '_custom_background_cb',
    'admin-head-callback'    => '',
    'admin-preview-callback' => ''
  );

  add_theme_support( 'custom-background', $defaults );

  // Theme Post Thumbnails \\
  add_theme_support( 'post-thumbnails' );
}

add_action( 'after_setup_theme', 'summit_setup' );

add_action( 'widgets_init', function(){
    // Register Sidebar for Theme
    register_sidebar(array(
      'name' => 'Sidebar',
      'id' => 'right-sidebar',
      'description' => 'Widgets in this area will be shown on the main sidebar.',
      'before_widget' => '<div id="%1$s" class="widget %2$s">',
      'after_widget'  => '</div>',
      'before_title' => '<h3>',
      'after_title' => '</h3>'
    ));
});

// Add Scripts
function summit_scripts() {
  // jQuery
  wp_enqueue_script('jquery');
  // Theme Scripts
  wp_enqueue_script(
    'custom-script',
    get_template_directory_uri() . '/js/scripts.js',
    array( 'jquery' )
  );
  // Bootstrap Scripts
  wp_enqueue_script(
    'bootstrap',
    get_template_directory_uri() . '/js/bootstrap.min.js',
    array( 'jquery' )
  );
}

add_action( 'wp_enqueue_scripts', 'summit_scripts' );

// Add Styles 
function summit_styles()  
{ 
  // Register the style like this for a theme:  
  // (First the unique name for the style (custom-style) then the src, 
  // then dependencies and ver no. and media type)
  wp_register_style( 'bootstrap',
    get_template_directory_uri() . '/css/bootstrap.min.css' );
  wp_register_style( 'glyphicons', 
    get_template_directory_uri() . '/css/bootstrap-glyphicons.css' );
  wp_register_style( 'theme-stylesheet', 
    get_template_directory_uri() . '/style.css' );
  wp_register_style( 'google-font',
    'http://fonts.googleapis.com/css?family=Lora:400,700,400italic' );

  // enqueing:
  wp_enqueue_style( 'bootstrap' );
  wp_enqueue_style( 'glyphicons' );
  wp_enqueue_style( 'theme-stylesheet' );
  wp_enqueue_style( 'google-font' );
}
add_action('wp_enqueue_scripts', 'summit_styles');

// Add Editor Style 
function summit_add_editor_styles() {
    add_editor_style( 'editor-style.css' );
}
add_action( 'init', 'summit_add_editor_styles' );

// Add Theme Comments
require_once( dirname( __FILE__ ) . '/inc/template-tags.php' );
function summit_queue_js() {
if ( (!is_admin()) && is_singular() && comments_open() && get_option('thread_comments') )
  wp_enqueue_script( 'comment-reply' );
}
add_action('wp_print_scripts', 'summit_queue_js');

// Add function for bottom of content navigation \\
function summit_content_nav( $html_id ) {
  global $wp_query;
  $html_id = esc_attr( $html_id );

  if ( $wp_query->max_num_pages > 1 ) : ?>
    <nav id="<?php echo $html_id; ?>" class="nav-below" role="navigation">
      <div class="nav-previous alignleft"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts' ) ); ?></div>
      <div class="nav-next alignright"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>' ) ); ?></div>
    </nav><!-- #<?php echo $html_id; ?> .navigation -->
  <?php endif;
}

function summit_filter_ptags_on_images($content){
   return preg_replace('/<p>\s*(<a .*>)?\s*(<img .* \/>)\s*(<\/a>)?\s*<\/p>/iU', '\1\2\3', $content);
}

add_filter('the_content', 'summit_filter_ptags_on_images');

// Custom Excerpt \\
function summit_excerpt_more( $more ) {
	return '<br/><a href="'. get_permalink( get_the_ID() ) . '">Read more &rarr;</a>';
}

add_filter('excerpt_more', 'summit_excerpt_more');

// Create the Options Page \\
function summit_add_admin() {
    global $themename, $shortname, $options;

    if ( $_GET['page'] == basename(__FILE__) ) {
        if ( 'save' == $_REQUEST['action'] ) {
            foreach ($options as $value) {
	            update_option( $value['id'], $_REQUEST[ $value['id'] ] ); }
            foreach ($options as $value) {
                if( isset( $_REQUEST[ $value['id'] ] ) ) { update_option( $value['id'], $_REQUEST[ $value['id'] ]  ); } else { delete_option( $value['id'] ); } }
    	    header("Location: themes.php?page=theme-options.php&saved=true");
            die;
        } else if( 'reset' == $_REQUEST['action'] ) {
            foreach ($options as $value) {
                delete_option( $value['id'] ); }
            header("Location: themes.php?page=theme-options.php&reset=true");
            die;
        } else if ( 'reset_widgets' == $_REQUEST['action'] ) {
            $null = null;
            update_option('sidebars_widgets',$null);
            header("Location: themes.php?page=theme-options.php&reset=true");
            die;
        }
    }

    add_theme_page($themename." Options", "Summit Options", 'edit_themes', basename(__FILE__), 'summit_admin');
}

function summit_admin() {
    global $themename, $shortname, $options;

    if ( $_REQUEST['saved'] ) echo '<div id="message" class="updated fade"><p><strong>'.$themename.' '.__('settings saved.','thematic').'</strong></p></div>';
    if ( $_REQUEST['reset'] ) echo '<div id="message" class="updated fade"><p><strong>'.$themename.' '.__('settings reset.','thematic').'</strong></p></div>';
    if ( $_REQUEST['reset_widgets'] ) echo '<div id="message" class="updated fade"><p><strong>'.$themename.' '.__('widgets reset.','thematic').'</strong></p></div>';
} 

// Options Framework Integration \\ 
define( 'OPTIONS_FRAMEWORK_DIRECTORY', get_template_directory_uri() . '/inc/' );
require_once dirname( __FILE__ ) . '/inc/options-framework.php';

/* 
 * This is an example of how to add custom scripts to the options panel.
 * This one shows/hides the an option when a checkbox is clicked.
 *
 * You can delete it if you not using that option
 */

add_action('summit_optionsframework_custom_scripts', 'summit_optionsframework_custom_scripts');

function summit_optionsframework_custom_scripts() { ?>

<script type="text/javascript">
jQuery(document).ready(function() {

  jQuery('#example_showhidden').click(function() {
      jQuery('#section-example_text_hidden').fadeToggle(400);
  });
  
  if (jQuery('#example_showhidden:checked').val() !== undefined) {
    jQuery('#section-example_text_hidden').show();
  }
  
});
</script>
 
<?php
}

// Wordpress Required Functions
if ( ! isset( $content_width ) )
  $content_width = '100%';
add_theme_support( 'automatic-feed-links' )
?>