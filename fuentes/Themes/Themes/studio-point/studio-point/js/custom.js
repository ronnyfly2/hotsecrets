/**
	STUDIO POINT - Parallax Responsive Retina Ready
 	Copyright (c) 2013, Subramanian 

	Author: Subramanian
    Profile: themeforest.net/user/FMedia/
	
    Version: 1.0.0
	Release Date: February 2013
	
**/



/* Load Google font */

$('head').append('<link rel="stylesheet" href="//fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800,300italic,400italic,600italic" />');			
$('head').append('<script type="text/javascript" src="https://www.google.com/jsapi" />');		



/* preload images are defined here */
var preLoadImgs = [];
	preLoadImgs.push("images/loading.gif");
		
/* Responsive define varaible */
	var isMobile = $(window).width() <= 767;
	var mobileDevice = screen.width < 1024 && screen.height < 1024;
	var isSmartPhone = ((screen.width <= 959) || (screen.height <= 959));
	var ipad = (screen.width == 768 || screen.height == 768) && (screen.width == 1024 || screen.height == 1024) ;
	var isMobileChk = screen.width < 768;
	var isTouch = false;
	var siteStartOpen = false;
	var retinaDevice;
	
	
	$(document).ready(function(){
		retinaDevice = window.devicePixelRatio !== undefined &&  window.devicePixelRatio > 1 ? true : false;
		
		if(retinaDevice){
			preLoadImgs.push("images/sprite@2x.png");
			preLoadImgs.push("images/next_previous_button@2x.png");
		}else{
			preLoadImgs.push("images/sprite.png");
			preLoadImgs.push("images/next_previous_button.png");
		}
		
		if(isMobile || $(".singlePage").height() != null){
			$("body, .topSpacing").css({"padding-top":$(".header").outerHeight()});
		}else{
			$("body, .topSpacing").css({"padding-top":0});
		}
		
		
		
		var iimg = !retinaDevice ? "images/supersized/pause.png" : "images/supersized/pause@2x.png";
		$("#pauseplay").attr("src",iimg)
				
	});
	
	 $(function () {
		$("#navHolder").tinyNav();
	  });


				
/* Modernizr 2.6.2 (Custom Build) | MIT & BSD
 * Build: http://modernizr.com/download/#-borderimage-borderradius-boxshadow-hsla-opacity-rgba-cssanimations-generatedcontent-csstransforms-csstransforms3d-csstransitions-shiv-cssclasses-teststyles-testprop-testallprops-prefixes-domprefixes-load
 */
