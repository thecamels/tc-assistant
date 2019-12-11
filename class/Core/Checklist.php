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
	 * Fallback for Yaml file
	 *
	 * @var string
	 */
	private $fallback_filename = 'inc/checklist/checklist-en.yaml';

	/**
	 * Class constructor
	 *
	 * @since 1.0.0
	 * @param Files $files Files instance.
	 */
	public function __construct( Files $files ) {

		$this->files = $files;

		$lang = substr( get_locale(), 0, 2 );
		$file = sprintf( 'inc/checklist/checklist-%s.yaml', $lang );

		if ( $this->files->file_exists( $file ) ) {
			$config_file = $this->files->file_path( $file );
		} else {
			$config_file = $this->files->file_path( $this->fallback_filename );
		}

		parent::__construct( $config_file );

	}

}
