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


/**
 * Adds the custom fields to the member edit screen
 *
 */
function wpparis_rcp_add_member_edit_fields( $user_id = 0 ) {

	$profession = get_user_meta( $user_id, 'rcp_profession', true );
	$ville  = get_user_meta( $user_id, 'rcp_ville', true );
	?>
	<tr valign="top">
		<th scope="row" valign="top">
			<label for="rcp_profession"><?php _e( 'Profession', 'rcp' ); ?></label>
		</th>
		<td>
			<input name="rcp_profession" id="rcp_profession" type="text" value="<?php echo esc_attr( $profession ); ?>"/>
			<p class="description"><?php _e( 'La profession de l\'adhérent', 'rcp' ); ?></p>
		</td>
	</tr>
	<tr valign="top">
		<th scope="row" valign="top">
			<label for="rcp_profession"><?php _e( 'Ville', 'rcp' ); ?></label>
		</th>
		<td>
			<input name="rcp_ville" id="rcp_ville" type="text" value="<?php echo esc_attr( $ville); ?>"/>
			<p class="description"><?php _e( 'La ville de l\'adhérent', 'rcp' ); ?></p>
		</td>
	</tr>
	<?php
}
add_action( 'rcp_edit_member_after', 'wpparis_rcp_add_member_edit_fields' );


/**
 * Stores the information submitted during registration
 *
 */
function pw_rcp_save_user_fields_on_register( $posted, $user_id ) {
	if( ! empty( $posted['rcp_profession'] ) ) {
		update_user_meta( $user_id, 'rcp_profession', sanitize_text_field( $posted['rcp_profession'] ) );
	}
	if( ! empty( $posted['rcp_ville'] ) ) {
		update_user_meta( $user_id, 'rcp_ville', sanitize_text_field( $posted['rcp_ville'] ) );
	}
}
add_action( 'rcp_form_processing', 'wpparis_rcp_save_user_fields_on_register', 10, 2 );


/**
 * Stores the information submitted profile update
 *
 */
function wpparis_rcp_save_user_fields_on_profile_save( $user_id ) {
	if( ! empty( $_POST['rcp_profession'] ) ) {
		update_user_meta( $user_id, 'rcp_profession', sanitize_text_field( $_POST['rcp_profession'] ) );
	}
	if( ! empty( $_POST['rcp_ville'] ) ) {
		update_user_meta( $user_id, 'rcp_ville', sanitize_text_field( $_POST['rcp_ville'] ) );
	}
}
add_action( 'rcp_user_profile_updated', 'wpparis_rcp_save_user_fields_on_profile_save', 10 );
add_action( 'rcp_edit_member', 'wpparis_rcp_save_user_fields_on_profile_save', 10 );