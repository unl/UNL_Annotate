<?php 
require_once dirname(dirname(dirname(__FILE__))).'/config.inc.php';
if (false == headers_sent()) {
    header("content-type: application/x-javascript");
}
?>

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
	if ($('.wdn_annotate')) {
		WDN.loadCSS(annotate.path+'/css/annotate.css');
		WDN.loadJS('<?php echo UNL_Annotate::$url; ?>scripts/annotate_functions.js', function(){
			annotate.path = '<?php echo UNL_Annotate::$url; ?>';
			annotate.initialize();
		});
	}


});