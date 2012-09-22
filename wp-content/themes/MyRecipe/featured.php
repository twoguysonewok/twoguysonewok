<?php
if(get_theme_option('featured_posts') != '') {
?>
<script type="text/javascript">
/*	function startGallery() {
		var myGallery = new gallery($('myGallery'), {
			timed: true,
			delay: 6000,
			slideInfoZoneOpacity: 0.8,
			showCarousel: false 
		});
	}
	window.addEvent('domready', startGallery);*/
</script>
	<div class="fp-slider clearfix">
    
    <div class="fp-slides-container clearfix">
        
        <div class="fp-slides">		
            	<?php
				$featured_posts_category = get_theme_option('featured_posts_category');
				
				if($featured_posts_category != '' && $featured_posts_category != '0') {
					global $post;

					 $featured_posts = get_posts("numberposts=5&&category=$featured_posts_category");
					 $i = 0;
					 foreach($featured_posts as $post) {
					 	setup_postdata($post);
                        if ( version_compare( $wp_version, '2.9', '>=' ) ) {
                            $slide_image_full = get_the_post_thumbnail($post->ID,'large', array('class' => 'full'));
                            $slide_image_thumbnail = get_the_post_thumbnail($post->ID,'large', array('class' => 'thumbnail'));
                        } else {
                            $get_slide_image = get_post_meta($post->ID, 'featured', true);
                            $slide_image_full = "<img src=\"$get_slide_image\" class=\"full\" alt=\"\" />";
                            $slide_image_thumbnail = "<img src=\"$get_slide_image\" class=\"thumbnail\" alt=\"\" />";
                        }
					 	
					  ?>
			         <div class="fp-slides-items">
                        <div class="fp-thumbnail">
                 			<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" class="open">	<?php echo  $slide_image_full; ?>
						</a> 
						</div>                       
                         <div class="fp-content-wrap">
        						<div class="fp-content">
                                   	<h3 class="fp-title"><?php the_title(); ?></h3>
							<?php the_excerpt(); ?>
							<?php //echo  $slide_image_thumbnail; ?>
						</div>
                        </div>
                        </div>
					 <?php }
				} else {
					for($i = 1; $i <=5; $i++) {
						?>
			         <div class="fp-slides-items">
                        <div class="fp-thumbnail">
                        	<a title="This is default featured slide 5 title" href="#">		<img src="<?php bloginfo('template_directory'); ?>/jdgallery/slides/<?php echo $i; ?>.jpg" class="thumbnail" alt="" /> </a>
					</div>
                    <div class="fp-content-wrap">
        						<div class="fp-content">
                                <h3 class="fp-title">This is featured post <?php echo $i; ?> title</h3>
								<p>You can easy customize the featured slides from the theme options page, on your Wordpress dashboard. You can also disable featured posts slideshow if you don't wish to display them. Dont edit it manually, by replacing images, but you set feature image when you create new posts.</p>
							
							</div>
                            </div>
                            
                            </div>
						<?php
					}
				}
				
				?>
			
		</div>
        
        
             <div class="fp-prev-next-wrap">
                <div class="fp-prev-next">
                    <a href="#fp-next" class="fp-next"></a>
                    <a href="#fp-prev" class="fp-prev"></a>
                </div>
            </div>
     
     <div class="fp-nav">
                <span class="fp-pager">&nbsp;</span>
            </div>  
        
	</div>
</div>
<script>
$j=jQuery.noConflict();
$j(document).ready(function(){
	jQuery('.fp-slides').cycle({
		fx: 'scrollHorz',
		timeout: 4000,
		delay: 0,
		speed: 400,
		next: '.fp-next',
		prev: '.fp-prev',
		pager: '.fp-pager',
		continuous: 0,
		sync: 1,
		pause: 1,
		pauseOnPagerHover: 1,
		cleartype: true,
		cleartypeNoBg: true
	});
 });
</script>

<?php } ?>