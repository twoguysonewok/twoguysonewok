<?php
	$redirect_to = admin_url( 'admin.php?page=' . $this->model->config->token );
	if ( isset( $_REQUEST['redirect_to'] ) ) { $redirect_to = $_REQUEST['redirect_to']; }
?>
<div id="woodojo" class="wrap">
	<div id="icon-dojo" class="icon32"><br></div>
	<h2><?php echo esc_html( $this->name . ' ' . __( 'Login', 'woodojo' ) ); ?></h2>
	<p class="powered-by-woo"><?php _e( 'Powered by', 'woodojo' ); ?><a href="http:www/woothemes.com" title="WooThemes"><img src="<?php echo $this->assets_url; ?>images/woothemes.png" alt="WooThemes" /></a></p>
	<p><?php _e( 'Login with your WooThemes.com account to download additional features within WooDojo. You can use this account to access our public support forums as well.', 'woodojo' ); ?></p>
	<p><?php printf( __( 'If you don\'t have a free WooThemes.com account, %sclick here to register%s.', 'woodojo' ), '<a href="' . esc_url( admin_url( 'admin.php?page=' . $this->model->config->token . '&screen=register' ) ) . '">', '</a>' ); ?></p>
	<form name="<?php echo $this->token; ?>-login" id="<?php echo $this->token; ?>-login" action="" method="post">
		<fieldset>
			<table class="form-table">
				<tbody>
					<tr>
						<th scope="row"><label for="username"><?php _e( 'WooThemes Username', 'woodojo' ); ?>:</label></th>
						<td><input type="text" class="input-text input-woo_user regular-text" name="username" id="woo_user" value="" /></td>
					</tr>
					<tr>
						<th scope="row"><label for="password"><?php _e( 'WooThemes Password', 'woodojo' ); ?>:</label></th>
						<td><input type="password" class="input-text input-woo_pass regular-text" name="password" id="woo_pass" value="" /></td>
					</tr>
				</tbody>
			</table>
		</fieldset>
		
		<fieldset>
			<p class="submit">
				<button type="submit" name="woo_login" id="woo_login" class="button-primary"><?php _e( 'Login', 'woodojo' ); ?></button>
				<a href="<?php echo esc_url( admin_url( 'admin.php?page=' . $this->token . '&screen=register&component=' . $_REQUEST['component'] . '&component_id=' . $_REQUEST['component_id'] . '&redirect_to=' . esc_attr( urlencode( $redirect_to ) ) ) ); ?>"><?php _e( 'Register', 'woodojo' ); ?></a>
			</p>
			<input type="hidden" name="action" value="woodojo-login" />
			<input type="hidden" name="page" value="woodojo" />
			<input type="hidden" name="redirect_to" value="<?php echo esc_attr( $redirect_to ); ?>" />
			<?php if ( isset( $_REQUEST['component'] ) ) { wp_nonce_field( esc_attr( trim( $_REQUEST['component'] ) ) ); } ?>
			<?php if ( isset( $_REQUEST['component_id'] ) ) {?>
			<input type="hidden" name="component_id" value="<?php echo esc_attr( trim( $_REQUEST['component_id'] ) ); ?>" />
			<?php } ?>
		</fieldset>
	</form>
	<br class="clear" />
</div><!--/#woodojo .wrap-->