// All the logic for the nav lives here: dropdown hide/show,
// small-screen "hamburger button" behavior, and the search bar.
const nav = {
	init: function() {
		const $nav = document.querySelector( '.site-nav' ),
			$header = document.querySelector( '.site-header' ),
			$menuButton = document.querySelector( '#menu-btn' ),
			$triggers = $nav.querySelectorAll( '.menu-item > a' ),
			$menuItems = $nav.querySelectorAll( '.menu > li' ),
			$mask = document.querySelector( '.nav-mask' ),
			$searchField = document.querySelector( '.search-field' ),
			$searchButton = document.querySelector( '#site-search-btn' ),

		// Track the focusable elements so we can trap focus in the menu
		$focusables = ( function getFocusables() {
			let focusables = [ $menuButton ],
					$links = $nav.querySelectorAll( 'a' ),
					$buttons = $nav.querySelectorAll( 'button' );

			Array.prototype.forEach.call( $links, function( $link ) {
				focusables.push( $link );
			});

			Array.prototype.forEach.call( $buttons, function( $button ) {
				focusables.push( $button );
			});

			return focusables;
		}() ),

		// Here's the trap!
		handleBlur = function( e ) {
			if ( $focusables.lastIndexOf( e.target ) === $focusables.length - 1 ) {
				$menuButton.focus();
			}
		},

		// Listen for 'esc' if the menu's open
		handleKeyup = function( e ) {
			if ( 'Escape' === e.key | 'Esc' === e.key ) {
				closeNav();
				$header.classList.remove( 'search-open' );
			}
		},

		// Show or hide the whole menu
		toggleNav = function() {
			$header.classList.remove( 'search-open' );
			$menuButton.setAttribute( 'aria-expanded', ! $menuButton.getAttribute( 'aria-expanded' ) );
			$nav.classList.toggle( 'is-expanded' );
			$header.classList.toggle( 'is-expanded' );
		},

		// Just hide it
		// TODO: should probably refactor toggleNav to take a param and use that
		closeNav = function() {
			$menuButton.setAttribute( 'aria-expanded', false );
			$nav.classList.remove( 'is-expanded' );
			$header.classList.remove( 'is-expanded' );

			for ( let i = 0; i < $menuItems.length; i++ ) {
				$menuItems[i].classList.remove( 'is-expanded' );
			}
		},

		// Expand a sub-menu when its sibling <a> is clicked
		expandSubnav = function( e ) {
			const $target = e.target.parentNode;
			let i;

			// Search or nav can be expanded, but not both
			$header.classList.remove( 'search-open' );

			// Don't do anything special if we didn't click a top-level link
			if ( $target.parentNode.classList.contains( 'sub-menu' ) ) {
				return;
			}

			e.preventDefault();

			for ( i = 0; i < $menuItems.length; i++ ) {
				if ( $target !== $menuItems[i]) {
					$menuItems[i].classList.remove( 'is-expanded' );
				}
			}

			$target.classList.toggle( 'is-expanded' );
		},

		// Toggle the visibility of the search bar when the [Q] is cicked
		toggleSearchBar = function() {
			if ( $header.classList.contains( 'search-open' ) ) {
				$header.classList.remove( 'search-open' );
				return;
			}
			closeNav();
			$header.classList.add( 'search-open' );
			$searchField.focus();
			return;
		};


		// Add event listeners
		for ( let i = 0; i < $triggers.length; i++ ) {
			let trigger = $triggers[i];
			trigger.addEventListener( 'click', expandSubnav );
		}

		$focusables.forEach( function( item ) {
			item.addEventListener( 'blur', handleBlur );
		});

		$menuButton.addEventListener( 'click', toggleNav );
		if ( $searchButton ) {
			$searchButton.addEventListener( 'click', toggleSearchBar );
		}
		$mask.addEventListener( 'click', closeNav );
		window.addEventListener( 'keyup', handleKeyup );
	}
};

export default nav;
