<?php
/** This will be the name of the Archive Page Template **/
/** We have to remove the default Genesis loop, and add our Custom loop **/
//remove_action('genesis_loop','genesis_do_loop');
//add_action( 'genesis_loop', 'wdm_do_custom_loop' );

function wdm_do_custom_loop() {
	$catquery = new WP_Query( 'cat=21&posts_per_page=4&post_type=sponsor' ); ?>
<ul class="sponsorlist">
<?php while($catquery->have_posts()) : $catquery->the_post(); ?>
<li>
	<div>
	<a href="<?php echo get_post_meta(get_the_ID(), 'link', true); ?>" rel="nofollow" target="_blank"><?php the_post_thumbnail( 'thumbnail' ); ?></a>
	<h6><?php the_title(); ?></h6>
</div>
</li>
<?php endwhile; ?> 
</ul>
<?php wp_reset_postdata(); 
}
?>
<?php
remove_action( 'genesis_entry_header', 'genesis_entry_header_markup_open', 5 );
remove_action( 'genesis_entry_header', 'genesis_entry_header_markup_close', 15 );
remove_action( 'genesis_entry_header', 'genesis_post_info', 12 );
remove_action( 'genesis_entry_footer', 'genesis_post_meta' );
remove_action( 'genesis_entry_footer', 'genesis_entry_footer_markup_open', 5 );
remove_action( 'genesis_entry_footer', 'genesis_entry_footer_markup_close', 15 );
// remove_action( 'genesis_post_content', 'genesis_do_post_content' );
// remove_action( 'genesis_entry_content', 'genesis_do_post_content' );
 
// add_action( 'genesis_entry_content', 'genesis_page_archive_content' );
// add_action( 'genesis_post_content', 'genesis_page_archive_content' ); 
//function genesis_page_archive_content() { 
remove_action( 'genesis_before_loop', 'genesis_do_cpt_archive_title_description' );

//* Custom output
add_action( 'genesis_before_loop', 'rv_cpt_archive_title_description' );
function rv_cpt_archive_title_description() { 
?>	
	<div class="page-title-sec">
		<h2 class="pg-title">Sponsors</h2>
	    <div class="elementor-image">
			<picture class="attachment-large size-large" loading="lazy">
				<source type="image/webp" srcset="https://vastg.wpengine.com/wp-content/uploads/2020/06/undertitledesign1.png.webp 386w" sizes="(max-width: 386px) 100vw, 386px">
				<img width="386" height="38" src="https://vastg.wpengine.com/wp-content/uploads/2020/06/undertitledesign1.png" alt="" srcset="https://vastg.wpengine.com/wp-content/uploads/2020/06/undertitledesign1.png 386w, https://vastg.wpengine.com/wp-content/uploads/2020/06/undertitledesign1-300x30.png 300w" sizes="(max-width: 386px) 100vw, 386px" loading="lazy">
			</picture>
		</div>
	</div>
	<div class="archive-pg-content">
		<div class='archive-sponsorlist'>
<?php

}

remove_action( 'genesis_after_loop', 'genesis_do_cpt_archive_title_description' );
//* Custom output
add_action( 'genesis_after_loop', 'ssrv_cpt_archive_title_description' );
function ssrv_cpt_archive_title_description() { 
	echo '</div>';
	echo '</div>';
}





remove_action('genesis_entry_content', 'genesis_do_post_content');
add_action( 'genesis_entry_content', 'custom_entry_content' ); // Add custom loop
function custom_entry_content() { 
 echo "<div class='sponsorlist'>";
	//$value = get_post_meta($post->ID, '_sponsorurl_key', true); get_the_ID()
	$value = get_post_meta(get_the_ID(), '_sponsorurl_key', true); 
	if($value !=''){ ?>
		<a href='<?php echo $value; ?>'  target='_blank'>
	<?php }
	else {
		echo "<a href='#'>";
	}
	echo "<div class='sponsorimage'>";
		the_post_thumbnail('full'); 
	echo "</div>";
	echo "<h6>";
		the_title();
	echo "</h6>";
	echo "</a></div>";
}



genesis();
?>
