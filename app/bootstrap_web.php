<?php

use Phalcon\Di\FactoryDefault;
use Phalcon\Mvc\Application;

error_reporting(E_ALL);

define('BASE_PATH', dirname(__DIR__));
define('APP_PATH', BASE_PATH . '/app');

try {
    $di = new FactoryDefault();

    require APP_PATH . '/config/services.php';

    require APP_PATH . '/config/services_web.php';

    $config = $di->getConfig();

    include APP_PATH . '/config/loader.php';

    $application = new Application($di);
//TODO start services
    $application->registerModules([
        'frontend' => ['className' => 'Keis\Modules\Frontend\Module'],
    ]);

    require APP_PATH . '/config/routes.php';

    echo str_replace(["\n","\r","\t"], '', $application->handle()->getContent());

} catch (\Exception $e) {
    echo $e->getMessage() . '<br>';
    echo '<pre>' . $e->getTraceAsString() . '</pre>';
}
