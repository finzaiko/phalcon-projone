<?php

/** (c)Finzaiko */

use Phalcon\Mvc\Dispatcher,
    Phalcon\Events\Event,
    Phalcon\Acl;

class Permission extends \Phalcon\Mvc\User\Plugin {

    const GUEST = 'guest';
    const USER  = 'user';
    const ADMIN = 'admin';

    protected $_publicResources = [
        'index' => ['*'],
        'signin' => ['*']
    ];
    
    protected $_userResources = [
        'dashboard' => ['*']
    ];
    
    protected $_adminResources = [
        'admin' => ['*']
    ];

    public function beforeExecuteRoute(Event $event, Dispatcher $dispatcher) {

        // Debug
        //$this->session->destroy();
        
        // get current row
        //return;
        $role = $this->session->get('role');
        if(!$role){
            $role = self::GUEST;
        }
        
        // get controller/action from dispatcher
        $controller = $dispatcher->getControllerName();
        $action = $dispatcher->getActionName();
        
        // get acl roles list
        $acl = $this->_getAcl();
        
        // set if any permission
        $allowed = $acl->isAllowed($role, $controller, $action);
        
        //echo $allowed;
        //die;
        
        if($allowed != Acl::ALLOW){
            $this->flash->error("You do not have permission to access this action.");
            $this->response->redirect('index');
            /*
            $dispatcher->forward([
                'controller' => 'index',
                'action' => 'index'
            ]);
             */
            // stop dispatcher current oparation
            return false;
        }
    }
    
    protected function _getAcl() {
        
        if(!isset($this->persistent->acl)){
            $acl = new Phalcon\Acl\Adapter\Memory();
            $acl->setDefaultAction(Acl::DENY);
            
            $roles = [
                self::GUEST => new Acl\Role(self::GUEST),
                self::USER => new Acl\Role(self::USER),
                self::ADMIN => new Acl\Role(self::ADMIN),
            ];
            
            foreach ($roles as $role) {
                $acl->addRole($role);
            }
            
            // Public resources
            foreach ($this->_publicResources as $resouce => $action) {
                $acl->addResource(new Acl\Resource($resouce), $action);
            }
            
            // User resources
            foreach ($this->_userResources as $resouce => $action) {
                $acl->addResource(new Acl\Resource($resouce), $action);
            }
            
            // Admin resources
            foreach ($this->_adminResources as $resouce => $action) {
                $acl->addResource(new Acl\Resource($resouce), $action);
            }
            
            // Allow all roles to access Public Resources
            foreach ($roles as $role) {
                foreach ($this->_publicResources as $resouce => $actions) {
                    //echo $role->getName();
                    //echo $resouce;
                    $acl->allow($role->getName(), $resouce, '*');
                }
            }
            //die;
            
            // Allow user and admin to User Resources
            foreach ($this->_userResources as $resouce => $actions) {
                foreach ($actions as $action) {
                    $acl->allow(self::USER, $resouce, $action);
                    $acl->allow(self::ADMIN, $resouce, $action);
                }
            }
            
            // Allow admin to Admin Resources
            foreach ($this->_adminResources as $resouce => $actions) {
                foreach ($actions as $action) {
                    $acl->allow(self::ADMIN, $resouce, $action);
                }
            }
            
            $this->persistent->acl = $acl;
        }
        return $this->persistent->acl;
    }
}
