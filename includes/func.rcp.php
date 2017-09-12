<?php
// Add new fields for User in Restrict Content Pro Plugin

/**
 * Adds the custom fields to the registration form and profile editor
 *
 */
function wpparis_rcp_add_user_fields() {

	$profession = get_user_meta( get_current_user_id(), 'rcp_profession', true );
	$ville  = get_user_meta( get_current_user_id(), 'rcp_ville', true );
	?>
	<p>
		<label for="rcp_profession"><?php _e( 'Votre profession', 'rcp' ); ?></label>
		<input name="rcp_profession" id="rcp_profession" type="text" value="<?php echo esc_attr( $profession ); ?>"/>
	</p>
	<p>
		<label for="rcp_ville"><?php _e( 'Votre ville', 'rcp' ); ?></label>
		<input name="rcp_ville" id="rcp_ville" type="text" value="<?php echo esc_attr( $ville); ?>"/>
	</p>
	<?php
}
add_action( 'rcp_after_password_registration_field', 'wpparis_rcp_add_user_fields' );
add_action( 'rcp_profile_editor_after', 'wpparis_rcp_add_user_fields' );

