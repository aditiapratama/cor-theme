<?php
	global $current_user;
	$profileuser = get_user_to_edit( $current_user->ID );

	if ( ( is_array( $current_user->roles ) && in_array( 'city', $current_user->roles ) ) ) {
		$city_switch = true;
		$disable_field = ' disabled="disabled"';
	} else {
		$city_switch = false;
		$disable_field = '';
	}
?>
<div class="login profile" id="theme-my-login<?php $template->the_instance(); ?>">
	<form id="your-profile" action="<?php $template->the_action_url( 'profile' ); ?>" method="post">

		<?php wp_nonce_field( 'update-user_' . $current_user->ID ); ?>
		<input type="hidden" name="from" value="profile" />
		<input type="hidden" name="checkuser_id" value="<?php echo $current_user->ID; ?>" />

		<?php $template->the_action_template_message( 'profile' ); ?>
		<?php $template->the_errors(); ?>

		<?php do_action( 'personal_options', $profileuser ); ?>
		<?php do_action( 'profile_personal_options', $profileuser ); ?>

		<h3><?php _e( 'Name', 'vca-theme' ); ?></h3>

		<div class="form-row">
			<label for="user_login"><span class="silent-tip" onmouseover="tooltip('<?php _e( 'Your username cannot be changed.', 'vca-theme' ); ?>');" onmouseout="exit();"><?php _e( 'Username', 'vca-theme' ); ?></span></label>
			<input type="text" name="user_login" id="user_login" value="<?php echo esc_attr( $profileuser->user_login ); ?>" disabled="disabled" class="regular-text" />
		</div><div class="form-row">
			<label for="first_name"><?php _e( 'First name', 'vca-theme' ) ?></label>
			<input type="text" name="first_name" id="first_name"<?php echo $disable_field; ?> value="<?php echo esc_attr( $profileuser->first_name ) ?>" class="regular-text" />
		</div><div class="form-row">
			<label for="last_name"><?php _e( 'Last name', 'vca-theme' ) ?></label>
			<input type="text" name="last_name" id="last_name"<?php echo $disable_field; ?> value="<?php echo esc_attr( $profileuser->last_name ) ?>" class="regular-text" />
		</div>

		<h3 class="top-space-more"><?php _e( 'Contact Info', 'vca-theme' ) ?></h3>

		<div class="form-row">
			<label for="email"><?php _e( 'E-mail', 'vca-theme' ); ?></label>
			<input type="email" name="email" id="email" value="<?php echo esc_attr( $profileuser->user_email ) ?>" class="regular-text" />
		</div>

		<?php
			do_action( 'vca_theme_show_user_profile', $profileuser );
		?>

		<?php
			// do_action( 'vca_theme_show_user_settings', $profileuser );
		?>

		<?php
		$show_password_fields = apply_filters( 'show_password_fields', true, $profileuser );
		if ( $show_password_fields ) :
		?>
			<h3 class="top-space-more"><?php _e( 'New Password', 'vca-theme' ); ?></h3>
			<div class="form-row">
				<p class="description"><?php _e( 'If you would like to change the password type a new one. Otherwise leave this blank.', 'vca-theme' ); ?></p>
				<label for="pass1"><?php _e( 'New Password', 'vca-theme' ); ?></label>
				<input type="password" name="pass1" id="pass1" size="16" value="" autocomplete="off" />
			</div><div class="form-row">
				<label for="pass1"><?php _e( 'Repeat Password', 'vca-theme' ); ?></label>
				<input type="password" name="pass2" id="pass2" size="16" value="" autocomplete="off" />
			</div><div class="form-row indicator-row">
				<label><?php _e( 'Password Strength', 'vca-theme' ); ?></label>
				<div id="pass-strength-result"><?php _e( 'Strength Indicator', 'vca-theme' ); ?></div>
			</div>
		<?php endif; ?>
		<?php if( ! isset( $city_switch ) || $city_switch === false ) { ?>
		<h3 class="top-space-more"><?php _e( 'Leave for good', 'vca-theme' ); ?></h3>
		<div class="form-row check-row column-row">
			<span class="box-test"></span><input name="deleteme" type="checkbox" id="deleteme" value="forever" />
			<label for="deleteme" class="warning"><span class="box"></span><?php _e( 'Delete my account permanently', 'vca-theme' ); ?></label>
		</div>
		<?php } ?>
		<div class="form-row">

			<?php //do_action( 'show_user_profile', $profileuser ); ?>

			<input type="hidden" name="action" value="profile" />
			<input type="hidden" name="instance" value="<?php $template->the_instance(); ?>" />
			<input type="hidden" name="user_id" id="user_id" value="<?php echo esc_attr( $current_user->ID ); ?>" />
			<input type="submit" onclick="
				if( jQuery('#deleteme').is(':checked') ) {
					if( confirm('<?php _e( "Do you really want to delete your account? This will be permanent and cannot be undone!", 'vca-theme' ); ?>') ) {
						return true;
					} else {
						return false;
					}
				} else if( jQuery('#birthday-year').val() <= <?php echo( (intval(date('Y')) - 100) ); ?> ) {
					if( confirm('<?php _e( 'Are you really a hundred years old???', 'vca-theme' ); ?>') ) {
						return true;
					} else {
						return false;
					}
				} else if( jQuery('#birthday-year').val() == 1970 && jQuery('#birthday-month').val() == 1 && jQuery('#birthday-day').val() == 1 ) {
					if( confirm('<?php _e( 'Have you really been born on January 1st, 1970?', 'vca-theme' ); ?>') ) {
						return true;
					} else {
						return false;
					}
				}
			" class="button-primary" value="<?php _e( 'Update Profile', 'vca-theme' ); ?>" name="submit" />
		</div>

	</form>
</div>