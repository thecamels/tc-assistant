<?php
/**
 * Scripts class
 *
 * @package the-camels-assistant
 */

namespace TheCamels\Assistant\Core;

use TheCamels\Assistant\Utils\Files;

/**
 * Scripts class
 */
class Scripts {

	/**
	 * Files class
	 *
	 * @var object
	 */
	private $files;

	/**
	 * Runtime class
	 *
	 * @var object
	 */
	private $runtime;

	/**
	 * Scripts constructor
	 *
	 * @since 1.0.0
	 * @param object $runtime Plugin Runtime class.
	 * @param Files  $files   Files class.
	 */
	public function __construct( $runtime, Files $files ) {
		$this->files   = $files;
		$this->runtime = $runtime;
	}

	/**
	 * Enqueue scripts and styles for admin
	 *
	 * @action admin_enqueue_scripts
	 *
	 * @since  1.0.0
	 * @param  string $page_hook current page hook.
	 * @return void
	 */
	public function enqueue_scripts( $page_hook ) {

		$allowed_hooks = apply_filters( 'tcassistant/scripts/allowed_hooks', array(
			$this->runtime->core_screen->page_hook,
		) );

		if ( ! in_array( $page_hook, $allowed_hooks, true ) ) {
			return;
		}

		wp_enqueue_style( 'tc-assistant', $this->files->asset_url( 'css', 'style.css' ), array(), $this->files->asset_mtime( 'css', 'style.css' ) );

		wp_enqueue_script( 'tc-assistant', $this->files->asset_url( 'js', 'main.js' ), array( 'jquery', 'wp-i18n' ), $this->files->asset_mtime( 'js', 'scripts.js' ), true );

		wp_set_script_translations( 'tc-assistant', 'tcassistant' );

	}

}
