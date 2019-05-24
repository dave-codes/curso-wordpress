<?php
/**
 * This template is used to display the login form with [edd_login]
 */
$edd_login_redirect = businesshub_get_global_edd_login_redirect();
if ( ! is_user_logged_in() ) :

	// Show any error messages after form submission
	edd_print_errors(); ?>
	<form id="edd_login_form" class="edd_form" action="" method="post">
		<fieldset>
			<span><legend><?php esc_html_e( 'Log into Your Account', 'easy-digital-downloads' ); ?></legend></span>
			<?php do_action( 'edd_login_fields_before' ); ?>
			<p>
				<label for="edd_user_login"><?php esc_html_e( 'Username', 'easy-digital-downloads' ); ?></label>
				<input name="edd_user_login" id="edd_user_login" class="required edd-input" type="text" title="<?php esc_html_e( 'Username', 'easy-digital-downloads' ); ?>" placeholder="<?php esc_html_e( 'Username', 'easy-digital-downloads' ); ?>"/>
			</p>
			<p>
				<label for="edd_user_pass"><?php esc_html_e( 'Password', 'easy-digital-downloads' ); ?></label>
				<input name="edd_user_pass" id="edd_user_pass" class="password required edd-input" type="password" placeholder="<?php esc_html_e( 'Password', 'easy-digital-downloads' ); ?>"/>
			</p>
			<p>
				<input type="hidden" name="edd_redirect" value="<?php echo esc_url( $edd_login_redirect ); ?>"/>
				<input type="hidden" name="edd_login_nonce" value="<?php echo wp_create_nonce( 'edd-login-nonce' ); ?>"/>
				<input type="hidden" name="edd_action" value="user_login"/>
				<input id="edd_login_submit" type="submit" class="edd_submit" value="<?php esc_html_e( 'Log In', 'easy-digital-downloads' ); ?>"/>
                
                <a href="<?php echo wp_lostpassword_url(); ?>" title="<?php esc_html_e( 'Lost Password', 'easy-digital-downloads' ); ?>" class="edd-lost-password">
					<?php esc_html_e( 'Lost Password?', 'easy-digital-downloads' ); ?>
				</a>
			</p>
			<?php do_action( 'edd_login_fields_after' ); ?>
		</fieldset>
	</form>
<?php else : ?>
	<p class="edd-logged-in"><?php esc_html_e( 'You are already logged in', 'easy-digital-downloads' ); ?></p>
<?php endif; ?>
