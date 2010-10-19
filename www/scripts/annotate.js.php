<?php 
require_once dirname(dirname(dirname(__FILE__))).'/config.inc.php';
if (false == headers_sent()) {
    header("content-type: application/x-javascript");
}
?>
var annotate = function() { 
	return {
		initialize : function() { //check to see if we have class="wdn_annotate" on the page
			if ($('.wdn_annotate')) {
				WDN.loadCSS('<?php echo UNL_Annotate::$url; ?>/css/annotate.css');
				annotate.setupUserNotice();
			} else {
				return false;
			}
		},

		setupUserNotice : function() { //indicate to user areas are annotatable
			
		},
		
		showAnnotableRegions : function() { //add markup/icon to areas which can be annotatable
			
		},
		
		buildAnnotables : function() { //when a user clicks on one of the icons, bring up a qTip with the textarea/contenteditable for the note
			
		}
	};
}($ = WDN.jQuery);

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
			'<?php echo UNL_Annotate::$url; ?>',
			dataString,
			function(data){
				
			},
			''
		);
		
	});

	//initial call to load the rest of the JS
	annotate.initialize();


});