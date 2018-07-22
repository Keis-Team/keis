<?php

namespace Keis\Modules\Frontend\Controllers;

use Phalcon\Mvc\Controller;
use Phalcon\Mvc\Dispatcher;
use Phalcon\Tag;

class ControllerBase extends Controller
{
    protected static $pre_tittle = 'Keis | ';

    public function initialize()
    {
        $this->tag->setDoctype(Tag::HTML401_STRICT);
        $this->tag->prependTitle(self::$pre_tittle);
        // $this->view->setTemplateAfter('main');
    }

    /**
     * Execute before the router so we can determine if this is a private controller, and must be authenticated, or a
     * public controller that is open to all.
     *
     * @param Dispatcher $dispatcher
     * @return boolean
     */
    public function beforeExecuteRoute(Dispatcher $dispatcher)
    {
        //$this->init_default_styles();


        $controllerName = $dispatcher->getControllerName();

        // Only check permissions on private controllers
        if ($this->acl->isPrivate($controllerName)) {

            // Get the current identity
            $identity = $this->auth->getIdentity();

            // If there is no identity available the user is redirected to index/index
            if (!is_array($identity)) {

                $this->flash->notice('You don\'t have access to this module: private');

                $dispatcher->forward([
                    'controller' => 'index',
                    'action' => 'index'
                ]);
                return false;
            }

            // Check if the user have permission to the current option
            $actionName = $dispatcher->getActionName();
            if (!$this->acl->isAllowed($identity['profile'], $controllerName, $actionName)) {

                $this->flash->notice('You don\'t have access to this module: ' . $controllerName . ':' . $actionName);

                if ($this->acl->isAllowed($identity['profile'], $controllerName, 'index')) {
                    $dispatcher->forward([
                        'controller' => $controllerName,
                        'action' => 'index'
                    ]);
                } else {
                    $dispatcher->forward([
                        'controller' => 'user_control',
                        'action' => 'index'
                    ]);
                }

                return false;
            }
        }
    }

    protected function init_default_styles()
    {
        /*$headerCollection = $this->assets->collection("header");

        $headerCollection->addCss("js/jquery.js");
        $headerCollection->addCss("js/bootstrap.min.js");

        $footerCollection = $this->assets->collection("footer");

        $footerCollection->addJs("js/jquery.js");
        $footerCollection->addJs("js/bootstrap.min.js");*/
    }


}