;window.Modernizr_=function(a,b,c){function A(a){j.cssText=a}function B(a,b){return A(n.join(a+";")+(b||""))}function C(a,b){return typeof a===b}function D(a,b){return!!~(""+a).indexOf(b)}function E(a,b){for(var d in a){var e=a[d];if(!D(e,"-")&&j[e]!==c)return b=="pfx"?e:!0}return!1}function F(a,b,d){for(var e in a){var f=b[a[e]];if(f!==c)return d===!1?a[e]:C(f,"function")?f.bind(d||b):f}return!1}function G(a,b,c){var d=a.charAt(0).toUpperCase()+a.slice(1),e=(a+" "+p.join(d+" ")+d).split(" ");return C(b,"string")||C(b,"undefined")?E(e,b):(e=(a+" "+q.join(d+" ")+d).split(" "),F(e,b,c))}var d="2.6.2",e={},f=!0,g=b.documentElement,h="modernizr",i=b.createElement(h),j=i.style,k,l=":)",m={}.toString,n=" -webkit- -moz- -o- -ms- ".split(" "),o="Webkit Moz O ms",p=o.split(" "),q=o.toLowerCase().split(" "),r={},s={},t={},u=[],v=u.slice,w,x=function(a,c,d,e){var f,i,j,k,l=b.createElement("div"),m=b.body,n=m||b.createElement("body");if(parseInt(d,10))while(d--)j=b.createElement("div"),j.id=e?e[d]:h+(d+1),l.appendChild(j);return f=["&#173;",'<style id="s',h,'">',a,"</style>"].join(""),l.id=h,(m?l:n).innerHTML+=f,n.appendChild(l),m||(n.style.background="",n.style.overflow="hidden",k=g.style.overflow,g.style.overflow="hidden",g.appendChild(n)),i=c(l,a),m?l.parentNode.removeChild(l):(n.parentNode.removeChild(n),g.style.overflow=k),!!i},y={}.hasOwnProperty,z;!C(y,"undefined")&&!C(y.call,"undefined")?z=function(a,b){return y.call(a,b)}:z=function(a,b){return b in a&&C(a.constructor.prototype[b],"undefined")},Function.prototype.bind||(Function.prototype.bind=function(b){var c=this;if(typeof c!="function")throw new TypeError;var d=v.call(arguments,1),e=function(){if(this instanceof e){var a=function(){};a.prototype=c.prototype;var f=new a,g=c.apply(f,d.concat(v.call(arguments)));return Object(g)===g?g:f}return c.apply(b,d.concat(v.call(arguments)))};return e}),r.rgba=function(){return A("background-color:rgba(150,255,150,.5)"),D(j.backgroundColor,"rgba")},r.hsla=function(){return A("background-color:hsla(120,40%,100%,.5)"),D(j.backgroundColor,"rgba")||D(j.backgroundColor,"hsla")},r.borderimage=function(){return G("borderImage")},r.borderradius=function(){return G("borderRadius")},r.boxshadow=function(){return G("boxShadow")},r.opacity=function(){return B("opacity:.55"),/^0.55$/.test(j.opacity)},r.cssanimations=function(){return G("animationName")},r.csstransforms=function(){return!!G("transform")},r.csstransforms3d=function(){var a=!!G("perspective");return a&&"webkitPerspective"in g.style&&x("@media (transform-3d),(-webkit-transform-3d){#modernizr{left:9px;position:absolute;height:3px;}}",function(b,c){a=b.offsetLeft===9&&b.offsetHeight===3}),a},r.csstransitions=function(){return G("transition")},r.generatedcontent=function(){var a;return x(["#",h,"{font:0/0 a}#",h,':after{content:"',l,'";visibility:hidden;font:3px/1 a}'].join(""),function(b){a=b.offsetHeight>=3}),a};for(var H in r)z(r,H)&&(w=H.toLowerCase(),e[w]=r[H](),u.push((e[w]?"":"no-")+w));return e.addTest=function(a,b){if(typeof a=="object")for(var d in a)z(a,d)&&e.addTest(d,a[d]);else{a=a.toLowerCase();if(e[a]!==c)return e;b=typeof b=="function"?b():b,typeof f!="undefined"&&f&&(g.className+=" "+(b?"":"no-")+a),e[a]=b}return e},A(""),i=k=null,function(a,b){function k(a,b){var c=a.createElement("p"),d=a.getElementsByTagName("head")[0]||a.documentElement;return c.innerHTML="x<style>"+b+"</style>",d.insertBefore(c.lastChild,d.firstChild)}function l(){var a=r.elements;return typeof a=="string"?a.split(" "):a}function m(a){var b=i[a[g]];return b||(b={},h++,a[g]=h,i[h]=b),b}function n(a,c,f){c||(c=b);if(j)return c.createElement(a);f||(f=m(c));var g;return f.cache[a]?g=f.cache[a].cloneNode():e.test(a)?g=(f.cache[a]=f.createElem(a)).cloneNode():g=f.createElem(a),g.canHaveChildren&&!d.test(a)?f.frag.appendChild(g):g}function o(a,c){a||(a=b);if(j)return a.createDocumentFragment();c=c||m(a);var d=c.frag.cloneNode(),e=0,f=l(),g=f.length;for(;e<g;e++)d.createElement(f[e]);return d}function p(a,b){b.cache||(b.cache={},b.createElem=a.createElement,b.createFrag=a.createDocumentFragment,b.frag=b.createFrag()),a.createElement=function(c){return r.shivMethods?n(c,a,b):b.createElem(c)},a.createDocumentFragment=Function("h,f","return function(){var n=f.cloneNode(),c=n.createElement;h.shivMethods&&("+l().join().replace(/\w+/g,function(a){return b.createElem(a),b.frag.createElement(a),'c("'+a+'")'})+");return n}")(r,b.frag)}function q(a){a||(a=b);var c=m(a);return r.shivCSS&&!f&&!c.hasCSS&&(c.hasCSS=!!k(a,"article,aside,figcaption,figure,footer,header,hgroup,nav,section{display:block}mark{background:#FF0;color:#000}")),j||p(a,c),a}var c=a.html5||{},d=/^<|^(?:button|map|select|textarea|object|iframe|option|optgroup)$/i,e=/^(?:a|b|code|div|fieldset|h1|h2|h3|h4|h5|h6|i|label|li|ol|p|q|span|strong|style|table|tbody|td|th|tr|ul)$/i,f,g="_html5shiv",h=0,i={},j;(function(){try{var a=b.createElement("a");a.innerHTML="<xyz></xyz>",f="hidden"in a,j=a.childNodes.length==1||function(){b.createElement("a");var a=b.createDocumentFragment();return typeof a.cloneNode=="undefined"||typeof a.createDocumentFragment=="undefined"||typeof a.createElement=="undefined"}()}catch(c){f=!0,j=!0}})();var r={elements:c.elements||"abbr article aside audio bdi canvas data datalist details figcaption figure footer header hgroup mark meter nav output progress section summary time video",shivCSS:c.shivCSS!==!1,supportsUnknownElements:j,shivMethods:c.shivMethods!==!1,type:"default",shivDocument:q,createElement:n,createDocumentFragment:o};a.html5=r,q(b)}(this,b),e._version=d,e._prefixes=n,e._domPrefixes=q,e._cssomPrefixes=p,e.testProp=function(a){return E([a])},e.testAllProps=G,e.testStyles=x,g.className=g.className.replace(/(^|\s)no-js(\s|$)/,"$1$2")+(f?" js "+u.join(" "):""),e}(this,this.document),function(a,b,c){function d(a){return"[object Function]"==o.call(a)}function e(a){return"string"==typeof a}function f(){}function g(a){return!a||"loaded"==a||"complete"==a||"uninitialized"==a}function h(){var a=p.shift();q=1,a?a.t?m(function(){("c"==a.t?B.injectCss:B.injectJs)(a.s,0,a.a,a.x,a.e,1)},0):(a(),h()):q=0}function i(a,c,d,e,f,i,j){function k(b){if(!o&&g(l.readyState)&&(u.r=o=1,!q&&h(),l.onload=l.onreadystatechange=null,b)){"img"!=a&&m(function(){t.removeChild(l)},50);for(var d in y[c])y[c].hasOwnProperty(d)&&y[c][d].onload()}}var j=j||B.errorTimeout,l=b.createElement(a),o=0,r=0,u={t:d,s:c,e:f,a:i,x:j};1===y[c]&&(r=1,y[c]=[]),"object"==a?l.data=c:(l.src=c,l.type=a),l.width=l.height="0",l.onerror=l.onload=l.onreadystatechange=function(){k.call(this,r)},p.splice(e,0,u),"img"!=a&&(r||2===y[c]?(t.insertBefore(l,s?null:n),m(k,j)):y[c].push(l))}function j(a,b,c,d,f){return q=0,b=b||"j",e(a)?i("c"==b?v:u,a,b,this.i++,c,d,f):(p.splice(this.i++,0,a),1==p.length&&h()),this}function k(){var a=B;return a.loader={load:j,i:0},a}var l=b.documentElement,m=a.setTimeout,n=b.getElementsByTagName("script")[0],o={}.toString,p=[],q=0,r="MozAppearance"in l.style,s=r&&!!b.createRange().compareNode,t=s?l:n.parentNode,l=a.opera&&"[object Opera]"==o.call(a.opera),l=!!b.attachEvent&&!l,u=r?"object":l?"script":"img",v=l?"script":u,w=Array.isArray||function(a){return"[object Array]"==o.call(a)},x=[],y={},z={timeout:function(a,b){return b.length&&(a.timeout=b[0]),a}},A,B;B=function(a){function b(a){var a=a.split("!"),b=x.length,c=a.pop(),d=a.length,c={url:c,origUrl:c,prefixes:a},e,f,g;for(f=0;f<d;f++)g=a[f].split("="),(e=z[g.shift()])&&(c=e(c,g));for(f=0;f<b;f++)c=x[f](c);return c}function g(a,e,f,g,h){var i=b(a),j=i.autoCallback;i.url.split(".").pop().split("?").shift(),i.bypass||(e&&(e=d(e)?e:e[a]||e[g]||e[a.split("/").pop().split("?")[0]]),i.instead?i.instead(a,e,f,g,h):(y[i.url]?i.noexec=!0:y[i.url]=1,f.load(i.url,i.forceCSS||!i.forceJS&&"css"==i.url.split(".").pop().split("?").shift()?"c":c,i.noexec,i.attrs,i.timeout),(d(e)||d(j))&&f.load(function(){k(),e&&e(i.origUrl,h,g),j&&j(i.origUrl,h,g),y[i.url]=2})))}function h(a,b){function c(a,c){if(a){if(e(a))c||(j=function(){var a=[].slice.call(arguments);k.apply(this,a),l()}),g(a,j,b,0,h);else if(Object(a)===a)for(n in m=function(){var b=0,c;for(c in a)a.hasOwnProperty(c)&&b++;return b}(),a)a.hasOwnProperty(n)&&(!c&&!--m&&(d(j)?j=function(){var a=[].slice.call(arguments);k.apply(this,a),l()}:j[n]=function(a){return function(){var b=[].slice.call(arguments);a&&a.apply(this,b),l()}}(k[n])),g(a[n],j,b,n,h))}else!c&&l()}var h=!!a.test,i=a.load||a.both,j=a.callback||f,k=j,l=a.complete||f,m,n;c(h?a.yep:a.nope,!!i),i&&c(i)}var i,j,l=this.yepnope.loader;if(e(a))g(a,0,l,0);else if(w(a))for(i=0;i<a.length;i++)j=a[i],e(j)?g(j,0,l,0):w(j)?B(j):Object(j)===j&&h(j,l);else Object(a)===a&&h(a,l)},B.addPrefix=function(a,b){z[a]=b},B.addFilter=function(a){x.push(a)},B.errorTimeout=1e4,null==b.readyState&&b.addEventListener&&(b.readyState="loading",b.addEventListener("DOMContentLoaded",A=function(){b.removeEventListener("DOMContentLoaded",A,0),b.readyState="complete"},0)),a.yepnope=k(),a.yepnope.executeStack=h,a.yepnope.injectJs=function(a,c,d,e,i,j){var k=b.createElement("script"),l,o,e=e||B.errorTimeout;k.src=a;for(o in d)k.setAttribute(o,d[o]);c=j?h:c||f,k.onreadystatechange=k.onload=function(){!l&&g(k.readyState)&&(l=1,c(),k.onload=k.onreadystatechange=null)},m(function(){l||(l=1,c(1))},e),i?k.onload():n.parentNode.insertBefore(k,n)},a.yepnope.injectCss=function(a,c,d,e,g,i){var e=b.createElement("link"),j,c=i?h:c||f;e.href=a,e.rel="stylesheet",e.type="text/css";for(j in d)e.setAttribute(j,d[j]);g||(n.parentNode.insertBefore(e,n),m(c,0))}}(this,document),Modernizr_.load=function(){yepnope.apply(window,[].slice.call(arguments,0))};


