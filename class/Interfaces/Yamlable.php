<?php
/**
 * Yamlable class
 *
 * @package the-camels-assistant
 */

namespace TheCamels\Assistant\Interfaces;

/**
 * Yamlable interface.
 */
interface Yamlable {

	/**
	 * Gets config from YAML file.
	 *
	 * @since 1.0.0
	 * @return []
	 */
	public function get_config();

	/**
	 * Gets config from YAML file.
	 *
	 * @since 1.0.0
	 * @param string $filename File full path.
	 * @return void
	 */
	public function load_file( $filename );

}
