<?php
/**
 * Ajout de nouveaux champs sur mesure pour l'extension Restrict Content Pro
 * http://docs.restrictcontentpro.com/article/1720-creating-custom-registration-fields
 * Ajouté par Grégoire Noyelle le 12/09/2017
 */


/**
 * Champs personnalisés pour le formulaire d'inscription et la page mon compte
 *
 */
function wpparis_rcp_add_user_fields() {

	$civilite = get_user_meta( get_current_user_id(), 'rcp_civilite', true );
	$profession = get_user_meta( get_current_user_id(), 'rcp_profession', true );
	$rue = get_user_meta( get_current_user_id(), 'rcp_rue', true );
	$code_postal = get_user_meta( get_current_user_id(), 'rcp_code_postal', true );
	$ville  = get_user_meta( get_current_user_id(), 'rcp_ville', true );
	$tshirt = get_user_meta( get_current_user_id(), 'rcp_tshirt', true );
	$tshirt_taille = get_user_meta( get_current_user_id(), 'rcp_tshirt_taille', true );

	?>
    <p>
        <label for="rcp_civilite"><?php _e( 'Civilité?', 'rcp' ); ?></label>
        <select id="rcp_civilite" name="rcp_civilite">
            <option value="homme" <?php selected( $civilite, 'homme'); ?>><?php _e( 'Homme', 'rcp' ); ?></option>
            <option value="femme" <?php selected( $civilite, 'femme'); ?>><?php _e( 'Femme', 'rcp' ); ?></option>
            <option value="autre" <?php selected( $civilite, 'autre'); ?>><?php _e( 'Autre', 'rcp' ); ?></option>
        </select>
    </p>
	<p>
		<label for="rcp_profession"><?php _e( 'Votre profession', 'rcp' ); ?></label>
		<input name="rcp_profession" id="rcp_profession" type="text" value="<?php echo esc_attr( $profession ); ?>"/>
	</p>
	<legend>Adresse</legend>
	<p>
		<label for="rcp_rue"><?php _e( 'N° et Rue', 'rcp' ); ?></label>
		<input name="rcp_rue" id="rcp_rue" type="text" value="<?php echo esc_attr( $rue); ?>"/>
	</p>
	<p>
		<label for="rcp_code_postal"><?php _e( 'Code Postal', 'rcp' ); ?></label>
		<input name="rcp_code_postal" id="rcp_code_postal" type="number" value="<?php echo esc_attr( $code_postal); ?>"/>
	</p>
	<p>
		<label for="rcp_ville"><?php _e( 'Ville', 'rcp' ); ?></label>
		<input name="rcp_ville" id="rcp_ville" type="text" value="<?php echo esc_attr( $ville); ?>"/>
	</p>
    <p>
        <input name="rcp_tshirt" id="rcp_tshirt" type="checkbox" value="1" <?php checked( $tshirt ); ?>/>
        <label for="rcp_tshirt"><?php _e( 'Oui, je veux mon t-shirt', 'rcp' ); ?></label>
    </p>

    <legend>T-Shirt WP Paris</legend>
    <p>
        <label for="rcp_tshirt_taille"><?php _e( 'Taille du t-shirt', 'rcp' ); ?></label>
        <select id="rcp_tshirt_taille" name="rcp_tshirt_taille">
        	<option value="s" <?php selected( $tshirt_taille, 'm'); ?>><?php _e( 'S (femme uniquement)', 'rcp' ); ?></option>
            <option value="m" <?php selected( $tshirt_taille, 'm'); ?>><?php _e( 'M', 'rcp' ); ?></option>
            <option value="l" <?php selected( $tshirt_taille, 'l'); ?>><?php _e( 'L', 'rcp' ); ?></option>
            <option value="xl" <?php selected( $tshirt_taille, 'xl'); ?>><?php _e( 'XL', 'rcp' ); ?></option>
        </select>
    </p>

    <?php

    ?>
	<?php
}
add_action( 'rcp_after_password_registration_field', 'wpparis_rcp_add_user_fields' );
add_action( 'rcp_profile_editor_after', 'wpparis_rcp_add_user_fields' );


/**
 * Champs personnalisés pour la page d'édition des membres en back-office
 *
 */
