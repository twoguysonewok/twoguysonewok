<?php get_header(); ?>

	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
	
    <div id="post-<?php the_ID(); ?>" <?php post_class('one-post'); ?>>
	<h1 class="post-title"><?php the_title(); ?></h1>
	<div class="entry-meta">
		<span class="cat"><?php the_category(', ') ?></span><span class="date"><?php the_time( get_option('date_format') ); ?></span><span class="comments"><?php comments_popup_link(__('No comments','delicacy'), __('1 comment','delicacy'), __('Comments: %','delicacy')); ?></span>
	</div>
	<div class="entry-content">
    	<?php the_content(); ?>
		<div class="recipe">
		    <?php if(get_post_meta($post->ID, "Delicacy_ingredients", true)) { ?>
			<div class="ingredients">
				<h3><?php _e('Ingredients','delicacy'); ?></h3>
				<ul class="ingredient-list">
					<?php
						$get_ingredients = get_post_meta($post->ID, "Delicacy_ingredients", true);
						$ingredients = explode("\r", $get_ingredients);

						foreach($ingredients as $ingredient) {
							echo '<li>' . $ingredient . '</li>';
						}

					?>
				</ul>
				<div class="info">
				<?php
					$diff = array (
						1 => __('easy', 'delicacy'),
						2 => __('medium', 'delicacy'),
						3 => __('hard', 'delicacy'),
					);
				?>
				<ul>
					<?php if(get_post_meta($post->ID, "Delicacy_prep_time", true)) { ?><li><?php _e('Prep time','delicacy'); ?>: <b><?php echo get_post_meta($post->ID, "Delicacy_prep_time", true); ?></b></li><?php } ?>
					<?php if(get_post_meta($post->ID, "Delicacy_cook_time", true)) { ?><li><?php _e('Cook time','delicacy'); ?>: <b><?php echo get_post_meta($post->ID, "Delicacy_cook_time", true); ?></b></li><?php } ?>
					<?php if(get_post_meta($post->ID, "Delicacy_servings", true)) { ?><li><?php _e('Servings','delicacy'); ?>: <b><?php echo get_post_meta($post->ID, "Delicacy_servings", true); ?></b></li><?php } ?>
					<?php if(get_post_meta($post->ID, "Delicacy_difficulty", true)) { ?><li><?php _e('Difficulty','delicacy'); ?>: <b><?php echo $diff[get_post_meta($post->ID, "Delicacy_difficulty", true)]; ?></b></li><?php } ?>
				</ul>
				</div>
			</div>
			<?php } ?>
			<?php if(get_post_meta($post->ID, "Delicacy_recipe", true)) { ?>
			<h3><?php _e('Directions','delicacy'); ?></h3>
				<?php echo get_post_meta($post->ID, "Delicacy_recipe", true); ?>
			<?php } ?>
		</div>
		<div class="clear"></div>
		<?php wp_link_pages( array( 'before' => '<div class="page-link"><span>' . __( 'Pages:', 'delicacy' ) . '</span>', 'after' => '</div>' ) ); ?>
		<p><?php the_tags( __( 'Tagged: ', 'delicacy' ), ', ', ''); ?></p>
    	<?php edit_post_link('Edit this entry','<p>', '</p>'); ?>
	</div>


	<div class="deco-line"></div>
			
	<?php comments_template(); ?>

	</div>

	<?php endwhile; endif; ?>
	
	</div><!-- end #content -->
		<?php get_sidebar(); ?>
</div><!-- end #content-wrapper -->

		<?php get_footer(); ?>