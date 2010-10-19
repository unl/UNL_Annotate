WDN.loadCSS('http://ucommrasmussen.unl.edu/workspace/unl_annotate/www/css/annotate.css');
WDN.jQuery(document).ready(function($){
	$('.wdn_annotate').attr("contenteditable",true);
	
	$('.wdn_annotate').change(function(){
		var newValue = $(this).html();

		WDN.post(
			'http://ucommrasmussen.unl.edu/workspace/unl_annotate/www',
			'note='+newValue,
			function(data){
				
			},
			''
		);
		return false
	});

});