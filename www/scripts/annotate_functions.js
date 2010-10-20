var annotate = function() { 
	return {
		path : false,
		
		initialize : function() { //this should only be called if we have a .wdn_annonate
			annotate.setupUserNotice();
		},

		setupUserNotice : function() { //indicate to user areas are annotatable
			$('#wdn_wrapper').before('<div id="wdn_annotate_notice">This page has areas in which you can save personal annotations specific to particular content. <a href="#">Show these areas</a></div>');
		},
		
		showAnnotableRegions : function() { //add markup/icon to areas which can be annotatable
			
		},
		
		buildAnnotables : function() { //when a user clicks on one of the icons, bring up a qTip with the textarea/contenteditable for the note
			
		}
	};
}($ = WDN.jQuery);