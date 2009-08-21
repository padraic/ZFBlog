<?php

spl_autoload_register(create_function('$class',
"include str_replace('_', '/', \$class) . '.php';"
));

error_reporting( E_ALL | E_STRICT );

$root = dirname(__FILE__) . '/..';

/**
 * Set your own ZF path unless set in php.ini
 */
$path = array(
    '/home/padraic/projects/zf/trunk/library',
    $root . "/library",
    $root . "/tests",
    get_include_path()
);
set_include_path(implode(PATH_SEPARATOR, $path));

unset($root, $path);
