<?php
/**
 * Uninstall routine.
 *
 * @package the-camels-assistant
 */

if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
	die;
}

global $wpdb;

$wpdb->query( "DELETE FROM {$wpdb->options} WHERE option_name LIKE 'tc_assistant%'" ); // phpcs:ignore
