jQuery(document).ready(function($) {

	var eventAxaxLoading = $("#gg_event_window").html();
	//var SelectedDates = new Array();
	
	$( ".gg_widget_calendar" ).datepicker({
	   beforeShowDay: function(date){
			var SelectedDates = new Array();
			var dataData = $(this).data('dates'); 

			$.each( dataData, function( key, value ) {
				var year = value.slice(0, 4);
				var month = value.slice(4,6);
				var day = value.slice(6,8);
				var theDate = new Date(year + '/' + month + '/' + day);
				SelectedDates[new Date(theDate)] = new Date(theDate); 
		
			});//$.each( gg_event_dates	
			
			$(this).data('selecteddates', SelectedDates);

			var Highlight = SelectedDates[date];
			if (Highlight) {
				return [true, "gg_has_event"];
			}
			else {
				return [true, "gg_no_event"];
			}
		},
		
		closeText: languageoptions.closeText,
		currentText: languageoptions.currentText,
		monthNames: languageoptions.monthNames,
		monthNamesShort: languageoptions.monthNamesShort,
		dayNames: languageoptions.dayNames,
		dayNamesShort: languageoptions.dayNamesShort,
		dayNamesMin: languageoptions.dayNamesMin,
		dateFormat: languageoptions.dateFormat,
		firstDay: languageoptions.firstDay,
		isRTL: languageoptions.isRTL,
		onSelect: function ( dateText, inst ) { 
			var SelectedDates = $(this).data('selecteddates');
	   
		var theDate = inst.selectedYear + '/' + (inst.selectedMonth+1) + '/' +inst.selectedDay;
		var Highlight = SelectedDates[new Date(theDate)];
		if (Highlight) {
			
			var popup = $(this).data('popup');
			
			if(popup == "yes"){
				$("#gg_event_window").html(eventAxaxLoading);
				//if this date has an event...
				$("#gg_event_window").fadeIn();
				$("#gg_event_lightbox").fadeTo('fast', gg_event_site_vars.lightbox_tansparency);	
				var theURL = gg_event_site_vars.admin_url + 'admin-ajax.php?action=gg_event_ajax';
				//load ajax content:
				$.post(
				   theURL, 
				   {
					  'action':'gg_event_ajax',
					  'clickedDate':theDate,
					  'cat': $(this).data('category')
				   }, 
				   function(result){
					
						
					$("#gg_event_window").html(result); //load
					$("html").css('overflow', 'hidden');
					var windowStartPosition= $('#gg_event_window_inner').position();
					var	outerWindowHeight = $('#gg_event_window').height()
					
					//set up scrolling---------------------------------
					$("#gg_event_window .arrow_up").click(function(){
						$('#gg_event_window_inner').stop(true,true);
						var position = $('#gg_event_window_inner').position();
				
						if(position.top != windowStartPosition.top){ $('#gg_event_window_inner').animate({bottom: '-=100'}, 500); }
					});		
					
					$("#gg_event_window .arrow_down").click(function(){
						$('#gg_event_window_inner').stop(true,true);
						var position = $('#gg_event_window_inner').position();
						
						var height = $('#gg_event_window_inner').height()-outerWindowHeight;
						var newheight = -height;
						if(position.top >= newheight){$('#gg_event_window_inner').animate({bottom: '+=100'}, 500);	}
					});
	
					//set up mousewheel scrolling-------------------------------------------
					$('#gg_event_window').mousewheel(function(event, delta, deltaX, deltaY) {
						
						if (deltaY > 0) {
							$('#gg_event_window_inner').stop(true,true);
							var position = $('#gg_event_window_inner').position();
							if(position.top !=windowStartPosition.top){ $('#gg_event_window_inner').animate({bottom: '-=50'}, 250); }
						} else {
							$('#gg_event_window_inner').stop(true,true);
							var position = $('#gg_event_window_inner').position();
						
							var height = $('#gg_event_window_inner').height()-outerWindowHeight;
							var newheight = -height;
							if(position.top >= newheight){$('#gg_event_window_inner').animate({bottom: '+=50'}, 500);	}
						}
					});				
					
					$(".gg_close_ajax").click(function(){
					//$("#gg_event_window").stop(true,true);	
					$("#gg_event_window").fadeOut();
					$("#gg_event_lightbox").fadeOut();
					$("html").css('overflow', 'auto');
				
					});
				 
				   }
				);// end .post				
				}
			else {
				window.location = popup + '?date=' + theDate + '&cat=' + $(this).data('category');
			}// if popup

		  }//end if Highlight
		}//onSelect
	});// end datepicker

	
	$( "#gg_fullsize_calendar" ).datepicker({
	   beforeShowDay: function(date)
	   {
		  var Highlight = SelectedDates[date];
		  if (Highlight) {
			 return [true, "gg_has_event"];
		  }
		  else {
			 return [true, 'gg_no_event', ''];
		  }
	   },
		
		closeText: languageoptions.closeText,
		currentText: languageoptions.currentText,
		monthNames: languageoptions.monthNames,
		monthNamesShort: languageoptions.monthNamesShort,
		dayNames: languageoptions.dayNames,
		dayNamesShort: languageoptions.dayNamesShort,
		dayNamesMin: languageoptions.dayNamesMin,
		dateFormat: languageoptions.dateFormat,
		firstDay: languageoptions.firstDay,
		isRTL: languageoptions.isRTL,
	   onSelect: function ( dateText, inst ) { 
		
		}//onSelect
	});// end datepicker	

	if($('#gg_fullsize_calendar').size()>0){
		var theURL = gg_event_site_vars.admin_url + 'admin-ajax.php?action=gg_ajax_event_info';
		var data = {
			action: 'gg_ajax_event_info'
		};			
		
		var eventObject;
		$.post(theURL, data, function(response) {
				eventObject = $.parseJSON(response);
				//console.log(eventObject);
				$('#gg_fullsize_calendar .gg_has_event').each(function(){
					//get date values
					//var year = $(this).context.attributes[5].value;
					//var month = $(this).context.attributes[4].value;
					var year = $(this).data('year');
					var month = $(this).data('month');
					var day = $('a',this).text();
					var theDate = year + '/' + (parseInt(month)+1) + '/' + day;
					
					if($.inArray(theDate, eventObject.start_date) != -1){
						//console.log(theDate);
						var theIndex = $.inArray(theDate, eventObject.start_date);
						
						$('a',this).addClass('gg_start_date').append('<br/>' + eventObject.title[theIndex]);
						}
						else{
						$('a',this).append('<br/>&nbsp;');							
							}
					
					//console.log(theDate);
				});//.each		
						
		});//post

				

	}//end if($('#gg_fullsize_calendar')

});