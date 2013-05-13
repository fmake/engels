var WS_UA = navigator.userAgent.toLowerCase();

var browser={
  version: (WS_UA.match( /.+(?:me|ox|on|rv|it|ra|ie)[\/: ]([\d.]+)/ ) || [0,'0'])[1],
  opera: /opera/i.test(WS_UA),
  msie: (!this.opera && /msie/i.test(WS_UA)),
  msie6: (!this.opera && /msie 6/i.test(WS_UA)),
  msie7: (!this.opera && /msie 7/i.test(WS_UA)),  
  msie8: (!this.opera && /msie 8/i.test(WS_UA)),
  mozilla: /firefox/i.test(WS_UA),
  chrome: /chrome/i.test(WS_UA),
  safari: (!this.chrome && /webkit|safari|khtml/i.test(WS_UA)),
  iphone: /iphone/i.test(WS_UA),
  ipad: /ipad/i.test(WS_UA)
}

function get_doc_body(){
  return document.body || document.documentElement;
}

function abs_pos(obj) {
  var a={'x': 0, 'y':0, 'w':0, 'h':0};
  if(!(obj=$(obj))) return a;
  a['w']=parseInt(get_style(obj, 'width'));  
  a['h']=parseInt(get_style(obj, 'height'));
  while(obj){ 	
    a['x']+=obj.offsetLeft;
    a['y']+=obj.offsetTop;
    obj=obj.offsetParent; 
  } 
  if(WS_UA.indexOf("Mac")!=-1 && typeof(document.body.leftMargin)!="undefined"){
    a['x']+=document.body.leftMargin;
    a['y']+=document.body.topMargin;
  }  
  return a; 
}

function get_client_width(){
  return ( (document.compatMode=='CSS1Compat') && !window.opera) ? document.documentElement.clientWidth : document.body.clientWidth;
}

function get_client_height(){
  return ((document.compatMode=='CSS1Compat') && !window.opera) ? document.documentElement.clientHeight : document.body.clientHeight;
}

function get_scroll_top(obj){
  if(!(obj=$(obj))) return 0;
  else if(typeof(obj.scrollTop)!='undefined') return obj.scrollTop;
  else if(typeof(obj.pageYOffset)!='undefined') return obj.pageYOffset;
  return 0;
}

function get_scroll_height(obj){
  if(!(obj=$(obj))) return 0; 
  return (obj.scrollHeight>obj.offsetHeight) ? obj.scrollHeight : obj.offsetHeight;
}

function set_scroll_top(obj, p){
  if(!(obj=$(obj))) return false;
  p=parseInt(p)
  if(typeof(obj.scrollTop)!='undefined') obj.scrollTop=p;
  else if(typeof(obj.pageYOffset)!='undefined') obj.pageYOffset=p;
  return false;
}

function each(obj, callback) {
  var name, i=0, length=obj.length;
  if ( length === undefined ) {
    for ( name in obj )
      if ( callback.call( obj[ name ], name, obj[ name ] ) === false )
        break;
  } else
    for ( var value = obj[0];
      i < length && callback.call( value, i, value ) !== false; value = obj[++i] ){}
	
  return obj;
}

function get_class_style(selector, prop) {
  if(document.styleSheets){
    for(var i = 0; i<document.styleSheets.length; i++){
      var styleRules=document.styleSheets[i];
      try{
	    if(styleRules.rules) styleRules=styleRules.rules;		
	    else if(styleRules.cssRules) styleRules=styleRules.cssRules;	  
	  }catch(e){continue;}	
	  if(!styleRules) continue;	
      for(var j=0; j<styleRules.length; j++) {
        if(styleRules[j].selectorText.toLowerCase()==selector.toLowerCase()){ 
		  return (styleRules[j].style[prop]) ? styleRules[j].style[prop] : undefined; 
		}
      }
    }
  }
  return undefined;
}

function get_style(obj, name, force) {
  if(!(obj=$(obj))) return;  
  if(typeof(force)=="undefined") force=true;
  
  if(!force && name == 'opacity' && browser.msie) {
    var filter = obj.style['filter'];
    return filter ? (filter.indexOf("opacity=") >= 0 ?
      (parseFloat(filter.match(/opacity=([^)]*)/)[1] ) / 100) + '' : '1') : '';
  }  

  if(force && (name=='width' || name=='height')) {	  
 	if(name=='width' && obj.offsetWidth) return obj.offsetWidth+'px';
	else if(name=='height' && obj.offsetHeight) return obj.offsetHeight+'px';
	force=false;
  }

  if(!force && typeof(obj.style[name])!='undefined' && obj.style[name]) 
    return obj.style[name];

  var ret, defaultView = document.defaultView || window;
  if (defaultView.getComputedStyle) {
    name = name.replace( /([A-Z])/g, "-$1" ).toLowerCase();
    var computedStyle = defaultView.getComputedStyle( obj, null );
    if (computedStyle) ret = computedStyle.getPropertyValue(name);
	
  }else if (obj.currentStyle) {
    if (name == 'opacity' && browser.msie) {
      var filter = obj.currentStyle['filter'];
      return filter && filter.indexOf("opacity=") >= 0 ?
        (parseFloat(filter.match(/opacity=([^)]*)/)[1] ) / 100) + '' : '1';
    }
    var camelCase = name.replace(/\-(\w)/g, function(all, letter){
      return letter.toUpperCase();
    });
    ret = obj.currentStyle[name] || obj.currentStyle[camelCase];
    //dummy fix for ie
    if(ret == 'auto') ret = 0;
    // If we're not dealing with a regular pixel number
    // but a number that has a weird ending, we need to convert it to pixels
    if ( !/^\d+(px)?$/i.test( ret ) && /^\d/.test( ret ) ) {
      // Remember the original values
      var left = style.left, rsLeft = obj.runtimeStyle.left;

      // Put in the new values to get a computed value out
      obj.runtimeStyle.left = obj.currentStyle.left;
      style.left = ret || 0;
      ret = style.pixelLeft + "px";

      // Revert the changed values
      style.left = left;
      obj.runtimeStyle.left = rsLeft;
    }
  }

  if((!ret || ret=='0px') && obj.className){
    var x=get_class_style('.'+obj.className, name);  
	if(x) ret=x;
  }
  
  return ret;
}

function set_style(obj, name, value){
  if(!(obj=$(obj))) return;
  if(typeof(name)=='object') 
    return each(name, function(k, v){ set_style(obj, k, v);} );
  if(name == 'opacity'){
    if(browser.msie){
      obj.style.filter = (is_int(value)) ? "alpha(opacity=" + value*100 + ")" : '';
      obj.style.zoom = 1;
    };
    obj.style.opacity = value;
	
  }else{
    var isNum = typeof(value)=='number' && !(/z-?index|font-?weight|opacity|zoom|line-?height/i).test(name);
    if(isNum && value<0 && (/^(width|height)$/i).test(name)) value = 0; //fix for IE;
    obj.style[name] = isNum ? value + 'px' : value;
  }
} 