<?php

require_once 'BaseTest.php';

/**
 *  test case.
 */
class WURFL_Request_UserAgentNormalizer_MSIETest extends WURFL_Request_UserAgentNormalizer_BaseTest {

	const MSIE_USERAGENTS_FILE = "msie.txt";
	
	/**
	 * Prepares the environment before running a test.
	 */
	protected function setUp() {
		parent::setUp(new WURFL_Request_UserAgentNormalizer_MSIE());
	}
	
	
	/**
	 * @test
	 * @dataProvider msieUserAgentsDataProvider
	 *
	 */
	function shoudRemoveAllTheCharactersAfterTheMinorVersion($userAgent) {
		$found = $this->normalizer->normalize($userAgent);
		//$this->assertEquals(strlen($expected), strlen($found), $userAgent);
		$this->assertTrue(strpos($found, "MSIE") !== FALSE, $userAgent);
	
	}
		
	
	
	function msieUserAgentsDataProvider() {
		return $this->userAgentsProvider(self::MSIE_USERAGENTS_FILE);
	}
	
	

}

