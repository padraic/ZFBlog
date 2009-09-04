<?php

class ZFExt_View_Helper_Doctype extends Zend_View_Helper_Doctype
{
    const XHTML5 = 'XHTML5';

    public function __construct()
    {
        parent::__construct();
        $this->_registry['doctypes'][self::XHTML5] = '<!DOCTYPE html>';
    }

    public function doctype($doctype = null)
    {
        if (null !== $doctype && $doctype == self::XHTML5) {
            $this->setDoctype($doctype);
        } else {
            parent::doctype($doctype);
        }
        return $this;
    }

}
