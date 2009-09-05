<?php

if (!defined('PHPUnit_MAIN_METHOD')) {
    define('PHPUnit_MAIN_METHOD', 'ZFExt_AllTests::main');
}

require_once dirname(__FILE__) . '/../TestHelper.php';

require_once 'ZFExt/Model/AllTests.php';
require_once 'ZFExt/View/AllTests.php';

class ZFExt_AllTests
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

if (PHPUnit_MAIN_METHOD == 'ZFExt_AllTests::main') {
    ZFExt_AllTests::main();
}