/*
 * jQuery history plugin
 * 
 * The MIT License
 * 
 * Copyright (c) 2006-2009 Taku Sano (Mikage Sawatari)
 * Copyright (c) 2010 Takayuki Miwa
 * 
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 * 
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 * 
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 */

(function($){var locationWrapper={put:function(hash,win){(win||window).location.hash=this.encoder(hash)},get:function(win){var hash=(win||window).location.hash.replace(/^#/,"");try{return $.browser.mozilla?hash:decodeURIComponent(hash)}catch(error){return hash}},encoder:encodeURIComponent};var iframeWrapper={id:"__jQuery_history",init:function(){var html='<iframe id="'+this.id+'" style="display:none" src="javascript:false;" />';$("body").prepend(html);return this},_document:function(){return $("#"+
this.id)[0].contentWindow.document},put:function(hash){var doc=this._document();doc.open();doc.close();locationWrapper.put(hash,doc)},get:function(){return locationWrapper.get(this._document())}};function initObjects(options){options=$.extend({unescape:false},options||{});locationWrapper.encoder=encoder(options.unescape);function encoder(unescape_){if(unescape_===true)return function(hash){return hash};if(typeof unescape_=="string"&&(unescape_=partialDecoder(unescape_.split("")))||typeof unescape_==
"function")return function(hash){return unescape_(encodeURIComponent(hash))};return encodeURIComponent}function partialDecoder(chars){var re=new RegExp($.map(chars,encodeURIComponent).join("|"),"ig");return function(enc){return enc.replace(re,decodeURIComponent)}}}var implementations={};implementations.base={callback:undefined,type:undefined,check:function(){},load:function(hash){},init:function(callback,options){initObjects(options);self.callback=callback;self._options=options;self._init()},_init:function(){},
_options:{}};implementations.timer={_appState:undefined,_init:function(){var current_hash=locationWrapper.get();self._appState=current_hash;self.callback(current_hash);setInterval(self.check,100)},check:function(){var current_hash=locationWrapper.get();if(current_hash!=self._appState){self._appState=current_hash;self.callback(current_hash)}},load:function(hash){if(hash!=self._appState){locationWrapper.put(hash);self._appState=hash;self.callback(hash)}}};implementations.iframeTimer={_appState:undefined,
_init:function(){var current_hash=locationWrapper.get();self._appState=current_hash;iframeWrapper.init().put(current_hash);self.callback(current_hash);setInterval(self.check,100)},check:function(){var iframe_hash=iframeWrapper.get(),location_hash=locationWrapper.get();if(location_hash!=iframe_hash)if(location_hash==self._appState){self._appState=iframe_hash;locationWrapper.put(iframe_hash);self.callback(iframe_hash)}else{self._appState=location_hash;iframeWrapper.put(location_hash);self.callback(location_hash)}},
load:function(hash){if(hash!=self._appState){locationWrapper.put(hash);iframeWrapper.put(hash);self._appState=hash;self.callback(hash)}}};implementations.hashchangeEvent={_init:function(){self.callback(locationWrapper.get());$(window).bind("hashchange",self.check)},check:function(){self.callback(locationWrapper.get())},load:function(hash){locationWrapper.put(hash)}};var self=$.extend({},implementations.base);if($.browser.msie&&($.browser.version<8||document.documentMode<8))self.type="iframeTimer";
else if("onhashchange"in window)self.type="hashchangeEvent";else self.type="timer";$.extend(self,implementations[self.type]);$.history=self})(jQuery);


	



