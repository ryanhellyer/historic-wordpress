
function TinyMCECompressed() {
	this.configs = new Array();
	this.loadedFiles = new Array();
	this.externalPlugins = new Array();
	this.loadAdded = false;
	this.isLoaded = false;
}

TinyMCECompressed.prototype.init = function(settings) {
	var elements = document.getElementsByTagName('script');
	var scriptURL = "";

	for (var i=0; i<elements.length; i++) {
		if (elements[i].src && elements[i].src.indexOf("tiny_mce_gzip.php") != -1) {
			scriptURL = elements[i].src;
			break;
		}
	}

	settings["theme"] = typeof(settings["theme"]) != "undefined" ? settings["theme"] : "default";
	settings["plugins"] = typeof(settings["plugins"]) != "undefined" ? settings["plugins"] : "";
	settings["language"] = typeof(settings["language"]) != "undefined" ? settings["language"] : "en";
	settings["button_tile_map"] = typeof(settings["button_tile_map"]) != "undefined" ? settings["button_tile_map"] : true;
	this.configs[this.configs.length] = settings;
	this.settings = settings;

	scriptURL += (scriptURL.indexOf('?') == -1) ? '?' : '&';
	scriptURL += "theme=" + escape(this.getOnce(settings["theme"])) + "&language=" + escape(this.getOnce(settings["language"])) + "&plugins=" + escape(this.getOnce(settings["plugins"])) + "&lang=" + settings["language"] + "&index=" + escape(this.configs.length-1);
	document.write('<sc'+'ript language="javascript" type="text/javascript" src="' + scriptURL + '"></script>');

	if (!this.loadAdded) {
		tinyMCE.addEvent(window, "DOMContentLoaded", TinyMCECompressed.prototype.onLoad);
		tinyMCE.addEvent(window, "load", TinyMCECompressed.prototype.onLoad);
		this.loadAdded = true;
	}
}

TinyMCECompressed.prototype.onLoad = function() {
	if (tinyMCE.isLoaded)
		return true;

	tinyMCE = realTinyMCE;
	TinyMCE_Engine.prototype.onLoad();
	tinyMCE._addUnloadEvents();

	tinyMCE.isLoaded = true;
}

TinyMCECompressed.prototype.addEvent = function(o, n, h) {
	if (o.attachEvent)
		o.attachEvent("on" + n, h);
	else
		o.addEventListener(n, h, false);
}

TinyMCECompressed.prototype.getOnce = function(str) {
	var ar = str.replace(/\s+/g, '').split(',');

	for (var i=0; i<ar.length; i++) {
		if (ar[i] == '' || ar[i].charAt(0) == '-') {
			ar[i] = null;
			continue;
		}

		// Skip load
		for (var x=0; x<this.loadedFiles.length; x++) {
			if (this.loadedFiles[x] == ar[i])
				ar[i] = null;
		}

		this.loadedFiles[this.loadedFiles.length] = ar[i];
	}

	// Glue
	str = "";
	for (var i=0; i<ar.length; i++) {
		if (ar[i] == null)
			continue;

		str += ar[i];

		if (i != ar.length-1)
			str += ",";
	}

	return str;
};

TinyMCECompressed.prototype.loadPlugins = function() {
	var i, ar;

	TinyMCE.prototype.loadScript = TinyMCE.prototype.orgLoadScript;
	tinyMCE = realTinyMCE;

	ar = tinyMCECompressed.externalPlugins;
	for (i=0; i<ar.length; i++)
		tinyMCE.loadPlugin(ar[i].name, ar[i].url);

	TinyMCE.prototype.loadScript = function() {};
};

TinyMCECompressed.prototype.loadPlugin = function(n, u) {
	this.externalPlugins[this.externalPlugins.length] = {name : n, url : u};
};

TinyMCECompressed.prototype.importPluginLanguagePack = function(n, v) {
	tinyMCE = realTinyMCE;
	TinyMCE.prototype.loadScript = TinyMCE.prototype.orgLoadScript;
	tinyMCE.importPluginLanguagePack(n, v);
};

TinyMCECompressed.prototype.addPlugin = function(n, p) {
	tinyMCE = realTinyMCE;
	tinyMCE.addPlugin(n, p);
};

var tinyMCE = new TinyMCECompressed();
var tinyMCECompressed = tinyMCE;
