<?php
namespace Keis\Modules\Frontend\Controllers;
class PrivacyController extends ControllerBase
{
    public function indexAction()
    {
        $this->view->setTemplateBefore('public');
    }
}
