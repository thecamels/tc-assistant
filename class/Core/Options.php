<?php
/**
 * Options class
 *
 * @package the-camels-assistant
 */

namespace TheCamels\Assistant\Core;

use TheCamels\Assistant\Utils\Files;

/**
 * Options class
 */
class Options {

	/**
	 * Completed items option name
	 *
	 * @var string
	 */
	private $option_completed_items = 'tc_assistant_completed_items';

	/**
	 * Gets completed items
	 *
	 * @return array
	 */
	public function get_completed_items() {
		return get_option( $this->option_completed_items, array() );
	}

	/**
	 * Completes an item
	 *
	 * @param array $item Item array.
	 * @return void
	 */
	public function complete_item( $item ) {
		$items                     = $this->get_completed_items();
		$items[ $item['item_id'] ] = $item;
		update_option( $this->option_completed_items, $items );
	}

	/**
	 * Uncompletes an item
	 *
	 * @param int $item_id Item ID.
	 * @return void
	 */
	public function uncomplete_item( $item_id ) {
		$items = $this->get_completed_items();
		unset( $items[ $item_id ] );
		update_option( $this->option_completed_items, $items );
	}

}
