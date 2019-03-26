export default class ThirdPartyScripts {
	constructor() {
		this.loadGA(window, document, 'script', 'dataLayer', 'GTM-PDFCFTR');
		this.loadHotjar(window, document, 'https://static.hotjar.com/c/hotjar-', '.js?sv=');
		this.loadYTScripts();
		this.initCalendar();
		this.initFacebook(document, 'script', 'facebook-jssdk');
		this.initTwitter(document, 'script', 'twitter-wjs');
	}

	// Google Analytics
	loadGA(w, d, s, l, i) {
		w[l] = w[l] || [];
		w[l].push({
			'gtm.start': new Date().getTime(),
			event: 'gtm.js'
		});
		const f = d.getElementsByTagName(s)[0],
			j = d.createElement(s),
			dl = l !== 'dataLayer' ? '&l=' + l : '';
		j.async = true;
		j.src = 'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
		f.parentNode.insertBefore(j, f);
	}

	// Hotjar Tracking Code for www.prh.org
	loadHotjar(h,o,t,j,a,r) {
		h.hj = h.hj || function() {
			(h.hj.q = h.hj.q || []).push(arguments)
		};
		h._hjSettings = {
			hjid: 775714,
			hjsv: 6
		};
		a = o.getElementsByTagName('head')[0];
		r = o.createElement('script');
		r.async = 1;
		r.src = t + h._hjSettings.hjid + j + h._hjSettings.hjsv;
		a.appendChild(r);
	}

	// Add-to-calendar library
	initCalendar() {
		const calendar = document.querySelector('.addtocalendar');
		if (calendar) {
			if (window.addtocalendar) {
				if (typeof window.addtocalendar.start === 'function') {
					return;
				}
			}
			if (window.ifaddtocalendar === undefined) {
				window.ifaddtocalendar = 1;
				const d = document,
					s = d.createElement('script'),
					g = 'getElementsByTagName',
					h = d[g]('body')[0];
				s.type = 'text/javascript';
				s.charset = 'UTF-8';
				s.async = true;
				s.src = ('https:' === window.location.protocol ? 'https' : 'http') + '://addtocalendar.com/atc/1.5/atc.min.js';
				h.appendChild(s);
			}
		}
	}

	// Init facebook share library
	initFacebook(d, s, id) {
		window.fbAsyncInit = function() {
			FB.init({
				appId: '113299352595401',
				autoLogAppEvents: true,
				xfbml: true,
				version: 'v2.9'
			});
			FB.AppEvents.logPageView();
		};

		let js, fjs = d.getElementsByTagName(s)[0];
		if (d.getElementById(id)) {
			return;
		}
		js = d.createElement(s);
		js.id = id;
		js.src = '//connect.facebook.net/en_US/sdk.js';
		fjs.parentNode.insertBefore(js, fjs);

		const social = document.querySelector('.sidebar-social');
		if (social) {
			const fbLinks = document.querySelectorAll('.fb-link');
			for (let i = 0; i < fbLinks.length; i++) {
				fbLinks[i].addEventListener('click', function(e) {
					e.preventDefault();
					FB.ui({
						method: 'share',
						href: window.location.href,
					}, function() {});
				})
			}
		}
	}

	// Init twitter share library
	initTwitter(d, s, id) {
		let js, fjs = d.getElementsByTagName(s)[0],
			t = window.twttr || {};
		if (d.getElementById(id)) {
			return t;
		}
		js = d.createElement(s);
		js.id = id;
		js.src = 'https://platform.twitter.com/widgets.js';
		fjs.parentNode.insertBefore(js, fjs);
		t._e = [];
		t.ready = function(f) {
			t._e.push(f);
		};
		window.twttr = t;
	}

	// Load Youtube API
	loadYTScripts() {
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
				for (let k in c) {
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
		}
	}
}

