<?php
/**
 * Runtime
 *
 * @package the-camels-assistant
 */

namespace TheCamels\Assistant;

use TheCamels\Assistant\Utils;

/**
 * Runtime class
 */
class Runtime extends Utils\DocHooks {

	/**
	 * Plugin file full path
	 *
	 * @var string
	 */
	public $plugin_file;

	/**
	 * Class constructor
	 *
	 * @since 1.0.0
	 * @param string $plugin_file plugin main file full path.
	 */
	public function __construct( $plugin_file ) {
		$this->plugin_file = $plugin_file;
	}

	/**
	 * Loads needed files
	 *
	 * @since  1.0.0
	 * @return void
	 */
	public function boot() {

		$this->singletons();
		$this->load_functions();
		$this->actions();

		do_action( 'thecamels/assistant/boot/initial' );

	}

	/**
	 * Registers all the hooks with DocHooks
	 *
	 * @since  1.0.0
	 * @return void
	 */
	public function register_hooks() {

		$this->add_hooks();

		foreach ( get_object_vars( $this ) as $instance ) {
			if ( is_object( $instance ) ) {
				$this->add_hooks( $instance );
			}
		}

	}

	/**
	 * Creates needed classes
	 * Singletons are used for a sake of performance
	 *
	 * @since  1.0.0
	 * @return void
	 */
	public function singletons() {

		$this->files = new Utils\Files( $this->plugin_file );

		$this->options     = new Core\Options();
		$this->scripts     = new Core\Scripts( $this, $this->files );
		$this->checklist   = new Core\Checklist( $this->files, $this->options );
		$this->core_screen = new Core\Screen( $this->checklist );

	}

	/**
	 * All WordPress actions this plugin utilizes
	 *
	 * @since  1.0.0
	 * @return void
	 */
	public function actions() {

		$this->register_hooks();

		register_uninstall_hook( $this->plugin_file, array( 'TheCamels\Assistant\Core\Uninstall', 'remove_plugin_data' ) );

		// DocHooks compatibility.
		$hooks_file = $this->files->file_path( 'inc/hooks.php' );
		if ( ! tc_assistant_dochooks_enabled() && file_exists( $hooks_file ) ) {
			include_once $hooks_file;
		}

	}

	/**
	 * Loads functions
	 *
	 * @since  1.0.0
	 * @return void
	 */
	public function load_functions() {

		require_once $this->files->file_path( 'inc/functions/general.php' );

	}

	/**
	 * Returns new View object
	 *
	 * @since  1.0.0
	 * @return View view object
	 */
	public function view() {
		return new Utils\View( $this->files );
	}


}
