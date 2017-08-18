<?php

/**
 * Registers and queues the scripts that the theme requires.
 *
 */

define("JS_DIRECTORY", get_template_directory_uri()."/public/js/");


add_action("wp_enqueue_scripts", "enqueue_theme_scripts");
function enqueue_theme_scripts() {
	global $post, $is_IE;

	if ( !is_admin() ) {
		// Load specific jQuery library
		wp_deregister_script("jquery");
		wp_register_script("jquery", "//ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js", false, false, true);
		wp_enqueue_script("jquery");

		// Load Custom JS
		wp_register_script ("head_js", JS_DIRECTORY."head.min.js", array( 'jquery' ) );
		wp_enqueue_script ("head_js");

		// Dependancies that should load before the footer_js file
		$footer_js_deps = array( 'jquery' );

		// Only load these files if the page was found
		if ( !is_404() ) {

			wp_register_script ("google_maps_api", "https://maps.googleapis.com/maps/api/js?libraries=places&key=AIzaSyCAud800LEZYVqR1J6F7lHUhEYobVH-Bbk", array( 'jquery' ), false, true);
			wp_enqueue_script ("google_maps_api");

			// Dynamically insert the dependancy
			$footer_js_deps[] = 'google_maps_api';

		}
		
		wp_register_script ("footer_js", JS_DIRECTORY."footer.min.js", $footer_js_deps, false, true);
		wp_enqueue_script ("footer_js");

	}
}

/**
 * Load Google Maps script with API key for WordPress admin
 */
add_action("admin_head", "enqueue_admin_scripts", 1);
function enqueue_admin_scripts() {
	?>
	<script src="https://maps.googleapis.com/maps/api/js?libraries=places&key=AIzaSyCAud800LEZYVqR1J6F7lHUhEYobVH-Bbk"></script>
	<?php
}
