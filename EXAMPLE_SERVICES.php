<?php

use Phalcon\Mvc\Dispatcher;
use Phalcon\Mvc\Router;
use Phalcon\Mvc\Url as UrlResolver;
use Phalcon\Session\Adapter\Files as SessionAdapter;
use Phalcon\Flash\Direct as Flash;
use Keis\Auth\Auth;
use Keis\Acl\Acl;
use Keis\Mail\Mail;

use Phalcon\Cache\Backend\File as BackFile;
use Phalcon\Cache\Frontend\Data as FrontData;

$di->setShared('router', function () {
    $router = new Router();

    $router->setDefaultModule('frontend');

    return $router;
});

$di->setShared('url', function () {
    $config = $this->getConfig();

    $url = new UrlResolver();
    $url->setBaseUri($config->application->baseUri);

    return $url;
});

$di->setShared('session', function () {
    $session = new SessionAdapter();

    /* $session->setOptions([
         'uniqueId' => 'my-private-app',
         'host' => '127.0.0.1',
         'port' => 11211,
         'persistent' => true,
         'lifetime' => 3600,
         'prefix' => 'keis_',
         'adapter' => 'memcache',
     ]);*/

    $session->start();

    return $session;
});

$di->set('flash', function () {
    return new Flash([
        'error' => 'alert alert-danger',
        'success' => 'alert alert-success',
        'notice' => 'alert alert-info',
        'warning' => 'alert alert-warning'
    ]);
});

$di->set('auth', function () {
    return new Auth();
});

$di->set('mail', function () {
    return new Mail();
});

$di->setShared('AclResources', function () {
    $pr = [];
    if (is_readable(APP_PATH . '/config/privateResources.php')) {
        $pr = include APP_PATH . '/config/privateResources.php';
    }
    return $pr;
});

$di->set('acl', function () {
    $acl = new Acl();
    $pr = $this->getShared('AclResources')->privateResources->toArray();
    $acl->addPrivateResources($pr);
    return $acl;
});

$di->setShared('dispatcher', function () {
    $dispatcher = new Dispatcher();
    $dispatcher->setDefaultNamespace('Keis\Modules\Frontend\Controllers');
    return $dispatcher;
});

/*$di->set('Cache', function () {

// Create an Output frontend. Cache the files for 2 days
    $frontCache = new FrontData(
        [
            'lifetime' => 172800,
        ]
    );

// Create the component that will cache from the 'Output' to a 'File' backend
// Set the cache file directory - it's important to keep the '/' at the end of
// the value for the folder
    $cache = new BackFile(
        $frontCache,
        [
            'cacheDir' => '../app/cache/',
        ]
    );
    return $cache;
});*/
/*$this->di->set('assets', function(){

    $assetManager = new \Phalcon\Assets\Manager();

    $assetManager->collection('css')
        ->addCss('css' . DS . 'vendor.css')
        ->addCss('css' . DS . 'bootstrapValidator.min.css');

    $assetManager->collection('js')
        ->addJs('js' . DS . 'vendor.js')
        ->addJs('js' . DS . 'scripts' . DS . 'Utils.js')
        ->addJs('js' . DS . 'bootstrapValidator.min.js')
        ->addJs('js' . DS . 'script.js');

    return $assetManager;
}, true);*/

$di->set('view', function () {
    $view = new View();
    $view->setDI($this);
    $view->setViewsDir(__DIR__ . '/views/');
    $view->setPartialsDir( __DIR__ . '/views/partials/');
    // $view->setLayoutsDir(__DIR__ . '/layouts/');

    $view->registerEngines([
        '.volt'  => 'voltShared',
        '.phtml' => PhpEngine::class
    ]);

    return $view;
});
