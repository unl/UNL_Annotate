WDN.loadCSS('http://ucommrasmussen.unl.edu/workspace/unl_annotate/www/css/annotate.css');
WDN.jQuery(document).ready(function($){
	$('.wdn_annotate').attr("contenteditable",true);
	
	$('.wdn_annotate').live('focus', function() {
		before = $(this).html();
	}).live('keyup paste', function() { 
		if (before != $(this).html()) {
			$(this).trigger('change');
		}
	});
	
	$('.wdn_annotate').live('change', function() {
		var id = $(this).attr('id').split('_');
		var sitekey = id[0];
		var fieldname = id[1];
		var note = $(this).html();
		
		var dataString = 'note='+$.trim(note)+'&sitekey='+sitekey+'&fieldname='+fieldname;

		WDN.post(
			'http://ucommrasmussen.unl.edu/workspace/unl_annotate/www/',
			dataString,
			function(data){
				
			},
			''
		);
		
	});



});