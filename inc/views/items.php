<?php
/**
 * Assistant items template
 *
 * @package the-camels-assistant
 */

?>

<?php foreach ( $this->get_var( 'checklist' ) as $category ) : ?>
	<div class="tc-assistant-category">
		<h2><?php echo esc_html( $category['category'] ); ?></h2>
		<?php foreach ( $category['items'] as $item_id => $item ) : ?>
			<div class="tc-assistant-item">
				<div class="checkbox-col"><input type="checkbox" name="<?php echo esc_attr( $item_id ); ?>"></div>
				<div class="content-col">
					<h3><?php echo esc_html( $item['title'] ); ?></h3>
					<?php if ( ! empty( $item['description'] ) ) : ?>
						<p><?php echo esc_html( $item['description'] ); ?></p>
					<?php endif; ?>
					<?php if ( ! empty( $item['link'] ) ) : ?>
						<a href="<?php echo esc_url_raw( $item['link'] ); ?>" target="_blank" class="button button-secondary">
							<?php if ( ! empty( $item['link_label'] ) ) : ?>
								<?php echo esc_html( $item['link_label'] ); ?>
							<?php else : ?>
								<?php esc_html_e( 'Read More', 'tcassistant' ); ?>
							<?php endif; ?>
						</a>
					<?php endif; ?>
				</div>
			</div>
		<?php endforeach; ?>
	</div>
<?php endforeach; ?>
