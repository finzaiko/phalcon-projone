<?php

/** (c)Finzaiko */

use \Phalcon\Tag;

class DashboardController extends BaseController {

    public function indexAction() {
        Tag::setTitle('Dashboard');
        echo 'DASHBOARD';
        parent::initialize();
    }
    
}
