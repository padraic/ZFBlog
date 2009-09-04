<?php

if (!defined('PHPUnit_MAIN_METHOD')) {
    define('PHPUnit_MAIN_METHOD', 'AllTests::main');
}

require_once 'TestHelper.php';

require_once 'ZFExt/Model/AllTests.php';
require_once 'ZFExt/View/AllTests.php';

class AllTests
{
    public static function main()
    {
        PHPUnit_TextUI_TestRunner::run(self::suite());
    }

    public static function suite()
    {
        $suite = new PHPUnit_Framework_TestSuite('ZFSTDE Blog Suite');

        $suite->addTest(ZFExt_Model_AllTests::suite());
        $suite->addTest(ZFExt_View_AllTests::suite());

        return $suite;
    }
}

if (PHPUnit_MAIN_METHOD == 'AllTests::main') {
    AllTests::main();
}
