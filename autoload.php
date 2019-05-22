<?php
require 'vendor/autoload.php';
function poloDcApiLoader($class)
{
    $path = str_replace('PoloDcApi\\', '', $class);
    $path = str_replace('\\', DIRECTORY_SEPARATOR, $path);
    $file = __DIR__ . DIRECTORY_SEPARATOR .'src'. DIRECTORY_SEPARATOR . $path . '.php';
//    var_dump($file, file_exists($file));
    if (file_exists($file)) {
        require_once $file;
    }
}
spl_autoload_register('poloDcApiLoader');
