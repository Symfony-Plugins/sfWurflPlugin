<?php

/**
 *  test case.
 */
class WURFL_Hanlders_FirefoxHandlerTest extends PHPUnit_Framework_TestCase {
	
	private $firefoxHandler;
	
	function setUp() {
		$userAgentNormalizer = new WURFL_Request_UserAgentNormalizer_Firefox();
		$this->firefoxHandler = new WURFL_Handlers_FirefoxHandler($userAgentNormalizer);
	}
	
	
	function testShoudApplyRisWithFirstSlash() {
		$userAgent = "Mozilla/5.0 (Macintosh; U; Intel Mac OS X 10.5; nb-NO; rv:1.9b5) Gecko/2008032619 Firefox/3.0b5";
		$found = $this->firefoxHandler->match($userAgent);
		$expected = "firefox_3_0_mac_osx";	
		$this->assertEquals($expected, $found);
	}
	
	
	
}

