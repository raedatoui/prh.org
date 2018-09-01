// A simple accordion component, built with accessibility in mind.
// See template-parts/modules/accordion-section.php for sample markup.
// Styles are in scss/partials/accordions.
// Note: the "tab-accordion" module shares some of those styles, but uses different JS;
// see './tabbordion.js'.

const accordion = {
	triggers: [],
	targets: [],
	init: function() {
		this.triggers = document.querySelectorAll( '.accordion-title' );
		this.targets = document.querySelectorAll( '.accordion-content' );

		let i,
		toggle = function( ev ) {
			let button = ev.currentTarget,
					target = document.querySelector( '[aria-labelledby=accordion-label-' + button.getAttribute( 'aria-controls' ) + ']' ),
					state = ( 'false' === button.getAttribute( 'aria-expanded' ) || false ) ? true : false;
			target.classList.toggle( 'is-active' );
			button.setAttribute( 'aria-expanded', state );
			target.setAttribute( 'aria-hidden', ! state );
		};

		for ( i = 0; i < this.triggers.length; i++ ) {
			let trigger = this.triggers[i],
					index = 'collapsible--' + i,
					button = document.createElement( 'button' ),
					target = trigger.nextElementSibling,
					state = !! trigger.getAttribute( 'data-state' );

			button.id = 'accordion-label-' + index;
			button.setAttribute( 'aria-controls', index );
			button.setAttribute( 'aria-expanded', state );
			button.innerHTML = trigger.innerHTML;
			button.addEventListener( 'click', toggle, false );

			trigger.innerHTML = '';
			trigger.appendChild( button );

			if ( state ) {
				target.classList.add( 'is-active' );
			}

			target.id = index;
			target.setAttribute( 'aria-labelledby', 'accordion-label-' + index );
			target.setAttribute( 'aria-hidden', 'true' );
		}
	}
};

export default accordion;
