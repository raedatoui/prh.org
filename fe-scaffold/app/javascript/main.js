'use strict';

import TweenMax from 'gsap/TweenMax';
import EasePack from 'gsap/EasePack';
import testObj from './test.js';

function init(){
  console.log("HELLO!");

  //var obj={x:0};
  //TweenMax.to(obj, .1, {x:.1});

}

export default function () {
  testObj.test();
  console.log("FOO");
}
