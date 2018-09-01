// Simple, accessible hide/show behavior,
// used for our "read more" breaks on certain long pages.
// (Not to be confused with the accordion module.)
// If JS fails to load, this should fall back gracefully and leave the content accessible.
// template-parts/modules/overview.php has some example markup.

const collapsible = {
	triggers: [],
	targets: [],
	init: function() {
		this.triggers = document.querySelectorAll( '.collapse-link' );
		this.targets = document.querySelectorAll( '.collapsible' );

		Array.prototype.forEach.call( this.targets, function( target ) {
			target.setAttribute( 'aria-hidden', true );
		});

		Array.prototype.forEach.call( this.triggers, function( trigger ) {
			trigger.addEventListener( 'click', function( e ) {
				e.preventDefault();

				let t = document.querySelector( e.target.hash ),
					oldState = t.getAttribute( 'aria-hidden' ),
					newState = ( 'true' === oldState ? 'false' : 'true' );

				t.classList.toggle( 'is-collapsed' );
				t.setAttribute( 'aria-hidden', newState );
			});
		});

	}
};

export default collapsible;