/*! http://tinynav.viljamis.com v1.1 by @viljamis */
(function($,window,i){$.fn.tinyNav=function(options){var settings=$.extend({"active":"selected","header":"","label":""},options);return this.each(function(){i++;var $nav=$(this),namespace="tinynav",namespace_i=namespace+i,l_namespace_i=".l_"+namespace_i,$select=$("<select/>").attr("id",namespace_i).addClass(namespace+" "+namespace_i);if($nav.is("ul,ol")){if(settings.header!=="")$select.append($("<option/>").text(settings.header));var options="";$nav.addClass("l_"+namespace_i).find("a").each(function(){options+=
'<option value="'+$(this).attr("href")+'">';var j;for(j=0;j<$(this).parents("ul, ol").length-1;j++)options+="- ";options+=$(this).text()+"</option>"});$select.append(options);if(!settings.header)$select.find(":eq("+$(l_namespace_i+" li").index($(l_namespace_i+" li."+settings.active))+")").attr("selected",true);$select.change(function(){window.location.href=$(this).val()});$(l_namespace_i).after($select);if(settings.label)$select.before($("<label/>").attr("for",namespace_i).addClass(namespace+"_label "+
namespace_i+"_label").append(settings.label))}})}})(jQuery,this,0);



/*
Plugin: jQuery Parallax
Version 1.1.3
Author: Ian Lunn
Twitter: @IanLunn
Author URL: http://www.ianlunn.co.uk/
Plugin URL: http://www.ianlunn.co.uk/plugins/jquery-parallax/

Dual licensed under the MIT and GPL licenses:
http://www.opensource.org/licenses/mit-license.php
http://www.gnu.org/licenses/gpl.html
*/

var parallexTopPos=0;
(function($){var $window=$(window);var windowHeight=$window.height();$window.resize(function(){windowHeight=$window.height()});$.fn.parallax=function(xpos,speedFactor,outerHeight){var $this=$(this);var getHeight;var firstTop;var updateTop;var paddingTop=0;$this.each(function(){firstTop=updateTop=$this.offset().top});if(outerHeight)getHeight=function(jqo){return jqo.outerHeight(true)};else getHeight=function(jqo){return jqo.height()};if(arguments.length<1||xpos===null)xpos="50%";if(arguments.length<
2||speedFactor===null)speedFactor=0.1;if(arguments.length<3||outerHeight===null)outerHeight=true;function update(){var pos=$window.scrollTop();$this.each(function(){var $element=$(this);var top=$element.offset().top;var height=getHeight($element);if(top+height<pos||top>pos+windowHeight)return;if(!isMobileChk&&!isTouch){parallexTopPos=$(".homeSlider").outerHeight()+$(".projDetailLoad").outerHeight()+$(".header_bg").outerHeight()*2;firstTop=updateTop+parallexTopPos;$this.css("backgroundPosition",xpos+
" "+Math.round((firstTop-pos)*speedFactor)+"px")}else $this.css({"backgroundPosition":"0% 0%"})})}if(!isTouch)$window.bind("scroll",update).resize(update);update()}})(jQuery);




/*
	* Skeleton V1.1
	* Copyright 2011, Dave Gamache
	* www.getskeleton.com
	* Free to use under the MIT license.
	* http://www.opensource.org/licenses/mit-license.php
	* 8/17/2011
*/
			
