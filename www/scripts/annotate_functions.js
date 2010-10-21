var annotate = function() { 
	return {
		path : false,
		
		initialize : function() { //this should only be called if we have a .wdn_annonate
			annotate.setupUserNotice();
		},

		setupUserNotice : function() { //indicate to user areas are annotatable
			$('#wdn_wrapper').before('<div id="wdn_annotate_notice"><img src="'+annotate.path+'css/images/note.png" />This page has areas in which you can save personal annotations specific to particular content. <a href="#" onclick="annotate.showAnnotatableRegions();">Show these areas</a></div>');
			$('#wdn_annotate_notice').slideDown('slow');
		},
		
		showAnnotatableRegions : function() { //add markup/icon to areas which can be annotatable
			$('.wdn_annotate').each(function(index, Element){
				$(this).append('<a href="#" class="annotatable"></a>');
				if (index == ($('.wdn_annotate').length - 1)) {
					annotate.buildAnnotatables();
				}
			});
		},
		
		buildAnnotatables : function() { //when a user clicks on one of the icons, bring up a qTip with the textarea/contenteditable for the note
			//try {
				$('.wdn_annotate .annotatable').each(function(){
					$(this).qtip({
			    		content:{
			    			text: 'blah blah'
			    		},
			            position : {
			            	corner : {
			            		target : 'topMiddle',
			            		tooltip : 'bottomMiddle'
			            	},
			            	container: $('body'),
			            	adjust : {
			            		screen : true,
			            		y : 3,
			            		x : 5
			            	}
			            },
			            show: {
			            	delay : 150
			            },
			            hide: {
			            	fixed : true,
			            	delay : 150
			            },
			            style: { 
			            	tip: { 
			            		corner: 'bottomMiddle' ,
			            		size: { x: 25, y: 15 },
			            		color: '#c8c8c8'
			            	},
			            	"padding" : "9px",
			            	"width":"98px",
			            	classes : {
			            		tooltip : 'courseInfo'
			            	}
			            }
			    	});
				});
	    	//} catch(e) {}
		},
		
		createNote : function() { //either get the note from DB or just setup a new one
			
		}
	};
}($ = WDN.jQuery);