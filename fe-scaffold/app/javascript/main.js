'use strict';

import './polyfills';
import TweenMax from 'gsap/TweenMax';
import EasePack from 'gsap/EasePack';
import Flickity from 'flickity-imagesloaded';
import Macy from 'macy';
import modernizr from './modernizr.js';

import TabAccordion from './tabbordion';
import collapsible from './collapsible';
import accordion from './accordion';
import nav from './nav';

function init(){

	let carousel = document.querySelector('.carousel');
	if (carousel) {
		let flickity = new Flickity(carousel, {
			cellAlign: 'left',
			imagesLoaded: true,
			adaptiveHeight: true,
			wrapAround: 'true'
		});
	}

	nav.init();
	accordion.init();
	collapsible.init();

	let tabs = document.querySelector('.tab-accordion');
	if (tabs) {
		TabAccordion.init('.tab-accordion', {
			tabClass: '.tab-nav-title',
			titleClass: '.tab-section-title',
			currentClass: 'active',
			active: 0
		});
	}
	
	let cards = document.querySelectorAll('.macy-grid');
	if (cards.length > 0) {
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
			instance.recalculate();
		}
	}

}


init();
