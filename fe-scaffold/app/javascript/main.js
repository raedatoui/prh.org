'use strict';

import TweenMax from 'gsap/TweenMax';
import EasePack from 'gsap/EasePack';
import Flickity from 'flickity-imagesloaded';
import modernizr from './modernizr.js';
import TabAccordion from 'storm-tab-accordion';


function init(){

	let carousel = document.querySelector('.carousel'),
			flickity = new Flickity(carousel, {
				cellAlign: 'left',
				imagesLoaded: true,
				adaptiveHeight: true,
				wrapAround: 'true'
			});

  TabAccordion.init('.tab-component');
}

init();
