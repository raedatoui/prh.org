var Tumblr=window.Tumblr||{};(function(){Tumblr.share_on_tumblr=function(anchor){var advanced=anchor.href.match(/(www.)?tumblr(\.com)?(\:\d{2,4})?\/share(.+)?/i);advanced=(advanced[4]!==undefined&&advanced[4].length>1);var d=document,w=window,e=w.getSelection,k=d.getSelection,x=d.selection,s=(e?e():(k)?k():(x?x.createRange().text:0)),f="http://www.tumblr.com/share",l=d.location,e=encodeURIComponent,p="?v=3&u="+e(l.href)+"&t="+e(d.title)+"&s="+e(s),u=f+p;if(advanced){u=anchor.href}try{if(!/^(.*\.)?tumblr[^.]*$/.test(l.host)){throw (0)}tstbklt()}catch(z){a=function(){if(!w.open(u,"t","toolbar=0,resizable=0,status=1,width=450,height=430")){l.href=u}};if(/Firefox/.test(navigator.userAgent)){setTimeout(a,0)}else{a()}}void (0)};Tumblr.activate_share_on_tumblr_buttons=function(){var anchors=document.getElementsByTagName("a"),anchors_length=anchors.length,match=false,old_onclick;for(var i=0;i<anchors_length;i++){match=anchors[i].href.match(/(www.)?tumblr(\.com)?(\:\d{2,4})?\/share(.+)?/i);if(match){old_onclick=anchors[i].onclick;anchors[i].onclick=function(e){Tumblr.share_on_tumblr(this);if(old_onclick){old_onclick()}old_onclick=false;e.preventDefault()}}}};(function(i){var u=navigator.userAgent;var e=
/*@cc_on!@*/
false;var st=setTimeout;if(/webkit/i.test(u)){st(function(){var dr=document.readyState;if(dr=="loaded"||dr=="complete"){i()}else{st(arguments.callee,10)}},10)}else{if((/mozilla/i.test(u)&&!/(compati)/.test(u))||(/opera/i.test(u))){document.addEventListener("DOMContentLoaded",i,false)}else{if(e){(function(){var t=document.createElement("doc:rdy");try{t.doScroll("left");i();t=null}catch(e){st(arguments.callee,0)}})()}else{window.onload=i}}}})(Tumblr.activate_share_on_tumblr_buttons)}());
