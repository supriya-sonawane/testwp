<?php
/**
 * This file adds the Single Post Template to any Genesis child theme.
 *
 * @author Brad Dalton
 * @link https://wpsites.net/web-design/basic-single-post-template-file-for-genesis-beginners/
 */

//* Add custom body class to the head
add_filter( 'body_class', 'single_posts_body_class' );
function single_posts_body_class( $classes ) {

   $classes[] = 'cast-single';
   return $classes;
   
}

remove_action('genesis_entry_content', 'genesis_do_post_content');
add_action( 'genesis_entry_content', 'custom_entry_content' ); // Add custom loop
function custom_entry_content() { 
?>

	<div class="single-post-data">
		<div class="gtco-testimonials">
		        <div class="backpglink"><a href="<?php echo get_site_url(); ?>/cast"><i class="fa fa-arrow-left"></i> Go Back</a></div>
   			<div class="header-data">
   			
				<div class="entry-header">
					<h2 class="pg-title"><?php the_title(); ?> </h2>
				</div>
				<div class="elementor-image">
					<picture class="attachment-large size-large" loading="lazy">
						<source type="image/webp" srcset="https://vastg.wpengine.com/wp-content/uploads/2020/06/undertitledesign1.png.webp 386w" sizes="(max-width: 386px) 100vw, 386px">
						<img width="386" height="38" src="https://vastg.wpengine.com/wp-content/uploads/2020/06/undertitledesign1.png" alt="" srcset="https://vastg.wpengine.com/wp-content/uploads/2020/06/undertitledesign1.png 386w, https://vastg.wpengine.com/wp-content/uploads/2020/06/undertitledesign1-300x30.png 300w" sizes="(max-width: 386px) 100vw, 386px" loading="lazy">
					</picture>
				</div>
			</div>	
	
    		<div class="owl-carousel owl-carousel2 owl-theme">
		    	<?php
		 		 $cpoid = get_the_id();
					$gelimg = get_post_meta( $cpoid, 'vdw_gallery_id', true );
				
					$totimg = count($gelimg);
					//echo wp_get_attachment_image( '325', 'thumbnail', false , '' );
					if($totimg > 0) { 
					foreach ($gelimg as $key => $value) {					   
					   					
				?>
		    	<div>
			        <div class="card text-center">
			        	<?php echo wp_get_attachment_image( $value, 'full', false , '' ); ?>
			        </div>
			    </div> 
				<?php } } ?>
			</div>
  		</div>
		<div class="singlepage-content">
			<div class="content-data">
				<?php
					$poid = get_the_id(); 
					//echo get_the_content() ;
					$post = get_post($poid); // specific post
					$the_content = apply_filters('the_content', $post->post_content);
					if ( !empty($the_content) ) {
					  echo $the_content;
					}
				?>
			</div>
			
		</div>
	</div>

<?php
}

//* Remove site footer widgets
remove_action( 'genesis_before_footer', 'genesis_footer_widget_areas' );

//* Run the Genesis loop
genesis();
