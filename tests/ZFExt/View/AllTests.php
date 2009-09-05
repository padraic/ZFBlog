<?php

if (!defined('PHPUnit_MAIN_METHOD')) {
    define('PHPUnit_MAIN_METHOD', 'ZFExt_View_AllTests::main');
}

require_once dirname(__FILE__) . '/../../TestHelper.php';

require_once 'ZFExt/View/Helper/DoctypeTest.php';
require_once 'ZFExt/View/Helper/HeadMetaTest.php';
require_once 'ZFExt/View/Helper/AppendModifiedDateTest.php';

class ZFExt_View_AllTests
{
    public static function main()
    {
        PHPUnit_TextUI_TestRunner::run(self::suite());
    }

    public static function suite()
    {
        $suite = new PHPUnit_Framework_TestSuite('ZFSTDE Blog Suite: Models');

        $suite->addTestSuite('ZFExt_View_Helper_DoctypeTest');
        $suite->addTestSuite('ZFExt_View_Helper_HeadMetaTest');
        $suite->addTestSuite('ZFExt_View_Helper_AppendModifiedDateTest');

        return $suite;
    }
}

if (PHPUnit_MAIN_METHOD == 'ZFExt_View_AllTests::main') {
    ZFExt_View_AllTests::main();
}
