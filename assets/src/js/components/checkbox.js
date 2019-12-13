/**
 * External dependencies
 */
import $ from 'jquery';

export default class Checkbox {
	constructor() {
		this.items = document.getElementsByClassName( 'tc-assistant-item' );

		this.listenChanges = this.listenChanges.bind( this );

		if ( this.items.length ) {
			this.init();
		}
	}

	init() {
		[ ...this.items ].forEach( this.listenChanges );
	}

	listenChanges( item ) {
		const checkboxes = item.querySelector( 'input[type="checkbox"]' );
		checkboxes.addEventListener( 'change', this.highlightItem );
		checkboxes.addEventListener( 'change', this.saveItemState );
	}

	highlightItem( event ) {
		const checkbox = event.currentTarget;
		const itemWrap = checkbox.parentElement.parentElement;

		if ( checkbox.checked ) {
			itemWrap.classList.add( 'completed' );
		} else {
			itemWrap.classList.remove( 'completed' );
		}
	}

	saveItemState( event ) {
		const checkbox = event.currentTarget;

		/* global ajaxurl */
		$.post( ajaxurl, {
			action: 'tc_assistant_save_item',
			item_id: checkbox.name,
			nonce: checkbox.getAttribute( 'data-nonce' ),
			checked: checkbox.checked,
		} );
	}
}
