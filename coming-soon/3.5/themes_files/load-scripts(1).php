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

jQuery(function(a){a("#availablethemes").on("click",".theme-detail",function(c){var d=a(this).closest(".available-theme"),b=d.find(".themedetaildiv");if(!b.length){b=d.find(".install-theme-info .theme-details");b=b.clone().addClass("themedetaildiv").appendTo(d).hide()}b.toggle();c.preventDefault()})});jQuery(function(c){if(!window.postMessage){return}var e=c("#theme-installer"),d=e.find(".install-theme-info"),b=e.find(".wp-full-overlay-main"),a=c(document.body);e.on("click",".close-full-overlay",function(f){e.fadeOut(200,function(){b.empty();a.removeClass("theme-installer-active full-overlay-active")});f.preventDefault()});e.on("click",".collapse-sidebar",function(f){e.toggleClass("collapsed").toggleClass("expanded");f.preventDefault()});c("#availablethemes").on("click",".install-theme-preview",function(f){var g;d.html(c(this).closest(".installable-theme").find(".install-theme-info").html());g=d.find(".theme-preview-url").val();b.html('<iframe src="'+g+'" />');e.fadeIn(200,function(){a.addClass("theme-installer-active full-overlay-active")});f.preventDefault()})});var ThemeViewer;(function(a){ThemeViewer=function(b){function d(){a("#filter-click, #mini-filter-click").unbind("click").click(function(){a("#filter-click").toggleClass("current");a("#filter-box").slideToggle();a("#current-theme").slideToggle(300);return false});a("#filter-box :checkbox").unbind("click").click(function(){var e=a("#filter-box :checked").length,f=a("#filter-click").text();if(f.indexOf("(")!=-1){f=f.substr(0,f.indexOf("("))}if(e==0){a("#filter-click").text(f)}else{a("#filter-click").text(f+" ("+e+")")}})}var c={init:d};return c}})(jQuery);jQuery(document).ready(function(a){theme_viewer=new ThemeViewer();theme_viewer.init()});var ThemeScroller;(function(a){ThemeScroller={querying:false,scrollPollingDelay:500,failedRetryDelay:4000,outListBottomThreshold:300,init:function(){var b=this;if(typeof ajaxurl==="undefined"||typeof list_args==="undefined"||typeof theme_list_args==="undefined"){a(".pagination-links").show();return}this.nonce=a("#_ajax_fetch_list_nonce").val();this.nextPage=(theme_list_args.paged+1);this.$outList=a("#availablethemes");this.$spinner=a("div.tablenav.bottom").children(".spinner");this.$window=a(window);this.$document=a(document);if(theme_list_args.total_pages>=this.nextPage){this.pollInterval=setInterval(function(){return b.poll()},this.scrollPollingDelay)}},poll:function(){var b=this.$document.scrollTop()+this.$window.innerHeight();if(this.querying||(b<this.$outList.height()-this.outListBottomThreshold)){return}this.ajax()},process:function(b){if(b===undefined){clearInterval(this.pollInterval);return}if(this.nextPage>theme_list_args.total_pages){clearInterval(this.pollInterval)}if(this.nextPage<=(theme_list_args.total_pages+1)){this.$outList.append(b.rows)}},ajax:function(){var b=this;this.querying=true;var c={action:"fetch-list",paged:this.nextPage,s:theme_list_args.search,tab:theme_list_args.tab,type:theme_list_args.type,_ajax_fetch_list_nonce:this.nonce,"features[]":theme_list_args.features,list_args:list_args};this.$spinner.show();a.getJSON(ajaxurl,c).done(function(d){b.nextPage++;b.process(d);b.$spinner.hide();b.querying=false}).fail(function(){b.$spinner.hide();b.querying=false;setTimeout(function(){b.ajax()},b.failedRetryDelay)})}};a(document).ready(function(b){ThemeScroller.init()})})(jQuery);
window.wp=window.wp||{};(function(a,d){var b,g,c,f,e=Array.prototype.slice;g=function(h,i){var j=f(this,h,i);j.extend=this.extend;return j};c=function(){};f=function(i,h,j){var k;if(h&&h.hasOwnProperty("constructor")){k=h.constructor}else{k=function(){var l=i.apply(this,arguments);return l}}d.extend(k,i);c.prototype=i.prototype;k.prototype=new c();if(h){d.extend(k.prototype,h)}if(j){d.extend(k,j)}k.prototype.constructor=k;k.__super__=i.prototype;return k};b={};b.Class=function(l,k,i){var j,h=arguments;if(l&&k&&b.Class.applicator===l){h=k;d.extend(this,i||{})}j=this;if(this.instance){j=function(){return j.instance.apply(j,arguments)};d.extend(j,this)}j.initialize.apply(j,h);return j};b.Class.applicator={};b.Class.prototype.initialize=function(){};b.Class.prototype.extended=function(h){var i=this;while(typeof i.constructor!=="undefined"){if(i.constructor===h){return true}if(typeof i.constructor.__super__==="undefined"){return false}i=i.constructor.__super__}return false};b.Class.extend=g;b.Events={trigger:function(h){if(this.topics&&this.topics[h]){this.topics[h].fireWith(this,e.call(arguments,1))}return this},bind:function(i,h){this.topics=this.topics||{};this.topics[i]=this.topics[i]||d.Callbacks();this.topics[i].add.apply(this.topics[i],e.call(arguments,1));return this},unbind:function(i,h){if(this.topics&&this.topics[i]){this.topics[i].remove.apply(this.topics[i],e.call(arguments,1))}return this}};b.Value=b.Class.extend({initialize:function(i,h){this._value=i;this.callbacks=d.Callbacks();d.extend(this,h||{});this.set=d.proxy(this.set,this)},instance:function(){return arguments.length?this.set.apply(this,arguments):this.get()},get:function(){return this._value},set:function(i){var h=this._value;i=this._setter.apply(this,arguments);i=this.validate(i);if(null===i||this._value===i){return this}this._value=i;this.callbacks.fireWith(this,[i,h]);return this},_setter:function(h){return h},setter:function(i){var h=this.get();this._setter=i;this._value=null;this.set(h);return this},resetSetter:function(){this._setter=this.constructor.prototype._setter;this.set(this.get());return this},validate:function(h){return h},bind:function(h){this.callbacks.add.apply(this.callbacks,arguments);return this},unbind:function(h){this.callbacks.remove.apply(this.callbacks,arguments);return this},link:function(){var h=this.set;d.each(arguments,function(){this.bind(h)});return this},unlink:function(){var h=this.set;d.each(arguments,function(){this.unbind(h)});return this},sync:function(){var h=this;d.each(arguments,function(){h.link(this);this.link(h)});return this},unsync:function(){var h=this;d.each(arguments,function(){h.unlink(this);this.unlink(h)});return this}});b.Values=b.Class.extend({defaultConstructor:b.Value,initialize:function(h){d.extend(this,h||{});this._value={};this._deferreds={}},instance:function(h){if(arguments.length===1){return this.value(h)}return this.when.apply(this,arguments)},value:function(h){return this._value[h]},has:function(h){return typeof this._value[h]!=="undefined"},add:function(i,h){if(this.has(i)){return this.value(i)}this._value[i]=h;h.parent=this;if(h.extended(b.Value)){h.bind(this._change)}this.trigger("add",h);if(this._deferreds[i]){this._deferreds[i].resolve()}return this._value[i]},create:function(h){return this.add(h,new this.defaultConstructor(b.Class.applicator,e.call(arguments,1)))},each:function(i,h){h=typeof h==="undefined"?this:h;d.each(this._value,function(j,k){i.call(h,k,j)})},remove:function(i){var h;if(this.has(i)){h=this.value(i);this.trigger("remove",h);if(h.extended(b.Value)){h.unbind(this._change)}delete h.parent}delete this._value[i];delete this._deferreds[i]},when:function(){var i=this,j=e.call(arguments),h=d.Deferred();if(d.isFunction(j[j.length-1])){h.done(j.pop())}d.when.apply(d,d.map(j,function(k){if(i.has(k)){return}return i._deferreds[k]=i._deferreds[k]||d.Deferred()})).done(function(){var k=d.map(j,function(l){return i(l)});if(k.length!==j.length){i.when.apply(i,j).done(function(){h.resolveWith(i,k)});return}h.resolveWith(i,k)});return h.promise()},_change:function(){this.parent.trigger("change",this)}});d.extend(b.Values.prototype,b.Events);b.ensure=function(h){return typeof h=="string"?d(h):h};b.Element=b.Value.extend({initialize:function(j,i){var h=this,m=b.Element.synchronizer.html,l,n,k;this.element=b.ensure(j);this.events="";if(this.element.is("input, select, textarea")){this.events+="change";m=b.Element.synchronizer.val;if(this.element.is("input")){l=this.element.prop("type");if(b.Element.synchronizer[l]){m=b.Element.synchronizer[l]}if("text"===l||"password"===l){this.events+=" keyup"}}else{if(this.element.is("textarea")){this.events+=" keyup"}}}b.Value.prototype.initialize.call(this,null,d.extend(i||{},m));this._value=this.get();n=this.update;k=this.refresh;this.update=function(o){if(o!==k.call(h)){n.apply(this,arguments)}};this.refresh=function(){h.set(k.call(h))};this.bind(this.update);this.element.bind(this.events,this.refresh)},find:function(h){return d(h,this.element)},refresh:function(){},update:function(){}});b.Element.synchronizer={};d.each(["html","val"],function(h,j){b.Element.synchronizer[j]={update:function(i){this.element[j](i)},refresh:function(){return this.element[j]()}}});b.Element.synchronizer.checkbox={update:function(h){this.element.prop("checked",h)},refresh:function(){return this.element.prop("checked")}};b.Element.synchronizer.radio={update:function(h){this.element.filter(function(){return this.value===h}).prop("checked",true)},refresh:function(){return this.element.filter(":checked").val()}};d.support.postMessage=!!window.postMessage;b.Messenger=b.Class.extend({add:function(j,i,h){return this[j]=new b.Value(i,h)},initialize:function(j,h){var i=window.parent==window?null:window.parent;d.extend(this,h||{});this.add("channel",j.channel);this.add("url",j.url||"");this.add("targetWindow",j.targetWindow||i);this.add("origin",this.url()).link(this.url).setter(function(k){return k.replace(/([^:]+:\/\/[^\/]+).*/,"$1")});this.receive=d.proxy(this.receive,this);this.receive.guid=d.guid++;d(window).on("message",this.receive)},destroy:function(){d(window).off("message",this.receive)},receive:function(i){var h;i=i.originalEvent;if(!this.targetWindow()){return}if(this.origin()&&i.origin!==this.origin()){return}h=JSON.parse(i.data);if(!h||!h.id||typeof h.data==="undefined"){return}if((h.channel||this.channel())&&this.channel()!==h.channel){return}this.trigger(h.id,h.data)},send:function(j,i){var h;i=typeof i==="undefined"?null:i;if(!this.url()||!this.targetWindow()){return}h={id:j,data:i};if(this.channel()){h.channel=this.channel()}this.targetWindow().postMessage(JSON.stringify(h),this.origin())}});d.extend(b.Messenger.prototype,b.Events);b=d.extend(new b.Values(),b);b.get=function(){var h={};this.each(function(j,i){h[i]=j.get()});return h};a.customize=b})(wp,jQuery);
window.wp=window.wp||{};(function(a,c){var b=wp.customize,d;c.extend(c.support,{history:!!(window.history&&history.pushState),hashchange:("onhashchange" in window)&&(document.documentMode===undefined||document.documentMode>7)});d=c.extend({},b.Events,{initialize:function(){this.body=c(document.body);if(!d.settings||!c.support.postMessage||(!c.support.cors&&d.settings.isCrossDomain)){return}this.window=c(window);this.element=c('<div id="customize-container" />').appendTo(this.body);this.bind("open",this.overlay.show);this.bind("close",this.overlay.hide);c("#wpbody").on("click",".load-customize",function(e){e.preventDefault();d.link=c(this);d.open(d.link.attr("href"))});if(c.support.history){this.window.on("popstate",d.popstate)}if(c.support.hashchange){this.window.on("hashchange",d.hashchange);this.window.triggerHandler("hashchange")}},popstate:function(g){var f=g.originalEvent.state;if(f&&f.customize){d.open(f.customize)}else{if(d.active){d.close()}}},hashchange:function(g){var f=window.location.toString().split("#")[1];if(f&&0===f.indexOf("wp_customize=on")){d.open(d.settings.url+"?"+f)}if(!f&&!c.support.history){d.close()}},open:function(f){var e;if(this.active){return}if(d.settings.browser.mobile){return window.location=f}this.active=true;this.body.addClass("customize-loading");this.iframe=c("<iframe />",{src:f}).appendTo(this.element);this.iframe.one("load",this.loaded);this.messenger=new b.Messenger({url:f,channel:"loader",targetWindow:this.iframe[0].contentWindow});this.messenger.bind("ready",function(){d.messenger.send("back")});this.messenger.bind("close",function(){if(c.support.history){history.back()}else{if(c.support.hashchange){window.location.hash=""}else{d.close()}}});this.messenger.bind("activated",function(g){if(g){window.location=g}});e=f.split("?")[1];if(c.support.history&&window.location.href!==f){history.pushState({customize:f},"",f)}else{if(!c.support.history&&c.support.hashchange&&e){window.location.hash="wp_customize=on&"+e}}this.trigger("open")},opened:function(){d.body.addClass("customize-active full-overlay-active")},close:function(){if(!this.active){return}this.active=false;this.trigger("close");if(this.link){this.link.focus()}},closed:function(){d.iframe.remove();d.messenger.destroy();d.iframe=null;d.messenger=null;d.body.removeClass("customize-active full-overlay-active").removeClass("customize-loading")},loaded:function(){d.body.removeClass("customize-loading")},overlay:{show:function(){this.element.fadeIn(200,d.opened)},hide:function(){this.element.fadeOut(200,d.closed)}}});c(function(){d.settings=_wpCustomizeLoaderSettings;d.initialize()});b.Loader=d})(wp,jQuery);
