if(typeof(jQuery)!="undefined"){if(typeof(jQuery.fn.hoverIntent)=="undefined"){(function(b){b.fn.hoverIntent=function(p,r){var g={sensitivity:7,interval:100,timeout:0};g=b.extend(g,r?{over:p,out:r}:p);var a,f,t,v;var u=function(c){a=c.pageX;f=c.pageY};var w=function(c,d){d.hoverIntent_t=clearTimeout(d.hoverIntent_t);if((Math.abs(t-a)+Math.abs(v-f))<g.sensitivity){b(d).unbind("mousemove",u);d.hoverIntent_s=1;return g.over.apply(d,[c])}else{t=a;v=f;d.hoverIntent_t=setTimeout(function(){w(c,d)},g.interval)}};var s=function(c,d){d.hoverIntent_t=clearTimeout(d.hoverIntent_t);d.hoverIntent_s=0;return g.out.apply(d,[c])};var x=function(e){var d=this;var c=(e.type=="mouseover"?e.fromElement:e.toElement)||e.relatedTarget;while(c&&c!=this){try{c=c.parentNode}catch(e){c=this}}if(c==this){if(b.browser.mozilla){if(e.type=="mouseout"){d.mtout=setTimeout(function(){q(e,d)},30)}else{if(d.mtout){d.mtout=clearTimeout(d.mtout)}}}return}else{if(d.mtout){d.mtout=clearTimeout(d.mtout)}q(e,d)}};var q=function(e,d){var c=jQuery.extend({},e);if(d.hoverIntent_t){d.hoverIntent_t=clearTimeout(d.hoverIntent_t)}if(e.type=="mouseover"){t=c.pageX;v=c.pageY;b(d).bind("mousemove",u);if(d.hoverIntent_s!=1){d.hoverIntent_t=setTimeout(function(){w(c,d)},g.interval)}}else{b(d).unbind("mousemove",u);if(d.hoverIntent_s==1){d.hoverIntent_t=setTimeout(function(){s(c,d)},g.timeout)}}};return this.mouseover(x).mouseout(x)}})(jQuery)}jQuery(document).ready(function(b){var a=function(c,e){var f=b(e),d=f.attr("tabindex");if(d){f.attr("tabindex","0").attr("tabindex",d)}};b("#wpadminbar").removeClass("nojq").removeClass("nojs").find("li.menupop").hoverIntent({over:function(c){b(this).addClass("hover")},out:function(c){b(this).removeClass("hover")},timeout:180,sensitivity:7,interval:100});b("#wp-admin-bar-get-shortlink").click(function(c){c.preventDefault();b(this).addClass("selected").children(".shortlink-input").blur(function(){b(this).parents("#wp-admin-bar-get-shortlink").removeClass("selected")}).focus().select()});b("#wpadminbar li.menupop > .ab-item").bind("keydown.adminbar",function(f){if(f.which!=13){return}var d=b(f.target),c=d.closest("ab-sub-wrapper");f.stopPropagation();f.preventDefault();if(!c.length){c=b("#wpadminbar .quicklinks")}c.find(".menupop").removeClass("hover");d.parent().toggleClass("hover");d.siblings(".ab-sub-wrapper").find(".ab-item").each(a)}).each(a);b("#wpadminbar .ab-item").bind("keydown.adminbar",function(d){if(d.which!=27){return}var c=b(d.target);d.stopPropagation();d.preventDefault();c.closest(".hover").removeClass("hover").children(".ab-item").focus();c.siblings(".ab-sub-wrapper").find(".ab-item").each(a)})})}else{(function(i,k){var c=function(n,m,d){if(n.addEventListener){n.addEventListener(m,d,false)}else{if(n.attachEvent){n.attachEvent("on"+m,function(){return d.call(n,window.event)})}}},e,f=new RegExp("\\bhover\\b","g"),a=[],j=new RegExp("\\bselected\\b","g"),g=function(m){var d=a.length;while(d--){if(a[d]&&m==a[d][1]){return a[d][0]}}return false},h=function(s){var n,d,q,m,p,r,u=[],o=0;while(s&&s!=e&&s!=i){if("LI"==s.nodeName.toUpperCase()){u[u.length]=s;d=g(s);if(d){clearTimeout(d)}s.className=s.className?(s.className.replace(f,"")+" hover"):"hover";m=s}s=s.parentNode}if(m&&m.parentNode){p=m.parentNode;if(p&&"UL"==p.nodeName.toUpperCase()){n=p.childNodes.length;while(n--){r=p.childNodes[n];if(r!=m){r.className=r.className?r.className.replace(j,""):""}}}}n=a.length;while(n--){q=false;o=u.length;while(o--){if(u[o]==a[n][1]){q=true}}if(!q){a[n][1].className=a[n][1].className?a[n][1].className.replace(f,""):""}}},l=function(d){while(d&&d!=e&&d!=i){if("LI"==d.nodeName.toUpperCase()){(function(m){var n=setTimeout(function(){m.className=m.className?m.className.replace(f,""):""},500);a[a.length]=[n,m]})(d)}d=d.parentNode}},b=function(p){var n,d,o,m=p.target||p.srcElement;while(true){if(!m||m==i||m==e){return}if(m.id&&m.id=="wp-admin-bar-get-shortlink"){break}m=m.parentNode}if(p.preventDefault){p.preventDefault()}p.returnValue=false;if(-1==m.className.indexOf("selected")){m.className+=" selected"}for(n=0,d=m.childNodes.length;n<d;n++){o=m.childNodes[n];if(o.className&&-1!=o.className.indexOf("shortlink-input")){o.focus();o.select();o.onblur=function(){m.className=m.className?m.className.replace(j,""):""};break}}return false};c(k,"load",function(){e=i.getElementById("wpadminbar");if(i.body&&e){i.body.appendChild(e);if(e.className){e.className=e.className.replace(/nojs/,"")}c(e,"mouseover",function(d){h(d.target||d.srcElement)});c(e,"mouseout",function(d){l(d.target||d.srcElement)});c(e,"click",b)}if(k.location.hash){k.scrollBy(0,-32)}})})(document,window)};
(function(a){a.fn.hoverIntent=function(l,j){var m={sensitivity:7,interval:100,timeout:0};m=a.extend(m,j?{over:l,out:j}:l);var o,n,h,d;var e=function(f){o=f.pageX;n=f.pageY};var c=function(g,f){f.hoverIntent_t=clearTimeout(f.hoverIntent_t);if((Math.abs(h-o)+Math.abs(d-n))<m.sensitivity){a(f).unbind("mousemove",e);f.hoverIntent_s=1;return m.over.apply(f,[g])}else{h=o;d=n;f.hoverIntent_t=setTimeout(function(){c(g,f)},m.interval)}};var i=function(g,f){f.hoverIntent_t=clearTimeout(f.hoverIntent_t);f.hoverIntent_s=0;return m.out.apply(f,[g])};var b=function(q){var f=this;var g=(q.type=="mouseover"?q.fromElement:q.toElement)||q.relatedTarget;while(g&&g!=this){try{g=g.parentNode}catch(q){g=this}}if(g==this){if(a.browser.mozilla){if(q.type=="mouseout"){f.mtout=setTimeout(function(){k(q,f)},30)}else{if(f.mtout){f.mtout=clearTimeout(f.mtout)}}}return}else{if(f.mtout){f.mtout=clearTimeout(f.mtout)}k(q,f)}};var k=function(p,f){var g=jQuery.extend({},p);if(f.hoverIntent_t){f.hoverIntent_t=clearTimeout(f.hoverIntent_t)}if(p.type=="mouseover"){h=g.pageX;d=g.pageY;a(f).bind("mousemove",e);if(f.hoverIntent_s!=1){f.hoverIntent_t=setTimeout(function(){c(g,f)},m.interval)}}else{a(f).unbind("mousemove",e);if(f.hoverIntent_s==1){f.hoverIntent_t=setTimeout(function(){i(g,f)},m.timeout)}}};return this.mouseover(b).mouseout(b)}})(jQuery);
var showNotice,adminMenu,columns,validateForm,screenMeta,autofold_menu;(function(a){adminMenu={init:function(){},fold:function(){},restoreMenuState:function(){},toggle:function(){},favorites:function(){}};columns={init:function(){var b=this;a(".hide-column-tog","#adv-settings").click(function(){var d=a(this),c=d.val();if(d.prop("checked")){b.checked(c)}else{b.unchecked(c)}columns.saveManageColumnsState()})},saveManageColumnsState:function(){var b=this.hidden();a.post(ajaxurl,{action:"hidden-columns",hidden:b,screenoptionnonce:a("#screenoptionnonce").val(),page:pagenow})},checked:function(b){a(".column-"+b).show();this.colSpanChange(+1)},unchecked:function(b){a(".column-"+b).hide();this.colSpanChange(-1)},hidden:function(){return a(".manage-column").filter(":hidden").map(function(){return this.id}).get().join(",")},useCheckboxesForHidden:function(){this.hidden=function(){return a(".hide-column-tog").not(":checked").map(function(){var b=this.id;return b.substring(b,b.length-5)}).get().join(",")}},colSpanChange:function(b){var d=a("table").find(".colspanchange"),c;if(!d.length){return}c=parseInt(d.attr("colspan"),10)+b;d.attr("colspan",c.toString())}};a(document).ready(function(){columns.init()});validateForm=function(b){return !a(b).find(".form-required").filter(function(){return a("input:visible",this).val()==""}).addClass("form-invalid").find("input:visible").change(function(){a(this).closest(".form-invalid").removeClass("form-invalid")}).size()};showNotice={warn:function(){var b=commonL10n.warnDelete||"";if(confirm(b)){return true}return false},note:function(b){alert(b)}};screenMeta={element:null,toggles:null,page:null,init:function(){this.element=a("#screen-meta");this.toggles=a(".screen-meta-toggle a");this.page=a("#wpcontent");this.toggles.click(this.toggleEvent)},toggleEvent:function(c){var b=a(this.href.replace(/.+#/,"#"));c.preventDefault();if(!b.length){return}if(b.is(":visible")){screenMeta.close(b,a(this))}else{screenMeta.open(b,a(this))}},open:function(b,c){a(".screen-meta-toggle").not(c.parent()).css("visibility","hidden");b.parent().show();b.slideDown("fast",function(){c.addClass("screen-meta-active")})},close:function(b,c){b.slideUp("fast",function(){c.removeClass("screen-meta-active");a(".screen-meta-toggle").css("visibility","");b.parent().hide()})}};a(".contextual-help-tabs").delegate("a","click focus",function(d){var c=a(this),b;d.preventDefault();if(c.is(".active a")){return false}a(".contextual-help-tabs .active").removeClass("active");c.parent("li").addClass("active");b=a(c.attr("href"));a(".help-tab-content").not(b).removeClass("active").hide();b.addClass("active").show()});a(document).ready(function(){var j=false,c,e,k,i,b=a("#adminmenu"),d=a("input.current-page"),f=d.val(),h,g;g=function(l,n){var o=a(n),m=o.attr("tabindex");if(m){o.attr("tabindex","0").attr("tabindex",m)}};a("#collapse-menu",b).click(function(){var l=a(document.body);if(l.hasClass("folded")){l.removeClass("folded");setUserSetting("mfold","o")}else{l.addClass("folded");setUserSetting("mfold","f")}return false});a("li.wp-has-submenu",b).hoverIntent({over:function(t){var u,r,l,s,n=a(this).find(".wp-submenu"),v,p,q;if(!a(document.body).hasClass("folded")&&a(this).hasClass("wp-menu-open")){return}v=a(this).offset().top;p=a(window).scrollTop();q=v-p-30;u=v+n.height()+1;r=a("#wpwrap").height();l=60+u-r;s=a(window).height()+p-15;if(s<(u-l)){l=u-s}if(l>q){l=q}if(l>1){n.css({marginTop:"-"+l+"px"})}else{if(n.css("marginTop")){n.css({marginTop:""})}}n.addClass("sub-open")},out:function(){a(this).find(".wp-submenu").removeClass("sub-open")},timeout:200,sensitivity:7,interval:90});a("li.wp-has-submenu > a.wp-not-current-submenu",b).bind("keydown.adminmenu",function(m){if(m.which!=13){return}var l=a(m.target);m.stopPropagation();m.preventDefault();b.find(".wp-submenu").removeClass("sub-open");l.siblings(".wp-submenu").toggleClass("sub-open").find('a[role="menuitem"]').each(g)}).each(g);a('a[role="menuitem"]',b).bind("keydown.adminmenu",function(m){if(m.which!=27){return}var l=a(m.target);m.stopPropagation();m.preventDefault();l.add(l.siblings()).closest(".sub-open").removeClass("sub-open").siblings("a.wp-not-current-submenu").focus()});a("div.wrap h2:first").nextAll("div.updated, div.error").addClass("below-h2");a("div.updated, div.error").not(".below-h2, .inline").insertAfter(a("div.wrap h2:first"));screenMeta.init();a("tbody").children().children(".check-column").find(":checkbox").click(function(l){if("undefined"==l.shiftKey){return true}if(l.shiftKey){if(!j){return true}c=a(j).closest("form").find(":checkbox");e=c.index(j);k=c.index(this);i=a(this).prop("checked");if(0<e&&0<k&&e!=k){c.slice(e,k).prop("checked",function(){if(a(this).closest("tr").is(":visible")){return i}return false})}}j=this;return true});a("thead, tfoot").find(".check-column :checkbox").click(function(n){var o=a(this).prop("checked"),m="undefined"==typeof toggleWithKeyboard?false:toggleWithKeyboard,l=n.shiftKey||m;a(this).closest("table").children("tbody").filter(":visible").children().children(".check-column").find(":checkbox").prop("checked",function(){if(a(this).closest("tr").is(":hidden")){return false}if(l){return a(this).prop("checked")}else{if(o){return true}}return false});a(this).closest("table").children("thead,  tfoot").filter(":visible").children().children(".check-column").find(":checkbox").prop("checked",function(){if(l){return false}else{if(o){return true}}return false})});a("#default-password-nag-no").click(function(){setUserSetting("default_password_nag","hide");a("div.default-password-nag").hide();return false});a("#newcontent").bind("keydown.wpevent_InsertTab",function(q){if(q.keyCode!=9){return true}var n=q.target,s=n.selectionStart,m=n.selectionEnd,r=n.value,l,p;try{this.lastKey=9}catch(o){}if(document.selection){n.focus();p=document.selection.createRange();p.text="\t"}else{if(s>=0){l=this.scrollTop;n.value=r.substring(0,s).concat("\t",r.substring(m));n.selectionStart=n.selectionEnd=s+1;this.scrollTop=l}}if(q.stopPropagation){q.stopPropagation()}if(q.preventDefault){q.preventDefault()}});a("#newcontent").bind("blur.wpevent_InsertTab",function(l){if(this.lastKey&&9==this.lastKey){this.focus()}});if(d.length){d.closest("form").submit(function(l){if(a('select[name="action"]').val()==-1&&a('select[name="action2"]').val()==-1&&d.val()==f){d.val("1")}})}a(window).bind("resize.autofold",function(){if(getUserSetting("mfold")=="f"){return}var l=a(window).width();if(l<=800){if(!h){a(document.body).addClass("folded");h=true}}else{if(h){a(document.body).removeClass("folded");h=false}}}).triggerHandler("resize")});a(document).bind("wp_CloseOnEscape",function(c,b){if(typeof(b.cb)!="function"){return}if(typeof(b.condition)!="function"||b.condition()){b.cb()}return true})})(jQuery);
(function(d){d.each(["backgroundColor","borderBottomColor","borderLeftColor","borderRightColor","borderTopColor","color","outlineColor"],function(f,e){d.fx.step[e]=function(g){if(g.state==0){g.start=c(g.elem,e);g.end=b(g.end)}g.elem.style[e]="rgb("+[Math.max(Math.min(parseInt((g.pos*(g.end[0]-g.start[0]))+g.start[0]),255),0),Math.max(Math.min(parseInt((g.pos*(g.end[1]-g.start[1]))+g.start[1]),255),0),Math.max(Math.min(parseInt((g.pos*(g.end[2]-g.start[2]))+g.start[2]),255),0)].join(",")+")"}});function b(f){var e;if(f&&f.constructor==Array&&f.length==3){return f}if(e=/rgb\(\s*([0-9]{1,3})\s*,\s*([0-9]{1,3})\s*,\s*([0-9]{1,3})\s*\)/.exec(f)){return[parseInt(e[1]),parseInt(e[2]),parseInt(e[3])]}if(e=/rgb\(\s*([0-9]+(?:\.[0-9]+)?)\%\s*,\s*([0-9]+(?:\.[0-9]+)?)\%\s*,\s*([0-9]+(?:\.[0-9]+)?)\%\s*\)/.exec(f)){return[parseFloat(e[1])*2.55,parseFloat(e[2])*2.55,parseFloat(e[3])*2.55]}if(e=/#([a-fA-F0-9]{2})([a-fA-F0-9]{2})([a-fA-F0-9]{2})/.exec(f)){return[parseInt(e[1],16),parseInt(e[2],16),parseInt(e[3],16)]}if(e=/#([a-fA-F0-9])([a-fA-F0-9])([a-fA-F0-9])/.exec(f)){return[parseInt(e[1]+e[1],16),parseInt(e[2]+e[2],16),parseInt(e[3]+e[3],16)]}if(e=/rgba\(0, 0, 0, 0\)/.exec(f)){return a.transparent}return a[d.trim(f).toLowerCase()]}function c(g,e){var f;do{f=d.curCSS(g,e);if(f!=""&&f!="transparent"||d.nodeName(g,"body")){break}e="backgroundColor"}while(g=g.parentNode);return b(f)}var a={aqua:[0,255,255],azure:[240,255,255],beige:[245,245,220],black:[0,0,0],blue:[0,0,255],brown:[165,42,42],cyan:[0,255,255],darkblue:[0,0,139],darkcyan:[0,139,139],darkgrey:[169,169,169],darkgreen:[0,100,0],darkkhaki:[189,183,107],darkmagenta:[139,0,139],darkolivegreen:[85,107,47],darkorange:[255,140,0],darkorchid:[153,50,204],darkred:[139,0,0],darksalmon:[233,150,122],darkviolet:[148,0,211],fuchsia:[255,0,255],gold:[255,215,0],green:[0,128,0],indigo:[75,0,130],khaki:[240,230,140],lightblue:[173,216,230],lightcyan:[224,255,255],lightgreen:[144,238,144],lightgrey:[211,211,211],lightpink:[255,182,193],lightyellow:[255,255,224],lime:[0,255,0],magenta:[255,0,255],maroon:[128,0,0],navy:[0,0,128],olive:[128,128,0],orange:[255,165,0],pink:[255,192,203],purple:[128,0,128],violet:[128,0,128],red:[255,0,0],silver:[192,192,192],white:[255,255,255],yellow:[255,255,0],transparent:[255,255,255]}})(jQuery);
/*
 * Thickbox 3.1 - One Box To Rule Them All.
 * By Cody Lindley (http://www.codylindley.com)
 * Copyright (c) 2007 cody lindley
 * Licensed under the MIT License: http://www.opensource.org/licenses/mit-license.php
*/

if ( typeof tb_pathToImage != 'string' ) {
	var tb_pathToImage = thickboxL10n.loadingAnimation;
}
if ( typeof tb_closeImage != 'string' ) {
	var tb_closeImage = thickboxL10n.closeImage;
}

/*!!!!!!!!!!!!!!!!! edit below this line at your own risk !!!!!!!!!!!!!!!!!!!!!!!*/

//on page load call tb_init
jQuery(document).ready(function(){
	tb_init('a.thickbox, area.thickbox, input.thickbox');//pass where to apply thickbox
	imgLoader = new Image();// preload image
	imgLoader.src = tb_pathToImage;
});

//add thickbox to href & area elements that have a class of .thickbox
function tb_init(domChunk){
	jQuery(domChunk).live('click', tb_click);
}

function tb_click(){
	var t = this.title || this.name || null;
	var a = this.href || this.alt;
	var g = this.rel || false;
	tb_show(t,a,g);
	this.blur();
	return false;
}

function tb_show(caption, url, imageGroup) {//function called when the user clicks on a thickbox link

	try {
		if (typeof document.body.style.maxHeight === "undefined") {//if IE 6
			jQuery("body","html").css({height: "100%", width: "100%"});
			jQuery("html").css("overflow","hidden");
			if (document.getElementById("TB_HideSelect") === null) {//iframe to hide select elements in ie6
				jQuery("body").append("<iframe id='TB_HideSelect'>"+thickboxL10n.noiframes+"</iframe><div id='TB_overlay'></div><div id='TB_window'></div>");
				jQuery("#TB_overlay").click(tb_remove);
			}
		}else{//all others
			if(document.getElementById("TB_overlay") === null){
				jQuery("body").append("<div id='TB_overlay'></div><div id='TB_window'></div>");
				jQuery("#TB_overlay").click(tb_remove);
			}
		}

		if(tb_detectMacXFF()){
			jQuery("#TB_overlay").addClass("TB_overlayMacFFBGHack");//use png overlay so hide flash
		}else{
			jQuery("#TB_overlay").addClass("TB_overlayBG");//use background and opacity
		}

		if(caption===null){caption="";}
		jQuery("body").append("<div id='TB_load'><img src='"+imgLoader.src+"' /></div>");//add loader to the page
		jQuery('#TB_load').show();//show loader

		var baseURL;
	   if(url.indexOf("?")!==-1){ //ff there is a query string involved
			baseURL = url.substr(0, url.indexOf("?"));
	   }else{
	   		baseURL = url;
	   }

	   var urlString = /\.jpg$|\.jpeg$|\.png$|\.gif$|\.bmp$/;
	   var urlType = baseURL.toLowerCase().match(urlString);

		if(urlType == '.jpg' || urlType == '.jpeg' || urlType == '.png' || urlType == '.gif' || urlType == '.bmp'){//code to show images

			TB_PrevCaption = "";
			TB_PrevURL = "";
			TB_PrevHTML = "";
			TB_NextCaption = "";
			TB_NextURL = "";
			TB_NextHTML = "";
			TB_imageCount = "";
			TB_FoundURL = false;
			if(imageGroup){
				TB_TempArray = jQuery("a[rel="+imageGroup+"]").get();
				for (TB_Counter = 0; ((TB_Counter < TB_TempArray.length) && (TB_NextHTML === "")); TB_Counter++) {
					var urlTypeTemp = TB_TempArray[TB_Counter].href.toLowerCase().match(urlString);
						if (!(TB_TempArray[TB_Counter].href == url)) {
							if (TB_FoundURL) {
								TB_NextCaption = TB_TempArray[TB_Counter].title;
								TB_NextURL = TB_TempArray[TB_Counter].href;
								TB_NextHTML = "<span id='TB_next'>&nbsp;&nbsp;<a href='#'>"+thickboxL10n.next+"</a></span>";
							} else {
								TB_PrevCaption = TB_TempArray[TB_Counter].title;
								TB_PrevURL = TB_TempArray[TB_Counter].href;
								TB_PrevHTML = "<span id='TB_prev'>&nbsp;&nbsp;<a href='#'>"+thickboxL10n.prev+"</a></span>";
							}
						} else {
							TB_FoundURL = true;
							TB_imageCount = thickboxL10n.image + ' ' + (TB_Counter + 1) + ' ' + thickboxL10n.of + ' ' + (TB_TempArray.length);
						}
				}
			}

			imgPreloader = new Image();
			imgPreloader.onload = function(){
			imgPreloader.onload = null;

			// Resizing large images - orginal by Christian Montoya edited by me.
			var pagesize = tb_getPageSize();
			var x = pagesize[0] - 150;
			var y = pagesize[1] - 150;
			var imageWidth = imgPreloader.width;
			var imageHeight = imgPreloader.height;
			if (imageWidth > x) {
				imageHeight = imageHeight * (x / imageWidth);
				imageWidth = x;
				if (imageHeight > y) {
					imageWidth = imageWidth * (y / imageHeight);
					imageHeight = y;
				}
			} else if (imageHeight > y) {
				imageWidth = imageWidth * (y / imageHeight);
				imageHeight = y;
				if (imageWidth > x) {
					imageHeight = imageHeight * (x / imageWidth);
					imageWidth = x;
				}
			}
			// End Resizing

			TB_WIDTH = imageWidth + 30;
			TB_HEIGHT = imageHeight + 60;
			jQuery("#TB_window").append("<a href='' id='TB_ImageOff' title='"+thickboxL10n.close+"'><img id='TB_Image' src='"+url+"' width='"+imageWidth+"' height='"+imageHeight+"' alt='"+caption+"'/></a>" + "<div id='TB_caption'>"+caption+"<div id='TB_secondLine'>" + TB_imageCount + TB_PrevHTML + TB_NextHTML + "</div></div><div id='TB_closeWindow'><a href='#' id='TB_closeWindowButton' title='"+thickboxL10n.close+"'><img src='" + tb_closeImage + "' /></a></div>");

			jQuery("#TB_closeWindowButton").click(tb_remove);

			if (!(TB_PrevHTML === "")) {
				function goPrev(){
					if(jQuery(document).unbind("click",goPrev)){jQuery(document).unbind("click",goPrev);}
					jQuery("#TB_window").remove();
					jQuery("body").append("<div id='TB_window'></div>");
					tb_show(TB_PrevCaption, TB_PrevURL, imageGroup);
					return false;
				}
				jQuery("#TB_prev").click(goPrev);
			}

			if (!(TB_NextHTML === "")) {
				function goNext(){
					jQuery("#TB_window").remove();
					jQuery("body").append("<div id='TB_window'></div>");
					tb_show(TB_NextCaption, TB_NextURL, imageGroup);
					return false;
				}
				jQuery("#TB_next").click(goNext);

			}

			jQuery(document).bind('keydown.thickbox', function(e){
				e.stopImmediatePropagation();

				if ( e.which == 27 ){ // close
					if ( ! jQuery(document).triggerHandler( 'wp_CloseOnEscape', [{ event: e, what: 'thickbox', cb: tb_remove }] ) )
						tb_remove();

				} else if ( e.which == 190 ){ // display previous image
					if(!(TB_NextHTML == "")){
						jQuery(document).unbind('thickbox');
						goNext();
					}
				} else if ( e.which == 188 ){ // display next image
					if(!(TB_PrevHTML == "")){
						jQuery(document).unbind('thickbox');
						goPrev();
					}
				}
				return false;
			});

			tb_position();
			jQuery("#TB_load").remove();
			jQuery("#TB_ImageOff").click(tb_remove);
			jQuery("#TB_window").css({'visibility':'visible'}); //for safari using css instead of show
			};

			imgPreloader.src = url;
		}else{//code to show html

			var queryString = url.replace(/^[^\?]+\??/,'');
			var params = tb_parseQuery( queryString );

			TB_WIDTH = (params['width']*1) + 30 || 630; //defaults to 630 if no paramaters were added to URL
			TB_HEIGHT = (params['height']*1) + 40 || 440; //defaults to 440 if no paramaters were added to URL
			ajaxContentW = TB_WIDTH - 30;
			ajaxContentH = TB_HEIGHT - 45;

			if(url.indexOf('TB_iframe') != -1){// either iframe or ajax window
					urlNoQuery = url.split('TB_');
					jQuery("#TB_iframeContent").remove();
					if(params['modal'] != "true"){//iframe no modal
						jQuery("#TB_window").append("<div id='TB_title'><div id='TB_ajaxWindowTitle'>"+caption+"</div><div id='TB_closeAjaxWindow'><a href='#' id='TB_closeWindowButton' title='"+thickboxL10n.close+"'><img src='" + tb_closeImage + "' /></a></div></div><iframe frameborder='0' hspace='0' src='"+urlNoQuery[0]+"' id='TB_iframeContent' name='TB_iframeContent"+Math.round(Math.random()*1000)+"' onload='tb_showIframe()' style='width:"+(ajaxContentW + 29)+"px;height:"+(ajaxContentH + 17)+"px;' >"+thickboxL10n.noiframes+"</iframe>");
					}else{//iframe modal
					jQuery("#TB_overlay").unbind();
						jQuery("#TB_window").append("<iframe frameborder='0' hspace='0' src='"+urlNoQuery[0]+"' id='TB_iframeContent' name='TB_iframeContent"+Math.round(Math.random()*1000)+"' onload='tb_showIframe()' style='width:"+(ajaxContentW + 29)+"px;height:"+(ajaxContentH + 17)+"px;'>"+thickboxL10n.noiframes+"</iframe>");
					}
			}else{// not an iframe, ajax
					if(jQuery("#TB_window").css("visibility") != "visible"){
						if(params['modal'] != "true"){//ajax no modal
						jQuery("#TB_window").append("<div id='TB_title'><div id='TB_ajaxWindowTitle'>"+caption+"</div><div id='TB_closeAjaxWindow'><a href='#' id='TB_closeWindowButton'><img src='" + tb_closeImage + "' /></a></div></div><div id='TB_ajaxContent' style='width:"+ajaxContentW+"px;height:"+ajaxContentH+"px'></div>");
						}else{//ajax modal
						jQuery("#TB_overlay").unbind();
						jQuery("#TB_window").append("<div id='TB_ajaxContent' class='TB_modal' style='width:"+ajaxContentW+"px;height:"+ajaxContentH+"px;'></div>");
						}
					}else{//this means the window is already up, we are just loading new content via ajax
						jQuery("#TB_ajaxContent")[0].style.width = ajaxContentW +"px";
						jQuery("#TB_ajaxContent")[0].style.height = ajaxContentH +"px";
						jQuery("#TB_ajaxContent")[0].scrollTop = 0;
						jQuery("#TB_ajaxWindowTitle").html(caption);
					}
			}

			jQuery("#TB_closeWindowButton").click(tb_remove);

				if(url.indexOf('TB_inline') != -1){
					jQuery("#TB_ajaxContent").append(jQuery('#' + params['inlineId']).children());
					jQuery("#TB_window").bind('tb_unload', function () {
						jQuery('#' + params['inlineId']).append( jQuery("#TB_ajaxContent").children() ); // move elements back when you're finished
					});
					tb_position();
					jQuery("#TB_load").remove();
					jQuery("#TB_window").css({'visibility':'visible'});
				}else if(url.indexOf('TB_iframe') != -1){
					tb_position();
					if(jQuery.browser.safari){//safari needs help because it will not fire iframe onload
						jQuery("#TB_load").remove();
						jQuery("#TB_window").css({'visibility':'visible'});
					}
				}else{
					jQuery("#TB_ajaxContent").load(url += "&random=" + (new Date().getTime()),function(){//to do a post change this load method
						tb_position();
						jQuery("#TB_load").remove();
						tb_init("#TB_ajaxContent a.thickbox");
						jQuery("#TB_window").css({'visibility':'visible'});
					});
				}

		}

		if(!params['modal']){
			jQuery(document).bind('keyup.thickbox', function(e){

				if ( e.which == 27 ){ // close
					e.stopImmediatePropagation();
					if ( ! jQuery(document).triggerHandler( 'wp_CloseOnEscape', [{ event: e, what: 'thickbox', cb: tb_remove }] ) )
						tb_remove();

					return false;
				}
			});
		}

	} catch(e) {
		//nothing here
	}
}

//helper functions below
function tb_showIframe(){
	jQuery("#TB_load").remove();
	jQuery("#TB_window").css({'visibility':'visible'});
}

function tb_remove() {
 	jQuery("#TB_imageOff").unbind("click");
	jQuery("#TB_closeWindowButton").unbind("click");
	jQuery("#TB_window").fadeOut("fast",function(){jQuery('#TB_window,#TB_overlay,#TB_HideSelect').trigger("tb_unload").unbind().remove();});
	jQuery("#TB_load").remove();
	if (typeof document.body.style.maxHeight == "undefined") {//if IE 6
		jQuery("body","html").css({height: "auto", width: "auto"});
		jQuery("html").css("overflow","");
	}
	jQuery(document).unbind('.thickbox');
	return false;
}

function tb_position() {
var isIE6 = typeof document.body.style.maxHeight === "undefined";
jQuery("#TB_window").css({marginLeft: '-' + parseInt((TB_WIDTH / 2),10) + 'px', width: TB_WIDTH + 'px'});
	if ( ! isIE6 ) { // take away IE6
		jQuery("#TB_window").css({marginTop: '-' + parseInt((TB_HEIGHT / 2),10) + 'px'});
	}
}

function tb_parseQuery ( query ) {
   var Params = {};
   if ( ! query ) {return Params;}// return empty object
   var Pairs = query.split(/[;&]/);
   for ( var i = 0; i < Pairs.length; i++ ) {
      var KeyVal = Pairs[i].split('=');
      if ( ! KeyVal || KeyVal.length != 2 ) {continue;}
      var key = unescape( KeyVal[0] );
      var val = unescape( KeyVal[1] );
      val = val.replace(/\+/g, ' ');
      Params[key] = val;
   }
   return Params;
}

function tb_getPageSize(){
	var de = document.documentElement;
	var w = window.innerWidth || self.innerWidth || (de&&de.clientWidth) || document.body.clientWidth;
	var h = window.innerHeight || self.innerHeight || (de&&de.clientHeight) || document.body.clientHeight;
	arrayPageSize = [w,h];
	return arrayPageSize;
}

function tb_detectMacXFF() {
  var userAgent = navigator.userAgent.toLowerCase();
  if (userAgent.indexOf('mac') != -1 && userAgent.indexOf('firefox')!=-1) {
    return true;
  }
}

var thickDims,tbWidth,tbHeight;jQuery(document).ready(function(a){thickDims=function(){var f=a("#TB_window"),d=a(window).height(),b=a(window).width(),c,e;c=(tbWidth&&tbWidth<b-90)?tbWidth:b-90;e=(tbHeight&&tbHeight<d-60)?tbHeight:d-60;if(f.size()){f.width(c).height(e);a("#TB_iframeContent").width(c).height(e-27);f.css({"margin-left":"-"+parseInt((c/2),10)+"px"});if(typeof document.body.style.maxWidth!="undefined"){f.css({top:"30px","margin-top":"0"})}}};thickDims();a(window).resize(function(){thickDims()});a("a.thickbox-preview").click(function(){tb_click.call(this);var d=a(this).parents(".available-theme").find(".activatelink"),e="",b=a(this).attr("href"),c,f;if(tbWidth=b.match(/&tbWidth=[0-9]+/)){tbWidth=parseInt(tbWidth[0].replace(/[^0-9]+/g,""),10)}else{tbWidth=a(window).width()-90}if(tbHeight=b.match(/&tbHeight=[0-9]+/)){tbHeight=parseInt(tbHeight[0].replace(/[^0-9]+/g,""),10)}else{tbHeight=a(window).height()-60}if(d.length){c=d.attr("href")||"";f=d.attr("title")||"";e='&nbsp; <a href="'+c+'" target="_top" class="tb-theme-preview-link">'+f+"</a>"}else{f=a(this).attr("title")||"";e='&nbsp; <span class="tb-theme-preview-link">'+f+"</span>"}a("#TB_title").css({"background-color":"#222",color:"#dfdfdf"});a("#TB_closeAjaxWindow").css({"float":"left"});a("#TB_ajaxWindowTitle").css({"float":"right"}).html(e);a("#TB_iframeContent").width("100%");thickDims();return false});a(".theme-detail").click(function(){a(this).siblings(".themedetaildiv").toggle();return false})});
var ThemeViewer;(function(a){ThemeViewer=function(b){function d(){a("#filter-click, #mini-filter-click").unbind("click").click(function(){a("#filter-click").toggleClass("current");a("#filter-box").slideToggle();a("#current-theme").slideToggle(300);return false});a("#filter-box :checkbox").unbind("click").click(function(){var e=a("#filter-box :checked").length,f=a("#filter-click").text();if(f.indexOf("(")!=-1){f=f.substr(0,f.indexOf("("))}if(e==0){a("#filter-click").text(f)}else{a("#filter-click").text(f+" ("+e+")")}})}var c={init:d};return c}})(jQuery);jQuery(document).ready(function(a){theme_viewer=new ThemeViewer();theme_viewer.init()});
