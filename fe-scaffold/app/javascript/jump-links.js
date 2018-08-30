// Jump links - smooth same-page scrolling. Binds on the 'jump-link' class.
// Uses jump.js [https://github.com/callmecavs/jump.js]
// Note: the 'back to top' button takes advantage of this, but doesn't depend on it;
// if JS fails to load, all internal links should fall back and work as normal hash anchors.

import jump from 'jump.js';

var jumpLinks = {
  links: document.querySelectorAll( '.jump-link' ),
  adminBar: document.getElementById( 'wpadminbar' ),
  nav: document.getElementById( 'site-header' ),
  baseOffset: -100, // the desired gap between the (non fixed) viewport top and the anchor
  jumpScroll: function( e ) {

    e.preventDefault();
    const dest = document.querySelector( e.target.hash ),
        isNavFixed = !! ( 'fixed' === window.getComputedStyle( this.nav, null ).position );
    let offset = this.baseOffset;

    // We have to tweak the offset depending on the current states of the nav and admin bar,
    // which are affected by user status (logged-in vs not) and viewport size.
    // Any elements that are fixed have to be accounted for in the offset,
    // and hero anchors need a little adjustment.

    if ( isNavFixed ) {
      offset -= this.nav.clientHeight;
    }

    if ( this.adminBar ) {
      offset -= this.adminBar.clientHeight;
    }

    if ( '#hero' === e.target.hash ) {
      offset -= this.nav.clientHeight;
    }

    jump( dest, {
        duration: 1000,
        offset: offset,
        a11y: true
      }
    );
  },
  init: function() {
    for ( let i = 0; i < this.links.length; i++ ) {
      this.links[i].addEventListener( 'click', this.jumpScroll.bind( this ) );
    }
  }
};

export default jumpLinks;