/* Tabs, Homepage feature image and Accordion are custom style */

	
	$(document).ready(function(){
		
		/* Find touch device */
		try {
			isTouch = true;
			document.createEvent('TouchEvent');
		} catch (e) {
			isTouch = false;			
		}
		
		$("#options .catName").each(function(){
			$(this).children(":first-child").clone().appendTo($(this));
			$(this).children(":last-child").addClass("iover")
			$(this).children(":first-child").addClass("nover")
		})
		
		/* Add flip effect only for non-touch device */
		if(!isTouch){
			$('.circleHolder').hover(function(){
				if(Modernizr_.testAllProps('transform')){
					$(this).find(".flipPanel").addClass('flip');
				}else{
					$(this).find(".front").css({"width":"0%"});
				}
					
			},function(){
				if(Modernizr_.testAllProps('transform')){
					$(this).find(".flipPanel").removeClass('flip');
				}else{
					$(this).find(".front").css({"width":"100%"});
				}
			});
				
			// set up click/tap panels
			$('.click').toggle(function(){
				if(Modernizr_.testAllProps('csstransforms3d')){
					$(this).find(".flipPanel").addClass('flip');
				}else{
					$(this).find(".front").css({"width":"0%"});
				}
			},function(){
				if(Modernizr_.testAllProps('csstransforms3d')){
					$(this).find(".flipPanel").removeClass('flip');
				}else{
					$(this).find(".front").css({"width":"100%"});
				}
			});
		} else{
			$('.fmSliderNode').find(".front").addClass("slider_nav");
			$('.overlayPattern, .homeSlider .overlayPattern, .parallaxPattern').css({ "display":"none" })
		}
		
		
		/* Contact page close button*/	
		$(".closeBtn").click(function(){
			var sel =	$($(this).attr("data-content"));
			if( parseInt(sel.css("top")) < sel.height()-70){
				sel.animate({"top":sel.height()-50},500, "easeInOutQuart");
				$(this).children(":first-child").children(":first-child").css({"right" : "0px"});
			}else{
				sel.animate({"top":"0px"},500, "easeInOutQuart");
				$(this).children(":first-child").children(":first-child").css({"right" : "-40px"});
			}
		});
		
		
		/* Add background if it placed below the parallax */
		$("body").find(".darkStyle.parallax").each(function(){
			$(this).prepend('<div class="darkStyle" style="position:absolute; width:100%; height:100%; top:0px; left:0px">  </div>')
		});
		
		
		$("body").find(".contentWrapper.lightStyle.parallax").each(function(){
			$(this).prepend('<div class="lightStyle" style="position:absolute; width:100%; height:100%; top:0px; left:0px">  </div>')
		});

		
		/* Initialize the fancybox plug-in for portfolio */
		var fancy_Obj = $("a[rel=example_group]");
		fancy_Obj.fancybox({
			'padding'			: 0,
			'titlePosition'		: 'outside',
			'transitionIn'		: 'elastic',
			'transitionOut'		: 'elastic',
			'overlayColor'		: '#000',
			'overlayOpacity'	:.75	
		});	


	
		$("a.single_image").fancybox({
			'padding'			: 0,
			'titlePosition'		: 'outside',
			'transitionIn'		: 'fade',
			'transitionOut'		: 'fade',
			'overlayColor'		: '#000',
			'overlayOpacity'	:.75
		});
			
// Remove title tag, so that the title text doesn't show one tooltip when mouse hover the thumbnail
		fancy_Obj.each(function(){
			$(this).attr(('data-title'),$(this).find(".img_text").html());
			if($(this).attr('title')){
				$($(this).find(('.img_text')).html(String('<span class="img_txt_hold">'+$(this).attr('title')))+'</span>');
			}
			$(this).attr('title', '');
		})	
/* End fancybox plug-in for portfolio */



/* Hook up the FlexSlider */
		$('.flexslider').each(function(){
			var flexs = $(this);
			flexs.flexslider({
				slideshow: true,
				slideshowSpeed: 5000,
				start: function(slider){
					flexs.data("slid",slider)
					slider.pause();
				}
			});
		});
			
		$('.flexslider').flexslider("pause");

		// Tabs function
		
		
		$('body').find('ul.tabs > li > a').each( function(){
			 $($(this).attr('href')).data("vidd",  $($(this).attr('href')).find('.tabVideo .addVideo') );
		});
		
		$('body').on('click', 'ul.tabs > li > a', function(e) {
			
			//Get Location of tab's content
			var contentLocation = $(this).attr('href');
			//Let go if not a hashed one
			if(contentLocation.charAt(0)=="#") {
			
				e.preventDefault();
			
				//Make Tab Active
				$(this).parent().siblings().children('a').removeClass('active');
				$(this).addClass('active');
			
				//Show Tab Content & add active class
				$(contentLocation).show().addClass('active').siblings().hide().removeClass('active');
				$(contentLocation).css({"opacity":"0"}).animate({"opacity":1},900);
				
				$('body').find('ul.tabs > li > a').each( function(){
					$($(this).attr('href')).find('.tabVideo .addVideo').remove();
				});

				$(contentLocation).find('.tabVideo').append($(contentLocation).data("vidd"))
					
				$(contentLocation).find('.graph_container').each(function() {
					$("body").mainFm('graph_display',$(this));
				});
			}
		});

		
		// align tipsy relative to the hovered element

		$('.hastip').tipsy({
			live: true, 
			gravity: 's',
			fade: true, 
			fallback: 'error'
		});
		
		
		// Graph
		
		$("body").find('.contentWrapper').each(function(){
			$(this).find('.graph_container').each(function(){
				$(this).find('li').each(function() {
					$(this).each(function() {
						$(this).children(':first-child').css("width",$(this).attr('data-level'));
					});
				});
			});

		});
		
		
		// Accordion
		
		jQuery(function($){
    
			  
			$('.accordion > dt > a').prepend('<span class="closeOpen" ></span>');
			//$('.accordion').attr("data-autoHide");
				 
			$('.accordion').each( function(){
				
				var allDt = $(this);
				var allPanels = allDt.find(' > dd').hide();
				allDt.find(' dt .closeOpen').css({"background-position":"0px 0px"});
				 
				if($(this).attr("data-openFirstElement") == "true"){
					 $(this).children(":first-child").find(".closeOpen").css({"background-position":"0px -15px"});
					$(this).children(":first-child").find("a").data('show',true);
					$target =  $(this).children(":first-child").next();
					 $target.addClass('active').slideDown();
				}
				
				
				$(this).find(' > dt > a').click(function() {
					$this = $(this);
					$target =  $this.parent().next();
					
					if($(this).parent().parent().attr("data-autoHide") != "false"){
						allDt.find(' dt .closeOpen').css({"background-position":"0px 0px"});
						$this.find(".closeOpen").css({"background-position":"0px -15px"});
						$target =  $this.parent().next();
						if(!$target.hasClass('active')){
							allPanels.removeClass('active').slideUp();
							$target.addClass('active').slideDown();
						}
					}else{
						
						if($this.data('show')){
							$this.data('show',false);
							$this.find('.closeOpen').css({"background-position":"0px 0px"});
							$target.removeClass('active').slideUp();
						}else{
							$this.data('show',true);
							$this.find(".closeOpen").css({"background-position":"0px -15px"});
							$target.addClass('active').slideDown();
							
						}
						
					}
					return false;
				});
			
			})
			  
		}); 
		
		jQuery(function($){
    
			  var allPanels = $('.accordion_autoHide > dd').hide();
			  $('.accordion_autoHide > dt > a').prepend('<span class="closeOpen" ></span>');
			  $('.accordion_autoHide > dt > a').click(function() {
				  $('.accordion_autoHide dt .closeOpen').css({"background-position":"0px 0px"});
				  $this = $(this);
				  $this .find(".closeOpen").css({"background-position":"0px -15px"});
				  $target =  $this.parent().next();
				  
				  if(!$target.hasClass('active')){
					 allPanels.removeClass('active').slideUp();
					 $target.addClass('active').slideDown();
				  }
				  
				return false;
			  });
		});
		
		 

	});
				

