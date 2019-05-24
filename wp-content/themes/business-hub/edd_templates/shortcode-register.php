<?php
/**
 * This template is used to display the registration form with [edd_register]
 */
$edd_register_redirect = businesshub_get_global_edd_register_redirect();

edd_print_errors(); ?>

<form id="edd_register_form" class="edd_form" action="" method="post">
	<?php do_action( 'edd_register_form_fields_top' ); ?>

	<fieldset>
		<legend><?php esc_html_e( 'Register New Account', 'easy-digital-downloads' ); ?></legend>

		<?php do_action( 'edd_register_form_fields_before' ); ?>

		<p>
			<label for="edd-user-login"><?php esc_html_e( 'Username', 'easy-digital-downloads' ); ?></label>
			<input id="edd-user-login" class="required edd-input" type="text" name="edd_user_login" title="<?php esc_attresc_html_e( 'Username', 'easy-digital-downloads' ); ?>" placeholder="<?php esc_html_e( 'Username', 'easy-digital-downloads' ); ?>" />
		</p>

		<p>
			<label for="edd-user-email"><?php esc_html_e( 'Email', 'easy-digital-downloads' ); ?></label>
			<input id="edd-user-email" class="required edd-input" type="email" name="edd_user_email" title="<?php esc_attresc_html_e( 'Email Address', 'easy-digital-downloads' ); ?>" placeholder="<?php esc_html_e( 'Email', 'easy-digital-downloads' ); ?>" />
		</p>

		<p>
			<label for="edd-user-pass"><?php esc_html_e( 'Password', 'easy-digital-downloads' ); ?></label>
			<input id="edd-user-pass" class="password required edd-input" type="password" name="edd_user_pass" placeholder="<?php esc_html_e( 'Password', 'easy-digital-downloads' ); ?>" />
		</p>

		<p>
			<label for="edd-user-pass2"><?php esc_html_e( 'Confirm Password', 'easy-digital-downloads' ); ?></label>
			<input id="edd-user-pass2" class="password required edd-input" type="password" name="edd_user_pass2" placeholder="<?php esc_html_e( 'Confirm Password', 'easy-digital-downloads' ); ?>" />
		</p>


		<?php do_action( 'edd_register_form_fields_before_submit' ); ?>

		<p>
			<input type="hidden" name="edd_honeypot" value="" />
			<input type="hidden" name="edd_action" value="user_register" />
			<input type="hidden" name="edd_redirect" value="<?php echo esc_url( $edd_register_redirect ); ?>"/>
			<input class="button" name="edd_register_submit" type="submit" value="<?php esc_attr_e( 'Register', 'easy-digital-downloads' ); ?>" />
		</p>

		<?php do_action( 'edd_register_form_fields_after' ); ?>
	</fieldset>

	<?php do_action( 'edd_register_form_fields_bottom' ); ?>
</form>
