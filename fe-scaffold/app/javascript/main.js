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
import ltaForm from './lta';

import ThirdPartyScripts from './third-party-scripts';

const instances = [],
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
	ltaForm.init();

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
		});

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
			instance.runOnImageLoad(function () {
				instance.recalculate(true, true);
			});
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
	const loaders = document.querySelectorAll('.loader');
	if (loaders.length > 0) {
		loaders.forEach(loader => loader.style.display = 'none');
		const modules = document.querySelectorAll('section.module');
		modules.forEach(module => module.style.visibility = 'inherit');
	}
	// Init UI
	init();
	new ThirdPartyScripts();
};
