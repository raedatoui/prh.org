'use strict';

import TweenMax from 'gsap/TweenMax';
import EasePack from 'gsap/EasePack';
import Flickity from 'flickity-imagesloaded';
import modernizr from './modernizr.js';
import testObj from './test.js';


function init(){

	let carousel = document.querySelector('.carousel'),
			flickity = new Flickity(carousel, {
				cellAlign: 'left',
				imagesLoaded: true,
				adaptiveHeight: true,
				wrapAround: 'true'
			});
}

export default function () {
	testObj.test();
}

init();
