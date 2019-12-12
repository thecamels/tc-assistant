<?php
/**
 * General functions
 *
 * @package the-camels-assistant
 */

/**
 * Adds handlers for doc hooks to an object
 *
 * @since  1.0.0
 * @param  object $object Object to create the hooks.
 * @return object
 */
function tc_assistant_add_doc_hooks( $object ) {
	$dochooks = new TheCamels\Assistant\Utils\DocHooks();
	$dochooks->add_hooks( $object );
	return $object;
}

/**
 * Creates new View object.
 *
 * @since  1.0.0
 * @return TheCamels\Assistant\Utils\View
 */
function tc_assistant_create_view() {
	return tc_assistant_runtime()->view();
}

/**
 * Creates new AJAX Handler object.
 *
 * @since  1.0.0
 * @return TheCamels\Assistant\Utils\Ajax
 */
function tc_assistant_ajax_handler() {
	return new TheCamels\Assistant\Utils\Ajax();
}

/**
 * Checks if the DocHooks are enabled and working.
 *
 * @since  1.0.0
 * @return boolean
 */
function tc_assistant_dochooks_enabled() {

	if ( ! class_exists( 'TheCamelsAssistantDocHookTest' ) ) {
		/**
		 * TheCamelsAssistantDocHookTest class
		 */
		class TheCamelsAssistantDocHookTest {
			/**
			 * Test method
			 *
			 * @action test 10
			 * @return void
			 */
			public function test_method() {}
		}
	}

	$reflector = new \ReflectionObject( new TheCamelsAssistantDocHookTest() );

	foreach ( $reflector->getMethods() as $method ) {
		$doc = $method->getDocComment();
		return (bool) strpos( $doc, '@action' );
	}
}
