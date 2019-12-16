<?php
/**
 * Checklist class
 *
 * @package the-camels-assistant
 */

namespace TheCamels\Assistant\Core;

use TheCamels\Assistant\Abstracts;
use TheCamels\Assistant\Utils\Files;

/**
 * Checklist class
 */
class Checklist extends Abstracts\YamlLoader {

	/**
	 * Files class
	 *
	 * @var object
	 */
	private $files;

	/**
	 * Options class
	 *
	 * @var object
	 */
	private $options;

	/**
	 * Fallback for Yaml file
	 *
	 * @var string
	 */
	private $fallback_filename = 'inc/checklist/checklist-en.yaml';

	/**
	 * Class constructor
	 *
	 * @since 1.0.0
	 * @param Files   $files   Files instance.
	 * @param Options $options Options instance.
	 */
	public function __construct( Files $files, Options $options ) {

		$this->files   = $files;
		$this->options = $options;

		$lang = substr( get_locale(), 0, 2 );
		$file = sprintf( 'inc/checklist/checklist-%s.yaml', $lang );

		if ( $this->files->file_exists( $file ) ) {
			$config_file = $this->files->file_path( $file );
		} else {
			$config_file = $this->files->file_path( $this->fallback_filename );
		}

		parent::__construct( $config_file );

	}

	/**
	 * Gets all items with flag indicating if an item is completed
	 * Also adds completed items if missing.
	 *
	 * @since 1.0.0
	 * @return array
	 */
	public function get_items_with_state() {

		$checklist       = $this->get_config();
		$completed_items = $this->options->get_completed_items();
		$item_ids        = array();

		// Calculate completed elements.
		foreach ( $checklist as $category_name => &$items ) {
			foreach ( $items as $item_id => &$item ) {
				$item['completed'] = array_key_exists( $item_id, $completed_items );
				$item_ids[]        = $item_id;
			}
		}

		// Add missing items.
		$items_to_add = array_diff( array_keys( $completed_items ), $item_ids );

		foreach ( $items_to_add as $item_id ) {
			$item_to_add              = $completed_items[ $item_id ];
			$item_to_add['completed'] = true;
			if ( ! isset( $checklist[ $item_to_add['category'] ] ) ) {
				$checklist[ $item_to_add['category'] ] = array();
			}

			$checklist[ $item_to_add['category'] ][ $item_id ] = $item_to_add;
		}

		return $checklist;

	}

	/**
	 * Saves item state into database
	 *
	 * @action wp_ajax_tc_assistant_save_item
	 *
	 * @since 1.0.0
	 * @return void
	 */
	public function _ajax_save_item() {

		check_ajax_referer( $_POST['item_id'], 'nonce', true ); // phpcs:ignore

		$this->save_item_state( $_POST['checked'], $_POST['item_id'] ); // phpcs:ignore

		wp_send_json_success();

	}

	/**
	 * Saves item stage
	 *
	 * @param bool $checked If checked.
	 * @param int  $item_id Item ID.
	 * @return void
	 */
	public function save_item_state( $checked, $item_id ) {
		if ( 'true' === $checked ) {
			$this->options->complete_item( $this->get_item_by_id( $item_id ) );
		} else {
			$this->options->uncomplete_item( $item_id );
		}
	}

	/**
	 * Gets item from config file via ID.
	 *
	 * @since 1.0.0
	 * @param string $searched_item_id Searched item ID.
	 * @return mixed
	 */
	public function get_item_by_id( $searched_item_id ) {
		$checklist = $this->get_config();
		foreach ( $checklist as $category_name => $items ) {
			foreach ( $items as $item_id => $item ) {
				if ( $item_id === $searched_item_id ) {
					$item['item_id']  = $item_id;
					$item['category'] = $category_name;
					return $item;
				}
			}
		}
		return null;
	}

	/**
	 * Gets checksum calculated from item IDs
	 *
	 * @since 1.0.0
	 * @return string
	 */
	public function get_checksum() {
		$items = array();
		foreach ( $this->get_config() as $category_name => $items ) {
			foreach ( $items as $item_id => $item ) {
				$items[] = $item_id;
			}
		}
		sort( $items );
		return md5( wp_json_encode( $items ) );
	}

	/**
	 * Gets total number of items in checklist
	 *
	 * @since 1.0.0
	 * @return int
	 */
	public function get_items_total() {
		$count = 0;
		foreach ( $this->get_items_with_state() as $category_name => $items ) {
			foreach ( $items as $item_id => $item ) {
				$count++;
			}
		}
		return $count;
	}

	/**
	 * Gets total number of completed items in checklist
	 *
	 * @since 1.0.0
	 * @return int
	 */
	public function get_completed_items_total() {
		return count( $this->options->get_completed_items() );
	}

}
