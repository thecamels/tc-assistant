<?php
/**
 * Hooks compatibilty file.
 *
 * Automatically generated with bin/dump-hooks.php file.
 *
 * @package the-camels-assistant
 */

// phpcs:disable
add_action( 'admin_enqueue_scripts', array( $this->scripts, 'enqueue_scripts' ), 10, 1 );
add_action( 'wp_ajax_tc_assistant_save_item', array( $this->checklist, '_ajax_save_item' ), 10, 0 );
add_action( 'admin_menu', array( $this->core_screen, 'register_page' ), 10, 0 );
