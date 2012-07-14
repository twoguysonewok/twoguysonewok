<div id="<?php echo $this->token . '-' . $k; ?>" class="widgets-holder-wrap">
		<h3 class="section-title"><?php echo esc_html( $this->model->sections[$k]['name'] ); ?> <span id="removing-widget"><?php _e( 'Deactivate', 'woodojo' ); ?><span></span></span></h3>
		<?php if ( isset( $this->model->sections[$k]['description'] ) ) { ?><p class="description"><?php echo esc_html( $this->model->sections[$k]['description'] ); ?></p><?php } ?>
		<div id="module-list">
		<?php
			$count = 0;
			foreach ( $v as $i => $j ) {
				$count++;
				include( $this->model->config->screens_path . 'main/component-item.php' );
				if($count == 3) {
					echo('<br class="clear" />');
					$count = 0;
				}
			}
		?>
		<div class="clear"></div>
		</div>
	<br class="clear" />
</div><!--/#modules-->