<?php

class ZFExt_Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{

    public static function autoload($class) {
        include str_replace('_', '/', $class) . '.php';
        return $class;
    }

    protected function _initView()
    {
        $options = $this->getOptions();
        $config = $options['resources']['view'];
        if (isset($config)) {
            $view = new Zend_View($config);
        } else {
            $view = new Zend_View;
        }
        if (isset($config['doctype'])) {
            $view->doctype($config['doctype']);
        }
        if (isset($config['language'])) {
            $view->headMeta()->appendName('language', $config['language']);
        }
        if (isset($config['charset'])) {
            $view->headMeta()->setCharset($config['charset'], 'charset');
        }
        $viewRenderer = Zend_Controller_Action_HelperBroker::getStaticHelper(
            'ViewRenderer'
        );
        $viewRenderer->setView($view);
        return $view;
    }

    protected function _initModifiedFrontController()
    {
        $options = $this->getOptions();
        if (!isset($options['resources']['modifiedFrontController']['contentType'])) {
            return;
        }
        $this->bootstrap('FrontController');
        $front = $this->getResource('FrontController');
        $response = new Zend_Controller_Response_Http;
        $response->setHeader('Content-Type',
            $options['resources']['modifiedFrontController']['contentType'], true);
        $front->setResponse($response);
    }

}
