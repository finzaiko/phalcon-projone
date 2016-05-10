<?php

/** (c)Finzaiko */

use Phalcon\Loader;
use Phalcon\Mvc\View;
use Phalcon\Mvc\Application;
use Phalcon\Di\FactoryDefault;
use Phalcon\Mvc\Url as UrlProvider;
use Phalcon\Db\Adapter\Pdo\Postgresql;
use Phalcon\Session\Adapter\Files;
use Phalcon\Mvc\Router;

try {

    // Register an autoloader
    $loader = new Loader();
    $loader->registerDirs(array(
        '../app/controllers/',
        '../app/models/',
        '../app/config/',
    ))->register();

    // Create a DI
    $di = new FactoryDefault();

    // Setup the database service
    $di->set('db', function () {
        $db = new Postgresql([
            "host"     => "localhost",
            "username" => "postgres",
            "password" => "postgres",
            "dbname"   => "belajar_phalcon"
        ]);
        return $db;
    });

    // Setup the view component
    $di->set('view', function () {
        $view = new View();
        $view->setViewsDir('../app/views/');
        $view->registerEngines([
            '.volt' => 'Phalcon\Mvc\View\Engine\Volt'
        ]);
        return $view;
    });
    
    $di->set('security', function () {
        $security = new Phalcon\Security();
        //$security->setWorkFactor(12); // Set the password hashing factor to 12 rounds
        return $security;
    });

    // Router
    
    // Session
    $di->setShared('session', function(){
        $session = new Files();
        $session->start();
        return $session;
    });

    // Flash data
    $di->set('flash', function(){
        $flash = new \Phalcon\Flash\Session([
            'error' => 'alert alert-danger',
            'success' => 'alert alert-success',
            'notice' => 'alert alert-info',
            'warning' => 'alert alert-warning'
        ]);
        return $flash;
    }); 
    
    // Base url
    $di->set('url', function () {
        $url = new UrlProvider();
        $url->setBaseUri('/phalcon-projone/');
        return $url;
    });
    
    /*
    $di['modelsMetadata'] = function(){
        $metaData = new \Phalcon\Mvc\Model\MetaData\Apc([
            'lifetime'=>86400,
            'prefix'=>'metaData'
        ]);
        return $metaData;
    };
     * 
     */
    
    // Custom dispather (overide the default)
    $di->set('dispatcher', function() use ($di){
        $eventManager = $di->getShared('eventsManager');
        
        // Custom ACL Class
        $permission = new Permission();
        
        // Lister for event the permission class
        $eventManager->attach('dispatch',$permission);
        
        $disparcher = new \Phalcon\Mvc\Dispatcher();
        $disparcher->setEventsManager($eventManager);
        
        return $disparcher;
        
    });
    
    // Handle the request
    $application = new Application($di);
    echo $application->handle()->getContent();

} catch (\Exception $e) {
     echo "Exception: ", $e->getMessage();
}