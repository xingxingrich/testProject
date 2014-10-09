<?php
// Commands are tested in Selenium RC build, and all commands are generated using XSLT.
// So this tests only if basic commands work.
if (!defined('PHPUnit_MAIN_METHOD')) {
    define('PHPUnit_MAIN_METHOD', 'Testing_Selenium_AllTests::main');
}
 
require_once 'PHPUnit/Framework.php';
require_once 'PHPUnit/TextUI/TestRunner.php';

require_once 'SeleniumTest.php';
require_once 'GoogleTest.php';
require_once 'BugTest.php';
 
class Testing_Selenium_AllTests
{
    public static function main()
    {
        PHPUnit_TextUI_TestRunner::run(self::suite());
    }
 
    public static function suite()
    {
        $suite = new PHPUnit_Framework_TestSuite('PHPUnit Framework');
        $suite->addTestSuite('SeleniumTest');
        $suite->addTestSuite('GoogleTest');
        $suite->addTestSuite('BugTest');
 
        return $suite;
    }
}
 
if (PHPUnit_MAIN_METHOD == 'Testing_Selenium_AllTests::main') {
    Testing_Selenium_AllTests::main();
}
?>
