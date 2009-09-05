<?php

class ZFExt_View_Helper_HeadMetaTest extends PHPUnit_Framework_TestCase
{

    protected $helper = null;

    protected $view = null;

    public function setup()
    {
        foreach (array(Zend_View_Helper_Placeholder_Registry::REGISTRY_KEY, 'Zend_View_Helper_Doctype') as $key) {
            if (Zend_Registry::isRegistered($key)) {
                $registry = Zend_Registry::getInstance();
                unset($registry[$key]);
            }
        }
        /**
         * This custom helper only concerns (X)HTML 5 support
         * using the ZFExt doctype helper for the XHTML flavour
         */
        $this->view = new Zend_View();
        $this->view->addHelperPath('ZFExt/View/Helper', 'ZFExt_View_Helper');
        $this->view->doctype('HTML5');
        $this->helper = new ZFExt_View_Helper_HeadMeta();
        $this->helper->setView($this->view);
    }

    public function testRendersHtml5CharsetMetaElement()
    {
        $this->helper->setCharset('utf-8');
        $this->assertEquals('<meta charset="utf-8">', (string) $this->helper);
    }

    public function testRendersXhtml5CharsetMetaElement()
    {
        $this->view->doctype('XHTML5');
        $this->helper->setCharset('utf-8');
        $this->assertEquals('<meta charset="utf-8"/>', (string) $this->helper);
    }

    public function testPreventsUseOfSchemeAttributeWithHtml5()
    {
        try {
            $this->helper->setName('language', 'en', array('scheme'=>'somescheme'));
            $this->fail();
        } catch (Zend_View_Exception $e) {
        }
    }

    public function testPreventsUseOfSchemeAttributeWithXhtml5()
    {
        try {
            $this->view->doctype('XHTML5');
            $this->helper->setName('language', 'en', array('scheme'=>'somescheme'));
            $this->fail();
        } catch (Zend_View_Exception $e) {
        }
    }

}
