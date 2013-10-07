function TinyMCE_Engine() {var ua;this.majorVersion = "2";this.minorVersion = "1.1.1";this.releaseDate = "2007-05-14";this.instances = [];this.switchClassCache = [];this.windowArgs = [];this.loadedFiles = [];this.pendingFiles = [];this.loadingIndex = 0;this.configs = [];this.currentConfig = 0;this.eventHandlers = [];this.log = [];this.undoLevels = [];this.undoIndex = 0;this.typingUndoIndex = -1;this.settings = [];ua = navigator.userAgent;this.isMSIE = (navigator.appName == "Microsoft Internet Explorer");this.isMSIE5 = this.isMSIE && (ua.indexOf('MSIE 5') != -1);this.isMSIE5_0 = this.isMSIE && (ua.indexOf('MSIE 5.0') != -1);this.isMSIE7 = this.isMSIE && (ua.indexOf('MSIE 7') != -1);this.isGecko = ua.indexOf('Gecko') != -1;this.isSafari = ua.indexOf('Safari') != -1;this.isOpera = window['opera'] && opera.buildNumber ? true : false;this.isMac = ua.indexOf('Mac') != -1;this.isNS7 = ua.indexOf('Netscape/7') != -1;this.isNS71 = ua.indexOf('Netscape/7.1') != -1;this.dialogCounter = 0;this.plugins = [];this.themes = [];this.menus = [];this.loadedPlugins = [];this.buttonMap = [];this.isLoaded = false;if (this.isOpera) {this.isMSIE = true;this.isGecko = false;this.isSafari =  false;}this.isIE = this.isMSIE;this.isRealIE = this.isMSIE && !this.isOpera;this.idCounter = 0;};TinyMCE_Engine.prototype = {init : function(settings) {var theme, nl, baseHREF = "", i, cssPath, entities, h, p, src, elements = [], head;if (this.isMSIE5_0)return;this.settings = settings;if (typeof(document.execCommand) == 'undefined')return;if (!tinyMCE.baseURL) {head = document.getElementsByTagName('head')[0];if (head) {for (i=0, nl = head.getElementsByTagName('script'); i<nl.length; i++)elements.push(nl[i]);}for (i=0, nl = document.getElementsByTagName('script'); i<nl.length; i++)elements.push(nl[i]);nl = document.getElementsByTagName('base');for (i=0; i<nl.length; i++) {if (nl[i].href)baseHREF = nl[i].href;}for (i=0; i<elements.length; i++) {if (elements[i].src && (elements[i].src.indexOf("tiny_mce.js") != -1 || elements[i].src.indexOf("tiny_mce_dev.js") != -1 || elements[i].src.indexOf("tiny_mce_src.js") != -1 || elements[i].src.indexOf("tiny_mce_gzip") != -1)) {src = elements[i].src;tinyMCE.srcMode = (src.indexOf('_src') != -1 || src.indexOf('_dev') != -1) ? '_src' : '';tinyMCE.gzipMode = src.indexOf('_gzip') != -1;src = src.substring(0, src.lastIndexOf('/'));if (settings.exec_mode == "src" || settings.exec_mode == "normal")tinyMCE.srcMode = settings.exec_mode == "src" ? '_src' : '';if (baseHREF !== '' && src.indexOf('://') == -1)tinyMCE.baseURL = baseHREF + src;else
tinyMCE.baseURL = src;break;}}}this.documentBasePath = document.location.href;if (this.documentBasePath.indexOf('?') != -1)this.documentBasePath = this.documentBasePath.substring(0, this.documentBasePath.indexOf('?'));this.documentURL = this.documentBasePath;this.documentBasePath = this.documentBasePath.substring(0, this.documentBasePath.lastIndexOf('/'));if (tinyMCE.baseURL.indexOf('://') == -1 && tinyMCE.baseURL.charAt(0) != '/') {tinyMCE.baseURL = this.documentBasePath + "/" + tinyMCE.baseURL;}this._def("mode", "none");this._def("theme", "advanced");this._def("plugins", "", true);this._def("language", "en");this._def("docs_language", this.settings.language);this._def("elements", "");this._def("textarea_trigger", "mce_editable");this._def("editor_selector", "");this._def("editor_deselector", "mceNoEditor");this._def("valid_elements", "+a[id|style|rel|rev|charset|hreflang|dir|lang|tabindex|accesskey|type|name|href|target|title|class|onfocus|onblur|onclick|ondblclick|onmousedown|onmouseup|onmouseover|onmousemove|onmouseout|onkeypress|onkeydown|onkeyup],-strong/-b[class|style],-em/-i[class|style],-strike[class|style],-u[class|style],#p[id|style|dir|class|align],-ol[class|style],-ul[class|style],-li[class|style],br,img[id|dir|lang|longdesc|usemap|style|class|src|onmouseover|onmouseout|border|alt=|title|hspace|vspace|width|height|align],-sub[style|class],-sup[style|class],-blockquote[dir|style],-table[border=0|cellspacing|cellpadding|width|height|class|align|summary|style|dir|id|lang|bgcolor|background|bordercolor],-tr[id|lang|dir|class|rowspan|width|height|align|valign|style|bgcolor|background|bordercolor],tbody[id|class],thead[id|class],tfoot[id|class],#td[id|lang|dir|class|colspan|rowspan|width|height|align|valign|style|bgcolor|background|bordercolor|scope],-th[id|lang|dir|class|colspan|rowspan|width|height|align|valign|style|scope],caption[id|lang|dir|class|style],-div[id|dir|class|align|style],-span[style|class|align],-pre[class|align|style],address[class|align|style],-h1[id|style|dir|class|align],-h2[id|style|dir|class|align],-h3[id|style|dir|class|align],-h4[id|style|dir|class|align],-h5[id|style|dir|class|align],-h6[id|style|dir|class|align],hr[class|style],-font[face|size|style|id|class|dir|color],dd[id|class|title|style|dir|lang],dl[id|class|title|style|dir|lang],dt[id|class|title|style|dir|lang],cite[title|id|class|style|dir|lang],abbr[title|id|class|style|dir|lang],acronym[title|id|class|style|dir|lang],del[title|id|class|style|dir|lang|datetime|cite],ins[title|id|class|style|dir|lang|datetime|cite]");this._def("extended_valid_elements", "");this._def("invalid_elements", "");this._def("encoding", "");this._def("urlconverter_callback", tinyMCE.getParam("urlconvertor_callback", "TinyMCE_Engine.prototype.convertURL"));this._def("save_callback", "");this._def("force_br_newlines", false);this._def("force_p_newlines", true);this._def("add_form_submit_trigger", true);this._def("relative_urls", true);this._def("remove_script_host", true);this._def("focus_alert", true);this._def("document_base_url", this.documentURL);this._def("visual", true);this._def("visual_table_class", "mceVisualAid");this._def("setupcontent_callback", "");this._def("fix_content_duplication", true);this._def("custom_undo_redo", true);this._def("custom_undo_redo_levels", -1);this._def("custom_undo_redo_keyboard_shortcuts", true);this._def("custom_undo_redo_restore_selection", true);this._def("custom_undo_redo_global", false);this._def("verify_html", true);this._def("apply_source_formatting", false);this._def("directionality", "ltr");this._def("cleanup_on_startup", false);this._def("inline_styles", false);this._def("convert_newlines_to_brs", false);this._def("auto_reset_designmode", true);this._def("entities", "39,#39,160,nbsp,161,iexcl,162,cent,163,pound,164,curren,165,yen,166,brvbar,167,sect,168,uml,169,copy,170,ordf,171,laquo,172,not,173,shy,174,reg,175,macr,176,deg,177,plusmn,178,sup2,179,sup3,180,acute,181,micro,182,para,183,middot,184,cedil,185,sup1,186,ordm,187,raquo,188,frac14,189,frac12,190,frac34,191,iquest,192,Agrave,193,Aacute,194,Acirc,195,Atilde,196,Auml,197,Aring,198,AElig,199,Ccedil,200,Egrave,201,Eacute,202,Ecirc,203,Euml,204,Igrave,205,Iacute,206,Icirc,207,Iuml,208,ETH,209,Ntilde,210,Ograve,211,Oacute,212,Ocirc,213,Otilde,214,Ouml,215,times,216,Oslash,217,Ugrave,218,Uacute,219,Ucirc,220,Uuml,221,Yacute,222,THORN,223,szlig,224,agrave,225,aacute,226,acirc,227,atilde,228,auml,229,aring,230,aelig,231,ccedil,232,egrave,233,eacute,234,ecirc,235,euml,236,igrave,237,iacute,238,icirc,239,iuml,240,eth,241,ntilde,242,ograve,243,oacute,244,ocirc,245,otilde,246,ouml,247,divide,248,oslash,249,ugrave,250,uacute,251,ucirc,252,uuml,253,yacute,254,thorn,255,yuml,402,fnof,913,Alpha,914,Beta,915,Gamma,916,Delta,917,Epsilon,918,Zeta,919,Eta,920,Theta,921,Iota,922,Kappa,923,Lambda,924,Mu,925,Nu,926,Xi,927,Omicron,928,Pi,929,Rho,931,Sigma,932,Tau,933,Upsilon,934,Phi,935,Chi,936,Psi,937,Omega,945,alpha,946,beta,947,gamma,948,delta,949,epsilon,950,zeta,951,eta,952,theta,953,iota,954,kappa,955,lambda,956,mu,957,nu,958,xi,959,omicron,960,pi,961,rho,962,sigmaf,963,sigma,964,tau,965,upsilon,966,phi,967,chi,968,psi,969,omega,977,thetasym,978,upsih,982,piv,8226,bull,8230,hellip,8242,prime,8243,Prime,8254,oline,8260,frasl,8472,weierp,8465,image,8476,real,8482,trade,8501,alefsym,8592,larr,8593,uarr,8594,rarr,8595,darr,8596,harr,8629,crarr,8656,lArr,8657,uArr,8658,rArr,8659,dArr,8660,hArr,8704,forall,8706,part,8707,exist,8709,empty,8711,nabla,8712,isin,8713,notin,8715,ni,8719,prod,8721,sum,8722,minus,8727,lowast,8730,radic,8733,prop,8734,infin,8736,ang,8743,and,8744,or,8745,cap,8746,cup,8747,int,8756,there4,8764,sim,8773,cong,8776,asymp,8800,ne,8801,equiv,8804,le,8805,ge,8834,sub,8835,sup,8836,nsub,8838,sube,8839,supe,8853,oplus,8855,otimes,8869,perp,8901,sdot,8968,lceil,8969,rceil,8970,lfloor,8971,rfloor,9001,lang,9002,rang,9674,loz,9824,spades,9827,clubs,9829,hearts,9830,diams,34,quot,38,amp,60,lt,62,gt,338,OElig,339,oelig,352,Scaron,353,scaron,376,Yuml,710,circ,732,tilde,8194,ensp,8195,emsp,8201,thinsp,8204,zwnj,8205,zwj,8206,lrm,8207,rlm,8211,ndash,8212,mdash,8216,lsquo,8217,rsquo,8218,sbquo,8220,ldquo,8221,rdquo,8222,bdquo,8224,dagger,8225,Dagger,8240,permil,8249,lsaquo,8250,rsaquo,8364,euro", true);this._def("entity_encoding", "named");this._def("cleanup_callback", "");this._def("add_unload_trigger", true);this._def("ask", false);this._def("nowrap", false);this._def("auto_resize", false);this._def("auto_focus", false);this._def("cleanup", true);this._def("remove_linebreaks", true);this._def("button_tile_map", false);this._def("submit_patch", true);this._def("browsers", "msie,safari,gecko,opera", true);this._def("dialog_type", "window");this._def("accessibility_warnings", true);this._def("accessibility_focus", true);this._def("merge_styles_invalid_parents", "");this._def("force_hex_style_colors", true);this._def("trim_span_elements", true);this._def("convert_fonts_to_spans", false);this._def("doctype", '<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">');this._def("font_size_classes", '');this._def("font_size_style_values", 'xx-small,x-small,small,medium,large,x-large,xx-large', true);this._def("event_elements", 'a,img', true);this._def("convert_urls", true);this._def("table_inline_editing", false);this._def("object_resizing", true);this._def("custom_shortcuts", true);this._def("convert_on_click", false);this._def("content_css", '');this._def("fix_list_elements", true);this._def("fix_table_elements", false);this._def("strict_loading_mode", document.contentType == 'application/xhtml+xml');this._def("hidden_tab_class", '');this._def("display_tab_class", '');this._def("gecko_spellcheck", false);this._def("hide_selects_on_submit", true);this._def("forced_root_block", false);this._def("remove_trailing_nbsp", false);if (this.isMSIE && !this.isOpera)this.settings.strict_loading_mode = false;if (this.isMSIE && this.settings.browsers.indexOf('msie') == -1)return;if (this.isGecko && this.settings.browsers.indexOf('gecko') == -1)return;if (this.isSafari && this.settings.browsers.indexOf('safari') == -1)return;if (this.isOpera && this.settings.browsers.indexOf('opera') == -1)return;baseHREF = tinyMCE.settings.document_base_url;h = document.location.href;p = h.indexOf('://');if (p > 0 && document.location.protocol != "file:") {p = h.indexOf('/', p + 3);h = h.substring(0, p);if (baseHREF.indexOf('://') == -1)baseHREF = h + baseHREF;tinyMCE.settings.document_base_url = baseHREF;tinyMCE.settings.document_base_prefix = h;}if (baseHREF.indexOf('?') != -1)baseHREF = baseHREF.substring(0, baseHREF.indexOf('?'));this.settings.base_href = baseHREF.substring(0, baseHREF.lastIndexOf('/')) + "/";theme = this.settings.theme;this.inlineStrict = 'A|BR|SPAN|BDO|MAP|OBJECT|IMG|TT|I|B|BIG|SMALL|EM|STRONG|DFN|CODE|Q|SAMP|KBD|VAR|CITE|ABBR|ACRONYM|SUB|SUP|#text|#comment';this.inlineTransitional = 'A|BR|SPAN|BDO|OBJECT|APPLET|IMG|MAP|IFRAME|TT|I|B|U|S|STRIKE|BIG|SMALL|FONT|BASEFONT|EM|STRONG|DFN|CODE|Q|SAMP|KBD|VAR|CITE|ABBR|ACRONYM|SUB|SUP|INPUT|SELECT|TEXTAREA|LABEL|BUTTON|#text|#comment';this.blockElms = 'H[1-6]|P|DIV|ADDRESS|PRE|FORM|TABLE|LI|OL|UL|TD|CAPTION|BLOCKQUOTE|CENTER|DL|DT|DD|DIR|FIELDSET|FORM|NOSCRIPT|NOFRAMES|MENU|ISINDEX|SAMP';this.blockRegExp = new RegExp("^(" + this.blockElms + ")$", "i");this.posKeyCodes = [13,45,36,35,33,34,37,38,39,40];this.uniqueURL = 'javascript:void(091039730);';this.uniqueTag = '<div id="mceTMPElement" style="display: none">TMP</div>';this.callbacks = ['onInit', 'getInfo', 'getEditorTemplate', 'setupContent', 'onChange', 'onPageLoad', 'handleNodeChange', 'initInstance', 'execCommand', 'getControlHTML', 'handleEvent', 'cleanup', 'removeInstance'];this.settings.theme_href = tinyMCE.baseURL + "/themes/" + theme;if (!tinyMCE.isIE || tinyMCE.isOpera)this.settings.force_br_newlines = false;if (tinyMCE.getParam("popups_css", false)) {cssPath = tinyMCE.getParam("popups_css", "");if (cssPath.indexOf('://') == -1 && cssPath.charAt(0) != '/')this.settings.popups_css = this.documentBasePath + "/" + cssPath;else
this.settings.popups_css = cssPath;} else
this.settings.popups_css = tinyMCE.baseURL + "/themes/" + theme + "/css/editor_popup.css";if (tinyMCE.getParam("editor_css", false)) {cssPath = tinyMCE.getParam("editor_css", "");if (cssPath.indexOf('://') == -1 && cssPath.charAt(0) != '/')this.settings.editor_css = this.documentBasePath + "/" + cssPath;else
this.settings.editor_css = cssPath;} else {if (this.settings.editor_css !== '')this.settings.editor_css = tinyMCE.baseURL + "/themes/" + theme + "/css/editor_ui.css";}if (this.configs.length == 0) {if (typeof(TinyMCECompressed) == "undefined") {tinyMCE.addEvent(window, "DOMContentLoaded", TinyMCE_Engine.prototype.onLoad);if (tinyMCE.isRealIE) {if (document.body)tinyMCE.addEvent(document.body, "readystatechange", TinyMCE_Engine.prototype.onLoad);else
tinyMCE.addEvent(document, "readystatechange", TinyMCE_Engine.prototype.onLoad);}tinyMCE.addEvent(window, "load", TinyMCE_Engine.prototype.onLoad);tinyMCE._addUnloadEvents();}}this.loadScript(tinyMCE.baseURL + '/themes/' + this.settings.theme + '/editor_template' + tinyMCE.srcMode + '.js');this.loadScript(tinyMCE.baseURL + '/langs/' + this.settings.language +  '.js');this.loadCSS(this.settings.editor_css);p = tinyMCE.getParam('plugins', '', true, ',');if (p.length > 0) {for (i=0; i<p.length; i++) {if (p[i].charAt(0) != '-')this.loadScript(tinyMCE.baseURL + '/plugins/' + p[i] + '/editor_plugin' + tinyMCE.srcMode + '.js');}}if (tinyMCE.getParam('entity_encoding') == 'named') {settings.cleanup_entities = [];entities = tinyMCE.getParam('entities', '', true, ',');for (i=0; i<entities.length; i+=2)settings.cleanup_entities['c' + entities[i]] = entities[i+1];}settings.index = this.configs.length;this.configs[this.configs.length] = settings;this.loadNextScript();if (this.isIE && !this.isOpera) {try {document.execCommand('BackgroundImageCache', false, true);} catch (e) {}}this.xmlEncodeRe = new RegExp('[<>&"]', 'g');},
_addUnloadEvents : function() {var st = tinyMCE.settings.add_unload_trigger;if (tinyMCE.isIE) {if (st) {tinyMCE.addEvent(window, "unload", TinyMCE_Engine.prototype.unloadHandler);tinyMCE.addEvent(window.document, "beforeunload", TinyMCE_Engine.prototype.unloadHandler);}} else {if (st)tinyMCE.addEvent(window, "unload", function () {tinyMCE.triggerSave(true, true);});}},
_def : function(key, def_val, t) {var v = tinyMCE.getParam(key, def_val);v = t ? v.replace(/\s+/g, "") : v;this.settings[key] = v;},
hasPlugin : function(n) {return typeof(this.plugins[n]) != "undefined" && this.plugins[n] != null;},
addPlugin : function(n, p) {var op = this.plugins[n];p.baseURL = op ? op.baseURL : tinyMCE.baseURL + "/plugins/" + n;this.plugins[n] = p;this.loadNextScript();},
setPluginBaseURL : function(n, u) {var op = this.plugins[n];if (op)op.baseURL = u;else
this.plugins[n] = {baseURL : u};},
loadPlugin : function(n, u) {u = u.indexOf('.js') != -1 ? u.substring(0, u.lastIndexOf('/')) : u;u = u.charAt(u.length-1) == '/' ? u.substring(0, u.length-1) : u;this.plugins[n] = {baseURL : u};this.loadScript(u + "/editor_plugin" + (tinyMCE.srcMode ? '_src' : '') + ".js");},
hasTheme : function(n) {return typeof(this.themes[n]) != "undefined" && this.themes[n] != null;},
addTheme : function(n, t) {this.themes[n] = t;this.loadNextScript();},
addMenu : function(n, m) {this.menus[n] = m;},
hasMenu : function(n) {return typeof(this.plugins[n]) != "undefined" && this.plugins[n] != null;},
loadScript : function(url) {var i;for (i=0; i<this.loadedFiles.length; i++) {if (this.loadedFiles[i] == url)return;}if (tinyMCE.settings.strict_loading_mode)this.pendingFiles[this.pendingFiles.length] = url;else
document.write('<sc'+'ript language="javascript" type="text/javascript" src="' + url + '"></script>');this.loadedFiles[this.loadedFiles.length] = url;},
loadNextScript : function() {var d = document, se;if (!tinyMCE.settings.strict_loading_mode)return;if (this.loadingIndex < this.pendingFiles.length) {se = d.createElementNS('http://www.w3.org/1999/xhtml', 'script');se.setAttribute('language', 'javascript');se.setAttribute('type', 'text/javascript');se.setAttribute('src', this.pendingFiles[this.loadingIndex++]);d.getElementsByTagName("head")[0].appendChild(se);} else
this.loadingIndex = -1;},
loadCSS : function(url) {var ar = url.replace(/\s+/, '').split(',');var lflen = 0, csslen = 0, skip = false;var x = 0, i = 0, nl, le;for (x = 0,csslen = ar.length; x<csslen; x++) {if (ar[x] != null && ar[x] != 'null' && ar[x].length > 0) {for (i=0, lflen=this.loadedFiles.length; i<lflen; i++) {if (this.loadedFiles[i] == ar[x]) {skip = true;break;}}if (!skip) {if (tinyMCE.settings.strict_loading_mode) {nl = document.getElementsByTagName("head");le = document.createElement('link');le.setAttribute('href', ar[x]);le.setAttribute('rel', 'stylesheet');le.setAttribute('type', 'text/css');nl[0].appendChild(le);			
} else
document.write('<link href="' + ar[x] + '" rel="stylesheet" type="text/css" />');this.loadedFiles[this.loadedFiles.length] = ar[x];}}}},
importCSS : function(doc, css) {var css_ary = css.replace(/\s+/, '').split(',');var csslen, elm, headArr, x, css_file;for (x = 0, csslen = css_ary.length; x<csslen; x++) {css_file = css_ary[x];if (css_file != null && css_file != 'null' && css_file.length > 0) {if (css_file.indexOf('://') == -1 && css_file.charAt(0) != '/')css_file = this.documentBasePath + "/" + css_file;if (typeof(doc.createStyleSheet) == "undefined") {elm = doc.createElement("link");elm.rel = "stylesheet";elm.href = css_file;if ((headArr = doc.getElementsByTagName("head")) != null && headArr.length > 0)headArr[0].appendChild(elm);} else
doc.createStyleSheet(css_file);}}},
confirmAdd : function(e, settings) {var elm = tinyMCE.isIE ? event.srcElement : e.target;var elementId = elm.name ? elm.name : elm.id;tinyMCE.settings = settings;if (tinyMCE.settings.convert_on_click || (!elm.getAttribute('mce_noask') && confirm(tinyMCELang.lang_edit_confirm)))tinyMCE.addMCEControl(elm, elementId);elm.setAttribute('mce_noask', 'true');},
updateContent : function(form_element_name) {var formElement, n, inst, doc;formElement = document.getElementById(form_element_name);for (n in tinyMCE.instances) {inst = tinyMCE.instances[n];if (!tinyMCE.isInstance(inst))continue;inst.switchSettings();if (inst.formElement == formElement) {doc = inst.getDoc();tinyMCE._setHTML(doc, inst.formElement.value);if (!tinyMCE.isIE)doc.body.innerHTML = tinyMCE._cleanupHTML(inst, doc, this.settings, doc.body, inst.visualAid);}}},
addMCEControl : function(replace_element, form_element_name, target_document) {var id = "mce_editor_" + tinyMCE.idCounter++;var inst = new TinyMCE_Control(tinyMCE.settings);inst.editorId = id;this.instances[id] = inst;inst._onAdd(replace_element, form_element_name, target_document);},
removeInstance : function(ti) {var t = [], n, i;for (n in tinyMCE.instances) {i = tinyMCE.instances[n];if (tinyMCE.isInstance(i) && ti != i)t[n] = i;}tinyMCE.instances = t;n = [];t = tinyMCE.undoLevels;for (i=0; i<t.length; i++) {if (t[i] != ti)n.push(t[i]);}tinyMCE.undoLevels = n;tinyMCE.undoIndex = n.length;tinyMCE.dispatchCallback(ti, 'remove_instance_callback', 'removeInstance', ti);return ti;},
removeMCEControl : function(editor_id) {var inst = tinyMCE.getInstanceById(editor_id), h, re, ot, tn;if (inst) {inst.switchSettings();editor_id = inst.editorId;h = tinyMCE.getContent(editor_id);this.removeInstance(inst);tinyMCE.selectedElement = null;tinyMCE.selectedInstance = null;re = document.getElementById(editor_id + "_parent");ot = inst.oldTargetElement;tn = ot.nodeName.toLowerCase();if (tn == "textarea" || tn == "input") {re.parentNode.removeChild(re);ot.style.display = "inline";ot.value = h;} else {ot.innerHTML = h;ot.style.display = 'block';re.parentNode.insertBefore(ot, re);re.parentNode.removeChild(re);}}},
triggerSave : function(skip_cleanup, skip_callback) {var inst, n;if (typeof(skip_cleanup) == "undefined")skip_cleanup = false;if (typeof(skip_callback) == "undefined")skip_callback = false;for (n in tinyMCE.instances) {inst = tinyMCE.instances[n];if (!tinyMCE.isInstance(inst))continue;inst.triggerSave(skip_cleanup, skip_callback);}},
resetForm : function(form_index) {var i, inst, n, formObj = document.forms[form_index];for (n in tinyMCE.instances) {inst = tinyMCE.instances[n];if (!tinyMCE.isInstance(inst))continue;inst.switchSettings();for (i=0; i<formObj.elements.length; i++) {if (inst.formTargetElementId == formObj.elements[i].name)inst.getBody().innerHTML = inst.startContent;}}},
execInstanceCommand : function(editor_id, command, user_interface, value, focus) {var inst = tinyMCE.getInstanceById(editor_id), r;if (inst) {r = inst.selection.getRng();if (typeof(focus) == "undefined")focus = true;if (focus && (!r || !r.item))inst.contentWindow.focus();inst.autoResetDesignMode();this.selectedElement = inst.getFocusElement();inst.select();tinyMCE.execCommand(command, user_interface, value);if (tinyMCE.isIE && window.event != null)tinyMCE.cancelEvent(window.event);}},
execCommand : function(command, user_interface, value) {var inst = tinyMCE.selectedInstance, n, pe, te;user_interface = user_interface ? user_interface : false;value = value ? value : null;if (inst)inst.switchSettings();switch (command) {case "Undo":if (this.getParam('custom_undo_redo_global')) {if (this.undoIndex > 0) {tinyMCE.nextUndoRedoAction = 'Undo';inst = this.undoLevels[--this.undoIndex];inst.select();if (!tinyMCE.nextUndoRedoInstanceId)inst.execCommand('Undo');}} else
inst.execCommand('Undo');return true;case "Redo":if (this.getParam('custom_undo_redo_global')) {if (this.undoIndex <= this.undoLevels.length - 1) {tinyMCE.nextUndoRedoAction = 'Redo';inst = this.undoLevels[this.undoIndex++];inst.select();if (!tinyMCE.nextUndoRedoInstanceId)inst.execCommand('Redo');}} else
inst.execCommand('Redo');return true;case 'mceFocus':inst = tinyMCE.getInstanceById(value);if (inst)inst.getWin().focus();return;case "mceAddControl":case "mceAddEditor":tinyMCE.addMCEControl(tinyMCE._getElementById(value), value);return;case "mceAddFrameControl":tinyMCE.addMCEControl(tinyMCE._getElementById(value.element, value.document), value.element, value.document);return;case "mceRemoveControl":case "mceRemoveEditor":tinyMCE.removeMCEControl(value);return;case "mceToggleEditor":inst = tinyMCE.getInstanceById(value);if (inst) {pe = document.getElementById(inst.editorId + '_parent');te = inst.oldTargetElement;if (typeof(inst.enabled) == 'undefined')inst.enabled = true;inst.enabled = !inst.enabled;if (!inst.enabled) {pe.style.display = 'none';if (te.nodeName == 'TEXTAREA' || te.nodeName == 'INPUT')te.value = inst.getHTML();else
te.innerHTML = inst.getHTML();te.style.display = inst.oldTargetDisplay;tinyMCE.dispatchCallback(inst, 'hide_instance_callback', 'hideInstance', inst);} else {pe.style.display = 'block';te.style.display = 'none';if (te.nodeName == 'TEXTAREA' || te.nodeName == 'INPUT')inst.setHTML(te.value);else
inst.setHTML(te.innerHTML);inst.useCSS = false;tinyMCE.dispatchCallback(inst, 'show_instance_callback', 'showInstance', inst);}} else
tinyMCE.addMCEControl(tinyMCE._getElementById(value), value);return;case "mceResetDesignMode":if (tinyMCE.isGecko) {for (n in tinyMCE.instances) {if (!tinyMCE.isInstance(tinyMCE.instances[n]))continue;try {tinyMCE.instances[n].getDoc().designMode = "off";tinyMCE.instances[n].getDoc().designMode = "on";tinyMCE.instances[n].useCSS = false;} catch (e) {}}}return;}if (inst) {inst.execCommand(command, user_interface, value);} else if (tinyMCE.settings.focus_alert)alert(tinyMCELang.lang_focus_alert);},
_createIFrame : function(replace_element, doc, win) {var iframe, id = replace_element.getAttribute("id");var aw, ah;if (typeof(doc) == "undefined")doc = document;if (typeof(win) == "undefined")win = window;iframe = doc.createElement("iframe");aw = "" + tinyMCE.settings.area_width;ah = "" + tinyMCE.settings.area_height;if (aw.indexOf('%') == -1) {aw = parseInt(aw);aw = (isNaN(aw) || aw < 0) ? 300 : aw;aw = aw + "px";}if (ah.indexOf('%') == -1) {ah = parseInt(ah);ah = (isNaN(ah) || ah < 0) ? 240 : ah;ah = ah + "px";}iframe.setAttribute("id", id);iframe.setAttribute("name", id);iframe.setAttribute("class", "mceEditorIframe");iframe.setAttribute("border", "0");iframe.setAttribute("frameBorder", "0");iframe.setAttribute("marginWidth", "0");iframe.setAttribute("marginHeight", "0");iframe.setAttribute("leftMargin", "0");iframe.setAttribute("topMargin", "0");iframe.setAttribute("width", aw);iframe.setAttribute("height", ah);iframe.setAttribute("allowtransparency", "true");iframe.className = 'mceEditorIframe';if (tinyMCE.settings.auto_resize)iframe.setAttribute("scrolling", "no");if (tinyMCE.isRealIE)iframe.setAttribute("src", this.settings.default_document);iframe.style.width = aw;iframe.style.height = ah;if (tinyMCE.settings.strict_loading_mode)iframe.style.marginBottom = '-5px';if (tinyMCE.isRealIE)replace_element.outerHTML = iframe.outerHTML;else
replace_element.parentNode.replaceChild(iframe, replace_element);if (tinyMCE.isRealIE)return win.frames[id];else
return iframe;},
setupContent : function(editor_id) {var inst = tinyMCE.instances[editor_id], i, doc = inst.getDoc(), head = doc.getElementsByTagName('head').item(0);var content = inst.startContent, contentElement, body;if (tinyMCE.settings.strict_loading_mode) {content = content.replace(/&lt;/g, '<');content = content.replace(/&gt;/g, '>');content = content.replace(/&quot;/g, '"');content = content.replace(/&amp;/g, '&');}tinyMCE.selectedInstance = inst;inst.switchSettings();if (!tinyMCE.isIE && tinyMCE.getParam("setupcontent_reload", false) && doc.title != "blank_page") {try {doc.location.href = tinyMCE.baseURL + "/blank.htm";} catch (ex) {}window.setTimeout("tinyMCE.setupContent('" + editor_id + "');", 1000);return;}if (!head || !doc.body) {window.setTimeout("tinyMCE.setupContent('" + editor_id + "');", 10);return;}tinyMCE.importCSS(inst.getDoc(), tinyMCE.baseURL + "/themes/" + inst.settings.theme + "/css/editor_content.css");tinyMCE.importCSS(inst.getDoc(), inst.settings.content_css);tinyMCE.dispatchCallback(inst, 'init_instance_callback', 'initInstance', inst);if (tinyMCE.getParam('custom_undo_redo_keyboard_shortcuts')) {inst.addShortcut('ctrl', 'z', 'lang_undo_desc', 'Undo');inst.addShortcut('ctrl', 'y', 'lang_redo_desc', 'Redo');}for (i=1; i<=6; i++)inst.addShortcut('ctrl', '' + i, '', 'FormatBlock', false, '<h' + i + '>');inst.addShortcut('ctrl', '7', '', 'FormatBlock', false, '<p>');inst.addShortcut('ctrl', '8', '', 'FormatBlock', false, '<div>');inst.addShortcut('ctrl', '9', '', 'FormatBlock', false, '<address>');if (tinyMCE.isGecko) {inst.addShortcut('ctrl', 'b', 'lang_bold_desc', 'Bold');inst.addShortcut('ctrl', 'i', 'lang_italic_desc', 'Italic');inst.addShortcut('ctrl', 'u', 'lang_underline_desc', 'Underline');}if (tinyMCE.getParam("convert_fonts_to_spans"))inst.getBody().setAttribute('id', 'mceSpanFonts');if (tinyMCE.settings.nowrap)doc.body.style.whiteSpace = "nowrap";doc.body.dir = this.settings.directionality;doc.editorId = editor_id;if (!tinyMCE.isIE)doc.documentElement.editorId = editor_id;inst.setBaseHREF(tinyMCE.settings.base_href);if (tinyMCE.settings.convert_newlines_to_brs) {content = tinyMCE.regexpReplace(content, "\r\n", "<br />", "gi");content = tinyMCE.regexpReplace(content, "\r", "<br />", "gi");content = tinyMCE.regexpReplace(content, "\n", "<br />", "gi");}content = tinyMCE.storeAwayURLs(content);content = tinyMCE._customCleanup(inst, "insert_to_editor", content);if (tinyMCE.isIE) {window.setInterval('try{tinyMCE.getCSSClasses(tinyMCE.instances["' + editor_id + '"].getDoc(), "' + editor_id + '");}catch(e){}', 500);if (tinyMCE.settings.force_br_newlines)doc.styleSheets[0].addRule("p", "margin: 0;");body = inst.getBody();body.editorId = editor_id;}content = tinyMCE.cleanupHTMLCode(content);if (!tinyMCE.isIE) {contentElement = inst.getDoc().createElement("body");doc = inst.getDoc();contentElement.innerHTML = content;if (tinyMCE.settings.cleanup_on_startup)tinyMCE.setInnerHTML(inst.getBody(), tinyMCE._cleanupHTML(inst, doc, this.settings, contentElement));else
tinyMCE.setInnerHTML(inst.getBody(), content);tinyMCE.convertAllRelativeURLs(inst.getBody());} else {if (tinyMCE.settings.cleanup_on_startup) {tinyMCE._setHTML(inst.getDoc(), content);try {tinyMCE.setInnerHTML(inst.getBody(), tinyMCE._cleanupHTML(inst, inst.contentDocument, this.settings, inst.getBody()));} catch(e) {}} else
tinyMCE._setHTML(inst.getDoc(), content);}tinyMCE.handleVisualAid(inst.getBody(), true, tinyMCE.settings.visual, inst);tinyMCE.dispatchCallback(inst, 'setupcontent_callback', 'setupContent', editor_id, inst.getBody(), inst.getDoc());if (!tinyMCE.isIE)tinyMCE.addEventHandlers(inst);if (tinyMCE.isIE) {tinyMCE.addEvent(inst.getBody(), "blur", TinyMCE_Engine.prototype._eventPatch);tinyMCE.addEvent(inst.getBody(), "beforedeactivate", TinyMCE_Engine.prototype._eventPatch);if (!tinyMCE.isOpera) {tinyMCE.addEvent(doc.body, "mousemove", TinyMCE_Engine.prototype.onMouseMove);tinyMCE.addEvent(doc.body, "beforepaste", TinyMCE_Engine.prototype._eventPatch);tinyMCE.addEvent(doc.body, "drop", TinyMCE_Engine.prototype._eventPatch);}}inst.select();tinyMCE.selectedElement = inst.contentWindow.document.body;tinyMCE._customCleanup(inst, "insert_to_editor_dom", inst.getBody());tinyMCE._customCleanup(inst, "setup_content_dom", inst.getBody());tinyMCE._setEventsEnabled(inst.getBody(), false);tinyMCE.cleanupAnchors(inst.getDoc());if (tinyMCE.getParam("convert_fonts_to_spans"))tinyMCE.convertSpansToFonts(inst.getDoc());inst.startContent = tinyMCE.trim(inst.getBody().innerHTML);inst.undoRedo.add({ content : inst.startContent });if (tinyMCE.isGecko) {tinyMCE.selectNodes(inst.getBody(), function(n) {if (n.nodeType == 3 || n.nodeType == 8)n.nodeValue = n.nodeValue.replace(new RegExp('\\s(mce_src|mce_href)=\"[^\"]*\"', 'gi'), "");return false;});}if (tinyMCE.isGecko)inst.getBody().spellcheck = tinyMCE.getParam("gecko_spellcheck");tinyMCE._removeInternal(inst.getBody());inst.select();tinyMCE.triggerNodeChange(false, true);},
storeAwayURLs : function(s) {if (!s.match(/(mce_src|mce_href)/gi, s)) {s = s.replace(new RegExp('src\\s*=\\s*\"([^ >\"]*)\"', 'gi'), 'src="$1" mce_src="$1"');s = s.replace(new RegExp('href\\s*=\\s*\"([^ >\"]*)\"', 'gi'), 'href="$1" mce_href="$1"');}return s;},
_removeInternal : function(n) {if (tinyMCE.isGecko) {tinyMCE.selectNodes(n, function(n) {if (n.nodeType == 3 || n.nodeType == 8)n.nodeValue = n.nodeValue.replace(new RegExp('\\s(mce_src|mce_href)=\"[^\"]*\"', 'gi'), "");return false;});}},
removeTinyMCEFormElements : function(form_obj) {var i, elementId;if (!tinyMCE.getParam('hide_selects_on_submit'))return;if (typeof(form_obj) == "undefined" || form_obj == null)return;if (form_obj.nodeName != "FORM") {if (form_obj.form)form_obj = form_obj.form;else
form_obj = tinyMCE.getParentElement(form_obj, "form");}if (form_obj == null)return;for (i=0; i<form_obj.elements.length; i++) {elementId = form_obj.elements[i].name ? form_obj.elements[i].name : form_obj.elements[i].id;if (elementId.indexOf('mce_editor_') == 0)form_obj.elements[i].disabled = true;}},
handleEvent : function(e) {var inst = tinyMCE.selectedInstance, i, elm, keys;if (typeof(tinyMCE) == "undefined")return true;if (tinyMCE.executeCallback(tinyMCE.selectedInstance, 'handle_event_callback', 'handleEvent', e))return false;switch (e.type) {case "beforedeactivate":case "blur":if (tinyMCE.selectedInstance)tinyMCE.selectedInstance.execCommand('mceEndTyping');tinyMCE.hideMenus();return;case "drop":case "beforepaste":if (tinyMCE.selectedInstance)tinyMCE.selectedInstance.setBaseHREF(null);if (tinyMCE.isRealIE) {var ife = tinyMCE.selectedInstance.iframeElement;if (ife.style.height.indexOf('%') != -1) {ife._oldHeight = ife.style.height;ife.style.height = ife.clientHeight;}}window.setTimeout("tinyMCE.selectedInstance.setBaseHREF(tinyMCE.settings.base_href);tinyMCE._resetIframeHeight();", 1);return;case "submit":tinyMCE.formSubmit(tinyMCE.isMSIE ? window.event.srcElement : e.target);return;case "reset":var formObj = tinyMCE.isIE ? window.event.srcElement : e.target;for (i=0; i<document.forms.length; i++) {if (document.forms[i] == formObj)window.setTimeout('tinyMCE.resetForm(' + i + ');', 10);}return;case "keypress":if (inst && inst.handleShortcut(e))return false;if (e.target.editorId) {tinyMCE.instances[e.target.editorId].select();} else {if (e.target.ownerDocument.editorId)tinyMCE.instances[e.target.ownerDocument.editorId].select();}if (tinyMCE.selectedInstance)tinyMCE.selectedInstance.switchSettings();if ((tinyMCE.isGecko || tinyMCE.isOpera || tinyMCE.isSafari) && tinyMCE.settings.force_p_newlines && e.keyCode == 13 && !e.shiftKey) {if (TinyMCE_ForceParagraphs._insertPara(tinyMCE.selectedInstance, e)) {tinyMCE.execCommand("mceAddUndoLevel");return tinyMCE.cancelEvent(e);}}if ((tinyMCE.isGecko && !tinyMCE.isSafari) && tinyMCE.settings.force_p_newlines && (e.keyCode == 8 || e.keyCode == 46) && !e.shiftKey) {if (TinyMCE_ForceParagraphs._handleBackSpace(tinyMCE.selectedInstance, e.type)) {tinyMCE.execCommand("mceAddUndoLevel");return tinyMCE.cancelEvent(e);}}if (tinyMCE.isIE && tinyMCE.settings.force_br_newlines && e.keyCode == 13) {if (e.target.editorId)tinyMCE.instances[e.target.editorId].select();if (tinyMCE.selectedInstance) {var sel = tinyMCE.selectedInstance.getDoc().selection;var rng = sel.createRange();if (tinyMCE.getParentElement(rng.parentElement(), "li") != null)return false;e.returnValue = false;e.cancelBubble = true;rng.pasteHTML("<br />");rng.collapse(false);rng.select();tinyMCE.execCommand("mceAddUndoLevel");tinyMCE.triggerNodeChange(false);return false;}}if (e.keyCode == 8 || e.keyCode == 46) {tinyMCE.selectedElement = e.target;tinyMCE.linkElement = tinyMCE.getParentElement(e.target, "a");tinyMCE.imgElement = tinyMCE.getParentElement(e.target, "img");tinyMCE.triggerNodeChange(false);}return false;case "keyup":case "keydown":tinyMCE.hideMenus();tinyMCE.hasMouseMoved = false;if (inst && inst.handleShortcut(e))return false;inst._fixRootBlocks();if (inst.settings.remove_trailing_nbsp)inst._fixTrailingNbsp();if (e.target.editorId)tinyMCE.instances[e.target.editorId].select();if (tinyMCE.selectedInstance)tinyMCE.selectedInstance.switchSettings();inst = tinyMCE.selectedInstance;if (tinyMCE.isGecko && tinyMCE.settings.force_p_newlines && (e.keyCode == 8 || e.keyCode == 46) && !e.shiftKey) {if (TinyMCE_ForceParagraphs._handleBackSpace(tinyMCE.selectedInstance, e.type)) {tinyMCE.execCommand("mceAddUndoLevel");e.preventDefault();return false;}}tinyMCE.selectedElement = null;tinyMCE.selectedNode = null;elm = tinyMCE.selectedInstance.getFocusElement();tinyMCE.linkElement = tinyMCE.getParentElement(elm, "a");tinyMCE.imgElement = tinyMCE.getParentElement(elm, "img");tinyMCE.selectedElement = elm;if (tinyMCE.isGecko && e.type == "keyup" && e.keyCode == 9)tinyMCE.handleVisualAid(tinyMCE.selectedInstance.getBody(), true, tinyMCE.settings.visual, tinyMCE.selectedInstance);if (tinyMCE.isIE && e.type == "keydown" && e.keyCode == 13)tinyMCE.enterKeyElement = tinyMCE.selectedInstance.getFocusElement();if (tinyMCE.isIE && e.type == "keyup" && e.keyCode == 13) {elm = tinyMCE.enterKeyElement;if (elm) {var re = new RegExp('^HR|IMG|BR$','g');var dre = new RegExp('^H[1-6]$','g');if (!elm.hasChildNodes() && !re.test(elm.nodeName)) {if (dre.test(elm.nodeName))elm.innerHTML = "&nbsp;&nbsp;";else
elm.innerHTML = "&nbsp;";}}}keys = tinyMCE.posKeyCodes;var posKey = false;for (i=0; i<keys.length; i++) {if (keys[i] == e.keyCode) {posKey = true;break;}}if (tinyMCE.isIE && tinyMCE.settings.custom_undo_redo) {keys = [8, 46];for (i=0; i<keys.length; i++) {if (keys[i] == e.keyCode) {if (e.type == "keyup")tinyMCE.triggerNodeChange(false);}}}if (e.keyCode == 17)return true;if (tinyMCE.isGecko) {if (!posKey && e.type == "keyup" && !e.ctrlKey || (e.ctrlKey && (e.keyCode == 86 || e.keyCode == 88)))tinyMCE.execCommand("mceStartTyping");} else {if (!posKey && e.type == "keyup")tinyMCE.execCommand("mceStartTyping");}if (e.type == "keydown" && (posKey || e.ctrlKey) && inst)inst.undoBookmark = inst.selection.getBookmark();if (e.type == "keyup" && (posKey || e.ctrlKey))tinyMCE.execCommand("mceEndTyping");if (posKey && e.type == "keyup")tinyMCE.triggerNodeChange(false);if (tinyMCE.isIE && e.ctrlKey)window.setTimeout('tinyMCE.triggerNodeChange(false);', 1);break;case "mousedown":case "mouseup":case "click":case "dblclick":case "focus":tinyMCE.hideMenus();if (tinyMCE.selectedInstance) {tinyMCE.selectedInstance.switchSettings();tinyMCE.selectedInstance.isFocused = true;}var targetBody = tinyMCE.getParentElement(e.target, "html");for (var instanceName in tinyMCE.instances) {if (!tinyMCE.isInstance(tinyMCE.instances[instanceName]))continue;inst = tinyMCE.instances[instanceName];inst.autoResetDesignMode();if (inst.getBody().parentNode == targetBody) {inst.select();tinyMCE.selectedElement = e.target;tinyMCE.linkElement = tinyMCE.getParentElement(tinyMCE.selectedElement, "a");tinyMCE.imgElement = tinyMCE.getParentElement(tinyMCE.selectedElement, "img");break;}}if (!tinyMCE.selectedInstance.undoRedo.undoLevels[0].bookmark && (e.type == "mouseup" || e.type == "dblclick"))tinyMCE.selectedInstance.undoRedo.undoLevels[0].bookmark = tinyMCE.selectedInstance.selection.getBookmark();if (e.type != "focus")tinyMCE.selectedNode = null;tinyMCE.triggerNodeChange(false);tinyMCE.execCommand("mceEndTyping");if (e.type == "mouseup")tinyMCE.execCommand("mceAddUndoLevel");if (!tinyMCE.selectedInstance && e.target.editorId)tinyMCE.instances[e.target.editorId].select();return false;}},
getButtonHTML : function(id, lang, img, cmd, ui, val) {var h = '', m, x, io = '';cmd = 'tinyMCE.execInstanceCommand(\'{$editor_id}\',\'' + cmd + '\'';if (typeof(ui) != "undefined" && ui != null)cmd += ',' + ui;if (typeof(val) != "undefined" && val != null)cmd += ",'" + val + "'";cmd += ');';if (tinyMCE.isRealIE)io = 'onmouseover="tinyMCE.lastHover = this;"';if (tinyMCE.getParam('button_tile_map') && (!tinyMCE.isIE || tinyMCE.isOpera) && (m = this.buttonMap[id]) != null && (tinyMCE.getParam("language") == "en" || img.indexOf('$lang') == -1)) {x = 0 - (m * 20) == 0 ? '0' : 0 - (m * 20);h += '<a id="{$editor_id}_' + id + '" href="javascript:' + cmd + '" onclick="' + cmd + 'return false;" onmousedown="return false;" ' + io + ' class="mceTiledButton mceButtonNormal" target="_self">';h += '<img src="{$themeurl}/images/spacer.gif" style="background-position: ' + x + 'px 0" alt="{$'+lang+'}" title="{$' + lang + '}" />';h += '</a>';} else {h += '<a id="{$editor_id}_' + id + '" href="javascript:' + cmd + '" onclick="' + cmd + 'return false;" onmousedown="return false;" ' + io + ' class="mceButtonNormal" target="_self">';h += '<img src="' + img + '" alt="{$'+lang+'}" title="{$' + lang + '}" />';h += '</a>';}return h;},
getMenuButtonHTML : function(id, lang, img, mcmd, cmd, ui, val) {var h = '', m, x;mcmd = 'tinyMCE.execInstanceCommand(\'{$editor_id}\',\'' + mcmd + '\');';cmd = 'tinyMCE.execInstanceCommand(\'{$editor_id}\',\'' + cmd + '\'';if (typeof(ui) != "undefined" && ui != null)cmd += ',' + ui;if (typeof(val) != "undefined" && val != null)cmd += ",'" + val + "'";cmd += ');';if (tinyMCE.getParam('button_tile_map') && (!tinyMCE.isIE || tinyMCE.isOpera) && (m = tinyMCE.buttonMap[id]) != null && (tinyMCE.getParam("language") == "en" || img.indexOf('$lang') == -1)) {x = 0 - (m * 20) == 0 ? '0' : 0 - (m * 20);if (tinyMCE.isRealIE)h += '<span id="{$editor_id}_' + id + '" class="mceMenuButton" onmouseover="tinyMCE._menuButtonEvent(\'over\',this);tinyMCE.lastHover = this;" onmouseout="tinyMCE._menuButtonEvent(\'out\',this);">';else
h += '<span id="{$editor_id}_' + id + '" class="mceMenuButton">';h += '<a href="javascript:' + cmd + '" onclick="' + cmd + 'return false;" onmousedown="return false;" class="mceTiledButton mceMenuButtonNormal" target="_self">';h += '<img src="{$themeurl}/images/spacer.gif" style="width: 20px; height: 20px; background-position: ' + x + 'px 0" title="{$' + lang + '}" /></a>';h += '<a href="javascript:' + mcmd + '" onclick="' + mcmd + 'return false;" onmousedown="return false;"><img src="{$themeurl}/images/button_menu.gif" title="{$' + lang + '}" class="mceMenuButton" />';h += '</a></span>';} else {if (tinyMCE.isRealIE)h += '<span id="{$editor_id}_' + id + '" dir="ltr" class="mceMenuButton" onmouseover="tinyMCE._menuButtonEvent(\'over\',this);tinyMCE.lastHover = this;" onmouseout="tinyMCE._menuButtonEvent(\'out\',this);">';else
h += '<span id="{$editor_id}_' + id + '" dir="ltr" class="mceMenuButton">';h += '<a href="javascript:' + cmd + '" onclick="' + cmd + 'return false;" onmousedown="return false;" class="mceMenuButtonNormal" target="_self">';h += '<img src="' + img + '" title="{$' + lang + '}" /></a>';h += '<a href="javascript:' + mcmd + '" onclick="' + mcmd + 'return false;" onmousedown="return false;"><img src="{$themeurl}/images/button_menu.gif" title="{$' + lang + '}" class="mceMenuButton" />';h += '</a></span>';}return h;},
_menuButtonEvent : function(e, o) {if (o.className == 'mceMenuButtonFocus')return;if (e == 'over')o.className = o.className + ' mceMenuHover';else
o.className = o.className.replace(/\s.*$/, '');},
addButtonMap : function(m) {var i, a = m.replace(/\s+/, '').split(',');for (i=0; i<a.length; i++)this.buttonMap[a[i]] = i;},
formSubmit : function(f, p) {var n, inst, found = false;if (f.form)f = f.form;for (n in tinyMCE.instances) {inst = tinyMCE.instances[n];if (!tinyMCE.isInstance(inst))continue;if (inst.formElement) {if (f == inst.formElement.form) {found = true;inst.isNotDirty = true;}}}if (found) {tinyMCE.removeTinyMCEFormElements(f);tinyMCE.triggerSave();}if (f.mceOldSubmit && p)f.mceOldSubmit();},
submitPatch : function() {tinyMCE.formSubmit(this, true);},
onLoad : function() {var r, i, c, mode, trigger, elements, element, settings, elementId, elm;var selector, deselector, elementRefAr, form;if (tinyMCE.settings.strict_loading_mode && this.loadingIndex != -1) {window.setTimeout('tinyMCE.onLoad();', 1);return;}if (tinyMCE.isRealIE && window.event.type == "readystatechange" && document.readyState != "complete")return true;if (tinyMCE.isLoaded)return true;tinyMCE.isLoaded = true;if (tinyMCE.isRealIE && document.body && window.location.href != window.top.location.href) {r = document.body.createTextRange();r.collapse(true);r.select();}tinyMCE.dispatchCallback(null, 'onpageload', 'onPageLoad');for (c=0; c<tinyMCE.configs.length; c++) {tinyMCE.settings = tinyMCE.configs[c];selector = tinyMCE.getParam("editor_selector");deselector = tinyMCE.getParam("editor_deselector");elementRefAr = [];if (document.forms && tinyMCE.settings.add_form_submit_trigger && !tinyMCE.submitTriggers) {for (i=0; i<document.forms.length; i++) {form = document.forms[i];tinyMCE.addEvent(form, "submit", TinyMCE_Engine.prototype.handleEvent);tinyMCE.addEvent(form, "reset", TinyMCE_Engine.prototype.handleEvent);tinyMCE.submitTriggers = true;if (tinyMCE.settings.submit_patch) {try {form.mceOldSubmit = form.submit;form.submit = TinyMCE_Engine.prototype.submitPatch;} catch (e) {}}}}mode = tinyMCE.settings.mode;switch (mode) {case "exact":elements = tinyMCE.getParam('elements', '', true, ',');for (i=0; i<elements.length; i++) {element = tinyMCE._getElementById(elements[i]);trigger = element ? element.getAttribute(tinyMCE.settings.textarea_trigger) : "";if (new RegExp('\\b' + deselector + '\\b').test(tinyMCE.getAttrib(element, "class")))continue;if (trigger == "false")continue;if ((tinyMCE.settings.ask || tinyMCE.settings.convert_on_click) && element) {elementRefAr[elementRefAr.length] = element;continue;}if (element)tinyMCE.addMCEControl(element, elements[i]);}break;case "specific_textareas":case "textareas":elements = document.getElementsByTagName("textarea");for (i=0; i<elements.length; i++) {elm = elements.item(i);trigger = elm.getAttribute(tinyMCE.settings.textarea_trigger);if (selector !== '' && !new RegExp('\\b' + selector + '\\b').test(tinyMCE.getAttrib(elm, "class")))continue;if (selector !== '')trigger = selector !== '' ? "true" : "";if (new RegExp('\\b' + deselector + '\\b').test(tinyMCE.getAttrib(elm, "class")))continue;if ((mode == "specific_textareas" && trigger == "true") || (mode == "textareas" && trigger != "false"))elementRefAr[elementRefAr.length] = elm;}break;}for (i=0; i<elementRefAr.length; i++) {element = elementRefAr[i];elementId = element.name ? element.name : element.id;if (tinyMCE.settings.ask || tinyMCE.settings.convert_on_click) {if (tinyMCE.isGecko) {settings = tinyMCE.settings;tinyMCE.addEvent(element, "focus", function (e) {window.setTimeout(function() {TinyMCE_Engine.prototype.confirmAdd(e, settings);}, 10);});if (element.nodeName != "TEXTAREA" && element.nodeName != "INPUT")tinyMCE.addEvent(element, "click", function (e) {window.setTimeout(function() {TinyMCE_Engine.prototype.confirmAdd(e, settings);}, 10);});} else {settings = tinyMCE.settings;tinyMCE.addEvent(element, "focus", function () { TinyMCE_Engine.prototype.confirmAdd(null, settings); });tinyMCE.addEvent(element, "click", function () { TinyMCE_Engine.prototype.confirmAdd(null, settings); });}} else
tinyMCE.addMCEControl(element, elementId);}if (tinyMCE.settings.auto_focus) {window.setTimeout(function () {var inst = tinyMCE.getInstanceById(tinyMCE.settings.auto_focus);inst.selection.selectNode(inst.getBody(), true, true);inst.contentWindow.focus();}, 100);}tinyMCE.dispatchCallback(null, 'oninit', 'onInit');}},
isInstance : function(o) {return o != null && typeof(o) == "object" && o.isTinyMCE_Control;},
getParam : function(name, default_value, strip_whitespace, split_chr) {var i, outArray, value = (typeof(this.settings[name]) == "undefined") ? default_value : this.settings[name];if (value == "true" || value == "false")return (value == "true");if (strip_whitespace)value = tinyMCE.regexpReplace(value, "[ \t\r\n]", "");if (typeof(split_chr) != "undefined" && split_chr != null) {value = value.split(split_chr);outArray = [];for (i=0; i<value.length; i++) {if (value[i] && value[i] !== '')outArray[outArray.length] = value[i];}value = outArray;}return value;},
getLang : function(name, default_value, parse_entities, va) {var v = (typeof(tinyMCELang[name]) == "undefined") ? default_value : tinyMCELang[name], n;if (parse_entities)v = tinyMCE.entityDecode(v);if (va) {for (n in va)v = this.replaceVar(v, n, va[n]);}return v;},
entityDecode : function(s) {var e = document.createElement("div");e.innerHTML = s;return !e.firstChild ? s : e.firstChild.nodeValue;},
addToLang : function(prefix, ar) {var k;for (k in ar) {if (typeof(ar[k]) == 'function')continue;tinyMCELang[(k.indexOf('lang_') == -1 ? 'lang_' : '') + (prefix !== '' ? (prefix + "_") : '') + k] = ar[k];}this.loadNextScript();},
triggerNodeChange : function(focus, setup_content) {var elm, inst, editorId, undoIndex = -1, undoLevels = -1, doc, anySelection = false, st;if (tinyMCE.selectedInstance) {inst = tinyMCE.selectedInstance;elm = (typeof(setup_content) != "undefined" && setup_content) ? tinyMCE.selectedElement : inst.getFocusElement();editorId = inst.editorId;st = inst.selection.getSelectedText();if (tinyMCE.settings.auto_resize)inst.resizeToContent();if (setup_content && tinyMCE.isGecko && inst.isHidden())elm = inst.getBody();inst.switchSettings();if (tinyMCE.selectedElement)anySelection = (tinyMCE.selectedElement.nodeName.toLowerCase() == "img") || (st && st.length > 0);if (tinyMCE.settings.custom_undo_redo) {undoIndex = inst.undoRedo.undoIndex;undoLevels = inst.undoRedo.undoLevels.length;}tinyMCE.dispatchCallback(inst, 'handle_node_change_callback', 'handleNodeChange', editorId, elm, undoIndex, undoLevels, inst.visualAid, anySelection, setup_content);}if (this.selectedInstance && (typeof(focus) == "undefined" || focus))this.selectedInstance.contentWindow.focus();},
_customCleanup : function(inst, type, content) {var pl, po, i, customCleanup;customCleanup = tinyMCE.settings.cleanup_callback;if (customCleanup != '')content = tinyMCE.resolveDots(tinyMCE.settings.cleanup_callback, window)(type, content, inst);po = tinyMCE.themes[tinyMCE.settings.theme];if (po && po.cleanup)content = po.cleanup(type, content, inst);pl = inst.plugins;for (i=0; i<pl.length; i++) {po = tinyMCE.plugins[pl[i]];if (po && po.cleanup)content = po.cleanup(type, content, inst);}return content;},
setContent : function(h) {if (tinyMCE.selectedInstance) {tinyMCE.selectedInstance.execCommand('mceSetContent', false, h);tinyMCE.selectedInstance.repaint();}},
importThemeLanguagePack : function(name) {if (typeof(name) == "undefined")name = tinyMCE.settings.theme;tinyMCE.loadScript(tinyMCE.baseURL + '/themes/' + name + '/langs/' + tinyMCE.settings.language + '.js');},
importPluginLanguagePack : function(name) {var b = tinyMCE.baseURL + '/plugins/' + name;if (this.plugins[name])b = this.plugins[name].baseURL;tinyMCE.loadScript(b + '/langs/' + tinyMCE.settings.language +  '.js');},
applyTemplate : function(h, ag) {return h.replace(new RegExp('\\{\\$([a-z0-9_]+)\\}', 'gi'), function(m, s) {if (s.indexOf('lang_') == 0 && tinyMCELang[s])return tinyMCELang[s];if (ag && ag[s])return ag[s];if (tinyMCE.settings[s])return tinyMCE.settings[s];if (m == 'themeurl')return tinyMCE.themeURL;return m;});},
replaceVar : function(h, r, v) {return h.replace(new RegExp('{\\\$' + r + '}', 'g'), v);},
openWindow : function(template, args) {var html, width, height, x, y, resizable, scrollbars, url, name, win, modal, features;args = !args ? {} : args;args.mce_template_file = template.file;args.mce_width = template.width;args.mce_height = template.height;tinyMCE.windowArgs = args;html = template.html;if (!(width = parseInt(template.width)))width = 320;if (!(height = parseInt(template.height)))height = 200;if (tinyMCE.isIE)height += 40;else
height += 20;x = parseInt(screen.width / 2.0) - (width / 2.0);y = parseInt(screen.height / 2.0) - (height / 2.0);resizable = (args && args.resizable) ? args.resizable : "no";scrollbars = (args && args.scrollbars) ? args.scrollbars : "no";if (template.file.charAt(0) != '/' && template.file.indexOf('://') == -1)url = tinyMCE.baseURL + "/themes/" + tinyMCE.getParam("theme") + "/" + template.file;else
url = template.file;for (name in args) {if (typeof(args[name]) == 'function')continue;url = tinyMCE.replaceVar(url, name, escape(args[name]));}if (html) {html = tinyMCE.replaceVar(html, "css", this.settings.popups_css);html = tinyMCE.applyTemplate(html, args);win = window.open("", "mcePopup" + new Date().getTime(), "top=" + y + ",left=" + x + ",scrollbars=" + scrollbars + ",dialog=yes,minimizable=" + resizable + ",modal=yes,width=" + width + ",height=" + height + ",resizable=" + resizable);if (win == null) {alert(tinyMCELang.lang_popup_blocked);return;}win.document.write(html);win.document.close();win.resizeTo(width, height);win.focus();} else {if ((tinyMCE.isRealIE) && resizable != 'yes' && tinyMCE.settings.dialog_type == "modal") {height += 10;features = "resizable:" + resizable + ";scroll:" + scrollbars + ";status:yes;center:yes;help:no;dialogWidth:" + width + "px;dialogHeight:" + height + "px;";window.showModalDialog(url, window, features);} else {modal = (resizable == "yes") ? "no" : "yes";if (tinyMCE.isGecko && tinyMCE.isMac)modal = "no";if (template.close_previous != "no")try {tinyMCE.lastWindow.close();} catch (ex) {}win = window.open(url, "mcePopup" + new Date().getTime(), "top=" + y + ",left=" + x + ",scrollbars=" + scrollbars + ",dialog=" + modal + ",minimizable=" + resizable + ",modal=" + modal + ",width=" + width + ",height=" + height + ",resizable=" + resizable);if (win == null) {alert(tinyMCELang.lang_popup_blocked);return;}if (template.close_previous != "no")tinyMCE.lastWindow = win;try {win.resizeTo(width, height);} catch(e) {}if (tinyMCE.isGecko) {if (win.document.defaultView.statusbar.visible)win.resizeBy(0, tinyMCE.isMac ? 10 : 24);}win.focus();}}},
closeWindow : function(win) {win.close();},
getVisualAidClass : function(class_name, state) {var i, classNames, ar, className, aidClass = tinyMCE.settings.visual_table_class;if (typeof(state) == "undefined")state = tinyMCE.settings.visual;classNames = [];ar = class_name.split(' ');for (i=0; i<ar.length; i++) {if (ar[i] == aidClass)ar[i] = "";if (ar[i] !== '')classNames[classNames.length] = ar[i];}if (state)classNames[classNames.length] = aidClass;className = "";for (i=0; i<classNames.length; i++) {if (i > 0)className += " ";className += classNames[i];}return className;},
handleVisualAid : function(el, deep, state, inst, skip_dispatch) {var i, x, y, tableElement, anchorName, oldW, oldH, bo, cn;if (!el)return;if (!skip_dispatch)tinyMCE.dispatchCallback(inst, 'handle_visual_aid_callback', 'handleVisualAid', el, deep, state, inst);tableElement = null;switch (el.nodeName) {case "TABLE":oldW = el.style.width;oldH = el.style.height;bo = tinyMCE.getAttrib(el, "border");bo = bo == '' || bo == "0" ? true : false;tinyMCE.setAttrib(el, "class", tinyMCE.getVisualAidClass(tinyMCE.getAttrib(el, "class"), state && bo));el.style.width = oldW;el.style.height = oldH;for (y=0; y<el.rows.length; y++) {for (x=0; x<el.rows[y].cells.length; x++) {cn = tinyMCE.getVisualAidClass(tinyMCE.getAttrib(el.rows[y].cells[x], "class"), state && bo);tinyMCE.setAttrib(el.rows[y].cells[x], "class", cn);}}break;case "A":anchorName = tinyMCE.getAttrib(el, "name");if (anchorName !== '' && state) {el.title = anchorName;tinyMCE.addCSSClass(el, 'mceItemAnchor');} else if (anchorName !== '' && !state)el.className = '';break;}if (deep && el.hasChildNodes()) {for (i=0; i<el.childNodes.length; i++)tinyMCE.handleVisualAid(el.childNodes[i], deep, state, inst, true);}},
fixGeckoBaseHREFBug : function(m, e, h) {var xsrc, xhref;if (tinyMCE.isGecko) {if (m == 1) {h = h.replace(/\ssrc=/gi, " mce_tsrc=");h = h.replace(/\shref=/gi, " mce_thref=");return h;} else {if (!new RegExp('(src|href)=', 'g').test(h))return h;tinyMCE.selectElements(e, 'A,IMG,SELECT,AREA,IFRAME,BASE,INPUT,SCRIPT,EMBED,OBJECT,LINK', function (n) {xsrc = tinyMCE.getAttrib(n, "mce_tsrc");xhref = tinyMCE.getAttrib(n, "mce_thref");if (xsrc !== '') {try {n.src = tinyMCE.convertRelativeToAbsoluteURL(tinyMCE.settings.base_href, xsrc);} catch (e) {}n.removeAttribute("mce_tsrc");}if (xhref !== '') {try {n.href = tinyMCE.convertRelativeToAbsoluteURL(tinyMCE.settings.base_href, xhref);} catch (e) {}n.removeAttribute("mce_thref");}return false;});tinyMCE.selectNodes(e, function(n) {if (n.nodeType == 3 || n.nodeType == 8) {n.nodeValue = n.nodeValue.replace(/\smce_tsrc=/gi, " src=");n.nodeValue = n.nodeValue.replace(/\smce_thref=/gi, " href=");}return false;});}}return h;},
_setHTML : function(doc, html_content) {var i, html, paras, node;html_content = tinyMCE.cleanupHTMLCode(html_content);try {tinyMCE.setInnerHTML(doc.body, html_content);} catch (e) {if (this.isMSIE)doc.body.createTextRange().pasteHTML(html_content);}if (tinyMCE.isIE && tinyMCE.settings.fix_content_duplication) {paras = doc.getElementsByTagName("P");for (i=0; i<paras.length; i++) {node = paras[i];while ((node = node.parentNode) != null) {if (node.nodeName == "P")node.outerHTML = node.innerHTML;}}html = doc.body.innerHTML;tinyMCE.setInnerHTML(doc.body, html);}tinyMCE.cleanupAnchors(doc);if (tinyMCE.getParam("convert_fonts_to_spans"))tinyMCE.convertSpansToFonts(doc);},
getEditorId : function(form_element) {var inst = this.getInstanceById(form_element);if (!inst)return null;return inst.editorId;},
getInstanceById : function(editor_id) {var inst = this.instances[editor_id], n;if (!inst) {for (n in tinyMCE.instances) {inst = tinyMCE.instances[n];if (!tinyMCE.isInstance(inst))continue;if (inst.formTargetElementId == editor_id)return inst;}} else
return inst;return null;},
queryInstanceCommandValue : function(editor_id, command) {var inst = tinyMCE.getInstanceById(editor_id);if (inst)return inst.queryCommandValue(command);return false;},
queryInstanceCommandState : function(editor_id, command) {var inst = tinyMCE.getInstanceById(editor_id);if (inst)return inst.queryCommandState(command);return null;},
setWindowArg : function(n, v) {this.windowArgs[n] = v;},
getWindowArg : function(n, d) {return (typeof(this.windowArgs[n]) == "undefined") ? d : this.windowArgs[n];},
getCSSClasses : function(editor_id, doc) {var i, c, x, rule, styles, rules, csses, selectorText, inst = tinyMCE.getInstanceById(editor_id);var cssClass, addClass, p;if (!inst)inst = tinyMCE.selectedInstance;if (!inst)return [];if (!doc)doc = inst.getDoc();if (inst && inst.cssClasses.length > 0)return inst.cssClasses;if (!doc)return;styles = doc.styleSheets;if (styles && styles.length > 0) {for (x=0; x<styles.length; x++) {csses = null;try {csses = tinyMCE.isIE ? doc.styleSheets(x).rules : styles[x].cssRules;} catch(e) {}if (!csses)return [];for (i=0; i<csses.length; i++) {selectorText = csses[i].selectorText;if (selectorText) {rules = selectorText.split(',');for (c=0; c<rules.length; c++) {rule = rules[c];while (rule.indexOf(' ') == 0)rule = rule.substring(1);if (rule.indexOf(' ') != -1 || rule.indexOf(':') != -1 || rule.indexOf('mceItem') != -1)continue;if (rule.indexOf(tinyMCE.settings.visual_table_class) != -1 || rule.indexOf('mceEditable') != -1 || rule.indexOf('mceNonEditable') != -1)continue;if (rule.indexOf('.') != -1) {cssClass = rule.substring(rule.indexOf('.') + 1);addClass = true;for (p=0; p<inst.cssClasses.length && addClass; p++) {if (inst.cssClasses[p] == cssClass)addClass = false;}if (addClass)inst.cssClasses[inst.cssClasses.length] = cssClass;}}}}}}return inst.cssClasses;},
regexpReplace : function(in_str, reg_exp, replace_str, opts) {var re;if (in_str == null)return in_str;if (typeof(opts) == "undefined")opts = 'g';re = new RegExp(reg_exp, opts);return in_str.replace(re, replace_str);},
trim : function(s) {return s.replace(/^\s*|\s*$/g, "");},
cleanupEventStr : function(s) {s = "" + s;s = s.replace('function anonymous()\n{\n', '');s = s.replace('\n}', '');s = s.replace(/^return true;/gi, '');return s;},
getControlHTML : function(c) {var i, l, n, o, v, rtl = tinyMCE.getLang('lang_dir') == 'rtl';l = tinyMCE.plugins;for (n in l) {o = l[n];if (o.getControlHTML && (v = o.getControlHTML(c)) !== '') {if (rtl)return '<span dir="rtl">' + tinyMCE.replaceVar(v, "pluginurl", o.baseURL) + '</span>';return tinyMCE.replaceVar(v, "pluginurl", o.baseURL);}}o = tinyMCE.themes[tinyMCE.settings.theme];if (o.getControlHTML && (v = o.getControlHTML(c)) !== '') {if (rtl)return '<span dir="rtl">' + v + '</span>';return v;}return '';},
evalFunc : function(f, idx, a, o) {o = !o ? window : o;f = typeof(f) == 'function' ? f : o[f];return f.apply(o, Array.prototype.slice.call(a, idx));},
dispatchCallback : function(i, p, n) {return this.callFunc(i, p, n, 0, this.dispatchCallback.arguments);},
executeCallback : function(i, p, n) {return this.callFunc(i, p, n, 1, this.executeCallback.arguments);},
execCommandCallback : function(i, p, n) {return this.callFunc(i, p, n, 2, this.execCommandCallback.arguments);},
callFunc : function(ins, p, n, m, a) {var l, i, on, o, s, v;s = m == 2;l = tinyMCE.getParam(p, '');if (l !== '' && (v = tinyMCE.evalFunc(l, 3, a)) == s && m > 0)return true;if (ins != null) {for (i=0, l = ins.plugins; i<l.length; i++) {o = tinyMCE.plugins[l[i]];if (o[n] && (v = tinyMCE.evalFunc(n, 3, a, o)) == s && m > 0)return true;}}l = tinyMCE.themes;for (on in l) {o = l[on];if (o[n] && (v = tinyMCE.evalFunc(n, 3, a, o)) == s && m > 0)return true;}return false;},
resolveDots : function(s, o) {var i;if (typeof(s) == 'string') {for (i=0, s=s.split('.'); i<s.length; i++)o = o[s[i]];} else
o = s;return o;},
xmlEncode : function(s) {return s ? ('' + s).replace(this.xmlEncodeRe, function (c, b) {switch (c) {case '&':return '&amp;';case '"':return '&quot;';case '<':return '&lt;';case '>':return '&gt;';}return c;}) : s;},
add : function(c, m) {var n;for (n in m)c.prototype[n] = m[n];},
extend : function(p, np) {var o = {}, n;o.parent = p;for (n in p)o[n] = p[n];for (n in np)o[n] = np[n];return o;},
hideMenus : function() {var e = tinyMCE.lastSelectedMenuBtn;if (tinyMCE.lastMenu) {tinyMCE.lastMenu.hide();tinyMCE.lastMenu = null;}if (e) {tinyMCE.switchClass(e, tinyMCE.lastMenuBtnClass);tinyMCE.lastSelectedMenuBtn = null;}}};var TinyMCE = TinyMCE_Engine;var tinyMCE = new TinyMCE_Engine();var tinyMCELang = {};function TinyMCE_Control(settings) {var t, i, tos, fu, p, x, fn, fu, pn, s = settings;this.undoRedoLevel = true;this.isTinyMCE_Control = true;this.enabled = true;this.settings = s;this.settings.theme = tinyMCE.getParam("theme", "default");this.settings.width = tinyMCE.getParam("width", -1);this.settings.height = tinyMCE.getParam("height", -1);this.selection = new TinyMCE_Selection(this);this.undoRedo = new TinyMCE_UndoRedo(this);this.cleanup = new TinyMCE_Cleanup();this.shortcuts = [];this.hasMouseMoved = false;this.foreColor = this.backColor = "#999999";this.data = {};this.cssClasses = [];this.cleanup.init({valid_elements : s.valid_elements,
extended_valid_elements : s.extended_valid_elements,
valid_child_elements : s.valid_child_elements,
entities : s.entities,
entity_encoding : s.entity_encoding,
debug : s.cleanup_debug,
indent : s.apply_source_formatting,
invalid_elements : s.invalid_elements,
verify_html : s.verify_html,
fix_content_duplication : s.fix_content_duplication,
convert_fonts_to_spans : s.convert_fonts_to_spans
});t = this.settings.theme;if (!tinyMCE.hasTheme(t)) {fn = tinyMCE.callbacks;tos = {};for (i=0; i<fn.length; i++) {if ((fu = window['TinyMCE_' + t + "_" + fn[i]]))tos[fn[i]] = fu;}tinyMCE.addTheme(t, tos);}this.plugins = [];p = tinyMCE.getParam('plugins', '', true, ',');if (p.length > 0) {for (i=0; i<p.length; i++) {pn = p[i];if (pn.charAt(0) == '-')pn = pn.substring(1);if (!tinyMCE.hasPlugin(pn)) {fn = tinyMCE.callbacks;tos = {};for (x=0; x<fn.length; x++) {if ((fu = window['TinyMCE_' + pn + "_" + fn[x]]))tos[fn[x]] = fu;}tinyMCE.addPlugin(pn, tos);}this.plugins[this.plugins.length] = pn; 
}}};TinyMCE_Control.prototype = {selection : null,
settings : null,
cleanup : null,
getData : function(na) {var o = this.data[na];if (!o)o = this.data[na] = {};return o;},
hasPlugin : function(n) {var i;for (i=0; i<this.plugins.length; i++) {if (this.plugins[i] == n)return true;}return false;},
addPlugin : function(n, p) {if (!this.hasPlugin(n)) {tinyMCE.addPlugin(n, p);this.plugins[this.plugins.length] = n;}},
repaint : function() {var s, b, ex;if (tinyMCE.isRealIE)return;try {s = this.selection;b = s.getBookmark(true);this.getBody().style.display = 'none';this.getDoc().execCommand('selectall', false, null);this.getSel().collapseToStart();this.getBody().style.display = 'block';s.moveToBookmark(b);} catch (ex) {}},
switchSettings : function() {if (tinyMCE.configs.length > 1 && tinyMCE.currentConfig != this.settings.index) {tinyMCE.settings = this.settings;tinyMCE.currentConfig = this.settings.index;}},
select : function() {var oldInst = tinyMCE.selectedInstance;if (oldInst != this) {if (oldInst)oldInst.execCommand('mceEndTyping');tinyMCE.dispatchCallback(this, 'select_instance_callback', 'selectInstance', this, oldInst);tinyMCE.selectedInstance = this;}},
getBody : function() {return this.contentBody ? this.contentBody : this.getDoc().body;},
getDoc : function() {return this.contentWindow.document;},
getWin : function() {return this.contentWindow;},
getContainerWin : function() {return this.containerWindow ? this.containerWindow : window;},
getViewPort : function() {return tinyMCE.getViewPort(this.getWin());},
getParentNode : function(n, f) {return tinyMCE.getParentNode(n, f, this.getBody());},
getParentElement : function(n, na, f) {return tinyMCE.getParentElement(n, na, f, this.getBody());},
getParentBlockElement : function(n) {return tinyMCE.getParentBlockElement(n, this.getBody());},
resizeToContent : function() {var d = this.getDoc(), b = d.body, de = d.documentElement;this.iframeElement.style.height = (tinyMCE.isRealIE) ? b.scrollHeight : de.offsetHeight + 'px';},
addShortcut : function(m, k, d, cmd, ui, va) {var n = typeof(k) == "number", ie = tinyMCE.isIE, c, sc, i, scl = this.shortcuts;if (!tinyMCE.getParam('custom_shortcuts'))return false;m = m.toLowerCase();k = ie && !n ? k.toUpperCase() : k;c = n ? null : k.charCodeAt(0);d = d && d.indexOf('lang_') == 0 ? tinyMCE.getLang(d) : d;sc = {alt : m.indexOf('alt') != -1,
ctrl : m.indexOf('ctrl') != -1,
shift : m.indexOf('shift') != -1,
charCode : c,
keyCode : n ? k : (ie ? c : null),
desc : d,
cmd : cmd,
ui : ui,
val : va
};for (i=0; i<scl.length; i++) {if (sc.alt == scl[i].alt && sc.ctrl == scl[i].ctrl && sc.shift == scl[i].shift
&& sc.charCode == scl[i].charCode && sc.keyCode == scl[i].keyCode) {return false;}}scl[scl.length] = sc;return true;},
handleShortcut : function(e) {var i, s, o;if (!e.altKey && !e.ctrlKey)return false;s = this.shortcuts;for (i=0; i<s.length; i++) {o = s[i];if (o.alt == e.altKey && o.ctrl == e.ctrlKey && (o.keyCode == e.keyCode || o.charCode == e.charCode)) {if (o.cmd && (e.type == "keydown" || (e.type == "keypress" && !tinyMCE.isOpera)))tinyMCE.execCommand(o.cmd, o.ui, o.val);tinyMCE.cancelEvent(e);return true;}}return false;},
autoResetDesignMode : function() {if (!tinyMCE.isIE && this.isHidden() && tinyMCE.getParam('auto_reset_designmode'))eval('try { this.getDoc().designMode = "On"; this.useCSS = false; } catch(e) {}');},
isHidden : function() {var s;if (tinyMCE.isIE)return false;s = this.getSel();return (!s || !s.rangeCount || s.rangeCount == 0);},
isDirty : function() {return tinyMCE.trim(this.startContent) != tinyMCE.trim(this.getBody().innerHTML) && !this.isNotDirty;},
_mergeElements : function(scmd, pa, ch, override) {var st, stc, className, n;if (scmd == "removeformat") {pa.className = "";pa.style.cssText = "";ch.className = "";ch.style.cssText = "";return;}st = tinyMCE.parseStyle(tinyMCE.getAttrib(pa, "style"));stc = tinyMCE.parseStyle(tinyMCE.getAttrib(ch, "style"));className = tinyMCE.getAttrib(pa, "class");className = tinyMCE.getAttrib(ch, "class");if (override) {for (n in st) {if (typeof(st[n]) == 'function')continue;stc[n] = st[n];}} else {for (n in stc) {if (typeof(stc[n]) == 'function')continue;st[n] = stc[n];}}tinyMCE.setAttrib(pa, "style", tinyMCE.serializeStyle(st));tinyMCE.setAttrib(pa, "class", tinyMCE.trim(className));ch.className = "";ch.style.cssText = "";ch.removeAttribute("class");ch.removeAttribute("style");},
_fixRootBlocks : function() {var rb, b, ne, be, nx, bm;rb = tinyMCE.getParam('forced_root_block');if (!rb)return;b = this.getBody();ne = b.firstChild;while (ne) {nx = ne.nextSibling;if (ne.nodeType == 3 || !tinyMCE.blockRegExp.test(ne.nodeName)) {if (!bm)bm = this.selection.getBookmark();if (!be) {be = this.getDoc().createElement(rb);be.appendChild(ne.cloneNode(true));b.replaceChild(be, ne);} else {be.appendChild(ne.cloneNode(true));b.removeChild(ne);}} else
be = null;ne = nx;}if (bm)this.selection.moveToBookmark(bm);},
_fixTrailingNbsp : function() {var s = this.selection, e = s.getFocusElement(), bm, v;if (e && tinyMCE.blockRegExp.test(e.nodeName) && e.firstChild) {v = e.firstChild.nodeValue;if (v && v.length > 1 && /(^\u00a0|\u00a0$)/.test(v)) {e.firstChild.nodeValue = v.replace(/(^\u00a0|\u00a0$)/, '');s.selectNode(e.firstChild, true, false, false);}}},
_setUseCSS : function(b) {var d = this.getDoc();try {d.execCommand("useCSS", false, !b);} catch (ex) {}try {d.execCommand("styleWithCSS", false, b);} catch (ex) {}if (!tinyMCE.getParam("table_inline_editing"))try {d.execCommand('enableInlineTableEditing', false, "false");} catch (ex) {}if (!tinyMCE.getParam("object_resizing"))try {d.execCommand('enableObjectResizing', false, "false");} catch (ex) {}},
execCommand : function(command, user_interface, value) {var i, x, z, align, img, div, doc = this.getDoc(), win = this.getWin(), focusElm = this.getFocusElement();if (!new RegExp('mceStartTyping|mceEndTyping|mceBeginUndoLevel|mceEndUndoLevel|mceAddUndoLevel', 'gi').test(command))this.undoBookmark = null;if (!tinyMCE.isIE && !this.useCSS) {this._setUseCSS(false);this.useCSS = true;}this.contentDocument = doc;if (!/mceStartTyping|mceEndTyping/.test(command)) {if (tinyMCE.execCommandCallback(this, 'execcommand_callback', 'execCommand', this.editorId, this.getBody(), command, user_interface, value))return;}if (focusElm && focusElm.nodeName == "IMG") {align = focusElm.getAttribute('align');img = command == "JustifyCenter" ? focusElm.cloneNode(false) : focusElm;switch (command) {case "JustifyLeft":if (align == 'left')img.removeAttribute('align');else
img.setAttribute('align', 'left');div = focusElm.parentNode;if (div && div.nodeName == "DIV" && div.childNodes.length == 1 && div.parentNode)div.parentNode.replaceChild(img, div);this.selection.selectNode(img);this.repaint();tinyMCE.triggerNodeChange();return;case "JustifyCenter":img.removeAttribute('align');div = tinyMCE.getParentElement(focusElm, "div");if (div && div.style.textAlign == "center") {if (div.nodeName == "DIV" && div.childNodes.length == 1 && div.parentNode)div.parentNode.replaceChild(img, div);} else {div = this.getDoc().createElement("div");div.style.textAlign = 'center';div.appendChild(img);focusElm.parentNode.replaceChild(div, focusElm);}this.selection.selectNode(img);this.repaint();tinyMCE.triggerNodeChange();return;case "JustifyRight":if (align == 'right')img.removeAttribute('align');else
img.setAttribute('align', 'right');div = focusElm.parentNode;if (div && div.nodeName == "DIV" && div.childNodes.length == 1 && div.parentNode)div.parentNode.replaceChild(img, div);this.selection.selectNode(img);this.repaint();tinyMCE.triggerNodeChange();return;}}if (tinyMCE.settings.force_br_newlines) {var alignValue = "";if (doc.selection.type != "Control") {switch (command) {case "JustifyLeft":alignValue = "left";break;case "JustifyCenter":alignValue = "center";break;case "JustifyFull":alignValue = "justify";break;case "JustifyRight":alignValue = "right";break;}if (alignValue !== '') {var rng = doc.selection.createRange();if ((divElm = tinyMCE.getParentElement(rng.parentElement(), "div")) != null)divElm.setAttribute("align", alignValue);else if (rng.pasteHTML && rng.htmlText.length > 0)rng.pasteHTML('<div align="' + alignValue + '">' + rng.htmlText + "</div>");tinyMCE.triggerNodeChange();return;}}}switch (command) {case "mceRepaint":this.repaint();return true;case "unlink":if (tinyMCE.isGecko && this.getSel().isCollapsed) {focusElm = tinyMCE.getParentElement(focusElm, 'A');if (focusElm)this.selection.selectNode(focusElm, false);}this.getDoc().execCommand(command, user_interface, value);tinyMCE.isGecko && this.getSel().collapseToEnd();tinyMCE.triggerNodeChange();return true;case "InsertUnorderedList":case "InsertOrderedList":this.getDoc().execCommand(command, user_interface, value);tinyMCE.triggerNodeChange();break;case "Strikethrough":this.getDoc().execCommand(command, user_interface, value);tinyMCE.triggerNodeChange();break;case "mceSelectNode":this.selection.selectNode(value);tinyMCE.triggerNodeChange();tinyMCE.selectedNode = value;break;case "FormatBlock":if (value == null || value == '') {var elm = tinyMCE.getParentElement(this.getFocusElement(), "p,div,h1,h2,h3,h4,h5,h6,pre,address,blockquote,dt,dl,dd,samp");if (elm)this.execCommand("mceRemoveNode", false, elm);} else {if (!this.cleanup.isValid(value))return true;if (tinyMCE.isGecko && new RegExp('<(div|blockquote|code|dt|dd|dl|samp)>', 'gi').test(value))value = value.replace(/[^a-z]/gi, '');if (tinyMCE.isIE && new RegExp('blockquote|code|samp', 'gi').test(value)) {var b = this.selection.getBookmark();this.getDoc().execCommand("FormatBlock", false, '<p>');tinyMCE.renameElement(tinyMCE.getParentBlockElement(this.getFocusElement()), value);this.selection.moveToBookmark(b);} else
this.getDoc().execCommand("FormatBlock", false, value);}tinyMCE.triggerNodeChange();break;case "mceRemoveNode":if (!value)value = tinyMCE.getParentElement(this.getFocusElement());if (tinyMCE.isIE) {value.outerHTML = value.innerHTML;} else {var rng = value.ownerDocument.createRange();rng.setStartBefore(value);rng.setEndAfter(value);rng.deleteContents();rng.insertNode(rng.createContextualFragment(value.innerHTML));}tinyMCE.triggerNodeChange();break;case "mceSelectNodeDepth":var parentNode = this.getFocusElement();for (i=0; parentNode; i++) {if (parentNode.nodeName.toLowerCase() == "body")break;if (parentNode.nodeName.toLowerCase() == "#text") {i--;parentNode = parentNode.parentNode;continue;}if (i == value) {this.selection.selectNode(parentNode, false);tinyMCE.triggerNodeChange();tinyMCE.selectedNode = parentNode;return;}parentNode = parentNode.parentNode;}break;case "mceSetStyleInfo":case "SetStyleInfo":var rng = this.getRng();var sel = this.getSel();var scmd = value.command;var sname = value.name;var svalue = value.value == null ? '' : value.value;var wrapper = value.wrapper ? value.wrapper : "span";var parentElm = null;var invalidRe = new RegExp("^BODY|HTML$", "g");var invalidParentsRe = tinyMCE.settings.merge_styles_invalid_parents !== '' ? new RegExp(tinyMCE.settings.merge_styles_invalid_parents, "gi") : null;if (tinyMCE.isIE) {if (rng.item)parentElm = rng.item(0);else {var pelm = rng.parentElement();var prng = doc.selection.createRange();prng.moveToElementText(pelm);if (rng.htmlText == prng.htmlText || rng.boundingWidth == 0) {if (invalidParentsRe == null || !invalidParentsRe.test(pelm.nodeName))parentElm = pelm;}}} else {var felm = this.getFocusElement();if (sel.isCollapsed || (new RegExp('td|tr|tbody|table|img', 'gi').test(felm.nodeName) && sel.anchorNode == felm.parentNode))parentElm = felm;}if (parentElm && !invalidRe.test(parentElm.nodeName)) {if (scmd == "setstyle")tinyMCE.setStyleAttrib(parentElm, sname, svalue);if (scmd == "setattrib")tinyMCE.setAttrib(parentElm, sname, svalue);if (scmd == "removeformat") {parentElm.style.cssText = '';tinyMCE.setAttrib(parentElm, 'class', '');}var ch = tinyMCE.getNodeTree(parentElm, [], 1);for (z=0; z<ch.length; z++) {if (ch[z] == parentElm)continue;if (scmd == "setstyle")tinyMCE.setStyleAttrib(ch[z], sname, '');if (scmd == "setattrib")tinyMCE.setAttrib(ch[z], sname, '');if (scmd == "removeformat") {ch[z].style.cssText = '';tinyMCE.setAttrib(ch[z], 'class', '');}}} else {this._setUseCSS(false);doc.execCommand("FontName", false, "#mce_temp_font#");var elementArray = tinyMCE.getElementsByAttributeValue(this.getBody(), "font", "face", "#mce_temp_font#");for (x=0; x<elementArray.length; x++) {elm = elementArray[x];if (elm) {var spanElm = doc.createElement(wrapper);if (scmd == "setstyle")tinyMCE.setStyleAttrib(spanElm, sname, svalue);if (scmd == "setattrib")tinyMCE.setAttrib(spanElm, sname, svalue);if (scmd == "removeformat") {spanElm.style.cssText = '';tinyMCE.setAttrib(spanElm, 'class', '');}if (elm.hasChildNodes()) {for (i=0; i<elm.childNodes.length; i++)spanElm.appendChild(elm.childNodes[i].cloneNode(true));}spanElm.setAttribute("mce_new", "true");elm.parentNode.replaceChild(spanElm, elm);var ch = tinyMCE.getNodeTree(spanElm, [], 1);for (z=0; z<ch.length; z++) {if (ch[z] == spanElm)continue;if (scmd == "setstyle")tinyMCE.setStyleAttrib(ch[z], sname, '');if (scmd == "setattrib")tinyMCE.setAttrib(ch[z], sname, '');if (scmd == "removeformat") {ch[z].style.cssText = '';tinyMCE.setAttrib(ch[z], 'class', '');}}}}}var nodes = doc.getElementsByTagName(wrapper);for (i=nodes.length-1; i>=0; i--) {var elm = nodes[i];var isNew = tinyMCE.getAttrib(elm, "mce_new") == "true";elm.removeAttribute("mce_new");if (elm.childNodes && elm.childNodes.length == 1 && elm.childNodes[0].nodeType == 1) {this._mergeElements(scmd, elm, elm.childNodes[0], isNew);continue;}if (elm.parentNode.childNodes.length == 1 && !invalidRe.test(elm.nodeName) && !invalidRe.test(elm.parentNode.nodeName)) {if (invalidParentsRe == null || !invalidParentsRe.test(elm.parentNode.nodeName))this._mergeElements(scmd, elm.parentNode, elm, false);}}var nodes = doc.getElementsByTagName(wrapper);for (i=nodes.length-1; i>=0; i--) {var elm = nodes[i], isEmpty = true;var tmp = doc.createElement("body");tmp.appendChild(elm.cloneNode(false));tmp.innerHTML = tmp.innerHTML.replace(new RegExp('style=""|class=""', 'gi'), '');if (new RegExp('<span>', 'gi').test(tmp.innerHTML)) {for (x=0; x<elm.childNodes.length; x++) {if (elm.parentNode != null)elm.parentNode.insertBefore(elm.childNodes[x].cloneNode(true), elm);}elm.parentNode.removeChild(elm);}}if (scmd == "removeformat")tinyMCE.handleVisualAid(this.getBody(), true, this.visualAid, this);tinyMCE.triggerNodeChange();break;case "FontName":if (value == null) {var s = this.getSel();if (tinyMCE.isGecko && s.isCollapsed) {var f = tinyMCE.getParentElement(this.getFocusElement(), "font");if (f != null)this.selection.selectNode(f, false);}this.getDoc().execCommand("RemoveFormat", false, null);if (f != null && tinyMCE.isGecko) {var r = this.getRng().cloneRange();r.collapse(true);s.removeAllRanges();s.addRange(r);}} else
this.getDoc().execCommand('FontName', false, value);if (tinyMCE.isGecko)window.setTimeout('tinyMCE.triggerNodeChange(false);', 1);return;case "FontSize":this.getDoc().execCommand('FontSize', false, value);if (tinyMCE.isGecko)window.setTimeout('tinyMCE.triggerNodeChange(false);', 1);return;case "forecolor":value = value == null ? this.foreColor : value;value = tinyMCE.trim(value);value = value.charAt(0) != '#' ? (isNaN('0x' + value) ? value : '#' + value) : value;this.foreColor = value;this.getDoc().execCommand('forecolor', false, value);break;case "HiliteColor":value = value == null ? this.backColor : value;value = tinyMCE.trim(value);value = value.charAt(0) != '#' ? (isNaN('0x' + value) ? value : '#' + value) : value;this.backColor = value;if (tinyMCE.isGecko) {this._setUseCSS(true);this.getDoc().execCommand('hilitecolor', false, value);this._setUseCSS(false);} else
this.getDoc().execCommand('BackColor', false, value);break;case "Cut":case "Copy":case "Paste":var cmdFailed = false;eval('try {this.getDoc().execCommand(command, user_interface, value);} catch (e) {cmdFailed = true;}');if (tinyMCE.isOpera && cmdFailed)alert('Currently not supported by your browser, use keyboard shortcuts instead.');if (tinyMCE.isGecko && cmdFailed) {if (confirm(tinyMCE.entityDecode(tinyMCE.getLang('lang_clipboard_msg'))))window.open('http://www.mozilla.org/editor/midasdemo/securityprefs.html', 'mceExternal');return;} else
tinyMCE.triggerNodeChange();break;case "mceSetContent":if (!value)value = "";value = tinyMCE.storeAwayURLs(value);value = tinyMCE._customCleanup(this, "insert_to_editor", value);if (this.getBody().nodeName == 'BODY')tinyMCE._setHTML(doc, value);else
this.getBody().innerHTML = value;tinyMCE.setInnerHTML(this.getBody(), tinyMCE._cleanupHTML(this, doc, this.settings, this.getBody(), false, false, false, true));tinyMCE.convertAllRelativeURLs(this.getBody());tinyMCE._removeInternal(this.getBody());if (tinyMCE.getParam("convert_fonts_to_spans"))tinyMCE.convertSpansToFonts(doc);tinyMCE.handleVisualAid(this.getBody(), true, this.visualAid, this);tinyMCE._setEventsEnabled(this.getBody(), false);this._addBogusBR();return true;case "mceCleanup":var b = this.selection.getBookmark();tinyMCE._setHTML(this.contentDocument, this.getBody().innerHTML);tinyMCE.setInnerHTML(this.getBody(), tinyMCE._cleanupHTML(this, this.contentDocument, this.settings, this.getBody(), this.visualAid));tinyMCE.convertAllRelativeURLs(doc.body);if (tinyMCE.getParam("convert_fonts_to_spans"))tinyMCE.convertSpansToFonts(doc);tinyMCE.handleVisualAid(this.getBody(), true, this.visualAid, this);tinyMCE._setEventsEnabled(this.getBody(), false);this._addBogusBR();this.repaint();this.selection.moveToBookmark(b);tinyMCE.triggerNodeChange();break;case "mceReplaceContent":if (!value)value = '';this.getWin().focus();var selectedText = "";if (tinyMCE.isIE) {var rng = doc.selection.createRange();selectedText = rng.text;} else
selectedText = this.getSel().toString();if (selectedText.length > 0) {value = tinyMCE.replaceVar(value, "selection", selectedText);tinyMCE.execCommand('mceInsertContent', false, value);}this._addBogusBR();tinyMCE.triggerNodeChange();break;case "mceSetAttribute":if (typeof(value) == 'object') {var targetElms = (typeof(value.targets) == "undefined") ? "p,img,span,div,td,h1,h2,h3,h4,h5,h6,pre,address" : value.targets;var targetNode = tinyMCE.getParentElement(this.getFocusElement(), targetElms);if (targetNode) {targetNode.setAttribute(value.name, value.value);tinyMCE.triggerNodeChange();}}break;case "mceSetCSSClass":this.execCommand("mceSetStyleInfo", false, {command : "setattrib", name : "class", value : value});break;case "mceInsertRawHTML":var key = 'tiny_mce_marker';this.execCommand('mceBeginUndoLevel');this.execCommand('mceInsertContent', false, key);var scrollX = this.getBody().scrollLeft + this.getDoc().documentElement.scrollLeft;var scrollY = this.getBody().scrollTop + this.getDoc().documentElement.scrollTop;var html = this.getBody().innerHTML;if ((pos = html.indexOf(key)) != -1)tinyMCE.setInnerHTML(this.getBody(), html.substring(0, pos) + value + html.substring(pos + key.length));this.contentWindow.scrollTo(scrollX, scrollY);this.execCommand('mceEndUndoLevel');break;case "mceInsertContent":if (!value)value = '';var insertHTMLFailed = false;if (tinyMCE.isGecko || tinyMCE.isOpera) {try {if (value.indexOf('<') == -1 && !value.match(/(&#38;|&#160;|&#60;|&#62;)/g)) {var r = this.getRng();var n = this.getDoc().createTextNode(tinyMCE.entityDecode(value));var s = this.getSel();var r2 = r.cloneRange();s.removeAllRanges();r.deleteContents();r.insertNode(n);r2.selectNode(n);r2.collapse(false);s.removeAllRanges();s.addRange(r2);} else {value = tinyMCE.fixGeckoBaseHREFBug(1, this.getDoc(), value);this.getDoc().execCommand('inserthtml', false, value);tinyMCE.fixGeckoBaseHREFBug(2, this.getDoc(), value);}} catch (ex) {insertHTMLFailed = true;}if (!insertHTMLFailed) {tinyMCE.triggerNodeChange();return;}}if (!tinyMCE.isIE) {var isHTML = value.indexOf('<') != -1;var sel = this.getSel();var rng = this.getRng();if (isHTML) {if (tinyMCE.isSafari) {var tmpRng = this.getDoc().createRange();tmpRng.setStart(this.getBody(), 0);tmpRng.setEnd(this.getBody(), 0);value = tmpRng.createContextualFragment(value);} else
value = rng.createContextualFragment(value);} else {value = doc.createTextNode(tinyMCE.entityDecode(value));}if (tinyMCE.isSafari && !isHTML) {this.execCommand('InsertText', false, value.nodeValue);tinyMCE.triggerNodeChange();return true;} else if (tinyMCE.isSafari && isHTML) {rng.deleteContents();rng.insertNode(value);tinyMCE.triggerNodeChange();return true;}rng.deleteContents();if (rng.startContainer.nodeType == 3) {var node = rng.startContainer.splitText(rng.startOffset);node.parentNode.insertBefore(value, node); 
} else
rng.insertNode(value);if (!isHTML) {sel.selectAllChildren(doc.body);sel.removeAllRanges();var rng = doc.createRange();rng.selectNode(value);rng.collapse(false);sel.addRange(rng);} else
rng.collapse(false);tinyMCE.fixGeckoBaseHREFBug(2, this.getDoc(), value);} else {var rng = doc.selection.createRange(), tmpRng = null;var c = value.indexOf('<!--') != -1;if (c)value = tinyMCE.uniqueTag + value;if (rng.item)rng.item(0).outerHTML = value;else
rng.pasteHTML(value);if (c) {var e = this.getDoc().getElementById('mceTMPElement');e.parentNode.removeChild(e);}}tinyMCE.execCommand("mceAddUndoLevel");tinyMCE.triggerNodeChange();break;case "mceStartTyping":if (tinyMCE.settings.custom_undo_redo && this.undoRedo.typingUndoIndex == -1) {this.undoRedo.typingUndoIndex = this.undoRedo.undoIndex;tinyMCE.typingUndoIndex = tinyMCE.undoIndex;this.execCommand('mceAddUndoLevel');}break;case "mceEndTyping":if (tinyMCE.settings.custom_undo_redo && this.undoRedo.typingUndoIndex != -1) {this.execCommand('mceAddUndoLevel');this.undoRedo.typingUndoIndex = -1;}tinyMCE.typingUndoIndex = -1;break;case "mceBeginUndoLevel":this.undoRedoLevel = false;break;case "mceEndUndoLevel":this.undoRedoLevel = true;this.execCommand('mceAddUndoLevel');break;case "mceAddUndoLevel":if (tinyMCE.settings.custom_undo_redo && this.undoRedoLevel) {if (this.undoRedo.add())tinyMCE.triggerNodeChange(false);}break;case "Undo":if (tinyMCE.settings.custom_undo_redo) {tinyMCE.execCommand("mceEndTyping");this.undoRedo.undo();tinyMCE.triggerNodeChange();} else
this.getDoc().execCommand(command, user_interface, value);break;case "Redo":if (tinyMCE.settings.custom_undo_redo) {tinyMCE.execCommand("mceEndTyping");this.undoRedo.redo();tinyMCE.triggerNodeChange();} else
this.getDoc().execCommand(command, user_interface, value);break;case "mceToggleVisualAid":this.visualAid = !this.visualAid;tinyMCE.handleVisualAid(this.getBody(), true, this.visualAid, this);tinyMCE.triggerNodeChange();break;case "Indent":this.getDoc().execCommand(command, user_interface, value);tinyMCE.triggerNodeChange();if (tinyMCE.isIE) {var n = tinyMCE.getParentElement(this.getFocusElement(), "blockquote");do {if (n && n.nodeName == "BLOCKQUOTE") {n.removeAttribute("dir");n.removeAttribute("style");}} while (n != null && (n = n.parentNode) != null);}break;case "RemoveFormat":case "removeformat":var text = this.selection.getSelectedText();if (tinyMCE.isOpera) {this.getDoc().execCommand("RemoveFormat", false, null);return;}if (tinyMCE.isIE) {try {var rng = doc.selection.createRange();rng.execCommand("RemoveFormat", false, null);} catch (e) {}this.execCommand("mceSetStyleInfo", false, {command : "removeformat"});} else {this.getDoc().execCommand(command, user_interface, value);this.execCommand("mceSetStyleInfo", false, {command : "removeformat"});}if (text.length == 0)this.execCommand("mceSetCSSClass", false, "");tinyMCE.triggerNodeChange();break;default:this.getDoc().execCommand(command, user_interface, value);if (tinyMCE.isGecko)window.setTimeout('tinyMCE.triggerNodeChange(false);', 1);else
tinyMCE.triggerNodeChange();}if (command != "mceAddUndoLevel" && command != "Undo" && command != "Redo" && command != "mceStartTyping" && command != "mceEndTyping")tinyMCE.execCommand("mceAddUndoLevel");},
queryCommandValue : function(c) {try {return this.getDoc().queryCommandValue(c);} catch (e) {return null;}},
queryCommandState : function(c) {return this.getDoc().queryCommandState(c);},
_addBogusBR : function() {var b = this.getBody();if (tinyMCE.isGecko && !b.hasChildNodes())b.innerHTML = '<br _moz_editor_bogus_node="TRUE" />';},
_onAdd : function(replace_element, form_element_name, target_document) {var hc, th, tos, editorTemplate, targetDoc, deltaWidth, deltaHeight, html, rng, fragment;var dynamicIFrame, tElm, doc, parentElm;th = this.settings.theme;tos = tinyMCE.themes[th];targetDoc = target_document ? target_document : document;this.targetDoc = targetDoc;tinyMCE.themeURL = tinyMCE.baseURL + "/themes/" + this.settings.theme;this.settings.themeurl = tinyMCE.themeURL;if (!replace_element) {alert("Error: Could not find the target element.");return false;}if (tos.getEditorTemplate)editorTemplate = tos.getEditorTemplate(this.settings, this.editorId);deltaWidth = editorTemplate.delta_width ? editorTemplate.delta_width : 0;deltaHeight = editorTemplate.delta_height ? editorTemplate.delta_height : 0;html = '<span id="' + this.editorId + '_parent" class="mceEditorContainer">' + editorTemplate.html;html = tinyMCE.replaceVar(html, "editor_id", this.editorId);if (!this.settings.default_document)this.settings.default_document = tinyMCE.baseURL + "/blank.htm";this.settings.old_width = this.settings.width;this.settings.old_height = this.settings.height;if (this.settings.width == -1)this.settings.width = replace_element.offsetWidth;if (this.settings.height == -1)this.settings.height = replace_element.offsetHeight;if (this.settings.width == 0)this.settings.width = replace_element.style.width;if (this.settings.height == 0)this.settings.height = replace_element.style.height;if (this.settings.width == 0)this.settings.width = 320;if (this.settings.height == 0)this.settings.height = 240;this.settings.area_width = parseInt(this.settings.width);this.settings.area_height = parseInt(this.settings.height);this.settings.area_width += deltaWidth;this.settings.area_height += deltaHeight;this.settings.width_style = "" + this.settings.width;this.settings.height_style = "" + this.settings.height;if (("" + this.settings.width).indexOf('%') != -1)this.settings.area_width = "100%";else
this.settings.width_style += 'px';if (("" + this.settings.height).indexOf('%') != -1)this.settings.area_height = "100%";else
this.settings.height_style += 'px';if (("" + replace_element.style.width).indexOf('%') != -1) {this.settings.width = replace_element.style.width;this.settings.area_width = "100%";this.settings.width_style = "100%";}if (("" + replace_element.style.height).indexOf('%') != -1) {this.settings.height = replace_element.style.height;this.settings.area_height = "100%";this.settings.height_style = "100%";}html = tinyMCE.applyTemplate(html);this.settings.width = this.settings.old_width;this.settings.height = this.settings.old_height;this.visualAid = this.settings.visual;this.formTargetElementId = form_element_name;if (replace_element.nodeName == "TEXTAREA" || replace_element.nodeName == "INPUT")this.startContent = replace_element.value;else
this.startContent = replace_element.innerHTML;if (replace_element.nodeName != "TEXTAREA" && replace_element.nodeName != "INPUT") {this.oldTargetElement = replace_element;hc = '<input type="hidden" id="' + form_element_name + '" name="' + form_element_name + '" />';this.oldTargetDisplay = tinyMCE.getStyle(this.oldTargetElement, 'display', 'inline');this.oldTargetElement.style.display = "none";html += '</span>';if (tinyMCE.isGecko)html = hc + html;else
html += hc;if (tinyMCE.isGecko) {rng = replace_element.ownerDocument.createRange();rng.setStartBefore(replace_element);fragment = rng.createContextualFragment(html);tinyMCE.insertAfter(fragment, replace_element);} else
replace_element.insertAdjacentHTML("beforeBegin", html);} else {html += '</span>';this.oldTargetElement = replace_element;this.oldTargetDisplay = tinyMCE.getStyle(this.oldTargetElement, 'display', 'inline');this.oldTargetElement.style.display = "none";if (tinyMCE.isGecko) {rng = replace_element.ownerDocument.createRange();rng.setStartBefore(replace_element);fragment = rng.createContextualFragment(html);tinyMCE.insertAfter(fragment, replace_element);} else
replace_element.insertAdjacentHTML("beforeBegin", html);}dynamicIFrame = false;tElm = targetDoc.getElementById(this.editorId);if (!tinyMCE.isIE) {if (tElm && (tElm.nodeName == "SPAN" || tElm.nodeName == "span")) {tElm = tinyMCE._createIFrame(tElm, targetDoc);dynamicIFrame = true;}this.targetElement = tElm;this.iframeElement = tElm;this.contentDocument = tElm.contentDocument;this.contentWindow = tElm.contentWindow;} else {if (tElm && tElm.nodeName == "SPAN")tElm = tinyMCE._createIFrame(tElm, targetDoc, targetDoc.parentWindow);else
tElm = targetDoc.frames[this.editorId];this.targetElement = tElm;this.iframeElement = targetDoc.getElementById(this.editorId);if (tinyMCE.isOpera) {this.contentDocument = this.iframeElement.contentDocument;this.contentWindow = this.iframeElement.contentWindow;dynamicIFrame = true;} else {this.contentDocument = tElm.window.document;this.contentWindow = tElm.window;}this.getDoc().designMode = "on";}doc = this.contentDocument;if (dynamicIFrame) {html = tinyMCE.getParam('doctype') + '<html><head xmlns="http://www.w3.org/1999/xhtml"><base href="' + tinyMCE.settings.base_href + '" /><title>blank_page</title><meta http-equiv="Content-Type" content="text/html; charset=UTF-8"></head><body class="mceContentBody"></body></html>';try {if (!this.isHidden())this.getDoc().designMode = "on";doc.open();doc.write(html);doc.close();} catch (e) {this.getDoc().location.href = tinyMCE.baseURL + "/blank.htm";}}if (tinyMCE.isIE)window.setTimeout("tinyMCE.addEventHandlers(tinyMCE.instances[\"" + this.editorId + "\"]);", 1);parentElm = this.targetDoc.getElementById(this.editorId + '_parent');this.formElement = tinyMCE.isGecko ? parentElm.previousSibling : parentElm.nextSibling;tinyMCE.setupContent(this.editorId, true);return true;},
setBaseHREF : function(u) {var h, b, d, nl;d = this.getDoc();nl = d.getElementsByTagName("base");b = nl.length > 0 ? nl[0] : null;if (!b) {nl = d.getElementsByTagName("head");h = nl.length > 0 ? nl[0] : null;b = d.createElement("base");b.setAttribute('href', u);h.appendChild(b);} else {if (u == '' || u == null)b.parentNode.removeChild(b);else
b.setAttribute('href', u);}},
getHTML : function(r) {var h, d = this.getDoc(), b = this.getBody();if (r)return b.innerHTML;h = tinyMCE._cleanupHTML(this, d, this.settings, b, false, true, false, true);if (tinyMCE.getParam("convert_fonts_to_spans"))tinyMCE.convertSpansToFonts(d);return h;},
setHTML : function(h) {this.execCommand('mceSetContent', false, h);this.repaint();},
getFocusElement : function() {return this.selection.getFocusElement();},
getSel : function() {return this.selection.getSel();},
getRng : function() {return this.selection.getRng();},
triggerSave : function(skip_cleanup, skip_callback) {var e, nl = [], i, s, content, htm;if (!this.enabled)return;this.switchSettings();s = tinyMCE.settings;if (tinyMCE.isRealIE) {e = this.iframeElement;do {if (e.style && e.style.display == 'none') {e.style.display = 'block';nl[nl.length] = {elm : e, type : 'style'};}if (e.style && s.hidden_tab_class.length > 0 && e.className.indexOf(s.hidden_tab_class) != -1) {e.className = s.display_tab_class;nl[nl.length] = {elm : e, type : 'class'};}} while ((e = e.parentNode) != null)}tinyMCE.settings.preformatted = false;if (typeof(skip_cleanup) == "undefined")skip_cleanup = false;if (typeof(skip_callback) == "undefined")skip_callback = false;tinyMCE._setHTML(this.getDoc(), this.getBody().innerHTML);if (this.settings.cleanup == false) {tinyMCE.handleVisualAid(this.getBody(), true, false, this);tinyMCE._setEventsEnabled(this.getBody(), true);}tinyMCE._customCleanup(this, "submit_content_dom", this.contentWindow.document.body);htm = skip_cleanup ? this.getBody().innerHTML : tinyMCE._cleanupHTML(this, this.getDoc(), this.settings, this.getBody(), tinyMCE.visualAid, true, true);htm = tinyMCE._customCleanup(this, "submit_content", htm);if (!skip_callback && tinyMCE.settings.save_callback !== '')content = tinyMCE.resolveDots(tinyMCE.settings.save_callback, window)(this.formTargetElementId,htm,this.getBody());if ((typeof(content) != "undefined") && content != null)htm = content;htm = tinyMCE.regexpReplace(htm, "&#40;", "(", "gi");htm = tinyMCE.regexpReplace(htm, "&#41;", ")", "gi");htm = tinyMCE.regexpReplace(htm, "&#59;", ";", "gi");htm = tinyMCE.regexpReplace(htm, "&#34;", "&quot;", "gi");htm = tinyMCE.regexpReplace(htm, "&#94;", "^", "gi");if (this.formElement)this.formElement.value = htm;if (tinyMCE.isSafari && this.formElement)this.formElement.innerText = htm;for (i=0; i<nl.length; i++) {if (nl[i].type == 'style')nl[i].elm.style.display = 'none';else
nl[i].elm.className = s.hidden_tab_class;}}};tinyMCE.add(TinyMCE_Engine, {cleanupHTMLCode : function(s) {s = s.replace(new RegExp('<p \\/>', 'gi'), '<p>&nbsp;</p>');s = s.replace(new RegExp('<p>\\s*<\\/p>', 'gi'), '<p>&nbsp;</p>');s = s.replace(new RegExp('<br>\\s*<\\/br>', 'gi'), '<br />');s = s.replace(new RegExp('<(h[1-6]|p|div|address|pre|form|table|li|ol|ul|td|b|font|em|strong|i|strike|u|span|a|ul|ol|li|blockquote)([a-z]*)([^\\\\|>]*)\\/>', 'gi'), '<$1$2$3></$1$2>');s = s.replace(new RegExp('\\s+></', 'gi'), '></');s = s.replace(new RegExp('<(img|br|hr)([^>]*)><\\/(img|br|hr)>', 'gi'), '<$1$2 />');if (tinyMCE.isIE)s = s.replace(new RegExp('<p><hr \\/><\\/p>', 'gi'), "<hr>");if (tinyMCE.isIE)s = s.replace(/<!(\s*)\/>/g, '');return s;},
parseStyle : function(str) {var ar = [], st, i, re, pa;if (str == null)return ar;st = str.split(';');tinyMCE.clearArray(ar);for (i=0; i<st.length; i++) {if (st[i] == '')continue;re = new RegExp('^\\s*([^:]*):\\s*(.*)\\s*$');pa = st[i].replace(re, '$1||$2').split('||');if (pa.length == 2)ar[pa[0].toLowerCase()] = pa[1];}return ar;},
compressStyle : function(ar, pr, sf, res) {var box = [], i, a;box[0] = ar[pr + '-top' + sf];box[1] = ar[pr + '-left' + sf];box[2] = ar[pr + '-right' + sf];box[3] = ar[pr + '-bottom' + sf];for (i=0; i<box.length; i++) {if (box[i] == null)return;for (a=0; a<box.length; a++) {if (box[a] != box[i])return;}}ar[res] = box[0];ar[pr + '-top' + sf] = null;ar[pr + '-left' + sf] = null;ar[pr + '-right' + sf] = null;ar[pr + '-bottom' + sf] = null;},
serializeStyle : function(ar) {var str = "", key, val, m;tinyMCE.compressStyle(ar, "border", "", "border");tinyMCE.compressStyle(ar, "border", "-width", "border-width");tinyMCE.compressStyle(ar, "border", "-color", "border-color");tinyMCE.compressStyle(ar, "border", "-style", "border-style");tinyMCE.compressStyle(ar, "padding", "", "padding");tinyMCE.compressStyle(ar, "margin", "", "margin");for (key in ar) {val = ar[key];if (typeof(val) == 'function')continue;if (key.indexOf('mso-') == 0)continue;if (val != null && val !== '') {val = '' + val;val = val.replace(new RegExp("url\\(\\'?([^\\']*)\\'?\\)", 'gi'), "url('$1')");if (val.indexOf('url(') != -1 && tinyMCE.getParam('convert_urls')) {m = new RegExp("url\\('(.*?)'\\)").exec(val);if (m.length > 1)val = "url('" + eval(tinyMCE.getParam('urlconverter_callback') + "(m[1], null, true);") + "')";}if (tinyMCE.getParam("force_hex_style_colors"))val = tinyMCE.convertRGBToHex(val, true);val = val.replace(/\"/g, '\'');if (val != "url('')")str += key.toLowerCase() + ": " + val + "; ";}}if (new RegExp('; $').test(str))str = str.substring(0, str.length - 2);return str;},
convertRGBToHex : function(s, k) {var re, rgb;if (s.toLowerCase().indexOf('rgb') != -1) {re = new RegExp("(.*?)rgb\\s*?\\(\\s*?([0-9]+).*?,\\s*?([0-9]+).*?,\\s*?([0-9]+).*?\\)(.*?)", "gi");rgb = s.replace(re, "$1,$2,$3,$4,$5").split(',');if (rgb.length == 5) {r = parseInt(rgb[1]).toString(16);g = parseInt(rgb[2]).toString(16);b = parseInt(rgb[3]).toString(16);r = r.length == 1 ? '0' + r : r;g = g.length == 1 ? '0' + g : g;b = b.length == 1 ? '0' + b : b;s = "#" + r + g + b;if (k)s = rgb[0] + s + rgb[4];}}return s;},
convertHexToRGB : function(s) {if (s.indexOf('#') != -1) {s = s.replace(new RegExp('[^0-9A-F]', 'gi'), '');return "rgb(" + parseInt(s.substring(0, 2), 16) + "," + parseInt(s.substring(2, 4), 16) + "," + parseInt(s.substring(4, 6), 16) + ")";}return s;},
convertSpansToFonts : function(doc) {var s, i, size, fSize, x, fFace, fColor, sizes = tinyMCE.getParam('font_size_style_values').replace(/\s+/, '').split(',');s = tinyMCE.selectElements(doc, 'span,font');for (i=0; i<s.length; i++) {size = tinyMCE.trim(s[i].style.fontSize).toLowerCase();fSize = 0;for (x=0; x<sizes.length; x++) {if (sizes[x] == size) {fSize = x + 1;break;}}if (fSize > 0) {tinyMCE.setAttrib(s[i], 'size', fSize);s[i].style.fontSize = '';}fFace = s[i].style.fontFamily;if (fFace != null && fFace !== '') {tinyMCE.setAttrib(s[i], 'face', fFace);s[i].style.fontFamily = '';}fColor = s[i].style.color;if (fColor != null && fColor !== '') {tinyMCE.setAttrib(s[i], 'color', tinyMCE.convertRGBToHex(fColor));s[i].style.color = '';}}},
convertFontsToSpans : function(doc) {var fsClasses, s, i, fSize, fFace, fColor, sizes = tinyMCE.getParam('font_size_style_values').replace(/\s+/, '').split(',');fsClasses = tinyMCE.getParam('font_size_classes');if (fsClasses !== '')fsClasses = fsClasses.replace(/\s+/, '').split(',');else
fsClasses = null;s = tinyMCE.selectElements(doc, 'span,font');for (i=0; i<s.length; i++) {fSize = tinyMCE.getAttrib(s[i], 'size');fFace = tinyMCE.getAttrib(s[i], 'face');fColor = tinyMCE.getAttrib(s[i], 'color');if (fSize !== '') {fSize = parseInt(fSize);if (fSize > 0 && fSize < 8) {if (fsClasses != null)tinyMCE.setAttrib(s[i], 'class', fsClasses[fSize-1]);else
s[i].style.fontSize = sizes[fSize-1];}s[i].removeAttribute('size');}if (fFace !== '') {s[i].style.fontFamily = fFace;s[i].removeAttribute('face');}if (fColor !== '') {s[i].style.color = fColor;s[i].removeAttribute('color');}}},
cleanupAnchors : function(doc) {var i, cn, x, an = doc.getElementsByTagName("a");for (i=an.length-1; i>=0; i--) {if (tinyMCE.getAttrib(an[i], "name") !== '' && tinyMCE.getAttrib(an[i], "href") == '') {cn = an[i].childNodes;for (x=cn.length-1; x>=0; x--)tinyMCE.insertAfter(cn[x], an[i]);}}},
getContent : function(editor_id) {if (typeof(editor_id) != "undefined") tinyMCE.getInstanceById(editor_id).select();if (tinyMCE.selectedInstance)return tinyMCE.selectedInstance.getHTML();return null;},
_fixListElements : function(d) {var nl, x, a = ['ol', 'ul'], i, n, p, r = new RegExp('^(OL|UL)$'), np;for (x=0; x<a.length; x++) {nl = d.getElementsByTagName(a[x]);for (i=0; i<nl.length; i++) {n = nl[i];p = n.parentNode;if (r.test(p.nodeName)) {np = tinyMCE.prevNode(n, 'LI');if (!np) {np = d.createElement('li');np.innerHTML = '&nbsp;';np.appendChild(n);p.insertBefore(np, p.firstChild);} else
np.appendChild(n);}}}},
_fixTables : function(d) {var nl, i, n, p, np, x, t;nl = d.getElementsByTagName('table');for (i=0; i<nl.length; i++) {n = nl[i];if ((p = tinyMCE.getParentElement(n, 'p,h1,h2,h3,h4,h5,h6')) != null) {np = p.cloneNode(false);np.removeAttribute('id');t = n;while ((n = n.nextSibling))np.appendChild(n);tinyMCE.insertAfter(np, p);tinyMCE.insertAfter(t, p);}}},
_cleanupHTML : function(inst, doc, config, elm, visual, on_save, on_submit, inn) {var h, d, t1, t2, t3, t4, t5, c, s, nb;if (!tinyMCE.getParam('cleanup'))return elm.innerHTML;on_save = typeof(on_save) == 'undefined' ? false : on_save;c = inst.cleanup;s = inst.settings;d = c.settings.debug;if (d)t1 = new Date().getTime();inst._fixRootBlocks();if (tinyMCE.getParam("convert_fonts_to_spans"))tinyMCE.convertFontsToSpans(doc);if (tinyMCE.getParam("fix_list_elements"))tinyMCE._fixListElements(doc);if (tinyMCE.getParam("fix_table_elements"))tinyMCE._fixTables(doc);tinyMCE._customCleanup(inst, on_save ? "get_from_editor_dom" : "insert_to_editor_dom", doc.body);if (d)t2 = new Date().getTime();c.settings.on_save = on_save;c.idCount = 0;c.serializationId = new Date().getTime().toString(32);c.serializedNodes = [];c.sourceIndex = -1;if (s.cleanup_serializer == "xml")h = c.serializeNodeAsXML(elm, inn);else
h = c.serializeNodeAsHTML(elm, inn);if (d)t3 = new Date().getTime();nb = tinyMCE.getParam('entity_encoding') == 'numeric' ? '&#160;' : '&nbsp;';h = h.replace(/<\/?(body|head|html)[^>]*>/gi, '');h = h.replace(new RegExp(' (rowspan="1"|colspan="1")', 'g'), '');h = h.replace(/<p><hr \/><\/p>/g, '<hr />');h = h.replace(/<p>(&nbsp;|&#160;)<\/p><hr \/><p>(&nbsp;|&#160;)<\/p>/g, '<hr />');h = h.replace(/<td>\s*<br \/>\s*<\/td>/g, '<td>' + nb + '</td>');h = h.replace(/<p>\s*<br \/>\s*<\/p>/g, '<p>' + nb + '</p>');h = h.replace(/<br \/>$/, '');h = h.replace(/<br \/><\/p>/g, '</p>');h = h.replace(/<p>\s*(&nbsp;|&#160;)\s*<br \/>\s*(&nbsp;|&#160;)\s*<\/p>/g, '<p>' + nb + '</p>');h = h.replace(/<p>\s*(&nbsp;|&#160;)\s*<br \/>\s*<\/p>/g, '<p>' + nb + '</p>');h = h.replace(/<p>\s*<br \/>\s*&nbsp;\s*<\/p>/g, '<p>' + nb + '</p>');h = h.replace(new RegExp('<a>(.*?)<\\/a>', 'g'), '$1');h = h.replace(/<p([^>]*)>\s*<\/p>/g, '<p$1>' + nb + '</p>');if (/^\s*(<br \/>|<p>&nbsp;<\/p>|<p>&#160;<\/p>|<p><\/p>)\s*$/.test(h))h = '';if (s.preformatted) {h = h.replace(/^<pre>/, '');h = h.replace(/<\/pre>$/, '');h = '<pre>' + h + '</pre>';}if (tinyMCE.isGecko) {h = h.replace(/<br \/>\s*<\/li>/g, '</li>');h = h.replace(/&nbsp;\s*<\/(dd|dt)>/g, '</$1>');h = h.replace(/<o:p _moz-userdefined="" \/>/g, '');h = h.replace(/<td([^>]*)>\s*<br \/>\s*<\/td>/g, '<td$1>' + nb + '</td>');}if (s.force_br_newlines)h = h.replace(/<p>(&nbsp;|&#160;)<\/p>/g, '<br />');h = tinyMCE._customCleanup(inst, on_save ? "get_from_editor" : "insert_to_editor", h);if (on_save) {h = h.replace(new RegExp(' ?(mceItem[a-zA-Z0-9]*|' + s.visual_table_class + ')', 'g'), '');h = h.replace(new RegExp(' ?class=""', 'g'), '');}if (s.remove_linebreaks && !c.settings.indent)h = h.replace(/\n|\r/g, ' ');if (d)t4 = new Date().getTime();if (on_save && c.settings.indent)h = c.formatHTML(h);if (on_submit && (s.encoding == "xml" || s.encoding == "html"))h = c.xmlEncode(h);if (d)t5 = new Date().getTime();if (c.settings.debug)tinyMCE.debug("Cleanup in ms: Pre=" + (t2-t1) + ", Serialize: " + (t3-t2) + ", Post: " + (t4-t3) + ", Format: " + (t5-t4) + ", Sum: " + (t5-t1) + ".");return h;}});function TinyMCE_Cleanup() {this.isIE = (navigator.appName == "Microsoft Internet Explorer");this.rules = tinyMCE.clearArray([]);this.settings = {indent_elements : 'head,table,tbody,thead,tfoot,form,tr,ul,ol,blockquote,object',
newline_before_elements : 'h1,h2,h3,h4,h5,h6,pre,address,div,ul,ol,li,meta,option,area,title,link,base,script,td',
newline_after_elements : 'br,hr,p,pre,address,div,ul,ol,meta,option,area,link,base,script',
newline_before_after_elements : 'html,head,body,table,thead,tbody,tfoot,tr,form,ul,ol,blockquote,p,object,param,hr,div',
indent_char : '\t',
indent_levels : 1,
entity_encoding : 'raw',
valid_elements : '*[*]',
entities : '',
url_converter : '',
invalid_elements : '',
verify_html : false
};this.vElements = tinyMCE.clearArray([]);this.vElementsRe = '';this.closeElementsRe = /^(IMG|BR|HR|LINK|META|BASE|INPUT|AREA)$/;this.codeElementsRe = /^(SCRIPT|STYLE)$/;this.serializationId = 0;this.mceAttribs = {href : 'mce_href',
src : 'mce_src',
type : 'mce_type'
};}TinyMCE_Cleanup.prototype = {init : function(s) {var n, a, i, ir, or, st;for (n in s)this.settings[n] = s[n];s = this.settings;this.inRe = this._arrayToRe(s.indent_elements.split(','), '', '^<(', ')[^>]*');this.ouRe = this._arrayToRe(s.indent_elements.split(','), '', '^<\\/(', ')[^>]*');this.nlBeforeRe = this._arrayToRe(s.newline_before_elements.split(','), 'gi', '<(',  ')([^>]*)>');this.nlAfterRe = this._arrayToRe(s.newline_after_elements.split(','), 'gi', '<(',  ')([^>]*)>');this.nlBeforeAfterRe = this._arrayToRe(s.newline_before_after_elements.split(','), 'gi', '<(\\/?)(', ')([^>]*)>');this.serializedNodes = [];if (s.invalid_elements !== '')this.iveRe = this._arrayToRe(s.invalid_elements.toUpperCase().split(','), 'g', '^(', ')$');else
this.iveRe = null;st = '';for (i=0; i<s.indent_levels; i++)st += s.indent_char;this.inStr = st;if (!s.verify_html) {s.valid_elements = '*[*]';s.extended_valid_elements = '';}this.fillStr = s.entity_encoding == "named" ? "&nbsp;" : "&#160;";this.idCount = 0;this.xmlEncodeRe = new RegExp('[\u007F-\uFFFF<>&"]', 'g');},
addRuleStr : function(s) {var r = this.parseRuleStr(s), n;for (n in r) {if (r[n])this.rules[n] = r[n];}this.vElements = tinyMCE.clearArray([]);for (n in this.rules) {if (this.rules[n])this.vElements[this.vElements.length] = this.rules[n].tag;}this.vElementsRe = this._arrayToRe(this.vElements, '');},
isValid : function(n) {if (!this.rulesDone)this._setupRules();if (!n)return true;n = n.replace(/[^a-z0-9]+/gi, '').toUpperCase();return !tinyMCE.getParam('cleanup') || this.vElementsRe.test(n);},
addChildRemoveRuleStr : function(s) {var x, y, p, i, t, tn, ta, cl, r;if (!s)return;ta = s.split(',');for (x=0; x<ta.length; x++) {s = ta[x];p = this.split(/\[|\]/, s);if (p == null || p.length < 1)t = s.toUpperCase();else
t = p[0].toUpperCase();tn = this.split('/', t);for (y=0; y<tn.length; y++) {r = "^(";cl = this.split(/\|/, p[1]);for (i=0; i<cl.length; i++) {if (cl[i] == '%istrict')r += tinyMCE.inlineStrict;else if (cl[i] == '%itrans')r += tinyMCE.inlineTransitional;else if (cl[i] == '%istrict_na')r += tinyMCE.inlineStrict.substring(2);else if (cl[i] == '%itrans_na')r += tinyMCE.inlineTransitional.substring(2);else if (cl[i] == '%btrans')r += tinyMCE.blockElms;else if (cl[i] == '%strict')r += tinyMCE.blockStrict;else
r += (cl[i].charAt(0) != '#' ? cl[i].toUpperCase() : cl[i]);r += (i != cl.length - 1 ? '|' : '');}r += ')$';if (this.childRules == null)this.childRules = tinyMCE.clearArray([]);this.childRules[tn[y]] = new RegExp(r);if (p.length > 1)this.childRules[tn[y]].wrapTag = p[2];}}},
parseRuleStr : function(s) {var ta, p, r, a, i, x, px, t, tn, y, av, or = tinyMCE.clearArray([]), dv;if (s == null || s.length == 0)return or;ta = s.split(',');for (x=0; x<ta.length; x++) {s = ta[x];if (s.length == 0)continue;p = this.split(/\[|\]/, s);if (p == null || p.length < 1)t = s.toUpperCase();else
t = p[0].toUpperCase();tn = this.split('/', t);for (y=0; y<tn.length; y++) {r = {};r.tag = tn[y];r.forceAttribs = null;r.defaultAttribs = null;r.validAttribValues = null;px = r.tag.charAt(0);r.forceOpen = px == '+';r.removeEmpty = px == '-';r.fill = px == '#';r.tag = r.tag.replace(/\+|-|#/g, '');r.oTagName = tn[0].replace(/\+|-|#/g, '').toLowerCase();r.isWild = new RegExp('\\*|\\?|\\+', 'g').test(r.tag);r.validRe = new RegExp(this._wildcardToRe('^' + r.tag + '$'));if (p.length > 1) {r.vAttribsRe = '^(';a = this.split(/\|/, p[1]);for (i=0; i<a.length; i++) {t = a[i];if (t.charAt(0) == '!') {a[i] = t = t.substring(1);if (!r.reqAttribsRe)r.reqAttribsRe = '\\s+(' + t;else
r.reqAttribsRe += '|' + t;}av = new RegExp('(=|:|<)(.*?)$').exec(t);t = t.replace(new RegExp('(=|:|<).*?$'), '');if (av && av.length > 0) {if (av[0].charAt(0) == ':') {if (!r.forceAttribs)r.forceAttribs = tinyMCE.clearArray([]);r.forceAttribs[t.toLowerCase()] = av[0].substring(1);} else if (av[0].charAt(0) == '=') {if (!r.defaultAttribs)r.defaultAttribs = tinyMCE.clearArray([]);dv = av[0].substring(1);r.defaultAttribs[t.toLowerCase()] = dv == '' ? "mce_empty" : dv;} else if (av[0].charAt(0) == '<') {if (!r.validAttribValues)r.validAttribValues = tinyMCE.clearArray([]);r.validAttribValues[t.toLowerCase()] = this._arrayToRe(this.split('?', av[0].substring(1)), 'i');}}r.vAttribsRe += '' + t.toLowerCase() + (i != a.length - 1 ? '|' : '');a[i] = t.toLowerCase();}if (r.reqAttribsRe)r.reqAttribsRe = new RegExp(r.reqAttribsRe + ')=\"', 'g');r.vAttribsRe += ')$';r.vAttribsRe = this._wildcardToRe(r.vAttribsRe);r.vAttribsReIsWild = new RegExp('\\*|\\?|\\+', 'g').test(r.vAttribsRe);r.vAttribsRe = new RegExp(r.vAttribsRe);r.vAttribs = a.reverse();} else {r.vAttribsRe = '';r.vAttribs = tinyMCE.clearArray([]);r.vAttribsReIsWild = false;}or[r.tag] = r;}}return or;},
serializeNodeAsXML : function(n) {var s, b;if (!this.xmlDoc) {if (this.isIE) {try {this.xmlDoc = new ActiveXObject('MSXML2.DOMDocument');} catch (e) {}if (!this.xmlDoc)try {this.xmlDoc = new ActiveXObject('Microsoft.XmlDom');} catch (e) {}} else
this.xmlDoc = document.implementation.createDocument('', '', null);if (!this.xmlDoc)alert("Error XML Parser could not be found.");}if (this.xmlDoc.firstChild)this.xmlDoc.removeChild(this.xmlDoc.firstChild);b = this.xmlDoc.createElement("html");b = this.xmlDoc.appendChild(b);this._convertToXML(n, b);if (this.isIE)return this.xmlDoc.xml;else
return new XMLSerializer().serializeToString(this.xmlDoc);},
_convertToXML : function(n, xn) {var xd, el, i, l, cn, at, no, hc = false;if (tinyMCE.isRealIE && this._isDuplicate(n))return;xd = this.xmlDoc;switch (n.nodeType) {case 1:hc = n.hasChildNodes();el = xd.createElement(n.nodeName.toLowerCase());at = n.attributes;for (i=at.length-1; i>-1; i--) {no = at[i];if (no.specified && no.nodeValue)el.setAttribute(no.nodeName.toLowerCase(), no.nodeValue);}if (!hc && !this.closeElementsRe.test(n.nodeName))el.appendChild(xd.createTextNode(""));xn = xn.appendChild(el);break;case 3:xn.appendChild(xd.createTextNode(n.nodeValue));return;case 8:xn.appendChild(xd.createComment(n.nodeValue));return;}if (hc) {cn = n.childNodes;for (i=0, l=cn.length; i<l; i++)this._convertToXML(cn[i], xn);}},
serializeNodeAsHTML : function(n, inn) {var en, no, h = '', i, l, t, st, r, cn, va = false, f = false, at, hc, cr, nn;if (!this.rulesDone)this._setupRules();if (tinyMCE.isRealIE && this._isDuplicate(n))return '';if (n.parentNode && this.childRules != null) {cr = this.childRules[n.parentNode.nodeName];if (typeof(cr) != "undefined" && !cr.test(n.nodeName)) {st = true;t = null;}}switch (n.nodeType) {case 1:hc = n.hasChildNodes();if (st)break;nn = n.nodeName;if (tinyMCE.isRealIE) {if (n.nodeName.indexOf('/') != -1)break;if (n.scopeName && n.scopeName != 'HTML')nn = n.scopeName.toUpperCase() + ':' + nn.toUpperCase();} else if (tinyMCE.isOpera && nn.indexOf(':') > 0)nn = nn.toUpperCase();if (this.settings.convert_fonts_to_spans) {if (this.settings.on_save && nn == 'FONT')nn = 'SPAN';if (!this.settings.on_save && nn == 'SPAN')nn = 'FONT';}if (this.vElementsRe.test(nn) && (!this.iveRe || !this.iveRe.test(nn)) && !inn) {va = true;r = this.rules[nn];if (!r) {at = this.rules;for (no in at) {if (at[no] && at[no].validRe.test(nn)) {r = at[no];break;}}}en = r.isWild ? nn.toLowerCase() : r.oTagName;f = r.fill;if (r.removeEmpty && !hc)return "";t = '<' + en;if (r.vAttribsReIsWild) {at = n.attributes;for (i=at.length-1; i>-1; i--) {no = at[i];if (no.specified && r.vAttribsRe.test(no.nodeName))t += this._serializeAttribute(n, r, no.nodeName);}} else {for (i=r.vAttribs.length-1; i>-1; i--)t += this._serializeAttribute(n, r, r.vAttribs[i]);}if (!this.settings.on_save) {at = this.mceAttribs;for (no in at) {if (at[no])t += this._serializeAttribute(n, r, at[no]);}}if (r.reqAttribsRe && !t.match(r.reqAttribsRe))t = null;if (t != null && this.closeElementsRe.test(nn))return t + ' />';if (t != null)h += t + '>';if (this.isIE && this.codeElementsRe.test(nn))h += n.innerHTML;}break;case 3:if (st)break;if (n.parentNode && this.codeElementsRe.test(n.parentNode.nodeName))return this.isIE ? '' : n.nodeValue;return this.xmlEncode(n.nodeValue);case 8:if (st)break;return "<!--" + this._trimComment(n.nodeValue) + "-->";}if (hc) {cn = n.childNodes;for (i=0, l=cn.length; i<l; i++)h += this.serializeNodeAsHTML(cn[i]);}if (f && !hc)h += this.fillStr;if (t != null && va)h += '</' + en + '>';return h;},
_serializeAttribute : function(n, r, an) {var av = '', t, os = this.settings.on_save;if (os && (an.indexOf('mce_') == 0 || an.indexOf('_moz') == 0))return '';if (os && this.mceAttribs[an])av = this._getAttrib(n, this.mceAttribs[an]);if (av.length == 0)av = this._getAttrib(n, an);if (av.length == 0 && r.defaultAttribs && (t = r.defaultAttribs[an])) {av = t;if (av == "mce_empty")return " " + an + '=""';}if (r.forceAttribs && (t = r.forceAttribs[an]))av = t;if (os && av.length != 0 && /^(src|href|longdesc)$/.test(an))av = this._urlConverter(this, n, av);if (av.length != 0 && r.validAttribValues && r.validAttribValues[an] && !r.validAttribValues[an].test(av))return "";if (av.length != 0 && av == "{$uid}")av = "uid_" + (this.idCount++);if (av.length != 0) {if (an.indexOf('on') != 0)av = this.xmlEncode(av, 1);return " " + an + "=" + '"' + av + '"';}return "";},
formatHTML : function(h) {var s = this.settings, p = '', i = 0, li = 0, o = '', l;h = h.replace(/<pre([^>]*)>(.*?)<\/pre>/gi, function (a, b, c) {c = c.replace(/<br\s*\/>/gi, '\n');return '<pre' + b + '>' + c + '</pre>';});h = h.replace(/\r/g, '');h = '\n' + h;h = h.replace(new RegExp('\\n\\s+', 'gi'), '\n');h = h.replace(this.nlBeforeRe, '\n<$1$2>');h = h.replace(this.nlAfterRe, '<$1$2>\n');h = h.replace(this.nlBeforeAfterRe, '\n<$1$2$3>\n');h += '\n';while ((i = h.indexOf('\n', i + 1)) != -1) {if ((l = h.substring(li + 1, i)).length != 0) {if (this.ouRe.test(l) && p.length >= s.indent_levels)p = p.substring(s.indent_levels);o += p + l + '\n';if (this.inRe.test(l))p += this.inStr;}li = i;}return o;},
xmlEncode : function(s) {var cl = this, re = this.xmlEncodeRe;if (!this.entitiesDone)this._setupEntities();switch (this.settings.entity_encoding) {case "raw":return tinyMCE.xmlEncode(s);case "named":return s.replace(re, function (c) {var b = cl.entities[c.charCodeAt(0)];return b ? '&' + b + ';' : c;});case "numeric":return s.replace(re, function (c) {return '&#' + c.charCodeAt(0) + ';';});}return s;},
split : function(re, s) {var i, l, o = [], c = s.split(re);for (i=0, l=c.length; i<l; i++) {if (c[i] !== '')o[i] = c[i];}return o;},
_trimComment : function(s) {s = s.replace(new RegExp('\\smce_src=\"[^\"]*\"', 'gi'), "");s = s.replace(new RegExp('\\smce_href=\"[^\"]*\"', 'gi'), "");return s;},
_getAttrib : function(e, n, d) {var v, ex, nn;if (typeof(d) == "undefined")d = "";if (!e || e.nodeType != 1)return d;try {v = e.getAttribute(n, 0);} catch (ex) {v = e.getAttribute(n, 2);}if (n == "class" && !v)v = e.className;if (this.isIE) {if (n == "http-equiv")v = e.httpEquiv;nn = e.nodeName;if (nn == "FORM" && n == "enctype" && v == "application/x-www-form-urlencoded")v = "";if (nn == "INPUT" && n == "size" && v == "20")v = "";if (nn == "INPUT" && n == "maxlength" && v == "2147483647")v = "";if (n == "width" || n == "height")v = e.getAttribute(n, 2);}if (n == 'style' && v) {if (!tinyMCE.isOpera)v = e.style.cssText;v = tinyMCE.serializeStyle(tinyMCE.parseStyle(v));}if (this.settings.on_save && n.indexOf('on') != -1 && this.settings.on_save && v && v !== '')v = tinyMCE.cleanupEventStr(v);return (v && v !== '') ? '' + v : d;},
_urlConverter : function(c, n, v) {if (!c.settings.on_save)return tinyMCE.convertRelativeToAbsoluteURL(tinyMCE.settings.base_href, v);else if (tinyMCE.getParam('convert_urls')) {if (!this.urlConverter)this.urlConverter = eval(tinyMCE.settings.urlconverter_callback);return this.urlConverter(v, n, true);}return v;},
_arrayToRe : function(a, op, be, af) {var i, r;op = typeof(op) == "undefined" ? "gi" : op;be = typeof(be) == "undefined" ? "^(" : be;af = typeof(af) == "undefined" ? ")$" : af;r = be;for (i=0; i<a.length; i++)r += this._wildcardToRe(a[i]) + (i != a.length-1 ? "|" : "");r += af;return new RegExp(r, op);},
_wildcardToRe : function(s) {s = s.replace(/\?/g, '(\\S?)');s = s.replace(/\+/g, '(\\S+)');s = s.replace(/\*/g, '(\\S*)');return s;},
_setupEntities : function() {var n, a, i, s = this.settings;if (s.entity_encoding == "named") {n = tinyMCE.clearArray([]);a = this.split(',', s.entities);for (i=0; i<a.length; i+=2)n[a[i]] = a[i+1];this.entities = n;}this.entitiesDone = true;},
_setupRules : function() {var s = this.settings;this.addRuleStr(s.valid_elements);this.addRuleStr(s.extended_valid_elements);this.addChildRemoveRuleStr(s.valid_child_elements);this.rulesDone = true;},
_isDuplicate : function(n) {var i, l, sn;if (!this.settings.fix_content_duplication)return false;if (tinyMCE.isRealIE && n.nodeType == 1) {if (n.mce_serialized == this.serializationId)return true;n.setAttribute('mce_serialized', this.serializationId);} else {sn = this.serializedNodes;for (i=0, l = sn.length; i<l; i++) {if (sn[i] == n)return true;}sn.push(n);}return false;}};tinyMCE.add(TinyMCE_Engine, {createTagHTML : function(tn, a, h) {var o = '', f = tinyMCE.xmlEncode, n;o = '<' + tn;if (a) {for (n in a) {if (typeof(a[n]) != 'function' && a[n] != null)o += ' ' + f(n) + '="' + f('' + a[n]) + '"';}}o += !h ? ' />' : '>' + h + '</' + tn + '>';return o;},
createTag : function(d, tn, a, h) {var o = d.createElement(tn), n;if (a) {for (n in a) {if (typeof(a[n]) != 'function' && a[n] != null)tinyMCE.setAttrib(o, n, a[n]);}}if (h)o.innerHTML = h;return o;},
getElementByAttributeValue : function(n, e, a, v) {return (n = this.getElementsByAttributeValue(n, e, a, v)).length == 0 ? null : n[0];},
getElementsByAttributeValue : function(n, e, a, v) {var i, nl = n.getElementsByTagName(e), o = [];for (i=0; i<nl.length; i++) {if (tinyMCE.getAttrib(nl[i], a).indexOf(v) != -1)o[o.length] = nl[i];}return o;},
isBlockElement : function(n) {return n != null && n.nodeType == 1 && this.blockRegExp.test(n.nodeName);},
getParentBlockElement : function(n, r) {return this.getParentNode(n, function(n) {return tinyMCE.isBlockElement(n);}, r);return null;},
insertAfter : function(n, r){if (r.nextSibling)r.parentNode.insertBefore(n, r.nextSibling);else
r.parentNode.appendChild(n);},
setInnerHTML : function(e, h) {var i, nl, n;if (tinyMCE.isGecko) {h = h.replace(/<embed([^>]*)>/gi, '<tmpembed$1>');h = h.replace(/<em([^>]*)>/gi, '<i$1>');h = h.replace(/<tmpembed([^>]*)>/gi, '<embed$1>');h = h.replace(/<strong([^>]*)>/gi, '<b$1>');h = h.replace(/<\/strong>/gi, '</b>');h = h.replace(/<\/em>/gi, '</i>');}if (tinyMCE.isRealIE) {h = h.replace(/\s\/>/g, '>');h = h.replace(/<p([^>]*)>\u00A0?<\/p>/gi, '<p$1 mce_keep="true">&nbsp;</p>');h = h.replace(/<p([^>]*)>\s*&nbsp;\s*<\/p>/gi, '<p$1 mce_keep="true">&nbsp;</p>');h = h.replace(/<p([^>]*)>\s+<\/p>/gi, '<p$1 mce_keep="true">&nbsp;</p>');e.innerHTML = tinyMCE.uniqueTag + h;e.firstChild.removeNode(true);nl = e.getElementsByTagName("p");for (i=nl.length-1; i>=0; i--) {n = nl[i];if (n.nodeName == 'P' && !n.hasChildNodes() && !n.mce_keep)n.parentNode.removeChild(n);}} else {h = this.fixGeckoBaseHREFBug(1, e, h);e.innerHTML = h;this.fixGeckoBaseHREFBug(2, e, h);}},
getOuterHTML : function(e) {var d;if (tinyMCE.isIE)return e.outerHTML;d = e.ownerDocument.createElement("body");d.appendChild(e.cloneNode(true));return d.innerHTML;},
setOuterHTML : function(e, h, d) {var d = typeof(d) == "undefined" ? e.ownerDocument : d, i, nl, t;if (tinyMCE.isIE && e.nodeType == 1)e.outerHTML = h;else {t = d.createElement("body");t.innerHTML = h;for (i=0, nl=t.childNodes; i<nl.length; i++)e.parentNode.insertBefore(nl[i].cloneNode(true), e);e.parentNode.removeChild(e);}},
_getElementById : function(id, d) {var e, i, j, f;if (typeof(d) == "undefined")d = document;e = d.getElementById(id);if (!e) {f = d.forms;for (i=0; i<f.length; i++) {for (j=0; j<f[i].elements.length; j++) {if (f[i].elements[j].name == id) {e = f[i].elements[j];break;}}}}return e;},
getNodeTree : function(n, na, t, nn) {return this.selectNodes(n, function(n) {return (!t || n.nodeType == t) && (!nn || n.nodeName == nn);}, na ? na : []);},
getParentElement : function(n, na, f, r) {var re = na ? new RegExp('^(' + na.toUpperCase().replace(/,/g, '|') + ')$') : 0, v;if (f && typeof(f) == 'string')return this.getParentElement(n, na, function(no) {return tinyMCE.getAttrib(no, f) !== '';});return this.getParentNode(n, function(n) {return ((n.nodeType == 1 && !re) || (re && re.test(n.nodeName))) && (!f || f(n));}, r);},
getParentNode : function(n, f, r) {while (n) {if (n == r)return null;if (f(n))return n;n = n.parentNode;}return null;},
getAttrib : function(elm, name, dv) {var v;if (typeof(dv) == "undefined")dv = "";if (!elm || elm.nodeType != 1)return dv;try {v = elm.getAttribute(name, 0);} catch (ex) {v = elm.getAttribute(name, 2);}if (name == "class" && !v)v = elm.className;if (tinyMCE.isGecko) {if (name == "src" && elm.src != null && elm.src !== '')v = elm.src;if (name == "href" && elm.href != null && elm.href !== '')v = elm.href;} else if (tinyMCE.isIE) {switch (name) {case "http-equiv":v = elm.httpEquiv;break;case "width":case "height":v = elm.getAttribute(name, 2);break;}}if (name == "style" && !tinyMCE.isOpera)v = elm.style.cssText;return (v && v !== '') ? v : dv;},
setAttrib : function(el, name, va, fix) {if (typeof(va) == "number" && va != null)va = "" + va;if (fix) {if (va == null)va = "";va = va.replace(/[^0-9%]/g, '');}if (name == "style")el.style.cssText = va;if (name == "class")el.className = va;if (va != null && va !== '' && va != -1)el.setAttribute(name, va);else
el.removeAttribute(name);},
setStyleAttrib : function(e, n, v) {e.style[n] = v;if (tinyMCE.isIE && v == null || v == '') {v = tinyMCE.serializeStyle(tinyMCE.parseStyle(e.style.cssText));e.style.cssText = v;e.setAttribute("style", v);}},
switchClass : function(ei, c) {var e;if (tinyMCE.switchClassCache[ei])e = tinyMCE.switchClassCache[ei];else
e = tinyMCE.switchClassCache[ei] = document.getElementById(ei);if (e) {if (tinyMCE.settings.button_tile_map && e.className && e.className.indexOf('mceTiledButton') == 0)c = 'mceTiledButton ' + c;e.className = c;}},
getAbsPosition : function(n, cn) {var l = 0, t = 0;while (n && n != cn) {l += n.offsetLeft;t += n.offsetTop;n = n.offsetParent;}return {absLeft : l, absTop : t};},
prevNode : function(e, n) {var a = n.split(','), i;while ((e = e.previousSibling) != null) {for (i=0; i<a.length; i++) {if (e.nodeName == a[i])return e;}}return null;},
nextNode : function(e, n) {var a = n.split(','), i;while ((e = e.nextSibling) != null) {for (i=0; i<a.length; i++) {if (e.nodeName == a[i])return e;}}return null;},
selectElements : function(n, na, f) {var i, a = [], nl, x;for (x=0, na = na.split(','); x<na.length; x++)for (i=0, nl = n.getElementsByTagName(na[x]); i<nl.length; i++)(!f || f(nl[i])) && a.push(nl[i]);return a;},
selectNodes : function(n, f, a) {var i;if (!a)a = [];if (f(n))a[a.length] = n;if (n.hasChildNodes()) {for (i=0; i<n.childNodes.length; i++)tinyMCE.selectNodes(n.childNodes[i], f, a);}return a;},
addCSSClass : function(e, c, b) {var o = this.removeCSSClass(e, c);return e.className = b ? c + (o !== '' ? (' ' + o) : '') : (o !== '' ? (o + ' ') : '') + c;},
removeCSSClass : function(e, c) {c = e.className.replace(new RegExp("(^|\\s+)" + c + "(\\s+|$)"), ' ');return e.className = c != ' ' ? c : '';},
hasCSSClass : function(n, c) {return new RegExp('\\b' + c + '\\b', 'g').test(n.className);},
renameElement : function(e, n, d) {var ne, i, ar;d = typeof(d) == "undefined" ? tinyMCE.selectedInstance.getDoc() : d;if (e) {ne = d.createElement(n);ar = e.attributes;for (i=ar.length-1; i>-1; i--) {if (ar[i].specified && ar[i].nodeValue)ne.setAttribute(ar[i].nodeName.toLowerCase(), ar[i].nodeValue);}ar = e.childNodes;for (i=0; i<ar.length; i++)ne.appendChild(ar[i].cloneNode(true));e.parentNode.replaceChild(ne, e);}},
getViewPort : function(w) {var d = w.document, m = d.compatMode == 'CSS1Compat', b = d.body, de = d.documentElement;return {left : w.pageXOffset || (m ? de.scrollLeft : b.scrollLeft),
top : w.pageYOffset || (m ? de.scrollTop : b.scrollTop),
width : w.innerWidth || (m ? de.clientWidth : b.clientWidth),
height : w.innerHeight || (m ? de.clientHeight : b.clientHeight)};},
getStyle : function(n, na, d) {if (!n)return false;if (tinyMCE.isGecko && n.ownerDocument.defaultView) {try {return n.ownerDocument.defaultView.getComputedStyle(n, null).getPropertyValue(na);} catch (n) {return null;}}na = na.replace(/-(\D)/g, function(a, b){return b.toUpperCase();});if (n.currentStyle)return n.currentStyle[na];return false;}});tinyMCE.add(TinyMCE_Engine, {parseURL : function(url_str) {var urlParts = [], i, pos, lastPos, chr;if (url_str) {pos = url_str.indexOf('://');if (pos != -1) {urlParts.protocol = url_str.substring(0, pos);lastPos = pos + 3;}for (i=lastPos; i<url_str.length; i++) {chr = url_str.charAt(i);if (chr == ':')break;if (chr == '/')break;}pos = i;urlParts.host = url_str.substring(lastPos, pos);urlParts.port = "";lastPos = pos;if (url_str.charAt(pos) == ':') {pos = url_str.indexOf('/', lastPos);urlParts.port = url_str.substring(lastPos+1, pos);}lastPos = pos;pos = url_str.indexOf('?', lastPos);if (pos == -1)pos = url_str.indexOf('#', lastPos);if (pos == -1)pos = url_str.length;urlParts.path = url_str.substring(lastPos, pos);lastPos = pos;if (url_str.charAt(pos) == '?') {pos = url_str.indexOf('#');pos = (pos == -1) ? url_str.length : pos;urlParts.query = url_str.substring(lastPos+1, pos);}lastPos = pos;if (url_str.charAt(pos) == '#') {pos = url_str.length;urlParts.anchor = url_str.substring(lastPos+1, pos);}}return urlParts;},
serializeURL : function(up) {var o = "";if (up.protocol)o += up.protocol + "://";if (up.host)o += up.host;if (up.port)o += ":" + up.port;if (up.path)o += up.path;if (up.query)o += "?" + up.query;if (up.anchor)o += "#" + up.anchor;return o;},
convertAbsoluteURLToRelativeURL : function(base_url, url_to_relative) {var baseURL = this.parseURL(base_url), targetURL = this.parseURL(url_to_relative);var i, strTok1, strTok2, breakPoint = 0, outPath = "", forceSlash = false;var fileName, pos;if (targetURL.path == '')targetURL.path = "/";else
forceSlash = true;base_url = baseURL.path.substring(0, baseURL.path.lastIndexOf('/'));strTok1 = base_url.split('/');strTok2 = targetURL.path.split('/');if (strTok1.length >= strTok2.length) {for (i=0; i<strTok1.length; i++) {if (i >= strTok2.length || strTok1[i] != strTok2[i]) {breakPoint = i + 1;break;}}}if (strTok1.length < strTok2.length) {for (i=0; i<strTok2.length; i++) {if (i >= strTok1.length || strTok1[i] != strTok2[i]) {breakPoint = i + 1;break;}}}if (breakPoint == 1)return targetURL.path;for (i=0; i<(strTok1.length-(breakPoint-1)); i++)outPath += "../";for (i=breakPoint-1; i<strTok2.length; i++) {if (i != (breakPoint-1))outPath += "/" + strTok2[i];else
outPath += strTok2[i];}targetURL.protocol = null;targetURL.host = null;targetURL.port = null;targetURL.path = outPath == '' && forceSlash ? "/" : outPath;fileName = baseURL.path;if ((pos = fileName.lastIndexOf('/')) != -1)fileName = fileName.substring(pos + 1);if (fileName == targetURL.path && targetURL.anchor !== '')targetURL.path = "";if (targetURL.path == '' && !targetURL.anchor)targetURL.path = fileName !== '' ? fileName : "/";return this.serializeURL(targetURL);},
convertRelativeToAbsoluteURL : function(base_url, relative_url) {var baseURL = this.parseURL(base_url), baseURLParts, relURLParts, newRelURLParts, numBack, relURL = this.parseURL(relative_url), i;var len, absPath, start, end, newBaseURLParts;if (relative_url == '' || relative_url.indexOf('://') != -1 || /^(mailto:|javascript:|#|\/)/.test(relative_url))return relative_url;baseURLParts = baseURL.path.split('/');relURLParts = relURL.path.split('/');newBaseURLParts = [];for (i=baseURLParts.length-1; i>=0; i--) {if (baseURLParts[i].length == 0)continue;newBaseURLParts[newBaseURLParts.length] = baseURLParts[i];}baseURLParts = newBaseURLParts.reverse();newRelURLParts = [];numBack = 0;for (i=relURLParts.length-1; i>=0; i--) {if (relURLParts[i].length == 0 || relURLParts[i] == ".")continue;if (relURLParts[i] == '..') {numBack++;continue;}if (numBack > 0) {numBack--;continue;}newRelURLParts[newRelURLParts.length] = relURLParts[i];}relURLParts = newRelURLParts.reverse();len = baseURLParts.length-numBack;absPath = (len <= 0 ? "" : "/") + baseURLParts.slice(0, len).join('/') + "/" + relURLParts.join('/');start = "";end = "";relURL.protocol = baseURL.protocol;relURL.host = baseURL.host;relURL.port = baseURL.port;if (relURL.path.charAt(relURL.path.length-1) == "/")absPath += "/";relURL.path = absPath;return this.serializeURL(relURL);},
convertURL : function(url, node, on_save) {var dl = document.location, start, portPart, urlParts, baseUrlParts, tmpUrlParts, curl;var prot = dl.protocol, host = dl.hostname, port = dl.port;if (prot == "file:")return url;url = tinyMCE.regexpReplace(url, '(http|https):///', '/');if (url.indexOf('mailto:') != -1 || url.indexOf('javascript:') != -1 || /^[ \t\r\n\+]*[#\?]/.test(url))return url;if (!tinyMCE.isIE && !on_save && url.indexOf("://") == -1 && url.charAt(0) != '/')return tinyMCE.settings.base_href + url;if (on_save && tinyMCE.getParam('relative_urls')) {curl = tinyMCE.convertRelativeToAbsoluteURL(tinyMCE.settings.base_href, url);if (curl.charAt(0) == '/')curl = tinyMCE.settings.document_base_prefix + curl;urlParts = tinyMCE.parseURL(curl);tmpUrlParts = tinyMCE.parseURL(tinyMCE.settings.document_base_url);if (urlParts.host == tmpUrlParts.host && (urlParts.port == tmpUrlParts.port))return tinyMCE.convertAbsoluteURLToRelativeURL(tinyMCE.settings.document_base_url, curl);}if (!tinyMCE.getParam('relative_urls')) {urlParts = tinyMCE.parseURL(url);baseUrlParts = tinyMCE.parseURL(tinyMCE.settings.base_href);url = tinyMCE.convertRelativeToAbsoluteURL(tinyMCE.settings.base_href, url);if (urlParts.anchor && urlParts.path == baseUrlParts.path)return "#" + urlParts.anchor;}if (tinyMCE.getParam('remove_script_host')) {start = "";portPart = "";if (port !== '')portPart = ":" + port;start = prot + "//" + host + portPart + "/";if (url.indexOf(start) == 0)url = url.substring(start.length-1);}return url;},
convertAllRelativeURLs : function(body) {var i, elms, src, href, mhref, msrc;elms = body.getElementsByTagName("img");for (i=0; i<elms.length; i++) {src = tinyMCE.getAttrib(elms[i], 'src');msrc = tinyMCE.getAttrib(elms[i], 'mce_src');if (msrc !== '')src = msrc;if (src !== '') {src = tinyMCE.convertRelativeToAbsoluteURL(tinyMCE.settings.base_href, src);elms[i].setAttribute("src", src);}}elms = body.getElementsByTagName("a");for (i=0; i<elms.length; i++) {href = tinyMCE.getAttrib(elms[i], 'href');mhref = tinyMCE.getAttrib(elms[i], 'mce_href');if (mhref !== '')href = mhref;if (href && href !== '') {href = tinyMCE.convertRelativeToAbsoluteURL(tinyMCE.settings.base_href, href);elms[i].setAttribute("href", href);}}}});tinyMCE.add(TinyMCE_Engine, {clearArray : function(a) {var n;for (n in a)a[n] = null;return a;},
explode : function(d, s) {var ar = s.split(d), oar = [], i;for (i = 0; i<ar.length; i++) {if (ar[i] !== '')oar[oar.length] = ar[i];}return oar;}});tinyMCE.add(TinyMCE_Engine, {_setEventsEnabled : function(node, state) {var evs, x, y, elms, i, event;var events = ['onfocus','onblur','onclick','ondblclick',
'onmousedown','onmouseup','onmouseover','onmousemove',
'onmouseout','onkeypress','onkeydown','onkeydown','onkeyup'];evs = tinyMCE.settings.event_elements.split(',');for (y=0; y<evs.length; y++){elms = node.getElementsByTagName(evs[y]);for (i=0; i<elms.length; i++) {event = "";for (x=0; x<events.length; x++) {if ((event = tinyMCE.getAttrib(elms[i], events[x])) !== '') {event = tinyMCE.cleanupEventStr("" + event);if (!state)event = "return true;" + event;else
event = event.replace(/^return true;/gi, '');elms[i].removeAttribute(events[x]);elms[i].setAttribute(events[x], event);}}}}},
_eventPatch : function(editor_id) {var n, inst, win, e;if (typeof(tinyMCE) == "undefined")return true;try {if (tinyMCE.selectedInstance) {win = tinyMCE.selectedInstance.getWin();if (win && win.event) {e = win.event;if (!e.target)e.target = e.srcElement;TinyMCE_Engine.prototype.handleEvent(e);return;}}for (n in tinyMCE.instances) {inst = tinyMCE.instances[n];if (!tinyMCE.isInstance(inst))continue;inst.select();win = inst.getWin();if (win && win.event) {e = win.event;if (!e.target)e.target = e.srcElement;TinyMCE_Engine.prototype.handleEvent(e);return;}}} catch (ex) {}},
findEvent : function(e) {var n, inst;if (e)return e;for (n in tinyMCE.instances) {inst = tinyMCE.instances[n];if (tinyMCE.isInstance(inst) && inst.getWin().event)return inst.getWin().event;}return null;},
unloadHandler : function() {tinyMCE.triggerSave(true, true);},
addEventHandlers : function(inst) {this.setEventHandlers(inst, 1);},
setEventHandlers : function(inst, s) {var doc = inst.getDoc(), ie, ot, i, f = s ? tinyMCE.addEvent : tinyMCE.removeEvent;ie = ['keypress', 'keyup', 'keydown', 'click', 'mouseup', 'mousedown', 'controlselect', 'dblclick'];ot = ['keypress', 'keyup', 'keydown', 'click', 'mouseup', 'mousedown', 'focus', 'blur', 'dragdrop'];inst.switchSettings();if (tinyMCE.isIE) {for (i=0; i<ie.length; i++)f(doc, ie[i], TinyMCE_Engine.prototype._eventPatch);} else {for (i=0; i<ot.length; i++)f(doc, ot[i], tinyMCE.handleEvent);try {doc.designMode = "On";} catch (e) {}}},
onMouseMove : function() {var inst, lh;if (tinyMCE.lastHover) {lh = tinyMCE.lastHover;if (lh.className.indexOf('mceMenu') != -1)tinyMCE._menuButtonEvent('out', lh);else
lh.className = lh.className;tinyMCE.lastHover = null;}if (!tinyMCE.hasMouseMoved) {inst = tinyMCE.selectedInstance;if (inst.isFocused) {inst.undoBookmark = inst.selection.getBookmark();tinyMCE.hasMouseMoved = true;}}},
cancelEvent : function(e) {if (!e)return false;if (tinyMCE.isIE) {e.returnValue = false;e.cancelBubble = true;} else {e.preventDefault();e.stopPropagation && e.stopPropagation();}return false;},
addEvent : function(o, n, h) {if (n != 'unload') {function clean() {var ex;try {tinyMCE.removeEvent(o, n, h);tinyMCE.removeEvent(window, 'unload', clean);o = n = h = null;} catch (ex) {}}tinyMCE.addEvent(window, 'unload', clean);}if (o.attachEvent)o.attachEvent("on" + n, h);else
o.addEventListener(n, h, false);},
removeEvent : function(o, n, h) {if (o.detachEvent)o.detachEvent("on" + n, h);else
o.removeEventListener(n, h, false);},
addSelectAccessibility : function(e, s, w) {if (!s._isAccessible) {s.onkeydown = tinyMCE.accessibleEventHandler;s.onblur = tinyMCE.accessibleEventHandler;s._isAccessible = true;s._win = w;}return false;},
accessibleEventHandler : function(e) {var elm, win = this._win;e = tinyMCE.isIE ? win.event : e;elm = tinyMCE.isIE ? e.srcElement : e.target;if (e.type == "blur") {if (elm.oldonchange) {elm.onchange = elm.oldonchange;elm.oldonchange = null;}return true;}if (elm.nodeName == "SELECT" && !elm.oldonchange) {elm.oldonchange = elm.onchange;elm.onchange = null;}if (e.keyCode == 13 || e.keyCode == 32) {elm.onchange = elm.oldonchange;elm.onchange();elm.oldonchange = null;tinyMCE.cancelEvent(e);return false;}return true;},
_resetIframeHeight : function() {var ife;if (tinyMCE.isRealIE) {ife = tinyMCE.selectedInstance.iframeElement;if (ife._oldHeight) {ife.style.height = ife._oldHeight;ife.height = ife._oldHeight;}}}});function TinyMCE_Selection(inst) {this.instance = inst;};TinyMCE_Selection.prototype = {getSelectedHTML : function() {var inst = this.instance, e, r = this.getRng(), h;if (!r)return null;e = document.createElement("body");if (r.cloneContents)e.appendChild(r.cloneContents());else if (typeof(r.item) != 'undefined' || typeof(r.htmlText) != 'undefined')e.innerHTML = r.item ? r.item(0).outerHTML : r.htmlText;else
e.innerHTML = r.toString();h = tinyMCE._cleanupHTML(inst, inst.contentDocument, inst.settings, e, e, false, true, false);return h;},
getSelectedText : function() {var inst = this.instance, d, r, s, t;if (tinyMCE.isIE) {d = inst.getDoc();if (d.selection.type == "Text") {r = d.selection.createRange();t = r.text;} else
t = '';} else {s = this.getSel();if (s && s.toString)t = s.toString();else
t = '';}return t;},
getBookmark : function(simple) {var inst = this.instance, rng = this.getRng(), doc = inst.getDoc(), b = inst.getBody();var trng, sx, sy, xx = -999999999, vp = inst.getViewPort();var sp, le, s, e, nl, i, si, ei, w;sx = vp.left;sy = vp.top;if (simple)return {rng : rng, scrollX : sx, scrollY : sy};if (tinyMCE.isRealIE) {if (rng.item) {e = rng.item(0);nl = b.getElementsByTagName(e.nodeName);for (i=0; i<nl.length; i++) {if (e == nl[i]) {sp = i;break;}}return {tag : e.nodeName,
index : sp,
scrollX : sx,
scrollY : sy
};} else {trng = doc.body.createTextRange();trng.moveToElementText(inst.getBody());trng.collapse(true);bp = Math.abs(trng.move('character', xx));trng = rng.duplicate();trng.collapse(true);sp = Math.abs(trng.move('character', xx));trng = rng.duplicate();trng.collapse(false);le = Math.abs(trng.move('character', xx)) - sp;return {start : sp - bp,
length : le,
scrollX : sx,
scrollY : sy
};}} else {s = this.getSel();e = this.getFocusElement();if (!s)return null;if (e && e.nodeName == 'IMG') {return {start : -1,
end : -1,
index : sp,
scrollX : sx,
scrollY : sy
};}if (s.anchorNode == s.focusNode && s.anchorOffset == s.focusOffset) {e = this._getPosText(b, s.anchorNode, s.focusNode);if (!e)return {scrollX : sx, scrollY : sy};return {start : e.start + s.anchorOffset,
end : e.end + s.focusOffset,
scrollX : sx,
scrollY : sy
};} else {e = this._getPosText(b, rng.startContainer, rng.endContainer);if (!e)return {scrollX : sx, scrollY : sy};return {start : e.start + rng.startOffset,
end : e.end + rng.endOffset,
scrollX : sx,
scrollY : sy
};}}return null;},
moveToBookmark : function(bookmark) {var inst = this.instance, rng, nl, i, ex, b = inst.getBody(), sd;var doc = inst.getDoc(), win = inst.getWin(), sel = this.getSel();if (!bookmark)return false;if (tinyMCE.isSafari && bookmark.rng) {sel.setBaseAndExtent(bookmark.rng.startContainer, bookmark.rng.startOffset, bookmark.rng.endContainer, bookmark.rng.endOffset);return true;}if (tinyMCE.isRealIE) {if (bookmark.rng) {try {bookmark.rng.select();} catch (ex) {}return true;}win.focus();if (bookmark.tag) {rng = b.createControlRange();nl = b.getElementsByTagName(bookmark.tag);if (nl.length > bookmark.index) {try {rng.addElement(nl[bookmark.index]);} catch (ex) {}}} else {try {if (bookmark.start < 0)return true;rng = inst.getSel().createRange();rng.moveToElementText(inst.getBody());rng.collapse(true);rng.moveStart('character', bookmark.start);rng.moveEnd('character', bookmark.length);} catch (ex) {return true;}}rng.select();win.scrollTo(bookmark.scrollX, bookmark.scrollY);return true;}if (tinyMCE.isGecko || tinyMCE.isOpera) {if (!sel)return false;if (bookmark.rng) {sel.removeAllRanges();sel.addRange(bookmark.rng);}if (bookmark.start != -1 && bookmark.end != -1) {try {sd = this._getTextPos(b, bookmark.start, bookmark.end);rng = doc.createRange();rng.setStart(sd.startNode, sd.startOffset);rng.setEnd(sd.endNode, sd.endOffset);sel.removeAllRanges();sel.addRange(rng);if (!tinyMCE.isOpera)win.focus();} catch (ex) {}}win.scrollTo(bookmark.scrollX, bookmark.scrollY);return true;}return false;},
_getPosText : function(r, sn, en) {var w = document.createTreeWalker(r, NodeFilter.SHOW_TEXT, null, false), n, p = 0, d = {};while ((n = w.nextNode()) != null) {if (n == sn)d.start = p;if (n == en) {d.end = p;return d;}p += n.nodeValue ? n.nodeValue.length : 0;}return null;},
_getTextPos : function(r, sp, ep) {var w = document.createTreeWalker(r, NodeFilter.SHOW_TEXT, null, false), n, p = 0, d = {};while ((n = w.nextNode()) != null) {p += n.nodeValue ? n.nodeValue.length : 0;if (p >= sp && !d.startNode) {d.startNode = n;d.startOffset = sp - (p - n.nodeValue.length);}if (p >= ep) {d.endNode = n;d.endOffset = ep - (p - n.nodeValue.length);return d;}}return null;},
selectNode : function(node, collapse, select_text_node, to_start) {var inst = this.instance, sel, rng, nodes;if (!node)return;if (typeof(collapse) == "undefined")collapse = true;if (typeof(select_text_node) == "undefined")select_text_node = false;if (typeof(to_start) == "undefined")to_start = true;if (inst.settings.auto_resize)inst.resizeToContent();if (tinyMCE.isRealIE) {rng = inst.getDoc().body.createTextRange();try {rng.moveToElementText(node);if (collapse)rng.collapse(to_start);rng.select();} catch (e) {}} else {sel = this.getSel();if (!sel)return;if (tinyMCE.isSafari) {sel.setBaseAndExtent(node, 0, node, node.innerText.length);if (collapse) {if (to_start)sel.collapseToStart();else
sel.collapseToEnd();}this.scrollToNode(node);return;}rng = inst.getDoc().createRange();if (select_text_node) {nodes = tinyMCE.getNodeTree(node, [], 3);if (nodes.length > 0)rng.selectNodeContents(nodes[0]);else
rng.selectNodeContents(node);} else
rng.selectNode(node);if (collapse) {if (!to_start && node.nodeType == 3) {rng.setStart(node, node.nodeValue.length);rng.setEnd(node, node.nodeValue.length);} else
rng.collapse(to_start);}sel.removeAllRanges();sel.addRange(rng);}this.scrollToNode(node);tinyMCE.selectedElement = null;if (node.nodeType == 1)tinyMCE.selectedElement = node;},
scrollToNode : function(node) {var inst = this.instance, w = inst.getWin(), vp = inst.getViewPort(), pos = tinyMCE.getAbsPosition(node), cvp, p, cwin;if (pos.absLeft < vp.left || pos.absLeft > vp.left + vp.width || pos.absTop < vp.top || pos.absTop > vp.top + (vp.height-25))w.scrollTo(pos.absLeft, pos.absTop - vp.height + 25);if (inst.settings.auto_resize) {cwin = inst.getContainerWin();cvp = tinyMCE.getViewPort(cwin);p = this.getAbsPosition(node);if (p.absLeft < cvp.left || p.absLeft > cvp.left + cvp.width || p.absTop < cvp.top || p.absTop > cvp.top + cvp.height)cwin.scrollTo(p.absLeft, p.absTop - cvp.height + 25);}},
getAbsPosition : function(n) {var pos = tinyMCE.getAbsPosition(n), ipos = tinyMCE.getAbsPosition(this.instance.iframeElement);return {absLeft : ipos.absLeft + pos.absLeft,
absTop : ipos.absTop + pos.absTop
};},
getSel : function() {var inst = this.instance;if (tinyMCE.isRealIE)return inst.getDoc().selection;return inst.contentWindow.getSelection();},
getRng : function() {var s = this.getSel();if (s == null)return null;if (tinyMCE.isRealIE)return s.createRange();if (tinyMCE.isSafari && !s.getRangeAt)return '' + window.getSelection();if (s.rangeCount > 0)return s.getRangeAt(0);return null;},
isCollapsed : function() {var r = this.getRng();if (r.item)return false;return r.boundingWidth == 0 || this.getSel().isCollapsed;},
collapse : function(b) {var r = this.getRng(), s = this.getSel();if (r.select) {r.collapse(b);r.select();} else {if (b)s.collapseToStart();else
s.collapseToEnd();}},
getFocusElement : function() {var inst = this.instance, doc, rng, sel, elm;if (tinyMCE.isRealIE) {doc = inst.getDoc();rng = doc.selection.createRange();elm = rng.item ? rng.item(0) : rng.parentElement();} else {if (!tinyMCE.isSafari && inst.isHidden())return inst.getBody();sel = this.getSel();rng = this.getRng();if (!sel || !rng)return null;elm = rng.commonAncestorContainer;if (!rng.collapsed) {if (rng.startContainer == rng.endContainer) {if (rng.startOffset - rng.endOffset < 2) {if (rng.startContainer.hasChildNodes())elm = rng.startContainer.childNodes[rng.startOffset];}}}elm = tinyMCE.getParentElement(elm);}return elm;}};function TinyMCE_UndoRedo(inst) {this.instance = inst;this.undoLevels = [];this.undoIndex = 0;this.typingUndoIndex = -1;this.undoRedo = true;};TinyMCE_UndoRedo.prototype = {add : function(l) {var b, customUndoLevels, newHTML, inst = this.instance, i, ul, ur;if (l) {this.undoLevels[this.undoLevels.length] = l;return true;}if (this.typingUndoIndex != -1) {this.undoIndex = this.typingUndoIndex;if (tinyMCE.typingUndoIndex != -1)tinyMCE.undoIndex = tinyMCE.typingUndoIndex;}newHTML = tinyMCE.trim(inst.getBody().innerHTML);if (this.undoLevels[this.undoIndex] && newHTML != this.undoLevels[this.undoIndex].content) {inst.isNotDirty = false;tinyMCE.dispatchCallback(inst, 'onchange_callback', 'onChange', inst);customUndoLevels = tinyMCE.settings.custom_undo_redo_levels;if (customUndoLevels != -1 && this.undoLevels.length > customUndoLevels) {for (i=0; i<this.undoLevels.length-1; i++)this.undoLevels[i] = this.undoLevels[i+1];this.undoLevels.length--;this.undoIndex--;}b = inst.undoBookmark;if (!b)b = inst.selection.getBookmark();this.undoIndex++;this.undoLevels[this.undoIndex] = {content : newHTML,
bookmark : b
};ul = tinyMCE.undoLevels;for (i=tinyMCE.undoIndex + 1; i<ul.length; i++) {ur = ul[i].undoRedo;if (ur.undoIndex == ur.undoLevels.length -1)ur.undoIndex--;ur.undoLevels.length--;}tinyMCE.undoLevels[tinyMCE.undoIndex++] = inst;tinyMCE.undoLevels.length = tinyMCE.undoIndex;this.undoLevels.length = this.undoIndex + 1;return true;}return false;},
undo : function() {var inst = this.instance;if (this.undoIndex > 0) {this.undoIndex--;tinyMCE.setInnerHTML(inst.getBody(), this.undoLevels[this.undoIndex].content);inst.repaint();if (inst.settings.custom_undo_redo_restore_selection)inst.selection.moveToBookmark(this.undoLevels[this.undoIndex].bookmark);}},
redo : function() {var inst = this.instance;tinyMCE.execCommand("mceEndTyping");if (this.undoIndex < (this.undoLevels.length-1)) {this.undoIndex++;tinyMCE.setInnerHTML(inst.getBody(), this.undoLevels[this.undoIndex].content);inst.repaint();if (inst.settings.custom_undo_redo_restore_selection)inst.selection.moveToBookmark(this.undoLevels[this.undoIndex].bookmark);}tinyMCE.triggerNodeChange();}};var TinyMCE_ForceParagraphs = {_insertPara : function(inst, e) {var doc = inst.getDoc(), sel = inst.getSel(), body = inst.getBody(), win = inst.contentWindow, rng = sel.getRangeAt(0);var rootElm = doc.documentElement, blockName = "P", startNode, endNode, startBlock, endBlock;var rngBefore, rngAfter, direct, startNode, startOffset, endNode, endOffset, b = tinyMCE.isOpera ? inst.selection.getBookmark() : null;var paraBefore, paraAfter, startChop, endChop, contents, i;function isEmpty(para) {var nodes;function isEmptyHTML(html) {return html.replace(new RegExp('[ \t\r\n]+', 'g'), '').toLowerCase() == '';}if (para.getElementsByTagName("img").length > 0)return false;if (para.getElementsByTagName("table").length > 0)return false;if (para.getElementsByTagName("hr").length > 0)return false;nodes = tinyMCE.getNodeTree(para, [], 3);for (i=0; i<nodes.length; i++) {if (!isEmptyHTML(nodes[i].nodeValue))return false;}return true;}rngBefore = doc.createRange();rngBefore.setStart(sel.anchorNode, sel.anchorOffset);rngBefore.collapse(true);rngAfter = doc.createRange();rngAfter.setStart(sel.focusNode, sel.focusOffset);rngAfter.collapse(true);direct = rngBefore.compareBoundaryPoints(rngBefore.START_TO_END, rngAfter) < 0;startNode = direct ? sel.anchorNode : sel.focusNode;startOffset = direct ? sel.anchorOffset : sel.focusOffset;endNode = direct ? sel.focusNode : sel.anchorNode;endOffset = direct ? sel.focusOffset : sel.anchorOffset;startNode = startNode.nodeName == "BODY" ? startNode.firstChild : startNode;endNode = endNode.nodeName == "BODY" ? endNode.firstChild : endNode;startBlock = inst.getParentBlockElement(startNode);endBlock = inst.getParentBlockElement(endNode);if (startBlock && (startBlock.nodeName == 'CAPTION' || /absolute|relative|static/gi.test(startBlock.style.position)))startBlock = null;if (endBlock && (endBlock.nodeName == 'CAPTION' || /absolute|relative|static/gi.test(endBlock.style.position)))endBlock = null;if (startBlock != null) {blockName = startBlock.nodeName;if (/(TD|TABLE|TH|CAPTION)/.test(blockName) || (blockName == "DIV" && /left|right/gi.test(startBlock.style.cssFloat)))blockName = "P";}if (tinyMCE.getParentElement(startBlock, "OL,UL", null, body) != null)return false;if ((startBlock != null && startBlock.nodeName == "TABLE") || (endBlock != null && endBlock.nodeName == "TABLE"))startBlock = endBlock = null;paraBefore = (startBlock != null && startBlock.nodeName == blockName) ? startBlock.cloneNode(false) : doc.createElement(blockName);paraAfter = (endBlock != null && endBlock.nodeName == blockName) ? endBlock.cloneNode(false) : doc.createElement(blockName);if (/^(H[1-6])$/.test(blockName))paraAfter = doc.createElement("p");startChop = startNode;endChop = endNode;node = startChop;do {if (node == body || node.nodeType == 9 || tinyMCE.isBlockElement(node))break;startChop = node;} while ((node = node.previousSibling ? node.previousSibling : node.parentNode));node = endChop;do {if (node == body || node.nodeType == 9 || tinyMCE.isBlockElement(node))break;endChop = node;} while ((node = node.nextSibling ? node.nextSibling : node.parentNode));if (startChop.nodeName == "TD")startChop = startChop.firstChild;if (endChop.nodeName == "TD")endChop = endChop.lastChild;if (startBlock == null) {rng.deleteContents();if (!tinyMCE.isSafari)sel.removeAllRanges();if (startChop != rootElm && endChop != rootElm) {rngBefore = rng.cloneRange();if (startChop == body)rngBefore.setStart(startChop, 0);else
rngBefore.setStartBefore(startChop);paraBefore.appendChild(rngBefore.cloneContents());if (endChop.parentNode.nodeName == blockName)endChop = endChop.parentNode;rng.setEndAfter(endChop);if (endChop.nodeName != "#text" && endChop.nodeName != "BODY")rngBefore.setEndAfter(endChop);contents = rng.cloneContents();if (contents.firstChild && (contents.firstChild.nodeName == blockName || contents.firstChild.nodeName == "BODY"))paraAfter.innerHTML = contents.firstChild.innerHTML;else
paraAfter.appendChild(contents);if (isEmpty(paraBefore))paraBefore.innerHTML = "&nbsp;";if (isEmpty(paraAfter))paraAfter.innerHTML = "&nbsp;";rng.deleteContents();rngAfter.deleteContents();rngBefore.deleteContents();if (tinyMCE.isOpera) {paraBefore.normalize();rngBefore.insertNode(paraBefore);paraAfter.normalize();rngBefore.insertNode(paraAfter);} else {paraAfter.normalize();rngBefore.insertNode(paraAfter);paraBefore.normalize();rngBefore.insertNode(paraBefore);}} else {body.innerHTML = "<" + blockName + ">&nbsp;</" + blockName + "><" + blockName + ">&nbsp;</" + blockName + ">";paraAfter = body.childNodes[1];}inst.selection.moveToBookmark(b);inst.selection.selectNode(paraAfter, true, true);return true;}if (startChop.nodeName == blockName)rngBefore.setStart(startChop, 0);else
rngBefore.setStartBefore(startChop);rngBefore.setEnd(startNode, startOffset);paraBefore.appendChild(rngBefore.cloneContents());rngAfter.setEndAfter(endChop);rngAfter.setStart(endNode, endOffset);contents = rngAfter.cloneContents();if (contents.firstChild && contents.firstChild.nodeName == blockName) {paraAfter.innerHTML = contents.firstChild.innerHTML;} else
paraAfter.appendChild(contents);if (isEmpty(paraBefore))paraBefore.innerHTML = "&nbsp;";if (isEmpty(paraAfter))paraAfter.innerHTML = "&nbsp;";rng = doc.createRange();if (!startChop.previousSibling && startChop.parentNode.nodeName.toUpperCase() == blockName) {rng.setStartBefore(startChop.parentNode);} else {if (rngBefore.startContainer.nodeName.toUpperCase() == blockName && rngBefore.startOffset == 0)rng.setStartBefore(rngBefore.startContainer);else
rng.setStart(rngBefore.startContainer, rngBefore.startOffset);}if (!endChop.nextSibling && endChop.parentNode.nodeName.toUpperCase() == blockName)rng.setEndAfter(endChop.parentNode);else
rng.setEnd(rngAfter.endContainer, rngAfter.endOffset);rng.deleteContents();if (tinyMCE.isOpera) {rng.insertNode(paraBefore);rng.insertNode(paraAfter);} else {rng.insertNode(paraAfter);rng.insertNode(paraBefore);}paraAfter.normalize();paraBefore.normalize();inst.selection.moveToBookmark(b);inst.selection.selectNode(paraAfter, true, true);return true;},
_handleBackSpace : function(inst) {var r = inst.getRng(), sn = r.startContainer, nv, s = false;if (sn && sn.nextSibling && sn.nextSibling.nodeName == "BR" && sn.parentNode.nodeName != "BODY") {nv = sn.nodeValue;if (nv != null && r.startOffset == nv.length)sn.nextSibling.parentNode.removeChild(sn.nextSibling);}if (inst.settings.auto_resize)inst.resizeToContent();return s;}};function TinyMCE_Layer(id, bm) {this.id = id;this.blockerElement = null;this.events = false;this.element = null;this.blockMode = typeof(bm) != 'undefined' ? bm : true;this.doc = document;};TinyMCE_Layer.prototype = {moveRelativeTo : function(re, p) {var rep = this.getAbsPosition(re), e = this.getElement(), x, y;var w = parseInt(re.offsetWidth), h = parseInt(re.offsetHeight);var ew = parseInt(e.offsetWidth), eh = parseInt(e.offsetHeight);switch (p) {case "tl":x = rep.absLeft;y = rep.absTop;break;case "tr":x = rep.absLeft + w;y = rep.absTop;break;case "bl":x = rep.absLeft;y = rep.absTop + h;break;case "br":x = rep.absLeft + w;y = rep.absTop + h;break;case "cc":x = rep.absLeft + (w / 2) - (ew / 2);y = rep.absTop + (h / 2) - (eh / 2);break;}this.moveTo(x, y);},
moveBy : function(x, y) {var e = this.getElement();this.moveTo(parseInt(e.style.left) + x, parseInt(e.style.top) + y);},
moveTo : function(x, y) {var e = this.getElement();e.style.left = x + "px";e.style.top = y + "px";this.updateBlocker();},
resizeBy : function(w, h) {var e = this.getElement();this.resizeTo(parseInt(e.style.width) + w, parseInt(e.style.height) + h);},
resizeTo : function(w, h) {var e = this.getElement();if (w != null)e.style.width = w + "px";if (h != null)e.style.height = h + "px";this.updateBlocker();},
show : function() {var el = this.getElement();if (el) {el.style.display = 'block';this.updateBlocker();}},
hide : function() {var el = this.getElement();if (el) {el.style.display = 'none';this.updateBlocker();}},
isVisible : function() {return this.getElement().style.display == 'block';},
getElement : function() {if (!this.element)this.element = this.doc.getElementById(this.id);return this.element;},
setBlockMode : function(s) {this.blockMode = s;},
updateBlocker : function() {var e, b, x, y, w, h;b = this.getBlocker();if (b) {if (this.blockMode) {e = this.getElement();x = this.parseInt(e.style.left);y = this.parseInt(e.style.top);w = this.parseInt(e.offsetWidth);h = this.parseInt(e.offsetHeight);b.style.left = x + 'px';b.style.top = y + 'px';b.style.width = w + 'px';b.style.height = h + 'px';b.style.display = e.style.display;} else
b.style.display = 'none';}},
getBlocker : function() {var d, b;if (!this.blockerElement && this.blockMode) {d = this.doc;b = d.getElementById(this.id + "_blocker");if (!b) {b = d.createElement("iframe");b.setAttribute('id', this.id + "_blocker");b.style.cssText = 'display: none; position: absolute; left: 0; top: 0';b.src = 'javascript:false;';b.frameBorder = '0';b.scrolling = 'no';d.body.appendChild(b);}this.blockerElement = b;}return this.blockerElement;},
getAbsPosition : function(n) {var p = {absLeft : 0, absTop : 0};while (n) {p.absLeft += n.offsetLeft;p.absTop += n.offsetTop;n = n.offsetParent;}return p;},
create : function(n, c, p, h) {var d = this.doc, e = d.createElement(n);e.setAttribute('id', this.id);if (c)e.className = c;if (!p)p = d.body;if (h)e.innerHTML = h;p.appendChild(e);return this.element = e;},
exists : function() {return this.doc.getElementById(this.id) != null;},
parseInt : function(s) {if (s == null || s == '')return 0;return parseInt(s);},
remove : function() {var e = this.getElement(), b = this.getBlocker();if (e)e.parentNode.removeChild(e);if (b)b.parentNode.removeChild(b);}};function TinyMCE_Menu() {var id;if (typeof(tinyMCE.menuCounter) == "undefined")tinyMCE.menuCounter = 0;id = "mc_menu_" + tinyMCE.menuCounter++;TinyMCE_Layer.call(this, id, true);this.id = id;this.items = [];this.needsUpdate = true;};TinyMCE_Menu.prototype = tinyMCE.extend(TinyMCE_Layer.prototype, {init : function(s) {var n;this.settings = {separator_class : 'mceMenuSeparator',
title_class : 'mceMenuTitle',
disabled_class : 'mceMenuDisabled',
menu_class : 'mceMenu',
drop_menu : true
};for (n in s)this.settings[n] = s[n];this.create('div', this.settings.menu_class);},
clear : function() {this.items = [];},
addTitle : function(t) {this.add({type : 'title', text : t});},
addDisabled : function(t) {this.add({type : 'disabled', text : t});},
addSeparator : function() {this.add({type : 'separator'});},
addItem : function(t, js) {this.add({text : t, js : js});},
add : function(mi) {this.items[this.items.length] = mi;this.needsUpdate = true;},
update : function() {var e = this.getElement(), h = '', i, t, m = this.items, s = this.settings;if (this.settings.drop_menu)h += '<span class="mceMenuLine"></span>';h += '<table border="0" cellpadding="0" cellspacing="0">';for (i=0; i<m.length; i++) {t = tinyMCE.xmlEncode(m[i].text);c = m[i].class_name ? ' class="' + m[i].class_name + '"' : '';switch (m[i].type) {case 'separator':h += '<tr class="' + s.separator_class + '"><td>';break;case 'title':h += '<tr class="' + s.title_class + '"><td><span' + c +'>' + t + '</span>';break;case 'disabled':h += '<tr class="' + s.disabled_class + '"><td><span' + c +'>' + t + '</span>';break;default:h += '<tr><td><a href="' + tinyMCE.xmlEncode(m[i].js) + '" onmousedown="' + tinyMCE.xmlEncode(m[i].js) + ';return tinyMCE.cancelEvent(event);" onclick="return tinyMCE.cancelEvent(event);" onmouseup="return tinyMCE.cancelEvent(event);"><span' + c +'>' + t + '</span></a>';}h += '</td></tr>';}h += '</table>';e.innerHTML = h;this.needsUpdate = false;this.updateBlocker();},
show : function() {var nl, i;if (tinyMCE.lastMenu == this)return;if (this.needsUpdate)this.update();if (tinyMCE.lastMenu && tinyMCE.lastMenu != this)tinyMCE.lastMenu.hide();TinyMCE_Layer.prototype.show.call(this);if (!tinyMCE.isOpera) {}tinyMCE.lastMenu = this;}});tinyMCE.add(TinyMCE_Engine, {debug : function() {var m = "", a, i, l = tinyMCE.log.length;for (i=0, a = this.debug.arguments; i<a.length; i++) {m += a[i];if (i<a.length-1)m += ', ';}if (l < 1000)tinyMCE.log[l] = "[debug] " + m;}});
TinyMCE.prototype.orgLoadScript = TinyMCE.prototype.loadScript;TinyMCE.prototype.loadScript = function() {};var realTinyMCE = tinyMCE;tinyMCE.init(tinyMCECompressed.configs[0]);tinyMCECompressed.loadPlugins();// UK lang variables

tinyMCE.addToLang('',{
bold_desc : 'Bold (Ctrl+B)',
italic_desc : 'Italic (Ctrl+I)',
underline_desc : 'Underline (Ctrl+U)',
striketrough_desc : 'Strikethrough',
justifyleft_desc : 'Align left',
justifycenter_desc : 'Align center',
justifyright_desc : 'Align right',
justifyfull_desc : 'Align full',
bullist_desc : 'Unordered list',
numlist_desc : 'Ordered list',
outdent_desc : 'Outdent',
indent_desc : 'Indent',
undo_desc : 'Undo (Ctrl+Z)',
redo_desc : 'Redo (Ctrl+Y)',
link_desc : 'Insert/edit link',
unlink_desc : 'Unlink',
image_desc : 'Insert/edit image',
cleanup_desc : 'Cleanup messy code',
focus_alert : 'A editor instance must be focused before using this command.',
edit_confirm : 'Do you want to use the WYSIWYG mode for this textarea?',
insert_link_title : 'Insert/edit link',
insert : 'Insert',
update : 'Update',
cancel : 'Cancel',
insert_link_url : 'Link URL',
insert_link_target : 'Target',
insert_link_target_same : 'Open link in the same window',
insert_link_target_blank : 'Open link in a new window',
insert_image_title : 'Insert/edit image',
insert_image_src : 'Image URL',
insert_image_alt : 'Image description',
help_desc : 'Help',
bold_img : "bold.gif",
italic_img : "italic.gif",
underline_img : "underline.gif",
clipboard_msg : 'Copy/Cut/Paste is not available in Mozilla and Firefox.\nDo you want more information about this issue?',
popup_blocked : 'Sorry, but we have noticed that your popup-blocker has disabled a window that provides application functionality. You will need to disable popup blocking on this site in order to fully utilize this tool.'
});
tinyMCE.importThemeLanguagePack('advanced');var TinyMCE_AdvancedTheme = {_defColors : "000000,993300,333300,003300,003366,000080,333399,333333,800000,FF6600,808000,008000,008080,0000FF,666699,808080,FF0000,FF9900,99CC00,339966,33CCCC,3366FF,800080,999999,FF00FF,FFCC00,FFFF00,00FF00,00FFFF,00CCFF,993366,C0C0C0,FF99CC,FFCC99,FFFF99,CCFFCC,CCFFFF,99CCFF,CC99FF,FFFFFF",
_autoImportCSSClasses : true,
_resizer : {},
_buttons : [
['bold', '{$lang_bold_img}', 'lang_bold_desc', 'Bold'],
['italic', '{$lang_italic_img}', 'lang_italic_desc', 'Italic'],
['underline', '{$lang_underline_img}', 'lang_underline_desc', 'Underline'],
['strikethrough', 'strikethrough.gif', 'lang_striketrough_desc', 'Strikethrough'],
['justifyleft', 'justifyleft.gif', 'lang_justifyleft_desc', 'JustifyLeft'],
['justifycenter', 'justifycenter.gif', 'lang_justifycenter_desc', 'JustifyCenter'],
['justifyright', 'justifyright.gif', 'lang_justifyright_desc', 'JustifyRight'],
['justifyfull', 'justifyfull.gif', 'lang_justifyfull_desc', 'JustifyFull'],
['bullist', 'bullist.gif', 'lang_bullist_desc', 'InsertUnorderedList'],
['numlist', 'numlist.gif', 'lang_numlist_desc', 'InsertOrderedList'],
['outdent', 'outdent.gif', 'lang_outdent_desc', 'Outdent'],
['indent', 'indent.gif', 'lang_indent_desc', 'Indent'],
['cut', 'cut.gif', 'lang_cut_desc', 'Cut'],
['copy', 'copy.gif', 'lang_copy_desc', 'Copy'],
['paste', 'paste.gif', 'lang_paste_desc', 'Paste'],
['undo', 'undo.gif', 'lang_undo_desc', 'Undo'],
['redo', 'redo.gif', 'lang_redo_desc', 'Redo'],
['link', 'link.gif', 'lang_link_desc', 'mceLink', true],
['unlink', 'unlink.gif', 'lang_unlink_desc', 'unlink'],
['image', 'image.gif', 'lang_image_desc', 'mceImage', true],
['cleanup', 'cleanup.gif', 'lang_cleanup_desc', 'mceCleanup'],
['help', 'help.gif', 'lang_help_desc', 'mceHelp'],
['code', 'code.gif', 'lang_theme_code_desc', 'mceCodeEditor'],
['hr', 'hr.gif', 'lang_theme_hr_desc', 'inserthorizontalrule'],
['removeformat', 'removeformat.gif', 'lang_theme_removeformat_desc', 'removeformat'],
['sub', 'sub.gif', 'lang_theme_sub_desc', 'subscript'],
['sup', 'sup.gif', 'lang_theme_sup_desc', 'superscript'],
['forecolor', 'forecolor.gif', 'lang_theme_forecolor_desc', 'forecolor', true],
['forecolorpicker', 'forecolor.gif', 'lang_theme_forecolor_desc', 'forecolorpicker', true],
['backcolor', 'backcolor.gif', 'lang_theme_backcolor_desc', 'HiliteColor', true],
['backcolorpicker', 'backcolor.gif', 'lang_theme_backcolor_desc', 'backcolorpicker', true],
['charmap', 'charmap.gif', 'lang_theme_charmap_desc', 'mceCharMap'],
['visualaid', 'visualaid.gif', 'lang_theme_visualaid_desc', 'mceToggleVisualAid'],
['anchor', 'anchor.gif', 'lang_theme_anchor_desc', 'mceInsertAnchor'],
['newdocument', 'newdocument.gif', 'lang_newdocument_desc', 'mceNewDocument']
],
_buttonMap : 'anchor,backcolor,bold,bullist,charmap,cleanup,code,copy,cut,forecolor,help,hr,image,indent,italic,justifycenter,justifyfull,justifyleft,justifyright,link,newdocument,numlist,outdent,paste,redo,removeformat,strikethrough,sub,sup,underline,undo,unlink,visualaid,advhr,ltr,rtl,emotions,flash,fullpage,fullscreen,iespell,insertdate,inserttime,pastetext,pasteword,selectall,preview,print,save,replace,search,table,cell_props,delete_col,delete_row,col_after,col_before,row_after,row_before,merge_cells,row_props,split_cells,delete_table',
getControlHTML : function(button_name) {var i, x, but;for (i=0; i<TinyMCE_AdvancedTheme._buttons.length; i++) {but = TinyMCE_AdvancedTheme._buttons[i];if (but[0] == button_name && (button_name == "forecolor" || button_name == "backcolor"))return tinyMCE.getMenuButtonHTML(but[0], but[2], '{$themeurl}/images/' + but[1], but[3] + "Menu", but[3], (but.length > 4 ? but[4] : false), (but.length > 5 ? but[5] : null));if (but[0] == button_name)return tinyMCE.getButtonHTML(but[0], but[2], '{$themeurl}/images/' + but[1], but[3], (but.length > 4 ? but[4] : false), (but.length > 5 ? but[5] : null));}switch (button_name) {case "formatselect":var html = '<select id="{$editor_id}_formatSelect" name="{$editor_id}_formatSelect" onfocus="tinyMCE.addSelectAccessibility(event, this, window);" onchange="tinyMCE.execInstanceCommand(\'{$editor_id}\',\'FormatBlock\',false,this.options[this.selectedIndex].value);" class="mceSelectList">';var formats = tinyMCE.getParam("theme_advanced_blockformats", "p,address,pre,h1,h2,h3,h4,h5,h6", true).split(',');var lookup = [
['p', '{$lang_theme_paragraph}'],
['address', '{$lang_theme_address}'],
['pre', '{$lang_theme_pre}'],
['h1', '{$lang_theme_h1}'],
['h2', '{$lang_theme_h2}'],
['h3', '{$lang_theme_h3}'],
['h4', '{$lang_theme_h4}'],
['h5', '{$lang_theme_h5}'],
['h6', '{$lang_theme_h6}'],
['div', '{$lang_theme_div}'],
['blockquote', '{$lang_theme_blockquote}'],
['code', '{$lang_theme_code}'],
['dt', '{$lang_theme_dt}'],
['dd', '{$lang_theme_dd}'],
['samp', '{$lang_theme_samp}']
];html += '<option value="">{$lang_theme_block}</option>';for (var i=0; i<formats.length; i++) {for (var x=0; x<lookup.length; x++) {if (formats[i] == lookup[x][0])html += '<option value="&lt;' + lookup[x][0] + '&gt;">' + lookup[x][1] + '</option>';}}html += '</select>';return html;case "styleselect":return '<select id="{$editor_id}_styleSelect" onmousedown="tinyMCE.themes.advanced._setupCSSClasses(\'{$editor_id}\');" name="{$editor_id}_styleSelect" onfocus="tinyMCE.addSelectAccessibility(event,this,window);" onchange="tinyMCE.execInstanceCommand(\'{$editor_id}\',\'mceSetCSSClass\',false,this.options[this.selectedIndex].value);" class="mceSelectList">{$style_select_options}</select>';case "fontselect":var fontHTML = '<select id="{$editor_id}_fontNameSelect" name="{$editor_id}_fontNameSelect" onfocus="tinyMCE.addSelectAccessibility(event, this, window);" onchange="tinyMCE.execInstanceCommand(\'{$editor_id}\',\'FontName\',false,this.options[this.selectedIndex].value);" class="mceSelectList"><option value="">{$lang_theme_fontdefault}</option>';var iFonts = 'Arial=arial,helvetica,sans-serif;Courier New=courier new,courier,monospace;Georgia=georgia,times new roman,times,serif;Tahoma=tahoma,arial,helvetica,sans-serif;Times New Roman=times new roman,times,serif;Verdana=verdana,arial,helvetica,sans-serif;Impact=impact;WingDings=wingdings';var nFonts = 'Andale Mono=andale mono,times;Arial=arial,helvetica,sans-serif;Arial Black=arial black,avant garde;Book Antiqua=book antiqua,palatino;Comic Sans MS=comic sans ms,sand;Courier New=courier new,courier;Georgia=georgia,palatino;Helvetica=helvetica;Impact=impact,chicago;Symbol=symbol;Tahoma=tahoma,arial,helvetica,sans-serif;Terminal=terminal,monaco;Times New Roman=times new roman,times;Trebuchet MS=trebuchet ms,geneva;Verdana=verdana,geneva;Webdings=webdings;Wingdings=wingdings,zapf dingbats';var fonts = tinyMCE.getParam("theme_advanced_fonts", nFonts).split(';');for (i=0; i<fonts.length; i++) {if (fonts[i] != '') {var parts = fonts[i].split('=');fontHTML += '<option value="' + parts[1] + '">' + parts[0] + '</option>';}}fontHTML += '</select>';return fontHTML;case "fontsizeselect":return '<select id="{$editor_id}_fontSizeSelect" name="{$editor_id}_fontSizeSelect" onfocus="tinyMCE.addSelectAccessibility(event, this, window);" onchange="tinyMCE.execInstanceCommand(\'{$editor_id}\',\'FontSize\',false,this.options[this.selectedIndex].value);" class="mceSelectList">'+
'<option value="0">{$lang_theme_font_size}</option>'+
'<option value="1">1 (8 pt)</option>'+
'<option value="2">2 (10 pt)</option>'+
'<option value="3">3 (12 pt)</option>'+
'<option value="4">4 (14 pt)</option>'+
'<option value="5">5 (18 pt)</option>'+
'<option value="6">6 (24 pt)</option>'+
'<option value="7">7 (36 pt)</option>'+
'</select>';case "|":case "separator":return '<img src="{$themeurl}/images/separator.gif" width="2" height="20" class="mceSeparatorLine" alt="" />';case "spacer":return '<img src="{$themeurl}/images/separator.gif" width="2" height="15" border="0" class="mceSeparatorLine" style="vertical-align: middle" alt="" />';case "rowseparator":return '<br />';}return "";},
execCommand : function(editor_id, element, command, user_interface, value) {switch (command) {case 'mceHelp':tinyMCE.openWindow({file : 'about.htm',
width : 480,
height : 380
}, {tinymce_version : tinyMCE.majorVersion + "." + tinyMCE.minorVersion,
tinymce_releasedate : tinyMCE.releaseDate,
inline : "yes"
});return true;case "mceLink":var inst = tinyMCE.getInstanceById(editor_id);var doc = inst.getDoc();var selectedText = "";if (tinyMCE.isMSIE) {var rng = doc.selection.createRange();selectedText = rng.text;} else
selectedText = inst.getSel().toString();if (!tinyMCE.linkElement) {if ((tinyMCE.selectedElement.nodeName.toLowerCase() != "img") && (selectedText.length <= 0))return true;}var href = "", target = "", title = "", onclick = "", action = "insert", style_class = "";if (tinyMCE.selectedElement.nodeName.toLowerCase() == "a")tinyMCE.linkElement = tinyMCE.selectedElement;if (tinyMCE.linkElement != null && tinyMCE.getAttrib(tinyMCE.linkElement, 'href') == "")tinyMCE.linkElement = null;if (tinyMCE.linkElement) {href = tinyMCE.getAttrib(tinyMCE.linkElement, 'href');target = tinyMCE.getAttrib(tinyMCE.linkElement, 'target');title = tinyMCE.getAttrib(tinyMCE.linkElement, 'title');onclick = tinyMCE.getAttrib(tinyMCE.linkElement, 'onclick');style_class = tinyMCE.getAttrib(tinyMCE.linkElement, 'class');if (onclick == "")onclick = tinyMCE.getAttrib(tinyMCE.linkElement, 'onclick');onclick = tinyMCE.cleanupEventStr(onclick);href = eval(tinyMCE.settings['urlconverter_callback'] + "(href, tinyMCE.linkElement, true);");mceRealHref = tinyMCE.getAttrib(tinyMCE.linkElement, 'mce_href');if (mceRealHref != "") {href = mceRealHref;if (tinyMCE.getParam('convert_urls'))href = eval(tinyMCE.settings['urlconverter_callback'] + "(href, tinyMCE.linkElement, true);");}action = "update";}var template = new Array();template['file'] = 'link.htm';template['width'] = 310;template['height'] = 200;template['width'] += tinyMCE.getLang('lang_insert_link_delta_width', 0);template['height'] += tinyMCE.getLang('lang_insert_link_delta_height', 0);if (inst.settings['insertlink_callback']) {var returnVal = eval(inst.settings['insertlink_callback'] + "(href, target, title, onclick, action, style_class);");if (returnVal && returnVal['href'])TinyMCE_AdvancedTheme._insertLink(returnVal['href'], returnVal['target'], returnVal['title'], returnVal['onclick'], returnVal['style_class']);} else {tinyMCE.openWindow(template, {href : href, target : target, title : title, onclick : onclick, action : action, className : style_class, inline : "yes"});}return true;case "mceImage":var src = "", alt = "", border = "", hspace = "", vspace = "", width = "", height = "", align = "";var title = "", onmouseover = "", onmouseout = "", action = "insert";var img = tinyMCE.imgElement;var inst = tinyMCE.getInstanceById(editor_id);if (tinyMCE.selectedElement != null && tinyMCE.selectedElement.nodeName.toLowerCase() == "img") {img = tinyMCE.selectedElement;tinyMCE.imgElement = img;}if (img) {if (tinyMCE.getAttrib(img, 'name').indexOf('mce_') == 0)return true;src = tinyMCE.getAttrib(img, 'src');alt = tinyMCE.getAttrib(img, 'alt');if (alt == "")alt = tinyMCE.getAttrib(img, 'title');if (tinyMCE.isGecko) {var w = img.style.width;if (w != null && w != "")img.setAttribute("width", w);var h = img.style.height;if (h != null && h != "")img.setAttribute("height", h);}border = tinyMCE.getAttrib(img, 'border');hspace = tinyMCE.getAttrib(img, 'hspace');vspace = tinyMCE.getAttrib(img, 'vspace');width = tinyMCE.getAttrib(img, 'width');height = tinyMCE.getAttrib(img, 'height');align = tinyMCE.getAttrib(img, 'align');onmouseover = tinyMCE.getAttrib(img, 'onmouseover');onmouseout = tinyMCE.getAttrib(img, 'onmouseout');title = tinyMCE.getAttrib(img, 'title');if (tinyMCE.isMSIE) {width = img.attributes['width'].specified ? width : "";height = img.attributes['height'].specified ? height : "";}src = eval(tinyMCE.settings['urlconverter_callback'] + "(src, img, true);");mceRealSrc = tinyMCE.getAttrib(img, 'mce_src');if (mceRealSrc != "") {src = mceRealSrc;if (tinyMCE.getParam('convert_urls'))src = eval(tinyMCE.settings['urlconverter_callback'] + "(src, img, true);");}action = "update";}var template = new Array();template['file'] = 'image.htm?src={$src}';template['width'] = 355;template['height'] = 265 + (tinyMCE.isMSIE ? 25 : 0);template['width'] += tinyMCE.getLang('lang_insert_image_delta_width', 0);template['height'] += tinyMCE.getLang('lang_insert_image_delta_height', 0);if (inst.settings['insertimage_callback']) {var returnVal = eval(inst.settings['insertimage_callback'] + "(src, alt, border, hspace, vspace, width, height, align, title, onmouseover, onmouseout, action);");if (returnVal && returnVal['src'])TinyMCE_AdvancedTheme._insertImage(returnVal['src'], returnVal['alt'], returnVal['border'], returnVal['hspace'], returnVal['vspace'], returnVal['width'], returnVal['height'], returnVal['align'], returnVal['title'], returnVal['onmouseover'], returnVal['onmouseout']);} else
tinyMCE.openWindow(template, {src : src, alt : alt, border : border, hspace : hspace, vspace : vspace, width : width, height : height, align : align, title : title, onmouseover : onmouseover, onmouseout : onmouseout, action : action, inline : "yes"});return true;case "forecolor":var fcp = new TinyMCE_Layer(editor_id + '_fcPreview', false), p, img, elm;TinyMCE_AdvancedTheme._hideMenus(editor_id);if (!fcp.exists()) {fcp.create('div', 'mceColorPreview', document.getElementById(editor_id + '_toolbar'));elm = fcp.getElement();elm._editor_id = editor_id;elm._command = "forecolor";elm._switchId = editor_id + "_forecolor";tinyMCE.addEvent(elm, 'click', TinyMCE_AdvancedTheme._handleMenuEvent);tinyMCE.addEvent(elm, 'mouseover', TinyMCE_AdvancedTheme._handleMenuEvent);tinyMCE.addEvent(elm, 'mouseout', TinyMCE_AdvancedTheme._handleMenuEvent);}img = tinyMCE.selectNodes(document.getElementById(editor_id + "_forecolor"), function(n) {return n.nodeName == "IMG";})[0];p = tinyMCE.getAbsPosition(img, document.getElementById(editor_id + '_toolbar'));fcp.moveTo(p.absLeft, p.absTop);fcp.getElement().style.backgroundColor = value != null ? value : tinyMCE.getInstanceById(editor_id).foreColor;fcp.show();return false;case "forecolorpicker":this._pickColor(editor_id, 'forecolor');return true;case "forecolorMenu":TinyMCE_AdvancedTheme._hideMenus(editor_id);var ml = new TinyMCE_Layer(editor_id + '_fcMenu');if (!ml.exists())ml.create('div', 'mceMenu', document.body, TinyMCE_AdvancedTheme._getColorHTML(editor_id, 'theme_advanced_text_colors', 'forecolor'));tinyMCE.switchClass(editor_id + '_forecolor', 'mceMenuButtonFocus');ml.moveRelativeTo(document.getElementById(editor_id + "_forecolor"), 'bl');ml.moveBy(tinyMCE.isMSIE && !tinyMCE.isOpera ? -1 : 1, -1);if (tinyMCE.isOpera)ml.moveBy(0, -2);ml.show();return true;case "HiliteColor":var bcp = new TinyMCE_Layer(editor_id + '_bcPreview', false), p, img;TinyMCE_AdvancedTheme._hideMenus(editor_id);if (!bcp.exists()) {bcp.create('div', 'mceColorPreview', document.getElementById(editor_id + '_toolbar'));elm = bcp.getElement();elm._editor_id = editor_id;elm._command = "HiliteColor";elm._switchId = editor_id + "_backcolor";tinyMCE.addEvent(elm, 'click', TinyMCE_AdvancedTheme._handleMenuEvent);tinyMCE.addEvent(elm, 'mouseover', TinyMCE_AdvancedTheme._handleMenuEvent);tinyMCE.addEvent(elm, 'mouseout', TinyMCE_AdvancedTheme._handleMenuEvent);}img = tinyMCE.selectNodes(document.getElementById(editor_id + "_backcolor"), function(n) {return n.nodeName == "IMG";})[0];p = tinyMCE.getAbsPosition(img, document.getElementById(editor_id + '_toolbar'));bcp.moveTo(p.absLeft, p.absTop);bcp.getElement().style.backgroundColor = value != null ? value : tinyMCE.getInstanceById(editor_id).backColor;bcp.show();return false;case "HiliteColorMenu":TinyMCE_AdvancedTheme._hideMenus(editor_id);var ml = new TinyMCE_Layer(editor_id + '_bcMenu');if (!ml.exists())ml.create('div', 'mceMenu', document.body, TinyMCE_AdvancedTheme._getColorHTML(editor_id, 'theme_advanced_background_colors', 'HiliteColor'));tinyMCE.switchClass(editor_id + '_backcolor', 'mceMenuButtonFocus');ml.moveRelativeTo(document.getElementById(editor_id + "_backcolor"), 'bl');ml.moveBy(tinyMCE.isMSIE && !tinyMCE.isOpera ? -1 : 1, -1);if (tinyMCE.isOpera)ml.moveBy(0, -2);ml.show();return true;case "backcolorpicker":this._pickColor(editor_id, 'HiliteColor');return true;case "mceColorPicker":if (user_interface) {var template = [];if (!value['callback'] && !value['color'])value['color'] = value['document'].getElementById(value['element_id']).value;template['file'] = 'color_picker.htm';template['width'] = 380;template['height'] = 250;template['close_previous'] = "no";template['width'] += tinyMCE.getLang('lang_theme_advanced_colorpicker_delta_width', 0);template['height'] += tinyMCE.getLang('lang_theme_advanced_colorpicker_delta_height', 0);if (typeof(value['store_selection']) == "undefined")value['store_selection'] = true;tinyMCE.lastColorPickerValue = value;tinyMCE.openWindow(template, {editor_id : editor_id, mce_store_selection : value['store_selection'], inline : "yes", command : "mceColorPicker", input_color : value['color']});} else {var savedVal = tinyMCE.lastColorPickerValue, elm;if (savedVal['callback']) {savedVal['callback'](value);return true;}elm = savedVal['document'].getElementById(savedVal['element_id']);elm.value = value;if (elm.onchange != null && elm.onchange != '')eval('elm.onchange();');}return true;case "mceCodeEditor":var template = new Array();template['file'] = 'source_editor.htm';template['width'] = parseInt(tinyMCE.getParam("theme_advanced_source_editor_width", 720));template['height'] = parseInt(tinyMCE.getParam("theme_advanced_source_editor_height", 580));tinyMCE.openWindow(template, {editor_id : editor_id, resizable : "yes", scrollbars : "no", inline : "yes"});return true;case "mceCharMap":var template = new Array();template['file'] = 'charmap.htm';template['width'] = 550 + (tinyMCE.isOpera ? 40 : 0);template['height'] = 250;template['width'] += tinyMCE.getLang('lang_theme_advanced_charmap_delta_width', 0);template['height'] += tinyMCE.getLang('lang_theme_advanced_charmap_delta_height', 0);tinyMCE.openWindow(template, {editor_id : editor_id, inline : "yes"});return true;case "mceInsertAnchor":var template = new Array();template['file'] = 'anchor.htm';template['width'] = 320;template['height'] = 90 + (tinyMCE.isNS7 ? 30 : 0);template['width'] += tinyMCE.getLang('lang_theme_advanced_anchor_delta_width', 0);template['height'] += tinyMCE.getLang('lang_theme_advanced_anchor_delta_height', 0);tinyMCE.openWindow(template, {editor_id : editor_id, inline : "yes"});return true;case "mceNewDocument":if (confirm(tinyMCE.getLang('lang_newdocument')))tinyMCE.execInstanceCommand(editor_id, 'mceSetContent', false, ' ');return true;}return false;},
getEditorTemplate : function(settings, editorId) {function removeFromArray(in_array, remove_array) {var outArray = new Array(), skip;for (var i=0; i<in_array.length; i++) {skip = false;for (var j=0; j<remove_array.length; j++) {if (in_array[i] == remove_array[j]) {skip = true;}}if (!skip) {outArray[outArray.length] = in_array[i];}}return outArray;}function addToArray(in_array, add_array) {for (var i=0; i<add_array.length; i++) {in_array[in_array.length] = add_array[i];}return in_array;}var template = new Array();var deltaHeight = 0;var resizing = tinyMCE.getParam("theme_advanced_resizing", false);var path = tinyMCE.getParam("theme_advanced_path", true);var statusbarHTML = '<div id="{$editor_id}_path" class="mceStatusbarPathText" style="display: ' + (path ? "block" : "none") + '">&#160;</div><div id="{$editor_id}_resize" class="mceStatusbarResize" style="display: ' + (resizing ? "block" : "none") + '" onmousedown="tinyMCE.themes.advanced._setResizing(event,\'{$editor_id}\',true);"></div><br style="clear: both" />';var layoutManager = tinyMCE.getParam("theme_advanced_layout_manager", "SimpleLayout");var styleSelectHTML = '<option value="">{$lang_theme_style_select}</option>';if (settings['theme_advanced_styles']) {var stylesAr = settings['theme_advanced_styles'].split(';');for (var i=0; i<stylesAr.length; i++) {var key, value;key = stylesAr[i].split('=')[0];value = stylesAr[i].split('=')[1];styleSelectHTML += '<option value="' + value + '">' + key + '</option>';}TinyMCE_AdvancedTheme._autoImportCSSClasses = false;}switch(layoutManager) {case "SimpleLayout" :var toolbarHTML = "";var toolbarLocation = tinyMCE.getParam("theme_advanced_toolbar_location", "bottom");var toolbarAlign = tinyMCE.getParam("theme_advanced_toolbar_align", "center");var pathLocation = tinyMCE.getParam("theme_advanced_path_location", "none");var statusbarLocation = tinyMCE.getParam("theme_advanced_statusbar_location", pathLocation);var defVals = {theme_advanced_buttons1 : "bold,italic,underline,strikethrough,separator,justifyleft,justifycenter,justifyright,justifyfull,separator,styleselect,formatselect",
theme_advanced_buttons2 : "bullist,numlist,separator,outdent,indent,separator,undo,redo,separator,link,unlink,anchor,image,cleanup,help,code",
theme_advanced_buttons3 : "hr,removeformat,visualaid,separator,sub,sup,separator,charmap"
};toolbarHTML += '<a href="#" accesskey="q" title="' + tinyMCE.getLang("lang_toolbar_focus") + '"';if (!tinyMCE.getParam("accessibility_focus"))toolbarHTML += ' onfocus="tinyMCE.getInstanceById(\'' + editorId + '\').getWin().focus();"';toolbarHTML += '></a>';for (var i=1; i<100; i++) {var def = defVals["theme_advanced_buttons" + i];var buttons = tinyMCE.getParam("theme_advanced_buttons" + i, def == null ? '' : def, true, ',');if (buttons.length == 0)break;buttons = removeFromArray(buttons, tinyMCE.getParam("theme_advanced_disable", "", true, ','));buttons = addToArray(buttons, tinyMCE.getParam("theme_advanced_buttons" + i + "_add", "", true, ','));buttons = addToArray(tinyMCE.getParam("theme_advanced_buttons" + i + "_add_before", "", true, ','), buttons);for (var b=0; b<buttons.length; b++)toolbarHTML += tinyMCE.getControlHTML(buttons[b]);if (buttons.length > 0) {toolbarHTML += "<br />";deltaHeight -= 23;}}toolbarHTML += '<a href="#" accesskey="z" onfocus="tinyMCE.getInstanceById(\'' + editorId + '\').getWin().focus();"></a>';template['html'] = '<table class="mceEditor" border="0" cellpadding="0" cellspacing="0" width="{$width}" height="{$height}" style="width:{$width_style};height:{$height_style}"><tbody>';if (toolbarLocation == "top")template['html'] += '<tr><td dir="ltr" class="mceToolbarTop" align="' + toolbarAlign + '" height="1" nowrap="nowrap"><span id="' + editorId + '_toolbar" class="mceToolbarContainer">' + toolbarHTML + '</span></td></tr>';if (statusbarLocation == "top") {template['html'] += '<tr><td class="mceStatusbarTop" height="1">' + statusbarHTML + '</td></tr>';deltaHeight -= 23;}template['html'] += '<tr><td align="center"><span id="{$editor_id}"></span></td></tr>';if (toolbarLocation == "bottom")template['html'] += '<tr><td dir="ltr" class="mceToolbarBottom" align="' + toolbarAlign + '" height="1"><span id="' + editorId + '_toolbar" class="mceToolbarContainer">' + toolbarHTML + '</span></td></tr>';if (toolbarLocation == "external") {var bod = document.body;var elm = document.createElement ("div");toolbarHTML = tinyMCE.replaceVar(toolbarHTML, 'style_select_options', styleSelectHTML);toolbarHTML = tinyMCE.applyTemplate(toolbarHTML, {editor_id : editorId});elm.className = "mceToolbarExternal";elm.id = editorId+"_toolbar";elm.innerHTML = '<table width="100%" border="0" align="center"><tr><td align="center">'+toolbarHTML+'</td></tr></table>';bod.appendChild (elm);deltaHeight = 0;tinyMCE.getInstanceById(editorId).toolbarElement = elm;} else {tinyMCE.getInstanceById(editorId).toolbarElement = null;}if (statusbarLocation == "bottom") {template['html'] += '<tr><td class="mceStatusbarBottom" height="1">' + statusbarHTML + '</td></tr>';deltaHeight -= 23;}template['html'] += '</tbody></table>';break;case "RowLayout" :template['html'] = '<table class="mceEditor" border="0" cellpadding="0" cellspacing="0" width="{$width}" height="{$height}" style="width:{$width}px;height:{$height}px"><tbody>';var containers = tinyMCE.getParam("theme_advanced_containers", "", true, ",");var defaultContainerCSS = tinyMCE.getParam("theme_advanced_containers_default_class", "container");var defaultContainerAlign = tinyMCE.getParam("theme_advanced_containers_default_align", "center");for (var i = 0; i < containers.length; i++){if (containers[i] == "mceEditor")template['html'] += '<tr><td align="center" class="mceEditor_border"><span id="{$editor_id}"></span></td></tr>';else if (containers[i] == "mceElementpath" || containers[i] == "mceStatusbar"){var pathClass = "mceStatusbar";if (i == containers.length-1){pathClass = "mceStatusbarBottom";}else if (i == 0){pathClass = "mceStatusbar";}else
{deltaHeight-=2;}template['html'] += '<tr><td class="' + pathClass + '" height="1">' + statusbarHTML + '</td></tr>';deltaHeight -= 22;} else {var curContainer = tinyMCE.getParam("theme_advanced_container_"+containers[i], "", true, ',');var curContainerHTML = "";var curAlign = tinyMCE.getParam("theme_advanced_container_"+containers[i]+"_align", defaultContainerAlign);var curCSS = tinyMCE.getParam("theme_advanced_container_"+containers[i]+"_class", defaultContainerCSS);curContainer = removeFromArray(curContainer, tinyMCE.getParam("theme_advanced_disable", "", true, ','));for (var j=0; j<curContainer.length; j++)curContainerHTML += tinyMCE.getControlHTML(curContainer[j]);if (curContainer.length > 0) {curContainerHTML += "<br />";deltaHeight -= 23;}template['html'] += '<tr><td class="' + curCSS + '" align="' + curAlign + '" height="1">' + curContainerHTML + '</td></tr>';}}template['html'] += '</tbody></table>';break;case "CustomLayout" :var customLayout = tinyMCE.getParam("theme_advanced_custom_layout","");if (customLayout != "" && eval("typeof(" + customLayout + ")") != "undefined") {template = eval(customLayout + "(template);");}break;}if (resizing)template['html'] += '<span id="{$editor_id}_resize_box" class="mceResizeBox"></span>';template['html'] = tinyMCE.replaceVar(template['html'], 'style_select_options', styleSelectHTML);if (!template['delta_width'])template['delta_width'] = 0;if (!template['delta_height'])template['delta_height'] = deltaHeight;return template;},
initInstance : function(inst) {if (tinyMCE.getParam("theme_advanced_resizing", false)) {if (tinyMCE.getParam("theme_advanced_resizing_use_cookie", true)) {var w = TinyMCE_AdvancedTheme._getCookie("TinyMCE_" + inst.editorId + "_width");var h = TinyMCE_AdvancedTheme._getCookie("TinyMCE_" + inst.editorId + "_height");TinyMCE_AdvancedTheme._resizeTo(inst, w, h, tinyMCE.getParam("theme_advanced_resize_horizontal", true));}}inst.addShortcut('ctrl', 'k', 'lang_link_desc', 'mceLink');},
removeInstance : function(inst) {new TinyMCE_Layer(inst.editorId + '_fcMenu').remove();new TinyMCE_Layer(inst.editorId + '_bcMenu').remove();},
hideInstance : function(inst) {TinyMCE_AdvancedTheme._hideMenus(inst.editorId);},
_handleMenuEvent : function(e) {var te = tinyMCE.isMSIE ? window.event.srcElement : e.target;tinyMCE._menuButtonEvent(e.type == "mouseover" ? "over" : "out", document.getElementById(te._switchId));if (e.type == "click")tinyMCE.execInstanceCommand(te._editor_id, te._command);},
_hideMenus : function(id) {var fcml = new TinyMCE_Layer(id + '_fcMenu'), bcml = new TinyMCE_Layer(id + '_bcMenu');if (fcml.exists() && fcml.isVisible()) {tinyMCE.switchClass(id + '_forecolor', 'mceMenuButton');fcml.hide();}if (bcml.exists() && bcml.isVisible()) {tinyMCE.switchClass(id + '_backcolor', 'mceMenuButton');bcml.hide();}},
handleNodeChange : function(editor_id, node, undo_index, undo_levels, visual_aid, any_selection, setup_content) {var alignNode, breakOut, classNode;function selectByValue(select_elm, value, first_index) {first_index = typeof(first_index) == "undefined" ? false : true;if (select_elm) {for (var i=0; i<select_elm.options.length; i++) {var ov = "" + select_elm.options[i].value;if (first_index && ov.toLowerCase().indexOf(value.toLowerCase()) == 0) {select_elm.selectedIndex = i;return true;}if (ov == value) {select_elm.selectedIndex = i;return true;}}}return false;};if (node == null)return;var pathElm = document.getElementById(editor_id + "_path");var inst = tinyMCE.getInstanceById(editor_id);var doc = inst.getDoc();TinyMCE_AdvancedTheme._hideMenus(editor_id);if (pathElm) {var parentNode = node;var path = new Array();while (parentNode != null) {if (parentNode.nodeName.toUpperCase() == "BODY") {break;}if (parentNode.nodeType == 1 && tinyMCE.getAttrib(parentNode, "class").indexOf('mceItemHidden') == -1) {path[path.length] = parentNode;}parentNode = parentNode.parentNode;}var html = "";for (var i=path.length-1; i>=0; i--) {var nodeName = path[i].nodeName.toLowerCase();var nodeData = "";if (nodeName.indexOf("html:") == 0)nodeName = nodeName.substring(5);if (nodeName == "b") {nodeName = "strong";}if (nodeName == "i") {nodeName = "em";}if (nodeName == "span") {var cn = tinyMCE.getAttrib(path[i], "class");if (cn != "" && cn.indexOf('mceItem') == -1)nodeData += "class: " + cn + " ";var st = tinyMCE.getAttrib(path[i], "style");if (st != "") {st = tinyMCE.serializeStyle(tinyMCE.parseStyle(st));nodeData += "style: " + tinyMCE.xmlEncode(st) + " ";}}if (nodeName == "font") {if (tinyMCE.getParam("convert_fonts_to_spans"))nodeName = "span";var face = tinyMCE.getAttrib(path[i], "face");if (face != "")nodeData += "font: " + tinyMCE.xmlEncode(face) + " ";var size = tinyMCE.getAttrib(path[i], "size");if (size != "")nodeData += "size: " + tinyMCE.xmlEncode(size) + " ";var color = tinyMCE.getAttrib(path[i], "color");if (color != "")nodeData += "color: " + tinyMCE.xmlEncode(color) + " ";}if (tinyMCE.getAttrib(path[i], 'id') != "") {nodeData += "id: " + path[i].getAttribute('id') + " ";}var className = tinyMCE.getVisualAidClass(tinyMCE.getAttrib(path[i], "class"), false);if (className != "" && className.indexOf('mceItem') == -1)nodeData += "class: " + className + " ";if (tinyMCE.getAttrib(path[i], 'src') != "") {var src = tinyMCE.getAttrib(path[i], "mce_src");if (src == "") src = tinyMCE.getAttrib(path[i], "src");nodeData += "src: " + tinyMCE.xmlEncode(src) + " ";}if (path[i].nodeName == 'A' && tinyMCE.getAttrib(path[i], 'href') != "") {var href = tinyMCE.getAttrib(path[i], "mce_href");if (href == "") href = tinyMCE.getAttrib(path[i], "href");nodeData += "href: " + tinyMCE.xmlEncode(href) + " ";}className = tinyMCE.getAttrib(path[i], "class");if ((nodeName == "img" || nodeName == "span") && className.indexOf('mceItem') != -1) {nodeName = className.replace(/mceItem([a-z]+)/gi, '$1').toLowerCase();nodeData = path[i].getAttribute('title');}if (nodeName == "a" && (anchor = tinyMCE.getAttrib(path[i], "name")) != "") {nodeName = "a";nodeName += "#" + tinyMCE.xmlEncode(anchor);nodeData = "";}if (tinyMCE.getAttrib(path[i], 'name').indexOf("mce_") != 0) {var className = tinyMCE.getVisualAidClass(tinyMCE.getAttrib(path[i], "class"), false);if (className != "" && className.indexOf('mceItem') == -1) {nodeName += "." + className;}}var cmd = 'tinyMCE.execInstanceCommand(\'' + editor_id + '\',\'mceSelectNodeDepth\',false,\'' + i + '\');';html += '<a title="' + nodeData + '" href="javascript:' + cmd + '" onclick="' + cmd + 'return false;" onmousedown="return false;" target="_self" class="mcePathItem">' + nodeName + '</a>';if (i > 0) {html += " &raquo; ";}}pathElm.innerHTML = '<a href="#" accesskey="x"></a>' + tinyMCE.getLang('lang_theme_path') + ": " + html + '&#160;';}tinyMCE.switchClass(editor_id + '_justifyleft', 'mceButtonNormal');tinyMCE.switchClass(editor_id + '_justifyright', 'mceButtonNormal');tinyMCE.switchClass(editor_id + '_justifycenter', 'mceButtonNormal');tinyMCE.switchClass(editor_id + '_justifyfull', 'mceButtonNormal');tinyMCE.switchClass(editor_id + '_bold', 'mceButtonNormal');tinyMCE.switchClass(editor_id + '_italic', 'mceButtonNormal');tinyMCE.switchClass(editor_id + '_underline', 'mceButtonNormal');tinyMCE.switchClass(editor_id + '_strikethrough', 'mceButtonNormal');tinyMCE.switchClass(editor_id + '_bullist', 'mceButtonNormal');tinyMCE.switchClass(editor_id + '_numlist', 'mceButtonNormal');tinyMCE.switchClass(editor_id + '_sub', 'mceButtonNormal');tinyMCE.switchClass(editor_id + '_sup', 'mceButtonNormal');tinyMCE.switchClass(editor_id + '_anchor', 'mceButtonNormal');tinyMCE.switchClass(editor_id + '_link', 'mceButtonDisabled');tinyMCE.switchClass(editor_id + '_unlink', 'mceButtonDisabled');tinyMCE.switchClass(editor_id + '_outdent', 'mceButtonDisabled');tinyMCE.switchClass(editor_id + '_image', 'mceButtonNormal');tinyMCE.switchClass(editor_id + '_hr', 'mceButtonNormal');if (node.nodeName == "A" && tinyMCE.getAttrib(node, "class").indexOf('mceItemAnchor') != -1)tinyMCE.switchClass(editor_id + '_anchor', 'mceButtonSelected');var anchorLink = tinyMCE.getParentElement(node, "a", "href");if (anchorLink || any_selection) {tinyMCE.switchClass(editor_id + '_link', anchorLink ? 'mceButtonSelected' : 'mceButtonNormal');tinyMCE.switchClass(editor_id + '_unlink', anchorLink ? 'mceButtonSelected' : 'mceButtonNormal');}tinyMCE.switchClass(editor_id + '_visualaid', visual_aid ? 'mceButtonSelected' : 'mceButtonNormal');if (undo_levels != -1) {tinyMCE.switchClass(editor_id + '_undo', 'mceButtonDisabled');tinyMCE.switchClass(editor_id + '_redo', 'mceButtonDisabled');}if (tinyMCE.getParentElement(node, "li,blockquote"))tinyMCE.switchClass(editor_id + '_outdent', 'mceButtonNormal');if (undo_index != -1 && (undo_index < undo_levels-1 && undo_levels > 0))tinyMCE.switchClass(editor_id + '_redo', 'mceButtonNormal');if (undo_index != -1 && (undo_index > 0 && undo_levels > 0))tinyMCE.switchClass(editor_id + '_undo', 'mceButtonNormal');var selectElm = document.getElementById(editor_id + "_styleSelect");if (selectElm) {TinyMCE_AdvancedTheme._setupCSSClasses(editor_id);classNode = node;breakOut = false;var index = 0;do {if (classNode && classNode.className) {for (var i=0; i<selectElm.options.length; i++) {if (selectElm.options[i].value == classNode.className) {index = i;breakOut = true;break;}}}} while (!breakOut && classNode != null && (classNode = classNode.parentNode) != null);selectElm.selectedIndex = index;}var selectElm = document.getElementById(editor_id + "_formatSelect");if (selectElm) {var elm = tinyMCE.getParentElement(node, "p,div,h1,h2,h3,h4,h5,h6,pre,address");if (elm)selectByValue(selectElm, "<" + elm.nodeName.toLowerCase() + ">");else
selectByValue(selectElm, "");}var selectElm = document.getElementById(editor_id + "_fontNameSelect");if (selectElm) {if (!tinyMCE.isSafari && !(tinyMCE.isMSIE && !tinyMCE.isOpera)) {var face = inst.queryCommandValue('FontName');face = face == null || face == "" ? "" : face;selectByValue(selectElm, face, face != "");} else {var elm = tinyMCE.getParentElement(node, "font", "face");if (elm) {var family = tinyMCE.getAttrib(elm, "face");if (family == '')family = '' + elm.style.fontFamily;if (!selectByValue(selectElm, family, family != ""))selectByValue(selectElm, "");} else
selectByValue(selectElm, "");}}var selectElm = document.getElementById(editor_id + "_fontSizeSelect");if (selectElm) {if (!tinyMCE.isSafari && !tinyMCE.isOpera) {var size = inst.queryCommandValue('FontSize');selectByValue(selectElm, size == null || size == "" ? "0" : size);} else {var elm = tinyMCE.getParentElement(node, "font", "size");if (elm) {var size = tinyMCE.getAttrib(elm, "size");if (size == '') {var sizes = new Array('', '8px', '10px', '12px', '14px', '18px', '24px', '36px');size = '' + elm.style.fontSize;for (var i=0; i<sizes.length; i++) {if (('' + sizes[i]) == size) {size = i;break;}}}if (!selectByValue(selectElm, size))selectByValue(selectElm, "");} else
selectByValue(selectElm, "0");}}alignNode = node;breakOut = false;do {if (!alignNode.getAttribute || !alignNode.getAttribute('align'))continue;switch (alignNode.getAttribute('align').toLowerCase()) {case "left":tinyMCE.switchClass(editor_id + '_justifyleft', 'mceButtonSelected');breakOut = true;break;case "right":tinyMCE.switchClass(editor_id + '_justifyright', 'mceButtonSelected');breakOut = true;break;case "middle":case "center":tinyMCE.switchClass(editor_id + '_justifycenter', 'mceButtonSelected');breakOut = true;break;case "justify":tinyMCE.switchClass(editor_id + '_justifyfull', 'mceButtonSelected');breakOut = true;break;}} while (!breakOut && (alignNode = alignNode.parentNode) != null);var div = tinyMCE.getParentElement(node, "div");if (div && div.style.textAlign == "center")tinyMCE.switchClass(editor_id + '_justifycenter', 'mceButtonSelected');if (!setup_content) {var ar = new Array("Bold", "_bold", "Italic", "_italic", "Strikethrough", "_strikethrough", "superscript", "_sup", "subscript", "_sub");for (var i=0; i<ar.length; i+=2) {if (inst.queryCommandState(ar[i]))tinyMCE.switchClass(editor_id + ar[i+1], 'mceButtonSelected');}if (inst.queryCommandState("Underline") && (node.parentNode == null || node.parentNode.nodeName != "A"))tinyMCE.switchClass(editor_id + '_underline', 'mceButtonSelected');}do {switch (node.nodeName) {case "UL":tinyMCE.switchClass(editor_id + '_bullist', 'mceButtonSelected');break;case "OL":tinyMCE.switchClass(editor_id + '_numlist', 'mceButtonSelected');break;case "HR": tinyMCE.switchClass(editor_id + '_hr', 'mceButtonSelected');break;case "IMG":if (tinyMCE.getAttrib(node, 'name').indexOf('mce_') != 0 && tinyMCE.getAttrib(node, 'class').indexOf('mceItem') == -1) {tinyMCE.switchClass(editor_id + '_image', 'mceButtonSelected');}break;}} while ((node = node.parentNode) != null);},
_setupCSSClasses : function(editor_id) {var i, selectElm;if (!TinyMCE_AdvancedTheme._autoImportCSSClasses)return;selectElm = document.getElementById(editor_id + '_styleSelect');if (selectElm && selectElm.getAttribute('cssImported') != 'true') {var csses = tinyMCE.getCSSClasses(editor_id);if (csses && selectElm)	{for (i=0; i<csses.length; i++)selectElm.options[selectElm.options.length] = new Option(csses[i], csses[i]);}if (csses != null && csses.length > 0)selectElm.setAttribute('cssImported', 'true');}},
_setCookie : function(name, value, expires, path, domain, secure) {var curCookie = name + "=" + escape(value) +
((expires) ? "; expires=" + expires.toGMTString() : "") +
((path) ? "; path=" + escape(path) : "") +
((domain) ? "; domain=" + domain : "") +
((secure) ? "; secure" : "");document.cookie = curCookie;},
_getCookie : function(name) {var dc = document.cookie;var prefix = name + "=";var begin = dc.indexOf("; " + prefix);if (begin == -1) {begin = dc.indexOf(prefix);if (begin != 0)return null;} else
begin += 2;var end = document.cookie.indexOf(";", begin);if (end == -1)end = dc.length;return unescape(dc.substring(begin + prefix.length, end));},
_resizeTo : function(inst, w, h, set_w) {var editorContainer = document.getElementById(inst.editorId + '_parent');var tableElm = editorContainer.firstChild;var iframe = inst.iframeElement;if (w == null || w == "null") {set_w = false;w = 0;}if (h == null || h == "null")return;w = parseInt(w);h = parseInt(h);if (tinyMCE.isGecko) {w += 2;h += 2;}var dx = w - tableElm.clientWidth;var dy = h - tableElm.clientHeight;w = w < 1 ? 30 : w;h = h < 1 ? 30 : h;if (set_w)tableElm.style.width = w + "px";if ( !tinyMCE.isMSIE || tinyMCE.isMSIE7 || tinyMCE.isOpera )tableElm.style.height = h + "px";iw = iframe.clientWidth + dx;ih = iframe.clientHeight + dy;iw = iw < 1 ? 30 : iw;ih = ih < 1 ? 30 : ih;if (set_w)iframe.style.width = iw + "px";iframe.style.height = ih + "px";if (set_w) {var tableBodyElm = tableElm.firstChild;var minIframeWidth = tableBodyElm.scrollWidth;if (inst.iframeElement.clientWidth < minIframeWidth) {dx = minIframeWidth - inst.iframeElement.clientWidth;inst.iframeElement.style.width = (iw + dx) + "px";}}tableElm.style.height = h + "px";inst.useCSS = false;},
_resizeEventHandler : function(e) {var resizer = TinyMCE_AdvancedTheme._resizer;if (!resizer.resizing)return;e = typeof(e) == "undefined" ? window.event : e;var dx = e.screenX - resizer.downX;var dy = e.screenY - resizer.downY;var resizeBox = resizer.resizeBox;var editorId = resizer.editorId;switch (e.type) {case "mousemove":var w, h;w = resizer.width + dx;h = resizer.height + dy;w = w < 1 ? 1 : w;h = h < 1 ? 1 : h;if (resizer.horizontal)resizeBox.style.width = w + "px";resizeBox.style.height = h + "px";break;case "mouseup":TinyMCE_AdvancedTheme._setResizing(e, editorId, false);TinyMCE_AdvancedTheme._resizeTo(tinyMCE.getInstanceById(editorId), resizer.width + dx, resizer.height + dy, resizer.horizontal);if (tinyMCE.getParam("theme_advanced_resizing_use_cookie", true)) {var expires = new Date();expires.setTime(expires.getTime() + 3600000 * 24 * 30);TinyMCE_AdvancedTheme._setCookie("TinyMCE_" + editorId + "_width", "" + (resizer.horizontal ? resizer.width + dx : ""), expires);TinyMCE_AdvancedTheme._setCookie("TinyMCE_" + editorId + "_height", "" + (resizer.height + dy), expires);}break;}},
_setResizing : function(e, editor_id, state) {e = typeof(e) == "undefined" ? window.event : e;var resizer = TinyMCE_AdvancedTheme._resizer;var editorContainer = document.getElementById(editor_id + '_parent');var editorArea = document.getElementById(editor_id + '_parent').firstChild;var resizeBox = document.getElementById(editor_id + '_resize_box');var inst = tinyMCE.getInstanceById(editor_id);if (state) {var width = editorArea.clientWidth;var height = editorArea.clientHeight;resizeBox.style.width = width + "px";resizeBox.style.height = height + "px";resizer.iframeWidth = inst.iframeElement.clientWidth;resizer.iframeHeight = inst.iframeElement.clientHeight;editorArea.style.display = "none";resizeBox.style.display = "block";if (!resizer.eventHandlers) {if (tinyMCE.isMSIE)tinyMCE.addEvent(document, "mousemove", TinyMCE_AdvancedTheme._resizeEventHandler);else
tinyMCE.addEvent(window, "mousemove", TinyMCE_AdvancedTheme._resizeEventHandler);tinyMCE.addEvent(document, "mouseup", TinyMCE_AdvancedTheme._resizeEventHandler);resizer.eventHandlers = true;}resizer.resizing = true;resizer.downX = e.screenX;resizer.downY = e.screenY;resizer.width = parseInt(resizeBox.style.width);resizer.height = parseInt(resizeBox.style.height);resizer.editorId = editor_id;resizer.resizeBox = resizeBox;resizer.horizontal = tinyMCE.getParam("theme_advanced_resize_horizontal", true);} else {resizer.resizing = false;resizeBox.style.display = "none";editorArea.style.display = tinyMCE.isMSIE && !tinyMCE.isOpera ? "block" : "table";tinyMCE.execCommand('mceResetDesignMode');}},
_getColorHTML : function(id, n, cm) {var i, h, cl;h = '<span class="mceMenuLine"></span>';cl = tinyMCE.getParam(n, TinyMCE_AdvancedTheme._defColors).split(',');h += '<table class="mceColors"><tr>';for (i=0; i<cl.length; i++) {c = 'tinyMCE.execInstanceCommand(\'' + id + '\', \'' + cm + '\', false, \'#' + cl[i] + '\');';h += '<td><a href="javascript:' + c + '" style="background-color: #' + cl[i] + '" onclick="' + c + ';return false;"></a></td>';if ((i+1) % 8 == 0)h += '</tr><tr>';}h += '</tr></table>';if (tinyMCE.getParam("theme_advanced_more_colors", true))h += '<a href="javascript:void(0);" onclick="TinyMCE_AdvancedTheme._pickColor(\'' + id + '\',\'' + cm + '\');" class="mceMoreColors">' + tinyMCE.getLang('lang_more_colors') + '</a>';return h;},
_pickColor : function(id, cm) {var inputColor, inst = tinyMCE.selectedInstance;if (cm == 'forecolor' && inst)inputColor = inst.foreColor;if ((cm == 'backcolor' || cm == 'HiliteColor') && inst)inputColor = inst.backColor;tinyMCE.execCommand('mceColorPicker', true, {color : inputColor, callback : function(c) {tinyMCE.execInstanceCommand(id, cm, false, c);}});},
_insertImage : function(src, alt, border, hspace, vspace, width, height, align, title, onmouseover, onmouseout) {tinyMCE.execCommand("mceInsertContent", false, tinyMCE.createTagHTML('img', {src : tinyMCE.convertRelativeToAbsoluteURL(tinyMCE.settings['base_href'], src),
mce_src : src,
alt : alt,
border : border,
hspace : hspace,
vspace : vspace,
width : width,
height : height,
align : align,
title : title,
onmouseover : onmouseover,
onmouseout : onmouseout
}));},
_insertLink : function(href, target, title, onclick, style_class) {tinyMCE.execCommand('mceBeginUndoLevel');if (tinyMCE.selectedInstance && tinyMCE.selectedElement && tinyMCE.selectedElement.nodeName.toLowerCase() == "img") {var doc = tinyMCE.selectedInstance.getDoc();var linkElement = tinyMCE.getParentElement(tinyMCE.selectedElement, "a");var newLink = false;if (!linkElement) {linkElement = doc.createElement("a");newLink = true;}var mhref = href;var thref = eval(tinyMCE.settings['urlconverter_callback'] + "(href, linkElement);");mhref = tinyMCE.getParam('convert_urls') ? href : mhref;tinyMCE.setAttrib(linkElement, 'href', thref);tinyMCE.setAttrib(linkElement, 'mce_href', mhref);tinyMCE.setAttrib(linkElement, 'target', target);tinyMCE.setAttrib(linkElement, 'title', title);tinyMCE.setAttrib(linkElement, 'onclick', onclick);tinyMCE.setAttrib(linkElement, 'class', style_class);if (newLink) {linkElement.appendChild(tinyMCE.selectedElement.cloneNode(true));tinyMCE.selectedElement.parentNode.replaceChild(linkElement, tinyMCE.selectedElement);}return;}if (!tinyMCE.linkElement && tinyMCE.selectedInstance) {if (tinyMCE.isSafari) {tinyMCE.execCommand("mceInsertContent", false, '<a href="' + tinyMCE.uniqueURL + '">' + tinyMCE.selectedInstance.selection.getSelectedHTML() + '</a>');} else
tinyMCE.selectedInstance.contentDocument.execCommand("createlink", false, tinyMCE.uniqueURL);tinyMCE.linkElement = tinyMCE.getElementByAttributeValue(tinyMCE.selectedInstance.contentDocument.body, "a", "href", tinyMCE.uniqueURL);var elementArray = tinyMCE.getElementsByAttributeValue(tinyMCE.selectedInstance.contentDocument.body, "a", "href", tinyMCE.uniqueURL);for (var i=0; i<elementArray.length; i++) {var mhref = href;var thref = eval(tinyMCE.settings['urlconverter_callback'] + "(href, elementArray[i]);");mhref = tinyMCE.getParam('convert_urls') ? href : mhref;tinyMCE.setAttrib(elementArray[i], 'href', thref);tinyMCE.setAttrib(elementArray[i], 'mce_href', mhref);tinyMCE.setAttrib(elementArray[i], 'target', target);tinyMCE.setAttrib(elementArray[i], 'title', title);tinyMCE.setAttrib(elementArray[i], 'onclick', onclick);tinyMCE.setAttrib(elementArray[i], 'class', style_class);}tinyMCE.linkElement = elementArray[0];}if (tinyMCE.linkElement) {var mhref = href;href = eval(tinyMCE.settings['urlconverter_callback'] + "(href, tinyMCE.linkElement);");mhref = tinyMCE.getParam('convert_urls') ? href : mhref;tinyMCE.setAttrib(tinyMCE.linkElement, 'href', href);tinyMCE.setAttrib(tinyMCE.linkElement, 'mce_href', mhref);tinyMCE.setAttrib(tinyMCE.linkElement, 'target', target);tinyMCE.setAttrib(tinyMCE.linkElement, 'title', title);tinyMCE.setAttrib(tinyMCE.linkElement, 'onclick', onclick);tinyMCE.setAttrib(tinyMCE.linkElement, 'class', style_class);}tinyMCE.execCommand('mceEndUndoLevel');}};tinyMCE.addTheme("advanced", TinyMCE_AdvancedTheme);tinyMCE.addButtonMap(TinyMCE_AdvancedTheme._buttonMap);
// UK lang variables

tinyMCE.addToLang('',{
theme_style_select : '-- Styles --',
theme_code_desc : 'Edit HTML Source',
theme_code_title : 'HTML Source Editor',
theme_code_wordwrap : 'Word wrap',
theme_sub_desc : 'Subscript',
theme_sup_desc : 'Superscript',
theme_hr_desc : 'Insert horizontal ruler',
theme_removeformat_desc : 'Remove formatting',
theme_custom1_desc : 'Your custom description here',
insert_image_border : 'Border',
insert_image_dimensions : 'Dimensions',
insert_image_vspace : 'Vertical space',
insert_image_hspace : 'Horizontal space',
insert_image_align : 'Alignment',
insert_image_align_default : '-- Not set --',
insert_image_align_baseline : 'Baseline',
insert_image_align_top : 'Top',
insert_image_align_middle : 'Middle',
insert_image_align_bottom : 'Bottom',
insert_image_align_texttop : 'TextTop',
insert_image_align_absmiddle : 'Absolute Middle',
insert_image_align_absbottom : 'Absolute Bottom',
insert_image_align_left : 'Left',
insert_image_align_right : 'Right',
theme_font_size : '-- Font size --',
theme_fontdefault : '-- Font family --',
theme_block : '-- Format --',
theme_paragraph : 'Paragraph',
theme_div : 'Div',
theme_address : 'Address',
theme_pre : 'Preformatted',
theme_h1 : 'Heading 1',
theme_h2 : 'Heading 2',
theme_h3 : 'Heading 3',
theme_h4 : 'Heading 4',
theme_h5 : 'Heading 5',
theme_h6 : 'Heading 6',
theme_blockquote : 'Blockquote',
theme_code : 'Code',
theme_samp : 'Code sample',
theme_dt : 'Definition term ',
theme_dd : 'Definition description',
theme_colorpicker_title : 'Select a color',
theme_colorpicker_apply : 'Apply',
theme_forecolor_desc : 'Select text color',
theme_backcolor_desc : 'Select background color',
theme_charmap_title : 'Select custom character',
theme_charmap_desc : 'Insert custom character',
theme_visualaid_desc : 'Toggle guidelines/invisible elements',
insert_anchor_title : 'Insert/edit anchor',
insert_anchor_name : 'Anchor name',
theme_anchor_desc : 'Insert/edit anchor',
theme_insert_link_titlefield : 'Title',
theme_clipboard_msg : 'Copy/Cut/Paste is not available in Mozilla and Firefox.\nDo you want more information about this issue?',
theme_path : 'Path',
cut_desc : 'Cut',
copy_desc : 'Copy',
paste_desc : 'Paste',
link_list : 'Link list',
image_list : 'Image list',
browse : 'Browse',
image_props_desc : 'Image properties',
newdocument_desc : 'New document',
class_name : 'Class',
newdocument : 'Are you sure you want clear all contents?',
about_title : 'About TinyMCE',
about : 'About',
license : 'License',
plugins : 'Plugins',
plugin : 'Plugin',
author : 'Author',
version : 'Version',
loaded_plugins : 'Loaded plugins',
help : 'Help',
not_set : '-- Not set --',
close : 'Close',
toolbar_focus : 'Jump to tool buttons - Alt+Q, Jump to editor - Alt-Z, Jump to element path - Alt-X',
invalid_data : 'Error: Invalid values entered, these are marked in red.',
more_colors : 'More colors',
color_picker_tab : 'Picker',
color_picker : 'Color picker',
web_colors_tab : 'Palette',
web_colors : 'Palette colors',
named_colors_tab : 'Named',
named_colors : 'Named colors',
color : 'Color:',
color_name : 'Name:',
is_email : 'The URL you entered seems to be an email address, do you want to add the required mailto: prefix?',
is_external : 'The URL you entered seems to external link, do you want to add the required http:// prefix?'
});
/**
 * $Id: editor_plugin_src.js 268 2007-04-28 15:52:59Z spocke $
 *
 * Moxiecode DHTML Windows script.
 *
 * @author Moxiecode
 * @copyright Copyright © 2004-2007, Moxiecode Systems AB, All rights reserved.
 */

// Patch openWindow, closeWindow TinyMCE functions

var TinyMCE_InlinePopupsPlugin = {
	getInfo : function() {
		return {
			longname : 'Inline Popups',
			author : 'Moxiecode Systems AB',
			authorurl : 'http://tinymce.moxiecode.com',
			infourl : 'http://wiki.moxiecode.com/index.php/TinyMCE:Plugins/inlinepopups',
			version : tinyMCE.majorVersion + "." + tinyMCE.minorVersion
		};
	}
};

tinyMCE.addPlugin("inlinepopups", TinyMCE_InlinePopupsPlugin);

// Patch openWindow, closeWindow TinyMCE functions

TinyMCE_Engine.prototype.orgOpenWindow = TinyMCE_Engine.prototype.openWindow;
TinyMCE_Engine.prototype.orgCloseWindow = TinyMCE_Engine.prototype.closeWindow;

TinyMCE_Engine.prototype.openWindow = function(template, args) {
	// Does the caller support inline
	if (args['inline'] != "yes" || tinyMCE.isOpera || tinyMCE.getParam("plugins").indexOf('inlinepopups') == -1) {
		mcWindows.selectedWindow = null;
		args['mce_inside_iframe'] = false;
		this.orgOpenWindow(template, args);
		return;
	}

	var url, resizable, scrollbars;

	args['mce_inside_iframe'] = true;
	tinyMCE.windowArgs = args;

	if (template['file'].charAt(0) != '/' && template['file'].indexOf('://') == -1)
		url = tinyMCE.baseURL + "/themes/" + tinyMCE.getParam("theme") + "/" + template['file'];
	else
		url = template['file'];

	if (!(width = parseInt(template['width'])))
		width = 320;

	if (!(height = parseInt(template['height'])))
		height = 200;

	if (!(minWidth = parseInt(template['minWidth'])))
		minWidth = 100;

	if (!(minHeight = parseInt(template['minHeight'])))
		minHeight = 100;

	resizable = (args && args['resizable']) ? args['resizable'] : "no";
	scrollbars = (args && args['scrollbars']) ? args['scrollbars'] : "no";

	height += 18;

	// Replace all args as variables in URL
	for (var name in args) {
		if (typeof(args[name]) == 'function')
			continue;

		url = tinyMCE.replaceVar(url, name, escape(args[name]));
	}

	var elm = document.getElementById(this.selectedInstance.editorId + '_parent');

	if (tinyMCE.hasPlugin('fullscreen') && this.selectedInstance.getData('fullscreen').enabled)
		pos = { absLeft: 0, absTop: 0 };
	else
		pos = tinyMCE.getAbsPosition(elm);

	// Center div in editor area
	pos.absLeft += Math.round((elm.firstChild.clientWidth / 2) - (width / 2));
	pos.absTop += Math.round((elm.firstChild.clientHeight / 2) - (height / 2));
	
	// WordPress cache buster
	url += tinyMCE.settings['imp_version'] ? (url.indexOf('?')==-1?'?':'&') + 'ver=' + tinyMCE.settings['imp_version'] : '';

	mcWindows.open(url, mcWindows.idCounter++, "modal=yes,width=" + width+ ",height=" + height + ",resizable=" + resizable + ",scrollbars=" + scrollbars + ",statusbar=" + resizable + ",left=" + pos.absLeft + ",top=" + pos.absTop + ",minWidth=" + minWidth + ",minHeight=" + minHeight );
};

TinyMCE_Engine.prototype.closeWindow = function(win) {
	var gotit = false, n, w;

	for (n in mcWindows.windows) {
		w = mcWindows.windows[n];

		if (typeof(w) == 'function')
			continue;

		if (win.name == w.id + '_iframe') {
			w.close();
			gotit = true;
		}
	}

	if (!gotit)
		this.orgCloseWindow(win);

	tinyMCE.selectedInstance.getWin().focus(); 
};

TinyMCE_Engine.prototype.setWindowTitle = function(win_ref, title) {
	for (var n in mcWindows.windows) {
		var win = mcWindows.windows[n];
		if (typeof(win) == 'function')
			continue;

		if (win_ref.name == win.id + "_iframe")
			window.frames[win.id + "_iframe"].document.getElementById(win.id + '_title').innerHTML = title;
	}
};

// * * * * * TinyMCE_Windows classes below

// Windows handler
function TinyMCE_Windows() {
	this.settings = new Array();
	this.windows = new Array();
	this.isMSIE = (navigator.appName == "Microsoft Internet Explorer");
	this.isGecko = navigator.userAgent.indexOf('Gecko') != -1;
	this.isSafari = navigator.userAgent.indexOf('Safari') != -1;
	this.isMac = navigator.userAgent.indexOf('Mac') != -1;
	this.isMSIE5_0 = this.isMSIE && (navigator.userAgent.indexOf('MSIE 5.0') != -1);
	this.action = "none";
	this.selectedWindow = null;
	this.lastSelectedWindow = null;
	this.zindex = 1001;
	this.mouseDownScreenX = 0;
	this.mouseDownScreenY = 0;
	this.mouseDownLayerX = 0;
	this.mouseDownLayerY = 0;
	this.mouseDownWidth = 0;
	this.mouseDownHeight = 0;
	this.idCounter = 0;
};

TinyMCE_Windows.prototype.init = function(settings) {
	this.settings = settings;

	if (this.isMSIE)
		this.addEvent(document, "mousemove", mcWindows.eventDispatcher);
	else
		this.addEvent(window, "mousemove", mcWindows.eventDispatcher);

	this.addEvent(document, "mouseup", mcWindows.eventDispatcher);

	this.addEvent(window, "resize", mcWindows.eventDispatcher);
	this.addEvent(document, "scroll", mcWindows.eventDispatcher);

	this.doc = document;
};

TinyMCE_Windows.prototype.getBounds = function() {
	if (!this.bounds) {
		var vp = tinyMCE.getViewPort(window);
		var top, left, bottom, right, docEl = this.doc.documentElement;

		top    = vp.top;
		left   = vp.left;
		bottom = vp.height + top - 2;
		right  = vp.width  + left - 22; // TODO this number is platform dependant
		// x1, y1, x2, y2
		this.bounds = [left, top, right, bottom];
	}
	return this.bounds;
};

TinyMCE_Windows.prototype.clampBoxPosition = function(x, y, w, h, minW, minH) {
	var bounds = this.getBounds();

	x = Math.max(bounds[0], Math.min(bounds[2], x + w) - w);
	y = Math.max(bounds[1], Math.min(bounds[3], y + h) - h);

	return this.clampBoxSize(x, y, w, h, minW, minH);
};

TinyMCE_Windows.prototype.clampBoxSize = function(x, y, w, h, minW, minH) {
	var bounds = this.getBounds();

	return [
		x, y,
		Math.max(minW, Math.min(bounds[2], x + w) - x),
		Math.max(minH, Math.min(bounds[3], y + h) - y)
	];
};

TinyMCE_Windows.prototype.getParam = function(name, default_value) {
	var value = null;

	value = (typeof(this.settings[name]) == "undefined") ? default_value : this.settings[name];

	// Fix bool values
	if (value == "true" || value == "false")
		return (value == "true");

	return value;
};

TinyMCE_Windows.prototype.eventDispatcher = function(e) {
	e = typeof(e) == "undefined" ? window.event : e;

	if (mcWindows.selectedWindow == null)
		return;

	// Switch focus
	if (mcWindows.isGecko && e.type == "mousedown") {
		var elm = e.currentTarget;

		for (var n in mcWindows.windows) {
			var win = mcWindows.windows[n];

			if (win.headElement == elm || win.resizeElement == elm) {
				win.focus();
				break;
			}
		}
	}

	switch (e.type) {
		case "mousemove":
			mcWindows.selectedWindow.onMouseMove(e);
			break;

		case "mouseup":
			mcWindows.selectedWindow.onMouseUp(e);
			break;

		case "mousedown":
			mcWindows.selectedWindow.onMouseDown(e);
			break;

		case "focus":
			mcWindows.selectedWindow.onFocus(e);
			break;
		case "scroll":
		case "resize":
			if (mcWindows.clampUpdateTimeout)
				clearTimeout(mcWindows.clampUpdateTimeout);
			mcWindows.clampEventType = e.type;
			mcWindows.clampUpdateTimeout =
				setTimeout(function () {mcWindows.updateClamping()}, 100);
			break;
	}
};

TinyMCE_Windows.prototype.updateClamping = function () {
	var clamp, oversize, etype = mcWindows.clampEventType;

	this.bounds = null; // Recalc window bounds on resize/scroll
	this.clampUpdateTimeout = null;

	for (var n in this.windows) {
		win = this.windows[n];
		if (typeof(win) == 'function' || ! win.winElement) continue;

		clamp = mcWindows.clampBoxPosition(
			win.left, win.top,
			win.winElement.scrollWidth,
			win.winElement.scrollHeight,
			win.features.minWidth,
			win.features.minHeight
		);
		oversize = (
			clamp[2] != win.winElement.scrollWidth ||
			clamp[3] != win.winElement.scrollHeight
		) ? true : false;

		if (!oversize || win.features.resizable == "yes" || etype != "scroll")
			win.moveTo(clamp[0], clamp[1]);
		if (oversize && win.features.resizable == "yes")
			win.resizeTo(clamp[2], clamp[3]);
	}
};

TinyMCE_Windows.prototype.addEvent = function(obj, name, handler) {
	if (this.isMSIE)
		obj.attachEvent("on" + name, handler);
	else
		obj.addEventListener(name, handler, false);
};

TinyMCE_Windows.prototype.cancelEvent = function(e) {
	if (this.isMSIE) {
		e.returnValue = false;
		e.cancelBubble = true;
	} else
		e.preventDefault();
};

TinyMCE_Windows.prototype.parseFeatures = function(opts) {
	// Cleanup the options
	opts = opts.toLowerCase();
	opts = opts.replace(/;/g, ",");
	opts = opts.replace(/[^0-9a-z=,]/g, "");

	var optionChunks = opts.split(',');
	var options = new Array();

	options['left'] = "10";
	options['top'] = "10";
	options['width'] = "300";
	options['height'] = "300";
	options['minwidth'] = "100";
	options['minheight'] = "100";
	options['resizable'] = "yes";
	options['minimizable'] = "yes";
	options['maximizable'] = "yes";
	options['close'] = "yes";
	options['movable'] = "yes";
	options['statusbar'] = "yes";
	options['scrollbars'] = "auto";
	options['modal'] = "no";

	if (opts == "")
		return options;

	for (var i=0; i<optionChunks.length; i++) {
		var parts = optionChunks[i].split('=');

		if (parts.length == 2)
			options[parts[0]] = parts[1];
	}

	options['left'] = parseInt(options['left']);
	options['top'] = parseInt(options['top']);
	options['width'] = parseInt(options['width']);
	options['height'] = parseInt(options['height']);
	options['minWidth'] = parseInt(options['minwidth']);
	options['minHeight'] = parseInt(options['minheight']);

	return options;
};

TinyMCE_Windows.prototype.open = function(url, name, features) {
	this.lastSelectedWindow = this.selectedWindow;

	var win = new TinyMCE_Window();
	var winDiv, html = "", id;
	var imgPath = this.getParam("images_path");

	features = this.parseFeatures(features);

	// Clamp specified dimensions
	var clamp = mcWindows.clampBoxPosition(
		features['left'], features['top'],
		features['width'], features['height'],
		features['minWidth'], features['minHeight']
	);

	features['left'] = clamp[0];
	features['top'] = clamp[1];

	if (features['resizable'] == "yes") {
		features['width'] = clamp[2];
		features['height'] = clamp[3];
	}

	// Create div
	id = "mcWindow_" + name;
	win.deltaHeight = 18;

	if (features['statusbar'] == "yes") {
		win.deltaHeight += 13;

		if (this.isMSIE)
			win.deltaHeight += 1;
	}

	width = parseInt(features['width']);
	height = parseInt(features['height'])-win.deltaHeight;

	if (this.isMSIE)
		width -= 2;

	// Setup first part of window
	win.id = id;
	win.url = url;
	win.name = name;
	win.features = features;
	this.windows[name] = win;

	iframeWidth = width;
	iframeHeight = height;

	// Create inner content
	html += '<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">';
	html += '<html>';
	html += '<head>';
	html += '<title>Wrapper iframe</title>';
	
	// WordPress: put the window buttons on the left as in Macs
	if (this.isMac) html += '<style type="text/css">.mceWindowTitle{float:none;margin:0;width:100%;text-align:center;}.mceWindowClose{float:none;position:absolute;left:0px;top:0px;}</style>';
	
	html += '<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">';
	html += '<link href="' + this.getParam("css_file") + '" rel="stylesheet" type="text/css" />';
	html += '</head>';
	html += '<body onload="parent.mcWindows.onLoad(\'' + name + '\');">';

	html += '<div id="' + id + '_container" class="mceWindow">';
	html += '<div id="' + id + '_head" class="mceWindowHead" onmousedown="parent.mcWindows.windows[\'' + name + '\'].focus();">';
	html += '  <div id="' + id + '_title" class="mceWindowTitle"';
	html += '  onselectstart="return false;" unselectable="on" style="-moz-user-select: none !important;"></div>';
	html += '    <div class="mceWindowHeadTools">';
	html += '      <a href="javascript:parent.mcWindows.windows[\'' + name + '\'].close();" target="_self" onmousedown="return false;" class="mceWindowClose"><img border="0" src="' + imgPath + '/window_close.gif" /></a>';
	if (features['resizable'] == "yes" && features['maximizable'] == "yes")
		html += '      <a href="javascript:parent.mcWindows.windows[\'' + name + '\'].maximize();" target="_self" onmousedown="return false;" class="mceWindowMaximize"><img border="0" src="' + imgPath + '/window_maximize.gif" /></a>';
	// html += '      <a href="javascript:mcWindows.windows[\'' + name + '\'].minimize();" target="_self" onmousedown="return false;" class="mceWindowMinimize"></a>';
	html += '    </div>';
	html += '</div><div id="' + id + '_body" class="mceWindowBody" style="width: ' + width + 'px; height: ' + height + 'px;">';
	html += '<iframe id="' + id + '_iframe" name="' + id + '_iframe" frameborder="0" width="' + iframeWidth + '" height="' + iframeHeight + '" src="' + url + '" class="mceWindowBodyIframe" scrolling="' + features['scrollbars'] + '"></iframe></div>';

	if (features['statusbar'] == "yes") {
		html += '<div id="' + id + '_statusbar" class="mceWindowStatusbar" onmousedown="parent.mcWindows.windows[\'' + name + '\'].focus();">';

		if (features['resizable'] == "yes") {
			if (this.isGecko)
				html += '<div id="' + id + '_resize" class="mceWindowResize"><div style="background-image: url(\'' + imgPath + '/window_resize.gif\'); width: 12px; height: 12px;"></div></div>';
			else
				html += '<div id="' + id + '_resize" class="mceWindowResize"><img onmousedown="parent.mcWindows.windows[\'' + name + '\'].focus();" border="0" src="' + imgPath + '/window_resize.gif" /></div>';
		}

		html += '</div>';
	}

	html += '</div>';

	html += '</body>';
	html += '</html>';

	// Create iframe
	this.createFloatingIFrame(id, features['left'], features['top'], features['width'], features['height'], html);
};

// Blocks the document events by placing a image over the whole document
TinyMCE_Windows.prototype.setDocumentLock = function(state) {
	var elm = document.getElementById('mcWindowEventBlocker');

	if (state) {
		if (elm == null) {
			elm = document.createElement("div");

			elm.id = "mcWindowEventBlocker";
			elm.style.position = "absolute";
			elm.style.left = "0";
			elm.style.top = "0";

			document.body.appendChild(elm);
		}

		elm.style.display = "none";

		var imgPath = this.getParam("images_path");
		var width = document.body.clientWidth;
		var height = document.body.clientHeight;

		elm.style.width = width;
		elm.style.height = height;
		elm.innerHTML = '<img src="' + imgPath + '/spacer.gif" width="' + width + '" height="' + height + '" />';

		elm.style.zIndex = mcWindows.zindex-1;
		elm.style.display = "block";
	} else if (elm != null) {
		if (mcWindows.windows.length == 0)
			elm.parentNode.removeChild(elm);
		else
			elm.style.zIndex = mcWindows.zindex-1;
	}
};

// Gets called when wrapper iframe is initialized
TinyMCE_Windows.prototype.onLoad = function(name) {
	var win = mcWindows.windows[name];
	var id = "mcWindow_" + name;
	var wrapperIframe = window.frames[id + "_iframe"].frames[0];
	var wrapperDoc = window.frames[id + "_iframe"].document;
	var doc = window.frames[id + "_iframe"].document;
	var winDiv = document.getElementById("mcWindow_" + name + "_div");
	var realIframe = window.frames[id + "_iframe"].frames[0];

	// Set window data
	win.id = "mcWindow_" + name;
	win.winElement = winDiv;
	win.bodyElement = doc.getElementById(id + '_body');
	win.iframeElement = doc.getElementById(id + '_iframe');
	win.headElement = doc.getElementById(id + '_head');
	win.titleElement = doc.getElementById(id + '_title');
	win.resizeElement = doc.getElementById(id + '_resize');
	win.containerElement = doc.getElementById(id + '_container');
	win.left = win.features['left'];
	win.top = win.features['top'];
	win.frame = window.frames[id + '_iframe'].frames[0];
	win.wrapperFrame = window.frames[id + '_iframe'];
	win.wrapperIFrameElement = document.getElementById(id + "_iframe");

	// Add event handlers
	mcWindows.addEvent(win.headElement, "mousedown", mcWindows.eventDispatcher);

	if (win.resizeElement != null)
		mcWindows.addEvent(win.resizeElement, "mousedown", mcWindows.eventDispatcher);

	if (mcWindows.isMSIE) {
		mcWindows.addEvent(realIframe.document, "mousemove", mcWindows.eventDispatcher);
		mcWindows.addEvent(realIframe.document, "mouseup", mcWindows.eventDispatcher);
	} else {
		mcWindows.addEvent(realIframe, "mousemove", mcWindows.eventDispatcher);
		mcWindows.addEvent(realIframe, "mouseup", mcWindows.eventDispatcher);
		mcWindows.addEvent(realIframe, "focus", mcWindows.eventDispatcher);
	}

	for (var i=0; i<window.frames.length; i++) {
		if (!window.frames[i]._hasMouseHandlers) {
			if (mcWindows.isMSIE) {
				mcWindows.addEvent(window.frames[i].document, "mousemove", mcWindows.eventDispatcher);
				mcWindows.addEvent(window.frames[i].document, "mouseup", mcWindows.eventDispatcher);
			} else {
				mcWindows.addEvent(window.frames[i], "mousemove", mcWindows.eventDispatcher);
				mcWindows.addEvent(window.frames[i], "mouseup", mcWindows.eventDispatcher);
			}

			window.frames[i]._hasMouseHandlers = true;
		}
	}

	if (mcWindows.isMSIE) {
		mcWindows.addEvent(win.frame.document, "mousemove", mcWindows.eventDispatcher);
		mcWindows.addEvent(win.frame.document, "mouseup", mcWindows.eventDispatcher);
	} else {
		mcWindows.addEvent(win.frame, "mousemove", mcWindows.eventDispatcher);
		mcWindows.addEvent(win.frame, "mouseup", mcWindows.eventDispatcher);
		mcWindows.addEvent(win.frame, "focus", mcWindows.eventDispatcher);
	}

	// Dispatch open window event
	var func = this.getParam("on_open_window", "");
	if (func != "")
		eval(func + "(win);");

	win.focus();

	if (win.features['modal'] == "yes")
		mcWindows.setDocumentLock(true);
};

TinyMCE_Windows.prototype.createFloatingIFrame = function(id_prefix, left, top, width, height, html) {
	var iframe = document.createElement("iframe");
	var div = document.createElement("div"), doc;

	width = parseInt(width);
	height = parseInt(height)+1;

	// Create wrapper div
	div.setAttribute("id", id_prefix + "_div");
	div.setAttribute("width", width);
	div.setAttribute("height", (height));
	div.style.position = "absolute";

	div.style.left = left + "px";
	div.style.top = top + "px";
	div.style.width = width + "px";
	div.style.height = (height) + "px";
	div.style.backgroundColor = "white";
	div.style.display = "none";

	if (this.isGecko) {
		iframeWidth = width + 2;
		iframeHeight = height + 2;
	} else {
		iframeWidth = width;
		iframeHeight = height + 1;
	}

	// Create iframe
	iframe.setAttribute("id", id_prefix + "_iframe");
	iframe.setAttribute("name", id_prefix + "_iframe");
	iframe.setAttribute("border", "0");
	iframe.setAttribute("frameBorder", "0");
	iframe.setAttribute("marginWidth", "0");
	iframe.setAttribute("marginHeight", "0");
	iframe.setAttribute("leftMargin", "0");
	iframe.setAttribute("topMargin", "0");
	iframe.setAttribute("width", iframeWidth);
	iframe.setAttribute("height", iframeHeight);
	// iframe.setAttribute("src", "../jscripts/tiny_mce/blank.htm");
	// iframe.setAttribute("allowtransparency", "false");
	iframe.setAttribute("scrolling", "no");
	iframe.style.width = iframeWidth + "px";
	iframe.style.height = iframeHeight + "px";
	iframe.style.backgroundColor = "white";
	div.appendChild(iframe);

	document.body.appendChild(div);

	// Fixed MSIE 5.0 issue
	div.innerHTML = div.innerHTML;

	if (this.isSafari) {
		// Give Safari some time to setup
		window.setTimeout(function() {
			var doc = window.frames[id_prefix + '_iframe'].document;
			doc.open();
			doc.write(html);
			doc.close();
		}, 10);
	} else {
		doc = window.frames[id_prefix + '_iframe'].window.document;
		doc.open();
		doc.write(html);
		doc.close();
	}

	div.style.display = "block";

	return div;
};

// Window instance
function TinyMCE_Window() {
};

TinyMCE_Window.prototype.focus = function() {
	if (this != mcWindows.selectedWindow) {
		this.winElement.style.zIndex = ++mcWindows.zindex;
		mcWindows.lastSelectedWindow = mcWindows.selectedWindow;
		mcWindows.selectedWindow = this;
	}
};

TinyMCE_Window.prototype.minimize = function() {
};

TinyMCE_Window.prototype.maximize = function() {
	if (this.restoreSize) {
		this.moveTo(this.restoreSize[0], this.restoreSize[1]);
		this.resizeTo(this.restoreSize[2], this.restoreSize[3]);
		this.updateClamping();
		this.restoreSize = null;
	} else {
		var bounds = mcWindows.getBounds();
		this.restoreSize = [
			this.left, this.top,
			this.winElement.scrollWidth,
			this.winElement.scrollHeight
		];
		this.moveTo(bounds[0], bounds[1]);
		this.resizeTo(
			bounds[2] - bounds[0],
			bounds[3] - bounds[1]
		);
	}
};

TinyMCE_Window.prototype.startResize = function() {
	mcWindows.action = "resize";
};

TinyMCE_Window.prototype.startMove = function(e) {
	mcWindows.action = "move";
};

TinyMCE_Window.prototype.close = function() {
	if (this.frame && this.frame['tinyMCEPopup'])
		this.frame['tinyMCEPopup'].restoreSelection();

	if (mcWindows.lastSelectedWindow != null)
		mcWindows.lastSelectedWindow.focus();

	var mcWindowsNew = new Array();
	for (var n in mcWindows.windows) {
		var win = mcWindows.windows[n];
		if (typeof(win) == 'function')
			continue;

		if (win.name != this.name)
			mcWindowsNew[n] = win;
	}

	mcWindows.windows = mcWindowsNew;

	// alert(mcWindows.doc.getElementById(this.id + "_iframe"));

	var e = mcWindows.doc.getElementById(this.id + "_iframe");
	e.parentNode.removeChild(e);

	var e = mcWindows.doc.getElementById(this.id + "_div");
	e.parentNode.removeChild(e);

	mcWindows.setDocumentLock(false);
};

TinyMCE_Window.prototype.onMouseMove = function(e) {
	var clamp;
	// Calculate real X, Y
	var dx = e.screenX - mcWindows.mouseDownScreenX;
	var dy = e.screenY - mcWindows.mouseDownScreenY;

	switch (mcWindows.action) {
		case "resize":
			clamp = mcWindows.clampBoxSize(
				this.left, this.top,
				mcWindows.mouseDownWidth + (e.screenX - mcWindows.mouseDownScreenX),
				mcWindows.mouseDownHeight + (e.screenY - mcWindows.mouseDownScreenY),
				this.features.minWidth, this.features.minHeight
			);

			this.resizeTo(clamp[2], clamp[3]);

			mcWindows.cancelEvent(e);
			break;

		case "move":
			this.left = mcWindows.mouseDownLayerX + (e.screenX - mcWindows.mouseDownScreenX);
			this.top = mcWindows.mouseDownLayerY + (e.screenY - mcWindows.mouseDownScreenY);
			this.updateClamping();

			mcWindows.cancelEvent(e);
			break;
	}
};

TinyMCE_Window.prototype.moveTo = function (x, y) {
	this.left = x;
	this.top = y;

	this.winElement.style.left = this.left + "px";
	this.winElement.style.top = this.top + "px";
};

TinyMCE_Window.prototype.resizeTo = function (width, height) {
	this.wrapperIFrameElement.style.width = (width+2) + 'px';
	this.wrapperIFrameElement.style.height = (height+2) + 'px';
	this.wrapperIFrameElement.width = width+2;
	this.wrapperIFrameElement.height = height+2;
	this.winElement.style.width = width + 'px';
	this.winElement.style.height = height + 'px';

	height = height - this.deltaHeight;

	this.containerElement.style.width = width + 'px';
	this.iframeElement.style.width = width + 'px';
	this.iframeElement.style.height = height + 'px';
	this.bodyElement.style.width = width + 'px';
	this.bodyElement.style.height = height + 'px';
	this.headElement.style.width = width + 'px';
	//this.statusElement.style.width = width + 'px';
};

TinyMCE_Window.prototype.updateClamping = function () {
	var clamp, oversize;

	clamp = mcWindows.clampBoxPosition(
		this.left, this.top,
		this.winElement.scrollWidth,
		this.winElement.scrollHeight,
		this.features.minWidth, this.features.minHeight
	);
	oversize = (
		clamp[2] != this.winElement.scrollWidth ||
		clamp[3] != this.winElement.scrollHeight
	) ? true : false;

	this.moveTo(clamp[0], clamp[1]);
	if (this.features.resizable == "yes" && oversize)
		this.resizeTo(clamp[2], clamp[3]);
};

function debug(msg) {
	document.getElementById('debug').value += msg + "\n";
}

TinyMCE_Window.prototype.onMouseUp = function(e) {
	mcWindows.action = "none";
};

TinyMCE_Window.prototype.onFocus = function(e) {
	// Gecko only handler
	var winRef = e.currentTarget;

	for (var n in mcWindows.windows) {
		var win = mcWindows.windows[n];
		if (typeof(win) == 'function')
			continue;

		if (winRef.name == win.id + "_iframe") {
			win.focus();
			return;
		}
	}
};

TinyMCE_Window.prototype.onMouseDown = function(e) {
	var elm = mcWindows.isMSIE ? this.wrapperFrame.event.srcElement : e.target;

	mcWindows.mouseDownScreenX = e.screenX;
	mcWindows.mouseDownScreenY = e.screenY;
	mcWindows.mouseDownLayerX = this.left;
	mcWindows.mouseDownLayerY = this.top;
	mcWindows.mouseDownWidth = parseInt(this.winElement.style.width);
	mcWindows.mouseDownHeight = parseInt(this.winElement.style.height);

	if (this.resizeElement != null && elm == this.resizeElement.firstChild)
		this.startResize(e);
	else
		this.startMove(e);

	mcWindows.cancelEvent(e);
};

// Global instance
var mcWindows = new TinyMCE_Windows();

// Initialize windows
mcWindows.init({
	images_path : tinyMCE.baseURL + "/plugins/inlinepopups/images",
	css_file : tinyMCE.baseURL + "/plugins/inlinepopups/css/inlinepopup.css"
});
/**
 * $Id: editor_plugin_src.js 201 2007-02-12 15:56:56Z spocke $
 *
 * @author Moxiecode
 * @copyright Copyright © 2004-2007, Moxiecode Systems AB, All rights reserved.
 */

/* Import plugin specific language pack */
tinyMCE.importPluginLanguagePack('autosave');

var TinyMCE_AutoSavePlugin = {
	getInfo : function() {
		return {
			longname : 'Auto save',
			author : 'Moxiecode Systems AB',
			authorurl : 'http://tinymce.moxiecode.com',
			infourl : 'http://wiki.moxiecode.com/index.php/TinyMCE:Plugins/autosave',
			version : tinyMCE.majorVersion + "." + tinyMCE.minorVersion
		};
	},

	// Private plugin internal methods

	_beforeUnloadHandler : function() {
		var n, inst, anyDirty = false, msg = tinyMCE.getLang("lang_autosave_unload_msg");

		if (tinyMCE.getParam("fullscreen_is_enabled"))
			return;

		for (n in tinyMCE.instances) {
			inst = tinyMCE.instances[n];

			if (!tinyMCE.isInstance(inst))
				continue;

			if (inst.isDirty())
				return msg;
		}

		return;
	}
};

window.onbeforeunload = TinyMCE_AutoSavePlugin._beforeUnloadHandler;

tinyMCE.addPlugin("autosave", TinyMCE_AutoSavePlugin);
// EN lang variables

tinyMCE.addToLang('',{
autosave_unload_msg : 'The changes you made will be lost if you navigate away from this page.'
});
/**
 * $Id: editor_plugin_src.js 289 2007-05-28 09:12:16Z spocke $
 *
 * @author Moxiecode
 * @copyright Copyright © 2004-2006, Moxiecode Systems AB, All rights reserved.
 */

tinyMCE.importPluginLanguagePack('spellchecker', 'en,fr,sv,nn,nb');

// Plucin static class
var TinyMCE_SpellCheckerPlugin = {
	_contextMenu : new TinyMCE_Menu(),
	_menu : new TinyMCE_Menu(),
	_counter : 0,
	_ajaxPage : '/tinyspell.php',

	getInfo : function() {
		return {
			longname : 'Spellchecker PHP',
			author : 'Moxiecode Systems AB',
			authorurl : 'http://tinymce.moxiecode.com',
			infourl : 'http://wiki.moxiecode.com/index.php/TinyMCE:Plugins/spellchecker',
			version : "1.0.5"
		};
	},

	handleEvent : function(e) {
		var elm = tinyMCE.isMSIE ? e.srcElement : e.target;
		var inst = tinyMCE.selectedInstance, args = '';
		var self = TinyMCE_SpellCheckerPlugin;
		var cm = self._contextMenu;
		var p, p2, x, y, sx, sy, h, elm;

		// Handle click on word
		if ((e.type == "click" || e.type == "contextmenu") && elm) {
			do {
				if (tinyMCE.getAttrib(elm, 'class') == "mceItemHiddenSpellWord") {
					inst.spellCheckerElm = elm;

					// Setup arguments
					args += 'id=' + inst.editorId + "|" + (++self._counter);
					args += '&cmd=suggest&check=' + encodeURIComponent(elm.innerHTML);
					args += '&lang=' + escape(inst.spellCheckerLang);

					elm = inst.spellCheckerElm;
					p = tinyMCE.getAbsPosition(inst.iframeElement);
					p2 = tinyMCE.getAbsPosition(elm);
					h = parseInt(elm.offsetHeight);
					sx = inst.getBody().scrollLeft;
					sy = inst.getBody().scrollTop;
					x = p.absLeft + p2.absLeft - sx;
					y = p.absTop + p2.absTop - sy + h;

					cm.clear();
					cm.addTitle(tinyMCE.getLang('lang_spellchecker_wait', '', true));
					cm.show();
					cm.moveTo(x, y);

					inst.selection.selectNode(elm, false, false);

					self._sendAjax(self.baseURL + self._ajaxPage, self._ajaxResponse, 'post', args);

					tinyMCE.cancelEvent(e);
					return false;
				}
			} while ((elm = elm.parentNode));
		}

		return true;
	},

	initInstance : function(inst) {
		var self = TinyMCE_SpellCheckerPlugin, m = self._menu, cm = self._contextMenu, e;

		tinyMCE.importCSS(inst.getDoc(), tinyMCE.baseURL + "/plugins/spellchecker/css/content.css");

		if (!tinyMCE.hasMenu('spellcheckercontextmenu')) {
			tinyMCE.importCSS(document, tinyMCE.baseURL + "/plugins/spellchecker/css/spellchecker.css");

			cm.init({drop_menu : false});
			tinyMCE.addMenu('spellcheckercontextmenu', cm);
		}

		if (!tinyMCE.hasMenu('spellcheckermenu')) {
			m.init({});
			tinyMCE.addMenu('spellcheckermenu', m);
		}

        inst.spellCheckerLang = 'en';
		self._buildSettingsMenu(inst, null);

		e = self._getBlockBoxLayer(inst).create('div', 'mceBlockBox', document.getElementById(inst.editorId + '_parent'));
		self._getMsgBoxLayer(inst).create('div', 'mceMsgBox', document.getElementById(inst.editorId + '_parent'));
	},

	_getMsgBoxLayer : function(inst) {
		if (!inst.spellCheckerMsgBoxL)
			inst.spellCheckerMsgBoxL = new TinyMCE_Layer(inst.editorId + '_spellcheckerMsgBox', false);

		return inst.spellCheckerMsgBoxL;
	},

	_getBlockBoxLayer : function(inst) {
		if (!inst.spellCheckerBoxL)
			inst.spellCheckerBoxL = new TinyMCE_Layer(inst.editorId + '_spellcheckerBlockBox', false);

		return inst.spellCheckerBoxL;
	},

	_buildSettingsMenu : function(inst, lang) {
		var i, ar = tinyMCE.getParam('spellchecker_languages', '+English=en').split(','), p;
		var self = TinyMCE_SpellCheckerPlugin, m = self._menu, c;

		m.clear();
		m.addTitle(tinyMCE.getLang('lang_spellchecker_langs', '', true));

		for (i=0; i<ar.length; i++) {
			if (ar[i] != '') {
				p = ar[i].split('=');
				c = 'mceMenuCheckItem';

				if (p[0].charAt(0) == '+') {
					p[0] = p[0].substring(1);

					if (lang == null) {
						c = 'mceMenuSelectedItem';
						inst.spellCheckerLang = p[1];
					}
				}

				if (lang == p[1])
					c = 'mceMenuSelectedItem';

				m.add({text : p[0], js : "tinyMCE.execInstanceCommand('" + inst.editorId + "','mceSpellCheckerSetLang',false,'" + p[1] + "');", class_name : c});
			}
		}
	},

	setupContent : function(editor_id, body, doc) {
		TinyMCE_SpellCheckerPlugin._removeWords(doc, null, true);
	},

	getControlHTML : function(cn) {
		switch (cn) {
			case "spellchecker":
				return TinyMCE_SpellCheckerPlugin._getMenuButtonHTML(cn, 'lang_spellchecker_desc', '{$pluginurl}/images/spellchecker.gif', 'lang_spellchecker_desc', 'mceSpellCheckerMenu', 'mceSpellCheck');
		}

		return "";
	},

	/**
	 * Returns the HTML code for a normal button control.
	 *
	 * @param {string} id Button control id, this will be the suffix for the element id, the prefix is the editor id.
	 * @param {string} lang Language variable key name to insert as the title/alt of the button image.
	 * @param {string} img Image URL to insert, {$themeurl} and {$pluginurl} will be replaced.
	 * @param {string} mlang Language variable key name to insert as the title/alt of the menu button image.
	 * @param {string} mid Menu by id to display when the menu button is pressed.
	 * @param {string} cmd Command to execute when the user clicks the button.
	 * @param {string} ui Optional user interface boolean for command.
	 * @param {string} val Optional value for command.
	 * @return HTML code for a normal button based in input information.
	 * @type string
	 */
	_getMenuButtonHTML : function(id, lang, img, mlang, mid, cmd, ui, val) {
		var h = '', m, x;

		cmd = 'tinyMCE.hideMenus();tinyMCE.execInstanceCommand(\'{$editor_id}\',\'' + cmd + '\'';

		if (typeof(ui) != "undefined" && ui != null)
			cmd += ',' + ui;

		if (typeof(val) != "undefined" && val != null)
			cmd += ",'" + val + "'";

		cmd += ');';

		// Use tilemaps when enabled and found and never in MSIE since it loads the tile each time from cache if cahce is disabled
		if (tinyMCE.getParam('button_tile_map') && (!tinyMCE.isMSIE || tinyMCE.isOpera) && (m = tinyMCE.buttonMap[id]) != null && (tinyMCE.getParam("language") == "en" || img.indexOf('$lang') == -1)) {
			// Tiled button
			x = 0 - (m * 20) == 0 ? '0' : 0 - (m * 20);
			h += '<a id="{$editor_id}_' + id + '" href="javascript:' + cmd + '" onclick="' + cmd + 'return false;" onmousedown="return false;" class="mceTiledButton mceButtonNormal" target="_self">';
			h += '<img src="{$themeurl}/images/spacer.gif" style="background-position: ' + x + 'px 0" title="{$' + lang + '}" />';
			h += '<img src="{$themeurl}/images/button_menu.gif" title="{$' + lang + '}" class="mceMenuButton" onclick="' + mcmd + 'return false;" />';
			h += '</a>';
		} else {
			if (tinyMCE.isMSIE && !tinyMCE.isOpera)
				h += '<span id="{$editor_id}_' + id + '" class="mceMenuButton" onmouseover="tinyMCE.plugins.spellchecker._menuButtonEvent(\'over\',this);" onmouseout="tinyMCE.plugins.spellchecker._menuButtonEvent(\'out\',this);">';
			else
				h += '<span id="{$editor_id}_' + id + '" class="mceMenuButton">';

			h += '<a href="javascript:' + cmd + '" onclick="' + cmd + 'return false;" onmousedown="return false;" class="mceMenuButtonNormal" target="_self">';
			h += '<img src="' + img + '" title="{$' + lang + '}" /></a>';
			h += '<a href="#" onclick="tinyMCE.plugins.spellchecker._toggleMenu(\'{$editor_id}\',\'' + mid + '\');return false;" onmousedown="return false;"><img src="{$themeurl}/images/button_menu.gif" title="{$' + lang + '}" class="mceMenuButton" />';
			h += '</a></span>';
		}

		return h;
	},

	_menuButtonEvent : function(e, o) {
		var t = this;

		// Give IE some time since it's buggy!! :(
		window.setTimeout(function() {
			t._menuButtonEvent2(e, o);
		}, 1);
	},

	_menuButtonEvent2 : function(e, o) {
		if (o.className == 'mceMenuButtonFocus')
			return;

		if (e == 'over')
			o.className = o.className + ' mceMenuHover';
		else
			o.className = o.className.replace(/\s.*$/, '');
	},

	_toggleMenu : function(editor_id, id) {
		var self = TinyMCE_SpellCheckerPlugin;
		var e = document.getElementById(editor_id + '_spellchecker');
		var inst = tinyMCE.getInstanceById(editor_id);

		if (self._menu.isVisible()) {
			tinyMCE.hideMenus();
			return;
		}

		tinyMCE.lastMenuBtnClass = e.className.replace(/\s.*$/, '');
		tinyMCE.switchClass(editor_id + '_spellchecker', 'mceMenuButtonFocus');

		self._menu.moveRelativeTo(e, 'bl');
		self._menu.moveBy(tinyMCE.isMSIE && !tinyMCE.isOpera ? 0 : 1, -1);

		if (tinyMCE.isOpera)
			self._menu.moveBy(0, -2);

        self._onMenuEvent(inst, self._menu, 'show');

		self._menu.show();

		tinyMCE.lastSelectedMenuBtn = editor_id + '_spellchecker';
	},

	_onMenuEvent : function(inst, m, n) {
		TinyMCE_SpellCheckerPlugin._buildSettingsMenu(inst, inst.spellCheckerLang);
	},

	execCommand : function(editor_id, element, command, user_interface, value) {
		var inst = tinyMCE.getInstanceById(editor_id), self = TinyMCE_SpellCheckerPlugin, args = '', co, bb, mb, nl, i, e, mbs;

		// Handle commands
		switch (command) {
			case "mceSpellCheck":
				if (!inst.spellcheckerOn) {
					inst.spellCheckerBookmark = inst.selection.getBookmark();

					// Fix for IE bug: #1610184
					if (tinyMCE.isRealIE)
						tinyMCE.setInnerHTML(inst.getBody(), inst.getBody().innerHTML);

					// Setup arguments
					args += 'id=' + inst.editorId + "|" + (++self._counter);
					args += '&cmd=spell&check=' + encodeURIComponent(self._getWordList(inst.getBody())).replace(/\'/g, '%27');
					args += '&lang=' + escape(inst.spellCheckerLang);

					co = document.getElementById(inst.editorId + '_parent').firstChild;
					bb = self._getBlockBoxLayer(inst);
					bb.moveRelativeTo(co, 'tl');
					bb.resizeTo(co.offsetWidth, co.offsetHeight);
					bb.show();

					// Setup message box
					mb = self._getMsgBoxLayer(inst);
					e = mb.getElement();

					if (e.childNodes[0])
						e.removeChild(e.childNodes[0]);

					mbs = document.createElement("span");
					mbs.innerHTML = '<span>' + tinyMCE.getLang('lang_spellchecker_swait', '', true) + '</span>';
					e.appendChild(mbs);

					mb.show();
					mb.moveRelativeTo(co, 'cc');

					if (tinyMCE.isMSIE && !tinyMCE.isOpera) {
						nl = co.getElementsByTagName('select');
						for (i=0; i<nl.length; i++)
							nl[i].disabled = true;
					}

					inst.spellcheckerOn = true;
					tinyMCE.switchClass(editor_id + '_spellchecker', 'mceMenuButtonSelected');

					self._sendAjax(self.baseURL + self._ajaxPage, self._ajaxResponse, 'post', args);
				} else {
					self._removeWords(inst.getDoc());
					inst.spellcheckerOn = false;
					tinyMCE.switchClass(editor_id + '_spellchecker', 'mceMenuButton');
				}

				return true;

			case "mceSpellCheckReplace":
				if (inst.spellCheckerElm)
					tinyMCE.setOuterHTML(inst.spellCheckerElm, value);

				self._checkDone(inst);
				self._contextMenu.hide();
				self._menu.hide();

				return true;

			case "mceSpellCheckIgnore":
				if (inst.spellCheckerElm)
					self._removeWord(inst.spellCheckerElm);

				self._checkDone(inst);
				self._contextMenu.hide();
				self._menu.hide();
				return true;

			case "mceSpellCheckIgnoreAll":
				if (inst.spellCheckerElm)
					self._removeWords(inst.getDoc(), inst.spellCheckerElm.innerHTML);

				self._checkDone(inst);
				self._contextMenu.hide();
				self._menu.hide();
				return true;

			case "mceSpellCheckerSetLang":
				tinyMCE.hideMenus();
				inst.spellCheckerLang = value;
				self._removeWords(inst.getDoc());
				inst.spellcheckerOn = false;
				tinyMCE.switchClass(editor_id + '_spellchecker', 'mceMenuButton');
				return true;
		}

		// Pass to next handler in chain
		return false;
	},

	cleanup : function(type, content, inst) {
		switch (type) {
			case "get_from_editor_dom":
				TinyMCE_SpellCheckerPlugin._removeWords(content, null, true);
				inst.spellcheckerOn = false;
				break;
		}

		return content;
	},

	// Private plugin specific methods

	_displayUI : function(inst) {
		var self = TinyMCE_SpellCheckerPlugin;
		var bb = self._getBlockBoxLayer(inst);
		var mb = self._getMsgBoxLayer(inst);
		var nl, i;
		var co = document.getElementById(inst.editorId + '_parent').firstChild;

		if (tinyMCE.isMSIE && !tinyMCE.isOpera) {
			nl = co.getElementsByTagName('select');
			for (i=0; i<nl.length; i++)
				nl[i].disabled = false;
		}

		bb.hide();

		// Boom, crash in FF if focus isn't else were
		// el.style.display='none' on a opacity element seems to crash it
		mb.hide();
	},

	_ajaxResponse : function(xml, text) {
		var el = xml ? xml.documentElement : null;
		var inst = tinyMCE.selectedInstance, self = TinyMCE_SpellCheckerPlugin;
		var cmd = el ? el.getAttribute("cmd") : null, err, id = el ? el.getAttribute("id") : null;

		if (id)
			inst = tinyMCE.getInstanceById(id.substring(0, id.indexOf('|')));

		// Workaround for crash in Gecko
		if (tinyMCE.isGecko)
			window.focus();

		self._displayUI(inst);

		// Restore the selection again
		if (tinyMCE.isGecko) {
			inst.getWin().focus();
			inst.selection.moveToBookmark(inst.spellCheckerBookmark);
		}

		// Ignore suggestions for other ajax responses
		if (cmd == "suggest" && id != inst.editorId + "|" + self._counter)
			return;

		if (!el) {
			text = '' + text;

			if (text.length > 500)
				text = text.substring(500);

			inst.spellcheckerOn = false;
			tinyMCE.switchClass(inst.editorId + '_spellchecker', 'mceMenuButton');
			alert("Could not execute AJAX call, server didn't return valid a XML.\nResponse: " + text);
			return;
		}

		err = el.getAttribute("error");

		if (err == "true") {
			inst.spellcheckerOn = false;
			tinyMCE.switchClass(inst.editorId + '_spellchecker', 'mceMenuButton');
			alert(el.getAttribute("msg"));
			return;
		}

		switch (cmd) {
			case "spell":
				if (xml.documentElement.firstChild) {
					self._markWords(inst.getDoc(), inst.getBody(), decodeURIComponent(el.firstChild.nodeValue).split('+'));
					inst.selection.moveToBookmark(inst.spellCheckerBookmark);

					if(tinyMCE.getParam('spellchecker_report_misspellings', false))
						alert(tinyMCE.getLang('lang_spellchecker_mpell_found', '', true, {words : self._countWords(inst)}));
				} else
					alert(tinyMCE.getLang('lang_spellchecker_no_mpell', '', true));

				self._checkDone(inst);

				// Odd stuff FF removed useCSS, disable state for it
				inst.useCSS = false;

				break;

			case "suggest":
				self._buildMenu(el.firstChild ? decodeURIComponent(el.firstChild.nodeValue).split('+') : null, 10);
				self._contextMenu.show();
				break;
		}
	},

	_getWordSeparators : function() {
		var i, re = '', ch = tinyMCE.getParam('spellchecker_word_separator_chars', '\\s!"#$%&()*+,-./:;<=>?@[\]^_{|}§©«®±¶·¸»¼½¾¿×÷¤\u201d\u201c');

		for (i=0; i<ch.length; i++)
			re += '\\' + ch.charAt(i);

		return re;
	},

	_getWordList : function(n) {
		var i, x, s, nv = '', nl = tinyMCE.getNodeTree(n, [], 3), wl = [];
		var re = TinyMCE_SpellCheckerPlugin._getWordSeparators();

		for (i=0; i<nl.length; i++) {
			if (!new RegExp('/SCRIPT|STYLE/').test(nl[i].parentNode.nodeName))
				nv += nl[i].nodeValue + " ";
		}

		nv = nv.replace(new RegExp('([0-9]|[' + re + '])', 'g'), ' ');
		nv = tinyMCE.trim(nv.replace(/(\s+)/g, ' '));

		nl = nv.split(/\s+/);
		for (i=0; i<nl.length; i++) {
			s = false;
			for (x=0; x<wl.length; x++) {
				if (wl[x] == nl[i]) {
					s = true;
					break;
				}
			}

			if (!s && nl[i].length > 0)
				wl[wl.length] = nl[i];
		}

		return wl.join(' ');
	},

	_removeWords : function(doc, word, cleanup) {
		var i, c, nl = doc.getElementsByTagName("span");
		var self = TinyMCE_SpellCheckerPlugin;
		var inst = tinyMCE.selectedInstance, b = inst ? inst.selection.getBookmark() : null;

		word = typeof(word) == 'undefined' ? null : word;

		for (i=nl.length-1; i>=0; i--) {
			c = tinyMCE.getAttrib(nl[i], 'class');

			if ((c == 'mceItemHiddenSpellWord' || c == 'mceItemHidden') && (word == null || nl[i].innerHTML == word))
				self._removeWord(nl[i]);
		}

		if (b && !cleanup)
			inst.selection.moveToBookmark(b);
	},

	_checkDone : function(inst) {
		var self = TinyMCE_SpellCheckerPlugin;
		var w = self._countWords(inst);

		if (w == 0) {
			self._removeWords(inst.getDoc());
			inst.spellcheckerOn = false;
			tinyMCE.switchClass(inst.editorId + '_spellchecker', 'mceMenuButton');
		}
	},

	_countWords : function(inst) {
		var i, w = 0, nl = inst.getDoc().getElementsByTagName("span"), c;
		var self = TinyMCE_SpellCheckerPlugin;

		for (i=nl.length-1; i>=0; i--) {
			c = tinyMCE.getAttrib(nl[i], 'class');

			if (c == 'mceItemHiddenSpellWord')
				w++;
		}

		return w;
	},

	_removeWord : function(e) {
		if (e != null)
			tinyMCE.setOuterHTML(e, e.innerHTML);
	},

	_markWords : function(doc, n, wl) {
		var i, nv, nn, nl = tinyMCE.getNodeTree(n, new Array(), 3);
		var r1, r2, r3, r4, r5, w = '';
		var re = TinyMCE_SpellCheckerPlugin._getWordSeparators();

		for (i=0; i<wl.length; i++) {
			if (wl[i].length > 0)
				w += wl[i] + ((i == wl.length-1) ? '' : '|');
		}

		for (i=0; i<nl.length; i++) {
			nv = nl[i].nodeValue;

			r1 = new RegExp('([' + re + '])(' + w + ')([' + re + '])', 'g');
			r2 = new RegExp('^(' + w + ')', 'g');
			r3 = new RegExp('(' + w + ')([' + re + ']?)$', 'g');
			r4 = new RegExp('^(' + w + ')([' + re + ']?)$', 'g');
			r5 = new RegExp('(' + w + ')([' + re + '])', 'g');

			if (r1.test(nv) || r2.test(nv) || r3.test(nv) || r4.test(nv)) {
				nv = tinyMCE.xmlEncode(nv).replace('&#39;', "'");
				nv = nv.replace(r5, '<span class="mceItemHiddenSpellWord">$1</span>$2');
				nv = nv.replace(r3, '<span class="mceItemHiddenSpellWord">$1</span>$2');

				nn = doc.createElement('span');
				nn.className = "mceItemHidden";
				nn.innerHTML = nv;

				// Remove old text node
				nl[i].parentNode.replaceChild(nn, nl[i]);
			}
		}
	},

	_buildMenu : function(sg, max) {
		var i, self = TinyMCE_SpellCheckerPlugin, cm = self._contextMenu;

		cm.clear();

		if (sg != null) {
			cm.addTitle(tinyMCE.getLang('lang_spellchecker_sug', '', true));

			for (i=0; i<sg.length && i<max; i++)
				cm.addItem(sg[i], 'tinyMCE.execCommand("mceSpellCheckReplace",false,"' + sg[i] + '");');

			cm.addSeparator();
		} else
			cm.addTitle(tinyMCE.getLang('lang_spellchecker_no_sug', '', true));

		cm.addItem(tinyMCE.getLang('lang_spellchecker_ignore_word', '', true), 'tinyMCE.execCommand(\'mceSpellCheckIgnore\');');
		cm.addItem(tinyMCE.getLang('lang_spellchecker_ignore_words', '', true), 'tinyMCE.execCommand(\'mceSpellCheckIgnoreAll\');');

		cm.update();
	},

	_getAjaxHTTP : function() {
		try {
			return new ActiveXObject('Msxml2.XMLHTTP')
		} catch (e) {
			try {
				return new ActiveXObject('Microsoft.XMLHTTP')
			} catch (e) {
				return new XMLHttpRequest();
			}
		}
	},

	/**
	 * Perform AJAX call.
	 *
	 * @param {string} u URL of AJAX service.
	 * @param {function} f Function to call when response arrives.
	 * @param {string} m Request method post or get.
	 * @param {Array} a Array with arguments to send.
	 */
	_sendAjax : function(u, f, m, a) {
		var x = TinyMCE_SpellCheckerPlugin._getAjaxHTTP();

		x.open(m, u, true);

		x.onreadystatechange = function() {
			if (x.readyState == 4)
				f(x.responseXML, x.responseText);
		};

		if (m == 'post')
			x.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

		x.send(a);
	}
};

// Register plugin
tinyMCE.addPlugin('spellchecker', TinyMCE_SpellCheckerPlugin);
// UK lang variables

tinyMCE.addToLang('spellchecker',{
	desc : 'Toggle spellchecker',
	menu : 'Spellchecker settings',
	ignore_word : 'Ignore word',
	ignore_words : 'Ignore all',
	langs : 'Languages',
	wait : 'Please wait...',
	swait : 'Spellchecking, please wait...',
	sug : 'Suggestions',
	no_sug : 'No suggestions',
	no_mpell : 'No misspellings found.',
	mpell_found : 'Found {$words} misspellings.'
});
/**
 * $Id: editor_plugin_src.js 201 2007-02-12 15:56:56Z spocke $
 *
 * @author Moxiecode
 * @copyright Copyright © 2004-2007, Moxiecode Systems AB, All rights reserved.
 */

/* Import plugin specific language pack */ 
tinyMCE.importPluginLanguagePack('paste');

var TinyMCE_PastePlugin = {
	getInfo : function() {
		return {
			longname : 'Paste text/word',
			author : 'Moxiecode Systems AB',
			authorurl : 'http://tinymce.moxiecode.com',
			infourl : 'http://wiki.moxiecode.com/index.php/TinyMCE:Plugins/paste',
			version : tinyMCE.majorVersion + "." + tinyMCE.minorVersion
		};
	},

	initInstance : function(inst) {
		if (tinyMCE.isMSIE && tinyMCE.getParam("paste_auto_cleanup_on_paste", false))
			tinyMCE.addEvent(inst.getBody(), "paste", TinyMCE_PastePlugin._handlePasteEvent);
	},

	handleEvent : function(e) {
		// Force paste dialog if non IE browser
		if (!tinyMCE.isRealIE && tinyMCE.getParam("paste_auto_cleanup_on_paste", false) && e.ctrlKey && e.keyCode == 86 && e.type == "keydown") {
			window.setTimeout('tinyMCE.selectedInstance.execCommand("mcePasteText",true)', 1);
			return tinyMCE.cancelEvent(e);
		}

		return true;
	},

	getControlHTML : function(cn) { 
		switch (cn) { 
			case "pastetext":
				return tinyMCE.getButtonHTML(cn, 'lang_paste_text_desc', '{$pluginurl}/images/pastetext.gif', 'mcePasteText', true);

			case "pasteword":
				return tinyMCE.getButtonHTML(cn, 'lang_paste_word_desc', '{$pluginurl}/images/pasteword.gif', 'mcePasteWord', true);

			case "selectall":
				return tinyMCE.getButtonHTML(cn, 'lang_selectall_desc', '{$pluginurl}/images/selectall.gif', 'mceSelectAll', true);
		} 

		return ''; 
	},

	execCommand : function(editor_id, element, command, user_interface, value) { 
		switch (command) { 
			case "mcePasteText": 
				if (user_interface) {
					if ((tinyMCE.isMSIE && !tinyMCE.isOpera) && !tinyMCE.getParam('paste_use_dialog', false))
						TinyMCE_PastePlugin._insertText(clipboardData.getData("Text"), true); 
					else { 
						var template = new Array(); 
						template['file']	= '../../plugins/paste/pastetext.htm'; // Relative to theme 
						template['width']  = 450; 
						template['height'] = 400; 
						var plain_text = ""; 
						tinyMCE.openWindow(template, {editor_id : editor_id, plain_text: plain_text, resizable : "yes", scrollbars : "no", inline : "yes", mceDo : 'insert'}); 
					}
				} else
					TinyMCE_PastePlugin._insertText(value['html'], value['linebreaks']);

				return true;

			case "mcePasteWord": 
				if (user_interface) {
					if ((tinyMCE.isMSIE && !tinyMCE.isOpera) && !tinyMCE.getParam('paste_use_dialog', false)) {
						TinyMCE_PastePlugin._insertWordContent(TinyMCE_PastePlugin._clipboardHTML());
					} else { 
						var template = new Array(); 
						template['file']	= '../../plugins/paste/pasteword.htm'; // Relative to theme 
						template['width']  = 450; 
						template['height'] = 400; 
						var plain_text = ""; 
						tinyMCE.openWindow(template, {editor_id : editor_id, plain_text: plain_text, resizable : "yes", scrollbars : "no", inline : "yes", mceDo : 'insert'});
					}
				} else
					TinyMCE_PastePlugin._insertWordContent(value);

				return true;

			case "mceSelectAll":
				tinyMCE.execInstanceCommand(editor_id, 'selectall'); 
				return true; 

		} 

		// Pass to next handler in chain 
		return false; 
	},

	// Private plugin internal methods

	_handlePasteEvent : function(e) {
		switch (e.type) {
			case "paste":
				var html = TinyMCE_PastePlugin._clipboardHTML();
				var r, inst = tinyMCE.selectedInstance;

				// Removes italic, strong etc, the if was needed due to bug #1437114
				if (inst && (r = inst.getRng()) && r.text.length > 0)
					tinyMCE.execCommand('delete');

				if (html && html.length > 0)
					tinyMCE.execCommand('mcePasteWord', false, html);

				tinyMCE.cancelEvent(e);
				return false;
		}

		return true;
	},

	_insertText : function(content, bLinebreaks) { 
		if (content && content.length > 0) {
			if (bLinebreaks) { 
				// Special paragraph treatment 
				if (tinyMCE.getParam("paste_create_paragraphs", true)) {
					var rl = tinyMCE.getParam("paste_replace_list", '\u2122,<sup>TM</sup>,\u2026,...,\u201c|\u201d,",\u2019,\',\u2013|\u2014|\u2015|\u2212,-').split(',');
					for (var i=0; i<rl.length; i+=2)
						content = content.replace(new RegExp(rl[i], 'gi'), rl[i+1]);

					content = tinyMCE.regexpReplace(content, "\r\n\r\n", "</p><p>", "gi"); 
					content = tinyMCE.regexpReplace(content, "\r\r", "</p><p>", "gi"); 
					content = tinyMCE.regexpReplace(content, "\n\n", "</p><p>", "gi"); 

					// Has paragraphs 
					if ((pos = content.indexOf('</p><p>')) != -1) { 
						tinyMCE.execCommand("Delete"); 

						var node = tinyMCE.selectedInstance.getFocusElement(); 

						// Get list of elements to break 
						var breakElms = new Array(); 

						do { 
							if (node.nodeType == 1) { 
								// Don't break tables and break at body 
								if (node.nodeName == "TD" || node.nodeName == "BODY") 
									break; 
		
								breakElms[breakElms.length] = node; 
							} 
						} while(node = node.parentNode); 

						var before = "", after = "</p>"; 
						before += content.substring(0, pos); 

						for (var i=0; i<breakElms.length; i++) { 
							before += "</" + breakElms[i].nodeName + ">"; 
							after += "<" + breakElms[(breakElms.length-1)-i].nodeName + ">"; 
						} 

						before += "<p>"; 
						content = before + content.substring(pos+7) + after; 
					} 
				} 

				if (tinyMCE.getParam("paste_create_linebreaks", true)) {
					content = tinyMCE.regexpReplace(content, "\r\n", "<br />", "gi"); 
					content = tinyMCE.regexpReplace(content, "\r", "<br />", "gi"); 
					content = tinyMCE.regexpReplace(content, "\n", "<br />", "gi"); 
				}
			} 
		
			tinyMCE.execCommand("mceInsertRawHTML", false, content); 
		}
	},

	_insertWordContent : function(content) { 
		if (content && content.length > 0) {
			// Cleanup Word content
			var bull = String.fromCharCode(8226);
			var middot = String.fromCharCode(183);
			var cb;

			if ((cb = tinyMCE.getParam("paste_insert_word_content_callback", "")) != "")
				content = eval(cb + "('before', content)");

			var rl = tinyMCE.getParam("paste_replace_list", '\u2122,<sup>TM</sup>,\u2026,...,\u201c|\u201d,",\u2019,\',\u2013|\u2014|\u2015|\u2212,-').split(',');
			for (var i=0; i<rl.length; i+=2)
				content = content.replace(new RegExp(rl[i], 'gi'), rl[i+1]);

			if (tinyMCE.getParam("paste_convert_headers_to_strong", false)) {
				content = content.replace(new RegExp('<p class=MsoHeading.*?>(.*?)<\/p>', 'gi'), '<p><b>$1</b></p>');
			}

			content = content.replace(new RegExp('tab-stops: list [0-9]+.0pt">', 'gi'), '">' + "--list--");
			content = content.replace(new RegExp(bull + "(.*?)<BR>", "gi"), "<p>" + middot + "$1</p>");
			content = content.replace(new RegExp('<SPAN style="mso-list: Ignore">', 'gi'), "<span>" + bull); // Covert to bull list
			content = content.replace(/<o:p><\/o:p>/gi, "");
			content = content.replace(new RegExp('<br style="page-break-before: always;.*>', 'gi'), '-- page break --'); // Replace pagebreaks
			content = content.replace(new RegExp('<(!--)([^>]*)(--)>', 'g'), "");  // Word comments

			if (tinyMCE.getParam("paste_remove_spans", true))
				content = content.replace(/<\/?span[^>]*>/gi, "");

			if (tinyMCE.getParam("paste_remove_styles", true))
				content = content.replace(new RegExp('<(\\w[^>]*) style="([^"]*)"([^>]*)', 'gi'), "<$1$3");

			content = content.replace(/<\/?font[^>]*>/gi, "");

			// Strips class attributes.
			switch (tinyMCE.getParam("paste_strip_class_attributes", "all")) {
				case "all":
					content = content.replace(/<(\w[^>]*) class=([^ |>]*)([^>]*)/gi, "<$1$3");
					break;

				case "mso":
					content = content.replace(new RegExp('<(\\w[^>]*) class="?mso([^ |>]*)([^>]*)', 'gi'), "<$1$3");
					break;
			}

			content = content.replace(new RegExp('href="?' + TinyMCE_PastePlugin._reEscape("" + document.location) + '', 'gi'), 'href="' + tinyMCE.settings['document_base_url']);
			content = content.replace(/<(\w[^>]*) lang=([^ |>]*)([^>]*)/gi, "<$1$3");
			content = content.replace(/<\\?\?xml[^>]*>/gi, "");
			content = content.replace(/<\/?\w+:[^>]*>/gi, "");
			content = content.replace(/-- page break --\s*<p>&nbsp;<\/p>/gi, ""); // Remove pagebreaks
			content = content.replace(/-- page break --/gi, ""); // Remove pagebreaks

	//		content = content.replace(/\/?&nbsp;*/gi, ""); &nbsp;
	//		content = content.replace(/<p>&nbsp;<\/p>/gi, '');

			if (!tinyMCE.settings['force_p_newlines']) {
				content = content.replace('', '' ,'gi');
				content = content.replace('</p>', '<br /><br />' ,'gi');
			}

			if (!tinyMCE.isMSIE && !tinyMCE.settings['force_p_newlines']) {
				content = content.replace(/<\/?p[^>]*>/gi, "");
			}

			content = content.replace(/<\/?div[^>]*>/gi, "");

			// Convert all middlot lists to UL lists
			if (tinyMCE.getParam("paste_convert_middot_lists", true)) {
				var div = document.createElement("div");
				div.innerHTML = content;

				// Convert all middot paragraphs to li elements
				var className = tinyMCE.getParam("paste_unindented_list_class", "unIndentedList");

				while (TinyMCE_PastePlugin._convertMiddots(div, "--list--")) ; // bull
				while (TinyMCE_PastePlugin._convertMiddots(div, middot, className)) ; // Middot
				while (TinyMCE_PastePlugin._convertMiddots(div, bull)) ; // bull

				content = div.innerHTML;
			}

			// Replace all headers with strong and fix some other issues
			if (tinyMCE.getParam("paste_convert_headers_to_strong", false)) {
				content = content.replace(/<h[1-6]>&nbsp;<\/h[1-6]>/gi, '<p>&nbsp;&nbsp;</p>');
				content = content.replace(/<h[1-6]>/gi, '<p><b>');
				content = content.replace(/<\/h[1-6]>/gi, '</b></p>');
				content = content.replace(/<b>&nbsp;<\/b>/gi, '<b>&nbsp;&nbsp;</b>');
				content = content.replace(/^(&nbsp;)*/gi, '');
			}

			content = content.replace(/--list--/gi, ""); // Remove --list--

			if ((cb = tinyMCE.getParam("paste_insert_word_content_callback", "")) != "")
				content = eval(cb + "('after', content)");

			// Insert cleaned content
			tinyMCE.execCommand("mceInsertContent", false, content);

			if (tinyMCE.getParam('paste_force_cleanup_wordpaste', true))
				window.setTimeout('tinyMCE.execCommand("mceCleanup");', 1); // Do normal cleanup detached from this thread
		}
	},

	_reEscape : function(s) {
		var l = "?.\\*[](){}+^$:";
		var o = "";

		for (var i=0; i<s.length; i++) {
			var c = s.charAt(i);

			if (l.indexOf(c) != -1)
				o += '\\' + c;
			else
				o += c;
		}

		return o;
	},

	_convertMiddots : function(div, search, class_name) {
		var mdot = String.fromCharCode(183);
		var bull = String.fromCharCode(8226);

		var nodes = div.getElementsByTagName("p");
		var prevul;
		for (var i=0; i<nodes.length; i++) {
			var p = nodes[i];

			// Is middot
			if (p.innerHTML.indexOf(search) == 0) {
				var ul = document.createElement("ul");

				if (class_name)
					ul.className = class_name;

				// Add the first one
				var li = document.createElement("li");
				li.innerHTML = p.innerHTML.replace(new RegExp('' + mdot + '|' + bull + '|--list--|&nbsp;', "gi"), '');
				ul.appendChild(li);

				// Add the rest
				var np = p.nextSibling;
				while (np) {
			        // If the node is whitespace, then
			        // ignore it and continue on.
			        if (np.nodeType == 3 && new RegExp('^\\s$', 'm').test(np.nodeValue)) {
			                np = np.nextSibling;
			                continue;
			        }

					if (search == mdot) {
					        if (np.nodeType == 1 && new RegExp('^o(\\s+|&nbsp;)').test(np.innerHTML)) {
					                // Second level of nesting
					                if (!prevul) {
					                        prevul = ul;
					                        ul = document.createElement("ul");
					                        prevul.appendChild(ul);
					                }
					                np.innerHTML = np.innerHTML.replace(/^o/, '');
					        } else {
					                // Pop the stack if we're going back up to the first level
					                if (prevul) {
					                        ul = prevul;
					                        prevul = null;
					                }
					                // Not element or middot paragraph
					                if (np.nodeType != 1 || np.innerHTML.indexOf(search) != 0)
					                        break;
					        }
					} else {
					        // Not element or middot paragraph
					        if (np.nodeType != 1 || np.innerHTML.indexOf(search) != 0)
					                break;
				        }

					var cp = np.nextSibling;
					var li = document.createElement("li");
					li.innerHTML = np.innerHTML.replace(new RegExp('' + mdot + '|' + bull + '|--list--|&nbsp;', "gi"), '');
					np.parentNode.removeChild(np);
					ul.appendChild(li);
					np = cp;
				}

				p.parentNode.replaceChild(ul, p);

				return true;
			}
		}

		return false;
	},

	_clipboardHTML : function() {
		var div = document.getElementById('_TinyMCE_clipboardHTML');

		if (!div) {
			var div = document.createElement('DIV');
			div.id = '_TinyMCE_clipboardHTML';

			with (div.style) {
				visibility = 'hidden';
				overflow = 'hidden';
				position = 'absolute';
				width = 1;
				height = 1;
			}

			document.body.appendChild(div);
		}

		div.innerHTML = '';
		var rng = document.body.createTextRange();
		rng.moveToElementText(div);
		rng.execCommand('Paste');
		var html = div.innerHTML;
		div.innerHTML = '';
		return html;
	}
};

tinyMCE.addPlugin("paste", TinyMCE_PastePlugin);
// UK lang variables

tinyMCE.addToLang('',{
paste_text_desc : 'Paste as Plain Text',
paste_text_title : 'Use CTRL+V on your keyboard to paste the text into the window.',
paste_text_linebreaks : 'Keep linebreaks',
paste_word_desc : 'Paste from Word',
paste_word_title : 'Use CTRL+V on your keyboard to paste the text into the window.',
selectall_desc : 'Select All'
});
/* Import plugin specific language pack */
tinyMCE.importPluginLanguagePack('wordpress', 'en');

var TinyMCE_wordpressPlugin = {
	getInfo : function() {
		return {
			longname : 'WordPress Plugin',
			author : 'WordPress',
			authorurl : 'http://wordpress.org',
			infourl : 'http://wordpress.org',
			version : '1'
		};
	},

	getControlHTML : function(control_name) {
		switch (control_name) {
			case "wp_more":
				return tinyMCE.getButtonHTML(control_name, 'lang_wordpress_more_button', '{$pluginurl}/images/more.gif', 'wpMore');
			case "wp_page":
				return tinyMCE.getButtonHTML(control_name, 'lang_wordpress_page_button', '{$pluginurl}/images/page.gif', 'wpPage');
			case "wp_help":
				var buttons = tinyMCE.getButtonHTML(control_name, 'lang_help_button_title', '{$pluginurl}/images/help.gif', 'wpHelp');
				var hiddenControls = '<div class="zerosize">'
				+ '<input type="button" accesskey="n" onclick="tinyMCE.execInstanceCommand(\'{$editor_id}\',\'mceSpellCheck\',false);" />'
				+ '<input type="button" accesskey="k" onclick="tinyMCE.execInstanceCommand(\'{$editor_id}\',\'Strikethrough\',false);" />'
				+ '<input type="button" accesskey="l" onclick="tinyMCE.execInstanceCommand(\'{$editor_id}\',\'InsertUnorderedList\',false);" />'
				+ '<input type="button" accesskey="o" onclick="tinyMCE.execInstanceCommand(\'{$editor_id}\',\'InsertOrderedList\',false);" />'
				+ '<input type="button" accesskey="w" onclick="tinyMCE.execInstanceCommand(\'{$editor_id}\',\'Outdent\',false);" />'
				+ '<input type="button" accesskey="q" onclick="tinyMCE.execInstanceCommand(\'{$editor_id}\',\'Indent\',false);" />'
				+ '<input type="button" accesskey="f" onclick="tinyMCE.execInstanceCommand(\'{$editor_id}\',\'JustifyLeft\',false);" />'
				+ '<input type="button" accesskey="c" onclick="tinyMCE.execInstanceCommand(\'{$editor_id}\',\'JustifyCenter\',false);" />'
				+ '<input type="button" accesskey="r" onclick="tinyMCE.execInstanceCommand(\'{$editor_id}\',\'JustifyRight\',false);" />'
				+ '<input type="button" accesskey="j" onclick="tinyMCE.execInstanceCommand(\'{$editor_id}\',\'JustifyFull\',false);" />'
				+ '<input type="button" accesskey="a" onclick="tinyMCE.execInstanceCommand(\'{$editor_id}\',\'mceLink\',true);" />'
				+ '<input type="button" accesskey="s" onclick="tinyMCE.execInstanceCommand(\'{$editor_id}\',\'unlink\',false);" />'
				+ '<input type="button" accesskey="m" onclick="tinyMCE.execInstanceCommand(\'{$editor_id}\',\'mceImage\',true);" />'
				+ '<input type="button" accesskey="t" onclick="tinyMCE.execInstanceCommand(\'{$editor_id}\',\'wpMore\');" />'
				+ '<input type="button" accesskey="g" onclick="tinyMCE.execInstanceCommand(\'{$editor_id}\',\'wpPage\');" />'
				+ '<input type="button" accesskey="u" onclick="tinyMCE.execInstanceCommand(\'{$editor_id}\',\'Undo\',false);" />'
				+ '<input type="button" accesskey="y" onclick="tinyMCE.execInstanceCommand(\'{$editor_id}\',\'Redo\',false);" />'
				+ '<input type="button" accesskey="h" onclick="tinyMCE.execInstanceCommand(\'{$editor_id}\',\'wpHelp\',false);" />'
				+ '<input type="button" accesskey="b" onclick="tinyMCE.execInstanceCommand(\'{$editor_id}\',\'Bold\',false);" />'
				+ '<input type="button" accesskey="v" onclick="tinyMCE.execInstanceCommand(\'{$editor_id}\',\'wpAdv\',false);" />'
				+ '</div>';
				return buttons+hiddenControls;
			case "wp_adv":
				return tinyMCE.getButtonHTML(control_name, 'lang_wordpress_adv_button', '{$pluginurl}/images/toolbars.gif', 'wpAdv');
			case "wp_adv_start":
				return '<div id="wpadvbar" style="display:none;"><br />';
			case "wp_adv_end":
				return '</div>';
		}
		return '';
	},

	execCommand : function(editor_id, element, command, user_interface, value) {
		var inst = tinyMCE.getInstanceById(editor_id);
		var focusElm = inst.getFocusElement();
		var doc = inst.getDoc();

		function getAttrib(elm, name) {
			return elm.getAttribute(name) ? elm.getAttribute(name) : "";
		}

		// Handle commands
		switch (command) {
			case "wpMore":
				var flag = "";
				var template = new Array();
				var altMore = tinyMCE.getLang('lang_wordpress_more_alt');

				// Is selection a image
				if (focusElm != null && focusElm.nodeName.toLowerCase() == "img") {
					flag = getAttrib(focusElm, 'class');

					if (flag != 'mce_plugin_wordpress_more') // Not a wordpress
						return true;

					action = "update";
				}

				html = ''
					+ '<img src="' + (tinyMCE.getParam("theme_href") + "/images/spacer.gif") + '" '
					+ ' width="100%" height="10px" '
					+ 'alt="'+altMore+'" title="'+altMore+'" class="mce_plugin_wordpress_more" name="mce_plugin_wordpress_more" />';
				tinyMCE.execInstanceCommand(editor_id, 'mceInsertContent', false, html);
				tinyMCE.selectedInstance.repaint();
				return true;

			case "wpPage":
				var flag = "";
				var template = new Array();
				var altPage = tinyMCE.getLang('lang_wordpress_more_alt');

				// Is selection a image
				if (focusElm != null && focusElm.nodeName.toLowerCase() == "img") {
					flag = getAttrib(focusElm, 'name');

					if (flag != 'mce_plugin_wordpress_page') // Not a wordpress
						return true;

					action = "update";
				}

				html = ''
					+ '<img src="' + (tinyMCE.getParam("theme_href") + "/images/spacer.gif") + '" '
					+ ' width="100%" height="10px" '
					+ 'alt="'+altPage+'" title="'+altPage+'" class="mce_plugin_wordpress_page" name="mce_plugin_wordpress_page" />';
				tinyMCE.execCommand("mceInsertContent",true,html);
				tinyMCE.selectedInstance.repaint();
				return true;

			case "wpHelp":
				var template = new Array();

				template['file']   = tinyMCE.baseURL + '/wp-mce-help.php';
				template['width']  = 480;
				template['height'] = 380;

				args = {
					resizable : 'yes',
					scrollbars : 'yes'
				};

				tinyMCE.openWindow(template, args);
				return true;
			case "wpAdv":
				var adv = document.getElementById('wpadvbar');
				if ( adv.style.display == 'none' ) {
					adv.style.display = 'block';
					tinyMCE.switchClass(editor_id + '_wp_adv', 'mceButtonSelected');
				} else {
					adv.style.display = 'none';
					tinyMCE.switchClass(editor_id + '_wp_adv', 'mceButtonNormal');
				}
				return true;
		}

		// Pass to next handler in chain
		return false;
	},

	cleanup : function(type, content) {
		switch (type) {

			case "insert_to_editor":
				var startPos = 0;
				var altMore = tinyMCE.getLang('lang_wordpress_more_alt');
				var altPage = tinyMCE.getLang('lang_wordpress_page_alt');

				// Parse all <!--more--> tags and replace them with images
				while ((startPos = content.indexOf('<!--more', startPos)) != -1) {
					var endPos = content.indexOf('-->', startPos) + 3;
					// Insert image
					var moreText = content.substring(startPos + 8, endPos - 3);
					var contentAfter = content.substring(endPos);
					content = content.substring(0, startPos);
					content += '<img src="' + (tinyMCE.getParam("theme_href") + "/images/spacer.gif") + '" ';
					content += ' width="100%" height="10px" moretext="'+moreText+'" ';
					content += 'alt="'+altMore+'" title="'+altMore+'" class="mce_plugin_wordpress_more" name="mce_plugin_wordpress_more" />';
					content += contentAfter;

					startPos++;
				}
				var startPos = 0;

				// Parse all <!--page--> tags and replace them with images
				while ((startPos = content.indexOf('<!--nextpage-->', startPos)) != -1) {
					// Insert image
					var contentAfter = content.substring(startPos + 15);
					content = content.substring(0, startPos);
					content += '<img src="' + (tinyMCE.getParam("theme_href") + "/images/spacer.gif") + '" ';
					content += ' width="100%" height="10px" ';
					content += 'alt="'+altPage+'" title="'+altPage+'" class="mce_plugin_wordpress_page" name="mce_plugin_wordpress_page" />';
					content += contentAfter;

					startPos++;
				}

				// Look for \n in <pre>, replace with <br>
				var startPos = -1;
				while ((startPos = content.indexOf('<pre', startPos+1)) != -1) {
					var endPos = content.indexOf('</pre>', startPos+1);
					var innerPos = content.indexOf('>', startPos+1);
					var chunkBefore = content.substring(0, innerPos);
					var chunkAfter = content.substring(endPos);
					
					var innards = content.substring(innerPos, endPos);
					innards = innards.replace(/\n/g, '<br />');
					content = chunkBefore + innards + chunkAfter;
				}

				break;

			case "get_from_editor":
				// Parse all img tags and replace them with <!--more-->
				var startPos = -1;
				while ((startPos = content.indexOf('<img', startPos+1)) != -1) {
					var endPos = content.indexOf('/>', startPos);
					var attribs = this._parseAttributes(content.substring(startPos + 4, endPos));

					if (attribs['class'] == "mce_plugin_wordpress_more" || attribs['name'] == "mce_plugin_wordpress_more") {
						endPos += 2;

						var moreText = attribs['moretext'] ? attribs['moretext'] : '';
						var embedHTML = '<!--more'+moreText+'-->';

						// Insert embed/object chunk
						chunkBefore = content.substring(0, startPos);
						chunkAfter = content.substring(endPos);
						content = chunkBefore + embedHTML + chunkAfter;
					}
					if (attribs['class'] == "mce_plugin_wordpress_page" || attribs['name'] == "mce_plugin_wordpress_page") {
						endPos += 2;

						var embedHTML = '<!--nextpage-->';

						// Insert embed/object chunk
						chunkBefore = content.substring(0, startPos);
						chunkAfter = content.substring(endPos);
						content = chunkBefore + embedHTML + chunkAfter;
					}
				}

				// Remove normal line breaks
				content = content.replace(/\n|\r/g, ' ');

				// Look for <br> in <pre>, replace with \n
				var startPos = -1;
				while ((startPos = content.indexOf('<pre', startPos+1)) != -1) {
					var endPos = content.indexOf('</pre>', startPos+1);
					var innerPos = content.indexOf('>', startPos+1);
					var chunkBefore = content.substring(0, innerPos);
					var chunkAfter = content.substring(endPos);
					
					var innards = content.substring(innerPos, endPos);
					innards = innards.replace(new RegExp('<br\\s?/?>', 'g'), '\n');
					innards = innards.replace(new RegExp('\\s$', ''), '');
					content = chunkBefore + innards + chunkAfter;
				}

				// Remove anonymous, empty paragraphs.
				content = content.replace(new RegExp('<p>(\\s|&nbsp;)*</p>', 'mg'), '');

				// Handle table badness.
				content = content.replace(new RegExp('<(table( [^>]*)?)>.*?<((tr|thead)( [^>]*)?)>', 'mg'), '<$1><$3>');
				content = content.replace(new RegExp('<(tr|thead|tfoot)>.*?<((td|th)( [^>]*)?)>', 'mg'), '<$1><$2>');
				content = content.replace(new RegExp('</(td|th)>.*?<(td( [^>]*)?|th( [^>]*)?|/tr|/thead|/tfoot)>', 'mg'), '</$1><$2>');
				content = content.replace(new RegExp('</tr>.*?<(tr|/table)>', 'mg'), '</tr><$1>');
				content = content.replace(new RegExp('<(/?(table|tbody|tr|th|td)[^>]*)>(\\s*|(<br ?/?>)*)*', 'g'), '<$1>');

				// Pretty it up for the source editor.
				var blocklist = 'blockquote|ul|ol|li|table|thead|tr|th|td|div|h\\d|pre|p';
				content = content.replace(new RegExp('\\s*</('+blocklist+')>\\s*', 'mg'), '</$1>\n');
				content = content.replace(new RegExp('\\s*<(('+blocklist+')[^>]*)>', 'mg'), '\n<$1>');
				content = content.replace(new RegExp('<((li|/?tr|/?thead|/?tfoot)( [^>]*)?)>', 'g'), '\t<$1>');
				content = content.replace(new RegExp('<((td|th)( [^>]*)?)>', 'g'), '\t\t<$1>');
				content = content.replace(new RegExp('\\s*<br ?/?>\\s*', 'mg'), '<br />\n');
				content = content.replace(new RegExp('^\\s*', ''), '');
				content = content.replace(new RegExp('\\s*$', ''), '');

				break;
		}

		// Pass through to next handler in chain
		return content;
	},

	handleNodeChange : function(editor_id, node, undo_index, undo_levels, visual_aid, any_selection) {

		tinyMCE.switchClass(editor_id + '_wp_more', 'mceButtonNormal');
		tinyMCE.switchClass(editor_id + '_wp_page', 'mceButtonNormal');

		if (node == null)
			return;

		do {
			if (node.nodeName.toLowerCase() == "img" && tinyMCE.getAttrib(node, 'class').indexOf('mce_plugin_wordpress_more') == 0)
				tinyMCE.switchClass(editor_id + '_wp_more', 'mceButtonSelected');
			if (node.nodeName.toLowerCase() == "img" && tinyMCE.getAttrib(node, 'class').indexOf('mce_plugin_wordpress_page') == 0)
				tinyMCE.switchClass(editor_id + '_wp_page', 'mceButtonSelected');
		} while ((node = node.parentNode));

		return true;
	},

	saveCallback : function(el, content, body) {
		// We have a TON of cleanup to do.

		// Mark </p> if it has any attributes.
		content = content.replace(new RegExp('(<p[^>]+>.*?)</p>', 'mg'), '$1</p#>');

		// Decode the ampersands of time.
		// content = content.replace(new RegExp('&amp;', 'g'), '&');

		// Get it ready for wpautop.
		content = content.replace(new RegExp('\\s*<p>', 'mgi'), '');
		content = content.replace(new RegExp('\\s*</p>\\s*', 'mgi'), '\n\n');
		content = content.replace(new RegExp('\\n\\s*\\n', 'mgi'), '\n\n');
		content = content.replace(new RegExp('\\s*<br ?/?>\\s*', 'gi'), '\n');

		// Fix some block element newline issues
		var blocklist = 'blockquote|ul|ol|li|table|thead|tr|th|td|div|h\\d|pre';
		content = content.replace(new RegExp('\\s*<(('+blocklist+') ?[^>]*)\\s*>', 'mg'), '\n<$1>');
		content = content.replace(new RegExp('\\s*</('+blocklist+')>\\s*', 'mg'), '</$1>\n');
		content = content.replace(new RegExp('<li>', 'g'), '\t<li>');

		// Unmark special paragraph closing tags
		content = content.replace(new RegExp('</p#>', 'g'), '</p>\n');
		content = content.replace(new RegExp('\\s*(<p[^>]+>.*</p>)', 'mg'), '\n$1');

		// Trim trailing whitespace
		content = content.replace(new RegExp('\\s*$', ''), '');

		// Hope.
		return content;

	},

	_parseAttributes : function(attribute_string) {
		var attributeName = "";
		var attributeValue = "";
		var withInName;
		var withInValue;
		var attributes = new Array();
		var whiteSpaceRegExp = new RegExp('^[ \n\r\t]+', 'g');
		var titleText = tinyMCE.getLang('lang_wordpress_more');
		var titleTextPage = tinyMCE.getLang('lang_wordpress_page');

		if (attribute_string == null || attribute_string.length < 2)
			return null;

		withInName = withInValue = false;

		for (var i=0; i<attribute_string.length; i++) {
			var chr = attribute_string.charAt(i);

			if ((chr == '"' || chr == "'") && !withInValue)
				withInValue = true;
			else if ((chr == '"' || chr == "'") && withInValue) {
				withInValue = false;

				var pos = attributeName.lastIndexOf(' ');
				if (pos != -1)
					attributeName = attributeName.substring(pos+1);

				attributes[attributeName.toLowerCase()] = attributeValue.substring(1);

				attributeName = "";
				attributeValue = "";
			} else if (!whiteSpaceRegExp.test(chr) && !withInName && !withInValue)
				withInName = true;

			if (chr == '=' && withInName)
				withInName = false;

			if (withInName)
				attributeName += chr;

			if (withInValue)
				attributeValue += chr;
		}

		return attributes;
	}
};

tinyMCE.addPlugin("wordpress", TinyMCE_wordpressPlugin);

/* This little hack protects our More and Page placeholders from the removeformat command */
tinyMCE.orgExecCommand = tinyMCE.execCommand;
tinyMCE.execCommand = function (command, user_interface, value) {
	re = this.orgExecCommand(command, user_interface, value);

	if ( command == 'removeformat' ) {
		var inst = tinyMCE.getInstanceById('mce_editor_0');
		doc = inst.getDoc();
		var imgs = doc.getElementsByTagName('img');
		for (i=0;img=imgs[i];i++)
			img.className = img.name;
	}
	return re;
};
wpInstTriggerSave = function (skip_cleanup, skip_callback) {
	var e, nl = new Array(), i, s;

	this.switchSettings();
	s = tinyMCE.settings;

	// Force hidden tabs visible while serializing
	if (tinyMCE.isMSIE && !tinyMCE.isOpera) {
		e = this.iframeElement;

		do {
			if (e.style && e.style.display == 'none') {
				e.style.display = 'block';
				nl[nl.length] = {elm : e, type : 'style'};
			}

			if (e.style && s.hidden_tab_class.length > 0 && e.className.indexOf(s.hidden_tab_class) != -1) {
				e.className = s.display_tab_class;
				nl[nl.length] = {elm : e, type : 'class'};
			}
		} while ((e = e.parentNode) != null)
	}

	tinyMCE.settings['preformatted'] = false;

	// Default to false
	if (typeof(skip_cleanup) == "undefined")
		skip_cleanup = false;

	// Default to false
	if (typeof(skip_callback) == "undefined")
		skip_callback = false;

//	tinyMCE._setHTML(this.getDoc(), this.getBody().innerHTML);

	// Remove visual aids when cleanup is disabled
	if (this.settings['cleanup'] == false) {
		tinyMCE.handleVisualAid(this.getBody(), true, false, this);
		tinyMCE._setEventsEnabled(this.getBody(), true);
	}

	tinyMCE._customCleanup(this, "submit_content_dom", this.contentWindow.document.body);
	tinyMCE.selectedInstance.getWin().oldfocus=tinyMCE.selectedInstance.getWin().focus;
	tinyMCE.selectedInstance.getWin().focus=function() {};
	var htm = tinyMCE._cleanupHTML(this, this.getDoc(), this.settings, this.getBody(), tinyMCE.visualAid, true, true);
	tinyMCE.selectedInstance.getWin().focus=tinyMCE.selectedInstance.getWin().oldfocus;
	htm = tinyMCE._customCleanup(this, "submit_content", htm);

	if (!skip_callback && tinyMCE.settings['save_callback'] != "")
		var content = eval(tinyMCE.settings['save_callback'] + "(this.formTargetElementId,htm,this.getBody());");

	// Use callback content if available
	if ((typeof(content) != "undefined") && content != null)
		htm = content;

	// Replace some weird entities (Bug: #1056343)
	htm = tinyMCE.regexpReplace(htm, "&#40;", "(", "gi");
	htm = tinyMCE.regexpReplace(htm, "&#41;", ")", "gi");
	htm = tinyMCE.regexpReplace(htm, "&#59;", ";", "gi");
	htm = tinyMCE.regexpReplace(htm, "&#34;", "&quot;", "gi");
	htm = tinyMCE.regexpReplace(htm, "&#94;", "^", "gi");

	if (this.formElement)
		this.formElement.value = htm;

	if (tinyMCE.isSafari && this.formElement)
		this.formElement.innerText = htm;

	// Hide them again (tabs in MSIE)
	for (i=0; i<nl.length; i++) {
		if (nl[i].type == 'style')
			nl[i].elm.style.display = 'none';
		else
			nl[i].elm.className = s.hidden_tab_class;
	}
}
tinyMCE.wpTriggerSave = function () {
	var inst, n;
	for (n in tinyMCE.instances) {
		inst = tinyMCE.instances[n];
		if (!tinyMCE.isInstance(inst))
			continue;
		inst.wpTriggerSave = wpInstTriggerSave;
		inst.wpTriggerSave(false, false);
	}
}

function switchEditors(id) {
	var inst = tinyMCE.getInstanceById(id);
	var qt = document.getElementById('quicktags');
	var H = document.getElementById('edButtonHTML');
	var P = document.getElementById('edButtonPreview');
	var ta = document.getElementById(id);
	var pdr = ta.parentNode;

	if ( inst ) {
		edToggle(H, P);

		if ( tinyMCE.isMSIE && !tinyMCE.isOpera ) {
			// IE rejects the later overflow assignment so we skip this step.
			// Alternate code might be nice. Until then, IE reflows.
		} else {
			// Lock the fieldset's height to prevent reflow/flicker
			pdr.style.height = pdr.clientHeight + 'px';
			pdr.style.overflow = 'hidden';
		}

		// Save the coords of the bottom right corner of the rich editor
		var table = document.getElementById(inst.editorId + '_parent').getElementsByTagName('table')[0];
		var y1 = table.offsetTop + table.offsetHeight;

		if ( TinyMCE_AdvancedTheme._getCookie("TinyMCE_" + inst.editorId + "_height") == null ) {
			var expires = new Date();
			expires.setTime(expires.getTime() + 3600000 * 24 * 30);
			var offset = tinyMCE.isMSIE ? 1 : 2;
			TinyMCE_AdvancedTheme._setCookie("TinyMCE_" + inst.editorId + "_height", "" + (table.offsetHeight - offset), expires);
		}

		// Unload the rich editor
		inst.triggerSave(false, false);
		htm = inst.formElement.value;
		tinyMCE.removeMCEControl(id);
		document.getElementById(id).value = htm;
		--tinyMCE.idCounter;

		// Reveal Quicktags and textarea
		qt.style.display = 'block';
		ta.style.display = 'inline';

		// Set the textarea height to match the rich editor
		y2 = ta.offsetTop + ta.offsetHeight;
		ta.style.height = (ta.clientHeight + y1 - y2) + 'px';

		// Tweak the widths
		ta.parentNode.style.paddingRight = '12px';

		if ( tinyMCE.isMSIE && !tinyMCE.isOpera ) {
		} else {
			// Unlock the fieldset's height
			pdr.style.height = 'auto';
			pdr.style.overflow = 'display';
		}
	} else {
		edToggle(P, H);
		edCloseAllTags(); // :-(

		if ( tinyMCE.isMSIE && !tinyMCE.isOpera ) {
		} else {
			// Lock the fieldset's height
			pdr.style.height = pdr.clientHeight + 'px';
			pdr.style.overflow = 'hidden';
		}

		// Hide Quicktags and textarea
		qt.style.display = 'none';
		ta.style.display = 'none';

		// Tweak the widths
		ta.parentNode.style.paddingRight = '0px';

		// Load the rich editor with formatted html
		if ( tinyMCE.isMSIE ) {
			ta.value = wpautop(ta.value);
			tinyMCE.addMCEControl(ta, id);
		} else {
			htm = wpautop(ta.value);
			tinyMCE.addMCEControl(ta, id);
			tinyMCE.getInstanceById(id).execCommand('mceSetContent', null, htm);
		}

		if ( tinyMCE.isMSIE && !tinyMCE.isOpera ) {
		} else {
			// Unlock the fieldset's height
			pdr.style.height = 'auto';
			pdr.style.overflow = 'display';
		}
	}
}

function edToggle(A, B) {
	A.className = 'edButtonFore';
	B.className = 'edButtonBack';

	B.onclick = A.onclick;
	A.onclick = null;
}

function wpautop(pee) {
	pee = pee + "\n\n";
	pee = pee.replace(new RegExp('<br />\\s*<br />', 'gi'), "\n\n");
	pee = pee.replace(new RegExp('(<(?:table|thead|tfoot|caption|colgroup|tbody|tr|td|th|div|dl|dd|dt|ul|ol|li|pre|select|form|blockquote|address|math|p|h[1-6])[^>]*>)', 'gi'), "\n$1"); 
	pee = pee.replace(new RegExp('(</(?:table|thead|tfoot|caption|colgroup|tbody|tr|td|th|div|dl|dd|dt|ul|ol|li|pre|select|form|blockquote|address|math|p|h[1-6])>)', 'gi'), "$1\n\n");
	pee = pee.replace(new RegExp("\\r\\n|\\r", 'g'), "\n");
	pee = pee.replace(new RegExp("\\n\\s*\\n+", 'g'), "\n\n");
	pee = pee.replace(new RegExp('([\\s\\S]+?)\\n\\n', 'mg'), "<p>$1</p>\n");
	pee = pee.replace(new RegExp('<p>\\s*?</p>', 'gi'), '');
	pee = pee.replace(new RegExp('<p>\\s*(</?(?:table|thead|tfoot|caption|colgroup|tbody|tr|td|th|div|dl|dd|dt|ul|ol|li|hr|pre|select|form|blockquote|address|math|p|h[1-6])[^>]*>)\\s*</p>', 'gi'), "$1");
	pee = pee.replace(new RegExp("<p>(<li.+?)</p>", 'gi'), "$1");
	pee = pee.replace(new RegExp('<p><blockquote([^>]*)>', 'gi'), "<blockquote$1><p>");
	pee = pee.replace(new RegExp('</blockquote></p>', 'gi'), '</p></blockquote>');
	pee = pee.replace(new RegExp('<p>\\s*(</?(?:table|thead|tfoot|caption|colgroup|tbody|tr|td|th|div|dl|dd|dt|ul|ol|li|hr|pre|select|form|blockquote|address|math|p|h[1-6])[^>]*>)', 'gi'), "$1");
	pee = pee.replace(new RegExp('(</?(?:table|thead|tfoot|caption|colgroup|tbody|tr|td|th|div|dl|dd|dt|ul|ol|li|pre|select|form|blockquote|address|math|p|h[1-6])[^>]*>)\\s*</p>', 'gi'), "$1"); 
	pee = pee.replace(new RegExp('\\s*\\n', 'gi'), "<br />\n");
	pee = pee.replace(new RegExp('(</?(?:table|thead|tfoot|caption|tbody|tr|td|th|div|dl|dd|dt|ul|ol|li|pre|select|form|blockquote|address|math|p|h[1-6])[^>]*>)\\s*<br />', 'gi'), "$1");
	pee = pee.replace(new RegExp('<br />(\\s*</?(?:p|li|div|dl|dd|dt|th|pre|td|ul|ol)>)', 'gi'), '$1');
	pee = pee.replace(new RegExp('^((?:&nbsp;)*)\\s', 'mg'), '$1&nbsp;');
	//pee = pee.replace(new RegExp('(<pre.*?>)(.*?)</pre>!ise', " stripslashes('$1') .  stripslashes(clean_pre('$2'))  . '</pre>' "); // Hmm...
	return pee;
}
// EN lang variables

if (navigator.userAgent.indexOf('Mac OS') != -1) {
// Mac OS browsers use Ctrl to hit accesskeys
	var metaKey = 'Ctrl';
}
else if (navigator.userAgent.indexOf('Firefox/2') != -1) {
// Firefox 2.x uses Alt+Shift to hit accesskeys
	var metaKey = 'Alt+Shift';
}
else {
	var metaKey = 'Alt';
}

tinyMCE.addToLang('',{
wordpress_more_button : 'Split post with More tag (' + metaKey + '+t)',
wordpress_page_button : 'Split post with Page tag',
wordpress_adv_button : 'Show/Hide Advanced Toolbar (' + metaKey + '+v)',
wordpress_more_alt : 'More...',
wordpress_page_alt : '...page...',
help_button_title : 'Help (' + metaKey + '+h)',
bold_desc : 'Bold (Ctrl+B)',
italic_desc : 'Italic (Ctrl+I)',
underline_desc : 'Underline (Ctrl+U)',
link_desc : 'Insert/edit link (' + metaKey + '+a)',
unlink_desc : 'Unlink (' + metaKey + '+s)',
image_desc : 'Insert/edit image (' + metaKey + '+m)',
striketrough_desc : 'Strikethrough (' + metaKey + '+k)',
justifyleft_desc : 'Align left (' + metaKey + '+f)',
justifycenter_desc : 'Align center (' + metaKey + '+c)',
justifyright_desc : 'Align right (' + metaKey + '+r)',
justifyfull_desc : 'Align full (' + metaKey + '+j)',
bullist_desc : 'Unordered list (' + metaKey + '+l)',
numlist_desc : 'Ordered list (' + metaKey + '+o)',
outdent_desc : 'Outdent (' + metaKey + '+w)',
indent_desc : 'Indent list/blockquote (' + metaKey + '+q)'
});
tinyMCE = tinyMCECompressed;