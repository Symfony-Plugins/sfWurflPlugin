<?php


require_once 'BaseTest.php';

/**
 *  test case.
 */
class WURFL_Request_UserAgentNormalizer_ChromeTest extends WURFL_Request_UserAgentNormalizer_BaseTest  {
	
	const CHROME_USERAGENTS_FILE = "chrome.txt";
	
	private $firefoxNormalizer;
	
	function setUp() {		
		parent::setUp(new WURFL_Request_UserAgentNormalizer_Chrome());
	}
	

	/**
	 * @test
	 * @dataProvider chromeUserAgentsDataProvider
	 *
	 */
	function shoudReturnOnlyFirefoxStringWithTheMajorVersion($userAgent) {
		$expected = "Chrome/X";
		$found = $this->normalizer->normalize($userAgent);
		$this->assertEquals(strlen($expected), strlen($found), $userAgent);
		$this->assertTrue(strpos($found, "Chrome/") !== FALSE, $userAgent);
	
	}
		
	
	function chromeUserAgentsDataProvider() {
		return $this->userAgentsProvider(self::CHROME_USERAGENTS_FILE);
	}
		
		
}

