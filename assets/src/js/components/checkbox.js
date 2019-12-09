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
}
