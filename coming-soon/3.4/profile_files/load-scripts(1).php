if(typeof(jQuery)!="undefined"){if(typeof(jQuery.fn.hoverIntent)=="undefined"){(function(b){b.fn.hoverIntent=function(p,r){var g={sensitivity:7,interval:100,timeout:0};g=b.extend(g,r?{over:p,out:r}:p);var a,f,t,v;var u=function(c){a=c.pageX;f=c.pageY};var w=function(c,d){d.hoverIntent_t=clearTimeout(d.hoverIntent_t);if((Math.abs(t-a)+Math.abs(v-f))<g.sensitivity){b(d).unbind("mousemove",u);d.hoverIntent_s=1;return g.over.apply(d,[c])}else{t=a;v=f;d.hoverIntent_t=setTimeout(function(){w(c,d)},g.interval)}};var s=function(c,d){d.hoverIntent_t=clearTimeout(d.hoverIntent_t);d.hoverIntent_s=0;return g.out.apply(d,[c])};var x=function(e){var d=this;var c=(e.type=="mouseover"?e.fromElement:e.toElement)||e.relatedTarget;while(c&&c!=this){try{c=c.parentNode}catch(e){c=this}}if(c==this){if(b.browser.mozilla){if(e.type=="mouseout"){d.mtout=setTimeout(function(){q(e,d)},30)}else{if(d.mtout){d.mtout=clearTimeout(d.mtout)}}}return}else{if(d.mtout){d.mtout=clearTimeout(d.mtout)}q(e,d)}};var q=function(e,d){var c=jQuery.extend({},e);if(d.hoverIntent_t){d.hoverIntent_t=clearTimeout(d.hoverIntent_t)}if(e.type=="mouseover"){t=c.pageX;v=c.pageY;b(d).bind("mousemove",u);if(d.hoverIntent_s!=1){d.hoverIntent_t=setTimeout(function(){w(c,d)},g.interval)}}else{b(d).unbind("mousemove",u);if(d.hoverIntent_s==1){d.hoverIntent_t=setTimeout(function(){s(c,d)},g.timeout)}}};return this.mouseover(x).mouseout(x)}})(jQuery)}jQuery(document).ready(function(b){var a=function(c,e){var f=b(e),d=f.attr("tabindex");if(d){f.attr("tabindex","0").attr("tabindex",d)}};b("#wpadminbar").removeClass("nojq").removeClass("nojs").find("li.menupop").hoverIntent({over:function(c){b(this).addClass("hover")},out:function(c){b(this).removeClass("hover")},timeout:180,sensitivity:7,interval:100});b("#wp-admin-bar-get-shortlink").click(function(c){c.preventDefault();b(this).addClass("selected").children(".shortlink-input").blur(function(){b(this).parents("#wp-admin-bar-get-shortlink").removeClass("selected")}).focus().select()});b("#wpadminbar li.menupop > .ab-item").bind("keydown.adminbar",function(f){if(f.which!=13){return}var d=b(f.target),c=d.closest("ab-sub-wrapper");f.stopPropagation();f.preventDefault();if(!c.length){c=b("#wpadminbar .quicklinks")}c.find(".menupop").removeClass("hover");d.parent().toggleClass("hover");d.siblings(".ab-sub-wrapper").find(".ab-item").each(a)}).each(a);b("#wpadminbar .ab-item").bind("keydown.adminbar",function(d){if(d.which!=27){return}var c=b(d.target);d.stopPropagation();d.preventDefault();c.closest(".hover").removeClass("hover").children(".ab-item").focus();c.siblings(".ab-sub-wrapper").find(".ab-item").each(a)});b("#wpadminbar").click(function(c){if(c.target.id!="wpadminbar"&&c.target.id!="wp-admin-bar-top-secondary"){return}c.preventDefault();b("html, body").animate({scrollTop:0},"fast")})})}else{(function(j,l){var e=function(o,n,d){if(o.addEventListener){o.addEventListener(n,d,false)}else{if(o.attachEvent){o.attachEvent("on"+n,function(){return d.call(o,window.event)})}}},f,g=new RegExp("\\bhover\\b","g"),b=[],k=new RegExp("\\bselected\\b","g"),h=function(n){var d=b.length;while(d--){if(b[d]&&n==b[d][1]){return b[d][0]}}return false},i=function(u){var o,d,r,n,q,s,v=[],p=0;while(u&&u!=f&&u!=j){if("LI"==u.nodeName.toUpperCase()){v[v.length]=u;d=h(u);if(d){clearTimeout(d)}u.className=u.className?(u.className.replace(g,"")+" hover"):"hover";n=u}u=u.parentNode}if(n&&n.parentNode){q=n.parentNode;if(q&&"UL"==q.nodeName.toUpperCase()){o=q.childNodes.length;while(o--){s=q.childNodes[o];if(s!=n){s.className=s.className?s.className.replace(k,""):""}}}}o=b.length;while(o--){r=false;p=v.length;while(p--){if(v[p]==b[o][1]){r=true}}if(!r){b[o][1].className=b[o][1].className?b[o][1].className.replace(g,""):""}}},m=function(d){while(d&&d!=f&&d!=j){if("LI"==d.nodeName.toUpperCase()){(function(n){var o=setTimeout(function(){n.className=n.className?n.className.replace(g,""):""},500);b[b.length]=[o,n]})(d)}d=d.parentNode}},c=function(q){var o,d,p,n=q.target||q.srcElement;while(true){if(!n||n==j||n==f){return}if(n.id&&n.id=="wp-admin-bar-get-shortlink"){break}n=n.parentNode}if(q.preventDefault){q.preventDefault()}q.returnValue=false;if(-1==n.className.indexOf("selected")){n.className+=" selected"}for(o=0,d=n.childNodes.length;o<d;o++){p=n.childNodes[o];if(p.className&&-1!=p.className.indexOf("shortlink-input")){p.focus();p.select();p.onblur=function(){n.className=n.className?n.className.replace(k,""):""};break}}return false},a=function(n){var s,q,p,d,r,o;if(n.id!="wpadminbar"&&n.id!="wp-admin-bar-top-secondary"){return}s=window.pageYOffset||document.documentElement.scrollTop||document.body.scrollTop||0;if(s<1){return}o=s>800?130:100;q=Math.min(12,Math.round(s/o));p=s>800?Math.round(s/30):Math.round(s/20);d=[];r=0;while(s){s-=p;if(s<0){s=0}d.push(s);setTimeout(function(){window.scrollTo(0,d.shift())},r*q);r++}};e(l,"load",function(){f=j.getElementById("wpadminbar");if(j.body&&f){j.body.appendChild(f);if(f.className){f.className=f.className.replace(/nojs/,"")}e(f,"mouseover",function(d){i(d.target||d.srcElement)});e(f,"mouseout",function(d){m(d.target||d.srcElement)});e(f,"click",c);e(f,"click",function(d){a(d.target||d.srcElement)})}if(l.location.hash){l.scrollBy(0,-32)}})})(document,window)};
(function(a){a.fn.hoverIntent=function(k,j){var l={sensitivity:7,interval:100,timeout:0};l=a.extend(l,j?{over:k,out:j}:k);var n,m,h,d;var e=function(f){n=f.pageX;m=f.pageY};var c=function(g,f){f.hoverIntent_t=clearTimeout(f.hoverIntent_t);if((Math.abs(h-n)+Math.abs(d-m))<l.sensitivity){a(f).unbind("mousemove",e);f.hoverIntent_s=1;return l.over.apply(f,[g])}else{h=n;d=m;f.hoverIntent_t=setTimeout(function(){c(g,f)},l.interval)}};var i=function(g,f){f.hoverIntent_t=clearTimeout(f.hoverIntent_t);f.hoverIntent_s=0;return l.out.apply(f,[g])};var b=function(o){var g=jQuery.extend({},o);var f=this;if(f.hoverIntent_t){f.hoverIntent_t=clearTimeout(f.hoverIntent_t)}if(o.type=="mouseenter"){h=g.pageX;d=g.pageY;a(f).bind("mousemove",e);if(f.hoverIntent_s!=1){f.hoverIntent_t=setTimeout(function(){c(g,f)},l.interval)}}else{a(f).unbind("mousemove",e);if(f.hoverIntent_s==1){f.hoverIntent_t=setTimeout(function(){i(g,f)},l.timeout)}}};return this.bind("mouseenter",b).bind("mouseleave",b)}})(jQuery);
var showNotice,adminMenu,columns,validateForm,screenMeta;(function(a){adminMenu={init:function(){},fold:function(){},restoreMenuState:function(){},toggle:function(){},favorites:function(){}};columns={init:function(){var b=this;a(".hide-column-tog","#adv-settings").click(function(){var d=a(this),c=d.val();if(d.prop("checked")){b.checked(c)}else{b.unchecked(c)}columns.saveManageColumnsState()})},saveManageColumnsState:function(){var b=this.hidden();a.post(ajaxurl,{action:"hidden-columns",hidden:b,screenoptionnonce:a("#screenoptionnonce").val(),page:pagenow})},checked:function(b){a(".column-"+b).show();this.colSpanChange(+1)},unchecked:function(b){a(".column-"+b).hide();this.colSpanChange(-1)},hidden:function(){return a(".manage-column").filter(":hidden").map(function(){return this.id}).get().join(",")},useCheckboxesForHidden:function(){this.hidden=function(){return a(".hide-column-tog").not(":checked").map(function(){var b=this.id;return b.substring(b,b.length-5)}).get().join(",")}},colSpanChange:function(b){var d=a("table").find(".colspanchange"),c;if(!d.length){return}c=parseInt(d.attr("colspan"),10)+b;d.attr("colspan",c.toString())}};a(document).ready(function(){columns.init()});validateForm=function(b){return !a(b).find(".form-required").filter(function(){return a("input:visible",this).val()==""}).addClass("form-invalid").find("input:visible").change(function(){a(this).closest(".form-invalid").removeClass("form-invalid")}).size()};showNotice={warn:function(){var b=commonL10n.warnDelete||"";if(confirm(b)){return true}return false},note:function(b){alert(b)}};screenMeta={element:null,toggles:null,page:null,init:function(){this.element=a("#screen-meta");this.toggles=a(".screen-meta-toggle a");this.page=a("#wpcontent");this.toggles.click(this.toggleEvent)},toggleEvent:function(c){var b=a(this.href.replace(/.+#/,"#"));c.preventDefault();if(!b.length){return}if(b.is(":visible")){screenMeta.close(b,a(this))}else{screenMeta.open(b,a(this))}},open:function(b,c){a(".screen-meta-toggle").not(c.parent()).css("visibility","hidden");b.parent().show();b.slideDown("fast",function(){c.addClass("screen-meta-active")})},close:function(b,c){b.slideUp("fast",function(){c.removeClass("screen-meta-active");a(".screen-meta-toggle").css("visibility","");b.parent().hide()})}};a(".contextual-help-tabs").delegate("a","click focus",function(d){var c=a(this),b;d.preventDefault();if(c.is(".active a")){return false}a(".contextual-help-tabs .active").removeClass("active");c.parent("li").addClass("active");b=a(c.attr("href"));a(".help-tab-content").not(b).removeClass("active").hide();b.addClass("active").show()});a(document).ready(function(){var i=false,c,e,j,h,b=a("#adminmenu"),d=a("input.current-page"),f=d.val(),g;g=function(k,m){var n=a(m),l=n.attr("tabindex");if(l){n.attr("tabindex","0").attr("tabindex",l)}};a("#collapse-menu",b).click(function(){var k=a(document.body);a("#adminmenu div.wp-submenu").css("margin-top","");if(k.hasClass("folded")){k.removeClass("folded");setUserSetting("mfold","o")}else{k.addClass("folded");setUserSetting("mfold","f")}return false});a("li.wp-has-submenu",b).hoverIntent({over:function(s){var t,q,k,r,l=a(this).find(".wp-submenu"),u,n,p;if(l.is(":visible")){return}u=a(this).offset().top;n=a(window).scrollTop();p=u-n-30;t=u+l.height()+1;q=a("#wpwrap").height();k=60+t-q;r=a(window).height()+n-15;if(r<(t-k)){k=t-r}if(k>p){k=p}if(k>1){l.css("margin-top","-"+k+"px")}else{l.css("margin-top","")}b.find(".wp-submenu").removeClass("sub-open");l.addClass("sub-open")},out:function(){a(this).find(".wp-submenu").removeClass("sub-open")},timeout:200,sensitivity:7,interval:90});a("li.wp-has-submenu > a.wp-not-current-submenu",b).bind("keydown.adminmenu",function(l){if(l.which!=13){return}var k=a(l.target);l.stopPropagation();l.preventDefault();b.find(".wp-submenu").removeClass("sub-open");k.siblings(".wp-submenu").toggleClass("sub-open").find('a[role="menuitem"]').each(g)}).each(g);a('a[role="menuitem"]',b).bind("keydown.adminmenu",function(l){if(l.which!=27){return}var k=a(l.target);l.stopPropagation();l.preventDefault();k.add(k.siblings()).closest(".sub-open").removeClass("sub-open").siblings("a.wp-not-current-submenu").focus()});a("div.wrap h2:first").nextAll("div.updated, div.error").addClass("below-h2");a("div.updated, div.error").not(".below-h2, .inline").insertAfter(a("div.wrap h2:first"));screenMeta.init();a("tbody").children().children(".check-column").find(":checkbox").click(function(k){if("undefined"==k.shiftKey){return true}if(k.shiftKey){if(!i){return true}c=a(i).closest("form").find(":checkbox");e=c.index(i);j=c.index(this);h=a(this).prop("checked");if(0<e&&0<j&&e!=j){c.slice(e,j).prop("checked",function(){if(a(this).closest("tr").is(":visible")){return h}return false})}}i=this;return true});a("thead, tfoot").find(".check-column :checkbox").click(function(m){var n=a(this).prop("checked"),l="undefined"==typeof toggleWithKeyboard?false:toggleWithKeyboard,k=m.shiftKey||l;a(this).closest("table").children("tbody").filter(":visible").children().children(".check-column").find(":checkbox").prop("checked",function(){if(a(this).closest("tr").is(":hidden")){return false}if(k){return a(this).prop("checked")}else{if(n){return true}}return false});a(this).closest("table").children("thead,  tfoot").filter(":visible").children().children(".check-column").find(":checkbox").prop("checked",function(){if(k){return false}else{if(n){return true}}return false})});a("#default-password-nag-no").click(function(){setUserSetting("default_password_nag","hide");a("div.default-password-nag").hide();return false});a("#newcontent").bind("keydown.wpevent_InsertTab",function(p){if(p.keyCode!=9){return true}var m=p.target,r=m.selectionStart,l=m.selectionEnd,q=m.value,k,o;try{this.lastKey=9}catch(n){}if(document.selection){m.focus();o=document.selection.createRange();o.text="\t"}else{if(r>=0){k=this.scrollTop;m.value=q.substring(0,r).concat("\t",q.substring(l));m.selectionStart=m.selectionEnd=r+1;this.scrollTop=k}}if(p.stopPropagation){p.stopPropagation()}if(p.preventDefault){p.preventDefault()}});a("#newcontent").bind("blur.wpevent_InsertTab",function(k){if(this.lastKey&&9==this.lastKey){this.focus()}});if(d.length){d.closest("form").submit(function(k){if(a('select[name="action"]').val()==-1&&a('select[name="action2"]').val()==-1&&d.val()==f){d.val("1")}})}});a(document).bind("wp_CloseOnEscape",function(c,b){if(typeof(b.cb)!="function"){return}if(typeof(b.condition)!="function"||b.condition()){b.cb()}return true})})(jQuery);
(function(d){d.each(["backgroundColor","borderBottomColor","borderLeftColor","borderRightColor","borderTopColor","color","outlineColor"],function(f,e){d.fx.step[e]=function(g){if(g.state==0){g.start=c(g.elem,e);g.end=b(g.end)}g.elem.style[e]="rgb("+[Math.max(Math.min(parseInt((g.pos*(g.end[0]-g.start[0]))+g.start[0]),255),0),Math.max(Math.min(parseInt((g.pos*(g.end[1]-g.start[1]))+g.start[1]),255),0),Math.max(Math.min(parseInt((g.pos*(g.end[2]-g.start[2]))+g.start[2]),255),0)].join(",")+")"}});function b(f){var e;if(f&&f.constructor==Array&&f.length==3){return f}if(e=/rgb\(\s*([0-9]{1,3})\s*,\s*([0-9]{1,3})\s*,\s*([0-9]{1,3})\s*\)/.exec(f)){return[parseInt(e[1]),parseInt(e[2]),parseInt(e[3])]}if(e=/rgb\(\s*([0-9]+(?:\.[0-9]+)?)\%\s*,\s*([0-9]+(?:\.[0-9]+)?)\%\s*,\s*([0-9]+(?:\.[0-9]+)?)\%\s*\)/.exec(f)){return[parseFloat(e[1])*2.55,parseFloat(e[2])*2.55,parseFloat(e[3])*2.55]}if(e=/#([a-fA-F0-9]{2})([a-fA-F0-9]{2})([a-fA-F0-9]{2})/.exec(f)){return[parseInt(e[1],16),parseInt(e[2],16),parseInt(e[3],16)]}if(e=/#([a-fA-F0-9])([a-fA-F0-9])([a-fA-F0-9])/.exec(f)){return[parseInt(e[1]+e[1],16),parseInt(e[2]+e[2],16),parseInt(e[3]+e[3],16)]}if(e=/rgba\(0, 0, 0, 0\)/.exec(f)){return a.transparent}return a[d.trim(f).toLowerCase()]}function c(g,e){var f;do{f=d.curCSS(g,e);if(f!=""&&f!="transparent"||d.nodeName(g,"body")){break}e="backgroundColor"}while(g=g.parentNode);return b(f)}var a={aqua:[0,255,255],azure:[240,255,255],beige:[245,245,220],black:[0,0,0],blue:[0,0,255],brown:[165,42,42],cyan:[0,255,255],darkblue:[0,0,139],darkcyan:[0,139,139],darkgrey:[169,169,169],darkgreen:[0,100,0],darkkhaki:[189,183,107],darkmagenta:[139,0,139],darkolivegreen:[85,107,47],darkorange:[255,140,0],darkorchid:[153,50,204],darkred:[139,0,0],darksalmon:[233,150,122],darkviolet:[148,0,211],fuchsia:[255,0,255],gold:[255,215,0],green:[0,128,0],indigo:[75,0,130],khaki:[240,230,140],lightblue:[173,216,230],lightcyan:[224,255,255],lightgreen:[144,238,144],lightgrey:[211,211,211],lightpink:[255,182,193],lightyellow:[255,255,224],lime:[0,255,0],magenta:[255,0,255],maroon:[128,0,0],navy:[0,0,128],olive:[128,128,0],orange:[255,165,0],pink:[255,192,203],purple:[128,0,128],violet:[128,0,128],red:[255,0,0],silver:[192,192,192],white:[255,255,255],yellow:[255,255,0],transparent:[255,255,255]}})(jQuery);
function passwordStrength(f,i,d){var k=1,h=2,b=3,a=4,c=5,g=0,j,e;if((f!=d)&&d.length>0){return c}if(f.length<4){return k}if(f.toLowerCase()==i.toLowerCase()){return h}if(f.match(/[0-9]/)){g+=10}if(f.match(/[a-z]/)){g+=26}if(f.match(/[A-Z]/)){g+=26}if(f.match(/[^a-zA-Z0-9]/)){g+=31}j=Math.log(Math.pow(g,f.length));e=j/Math.LN2;if(e<40){return h}if(e<56){return b}return a};
(function(a){function b(){var e=a("#pass1").val(),d=a("#user_login").val(),c=a("#pass2").val(),f;a("#pass-strength-result").removeClass("short bad good strong");if(!e){a("#pass-strength-result").html(pwsL10n.empty);return}f=passwordStrength(e,d,c);switch(f){case 2:a("#pass-strength-result").addClass("bad").html(pwsL10n.bad);break;case 3:a("#pass-strength-result").addClass("good").html(pwsL10n.good);break;case 4:a("#pass-strength-result").addClass("strong").html(pwsL10n.strong);break;case 5:a("#pass-strength-result").addClass("short").html(pwsL10n.mismatch);break;default:a("#pass-strength-result").addClass("short").html(pwsL10n["short"])}}a(document).ready(function(){var c=a("#display_name");a("#pass1").val("").keyup(b);a("#pass2").val("").keyup(b);a("#pass-strength-result").show();a(".color-palette").click(function(){a(this).siblings('input[name="admin_color"]').prop("checked",true)});if(c.length){a("#first_name, #last_name, #nickname").bind("blur.user_profile",function(){var e=[],d={display_nickname:a("#nickname").val()||"",display_username:a("#user_login").val()||"",display_firstname:a("#first_name").val()||"",display_lastname:a("#last_name").val()||""};if(d.display_firstname&&d.display_lastname){d.display_firstlast=d.display_firstname+" "+d.display_lastname;d.display_lastfirst=d.display_lastname+" "+d.display_firstname}a.each(a("option",c),function(f,g){e.push(g.value)});a.each(d,function(h,f){if(!f){return}var g=f.replace(/<\/?[a-z][^>]*>/gi,"");if(d[h].length&&a.inArray(g,e)==-1){e.push(g);a("<option />",{text:g}).appendTo(c)}})})}})})(jQuery);