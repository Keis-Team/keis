<?php

namespace Keis\Modules\Frontend;

use Phalcon\DiInterface, Phalcon\Loader, Phalcon\Mvc\View, Phalcon\Mvc\ModuleDefinitionInterface;
use Phalcon\Mvc\View\Engine\Php as PhpEngine;

class Module implements ModuleDefinitionInterface {
    public function registerAutoloaders(DiInterface $di = null) {

        $loader = new Loader();
        $loader->registerNamespaces([
            'Keis\Modules\Frontend\Controllers' => __DIR__ . '/controllers/',
            'Keis\Modules\Frontend\Models'      => __DIR__ . '/models/',
            'Keis\Modules\Frontend\Forms'       => __DIR__ . '/forms/',
        ]);

        $loader->register();
    }

    public function registerServices(DiInterface $di) {
        $di->set('view', function () {
            $view = new View();
            $view->setDI($this);
            $view->setViewsDir(__DIR__ . '/views/');
            $view->setPartialsDir(__DIR__ . '/views/partials/');
            $view->registerEngines([
                '.volt'  => 'voltShared',
                '.phtml' => PhpEngine::class
            ]);

            return $view;
        });
    }
}
