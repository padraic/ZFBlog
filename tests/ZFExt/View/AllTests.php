<?php

if (!defined('PHPUnit_MAIN_METHOD')) {
    define('PHPUnit_MAIN_METHOD', 'ZFExt_View_AllTests::main');
}

require_once '../../TestHelper.php';

require_once 'ZFExt/View/DoctypeHelperTest.php';
require_once 'ZFExt/View/HeadMetaHelperTest.php';

class ZFExt_Model_AllTests
{
    public static function main()
    {
        PHPUnit_TextUI_TestRunner::run(self::suite());
    }

    public static function suite()
    {
        $suite = new PHPUnit_Framework_TestSuite('ZFSTDE Blog Suite: Models');

        $suite->addTestSuite('ZFExt_View_DoctypeHelperTest');
        $suite->addTestSuite('ZFExt_View_HeadMetaHelperTest');

        return $suite;
    }
}

if (PHPUnit_MAIN_METHOD == 'ZFExt_View_AllTests::main') {
    ZFExt_View_AllTests::main();
}
