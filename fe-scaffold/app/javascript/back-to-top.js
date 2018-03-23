// Show a 'back to top' jumplink button if the user's scrolled far enough.
// See ./utils.js for the debounce helper, ./jump-links.js for the smooth-scroll logic,
// template-parts/components/back-to-top-button.php for the markup.

import utils from './utils';

var backToTop = {

  init: function() {
    let el = document.getElementById( 'btt-button' ),
        contentHeight = document.body.scrollHeight,
        minHeight = window.innerHeight,
        handleScroll = function() {
          ( window.scrollY > minHeight / 3 ) ? el.classList.add( 'is-visible' ) : el.classList.remove( 'is-visible' );
        };

    if ( contentHeight <= minHeight ) {
      return;
    }

    window.addEventListener( 'scroll', function() {
      utils.debounce( handleScroll, 300 );
    });
  }
};

export default backToTop;
