<?php

define('RESOURCES_DIR', dirname(__FILE__) . '/../../resources');


$wurfl['main-file'] = RESOURCES_DIR . "/wurfl-regression.zip";
$wurfl['patches'] = array(RESOURCES_DIR . "/new_web_browsers_patch.xml", RESOURCES_DIR."/spv_patch.xml");


$persistence['provider'] = "memcache";
$persistence['params'] = array(
	"dir" => "../cache"
);

$cache['provider'] = "null";


$configuration["wurfl"] = $wurfl;
$configuration["persistence"] = $persistence;
$configuration["cache"] = $cache;




?>