/* Embed Video player */

(function($) {
	$.fn.embedPlayer = function(url, width, height, autoplay) {
		
		var $output = '';
		var youtubeUrl = url.match(/watch\?v=([a-zA-Z0-9\-_]+)/);
		var vimeoUrl = url.match(/^http:\/\/(www\.)?vimeo\.com\/(clip\:)?(\d+).*$/);
		var aPlay =  autoplay == "true" ||  autoplay ? true : false;
		
		if (youtubeUrl) {
			var url_ = 'http://www.youtube.com/embed/' + youtubeUrl[1] + '?rel=0;autohide=1';
			if (aPlay) { 
				url_ += '&amp;autoplay=1'; 
			}else{
				url_ += '&amp;autoplay=0';
			}
			$output = $('<iframe style="width: ' + width + '; height: ' + height + ';" src="' + url_ +'&wmode=opaque'+ '" frameborder="0" allowfullscreen ></iframe>');
			
			
		} else if (vimeoUrl) {
			
			var url_ = 'http://player.vimeo.com/video/' + vimeoUrl[3] + '?title=0&byline=0&portrait=0';
			if (aPlay) { 
				url_ += '&autoplay=1';
			}else{
				url_ += '&autoplay=0';
			}
			$output = $('<iframe style="width: ' + width + '; height: ' + height + ';" src="' + url_ +'&wmode=opaque'+ '"  frameborder="0" ></iframe>');
			
		} else {
			
			$output = $('<p>no video url found - vimeo and youtube supported</p>');
		}
		
		return this.html($output);
	};
})(jQuery);




/*! Copyright (c) 2010 Brandon Aaron (http://brandonaaron.net)
* Licensed under the MIT License (LICENSE.txt).
*
* Thanks to: http://adomas.org/javascript-mouse-wheel/ for some pointers.
* Thanks to: Mathias Bank(http://www.mathias-bank.de) for a scope bug fix.
* Thanks to: Seamus Leahy for adding deltaX and deltaY
*
* Version: 3.0.4
*
* Requires: 1.2.2+
*/

(function(d){function g(a){var b=a||window.event,i=[].slice.call(arguments,1),c=0,h=0,e=0;a=d.event.fix(b);a.type="mousewheel";if(a.wheelDelta)c=a.wheelDelta/120;if(a.detail)c=-a.detail/3;e=c;if(b.axis!==undefined&&b.axis===b.HORIZONTAL_AXIS){e=0;h=-1*c}if(b.wheelDeltaY!==undefined)e=b.wheelDeltaY/120;if(b.wheelDeltaX!==undefined)h=-1*b.wheelDeltaX/120;i.unshift(a,c,h,e);return d.event.handle.apply(this,i)}var f=["DOMMouseScroll","mousewheel"];d.event.special.mousewheel={setup:function(){if(this.addEventListener)for(var a=
f.length;a;)this.addEventListener(f[--a],g,false);else this.onmousewheel=g},teardown:function(){if(this.removeEventListener)for(var a=f.length;a;)this.removeEventListener(f[--a],g,false);else this.onmousewheel=null}};d.fn.extend({mousewheel:function(a){return a?this.bind("mousewheel",a):this.trigger("mousewheel")},unmousewheel:function(a){return this.unbind("mousewheel",a)}})})(jQuery);



