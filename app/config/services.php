<?php

use Phalcon\Mvc\Model\Metadata\Memory as MetaDataAdapter;
use Phalcon\Mvc\View\Engine\Volt as VoltEngine;
use Phalcon\Cache\Backend\Memcache;
use Phalcon\Cache\Frontend\Data as FrontData;

$di->setShared('config', function () {
    return include APP_PATH . "/config/config.php";
});

$di->setShared('db', function () {
    $config = $this->getConfig();

    $class  = 'Phalcon\Db\Adapter\Pdo\\' . $config->database->adapter;
    $params = [
        'host'     => $config->database->host,
        'username' => $config->database->username,
        'password' => $config->database->password,
        'dbname'   => $config->database->dbname,
        'charset'  => $config->database->charset
    ];

    if ($config->database->adapter == 'Postgresql') {
        unset($params['charset']);
    }

    $connection = new $class($params);

    return $connection;
});

$di->setShared('modelsMetadata', function () {
    return new MetaDataAdapter();
});

$di->setShared('voltShared', function ($view) {
    $config = $this->getConfig();

    $volt = new VoltEngine($view, $this);
    $volt->setOptions([
        'compiledPath'      => function ($templatePath) use ($config) {
            $basePath = $config->application->appDir;
            if ($basePath && substr($basePath, 0, 2) == '..') {
                $basePath = dirname(__DIR__);
            }

            $basePath     = realpath($basePath);
            $templatePath = trim(substr($templatePath, strlen($basePath)), '\\/');

            $filename = basename(str_replace(['\\', '/'], '_', $templatePath), '.volt') . '.php';

            $cacheDir = $config->application->cacheDir;
            if ($cacheDir && substr($cacheDir, 0, 2) == '..') {
                $cacheDir = __DIR__ . DIRECTORY_SEPARATOR . $cacheDir;
            }

            $cacheDir = realpath($cacheDir);

            if (!$cacheDir) {
                $cacheDir = sys_get_temp_dir();
            }

            if (!is_dir($cacheDir . DIRECTORY_SEPARATOR . 'volt')) {
                @mkdir($cacheDir . DIRECTORY_SEPARATOR . 'volt', 0755, true);
            }

            return $cacheDir . DIRECTORY_SEPARATOR . 'volt' . DIRECTORY_SEPARATOR . $filename;
        },
        'compileAlways'     => true,
        'compiledSeparator' => '_',
        'compiledExtension' => '.php'
    ]);

    return $volt;
});

$di->set('my-cache',function (){
    $frontCache = new FrontData(
        [
            "lifetime" => 172800,//2 days
        ]
    );
    $cache      = new Memcache(
        $frontCache,
        [
            'prefix' => 'cache',
            "host"   => "localhost",
            "port"   => 11211,
            //                "persistent" => false,
        ]
    );

    return $cache;
},true);
