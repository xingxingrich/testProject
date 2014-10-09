<?php
require_once 'Testing/Selenium.php';
require_once 'PHPUnit/Framework/TestCase.php';

class BugTest extends PHPUnit_Framework_TestCase
{
    private $selenium;

    public function __construct()
    {
        $this->browserUrl = "http://www.ganchiku.com/selenium/tests";
        parent::__construct();
    }
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
        try {
            $this->selenium = new Testing_Selenium("*firefox", $this->browserUrl);
            $this->selenium->start();
        } catch (Testing_Selenium_Exception $e) {
            $this->selenium->stop();
            echo $e;
        }
    }

    public function tearDown()
    {
        if (isset($this->selenium)) {
            try {
                $this->selenium->stop();
            } catch (Testing_Selenium_Exception $e) {
                echo $e;
            }
        }
    }
    // {{{ Bug #8893
    public function test8893()
    {
        try {
            $this->selenium->open($this->browserUrl . '/html/bug8893.html');

            // The default is glob
            $this->assertFalse($this->selenium->isTextPresent('Foo'));
            $this->assertTrue($this->selenium->isTextPresent('This*'));
            $this->assertTrue($this->selenium->isTextPresent('This?is'));
            $this->assertTrue($this->selenium->isTextPresent('T?????'));

            // To use JavaScrpt regexp, speicify regexp: as follows:
            $this->assertTrue($this->selenium->isTextPresent('regexp:^This'));
            $this->assertTrue($this->selenium->isTextPresent('regexp:^Th.s'));

        } catch (Selenium_Exception $e) {
            echo $e;
        }
    }
    // }}}

    // {{{ Bug #9119
    public function test9119()
    {
        try {
            $this->selenium->open($this->browserUrl . '/html/bug9119.html');
            $this->selenium->click('link=foo#bar');
            $this->assertTrue($this->selenium->isAlertPresent());
        } catch (Selenium_Exception $e) {
            echo $e;
        }
    }
    // }}}

    // {{{ Bug #9189 TODO
    // "&" will be escaped when passing Selenium RC Server... So &nbsp; will be &amp;nbsp;
    public function test9189()
    {
        try {
            $this->selenium->open($this->browserUrl . '/html/bug9189.html');
            $this->selenium->select('parent_cat', ' Test Category 001');
            $this->assertEquals('Test Category 001', $this->selenium->getSelectedLabel('parent_cat'));
            //            $selenium->select('parent_cat', '&nbsp;Test Category 001-1');
            //            $this->assertEquals('&Test Category 001-1', $selenium->getSelectedLabel('parent_cat'));
        } catch (Selenium_Exception $e) {
            echo $e;
        }
    }
}
?>
