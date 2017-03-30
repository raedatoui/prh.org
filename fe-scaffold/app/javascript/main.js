'use strict';

import TweenMax from 'gsap/TweenMax';
import EasePack from 'gsap/EasePack';
import Flickity from 'flickity';
import modernizr from './modernizr.js';
import testObj from './test.js';


function init(){

  let carousel = document.querySelector('.carousel');
  let flickity = new Flickity(carousel, {
    cellAlign: 'left',
    imagesLoaded: true,
    adaptiveHeight: true,
    wrapAround: 'true'

  });

  //var obj={x:0};
  //TweenMax.to(obj, .1, {x:.1});

}


export default function () {
  testObj.test();
  console.log("FOO");
}

init();
