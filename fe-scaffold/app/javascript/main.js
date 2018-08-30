'use strict';

import './polyfills';
import Flickity from 'flickity-imagesloaded';
import Macy from 'macy';
import Clipboard from 'clipboard';

import TabAccordion from './tabbordion';
import collapsible from './collapsible';
import accordion from './accordion';
import nav from './nav';
import jumpLinks from './jump-links';
import backToTop from './back-to-top';
import alertBanner from './action-alert.js';
import vocForm from './voc';


var instances = [],
	ytPlayers = {};

window.macyInstances = instances;
window.ytPlayers = ytPlayers;
window.currentPlayer = null;

function init() {
	nav.init();
	accordion.init();
	collapsible.init();
	backToTop.init();
	alertBanner.init();
	vocForm.init();

	let carousel = document.querySelector( '.carousel' ),
			tabs = document.querySelector( '.tab-accordion' ),
			cards = document.querySelectorAll( '.macy-grid' ),
			jumps = document.querySelectorAll( '.jump-link' ),
			permalink = document.querySelector( '.permalink-icon' );

	if ( permalink ) {
		const clipboard = new Clipboard( permalink ),
				clipStatus = permalink.nextElementSibling;

		clipboard.on( 'success', function() {
			clipStatus.classList.add( 'is-visible' );
			setTimeout( function() {
				clipStatus.classList.remove( 'is-visible' );
			}, 2000 );
		});
	}

	if ( carousel ) {
		const slider = new Flickity( carousel, {
			cellAlign: 'left',
			imagesLoaded: true,
			adaptiveHeight: true,
			wrapAround: 'true'
		}),

		loadYTScripts = (YT, YTConfig) => {
			YT.ready = (f) => {
				if (YT.loaded) {
					f();
				} else {
					l.push(f);
				}
			};

			window.onYTReady = () => {
				YT.loaded = 1;
				for (let i = 0; i < l.length; i++) {
					try {
						l[i]();
					} catch (e) {
						console.log(e);
					}
				}
			};

			YT.setConfig = (c) => {
				for (var k in c) {
					if (c.hasOwnProperty(k)) {
						YTConfig[k] = c[k];
					}
				}
			};

			let l = [],
				a = document.createElement('script'),
				b = document.getElementsByTagName('script')[0];
			a.type = 'text/javascript';
			a.id = 'www-widgetapi-script';
			a.src = 'https://s.ytimg.com/yts/jsbin/www-widgetapi-vflOozvUR/www-widgetapi.js';
			a.async = true;
			if (b.parentNode) {
				b.parentNode.insertBefore(a, b);
			}
		},

		loadYT = () => {
			let YT = window['YT'],
				YTConfig = window['YTConfig'];
			if (!YT) {
				YT = {
					loading: 0,
					loaded: 0
				};
			}

			if (!YTConfig) {
				YTConfig = {
					host: 'http://www.youtube.com'
				};
			}

			if (!YT.loading) {
				YT.loading = 1;
				loadYTScripts(YT, YTConfig);
			}
		};

		window.onYouTubeIframeAPIReady = () => {
			const embeds = document.querySelectorAll( '.youtube-video' );
			for ( let i = 0; i < embeds.length; i++ ) {
				const ytid = embeds[i].id;
				ytPlayers[ytid] = new YT.Player(ytid, {
					videoId: ytid,
					width: '100%',
					height: '100%',
				});
			}
			slider.on('select', () => {
				if (window.currentPlayer !== null) {
					const player = window.ytPlayers[window.currentPlayer];
					if (player) {
						player.pauseVideo();
					}
				}
				const el = slider.selectedCell.element.firstElementChild;
				if (el.classList.contains('video')) {
					const iframe = el.querySelector('.youtube-video');
					if (iframe) {
						window.currentPlayer = iframe.id;
					}
				}
			});
		};

		loadYT();
	}

	if ( tabs ) {
		TabAccordion.init( '.tab-accordion', {
			tabClass: '.tab-nav-title',
			titleClass: '.tab-section-title',
			currentClass: 'active',
			active: 0
		});
	}

	if ( 0 < cards.length ) {
		for ( let i = 0; i < cards.length; i++ ) {
			let instance = Macy({
				container: '#' + cards[i].id,
				trueOrder: true,
				waitForImages: false,
				margin: 0,
				columns: 3,
				breakAt: {
					1200: 3,
					992: 2,
					768: 1
				}
			});
			instances.push( instance );
		}
		setTimeout( function() {
			for ( let i = 0; i < instances.length; i++ ) {
				instances[i].recalculate();
			}
		}, 250 );
	}

	if ( 0 < jumps.length ) {
		jumpLinks.init();
	}
}

window.onload = function() {
	init();

	// Google Analytics
	(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
	new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
	j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
	'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
	})(window,document,'script','dataLayer','GTM-PDFCFTR');	

	// Hotjar Tracking Code for www.prh.org
	(function(h,o,t,j,a,r){
		h.hj=h.hj||function(){(h.hj.q=h.hj.q||[]).push(arguments)};
		h._hjSettings={hjid:775714,hjsv:6};
		a=o.getElementsByTagName('head')[0];
		r=o.createElement('script');r.async=1;
		r.src=t+h._hjSettings.hjid+j+h._hjSettings.hjsv;
		a.appendChild(r);
	})(window,document,'https://static.hotjar.com/c/hotjar-','.js?sv=');	
};
