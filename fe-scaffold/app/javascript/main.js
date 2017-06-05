'use strict';

import './polyfills';
import Flickity from 'flickity-imagesloaded';
import Macy from 'macy';
import modernizr from './modernizr.js';
import Clipboard from 'clipboard';

import TabAccordion from './tabbordion';
import collapsible from './collapsible';
import accordion from './accordion';
import nav from './nav';
import jumpLinks from './jump-links';
import backToTop from './back-to-top';
import alertBanner from './action-alert.js';

function init(){

	nav.init();
	accordion.init();
	collapsible.init();
	backToTop.init();
	alertBanner.init();

	let carousel = document.querySelector('.carousel'),
			tabs = document.querySelector('.tab-accordion'),
			cards = document.querySelectorAll('.macy-grid'),
			jumps = document.querySelectorAll('.jump-link'),
			permalink = document.querySelector('.permalink-icon');

	if (permalink) {
		var clipboard = new Clipboard(permalink),
				clipStatus = permalink.nextElementSibling;

		clipboard.on('success', function() {
			clipStatus.classList.add('is-visible');
			setTimeout(function () {
				clipStatus.classList.remove('is-visible');
			}, 2000);
		});
	}

	if (carousel) {
		new Flickity(carousel, {
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
			let instance = Macy({
				container: '#'+cards[i].id,
				trueOrder: true,
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
