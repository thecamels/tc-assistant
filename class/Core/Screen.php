<?php
/**
 * Screen class
 *
 * @package the-camels-assistant
 */

namespace TheCamels\Assistant\Core;

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
	 * Registers plugin screen
	 *
	 * @action admin_menu
	 * @since 1.0.0
	 * @return void
	 */
	public function register_page() {

		$this->page_hook = add_submenu_page(
			'index.php',
			__( 'The Camels Assistant', 'tcassistant' ),
			__( 'The Camels Assistant', 'tcassistant' ),
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
		$view->get_view( 'admin-page' );
	}

}
