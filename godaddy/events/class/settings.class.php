<?php

class setting {
	
	private function doSettingQuery($setting) {
		$settingQry = mysql_query("SELECT * FROM events_config WHERE config_name='".$setting."'");
		return mysql_result($settingQry,0,'config_value');
	}
	
	
	public function getTimezone() {
		return setting::doSettingQuery('timezone');
	}
	
	public function getSiteDomain() {
		return setting::doSettingQuery('site_domain');
	}
	
	public function getEventsPopupEnabled() {
		return setting::doSettingQuery('events_popup_enabled');
	}
	
	public function getDateFormat() {
		return setting::doSettingQuery('date_format');
	}
	
	public function getTimeFormat() {
		return setting::doSettingQuery('time_format');
	}
	
	public function getTwitterApprovation() {
		return stripslashes(setting::doSettingQuery('twitter_approvation'));
	}
	
	public function getTwitterEmail() {
		return stripslashes(setting::doSettingQuery('twitter_email'));
	}
	
	public function getFlickrApiKey() {
		return stripslashes(setting::doSettingQuery('flickr_api_key'));
	}
	
	public function getMetatagTitle() {
		return stripslashes(setting::doSettingQuery('metatag_title'));
	}
	
	public function getMetatagDescription() {
		return stripslashes(setting::doSettingQuery('metatag_description'));
	}
	
	public function getMetatagKeywords() {
		return stripslashes(setting::doSettingQuery('metatag_keywords'));
	}
	
	public function getPageTitle() {
		return stripslashes(setting::doSettingQuery('page_title'));
	}
	
	

}

?>