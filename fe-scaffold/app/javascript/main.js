'use strict';

import TweenMax from 'gsap/TweenMax';
import EasePack from 'gsap/EasePack';
import Flickity from 'flickity-imagesloaded';
import modernizr from './modernizr.js';
import testObj from './test.js';
import collapsible from './collapsible.js';
import accordion from './accordion.js';


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
	accordion.init();
}

export default function () {
	testObj.test();
}

init();
