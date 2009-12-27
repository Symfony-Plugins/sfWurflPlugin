<?php

define("WURFL_DIR", 	dirname(__FILE__) . '/../../WURFL/');
define("RESOURCES_DIR", dirname(__FILE__) . "/../resources/");

require_once WURFL_DIR. 'WURFLManagerProvider.php';
require_once WURFL_DIR. 'Reloader/DefaultWURFLReloader.php';

$wurflConfigFile = RESOURCES_DIR . 'wurfl-config.xml';


$wurflReloader = new WURFL_Reloader_DefaultWURFLReloader();
$wurflReloader->reload($wurflConfigFile);


?>