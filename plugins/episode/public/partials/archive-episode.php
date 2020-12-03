<?php
/** This will be the name of the Archive Page Template **/
/** We have to remove the default Genesis loop, and add our Custom loop **/

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
	<div class="page-title-sec episodespg">
		<h2 class="pg-title">Episodes</h2>
	    <div class="elementor-image">
			<picture class="attachment-large size-large" loading="lazy">
				<source type="image/webp" srcset="https://vastg.wpengine.com/wp-content/uploads/2020/06/undertitledesign1.png.webp 386w" sizes="(max-width: 386px) 100vw, 386px">
				<img width="386" height="38" src="https://vastg.wpengine.com/wp-content/uploads/2020/06/undertitledesign1.png" alt="" srcset="https://vastg.wpengine.com/wp-content/uploads/2020/06/undertitledesign1.png 386w, https://vastg.wpengine.com/wp-content/uploads/2020/06/undertitledesign1-300x30.png 300w" sizes="(max-width: 386px) 100vw, 386px" loading="lazy">
			</picture>
		</div>
	</div>
<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
 -->
<div class="main-section">
	<div class="main-slider-section">
		<div class="owl-slider episodeowl-slider">
			<div id="episodecarousel" class="owl-carousel episode_carousel" >
				<?php $args = array(
					    'post_type'=> 'episode',
					    'order'    => 'ASC',
					    'post_status' => 'publish',
					    'posts_per_page' => 2,
						// 'numberposts' => 10
					);  
					$the_query = new WP_Query( $args );
					if($the_query->have_posts() ) : 
					    while ( $the_query->have_posts() ) : 
					       $the_query->the_post(); 
					       // content goes here		  
							$spid = get_the_ID();
							$evalue = get_post_meta($spid, '_episodevid_meta_key', true); 
				?>
					<article class="post-<?php echo $spid;?>">
						<div class="item">
					 		<div class="img-sec">
								<img class="owl-lazy" src="<?php echo get_the_post_thumbnail_url(); ?>" alt="">
							</div>
							<div class="button-sec">
								<button type="button" class="btnicon" data-toggle="modal" data-target="#myModal_<?php echo $spid; ?>"><i class="far fa-play-circle"></i></button>
							</div>
							<div class="epivi-title"><p><?php echo wp_trim_words( get_the_title(), 12, '...' ); //the_title(); ?></p>
							</div>
						</div>
					</article>
				<?php 
					endwhile; 
					    wp_reset_postdata(); 
					else: 
					endif;
					wp_reset_query();

			echo '</div>';
			echo '<div class="hidearticle-section" style="display: none; height: 0; opacity: 0;">';

			}
