<?php

/** (c)Finzaiko */

use Phalcon\Tag;

class IndexController extends BaseController {

    public function indexAction() {
        
        Tag::setTitle('Home');
        parent::initialize();
        echo "Hello !!";
    }
    
    public function generatePasswordAction($password){
        echo $this->security->hash($password);
    }
    
    public function getSessionAction(){
        $user = $this->session->get('user');
        print_r($user);
        echo $this->session->get('name');
    }
    
    public function removeSessionAction() {
        echo $this->session->remove('name');
    }
    
    public function destroySessionAction() {
        echo $this->session->destroy();
    }
    
    public function signoutAction() {
        $this->session->destroy();
        $this->response->redirect('index');
    }
    
    
    
}

