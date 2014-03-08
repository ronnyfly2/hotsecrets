if (!window.HotSec) var HotSec = {};

HotSec.Cookies = {};
HotSec.Cookies.expires  = null;
HotSec.Cookies.path     = '/';
HotSec.Cookies.domain   = null;
HotSec.Cookies.secure   = false;
HotSec.Cookies.set = function(name, value){
     var argv = arguments;
     var argc = arguments.length;
     var expires = (argc > 2) ? argv[2] : HotSec.Cookies.expires;
     var path = (argc > 3) ? argv[3] : HotSec.Cookies.path;
     var domain = (argc > 4) ? argv[4] : HotSec.Cookies.domain;
     var secure = (argc > 5) ? argv[5] : HotSec.Cookies.secure;
     document.cookie = name + "=" + escape (value) +
       ((expires == null) ? "" : ("; expires=" + expires.toGMTString())) +
       ((path == null) ? "" : ("; path=" + path)) +
       ((domain == null) ? "" : ("; domain=" + domain)) +
       ((secure == true) ? "; secure" : "");
};

HotSec.Cookies.get = function(name){
    var arg = name + "=";
    var alen = arg.length;
    var clen = document.cookie.length;
    var i = 0;
    var j = 0;
    while(i < clen){
        j = i + alen;
        if (document.cookie.substring(i, j) == arg)
            return HotSec.Cookies.getCookieVal(j);
        i = document.cookie.indexOf(" ", i) + 1;
        if(i == 0)
            break;
    }
    return null;
};

HotSec.Cookies.clear = function(name) {
  if(HotSec.Cookies.get(name)){
    document.cookie = name + "=" +
    "; expires=Thu, 01-Jan-70 00:00:01 GMT";
  }
};

HotSec.Cookies.getCookieVal = function(offset){
   var endstr = document.cookie.indexOf(";", offset);
   if(endstr == -1){
       endstr = document.cookie.length;
   }
   return unescape(document.cookie.substring(offset, endstr));
};