<?php



/**
 *  test case.
 */
class WURFL_Request_UserAgentNormalizer_SafariTest extends WURFL_Request_UserAgentNormalizer_BaseTest {
	
	const SAFARI_USERAGENTS_FILE = "safari.txt";
	
	private $safariNormalizer;
	
	function setUp() {		
		$this->safariNormalizer = new WURFL_Request_UserAgentNormalizer_Safari();
	}
	

	/**
	 * @test
	 */
	function shoudReturnTheTypeWithTheSafariMajorVersion() {
		$userAgent = "Mozilla/5.0 (Macintosh; U; Intel Mac OS X 10_5_6; en-us) AppleWebKit/525.27.1 (KHTML, like Gecko) Version/3.2.1 Safari/525.27.1";
		$expected = "Mozilla/5.0 (Macintosh; U; Safari/525";
		$found = $this->safariNormalizer->normalize($userAgent);
		$this->assertEquals($expected, $found, $found);
			
	}
	
	
		
	function safariUserAgentsProvider() {		
		return $this->userAgentsProvider(self::SAFARI_USERAGENTS_FILE);
	}
		
		
}

