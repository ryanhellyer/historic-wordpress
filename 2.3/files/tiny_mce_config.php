
initArray = {
	mode : "specific_textareas",
	editor_selector : "mceEditor",
	width : "100%",
	theme : "advanced",
	theme_advanced_buttons1 : "bold,italic,strikethrough,separator,bullist,numlist,outdent,indent,separator,justifyleft,justifycenter,justifyright,separator,link,unlink,image,wp_more,separator,spellchecker,separator,wp_help,wp_adv,wp_adv_start,formatselect,underline,justifyfull,forecolor,separator,pastetext,pasteword,separator,removeformat,cleanup,separator,charmap,separator,undo,redo,wp_adv_end",
	theme_advanced_buttons2 : "",
	theme_advanced_buttons3 : "",
	language : "en",
	theme_advanced_toolbar_location : "top",
	theme_advanced_toolbar_align : "left",
	theme_advanced_path_location : "bottom",
	theme_advanced_resizing : true,
	browsers : "msie,gecko,opera,safari",
	dialog_type : "modal",
	theme_advanced_resize_horizontal : false,
	convert_urls : false,
	relative_urls : false,
	remove_script_host : false,
	force_p_newlines : true,
	force_br_newlines : false,
	convert_newlines_to_brs : false,
	remove_linebreaks : false,
	fix_list_elements : true,
	gecko_spellcheck : true,
	entities : "38,amp,60,lt,62,gt",
	button_tile_map : true,
	content_css : "#/wp-includes/js/tinymce/plugins/wordpress/wordpress.css",
	valid_elements : "p/-div[*],-strong/-b[*],-em/-i[*],-font[*],-ul[*],-ol[*],-li[*],*[*]",
	save_callback : 'TinyMCE_wordpressPlugin.saveCallback',
	imp_version : "20070528",
	plugins : "inlinepopups,autosave,spellchecker,paste,wordpress"
};


tinyMCE.init(initArray);