function wpparis_rcp_add_member_edit_fields( $user_id = 0 ) {

	$civilite = get_user_meta( get_current_user_id(), 'rcp_civilite', true );
	$profession = get_user_meta( $user_id, 'rcp_profession', true );
	$rue = get_user_meta( get_current_user_id(), 'rcp_rue', true );
	$code_postal = get_user_meta( get_current_user_id(), 'rcp_code_postal', true );
	$ville  = get_user_meta( $user_id, 'rcp_ville', true );
	$tshirt = get_user_meta( get_current_user_id(), 'rcp_tshirt', true );
	$tshirt_taille = get_user_meta( get_current_user_id(), 'rcp_tshirt_taille', true );
	?>

    <tr valign="top">
        <th scope="row" valign="top">
            <label for="rcp_civilite"><?php _e( 'Civilité', 'rcp' ); ?></label>
        </th>
        <td>
	        <select id="rcp_civilite" name="rcp_civilite">
	            <option value="homme" <?php selected( $civilite, 'homme'); ?>><?php _e( 'Homme', 'rcp' ); ?></option>
	            <option value="femme" <?php selected( $civilite, 'femme'); ?>><?php _e( 'Femme', 'rcp' ); ?></option>
	            <option value="autre" <?php selected( $civilite, 'autre'); ?>><?php _e( 'Autre', 'rcp' ); ?></option>
	        </select>
        </td>
    </tr>
	<tr valign="top">
		<th scope="row" valign="top">
			<label for="rcp_profession"><?php _e( 'Profession', 'rcp' ); ?></label>
		</th>
		<td>
			<input name="rcp_profession" id="rcp_profession" type="text" value="<?php echo esc_attr( $profession ); ?>"/>
			<p class="description"><?php _e( 'Profession', 'rcp' ); ?></p>
		</td>
	</tr>
	<tr valign="top">
		<th scope="row" valign="top">
			<label for="rcp_rue"><?php _e( 'N° et Rue', 'rcp' ); ?></label>
		</th>
		<td>
			<input name="rcp_rue" id="rcp_rue" type="text" value="<?php echo esc_attr( $rue); ?>"/>
			<p class="description"><?php _e( 'N° et Rue', 'rcp' ); ?></p>
		</td>
	</tr>
	<tr valign="top">
		<th scope="row" valign="top">
			<label for="rcp_code_postal"><?php _e( 'Code Postal', 'rcp' ); ?></label>
		</th>
		<td>
			<input name="rcp_code_postal" id="rcp_code_postal" type="number" value="<?php echo esc_attr( $code_postal); ?>"/>
			<p class="description"><?php _e( 'Code Postal', 'rcp' ); ?></p>
		</td>
	</tr>
	<tr valign="top">
		<th scope="row" valign="top">
			<label for="rcp_ville"><?php _e( 'Ville', 'rcp' ); ?></label>
		</th>
		<td>
			<input name="rcp_ville" id="rcp_ville" type="text" value="<?php echo esc_attr( $ville); ?>"/>
			<p class="description"><?php _e( 'Ville', 'rcp' ); ?></p>
		</td>
	</tr>
    <tr valign="top">
        <th scope="row" valign="top">
            <label for="rcp_tshirt"><?php _e( 'T-Shirt', 'rcp' ); ?></label>
        </th>
        <td>
            <input name="rcp_tshirt" id="rcp_tshirt" type="checkbox" <?php checked( $tshirt ); ?>/>
            <span class="description"><?php _e( 'A cocher si le t-shirt n\'a pas été donné', 'rcp' ); ?></span>
        </td>
    </tr>
    <tr valign="top">
        <th scope="row" valign="top">
            <label for="rcp_tshirt_taille"><?php _e( 'Taille du t-shirt', 'rcp' ); ?></label>
        </th>
        <td>
        <select id="rcp_tshirt_taille" name="rcp_tshirt_taille">
        	<option value="s" <?php selected( $tshirt_taille, 'm'); ?>><?php _e( 'S (femme uniquement)', 'rcp' ); ?></option>
            <option value="m" <?php selected( $tshirt_taille, 'm'); ?>><?php _e( 'M', 'rcp' ); ?></option>
            <option value="l" <?php selected( $tshirt_taille, 'l'); ?>><?php _e( 'L', 'rcp' ); ?></option>
            <option value="xl" <?php selected( $tshirt_taille, 'xl'); ?>><?php _e( 'XL', 'rcp' ); ?></option>
        </select>
        </td>
    </tr>
	<?php
}
add_action( 'rcp_edit_member_after', 'wpparis_rcp_add_member_edit_fields' );


