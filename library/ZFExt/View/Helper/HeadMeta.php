<?php

class ZFExt_View_Helper_HeadMeta extends Zend_View_Helper_HeadMeta
{

    protected $_typeKeys = array('name', 'http-equiv', 'charset');

    public function setCharset($charset)
    {
        $item = new stdClass;
        $item->type = 'charset';
        $item->charset = $charset;
        $item->content = null;
        $item->modifiers = array();
        $this->set($item);
        return $this;
    }

    protected function _isValid($item)
    {
        if ((!$item instanceof stdClass)
            || !isset($item->type)
            || !isset($item->modifiers))
        {
            return false;
        }

        $doctype = $this->view->doctype()->getDoctype();

        if (!isset($item->content)
        && (($doctype !== 'HTML5' && $doctype !== 'XHTML5')
        || (($doctype == 'HTML5' || $doctype == 'XHTML5') && $item->type !== 'charset'))
        ) {
            return false;
        }

        return true;
    }

    public function itemToString(stdClass $item)
    {
        if (!in_array($item->type, $this->_typeKeys)) {
            require_once 'Zend/View/Exception.php';
            throw new Zend_View_Exception(sprintf('Invalid type "%s" provided for meta', $item->type));
        }
        $type = $item->type;

        $modifiersString = '';
        foreach ($item->modifiers as $key => $value) {
            if (($this->view->doctype()->getDoctype() == 'HTML5'
            || $this->view->doctype()->getDoctype() == 'XHTML5')
            && $key == 'scheme') {
                require_once 'Zend/View/Exception.php';
                throw new Zend_View_Exception('Invalid modifier '
                . '"scheme" provided; not supported by HTML 5');
            }
            if (!in_array($key, $this->_modifierKeys)) {
                continue;
            }
            $modifiersString .= $key . '="' . $this->_escape($value) . '" ';
        }

        if ($this->view instanceof Zend_View_Abstract) {
            if ($this->view->doctype()->getDoctype() == 'XHTML5'
            && $type == 'charset') {
                $tpl = '<meta %s="%s"/>';
            } elseif ($this->view->doctype()->getDoctype() == 'HTML5'
            && $type == 'charset') {
                $tpl = '<meta %s="%s">';
            } elseif ($this->view->doctype()->isXhtml()) {
                $tpl = '<meta %s="%s" content="%s" %s/>';
            } else {
                $tpl = '<meta %s="%s" content="%s" %s>';
            }
        } else {
            $tpl = '<meta %s="%s" content="%s" %s/>';
        }

        $meta = sprintf(
            $tpl,
            $type,
            $this->_escape($item->$type),
            $this->_escape($item->content),
            $modifiersString
        );
        return $meta;
    }

}
