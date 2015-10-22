<?php
/**
 * @package   Caldera_Forms_EDD
 * @author    Josh Pollock <Josh@CalderaWP.com>
 * @license   GPL-2.0+
 * @link
 * @copyright 2015 Josh Pollock for CalderaWP
 *
 * @wordpress-plugin
 * Plugin Name: Caldera Forms EDD
 * Plugin URI:  https://calderawp.com/downloads/edd-for-caldera-forms/
 * Description: Integrate Easy Digital Downloads with Caldera Forms
 * Version:     0.1.0
 * Author:      CalderaWP <Josh@CalderaWP.com>
 * Author URI:  http://calderawp.com
 * Text Domain: cf-postmatic
 * License:     GPL-2.0+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 * Domain Path: /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

// define constants
define( 'CF_EDD_PATH',  plugin_dir_path( __FILE__ ) );
define( 'CF_EDD_URL',  plugin_dir_url( __FILE__ ) );
define( 'CF_EDD_VER', '0.1.0' );

// add filter to register addon with Caldera Forms
add_filter('caldera_forms_get_form_processors', 'cf_edd_register');

// we can filter the field and check that form has the processor directly. or just return the field intact if not
add_filter( 'caldera_forms_render_get_field', 'cf_edd_maybe_setup_licensed_field', 50, 2 );

// pull in the functions file
include CF_EDD_PATH . 'includes/functions.php';