// tipsy, facebook style tipsys for jquery
// version 1.0.0a
// (c) 2008-2010 jason frame [jason@onehackoranother.com]
// releated under the MIT license
(function($){$.fn.tipsy=function(opts){opts=$.extend({fade:false,gravity:"n"},opts||{});var tip=null,cancelHide=false;this.click(function(){$.data(this,"cancel.tipsy",false);var self=this;if($.data(this,"cancel.tipsy"))return;var tip=$.data(self,"active.tipsy");if(opts.fade)tip.stop().animate({"opacity":0,"top":parseInt(tip.css("top"))-20},500,"easeOutQuart",function(){$(this).remove()});else tip.remove()});this.hover(function(){$.data(this,"cancel.tipsy",true);var ff=false;$(this).parent().parent().find(".fea").each(function(){ff=
true});var tip=$.data(this,"active.tipsy");if(!tip){if(ff)tip=$('<div class="tipsy tipsy_feature"><div class="tipsy-inner">'+$(this).attr("title")+'</div><div class="tipsy-arrow"></div></div>');else tip=$('<div class="tipsy"><div class="tipsy-inner">'+$(this).attr("title")+'</div><div class="tipsy-arrow"></div></div>');tip.css({position:"absolute",zIndex:1E5});$(this).attr("title","");$.data(this,"active.tipsy",tip)}var pos=$.extend({},$(this).offset(),{width:this.offsetWidth,height:this.offsetHeight});
tip.remove().css({top:0,left:0,visibility:"hidden",display:"block"}).appendTo(document.body);var actualWidth=tip[0].offsetWidth,actualHeight=tip[0].offsetHeight;var wid=$(this).find(".fea").width()?$(this).find(".fea").css("margin-left"):10;var hig=$(this).find(".fea").height()?$(this).find(".fea").height():10;var yp=$.browser.mozilla?20:10;if(ff)if($.browser.opera||$.browser.msie)tip.css({"top":pos.top-hig-actualHeight+yp,"left":pos.left-5,"opacity":1});else{tip.css({"top":pos.top-hig-actualHeight+
yp-15,"left":pos.left-5,"visibility":"visible","opacity":0});tip.animate({"top":pos.top-hig-actualHeight+yp,"opacity":1},300,"easeOutQuad")}else if($.browser.opera||$.browser.msie)tip.css({"visibility":"visible","top":pos.top-actualHeight,"left":pos.left+pos.width/2-actualWidth/2,"opacity":0});else{tip.css({"visibility":"visible","top":pos.top-actualHeight-10,"left":pos.left+pos.width/2-actualWidth/2,"visibility":"visible","opacity":0});tip.animate({"visibility":"visible","top":pos.top-actualHeight,
"left":pos.left+pos.width/2-actualWidth/2,"opacity":1},300,"easeOutQuart")}if(opts.fade)if($.browser.opera||$.browser.msie)tip.css({"opacity":1,"display":"block","visibility":"visible"});else tip.css({"opacity":0,"display":"block","visibility":"visible"}).animate({"opacity":1});else tip.css({"visibility":"visible"})},function(){$.data(this,"cancel.tipsy",false);var self=this;setTimeout(function(){if($.data(this,"cancel.tipsy"))return;var tip=$.data(self,"active.tipsy");if(opts.fade&&!$.browser.opera)tip.stop().animate({"opacity":0,
"top":parseInt(tip.css("top"))-5},100,"easeOutCubic",function(){$(this).remove()});else tip.remove()},100)})}})(jQuery);





 /*! Copyright (c) 2011 Brandon Aaron (http://brandonaaron.net)
 * Licensed under the MIT License (LICENSE.txt).
 *
 * Thanks to: http://adomas.org/javascript-mouse-wheel/ for some pointers.
 * Thanks to: Mathias Bank(http://www.mathias-bank.de) for a scope bug fix.
 * Thanks to: Seamus Leahy for adding deltaX and deltaY
 *
 * Version: 3.0.6
 * 
 * Requires: 1.2.2+
 */

(function($){var types=["DOMMouseScroll","mousewheel"];if($.event.fixHooks)for(var i=types.length;i;)$.event.fixHooks[types[--i]]=$.event.mouseHooks;$.event.special.mousewheel={setup:function(){if(this.addEventListener)for(var i=types.length;i;)this.addEventListener(types[--i],handler,false);else this.onmousewheel=handler},teardown:function(){if(this.removeEventListener)for(var i=types.length;i;)this.removeEventListener(types[--i],handler,false);else this.onmousewheel=null}};$.fn.extend({mousewheel:function(fn){return fn?
this.bind("mousewheel",fn):this.trigger("mousewheel")},unmousewheel:function(fn){return this.unbind("mousewheel",fn)}});function handler(event){var orgEvent=event||window.event,args=[].slice.call(arguments,1),delta=0,returnValue=true,deltaX=0,deltaY=0;event=$.event.fix(orgEvent);event.type="mousewheel";if(orgEvent.wheelDelta)delta=orgEvent.wheelDelta/120;if(orgEvent.detail)delta=-orgEvent.detail/3;deltaY=delta;if(orgEvent.axis!==undefined&&orgEvent.axis===orgEvent.HORIZONTAL_AXIS){deltaY=0;deltaX=
-1*delta}if(orgEvent.wheelDeltaY!==undefined)deltaY=orgEvent.wheelDeltaY/120;if(orgEvent.wheelDeltaX!==undefined)deltaX=-1*orgEvent.wheelDeltaX/120;args.unshift(event,delta,deltaX,deltaY);return($.event.dispatch||$.event.handle).apply(this,args)}})(jQuery);

	
		


/*
 * jQuery Easing v1.3 - http://gsgd.co.uk/sandbox/jquery/easing/
 *
 * Uses the built in easing capabilities added In jQuery 1.1
 * to offer multiple easing options
 *
 * TERMS OF USE - jQuery Easing
 *
 * Open source under the BSD License.
 *
 * Copyright Â© 2008 George McGinley Smith
 * All rights reserved.
 *
 * Redistribution and use in source and binary forms, with or without modification,
 * are permitted provided that the following conditions are met:
 *
 * Redistributions of source code must retain the above copyright notice, this list of
 * conditions and the following disclaimer.
 * Redistributions in binary form must reproduce the above copyright notice, this list
 * of conditions and the following disclaimer in the documentation and/or other materials
 * provided with the distribution.
 *
 * Neither the name of the author nor the names of contributors may be used to endorse
 * or promote products derived from this software without specific prior written permission.
 *
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS" AND ANY
 * EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED WARRANTIES OF
 * MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE
 *  COPYRIGHT OWNER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL,
 *  EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE
 *  GOODS OR SERVICES; LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED
 * AND ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING
 *  NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED
 * OF THE POSSIBILITY OF SUCH DAMAGE.
 *
*/

// t: current time, b: begInnIng value, c: change In value, d: duration

