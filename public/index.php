<?php

use Phalcon\Loader;
use Phalcon\Mvc\View;


$loader = new Loader();

$loader->registerDirs(array(
          '../apps/controllers/',
          '../apps/models/'
));

$loader->register();
//router
$di = new DI();
//registriranje dispathera
$di->set('router', 'Phalcon\Mvc\Router');
//regist. http/responsa
$di->set('dispatcher', 'Phalcon\Http\Response');
//regist. http/requesta
$di->set('request', 'Phalcon\Http\Request');

//regist. view komponente
$di->set('view', function(){
        $view = new View();
        $view->setViewsDir('../apps/views/');
        return $view;
});

$di->set('db', function(){
      return new Database(array(
            "host" => "localhost",
            "usename" => "root",
            "password" => "",
            "dbname" => "invo"
          ));
});

//regist. model-metadata
$di->set('modelsMetadata', 'Phalcon\Mvc\Model\Metadata\Memory');

//registr. Model Manager
$di->set('modelsManager', 'Phalcon\Mvc\Model\Manager');

try {

  $application = new Application($di);
  echo $application->handle()->getContent();

}catch (Exception $e){
  echo $e->getMessage();
}




 ?>
