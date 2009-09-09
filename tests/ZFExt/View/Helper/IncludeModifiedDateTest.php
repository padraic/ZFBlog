<?php

class ZFExt_View_Helper_IncludeModifiedDateTest extends PHPUnit_Framework_TestCase
{

    protected $helper = null;

    private $cwd = null;

    public function setup()
    {
        $this->helper = new ZFExt_View_Helper_IncludeModifiedDate;
        $this->cwd = getcwd();
        chdir(dirname(__FILE__));
    }

    public function teardown()
    {
        chdir($this->cwd);
    }

    public function testAddsTimestampToFilenameBeforeFileExtension()
    {
        $file = '/_files/style.css';
        $timestamped = $this->helper->includeModifiedDate($file);
        $this->assertTrue((bool) preg_match("/^\/_files\/style\.\d{10,}\.css\$/", $timestamped));
    }

    public function testAddsTimestampToFilenameBeforeFileExtensionWithUriQueryString()
    {
        $file = '/_files/style.css?version=2.0';
        $timestamped = $this->helper->includeModifiedDate($file);
        $this->assertTrue((bool) preg_match("/^\/_files\/style\.\d{10,}\.css\?version=2\.0$/", $timestamped));
    }

}
