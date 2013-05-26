<?php 
include 'common.php';

$result = $calendarObj->getDefaultCalendar();
 ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title><?php echo $settingObj->getPageTitle(); ?></title>

<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta content="<?php echo $settingObj->getMetatagTitle(); ?>" name="title">
<meta content="<?php echo $settingObj->getMetatagDescription(); ?>" name="description">
<meta content="<?php echo $settingObj->getMetatagKeywords(); ?>" name="keywords">

<link rel="stylesheet" href="css/mainstyle.css" type="text/css" />
<link rel="stylesheet" href="css/jquery.lightbox-0.5.css" type="text/css" />

<!--[if IE 7]>
<link rel="stylesheet" href="css/ie.css" type="text/css" />
<![endif]-->
<!--[if IE 8]>
<link rel="stylesheet" href="css/ie.css" type="text/css" />
<![endif]-->

<script language="javascript" type="text/javascript" src="js/jquery-1.7.1.min.js"></script>
<script language="javascript" type="text/javascript" src="js/jquery-ui-1.8.16.custom.js"></script>
<script language="javascript" type="text/javascript" src="js/jquery.easing.1.3.js"></script>
<script language="javascript" type="text/javascript" src="js/jquery.easing.compatibility.js"></script>
<script language="javascript" type="text/javascript" src="js/jquery.bxSlider.min.js"></script>

<script language="javascript" type="text/javascript" src="js/jquery.lightbox-0.5.js"></script>
<script language="javascript" type="text/javascript" src="js/tmt_libs/tmt_core.js"></script>
<script language="javascript" type="text/javascript" src="js/tmt_libs/tmt_form.js"></script>
<script language="javascript" type="text/javascript" src="js/tmt_libs/tmt_validator.js"></script>
<script language="javascript" type="text/javascript" src="js/wachevents.calendar.js"></script>



</head>

<body>

<!-- ===============================================================
	js
================================================================ -->

<script language="javascript" type="text/javascript">
	var currentMonth;
	var currentYear;
	var pageX;
	var pageY;
	var today= new Date();
	$(function() {
		<?php
		if(isset($_GET["_escaped_fragment_"]) && $_GET["_escaped_fragment_"]!='') {
			?>
			queryStr = '<?php echo $_GET["_escaped_fragment_"];?>';
			arrParam = queryStr.split("_");
			openEvent(arrParam[1],arrParam[2],arrParam[3],arrParam[4],arrParam[5],arrParam[6]);
			getMonthName(arrParam[2]);
			<?php
		} else {
		?>
		//check pathname to load events from external link
		var pathname = window.location.toString();
		var n = pathname.indexOf("!");
		var queryStr = "";
		if(n >=0) {
			queryStr=pathname.substring((n+1),pathname.length);
			arrParam = queryStr.split("_");
			
			openEvent(arrParam[1],arrParam[2],arrParam[3],arrParam[4],arrParam[5],arrParam[6]);
			getMonthName(arrParam[2]);
		}  else {
			getMonthCalendar((today.getMonth()+1),today.getFullYear(),'<?php echo $calendarObj->getCalendarId(); ?>');
			$('#calendar_id').val('<?php echo $calendarObj->getCalendarId(); ?>');
		}
		<?php 
		}
		?>
		$("#search_field").keyup(function(event){
			if(event.keyCode == 13){
				$("#search_button").click();
			}
		});
		$('#search_button').bind('click',function() {
			searchEventsList($('#search_field').val(),$('#calendar_id').val(),1) ;
		});
		
	  
	});
	function getMonthName(month) {
		var m = new Array();
		m[0] ="<?php echo $lang["JANUARY"]; ?>";
		m[1] ="<?php echo $lang["FEBRUARY"]; ?>";
		m[2] ="<?php echo $lang["MARCH"]; ?>";
		m[3] ="<?php echo $lang["APRIL"]; ?>";
		m[4] ="<?php echo $lang["MAY"]; ?>";
		m[5] ="<?php echo $lang["JUNE"]; ?>";
		m[6] ="<?php echo $lang["JULY"]; ?>";
		m[7] ="<?php echo $lang["AUGUST"]; ?>";
		m[8] ="<?php echo $lang["SEPTEMBER"]; ?>";
		m[9] ="<?php echo $lang["OCTOBER"]; ?>";
		m[10] ="<?php echo $lang["NOVEMBER"]; ?>";
		m[11] ="<?php echo $lang["DECEMBER"]; ?>";
		$('#month_name').html(m[(month-1)]);
		currentMonth = month;
	}
	
	function setCalendar(calendar_id) {
		getMonthCalendar((today.getMonth()+1),today.getFullYear(),calendar_id);
		$('#calendar_id').val(calendar_id);
	}
	
</script>

<!-- ===============================================================
	box preview available time slots
================================================================ -->

<div class="box_preview_container_all" id="box_slots" style="display:none">
    <div class="box_preview_title" id="popup_title"><?php echo $lang["INDEX_EVENTS_PREVIEW"]; ?></div>
    <div class="box_preview_events_container" id="events_popup">
        
    </div>
</div>


<!-- ===============================================================
	events calendar begins here
