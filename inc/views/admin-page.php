<?php
/**
 * Assistant admin page template
 *
 * @package the-camels-assistant
 */

?>

<div class="tc-assistant-wrap">

	<div class="tc-assistant-header">
		<h1><?php esc_html_e( 'Thecamels Assistant', 'tcassistant' ); ?></h1>
	</div>

	<hr class="wp-header-end">

	<div class="tc-assistant-body">

		<?php
		if ( empty( $this->get_var( 'checklist' ) ) ) {
			$this->get_view( 'empty-checklist' );
		} else {
			$this->get_view( 'items' );
		}
		?>

	</div>

</div>
