<?php

use Phalcon\Loader;

$loader = new Loader();

$loader->registerNamespaces([
    'Keis\Models' => APP_PATH . '/common/models/',
    'Keis'        => APP_PATH . '/common/library/',
]);

$loader->registerClasses([
    'Keis\Modules\Frontend\Module' => APP_PATH . '/modules/frontend/Module.php',
    'Keis\Modules\Cli\Module'      => APP_PATH . '/modules/cli/Module.php'
]);

$loader->registerFiles([
    BASE_PATH . '/vendor/autoload.php'
]);

$loader->register();