================================================================ -->
<div class="main_container" id="container_all">
	
    <!-- =======================================
    	header (month + navigation + select)
	======================================== -->
	<div class="header_container">
    	<!-- month and navigation -->
    	<div class="month_container_all">
        	<!-- month -->
        	<div class="month_container">
            	<div class="font_custom month_name" id="month_name"></div>
                <div class="font_custom month_year" id="month_year"></div>
            </div>
            <!-- navigation -->
            <div class="month_nav_container" id="month_nav">
            	<div class="mont_nav_button_container" id="month_nav_prev"><a href="javascript:getPreviousMonth(<?php echo $calendarObj->getCalendarId(); ?>);" class="month_nav_button month_nav_button_prev"></a></div>
                <div class="mont_nav_button_container" id="month_nav_next"><a href="javascript:getNextMonth(<?php echo $calendarObj->getCalendarId(); ?>);" class="month_nav_button month_nav_button_next"></a></div>
            </div>
            <div class="cleardiv"></div>
            <!-- view type -->
            <div class="view_type_container" id="view_buttons">
            	<div class="view_type_button"><a href="javascript:getCalendarView((today.getMonth()+1),today.getFullYear(),'<?php echo $calendarObj->getCalendarId(); ?>');" style="background-color:#567BD2" id="view_calendar"><?php echo $lang["VIEW_CALENDAR"]; ?></a></div>
                <div class="view_type_button"><a href="javascript:getEventsHomeList(<?php echo $calendarObj->getCalendarId(); ?>,1,'future');" id="view_list"><?php echo $lang["VIEW_LIST"]; ?></a></div>
            </div>
            
        </div>
        
        <div class="select_search_container">
        	<!-- select -->
            <div class="select_container_all">
            	<input type="hidden" name="calendar_id" id="calendar_id" value="" />
            	<div class="select_calendar_container" id="calendar_select">
                <?php
                $arrayCalendars = $listObj->getCalendarsList('ORDER BY calendar_order');
                if(count($arrayCalendars)>0) {
                    ?>
                    <select name="calendar" onchange="javascript:setCalendar(this.options[this.selectedIndex].value);">
                        <?php
                        foreach($arrayCalendars as $calendarId => $calendar) {
                            ?>
                            <option value="<?php echo $calendarId; ?>" <?php if($calendarId == $calendarObj->getCalendarId()) { echo "selected"; }?>><?php echo $calendar["calendar_title"]; ?></option>
                            <?php
							}
							?>
						</select>
						<?php
					}
					?>
                </div>
            
                <!-- select message -->
                <div class="select_calendar_message" id="calendar_select_label"><?php echo $lang["SELECT_CALENDAR"]; ?></div>
                <div class="cleardiv"></div>
            
            </div>
            
            <!-- search -->
            <div class="search_container"  id="search_event_field">
                <div class="search_input_button"><input type="button" id="search_button" class="preview_event_button readmore_button" value="<?php echo $lang["SEARCH"]?>" /></div>
                <div class="search_input"><input type="text" name="search_field" id="search_field" style="background:#FFFFFF;width:150px;float:left;margin-right:10px"/></div>
                <!-- select message -->
           		<div class="select_calendar_message" id="search_event_label" ><?php echo $lang["SEARCH_EVENT"]; ?></div>
            
            </div>
            
        </div>
    </div>
    
    
    <!-- =======================================
    	calendar
	======================================== -->
    <div class="calendar_container_all">
    	<!-- days name -->
    	<div class="name_days_container" id="name_days_container">
        	<?php
			if($settingObj->getDateFormat() == "UK") {
				?>
				<div class="font_custom day_name"><?php echo $lang["MONDAY"]; ?></div>
				<div class="font_custom day_name"><?php echo $lang["TUESDAY"]; ?></div>
				<div class="font_custom day_name"><?php echo $lang["WEDNESDAY"]; ?></div>
				<div class="font_custom day_name"><?php echo $lang["THURSDAY"]; ?></div>
				<div class="font_custom day_name"><?php echo $lang["FRIDAY"]; ?></div>
				<div class="font_custom day_name"><?php echo $lang["SATURDAY"]; ?></div>
				<div class="font_custom day_name" style="margin-right: 0px;"><?php echo $lang["SUNDAY"]; ?></div>
				<?php
			} else {
				?>
                <div class="font_custom day_name"><?php echo $lang["SUNDAY"]; ?></div>
				<div class="font_custom day_name"><?php echo $lang["MONDAY"]; ?></div>
				<div class="font_custom day_name"><?php echo $lang["TUESDAY"]; ?></div>
				<div class="font_custom day_name"><?php echo $lang["WEDNESDAY"]; ?></div>
				<div class="font_custom day_name"><?php echo $lang["THURSDAY"]; ?></div>
				<div class="font_custom day_name"><?php echo $lang["FRIDAY"]; ?></div>
				<div class="font_custom day_name" style="margin-right: 0px;"><?php echo $lang["SATURDAY"]; ?></div>
				<?php
			}
			?>
        </div>
        
        <!-- days -->
        <div class="days_container_all" id="calendar_container">
        	
        	
        </div>
         <div class="events_container_all" id="events_container" style="display:none">
    	
       
    	 </div>
          <div class="events_container_all" id="event_container" style="display:none">
    	
       
    	 </div>
         <div class="events_container_all" id="events_home_container" style="display:none">
    	
       
    	 </div>
    </div>
    
   
   
</div>

<!-- ===============================================================
	events calendar ends here
================================================================ -->

<!-- preloader -->
<div id="modal_loading" class="modal_loading" style="display:none">
	<img src="images/loading.png" border=0 />
</div>

</body>
</html>
