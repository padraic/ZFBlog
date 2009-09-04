<?php

class ZFExt_View_DoctypeHelperTest extends PHPUnit_Framework_TestCase
{

    protected $helper = null;

    public function setup()
    {
        $this->helper = new ZFExt_View_Helper_Doctype;
    }

    public function testRendersHtml5DoctypeForXhtmlSerialisation()
    {
        $this->helper->doctype('XHTML5');
        $this->assertEquals('<!DOCTYPE html>', (string) $this->helper);
    }

    public function testReturnsXhtmlDoctypeName()
    {
        $this->helper->doctype('XHTML5');
        $this->assertEquals('XHTML5', $this->helper->getDoctype());
    }

}
