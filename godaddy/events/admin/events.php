<?php 
include 'common.php';
if(!isset($_SESSION["admin_id"]) || $_SESSION["admin_id"] == 0) {
	header('Location: login.php');
}



$calendarObj->setCalendar($_GET["calendar_id"]);

if(isset($_POST["operation"]) && $_POST["operation"] != '') {
	$arrEvents=$_POST["events"];
	$qryString = "0";
	for($i=0;$i<count($arrEvents); $i++) {
		$qryString .= ",".$arrEvents[$i];
	}
		
	switch($_POST["operation"]) {
		case "publishEvents":
			$eventObj->publishEvents($qryString);
			break;
		case "unpublishEvents":
			$eventObj->unpublishEvents($qryString);
			break;
		case "delEvents":
			$eventObj->delEvents($qryString);
			break;
		case "duplicateEvents":
			$eventObj->duplicateEvents($qryString);
			break;
	}                
	//header('Location: events.php?calendar_id='.$_GET["calendar_id"]);
}

include 'include/header.php';
?>

<div id="top_bg_container_all">
    <div id="container_all">
        <div id="container_content">
			<?php
            include 'include/menu.php';
            ?>
           <?php
			$background = "";
			$status = "";
			if($calendarObj->getCalendarActive() == 1) {
				$background = "#00B478";
				$status = "Published";
			} else {
				$background = "#E05B5B";
				$status = "Unpublished";
			}
			?>
            <!-- calendar status -->
            <div class="calendar_status" style="background:<?php echo $background; ?>">The Actual Status of this calendar is: <span style="text-transform:uppercase; font-weight: bold;"><?php echo $status; ?></span></div>
            
            <div id="cleardiv"></div>
            <div id="action_bar">
            	<script>
					
					function publishEvent(itemId) {
						if(confirm("Are you sure you want to publish this event?")) {
							$.ajax({
							  url: 'ajax/publishEvent.php?event_id='+itemId,
							  success: function(data) {
								  $('#publish_'+itemId).html('<a href="javascript:unpublishEvent('+itemId+');"><img src="images/icons/published.png" border=0 /></a>');								 							 
								
							  }
							});
						} 
					}
					function unpublishEvent(itemId) {
						if(confirm("Are you sure you want to unpublish this event?")) {
							$.ajax({
							  url: 'ajax/unpublishEvent.php?event_id='+itemId,
							  success: function(data) {
								  $('#publish_'+itemId).html('<a href="javascript:publishEvent('+itemId+');"><img src="images/icons/unpublished.png" border=0 /></a>');								 							 
								
							  }
							});
						} 
					}
					
					
				</script>
                <!--form to add a calendar--> 
                <div class="breadcrumb">You are in: <a href="calendars.php">Calendars</a> > <?php echo $calendarObj->getCalendarTitle(); ?> - <strong>Events List</strong></div> 
                <div id="action"><a onclick="javascript:delItems('manage_events','events[]','duplicateEvents','duplicate')">Duplicate</a></div>
                <div id="action"><a onclick="javascript:delItems('manage_events','events[]','delEvents','delete')">Delete</a></div>
                <div id="action"><a onclick="javascript:delItems('manage_events','events[]','unpublishEvents','unpublish')">Unpublish</a></div>
                <div id="action"><a onclick="javascript:delItems('manage_events','events[]','publishEvents','publish')">Publish</a></div>
                <div id="action"><a href="new_event.php?calendar_id=<?php echo $calendarObj->getCalendarId(); ?>">Add</a></div>
                
            </div>
            
            <form name="manage_events" action="" method="post">
                <input type="hidden" name="operation" />
                <input type="hidden" name="events[]" value=0 />
                <div id="table_container">
                    <div id="table">
                        <div class="event_title_col1">
                            <div id="table_cell">#</div>
                        </div>
                        <div class="event_title_col2">
                            <div id="table_cell"><input type="checkbox" name="selectAll" onclick="javascript:selectCheckbox('manage_events','events[]');" /></div>
                        </div>
                        <div class="event_title_col3">
                            <div id="table_cell">Title</div>
                        </div>
                        <div class="event_title_col4">
                            <div id="table_cell">Date</div>
                        </div>
                        <div class="event_title_col5">
                            <div id="table_cell">Start Time</div>
                        </div>
                        <div class="event_title_col6">
                            <div id="table_cell">Published</div>
                        </div>
                        <div class="event_title_col7">
                            <div id="table_cell"></div>
                        </div>
                        <div id="empty"></div>
                        <?php                         
                        $arrayEvents = $listObj->getEventsList($_GET["calendar_id"]);                        
						$i=1;
						foreach($arrayEvents as $eventId => $event) {																			
							if($i % 2) {
								$class="alternate_table_row_white";
							} else {
								$class="alternate_table_row_grey";
							}
							
						?>
						<div id="row_<?php echo $eventId; ?>">
                            <div class="event_row_col1 <?php echo $class; ?>">
                                <div id="table_cell"><?php echo $i; ?></div>
                            </div>
                            <div class="event_row_col2 <?php echo $class; ?>">
                                <div id="table_cell"><input type="checkbox" name="events[]" value="<?php echo $eventId; ?>" onclick="javascript:disableSelectAll('manage_events',this.checked);" /></div>
                            </div>                    
                            <div class="event_row_col3 <?php echo $class; ?>">
                                <div id="table_cell">
									<?php echo $event["event_title"]; ?>								
                                </div>
                            </div>
                            <div class="event_row_col4 <?php echo $class; ?>">
                                <div id="table_cell">
									<?php echo strftime('%B %e %Y',strtotime($event["event_date_from"])); ?>
                                    <?php
									if($event["event_date_to"]!='0000-00-00') {
										?>
										<br /><?php echo strftime('%B %e %Y',strtotime($event["event_date_to"])); ?>	
										<?php
									}
									?>
                                </div>
                            </div>
                            <div class="event_row_col5 <?php echo $class; ?>">
                                <div id="table_cell">
                                	<?php
									if($event["event_starttime"] != '00:00:00') {
									  echo substr($event["event_starttime"],0,-3); 
									} else {
										echo "---"; 
									}?>								
                                </div>
                            </div>
                            <div class="event_row_col6 <?php echo $class; ?>">
                                <div id="table_cell"><span id="publish_<?php echo $eventId; ?>"><?php if($event["event_active"]=='1') { ?><a href="javascript:unpublishEvent(<?php echo $eventId; ?>);"><img src="images/icons/published.png" border=0 /></a><?php } else { ?><a href="javascript:publishEvent(<?php echo $eventId; ?>);"><img src="images/icons/unpublished.png" border=0 /></a><?php } ?></span>
                                </div>
                            </div>                       
                            <div class="event_row_col7 <?php echo $class; ?>">
                                <div id="table_cell"><a href="new_event.php?event_id=<?php echo $eventId; ?>&calendar_id=<?php echo $_GET["calendar_id"]; ?>">Modify</a></div>
                            </div>
                                                       
                           
                            <div id="empty"></div>
						</div>
						<?php 
						$i++;
						} ?>
                    </div>
                </div>
            </form>
            <div id="cleardiv"></div>
            <div id="rowspace"></div>
        </div>
    </div>
</div>
<?php
include 'include/footer.php';
?>