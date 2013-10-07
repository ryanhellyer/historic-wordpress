if(typeof(jQuery)!="undefined"){if(typeof(jQuery.fn.hoverIntent)=="undefined"){(function(b){b.fn.hoverIntent=function(p,r){var g={sensitivity:7,interval:100,timeout:0};g=b.extend(g,r?{over:p,out:r}:p);var a,f,t,v;var u=function(c){a=c.pageX;f=c.pageY};var w=function(c,d){d.hoverIntent_t=clearTimeout(d.hoverIntent_t);if((Math.abs(t-a)+Math.abs(v-f))<g.sensitivity){b(d).unbind("mousemove",u);d.hoverIntent_s=1;return g.over.apply(d,[c])}else{t=a;v=f;d.hoverIntent_t=setTimeout(function(){w(c,d)},g.interval)}};var s=function(c,d){d.hoverIntent_t=clearTimeout(d.hoverIntent_t);d.hoverIntent_s=0;return g.out.apply(d,[c])};var x=function(e){var d=this;var c=(e.type=="mouseover"?e.fromElement:e.toElement)||e.relatedTarget;while(c&&c!=this){try{c=c.parentNode}catch(e){c=this}}if(c==this){if(b.browser.mozilla){if(e.type=="mouseout"){d.mtout=setTimeout(function(){q(e,d)},30)}else{if(d.mtout){d.mtout=clearTimeout(d.mtout)}}}return}else{if(d.mtout){d.mtout=clearTimeout(d.mtout)}q(e,d)}};var q=function(e,d){var c=jQuery.extend({},e);if(d.hoverIntent_t){d.hoverIntent_t=clearTimeout(d.hoverIntent_t)}if(e.type=="mouseover"){t=c.pageX;v=c.pageY;b(d).bind("mousemove",u);if(d.hoverIntent_s!=1){d.hoverIntent_t=setTimeout(function(){w(c,d)},g.interval)}}else{b(d).unbind("mousemove",u);if(d.hoverIntent_s==1){d.hoverIntent_t=setTimeout(function(){s(c,d)},g.timeout)}}};return this.mouseover(x).mouseout(x)}})(jQuery)}jQuery(document).ready(function(e){var d=e("#wpadminbar"),c,a,b,f=false;c=function(g,j){var k=e(j),h=k.attr("tabindex");if(h){k.attr("tabindex","0").attr("tabindex",h)}};a=function(g){d.find("li.menupop").on("click.wp-mobile-hover",function(i){var h=e(this);if(!h.hasClass("hover")){i.preventDefault();d.find("li.menupop.hover").removeClass("hover");h.addClass("hover")}if(g){e("li.menupop").off("click.wp-mobile-hover");f=false}})};b=function(){var g=/Mobile\/.+Safari/.test(navigator.userAgent)?"touchstart":"click";e(document.body).on(g+".wp-mobile-hover",function(h){if(!e(h.target).closest("#wpadminbar").length){d.find("li.menupop.hover").removeClass("hover")}})};d.removeClass("nojq").removeClass("nojs");if("ontouchstart" in window){d.on("touchstart",function(){a(true);f=true});b()}else{if(/IEMobile\/[1-9]/.test(navigator.userAgent)){a();b()}}d.find("li.menupop").hoverIntent({over:function(g){if(f){return}e(this).addClass("hover")},out:function(g){if(f){return}e(this).removeClass("hover")},timeout:180,sensitivity:7,interval:100});if(window.location.hash){window.scrollBy(0,-32)}e("#wp-admin-bar-get-shortlink").click(function(g){g.preventDefault();e(this).addClass("selected").children(".shortlink-input").blur(function(){e(this).parents("#wp-admin-bar-get-shortlink").removeClass("selected")}).focus().select()});e("#wpadminbar li.menupop > .ab-item").bind("keydown.adminbar",function(i){if(i.which!=13){return}var h=e(i.target),g=h.closest("ab-sub-wrapper");i.stopPropagation();i.preventDefault();if(!g.length){g=e("#wpadminbar .quicklinks")}g.find(".menupop").removeClass("hover");h.parent().toggleClass("hover");h.siblings(".ab-sub-wrapper").find(".ab-item").each(c)}).each(c);e("#wpadminbar .ab-item").bind("keydown.adminbar",function(h){if(h.which!=27){return}var g=e(h.target);h.stopPropagation();h.preventDefault();g.closest(".hover").removeClass("hover").children(".ab-item").focus();g.siblings(".ab-sub-wrapper").find(".ab-item").each(c)});e("#wpadminbar").click(function(g){if(g.target.id!="wpadminbar"&&g.target.id!="wp-admin-bar-top-secondary"){return}g.preventDefault();e("html, body").animate({scrollTop:0},"fast")});e(".screen-reader-shortcut").keydown(function(g){if(13!=g.which){return}var h=e(this).attr("href");if(e.browser.webkit&&h&&h.charAt(0)=="#"){setTimeout(function(){e(h).focus()},100)}})})}else{(function(j,l){var e=function(o,n,d){if(o.addEventListener){o.addEventListener(n,d,false)}else{if(o.attachEvent){o.attachEvent("on"+n,function(){return d.call(o,window.event)})}}},f,g=new RegExp("\\bhover\\b","g"),b=[],k=new RegExp("\\bselected\\b","g"),h=function(n){var d=b.length;while(d--){if(b[d]&&n==b[d][1]){return b[d][0]}}return false},i=function(u){var o,d,r,n,q,s,v=[],p=0;while(u&&u!=f&&u!=j){if("LI"==u.nodeName.toUpperCase()){v[v.length]=u;d=h(u);if(d){clearTimeout(d)}u.className=u.className?(u.className.replace(g,"")+" hover"):"hover";n=u}u=u.parentNode}if(n&&n.parentNode){q=n.parentNode;if(q&&"UL"==q.nodeName.toUpperCase()){o=q.childNodes.length;while(o--){s=q.childNodes[o];if(s!=n){s.className=s.className?s.className.replace(k,""):""}}}}o=b.length;while(o--){r=false;p=v.length;while(p--){if(v[p]==b[o][1]){r=true}}if(!r){b[o][1].className=b[o][1].className?b[o][1].className.replace(g,""):""}}},m=function(d){while(d&&d!=f&&d!=j){if("LI"==d.nodeName.toUpperCase()){(function(n){var o=setTimeout(function(){n.className=n.className?n.className.replace(g,""):""},500);b[b.length]=[o,n]})(d)}d=d.parentNode}},c=function(q){var o,d,p,n=q.target||q.srcElement;while(true){if(!n||n==j||n==f){return}if(n.id&&n.id=="wp-admin-bar-get-shortlink"){break}n=n.parentNode}if(q.preventDefault){q.preventDefault()}q.returnValue=false;if(-1==n.className.indexOf("selected")){n.className+=" selected"}for(o=0,d=n.childNodes.length;o<d;o++){p=n.childNodes[o];if(p.className&&-1!=p.className.indexOf("shortlink-input")){p.focus();p.select();p.onblur=function(){n.className=n.className?n.className.replace(k,""):""};break}}return false},a=function(n){var s,q,p,d,r,o;if(n.id!="wpadminbar"&&n.id!="wp-admin-bar-top-secondary"){return}s=window.pageYOffset||document.documentElement.scrollTop||document.body.scrollTop||0;if(s<1){return}o=s>800?130:100;q=Math.min(12,Math.round(s/o));p=s>800?Math.round(s/30):Math.round(s/20);d=[];r=0;while(s){s-=p;if(s<0){s=0}d.push(s);setTimeout(function(){window.scrollTo(0,d.shift())},r*q);r++}};e(l,"load",function(){f=j.getElementById("wpadminbar");if(j.body&&f){j.body.appendChild(f);if(f.className){f.className=f.className.replace(/nojs/,"")}e(f,"mouseover",function(d){i(d.target||d.srcElement)});e(f,"mouseout",function(d){m(d.target||d.srcElement)});e(f,"click",c);e(f,"click",function(d){a(d.target||d.srcElement)})}if(l.location.hash){l.scrollBy(0,-32)}})})(document,window)};
(function(a){a.fn.hoverIntent=function(k,j){var l={sensitivity:7,interval:100,timeout:0};l=a.extend(l,j?{over:k,out:j}:k);var n,m,h,d;var e=function(f){n=f.pageX;m=f.pageY};var c=function(g,f){f.hoverIntent_t=clearTimeout(f.hoverIntent_t);if((Math.abs(h-n)+Math.abs(d-m))<l.sensitivity){a(f).unbind("mousemove",e);f.hoverIntent_s=1;return l.over.apply(f,[g])}else{h=n;d=m;f.hoverIntent_t=setTimeout(function(){c(g,f)},l.interval)}};var i=function(g,f){f.hoverIntent_t=clearTimeout(f.hoverIntent_t);f.hoverIntent_s=0;return l.out.apply(f,[g])};var b=function(o){var g=jQuery.extend({},o);var f=this;if(f.hoverIntent_t){f.hoverIntent_t=clearTimeout(f.hoverIntent_t)}if(o.type=="mouseenter"){h=g.pageX;d=g.pageY;a(f).bind("mousemove",e);if(f.hoverIntent_s!=1){f.hoverIntent_t=setTimeout(function(){c(g,f)},l.interval)}}else{a(f).unbind("mousemove",e);if(f.hoverIntent_s==1){f.hoverIntent_t=setTimeout(function(){i(g,f)},l.timeout)}}};return this.bind("mouseenter",b).bind("mouseleave",b)}})(jQuery);
var showNotice,adminMenu,columns,validateForm,screenMeta;(function(a){adminMenu={init:function(){},fold:function(){},restoreMenuState:function(){},toggle:function(){},favorites:function(){}};columns={init:function(){var b=this;a(".hide-column-tog","#adv-settings").click(function(){var d=a(this),c=d.val();if(d.prop("checked")){b.checked(c)}else{b.unchecked(c)}columns.saveManageColumnsState()})},saveManageColumnsState:function(){var b=this.hidden();a.post(ajaxurl,{action:"hidden-columns",hidden:b,screenoptionnonce:a("#screenoptionnonce").val(),page:pagenow})},checked:function(b){a(".column-"+b).show();this.colSpanChange(+1)},unchecked:function(b){a(".column-"+b).hide();this.colSpanChange(-1)},hidden:function(){return a(".manage-column").filter(":hidden").map(function(){return this.id}).get().join(",")},useCheckboxesForHidden:function(){this.hidden=function(){return a(".hide-column-tog").not(":checked").map(function(){var b=this.id;return b.substring(b,b.length-5)}).get().join(",")}},colSpanChange:function(b){var d=a("table").find(".colspanchange"),c;if(!d.length){return}c=parseInt(d.attr("colspan"),10)+b;d.attr("colspan",c.toString())}};a(document).ready(function(){columns.init()});validateForm=function(b){return !a(b).find(".form-required").filter(function(){return a("input:visible",this).val()==""}).addClass("form-invalid").find("input:visible").change(function(){a(this).closest(".form-invalid").removeClass("form-invalid")}).size()};showNotice={warn:function(){var b=commonL10n.warnDelete||"";if(confirm(b)){return true}return false},note:function(b){alert(b)}};screenMeta={element:null,toggles:null,page:null,init:function(){this.element=a("#screen-meta");this.toggles=a(".screen-meta-toggle a");this.page=a("#wpcontent");this.toggles.click(this.toggleEvent)},toggleEvent:function(c){var b=a(this.href.replace(/.+#/,"#"));c.preventDefault();if(!b.length){return}if(b.is(":visible")){screenMeta.close(b,a(this))}else{screenMeta.open(b,a(this))}},open:function(b,c){a(".screen-meta-toggle").not(c.parent()).css("visibility","hidden");b.parent().show();b.slideDown("fast",function(){b.focus();c.addClass("screen-meta-active").attr("aria-expanded",true)})},close:function(b,c){b.slideUp("fast",function(){c.removeClass("screen-meta-active").attr("aria-expanded",false);a(".screen-meta-toggle").css("visibility","");b.parent().hide()})}};a(".contextual-help-tabs").delegate("a","click focus",function(d){var c=a(this),b;d.preventDefault();if(c.is(".active a")){return false}a(".contextual-help-tabs .active").removeClass("active");c.parent("li").addClass("active");b=a(c.attr("href"));a(".help-tab-content").not(b).removeClass("active").hide();b.addClass("active").show()});a(document).ready(function(){var i=false,d,f,j,h,c=a("#adminmenu"),b,e=a("input.current-page"),g=e.val();c.on("click.wp-submenu-head",".wp-submenu-head",function(k){a(k.target).parent().siblings("a").get(0).click()});a("#collapse-menu").on("click.collapse-menu",function(l){var k=a(document.body);a("#adminmenu div.wp-submenu").css("margin-top","");if(a(window).width()<900){if(k.hasClass("auto-fold")){k.removeClass("auto-fold");setUserSetting("unfold",1);k.removeClass("folded");deleteUserSetting("mfold")}else{k.addClass("auto-fold");deleteUserSetting("unfold")}}else{if(k.hasClass("folded")){k.removeClass("folded");deleteUserSetting("mfold")}else{k.addClass("folded");setUserSetting("mfold","f")}}});if("ontouchstart" in window||/IEMobile\/[1-9]/.test(navigator.userAgent)){b=/Mobile\/.+Safari/.test(navigator.userAgent)?"touchstart":"click";a(document.body).on(b+".wp-mobile-hover",function(k){if(!a(k.target).closest("#adminmenu").length){c.find("li.wp-has-submenu.opensub").removeClass("opensub")}});c.find("a.wp-has-submenu").on(b+".wp-mobile-hover",function(m){var l=a(this),k=l.parent();if(!k.hasClass("opensub")&&(!k.hasClass("wp-menu-open")||k.width()<40)){m.preventDefault();c.find("li.opensub").removeClass("opensub");k.addClass("opensub")}})}c.find("li.wp-has-submenu").hoverIntent({over:function(s){var u,q,k,r,l=a(this).find(".wp-submenu"),v,n,p,t=parseInt(l.css("top"),10);if(isNaN(t)||t>-5){return}v=a(this).offset().top;n=a(window).scrollTop();p=v-n-30;u=v+l.height()+1;q=a("#wpwrap").height();k=60+u-q;r=a(window).height()+n-15;if(r<(u-k)){k=u-r}if(k>p){k=p}if(k>1){l.css("margin-top","-"+k+"px")}else{l.css("margin-top","")}c.find("li.menu-top").removeClass("opensub");a(this).addClass("opensub")},out:function(){a(this).removeClass("opensub").find(".wp-submenu").css("margin-top","")},timeout:200,sensitivity:7,interval:90});c.on("focus.adminmenu",".wp-submenu a",function(k){a(k.target).closest("li.menu-top").addClass("opensub")}).on("blur.adminmenu",".wp-submenu a",function(k){a(k.target).closest("li.menu-top").removeClass("opensub")});a("div.wrap h2:first").nextAll("div.updated, div.error").addClass("below-h2");a("div.updated, div.error").not(".below-h2, .inline").insertAfter(a("div.wrap h2:first"));screenMeta.init();a("tbody").children().children(".check-column").find(":checkbox").click(function(l){if("undefined"==l.shiftKey){return true}if(l.shiftKey){if(!i){return true}d=a(i).closest("form").find(":checkbox");f=d.index(i);j=d.index(this);h=a(this).prop("checked");if(0<f&&0<j&&f!=j){d.slice(f,j).prop("checked",function(){if(a(this).closest("tr").is(":visible")){return h}return false})}}i=this;var k=a(this).closest("tbody").find(":checkbox").filter(":visible").not(":checked");a(this).closest("table").children("thead, tfoot").find(":checkbox").prop("checked",function(){return(0==k.length)});return true});a("thead, tfoot").find(".check-column :checkbox").click(function(m){var n=a(this).prop("checked"),l="undefined"==typeof toggleWithKeyboard?false:toggleWithKeyboard,k=m.shiftKey||l;a(this).closest("table").children("tbody").filter(":visible").children().children(".check-column").find(":checkbox").prop("checked",function(){if(a(this).closest("tr").is(":hidden")){return false}if(k){return a(this).prop("checked")}else{if(n){return true}}return false});a(this).closest("table").children("thead,  tfoot").filter(":visible").children().children(".check-column").find(":checkbox").prop("checked",function(){if(k){return false}else{if(n){return true}}return false})});a("#default-password-nag-no").click(function(){setUserSetting("default_password_nag","hide");a("div.default-password-nag").hide();return false});a("#newcontent").bind("keydown.wpevent_InsertTab",function(p){var m=p.target,r,l,q,k,o;if(p.keyCode==27){a(m).data("tab-out",true);return}if(p.keyCode!=9||p.ctrlKey||p.altKey||p.shiftKey){return}if(a(m).data("tab-out")){a(m).data("tab-out",false);return}r=m.selectionStart;l=m.selectionEnd;q=m.value;try{this.lastKey=9}catch(n){}if(document.selection){m.focus();o=document.selection.createRange();o.text="\t"}else{if(r>=0){k=this.scrollTop;m.value=q.substring(0,r).concat("\t",q.substring(l));m.selectionStart=m.selectionEnd=r+1;this.scrollTop=k}}if(p.stopPropagation){p.stopPropagation()}if(p.preventDefault){p.preventDefault()}});a("#newcontent").bind("blur.wpevent_InsertTab",function(k){if(this.lastKey&&9==this.lastKey){this.focus()}});if(e.length){e.closest("form").submit(function(k){if(a('select[name="action"]').val()==-1&&a('select[name="action2"]').val()==-1&&e.val()==g){e.val("1")}})}a("#contextual-help-link, #show-settings-link").on("focus.scroll-into-view",function(k){if(k.target.scrollIntoView){k.target.scrollIntoView(false)}});(function(){var l,k,m=a("form.wp-upload-form");if(!m.length){return}l=m.find('input[type="submit"]');k=m.find('input[type="file"]');function n(){l.prop("disabled",""===k.map(function(){return a(this).val()}).get().join(""))}n();k.on("change",n)})()});a(document).bind("wp_CloseOnEscape",function(c,b){if(typeof(b.cb)!="function"){return}if(typeof(b.condition)!="function"||b.condition()){b.cb()}return true})})(jQuery);
/*
 * Thickbox 3.1 - One Box To Rule Them All.
 * By Cody Lindley (http://www.codylindley.com)
 * Copyright (c) 2007 cody lindley
 * Licensed under the MIT License: http://www.opensource.org/licenses/mit-license.php
*/

if ( typeof tb_pathToImage != 'string' ) {
	var tb_pathToImage = thickboxL10n.loadingAnimation;
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
		jQuery("body").append("<div id='TB_load'><img src='"+imgLoader.src+"' width='208' /></div>");//add loader to the page
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
			jQuery("#TB_window").append("<a href='' id='TB_ImageOff' title='"+thickboxL10n.close+"'><img id='TB_Image' src='"+url+"' width='"+imageWidth+"' height='"+imageHeight+"' alt='"+caption+"'/></a>" + "<div id='TB_caption'>"+caption+"<div id='TB_secondLine'>" + TB_imageCount + TB_PrevHTML + TB_NextHTML + "</div></div><div id='TB_closeWindow'><a href='#' id='TB_closeWindowButton' title='"+thickboxL10n.close+"'><div class='tb-close-icon'></div></a></div>");

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
						jQuery("#TB_window").append("<div id='TB_title'><div id='TB_ajaxWindowTitle'>"+caption+"</div><div id='TB_closeAjaxWindow'><a href='#' id='TB_closeWindowButton' title='"+thickboxL10n.close+"'><div class='tb-close-icon'></div></a></div></div><iframe frameborder='0' hspace='0' src='"+urlNoQuery[0]+"' id='TB_iframeContent' name='TB_iframeContent"+Math.round(Math.random()*1000)+"' onload='tb_showIframe()' style='width:"+(ajaxContentW + 29)+"px;height:"+(ajaxContentH + 17)+"px;' >"+thickboxL10n.noiframes+"</iframe>");
					}else{//iframe modal
					jQuery("#TB_overlay").unbind();
						jQuery("#TB_window").append("<iframe frameborder='0' hspace='0' src='"+urlNoQuery[0]+"' id='TB_iframeContent' name='TB_iframeContent"+Math.round(Math.random()*1000)+"' onload='tb_showIframe()' style='width:"+(ajaxContentW + 29)+"px;height:"+(ajaxContentH + 17)+"px;'>"+thickboxL10n.noiframes+"</iframe>");
					}
			}else{// not an iframe, ajax
					if(jQuery("#TB_window").css("visibility") != "visible"){
						if(params['modal'] != "true"){//ajax no modal
						jQuery("#TB_window").append("<div id='TB_title'><div id='TB_ajaxWindowTitle'>"+caption+"</div><div id='TB_closeAjaxWindow'><a href='#' id='TB_closeWindowButton'><div class='tb-close-icon'></div></a></div></div><div id='TB_ajaxContent' style='width:"+ajaxContentW+"px;height:"+ajaxContentH+"px'></div>");
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

var tb_position;jQuery(document).ready(function(a){tb_position=function(){var f=a("#TB_window"),e=a(window).width(),d=a(window).height(),c=(720<e)?720:e,b=0;if(a("body.admin-bar").length){b=28}if(f.size()){f.width(c-50).height(d-45-b);a("#TB_iframeContent").width(c-50).height(d-75-b);f.css({"margin-left":"-"+parseInt(((c-50)/2),10)+"px"});if(typeof document.body.style.maxWidth!="undefined"){f.css({top:20+b+"px","margin-top":"0"})}}return a("a.thickbox").each(function(){var g=a(this).attr("href");if(!g){return}g=g.replace(/&width=[0-9]+/g,"");g=g.replace(/&height=[0-9]+/g,"");a(this).attr("href",g+"&width="+(c-80)+"&height="+(d-85-b))})};a(window).resize(function(){tb_position()});a("#dashboard_plugins a.thickbox, .plugins a.thickbox").click(function(){tb_click.call(this);a("#TB_title").css({"background-color":"#222",color:"#cfcfcf"});a("#TB_ajaxWindowTitle").html("<strong>"+plugininstallL10n.plugin_information+"</strong>&nbsp;"+a(this).attr("title"));return false});a("#plugin-information #sidemenu a").click(function(){var b=a(this).attr("name");a("#plugin-information-header a.current").removeClass("current");a(this).addClass("current");a("#section-holder div.section").hide();a("#section-"+b).show();return false});a("a.install-now").click(function(){return confirm(plugininstallL10n.ays)})});