remove_action( 'genesis_after_loop', 'genesis_do_cpt_archive_title_descriptionss' );
//* Custom output
add_action( 'genesis_after_loop', 'ssrv_cpt_archive_title_descriptionss' );
function ssrv_cpt_archive_title_descriptionss() { 
	echo '</div>';
	echo '</div></div>';
	$args = array(
	    'post_type'=> 'episode',
	    'order'    => 'ASC',
	    'post_status' => 'publish',
		'posts_per_page' => -1
	);  
	$the_query = new WP_Query( $args );
	if($the_query->have_posts() ) : 
	    while ( $the_query->have_posts() ) : 
	       $the_query->the_post(); 
	       // content goes here		  
	$pid = get_the_ID();
?>
<!--  Model -->
	<?php $evalue = get_post_meta($pid, '_episodevid_meta_key', true); ?>
	<div class="modal episodemodel fade" id="myModal_<?php echo $pid; ?>" role="dialog">
	    <div class="modal-dialog">
	      <!-- Modal content-->
	      <div class="modal-content">
	      	<button type="button" class="close" data-dismiss="modal">&times;</button>
	        <!-- <div class="modal-header">
	          <h4 class="modal-title">Modal Header</h4>
	        </div> -->
	        <div class="modal-body">
	          <?php if($evalue !=''){
	          	echo '<iframe width="560" height="315" src="'.$evalue.'" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>';
	          }
	          else {
	          	echo 'Video Not available ';
	          }
	           ?>
	        </div>
	      </div>
	    </div>
  	</div>
	 <!-- End -->
 <?php 
	endwhile; 
	    wp_reset_postdata(); 
	else: 
	endif;
	//wp_reset_query();
?>
<?php if ( is_active_sidebar( 'episodesidebar' ) ) { ?>
    <div id="episodesidebar-main">
        <?php dynamic_sidebar('episodesidebar'); ?>
    </div>
<?php } ?>
<!-- Tab Section -->
<div id="exTab2" class="containerss">
  <div class="panel tab-session-section"> 
    <div class="panel-heading">
      <div class="panel-title">
        <ul class="nav nav-tabs">
        	<?php $cat_args = array(
			    'orderby'       => 'term_id', 
			    'order'         => 'ASC',
			    'hide_empty'    => true, 
			);
			$terms = get_terms('seasons', $cat_args);
			//print_r($terms);
			$tabtitle = 0;
			    foreach($terms as $taxonomy){
			    	$tabtitle++;
			        $term_slug = $taxonomy->slug;
					$term_name = $taxonomy->name;
			?>
          <li class="<?php if($tabtitle == '1') { echo 'active'; } ?>">
            <a href="#<?php echo $tabtitle; ?>" data-toggle="tab"><?php echo $term_name; ?></a>
          </li>
      	<?php }	?>
        </ul>
      </div>
    </div>
    <div class="panel-body">
      <div class="tab-content ">
      	<?php 
      		$tabcat_args = array(
			    'orderby'       => 'term_id', 
			    'order'         => 'ASC',
			    'hide_empty'    => true, 
			);
			$tabterms = get_terms('seasons', $tabcat_args);
			//print_r($terms);
			$tabcon = 0;
		    foreach($tabterms as $tabtaxonomy){
		    	$tabcon++;
		        $tabterm_slug = $tabtaxonomy->slug;
				$tabterm_name = $tabtaxonomy->name;
				?>
				<div class="tab-pane <?php if($tabcon == '1') { echo 'active'; } ?>" id="<?php echo $tabcon; ?>">
					 <div class="tab-pane-inner">
				<?php $tax_post_args = array(
			          'post_type' => 'episode',
			          'posts_per_page' => 999,
			          'order' => 'ASC',
			          'tax_query' => array(
			                array(
			                     'taxonomy' => 'seasons',
			                     'field' => 'slug',
			                     'terms' => $tabterm_slug
			                )
			           )
			    );
			    $tax_post_qry = new WP_Query($tax_post_args);
			    if($tax_post_qry->have_posts()) :
		         while($tax_post_qry->have_posts()) :
		                $tax_post_qry->the_post(); 
		                $tabspid = get_the_ID(); ?>
		                <div class="tabitem">
		                	<div class="tabitem-inner">
		                		<div class="tabimg-view">
							 		<div class="tabimg-sec">
										<img class="owl-lazy" src="<?php echo get_the_post_thumbnail_url(); ?>" alt="">
									</div>
									<div class="tabbutton">
										<!-- <div class="tabbutton-sec"> -->
											<button type="button" class="tabbtnicon" data-toggle="modal" data-target="#tabmyModal_<?php echo $tabspid; ?>"><i class="far fa-play-circle"></i></button>
										<!-- </div> -->
									</div>
								</div>
								<div class="tabs-session-title"><p><?php echo wp_trim_words( get_the_title(), 10, '...' ); 
								//the_title(); ?></p>
								</div>
							</div>
						</div>
		  <?php
          endwhile;
		  else :
		    	 echo '<p>';
		          echo "No posts</p>";
		    endif;

		    echo '</div></div>';
			}		?>
        	
      </div>
    </div>
  </div>
</div>
</div>
<!-- Tab model -->
<?php $tax_post_args = array(
  'post_type' => 'episode',
  'posts_per_page' => 999,
  'order' => 'ASC',
);
$tax_post_qry = new WP_Query($tax_post_args);
if($tax_post_qry->have_posts()) :
 while($tax_post_qry->have_posts()) :
        $tax_post_qry->the_post(); 
        $tabsmodpid = get_the_ID(); ?>

<!--  Model -->
	<?php $tabevalue = get_post_meta($tabsmodpid, '_episodevid_meta_key', true); ?>
	<div class="modal tabepisodemodel fade" id="tabmyModal_<?php echo $tabsmodpid; ?>" role="dialog">
	    <div class="modal-dialog">
	      <!-- Modal content-->
	      <div class="modal-content">
	      	<button type="button" class="close" data-dismiss="modal">&times;</button>
	        <div class="modal-body">
	          <?php if($tabevalue !=''){
	          	echo '<iframe width="560" height="315" src="'.$tabevalue.'" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>';
	          }
	          else {
	          	echo 'Video Not available ';
	          }
	           ?>
	        </div>
	      </div>
	      
	    </div>
  	</div>
	 <!-- End -->

	
<?php
	endwhile;
    else :
    	 echo '<p>';
          echo "No posts</p>";
    endif;
	
?>
<!-- -->


</div>
<!-- Tab section END -->
<script type="text/javascript">
	
jQuery("#episodecarousel").owlCarousel({
	loop: true,
    
    margin: 15, 
    responsiveClass: true,
    navigation : true,
    dots: false,
    nav: true,
    navText:["<div class='nav-btn prev-slide'><span aria-label='Previous'>‹</span></div>","<div class='nav-btn next-slide'><span aria-label='Next'>›</span></div>"], 
    smartSpeed: 1000,
    responsive: {
        0: {
          items: 1,
         nav: true
        },
        600: {
          items: 1,
          nav: true
        },
        767: {
          items: 2,
          nav: true
        },
        1000: {
          items: 3,
          nav: true
        }
      }
});
</script>
<?php  } ?>


<?php 
remove_action('genesis_entry_content', 'genesis_do_post_content');
add_action( 'genesis_entry_content', 'custom_entry_content_episode' ); // Add custom loop
function custom_entry_content_episode() { 
 //echo "Content";
	$spid = get_the_ID();
 ?>
 
<?php } ?>
<?php
genesis();
?>
