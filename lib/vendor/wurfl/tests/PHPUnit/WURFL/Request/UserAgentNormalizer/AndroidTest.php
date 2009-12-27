<?php

require_once 'BaseTest.php';

/**
 *  test case.
 */
class WURFL_Request_UserAgentNormalizer_AndroidTest extends WURFL_Request_UserAgentNormalizer_BaseTest {
	
	const ANDROID_USERAGENTS_FILE = "android.txt";
	
	function setUp() {
		parent::setUp ( new WURFL_Request_UserAgentNormalizer_Android ( ) );
	}
	
	/**
	 * @test
	 * @dataProvider androidUserAgentsProvider
	 */
	function shoudReturnAndroindWithMajorAndMinorVersion($userAgent) {
		$expected = "Android/M.m";
		$found = $this->normalizer->normalize ( $userAgent );
		$this->assertEquals ( strlen ( $expected ), strlen ( $found ), $userAgent );
		$this->assertTrue ( strpos ( $found, "Android" ) !== FALSE, $userAgent );
	
	}
	
	function androidUserAgentsProvider() {
		return $this->userAgentsProvider ( self::ANDROID_USERAGENTS_FILE );
	}

}

