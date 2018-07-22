<?php
namespace Keis\Acl;

use Phalcon\Mvc\User\Component;
use Phalcon\Acl\Adapter\Memory as AclMemory;
use Phalcon\Acl\Role as AclRole;
use Phalcon\Acl\Resource as AclResource;
use Keis\Modules\Frontend\Models\Profiles;

class Acl extends Component
{

    private $acl;

    private $filePath;

    private $privateResources = array();

    private $actionDescriptions = [
        'index' => 'Access',
        'search' => 'Search',
        'create' => 'Create',
        'edit' => 'Edit',
        'delete' => 'Delete',
        'changePassword' => 'Change password'
    ];

    public function isPrivate($controllerName)
    {
        $controllerName = strtolower($controllerName);
        return isset($this->privateResources[$controllerName]);
    }

    public function isAllowed($profile, $controller, $action)
    {
        return $this->getAcl()->isAllowed($profile, $controller, $action);
    }

    public function getAcl()
    {
        // Check if the ACL is already created
        if (is_object($this->acl)) {
            return $this->acl;
        }

        // Check if the ACL is in APC
        if (function_exists('apc_fetch')) {
            $acl = apc_fetch('vokuro-acl');
            if (is_object($acl)) {
                $this->acl = $acl;
                return $acl;
            }
        }

        $filePath = $this->getFilePath();

        // Check if the ACL is already generated
        if (!file_exists($filePath)) {
            $this->acl = $this->rebuild();
            return $this->acl;
        }

        // Get the ACL from the data file
        $data = file_get_contents($filePath);
        $this->acl = unserialize($data);

        // Store the ACL in APC
        if (function_exists('apc_store')) {
            apc_store('vokuro-acl', $this->acl);
        }

        return $this->acl;
    }

    public function getPermissions(Profiles $profile)
    {
        $permissions = [];
        foreach ($profile->getPermissions() as $permission) {
            $permissions[$permission->resource . '.' . $permission->action] = true;
        }
        return $permissions;
    }

    public function getResources()
    {
        return $this->privateResources;
    }

    public function getActionDescription($action)
    {
        if (isset($this->actionDescriptions[$action])) {
            return $this->actionDescriptions[$action];
        } else {
            return $action;
        }
    }

    public function rebuild()
    {
        $acl = new AclMemory();

        $acl->setDefaultAction(\Phalcon\Acl::DENY);

        // Register roles

        $profiles = Profiles::find([
            'active = :active:',
            'bind' => [
                'active' => 'Y'
            ]
        ]);
        foreach ($profiles as $profile) {
            $acl->addRole(new AclRole($profile->name));
        }

        foreach ($this->privateResources as $resource => $actions) {
            $acl->addResource(new AclResource($resource), $actions);
        }

        // Grant access to private area to role Users
        foreach ($profiles as $profile) {

            // Grant permissions in "permissions" model
            foreach ($profile->getPermissions() as $permission) {
                $acl->allow($profile->name, $permission->resource, $permission->action);
            }

            // Always grant these permissions
            $acl->allow($profile->name, 'users', 'changePassword');
        }

        $filePath = $this->getFilePath();

        if (touch($filePath) && is_writable($filePath)) {

            file_put_contents($filePath, serialize($acl));

            // Store the ACL in APC
            if (function_exists('apc_store')) {
                apc_store('vokuro-acl', $acl);
            }
        } else {
            $this->flash->error(
                'The user does not have write permissions to create the ACL list at ' . $filePath
            );
        }

        return $acl;
    }


    protected function getFilePath()
    {
        if (!isset($this->filePath)) {
            $this->filePath = rtrim($this->config->application->cacheDir, '\\/') . '/acl/data.txt';
        }

        return $this->filePath;
    }

    public function addPrivateResources(array $resources) {
        if (count($resources) > 0) {
            $this->privateResources = array_merge($this->privateResources, $resources);
            if (is_object($this->acl)) {
                $this->acl = $this->rebuild();
            }
        }
    }
}
