<?php
/**
 * This file adds the Single Post Template to any Genesis child theme.
 *
 * @author Brad Dalton
 * @link https://wpsites.net/web-design/basic-single-post-template-file-for-genesis-beginners/
 */

//* Add custom body class to the head
// add_filter( 'body_class', 'single_posts_body_class' );
// function single_posts_body_class( $classes ) {

//    $classes[] = 'sponsor-single';
//    return $classes;
   
// }

// remove_action('genesis_entry_content', 'genesis_do_post_content');
// add_action( 'genesis_entry_content', 'custom_entry_content' ); // Add custom loop
// function custom_entry_content() { 
// // echo "Content";
// the_post_thumbnail('large'); 
// the_content();
// }

//* Remove site footer widgets
//remove_action( 'genesis_before_footer', 'genesis_footer_widget_areas' );

//* Run the Genesis loop
//genesis();