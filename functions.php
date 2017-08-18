<?php
/**
 * Sets up the theme and provides some helper functions, which are used
 * in the theme as custom template tags. Others are attached to action and
 * filter hooks in WordPress to change core functionality.
 *
 */

function _load_functions( $filename ) {
  require_once 'includes/' . $filename . '.php';
}


show_admin_bar(false);
include_once 'wp-developer-menu.php';

// Assets
_load_functions( 'queue-css' );
_load_functions( 'queue-js' );
_load_functions( 'image-sizes' );

// Filters
_load_functions( 'dom-classes' );
