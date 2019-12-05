<?php
/**
 * Plugin Name: The Camels Assistant
 * Description: TBD
 * Author: The Camels
 * Author URI: https://thecamels.org
 * Version: 1.0.0
 * License: GPL3
 * Text Domain: tcassistant
 * Domain Path: /languages
 *
 * @package the-camels-assistant
 */

// Autoloader.
require_once dirname( __FILE__ ) . '/vendor/autoload.php';

global $tc_assistant_runtime;

/**
 * Gets the plugin runtime.
 *
 * @param string $property Optional property to get.
 * @return object Runtime class instance
 */
function tc_assistant_runtime( $property = null ) {

	global $tc_assistant_runtime;

	if ( empty( $tc_assistant_runtime ) ) {
		$tc_assistant_runtime = new TheCamels\Assistant\Runtime( __FILE__ );
	}

	if ( null !== $property && isset( $tc_assistant_runtime->{ $property } ) ) {
		return $tc_assistant_runtime->{ $property };
	}

	return $tc_assistant_runtime;

}

add_action( 'plugins_loaded', function() {
	$runtime = tc_assistant_runtime();
	$runtime->boot();
} );
