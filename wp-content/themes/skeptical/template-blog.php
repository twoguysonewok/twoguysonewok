<?php
/*
Template Name: Blog
*/
?>
<?php get_header(); ?>
<?php global $woo_options; ?>
<?php $sidebar = $woo_options['woo_sidebar']; ?>

    <!-- #content Starts -->
	<?php woo_content_before(); ?>
    <div id="content" class="col-full">
    
        <!-- #main Starts -->
        <div id="main" <?php if($sidebar  == "true") { ?> class="col-left" <?php }?>>      
                    
		<?php if ( function_exists('yoast_breadcrumb') ) { yoast_breadcrumb('<div id="breadcrumb"><p>','</p></div>'); } ?>
        <?php 
			// WP 3.0 PAGED BUG FIX
			if ( get_query_var('paged') )
				$paged = get_query_var('paged');
			elseif ( get_query_var('page') ) 
				$paged = get_query_var('page');
			else 
				$paged = 1;
			//$paged = (get_query_var('paged')) ? get_query_var('paged') : 1; 
       		 
             query_posts("post_type=post&paged=$paged"); 
        ?>
        <?php if (have_posts()) : $count = 0; ?>
        <?php while (have_posts()) : the_post(); $count++; ?>
                                                                    
            <!-- Post Starts -->
            <div class="post">
            
            	<div class="post-meta col-left">
            	
            		<?php woo_post_meta(); ?>
            	
            	</div><!-- /.meta -->
            	
            	<div class="middle col-left">
                
                	<h2 class="title"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
                	
                	<?php woo_image('width=519&height='.$woo_options['woo_thumb_h'].'&class=thumbnail main-image '); ?> 
                	
                	<div class="entry">
                	    <?php if ( $woo_options['woo_post_content'] == "content" ) the_content(__('Read More...', 'woothemes')); else the_excerpt(); ?>
                	</div>
					
                	<div class="post-more">      
                		<?php if ( $woo_options['woo_post_content'] == "excerpt" ) { ?>
                	    <span class="read-more"><a href="<?php the_permalink() ?>" title="<?php _e('Continue Reading','woothemes'); ?>"><?php _e('Continue Reading','woothemes'); ?></a></span>
                	    <?php } ?>
                	</div>
                	
                </div><!-- /.middle -->
                
                <?php if($sidebar == "false") { $saved = $wp_query; ?>
                
                	<div class="related col-left">
                	
                		<h3><?php _e('More from this category','woothemes'); ?></h3>
                		<?php
                	 	$cats = strip_tags( get_the_category_list(',') ); 
                		$cats = explode(',',$cats);

                		if(!empty($cats)){
                			$cat_ids = array();
                			foreach ($cats as $cat) {
                				$term_data = get_term_by('name', $cat, 'category'); 
                				$cat_ids[] = $term_data->term_id;
                			}
                		}
                		//print_r($cat_ids);
                		$cats = implode(',',$cat_ids);
                		
                		$more_posts = query_posts(array(
                			'posts_per_page' => $woo_options['woo_more_from_count'],
                			'post__not_in' => array(get_the_id()),
                			'category__and' => $cat_ids)
                			);
                		
                		if (have_posts()) :?>
                		<ul><li>
                			<?php
        					while (have_posts()) : the_post(); $count++; ?>
                			<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
                					<span class="related-title"><?php the_title(); ?></span>
                					<span><?php the_time(get_option('date_format')); ?></span>
                			</a>
                			<?php
                			endwhile;
                			?>
                		</li></ul>
                		<?php
                		endif;
                		$wp_query = $saved;
                		?>
                	
                	</div><!-- /.related -->
                	
                <?php } ?>
                
                <div class="fix"></div>
                                     
            </div><!-- /.post -->
                                                
        <?php endwhile; else: ?>
            <div class="post not-found">
                <h2 class="title"><?php _e('Error 404 - Page not found!', 'woothemes') ?></h2>
                <p><?php _e('The page you trying to reach does not exist, or has been moved. Please use the menus or the search box to find what you are looking for.', 'woothemes') ?></p>
            </div><!-- /.post -->
        <?php endif; ?>  
    
            <?php woo_pagenav(); ?>
                
        </div><!-- /#main -->
            
		<?php if($sidebar == "true") { get_sidebar(); } ?>

    </div><!-- /#content -->    
		
<?php get_footer(); ?>