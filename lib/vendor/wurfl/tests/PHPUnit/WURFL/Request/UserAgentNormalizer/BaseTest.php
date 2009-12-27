<?php

/**
 *  test case.
 */
class WURFL_Request_UserAgentNormalizer_BaseTest extends PHPUnit_Framework_TestCase {
	
	protected $normalizer;
	
	protected function setUp($normalizer) {
		$this->normalizer = $normalizer;
	}
	
	protected function userAgentsProvider($testFilePath) {
		
		$fullTestFilePath = dirname ( __FILE__ ) . DIRECTORY_SEPARATOR . $testFilePath;
				
		return WURFL_TestUtils::loadUserAgentsAsArray($fullTestFilePath);		

	}

}

