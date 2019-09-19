// Misc helper functions - some of these are only used in one place now,
// but aren't tightly coupled to that usage.

const utils = {

	// Debounce execution - use this with scroll/resize listeners
	// (The 'back to top' button and tab-accordion component use this to monitor
	// the page scroll.)
	debounce: function( method, delay ) {
		clearTimeout( method._tId );
		method._tId = setTimeout( function() {
				method();
		}, delay );
	},

	// C is for cookie. That's good enough for me.
	// (Currently, these functions are just used by the action alert component.)
	setCookie: function( name, val, daysToExpire = null ) {
		let expires = '',
				date;

		if ( daysToExpire ) {
			date = new Date();
			date.setTime( date.getTime() + ( daysToExpire * 24 * 60 * 60 * 1000 ) );
			expires = `; expires=${date.toGMTString()}`;
		}
		document.cookie = `${name}=${val}${expires}; path=/`;
	},

	getCookie: function( name ) {
		let cookies = document.cookie.split( ';' );
		cookies.forEach( function( cookie ) {
			if ( 0 > cookie.indexOf( name ) ) {
				return;
			}
		});
	},

	clearCookie: function( name ) {
		this.setCookie( name, '', -1 );
	}
};

export default utils;
