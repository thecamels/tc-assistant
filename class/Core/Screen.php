<?php
/**
 * Screen class
 *
 * @package the-camels-assistant
 */

namespace TheCamels\Assistant\Core;

use TheCamels\Assistant\Interfaces;
use WPTRT\AdminNotices\Notices;

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
	 * Notices object
	 *
	 * @var Notices
	 */
	protected $notices;

	/**
	 * Class constructor
	 *
	 * @since 1.0.0
	 * @param Interfaces\Yamlable $checklist Yamlable instance.
	 * @param Notices             $notices   Notices instance.
	 */
	public function __construct( Interfaces\Yamlable $checklist, Notices $notices ) {
		$this->checklist = $checklist;
		$this->notices   = $notices;
	}

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
		$view->set_var( 'checklist', $this->checklist->get_items_with_state() );
		$view->get_view( 'admin-page' );
	}

	/**
	 * Adds screen notice
	 *
	 * @action admin_init
	 * @since 1.0.0
	 * @return void
	 */
	public function add_screen_notice() {

		$items_left = (int) $this->checklist->get_items_total() - (int) $this->checklist->get_completed_items_total();

		if ( 0 >= $items_left ) {
			return;
		}

		// Translators: numer of items.
		$message = esc_html( sprintf( _n( '%d checklist item left to complete.', '%d checklist items left to complete.', $items_left, 'tcassistant' ), $items_left ) ) . '<br><br>';

		// Translators: admin page link, link label.
		$message .= sprintf( '<a href="%s">%s</a>', admin_url( 'index.php?page=tcassistant' ), __( 'Go to the checklist', 'tcassistant' ) );

		$this->notices->add(
			$this->checklist->get_checksum(),
			esc_html__( 'The Camels Assistant', 'tcassistant' ),
			$message,
			array(
				'option_prefix' => 'tc_assistant',
			)
		);

		$this->notices->boot();

	}

}
