var social = document.querySelector('.sidebar-social'),
  calendar = document.querySelector('.addtocalendar');


// Social
if (social) {

  // Init facebook share library
  window.fbAsyncInit = function() {
    FB.init({
      appId            : '113299352595401',
      autoLogAppEvents : true,
      xfbml            : true,
      version          : 'v2.9'
    });
    FB.AppEvents.logPageView();
  };
  (function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s); js.id = id;
    js.src = "//connect.facebook.net/en_US/sdk.js";
    fjs.parentNode.insertBefore(js, fjs);
  }(document, 'script', 'facebook-jssdk'));

  var fbLinks = document.querySelectorAll('.fb-link');
  for (let i = 0; i < fbLinks.length; i++) {
    fbLinks[i].addEventListener('click', function(e) {
      e.preventDefault();

      FB.ui({
        method: 'share',
        href: window.location.href,
      }, function(response){});
    })
  }
  
  // Init twitter share library
  window.twttr = (function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0],
      t = window.twttr || {};
    if (d.getElementById(id)) return t;
    js = d.createElement(s);
    js.id = id;
    js.src = "https://platform.twitter.com/widgets.js";
    fjs.parentNode.insertBefore(js, fjs);
    t._e = [];
    t.ready = function(f) {
      t._e.push(f);
    };
    return t;
  }(document, "script", "twitter-wjs"));

  // Init tumblr share library (todo: test)
  var Tumblr=window.Tumblr||{};(function(){Tumblr.share_on_tumblr=function(anchor){var advanced=anchor.href.match(/(www.)?tumblr(\.com)?(\:\d{2,4})?\/share(.+)?/i);advanced=(advanced[4]!==undefined&&advanced[4].length>1);var d=document,w=window,e=w.getSelection,k=d.getSelection,x=d.selection,s=(e?e():(k)?k():(x?x.createRange().text:0)),f="http://www.tumblr.com/share",l=d.location,e=encodeURIComponent,p="?v=3&u="+e(l.href)+"&t="+e(d.title)+"&s="+e(s),u=f+p;if(advanced){u=anchor.href}try{if(!/^(.*\.)?tumblr[^.]*$/.test(l.host)){throw (0)}tstbklt()}catch(z){a=function(){if(!w.open(u,"t","toolbar=0,resizable=0,status=1,width=450,height=430")){l.href=u}};if(/Firefox/.test(navigator.userAgent)){setTimeout(a,0)}else{a()}}void (0)};Tumblr.activate_share_on_tumblr_buttons=function(){var anchors=document.getElementsByTagName("a"),anchors_length=anchors.length,match=false,old_onclick;for(var i=0;i<anchors_length;i++){match=anchors[i].href.match(/(www.)?tumblr(\.com)?(\:\d{2,4})?\/share(.+)?/i);if(match){old_onclick=anchors[i].onclick;anchors[i].onclick=function(e){Tumblr.share_on_tumblr(this);if(old_onclick){old_onclick()}old_onclick=false;e.preventDefault()}}}};(function(i){var u=navigator.userAgent;var e=
  /*@cc_on!@*/
  false;var st=setTimeout;if(/webkit/i.test(u)){st(function(){var dr=document.readyState;if(dr=="loaded"||dr=="complete"){i()}else{st(arguments.callee,10)}},10)}else{if((/mozilla/i.test(u)&&!/(compati)/.test(u))||(/opera/i.test(u))){document.addEventListener("DOMContentLoaded",i,false)}else{if(e){(function(){var t=document.createElement("doc:rdy");try{t.doScroll("left");i();t=null}catch(e){st(arguments.callee,0)}})()}else{window.onload=i}}}})(Tumblr.activate_share_on_tumblr_buttons)}());
}


// Add-to-calendar library
if (calendar) {
  (function () {
    if (window.addtocalendar)if(typeof window.addtocalendar.start == "function")return;
    if (window.ifaddtocalendar == undefined) { window.ifaddtocalendar = 1;
    var d = document, s = d.createElement('script'), g = 'getElementsByTagName';
    s.type = 'text/javascript';s.charset = 'UTF-8';s.async = true;
    s.src = ('https:' == window.location.protocol ? 'https' : 'http')+'://addtocalendar.com/atc/1.5/atc.min.js';
    var h = d[g]('body')[0];h.appendChild(s); }})();
}
