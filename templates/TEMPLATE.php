<?php
/**
 * Template Name: TEMPLATE
 * @author EDGE Creative Solutions
 *
 */

get_header();

?>

<?php while( have_posts() ): the_post(); ?>

	HTML
    
<?php endwhile; ?>

<?php get_sidebar(); ?>
<?php get_footer(); ?>