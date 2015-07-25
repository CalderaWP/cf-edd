<?php
/**
 * CF EDD Functions
 *
 * @package   Caldera_Forms_EDD
 * @author    Josh Pollock <Josh@CalderaWP.com>
 * @license   GPL-2.0+
 * @link
 * @copyright 2015 Josh Pollock for CalderaWP
 */

/**
 * Registers  Processors
 *
 * @since 0.1.0
 * @param array		$processors		Array of current registered processors
 *
 * @return array	array of registered processors
 */
function cf_edd_register($processors){

	$processors['edd-licensed-downloads'] = array(
		"name"				=>	__('EDD: Licensed Downloads', 'cf-edd'),
		"description"		=>	__( 'Populate a select field with a user\'s licensed downloads..', 'cf-edd'),
		"icon"				=>	CF_EDD_URL . "icon.png",
		"author"			=>	"Josh Pollock for CalderaWP LLC",
		"author_url"		=>	"https://CalderaWP.com",
		"pre_processor"		=>	'cf_edd_validate',
		"template"			=>	CF_EDD_PATH . "includes/config-licensed-downloads.php",

	);

	return $processors;

}

/**
 * If needed sets up dropdown options for EDD field.
 *
 * @since 0.1.0
 *
 * @param array $form Form config
 */
function cf_edd_maybe_setup_licensed_field( $form ) {
	include_once( CF_EDD_PATH .'includes/CF_EDD_License_Field.php' );
	new CF_EDD_License_Field( $form );
}

/**
 *  Process edd-licensed-downloads processor to validate setup
 *
 * @since 0.1.0
 *
 * @param array $config Processor config
 * @param array $form Form config
 *
 * @return array|void
 */
function cf_edd_validate( $config, $form ) {
	$value = Caldera_Forms::do_magic_tags( $config[ 'edd_licensed_downloads' ] );
	$_user = Caldera_Forms::do_magic_tags( $config[  'edd_licensed_downloads_user'] );
	if ( 0 < absint( $_user ) ) {
		$user = $_user;
	}else{
		$user = null;
	}
	$downloads = cf_edd_get_downloads_by_licensed_user( $user );

	if ( ! in_array( $value, array_keys( $downloads ) ) ) {
		return array(
			'type'=>'error',
			'note' => __( "Selected User Does Note Have A License For This Download.", 'cf-edd' )
		);
	}

}



/**
 * Get all licensed add-ons for a user
 *
 * @param null|int $user_id Optional. User ID, current user ID if mull
 * @param bool $include_expired Optional. If false the default, expired licenses will be skipped.
 *
 * @return bool|array Array of download_id => download title or false if none found.
 */
function cf_edd_get_downloads_by_licensed_user( $user_id = null, $include_expired = false ) {
	if ( is_null( $user_id ) ){
		$user_id = get_current_user_id();
	}

	$licensed_downloads = false;
	if ( 0 < absint( $user_id ) ) {
		global $wpdb;
		$query = $wpdb->prepare( 'SELECT `post_id` FROM `%2s` WHERE `meta_value` = %d AND `meta_key` = "_edd_sl_user_id"', $wpdb->postmeta, $user_id );
		$licenses = $wpdb->get_results( $query, ARRAY_A );

		if ( ! empty( $licenses ) ) {
			foreach( $licenses as $license ) {
				if ( ! $include_expired ) {
					if ( false == get_post_meta( $id, '_edd_sl_status', true ) ) {
						continue;
					}

				}
				$id = get_post_meta( $license[ 'post_id'], '_edd_sl_download_id', true );
				if ( $id ) {
					$licensed_downloads[$id] = get_the_title( $id );
				}

			}

		}

	}

	return $licensed_downloads;

}


