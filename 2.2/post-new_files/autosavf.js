var autosaveLast = '';
var autosavePeriodical;

function autosave_start_timer() {
	var form = $('post');
	autosaveLast = form.post_title.value+form.content.value;
	// Keep autosave_interval in sync with edit_post().
	autosavePeriodical = new PeriodicalExecuter(autosave, autosaveL10n.autosaveInterval);
	//Disable autosave after the form has been submitted
	if(form.addEventListener) {
		form.addEventListener("submit", function () { autosavePeriodical.currentlyExecuting = true; }, false);
	}
	if(form.attachEvent) {
		form.save ? form.save.attachEvent("onclick", function () { autosavePeriodical.currentlyExecuting = true; }) : null;
		form.submit ? form.submit.attachEvent("onclick", function () { autosavePeriodical.currentlyExecuting = true; }) : null;
		form.publish ? form.publish.attachEvent("onclick", function () { autosavePeriodical.currentlyExecuting = true; }) : null;
		form.deletepost ? form.deletepost.attachEvent("onclick", function () { autosavePeriodical.currentlyExecuting = true; }) : null;
	}
}
addLoadEvent(autosave_start_timer)

function autosave_cur_time() {
	var now = new Date();
	return "" + ((now.getHours() >12) ? now.getHours() -12 : now.getHours()) + 
	((now.getMinutes() < 10) ? ":0" : ":") + now.getMinutes() +
	((now.getSeconds() < 10) ? ":0" : ":") + now.getSeconds();
}

function autosave_update_nonce() {
	var response = nonceAjax.response;
	document.getElementsByName('_wpnonce')[0].value = response;
}

function autosave_update_post_ID() {
	var response = autosaveAjax.response;
	var res = parseInt(response);
	var message;

	if(isNaN(res)) {
		message = autosaveL10n.errorText.replace(/%response%/g, response);
	} else {
		message = autosaveL10n.saveText.replace(/%time%/g, autosave_cur_time());
		$('post_ID').name = "post_ID";
		$('post_ID').value = res;
		// We need new nonces
		nonceAjax = new sack();
		nonceAjax.element = null;
		nonceAjax.setVar("action", "autosave-generate-nonces");
		nonceAjax.setVar("post_ID", res);
		nonceAjax.setVar("cookie", document.cookie);
		nonceAjax.setVar("post_type", $('post_type').value);
		nonceAjax.requestFile = autosaveL10n.requestFile;
		nonceAjax.onCompletion = autosave_update_nonce;
		nonceAjax.method = "POST";
		nonceAjax.runAJAX();
		$('hiddenaction').value = 'editpost';
	}
	$('autosave').innerHTML = message;
	autosave_enable_buttons();
}

function autosave_loading() {
	$('autosave').innerHTML = autosaveL10n.savingText;
}

function autosave_saved() {
	var response = autosaveAjax.response;
	var res = parseInt(response);
	var message;

	if(isNaN(res)) {
		message = autosaveL10n.errorText.replace(/%response%/g, response);
	} else {
		message = autosaveL10n.saveText.replace(/%time%/g, autosave_cur_time());
	}
	$('autosave').innerHTML = message;
	autosave_enable_buttons();
}

function autosave_disable_buttons() {
	var form = $('post');
	form.save ? form.save.disabled = 'disabled' : null;
	form.submit ? form.submit.disabled = 'disabled' : null;
	form.publish ? form.publish.disabled = 'disabled' : null;
	form.deletepost ? form.deletepost.disabled = 'disabled' : null;
	setTimeout('autosave_enable_buttons();', 1000); // Re-enable 1 sec later.  Just gives autosave a head start to avoid collisions.
}

function autosave_enable_buttons() {
	var form = $('post');
	form.save ? form.save.disabled = '' : null;
	form.submit ? form.submit.disabled = '' : null;
	form.publish ? form.publish.disabled = '' : null;
	form.deletepost ? form.deletepost.disabled = '' : null;
}

function autosave() {
	var form = $('post');
	var rich = ((typeof tinyMCE != "undefined") && tinyMCE.getInstanceById('content')) ? true : false;

	autosaveAjax = new sack();

	/* Gotta do this up here so we can check the length when tinyMCE is in use */
	if ( typeof tinyMCE == "undefined" || tinyMCE.configs.length < 1 || rich == false ) {
		autosaveAjax.setVar("content", form.content.value);
	} else {
		// Don't run while the TinyMCE spellcheck is on.
		if(tinyMCE.selectedInstance.spellcheckerOn) return;
		tinyMCE.wpTriggerSave();
		autosaveAjax.setVar("content", form.content.value);
	}

	if(form.post_title.value.length==0 || form.content.value.length==0 || form.post_title.value+form.content.value == autosaveLast)
		return;

	autosave_disable_buttons();

	autosaveLast = form.post_title.value+form.content.value;

	cats = document.getElementsByName("post_category[]");
	goodcats = ([]);
	for(i=0;i<cats.length;i++) {
		if(cats[i].checked)
			goodcats.push(cats[i].value);
	}
	catslist = goodcats.join(",");

	autosaveAjax.setVar("action", "autosave");
	autosaveAjax.setVar("cookie", document.cookie);
	autosaveAjax.setVar("catslist", catslist);
	autosaveAjax.setVar("post_ID", $("post_ID").value);
	autosaveAjax.setVar("post_title", form.post_title.value);
	autosaveAjax.setVar("post_type", form.post_type.value);
	if ( form.comment_status.checked )
		autosaveAjax.setVar("comment_status", 'open');
	if ( form.ping_status.checked )
		autosaveAjax.setVar("ping_status", 'open');
	if(form.excerpt)
		autosaveAjax.setVar("excerpt", form.excerpt.value);

	if ( typeof tinyMCE == "undefined" || tinyMCE.configs.length < 1 || rich == false ) {
		autosaveAjax.setVar("content", form.content.value);
	} else {
		tinyMCE.wpTriggerSave();
		autosaveAjax.setVar("content", form.content.value);
	}

	autosaveAjax.requestFile = autosaveL10n.requestFile;
	autosaveAjax.method = "POST";
	autosaveAjax.element = null;
	autosaveAjax.onLoading = autosave_loading;
	autosaveAjax.onInteractive = autosave_loading;
	if(parseInt($("post_ID").value) < 1)
		autosaveAjax.onCompletion = autosave_update_post_ID;
	else
		autosaveAjax.onCompletion = autosave_saved;
	autosaveAjax.runAJAX();
}
