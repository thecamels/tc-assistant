<?php
/**
 * Assistant admin page template
 *
 * @package the-camels-assistant
 */

?>

<div class="tc-assistant-wrap">

	<div class="tc-assistant-header">
		<h1><?php esc_html_e( 'The Camels Assistant', 'tcassistant' ); ?></h1>
	</div>

	<hr class="wp-header-end">

	<div class="tc-assistant-body">

		<div class="tc-assistant-category">
			<h2>Category one</h2>

			<div class="tc-assistant-item">
				<div class="checkbox-col"><input type="checkbox" name="tc_assistant_item[0]"></div>
				<div class="content-col">
					<h3>Checklist item lorem ipsum dolor, sit amet consectetur adipisicing elit. Eaque at repellendus aliquam explicabo id perspiciatis quasi corrupti.</h3>
					<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Molestiae doloribus officiis architecto suscipit blanditiis inventore minima earum veniam. Assumenda repellendus libero vero odio unde commodi voluptatum praesentium quam optio eveniet!</p>
					<a href="#" class="button button-secondary">Read More</a>
				</div>
			</div>

			<div class="tc-assistant-item completed">
				<div class="checkbox-col"><input type="checkbox" checked name="tc_assistant_item[1]"></div>
				<div class="content-col">
					<h3>Checklist item</h3>
					<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Molestiae doloribus officiis architecto suscipit blanditiis inventore minima earum veniam. Assumenda repellendus libero vero odio unde commodi voluptatum praesentium quam optio eveniet!</p>
					<a href="#" class="button button-secondary">Read More</a>
				</div>
			</div>
		</div>

		<div class="tc-assistant-category">
			<h2>Category two</h2>

			<div class="tc-assistant-item">
				<div class="checkbox-col"><input type="checkbox" name="tc_assistant_item[2]"></div>
				<div class="content-col">
					<h3>Checklist item lorem ipsum dolor, sit amet consectetur adipisicing elit. Eaque at repellendus aliquam explicabo id perspiciatis quasi corrupti.</h3>
					<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Molestiae doloribus officiis architecto suscipit blanditiis inventore minima earum veniam. Assumenda repellendus libero vero odio unde commodi voluptatum praesentium quam optio eveniet!</p>
					<a href="#" class="button button-secondary">Read More</a>
				</div>
			</div>

			<div class="tc-assistant-item completed">
				<div class="checkbox-col"><input type="checkbox" checked name="tc_assistant_item[3]"></div>
				<div class="content-col">
					<h3>Checklist item</h3>
					<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Molestiae doloribus officiis architecto suscipit blanditiis inventore minima earum veniam. Assumenda repellendus libero vero odio unde commodi voluptatum praesentium quam optio eveniet!</p>
					<a href="#" class="button button-secondary">Read More</a>
				</div>
			</div>
		</div>

	</div>

</div>
