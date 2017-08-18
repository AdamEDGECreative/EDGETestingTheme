<?php
/**
 * Registers and queues the stylesheets that the theme requires.
 *
 */

define("CSS_DIRECTORY", get_template_directory_uri()."/public/css/");


add_action("wp_enqueue_scripts", "enqueue_theme_stylesheets");

function enqueue_theme_stylesheets() {
	global $post;
	
	if( !is_admin() ) {	
		// Load default theme stylesheet
		wp_register_style("theme_css", CSS_DIRECTORY."style.min.css", false);
		wp_enqueue_style("theme_css");
	}
}
