'use strict';

import './polyfills';
import Flickity from 'flickity-imagesloaded';
import Macy from 'macy';
import modernizr from './modernizr.js';

import TabAccordion from './tabbordion';
import collapsible from './collapsible';
import accordion from './accordion';
import nav from './nav';
import jumpLinks from './jump-links';

function init(){

	nav.init();
	accordion.init();
	collapsible.init();

	let carousel = document.querySelector('.carousel'),
			tabs = document.querySelector('.tab-accordion'),
			cards = document.querySelectorAll('.macy-grid'),
			jumps = document.querySelectorAll('.jump-link');


	if (carousel) {
		let flickity = new Flickity(carousel, {
			cellAlign: 'left',
			imagesLoaded: true,
			adaptiveHeight: true,
			wrapAround: 'true'
		});
	}

	if (tabs) {
		TabAccordion.init('.tab-accordion', {
			tabClass: '.tab-nav-title',
			titleClass: '.tab-section-title',
			currentClass: 'active',
			active: 0
		});
	}
	
	if (cards.length > 0) {
		var instances = [];
		for(let i = 0; i < cards.length; i++) {
			var instance = Macy({
				container: '#'+cards[i].id,
				trueOrder: false,
				waitForImages: false,
				margin: 0,
				columns: 3,
				breakAt: {
					1200: 3,
					992: 2,
					768: 1
				}
			});
			instances.push(instance);
		}
		setTimeout(function() {
			for(let i = 0; i < instances.length; i++) {
				instances[i].recalculate();
			}
		}, 100);
	}

	if (jumps.length > 0) {
		jumpLinks.init();
	}
}

window.onload = function() {
	init();
}
