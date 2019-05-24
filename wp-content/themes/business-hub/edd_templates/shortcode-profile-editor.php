<?php
/**
 * This template is used to display the profile editor with [edd_profile_editor]
 */
$current_user = businesshub_get_global_edd_current_user();

if ( is_user_logged_in() ):
	$user_id      = get_current_user_id();
	$first_name   = get_user_meta( $user_id, 'first_name', true );
	$last_name    = get_user_meta( $user_id, 'last_name', true );
	$display_name = $current_user->display_name;
	$address      = edd_get_customer_address( $user_id );

	if ( edd_is_cart_saved() ): ?>
		<?php $restore_url = add_query_arg( array( 'edd_action' => 'restore_cart', 'edd_cart_token' => edd_get_cart_token() ), edd_get_checkout_uri() ); ?>
		<div class="edd_success edd-alert edd-alert-success"><strong><?php esc_html_e( 'Saved cart','easy-digital-downloads' ); ?>:</strong> <?php printf( esc_html__( 'You have a saved cart, <a href="%s">click here</a> to restore it.', 'easy-digital-downloads' ), esc_url( $restore_url ) ); ?></div>
	<?php endif; ?>

	<?php if ( isset( $_GET['updated'] ) && $_GET['updated'] == true && ! edd_get_errors() ): ?>
		<div class="edd_success edd-alert edd-alert-success"><strong><?php esc_html_e( 'Success','easy-digital-downloads' ); ?>:</strong> <?php esc_html_e( 'Your profile has been edited successfully.', 'easy-digital-downloads' ); ?></div>
	<?php endif; ?>

	<?php edd_print_errors(); ?>

	<?php do_action( 'edd_profile_editor_before' ); ?>

	<form id="edd_profile_editor_form" class="edd_form" action="<?php echo edd_get_current_page_url(); ?>" method="post">
		<fieldset>
			<span id="edd_profile_name_label"><legend><?php esc_html_e( 'Change your Name', 'easy-digital-downloads' ); ?></legend></span>
			<p id="edd_profile_name_wrap">
				<label for="edd_first_name"><?php esc_html_e( 'First Name', 'easy-digital-downloads' ); ?></label>
				<input name="edd_first_name" id="edd_first_name" class="text edd-input" type="text" value="<?php echo esc_attr( $first_name ); ?>" placeholder="<?php esc_html_e( 'First Name', 'easy-digital-downloads' ); ?>" />
				<br />
				<label for="edd_last_name"><?php esc_html_e( 'Last Name', 'easy-digital-downloads' ); ?></label>
				<input name="edd_last_name" id="edd_last_name" class="text edd-input" type="text" value="<?php echo esc_attr( $last_name ); ?>" placeholder="<?php esc_html_e( 'Last Name', 'easy-digital-downloads' ); ?>" />
			</p>
			<p id="edd_profile_display_name_wrap">
				<label for="edd_display_name"><?php esc_html_e( 'Display Name', 'easy-digital-downloads' ); ?></label>
				<select name="edd_display_name" id="edd_display_name" class="select edd-select">
                	<option value="" disabled selected><?php esc_html_e( 'Select display Name', 'easy-digital-downloads' ); ?></option>
					<?php if ( ! empty( $current_user->first_name ) ): ?>
					<option <?php selected( $display_name, $current_user->first_name ); ?> value="<?php echo esc_attr( $current_user->first_name ); ?>"><?php echo esc_html( $current_user->first_name ); ?></option>
					<?php endif; ?>
					<option <?php selected( $display_name, $current_user->user_nicename ); ?> value="<?php echo esc_attr( $current_user->user_nicename ); ?>"><?php echo esc_html( $current_user->user_nicename ); ?></option>
					<?php if ( ! empty( $current_user->last_name ) ): ?>
					<option <?php selected( $display_name, $current_user->last_name ); ?> value="<?php echo esc_attr( $current_user->last_name ); ?>"><?php echo esc_html( $current_user->last_name ); ?></option>
					<?php endif; ?>
					<?php if ( ! empty( $current_user->first_name ) && ! empty( $current_user->last_name ) ): ?>
					<option <?php selected( $display_name, $current_user->first_name . ' ' . $current_user->last_name ); ?> value="<?php echo esc_attr( $current_user->first_name . ' ' . $current_user->last_name ); ?>"><?php echo esc_html( $current_user->first_name . ' ' . $current_user->last_name ); ?></option>
					<option <?php selected( $display_name, $current_user->last_name . ' ' . $current_user->first_name ); ?> value="<?php echo esc_attr( $current_user->last_name . ' ' . $current_user->first_name ); ?>"><?php echo esc_html( $current_user->last_name . ' ' . $current_user->first_name ); ?></option>
					<?php endif; ?>
				</select>
				<?php do_action( 'edd_profile_editor_name' ); ?>
			</p>
			<?php do_action( 'edd_profile_editor_after_name' ); ?>
			<p>
				<label for="edd_email"><?php esc_html_e( 'Email Address', 'easy-digital-downloads' ); ?></label>
				<input name="edd_email" id="edd_email" class="text edd-input required" type="email" value="<?php echo esc_attr( $current_user->user_email ); ?>" placeholder="<?php esc_html_e( 'Email Address', 'easy-digital-downloads' ); ?>" />
				<?php do_action( 'edd_profile_editor_email' ); ?>
			</p>
			<?php do_action( 'edd_profile_editor_after_email' ); ?>
			<span id="edd_profile_billing_address_label"><legend><?php esc_html_e( 'Change your Billing Address', 'easy-digital-downloads' ); ?></legend></span>
			<p id="edd_profile_billing_address_wrap">
				<label for="edd_address_line1"><?php esc_html_e( 'Line 1', 'easy-digital-downloads' ); ?></label>
				<input name="edd_address_line1" id="edd_address_line1" class="text edd-input" type="text" value="<?php echo esc_attr( $address['line1'] ); ?>" placeholder="<?php esc_html_e( 'Line 1', 'easy-digital-downloads' ); ?>" />
				<br/>
				<label for="edd_address_line2"><?php esc_html_e( 'Line 2', 'easy-digital-downloads' ); ?></label>
				<input name="edd_address_line2" id="edd_address_line2" class="text edd-input" type="text" value="<?php echo esc_attr( $address['line2'] ); ?>" placeholder="<?php esc_html_e( 'Line 2', 'easy-digital-downloads' ); ?>" />
				<br/>
				<label for="edd_address_city"><?php esc_html_e( 'City', 'easy-digital-downloads' ); ?></label>
				<input name="edd_address_city" id="edd_address_city" class="text edd-input" type="text" value="<?php echo esc_attr( $address['city'] ); ?>" placeholder="<?php esc_html_e( 'City', 'easy-digital-downloads' ); ?>" />
				<br/>
				<label for="edd_address_zip"><?php esc_html_e( 'Zip / Postal Code', 'easy-digital-downloads' ); ?></label>
				<input name="edd_address_zip" id="edd_address_zip" class="text edd-input" type="text" value="<?php echo esc_attr( $address['zip'] ); ?>" placeholder="<?php esc_html_e( 'Zip / Postal Code', 'easy-digital-downloads' ); ?>" />
				<br/>
				<label for="edd_address_country"><?php esc_html_e( 'Country', 'easy-digital-downloads' ); ?></label>
				<select name="edd_address_country" id="edd_address_country" class="select edd-select">                	
					<?php foreach( edd_get_country_list() as $key => $country ) : ?>
					<option value="<?php echo esc_attr($key); ?>"<?php selected( $address['country'], $key ); ?>><?php echo esc_html( $country ); ?></option>
					<?php endforeach; ?>
				</select>
				<br/>
				<label for="edd_address_state"><?php esc_html_e( 'State / Province', 'easy-digital-downloads' ); ?></label>
				<input name="edd_address_state" id="edd_address_state" class="text edd-input" type="text" value="<?php echo esc_attr( $address['state'] ); ?>" placeholder="<?php esc_html_e( 'State / Province', 'easy-digital-downloads' ); ?>" />
				<br/>
				<?php do_action( 'edd_profile_editor_address' ); ?>
			</p>
			<?php do_action( 'edd_profile_editor_after_address' ); ?>
			<span id="edd_profile_password_label"><legend><?php esc_html_e( 'Change your Password', 'easy-digital-downloads' ); ?></legend></span>
			<p id="edd_profile_password_wrap">
				<label for="edd_user_pass"><?php esc_html_e( 'New Password', 'easy-digital-downloads' ); ?></label>
				<input name="edd_new_user_pass1" id="edd_new_user_pass1" class="password edd-input" type="password" placeholder="<?php esc_html_e( 'New Password', 'easy-digital-downloads' ); ?>"/>
				<br />
				<label for="edd_user_pass"><?php esc_html_e( 'Re-enter Password', 'easy-digital-downloads' ); ?></label>
				<input name="edd_new_user_pass2" id="edd_new_user_pass2" class="password edd-input" type="password" placeholder="<?php esc_html_e( 'Re-enter Password', 'easy-digital-downloads' ); ?>"/>
				<?php do_action( 'edd_profile_editor_password' ); ?>
			</p>
			<p class="edd_password_change_notice"><?php esc_html_e( 'Please note after changing your password, you must log back in.', 'easy-digital-downloads' ); ?></p>
			<?php do_action( 'edd_profile_editor_after_password' ); ?>
			<p id="edd_profile_submit_wrap">
				<input type="hidden" name="edd_profile_editor_nonce" value="<?php echo wp_create_nonce( 'edd-profile-editor-nonce' ); ?>"/>
				<input type="hidden" name="edd_action" value="edit_user_profile" />
				<input type="hidden" name="edd_redirect" value="<?php echo esc_url( edd_get_current_page_url() ); ?>" />
				<input name="edd_profile_editor_submit" id="edd_profile_editor_submit" type="submit" class="edd_submit" value="<?php esc_html_e( 'Save Changes', 'easy-digital-downloads' ); ?>"/>
			</p>
		</fieldset>
	</form><!-- #edd_profile_editor_form -->

	<?php do_action( 'edd_profile_editor_after' ); ?>

	<?php
else:
	echo '<p>' . esc_html__( 'You need to login to edit your profile.', 'easy-digital-downloads' ) . '</p>';
	echo edd_login_form();
endif;
