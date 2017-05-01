'use strict';

import './polyfills';
import TweenMax from 'gsap/TweenMax';
import EasePack from 'gsap/EasePack';
import Flickity from 'flickity-imagesloaded';
import TabAccordion from './tabbordion';
import modernizr from './modernizr.js';
import collapsible from './collapsible.js';
import accordion from './accordion.js';
import nav from './nav.js';


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

}


init();
