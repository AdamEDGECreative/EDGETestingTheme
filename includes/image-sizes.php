<?php

/**
 * Add custom image crops to WordPress.
 */
add_filter( 'init', 'wp_add_image_sizes' );
function wp_add_image_sizes () {
  // Set medium & large to non-proportional crop
  update_option("medium_crop", "1");
  update_option("large_crop", "1");

  // Add other images
  $image_sizes = array(
    // array (
    //   'name' => 'SIZE_NAME',
    //   'width' => 1600,
    //   'height' => 900,
    //   'crop' => true
    // )
  );

  foreach ($image_sizes as $size) {
    add_image_size( 
      $size['name'],
      $size['width'],
      $size['height'],
      $size['crop']
    );
  }
}
