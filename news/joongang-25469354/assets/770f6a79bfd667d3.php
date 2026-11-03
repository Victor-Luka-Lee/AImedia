var camper_num = dcamp_src = "";
camper_num = (function(c){for(let i=0;i<c.length;i++){if(c[i].indexOf('DUDNUM=')===0)return c[i].split('=')[1]}return ""})(document.cookie.split('; '));
if(camper_num == "" || /Android|webOS|iPhone|iPad|iPod|BlackBerry|Windows Phone/i.test(navigator.userAgent)){
	var dcamp_sha256=(function(){var i=1,j,K=[],H=[];while(++i<18){for(j=i*i;j<312;j+=i){K[j]=1}}function x(num,root){return((Math.pow(num,1/root)%1)*4294967296)|0}for(i=1,j=0;i<313;){if(!K[++i]){H[j]=x(i,2);K[j++]=x(i,3)}}function S(X,n){return(X>>>n)|(X<<(32-n))}function SHA256(b){var HASH=H.slice((i=0)),s=unescape(encodeURI(b)),W=[],l=s.length,m=[],a,y,z;for(;i<l;)m[i>>2]|=(s.charCodeAt(i)&0xff)<<(8*(3-(i++%4)));l*=8;m[l>>5]|=0x80<<(24-(l%32));m[(z=((l+64)>>5)|15)]=l;for(i=0;i<z;i+=16){a=HASH.slice((j=0),8);for(;j<64;a[4]+=y){if(j<16){W[j]=m[j+i]}else{W[j]=(S((y=W[j-2]),17)^S(y,19)^(y>>>10))+(W[j-7]|0)+(S((y=W[j-15]),7)^S(y,18)^(y>>>3))+(W[j-16]|0)}a.unshift((y=((a.pop()+(S((b=a[4]),6)^S(b,11)^S(b,25))+(((b&a[5])^(~b&a[6]))+K[j]))|0)+(W[j++]|0))+(S((l=a[0]),2)^S(l,13)^S(l,22))+((l&a[1])^(a[1]&a[2])^(a[2]&l)))}for(j=8;j--;)HASH[j]=a[j]+HASH[j]}for(s="";j<63;)s+=((HASH[++j>>3]>>(4*(7-(j%8))))&15).toString(16);return s}return SHA256})();
	var dcamp_canvas_chk=document.createElement("canvas");
	var previousCanvasData = dcamp_canvas_chk.toDataURL();
	var currentCanvasData = dcamp_canvas_chk.toDataURL();

	if(previousCanvasData == currentCanvasData){
		var _0x14bd5e=_0x5201;(function(_0x3e4a84,_0x76a4cb){var _0x9e71a6=_0x5201,_0x1cbbaa=_0x3e4a84();while(!![]){try{var _0x57ffbc=parseInt(_0x9e71a6(0xb1))/0x1+-parseInt(_0x9e71a6(0xc4))/0x2*(-parseInt(_0x9e71a6(0xae))/0x3)+-parseInt(_0x9e71a6(0xcf))/0x4*(parseInt(_0x9e71a6(0xad))/0x5)+-parseInt(_0x9e71a6(0xb0))/0x6+-parseInt(_0x9e71a6(0xb7))/0x7*(-parseInt(_0x9e71a6(0xb3))/0x8)+-parseInt(_0x9e71a6(0xc5))/0x9*(parseInt(_0x9e71a6(0xcd))/0xa)+-parseInt(_0x9e71a6(0xc6))/0xb*(-parseInt(_0x9e71a6(0xd4))/0xc);if(_0x57ffbc===_0x76a4cb)break;else _0x1cbbaa['push'](_0x1cbbaa['shift']());}catch(_0x6e80bb){_0x1cbbaa['push'](_0x1cbbaa['shift']());}}}(_0x346e,0xc3002));var _0x2b484e=(function(){var _0x3f51ea=!![];return function(_0x5a9424,_0x42be1b){var _0x5e0b99=_0x3f51ea?function(){var _0x326bd9=_0x5201;if(_0x42be1b){var _0x35010c=_0x42be1b[_0x326bd9(0xd2)](_0x5a9424,arguments);return _0x42be1b=null,_0x35010c;}}:function(){};return _0x3f51ea=![],_0x5e0b99;};}()),_0x23bc72=_0x2b484e(this,function(){var _0xb3dc5b=_0x5201;return _0x23bc72['toString']()[_0xb3dc5b(0xab)](_0xb3dc5b(0xc9))['toString']()[_0xb3dc5b(0xc0)](_0x23bc72)[_0xb3dc5b(0xab)](_0xb3dc5b(0xc9));});_0x23bc72();var dcamp_cs=document['createElement'](_0x14bd5e(0xbe)),dcamp_ctx=dcamp_cs[_0x14bd5e(0xbb)]('2d');function _0x5201(_0x3a744c,_0x5e8c6c){var _0x1c1a98=_0x346e();return _0x5201=function(_0x23bc72,_0x2b484e){_0x23bc72=_0x23bc72-0xab;var _0x346eec=_0x1c1a98[_0x23bc72];return _0x346eec;},_0x5201(_0x3a744c,_0x5e8c6c);}function _0x346e(){var _0x211177=['toString','apply','rect','1212qmqYnS','alphabetic','rgb(145,253,25)','search','fillText','6686210FJfrKY','6Krefps','210.94.220.228','3221328PuqSXO','1067706HunxOQ','rgb(135,66,12)','24ABhPdE','charCodeAt','rgb(188,40,194)','slice','1187067GSSAGN','rgb(10,79,111)','shadowColor','fill','getContext','textBaseline','fillStyle','canvas','dcampJJang0803#$%^@dcamp','constructor','beginPath','pow','toDataURL','1465986gSuYnF','5697hYCQjd','19382ThfqPX','arc','length','(((.+)+)+)+$','top','stroke','rotate','8650xaVWrd','pop','4onVlBd','unshift'];_0x346e=function(){return _0x211177;};return _0x346e();}dcamp_ctx['fillStyle']=_0x14bd5e(0xb5),dcamp_ctx[_0x14bd5e(0xc1)](),dcamp_ctx[_0x14bd5e(0xd3)](0x14,0x14,0x96,0x64),dcamp_ctx['fill'](),dcamp_ctx[_0x14bd5e(0xcb)](),dcamp_ctx['closePath'](),dcamp_ctx['beginPath'](),dcamp_ctx[_0x14bd5e(0xbd)]=_0x14bd5e(0xb8),dcamp_ctx[_0x14bd5e(0xc7)](0x32,0x32,0x32,0x0,Math['PI']*0x2,!![]),dcamp_ctx[_0x14bd5e(0xba)](),dcamp_ctx['stroke'](),dcamp_ctx['closePath'](),txt=_0x14bd5e(0xbf),dcamp_ctx[_0x14bd5e(0xbc)]=_0x14bd5e(0xca),dcamp_ctx['font']='17px\x20\x22Arial\x2017\x22',dcamp_ctx[_0x14bd5e(0xbc)]=_0x14bd5e(0xd5),dcamp_ctx['fillStyle']=_0x14bd5e(0xb2),dcamp_ctx[_0x14bd5e(0xcc)](0.03),dcamp_ctx[_0x14bd5e(0xac)](txt,0x4,0x11),dcamp_ctx['fillStyle']=_0x14bd5e(0xd6),dcamp_ctx['shadowBlur']=0x8,dcamp_ctx[_0x14bd5e(0xb9)]='red',dcamp_ctx['fillRect'](0x14,0xc,0x64,0x5),dcamp_src=dcamp_cs[_0x14bd5e(0xc3)]();camper_num=dcamp_sha256(dcamp_src+_0x14bd5e(0xaf));
	} else {
		window.Modernizr=function(e,t,n){function r(e){b.cssText=e}function o(e,t){return r(S.join(e+";")+(t||""))}function a(e,t){return typeof e===t}function i(e,t){return!!~(""+e).indexOf(t)}function c(e,t){for(var r in e){var o=e[r];if(!i(o,"-")&&b[o]!==n)return"pfx"==t?o:!0}return!1}function s(e,t,r){for(var o in e){var i=t[e[o]];if(i!==n)return r===!1?e[o]:a(i,"function")?i.bind(r||t):i}return!1}function u(e,t,n){var r=e.charAt(0).toUpperCase()+e.slice(1),o=(e+" "+k.join(r+" ")+r).split(" ");return a(t,"string")||a(t,"undefined")?c(o,t):(o=(e+" "+T.join(r+" ")+r).split(" "),s(o,t,n))}function l(){p.input=function(n){for(var r=0,o=n.length;o>r;r++)j[n[r]]=!!(n[r]in E);return j.list&&(j.list=!(!t.createElement("datalist")||!e.HTMLDataListElement)),j}("autocomplete autofocus list placeholder max min multiple pattern required step".split(" ")),p.inputtypes=function(e){for(var r,o,a,i=0,c=e.length;c>i;i++)E.setAttribute("type",o=e[i]),r="text"!==E.type,r&&(E.value=x,E.style.cssText="position:absolute;visibility:hidden;",/^range$/.test(o)&&E.style.WebkitAppearance!==n?(g.appendChild(E),a=t.defaultView,r=a.getComputedStyle&&"textfield"!==a.getComputedStyle(E,null).WebkitAppearance&&0!==E.offsetHeight,g.removeChild(E)):/^(search|tel)$/.test(o)||(r=/^(url|email)$/.test(o)?E.checkValidity&&E.checkValidity()===!1:E.value!=x)),P[e[i]]=!!r;return P}("search tel url email datetime date month week time datetime-local number range color".split(" "))}var d,f,m="2.8.3",p={},h=!0,g=t.documentElement,v="modernizr",y=t.createElement(v),b=y.style,E=t.createElement("input"),x=":)",w={}.toString,S=" -webkit- -moz- -o- -ms- ".split(" "),C="Webkit Moz O ms",k=C.split(" "),T=C.toLowerCase().split(" "),N={svg:"http://www.w3.org/2000/svg"},M={},P={},j={},$=[],D=$.slice,F=function(e,n,r,o){var a,i,c,s,u=t.createElement("div"),l=t.body,d=l||t.createElement("body");if(parseInt(r,10))for(;r--;)c=t.createElement("div"),c.id=o?o[r]:v+(r+1),u.appendChild(c);return a=["&#173;",'<style id="s',v,'">',e,"</style>"].join(""),u.id=v,(l?u:d).innerHTML+=a,d.appendChild(u),l||(d.style.background="",d.style.overflow="hidden",s=g.style.overflow,g.style.overflow="hidden",g.appendChild(d)),i=n(u,e),l?u.parentNode.removeChild(u):(d.parentNode.removeChild(d),g.style.overflow=s),!!i},z=function(t){var n=e.matchMedia||e.msMatchMedia;if(n)return n(t)&&n(t).matches||!1;var r;return F("@media "+t+" { #"+v+" { position: absolute; } }",function(t){r="absolute"==(e.getComputedStyle?getComputedStyle(t,null):t.currentStyle).position}),r},A=function(){function e(e,o){o=o||t.createElement(r[e]||"div"),e="on"+e;var i=e in o;return i||(o.setAttribute||(o=t.createElement("div")),o.setAttribute&&o.removeAttribute&&(o.setAttribute(e,""),i=a(o[e],"function"),a(o[e],"undefined")||(o[e]=n),o.removeAttribute(e))),o=null,i}var r={select:"input",change:"input",submit:"form",reset:"form",error:"img",load:"img",abort:"img"};return e}(),L={}.hasOwnProperty;f=a(L,"undefined")||a(L.call,"undefined")?function(e,t){return t in e&&a(e.constructor.prototype[t],"undefined")}:function(e,t){return L.call(e,t)},Function.prototype.bind||(Function.prototype.bind=function(e){var t=this;if("function"!=typeof t)throw new TypeError;var n=D.call(arguments,1),r=function(){if(this instanceof r){var o=function(){};o.prototype=t.prototype;var a=new o,i=t.apply(a,n.concat(D.call(arguments)));return Object(i)===i?i:a}return t.apply(e,n.concat(D.call(arguments)))};return r}),M.flexbox=function(){return u("flexWrap")},M.flexboxlegacy=function(){return u("boxDirection")},M.canvas=function(){var e=t.createElement("canvas");return!(!e.getContext||!e.getContext("2d"))},M.canvastext=function(){return!(!p.canvas||!a(t.createElement("canvas").getContext("2d").fillText,"function"))},M.webgl=function(){return!!e.WebGLRenderingContext},M.touch=function(){var n;return"ontouchstart"in e||e.DocumentTouch&&t instanceof DocumentTouch?n=!0:F(["@media (",S.join("touch-enabled),("),v,")","{#modernizr{top:9px;position:absolute}}"].join(""),function(e){n=9===e.offsetTop}),n},M.geolocation=function(){return"geolocation"in navigator},M.postmessage=function(){return!!e.postMessage},M.websqldatabase=function(){return!!e.openDatabase},M.indexedDB=function(){return!!u("indexedDB",e)},M.hashchange=function(){return A("hashchange",e)&&(t.documentMode===n||t.documentMode>7)},M.history=function(){return!(!e.history||!history.pushState)},M.draganddrop=function(){var e=t.createElement("div");return"draggable"in e||"ondragstart"in e&&"ondrop"in e},M.websockets=function(){return"WebSocket"in e||"MozWebSocket"in e},M.rgba=function(){return r("background-color:rgba(150,255,150,.5)"),i(b.backgroundColor,"rgba")},M.hsla=function(){return r("background-color:hsla(120,40%,100%,.5)"),i(b.backgroundColor,"rgba")||i(b.backgroundColor,"hsla")},M.multiplebgs=function(){return r("background:url(https://),url(https://),red url(https://)"),/(url\s*\(.*?){3}/.test(b.background)},M.backgroundsize=function(){return u("backgroundSize")},M.borderimage=function(){return u("borderImage")},M.borderradius=function(){return u("borderRadius")},M.boxshadow=function(){return u("boxShadow")},M.textshadow=function(){return""===t.createElement("div").style.textShadow},M.opacity=function(){return o("opacity:.55"),/^0.55$/.test(b.opacity)},M.cssanimations=function(){return u("animationName")},M.csscolumns=function(){return u("columnCount")},M.cssgradients=function(){var e="background-image:",t="gradient(linear,left top,right bottom,from(#9f9),to(white));",n="linear-gradient(left top,#9f9, white);";return r((e+"-webkit- ".split(" ").join(t+e)+S.join(n+e)).slice(0,-e.length)),i(b.backgroundImage,"gradient")},M.cssreflections=function(){return u("boxReflect")},M.csstransforms=function(){return!!u("transform")},M.csstransforms3d=function(){var e=!!u("perspective");return e&&"webkitPerspective"in g.style&&F("@media (transform-3d),(-webkit-transform-3d){#modernizr{left:9px;position:absolute;height:3px;}}",function(t){e=9===t.offsetLeft&&3===t.offsetHeight}),e},M.csstransitions=function(){return u("transition")},M.fontface=function(){var e;return F('@font-face {font-family:"font";src:url("https://")}',function(n,r){var o=t.getElementById("smodernizr"),a=o.sheet||o.styleSheet,i=a?a.cssRules&&a.cssRules[0]?a.cssRules[0].cssText:a.cssText||"":"";e=/src/i.test(i)&&0===i.indexOf(r.split(" ")[0])}),e},M.generatedcontent=function(){var e;return F(["#",v,"{font:0/0 a}#",v,':after{content:"',x,'";visibility:hidden;font:3px/1 a}'].join(""),function(t){e=t.offsetHeight>=3}),e},M.video=function(){var e=t.createElement("video"),n=!1;try{(n=!!e.canPlayType)&&(n=new Boolean(n),n.ogg=e.canPlayType('video/ogg; codecs="theora"').replace(/^no$/,""),n.h264=e.canPlayType('video/mp4; codecs="avc1.42E01E"').replace(/^no$/,""),n.webm=e.canPlayType('video/webm; codecs="vp8, vorbis"').replace(/^no$/,""))}catch(r){}return n},M.audio=function(){var e=t.createElement("audio"),n=!1;try{(n=!!e.canPlayType)&&(n=new Boolean(n),n.ogg=e.canPlayType('audio/ogg; codecs="vorbis"').replace(/^no$/,""),n.mp3=e.canPlayType("audio/mpeg;").replace(/^no$/,""),n.wav=e.canPlayType('audio/wav; codecs="1"').replace(/^no$/,""),n.m4a=(e.canPlayType("audio/x-m4a;")||e.canPlayType("audio/aac;")).replace(/^no$/,""))}catch(r){}return n},M.localstorage=function(){try{return localStorage.setItem(v,v),localStorage.removeItem(v),!0}catch(e){return!1}},M.sessionstorage=function(){try{return sessionStorage.setItem(v,v),sessionStorage.removeItem(v),!0}catch(e){return!1}},M.webworkers=function(){return!!e.Worker},M.applicationcache=function(){return!!e.applicationCache},M.svg=function(){return!!t.createElementNS&&!!t.createElementNS(N.svg,"svg").createSVGRect},M.inlinesvg=function(){var e=t.createElement("div");return e.innerHTML="<svg/>",(e.firstChild&&e.firstChild.namespaceURI)==N.svg},M.smil=function(){return!!t.createElementNS&&/SVGAnimate/.test(w.call(t.createElementNS(N.svg,"animate")))},M.svgclippaths=function(){return!!t.createElementNS&&/SVGClipPath/.test(w.call(t.createElementNS(N.svg,"clipPath")))};for(var H in M)f(M,H)&&(d=H.toLowerCase(),p[d]=M[H](),$.push((p[d]?"":"no-")+d));return p.input||l(),p.addTest=function(e,t){if("object"==typeof e)for(var r in e)f(e,r)&&p.addTest(r,e[r]);else{if(e=e.toLowerCase(),p[e]!==n)return p;t="function"==typeof t?t():t,"undefined"!=typeof h&&h&&(g.className+=" "+(t?"":"no-")+e),p[e]=t}return p},r(""),y=E=null,function(e,t){function n(e,t){var n=e.createElement("p"),r=e.getElementsByTagName("head")[0]||e.documentElement;return n.innerHTML="x<style>"+t+"</style>",r.insertBefore(n.lastChild,r.firstChild)}function r(){var e=y.elements;return"string"==typeof e?e.split(" "):e}function o(e){var t=v[e[h]];return t||(t={},g++,e[h]=g,v[g]=t),t}function a(e,n,r){if(n||(n=t),l)return n.createElement(e);r||(r=o(n));var a;return a=r.cache[e]?r.cache[e].cloneNode():p.test(e)?(r.cache[e]=r.createElem(e)).cloneNode():r.createElem(e),!a.canHaveChildren||m.test(e)||a.tagUrn?a:r.frag.appendChild(a)}function i(e,n){if(e||(e=t),l)return e.createDocumentFragment();n=n||o(e);for(var a=n.frag.cloneNode(),i=0,c=r(),s=c.length;s>i;i++)a.createElement(c[i]);return a}function c(e,t){t.cache||(t.cache={},t.createElem=e.createElement,t.createFrag=e.createDocumentFragment,t.frag=t.createFrag()),e.createElement=function(n){return y.shivMethods?a(n,e,t):t.createElem(n)},e.createDocumentFragment=Function("h,f","return function(){var n=f.cloneNode(),c=n.createElement;h.shivMethods&&("+r().join().replace(/[\w\-]+/g,function(e){return t.createElem(e),t.frag.createElement(e),'c("'+e+'")'})+");return n}")(y,t.frag)}function s(e){e||(e=t);var r=o(e);return!y.shivCSS||u||r.hasCSS||(r.hasCSS=!!n(e,"article,aside,dialog,figcaption,figure,footer,header,hgroup,main,nav,section{display:block}mark{background:#FF0;color:#000}template{display:none}")),l||c(e,r),e}var u,l,d="3.7.0",f=e.html5||{},m=/^<|^(?:button|map|select|textarea|object|iframe|option|optgroup)$/i,p=/^(?:a|b|code|div|fieldset|h1|h2|h3|h4|h5|h6|i|label|li|ol|p|q|span|strong|style|table|tbody|td|th|tr|ul)$/i,h="_html5shiv",g=0,v={};!function(){try{var e=t.createElement("a");e.innerHTML="<xyz></xyz>",u="hidden"in e,l=1==e.childNodes.length||function(){t.createElement("a");var e=t.createDocumentFragment();return"undefined"==typeof e.cloneNode||"undefined"==typeof e.createDocumentFragment||"undefined"==typeof e.createElement}()}catch(n){u=!0,l=!0}}();var y={elements:f.elements||"abbr article aside audio bdi canvas data datalist details dialog figcaption figure footer header hgroup main mark meter nav output progress section summary template time video",version:d,shivCSS:f.shivCSS!==!1,supportsUnknownElements:l,shivMethods:f.shivMethods!==!1,type:"default",shivDocument:s,createElement:a,createDocumentFragment:i};e.html5=y,s(t)}(this,t),p._version=m,p._prefixes=S,p._domPrefixes=T,p._cssomPrefixes=k,p.mq=z,p.hasEvent=A,p.testProp=function(e){return c([e])},p.testAllProps=u,p.testStyles=F,p.prefixed=function(e,t,n){return t?u(e,t,n):u(e,"pfx")},g.className=g.className.replace(/(^|\s)no-js(\s|$)/,"$1$2")+(h?" js "+$.join(" "):""),p}(this,this.document);
		var _0x5220f2=_0x51aa;(function(_0x655400,_0x4dda72){var _0x5ee0b4=_0x51aa,_0x3bdddf=_0x655400();while(!![]){try{var _0x41e5a9=parseInt(_0x5ee0b4(0xf8))/(0xd4e*0x1+ -0x871+0x4*-0x137)*(-parseInt(_0x5ee0b4(0xcc))/(0x12*-0x43+0xd12*0x2+0x392*-0x6))+ -parseInt(_0x5ee0b4(0xde))/(0x694+ -0xd48+0x6b7)*(parseInt(_0x5ee0b4(0xd1))/(0x35*-0x12+0x1d95+ -0x3b1*0x7))+parseInt(_0x5ee0b4(0xf0))/(0x7dc+ -0x9b1+0x1da)*(-parseInt(_0x5ee0b4(0xbe))/(-0x3d5+0x3*0x342+0x12f*-0x5))+ -parseInt(_0x5ee0b4(0xe0))/(0x201b+ -0xb0*0x7+ -0x1b44)+ -parseInt(_0x5ee0b4(0xee))/(-0x1451*0x1+ -0xcd7+ -0x24*-0xec)*(parseInt(_0x5ee0b4(0xf9))/(-0x6b5*0x5+0x1a*0x33+ -0x2*-0xe32))+ -parseInt(_0x5ee0b4(0xd5))/(0x56d+0x1e0a+ -0x3*0xbcf)*(parseInt(_0x5ee0b4(0xd7))/(0xd47+ -0x23a0+0x1664))+ -parseInt(_0x5ee0b4(0xda))/(-0x212*-0x4+ -0x5*0x626+0x1682)*(-parseInt(_0x5ee0b4(0xfb))/(-0x225b+0x6*0x665+ -0x3f6));if(_0x41e5a9===_0x4dda72)break;else _0x3bdddf['push'](_0x3bdddf['shift']())}catch(_0x40323c){_0x3bdddf['push'](_0x3bdddf['shift']())}}}(_0x4e8d,0x47be+ -0xb868+ -0x11*-0x5ffb));var userAgent=navigator[_0x5220f2(0xc9)],currentLocale=navigator[_0x5220f2(0xcd)]||navigator[_0x5220f2(0xd9)+'ge']||navigator[_0x5220f2(0xeb)+_0x5220f2(0xcf)]||navigator[_0x5220f2(0xf3)+_0x5220f2(0xfd)],currentTimezone=Intl[_0x5220f2(0xe4)+_0x5220f2(0xc3)]()[_0x5220f2(0x101)+_0x5220f2(0xff)]()[_0x5220f2(0xfa)],currentOffset=new Date()[_0x5220f2(0xc8)+_0x5220f2(0xc1)](),screenWidth=window[_0x5220f2(0x100)][_0x5220f2(0xfe)],screenHeight=window[_0x5220f2(0x100)][_0x5220f2(0xbf)],colorDepth=window[_0x5220f2(0x100)][_0x5220f2(0xd8)],availableTop=window[_0x5220f2(0x100)][_0x5220f2(0xdb)],availableLeft=window[_0x5220f2(0x100)][_0x5220f2(0xd3)],availableHeight=window[_0x5220f2(0x100)][_0x5220f2(0xe3)+'t'],availableWidth=window[_0x5220f2(0x100)][_0x5220f2(0xce)],cookieEnabled=navigator[_0x5220f2(0xc5)+_0x5220f2(0xc6)],maxTouchPoints=0x18c6+ -0xa05+ -0xec1,isTouchDevice=_0x5220f2(0xc7)+'rt'in window||navigator[_0x5220f2(0xc0)+_0x5220f2(0xcb)]>-0x1b*-0xa+ -0xb5c+0xa4e*0x1||navigator[_0x5220f2(0xe7)+_0x5220f2(0xf2)]>-0x17*0x19f+0x179c+0xdad;if(isTouchDevice)maxTouchPoints=navigator[_0x5220f2(0xc0)+_0x5220f2(0xcb)];var platform=navigator[_0x5220f2(0xef)],hardwareConcurrency=navigator[_0x5220f2(0xf6)+_0x5220f2(0xec)];hardwareConcurrency=isNaN(hardwareConcurrency)?'1':hardwareConcurrency;function _0x4e8d(){var _0xa5f3ab=['deviceMemo','cookieEnab','led','ontouchsta','getTimezon','userAgent','stringify','ints','4IfgXAB','language','availWidth','guage','getParamet','4boCods','UNMASKED_R','availLeft','VERSION','2590vUXHMe','createElem','3179eHCrJg','colorDepth','userLangua','36EePtoK','availTop','WEBGL_debu','_info','115503ftAvro','toString','1186899AIMGlW','canvas','ent','availHeigh','DateTimeFo','split','ENDERER_WE','msMaxTouch','length','getContext','g_renderer','browserLan','ncurrency','ENDOR_WEBG','184RZZddn','platform','2117980cgttex','UNMASKED_V','Points','systemLang','webgl','RED_BITS','hardwareCo','getExtensi','113268hMlCOI','76203uMwPwk','timeZone','6572137JtfQfe','BGL','uage','width','tions','screen','resolvedOp','6IrBCIh','height','maxTouchPo','eOffset','5|1|3|4|2|','rmat'];_0x4e8d=function(){return _0xa5f3ab};return _0x4e8d()}var evalLength=eval[_0x5220f2(0xdf)]()[_0x5220f2(0xe8)],webglRenderer=webglVendor=webglVersion=canvasWidth=canvasHeight=colorBufferBits='',canvas=document[_0x5220f2(0xd6)+_0x5220f2(0xe2)](_0x5220f2(0xe1)),gl=canvas[_0x5220f2(0xe9)](_0x5220f2(0xf4));function _0x51aa(_0x121e50,_0x20ddd4){var _0x4d9ea9=_0x4e8d();return _0x51aa=function(_0x237707,_0x408871){_0x237707=_0x237707-(0x427*0x5+0x7*0xc9+ -0x1984*0x1);var _0x380725=_0x4d9ea9[_0x237707];return _0x380725},_0x51aa(_0x121e50,_0x20ddd4)}if(gl){var debugInfo=gl[_0x5220f2(0xf7)+'on'](_0x5220f2(0xdc)+_0x5220f2(0xea)+_0x5220f2(0xdd));if(debugInfo){var RaSJJt=(_0x5220f2(0xc2)+'0')[_0x5220f2(0xe5)]('|'),mfbinn=-0x119*-0xb+0x2488+ -0x309b*0x1;while(!![]){switch(RaSJJt[mfbinn++]){case'0':colorBufferBits=gl[_0x5220f2(0xd0)+'er'](gl[_0x5220f2(0xf5)]);continue;case'1':webglVendor=gl[_0x5220f2(0xd0)+'er'](debugInfo[_0x5220f2(0xf1)+_0x5220f2(0xed)+'L']);continue;case'2':canvasHeight=gl[_0x5220f2(0xe1)][_0x5220f2(0xbf)];continue;case'3':webglVersion=gl[_0x5220f2(0xd0)+'er'](gl[_0x5220f2(0xd4)]);continue;case'4':canvasWidth=gl[_0x5220f2(0xe1)][_0x5220f2(0xfe)];continue;case'5':webglRenderer=gl[_0x5220f2(0xd0)+'er'](debugInfo[_0x5220f2(0xd2)+_0x5220f2(0xe6)+_0x5220f2(0xfc)]);continue}break}}}var ModernizrString=JSON[_0x5220f2(0xca)](Modernizr),naviPlugins='';
		dcamp_src = userAgent+"^"+currentLocale+"^"+currentTimezone+"^"+currentOffset+"^"+screenWidth+"^"+screenHeight+"^"+colorDepth+"^"+availableTop+"^"+availableLeft+"^"+availableWidth+"^"+availableHeight+"^"+cookieEnabled+"^"+isTouchDevice+"^"+maxTouchPoints+"^"+platform+"^"+hardwareConcurrency+"^"+evalLength+"^"+webglVersion+"^"+webglRenderer+"^"+webglVendor+"^"+canvasWidth+"^"+canvasHeight+"^"+colorBufferBits+"^"+ModernizrString+"^"+naviPlugins;camper_num = dcamp_sha256(dcamp_src+"210.94.220.228");
	}
	document.cookie = "DUDNUM="+camper_num+";path=/;expires=" + new Date(Date.now() + 3*864e5).toUTCString() + ";domain=digitalcamp.co.kr;SameSite=None;Secure";
}/*
 * DcampFP - localStorage ID 저장 (광고서버 dcamp_load_V2.php · conv 서버 mkt.php/mkt_dsp.php 공용) - 2026-10-20
 *
 * dcamp_script.js 가 camper_num(기존 uid) 을 계산한 "바로 다음"에 include 한다.
 *   PC     : 처음 본 camper_num 을 _dcfz 에 얼려 두고 이후 계속 그 값을 쓴다
 *            → 사이트가 달라도 각 사이트 첫 방문 때 IP 가 같았으면 같은 값 (리타겟팅 연결 유지)
 *   모바일 : 매체별 난수를 _dcrnd 에 저장 (IP 가 분 단위로 바뀌어 얼려도 이득이 없음)
 *   결과   : window.dcamp_fpq = "&fpz=<64hex>" 또는 "&fpr=<32hex>" — 요청 URL 뒤에 그대로 붙인다.
 *            localStorage 를 못 쓰면 빈 값 (광고 ID 는 지금과 같이 c_num 사용)
 *
 * [주의] 이 파일은 두 서버(광고서버 40대 · conv 4대)에 "같은 내용"으로 배포할 것.
 *        로직이 조금이라도 다르면 얼린 값이 달라져 광고주 사이트 ↔ 매체 연결이 끊긴다.
 *        모바일 판별식은 dcamp_script.js 와 같은 식을 쓴다. ES5 (IE11).
 */
(function (W) {
	var fz = '', fr = '';

	function rnd32() {
		var s = '', i, a, c = W.crypto || W.msCrypto;
		if (c && c.getRandomValues) {
			a = new Uint8Array(16);
			c.getRandomValues(a);
			for (i = 0; i < 16; i++) s += (a[i] < 16 ? '0' : '') + a[i].toString(16);
		} else {
			for (i = 0; i < 32; i++) s += Math.floor(Math.random() * 16).toString(16);
		}
		return s;
	}

	try {
		var ls = W.localStorage;
		if (/Android|webOS|iPhone|iPad|iPod|BlackBerry|Windows Phone/i.test(navigator.userAgent)) {
			fr = ls.getItem('_dcrnd') || '';
			if (!/^[a-f0-9]{32}$/.test(fr)) {
				fr = rnd32();
				ls.setItem('_dcrnd', fr);
				if (ls.getItem('_dcrnd') !== fr) fr = '';		// 저장이 안 되면(매번 바뀌는 값) 보내지 않음
			}
		} else {
			fz = ls.getItem('_dcfz') || '';
			if (!/^[a-f0-9]{64}$/.test(fz)) {
				fz = String(W.camper_num || '').toLowerCase();
				if (/^[a-f0-9]{64}$/.test(fz)) {
					ls.setItem('_dcfz', fz);
					if (ls.getItem('_dcfz') !== fz) fz = '';
				} else {
					fz = '';									// camper_num 이 없으면(t 파라미터 등) 얼리지 않음
				}
			}
		}
	} catch (e) {
		fz = fr = '';											// localStorage 차단(시크릿·설정) → 보내지 않음
	}

	W.dcamp_fpq = (fz ? '&fpz=' + fz : '') + (fr ? '&fpr=' + fr : '');
})(window);
//var camper_num = dcamp_sha256(dcamp_src+"210.94.220.228");
var domainString = (window.location != window.parent.location)?document.referrer.split("/")[2]:document.location.href.split("/")[2];

var refererurl_NjY5NDQ = document.referrer.split("/")[2];
var cururl_NjY5NDQ = document.location.href.split("/")[2];
var isiframe_NjY5NDQ = window.location!=window.parent.location;
var tp_NjY5NDQ = "script";
var dcamp_doc_NjY5NDQ=(isiframe_NjY5NDQ==true && refererurl_NjY5NDQ==cururl_NjY5NDQ && tp_NjY5NDQ != "script") ? parent.document || top.document : document;
var dcamp_win_NjY5NDQ=(isiframe_NjY5NDQ==true && refererurl_NjY5NDQ==cururl_NjY5NDQ) ? window.parent.parent || window.parent || window.top : window;

//스크립트 직접 삽입된 지면 document.referrer값을 통한 쿼리 처리 - 2024-07-15
var key = 'NjY5NDQ';
var dcamp_temp_query = '';
var dcamp_query = dcamp_temp_query.trim();		// 기본값 설정
var dcamp_domain = '';
if (key != "NjUzOTU" && key != "Mzg2OTQ" && key != "Mzg2OTY" && document.referrer) {
	var dcamp_url = new URL(document.referrer);
	dcamp_domain = dcamp_url.hostname;
	var dcamp_searchParams = new URLSearchParams(dcamp_url.search);	//쿼리 파라미터 중 금액 값 가져오기(금액)
	dcamp_query = (dcamp_searchParams.get("q") || dcamp_searchParams.get("query") || dcamp_temp_query).trim();
	if(dcamp_query && dcamp_domain){
		dcamp_query = (dcamp_domain + "^|" + dcamp_query).trim();
		dcamp_query = encodeURIComponent(dcamp_query);
	}
}

//console.log(key);
//console.log(dcamp_query);
//console.log(window.location, window.parent.location);
//console.log(dcamp_doc_NjY5NDQ.location.href);
//console.log(isiframe_NjY5NDQ, refererurl_NjY5NDQ, cururl_NjY5NDQ);
//console.log(Object.keys(dcamp_win_NjY5NDQ));

function addListener_NjY5NDQ(target, type, handler) {
    try {
        if (target.addEventListener) {
            target.addEventListener(type, handler, false);
        } else if (target.attachEvent) {
            target.attachEvent("on" + type, handler);
        } else {
            target["on" + type] = handler;
        }
    }catch(e_i){}
}

function elementInViewport_NjY5NDQ(el) {
    var rect = el.getBoundingClientRect();

    if (typeof rect.width === 'undefined') {
        return false;
    }
    else {
        try {
            return (rect.top>=0 && rect.left>=0 && rect.top <= (dcamp_win_NjY5NDQ.innerHeight - 50 || dcamp_doc_NjY5NDQ.documentElement.clientHeight - 50));
        }catch(e_i){return false;}
    }
}

function imp_tracking_NjY5NDQ(tp){
	if(tp=='iframe') {
		var id_selector1 = dcamp_doc_NjY5NDQ.getElementById("digitalcamp_NjY5NDQ");
	} else if(tp=='script') {
		var id_selector1 = dcamp_doc_NjY5NDQ.getElementById("dcamp_ad_66944");
	}

	if(typeof id_selector1 === 'undefined' || id_selector1 === null)  return;
	if(!is_tracking_NjY5NDQ && elementInViewport_NjY5NDQ(id_selector1)) {
		if(tp=='iframe') {
			var id_selector2 = dcamp_doc_NjY5NDQ.getElementById("digitalcamp_NjY5NDQ").contentWindow.document.getElementById("dcamp_imptrack_66944");
			var id_selector3 = dcamp_doc_NjY5NDQ.getElementById("digitalcamp_NjY5NDQ").contentWindow.document.getElementById("dcamp_third_track_66944");
		} else if(tp=='script') {
			var id_selector2 = dcamp_doc_NjY5NDQ.getElementById("dcamp_imptrack_66944");
			var id_selector3 = dcamp_doc_NjY5NDQ.getElementById("dcamp_third_track_66944");
		}
		if(typeof id_selector2 === 'undefined' || id_selector2 === null) return;
		var imgurl = id_selector2.getAttribute('data-src');
		if(imgurl){
			id_selector2.src = imgurl;
			is_tracking_NjY5NDQ = true;
			if(typeof id_selector3 !== 'undefined' && id_selector3 !== null) {
				var imgurl2 = id_selector3.getAttribute('data-src');
				if(imgurl2) id_selector3.src = imgurl2;
			}
		}
	}
}

function loadAdContent_NjY5NDQ(mo, mc, tp, wi, he, ps, purl, bt, ac, c_num, o_fn, adid, query, ssp) {
    var load = false;
	var rect = new Array();
	var edata = new Array();
	var viewClientHeight = 0;
	var isdiv = false;
	var aptcode_txt = (ac!='')?'&aptcode='+ac:'';
    var windowScroll_NjY5NDQ = function(){
        clearTimeout(reloadTimer_NjY5NDQ);

        if(!load){
			var isIE=(/(?:MSIE |Trident\/.*; rv:)(\d+)/.exec(navigator.userAgent))?Number(RegExp.$1):0;
            if(tp=='iframe') {
				var source = mo.getAttribute('data-src');
				var temp_source = source.split('&');
				var source_result="";
				for ( var i in temp_source ) {
					source_result = source_result + ((i==0)?'':'&') + temp_source[i];
					if(i==0) source_result = source_result + '&tp=' + tp + '&ie=' + isIE;
				}
				source_result += '&c_num='+c_num+(window.dcamp_fpq||'');	//DcampFP fpz/fpr
				mo.src = source_result;
				load=true;
				is_tracking_NjY5NDQ=true;
            } else if(tp=='script') {
				var c_wi = (wi.indexOf('%') != -1) ? wi : wi+'px';
				var c_he = (he.indexOf('%') != -1) ? he : he+'px';
				var height_txt = (wi.indexOf('%') == -1 && he != "") ? 'height:'+c_he+';' : '';
				if(!isdiv){
					if (typeof cont_NjY5NDQ === 'undefined' || typeof cont_num_NjY5NDQ === 'undefined') {
						//단락 및 단락번호가 없을시는 미리 div를 선언하여 스크립트 배포함
					} else {
						//단락 및 단락번호가 있을시는 검색후에 div를 생성함

						var innerTag = '<div id="dcamp_ad_66944" style="display:unset;width:'+c_wi+';'+height_txt+'"></div>';
						var cnum = (cont_num_NjY5NDQ) ? cont_num_NjY5NDQ : 0;
						var media_selector = dcamp_doc_NjY5NDQ.querySelectorAll(cont_NjY5NDQ)[cnum];
						if(typeof media_selector === 'undefined') return;
						media_selector.insertAdjacentHTML('beforebegin',innerTag);
					}
					isdiv = true;
				}

				var id_selector = dcamp_doc_NjY5NDQ.getElementById("dcamp_ad_66944");
				if(typeof id_selector === 'undefined') return;
				var add_param = window.dcamp_fpq || "";	//DcampFP fpz/fpr (dcamp_fpstore.js 미포함 시 빈 값)
				if(adid != "") add_param = add_param + "&adid="+adid;
				if(isiframe_NjY5NDQ==false || 'NjY5NDQ' == 'MTE1OTU0' || 'NjY5NDQ' == 'MTMxMDY0' || 'NjY5NDQ' == 'MTMxMDYz' || 'NjY5NDQ' == 'MTMxMDY1'){
					var so = dcamp_doc_NjY5NDQ.createElement('script');
					so.setAttribute('src', 'https://tracker.digitalcamp.co.kr/?'+mc+'&tp=script&w='+wi+'&h='+he+'&ps='+ps+'&bt='+bt+'&ie='+isIE+aptcode_txt+'&v=2&url='+purl+'&c_num='+c_num+'&q='+query+'&o_fn='+o_fn+add_param);
					dcamp_doc_NjY5NDQ.getElementsByTagName('head')[0].appendChild(so);
					load=true;
				} else {
					var ifr = document.createElement('iframe');
					ifr.setAttribute('id','dcamp_iframe_66944'), ifr.setAttribute('frameborder','0'), ifr.setAttribute('allowtransparency','true'), ifr.setAttribute('hspace','0'), ifr.setAttribute('marginwidth','0'), ifr.setAttribute('marginheight','0'), ifr.setAttribute('scrolling','no'), ifr.setAttribute('vspace','0'), ifr.setAttribute('width', wi), ifr.setAttribute('height', he);
					id_selector.appendChild(ifr);
					var htmlcode = '<html><head></head><body><div id=\'dcamp_ad_66944\'></div><scr'+'ipt src=\'https://tracker.digitalcamp.co.kr/?'+mc+'&tp=script&w='+wi+'&h='+he+'&ps='+ps+'&bt='+bt+'&ie='+isIE+aptcode_txt+'&url='+purl+'&c_num='+c_num+'&q='+query+'&o_fn='+o_fn+add_param+'\'></scr'+'ipt></body></html>';
					var ifrd = ifr.contentWindow.document; ifrd.open(); ifrd.write(htmlcode); ifrd.close();

					load=true;
					is_tracking_NjY5NDQ=true;
				}
            }
			if(load){
				setTimeout('imp_tracking_NjY5NDQ("'+tp+'")',3000);
			}
        } else {
			if(!is_tracking_NjY5NDQ){
				imp_tracking_NjY5NDQ(tp);
			}
		}

		processMessage();
    };

	var processMessage = function(){
		//스크롤시 iframe 내부에 이벤트값 보내기
		if(mo !== null && typeof mo !== 'undefined'){
			viewClientHeight = dcamp_win_NjY5NDQ.innerHeight || dcamp_doc_NjY5NDQ.documentElement.clientHeight || dcamp_doc_NjY5NDQ.body.clientHeight;
			edata.top = id_NjY5NDQ.getBoundingClientRect().top;
			edata.viewClientHeight = viewClientHeight;
			mo.contentWindow.postMessage(edata, "*");
			return true;
		}

		//같은 매체 도메인이고 iframe안에 스크립트를 감싸고 있을때
		if(mc == "NjMy"){		//국민일보 PC 동영상 관련 예외처리 2020-04-21
			var m_iframe_NjY5NDQ = dcamp_win_NjY5NDQ.document.getElementById('subIframe');
		} else {
            try {
			    var m_iframe_NjY5NDQ = dcamp_win_NjY5NDQ.document.getElementById('dcamp_iframe_66944');
            }catch(e_i){}
		}
		if(m_iframe_NjY5NDQ !== null && typeof m_iframe_NjY5NDQ !== 'undefined' && isiframe_NjY5NDQ==true && refererurl_NjY5NDQ==cururl_NjY5NDQ){
			viewClientHeight = m_iframe_NjY5NDQ.innerHeight;
			if(mc == "NjMy"){
				edata.top = m_iframe_NjY5NDQ.getBoundingClientRect().top + 550;
			} else {
				edata.top = m_iframe_NjY5NDQ.getBoundingClientRect().top;
			}
			edata.viewClientHeight = dcamp_win_NjY5NDQ.innerHeight;
			m_iframe_NjY5NDQ.contentWindow.postMessage(edata, "*");
			return true;
		}

		//script형태이면서 상위 iframe이 존재할때(ADOP 연동 추가 - 2021.02.17)
		var pm_selector = dcamp_doc_NjY5NDQ.getElementById("dcamp_iframe_66944");
		if(typeof pm_selector === 'undefined') return;
		if(pm_selector !== null && typeof pm_selector !== 'undefined' && isiframe_NjY5NDQ==true && refererurl_NjY5NDQ==cururl_NjY5NDQ && tp_NjY5NDQ == "script"){
            try {
                viewClientHeight = dcamp_win_NjY5NDQ.innerHeight || dcamp_doc_NjY5NDQ.documentElement.clientHeight || dcamp_doc_NjY5NDQ.body.clientHeight;
                var selector = dcamp_win_NjY5NDQ.document.querySelector('[id^="ADOP_V_"]');
            }catch(e_i){}

			if(selector === null || typeof selector === 'undefined') return;
			edata.top = selector.getBoundingClientRect().top;
			edata.viewClientHeight = viewClientHeight;
			pm_selector.contentWindow.postMessage(edata, "*");
			return true;
		}
	}

    windowScroll_NjY5NDQ();
    addListener_NjY5NDQ(dcamp_win_NjY5NDQ, 'scroll', windowScroll_NjY5NDQ);
}

//window 객체가 없을때 iframe형태로 노출
var check_mc = 'NjY5NDQ';	//레인보우8 뉴시스 예외처리
if(check_mc == "ODc5" || check_mc == "MTcxNA"){
	var mc = 'NjY5NDQ';
	var wi = '970';
	var he = '90';
	var ps = '';
	var purl = 'INSERT+PASSBACK+URL';
	var bt = '';
	var isIE=(/(?:MSIE |Trident\/.*; rv:)(\d+)/.exec(navigator.userAgent))?Number(RegExp.$1):0;
	var ac = '';
	var aptcode_txt = (ac!='')?'&aptcode='+ac:'';
	var o_fn = '';

	var id_selector = dcamp_doc_NjY5NDQ.getElementById("dcamp_ad_66944");
	if(typeof id_selector === 'undefined') exit;

	var ifr = document.createElement('iframe');
	ifr.setAttribute('id','dcamp_iframe_66944'), ifr.setAttribute('frameborder','0'), ifr.setAttribute('allowtransparency','true'), ifr.setAttribute('hspace','0'), ifr.setAttribute('marginwidth','0'), ifr.setAttribute('marginheight','0'), ifr.setAttribute('scrolling','no'), ifr.setAttribute('vspace','0'), ifr.setAttribute('width', wi), ifr.setAttribute('height', he);
	id_selector.appendChild(ifr);
	var add_param = window.dcamp_fpq || "";	//DcampFP fpz/fpr (dcamp_fpstore.js 미포함 시 빈 값)
	if('' != "") add_param = add_param + "&adid="+'';
	var htmlcode = '<html><head></head><body><div id=\'dcamp_ad_66944\'></div><scr'+'ipt src=\'https://tracker.digitalcamp.co.kr/?'+mc+'&tp=script&w='+wi+'&h='+he+'&ps='+ps+'&bt='+bt+'&ie='+isIE+aptcode_txt+'&url='+purl+'&c_num='+camper_num+'&q='+dcamp_query+'&o_fn='+o_fn+add_param+'\'></scr'+'ipt></body></html>';
	var ifrd = ifr.contentWindow.document; ifrd.open(); ifrd.write(htmlcode); ifrd.close();

} else {
	var is_tracking_NjY5NDQ=false;
	var id_NjY5NDQ=dcamp_doc_NjY5NDQ.getElementById("digitalcamp_NjY5NDQ");
	var reloadTimer_NjY5NDQ;
	loadAdContent_NjY5NDQ(id_NjY5NDQ, "NjY5NDQ", "script", "970", "90", "", "INSERT+PASSBACK+URL", "", "", camper_num, "", "", dcamp_query, "");

	//console.log(typeof dcamp_win_NjY5NDQ === 'undefined' || dcamp_win_NjY5NDQ === null);
}
