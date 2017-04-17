'use strict';

import TweenMax from 'gsap/TweenMax';
import EasePack from 'gsap/EasePack';
import Flickity from 'flickity-imagesloaded';
import TabAccordion from 'storm-tab-accordion';
import modernizr from './modernizr.js';
import collapsible from './collapsible.js';


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

	collapsible.init();
  // TabAccordion.init('.tab-component', {
  //   tabClass: '.tab-component__tab',
  //   titleClass: '.tab-component__title',
  //   currentClass: 'active',
  //   active: 0
  // });

  TabAccordion.init('.js-tab-accordion');
}


init();
