<?php
namespace Libs;

class Loader {
    public function autoloader($class) {
        $classPath = BASEDIR . DS . str_replace('\\', DS, $class) . '.php';
        if (file_exists($classPath)) {
            require $classPath;
        }
    }
}