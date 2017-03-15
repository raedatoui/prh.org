(function (global, factory) {
	typeof exports === 'object' && typeof module !== 'undefined' ? factory(exports) :
	typeof define === 'function' && define.amd ? define(['exports'], factory) :
	(factory((global.mainBundle = global.mainBundle || {})));
}(this, (function (exports) { 'use strict';

var testObj = function () {
  console.log("TESSSST!!!");
};

//import TweenMax from 'gsap/TweenMax';
//import EasePack from 'gsap/EasePack';
var main = function () {

  testObj.test();

};

exports['default'] = main;

Object.defineProperty(exports, '__esModule', { value: true });

})));

//# sourceMappingURL=bundle.js.map
