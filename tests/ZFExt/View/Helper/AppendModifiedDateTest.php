<?php

class ZFExt_View_Helper_AppendModifiedDateTest extends PHPUnit_Framework_TestCase
{

    protected $helper = null;

    private $cwd = null;

    public function setup()
    {
        $this->helper = new ZFExt_View_Helper_AppendModifiedDate;
        $this->cwd = getcwd();
        chdir(dirname(__FILE__));
    }

    public function teardown()
    {
        chdir($this->cwd);
    }

    public function testAddsTimestampQueryStringToStaticFileUri()
    {
        $file = '/_files/style.css';
        $timestamped = $this->helper->appendModifiedDate($file);
        $this->assertTrue((bool) preg_match("/^\/_files\/style\.css\?\d{10,}$/", $timestamped));
    }

    public function testAddsTimestampQueryStringToExistingStaticFileUriQueryString()
    {
        $file = '/_files/style.css?version=2.0';
        $timestamped = $this->helper->appendModifiedDate($file);
        $this->assertTrue((bool) preg_match("/^\/_files\/style\.css\?version=2\.0&\d{10,}$/", $timestamped));
    }

}
