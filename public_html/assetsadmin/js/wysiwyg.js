/*
 * 	Additional function for wysiwyg.html
 *	Written by ThemePixels	
 *	http://themepixels.com/
 *
 *	Built for Shamcey Metro Admin Template
 *  http://themeforest.net/category/site-templates/admin-templates
 */

jQuery().ready(function() {
	tinymce.init({
	    selector: "textarea",
		plugins :[
		"advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker emoticons",
		"searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
		"save table contextmenu directionality template paste textcolor colorpicker"
	],
		fontsize_formats: "8pt 9pt 10pt 11pt 12pt 26pt 36pt",
	    toolbar: "insertfile undo redo | copy cut paste | styleselect | fontselect | fontsizeselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | print preview media fullpage | emoticons forecolor backcolor table",
	    //toolbar: "hr,link,image,charmap,paste,print,preview,anchor,pagebreak,spellchecker,searchreplace,visualblocks,visualchars,code,fullscreen,insertdatetime,media,nonbreaking,save cancel,table,directionality,,textcolor,emoticons,template,forecolor backcolor,insertfile",
    	insertdatetime_formats: ["%Y.%m.%d", "%H:%M"],
	    link_list: [
	    ]
	 });
	/*
		jQuery('textarea.tinymce').tinymce({
			// Location of TinyMCE script
			script_url : 'js/tinymce/tiny_mce.js',

			// General options
			theme : "advanced",
			skin : "themepixels",
			width: "100%",
			plugins : "autolink,lists,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,advlist",
			inlinepopups_skin: "themepixels",
			// Theme options
			theme_advanced_buttons1 : "bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,outdent,indent,blockquote,formatselect,fontselect,fontsizeselect",
			theme_advanced_buttons2 : "pastetext,pasteword,|,bullist,numlist,|,undo,redo,|,link,unlink,image,help,code,|,preview,|,forecolor,backcolor,removeformat,|,charmap,media,|,fullscreen",
			theme_advanced_buttons3 : "",
			theme_advanced_toolbar_location : "top",
			theme_advanced_toolbar_align : "left",
			theme_advanced_statusbar_location : "bottom",
			theme_advanced_resizing : true,

			// Example content CSS (should be your site CSS)
			content_css : "css/plugins/tinymce.css",

			// Drop lists for link/image/media/template dialogs
			template_external_list_url : "lists/template_list.js",
			external_link_list_url : "lists/link_list.js",
			external_image_list_url : "lists/image_list.js",
			media_external_list_url : "lists/media_list.js",
			tools: "table",

			// Replace values for the template plugin
			template_replace_values : {
				username : "Some User",
				staffid : "991234"
			}
		});
				
	*/	
		jQuery('.editornav a').click(function(){
			jQuery('.editornav li.current').removeClass('current');
			jQuery(this).parent().addClass('current');
			if(jQuery(this).hasClass('visual'))
				jQuery('#elm1').tinymce().show();
			else
				jQuery('#elm1').tinymce().hide();
			return false;
		});
});
