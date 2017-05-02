'use strict';

import './polyfills';
import TweenMax from 'gsap/TweenMax';
import EasePack from 'gsap/EasePack';
import Flickity from 'flickity-imagesloaded';
import TabAccordion from './tabbordion';
import modernizr from './modernizr.js';
import collapsible from './collapsible.js';
import accordion from './accordion.js';
import macy from 'macy';

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
			macy.init({
				container: '#'+cards[i].id,
				trueOrder: false,
				waitForImages: false,
				margin: 0,
				columns: 3,
				breakAt: {
					1200: 3,
					978: 2,
					760: 1,
				}
			});
		}
	}

}


init();
