<?php

define("WURFL_DIR", 	dirname(__FILE__) . '/../../../WURFL/');
define("RESOURCES_DIR", dirname(__FILE__) . "/../../resources/");

require_once WURFL_DIR. 'WURFLManagerProvider.php';

$wurflConfigFile = RESOURCES_DIR . 'wurfl-config.xml';

$wurflManager = WURFL_WURFLManagerProvider::getWURFLManager($wurflConfigFile);	
	


?>