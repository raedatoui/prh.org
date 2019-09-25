if ( 'function' !== typeof Object.assign ) {
  Object.assign = function( target ) { // .length of function is 2
    'use strict';
    if ( null === target ) { // TypeError if undefined or null
      throw new TypeError( 'Cannot convert undefined or null to object' );
    }

    let to = Object( target );

    for ( let index = 1; index < arguments.length; index++ ) {
      let nextSource = arguments[index];

      if ( null !== nextSource ) { // Skip over if undefined or null
        for ( let nextKey in nextSource ) {

          // Avoid bugs when hasOwnProperty is shadowed
          if ( Object.prototype.hasOwnProperty.call( nextSource, nextKey ) ) {
            to[nextKey] = nextSource[nextKey];
          }
        }
      }
    }
    return to;
  };
}
