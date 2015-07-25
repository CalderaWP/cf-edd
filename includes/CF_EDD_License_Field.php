<?php

/**
 * Sets up the select field for the licensed downloads
 *
 * @package   Caldera_Forms_EDD
 * @author    Josh Pollock <Josh@CalderaWP.com>
 * @license   GPL-2.0+
 * @link
 * @copyright 2015 Josh Pollock for CalderaWP
 */
class CF_EDD_License_Field {

	/**
	 * ID of field to use.
	 *
	 * @since 0.1.0
	 *
	 * @access protected
	 *
	 * @var string
	 */
	protected $field;

	/**
	 * User ID to get licensed downloads for (or null to use current user ID)
	 *
	 * @since 0.1.0
	 *
	 * @access protected
	 *
	 * @var int|null
	 */
	protected $user;


	/**
	 * Contructor for class
	 *
	 * @since 0.1.0
	 *
	 * @param array $form Form config
	 */
	public function __construct( $form ) {
		$this->get_settings( $form );
		if ( $this->field ) {

			add_filter(  'caldera_forms_render_get_field', function( $field, $form ) {
				if ( $this->field == $field[ 'ID' ] ) {
					$downloads = cf_edd_get_downloads_by_licensed_user( $this->user );
					$field[ 'config' ][ 'option' ] = array();
					if ( ! empty( $downloads ) ) {
						foreach( $downloads as $id => $title ) {
							$field[ 'config' ][ 'option' ][ ] = array(
								'label' => esc_html( $title ),
								'value' => (int) $id,
							);
						}
					}
				}

				return $field;
			}, 15, 2 );

		}
	}

	/**
	 * Determine if procceor is present and if so, get our settings.
	 *
	 * @since 0.1.0
	 *
	 * @access protected
	 *
	 * @param array $form Form config
	 */
	protected function get_settings( $form ) {
		$proccesors = $form[ 'processors' ];
		if ( ! empty( $proccesors ) ) {
			$_proccesors = array_combine( wp_list_pluck( $proccesors, 'type'), array_keys( $proccesors ) );
			if ( isset( $_proccesors[ 'edd-licensed-downloads' ] ) ){
				$config = $proccesors[ $_proccesors[ 'edd-licensed-downloads' ] ];
				$this->field = $config[ 'config' ][ 'edd_licensed_downloads' ];
				if ( ! empty( $config[ 'config' ][ 'edd_licensed_downloads_user' ] ) && 0 < absint( $config[ 'config' ][ 'edd_licensed_downloads_user' ] ) ) {
					$this->user = $config[ 'config' ][ 'edd_licensed_downloads_user' ];
				}

			}
		}
	}
}
