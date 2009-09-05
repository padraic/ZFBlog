<?php

class ZFExt_View_Helper_AppendModifiedDate extends Zend_View_Helper_Abstract
{

    public function appendModifiedDate($uri) {
        $parts = parse_url($uri);
        $root = getcwd();
        $mtime = filemtime($root . $parts['path']);
        if (isset($parts['query'])) {
            $query = '&' . $mtime;
        } else {
            $query = '?' . $mtime;
        }
        return $uri . $query;
    }

}
