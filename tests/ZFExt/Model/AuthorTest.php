<?php

class ZFExt_Model_AuthorTest extends PHPUnit_Framework_TestCase
{

    public function testSetsAllowedDomainObjectProperty()
    {
        $author = new ZFExt_Model_Author;
        $author->fullname = 'Joe';
        $this->assertEquals('Joe', $author->fullname);
    }

    public function testConstructorInjectionOfProperties()
    {
        $data = array(
            'username' => 'joe_bloggs',
            'fullname' => 'Joe Bloggs',
            'email' => 'joe@example.com',
            'url' => 'http://www.example.com'
        );
        $author = new ZFExt_Model_Author($data);
        $expected = $data;
        $expected['id'] = null;
        $this->assertEquals($expected, $author->toArray());
    }

    public function testReturnsIssetStatusOfProperties()
    {
        $author = new ZFExt_Model_Author;
        $author->fullname = 'Joe Bloggs';
        $this->assertTrue(isset($author->fullname));
    }

    public function testCanUnsetAnyProperties()
    {
        $author = new ZFExt_Model_Author;
        $author->fullname = 'Joe Bloggs';
        unset($author->fullname);
        $this->assertFalse(isset($author->fullname));
    }

    public function testCannotSetNewPropertiesUnlessDefinedInClass()
    {
        $author = new ZFExt_Model_Author;
        try {
            $author->notdefinedinclass = 1;
            $this->fail('Setting new property not defined in class should'
            . ' have raised an Exception');
        } catch (ZFExt_Model_Exception $e) {
        }
    }

}
