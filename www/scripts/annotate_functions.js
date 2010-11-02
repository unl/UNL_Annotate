var annotate = function() { 
	return {
		path : false,
		
		initialize : function() { //this should only be called if we have a .wdn_annonate
			//annotate.setupUserNotice();
			annotate.enableAnnotatableRegions();
		},

		setupUserNotice : function() { //indicate to user areas are annotatable
			$('#wdn_wrapper').before('<div id="wdn_annotate_notice"><img src="'+annotate.path+'css/images/note.png" />This page has areas in which you can save personal annotations specific to particular content. <a href="#" onclick="annotate.enableAnnotatableRegions(); return false;">Show these areas</a></div>');
			$('#wdn_annotate_notice').slideDown('slow');
		},
		
		enableAnnotatableRegions : function() {
			$('.wdn_annotate').each(function(){
				var id = $(this).attr('id').split('_');
				var sitekey = id[0];
				var fieldname = id[1];
				
				$(this).html('<a href="'+annotate.noteURL(sitekey,fieldname)+'">Annotation</a>');
				$(this).addClass('on');
				
				$(this).children('a').qtip({
					content: {
						text: annotate.createNote(sitekey, fieldname)
					},
					position: {
						corner: {
							target: 'bottomRight',
							tooltip: 'topLeft'
						},
						adjust: {
							screen: true
						}
					},
					show: { 
						when: 'click', 
						solo: true
					},
					hide: 'unfocus',
					style: {
						tip: false,
						border: {
							width: 0,
							radius: 0
						},
						'background-color':'transparent',
						width: 420,
						height: 160
					}
				});
			});
			$('.wdn_annotate a').click(function(evt){
				evt.preventDefault();
				$('.wdn_annotate').trigger('click');
			});
		},
		
		createNote : function(sitekey, fieldname) { //build the note
			htmlStructure = '<iframe src="'+annotate.noteURL(sitekey, fieldname)+'" width="100%" height="100%" scrolling="no" class="wdn_annotate_note"></iframe>';
			return htmlStructure;
		},
		
		availableNote : function(id) { //query to see if a note exists
			return false;
		},
		
		noteURL : function(sitekey, fieldname) {
			return annotate.path+'&sitekey='+sitekey+'&fieldname='+fieldname;
		}
	};
}($ = WDN.jQuery);