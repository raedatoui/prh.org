// Simple alert banner feature, with some cookie handling to save hide/show preferences.
// The actual cookie manipulation methods are defined in ./utils.
// See template-parts/modules/action-alert.php for markup
// (and the PHP-based part of the cookie handling.)

import utils from './utils';

const alertBanner = {
	banner: document.getElementById( 'alert-banner' ),
	closeBtn: document.getElementById( 'close-alert' ),
	getAlertId: function() {
		return this.banner.getAttribute( 'data-timestamp' );
	},
	hideBanner: function() {
		this.banner.classList.add( 'is-hidden' );
		if (document.getElementById( 'alert-banner' ).className.split('voc').length === 1) {
			utils.setCookie( 'alertClosed', true );
			utils.setCookie( 'alertID', this.getAlertId() );
		}
	},
	init: function() {
		if ( this.closeBtn ) {
			this.closeBtn.addEventListener( 'click', this.hideBanner.bind( this ) );
		}
	}
};

export default alertBanner;
