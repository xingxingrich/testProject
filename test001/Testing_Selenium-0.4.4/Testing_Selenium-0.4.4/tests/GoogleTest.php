<?php


require_once 'Testing/Selenium.php';
require_once 'PHPUnit/Framework/TestCase.php';

class GoogleTest extends PHPUnit_Framework_TestCase
{
    private $selenium;

    public function setUp()
    {
        $errno = null;
        $errstr = null;
        $resource = @fsockopen('127.0.0.1', 4444, $errno, $errstr, 10);
        if (!$resource) {
            $this->markTestSkipped($errstr);
        } else {
            fclose($resource);
        }
        $this->selenium = new Testing_Selenium("*firefox", "http://www.google.com");
        $this->selenium->start();
    }

    public function tearDown()
    {
        if (isset($this->selenium)) {
            $this->selenium->stop();
        }
    }

    public function testGoogle()
    {
        $this->selenium->open("/");
        $this->selenium->type("q", "hello world");
        $this->selenium->click("btnG");
        $this->selenium->waitForPageToLoad(10000);
        $this->assertRegExp("/Google Search/", $this->selenium->getTitle());
    }

}
?>
