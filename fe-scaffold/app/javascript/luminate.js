'use strict';

import collapsible from './collapsible';
import nav from './nav';

function init(){
	nav.init();
	collapsible.init();
}

window.onload = function() {
	init();
}
