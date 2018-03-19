// A barebones version of our 'main.js', specifically for third-party pages.
// Initializes just the nav and 'read more' functionality; that's all those pages need.

'use strict';

import collapsible from './collapsible';
import nav from './nav';

function init() {
	nav.init();
	collapsible.init();
}

window.onload = function() {
	init();
};