jQuery.easing["jswing"]=jQuery.easing["swing"];
jQuery.extend(jQuery.easing,{def:"easeOutQuad",swing:function(x,t,b,c,d){return jQuery.easing[jQuery.easing.def](x,t,b,c,d)},easeInQuad:function(x,t,b,c,d){return c*(t/=d)*t+b},easeOutQuad:function(x,t,b,c,d){return-c*(t/=d)*(t-2)+b},easeInOutQuad:function(x,t,b,c,d){if((t/=d/2)<1)return c/2*t*t+b;return-c/2*(--t*(t-2)-1)+b},easeInCubic:function(x,t,b,c,d){return c*(t/=d)*t*t+b},easeOutCubic:function(x,t,b,c,d){return c*((t=t/d-1)*t*t+1)+b},easeInOutCubic:function(x,t,b,c,d){if((t/=d/2)<1)return c/
2*t*t*t+b;return c/2*((t-=2)*t*t+2)+b},easeInQuart:function(x,t,b,c,d){return c*(t/=d)*t*t*t+b},easeOutQuart:function(x,t,b,c,d){return-c*((t=t/d-1)*t*t*t-1)+b},easeInOutQuart:function(x,t,b,c,d){if((t/=d/2)<1)return c/2*t*t*t*t+b;return-c/2*((t-=2)*t*t*t-2)+b},easeInQuint:function(x,t,b,c,d){return c*(t/=d)*t*t*t*t+b},easeOutQuint:function(x,t,b,c,d){return c*((t=t/d-1)*t*t*t*t+1)+b},easeInOutQuint:function(x,t,b,c,d){if((t/=d/2)<1)return c/2*t*t*t*t*t+b;return c/2*((t-=2)*t*t*t*t+2)+b},easeInSine:function(x,
t,b,c,d){return-c*Math.cos(t/d*(Math.PI/2))+c+b},easeOutSine:function(x,t,b,c,d){return c*Math.sin(t/d*(Math.PI/2))+b},easeInOutSine:function(x,t,b,c,d){return-c/2*(Math.cos(Math.PI*t/d)-1)+b},easeInExpo:function(x,t,b,c,d){return t==0?b:c*Math.pow(2,10*(t/d-1))+b},easeOutExpo:function(x,t,b,c,d){return t==d?b+c:c*(-Math.pow(2,-10*t/d)+1)+b},easeInOutExpo:function(x,t,b,c,d){if(t==0)return b;if(t==d)return b+c;if((t/=d/2)<1)return c/2*Math.pow(2,10*(t-1))+b;return c/2*(-Math.pow(2,-10*--t)+2)+b},
easeInCirc:function(x,t,b,c,d){return-c*(Math.sqrt(1-(t/=d)*t)-1)+b},easeOutCirc:function(x,t,b,c,d){return c*Math.sqrt(1-(t=t/d-1)*t)+b},easeInOutCirc:function(x,t,b,c,d){if((t/=d/2)<1)return-c/2*(Math.sqrt(1-t*t)-1)+b;return c/2*(Math.sqrt(1-(t-=2)*t)+1)+b},easeInElastic:function(x,t,b,c,d){var s=1.70158;var p=0;var a=c;if(t==0)return b;if((t/=d)==1)return b+c;if(!p)p=d*0.3;if(a<Math.abs(c)){a=c;var s=p/4}else var s=p/(2*Math.PI)*Math.asin(c/a);return-(a*Math.pow(2,10*(t-=1))*Math.sin((t*d-s)*2*
Math.PI/p))+b},easeOutElastic:function(x,t,b,c,d){var s=1.70158;var p=0;var a=c;if(t==0)return b;if((t/=d)==1)return b+c;if(!p)p=d*0.3;if(a<Math.abs(c)){a=c;var s=p/4}else var s=p/(2*Math.PI)*Math.asin(c/a);return a*Math.pow(2,-10*t)*Math.sin((t*d-s)*2*Math.PI/p)+c+b},easeInOutElastic:function(x,t,b,c,d){var s=1.70158;var p=0;var a=c;if(t==0)return b;if((t/=d/2)==2)return b+c;if(!p)p=d*0.3*1.5;if(a<Math.abs(c)){a=c;var s=p/4}else var s=p/(2*Math.PI)*Math.asin(c/a);if(t<1)return-0.5*a*Math.pow(2,10*
(t-=1))*Math.sin((t*d-s)*2*Math.PI/p)+b;return a*Math.pow(2,-10*(t-=1))*Math.sin((t*d-s)*2*Math.PI/p)*0.5+c+b},easeInBack:function(x,t,b,c,d,s){if(s==undefined)s=1.70158;return c*(t/=d)*t*((s+1)*t-s)+b},easeOutBack:function(x,t,b,c,d,s){if(s==undefined)s=1.70158;return c*((t=t/d-1)*t*((s+1)*t+s)+1)+b},easeInOutBack:function(x,t,b,c,d,s){if(s==undefined)s=1.70158;if((t/=d/2)<1)return c/2*t*t*(((s*=1.525)+1)*t-s)+b;return c/2*((t-=2)*t*(((s*=1.525)+1)*t+s)+2)+b},easeInBounce:function(x,t,b,c,d){return c-
jQuery.easing.easeOutBounce(x,d-t,0,c,d)+b},easeOutBounce:function(x,t,b,c,d){if((t/=d)<1/2.75)return c*7.5625*t*t+b;else if(t<2/2.75)return c*(7.5625*(t-=1.5/2.75)*t+0.75)+b;else if(t<2.5/2.75)return c*(7.5625*(t-=2.25/2.75)*t+0.9375)+b;else return c*(7.5625*(t-=2.625/2.75)*t+0.984375)+b},easeInOutBounce:function(x,t,b,c,d){if(t<d/2)return jQuery.easing.easeInBounce(x,t*2,0,c,d)*0.5+b;return jQuery.easing.easeOutBounce(x,t*2-d,0,c,d)*0.5+c*0.5+b}});
