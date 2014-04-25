<?php
/**
 * The template for displaying search forms in kotenhanagara
 *
 * @package kotenhanagara
 */
?>
	<form method="get" id="searchform" class="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>" role="search">
		<label for="s" class="screen-reader-text"><?php _ex( 'Search', 'assistive text', 'kotenhanagara' ); ?></label>
		<input type="search" class="field" name="s" value="<?php echo esc_attr( get_search_query() ); ?>" id="s" placeholder="Search" />
		<input type="image" src="<?php echo get_template_directory_uri(); ?>/images/ico_search.png" class="submit" id="searchsubmit" value="<?php echo esc_attr_x( 'Search', 'submit button', 'kotenhanagara' ); ?>" />
	</form>