/**
 * Enregistre les valeurs des champs personnalisés pendant l'enregistrement du compte
 *
 */
function pw_rcp_save_user_fields_on_register( $posted, $user_id ) {
	if( ! empty( $posted['rcp_civilite'] ) ) {
		update_user_meta( $user_id, 'rcp_civilite', sanitize_text_field( $posted['rcp_civilite'] ) );
	}
	if( ! empty( $posted['rcp_profession'] ) ) {
		update_user_meta( $user_id, 'rcp_profession', sanitize_text_field( $posted['rcp_profession'] ) );
	}
	if( ! empty( $posted['rcp_ville'] ) ) {
		update_user_meta( $user_id, 'rcp_ville', sanitize_text_field( $posted['rcp_ville'] ) );
	}
	if( ! empty( $posted['rcp_rue'] ) ) {
		update_user_meta( $user_id, 'rcp_rue', sanitize_text_field( $posted['rcp_rue'] ) );
	}
	if( ! empty( $posted['rcp_code_postal'] ) ) {
		update_user_meta( $user_id, 'rcp_code_postal', absint( $posted['rcp_code_postal'] ) );
	}
    if ( isset( $posted['rcp_tshirt'] ) ) {
        update_user_meta( $user_id, 'rcp_tshirt', true );
    }
	if( ! empty( $posted['rcp_tshirt_taille'] ) ) {
		update_user_meta( $user_id, 'rcp_tshirt_taille', sanitize_text_field( $posted['rcp_tshirt_taille'] ) );
	}
}
add_action( 'rcp_form_processing', 'wpparis_rcp_save_user_fields_on_register', 10, 2 );


/**
 * Enregistre les valeurs des champs personnalisés quand le profil est mis à jour
 *
 */
function wpparis_rcp_save_user_fields_on_profile_save( $user_id ) {
	$civilite_choice = array(
		'homme',
		'femme',
		'autre'
	);

	$taille_tshirt = array(
		's',
		'm',
		'l',
		'xl'
	);

    if( isset( $_POST['rcp_civilite'] ) && in_array( $_POST['rcp_civilite'], $civilite_choice ) ) {
        update_user_meta( $user_id, 'rcp_civilite', sanitize_text_field( $_POST['rcp_civilite'] ) );
    }
	if( ! empty( $_POST['rcp_profession'] ) ) {
		update_user_meta( $user_id, 'rcp_profession', sanitize_text_field( $_POST['rcp_profession'] ) );
	}
	if( ! empty( $_POST['rcp_ville'] ) ) {
		update_user_meta( $user_id, 'rcp_ville', sanitize_text_field( $_POST['rcp_ville'] ) );
	}

	if( ! empty( $_POST['rcp_rue'] ) ) {
		update_user_meta( $user_id, 'rcp_rue', sanitize_text_field( $_POST['rcp_rue'] ) );
	}
	if( ! empty( $_POST['rcp_code_postal'] ) ) {
		update_user_meta( $user_id, 'rcp_code_postal', absint( $_POST['rcp_code_postal'] ) );
	}
    if ( isset( $_POST['rcp_tshirt'] ) ) {
        // Set the user meta if the box was checked on.
        update_user_meta( $user_id, 'rcp_tshirt', true );
    } else {
        // Delete the user meta if the box is unchecked.
        delete_user_meta( $user_id, 'rcp_tshirt' );
    }
    if( isset( $_POST['rcp_tshirt_taille'] ) && in_array( $_POST['rcp_tshirt_taille'], $taille_tshirt ) ) {
        update_user_meta( $user_id, 'rcp_tshirt_taille', sanitize_text_field( $_POST['rcp_tshirt_taille'] ) );
    }
}
add_action( 'rcp_user_profile_updated', 'wpparis_rcp_save_user_fields_on_profile_save', 10 );
add_action( 'rcp_edit_member', 'wpparis_rcp_save_user_fields_on_profile_save', 10 );