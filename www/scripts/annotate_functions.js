var annotate = function() { 
	return {
		path : false,
		
		initialize : function() { //this should only be called if we have a .wdn_annonate
			annotate.setupUserNotice();
		},

		setupUserNotice : function() { //indicate to user areas are annotatable
			$('#wdn_wrapper').before('<div id="wdn_annotate_notice"><img src="'+annotate.path+'css/images/note.png" />This page has areas in which you can save personal annotations specific to particular content. <a href="#" onclick="annotate.showAnnotatableRegions(); return false;">Show these areas</a></div>');
			$('#wdn_annotate_notice').slideDown('slow');
		},
		
		showAnnotatableRegions : function() {
			$('.wdn_annotate').each(function(){
				$(this).addClass('on');
				$(this).append(annotate.createNote());
			});
		},
		
		createNote : function(id) { //build the note
			noteURL = annotate.path+'?='+id;
			htmlStructure = '<iframe src="'+noteURL+'" width="100%" scrolling="no" class="annotate_note"></iframe>';
			return htmlStructure;
		},
		
		availableNote : function(id) { //query to see if a note exists
			return false;
		}
	};
}($ = WDN.jQuery);