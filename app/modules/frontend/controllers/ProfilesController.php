<?php
namespace Keis\Modules\Frontend\Controllers;

use Phalcon\Tag;
use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;
use Keis\Modules\Frontend\Forms\ProfilesForm;
use Keis\Modules\Frontend\Models\Profiles;


class ProfilesController extends ControllerBase
{


    public function initialize()
    {
        $this->view->setTemplateBefore('private');
    }

    public function indexAction()
    {
        $this->persistent->conditions = null;
        $this->view->form = new ProfilesForm();
    }

    public function searchAction()
    {
        $numberPage = 1;
        if ($this->request->isPost()) {
            $query = Criteria::fromInput($this->di, 'Vokuro\Models\Profiles', $this->request->getPost());
            $this->persistent->searchParams = $query->getParams();
        } else {
            $numberPage = $this->request->getQuery("page", "int");
        }

        $parameters = [];
        if ($this->persistent->searchParams) {
            $parameters = $this->persistent->searchParams;
        }

        $profiles = Profiles::find($parameters);
        if (count($profiles) == 0) {

            $this->flash->notice("The search did not find any profiles");

            return $this->dispatcher->forward([
                "action" => "index"
            ]);
        }

        $paginator = new Paginator([
            "data" => $profiles,
            "limit" => 10,
            "page" => $numberPage
        ]);

        $this->view->page = $paginator->getPaginate();
    }

    public function createAction()
    {
        if ($this->request->isPost()) {

            $profile = new Profiles([
                'name' => $this->request->getPost('name', 'striptags'),
                'active' => $this->request->getPost('active')
            ]);

            if (!$profile->save()) {
                $this->flash->error($profile->getMessages());
            } else {
                $this->flash->success("Profile was created successfully");
            }

            Tag::resetInput();
        }

        $this->view->form = new ProfilesForm(null);
    }

    public function editAction($id)
    {
        $profile = Profiles::findFirstById($id);
        if (!$profile) {
            $this->flash->error("Profile was not found");
            return $this->dispatcher->forward([
                'action' => 'index'
            ]);
        }

        if ($this->request->isPost()) {

            $profile->assign([
                'name' => $this->request->getPost('name', 'striptags'),
                'active' => $this->request->getPost('active')
            ]);

            if (!$profile->save()) {
                $this->flash->error($profile->getMessages());
            } else {
                $this->flash->success("Profile was updated successfully");
            }

            Tag::resetInput();
        }

        $this->view->form = new ProfilesForm($profile, [
            'edit' => true
        ]);

        $this->view->profile = $profile;
    }

    public function deleteAction($id)
    {
        $profile = Profiles::findFirstById($id);
        if (!$profile) {

            $this->flash->error("Profile was not found");

            return $this->dispatcher->forward([
                'action' => 'index'
            ]);
        }

        if (!$profile->delete()) {
            $this->flash->error($profile->getMessages());
        } else {
            $this->flash->success("Profile was deleted");
        }

        return $this->dispatcher->forward([
            'action' => 'index'
        ]);
    }
}
