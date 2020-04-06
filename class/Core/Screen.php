<?php
/**
 * Screen class
 *
 * @package the-camels-assistant
 */

namespace TheCamels\Assistant\Core;

use TheCamels\Assistant\Interfaces;

/**
 * Screen class
 */
class Screen {

	/**
	 * Admin page hook
	 *
	 * @var string
	 */
	public $page_hook = 'none';

	/**
	 * Checklist object
	 *
	 * @var Interfaces\Yamlable
	 */
	protected $checklist;

	/**
	 * Class constructor
	 *
	 * @since 1.0.0
	 * @param Interfaces\Yamlable $checklist Yamlable instance.
	 */
	public function __construct( Interfaces\Yamlable $checklist ) {
		$this->checklist = $checklist;
	}

	/**
	 * Registers plugin screen
	 *
	 * @action admin_menu
	 * @since 1.0.0
	 * @return void
	 */
	public function register_page() {

		$items_left = (int) $this->checklist->get_items_total() - (int) $this->checklist->get_completed_items_total();
		$page_title = sprintf(
			'%s <span class="update-plugins"><span class="update-count">%d</span></span>',
			__( 'TC Assistant', 'tcassistant' ),
			$items_left
		);

		$this->page_hook = add_submenu_page(
			'index.php',
			__( 'Thecamels Assistant', 'tcassistant' ),
			$page_title,
			'manage_options',
			'tcassistant',
			array( $this, 'extensions_page' )
		);

	}

	/**
	 * Outputs plugin page
	 *
	 * @since 1.0.0
	 * @return void
	 */
	public function extensions_page() {
		$view = tc_assistant_create_view();
		$view->set_var( 'checklist', $this->checklist->get_items_with_state() );
		$view->get_view( 'admin-page' );
	}

}
