<?php

// Remove certain classes from the body class.
add_filter( 'body_class', 'wp_remove_body_classes', 10, 2 );
function wp_remove_body_classes( $wp_classes, $extra_classes ) {
  $blacklist = array(
    'error404',
  );

  foreach ($wp_classes as $key => $value) {
    if ( in_array( $value, $blacklist ) ) {
      unset( $wp_classes[ $key ] );
    }
  }

  return array_merge( $wp_classes, (array) $extra_classes );
}

function html_class( $extra_classes ) {
  $html_class = array(
    'no-js'
  );

  if ( is_404() ) {
    $html_class[] = 'error404';
  }

  // Add extra classes
  $html_class = array_merge( $html_class, (array) $extra_classes );

  echo implode( ' ', apply_filters( 'html_class', $html_class ) );
}
