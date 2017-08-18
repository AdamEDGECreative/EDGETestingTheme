<?php
/**
 * The Header for our theme.
 */

/**
 * Rules for <head> tags for best perfomance.
 * Load the attributes in this order:
 *     1) meta and title attributes
 *     2) Stylesheets
 *     3) External JavaScript files (e.g. using src=""). Avoid or add to footer if possible
 *     4) Inline JavaScript
 *
 * Doing it in this order makes sure all of the external resources are loading, 
 * while the browser parses and runs the JavaScript.
 * Otherwise the JavaScript can block the content loading, while it parses
 * @see https://developers.google.com/speed/docs/insights/BlockingJS
 */

?><!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7 no-js" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8 no-js" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) | !(IE 8) ]><!-->
<html class="no-js" <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
  <title><?php trim(wp_title('')); ?></title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta charset="<?php bloginfo( 'charset' ); ?>" />

  <link rel="profile" href="http://gmpg.org/xfn/11" />
  <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
  
  <?php wp_head(); // The theme stylesheet loads here, so follows Rule 2, being above JS ?>

  <?php 
    /**
     * Replace the .no-js class on the <html> element if JS enabled. 
     * This runs in the header because UI may depend on it and we don't want a FOUC.
     * @see https://en.wikipedia.org/wiki/Flash_of_unstyled_content
     *
     * Also minified, as we will not need to modify in the future.
     */
  ?>
  <script type="text/javascript">document.documentElement.className=document.documentElement.className.replace("no-js","js");</script>

  <!--[if IE]>
    <script src="<?php echo get_template_directory_uri() ?>/js/html5shiv.js"></script>
  <![endif]-->
</head>
<body <?php body_class(); ?> >
  
  <?php
    if ( !is_admin() ) {

  
  $start = microtime(true);
  $_old_menu = new WP_Developer_Menu( 'primary_menu' );
  // echo '<pre style="text-align:left;">'; 
  // var_dump( $_old_menu->get_items_for_level(0) ); 
  // echo '</pre>';
  $end = microtime(true);
  echo '<pre style="text-align:left;">'; 
  var_dump( 'Old one runs in', $end-$start ); 
  echo '</pre>';

  $start = microtime(true);
  $_menu_query_args = array( 
    'location' => 'primary_menu',
    'parent' => array( 'type' => 'page', 'id' => 2 ),
    'exclude' => array(
      // Post
      // array( 'type' => 'post', 'id' => 1 ),
      // Page
      // array( 'type' => 'page', 'id' => 2 ),
      // Archive
      // array( 'type' => 'testimonial', 'id' => 'testimonial' ),
      // Single Custom Post
      // array( 'type' => 'testimonial', 'id' => 600 ),
      // Category
      // array( 'type' => 'category', 'id' => 1 ),
      // Custom
      // array( 'type' => 'custom', 'id' => 'http://example.com' ),
    ),
    // 'offset' => 0,
    'limit' => -1,
    'limit_children' => -1,
  );
  $_menu_query = new WP_Menu_Query( $_menu_query_args );
  // $_menu_query->query( $_menu_query_args );

  echo '<pre style="text-align:left;">'; 
  var_dump( $_menu_query->found_items, $_menu_query->have_items() ); 
  echo '</pre>';

  while ( $_menu_query->have_items() ) {
    $item = $_menu_query->the_item();

    echo '<pre style="text-align:left;">'; 
    var_dump( $item->title, $item->url, $item->ID, $item->parent, $item->is_current(), $item->get_child_count() , $item->has_current_child() ); 
    echo '</pre>';

    while( $item->get_children()->have_items() ) {
      $child_item = $item->get_children()->the_item();

      echo '<pre style="text-align:left; margin-left: 40px">'; 
    var_dump( $child_item->title, $child_item->url, $child_item->ID, $child_item->parent, $child_item->is_current(), $child_item->get_child_count() ); 
    echo '</pre>';
    }
  }

  $end = microtime(true);
  echo '<pre style="text-align:left;">'; 
  var_dump( $end - $start ); 
  echo '</pre>';

}
  ?>
    
