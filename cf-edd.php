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
 * Version: 1.1.1
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
define( 'CF_EDD_VER', '1.1.1' );

add_filter( 'plugins_loaded', 'cf_edd_init', 0 );
function cf_edd_init(){
	if( ! defined( 'CF_EDD_PRO_PATH' ) && version_compare( PHP_VERSION, '5.4.0', '>=' ) ){
		include_once  CF_EDD_PATH . '/bootstrap.php';

	}

}




