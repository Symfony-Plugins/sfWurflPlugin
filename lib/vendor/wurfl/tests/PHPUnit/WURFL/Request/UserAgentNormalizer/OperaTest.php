<?php


require_once 'BaseTest.php';

/**
 *  test case.
 */
class WURFL_Request_UserAgentNormalizer_OperaTest extends WURFL_Request_UserAgentNormalizer_BaseTest {
	
	const OPERA_USERAGENTS_FILE = "opera.txt";
	
	
	function setUp() {		
		parent::setUp(new WURFL_Request_UserAgentNormalizer_Opera()); 
	}
	

	/**
	 * @test
	 * @dataProvider operaUserAgentsDataProvider
	 *
	 */
	function shoudReturnOnlyFirefoxStringWithTheMajorVersion($userAgent) {
		$expected = "Opera/M";
		$found = $this->normalizer->normalize($userAgent);
		$this->assertEquals(strlen($expected), strlen($found), $userAgent);
		$this->assertTrue(strpos($found, "Opera/") !== FALSE, $userAgent);
	
	}
		
		
	function operaUserAgentsDataProvider() {
		return $this->userAgentsProvider(self::OPERA_USERAGENTS_FILE);
	}
	
		
}

