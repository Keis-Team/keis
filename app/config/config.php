<?php

use Phalcon\Config;
use Phalcon\Logger;

defined('BASE_PATH') || define('BASE_PATH', getenv('BASE_PATH') ?: realpath(dirname(__FILE__) . '/../..'));
defined('APP_PATH') || define('APP_PATH', BASE_PATH . '/app');

return new Config([
    'database' => [
        'adapter' => 'Mysql',
        'host' => '127.0.0.1',
        'username' => 'root',
        'password' => '',
        'dbname' => 'vokuro',
        'charset' => 'utf8',
    ],
    'application' => [
        'appDir' => APP_PATH . '/',
        'modelsDir' => APP_PATH . '/common/models/',
        'migrationsDir' => APP_PATH . '/migrations/',
        'cacheDir' => BASE_PATH . '/cache/',
        'baseUri' => preg_replace('/public([\/\\\\])index.php$/', '', $_SERVER["PHP_SELF"]),
        'publicUrl' => 'vokuro.phalconphp.com',
        'cryptSalt' => 'eEAfR|_&G&f,+vU]:jFr!!A&+71w1Ms9~8_4L!<@[N@DyaIP_2My|:+.u>/6m,$D'
    ],
    'mail' => [
        'fromName' => 'Vokuro',
        'fromEmail' => 'phosphorum@phalconphp.com',
        'smtp' => [
            'server' => 'smtp.gmail.com',
            'port' => 587,
            'security' => 'tls',
            'username' => '',
            'password' => ''
        ]
    ],
    'amazon' => [
        'AWSAccessKeyId' => '',
        'AWSSecretKey' => ''
    ],
    'logger' => [
        'path' => BASE_PATH . '/logs/',
        'format' => '%date% [%type%] %message%',
        'date' => 'D j H:i:s',
        'logLevel' => Logger::DEBUG,
        'filename' => 'application.log',
    ],
    'useMail' => true,
    'version' => '1.0',
    'printNewLine' => true
]);
