		<?php get_header();
			if(of_get_option('slider_category')):
		    if ( $paged < 2  && of_get_option('slider_radio', '1')) : ?>
     		<div id="slider" class="nivoSlider">
				<?php
				
					$tmp = $wp_query;
					$cat = of_get_option('slider_category');
					$wp_query = new WP_Query('cat='.$cat.'');
					if(have_posts()) :
					    while(have_posts()) :
					        the_post();
					?>
			    <?php if(wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'nivo-thumb')) { 
                  $image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'nivo-thumb');
                }else {
                  $image[0] = get_template_directory_uri()."/images/nivo-thumb-placeholder.png";
                } 
          ?>
						<a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title(); ?>"><img src="<?php echo $image[0]; ?>" alt="<?php the_title(); ?>" title="#htmlcaption_<?php the_ID(); ?>" width="620" height="300" /></a>

					<?php
						endwhile;
					?>
					<?php endif; ?>
				</div><!-- close #slider -->

					<?php
						if(have_posts()) :
						    while(have_posts()) :
						        the_post();
						?>
						<div id="htmlcaption_<?php the_ID(); ?>"  class="nivo-html-caption">
						    <p><?php the_time( get_option('date_format') ); ?></p>
						    <h2><a href="<?php the_permalink();?>"><?php the_title(); ?></a></h2>
						</div>
	    				<?php
							endwhile;
						?>
						<h3 class="block-title"><?php _e('Newest','delicacy')?></h3>
						<?php endif;
						$wp_query = $tmp;
						?>
				<?php endif; ?>
			<?php endif; ?>
                    <div class="post-list">

					<?php if (have_posts()) : ?>
                    
                    <?php while (have_posts()) : the_post(); ?>

					<div id="post-<?php the_ID(); ?>" <?php post_class('list-post-item'); ?>>						
                        <?php if(of_get_option('hp_settings') == 1 || !of_get_option('hp_settings')) : ?>

						<h2><a href="<?php echo get_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
						<div class="entry-meta"><span class="date"><?php the_time( get_option('date_format') ); ?></span><span class="comments"><?php comments_popup_link(__('No comments','delicacy'), __('1 comment','delicacy'), __('Comments: %','delicacy')); ?></span></div>
						<div class="entry-content">
						<?php the_content(); ?>
						</div>

						<?php elseif (of_get_option('hp_settings') == 2) :?>

						<?php if (  (function_exists('has_post_thumbnail')) && (has_post_thumbnail())  ) { ?>
						<a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_post_thumbnail(); ?></a>
						<?php } ?>
						<h2><a href="<?php echo get_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
						<div class="entry-meta"><span class="date"><?php the_time( get_option('date_format') ); ?></span><span class="comments"><?php comments_popup_link(__('No comments','delicacy'), __('1 comment','delicacy'), __('Comments: %','delicacy')); ?></span></div>
						<div class="entry-content">
						<?php the_excerpt(); ?>
						</div>

						<?php endif; ?>
						
					</div>
					<div class="deco-line"></div>
					<?php endwhile; ?>
						<div class="pagination">
					    <span class="left"><?php next_posts_link('&laquo; '.__('Previous Entries','delicacy')) ?></span> <span class="right"><?php previous_posts_link(__('Next entries','delicacy').' &raquo;') ?></span>
						</div>
					<?php else : ?>
					
								<h2 class="post-title"><?php _e('Not Found','delicacy') ?></h2>

							<?php endif; ?>



					</div><!-- end #post-list -->
				</div><!-- end #content -->
			<?php get_sidebar(); ?>
			</div><!-- end #content-wrapper -->
			<?php get_footer(); ?>
