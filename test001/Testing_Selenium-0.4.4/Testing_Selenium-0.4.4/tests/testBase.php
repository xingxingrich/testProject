<?php
//set_include_path(get_include_path() . PATH_SEPARATOR . './PEAR/');
//require_once __DIR__.'/Testing_Selenium-0.4.4/Testing_Selenium-0.4.4/Testing/Selenium.php';

require_once 'Testing/Selenium.php';
require_once 'PHPUnit/Framework/TestCase.php';

class testBase extends PHPUnit_Framework_TestCase {
	private $selenium;
	public function setUp() {
		
		try {
			$this->selenium = new Testing_Selenium ( "*firefox", "http://www.soso.com" ); // $this->browserUrl);
			
			$this->selenium->start ();
		} catch ( Testing_Selenium_Exception $e ) {
			$this->selenium->stop ();
			echo $e;
		}
	}
	function testMyTestCase() {
		$this->selenium->open ( "/" );
		$this->selenium->type("smart_input", "xxx");
		$this->selenium->click("//input[@value='หั ห๗']");
		$this->selenium->waitForPageToLoad("30000");
			$this->assertEquals("xxx",$this->selenium->getValue("//input[@id='smart_input']"));
		$this->assertNotNull($this->selenium->getText("//div[@id='zdq_bingo']"));
		echo mb_convert_encoding($this->selenium->getText("//div[@id='zdq_bingo']"),'gbk','utf8');
		//print "Hello World!";
		
	}
	public function tearDown()
	{
		$this->selenium->stop();
	}
}
