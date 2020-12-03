<?php

/**
 * Infinity Pro.
 *
 * This file adds the team page template to the Infinity Pro Theme.
 *
 * Template Name: Cast Achive Page
 *
 * @package Infinity
 * @author  StudioPress
 * @license GPL-2.0+
 * @link	http://my.studiopress.com/themes/infinity/
 */
remove_action('genesis_loop', 'genesis_do_loop');
// Add team page body class to the head.
add_filter( 'body_class', 'infinity_add_body_class' );
function infinity_add_body_class( $classes ) {

	$classes[] = 'cast-page';

	return $classes;

}

// Conditionally remove loop.
add_action( 'genesis_before', 'infinity_conditionally_remove_loop' );
function infinity_conditionally_remove_loop () {

	if ( get_query_var( 'paged' ) >= 2 ) {
		remove_action('genesis_loop', 'genesis_do_loop');
	}

}

// Force full width content layout.
add_filter( 'genesis_site_layout', '__genesis_return_full_width_content' );

// Add our custom loop.
add_action( 'genesis_loop', 'infinity_team_loop' );
function infinity_team_loop() {

	global $post;

	$args = array(
		// 'post_parent'    => $post->ID,
		'order'          => 'ASC',
		'orderby'        => 'menu_order',
		'post_type'      => 'cast',
		'posts_per_page' => 8,
		'paged'          => get_query_var( 'paged' ),
	);

	global $wp_query;

	$loop = new WP_Query( $args );

	// Remove actions on entry.
	$hooks = array(
		'genesis_before_entry',
		'genesis_entry_header',
		'genesis_before_entry_content',
		'genesis_entry_content',
		'genesis_after_entry_content',
		'genesis_entry_footer',
		'genesis_after_entry',
	);

	foreach ( $hooks as $hook ) {
		remove_all_actions( $hook );
	}

	// Setup the team entry actions.
	add_filter( 'post_class' , 'infinity_team_class' );
	add_action( 'genesis_entry_content', 'infinity_page_team_image' );
	add_action( 'genesis_after_entry_content', 'genesis_entry_header_markup_open' , 5 );
	add_action( 'genesis_after_entry_content', 'genesis_entry_header_markup_close', 15 );
	add_action( 'genesis_after_entry_content', 'genesis_do_post_title' );
	add_action( 'genesis_after_entry_content', 'infinity_team_title' );

	if( !isset( $query_args ) ) {
		$query_args = array();
	}

	genesis_custom_loop( wp_parse_args( $query_args, $args ) );

	remove_filter( 'post_class' , 'infinity_team_class' );

}

// Add team member featured image.
function infinity_page_team_image() {

	$image = genesis_get_image( array(
		'format' => 'html',
		'size'   => 'team-member',
		'attr'   => array ( 'alt' => the_title_attribute( 'echo=0' ) ),
	) );

	if ( $image ) {
		printf( '<a href="%s" rel="bookmark">%s</a>', get_permalink(), $image );
	}

}

// Add team title field.
function infinity_team_title() {

	$title = '';

	if ( genesis_get_custom_field( 'team_title' ) ) {
		$title = '<p class="team-title">' . genesis_get_custom_field( 'team_title' ) . '</p>';
	}

	echo $title;

}

// Add one-fourth class to the page team entry.
function infinity_team_class( $classes ) {

	global $wp_query;

	$classes[] = 'one-third';

	if( 0 == $wp_query->current_post % 3 ) {
		$classes[] = 'first';
	}

	return $classes;

}

