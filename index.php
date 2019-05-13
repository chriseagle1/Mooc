<?php
define('BASEDIR', __DIR__);
define('DS', DIRECTORY_SEPARATOR);

include 'Libs/Loader.php';
spl_autoload_register([new Libs\Loader, 'autoloader']);

$ctrl = new \Libs\Controller();
$ctrl->run();