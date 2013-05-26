<?php
include 'common.php';
if(!isset($_SESSION["admin_id"]) || $_SESSION["admin_id"] == 0) {
	header('Location: login.php');
}
include 'include/header.php';
?>

<div id="top_bg_container_all">
    <div id="container_all">
        <div id="container_content">
        	<?php
            include 'include/menu.php';
			?>        
            <!-- welcome -->
            <div id="welcome_container">
                <div class="logo_pieve"><img src="images/logo_admin.gif"  /></div>
                <div class="welcome_text"><p>WELCOME TO EVENTS CALENDAR CONTROL PANEL<br />Use the menu above to manage all configurations and contents</p></div>
                <?php
				if(($settingObj->getSiteDomain() == '') || count($listObj->getCalendarsList()) == 0 ) {
					?>
                    <div class="welcome_text" style="padding: 15px; background-color: #ccc; color: #000;"><p>Hey Admin,<br />
                    it seems like you did not adjust the settings and created a calendar yet.<br />
                    Remember, <strong>if you skip these two steps, the Events Calendar cannot work.</strong><br />
                    Let's go to start now!</p></div>
                    <?php
				}
				?>
            </div>
        
        
        </div>
    </div>
</div>
<?php 
include 'include/footer.php';
?>