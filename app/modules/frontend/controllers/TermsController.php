<?php
namespace Keis\Modules\Frontend\Controllers;

class TermsController extends ControllerBase
{
    public function indexAction()
    {
        $this->view->setTemplateBefore('public');
    }
}
