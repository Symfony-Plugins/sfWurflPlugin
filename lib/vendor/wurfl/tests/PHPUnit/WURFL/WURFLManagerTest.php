<?php

require_once 'PHPUnit/Framework.php';

require_once dirname(__FILE__) . '/../../../WURFL/WURFLManagerProvider.php';

require_once 'TestUtils.php';

class WURFL_WURFLManagerTest extends PHPUnit_Framework_TestCase {

	protected $wurflManager;
	
	const DEVICE_CAPABILITY_TEST_DATA_FILE = "../../resources/device-capability.yml";
	const TEST_DATA_FILE = "../../resources/unit-test.yml";
	const TEST_DATA_FILE = "../../resources/unit-test-single.yml";
	//const WURFL_CONFIG_FILE = "../../resources/new/wurfl-config.xml";

	
	const USERAGENTS_FOR_PERFORMANCE = "../../resources/ualist.txt";
	
	protected function setUp() {
		$configFilePath = dirname(__FILE__) . DIRECTORY_SEPARATOR .  self::WURFL_CONFIG_FILE;
		$this->wurflManager = WURFL_WURFLManagerProvider::getWURFLManager($configFilePath);	
	}

	
	/**
	 * @test
	 * 
	 */
	public function wurflManagerShoudBeInitlialized() {
		$this->assertNotNull($this->wurflManager);
	}
	
	
			
	/**
	 * @test
	 * @dataProvider userAgentDeviceIdsProvider
	 */
	public function getDeviceForUserAgent($userAgent, $deviceId) {
		$deviceFound = $this->wurflManager->getDeviceForUserAgent($userAgent);	
		$this->assertEquals($deviceFound->id, $deviceId, $userAgent);
	}
	
	/**
	 * @test
	 * @dataProvider deviceIdCapabilityNameCapabilityValueProvider
	 */
	public function getCapability($deviceId, $groupId, $capabilityName, $capabilityValue) {
		$device = $this->wurflManager->getDevice($deviceId);
		$capabilityFound = $device->getCapability($capabilityName);
		
		$this->assertEquals($capabilityValue, $capabilityFound, "$deviceId");
	}


	
	/**
	 * @test
	 *
	 */
	public function shoudReturnAllTheGroupsDefinedInActualWURFL() {
		$actualGroups = array("product_info", "wml_ui", "chtml_ui", "xhtml_ui", "markup", "cache", "display", "image_format");	
		$listOfGroups = $this->wurflManager->getListOfGroups();
		foreach ($actualGroups as $groupId) {
			$this->assertContains($groupId, $listOfGroups);
		}				
	}
	

	public static function deviceIdCapabilityNameCapabilityValueProvider() {
		$fileName =  (dirname(__FILE__) . DIRECTORY_SEPARATOR . self::DEVICE_CAPABILITY_TEST_DATA_FILE);

		$testData = array();

		$file_handle = fopen($fileName, "r");
		while (!feof($file_handle)) {
			$line = fgets($file_handle);
			if(strpos($line, "#") === false && strcmp($line, "\n") != 0) {
				$testData[] = explode(":", trim($line));
			}
		}
		fclose($file_handle);

		return $testData;
	}
	
	
	
	public static function userAgentDeviceIdsProvider() {		
		$filePath =  (dirname ( __FILE__ ) . DIRECTORY_SEPARATOR . self::TEST_DATA_FILE);
		return  WURFL_TestUtils::loadUserAgentsWithIdFromFile($filePath);
	}
	
	
	public function __destruct() {
		$this->wurflManager = NULL;
	}
	
	

}

?>