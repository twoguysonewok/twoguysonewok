<?php
	$redirect_to = admin_url( 'admin.php?page=' . $this->model->config->token );
	$args = array();

	$args['component'] = urlencode( $_REQUEST['component'] );
	$args['component-type'] = urlencode( $_REQUEST['component-type'] );

	foreach ( $args as $k => $v ) {
		$redirect_to .= '&' . $k . '=' . $v;
	}


	$payment_url = esc_url( $this->model->get_payment_url() . '&redirect_to=' . urlencode( $redirect_to ) );

	if ( $this->model->load_screen ) {
?>
<div id="woodojo" class="wrap">
	<div id="icon-dojo" class="icon32"><br></div>
	<h2><?php echo esc_html( sprintf( __( 'Purchase %s', 'woodojo' ), $this->model->component->title ) ); ?></h2>
	<p class="powered-by-woo"><?php _e( 'Powered by', 'woodojo' ); ?><a href="http:www/woothemes.com" title="WooThemes"><img src="<?php echo $this->assets_url; ?>images/woothemes.png" alt="WooThemes" /></a></p>
<?php if ( $this->model->has_purchased ) { ?>
<?php
	$download_url = admin_url( 'admin.php?page=' . esc_attr( $this->model->config->token . '&download-component=' . $this->model->component->slug . '&component=' . $this->model->component->slug . '&component-type=' . $this->model->component->type . '&component_id=' . $this->model->component->product_id ) );
?>
	<p><?php printf( __( 'You have already purchased %s. Please %sclick here to download and activate%s.', 'woodojo' ), $this->model->component->title, '<a href="' . $download_url . '">', '</a>' ); ?></p>
	<p><a href="<?php echo esc_url( admin_url( 'admin.php?page=woodojo&purchase-status=return' ) ); ?>" title="<?php esc_attr_e( 'Return to WooDojo', 'woodojo' ); ?>" class="button"><?php _e( '&larr; Return to WooDojo', 'woodojo' ); ?></a></p>
<?php } else { ?>
	<p><?php printf( __( 'If the checkout window doesn\'t open automatically, please %sclick here%s.', 'woodojo' ), '<a href="' . $payment_url . '">', '</a>' ); ?></p>
	<p><a href="<?php echo esc_url( admin_url( 'admin.php?page=woodojo&purchase-status=return' ) ); ?>" title="<?php esc_attr_e( 'Return to WooDojo', 'woodojo' ); ?>" class="button"><?php _e( '&larr; Return to WooDojo', 'woodojo' ); ?></a></p>
	<input type="hidden" name="payment_url" value="<?php echo esc_attr( esc_url( $payment_url ) ); ?>" />
<?php } ?>
	<br class="clear" />
</div><!--/#woodojo .wrap-->
<?php } ?>