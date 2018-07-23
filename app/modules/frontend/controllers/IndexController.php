<?php

namespace Keis\Modules\Frontend\Controllers;



class IndexController extends ControllerBase {
    public function initialize() {
        $this->tag->setTitle('Welcome');
        parent::initialize();
    }

    public function indexAction() {
       /* $cache = $this->getDI()->get('my-cache');
        $cache->save("my-data", 'hello world');
        $data = $cache->get("my-data");*/

        $this->view->setVar('logged_in', is_array($this->auth->getIdentity()));
        $this->view->setTemplateBefore('public');
    }
}
