<?php
namespace Keis\Modules\Frontend\Controllers;

/**
 * Display the default index page.
 */
class IndexController extends ControllerBase
{
//    public function initialize()
//    {
//        $this->tag->setTitle('Welcome');
//        parent::initialize();
//    }
    /**
     * Default action. Set the public layout (layouts/public.volt)
     */
    public function indexAction()
    {
        $this->view->setVar('logged_in', is_array($this->auth->getIdentity()));
        $this->view->setTemplateBefore('public');
    }
}
