<?php

/** (c)Finzaiko */

use Phalcon\Mvc\Model\Behavior\SoftDelete;

class User extends BaseModel {

    public function getSource() {
        return 'users';
    }

    public function initialize() {
        
        //$this->setSource('users');
        
        //reference
        //$this->hasMany('id', 'Project', 'user_id');
        
        $this->addBehavior(new SoftDelete([
            'field'=>'is_deleted',
            'value'=> true
        ]));
    }
    
    public function beforeCreate() {
        $this->create_at = date('Y-m-d H:i:s');
    }
    
    public function beforeUpdate() {
        $this->create_at = date('Y-m-d H:i:s');
    }

}
