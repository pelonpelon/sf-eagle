<?php
include 'common.php';
if(!isset($_SESSION["admin_id"]) || $_SESSION["admin_id"] == 0) {
	header('Location: login.php');
}
if(isset($_POST["timezone"])) {	
	$settingObj->updateSettings();
	header('Location: welcome.php');	
}

$arrayTimezones = $listObj->getTimezonesList();
include 'include/header.php';
?>

<div id="top_bg_container_all">
    <div id="container_all">
        <div id="container_content">
        <?php
        include 'include/menu.php'; 
        ?>
        <div id="form_container">
        	<form name="editsettings" action="" method="post" tmt:validate="true" enctype="multipart/form-data">           
                
                <div id="label_input">
                    <div class="label_title"><label for="site_domain">Absolute path of Events Calendar installation.</label></div>
                    <div class="label_subtitle">For example if you place the Events App in your root in a folder named "events", path will be <strong>http://www.yoursite.com/events</strong><br /> (url <strong>MUST</strong> starting with "http://" <strong>WITHOUT</strong> final "/")</div>
                </div>
                <div id="input_box">
                    <input type="text" class="long_input_box" id="site_domain" name="site_domain" value="<?php echo $settingObj->getSiteDomain(); ?>">
                   
                </div>
                <div id="rowspace"></div>
                <div id="rowline"></div>
                <div id="rowspace"></div>
                
                <div id="label_input">
                    <div class="label_title"><label for="timezone">Timezone</label></div>
                    <div class="label_subtitle">Your timezone to highlight the right day when visitors load your calendars</div>
                </div>
                <div id="input_box">
                	<select name="timezone" id="timezone">
                    	<?php
						foreach($arrayTimezones as $timezoneid => $timezone) {
						?>
                        	<option value="<?php echo $timezone["timezone_value"]; ?>" <?php if(trim($settingObj->getTimezone()) == trim($timezone["timezone_value"])) { echo 'selected="selected"'; }?>><?php echo $timezone["timezone_name"]; ?></option>
						<?php
						}
						?>
                    </select>
                  
                </div>
                <div id="rowspace"></div>
                <div id="rowline"></div>
                <div id="rowspace"></div>
                <div id="label_input">
                    <div class="label_title"><label for="date_format">Choose calendar date format.</label></div>
                    <div class="label_subtitle">Switch between US and UK date formats</div>
                </div>
                <div id="input_box">
                   <select name="date_format" style="width:300px">
                   	 <option value="UK" <?php if($settingObj->getDateFormat()=="UK") { echo "selected"; }?>>UK - dd/mm/yyyy - week starts on Monday</option>
                     <option value="US" <?php if($settingObj->getDateFormat()=="US") { echo "selected"; }?>>US - mm/dd/yyyy - week starts on Sunday</option>
                   </select>
                </div>
                <div id="rowspace"></div>
                <div id="rowline"></div>
                <div id="rowspace"></div>
                <!-- 
                =======================
                === Time format ==
                =======================
                -->
                <div id="label_input">
                    <div class="label_title"><label for="time_format">Choose calendar time format.</label></div>
                    <div class="label_subtitle">Switch between 12-hour and 24-hour time formats</div>
                </div>
                <div id="input_box">
                   <select name="time_format" style="width:300px">
                   	 <option value="12" <?php if($settingObj->getTimeFormat()=="12") { echo "selected"; }?>>12-hour time format with am/pm</option>
                     <option value="24" <?php if($settingObj->getTimeFormat()=="24") { echo "selected"; }?>>24-hour time format</option>
                   </select>
                </div>
                <div id="rowspace"></div>
                <div id="rowline"></div>
                <div id="rowspace"></div>
                <script>
					function toggleEmailField(approvation) {
						if(approvation == 1) {
							$('#approvation_email').fadeIn();
						} else {
							$('#approvation_email').fadeOut();
						}
					}
					$(function() {
						<?php 
						if($settingObj->getTwitterApprovation() == 1) {
							?>
							$('#approvation_email').fadeIn();
							<?php
						}
						?>
					});
				</script>
                <div id="label_input">
                    <div class="label_title"><label for="twitter_approvation">Twitter approvation</label></div>
                    <div class="label_subtitle">Choose to approve or not tweets before they're visible on your events</div>
                </div>
                <div id="input_box">
                   <select name="twitter_approvation" onchange="javascript:toggleEmailField(this.options[this.selectedIndex].value);">
                   	 <option value="1" <?php if($settingObj->getTwitterApprovation()=="1") { echo "selected"; }?>>YES</option>
                     <option value="0" <?php if($settingObj->getTwitterApprovation()=="0") { echo "selected"; }?>>NO</option>
                   </select>
                   <div id="approvation_email" style="display:none">
                   		Insert an email if you want to receive new tweets to be approved:&nbsp;<input type="text" name="twitter_email" value="<?php echo $settingObj->getTwitterEmail(); ?>" />
                   </div>
                </div>
                <div id="rowspace"></div>
                <div id="rowline"></div>
                <div id="rowspace"></div>
                
                <div id="label_input">
                    <div class="label_title"><label for="flickr_api_key">Flickr API Key</label></div>
                    <div class="label_subtitle">Get a <a href="http://www.flickr.com/services/apps/create/apply" target="_blank">Flickr API</a> Key to show images related to your event</div>
                </div>
                <div id="input_box">
                	 <input type="text" class="long_input_box" id="flickr_api_key" name="flickr_api_key" value="<?php echo $settingObj->getFlickrApiKey(); ?>">
                   
                </div>
                <div id="rowspace"></div>
                <div id="rowline"></div>
                <div id="rowspace"></div>
                <!-- 
                =======================
                === events popup ==
                =======================
                -->
                <div id="label_input">
                    <div class="label_title"><label for="events_popup_enabled">Available events preview</label></div>
                    <div class="label_subtitle">Show the preview of available events on calendar days rollover</div>
                </div>
                <div id="rowspace"></div>
                <div >
                	<input type="radio" name="events_popup_enabled" id="events_popup_enabled" value="1" <?php if($settingObj->getEventsPopupEnabled() == 1) { echo "checked"; } ?>/>&nbsp;enabled&nbsp;&nbsp;<input type="radio" name="events_popup_enabled" id="events_popup_enabled" value="0" <?php if($settingObj->getEventsPopupEnabled() == 0) { echo "checked"; } ?>/>&nbsp;disabled
                </div>
                
                
                <div id="rowspace"></div>
                <div id="rowline"></div>
                <div id="rowspace"></div>
                
                
                
                <!-- bridge buttons -->
                <div class="bridge_buttons_container">
                    <!-- cancel -->
                    <div class="admin_button cancel_button" ><a href="javascript:document.location.href='welcome.php';"></a></div>
                    
                    <!-- save -->
                    <div class="admin_button" style="margin-left:750px;"><input type="submit" id="apply_button" style="background-color: #333;" name="saveunpublish" value=""></div>
                    
                </div>
                <div id="rowspace"></div>
             </form>
            
         </div>
        
        
        </div>
    </div>
</div>
<?php 
include 'include/footer.php';
?>