get_header();
?>
<div class="content-sidebar-wrap">
<main class="content" id="genesis-content">
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
  <div class="gtco-testimonials">
    <h2 class="pg-title">THE CAST</h2>
    <div class="elementor-image">
		<picture class="attachment-large size-large" loading="lazy">
			<source type="image/webp" srcset="https://vastg.wpengine.com/wp-content/uploads/2020/06/undertitledesign1.png.webp 386w" sizes="(max-width: 386px) 100vw, 386px">
			<img width="386" height="38" src="https://vastg.wpengine.com/wp-content/uploads/2020/06/undertitledesign1.png" alt="" srcset="https://vastg.wpengine.com/wp-content/uploads/2020/06/undertitledesign1.png 386w, https://vastg.wpengine.com/wp-content/uploads/2020/06/undertitledesign1-300x30.png 300w" sizes="(max-width: 386px) 100vw, 386px" loading="lazy">
		</picture>
	</div>
	<div class="page-content">
		<p>Excepteur sint occaecat cupidatat non proident, sunt in culpa qui
officia deserunt</p>
	</div>
	
	
	
    <div class="owl-carousel owl-carousel1 owl-theme">
    	<?php
    	$args = array(
		    'post_type'=> 'cast',
		    'order'    => 'ASC',
		    'post_status' => 'publish',
    		'posts_per_page' => -1
		);  
		$the_query = new WP_Query( $args );
		if($the_query->have_posts() ) : 
		    while ( $the_query->have_posts() ) : 
		       $the_query->the_post(); 
		       // content goes here		  
		?>
		    	<div>
					<div class="card text-center"> <a href="<?php echo get_post_permalink(); ?>"><img class="card-img-top" src="<?php echo get_the_post_thumbnail_url(); ?>" alt=""></a>
			          <div class="card-body">
			            <h5><?php the_title(); ?> </h5>
			            <div class="card-text"><?php the_excerpt(); //the_content(); ?></div>
			            <a href="<?php echo get_post_permalink(); ?>" class="readmore">Read more</a>
			          </div>
			        </div>
			    </div> 
					        

		   <?php 
		endwhile; 
		    wp_reset_postdata(); 
		else: 
		endif;
		wp_reset_query();
		?>
    </div>
    
    
    <div class="archive-cast-featuredsec">
	    <?php
    	$args = array(
		    'post_type'=> 'cast',
		    'order'    => 'ASC',
		    'post_status' => 'publish',
    		'posts_per_page' => -1
		);  
		$the_query = new WP_Query( $args );
		if($the_query->have_posts() ) : 
		    while ( $the_query->have_posts() ) : 
		       $the_query->the_post(); 
		       // content goes here		  
		?>
		   
		<div class="archive-cast-featuredsec-inner">				
		        <div class="cast text-center"><img class="cast-img-top" src="<?php echo get_the_post_thumbnail_url(); ?>" alt="">
		          <div class="cast-body">
		            <h5><?php the_title(); ?> </h5>
		            <div class="cast-text"><?php the_excerpt(); //the_content(); ?></div>
		            <a href="<?php echo get_post_permalink(); ?>" class="readmore">Read more</a>
		          </div>
		        </div>					
		    </div> 
		
		   <?php 
		endwhile; 
		    wp_reset_postdata(); 
		else: 
		endif;
		//wp_reset_query();
		?>
	</div>

    
    
  </div>
</article>

<div class="cast-cust-grid-sec">
<?php echo do_shortcode('[elementor-template id="1617"]');?>
</div>
</main>
</div>
<script type="text/javascript">
	(function () {
  "use strict";

  var carousels = function () {
    jQuery(".owl-carousel1").owlCarousel({
      loop: true,
      center: true,
      margin: 0,
      autoplay:true,
        autoplayTimeout:5000,
        autoplayHoverPause:true,
	 // autoWidth:true,
      responsiveClass: true,
      navigation : true,
      navText:["<div class='nav-btn prev-slide'><span aria-label='Previous'>‹</span></div>","<div class='nav-btn next-slide'><span aria-label='Next'>›</span></div>"], 
    smartSpeed: 1000,
      responsive: {
        0: {
          items: 1,
         nav: true
        },
        600: {
          items: 2,
          nav: true
        },
        767: {
          items: 3,
          nav: true
        },
        1000: {
          items: 3,
          nav: true
        }
      }
    });
  };

  (function (jQuery) {
    carousels();
  })(jQuery);
})();


</script>
<?php
get_footer();
