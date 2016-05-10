<?php

/** (c)Finzaiko */

use \Phalcon\Tag;

class SigninController extends BaseController {

    //public $tokenKey;
    //public $tokenVal;
    
    public function onConstruct() {
        parent::initialize();
    }
    
    public function indexAction() {
        Tag::setTitle('Sign in');
        $this->assets->collection('additional')->addCss('css/signin.css');
      
        /*
        $this->tokenKey = $this->security->getTokenKey();
        'old'=> $this->security->getSessionToken(),
        $this->tokenVal = $this->security->getToken();
        
        $this->view->setVars([
            'tokenKey' => $this->tokenKey,
            'token' => $this->tokenVal
        ]);
         */
        $this->view->setVars([
            'tokenKey' => $this->tokenKey,
            'token' => $this->tokenVal
        ]);
    }

    private function _createUserSession(User $user) {
        $this->session->set('id', $user->id);
        $this->session->set('role', $user->role);
        $this->response->redirect('dashboard/index');
    }
    
    public function doSigninAction() {
        /*
        if($this->security->checkToken('cS4HTzUniwCeeyGd','M7HaKouAmYI3DEGM') == false){
            $this->flash->error("Invalid Token !");
        }
        if($this->security->checkToken($this->tokenKey, $this->tokenVal) == false){
            $this->flash->error("Invalid Token !");
        }
         */
        
        if ($this->request->isPost()) {
            /*
            if($this->security->checkToken() == false){
                $this->flash->error("Invalid Token !");
            }
             */
            $this->view->disable();
            /*
            $user = User::findFirst([
                "email = :email: AND passwd = :passwd:",
                "bind" => [
                    'email' => $this->request->getPost('email'),
                    'passwd' => $this->request->getPost('password'),
                ]
            ]);
            if($user){
                $this->session->set('id', $user->id);
                $this->session->set('role', $user->role);
                $this->response->redirect('dashboard/index');
                return;
            }
            $this->flash->error('Incorrect Cridentials');
            $this->response->redirect('signin/index');
             */
            $email = $this->request->getPost('email');
            $password = $this->request->getPost('password');
            
            $user = User::findFirstByEmail($email);
            if($user){
                if($this->security->checkHash($password,$user->passwd)){
                    /*
                    $this->session->set('id', $user->id);
                    $this->session->set('role', $user->role);
                    $this->response->redirect('dashboard/index');
                     */
                    $this->_createUserSession($user);
                    return;
                }
            }
            
            $this->flash->error('Incorrect Cridentials');
            $this->response->redirect('signin/index');
        }
    }
    
    public function registerAction() {
        Tag::setTitle('Register');
        $this->assets->collection('additional')->addCss('css/signin.css');
    }
    
    public function doRegisterAction() {
         if ($this->request->isPost()) {
            /*
            if($this->security->checkToken() == false){
                $this->flash->error("Invalid Token !");
            }
             */
             
            $email = $this->request->getPost('email');
            $password = $this->request->getPost('password');
            $confirm_password = $this->request->getPost('confirm_password');
            
            if($password != $confirm_password){
                 $this->flash->error("Your password do not match.");
                 $this->response->redirect('signin/register');
            }
            
            $user = new User();
            $user->role = 'user';
            $user->email = $email;
            $user->passwd = $this->security->hash($password);
            
            $result = $user->save();
            
            if(!$result){
                $output = [];
                foreach ($user->getMessages() as $message) {
                    $output[] = $message;
                }
                $output = implode(',', $output);
                $this->flash->error($output);
                $this->response->redirect('signin/register');
                return;
            }
            $this->_createUserSession($user);
         
         }
    }
}
