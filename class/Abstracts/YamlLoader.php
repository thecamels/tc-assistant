<?php
/**
 * YamlLoader class
 *
 * @package the-camels-assistant
 */

namespace TheCamels\Assistant\Abstracts;

use TheCamels\Assistant\Interfaces;
use Symfony\Component\Yaml\Yaml;
use Symfony\Component\Yaml\Exception\ParseException;

/**
 * YamlLoader class
 */
abstract class YamlLoader implements Interfaces\Yamlable {

	/**
	 * Class constructor
	 *
	 * @since 1.0.0
	 * @param string $filename YAML file.
	 */
	public function __construct( $filename ) {
		$this->load_file( $filename );
	}

	/**
	 * Gets config from YAML file.
	 *
	 * @since 1.0.0
	 * @return []
	 */
	public function get_config() {
		return $this->config;
	}

	/**
	 * Gets config from YAML file.
	 *
	 * @since 1.0.0
	 * @param string $filename File full path.
	 * @return void
	 */
	public function load_file( $filename ) {
		try {
			$this->config = Yaml::parseFile( $filename );
		} catch ( ParseException $exception ) {
			$this->config = null;
		}
	}

}
